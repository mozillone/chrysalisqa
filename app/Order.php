<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;
use Auth;
use Cookie;
use Session;
use Config;
use App\Cart;
use App\Charities;
use App\Helpers\StripeApp;
class Order extends Authenticatable
{
   protected $fillable = [
                'order_id', 'user_id','firstname', 'lastname', 'email', 'phone_no', 'pay_firstname', 'pay_lastname', 'pay_address_1', 'pay_address_2', 'pay_city', 'pay_zipcode', 'pay_country', 'payment_method', 'payment_code','shipping_firstname', 'shipping_lastname','shipping_address_1','shipping_address_2','shipping_city','shipping_postcode','shipping_country','shipping_method','shipping_code','comment','total','affiliate_id','commission','created_at','modified_at'
    ];
  public function __construct()
  {
    $this->stripe=new StripeApp();
  }
    protected function placeOrder($req){
        $data=Cart::getCartProducts();
       foreach($data['basic'] as $cart){
        $costumer_costumes[$cart->created_by][]=$cart;
       }
        if(count($data['basic'])){
           $cc_token=$this->getCreditCardToken($data['basic'][0]->cc_id);
             if(count($cc_token)){
                $token=$cc_token;
             }else{
               $result=array('result'=>0,'message'=>"Credit card token not valid");
                return $result;
             }
            $orders=[];
            foreach($costumer_costumes as $key=>$costumer){
              $cart_id=$costumer[0]->cart_id;
              $cart_info=Cart::cartMetaInfo($cart_id);
            
                $order_info=array('user_id'=>Auth::user()->id, 
                                   'firstname'=>Auth::user()->first_name, 
                                   'lastname'=>Auth::user()->last_name, 
                                   'email'=>Auth::user()->email, 
                                   'phone_no'=>Auth::user()->phone_number,
                                   'pay_firstname'=>$cart_info[0]->pay_firstname,
                                   'pay_lastname'=>$cart_info[0]->pay_lastname,
                                   'pay_address_1'=>$cart_info[0]->pay_address_1,
                                   'pay_address_2'=>$cart_info[0]->pay_address_2,
                                   'pay_city'=>$cart_info[0]->pay_city,
                                   'pay_zipcode'=>$cart_info[0]->pay_zipcode,
                                   'pay_country'=>$cart_info[0]->pay_country,
                                   'shipping_firstname'=>$cart_info[0]->shipping_firstname,
                                   'shipping_lastname'=>$cart_info[0]->shipping_lastname,
                                   'shipping_address_1'=>$cart_info[0]->shipping_address_1,
                                   'shipping_address_2'=>$cart_info[0]->shipping_address_2,
                                   'shipping_city'=>$cart_info[0]->shipping_city,
                                   'shipping_postcode'=>$cart_info[0]->shipping_postcode,
                                   'shipping_country'=>$cart_info[0]->shipping_country,
                                   'total'=>$data['basic'][0]->total,
                                   'created_at'=>date('Y-m-d h:i:s'),
                                );
                 $order_id=Site_model::insert_get_id('order',$order_info);
                 $this->orderStatusInserted($order_id,Config::get('constants.Processing'));
                 $price=0;
                 $total_shiping=0;
                 $subtotal=0;
                 foreach($costumer as $cart){
                      $costume_info=array('costume_id'=>$cart->costume_id, 
                                 'sku'=>$cart->sku, 
                                 'costume_name'=>$cart->costume_name, 
                                 'qty'=>$cart->qty, 
                                 'price'=>$cart->price, 
                                 'order_id'=> $order_id, 
                        );
                       Site_model::insert_get_id('order_items',$costume_info);
                       DB::Update('update `cc_costumes` SET quantity=quantity-'.$cart->qty.' WHERE costume_id='.$cart->costume_id.'');
                       if($cart->shipping!="Free Shipping" && SiteHelper::domesticRate($cart->item_location,$cart_id)['result']!="0"){
                           $shipping_amout=SiteHelper::domesticRate($cart->item_location,$cart_id)['msg']['rate'];
                        }
                       else{
                          $shipping_amout="0";
                       }
                      $subtotal+=$cart->price*$cart->qty;
                      $price+=($cart->price*$cart->qty)+$shipping_amout;
                      $total_shiping+=$shipping_amout;
                     
                 }
               
                $amount=$price;
                $currency=Config::get('constants.Currency');
                $api_customer_id=Auth::user()->api_customer_id;

                $order_subtotal=array('order_id'=>$order_id,
                              'code'=>"",
                              'title'=>"Subtotal",
                              'value'=>$subtotal,
                      );
                $this->stripe->charge($amount,$currency,$api_customer_id,$token);
                Site_model::insert_get_id('order_total',$order_subtotal);

                $order_shipping=array('order_id'=>$order_id,
                              'code'=>"",
                              'title'=>"Shipping",
                              'value'=>$total_shiping,
                      );
                Site_model::insert_get_id('order_total',$order_shipping);
                DB::Update('update `cc_order` SET total='.$amount.' WHERE    order_id='.$order_id.'');
                $orders[]=$order_id;

           }
            
             Site_model::delete_single('cart',array('cart_id'=>$costumer[0]->cart_id));
             $result=array('result'=>1,'message'=>$orders);
             return $result;
         }else{
            $result=array('result'=>0,'message'=>"Cart Items are empty");
            return $result;
        }
    }
    private function orderStatusInserted($order_id,$status_id){
       $order_status=array('order_id'=>$order_id,'status_id'=>$status_id);
       Site_model::insert_get_id('order_status',$order_status);
       return true;
    }
    private function getCreditCardToken($cc_id){
      $cc_details=DB::Select('SELECT *  FROM `cc_creditcard` WHERE `id` ='.$cc_id);
      if(count($cc_details)){
        return $cc_details[0]->payment_method_token;
      }else{
        return false;
      }
    }
    protected function getCharitiesList(){
       $charities_list=DB::Select('SELECT * FROM cc_charities');
       return $charities_list;
    }
    protected function orderCharityFund($req){
     if(isset($req['suggest_charity']) && !isset($req['charity'])){
         $result=array('name'=>$req['suggest_charity'],
                        'suggested_by'=>Auth::user()->id,
                        'created_at'=>date('Y-m-d h:i:s')
                        );
         $charity_id=Site_model::insert_get_id('charities',$result);
      }else{
       $charity_id=$req['charity'];
      }
      $result=array('user_id'=>Auth::user()->id,
                    'charity_id'=>$charity_id,
                    'amount'=>$req['amount'],
                    'created_at'=>date('Y-m-d h:i:s')
                      );
       Site_model::insert_get_id('order_charity',$result);
       $carity_info=Charities::getCharityInfo($charity_id);
       return  $carity_info;
    }
  
}

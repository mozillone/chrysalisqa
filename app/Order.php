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
use App\Address;
use App\Helpers\StripeApp;
use Exception;
use Redirect;
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
         $api_customer_id=Auth::user()->api_customer_id;
         try {
                $this->stripe->customerFind($api_customer_id);
         }catch(Exception $e){
               $result=array('result'=>0,'message'=>$e->getMessage());
                return $result;
         }
         $data=Cart::getCartProducts();
         foreach($data['basic'] as $cart){
          $costumer_costumes[$cart->created_by][]=$cart;
         }
         if(isset($req['card_id'])){
            $card_id=$req['card_id'];
         }else{
            $card_id=$data['basic'][0]->cc_id;
         }
         if(count($data['basic'])){
           $cc_token=$this->getCreditCardToken($card_id);
             if(count($cc_token) && $cc_token!=false){
                $token=$cc_token;
                 try {
                   $this->stripe->CCVerify($api_customer_id,$token);
                 }catch(Exception $e){
                       $result=array('result'=>0,'message'=>$e->getMessage());
                        return $result;
                 }
             }else{
               $result=array('result'=>0,'message'=>"Credit card token not valid");
                return $result;
             }
            $orders=[];
            foreach($costumer_costumes as $key=>$costumer){
              $cart_id=$costumer[0]->cart_id;
              $cart_info=Cart::cartMetaInfo($cart_id);
               if(!empty($cart_info[0]->shipping_address_1)){
                   $shipping_address=$cart_info;
                   $shipping_address_1=$shipping_address[0]->shipping_address_1;
                   $shipping_address_2=$shipping_address[0]->shipping_address_2;
                   $shipping_city=$shipping_address[0]->shipping_city;
                   $shipping_state=$shipping_address[0]->shipping_state;
                   $shipping_zipcode=$shipping_address[0]->shipping_postcode;
                   $shipping_country=$shipping_address[0]->shipping_country;
               }else{
                  $shipping_address=Address::getAddressinfo('shipping',"latest"); 
                  $shipping_address_1=$shipping_address[0]->address1;
                  $shipping_address_2=$shipping_address[0]->address2;
                  $shipping_city=$shipping_address[0]->city;
                  $shipping_state=$shipping_address[0]->state;
                  $shipping_zipcode=$shipping_address[0]->zip_code;
                  $shipping_country=$shipping_address[0]->country;
               } 

               if(!empty($cart_info[0]->pay_address_1)){
                   $billing_address=$cart_info;
                   $pay_address_1=$billing_address[0]->pay_address_1;
                   $pay_address_2=$billing_address[0]->pay_address_2;
                   $pay_city=$billing_address[0]->pay_city;
                   $pay_state=$billing_address[0]->pay_state;
                   $pay_zipcode=$billing_address[0]->pay_zipcode;
                   $pay_country=$billing_address[0]->pay_country;
               }else{
                   $billing_address=Address::getAddressinfo('billing',"latest"); 
                   $pay_address_1=$billing_address[0]->address1;
                   $pay_address_2=$billing_address[0]->address2;
                   $pay_city=$billing_address[0]->city;
                   $pay_state=$billing_address[0]->state;
                   $pay_zipcode=$billing_address[0]->zip_code;
                   $pay_country=$billing_address[0]->country;
               }
                $order_info=array('buyer_id'=>Auth::user()->id,
                                 'seller_id'=>$key, 
                                 'firstname'=>Auth::user()->first_name, 
                                 'lastname'=>Auth::user()->last_name, 
                                 'email'=>Auth::user()->email, 
                                 'phone_no'=>Auth::user()->phone_number,
                                 'pay_firstname'=>$cart_info[0]->pay_firstname,
                                 'pay_lastname'=>$cart_info[0]->pay_lastname,
                                 'pay_address_1'=>$pay_address_1,
                                 'pay_address_2'=>$pay_address_2,
                                 'pay_city'=>$pay_city,
                                 'pay_state'=>$pay_state,
                                 'pay_zipcode'=>$pay_zipcode,
                                 'pay_country'=>$pay_country,
                                 'shipping_firstname'=>$cart_info[0]->shipping_firstname,
                                 'shipping_lastname'=>$cart_info[0]->shipping_lastname,
                                 'shipping_address_1'=>$shipping_address_1,
                                 'shipping_address_2'=>$shipping_address_2,
                                 'shipping_city'=>$shipping_city,
                                 'shipping_state'=>$shipping_state,
                                 'shipping_postcode'=>$shipping_zipcode,
                                 'shipping_country'=> $shipping_country,
                                 'total'=>'0.00',
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
               

                $order_subtotal=array('order_id'=>$order_id,
                              'code'=>"",
                              'title'=>"Subtotal",
                              'value'=>$subtotal,
                      );
                $order_info=$this->stripe->charge($amount,$currency,$api_customer_id,$token);
                $this->insertTransaction($order_info,$order_id,$cart->cc_id);
            
                Site_model::insert_get_id('order_total',$order_subtotal);

                $order_shipping=array('order_id'=>$order_id,
                              'code'=>"",
                              'title'=>"Shipping",
                              'value'=>$total_shiping,
                      );
                Site_model::insert_get_id('order_total',$order_shipping);
                DB::Update('update `cc_order` SET total='.$amount.',order_status_id='.Config::get('constants.Processing').' WHERE    order_id='.$order_id.'');
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
      $result=array('order_id'=>$req['order_id'],
                    'user_id'=>Auth::user()->id,
                    'charity_id'=>$charity_id,
                    'amount'=>$req['amount'],
                    'created_at'=>date('Y-m-d h:i:s')
                      );
       Site_model::insert_get_id('order_charity',$result);
       $carity_info=Charities::getCharityInfo($charity_id);
       return  $carity_info;
    }
    private function  insertTransaction($data,$order_id,$cc_id){
      $transaction=array('order_id'=>$order_id,
                    'user_id'=>Auth::user()->id,
                    'amount'=>$data['amount'],
                    'api_transaction_no'=>$data['id'],
                    'cc_id'=>$cc_id,
                    'status'=>$data['outcome']['type'],
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s')
                      );
       Site_model::insert_get_id('transactions',$transaction);
       return true;
    }
    protected function orderSummary($order_id){
        $order['basic']=DB::Select('SELECT ord.order_id,ord.created_at,ord.total,ord.phone_no,sts.name as status,trans.api_transaction_no,trans.status as payment_status,buyer.id as buyer_id,concat(buyer.first_name," ",buyer.last_name) as buyer_name,buyer.email as buyer_email,buyer.phone_number as buyer_phone,seller.id as seller_id,concat(seller.first_name," ",seller.last_name) as seller_name,seller.email as seller_email,seller.phone_number as seller_phone,concat(ord.pay_firstname," ",ord.pay_lastname) as pay_username,ord.pay_firstname,ord.pay_lastname,ord.pay_address_1,ord.pay_address_2,ord.pay_city,ord.pay_state,ord.pay_zipcode,ord.pay_country,concat(ord.shipping_firstname," ",ord.shipping_lastname) as ship_username,ord.shipping_firstname,ord.shipping_lastname,ord.shipping_address_1,ord.shipping_address_2,ord.shipping_city,ord.shipping_state,ord.shipping_postcode,ord.shipping_country FROM `cc_order` as ord LEFT JOIN  cc_status as sts on sts.status_id=ord.order_status_id LEFT JOIN cc_transactions as trans on trans.order_id=ord.order_id LEFT JOIN cc_users as buyer on buyer.id=ord.buyer_id  LEFT JOIN cc_users as seller on seller.id=ord.seller_id where ord.order_id='.$order_id.'  group by ord.order_id');
         $order['items']=DB::Select('SELECT * FROM `cc_order_items` where order_id="'.$order_id.'" order by sku ');
         $order['order_amount']=DB::Select('SELECT * FROM `cc_order_total` where order_id="'.$order_id.'" order by sort_order ');
         $order['status']=DB::Select('SELECT * FROM  cc_status');
         $order['states']=DB::Select('SELECT * FROM  cc_states');
         $order['countries']=DB::Select('SELECT * FROM `cc_countries`');
         $order['order_comment']=DB::Select('SELECT ord_sts.comment,sts.name as status,DATE_FORMAT(ord_sts.created_at,"%m/%d/%Y %h:%i %p") as date FROM `cc_order_status` as ord_sts LEFT JOIN cc_status as sts on sts.status_id=ord_sts.status_id where ord_sts.order_id='.$order_id.' order by order_status_id desc');
        return $order; 

    }
    protected function myOrderSummary($order_id){
        $order['basic']=DB::Select('SELECT ord.order_id,ord.created_at,ord.total,ord.phone_no,sts.name as status,trans.api_transaction_no,trans.status as payment_status,buyer.id as buyer_id,concat(buyer.first_name," ",buyer.last_name) as buyer_name,buyer.email as buyer_email,buyer.phone_number as buyer_phone,seller.id as seller_id,concat(seller.first_name," ",seller.last_name) as seller_name,seller.email as seller_email,seller.phone_number as seller_phone,concat(ord.pay_firstname," ",ord.pay_lastname) as pay_username,ord.pay_firstname,ord.pay_lastname,ord.pay_address_1,ord.pay_address_2,ord.pay_city,ord.pay_state,ord.pay_zipcode,ord.pay_country,concat(ord.shipping_firstname," ",ord.shipping_lastname) as ship_username,ord.shipping_firstname,ord.shipping_lastname,ord.shipping_address_1,ord.shipping_address_2,ord.shipping_city,ord.shipping_state,ord.shipping_postcode,ord.shipping_country FROM `cc_order` as ord LEFT JOIN  cc_status as sts on sts.status_id=ord.order_status_id LEFT JOIN cc_transactions as trans on trans.order_id=ord.order_id LEFT JOIN cc_users as buyer on buyer.id=ord.buyer_id  LEFT JOIN cc_users as seller on seller.id=ord.seller_id where ord.order_id='.$order_id.'  group by ord.order_id');
         $order['items']=DB::Select('SELECT * FROM `cc_order_items` where order_id="'.$order_id.'" order by sku ');
         $order['order_amount']=DB::Select('SELECT * FROM `cc_order_total` where order_id="'.$order_id.'" order by sort_order ');
           $order['order_comment']=DB::Select('SELECT ord_sts.comment,sts.name as status,DATE_FORMAT(ord_sts.created_at,"%m/%d/%Y %h:%i %p") as date FROM `cc_order_status` as ord_sts LEFT JOIN cc_status as sts on sts.status_id=ord_sts.status_id where ord_sts.order_id='.$order_id.' order by order_status_id desc');
        return $order; 

    }
    protected function orderUserCheck($order_id){
     $res=DB::Select('SELECT if(count(order_id)>=1,"true","false") as is_exists  FROM `cc_order` WHERE `order_id` ='.$order_id.' AND `buyer_id` ='.Auth::user()->id);
     return $res[0]->is_exists;
    }
    protected function orderStatusUpdate($req){
      $data=array('order_id'=>$req['order_id'],'status_id'=>$req['status_id'],'comment'=>$req['comment'],'created_at'=>date('Y-m-d h:i:s'));
      Site_model::insert_get_id('order_status',$data);
      DB::Update('update `cc_order` SET order_status_id='.$req['status_id'].' WHERE order_id='.$req['order_id'].'');
      return true;
    } 
    protected function OrderBillingAddressUpate($req){
      if(!empty($req['billing_state_dropdown'])){ $state=$req['billing_state_dropdown'];}else{$state=$req['state'];}
      $data=array('pay_firstname'=>$req['firstname'],
                  'pay_lastname'=>$req['lastname'],
                  'pay_address_1'=>$req['address_1'],
                  'pay_address_2'=>$req['address_2'],
                  'pay_city'=>$req['city'],
                  'pay_state'=>$state,
                  'pay_zipcode'=>$req['postcode'],
                  'pay_country'=>$req['country']);
      $cond=array('order_id'=>$req['order_id']);
      Site_model::update_data('order',$data,$cond);
      return true;
    }
    protected function OrderShippingAddressUpate($req){
      if(!empty($req['shipping_state_dropdown'])){ $state=$req['shipping_state_dropdown'];}else{$state=$req['state'];}
      $data=array('shipping_firstname'=>$req['firstname'],
                  'shipping_lastname'=>$req['lastname'],
                  'shipping_address_1'=>$req['address_1'],
                  'shipping_address_2'=>$req['address_2'],
                  'shipping_city'=>$req['city'],
                  'shipping_state'=>$state,
                  'shipping_postcode'=>$req['postcode'],
                  'shipping_country'=>$req['country']);
      $cond=array('order_id'=>$req['order_id']);
      Site_model::update_data('order',$data,$cond);
      return true;
    }
  
}

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
//use App\BraintreeApp;
use App\Helpers\StripeApp;
use Exception;
use Redirect;
use Mail;

class Order extends Authenticatable
{
   protected $fillable = [
                'order_id', 'user_id','firstname', 'lastname', 'email', 'phone_no', 'pay_firstname', 'pay_lastname', 'pay_address_1', 'pay_address_2', 'pay_city', 'pay_zipcode', 'pay_country', 'payment_method', 'payment_code','shipping_firstname', 'shipping_lastname','shipping_address_1','shipping_address_2','shipping_city','shipping_postcode','shipping_country','shipping_method','shipping_code','shipping_est','comment','total','affiliate_id','commission','created_at','modified_at'
    ];
  public function __construct()
  {
    //$this->braintreeApi = new BraintreeApp();
    $this->stripe=new StripeApp();
  }
    protected function placeOrder($req){
         $api_customer_id=Auth::user()->api_customer_id;
         $total=0;
         try {
               $this->stripe->customerFind($api_customer_id);
         }catch(Exception $e){
               $result=array('result'=>0,'message'=>$e->getMessage());
                return $result;
         }
        $coupan_code=Cart::verifyCoupanCode();
        if(!$coupan_code){
          $data=Cart::getCartProducts();
        }else{
          $res=Promotions::verifyCoupanCode($coupan_code);
          $data=Cart::getCartProductswithCoupan($coupan_code, $res[0]->coupon_id);
        }
        foreach($data['basic'] as $cart){
         if(array_key_exists($cart->created_by,$req['shipping_type'])){
            $costumer_costumes[$cart->created_by][]=$cart;
            $total=$cart->total;
            if($cart->coupon_amount!="0.00"){
              $cpn_amout=$cart->coupon_amount;
            }
          }
         }
         if(isset($req['card_id'])){
            $card_id=$req['card_id'];
         }else{
            $card_id=$data['basic'][0]->cc_id;
         }
         if(count($data['basic'])){
           $cc_token=$this->getCreditCardToken($card_id);
             if(count($cc_token)){
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
            $parent_order=1;
            foreach($costumer_costumes as $key=>$costumer){
              $cart_id=$costumer[0]->cart_id;
              $store_credits=$costumer[0]->store_credits;
             
            
              $shipping=explode("_",$req['shipping_type'][$key]);

               $cart_info=Cart::cartMetaInfo($cart_id);
               if(!empty($cart_info[0]->shipping_address_2)){
                   $shipping_address=$cart_info;
                   $shipping_address_1=$shipping_address[0]->shipping_address_1;
                   $shipping_address_2=$shipping_address[0]->shipping_address_2;
                   $shipping_city=$shipping_address[0]->shipping_city;
                   $shipping_state=$shipping_address[0]->shipping_state;
                   $shipping_zipcode=$shipping_address[0]->shipping_postcode;
                 //  $shipping_country=$shipping_address[0]->shipping_country;
               }else{
                  $shipping_address=Address::getAddressinfo('shipping',"latest"); 
                  $shipping_address_1=$shipping_address[0]->address1;
                  $shipping_address_2=$shipping_address[0]->address2;
                  $shipping_city=$shipping_address[0]->city;
                  $shipping_state=$shipping_address[0]->state;
                  $shipping_zipcode=$shipping_address[0]->zip_code;
                 // $shipping_country=$shipping_address[0]->country;
               } 

               if(!empty($cart_info[0]->pay_address_2)){
                   $billing_address=$cart_info;
                   $pay_address_1=$billing_address[0]->pay_address_1;
                   $pay_address_2=$billing_address[0]->pay_address_2;
                   $pay_city=$billing_address[0]->pay_city;
                   $pay_state=$billing_address[0]->pay_state;
                   $pay_zipcode=$billing_address[0]->pay_zipcode;
                   //$pay_country=$billing_address[0]->pay_country;
               }else{
                   $billing_address=Address::getAddressinfo('billing',"latest"); 
                   $pay_address_1=$billing_address[0]->address1;
                   $pay_address_2=$billing_address[0]->address2;
                   $pay_city=$billing_address[0]->city;
                   $pay_state=$billing_address[0]->state;
                   $pay_zipcode=$billing_address[0]->zip_code;
                  // $pay_country=$billing_address[0]->country;
               }
               if(!empty($cart_info[0]->pay_firstname)){$pfname=$cart_info[0]->pay_firstname;}else{$pfname=Auth::user()->first_name;}
               if(!empty($cart_info[0]->pay_lastname)){$plname=$cart_info[0]->pay_lastname;}else{$plname=Auth::user()->last_name;}

               if(!empty($cart_info[0]->shipping_firstname)){$sfname=$cart_info[0]->shipping_firstname;}else{$sfname=Auth::user()->first_name;}
               if(!empty($cart_info[0]->shipping_lastname)){$slname=$cart_info[0]->shipping_lastname;}else{$slname=Auth::user()->last_name;}
                $order_info=array('buyer_id'=>Auth::user()->id,
                                 'seller_id'=>$key, 
                                 'firstname'=>Auth::user()->first_name, 
                                 'lastname'=>Auth::user()->last_name, 
                                 'email'=>Auth::user()->email, 
                                 'phone_no'=>Auth::user()->phone_number,
                                 'pay_firstname'=>$pfname,
                                 'pay_lastname'=>$plname,
                                 'pay_address_1'=>$pay_address_1,
                                 'pay_address_2'=>$pay_address_2,
                                 'pay_city'=>$pay_city,
                                 'pay_state'=>$pay_state,
                                 'pay_zipcode'=>$pay_zipcode,
                                 'shipping_firstname'=>$sfname,
                                 'shipping_lastname'=>$slname,
                                 'shipping_address_1'=>$shipping_address_1,
                                 'shipping_address_2'=>$shipping_address_2,
                                 'shipping_city'=>$shipping_city,
                                 'shipping_state'=>$shipping_state,
                                 'shipping_postcode'=>$shipping_zipcode,
                                 'shipping_method'=>  $shipping[1],
                                 'shipping_est'=>  $shipping[2],
                                 'total'=>'0.00',
                                 'cc_id'=>$card_id,
                                 'created_at'=>date('Y-m-d h:i:s'),
                                );
                 $order_id=Site_model::insert_get_id('order',$order_info);
                 $this->converstionTheard($order_id,$key);
                 $this->orderStatusInserted($order_id,Config::get('constants.Processing'));
                 $price=0;
                 $total_shiping=0;
                 $subtotal=0;
                 $coupon_amount="0.00";
               //  echo "********************************************<br>";
                $j = 0;
                 foreach($costumer as $cart){
                   $user_type=$cart->created_user_group;
                   if($user_type=="admin"){
                     // echo $cart->price."/100"."*".$cart->discount;
                       $discount=($cart->price/100*$cart->qty)*$cart->discount;
                       $coupon_amount+=$discount;
                      // echo $discount;
                    }
                    
                   // echo "<br>item amount".$cart->price."<br>";
                   //echo "item discount".$coupon_amount."<br>";

                      $costume_info=array('costume_id'=>$cart->costume_id, 
                                 'sku'=>$cart->sku, 
                                 'costume_name'=>$cart->costume_name, 
                                 'qty'=>$cart->qty, 
                                 'price'=>$cart->price, 
                                 'weight'=>($cart->weight_pounds)+($cart->weight_ounces/16),
                                 'order_id'=> $order_id, 
                                 'image'=> $cart->image, 
                        );
                      $mail_costumes=array('costume_name'=>$cart->costume_name, 
                                 'size'=>$cart->size, 
                                 'condition'=>$cart->condition, 
                                 'is_film'=>$cart->is_film, 
                                 'price'=>$cart->price, 
                                 'order_id'=> $order_id, 
                                 'qty'=> $cart->qty, 
                                 'weight'=> $cart->weight, 
                                 'image'=>$cart->image
                        );
                      $shiping_est = explode(',', $shipping[2]);
                      if(count($shiping_est)>0){
                        for ($i=0; $i < count($shiping_est); $i++) { 
                          $mail_costumes['shipping'] = $shiping_est[$j];
                        }  
                      }else{
                        $mail_costumes['shipping']=$shipping[2];
                      }
                       Site_model::insert_get_id('order_items',$costume_info);
                       DB::Update('update `cc_costumes` SET quantity=quantity-'.$cart->qty.' WHERE costume_id='.$cart->costume_id.'');
                      $subtotal+=$cart->price*$cart->qty;

                     $mail_order[$order_id]['items'][]= $mail_costumes;

                     $j++;
                 }
                 // echo "********************************************";    
                      $total_shiping=$shipping[0];
                      $store_credit_amount=0;
                      if($coupon_amount!="0.00" && $store_credits=="0.00"){
                        $subtotal_c=$subtotal+$total_shiping-$coupon_amount;
                        $amount= $subtotal_c;
                      }
                      elseif($store_credits!="0.00" && $coupon_amount=="0.00"){
                       
                          $store_credit_amount=$this->storeCredits($total,$store_credits)*$subtotal;
                          $amount=$subtotal+$total_shiping-$store_credit_amount;
                      }
                      elseif($store_credits!="0.00" && $coupon_amount!="0.00"){
                          $store_credit_amount=$this->storeCredits($total,$store_credits)*$subtotal;
                          $subtotal_c=$subtotal-$coupon_amount;
                          $amount=$subtotal_c+$total_shiping-$store_credit_amount;
                      }else{
                          $amount=$subtotal+$total_shiping;
                      }

                      $currency=Config::get('constants.Currency');
                      
                     
                $order_subtotal=array('order_id'=>$order_id,
                              'code'=>"add",
                              'title'=>"Subtotal",
                              'value'=>$subtotal,
                              'sort_order'=>"0",
                      );
                $order_data=['amount' => number_format($amount,1),
                      'paymentMethodNonce' => "fake-valid-nonce",
                      'customerId' =>  $api_customer_id,
                      'options' => [
                        'submitForSettlement' => False
                      ]];
              //  $order_info=$this->braintreeApi->transactionCreate($order_data);
                 $api_amount=number_format($amount,2);
                 $api_currency="usd";
                 $api_card_id=$token;
                 $api_desc="This transaction is uncaptured";
                 $capture=false;
                $order_info=$this->stripe->charge_capture($api_amount,$api_currency,$api_customer_id,$api_card_id,$api_desc,$capture);
                //echo "<pre>"; print_r($order_info); exit;
                $this->insertTransaction($order_info,$order_id,$cart->cc_id);
                Site_model::insert_get_id('order_total',$order_subtotal);
                $this->sellerPayout($api_amount,$order_id,$key);

                if($store_credits!="0.00"){
                $order_storecredits=array('order_id'=>$order_id,
                              'code'=>"sub",
                              'title'=>"Store Credits",
                              'value'=>$store_credit_amount,
                              'sort_order'=>"2",
                      );
                Site_model::insert_get_id('order_total',$order_storecredits);
                }

                if($coupon_amount!="0.00"){
                $order_coupon=array('order_id'=>$order_id,
                              'code'=>"sub",
                              'title'=>"Discount Amount",
                              'value'=>$coupon_amount,
                              'sort_order'=>"3",
                      );
                
                Site_model::insert_get_id('order_total',$order_coupon);
                }
                $order_shipping=array('order_id'=>$order_id,
                              'code'=>"add",
                              'title'=>"Shipping",
                              'value'=>$total_shiping,
                              'sort_order'=>"1",
                      );
                Site_model::insert_get_id('order_total',$order_shipping);
                if($parent_order=="1"){
                   $porder_id=$order_id;
                }

                DB::Update('update `cc_order` SET total='.$amount.',order_status_id='.Config::get('constants.Processing').',parent_order_id='.$porder_id.' WHERE    order_id='.$order_id.'');
                $parent_order++;
                $seller_info=$this->getUserInfo($key);
                $cc_details=DB::Select('SELECT *  FROM `cc_creditcard` WHERE `id` ='.$card_id)[0];
                $address=array('shipping_firstname'=>$cart_info[0]->shipping_firstname,
                                 'shipping_lastname'=>$cart_info[0]->shipping_lastname,
                                 'shipping_address_1'=>$shipping_address_1,
                                 'shipping_address_2'=>$shipping_address_2,
                                 'shipping_city'=>$shipping_city,
                                 'shipping_state'=>$shipping_state,
                                 'shipping_postcode'=>$shipping_zipcode,
                              );
                $mail_order[$order_id]['subtotal']=$subtotal;
                $mail_order[$order_id]['shipping']=$total_shiping;
                if(!empty($store_credits) && $store_credits!="0.00"){
                  $mail_order[$order_id]['store_credits']=$store_credits;
                }
                if(!empty($cpn_amout)  && $cpn_amout!="0.00"){
                  $mail_order[$order_id]['coupon_amount']=$cpn_amout;
                }
                $mail_order[$order_id]['total']=$amount;
                $mail_order[$order_id]['seller_name']=$seller_info[0]->first_name." ".$seller_info[0]->last_name;
                $mail_order[$order_id]['location_from']="Expected Shipping from ".$seller_info[0]->city.", ".$seller_info[0]->state;
                $mail_order[$order_id]['zip_code']=$seller_info[0]->zip_code;
                $mail_order[$order_id]['order_id']=$order_id;
                $mail_order[$order_id]['address']=$address;
                $mail_order[$order_id]['card_details']=$cc_details;
                $mail_order[$order_id]['shipping_to']=$shipping_zipcode;
              
                if(count($seller_info)){
                     $order_data['seller_name']=$seller_info[0]->first_name." ".$seller_info[0]->last_name;
                     $order_data['items']=$mail_order[$order_id]['items'];
                     $order_data['order_id'] = $order_id;
                     
                     $sent=Mail::send('emails.order_seller',array("order_info"=>$order_data), function ($m) use($seller_info) {
                     $m->to($seller_info[0]->email,$seller_info[0]->first_name." ".$seller_info[0]->last_name);
                    $m->subject("Congratulations! Your Costume Sold!");
                   });
                 
                }
                $orders[]=$order_id;


           }
          // dd();
          // dd($mail_order);
             Site_model::delete_single('cart',array('cart_id'=>$costumer[0]->cart_id));
             DB::Update('update `cc_users` SET credits=credits-'.$store_credits.' WHERE id='.Auth::user()->id.'');

             $sent=Mail::send('emails.order_buyer',array("mail_order"=>$mail_order), function ($m) {
                
                $admin_settings=Site_model::Fetch_data('users','*',array("role_id"=>"1"));
                
                $m->to(Auth::user()->email, Auth::user()->first_name." ".Auth::user()->last_name);
                    $m->subject('Order Details');
                });

              $admin_settings=Site_model::Fetch_data('users','*',array("role_id"=>"1"));
                    $sent=Mail::send('emails.order_admin',array("mail_order"=>$mail_order), function ($m) {
                    $admin_settings=Site_model::Fetch_data('users','*',array("role_id"=>"1"));
                    $m->to($admin_settings[0]->email, $admin_settings[0]->first_name." ".$admin_settings[0]->last_name);
                        $m->subject("Congratulations! Your Costume Sold!");
                    });
             $this->orderHistory($order_id,Config::get('constants.Processing'),"1","Order Created");
             $result=array('result'=>1,'message'=>$orders);

            
             return $result;
         }else{
            $result=array('result'=>0,'message'=>"Cart Items are empty");
            return $result;
        }
    }
    private function orderStatusInserted($order_id,$status_id){
       $order_status=array('order_id'=>$order_id,'status_id'=>$status_id,'comment'=>"Order Created",'created_at'=>date('Y-m-d h:i:s'));
       Site_model::insert_get_id('order_status',$order_status);
       return true;
    }
    private function converstionTheard($order_id,$seller_id){
      /*Message To Seller From Admin Start Here*/
      $converstion_array = array('type'=>'order','user_one'=>'1',
        'user_two'=>$seller_id,
        'subject' =>'Your Costume has been ordered.',
        'type_id' => $order_id,
        'status'=>'1',
        'created_at'=>date('Y-m-d h:i:s'));
      $converstion_id = Site_model::insert_get_id('conversations',$converstion_array);
      $message_array  = array('message'=>'We have received an order for your costume.',
        'is_seen'=>'0',
        'deleted_from_sender'=>'0',
        'deleted_from_receiver'=>'0',
        'user_id'=> "1",
        'user_name'=> \App\User::find(1)->pluck("display_name")->first(),
        'conversation_id'=>$converstion_id,'created_at'=>date('Y-m-d h:i:s'));
      $converstion_id = Site_model::insert_get_id('messages',$message_array);
      /*Message To Seller From Admin Start Here*/

      /*Message To Buyer From Admin Start Here*/
      /*$converstion_array = array('type'=>'order','user_one'=>'1',
        'user_two'=>Auth::user()->id,
        'subject' =>'Your Order has been placed.',
        'type_id' => $order_id,
        'status'=>'1',
        'created_at'=>date('Y-m-d h:i:s'));
      $converstion_id = Site_model::insert_get_id('conversations',$converstion_array);
      $message_array  = array('message'=>'Your Order is under process.',
        'is_seen'=>'0',
        'deleted_from_sender'=>'0',
        'deleted_from_receiver'=>'0',
        'user_id'=>'1',
        'user_name'=>\App\User::find(1)->pluck("display_name")->first(),
        'conversation_id'=>$converstion_id,'created_at'=>date('Y-m-d h:i:s'));
      $converstion_id = Site_model::insert_get_id('messages',$message_array);*/
      /*Message To Buyer From Admin End Here*/

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
       $charities_list=DB::Select('SELECT * FROM cc_charities where status = "1" order by id desc LIMIT 0,5');
       return $charities_list;
    }
    protected function orderCharityFund($req){
     if(isset($req['suggested_charity']) && !empty($req['suggested_charity'])){
         $result = array('name'=>$req['suggested_charity'],
                        'suggested_by'=>Auth::user()->id,
                        'status'=>'0',
                        'created_at'=>date('Y-m-d h:i:s')
                        );
         $charity_id = Site_model::insert_get_id('charities',$result);
      }else{
        $charity_id = $req['charity'];
      }
      $result = array('order_id' => $req['order_id'],
                    'user_id' => Auth::user()->id,
                    'charity_id' => $req['charity'],
                    'amount' => $req['amount'],
                    'created_at' => date('Y-m-d h:i:s')
                      );
       Site_model::insert_get_id('order_charity',$result);
       $carity_info = Charities::getCharityInfo($req['charity']);
       return  $carity_info;
    }
    private function  insertTransaction($data,$order_id,$cc_id){
      $transaction=array('order_id'=>$order_id,
                    'user_id'=>Auth::user()->id,
                    'amount'=>$data['amount']/100,
                    'api_transaction_no'=>$data['id'],
                    'cc_id'=>$cc_id,
                    'status'=>$data['outcome']['type'],
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s')
                      );
       $transaction_id=Site_model::insert_get_id('transactions',$transaction);
       DB::Update('update `cc_order` SET  transaction_id='.$transaction_id.' WHERE order_id='.$order_id.'');
       return true;
    }

    protected function orderSummary($order_id){
        $order['basic']=DB::Select('SELECT ord.order_id,ord.transaction_id,DATE_FORMAT(ord.created_at,"%m/%d/%Y %h:%i %p") as date,ord.total,ord.phone_no,ord.cc_id,ord.shipping_method,sts.name as status,trans.api_transaction_no,trans.status as payment_status,buyer.id as buyer_id,concat(buyer.first_name," ",buyer.last_name) as buyer_name,buyer.email as buyer_email,buyer.phone_number as buyer_phone,seller.id as seller_id,concat(seller.first_name," ",seller.last_name) as seller_name,seller.email as seller_email,seller.phone_number as seller_phone,seller.is_free,concat(ord.pay_firstname," ",ord.pay_lastname) as pay_username,ord.pay_firstname,ord.pay_lastname,ord.pay_address_1,ord.pay_address_2,ord.pay_city,ord.pay_state,ord.pay_zipcode,ord.pay_country,concat(ord.shipping_firstname," ",ord.shipping_lastname) as ship_username,ord.shipping_firstname,ord.shipping_lastname,ord.shipping_address_1,ord.shipping_address_2,ord.shipping_city,ord.shipping_state,ord.shipping_postcode,ord.shipping_country FROM `cc_order` as ord LEFT JOIN  cc_status as sts on sts.status_id=ord.order_status_id LEFT JOIN cc_transactions as trans on trans.id=ord.transaction_id LEFT JOIN cc_users as buyer on buyer.id=ord.buyer_id  LEFT JOIN cc_users as seller on seller.id=ord.seller_id where ord.order_id='.$order_id.'  group by trans.id order by trans.id desc LIMIT 1');
         $order['items']=DB::Select('SELECT * FROM `cc_order_items` where order_id="'.$order_id.'" order by sku ');
         $order['order_amount']=DB::Select('SELECT * FROM `cc_order_total` where order_id="'.$order_id.'" order by sort_order ');
         $order['status']=DB::Select('SELECT * FROM  cc_status');
         $order['states']=DB::Select('SELECT * FROM  cc_states');
         $order['countries']=DB::Select('SELECT * FROM `cc_countries`');
         // $order['order_comment']=DB::Select('SELECT ord_sts.comment,sts.name as status,DATE_FORMAT(ord_sts.created_at,"%m/%d/%Y %h:%i %p") as date FROM `cc_order_status` as ord_sts LEFT JOIN cc_status as sts on sts.status_id=ord_sts.status_id where ord_sts.order_id='.$order_id.' order by order_status_id desc');
         $order['order_comment']=DB::Select('SELECT hist.comment,sts.name as status,DATE_FORMAT(hist.date_added,"%m/%d/%Y %h:%i %p") as date FROM `cc_order_history` as hist LEFT JOIN `cc_status` as  sts on sts.status_id=hist.order_status_id where hist.order_id='.$order_id.' order by hist.date_added desc');
         $order['order_shipping']=DB::Select('SELECT *  FROM `cc_order_ship_track` WHERE `order_id`='.$order_id.'  order by id desc');
        return $order; 

    }
    protected function userOrderSummary($order_id){
        $order['basic']=DB::Select('SELECT ord.order_id,ord.transaction_id,DATE_FORMAT(ord.created_at,"%m/%d/%Y %h:%i %p") as date,ord.total,ord.phone_no,sts.name as status,ord.shipping_method,trans.api_transaction_no,trans.status as payment_status,buyer.id as buyer_id,concat(buyer.first_name," ",buyer.last_name) as buyer_name,buyer.email as buyer_email,buyer.phone_number as buyer_phone,seller.id as seller_id,concat(seller.first_name," ",seller.last_name) as seller_name,seller.email as seller_email,seller.phone_number as seller_phone,concat(ord.pay_firstname," ",ord.pay_lastname) as pay_username,ord.pay_firstname,ord.pay_lastname,ord.pay_address_1,ord.pay_address_2,ord.pay_city,ord.pay_state,ord.pay_zipcode,ord.pay_country,concat(ord.shipping_firstname," ",ord.shipping_lastname) as ship_username,ord.shipping_firstname,ord.shipping_lastname,ord.shipping_address_1,ord.shipping_address_2,ord.shipping_city,ord.shipping_state,ord.shipping_postcode,ord.shipping_country FROM `cc_order` as ord LEFT JOIN  cc_status as sts on sts.status_id=ord.order_status_id LEFT JOIN cc_transactions as trans on trans.order_id=ord.order_id LEFT JOIN cc_users as buyer on buyer.id=ord.buyer_id  LEFT JOIN cc_users as seller on seller.id=ord.seller_id where ord.order_id='.$order_id.' group by trans.id order by trans.id desc LIMIT 1');
         $order['items']=DB::Select('SELECT * FROM `cc_order_items` where order_id="'.$order_id.'" order by sku ');
         $order['order_amount']=DB::Select('SELECT * FROM `cc_order_total` where order_id="'.$order_id.'" order by sort_order ');
         $order['order_comment']=DB::Select('SELECT ord_sts.comment,sts.name as status,DATE_FORMAT(ord_sts.created_at,"%m/%d/%Y %h:%i %p") as date FROM `cc_order_status` as ord_sts LEFT JOIN cc_status as sts on sts.status_id=ord_sts.status_id where ord_sts.order_id='.$order_id.' order by order_status_id desc');
         $order['order_shipping']=DB::Select('SELECT *  FROM `cc_order_ship_track` WHERE `order_id`='.$order_id.' order by id desc');  
        return $order; 
    }
    protected function orderBuyerCheck($order_id){
     $res=DB::Select('SELECT if(count(order_id)>=1,"true","false") as is_exists  FROM `cc_order` WHERE `order_id` ='.$order_id.' AND `buyer_id` ='.Auth::user()->id);
     return $res[0]->is_exists;
    }
    protected function orderSellerCheck($order_id){
     $res=DB::Select('SELECT if(count(order_id)>=1,"true","false") as is_exists  FROM `cc_order` WHERE `order_id` ='.$order_id.' AND `seller_id` ='.Auth::user()->id);
     return $res[0]->is_exists;
    }
    protected function orderStatusUpdate($req){
      $data=array('order_id'=>$req['order_id'],'status_id'=>$req['status_id'],'comment'=>$req['comment'],'created_at'=>date('Y-m-d h:i:s'));
      Site_model::insert_get_id('order_status',$data);
       $this->orderHistory($req['order_id'],$req['status_id'],"1","Order Status changed");
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
                  'pay_zipcode'=>$req['postcode']);
      $cond=array('order_id'=>$req['order_id']);
      Site_model::update_data('order',$data,$cond);
       $this->orderHistory($req['order_id'],"0","0","Order billing address updated successfully");
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
                  'shipping_postcode'=>$req['postcode']);
      $cond=array('order_id'=>$req['order_id']);
      Site_model::update_data('order',$data,$cond);
      $this->orderHistory($req['order_id'],"0","0","Order shipping address updated successfully");
      return true;
    }
     protected function  orderAdditionalTransaction($req){
      $user=User::find($req['user_id'])->toArray();
      $api_customer_id=$user['api_customer_id'];

      $token=$this->getCreditCardToken($req['cc_id']);
      if(count($token)){
          $token=$token;
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
      $amount=$req['transaction_amount'];
      $currency=Config::get('constants.Currency');
       try {
       if($req['type']=="charge"){
        // $order_data=['amount' => $amount,
        //               'paymentMethodNonce' => "fake-valid-nonce",
        //               'customerId' =>  $api_customer_id,
        //               'options' => [
        //                 'submitForSettlement' => True
        //               ]];

        //     $order_info=$this->braintreeApi->transactionCreate($order_data);
        $data=$this->stripe->charge($amount,"usd",$api_customer_id,$token,"Order additional transaction");
        $transaction=array('order_id'=>$req['order_id'],
                    'user_id'=>$user['id'],
                    'type'=>$req['type'],
                    'amount'=>$data['amount']/100,
                    'api_transaction_no'=>$data['id'],
                    'cc_id'=>$req['cc_id'],
                    'status'=>"Charged",
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s')
                      );
            $transaction_id=Site_model::insert_get_id('transactions',$transaction);
            $transaction_info=array('user_name'=>$user['first_name']." ".$user['last_name'],'transaction_id'=>$transaction_id,'order_id'=>$req['order_id'],'status'=>$data['outcome']['type'],'amount'=>$data['amount']/100,'buyer_email'=>$req['buyer_email'],'buyer_name'=>$req['buyer_name'],'comment'=>$req['comment']);
            $result=array('result'=>1,'message'=>$transaction_info);
            $this->orderHistory($req['order_id'],"0","1","$".number_format(($data['amount']/100), 2, '.', ',')." additional transaction done for this order");
            return $result;
             }else if($req['type']=="refund" || $req['type']=="return"){

             $transactions=$this->getAuthrisedOrderTransationInfo($req['order_id']);
             //$data=$this->stripe->RefundTransaction($transactions[0]->api_transaction_no,$req['transaction_amount']);

             if($req['payment_status']!="authorized"){
               $data=$this->stripe->RefundTransaction($transactions[0]->api_transaction_no,$req['transaction_amount']);
               $status="Refund";
             }else{

               $data=$this->stripe->voidTransaction($transactions[0]->api_transaction_no);
               $status="Void";
               
               $update_data=array('status'=>"Return",
                   'updated_at'=>date('Y-m-d h:i:s')
                      );
               $cond=array('id'=>$req['transation_id']);
               Site_model::update_data('transactions',$update_data,$cond);
              $this->orderHistory($req['order_id'],"0","1","order amount is successfully returned");
           
             }
               $transaction=array('order_id'=>$req['order_id'],
                    'user_id'=>$user['id'],
                    'type'=>"Refund",
                    'amount'=>$data['amount']/100,
                    'api_transaction_no'=>$data['id'],
                    'cc_id'=>$req['cc_id'],
                    'status'=>$status,
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s')
                      );
            $transaction_id=Site_model::insert_get_id('transactions',$transaction);
            $transaction_info=array('user_name'=>$user['first_name']." ".$user['last_name'],'transaction_id'=>$transaction_id,'order_id'=>$req['order_id'],'status'=>$req['type'],'amount'=>$data['amount']/100,'buyer_email'=>$req['buyer_email'],'buyer_name'=>$req['buyer_name'],'comment'=>$req['comment']);
            $result=array('result'=>1,'message'=>$transaction_info);
           }else{
          Session::flash('error', $data->message); 
          $result=array('result'=>0,'message'=>$data->message);
           }
        $this->orderHistory($req['order_id'],"0","1","$".number_format(($data['amount']/100), 2, '.', ',')." amount is refunded for this order");
         Session::flash('success', "Amount is refunded successfully"); 
        //$result=array('result'=>1, 'message'=>"Amount is refunded successfully");
            return $result;
        }catch(Exception $e){
                 $result=array('result'=>0,'message'=>$e->getMessage());
                  return $result;
           }
     }
     protected function getOrderStatus($status_id){
      $status=DB::Select('SELECT name  FROM `cc_status` WHERE `status_id`='.$status_id);
      return $status[0]->name;

     }
     protected function orderShippingmentProcess($req,$track_no,$amount){
      if(isset($req['weight'])){ $weight=$req['weight'];}else{$weight="";}
      if(isset($req['carrier_type'])){ $carrier_type=$req['carrier_type'];}else{$carrier_type="usps";}
      if(isset($req['method'])){ $method=$req['method'];}else{$method="Retail Ground";}
        $shipping=array('order_id'=>$req['order_id'],
                      'weight'=>$weight,
                      'user_id'=>$req['user_id'],
                      'carrier_type'=>$carrier_type,
                      'carrier_code'=>$method,
                      'track_no'=>$track_no,
                      'amount'=>$amount,
                      'created_at'=>date('Y-m-d h:i:s')
                      );
      Site_model::insert_get_id('order_ship_track',$shipping);
      $data=array('order_id'=>$req['order_id'],'status_id'=>Config::get('constants.Shipping'),'comment'=>"Label generated for this order",'created_at'=>date('Y-m-d h:i:s'));
      Site_model::insert_get_id('order_status',$data);
      $this->orderHistory($req['order_id'],Config::get('constants.Shipping'),"1","Label generated for this order");
      DB::Update('update `cc_order` SET order_status_id='.Config::get('constants.Shipping').' WHERE order_id='.$req['order_id'].'');
      return true;
     }
     protected function getStateAbbrev($state){
        $state_abbrev=DB::Select('SELECT abbrev FROM `cc_states` WHERE `name` LIKE "'.$state.'"');
        if(count($state_abbrev)){
            return $state_abbrev[0]->abbrev;
        }else{
          return "";
        }
     }
 protected function getUserInfo($seller_id){
  $data=DB::Select('select * from cc_users  as usr LEFT JOIN cc_address_master as addr on addr.user_id=usr.id and address_type="selling" where id='.$seller_id);
  return $data;
 } 
 private function getAuthrisedOrderTransationInfo($order_id){
  $res=DB::Select('select trans.* from cc_order as ord LEFT JOIN cc_transactions as trans on trans.id=ord.transaction_id where ord.order_id='.$order_id);
  return $res;
 }
 protected function orderMetaInfo($order_id){
        $order_meta=DB::Select('SELECT *  FROM `cc_order` WHERE `order_id` ='.$order_id);
        return $order_meta;
}
private function storeCredits($total_amount,$credit_amount){

  $amount=$credit_amount/$total_amount;
   return number_format($amount,4);

}

protected function orderHistory($order_id,$order_status_id,$notify,$comment){
    $history=array('order_id'=>$order_id,
                   'order_status_id'=>$order_status_id,
                   'notify'=>$notify,
                   'comment'=>$comment,
                   'date_added'=>date('Y-m-d h:i:s')
                      );
      Site_model::insert_get_id('order_history',$history);
}
private function sellerPayout($amount,$order_id,$key){
    $amt=($amount * (99.25/100)) - 0.20;
    $seller_payout=array('type'=>"order",
                   'type_id'=>$order_id,
                   'user_id'=>$key,
                   'amount'=>$amt,
                   'status'=>"not_paid",
                   'created_at'=>date('Y-m-d h:i:s')
                      );
    Site_model::insert_get_id('paypal_payouts',$seller_payout);
}
}

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

class Order extends Authenticatable
{
   protected $fillable = [
                'order_id', 'user_id','firstname', 'lastname', 'email', 'phone_no', 'pay_firstname', 'pay_lastname', 'pay_address_1', 'pay_address_2', 'pay_city', 'pay_zipcode', 'pay_country', 'payment_method', 'payment_code','shipping_firstname', 'shipping_lastname','shipping_address_1','shipping_address_2','shipping_city','shipping_postcode','shipping_country','shipping_method','shipping_code','comment','total','affiliate_id','commission','created_at','modified_at'
    ];
    protected function placeOrder($req){
        $data=Cart::getCartProducts();
        if(count($data)){
            $order_info=array('user_id'=>Auth::user()->id, 
                               'firstname'=>Auth::user()->first_name, 
                               'lastname'=>Auth::user()->last_name, 
                               'email'=>Auth::user()->email, 
                               'phone_number'=>Auth::user()->phone_number,
                               'pay_firstname'=>$req['pay_firstname'],
                               'pay_lastname'=>$req['pay_lastname'],
                               'pay_address_1'=>$req['pay_address_1'],
                               'pay_address_2'=>$req['pay_address_2'],
                               'pay_city'=>$req['pay_city'],
                               'pay_zipcode'=>$req['pay_zipcode'],
                               'pay_country'=>$req['pay_country'],
                               'shipping_firstname'=>$req['shipping_firstname'],
                               'shipping_lastname'=>$req['shipping_lastname'],
                               'shipping_address_1'=>$req['shipping_address_1'],
                               'shipping_address_2'=>$req['shipping_address_2'],
                               'shipping_city'=>$req['shipping_city'],
                               'shipping_postcode'=>$req['shipping_postcode'],
                               'shipping_country'=>$req['shipping_country'],
                               'total'=>$data[0]->total,
                               'created_at'=>date('Y-m-d h:i:s'),
                            );
             $order_id=Site_model::insert_get_id('order',$order_info);
             foreach($data as $cart){
                  $costume_info=array('costume_id'=>$cart->costume_id, 
                             'sku'=>$cart->sku, 
                             'costume_name'=>$cart->costume_name, 
                             'qty'=>$cart->qty, 
                             'price'=>$cart->price, 
                             'order_id'=> $order_id, 
                    );
                   Site_model::insert_get_id('order_items',$costume_info);
                   DB::Update('update `cc_costumes` SET quantity=quantity-'.$cart->qty.' WHERE costume_id='.$cart->costume_id.'');
             }
             $order_total=array('order_id'=>$order_id,
                                'code'=>"",
                                'title'=>"",
                                'value'=>$data[0]->total,
                        );
             Site_model::insert_get_id('order_total',$order_total);
              $result=array('result'=>1,'message'=>"Cart Items are empty");
            return $result;
         }else{
            $result=array('result'=>0,'message'=>"Cart Items are empty");
            return $result;
        }
    }
    
}

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
        if(count($data['basic'])){
            $cart_info=Cart::cartMetaInfo($data['basic'][0]->cart_id);
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
             foreach($data['basic'] as $cart){
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
                                'title'=>"Total",
                                'value'=>$data['basic'][0]->total,
                        );
             Site_model::insert_get_id('order_total',$order_total);
             Site_model::delete_single('cart',array('cart_id'=>$data['basic'][0]->cart_id));
             $result=array('result'=>1,'message'=>$order_id);
             return $result;
         }else{
            $result=array('result'=>0,'message'=>"Cart Items are empty");
            return $result;
        }
    }
    protected function getCharitiesList(){
       $charities_list=DB::Select('SELECT * FROM cc_charities');
       return $charities_list;
    }
    
}

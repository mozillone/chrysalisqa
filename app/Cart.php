<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use Auth;
use Cookie;
use Session;

class Cart extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'cart_id', 'user_id','cookie_id', 'firstname', 'lastname', 'email', 'phone_no', 'pay_firstname', 'pay_lastname', 'pay_address_1', 'pay_address_2', 'pay_city', 'pay_zipcode', 'pay_country', 'payment_method', 'payment_code','shipping_firstname', 'shipping_lastname','shipping_address_1','shipping_address_2','shipping_city','shipping_postcode','shipping_country','shipping_method','shipping_code','comment','total','affiliate_id','commission','created_at','modified_at'
    ];
    protected function addToCart($req){
             if(Auth::check()){$user_id=Auth::user()->id;}{$user_id="0";}
             
             // $cart_list=$this->getCookieAllProducts();
             // if($cart_list==null){
             //    $product=array('costume_id'=>$req['costume_id'],'cookie_id'=>$req['cookie_id']);
             //    $this->productsAddToCookie($product)->send();
             // }else{
             //    $this->productsUpdateToCookie();

             // }
             // $data=array('user_id'=>$user_id,
             //            'cookie_id'=>$req['cookie_id'],
             //            'modified_at'=>date('Y-m-d h:i:s')
             //            );
             // $cart_id=Site_model::insert_get_id('cart',$data);
             // $costume_info=$this->getCostumeInfo($req['costume_id']);
             // $res=$this->addItemToCart($cart_id,$costume_info[0]);
             return true;
    }
   
 private function addItemToCart($cart_id,$costume_info){
            $data=array('cart_id'=>$cart_id,
                        'costume_id'=>$costume_info->costume_id,
                        'sku'=>$costume_info->sku_no,
                        'costume_name'=>$costume_info->name,
                        'qty'=>$costume_info->quantity,
                        'price'=>$costume_info->price);
            Site_model::insert_data('cart_items',$data);
            return true;

    }
    private function getCostumeInfo($costume_id){
       $data=DB::Select('SELECT costume_id,name,sku_no,quantity,price FROM `cc_costumes` WHERE costume_id='.$costume_id);
       return $data;
    }
     // private function verifyCostumeQuantity($costume_id,$qnt){
   // }
   // }
    //     $res=DB::Select('SELECT quantity FROM `cc_costumes` WHERE costume_id='.$costume_id,.' having quantity<='.$qnt.'');
    //     return $res;
    // }
   
}

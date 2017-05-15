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

class Cart extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'cart_id', 'user_id','cookie_id', 'firstname', 'lastname', 'email', 'phone_no', 'pay_firstname', 'pay_lastname', 'pay_address_1', 'pay_address_2', 'pay_city', 'pay_zipcode', 'pay_country', 'payment_method', 'payment_code','shipping_firstname', 'shipping_lastname','shipping_address_1','shipping_address_2','shipping_city','shipping_postcode','shipping_country','shipping_method','shipping_code','comment','total','coupan_code','affiliate_id','commission','created_at','modified_at'
    ];
    protected function addToCart($req,$cookie_id,$qty){

             if(Auth::check()){
                $user_id=Auth::user()->id;
                $data=array('user_id'=>$user_id,
                        'cookie_id'=>$cookie_id,
                        'created_at'=>date('Y-m-d h:i:s'),
                        'modified_at'=>date('Y-m-d h:i:s')
                        );
                $results=$this->userCartVerify(Auth::user()->id);
                if(count($results)){
                     $cart_id=$results[0]->cart_id;
                }else{
                     $cart_id=$cookie_id;
                     $data=array('user_id'=>$user_id,
                        'cookie_id'=>$cookie_id,
                        'created_at'=>date('Y-m-d h:i:s'),
                        'modified_at'=>date('Y-m-d h:i:s')
                        );
                     $cart_id=Site_model::insert_get_id('cart',$data);
                }
               

            }else{
                $results=$this->cookieCartVerify($cookie_id);
                 if(count($results)){
                     $cart_id=$results[0]->cart_id;
                }else{
                    $user_id="0";
                    $data=array('user_id'=>$user_id,
                        'cookie_id'=>$cookie_id,
                        'created_at'=>date('Y-m-d h:i:s'),
                        'modified_at'=>date('Y-m-d h:i:s')
                        );
                    $cart_id=Site_model::insert_get_id('cart',$data);
                }
            }
           
             $costume_info=$this->getCostumeInfo($req['costume_id']);
             $res=$this->addItemToCart($cart_id,$qty,$costume_info[0]);
             $total=$this->getCartSubtotalPrice($cart_id);
             $data=array('total'=>$total,'modified_at'=>date('Y-m-d h:i:s'));
             $cond=array('cart_id'=>$cart_id,);
             Site_model::update_data('cart',$data,$cond);
             return true;
    }
    protected function updateCartDetails($costume_id,$cart_id,$qty){
            $result=$this->verifieItemExists($costume_id,$cart_id);
              if($result=="1"){
                $res=DB::Update('UPDATE `cc_cart_items` SET qty='.$qty.' WHERE cart_id='.$cart_id.' and  costume_id='.$costume_id.'');
            }else{
             $costume_info=$this->getCostumeInfo($costume_id);
             $res=$this->addItemToCart($cart_id,$qty,$costume_info[0]);
            }
            $total=$this->getCartSubtotalPrice($cart_id);
            $data=array('total'=>$total,'modified_at'=>date('Y-m-d h:i:s'));
            $cond=array('cart_id'=>$cart_id,);
            Site_model::update_data('cart',$data,$cond);
            return true;
          
            
    }
    private function userCartVerify($user_id){
        $data=DB::Select('SELECT cart_id FROM `cc_cart` WHERE user_id= '.$user_id.'');
        return $data;
    }
    private function cookieCartVerify($cookie_id){
        $data=DB::Select('SELECT cart_id FROM `cc_cart` WHERE cookie_id= "'.$cookie_id.'"');
        return $data;
    }
  private function addItemToCart($cart_id,$qty,$costume_info){
            $data=array('cart_id'=>$cart_id,
                        'costume_id'=>$costume_info->costume_id,
                        'sku'=>$costume_info->sku_no,
                        'costume_name'=>$costume_info->name,
                        'qty'=>$qty,
                        'price'=>$costume_info->price);
            Site_model::insert_data('cart_items',$data);
            return true;

    }
    private function verifieItemExists($costume_id,$cart_id){
        $data=DB::Select('SELECT if(count(*)>=1,"1","0") as is_exists  FROM `cc_cart_items` WHERE `costume_id` = '.$costume_id.' AND `cart_id` = '.$cart_id.'');
        return $data[0]->is_exists;
    }
    protected function getCostumeInfo($costume_id){
       $data=DB::Select('SELECT cst.costume_id,dsr.name,cst.sku_no,cst.quantity,cst.price FROM cc_costumes as cst LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id WHERE cst.costume_id='.$costume_id);
       return $data;
    }
    protected function verifyCostumeCartQuantity($costume_id,$cookie_id){
        $currentCookieKeyID=$cookie_id;
        if(Auth::check()){
            $where="where crt.user_id=".Auth::user()->id.' or crt.cookie_id="'.$currentCookieKeyID.'" and items.costume_id='.$costume_id.'';
        }else{
            $where="where crt.cookie_id='".$currentCookieKeyID."' and items.costume_id=".$costume_id."";
        }
       $data=DB::Select('SELECT items.qty  FROM `cc_cart_items` as items LEFT JOIN cc_cart as crt on crt.cart_id=items.cart_id '.$where.' ');
        if(!empty($data)){
                return $data[0]->qty;
       }else{
                 return "1";
       }
    }
    //  protected function verifyCostumeCart($costume_id,$cookie_id){
    //    $data=DB::Select('SELECT crt.cart_id  FROM `cc_cart_items` as items LEFT JOIN cc_cart as crt on crt.cart_id=items.cart_id where crt.cookie_id="'.$cookie_id.'" and items.costume_id='.$costume_id.'');
    //     if(!empty($data)){
    //             return $data[0]->cart_id;
    //    }else{
    //              return false;
    //    }
    // }

     protected function verifyCostumeCart($costume_id,$cookie_id){
        $currentCookieKeyID=$cookie_id;
        if(Auth::check()){
            $where="where crt.user_id=".Auth::user()->id.' or crt.cookie_id="'.$currentCookieKeyID.'" and items.costume_id='.$costume_id.'';
        }else{
            $where="where crt.cookie_id='".$currentCookieKeyID."' and items.costume_id=".$costume_id."";
        }
       $data=DB::Select('SELECT crt.cart_id  FROM `cc_cart_items` as items LEFT JOIN cc_cart as crt on crt.cart_id=items.cart_id '.$where.'');
        if(!empty($data)){
                return $data[0]->cart_id;
       }else{
                 return false;
       }
    }

    protected function verifyCostumeQuantity($costume_id,$qnt){
        $res=DB::Select('SELECT quantity FROM `cc_costumes` WHERE costume_id='.$costume_id.' having quantity>='.$qnt.'');
        return $res;
    }
    protected function getCartCount(){
        $currentCookieKeyID=SiteHelper::currentCookieKey();
        if(Auth::check()){
        	$where="where crt.user_id=".Auth::user()->id.' or crt.cookie_id="'.$currentCookieKeyID.'"';
        }else{
        	$where="where crt.cookie_id='".$currentCookieKeyID."'";
        }
        $res=DB::Select('select count(itms.cart_item_id) as mini_count from cc_cart_items as itms LEFT JOIN cc_cart as crt on crt.cart_id=itms.cart_id '.$where.'');
        return $res[0]->mini_count;

    }
    protected function updateCartToUser(){
       $currentCookieKeyID=SiteHelper::currentCookieKey();
       $carts_list=DB::Select('Select itms.* FROM `cc_cart` as crt LEFT JOIN cc_cart_items as itms on itms.cart_id=crt.cart_id WHERE crt.cookie_id="'.$currentCookieKeyID.'"');
      $user_cart=DB::Select('Select cart_id FROM `cc_cart` WHERE user_id="'.Auth::user()->id.'"');
      if(count($user_cart)){
      foreach ($carts_list as $key => $carts) {
            $check_cart=DB::Select('Select if(count(*)>0,true,false)  as is_exits from  cc_cart_items where cart_id='.$user_cart[0]->cart_id.' and costume_id='.$carts->costume_id.'');
            if($check_cart[0]->is_exits){
                DB::Update('update cc_cart_items set qty=qty+'.$carts->qty.' where cart_id='.$user_cart[0]->cart_id.' and costume_id='.$carts->costume_id.'');
            }else{
                $new_check_cart=DB::Select('Select cart_id,costume_id,sku,costume_name,qty,price from  cc_cart_items where cart_id='.$carts_list[0]->cart_id.' and costume_id='.$carts->costume_id.'');
           
                $data=array('cart_id'=>$new_check_cart[0]->cart_id,
                        'costume_id'=>$new_check_cart[0]->costume_id,
                        'sku'=>$new_check_cart[0]->sku,
                        'costume_name'=>$new_check_cart[0]->costume_name,
                        'qty'=>$new_check_cart[0]->qty,
                        'price'=>$new_check_cart[0]->price);
            Site_model::insert_data('cart_items',$data);
            }
            //DB::Update('update cc_cart_items set qty=qty+'.$carts->qty.' where cart_id='.$user_cart[0]->cart_id.' and costume_id='.$carts->costume_id.'');
      }
      $cond=array('cookie_id'=> $currentCookieKeyID);
      Site_model::delete_single('cart',$cond);
    }else{
        DB::Update('UPDATE `cc_cart` SET `user_id`='.Auth::user()->id.' WHERE cookie_id="'.$currentCookieKeyID.'"');
    }
       
    }
    protected function getCartProducts(){
    	$currentCookieKeyID=SiteHelper::currentCookieKey();
        if(Auth::check()){
        	$where="where crt.user_id=".Auth::user()->id.' or crt.cookie_id="'.$currentCookieKeyID.'"';
        }else{
        	$where="where crt.cookie_id='".$currentCookieKeyID."'";
        }
        DB::Update('update cc_cart as crt set coupan_code=""  '.$where.'');
       	$cart_products['basic']=DB::Select('SELECT itms.*,img.image,cst.condition,cst.size,concat(usr.first_name," ",usr.last_name) as user_name,cstopt.attribute_option_value  as is_film,crt.total,crt.coupan_code,link.url_key,created_user_group,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer FROM `cc_cart` as crt RIGHT JOIN cc_cart_items as itms on itms.cart_id=crt.cart_id LEFT JOIN cc_costume_image as img on img.costume_id=itms.costume_id and img.type="1" LEFT JOIN cc_costumes as cst on cst.costume_id=itms.costume_id LEFT JOIN cc_users as usr on usr.id=cst.created_by LEFT JOIN cc_costume_attribute_options as cstopt on cstopt.costume_id=cst.costume_id and cstopt.attribute_id="'.Config::get('constants.IS_FILMY').'" LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id and link.type="product" LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id  LEFT JOIN cc_coupon_category as cpn_cat on cpn_cat.category_id=cat.category_id LEFT JOIN cc_promotion_coupon as prom on prom.coupon_id=cpn_cat.coupon_id and prom.code="" '.$where.' group by itms.cart_item_id');
    	return $cart_products;
    }
    protected function getCartProductswithCoupan($code){
       $currentCookieKeyID=SiteHelper::currentCookieKey();
        if(Auth::check()){
          $where="where crt.user_id=".Auth::user()->id.' or crt.cookie_id="'.$currentCookieKeyID.'"';
        }else{
          $where="where crt.cookie_id='".$currentCookieKeyID."'";
        }
        $cart_products['basic']=DB::Select('SELECT itms.*,img.image,cst.condition,cst.size,concat(usr.first_name," ",usr.last_name) as user_name,cstopt.attribute_option_value  as is_film,crt.total,crt.coupan_code,link.url_key,created_user_group,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer FROM `cc_cart` as crt RIGHT JOIN cc_cart_items as itms on itms.cart_id=crt.cart_id LEFT JOIN cc_costume_image as img on img.costume_id=itms.costume_id and img.type="1" LEFT JOIN cc_costumes as cst on cst.costume_id=itms.costume_id LEFT JOIN cc_users as usr on usr.id=cst.created_by LEFT JOIN cc_costume_attribute_options as cstopt on cstopt.costume_id=cst.costume_id and cstopt.attribute_id="'.Config::get('constants.IS_FILMY').'" LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id and link.type="product" LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id  LEFT JOIN cc_coupon_category as cpn_cat on cpn_cat.category_id=cat.category_id LEFT JOIN cc_promotion_coupon as prom on prom.coupon_id=cpn_cat.coupon_id and prom.code="'.$code.'" '.$where.' group by itms.cart_item_id');
          DB::Update('UPDATE `cc_cart` SET `coupan_code`="'.$code.'" WHERE cart_id="'.$cart_products['basic'][0]->cart_id.'"');
          $count=0;
          $total=0;
          foreach( $cart_products['basic'] as $cart){
            if($cart->created_user_group=="admin"){
              $count++;
              $cart_products['dis_count']=$count;
              $total=($total+($cart->price/100)*$cart->discount)*$cart->qty;
            }
         
          }
         $cart_products['dis_total']=$total;
         return $cart_products;
    }

    protected function getCartSubtotalPrice($cart_id){
        $total_price=DB::Select('SELECT sum(price*qty) as total_price FROM `cc_cart_items` where cart_id='.$cart_id);
	   	return $total_price[0]->total_price;
    }
    protected function productRemoveFromCart($cart_item_id,$cart_id){
    	$cond=array('cart_item_id'=>$cart_item_id);
    	Site_model::delete_single('cart_items',$cond);
        $total=$this->getCartSubtotalPrice($cart_id);
        $data=array('total'=>$total,'modified_at'=>date('Y-m-d h:i:s'));
        $cond=array('cart_id'=>$cart_id,);
        Site_model::update_data('cart',$data,$cond);
        return true;
     }
     protected function cartMetaInfo($cart_id){
        $cart_meta=DB::Select('SELECT *  FROM `cc_cart` WHERE `cart_id` ='.$cart_id);
        return $cart_meta;
     }
     protected function verifyCoupanCode(){
        $coupan_code=DB::Select('SELECT coupan_code  FROM `cc_cart` WHERE `user_id` ='.Auth::user()->id);
        if(count($coupan_code)){
            return $coupan_code[0]->coupan_code;
        }else{
            return false;
        }
     }

     
    
   
}


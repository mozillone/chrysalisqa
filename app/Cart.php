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
use Log;


class Cart extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'cart_id', 'user_id','cookie_id', 'firstname', 'lastname', 'email', 'phone_no', 'pay_firstname', 'pay_lastname', 'pay_address_1', 'pay_address_2', 'pay_city', 'pay_zipcode',' pay_state','pay_country', 'payment_method', 'payment_code','shipping_firstname', 'shipping_lastname','shipping_address_1','shipping_address_2','shipping_city','shipping_postcode','shipping_country','shipping_method','shipping_code','comment','total','coupan_code','affiliate_id','commission','created_at','modified_at'
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
            if($qty=="0"){
               $res=DB::Delete('delete FROM `cc_cart_items` WHERE cart_id='.$cart_id.' and  costume_id='.$costume_id.'');
                $total=$this->getCartSubtotalPrice($cart_id);
                $data=array('total'=>$total,'modified_at'=>date('Y-m-d h:i:s'));
                $cond=array('cart_id'=>$cart_id,);
                Site_model::update_data('cart',$data,$cond);
                return true;
            }
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
    protected function userCartData($user_id){
        $data=DB::Select('SELECT * FROM `cc_cart` WHERE user_id= '.$user_id.'');
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
                        'weight'=>($costume_info->weight_pounds)+($costume_info->weight_ounces/16),
                        'price'=>$costume_info->price);
            Site_model::insert_data('cart_items',$data);
            return true;

    }
    private function verifieItemExists($costume_id,$cart_id){
        $data=DB::Select('SELECT if(count(*)>=1,"1","0") as is_exists  FROM `cc_cart_items` WHERE `costume_id` = '.$costume_id.' AND `cart_id` = '.$cart_id.'');
        return $data[0]->is_exists;
    }
    protected function getCostumeInfo($costume_id){
       $data=DB::Select('SELECT cst.costume_id,dsr.name,cst.sku_no,cst.quantity,cst.price,cst.weight_pounds,cst.weight_ounces FROM cc_costumes as cst LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id WHERE cst.costume_id='.$costume_id);
       return $data;
    }
    protected function verifyCostumeCartQuantity($costume_id,$cookie_id){
        $currentCookieKeyID=$cookie_id;
        if(Auth::check()){
            $where="where crt.user_id=".Auth::user()->id.' and items.costume_id='.$costume_id.'';
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
            $where="where crt.user_id=".Auth::user()->id.' and items.costume_id='.$costume_id.'';
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
    protected function getCartCount($cookie_id){
       // $currentCookieKeyID=SiteHelper::currentCookieKey();
       $currentCookieKeyID=$cookie_id;
        if(Auth::check()){
        	$where="where crt.user_id=".Auth::user()->id.'';
        }else{
        	$where="where crt.cookie_id='".$currentCookieKeyID."'";
        }
        $res=DB::Select('select sum(itms.qty) as mini_count from cc_cart_items as itms LEFT JOIN cc_cart as crt on crt.cart_id=itms.cart_id '.$where.'');
        return $res[0]->mini_count;

    }
    protected function updateCartToUser(){

       $currentCookieKeyID=SiteHelper::currentCookieKey();
       $carts_list=DB::Select('Select crt.cart_id,crt.total FROM `cc_cart` as crt LEFT JOIN cc_cart_items as itms on itms.cart_id=crt.cart_id WHERE crt.cookie_id="'.$currentCookieKeyID.'"');
        $user_cart=DB::Select('Select cart_id,total FROM `cc_cart` WHERE user_id="'.Auth::user()->id.'"');
        if(count($user_cart) && count($carts_list)){
          $total=$carts_list[0]->total+$user_cart[0]->total;
		  DB::Update('UPDATE `cc_cart_items` SET `cart_id`='.$carts_list[0]->cart_id.' WHERE cart_id='.$user_cart[0]->cart_id.'');
          DB::Update('UPDATE `cc_cart` SET `user_id`='.Auth::user()->id.',total='.$total.' WHERE cookie_id="'.$currentCookieKeyID.'"');
          DB::delete('delete from `cc_cart` where cookie_id!="'.$currentCookieKeyID.'" and user_id='.Auth::user()->id);

          DB::Insert('INSERT INTO cc_cart_items_temp (`costume_id`, `sku`, `costume_name`, `qty`, `price`, `cart_id`) SELECT `costume_id`, `sku`, `costume_name`, sum(`qty`), `price`, `cart_id` FROM `cc_cart_items` WHERE cart_id = '.$carts_list[0]->cart_id.' GROUP BY costume_id');
          DB::delete('delete from cc_cart_items WHERE cart_id ='.$carts_list[0]->cart_id);

          DB::Insert('INSERT INTO cc_cart_items (`costume_id`, `sku`, `costume_name`, `qty`, `price`, `cart_id`) SELECT `costume_id`, `sku`, `costume_name`, `qty`, `price`, `cart_id` FROM `cc_cart_items_temp` WHERE cart_id = '.$carts_list[0]->cart_id);
          DB::delete('delete from cc_cart_items_temp WHERE cart_id ='.$carts_list[0]->cart_id);
        }
        else{
        DB::Update('UPDATE `cc_cart` SET `user_id`='.Auth::user()->id.' WHERE cookie_id="'.$currentCookieKeyID.'"');
        }
       
    //   $user_cart=DB::Select('Select cart_id FROM `cc_cart` WHERE user_id="'.Auth::user()->id.'"');
    //   if(count($user_cart)){
    //   foreach ($carts_list as $key => $carts) {
    //         $check_cart=DB::Select('Select if(count(*)>0,true,false)  as is_exits from  cc_cart_items where cart_id='.$user_cart[0]->cart_id.' and costume_id='.$carts->costume_id.'');
    //        if($check_cart[0]->is_exits=="1"){
    //             DB::Update('update cc_cart_items set qty=qty+'.$carts->qty.' where cart_id='.$user_cart[0]->cart_id.' and costume_id='.$carts->costume_id.'');
    //         }else{
    //             $new_check_cart=DB::Select('Select cart_id,costume_id,sku,costume_name,qty,price from  cc_cart_items where cart_id='.$carts_list[0]->cart_id.' and costume_id='.$carts->costume_id.'');
           
    //             $data=array('cart_id'=>$new_check_cart[0]->cart_id,
    //                     'costume_id'=>$new_check_cart[0]->costume_id,
    //                     'sku'=>$new_check_cart[0]->sku,
    //                     'costume_name'=>$new_check_cart[0]->costume_name,
    //                     'qty'=>$new_check_cart[0]->qty,
    //                     'price'=>$new_check_cart[0]->price);
    //         Site_model::insert_data('cart_items',$data);
    //         }
    //         DB::Update('update cc_cart_items set qty=qty+'.$carts->qty.' where cart_id='.$user_cart[0]->cart_id.' and costume_id='.$carts->costume_id.'');
    //   }
    //   $cond=array('cookie_id'=> $currentCookieKeyID);
    //   Site_model::delete_single('cart',$cond);
    // }else{
    //     DB::Update('UPDATE `cc_cart` SET `user_id`='.Auth::user()->id.' WHERE cookie_id="'.$currentCookieKeyID.'"');
    // }
       
    }
    protected function getCartProducts(){
    	$currentCookieKeyID=SiteHelper::currentCookieKey();
        if(Auth::check()){
        	$where="where crt.user_id=".Auth::user()->id.'';
        }else{
        	$where="where crt.cookie_id='".$currentCookieKeyID."'";
        }
          	$cart_products['basic']=DB::Select('SELECT itms.*,img.image,cst.condition,cst.size,cst.weight_pounds,cst.weight_ounces,concat(usr.first_name," ",usr.last_name) as user_name,usr.is_free,cstopt.attribute_option_value  as is_film,crt.total,crt.coupan_code,crt.coupon_amount,crt.cc_id,crt.store_credits,link.url_key,created_user_group,cst.created_by,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer,addr.*,(SELECT attribute_option_value  FROM `cc_costume_attribute_options` WHERE `costume_id` = cst.costume_id and attribute_id='.Config::get('constants.Shipping_id').') as shipping,cst.item_location FROM `cc_cart` as crt RIGHT JOIN cc_cart_items as itms on itms.cart_id=crt.cart_id LEFT JOIN cc_costume_image as img on img.costume_id=itms.costume_id and img.type="1" LEFT JOIN cc_costumes as cst on cst.costume_id=itms.costume_id LEFT JOIN cc_users as usr on usr.id=cst.created_by LEFT JOIN cc_costume_attribute_options as cstopt on cstopt.costume_id=cst.costume_id and cstopt.attribute_id="'.Config::get('constants.IS_FILMY').'" LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id and link.type="product" LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id  LEFT JOIN cc_coupon_category as cpn_cat on cpn_cat.category_id=cat.category_id LEFT JOIN cc_promotion_coupon as prom on prom.coupon_id=cpn_cat.coupon_id and prom.code="" LEFT JOIN cc_address_master as addr on addr.user_id=cst.created_by and addr.address_type="selling" '.$where.' group by itms.cart_item_id');
            $data=DB::Select('SELECT cart_id,coupan_code,store_credits from cc_cart as crt '.$where.'');
            if(count($data)){
              $cart_products['credits']=$data[0]->store_credits;
            }
            //dd($cart_products);
           	return $cart_products;
    }
    protected function getCartProductswithCoupan($code,$coupon_id="0"){
       $currentCookieKeyID=SiteHelper::currentCookieKey();
        if(Auth::check()){
          $where="where crt.user_id=".Auth::user()->id.'';
        }else{
          $where="where crt.cookie_id='".$currentCookieKeyID."'";
        }
        $cart_products['basic']=DB::Select('SELECT itms.*,img.image,cst.condition,cst.size,cst.weight_pounds,cst.weight_ounces,concat(usr.first_name," ",usr.last_name) as user_name,usr.is_free,cstopt.attribute_option_value  as is_film,crt.total,crt.coupan_code,crt.coupon_amount,crt.cc_id,crt.store_credits,link.url_key,created_user_group,cst.created_by,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer,addr.city,addr.state,addr.country,addr.*,(SELECT attribute_option_value  FROM `cc_costume_attribute_options` WHERE `costume_id` = cst.costume_id and attribute_id='.Config::get('constants.Shipping_id').') as shipping,cst.item_location  FROM `cc_cart` as crt RIGHT JOIN cc_cart_items as itms on itms.cart_id=crt.cart_id LEFT JOIN cc_costume_image as img on img.costume_id=itms.costume_id and img.type="1" LEFT JOIN cc_costumes as cst on cst.costume_id=itms.costume_id LEFT JOIN cc_users as usr on usr.id=cst.created_by LEFT JOIN cc_costume_attribute_options as cstopt on cstopt.costume_id=cst.costume_id and cstopt.attribute_id="'.Config::get('constants.IS_FILMY').'" LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id and link.type="product" LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id  LEFT JOIN cc_coupon_category as cpn_cat on cpn_cat.category_id=cat.category_id LEFT JOIN cc_promotion_coupon as prom on prom.coupon_id=cpn_cat.coupon_id and prom.code="'.$code.'" LEFT JOIN cc_address_master as addr on addr.user_id=cst.created_by and addr.address_type="selling" '.$where.' group by itms.cart_item_id');
         DB::Update('UPDATE `cc_cart` SET `coupan_code`="'.$code.'",coupon_id="'.$coupon_id.'"  WHERE cart_id="'.$cart_products['basic'][0]->cart_id.'"');
            $data=DB::Select('SELECT cart_id,coupan_code,store_credits from cc_cart as crt '.$where.'');
            $cart_products['credits']=$data[0]->store_credits;
          $count=0;
          $total=0;
          $discount = \DB::table('promotion_coupon')->where('coupon_id', $coupon_id)->value('discount');
          
          foreach( $cart_products['basic'] as $cart){
            // echo "<pre>";
            // print_r($cart);
            $cart_products['type']="";
            if($cart->created_user_group=="admin"){
              $count+=$cart->qty;
              $cart_products['dis_count']=$count;
              $cart_products['type']=$cart->type;
              $total=$total+(($cart->price/100)*$discount*$cart->qty);
              $cart->discount=$discount;
            }
         
          }
          
          $res=$this->verifyCouponCreditsSubZero($cart_products['basic'][0]->cart_id,$total);
          $cart_products['dis_total']=$total;
          $cart_products['seller_add']=DB::Select('select * from cc_address_master where user_id='.$cart_products['basic'][0]->created_by.' and address_type="selling"');
          if(!$res){
            $cart_products['error']=1; 
            unset($cart_products['dis_count']);
            $cart_products['dis_total']=0;
            
          }
            DB::Update('UPDATE `cc_cart` SET `coupan_code`="'.$code.'", coupon_amount='.$total.'  WHERE cart_id="'.$cart_products['basic'][0]->cart_id.'"');
         return $cart_products;
    }
  protected function creditsReset(){
      $currentCookieKeyID=SiteHelper::currentCookieKey();
        if(Auth::check()){
          $where="where crt.user_id=".Auth::user()->id.'';
        }else{
          $where="where crt.cookie_id='".$currentCookieKeyID."'";
        }
        DB::Update('update cc_cart as crt set coupan_code="",coupon_id="" '.$where.'');
      
    }
    protected function getCartSubtotalPrice($cart_id){
        $total_price=DB::Select('SELECT sum(price*qty) as total_price FROM `cc_cart_items` where cart_id='.$cart_id);
	   	return $total_price[0]->total_price;
    }
    protected function productRemoveFromCart($cart_item_id,$cart_id){
    	$cond=array('cart_item_id'=>$cart_item_id);
    	Site_model::delete_single('cart_items',$cond);
        $total=$this->getCartSubtotalPrice($cart_id);
        $data=array('total'=>$total,'store_credits'=>"0.00",'modified_at'=>date('Y-m-d h:i:s'));
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
      protected function storeCreditsUpdate($req){
        $cart_amount=DB::Select('Select cart_id,total from `cc_cart`  WHERE user_id='.Auth::user()->id);
        if(trim($req['credits'])<=Auth::user()->credits){
          if(trim($req['credits'])<=$cart_amount[0]->total){
            DB::Update('UPDATE `cc_cart` SET store_credits="'.$req['credits'].'" WHERE user_id='.Auth::user()->id);
            $res=$this->verifyCouponCreditsSubZero($cart_amount[0]->cart_id);
            if(!$res){
             return array('result'=>"0","msg"=>"You don't have sufficient credits");
            }else{
              return array('result'=>"1","msg"=>"");
            }
          }else{
             return array('result'=>"0","msg"=>"Your credits exceeds of cart amount");
          }
        }else{
          return array('result'=>"0","msg"=>"You don't have sufficient credits");
        }
     }
 protected function getUserShippingAddress(){
    $cart_address=$this->getUserCartShippingAddress();
    if(!empty($cart_address[0]->shipping_postcode)){
      $shipping_address=array('city'=>$cart_address[0]->shipping_city,
                              'state'=>$cart_address[0]->shipping_state,
                              'zip_code'=>$cart_address[0]->shipping_postcode
                            );
    }else{
      if(Auth::check()){
        $data=DB::Select('SELECT *  FROM `cc_address_master` WHERE `address_type` = "shipping" AND `user_id` ='.Auth::user()->id );
        if(count($data)){
          $shipping_address=array('city'=>$data[0]->city,
                                  'state'=>$data[0]->state,
                                  'zip_code'=>$data[0]->zip_code
                                );
        }else{
          $shipping_address=[];

        }
      }else{
        $shipping_address=[];
      }
    }
  //  dd($shipping_address);
    if(count($shipping_address)){
      return $shipping_address;
    }else{
      return false;
    }

 }protected function getSellerShippingAddress($user_id){
    $seller_address=DB::Select('SELECT *  FROM `cc_address_master` WHERE `address_type` = "selling" AND `user_id` ='.$user_id );
    if(count($seller_address)){
      return $seller_address;
    }else{
      return false;;
    }

 }
 protected function verifyCouponCreditsSubZero($cart_id){
    $res=DB::Select('SELECT if((total-store_credits-coupon_amount)>=0,true,false) as is_exists  FROM `cc_cart`  WHERE cart_id='.$cart_id);
    return $res[0]->is_exists;
 }   
    
protected function getUserCartShippingAddress(){
  if(Auth::check()){
      $data=DB::Select('SELECT *  FROM `cc_cart` WHERE `user_id` ='.Auth::user()->id);
      return $data;
  }else{
    return ;
  }
    
    //return $data; 
}

}
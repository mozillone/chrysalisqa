<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;
use Auth;
use Session;
use App\Cart;
use App\Address;
use App\Order;

class Address extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'address_id', 'fname','lname','address1','address2', 'city', 'state', 'country', 'zip_code', 'address_type', 'user_id','created_on'];
    protected function addBillingAddress($req){
               $user_id=Auth::user()->id;
                $state=$req['state'];
                if(isset($req['address_id']) && $req['address_id']!="new"){
                   $data=DB::Select('Select * FROM `cc_address_master` WHERE `address_id` ='.$req['address_id'].' and user_id='.Auth::user()->id);
                   $res=array('pay_firstname'=>Auth::user()->first_name,
                      'pay_lastname'=>Auth::user()->last_name,
                      'pay_address_1'=>$data[0]->address1,
                      'pay_address_2'=>$data[0]->address2,
                      'pay_city'=>$data[0]->city,
                      'pay_state'=>$data[0]->state,
                      'pay_zipcode'=>$data[0]->zip_code
                       );
                   $cond=array('cart_id'=>$req['cart_id']);
                   Site_model::update_data('cart',$res,$cond);
                  return true; 
                }
                $billing_address=array('fname'=>$req['firstname'],
                                       'lname'=>$req['lastname'],
                                       'address1'=>$req['address_1'],
                                       'address2'=>$req['address_2'],
                                       'city'=>$req['city'],
                                       'state'=> $state,
                                       'zip_code'=>$req['postcode'],
                                       'address_type'=>'billing',
                                       'user_id'=>Auth::user()->id,
                                       'created_on'=>date('Y-m-d h:i:s')
                                        );
               $address_id=Site_model::insert_get_id('address_master',$billing_address);
              
               if(isset($req['is_shipping'])){
                    $this->addShippingAddress($req);
                    $this->updateCartOrderAddress($req);
               }else{
                    $this->updateCartOrderInfo($req,'billing');
               }
               return $address_id;
    }
     protected function addShippingAddress($req){
                $user_id=Auth::user()->id;
                $state=$req['state'];
                if(isset($req['address_id']) && $req['address_id']!="new"){
                   $data=DB::Select('Select * FROM `cc_address_master` WHERE `address_id` ='.$req['address_id'].' and user_id='.Auth::user()->id);
                   $res=array('shipping_firstname'=>Auth::user()->first_name,
                      'shipping_lastname'=>Auth::user()->last_name,
                      'shipping_address_1'=>$data[0]->address1,
                      'shipping_address_2'=>$data[0]->address2,
                      'shipping_city'=>$data[0]->city,
                      'shipping_state'=>$data[0]->state,
                      'shipping_postcode'=>$data[0]->zip_code
                       );
                   $cond=array('cart_id'=>$req['cart_id']);
                   Site_model::update_data('cart',$res,$cond);
                  return true; 
                }
                 $billing_address=array('fname'=>$req['firstname'],
                                       'lname'=>$req['lastname'],
                                       'address1'=>$req['address_1'],
                                       'address2'=>$req['address_2'],
                                       'city'=>$req['city'],
                                       'state'=> $state,
                                       'zip_code'=>$req['postcode'],
                                       'address_type'=>'shipping',
                                       'user_id'=>Auth::user()->id,
                                       'created_on'=>date('Y-m-d h:i:s')
                                        );
               $address_id=Site_model::insert_get_id('address_master',$billing_address);
               if(isset($req['is_billing'])){
                    $this->addBillingAddress($req);
                    $this->updateCartOrderAddress($req);
               }else{
                    $this->updateCartOrderInfo($req,'shipping');
              
               }
               return $address_id;
    }
    protected function getAddressinfo($type,$latest=null,$address_id=null){
        
        if($latest==null && $address_id==null){
             $where=' where user_id="'.Auth::user()->id.'" and address_type="'.$type.'"';
        }
        if($latest!=null && $address_id==null){
               $where=' where user_id="'.Auth::user()->id.'" and address_type="'.$type.'" order by address_id desc LIMIT 0,1';
        }
        if($latest==null && $address_id!=null){
            $where=' where address_id="'.$address_id.'"';

        }
        $address_info=DB::Select('select * from cc_address_master '.$where.'');
        return $address_info;
    }
    private function updateCartOrderInfo($req,$type){
          if($type=="billing"){
          if(!empty($req['billing_state_dropdown'])){ $state=$req['billing_state_dropdown'];}else{$state=$req['state'];}
          $data=array('pay_firstname'=>$req['firstname'],
                      'pay_lastname'=>$req['lastname'],
                      'pay_address_1'=>$req['address_1'],
                      'pay_address_2'=>$req['address_2'],
                      'pay_city'=>$req['city'],
                      'pay_state'=>$state,
                      'pay_zipcode'=>$req['postcode']
                       );
          }else{
          if(!empty($req['shipping_state_dropdown'])){ $state=$req['shipping_state_dropdown'];}else{$state=$req['state'];}
           $data=array('shipping_firstname'=>$req['firstname'],
                      'shipping_lastname'=>$req['lastname'],
                      'shipping_address_1'=>$req['address_1'],
                      'shipping_address_2'=>$req['address_2'],
                      'shipping_city'=>$req['city'],
                      'shipping_state'=>$state,
                      'shipping_postcode'=>$req['postcode']
                       );
          }
         $cond=array('cart_id'=>$req['cart_id']);
         Site_model::update_data('cart',$data,$cond);
        return true;    
     }
     private function updateCartOrderAddress($req){
       $pay_state=$req['state'];
       $shipping_state=$req['state'];
         $data=array('pay_firstname'=>$req['firstname'],
                      'pay_lastname'=>$req['lastname'],
                      'pay_address_1'=>$req['address_1'],
                      'pay_address_2'=>$req['address_2'],
                      'pay_city'=>$req['city'],
                      'pay_state'=>$pay_state,
                      'pay_zipcode'=>$req['postcode'],
                      'shipping_firstname'=>$req['firstname'],
                      'shipping_lastname'=>$req['lastname'],
                      'shipping_address_1'=>$req['address_1'],
                      'shipping_address_2'=>$req['address_2'],
                      'shipping_city'=>$req['city'],
                      'shipping_state'=>$shipping_state,
                      'shipping_postcode'=>$req['postcode']
                       );
        $cond=array('cart_id'=>$req['cart_id']);
        Site_model::update_data('cart',$data,$cond);
        return true;   
     }
     protected function addShippingAddressDashboard($req){

                $user_id=Auth::user()->id;
                if(!empty($req['shiping_state_dropdown'])){ 
                    $state=$req['shiping_state_dropdown'];
                }else{
                    $state=$req['state'];
                }
                 //echo "<pre>";print_r($state);die;
                 $billing_address=array('fname'=>$req['firstname'],
                                       'lname'=>$req['lastname'],
                                       'address1'=>$req['address_1'],
                                       'address2'=>$req['address_2'],
                                       'city'=>$req['city'],
                                       'state'=> $state,
                                       'country'=>$req['country'],
                                       'zip_code'=>$req['postcode'],
                                       'address_type'=>'shipping',
                                       'user_id'=>Auth::user()->id,
                                       'created_on'=>date('Y-m-d h:i:s')
                                        );
                if ($req['is_edit'] == 'yes') {
                  $address_id=DB::table('address_master')->where('user_id',$user_id)->where('address_type','shipping')->where('address_id',$req['shipping_address_id'])->update($billing_address);
                }else{
                  $address_id=Site_model::insert_get_id('address_master',$billing_address);
                }
               if(isset($req['is_billing'])){
                    $billing_address=array('fname'=>$req['firstname'],
                                       'lname'=>$req['lastname'],
                                       'address1'=>$req['address_1'],
                                       'address2'=>$req['address_2'],
                                       'city'=>$req['city'],
                                       'state'=> $state,
                                       'country'=>$req['country'],
                                       'zip_code'=>$req['postcode'],
                                       'address_type'=>'billing',
                                       'user_id'=>Auth::user()->id,
                                       'created_on'=>date('Y-m-d h:i:s')
                                        );
                    $address_id=Site_model::insert_get_id('address_master',$billing_address);
               }
               return $address_id;
    }

    protected function addBillingAddressDashboard($req){
      //echo "<pre>";print_r($req->all());die;
                $user_id=Auth::user()->id;
                if(!empty($req['billing_state_dropdown'])){ 
                  $state=$req['billing_state_dropdown'];
                }else{
                  $state=$req['state'];
                }
                $billing_address=array('fname'=>$req['firstname'],
                                       'lname'=>$req['lastname'],
                                       'address1'=>$req['address_1'],
                                       'address2'=>$req['address_2'],
                                       'city'=>$req['city'],
                                       'state'=> $state,
                                       'country'=>$req['country'],
                                       'zip_code'=>$req['postcode'],
                                       'address_type'=>'billing',
                                       'user_id'=>Auth::user()->id,
                                       'created_on'=>date('Y-m-d h:i:s')
                                        );
               if ($req['is_edit'] == 'yes') {
                  $address_id=DB::table('address_master')->where('user_id',$user_id)->where('address_type','billing')->where('address_id',$req['billing_address_id'])->update($billing_address);
                }else{
                  $address_id=Site_model::insert_get_id('address_master',$billing_address);
                }
               if(isset($req['is_shipping'])){
                    $billing_address=array('fname'=>$req['firstname'],
                                       'lname'=>$req['lastname'],
                                       'address1'=>$req['address_1'],
                                       'address2'=>$req['address_2'],
                                       'city'=>$req['city'],
                                       'state'=> $state,
                                       'country'=>$req['country'],
                                       'zip_code'=>$req['postcode'],
                                       'address_type'=>'shipping',
                                       'user_id'=>Auth::user()->id,
                                       'created_on'=>date('Y-m-d h:i:s')
                                        );
               $address_id=Site_model::insert_get_id('address_master',$billing_address);
               }
               return $address_id;
    }  
    protected function sellerLocationAddress($req){
                $user_id=Auth::user()->id;
                $state=Order::getStateAbbrev($req['state']);
                if(empty($state)){
                  $st=$req['state'];
                }else{
                  $st=$state;
                }
                $billing_address=array('fname'=>Auth::user()->first_name,
                                       'lname'=>Auth::user()->last_name,
                                       'address1'=>$req['address_1'],
                                       'address2'=>$req['address_2'],
                                       'city'=>$req['city'],
                                       'state'=> $st,
                                       'zip_code'=>$req['zipcode'],
                                       'address_type'=>'selling',
                                       'user_id'=>$user_id,
                                       'created_on'=>date('Y-m-d h:i:s')
                                        );
               if (isset($req['is_edit'])) {
                  $address_id=DB::table('address_master')->where('user_id',$user_id)->where('address_type','selling')->update($billing_address);
                  return "Seller address is updated successfully";
                }else{
                  $address_id=Site_model::insert_get_id('address_master',$billing_address);
                  return "Seller address is created successfully";
                }
               
               return $address_id;
    }
    protected function userCartShippingAddress($cart_id){
       if(Auth::check()){
          $user_id=Auth::user()->id;
          $cart_info=Cart::cartMetaInfo($cart_id);
          if(!empty($cart_info[0]->shipping_address_2)){

              $zip_code=$cart_info[0]->shipping_postcode;
           //    dd($zip_code);
          }else{
             $address_info=$this->getAddressinfo('shipping',"latest"); 
             if(count($address_info)){
               $zip_code= $address_info[0]->zip_code;
              }else{
                 return false;
              }
          }
          return $zip_code;
        }else{
          return false;
       }
    }
    protected function getStatesList(){
      $states=DB::Select('SELECT * FROM `cc_states` order by name');
      return $states;
    }
    protected function getUserSellerAddress($user_id){
      $data=DB::Select('SELECT *  FROM `cc_address_master` WHERE `address_type` = "selling" AND `user_id` ='.$user_id);
      return $data;
    }
    protected function deletSellerLocationAddress($add_id){

      $data=DB::delete('DELETE FROM `cc_address_master` WHERE `address_id` ='.$add_id.' and user_id='.Auth::user()->id);
      return $data;
    }
    protected function getAddressData($add_id){

      $data=DB::Select('Select * FROM `cc_address_master` WHERE `address_id` ='.$add_id.' and user_id='.Auth::user()->id);
      return $data;
    }
}

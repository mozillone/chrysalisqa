<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;
use Auth;
use Session;

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
                $billing_address=array('fname'=>$req['firstname'],
                                       'lname'=>$req['lastname'],
                                       'address1'=>$req['address_1'],
                                       'address2'=>$req['address_2'],
                                       'city'=>$req['city'],
                                       'state'=>$req['state'],
                                       'country'=>$req['country'],
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
                $billing_address=array('fname'=>$req['firstname'],
                                       'lname'=>$req['lastname'],
                                       'address1'=>$req['address_1'],
                                       'address2'=>$req['address_2'],
                                       'city'=>$req['city'],
                                       'state'=>$req['state'],
                                       'country'=>$req['country'],
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
          $data=array('pay_firstname'=>$req['firstname'],
                      'pay_lastname'=>$req['lastname'],
                      'pay_address_1'=>$req['address_1'],
                      'pay_address_2'=>$req['address_2'],
                      'pay_city'=>$req['city'],
                      'pay_state'=>$req['state'],
                      'pay_zipcode'=>$req['country'],
                      'pay_country'=>$req['postcode'],
                       );
          }else{
           $data=array('shipping_firstname'=>$req['firstname'],
                      'shipping_lastname'=>$req['lastname'],
                      'shipping_address_1'=>$req['address_1'],
                      'shipping_address_2'=>$req['address_2'],
                      'shipping_city'=>$req['city'],
                      'shipping_state'=>$req['state'],
                      'shipping_postcode'=>$req['country'],
                      'shipping_country'=>$req['postcode'],
                       );
          }
         $cond=array('cart_id'=>$req['cart_id']);
         Site_model::update_data('cart',$data,$cond);
        return true;    
     }
     private function updateCartOrderAddress($req){
         $data=array('pay_firstname'=>$req['firstname'],
                      'pay_lastname'=>$req['lastname'],
                      'pay_address_1'=>$req['address_1'],
                      'pay_address_2'=>$req['address_2'],
                      'pay_city'=>$req['city'],
                      'pay_state'=>$req['state'],
                      'pay_zipcode'=>$req['country'],
                      'pay_country'=>$req['postcode'],
                      'shipping_firstname'=>$req['firstname'],
                      'shipping_lastname'=>$req['lastname'],
                      'shipping_address_1'=>$req['address_1'],
                      'shipping_address_2'=>$req['address_2'],
                      'shipping_city'=>$req['city'],
                      'shipping_state'=>$req['state'],
                      'shipping_postcode'=>$req['country'],
                      'shipping_country'=>$req['postcode'],
                       );
        $cond=array('cart_id'=>$req['cart_id']);
        Site_model::update_data('cart',$data,$cond);
        return true;   
     }
}

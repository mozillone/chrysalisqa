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
                dd($req);
                $billing_address=array('fname'=>$req['pay_firstname'],
                                       'lname'=>$req['pay_lastname'],
                                       'address1'=>$req['pay_address_1'],
                                       'address2'=>$req['pay_address_2'],
                                       'city'=>$req['pay_city'],
                                       'country'=>$req['pay_country'],
                                       'zip_code'=>$req['pay_postcode'],
                                       'address_type'=>'billing',
                                       'user_id'=>Auth::user()->id,
                                       'created_on'=>date('Y-m-d h:i:s')
                                        );
               Site_model::insert_get_id('address_master',$billing_address);
    }
     protected function addShippingAddress($req){
                $user_id=Auth::user()->id;
                $billing_address=array('fname'=>$req['shipping_firstname'],
                                       'lname'=>$req['shipping_lastname'],
                                       'address1'=>$req['shipping_address_1'],
                                       'address2'=>$req['shipping_address_2'],
                                       'city'=>$req['shipping_city'],
                                       'country'=>$req['shipping_country'],
                                       'zip_code'=>$req['shipping_postcode'],
                                       'address_type'=>'shipping',
                                       'user_id'=>Auth::user()->id,
                                       'created_on'=>date('Y-m-d h:i:s')
                                        );
               Site_model::insert_get_id('address_master',$billing_address);
    }
    protected function getAddressinfo($user_id,$type){
        $address_info=DB::Select('select * from cc_address_master where user_id="'.Auth::user()->id.'" and address_type="'.$type.'"');
        return $address_info;
    }
}

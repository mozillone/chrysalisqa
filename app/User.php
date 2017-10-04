<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
<<<<<<< HEAD
use DB;
use App\Helpers\Site_model;
use App\Helpers\Paypal;
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'id', 'role_id', 'username','paypal_email','display_name', 'first_name', 'last_name', 'email', 'password', 'user_img', 'active', 'last_login', 'newsletter', 'deleted', 'api_customer_id', 'activate_hash', 'reset_hash'
=======
        'id', 'role_id', 'display_name', 'first_name', 'last_name', 'email', 'password', 'user_img', 'active', 'last_login', 'newsletter', 'deleted', 'api_customer_id', 'activate_hash', 'reset_hash'
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
<<<<<<< HEAD

    protected function ShippingDetails($data){
        if (isset($data['free_shipping']) && !empty($data['free_shipping'])) {
            $is_free = '1';
        }else{
            $is_free = '0';
        }
        $getdetails = DB::table('users')->where('id',$data['user_id'])->first();
        $users_update = array('is_free'=>$is_free,
                'updated_at'=>date('y-m-d H:i:s'));
            $sd_id = DB::table('users')->where('id',$data['user_id'])->update($users_update);
        $data['fname'] = $getdetails->first_name;
        $data['lname'] = $getdetails->last_name;
        $paypal_email_verify = Paypal::checkPaypalId($data);
        //echo "<pre>";print_r($paypal_email_verify);die;
        if ($paypal_email_verify['status'] == "Success") {
            $users_update = array('paypal_verified'=>'verified',
                'paypal_email'=>$data['paypal_email'],
                'updated_at'=>date('y-m-d H:i:s'));
            $sd_id = DB::table('users')->where('id',$data['user_id'])->update($users_update);
            return $sd_id;
        }else{
           return $paypal_email_verify['error'];
        }
    }

    protected function CreditLog($data){
     $credit_insert =Site_model::insert_get_id('user_credit_log',$data); 
     return $credit_insert;
    }
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
}

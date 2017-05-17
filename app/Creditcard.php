<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;
use Auth;
use Session;
use App\Helpers\StripeApp;

class Creditcard extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'display_name', 'cardholder_name', 'credit_card_mask', 'card_type', 'is_default', 'payment_method_token','exp_month','exp_year','cvn_pin',
    ];
    public function __construct()
    {
      $this->stripe=new StripeApp();
     
    }

   // protected function addCreditCard($req,$user_id){
           
   //      $cc_details=array('user_id'=>$user_id,
   //                     'cardholder_name'=>$req['cardholder_name'],
   //                     'credit_card_mask'=> $req['cc_number'],
   //                     'card_type'=> $req['card_type'],
   //                     'exp_month'=> $req['exp_month'],
   //                     'exp_year'=> $req['exp_year'],
   //                     'cvn_pin'=> $req['cvn_pin'],
   //                     'created_at'=>date('Y-m-d H:i:s'));
   //      $cc_id=Site_model::insert_get_id('creditcard',$cc_details);
   //       $this->updateCartOrderInfo($cc_id,$req['cart_id']);
   //      return $cc_id;
   //      }
    protected function addCreditCard($req,$user_id){
           
         $card=$this->stripe->cards(Auth::user()->api_customer_id,$req['cardholder_name'],$req['cc_number'],$req['exp_month'],$req['cvn_pin'],$req['exp_year']);    
         $cc_details=array('user_id'=>$user_id,
                       'cardholder_name'=>$req['cardholder_name'],
                       'credit_card_mask'=> $cardno='xxxx-xxxx-xxxx-'.$card['last4'],
                       'card_type'=> $card['brand'],
                       'payment_method_token'=> $card['id'],
                       'exp_month'=> $card['exp_month'],
                       'exp_year'=> $card['exp_year'],
                       'cvn_pin'=> $req['cvn_pin'],
                       'created_at'=>date('Y-m-d H:i:s'));
        $cc_id=Site_model::insert_get_id('creditcard',$cc_details);

         $this->updateCartOrderInfo($cc_id,$req['cart_id']);
        return $cc_id;

        }
    protected function getCCList($user_id,$cc_id=null){
        if($cc_id==null){
            $where='where user_id="'.$user_id.'"';
        }else{
            $where='where user_id="'.$user_id.'" and id='.$cc_id.'';
        }
        $cc_list=DB::Select('select * from cc_creditcard '.$where.'');
        return $cc_list;
    }  
    private function updateCartOrderInfo($cc_id,$cart_id){
          $data=array('cc_id'=>$cc_id);
          $cond=array('cart_id'=>$cart_id);
          Site_model::update_data('cart',$data,$cond);
          return true;    
     }  
}

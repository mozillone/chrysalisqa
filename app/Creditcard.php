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
use Exception;

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
<<<<<<< HEAD
      //$this->braintreeApi = new BraintreeApp();
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
        try {
<<<<<<< HEAD
         
          // $customerData = [
          //     'customerId' => Auth::user()->api_customer_id,
          //     'paymentMethodNonce' => 'fake-valid-nonce',
          //     'cardholderName' => $req['cardholder_name'],
              
          //     'number' => $req['cc_number'],
          //     'cvv' => $req['cvn_pin'],
          //     'expirationMonth' => $req['exp_month'],
          //     'expirationYear' => $req['exp_year'],
               
          //     'options' => [
          //         'makeDefault' => true ]
          //];
            $card=$this->stripe->cards(Auth::user()->api_customer_id,$req['cardholder_name'],$req['cc_number'],$req['exp_month'],$req['cvn_pin'],$req['exp_year']);    
           /**
            * undocumented constant
            **/
           
         // $result_payment = $this->braintreeApi->paymentMethodCreate($customerData,$user_id);
          // if(isset($result_payment->errors))
          // {
          //   foreach($result_payment->errors->deepAll() AS $error) {
          //     $message = $error->message ;
          //   }
          //   $result=array('result'=>0,'message'=>$message);
          //   return $result;
          // }

          $cc_details=array('user_id'=>$user_id,
                       'cardholder_name'=>$req['cardholder_name'],
                       'credit_card_mask'=> $cardno='xxxx-xxxx-xxxx-'.$card['last4'],
                       'card_type'=>$card['brand'],
                       'last_digits'=> $card['last4'],
=======
         $card=$this->stripe->cards(Auth::user()->api_customer_id,$req['cardholder_name'],$req['cc_number'],$req['exp_month'],$req['cvn_pin'],$req['exp_year']); 
          $cc_details=array('user_id'=>$user_id,
                       'cardholder_name'=>$req['cardholder_name'],
                       'credit_card_mask'=> $cardno='xxxx-xxxx-xxxx-'.$card['last4'],
                       'card_type'=> $card['brand'],
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                       'payment_method_token'=> $card['id'],
                       'exp_month'=> $card['exp_month'],
                       'exp_year'=> $card['exp_year'],
                       'cvn_pin'=> $req['cvn_pin'],
                       'created_at'=>date('Y-m-d H:i:s'));
        $cc_id=Site_model::insert_get_id('creditcard',$cc_details);

         $this->updateCartOrderInfo($cc_id,$req['cart_id']);
         $result=array('result'=>1,'message'=>$cc_id);
         return $result;  
         }catch(Exception $e){
             $result=array('result'=>0,'message'=>$e->getMessage());
              return $result;
         } 
        
    
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

     protected function addCreditCardDashboard($req,$user_id){
<<<<<<< HEAD
       try {
      // $customerData = [
      //        'customerId' => Auth::user()->api_customer_id,
      //        'paymentMethodNonce' => 'fake-valid-nonce',
      //        'cardholderName' => $req['cardholder_name'],
             
      //        'number' => $req['cc_number'],
      //        'cvv' => $req['cvn_pin'],
      //        'expirationMonth' => $req['exp_month'],
      //        'expirationYear' => $req['exp_year'],
             
      //        'options' => [
      //            'makeDefault' => true ]
      //    ];
      //    $result_payment = $this->braintreeApi->paymentMethodCreate($customerData,$user_id);
       $card=$this->stripe->cards(Auth::user()->api_customer_id,$req['cardholder_name'],$req['cc_number'],$req['exp_month'],$req['cvn_pin'],$req['exp_year']);
       //$card = array();
       $updat_cc = DB::table('creditcard')->where('user_id',$user_id)->update(['is_default'=>'0']);

       $cc_details=array('user_id'=>$user_id,
                      'cardholder_name'=>$req['cardholder_name'],
                      'credit_card_mask'=> $cardno='xxxx-xxxx-xxxx-'.$card['last4'],
                      'card_type'=>$card['brand'],
                       'last_digits'=> $card['last4'],
                       'payment_method_token'=> $card['id'],
                       'exp_month'=> $card['exp_month'],
                       'exp_year'=> $card['exp_year'],
                       'cvn_pin'=> $req['cvn_pin'],
                      'is_default'=>'1',
                      'created_at'=>date('Y-m-d H:i:s'));
       $cc_id=Site_model::insert_get_id('creditcard',$cc_details);
       $result=array('result'=>1,'message'=>null,'cc_id'=>$cc_id);
             return $result;
        }catch(Exception $e){
            $result=array('result'=>0,'message'=>$e->getMessage(),'cc_id'=>'0');
             return $result;
        }
       }

       protected function updateCreditCardDashboard($data){
        //echo "<pre>";print_r($data);die;
        $user_id = Auth::user()->id;
       $updat_cc = DB::table('creditcard')->where('user_id',$user_id)->update(['is_default'=>'0']);

       $updat_cc = DB::table('creditcard')->where('user_id',$user_id)->where('id',$data['cc_id'])->update(['is_default'=>'1']);

       }
=======
        $card=$this->stripe->cards(Auth::user()->api_customer_id,$req['cardholder_name'],$req['cc_number'],$req['exp_month'],$req['cvn_pin'],$req['exp_year']); 
        $cc_details=array('user_id'=>$user_id,
                       'cardholder_name'=>$req['cardholder_name'],
                       'credit_card_mask'=> $req['cc_number'],
                       'card_type'=> "",
                       'exp_month'=> $req['exp_month'],
                       'exp_year'=> $req['exp_year'],
                       'cvn_pin'=> $req['cvn_pin'],
                       'created_at'=>date('Y-m-d H:i:s'));
        $cc_id=Site_model::insert_get_id('creditcard',$cc_details);
        return $cc_id;
        }
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
}

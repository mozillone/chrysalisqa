<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Creditcard extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'display_name', 'cardholder_name', 'credit_card_mask', 'card_type', 'is_default', 'payment_method_token'
    ];

   protected function createCC($req){
           
        $cc_details=array('user_id'=>$user_id,
                       'cardholder_name'=>$req['cardholder_name'];,
                       'credit_card_mask'=> $req['credit_card_mask'],
                       'created_at'=>date('Y-m-d H:i:s'));
        Site_model::insert_get_id('creditcard',$cc_details);
        return true;
        }
}

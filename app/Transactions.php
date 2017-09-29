<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;


class Transactions extends Authenticatable
{
 
    protected function getTransactionInformation($transaction_id){
        $transaction_info=DB::Select('SELECT trans.id as transaction_id,trans.order_id,concat(usr.first_name," ",usr.last_name) as user_name,concat("$ ",trans.amount) as price,DATE_FORMAT(trans.created_at,"%m/%d/%Y %h:%i %p") as date,CONCAT(UCASE(LEFT(trans.status, 1)), SUBSTRING(trans.status, 2)) as status FROM cc_transactions as trans  LEFT JOIN cc_users as usr on usr.id=trans.user_id where trans.id='.$transaction_id.' ');
        return $transaction_info;

    }
   
}

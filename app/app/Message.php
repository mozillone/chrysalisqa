<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;
use Auth;
use Session;

class Message extends Authenticatable
{
    use Notifiable;

    protected function getallConversationsofuser($id){
    	//echo "<pre>";print_r($id);die;
    	$get_conversations = DB::table('conversations')->where('user_one',$id)->get();
    	foreach ($get_conversations as $con_value) {
    		$get_messages = DB::table('messages')->where('conversation_id',$con_value->id)->get();
    	}
    	return  $get_messages;
    }


}
?>
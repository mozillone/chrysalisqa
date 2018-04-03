<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Config;
use App\Helpers\Site_model;
use Auth;
use App\Helpers\SiteHelper;
use Log;
class Costumes extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'costume_id', 'name', 'sku_no', 'quantity', 'price', 'gender', 'condition', 'sort_order', 'status', 'created_user_group', 'created_by', 'viewed', 'item_location', 'size', 'created_at', 'updated_at'
    ];
    protected function getCategoryInfo($cat_id){
        $data=DB::Select('SELECT *  FROM `cc_category` WHERE category_id="'.$cat_id.'" order by sort_order asc');
        return $data;
        
    }
    protected function getParentCategories($parent_cat_id){
        $data=DB::Select('SELECT *  FROM `cc_category` WHERE status="1" and parent_id="'.$parent_cat_id.'" order by sort_order asc');
        return $data;
        
    }
    protected function costumeLike($costume_id,$user_id){
        $res=DB::Select('SELECT count(id) as count FROM `cc_costumes_like` where user_id='.$user_id.' and costume_id='.$costume_id.'');
        if($res[0]->count=="0"){
            $data=array('user_id'=>$user_id,
                        'costume_id'=>$costume_id,
                        'date_added'=>date('Y-m-d H:i:s'));
            Site_model::insert_data('costumes_like',$data);
        }else{
            $cond=array('user_id'=>$user_id,
                        'costume_id'=>$costume_id);
            Site_model::delete_single('costumes_like',$cond);
        }
        $result=DB::Select('SELECT count(id) as count,if((select count(id) from cc_costumes_like where user_id='.$user_id.' and costume_id='.$costume_id.')>0,true,false) as is_user_like FROM `cc_costumes_like` where costume_id='.$costume_id.'');
        return array('count'=>$result[0]->count,'is_user_like'=>$result[0]->is_user_like);
    }
     protected function costumeFavourite($costume_id,$user_id){
        $res=DB::Select('SELECT count(id) as count FROM `cc_customer_wishlist` where user_id='.$user_id.' and costume_id='.$costume_id.'');
        if($res[0]->count=="0"){
            $data=array('user_id'=>$user_id,
                        'costume_id'=>$costume_id,
                        'date_added'=>date('Y-m-d H:i:s'));
            Site_model::insert_data('customer_wishlist',$data);
        }else{
            $cond=array('user_id'=>$user_id,
                        'costume_id'=>$costume_id);
            Site_model::delete_single('customer_wishlist',$cond);
        }
        $result=DB::Select('select count(id) as is_user_fav from cc_customer_wishlist where user_id='.$user_id.' and costume_id='.$costume_id.'');
        //$fav_count=DB::Select('select count(id) as fav_count from cc_customer_wishlist where user_id='.$user_id.'')[0]->fav_count;
        $fav_count= Wishlist::getMyWishlistCount(Auth::user()->id)[0]->count;
        return array('is_user_fav'=>$result[0]->is_user_fav,'fav_count'=>$fav_count);
    }
    protected function getCostumesList(){
        $costumes_list=DB::Select('SELECT cst.costume_id,dsr.name as cst_name,concat(cst.sku_no,"-",dsr.name) as name,cst.sku_no,cst.price FROM `cc_costumes` as cst LEFT JOIN  cc_costume_description as dsr on dsr.costume_id=cst.costume_id ORDER BY `name` ASC');
        return $costumes_list;
    }
    protected function getCostumeDetails($costume_id){
        if(Auth::check()){
        $is_login=',if((select count(*) from cc_costumes_like as likes where likes.user_id='.Auth::user()->id.' and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id='.Auth::user()->id.'  and  wsh_lst.costume_id=cst.costume_id )>=1,true,false) as is_fav';
        }else{
            //$is_login=',if((select count(*) from cc_costumes_like as likes where likes.user_id=cst.created_by and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id=cst.created_by and  wsh_lst.    costume_id=cst.costume_id )>=1,true,false) as is_fav';
          $is_login = '';
        }
        //dd('SELECT *  FROM `cc_costume_attribute_options` WHERE `costume_id` ='.$costume_id.' AND `attribute_id` = '.Config::get('constants.FAQ_ID').' AND `attribute_option_value_id` = '.Config::get('constants.FAQ_OPTION_VALUE').'');
        $data=DB::Select('SELECT cats.category_id,cats.parent_id,cats.name as cat_name,cats.description,cst.costume_id,cst.weight_pounds,cst.weight_ounces,dsr.name,dsr.description,cst.sku_no,cst.quantity,cst.price,cst.gender,cst.condition,cst.size,cst.created_by,cst.created_user_group,cst.deleted_status,cst.status as cos_act_status '.$is_login.',(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,prom.status as discount_status,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer FROM `cc_costume_to_category` as cat JOIN cc_costumes as cst on cst.costume_id=cat.costume_id JOIN cc_category  as cats on cats.category_id=cat.category_id LEFT JOIN cc_coupon_costumes as cst_cupn on cst_cupn.costume_id=cst.costume_id LEFT JOIN  cc_promotion_coupon as prom on prom.coupon_id=cst_cupn.coupon_id  LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id where cat.costume_id='.$costume_id.' group by cat.costume_id');

        /* Added by Gayatri*/
        $data['est_time'] = DB::table('costume_attribute_options')
                                ->where('costume_attribute_options.attribute_id', '=', 14)
                                ->where('costume_attribute_options.costume_id','=', $costume_id)
                                ->select('attribute_option_value')
                                ->first();
        /* End */
        
        $data['faq']=DB::Select('SELECT *  FROM `cc_costume_attribute_options` WHERE `costume_id` ='.$costume_id.' AND `attribute_id` = '.Config::get('constants.FAQ_ID').' AND `attribute_option_value_id` = '.Config::get('constants.FAQ_OPTION_VALUE').'');
        $data['returns']=DB::Select('SELECT *  FROM `cc_costume_attribute_options` WHERE `costume_id` ='.$costume_id.' AND `attribute_id` = '.Config::get('constants.IS_Returns').'');
        return $data;

    }
    protected function getRandomCategoyCostumesList($cat_id,$parent_id,$iCostumeId){
       $data=DB::Select('SELECT dsr.name,price,img.image,link.url_key,cst.status,cst.deleted_status, cao.attribute_option_value_id as film_qlty FROM `cc_costume_to_category` as cat LEFT JOIN cc_costumes as cst on cst.costume_id=cat.costume_id  LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.type="1"  LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id LEFT JOIN cc_url_rewrites as link on link.url_offset=dsr.costume_id and link.type="product"  LEFT JOIN cc_costume_attribute_options as cao on cst.costume_id=cao.costume_id where cat.category_id='.$cat_id.' and cst.deleted_status=0 AND cao.attribute_id=21 and cst.status="active" and cst.costume_id!='.$iCostumeId.' group by cst.costume_id ORDER BY RAND() LIMIT 10');
       if(count($data)>=10){
        $result=$data;
       }else{
        $result=DB::Select('SELECT dsr.name,price,img.image,link.url_key,cst.status,cst.deleted_status, cao.attribute_option_value_id as film_qlty FROM `cc_costume_to_category` as cat LEFT JOIN cc_costumes as cst on cst.costume_id=cat.costume_id LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.type="1"  LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id LEFT JOIN cc_url_rewrites as link on link.url_offset=dsr.costume_id and link.type="product" LEFT JOIN cc_category as cats on cats.category_id=cat.category_id  LEFT JOIN cc_costume_attribute_options as cao on cst.costume_id=cao.costume_id where cat.category_id='.$cat_id.' and cst.deleted_status=0 and cst.status="active" and cst.costume_id!='.$iCostumeId.' || cats.parent_id='.$parent_id.' and cst.deleted_status=0 AND cao.attribute_id=21 and cst.status="active" and cst.costume_id!='.$iCostumeId.' group by cst.costume_id ORDER BY RAND() LIMIT 10');
       }
      //dd($result);
        return $result;
    }
    protected function getCostumeImages($costume_id){
        $costume_images=DB::Select('SELECT * FROM `cc_costume_image` where costume_id='.$costume_id.' order by type asc');
        return $costume_images;
    }
    protected function costumeSellerInfo($user_id){
        $costumeSellerInfo=DB::Select('select id,display_name,username,email,phone_number from cc_users where id='.$user_id);
        $costumeSellerInfo['shipping_location']=DB::Select('select * from cc_address_master where user_id='.$user_id.' and address_type="selling"');
        return $costumeSellerInfo;
    }
    protected function costumeReport($req){
        $data=array('costume_id'=>$req['costume_id'],
                    'name'=>$req['name'],
                    'phn_no'=>$req['phone'],
                    'email'=>$req['email'],
                    'reason'=>$req['reason'],
                    'created_at'=>date('Y-m-d H:i:s'),
            );
        //echo "<pre>";print_r($data);die;
        $res=Site_model::insert_data('reported_costumes',$data);
        return $res;
    }
    /************* Costume URL Create start here **************/
    protected function urlRewrites($costume_id,$type){
        Log::info('urlRewrites');
        if($type=="update"){
              $cond=array('type'=>'product',
                    'url_offset'=>$costume_id);
              Site_model::delete_single('url_rewrites',$cond);
        }
        $data=$this->getUrlCategoryInfo($costume_id);
        if(!$data){
            return true;
        }else{
            Log::info('in else');
             $costume_name=$this->getCostumeInfo($costume_id);
             $costume_count = $this->getCostumeCount($costume_name);
             if($costume_count>1){
                 $costume_count++;
             }
             if(!$costume_name){
                return true;
             }
        }
        if($data[0]->parent_id!="0"){
            $main_cat=$this->specialCharectorsRemove($data[0]->parent_cat_name);
            $sub_cat=$this->specialCharectorsRemove($data[0]->sub_cat_name);
            $name=$this->specialCharectorsRemove($costume_name);
            $url_key='/'.$main_cat.'/'.$sub_cat.'/'.$name.$costume_count;
        }else{
            $main_cat=$this->specialCharectorsRemove($data[0]->name);
            $name=$this->specialCharectorsRemove($costume_name);
            $url_key='/'.$main_cat.'/'.$name.$costume_count;
        }
        $data=array('type'=>'product',
                    'url_offset'=>$costume_id,
                    'url_key'=> $url_key);
       $url_id =  Site_model::insert_get_id('url_rewrites',$data);
        return $url_id;
    }
    protected function getUrlLinks($id){
        $data=$this->getUrlCategoryInfo($id);
        if($data[0]->parent_id!="0"){
            $main_cat=$this->specialCharectorsRemove($data[0]->parent_cat_name);
            $sub_cat=$this->specialCharectorsRemove($data[0]->sub_cat_name);
            $url_key='/'.$main_cat.'/'.$sub_cat;
        }else{
            $main_cat=$this->specialCharectorsRemove($data[0]->name);
            $url_key='/'.$main_cat;
        }
        return $url_key;
    }

    private function specialCharectorsRemove($string) {
            $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
            $string =str_replace(array('\'', '"'), '', $string); 
            $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
            return strtolower(trim($string, '-'));
    }
    protected function getUrlCategoryId($key_url){
           $data=DB::Select('SELECT  * FROM `cc_url_rewrites` where url_key="'.$key_url.'"');
           return $data;

    }
      private function getUrlCategoryInfo($costume_id){
        $cat_info=DB::Select('SELECT *  FROM `cc_costume_to_category` WHERE `costume_id` ='.$costume_id);
       if(count($cat_info)){
          $data=DB::Select('SELECT  category_id,name,parent_id FROM `cc_category` where category_id='.$cat_info[0]->category_id);
        }else{
            return false;
        }
        if($data[0]->parent_id=="0"){
             return $data;
        }else{
             $res=DB::Select('SELECT cat1.category_id,cat1.name as sub_cat_name,cat2.name as parent_cat_name,cat1.parent_id FROM cc_category as cat1 INNER JOIN cc_category as cat2 on cat2.category_id=cat1.parent_id WHERE cat1.category_id ='.$data[0]->category_id);
             return $res;
        }  
    }
     private function getCostumeInfo($costume_id){
        $costume_info=DB::Select('SELECT name FROM `cc_costume_description` WHERE `costume_id` ='.$costume_id);
         if(count($costume_info)){
            return $costume_info[0]->name;
        }else{
            return false;
        }
      }

    private function getCostumeCount($costume_name){
        $costume_count = DB::table('costume_description')
            ->where('name',$costume_name)
            ->count();
        return $costume_count;
    }


    /* Added by gayatri */
    public static function getCostumesCount($costume_name){
        $costume_count = DB::table('costume_description')
            ->where('name',$costume_name)
            ->count();
        return $costume_count;
    }
    /* End */
    /************* Costume URL Create end here **************/

    /* Added by Gayatri */
    public static function facebookDebugger($url) {

        /*$ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v1.0/?id='. urlencode($url). '&scrape=1');
              curl_setopt($ch,CURLOPT_HEADER, 0)
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false)
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $r = curl_exec($ch);
        return $r;*/

        $auth_header = 'EAAcMdgezwNYBAB96ZBPVzNfQGk5lSlV9mVzIQ0COFpNWcSZC1QqxUsM6Jm5hKXfBRwMJ3dy9xkos9AJlBlLHyCetnX7fZAJvyVEdian6K6TmmyWBzqwHvGe5ItK9nrNuJPWjMFUH7zVZBNUI6h9btuWVUJYJ1zMZD';
        $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v1.0/?scrape=true&id='. urlencode($url).'&access_token='.$auth_header);
              //curl_setopt($ch, CURLOPT_HTTPHEADER, array($auth_header));
              curl_setopt($ch, CURLOPT_HEADER, 0);
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $r = curl_exec($ch);

        $ch = curl_init("https://developers.facebook.com/tools/debug/sharing/?q=".$url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $a = curl_exec($ch);
        curl_close($ch);
//        dd($a);
        return $a;
    }
    /* End */

    /**
     * Added by Gayatri
     */
    public static function createRequestBag($users)
    {
        $get_address_info = DB::table('tmp_address_master')->orderby('address_id','desc')->take(1)->first();

        $get_conversations_info = DB::table('tmp_conversations')->orderby('id','desc')->take(1)->first();

        $get_messages_info = DB::table('tmp_messages')->orderby('id','desc')->take(1)->first();

        $get_request_bags_info = DB::table('tmp_request_bags')->orderby('id','desc')->take(1)->first();

        $insert_address = array(    
                                'fname'        => $get_address_info->fname,
                                'address1'     => $get_address_info->address1,
                                'address2'     => $get_address_info->address2,
                                'city'         => $get_address_info->city,
                                'state'        => $get_address_info->state,
                                'zip_code'     => $get_address_info->zip_code,
                                'phone'        => $get_address_info->phone,
                                'user_id'      => $users,
                                'address_type' => 'request_a_bag',
                                'created_on'   => date('y-m-d H:i:s')
                            );
        $addres_insert = DB::table('address_master')->insertGetId($insert_address);

        $conversation_array = array('type'=>'request_a_bag',
                                    'user_one'=> '1',
                                    'subject'=>'Bag Request Successful',
                                    'user_two'=>$users,
                                    'status'=>'1',
                                    'type_id'=>$get_conversations_info->type_id,
                                    'created_at'=>date('y-m-d H:i:s'));
        $conversation_insert = DB::table('conversations')->insertGetId($conversation_array);

        $theard_array  = array('message'=>'Your bag is being processed',
                                'is_seen'=>'0',
                                'deleted_from_sender'=>'0',
                                'deleted_from_receiver'=>'0',
                                'user_id'=>'1',
                                'user_name'=> User::find(1)->pluck('display_name')->first(),
                                'conversation_id'=> $conversation_insert,
                                'created_at'=>date('y-m-d H:i:s'));
        $theard = DB::table('messages')->insertGetId($theard_array);

        $requestabag_array = array('user_id'=>$users,
                                    'ref_no'=>$get_request_bags_info->ref_no,
                                    'addres_id'=> $addres_insert,
                                    'conversation_id'=> $conversation_insert,
                                    'is_payout'=>$get_request_bags_info->is_payout,
                                    'is_return'=>$get_request_bags_info->is_return,
                                    'is_recycle'=>$get_request_bags_info->is_recycle,
                                    'status'=>'requested',
                                    'cus_name'=>$get_request_bags_info->cus_name,
                                    'cus_email'=>$get_request_bags_info->cus_email,
                                    'cus_phone'=>$get_request_bags_info->cus_phone,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                );
        $requestabag_insert = DB::table('request_bags')->insertGetId($requestabag_array);

        $user_info = DB::table('users')->where('id',$users)->first();

        /* Delete the tmp data in  */
        DB::table('tmp_address_master')->where('address_id', $get_address_info->address_id)->delete();
        DB::table('tmp_conversations')->where('id', $get_conversations_info->id)->delete();
        DB::table('tmp_messages')->where('id', $get_messages_info->id)->delete();
        DB::table('tmp_request_bags')->where('id', $get_request_bags_info->id)->delete();

        // send mail to admin
        $bag_url_admin      = '/process-bag/'.$requestabag_insert;
        $req_subject        = "REQUEST A BAG";
        $req_data           = array('cus_name'=>$get_request_bags_info->cus_name,'bag_url'=>$bag_url_admin);
        $template           = 'emails.reqabag_requestfromuser';
        $req_to             = "support@chrysaliscostumes.com";
        $mail_status        = SiteHelper::sendmail($req_to,$req_subject,$template,$req_data);

        // send mail to user
        $req_subject        = "REQUEST A BAG";
        $req_data           = array('cus_name'=>$get_request_bags_info->cus_name,'username'=>$user_info->username);
        $template           = 'emails.reqabag_requestfromuser';
        $req_to             = $user_info->email;
        $mail_status        = SiteHelper::sendmail($req_to,$req_subject,$template,$req_data);
        
    }
}

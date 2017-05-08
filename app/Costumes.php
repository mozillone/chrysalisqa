<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Config;
use App\Helpers\Site_model;

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
        $data=DB::Select('SELECT *  FROM `cc_category` WHERE category_id="'.$cat_id.'"');
        return $data;
        
    }
    protected function getParentCategories($parent_cat_id){
        $data=DB::Select('SELECT *  FROM `cc_category` WHERE parent_id="'.$parent_cat_id.'"');
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
        $fav_count=DB::Select('select count(id) as fav_count from cc_customer_wishlist where user_id='.$user_id.'')[0]->fav_count;

        return array('is_user_fav'=>$result[0]->is_user_fav,'fav_count'=>$fav_count);
    }
    protected function getCostumesList(){
        $costumes_list=DB::Select('SELECT cst.costume_id,dsr.name as cst_name,concat(cst.sku_no,"-",dsr.name) as name,cst.sku_no,cst.price FROM `cc_costumes` as cst LEFT JOIN  cc_costume_description as dsr on dsr.costume_id=cst.costume_id ORDER BY `name` ASC');
        return $costumes_list;
    }
    protected function getCostumeDetails($costume_id){
        $data=DB::Select('SELECT cats.category_id,cats.name as cat_name,cats.description,cst.costume_id,dsr.name,dsr.description,cst.sku_no,cst.quantity,cst.price,cst.gender,cst.condition,cst.size,cst.created_by,cst.created_user_group ,if((select count(*) from cc_costumes_like as likes where likes.user_id=cst.created_by and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id=cst.created_by and  wsh_lst.    costume_id=cst.costume_id )>=1,true,false) as is_fav,(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer FROM `cc_costume_to_category` as cat JOIN cc_costumes as cst on cst.costume_id=cat.costume_id JOIN cc_category  as cats on cats.category_id=cat.category_id LEFT JOIN cc_coupon_costumes as cst_cupn on cst_cupn.costume_id=cst.costume_id LEFT JOIN  cc_promotion_coupon as prom on prom.coupon_id=cst_cupn.coupon_id  LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id where cat.costume_id='.$costume_id.' group by cat.costume_id');
        $data['faq']=DB::Select('SELECT *  FROM `cc_costume_attribute_options` WHERE `costume_id` ='.$costume_id.' AND `attribute_id` = '.Config::get('constants.FAQ_ID').' AND `attribute_option_value_id` = '.Config::get('constants.FAQ_OPTION_VALUE').'');
        return $data;

    }
    protected function getRandomCategoyCostumesList($cat_id){
       $data=DB::Select('SELECT dsr.name,price,img.image,link.url_key FROM `cc_costume_to_category` as cat LEFT JOIN cc_costumes as cst on cst.costume_id=cat.costume_id LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.type="1"  LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id LEFT JOIN cc_url_rewrites as link on link.url_offset=dsr.costume_id and link.type="product" where cat.category_id='.$cat_id.' ORDER BY RAND() LIMIT 10');
        return $data;
    }
    protected function getCostumeImages($costume_id){
        $costume_images=DB::Select('SELECT * FROM `cc_costume_image` where costume_id='.$costume_id);
        return $costume_images;
    }
    protected function costumeSellerInfo($user_id){
        $costumeSellerInfo=DB::Select('select display_name,email,phone_number from cc_users where id='.$user_id);
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
        $res=Site_model::insert_data('reported_costumes',$data);
        return $res;
    }
    /************* Costume URL Create start here **************/
    protected function urlRewrites($costume_id,$type){
        if($type=="update"){
              $cond=array('type'=>'product',
                    'url_offset'=>$costume_id);
              Site_model::delete_single('url_rewrites',$cond);
        }
        $data=$this->getUrlCategoryInfo($costume_id);
        if(!$data){
            return true;
        }else{
             $costume_name=$this->getCostumeInfo($costume_id);
             if(!$costume_name){
                return true;
             }
        }
        if($data[0]->parent_id!="0"){
            $main_cat=$this->specialCharectorsRemove($data[0]->parent_cat_name);
            $sub_cat=$this->specialCharectorsRemove($data[0]->sub_cat_name);
            $name=$this->specialCharectorsRemove($costume_name);
            $url_key='/'.$main_cat.'/'.$sub_cat.'/'.$name;
        }else{
            $main_cat=$this->specialCharectorsRemove($data[0]->name);
            $name=$this->specialCharectorsRemove($costume_name);
            $url_key='/'.$main_cat.'/'.$name;
        }
        $data=array('type'=>'product',
                    'url_offset'=>$costume_id,
                    'url_key'=> $url_key);
        Site_model::insert_data('url_rewrites',$data);
        return true;
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
    /************* Costume URL Create end here **************/

}

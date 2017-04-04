<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
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
        return array('is_user_fav'=>$result[0]->is_user_fav);
    }

}

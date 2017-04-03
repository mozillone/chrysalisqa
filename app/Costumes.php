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
        $res=DB::Select('SELECT count(id) as count FROM `cc_costumes_like` where useer_id='.$user_id.' and costume_id='.$costume_id.'');
        if(count($res[0]->count)==0){
            $data=array('user_id'=>$user_id,
                        'costume_id'=>$costume_id,
                        'date_added'=>date('Y-m-d H:i:s'));
            Site_model::insert_data('costumes_like',$data);
        }else{
            $cond=array('user_id'=>$user_id,
                        'costume_id'=>$costume_id);
            Site_model::delete_single('costumes_like',$cond);
        }
        return true;
    }

}

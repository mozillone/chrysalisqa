<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

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
    protected function getCostumesList(){
        
    }
}

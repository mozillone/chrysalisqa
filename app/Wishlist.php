<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;

class Wishlist extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'id', 'user_id', 'costume_id', 'date_added'
    ];
    protected function getMyWishlistCount($user_id){
          $res=DB::Select('select count(id) as count from cc_customer_wishlist where user_id='.$user_id);
          return $res;
    }
    protected function myWishlistList($user_id){
        $wish_list=DB::Select('SELECT  cst.costume_id,cst.name,CONCAT("$",FORMAT(cst.price,2)) as price,if((select count(*) from cc_costumes_like as likes where likes.user_id=cst.created_by and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id=cst.created_by and  wsh_lst.  costume_id=cst.costume_id )>=1,true,false) as is_fav,(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,img.image,cat.name as cat_name,(select name from cc_category where category_id=cat.parent_id) as parent_cat_name FROM `cc_customer_wishlist` as wish LEFT JOIN cc_costumes as cst on cst.costume_id=wish.costume_id  LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.sort_order="0" LEFT JOIN cc_costume_to_category as cats on cats.costume_id=cst.costume_id  LEFT JOIN cc_category as cat on cats.category_id=cat.category_id where wish.user_id='.$user_id.'');
       
        return $wish_list;
    }
    protected function removeWishlistCostume($user_id,$costume_id){
            $cond=array('user_id'=>$user_id,
                        'costume_id'=>$costume_id);
            $res=Site_model::delete_single('customer_wishlist',$cond);
            return $res;

    }
   

}

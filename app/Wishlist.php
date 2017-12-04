<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;
use Auth;

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
          $res=DB::Select('select count(id) as count from cc_customer_wishlist as cw, cc_costumes as co where co.costume_id=cw.costume_id and co.deleted_status = 0 and user_id='.$user_id);
          return $res;
    }
    protected function myWishlistList($user_id){
        //echo $user_id; exit;
        $wish_list=DB::Select('SELECT  cst.costume_id,cst.gender,cst.size,dsr.name,CONCAT("$",FORMAT(cst.price,2)) as price,if((select count(*) from cc_costumes_like as likes where likes.user_id='.Auth::user()->id.' and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id='.Auth::user()->id.' and  wsh_lst.  costume_id=cst.costume_id )>=1,true,false) as is_fav,(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,img.image,link.url_key,cst.quantity FROM `cc_customer_wishlist` as wish LEFT JOIN cc_costumes as cst on cst.costume_id=wish.costume_id  LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.type="1"  LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id and link.type="product" where cst.deleted_status=0 and wish.user_id='.$user_id.' group by cst.costume_id');
       // echo "<pre>"; print_r($wish_list); exit;
        return $wish_list;
    }
    protected function removeWishlistCostume($user_id,$costume_id){
            $cond=array('user_id'=>$user_id,
                        'costume_id'=>$costume_id);
            $res=Site_model::delete_single('customer_wishlist',$cond);
            return $res;

    }
   

}

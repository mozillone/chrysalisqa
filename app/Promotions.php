<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;

class Promotions extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'coupon_id', 'name', 'code','type','discount','date_start','date_end','uses_total','uses_customer','status','created_at'
    ];
    protected function createPromotions($req){
            $data=array('name'=>$req['name'],
                        'code'=>$req['code'],
                        'type'=>$req['type'],
                        'discount'=>$req['discount'],
                        'date_start'=>date('y-m-d',strtotime($req['date_start'])),
                        'date_end'=>date('y-m-d',strtotime($req['date_end'])),
                        'uses_total'=>$req['uses_total']
                        );
            $coupon_id=$this->insertPromotionsInfo($data);
            if(!empty($req['cats'])){
                 $this->insertCouponCategories($req['cats'],$coupon_id);
            }
            if(!empty($req['costumes'])){
                $this->insertCouponCostumes($req['costumes'],$coupon_id);
            }
            return true;

    }
    private function insertPromotionsInfo($data){
        $coupon_id=Site_model::insert_get_id('promotion_coupon',$data);
        return $coupon_id;
    }
    private function insertCouponCategories($cats,$coupon_id){
        foreach ($cats as $key => $category_id) {
            $data=array('coupon_id'=>$coupon_id,'category_id'=>$category_id);
            $coupon_id=Site_model::insert_data('coupon_category',$data);
        }
        return true;
    }
    private function insertCouponCostumes($costumes,$coupon_id){
        foreach ($costumes as $key => $costume_id) {
            $data=array('coupon_id'=>$coupon_id,'costume_id'=>$costume_id);
            $coupon_id=Site_model::insert_data('coupon_costumes',$data);
        }
        return true;
    }
    protected function getSelectedCategories($cat_id){
        $data=DB::Select('SELECT  category_id,name,parent_id FROM `cc_category` where category_id='.$cat_id);
        if($data[0]->parent_id=="0"){
            $res=DB::Select('SELECT cat1.category_id,cat1.parent_id,cat2.name as parent_cat,cat1.name as sub_cat  FROM cc_category as cat1 INNER JOIN cc_category as cat2 on cat2.category_id=cat1.parent_id where cat1.parent_id='.$data[0]->category_id);
        }else{
            $res=DB::Select('SELECT cat1.category_id,cat1.parent_id,cat2.name as parent_cat,cat1.name as sub_cat  FROM cc_category as cat1 INNER JOIN cc_category as cat2 on cat2.category_id=cat1.parent_id where cat1.category_id='.$data[0]->category_id);
        }
          return $res;
    }
    protected function getPromotionInfo($coupon_id){
        $data['basic']=DB::Select('SELECT prom.coupon_id, prom.name, prom.code, prom.type, prom.discount, DATE_FORMAT(prom.date_start,"%m/%d/%Y %h:%i %p") as datestart,DATE_FORMAT(prom.date_end,"%m/%d/%Y %h:%i %p") as dateend , prom.uses_total,prom.status FROM cc_promotion_coupon as prom where coupon_id='.$coupon_id);
        $data['promo_costumes']=DB::Select('SELECT * FROM `cc_coupon_costumes` where coupon_id='.$coupon_id);
        $data['promo_cats']=DB::Select('SELECT * FROM `cc_coupon_category` where coupon_id='.$coupon_id);
        return $data;
    }
   

}

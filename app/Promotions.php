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
                        'status'=>"1",
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
     protected function updatePromotions($req){
           $data=array('name'=>$req['name'],
                        'code'=>$req['code'],
                        'type'=>$req['type'],
                        'discount'=>$req['discount'],
                        'date_start'=>date('y-m-d',strtotime($req['date_start'])),
                        'date_end'=>date('y-m-d',strtotime($req['date_end'])),
                        'uses_total'=>$req['uses_total']
                        );
            $this->updatePromotionsInfo($data,$req['coupon_id']);
            if(!empty($req['cats'])){
                 $this->updateCouponCategories($req['cats'],$req['coupon_id']);
            }else{
                $cond=array('coupon_id'=>$req['coupon_id']);
                Site_model::delete_single('coupon_category',$cond);

                $cond=array('coupon_id'=>$req['coupon_id']);
                Site_model::delete_single('coupon_costumes',$cond);
            }
            if(!empty($req['costumes'])){
                $this->updateCouponCostumes($req['costumes'],$req['coupon_id']);
            }else{
                $cond=array('coupon_id'=>$req['coupon_id']);
                Site_model::delete_single('coupon_costumes',$cond);
            }
            return true;
    }
    private function insertPromotionsInfo($data){
        $coupon_id=Site_model::insert_get_id('promotion_coupon',$data);
        return $coupon_id;
    }
    private function updatePromotionsInfo($data,$coupon_id){
        $coupon_id=Site_model::update_data('promotion_coupon',$data,array('coupon_id'=>$coupon_id));
        return $coupon_id;
    }
    private function insertCouponCategories($cats,$coupon_id){
       foreach ($cats as $key => $category_id) {
            $data=array('coupon_id'=>$coupon_id,'category_id'=>$category_id);
            Site_model::insert_data('coupon_category',$data);
            $costumes_list=$this->getCostumesByCategory($category_id);
            foreach($costumes_list as $cst){
               $data=array('coupon_id'=>$coupon_id,'costume_id'=>$cst->costume_id);
               Site_model::insert_data('coupon_costumes',$data);
            }
        }
        return true;
    }
    private function updateCouponCategories($cats,$coupon_id){
        $cond=array('coupon_id'=>$coupon_id);
        Site_model::delete_single('coupon_category',$cond);

        $cond=array('coupon_id'=>$coupon_id);
        Site_model::delete_single('coupon_costumes',$cond);
 
        foreach ($cats as $key => $category_id) {
            $data=array('coupon_id'=>$coupon_id,'category_id'=>$category_id);
            Site_model::insert_data('coupon_category',$data);
            $costumes_list=$this->getCostumesByCategory($category_id);
            foreach($costumes_list as $cst){
               $data=array('coupon_id'=>$coupon_id,'costume_id'=>$cst->costume_id);
               Site_model::insert_data('coupon_costumes',$data);
            }
        }
        return true;
    }
    private function insertCouponCostumes($costumes,$coupon_id){
        foreach ($costumes as $key => $costume_id) {
            $data=array('coupon_id'=>$coupon_id,'costume_id'=>$costume_id);
            Site_model::insert_data('coupon_costumes',$data);
        }
        return true;
    }
    private function updateCouponCostumes($costumes,$coupon_id){
        $cond=array('coupon_id'=>$coupon_id);
        Site_model::delete_single('coupon_costumes',$cond);
         foreach ($costumes as $key => $costume_id) {
            $data=array('coupon_id'=>$coupon_id,'costume_id'=>$costume_id);
            Site_model::insert_data('coupon_costumes',$data);
        }
        return true;
    }
   private function getCostumesByCategory($cat_id){
        $res=DB::Select('SELECT * FROM `cc_costume_to_category` where category_id='.$cat_id);
        return $res;
   }
    protected function getSelectedCategories($cat_id){
        if($cat_id=="all"){
            $where='Where 1'; 
             $res=DB::Select('SELECT cat1.category_id,cat1.parent_id,cat2.name as parent_cat,cat1.name as sub_cat  FROM cc_category as cat1 INNER JOIN cc_category as cat2 on cat2.category_id=cat1.parent_id');
        }else{
            $where='where category_id='.$cat_id;
            $data=DB::Select('SELECT  category_id,name,parent_id FROM `cc_category` '.$where.'');
            if($data[0]->parent_id=="0"){
                $res=DB::Select('SELECT cat1.category_id,cat1.parent_id,cat2.name as parent_cat,cat1.name as sub_cat  FROM cc_category as cat1 INNER JOIN cc_category as cat2 on cat2.category_id=cat1.parent_id where cat1.parent_id='.$data[0]->category_id);
            }else{
                $res=DB::Select('SELECT cat1.category_id,cat1.parent_id,cat2.name as parent_cat,cat1.name as sub_cat  FROM cc_category as cat1 INNER JOIN cc_category as cat2 on cat2.category_id=cat1.parent_id where cat1.category_id='.$data[0]->category_id);
            } 
        }

          return $res;
    }
    protected function getPromotionInfo($coupon_id){
        $data['basic']=DB::Select('SELECT prom.coupon_id, prom.name, prom.code, prom.type, prom.discount, DATE_FORMAT(prom.date_start,"%m/%d/%Y %h:%i %p") as datestart,DATE_FORMAT(prom.date_end,"%m/%d/%Y %h:%i %p") as dateend , prom.uses_total,prom.status FROM cc_promotion_coupon as prom where coupon_id='.$coupon_id);
        $data['promo_costumes']=DB::Select('SELECT cst.costume_id,dsr.name,cst.sku_no FROM `cc_coupon_costumes` as cupn LEFT JOIN cc_costumes as cst on cst.costume_id=cupn.costume_id LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id where cupn.coupon_id='.$coupon_id.' group by cst.costume_id');
        $data['promo_cats']=DB::Select('SELECT cat1.category_id,cat1.parent_id,cat2.name as parent_cat,cat1.name as sub_cat  FROM cc_category as cat1 INNER JOIN cc_category as cat2 on cat2.category_id=cat1.parent_id LEFT JOIN cc_coupon_category as cupn on cupn.category_id=cat1.category_id where  cupn.coupon_id='.$coupon_id);
        return $data;
    }
   protected function verifyCoupanCode($code){
       $res=DB::Select('SELECT if(count(*)>=1,true,false) as is_exists,coupon_id  FROM `cc_promotion_coupon` WHERE code="'.$code.'" and DATE(NOW()) between date_start and date_end and status="1"'); 
       return $res;

   }
 

}

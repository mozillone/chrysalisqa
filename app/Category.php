<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;

class Category extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'category_id', 'name', 'parent_id', 'description','thumb_image', 'banner_image', 'sort_order', 'status', 'created_at', 'updated_at'
    ];
    protected function createCategory($req){
        if(!empty($req['parent_id'])){$parent_id=$req['parent_id'];}else{$parent_id="0";}

        $cat_image_path=public_path('category_images/Normal');
        $cat_banner_image=public_path('category_images/Banner');
      
        $cat_file_name=$this->fileUploading($cat_image_path,$req['cat_image']);
        $banner_file_name=$this->fileUploading($cat_banner_image,$req['banner_image']);
        
        $category=array('name'=>$req['name'],
                        'description'=>$req['desc'],
                       'parent_id'=>$parent_id,
                       'thumb_image'=>$cat_file_name,
                       'banner_image'=> $banner_file_name,
                       'status'=>"1",
                       'created_at'=>date('Y-m-d H:i:s'));
        $cat_id=Site_model::insert_get_id('category',$category);
        if(isset($req['costume_list']) && $parent_id!="0"){
            foreach($req['costume_list'] as $key=>$value){
                $category_coustume=array('costume_id'=>$value,
                       'category_id'=>$cat_id,
                       'sort_no'=>$key,
                       );
               Site_model::insert_get_id('costume_to_category',$category_coustume);
            }
          return true;
        }
    }
    public static function fileUploading($destinationPath,$file)
    {
        $file_name = $file->getClientOriginalName();
        $extension       = $file->getClientOriginalExtension() ?: 'png';
        $safeName        = str_random(10).'.'.$extension;
        $file->move($destinationPath,$safeName);
        return $safeName ;
    }
    protected function getParentCategories(){
        $parent_cats=DB::Select('SELECT *  FROM `cc_category` WHERE `parent_id` = 0');
        return $parent_cats;
    }
    protected function getCategories(){
        $cats_list=DB::Select('SELECT *  FROM `cc_category`');
        return $cats_list;
    }
    protected function getCatCostumesList($cat_id){
        $costumes_list=DB::Select('SELECT cst.costume_id,cst.name as cst_name,concat(cst.sku_no,"-",cst.name) as name,cst.sku_no,cst.price FROM `cc_costume_to_category` as cat LEFT JOIN cc_costumes as cst on cat.costume_id=cst.costume_id where cat.category_id='.$cat_id);
        return $costumes_list;
    }
     protected function updateCategory($req){
        if(!empty($req['parent_id'])){$parent_id=$req['parent_id'];}else{$parent_id="0";}
        if(isset($req['cat_image']) && !isset($req['banner_image'])){
            $cat_image_path=public_path('category_images/Normal');
            $cat_file_name=$this->fileUploading($cat_image_path,$req['cat_image']);
            $category=array('name'=>$req['name'],
                            'description'=>$req['desc'],
                            'parent_id'=>$parent_id,
                            'thumb_image'=>$cat_file_name,
                            'updated_at'=>date('Y-m-d H:i:s'));
        }
        else if(isset($req['banner_image']) && !isset($req['cat_image'])){
            $cat_banner_image=public_path('category_images/Banner');
            $banner_file_name=$this->fileUploading($cat_banner_image,$req['banner_image']);
            $category=array('name'=>$req['name'],
                        'description'=>$req['desc'],
                        'parent_id'=>$parent_id,
                        'banner_image'=> $banner_file_name,
                        'updated_at'=>date('Y-m-d H:i:s'));
        }
        else if(isset($req['banner_image']) && !isset($req['cat_image'])){
            $cat_image_path=public_path('category_images/Normal');
            $cat_file_name=$this->fileUploading($cat_image_path,$req['cat_image']);
            
            $cat_banner_image=public_path('category_images/Banner');
            $banner_file_name=$this->fileUploading($cat_banner_image,$req['banner_image']);
            $category=array('name'=>$req['name'],
                        'description'=>$req['desc'],
                        'parent_id'=>$parent_id,
                        'thumb_image'=>$cat_file_name,
                        'banner_image'=> $banner_file_name,
                        'updated_at'=>date('Y-m-d H:i:s'));
        }else{
            $category=array('name'=>$req['name'],
                        'description'=>$req['desc'],
                        'parent_id'=>$parent_id,
                        'updated_at'=>date('Y-m-d H:i:s'));
         }
       
        
        $cond=array('category_id'=>$req['category_id']);
        Site_model::update_data('category',$category,$cond);
        if(isset($req['costume_list']) && $parent_id!="0"){
            Site_model::delete_single('costume_to_category',$cond);
            foreach($req['costume_list'] as $key=>$value){
                $category_coustume=array('costume_id'=>$value,
                       'category_id'=>$req['category_id'],
                       'sort_no'=>$key,
                       );
               Site_model::insert_get_id('costume_to_category',$category_coustume);
            }
          return true;
        }
    }
    

}

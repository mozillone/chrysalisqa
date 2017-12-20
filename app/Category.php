<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;
use App\Costumes;
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
        $this->urlRewrites($cat_id,"insert");


        if($parent_id != "0"){
            $attribute_subcat_id = "";
            if($parent_id == 147){
              $attribute_subcat_id = 25;
            }elseif ($parent_id == 143) {
              $attribute_subcat_id = 26;
            }elseif ($parent_id == 78) {
              $attribute_subcat_id = 28;
            }
            $attr_arr=array(
                'attribute_id'=>$attribute_subcat_id,
                'option_value'=> $req['name'],
            );

            $isAttrExist = DB::table('attribute_options')->where('option_value', $req['name'])->first();
            if(!$isAttrExist){
              $cosplay_yes_insert=DB::table('attribute_options')->insert($attr_arr);
            }
        }

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
    protected function getCategoryInfo($cat_id){
       $data=DB::Select('SELECT  category_id,name,parent_id FROM `cc_category` where category_id='.$cat_id);
        if($data[0]->parent_id=="0"){
            $res=DB::Select('SELECT GROUP_CONCAT(DISTINCT(cat1.category_id) SEPARATOR ",") as cat_id FROM cc_category as cat1  where cat1.parent_id='.$data[0]->category_id);
             return $res;
        }else{
             return 0;
        }
    }
    
    private function urlRewrites($id,$type,$old_name='',$new_name='',$product_added=''){
      //echo "string"; exit;
        if($type == "update"){
              $cond=array('type'=>'category',
                    'url_offset'=>$id);
              Site_model::delete_single('url_rewrites',$cond);
        }
        $data=$this->getUrlCategoryInfo($id);
        if($data[0]->parent_id!="0"){
            $main_cat=$this->specialCharectorsRemove($data[0]->parent_cat_name);
            $sub_cat=$this->specialCharectorsRemove($data[0]->sub_cat_name);
            $url_key='/'.$main_cat;
            /*$data=array('type'=>'category',
                    'url_offset'=>$id,
                    'url_key'=> $url_key);
            
            Site_model::insert_data('url_rewrites',$data);*/
            /* Addeed by Gayatri */
            if(($old_name != $new_name) || $product_added !=""){
              
              $taged_costumes = DB::table('costume_to_category')->where('category_id', $id)->get();
              
              $sub_cat_url_name = $this->specialCharectorsRemove($data[0]->sub_cat_name);
              
              foreach ($taged_costumes as $key => $cos_to_cat) {
                $cos_name = DB::table('costume_description')->where('costume_id',$cos_to_cat->costume_id)->select('name')->first();
                $costume_count = Costumes::getCostumesCount($cos_name->name);
                if($costume_count>1){
                  $costume_count++;
                }
                $costume_url_name = $this->specialCharectorsRemove($cos_name->name);
                $product_url = $url_key."/".$sub_cat_url_name."/".$costume_url_name.$costume_count;

                $data = array('type'=>'product',
                              'url_offset'=>$cos_to_cat->costume_id,
                              'url_key'=> $product_url
                            );
                //echo"<pre>";print_r($data);
                Site_model::insert_data('url_rewrites',$data);
              }
              $data = array('type'=>'category',
                              'url_offset'=>$id,
                              'url_key'=> $url_key."/".$sub_cat_url_name
                            );
              //echo"<pre>";print_r($data);
              //exit;
              Site_model::insert_data('url_rewrites',$data);
            }
            if($old_name == ''){
            	$main_cat=$this->specialCharectorsRemove($data[0]->parent_cat_name);
	            $sub_cat=$this->specialCharectorsRemove($data[0]->sub_cat_name);
	            $url_key='/'.$main_cat.'/'.$sub_cat;
            	$data=array('type'=>'category',
                    'url_offset'=>$id,
                    'url_key'=> $url_key);
            
            	Site_model::insert_data('url_rewrites',$data);
            }
            /* END */
        }else{
          //echo "string"; exit;
            $main_cat=$this->specialCharectorsRemove($data[0]->name);
            $url_key='/'.$main_cat;
            /* Added by Gayatri */
            if($old_name != $new_name || $product_added !=""){

              $sub_cat = Costumes::getParentCategories($id);
              foreach ($sub_cat as $key => $child_cat) {
                
                $taged_costumes = DB::table('costume_to_category')->where('category_id', $child_cat->category_id)->get();
                $sub_cat_url_name = $this->specialCharectorsRemove($child_cat->name);

                foreach ($taged_costumes as $key => $cos_to_cat) {
                  $cos_name = DB::table('costume_description')->where('costume_id',$cos_to_cat->costume_id)->select('name')->first();
                  $costume_count = Costumes::getCostumesCount($cos_name->name);
                  if($costume_count>1){
                    $costume_count++;
                  }
                  $costume_url_name = $this->specialCharectorsRemove($cos_name->name);
                  $product_url = $url_key."/".$sub_cat_url_name."/".$costume_url_name.$costume_count;

                  $data = array('type'=>'product',
                                'url_offset'=>$cos_to_cat->costume_id,
                                'url_key'=> $product_url
                              );
                  //echo "<pre>"; print_r($data);
                  Site_model::insert_data('url_rewrites',$data);
                }
                $data = array('type'=>'category',
                                'url_offset'=>$child_cat->category_id,
                                'url_key'=> $url_key."/".$sub_cat_url_name
                              );
                //echo "<pre>"; print_r($data);
                Site_model::insert_data('url_rewrites',$data);
              }
              $data = array('type'=>'category',
                            'url_offset'=>$id,
                            'url_key'=> $url_key
                          );
              //echo "<pre>"; print_r($data); exit;
              Site_model::insert_data('url_rewrites',$data);

              return true;
            }
            if($old_name == ''){
            	$data=array('type'=>'category',
                    'url_offset'=>$id,
                    'url_key'=> $url_key);
            
            	Site_model::insert_data('url_rewrites',$data);
            }
            /* End */
        }
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



    protected function getUrlLinksMulti($ids){

      $data=$this->getUrlCategoryInfoMulti($ids);

      foreach($data as $data_res){

        if($data_res->parent_id !="0"){
            $main_cat=$this->specialCharectorsRemove($data_res->parent_cat_name);
            $sub_cat=$this->specialCharectorsRemove($data_res->sub_cat_name);
            $url_keys[$data_res->category_id] ='/'.$main_cat.'/'.$sub_cat;
        }else{
            $main_cat=$this->specialCharectorsRemove($data_res->sub_cat_name);
            $url_keys[$data_res->category_id] ='/'.$main_cat;
        }
        
      }
      return $url_keys;
    }

    private function getUrlCategoryInfoMulti($cat_ids){
      
        $res=DB::Select('SELECT cat1.category_id,cat1.name as sub_cat_name,cat2.name as parent_cat_name,cat1.parent_id FROM cc_category as cat1 LEFT JOIN cc_category as cat2 on cat2.category_id=cat1.parent_id WHERE cat1.category_id  IN ('.$cat_ids.')');
       
         return $res;
    }


     protected function getCategoriesCostumes($cat_id){
       $costumes=DB::Select('SELECT name FROM `cc_costume_to_category` as cats LEFT JOIN cc_costume_description as cst on cst.costume_id=cats.costume_id where cats.category_id='.$cat_id);
        return $costumes;
    }

    private function getUrlCategoryInfo($cat_id){
        $data=DB::Select('SELECT  category_id,name,parent_id FROM `cc_category` where category_id='.$cat_id);
    //	dd($data);
        if($data[0]->parent_id=="0"){
             return $data;
        }else{
        	

             $res=DB::Select('SELECT cat1.category_id,cat1.name as sub_cat_name,cat2.name as parent_cat_name,cat1.parent_id FROM cc_category as cat1 INNER JOIN cc_category as cat2 on cat2.category_id=cat1.parent_id WHERE cat1.category_id ='.$data[0]->category_id);
//dd($res);
             return $res;
            
      }  
    }
    protected function getCatCostumesList($cat_id){
        $costumes_list=DB::Select('SELECT cst.costume_id,dsr.name as cst_name,concat(cst.sku_no,"-",dsr.name) as name,cst.sku_no,cst.price FROM `cc_costume_to_category` as cat LEFT JOIN cc_costumes as cst on cat.costume_id=cst.costume_id  LEFT JOIN  cc_costume_description as dsr on dsr.costume_id=cst.costume_id where cat.category_id='.$cat_id);
        return $costumes_list;
    }
     protected function updateCategory($req){
      //echo "<pre>"; print_r($req); exit;
        if(!empty($req['parent_id'])){
          $parent_id = $req['parent_id'];
        }else{
          $parent_id="0";
        }
        if(isset($req['cat_image']) && !isset($req['banner_image'])){
            $cat_image_path=public_path('category_images/Normal');
            $sort = $req['sort'];
            $cat_file_name=$this->fileUploading($cat_image_path,$req['cat_image']);
            $category=array('name'=>$req['name'],
                            'description'=>$req['desc'],
                            'parent_id'=>$parent_id,
                            'thumb_image'=>$cat_file_name,
                            'sort_order' => $sort,
                            'updated_at'=>date('Y-m-d H:i:s'));
            
        }
        else if(isset($req['banner_image']) && !isset($req['cat_image'])){
            $cat_banner_image=public_path('category_images/Banner');
            $banner_file_name=$this->fileUploading($cat_banner_image,$req['banner_image']);
             $sort = $req['sort'];
            $category=array('name'=>$req['name'],
                        'description'=>$req['desc'],
                        'parent_id'=>$parent_id,
                        'banner_image'=> $banner_file_name,
                        'sort_order' => $sort,
                        'updated_at'=>date('Y-m-d H:i:s'));
        }
        else if(isset($req['banner_image']) && isset($req['cat_image'])){
            $cat_image_path=public_path('category_images/Normal');
            $cat_file_name=$this->fileUploading($cat_image_path,$req['cat_image']);
             $sort = $req['sort'];
            $cat_banner_image=public_path('category_images/Banner');
            $banner_file_name=$this->fileUploading($cat_banner_image,$req['banner_image']);
            $category=array('name'=>$req['name'],
                        'description'=>$req['desc'],
                        'parent_id'=>$parent_id,
                        'thumb_image'=>$cat_file_name,
                        'banner_image'=> $banner_file_name,
                        'sort_order' => $sort,
                        'updated_at'=>date('Y-m-d H:i:s'));
        }else{
            $category=array('name'=>$req['name'],
                        'description'=>$req['desc'],
                        'parent_id'=>$parent_id,
                        'sort_order' => $req['sort'],
                        'updated_at'=>date('Y-m-d H:i:s'));
         }
        
        
        if($parent_id != "0"){
            $attribute_subcat_id = "";
            if($parent_id == 147){
              $attribute_subcat_id = 25;
            }elseif ($parent_id == 143) {
              $attribute_subcat_id = 26;
            }elseif ($parent_id == 78) {
              $attribute_subcat_id = 28;
            }
            $attr_arr=array(
                'attribute_id'=>$attribute_subcat_id,
                'option_value'=> $req['name'],
            );

            $isAttrExist = DB::table('attribute_options')->where('option_value', $req['name'])->first();
            if(!$isAttrExist){
              $cosplay_yes_insert=DB::table('attribute_options')->insert($attr_arr);
            }
        } 
        
        $cond = array('category_id'=>$req['category_id']);
        Site_model::update_data('category',$category,$cond);
        
        if(isset($req['costume_list']) && $parent_id!="0"){
          Site_model::delete_single('costume_to_category',$cond);
          foreach(array_unique($req['costume_list']) as $key=>$value){
            DB::table('costume_to_category')
                ->where('costume_id', $value)
                ->where('category_id', '!=', $req['category_id'])
                ->delete();
            $category_coustume=array('costume_id'=>$value,
                   'category_id'=>$req['category_id'],
                   'sort_no'=>$key,
                   );
            Site_model::insert_get_id('costume_to_category',$category_coustume);
          }
        }
        $this->urlRewrites($req['category_id'],"update",$req['old_category'],$req['name'],$req['elements_change']);
          return true;
    }
    private function specialCharectorsRemove($string) {
            $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
            $string =str_replace(array('\'', '"'), '', $string); 
            $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
            return strtolower(trim($string, '-'));
    }
    protected function getUrlCategoryId($key_url){
    	//dd($key_url);
           $data=DB::Select('SELECT  * FROM `cc_url_rewrites` where url_key="'.$key_url.'"');
           return $data;
    }

}

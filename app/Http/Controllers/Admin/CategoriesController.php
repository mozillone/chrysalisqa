<?php
	
namespace App\Http\Controllers\Admin;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use DB;
use Session;
use App\Helpers\SiteHelper;
use App\Helpers\Site_model;
use Hash;
use Response;
use Validator;
use App\Category;
use App\Costumes;

class CategoriesController extends Controller
{
    protected $messageBag = null;
    

    public function __construct()
    {
      $this->sitehelper = new SiteHelper();
      $this->middleware(function ($request, $next) {
          if(!Auth::check()){
            return Redirect::to('/admin/login')->send();
          }
          else{
               return $next($request);
          }
      });
    }
   public function categoriesList()
   {
      return view('admin.categories.categories_list');
   }
   public function categoriesData(Request $request)
   {
        $categories = DB::select('SELECT cat.category_id,cat.name,cat.parent_id,if(cat.parent_id=0,cat.name,cat1.name)  as main_cat,cat.sort_order  FROM `cc_category`  as cat INNER JOIN cc_category as cat1 on  cat.parent_id=cat1.category_id  or cat.parent_id="0" where cat.status=1 GROUP by cat.category_id order by (case when cat.parent_id > 0 then cat1.sort_order end) asc,(case WHEN cat1.parent_id=0 then cat.sort_order end) asc');
        return response()->success(compact('categories'));
   }
   public function getCostumesList(){
      $costumes_list=Costumes::getCostumesList();
      return Response::JSON($costumes_list);
   }
   public function createCategories(Request $request)
   {
         $req=$request->all();
       //  dd($req);
         if(count($req))
         {
            $rule  = array('name' => 'required|max:50','desc' => 'required|max:200','cat_image' => 'required','banner_image'=>'required');
            $validator = Validator::make($req,$rule);
            if ($validator->fails())
            {
               return Redirect::back()->withErrors($validator->messages())->withInput();
            }
            else
              { 
                  if(!empty($req['cat_name'])){
                    $slug1=$this->specialCharectorsRemove($req['cat_name']);
                    $slug2=$this->specialCharectorsRemove($req['name']);
                    $key_url='/'.$slug1.'/'.$slug2;
                  }else{
                    $slug1=$this->specialCharectorsRemove($req['name']);
                    $key_url='/'.$slug1;
                  }
                  $cat_info = Category::getUrlCategoryId($key_url);
                  if(!count($cat_info)){
                    Category::createCategory($req);
                    Session::flash('success', 'Category is created successfully');
                    return Redirect::back();
                  }else{
                   Session::flash('error', 'This Category is already exits');
                   return Redirect::back(); 
                  }
              }
         }
         else
         {
            $parent_cats=Category::getParentCategories();
            $costumes_list=Costumes::getCostumesList();
             return view('admin.categories.categories_create',compact('parent_cats',$parent_cats))->with('costumes_list',$costumes_list);
         }
   }
    public function editCategories(Request $request,$cat_id=null)
    {

      $req=$request->all();

      if(count($req))
      {
     //dd($req);
        $rule  = array('name' => 'required|max:50','desc' => 'required|max:200');
        $validator = Validator::make($req,$rule);
        if ($validator->fails())
        {
          return Redirect::back()->withErrors($validator->messages())->withInput();
        }
        else
        { 
          if($req['cat_name'] !== '--Select--'){
            $slug1=$this->specialCharectorsRemove($req['cat_name']);
            $slug2=$this->specialCharectorsRemove($req['name']);
            $key_url='/'.$slug1.'/'.$slug2;
          }else{
            $slug1=$this->specialCharectorsRemove($req['name']);
            $key_url='/'.$slug1;
          }
          
          $cat_info=Category::getUrlCategoryId($key_url); 

          if(!count($cat_info) || $cat_info[0]->url_offset==$req['category_id']){
            $cat_info=Category::getUrlCategoryId($key_url);
            
            Category::updateCategory($req);
            Session::flash('success', 'Category is updated successfully');
            return Redirect::to('categories');
          }else{
             Session::flash('error', 'This Category is already exits');
             return Redirect::to("/categories"); 
          }
        }
      }
      else
      {
        $cond=array('category_id'=>$cat_id);
        $cat_data=Site_model::fetch_data('category','*',$cond);

        $parent_cats=Category::getParentCategories();
        $costumes_list=Costumes::getCostumesList();
        $cat_costumes=Category::getCatCostumesList($cat_id);
        return view('admin.categories.categories_edit',compact('cat_data',$cat_data))
                    ->with('parent_cats',$parent_cats)
                    ->with('costumes_list',$costumes_list)
                    ->with('cat_costumes',$cat_costumes);
     }
   }
   public function deleteCategory($id)
   {
        $deleteCategory = DB::table('category')->where('category_id', $id)->delete();
        $deleteUrlRewrite = DB::table('url_rewrites')->where('type', 'category')->where('url_offset', $id)->delete();
        Session::flash('success', 'Category is deleted successfully');
        return Redirect::back();
   }
   public function attributesValuesList()
   {
      return view('admin.attributes.attributes_values_list');
   }
   public function attributesValuesData(Request $request)
    {
        $attributes_values = DB::select('SELECT val.option_id,attr.label,val.option_value FROM `cc_attribute_options` as val LEFT JOIN cc_attributes as attr on attr.attribute_id=val.attribute_id  ORDER BY attr.attribute_id ASC');
        return response()->success(compact('attributes_values'));
    }
   public function createAttributesValue(Request $request)
   {

         $req=$request->all();
         if(count($req))
         {
            $rule  = array('attribute_id' => 'required','option_value' => 'required|max:50');
            $validator = Validator::make($req,$rule);
            if ($validator->fails())
            {
               return Redirect::back()->withErrors($validator->messages())->withInput();
            }
            else
              { 
                  $data = array('attribute_id'=> $req['attribute_id'],
                  				'option_value'=> $req['option_value'],
                  				);
                  Site_model::insert_data('attribute_options',$data);
                  Session::flash('success', 'Attribute value is created successfully');
                  return Redirect::back();
              }
         }
         else
         {
            $attributes=Site_model::Fetch_all_data('attributes','*');
            return view('admin.attributes.attributes_value_create',compact('attributes',$attributes));
         }
   }
   public function editAttributeValue(Request $request,$option_id=null)
   {
         $req=$request->all();
         if(count($req))
         {
            $rule  = array('attribute_id' => 'required','option_value' => 'required|max:50');
            $validator = Validator::make($req,$rule);
            if ($validator->fails())
            {
               return Redirect::back()->withErrors($validator->messages())->withInput();
            }
            else
              { 
                  
                  $data = array('attribute_id'=> $req['attribute_id'],
                  				'option_value'=> $req['option_value'],
                  				);
                  $cond=array('option_id'=>$req['id']);
                  Site_model::update_data('attribute_options',$data,$cond);
                  Session::flash('success', 'Attribute value is updated successfully');
                  return Redirect::to('attributes/values');
              }
         }
         else
         {
            $cond=array('option_id'=>$option_id);
            $attribute_value_data=Site_model::fetch_data('attribute_options','*',$cond);
            $attributes=Site_model::Fetch_all_data('attributes','*');
            return view('admin.attributes.attributes_value_edit',compact('attribute_value_data',$attribute_value_data))->with('attributes',$attributes);
         }
   }
   public function deleteAttributesValue($id)
   {   
         $cond = array('option_id'=>$id);
         Site_model::delete_single('attribute_options',$cond);
         Session::flash('success', 'Attribute value is deleted successfully');
         return Redirect::back();
   }
   private function specialCharectorsRemove($string) {
            $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
            $string =str_replace(array('\'', '"'), '', $string); 
            $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
            return strtolower(trim($string, '-'));
    }

  public static function deleteCategoryCostume($product_id, $category_id)
  {
    $is_deleted = DB::table('costume_to_category')
                    ->where('costume_id',$product_id)
                    ->where('category_id', $category_id)
                    ->delete();

    if($is_deleted){
      Session::flash('success', 'Costume Deleted successfully');
      return redirect()->back();
    }else{
      Session::flash('error', 'Costume not Deleted, Try Again');
      return redirect()->back();
    }
  }

}

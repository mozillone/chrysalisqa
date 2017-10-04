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
<<<<<<< HEAD
        $categories = DB::select('SELECT cat.category_id,cat.name,cat.parent_id,if(cat.parent_id=0,cat.name,cat1.name)  as main_cat,cat.sort_order  FROM `cc_category`  as cat INNER JOIN cc_category as cat1 on  cat.parent_id=cat1.category_id  or cat.parent_id="0" where cat.status=1 GROUP by cat.category_id order by parent_id,category_id asc');
=======
        $categories = DB::select('SELECT cat.category_id,cat.name,cat.parent_id,if(cat.parent_id=0,cat.name,cat1.name)  as main_cat,cat.sort_order  FROM `cc_category`  as cat INNER JOIN cc_category as cat1 on  cat.parent_id=cat1.category_id  or cat.parent_id="0"
                                  GROUP by cat.category_id order by parent_id,category_id asc');
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        return response()->success(compact('categories'));
   }
   public function getCostumesList(){
      $costumes_list=Costumes::getCostumesList();
      return Response::JSON($costumes_list);
   }
   public function createCategories(Request $request)
   {
         $req=$request->all();
<<<<<<< HEAD
       //  dd($req);
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
                  if(!empty($req['cat_name'])){
                    $slug1=$this->specialCharectorsRemove($req['cat_name']);
                    $slug2=$this->specialCharectorsRemove($req['name']);
                    $key_url='/'.$slug1.'/'.$slug2;
                  }else{
                    $slug1=$this->specialCharectorsRemove($req['name']);
                    $key_url='/'.$slug1;
                  }
                  $cat_info=Category::getUrlCategoryId($key_url);
                  if(!count($cat_info)){
                  Category::createCategory($req);
                  Session::flash('success', 'Category is created successfully');
                  return Redirect::back();
                  }else{
                   Session::flash('error', 'This Category is already exits');
                   return Redirect::back(); 
                  }
=======
                  Category::createCategory($req);
                  Session::flash('success', 'Category is created successfully');
                  return Redirect::back();
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD

         $req=$request->all();

         if(count($req))
         {
         //dd($req);
=======
         $req=$request->all();
         if(count($req))
         {
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
           $rule  = array('name' => 'required|max:50','desc' => 'required|max:200');
           $validator = Validator::make($req,$rule);
            if ($validator->fails())
            {
               return Redirect::back()->withErrors($validator->messages())->withInput();
            }
            else
              { 
                  
<<<<<<< HEAD
                  if(!empty($req['cat_name'])){
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
=======
                  Category::updateCategory($req);
                  Session::flash('success', 'Category is updated successfully');
                  return Redirect::to('categories');
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
              }
         }
         else
         {
            $cond=array('category_id'=>$cat_id);
            $cat_data=Site_model::fetch_data('category','*',$cond);
<<<<<<< HEAD

=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
   {
        $deleteCategory = DB::table('category')->where('category_id', $id)->delete();
        $deleteUrlRewrite = DB::table('url_rewrites')->where('type', 'category')->where('url_offset', $id)->delete();
        Session::flash('success', 'Category is deleted successfully');
        return Redirect::back();
=======
   {   
         $cond = array('category_id'=>$id);
         Site_model::delete_single('category',$cond);
         Session::flash('success', 'Category is deleted successfully');
         return Redirect::back();
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD

=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
   private function specialCharectorsRemove($string) {
            $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
            $string =str_replace(array('\'', '"'), '', $string); 
            $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
            return strtolower(trim($string, '-'));
    }
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

}

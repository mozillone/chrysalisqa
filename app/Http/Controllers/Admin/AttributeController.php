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

class AttributeController extends Controller
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
   public function attributesList()
   {
      return view('admin.attributes.attributes_list');
   }
   public function attributesData(Request $request)
    {
        $attributes = DB::select('SELECT attr.attribute_id,attr.type,attr.label,DATE_FORMAT(attr.created_at,"%m/%d/%y %h:%i %p") as date FROM `cc_attributes` as attr  ORDER BY attr.label ASC');
        return response()->success(compact('attributes'));
    }
   public function createAttributes(Request $request)
   {
         $req=$request->all();
         if(count($req))
         {
            $rule  = array('name' => 'required|max:50','code' => 'required|max:50','type' => 'required');
            $validator = Validator::make($req,$rule);
            if ($validator->fails())
            {
               return Redirect::back()->withErrors($validator->messages())->withInput();
            }
            else
              { 
                  $data = array('label'=> $req['name'],
                  				'code'=> $req['code'],
                  				'type'=> $req['type'],
                                'created_at'=>date('Y-m-d H:i:s'));
                  Site_model::insert_data('attributes',$data);
                  Session::flash('success', 'Attribute is created successfully');
                  return Redirect::back();
              }
         }
         else
         {
            return view('admin.attributes.attributes_create');
         }
   }
   public function editAttribute(Request $request,$attribute_id=null)
   {
         $req=$request->all();
         if(count($req))
         {
               $rule  = array('name' => 'required|max:50','code' => 'required|max:50','type' => 'required');
            $validator = Validator::make($req,$rule);
            if ($validator->fails())
            {
               return Redirect::back()->withErrors($validator->messages())->withInput();
            }
            else
              { 
                  
                  $data = array('label'=> $req['name'],
                  				'code'=> $req['code'],
                  				'type'=> $req['type'],
                                'updated_at'=>date('Y-m-d H:i:s'));
                  $cond=array('attribute_id'=>$req['id']);
                  Site_model::update_data('attributes',$data,$cond);
                  Session::flash('success', 'Attribute is updated successfully');
                  return Redirect::to('attributes');
              }
         }
         else
         {
            $cond=array('attribute_id'=>$attribute_id);
            $attributes_data=Site_model::fetch_data('attributes','*',$cond);
            return view('admin.attributes.attributes_edit',compact('attributes_data',$attributes_data));
         }
   }
   public function deleteAttributes($id)
   {   
         $cond = array('attribute_id'=>$id);
         Site_model::delete_single('attributes',$cond);
         Session::flash('success', 'Attribute is deleted successfully');
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

}

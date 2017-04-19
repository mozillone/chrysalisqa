<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use App\Costumes;
use Session;
use Hash;
use DB;
use Response;
class CreateCostumeController  extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
	}
	public function costumeListings($sub_cat_id,$parent_cat_name)
	{
		$data['sub_cat_info']=Costumes::getCategoryInfo($sub_cat_id);
		$parent_cat_id=$data['sub_cat_info'][0]->parent_id;
		$data['sub_cats_list']=Costumes::getParentCategories($parent_cat_id);
		return view('frontend.costumes.costumes_list',compact('data',$data))->with('parent_cat_name',$parent_cat_name);
	}
	/***create costume step 2 code starts here***/
	public function createCostumestep2(){
		/***Getting categories code starts here***/
		/***selecting body and dimensions code starts here***/
		$bodyanddimensions=DB::table('attributes')->select('attribute_id as attributeid','code as code','label as label','type as type')->where('attribute_id','1')->first();
		$body_height_ft=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attributeid','option_value as value')->where('option_id','=','1')->first();
		$body_height_in=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attributeid','option_value as value')->where('option_id','=','2')->first();
		$body_weight_lbs=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attributeid','option_value as value')->where('option_id','=','3')->first();
		$body_chest_in=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attributeid','option_value as value')->where('option_id','=','5')->first();
		$body_waist_lbs=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attributeid','option_value as value')->where('option_id','=','6')->first();
		$cosplayone=DB::table('attributes')->select('attribute_id as attributeid','code as code','label as label','type as type')->where('attribute_id','2')->first();
		$cosplayone_values=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attributeid','option_value as value')->where('attribute_id','2')->get();
		$cosplaytwo=DB::table('attributes')->select('attribute_id as attributeid','code as code','label as label','type as type')->where('attribute_id','3')->first();
		$cosplaytwo_values=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attributeid','option_value as value')->where('attribute_id','3')->get();
		$cosplaythree=DB::table('attributes')->select('attribute_id as attributeid','code as code','label as label','type as type')->where('attribute_id','4')->first();
		$cosplaythree_values=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attributeid','option_value as value')->where('attribute_id','4')->get();
		$cosplayfour=DB::table('attributes')->select('attribute_id as attributeid','code as code','label as label','type as type')->where('attribute_id','5')->first();
		$cosplayfour_values=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attributeid','option_value as value')->where('attribute_id','5')->get();
		$cosplayfive=DB::table('attributes')->select('attribute_id as attributeid','code as code','label as label','type as type')->where('attribute_id','21')->first();
		$cosplayfive_values=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attributeid','option_value as value')->where('attribute_id','21')->get();
		$categories=DB::table('category')->select('category_id as categoryid','name as categoryname')->where('status','=','1')->where('parent_id','=','0')->get();
		return view('frontend.costumes.costume_create_two',compact('categories','bodyanddimensions','bodydimensions_val','body_height_ft',
		'body_height_in','body_weight_lbs','body_chest_in','body_waist_lbs','cosplayone','cosplaytwo','cosplaythree','cosplayfour',
		'cosplayfive','cosplayone_values','cosplaytwo_values','cosplaythree_values','cosplayfour_values','cosplayfive_values'));
		
	}
	/****Fetching sub category values based on category code starts here***/
	public function ajaxSubCategory(){
		echo "hi"; exit;
		$id = Input::get('categoryid');
	
		$results = DB::table('category')->where('category_id', '=',$id)->where('status', '=',1)->get(['category_id as subcategoryid','name as subcategoryname']);
		return $results;
		
	}
	/******Step 3 code starts here***/
	public function createCostumestep3(){
		$shippingoptions=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','9')->get();
		$packageditems=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','10')->get();
		$type=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','12')->get();
		$service=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','13')->get();
		$dimensions=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','11')->get();
		return view('frontend.costumes.costume_create_three',compact('shippingoptions','packageditems','type','service','dimensions'));
	}
	/******step 3 costume code starts here***/
	public function createCostumestep4(){
		$handlingtime=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','14')->get();
		$returnpolicy=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','15')->get();
		$charities=DB::table('charities')->select('id as id','name as name')->get();
		return view('frontend.costumes.costume_create_four',compact('handlingtime','returnpolicy','charities'));
	}
	/****Sell a costume code starts here***/
	public function sellCostume(){
	  return view('frontend.costumes.sellacostume');
	}
	/****create costume step 1 code starts her***/
	public function createCostumestep1(){
	 return view('frontend.costumes.costume_create_one');
	}
}

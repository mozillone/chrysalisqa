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
use Illuminate\Support\Facades\Input;

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
		$handlingtime=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','14')->get();
		$returnpolicy=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','15')->get();
		$charities=DB::table('charities')->select('id as id','name as name')->get();
		return view('frontend.costumes.costume_create_two',compact('categories','bodyanddimensions','bodydimensions_val','body_height_ft',
		'body_height_in','body_weight_lbs','body_chest_in','body_waist_lbs','cosplayone','cosplaytwo','cosplaythree','cosplayfour',
		'cosplayfive','cosplayone_values','cosplaytwo_values','cosplaythree_values','cosplayfour_values','cosplayfive_values',
		'shippingoptions','packageditems','type','dimensions','service','handlingtime','returnpolicy','charities'));
		
	}
	/****Fetching sub category values based on category code starts here***/
	public function ajaxSubCategory(){
	    $id = Input::get('categoryid');
		 $results = DB::table('category')->where('parent_id', '=',$id)->where('status', '=',1)->get(['category_id as subcategoryid','name as subcategoryname']);
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
	/***insert costume description code starts here***/
	public function insertDescription(Request $request){
    
	$req = $request->all();
	$userid=Auth::user()->id;
	//Getting the values of attribute description
	$costume_name=$request->costume_name;
	$category_name=$request->categoryname;
	$gender=$request->gender;
	$size=$request->size;
	$sub_category=$request->subcategory;
	$condition=$request->condition;
	$heightft=$request->heightft;
	$heightin=$request->heighin;
	$weightlbs=$request->weightlbs;
	$chestin=$request->chestin;
	$waistlbs=$request->waistlbs;
	$cosplay=$request->cosplay;
	$fashion=$request->fashion;
	$activity=$request->activity;
	$makecostume=$request->makecostume;
	//$makecostumetime=$request->make-costume-time;
	$filmquality=$request->fimquality;
	$description=$request->description;
	$funfact=$request->funfact;
	$faq=$request->faq;
	//if($costume_name!='' && $category_name!='' && $gender!='' && $size!='' && $sub_category!='' && $condition!='' && heightft!='' && $heightin!=''
	//&& $weightlbs!='' && $chestin!='' && $waistlbs!='' && $cosplay!='' && $fashion!='' && $activity!='' &&  $makecostume!='' && $fimquality!='' 
	//&& $description!='' && $funfact!='' && $faq!=''){
	   /***Not checking any server side upto know***/
	   //Inserting all the values in costumes table first
	   //costume_id-autoincrement
	   //sku_no
	   //quantity
	   //price
	   //gender
	   //condition
	   //status
	   //created_user_group
	   //created_by
	   //viewed
	   //item_location
	   //size
	   //created_at
	   //updated_at
	   //Generating sku_no based on last inserted code starts here
	   //Getting the last inserted sku_no if it is there in the datbase we need to increment and insert if not there we need to insert the new one
	   $sku_no=DB::table('costumes')->select('*')->get();
	   $count=count($sku_no);
	   //if count greater than zero increment the sku number else insert the sku number
	   if($count > 0){
	   //Get the last sku number
	   $sku_num=DB::table('costumes')->max('sku_no');
	    //increment the value 
		$sku_org=str_replace('CS', '', $sku_num);
		$sku_org_val=$sku_org+1;
		$sku_val='CS'.'00000'.$sku_org_val;
		}
		else{
			$sku_val='CS'.'00000'.'1';
		}
		//Generating sku_no based on last inserted code ends here
		//Costumes table array code starts here
		 $costume_description=array('sku_no'=>$sku_val,
		'gender'=>$gender,
		'condition'=>$condition,
		'created_user_group'=>$userid,
		'size'=>$size,
		'created_at'=>date('y-m-d H:i:s'),
		'updated_at'=>date('y-m-d H:i:s'),
		);
		print_r($costume_description);
		$insert_description=DB::table('costumes')->insert($costume_description);
		if($insert_description){
			$costume_id=DB::table('costumes')->max('costume_id');
			//If inserted get customer id and then insert into costume_description table
			$costume_name_desc=array('costume_id'=>$costume_id,
			'language_id'=>'1',
			'name'=>$costume_name,
			'description'=>$description,
			);
			//Costume category array code starts here
			$costumne_category=array('costume_id'=>$costume_id,
			'category_id'=>$sub_category,
			);
			
			$costume_name_desc_insert=DB::table('costume_description')->insert($costume_name_desc);
			if($costume_name_desc_insert){
				$categoryinsertion=DB::table('costume_to_category')->insert($costumne_category);
				//attribute insertion code starts here 
				//Height-feet
		$height_ft=array('costume_id'=>$costume_id,
		'attribute_id'=>'16',
		'attribute_option_value_id'=>'0',
		'attribute_option_value'=>$heightft,
		);
		$height_ft_insert=DB::table('costume_attribute_options')->insert($height_ft);
		//Height-inches
		$height_in=array('costume_id'=>$costume_id,
		'attribute_id'=>'17',
		'attribute_option_value_id'=>'0',
		'attribute_option_value'=>$heightin,
		);
		$height_in_insert=DB::table('costume_attribute_options')->insert($height_in);
		//weight-lbs
		$weight_lbs=array('costume_id'=>$costume_id,
		'attribute_id'=>'18',
		'attribute_option_value_id'=>'0',
		'attribute_option_value'=>$weightlbs,
		);
		$weight_lbs_insert=DB::table('costume_attribute_options')->insert($weight_lbs);
		//chestin
		$chest_in=array('costume_id'=>$costume_id,
		'attribute_id'=>'19',
		'attribute_option_value_id'=>'0',
		'attribute_option_value'=>$chestin,
		);
		$chest_in_insert=DB::table('costume_attribute_options')->insert($chest_in);
		//chestin
		$waist_lbs=array('costume_id'=>$costume_id,
		'attribute_id'=>'20',
		'attribute_option_value_id'=>'0',
		'attribute_option_value'=>$waistlbs,
		);
		$waist_lbs_insert=DB::table('costume_attribute_options')->insert($waist_lbs);
		//cosplay insertion
		//Fetch values based on cosplay value
		switch($cosplay){ case '7': $cosplay_value="yes"; break; case '8': $cosplay_value="No"; break; }
		$cosplay_value=array('costume_id'=>$costume_id,
		'attribute_id'=>'2',
		'attribute_option_value_id'=>$cosplay,
		'attribute_option_value'=>$cosplay_value,
		);
		$cosplay_value_insert=DB::table('costume_attribute_options')->insert($cosplay_value);
		//uniquefashion insertion
		switch($fashion){ case '9': $fashion_val="yes"; break; case '10': $fashion_val="No"; break; }
		$unique_fashion=array('costume_id'=>$costume_id,
		'attribute_id'=>'3',
		'attribute_option_value_id'=>$fashion,
		'attribute_option_value'=>$fashion_val,
		);
		$unique_fashion_insert=DB::table('costume_attribute_options')->insert($unique_fashion);
		//Activity
		switch($activity){ case '11': $activity_value="yes"; break; case '12': $activity_value="No"; break; }
		$activity_val=array('costume_id'=>$costume_id,
		'attribute_id'=>'4',
		'attribute_option_value_id'=>$activity,
		'attribute_option_value'=>$activity_value,
		);
		$activity_val_insert=DB::table('costume_attribute_options')->insert($activity_val);
		//User Costumes
		switch($makecostume){ case '30': $makecostume_value="yes"; break; case '31': $makecostume_value="No"; break; }
		$user_costume=array('costume_id'=>$costume_id,
		'attribute_id'=>'5',
		'attribute_option_value_id'=>$makecostume,
		'attribute_option_value'=>$makecostume_value,
		);
		$user_costume_insert=DB::table('costume_attribute_options')->insert($user_costume);
		//film Quality
		switch($filmquality){ case '32': $filmquality_value="yes"; break; case '33': $filmquality_value="No"; break; }
		$film_quality=array('costume_id'=>$costume_id,
		'attribute_id'=>'21',
		'attribute_option_value_id'=>$filmquality,
		'attribute_option_value'=>$filmquality_value,
		);
		$filmquality_insert=DB::table('costume_attribute_options')->insert($film_quality);
		//Descriptioon
		$description_val=array('costume_id'=>$costume_id,
		'attribute_id'=>'6',
		'attribute_option_value_id'=>'0',
		'attribute_option_value'=>$description,
		);
		$description_insert=DB::table('costume_attribute_options')->insert($description_val);
		//Funfact
		$funfact_val=array('costume_id'=>$costume_id,
		'attribute_id'=>'7',
		'attribute_option_value_id'=>'0',
		'attribute_option_value'=>$funfact,
		);
		$funfact_insert=DB::table('costume_attribute_options')->insert($funfact_val);
		//faq
		$faq_value=array('costume_id'=>$costume_id,
		'attribute_id'=>'8',
		'attribute_option_value_id'=>'0',
		'attribute_option_value'=>$faq,
		);
		$faq_insert=DB::table('costume_attribute_options')->insert($faq_value);
		if($faq_insert){
			Session::flash('success', 'Step2 Updated successfully');
           return Redirect::back();
		}
			}

		}
		//Costume decription array code starts here
		}
		public function insertShipping(Request $request){
			$req = $request->all();
			$price=$request->price;
			$quantity=$request->quantity;
			
			$shipping=$request->shipping;
			$packageditems=$request->packageditems;
			$type=$request->type;
			$service=$request->service;
			$freeshipping=$request->freeshipping;
			$shipping_array=array('quantity'=>$quantity,
			'price'=>$price
			);
			$packageitems_insert=DB::table('costumes')->insert($shipping_array);
			//attributes inserting code starts here
			//film Quality
			$shipping_val=array('costume_id'=>'35',
			'attribute_id'=>'9',
			'attribute_option_value_id'=>$shipping,
			'attribute_option_value'=>'Free Shipping',
			);
			$shipping_quality=DB::table('costume_attribute_options')->insert($shipping_val);
			switch($packageditems){
				
				case '18':
				$packaged_items_val='1+ -20lbs';
				break;
				case '19':
				$packaged_items_val='2+ -201lbs';
				break;
			}
			$packaged_items_array=array('costume_id'=>'35',
			'attribute_id'=>'9',
			'attribute_option_value_id'=>$packageditems,
			'attribute_option_value'=>$packaged_items_val,
			);
			$packaged_items_insert=DB::table('costume_attribute_options')->insert($packaged_items_array);
			if($packaged_items_insert){
			Session::flash('success', 'Shipping information inserted successfully ');
           return Redirect::back();
		}
			
			
			
		}
		/****insert prefernces ***/
		public function insertPreferences(Request $request){
			
		}
		/****insert images code starts here**/
		public function insertCostumeimages(Request $request){
			
		}
}

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
		$charities=DB::table('charities')->select('id as id','name as name','image as image')->where('status','1')->get();
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

		public function Costumecreate(Request $request){
			/*echo "<pre>";
			print_r($request->all());
			die;*/
			//costume description insertion
			$req=$request->all();
			$userid=Auth::user()->id;

		  	$costume_name=$req['costume_name'];
		  	$categoryname=$req['categoryname'];
		  	$costume_condition=$req['condition'];
		  	$gender = $req['gender'];
		  	$size = $req['size'];
		  	$subcategory = $req['subcategory'];
		  	$heightft = $req['height-ft'];
		  	$heightin = $req['height-in'];
		  	$weightlbs = $req['weight-lbs'];
		  	$chestin = $req['chest-in'];
		  	$waistlbs = $req['waist-lbs'];
		  	$cosplay=$req['cosplay'];
		  	$fashion=$req['fashion'];
		  	$activity=$req['activity'];
		  	$makecostume=$req['make_costume'];
		  	$filmquality=$req['fimquality'];
		  	//$makecostumetime = $req['make-costume-time'];
		  	$description = $req['description'];
		  	$funfacts = $req['funfcats'];
		  	$faq = $req['faq'];
		  	//Generating sku number for a costume code starts here code format should be (CS(five zeros)incrementing the number form 0 Ex:CS0000012)*****/
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
			$customer_group="user";
			/*
		 |Tbale:costumes
		 |@sku_no varchar
		 |@gender  enum
		 |@condition enum
		 |@created_user_group enum (admin/user)
		 |@size varchar
		 |@created_by interface_exists
		 |@created_at datetime
		 |@updated_at datetime
		 */
			//Check whether the costume inserted by admin or not if the user is selected insert the user id else insert the admin as costumer
			$costume=array('sku_no'=>$sku_val,
			'gender'=>$gender,
			'condition'=>$costume_condition,
			'created_user_group'=>$customer_group,
			'size'=>$size,
			'item_location'=>$request->zipcode,
			'created_by'=>$userid,
			'created_at'=>date('y-m-d H:i:s'),
			'updated_at'=>date('y-m-d H:i:s'),
			);

			$insert_costume=DB::table('costumes')->insertGetId($costume);
			
			


			 Session::put('session_costume_id', $insert_costume);
			 $costume_id = $insert_costume;

			$file_name1 = str_random(10).'.'.$request->file1->getClientOriginalExtension();
			$file_name2 = str_random(10).'.'.$request->file2->getClientOriginalExtension();
			$file_name3 = str_random(10).'.'.$request->file3->getClientOriginalExtension(); 
				$source_image_path=public_path('costumers_images');
	            $thumb_image_path1=public_path('costumers_images/Original');
	            $thumb_image_path2=public_path('costumers_images/Medium');
	            $thumb_image_path3=public_path('costumers_images/Small');
	            //file1 moving to folder
	            $request['file1']->move($source_image_path, $file_name1);
	            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name1,$thumb_image_path1.'/'.$file_name1,150,150);
	            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name1,$thumb_image_path2.'/'.$file_name1,150,150);
	            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name1,$thumb_image_path3.'/'.$file_name1,30,30);
	            //inserting in db
	            $file_db_array1 = array('costume_id'=>$costume_id,
	            	'image'=>$file_name1,
	            	'type'=>1,
	            	'sort_order'=>0,
	            	);
	            $file_db=DB::table('costume_image')->insert($file_db_array1);
	            //file2 moving to folder
	            $request['file2']->move($source_image_path, $file_name2);
	            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name2,$thumb_image_path1.'/'.$file_name2,150,150);
	            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name2,$thumb_image_path2.'/'.$file_name2,150,150);
	            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name2,$thumb_image_path3.'/'.$file_name2,30,30);
	            //inserting in db
	            $file_db_array2 = array('costume_id'=>$costume_id,
	            	'image'=>$file_name2,
	            	'type'=>2,
	            	'sort_order'=>0,
	            	);
	            $file_db=DB::table('costume_image')->insert($file_db_array2);
	            //file3 moving to folder
	            $request['file3']->move($source_image_path, $file_name3);
	            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name3,$thumb_image_path1.'/'.$file_name3,150,150);
	            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name3,$thumb_image_path2.'/'.$file_name3,150,150);
	            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name3,$thumb_image_path3.'/'.$file_name3,30,30);

	            //inserting in db
	            $file_db_array3 = array('costume_id'=>$costume_id,
	            	'image'=>$file_name3,
	            	'type'=>3,
	            	'sort_order'=>0,
	            	);
	            $file_db=DB::table('costume_image')->insert($file_db_array3);

	            //moving extra images
	            if (isset($request['file4']) && !empty($request['file4'])) {
	            	foreach ($request['file4'] as $file4) {
	            		$file_name = str_random(10).'.'.$file4->getClientOriginalExtension();
	            		$source_image_path=public_path('costumers_images');
	            		$thumb_image_path1=public_path('costumers_images/Original');
	            		$thumb_image_path2=public_path('costumers_images/Medium');
	            		$thumb_image_path3=public_path('costumers_images/Small');
	            		//file3 moving to folder
			            $file4->move($source_image_path, $file_name);
			            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,150,150);
			            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,198,295);
			            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path3.'/'.$file_name,30,30);
			            //inserting in db
	            		$file_db_array4 = array('costume_id'=>$costume_id,
	            			'image'=>$file_name,
	            			'type'=>4,
	            			'sort_order'=>0,
	            		);
	            		$file_db=DB::table('costume_image')->insert($file_db_array4);
	            	}
	            }

	           // echo "images insertion";die;
			/*
		 |Tbale:costume_description
		 |@costume_id int
		 |@language_id  int
		 |@name varchar
		 |@description text
		 */
			$costume_description=array('costume_id'=>$insert_costume,
			'language_id'=>"1",
			'name'=>$costume_name,
			'description'=>$description);
			$insert_costume_desc=DB::table('costume_description')->insertGetId($costume_description);

			/*
		|Table:costume_to_category
		|@costume_id int
		|@category_id int
		*/
			$costume_category=array('costume_id'=>$insert_costume,
			'category_id'=>$subcategory);
			$insert_costume_category=DB::table('costume_to_category')->insertGetId($costume_category);
			/**** Url create start here ***/
			Costumes::urlRewrites($insert_costume,'insert');
			/**** Url create end here ***/
			

		/*****************************Attributes insertion code starts here****/
		/*
		|Table:costume_attribute_options
		|Make a costume if yes 
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
		if (isset($request->make_costume_time) && !empty($request->make_costume_time)) {
			$make_costume_time=array('costume_id'=>$insert_costume,
			'attribute_id'=>'29',
			'attribute_option_value_id'=>"0",
			'attribute_option_value'=>$request->make_costume_time,
			);
			$make_costume_timeinsert=DB::table('costume_attribute_options')->insert($make_costume_time);
		}
		/*
		|Table:costume_attribute_options
		|Cosplay if yes 
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
		if (isset($request->cosplayplay_yes_opt) && !empty($request->cosplayplay_yes_opt)) {
			$get_attr_opt_value_id = DB::table('attribute_options')->where('option_value',$request->cosplayplay_yes_opt)->first(['option_id']);
			$cosplay_yes=array('costume_id'=>$insert_costume,
			'attribute_id'=>'25',
			'attribute_option_value_id'=>$get_attr_opt_value_id->option_id,
			'attribute_option_value'=>$request->cosplayplay_yes_opt,
			);
			$cosplay_yes_insert=DB::table('costume_attribute_options')->insert($cosplay_yes);
		}
		/*
		|Table:costume_attribute_options
		|Unique fashion if yes 
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
		if (isset($request->uniquefashion_yes_opt) && !empty($request->uniquefashion_yes_opt)) {
			$get_attr_opt_value_id = DB::table('attribute_options')->where('option_value',$request->uniquefashion_yes_opt)->first(['option_id']);
			$uniquefashion_yes=array('costume_id'=>$insert_costume,
			'attribute_id'=>'26',
			'attribute_option_value_id'=>$get_attr_opt_value_id->option_id,
			'attribute_option_value'=>$request->uniquefashion_yes_opt,
			);
			$uniquefashion_insert=DB::table('costume_attribute_options')->insert($uniquefashion_yes);
		}
		/*
		|Table:costume_attribute_options
		|Activity fashion if yes 
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
		if (isset($request->activity_yes_opt) && !empty($request->activity_yes_opt)) {
			$get_attr_opt_value_id = DB::table('attribute_options')->where('option_value',$request->activity_yes_opt)->first(['option_id']);
			$activity_yes=array('costume_id'=>$insert_costume,
			'attribute_id'=>'28',
			'attribute_option_value_id'=>$get_attr_opt_value_id->option_id,
			'attribute_option_value'=>$request->activity_yes_opt,
			);
			$uniquefashion_insert=DB::table('costume_attribute_options')->insert($activity_yes);
		}
		/*
		|Table:costume_attribute_options
		|Body dimensions (height-ft,height-in,ewight-lbs,waist-lbs,chest-in)
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
			$height_ft=array('costume_id'=>$insert_costume,
			'attribute_id'=>'16',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$heightft,
			);
			$height_ft_insert=DB::table('costume_attribute_options')->insert($height_ft);
			//Height-inches
			$height_in=array('costume_id'=>$insert_costume,
			'attribute_id'=>'17',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$heightin,
			);
			$height_in_insert=DB::table('costume_attribute_options')->insert($height_in);
			//weight-lbs
			$weight_lbs=array('costume_id'=>$insert_costume,
			'attribute_id'=>'18',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$weightlbs,
			);
			$weight_lbs_insert=DB::table('costume_attribute_options')->insert($weight_lbs);
			//chestin
			$chest_in=array('costume_id'=>$insert_costume,
			'attribute_id'=>'19',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$chestin,
			);
			$chest_in_insert=DB::table('costume_attribute_options')->insert($chest_in);
			//chestin
			$waist_lbs=array('costume_id'=>$insert_costume,
			'attribute_id'=>'20',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$waistlbs,
			);
			$waist_lbs_insert=DB::table('costume_attribute_options')->insert($waist_lbs);
			//echo "<pre>";print_r("hello");die;

			/*
		|Table:costume_attribute_options
		|Costume FAQ (used for cosplay ?,is your costume have unique fashion?,used for an activity?,you make the costume?,Is the costume fit for film quality?)
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
			switch($cosplay){ case '7': $cosplay_value="yes"; break; case '8': $cosplay_value="No"; break; }
			$cosplay_value=array('costume_id'=>$insert_costume,
			'attribute_id'=>'2',
			'attribute_option_value_id'=>$cosplay,
			'attribute_option_value'=>$cosplay_value,
			);
			$cosplay_value_insert=DB::table('costume_attribute_options')->insert($cosplay_value);
			//uniquefashion insertion
			switch($fashion){ case '9': $fashion_val="yes"; break; case '10': $fashion_val="No"; break; }
			$unique_fashion=array('costume_id'=>$insert_costume,
			'attribute_id'=>'3',
			'attribute_option_value_id'=>$fashion,
			'attribute_option_value'=>$fashion_val,
			);
			$unique_fashion_insert=DB::table('costume_attribute_options')->insert($unique_fashion);
			//Activity
			switch($activity){ case '11': $activity_value="yes"; break; case '12': $activity_value="No"; break; }
			$activity_val=array('costume_id'=>$insert_costume,
			'attribute_id'=>'4',
			'attribute_option_value_id'=>$activity,
			'attribute_option_value'=>$activity_value,
			);
			$activity_val_insert=DB::table('costume_attribute_options')->insert($activity_val);
			//User Costumes
			switch($makecostume){ case '30': $makecostume_value="yes"; break; case '31': $makecostume_value="No"; break; }
			$user_costume=array('costume_id'=>$insert_costume,
			'attribute_id'=>'5',
			'attribute_option_value_id'=>$makecostume,
			'attribute_option_value'=>$makecostume_value,
			);
			$user_costume_insert=DB::table('costume_attribute_options')->insert($user_costume);
			//film Quality
			switch($filmquality){ case '32': $filmquality_value="yes"; break; case '33': $filmquality_value="No"; break; }
			$film_quality=array('costume_id'=>$insert_costume,
			'attribute_id'=>'21',
			'attribute_option_value_id'=>$filmquality,
			'attribute_option_value'=>$filmquality_value,
			);
			$filmquality_insert=DB::table('costume_attribute_options')->insert($film_quality);

			/*
		|Table:costume_attribute_options
		|Costume Description,costume funfacts abd costume faq
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
			$description_val=array('costume_id'=>$insert_costume,
			'attribute_id'=>'6',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$description,
			);
			$description_insert=DB::table('costume_attribute_options')->insert($description_val);
			//Funfact
			$funfact_val=array('costume_id'=>$insert_costume,
			'attribute_id'=>'7',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$funfacts,
			);
			$funfact_insert=DB::table('costume_attribute_options')->insert($funfact_val);
			//faq
			$faq_value=array('costume_id'=>$insert_costume,
			'attribute_id'=>'8',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$faq,
			);
			$faq_insert=DB::table('costume_attribute_options')->insert($faq_value);
			// costume description end
			// pricing insertion

			$price=$req['price'];
		  	$quantity=$req['quantity'];
		  	$shipping=$req['shipping'];
		  	$packageitems = $req['packageditems'];
		  	$length = $req['Length'];
		  	$width = $req['Width'];
		  	$height = $req['Height'];
		  	$type = $req['type'];
		  	$service = $req['service'];

			/*
		 |Tbale:costumes
		 |@price varchar
		 |@quantity  enum
		 
		 */
			//Check whether the costume inserted by admin or not if the user is selected insert the user id else insert the admin as costumer
			$costume=array('price'=>$price,
			'quantity'=>$quantity,
			'updated_at'=>date('y-m-d H:i:s'),
			);

			$update_costume = DB::table('costumes')->where('costume_id',$costume_id)->update($costume);

			/*
		|Table:costume_attribute_options
		|Package Information
		|@costume_id 
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/

		 $shipping_val=array('costume_id'=>$costume_id,
				'attribute_id'=>'9',
				'attribute_option_value_id'=>$shipping,
				'attribute_option_value'=>'Free Shipping',
				);
				
			$shipping_quality=DB::table('costume_attribute_options')->insert($shipping_val);

			//weight of packaged items
			switch($packageitems){ case '17': $package="1+ -20lbs"; break; case '18': $package="2+ -201lbs"; break; }
			$package_val=array('costume_id'=>$costume_id,
				'attribute_id'=>'10',
				'attribute_option_value_id'=>$packageitems,
				'attribute_option_value'=>$package,
				);
			$insert_package=DB::table('costume_attribute_options')->insert($package_val);

			//length
			$length=array('costume_id'=>$costume_id,
				'attribute_id'=>'22',
				'attribute_option_value_id'=>0,
				'attribute_option_value'=>$length,
				);
			$length_db=DB::table('costume_attribute_options')->insert($length);
			//width
			$width=array('costume_id'=>$costume_id,
				'attribute_id'=>'23',
				'attribute_option_value_id'=>0,
				'attribute_option_value'=>$width,
				);
			$width_db=DB::table('costume_attribute_options')->insert($width);
			//height
			$height=array('costume_id'=>$costume_id,
				'attribute_id'=>'24',
				'attribute_option_value_id'=>0,
				'attribute_option_value'=>$height,
				);
			$width_db=DB::table('costume_attribute_options')->insert($height);
				

			//Type
			switch($type){ case '22': $typevl="Postage (for thin envelope)"; break; case '23': $typevl="Postage (for thick envelope)"; break; }
			$type_value=array('costume_id'=>$costume_id,
				'attribute_id'=>'12',
				'attribute_option_value_id'=>$type,
				'attribute_option_value'=>$typevl,
				);
			$insert_type=DB::table('costume_attribute_options')->insert($package_val);
			//Service
			switch($service){ case '24': $service_name="USPS Media Mail(2-8 Business Hours)"; break; case '25': $service_name="USPS Media Mail(10-18 Business Hours)"; break; }
			$service_val=array('costume_id'=>$costume_id,
				'attribute_id'=>'13',
				'attribute_option_value_id'=>$service,
				'attribute_option_value'=>$service_name,
				);
				
			$insert_service=DB::table('costume_attribute_options')->insert($service_val);


			//end pricing insertion

			$req=$request->all();
			$userid=Auth::user()->id;

		  	$handlingtime=$req['handlingtime'];
		  	$returnpolicy=$req['returnpolicy'];
		  	$donate_charity=$req['donate_charity'];
		  	$charity_name=$req['charity_name'];
			/*
			|Table:costume_attribute_options
			|Preferences
			|@costume_id 
			|@attribute_id
			|@attribute_option_value_id
			|@attribute_option_value
			*/
			//Handling Time
			switch($handlingtime){ case '26': $handlingtime_name="Same Business Day"; break; case '27': $handlingtime_name="10 Business Days"; break; }
			$handlingtime_val=array('costume_id'=>$costume_id,
				'attribute_id'=>'14',
				'attribute_option_value_id'=>$handlingtime,
				'attribute_option_value'=>$handlingtime_name,
				);
			$insert_handlingtime=DB::table('costume_attribute_options')->insert($handlingtime_val);
			//Return Policy
			switch($returnpolicy){ case '28': $returnpolicy_name="Return Accepted"; break; case '29': $returnpolicy_name="Return Not Accepted "; break; }
			$returnpolicy_val=array('costume_id'=>$costume_id,
				'attribute_id'=>'15',
				'attribute_option_value_id'=>$returnpolicy,
				'attribute_option_value'=>$returnpolicy_name,
				);
			$insert_returnpolicy=DB::table('costume_attribute_options')->insert($returnpolicy_val);

			/*
		 	|Tbale:costumes
		 	|@donation_amount float
		 	|@charity_id  int
		 
		 	*/
			//Check whether the costume inserted by admin or not if the user is selected insert the user id else insert the admin as costumer
			$costume=array('charity_id'=>$donate_charity,
			'donation_amount'=>$charity_name,
			'updated_at'=>date('y-m-d H:i:s'),
			);

			$update_costume = DB::table('costumes')->where('costume_id',$costume_id)->update($costume);

			//charites
			if (isset($req['organzation_name']) && !empty($req['organzation_name'])) {
				$organzation_name=$req['organzation_name'];
				$arrayName = array('name' => $organzation_name,
					'suggested_by'=>$userid,
					'status'=>'0',
					'created_at'=>date('y-m-d H:i:s'),
					'updated_at'=>date('y-m-d H:i:s'),
					 );
				$organzation_name=DB::table('charities')->insert($arrayName);
			}
			return "success";

		}

}

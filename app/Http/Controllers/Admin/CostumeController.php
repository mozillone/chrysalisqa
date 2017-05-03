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
use Hash;
use Response;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use App\Costumes;

class CostumeController extends Controller
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
	/*
	Method Name : costumesList()
	Purpose :costumesList Method is  used to get the data of all costumes from the database.
	*/
	public function costumesList(){
	   /*****Costumes View Page***/
	    $title=Auth::user()->display_name." Costumes List";
        return view('admin.costumes.costumes_list',compact('title'));
	}
	/*
	Method Name : addCostume()
	purpose:addCostume Method is used to show the add costume page
	*/
	public function createCostume(){
	 /****Add Costumes View page ***/
	 $customers=DB::table('users')->select('id as id','display_name as username')
	 ->where('role_id','!=','1')
	 ->where('active','=','1')
	 ->orderby('display_name','ASC')
	 ->get();
	 /*******Array push for both categories and subcategories displaying code starts here*****/
	 $categories=array('modules_result'=>array());
		/****Getting the hotel feautures code starts here***/
		$hotelfeautures =\DB::table('category')->where('parent_id','=','0')->get();
		//print_r($hotelfeautures);exit;
		 $hotelcount=count($hotelfeautures);
		if($hotelcount > 0)
		{
			 $module_array=array();
			 foreach($hotelfeautures as $feautures_response)
			 {
				 foreach($feautures_response as $feauture_key=>$feauture_val)
				 {
					  $module_array[$feauture_key]=$feauture_val;
				 }
				  $module_array['submodule_result']=array();
				  /* >> sub module code start*/
				  $where=array('cc.parent_id'=>$feautures_response->category_id);
					  $hotelfeautures=\DB::table('category as cc')
					 ->join('category', 'category.category_id', '=', 'cc.parent_id')
           ->select('cc.category_id as subcategoryid','cc.name as subcategoryname')->where($where)->get();
					  $sub_count=count($hotelfeautures);
					  if($sub_count > 0)
					  {
						  $submodule_array=array();
						  foreach($hotelfeautures as $sub_response)
							{
								$submodule_array['count']=$feautures_response->category_id;
								foreach($sub_response as $sub_key=>$sub_val)
								{
									$submodule_array[$sub_key]=$sub_val;
								}
								array_push($module_array['submodule_result'],$submodule_array);
								
							}
					  }
				 array_push($categories['modules_result'],$module_array);
			 }
			 
		}
		//print_r($categories); exit;
		//Fetching attributes code starts here***/
		/*****************Body and dimensions code starts here***/
		$bd_height=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',16)->first();
		$bd_height_in=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',17)->first();
        $bd_weight=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',18)->first();
		$bd_chest=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',19)->first();
		$bd_waist=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',20)->first();
		/******Costume Faq code starts here*****/
		$cosplay_one=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',2)->first();
		$cosplay_one_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',2)->get();
		$cosplay_two=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',3)->first();
		$cosplay_two_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',3)->get();
		$cosplay_three=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',4)->first();
		$cosplay_three_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',4)->get();
		$cosplay_four=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',5)->first();
		$cosplay_four_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',5)->get();
		$cosplay_five=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',21)->first();
		$cosplay_five_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',21)->get();
		/*****costume Faq code ends here***/
		/****Description,funfacts and faq code starts here***/
		$descriptions=DB::table('attributes')
		->leftJoin('attribute_options','attribute_options.attribute_id','=','attributes.attribute_id')
		->select('attributes.attribute_id','attributes.code','attributes.label','attributes.type','attribute_options.option_id','attribute_options.option_value')
		->where('attributes.attribute_id','>=',6)
		->where('attributes.attribute_id','<=',8)
		->get();
		$shippingoptions=DB::table('attributes')
		->leftJoin('attribute_options','attribute_options.attribute_id','=','attributes.attribute_id')
		->select('attributes.attribute_id','attributes.code','attributes.label','attributes.type','attribute_options.option_id','attribute_options.option_value')
		->where('attributes.attribute_id','=',9)
		->first();
		$packageditems=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',10)->first();
		$packageditems_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',10)->get();
		$dimensions=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',11)->first();
		$dimensions_values=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',11)->get();
		//print_r($description);exit;
		$type=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',12)->first();
		$type_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',12)->get();
		$service=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',13)->first();
		$service_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',13)->get();
		$handling=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',14)->first();
		$handling_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',14)->get();
		$returnpolicy=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',15)->first();
		$returnpolicy_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',15)->get();
		$charities=DB::table('charities')->select('id as id','name as name')->get();
		$description=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',6)->first();
		$description_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',6)->get();
		$funfacts=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',7)->first();
		$funfacts_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',7)->get();
		$faq=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',8)->first();
		$faq_value=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',8)->get();
		//print_r($cosplay_one);exit;
		/****Array push code ends here***/
	 return view('admin.costumes.costume_create',compact('title','customers','categories','bd_height',
	 'bd_height_in','bd_weight','bd_chest','bd_waist','cosplay_one','cosplay_one_value','cosplay_two','cosplay_two_value','cosplay_three','cosplay_three_value',
	 'cosplay_four','cosplay_four_value','cosplay_five','cosplay_five_value','descriptions','shippingoptions','packageditems','packageditems_value'
	 ,'dimensions','dimensions_values','type','type_value','service','service_value','handling','returnpolicy','handling_value','returnpolicy_value','charities',
	 'description','description_value','funfacts','funfacts_value','faq','faq_value'));
	}
	/*
	Method Name : insertCostume()
	purpose:insertCostume Method is used to insert the costume into the database
	*/
	public function insertCostume(Request $request){
	  /****Inserting costume codes starts here***/
		  /*echo "<pre>";
		  print_r($request->all());
		  die;*/
	  $response=array();
	  $req=$request->all();
	  $userid=Auth::user()->id;
	  $customer_name=$req['customer_name'];
	  $costume_name=$req['costume_name'];
	  $gender=$req['gender'];
	  $category=$req['category'];
	  $costume_condition=$req['costumecondition'];
	  $size=$req['size'];
	  $heightft=$req['heightft'];
	  $heightin=$req['heightin'];
	  $weightlbs=$req['weightlbs'];
	  $chestin=$req['chestin'];
	  $waistlbs=$req['waistlbs'];
	  $cosplay=$req['cosplay'];
	  $fashion=$req['fashion'];
	  $activity=$req['activity'];
	  $makecostume=$req['make_costume'];
	  $filmquality=$req['fimquality'];
	  $costumedesc=$req['costume_desc'];
	  $funfact=$req['fun_fact'];
	  $faq=$req['faq'];
	  $price=$req['price'];
	  $quantity=$req['quantity'];
	  $shippingoption=$req['shipping_option'];
	  $charityamount=$req['charity_amount'];
	  $charity_name=$req['charity_name'];
	  $dimensions=$req['dimensions'];
	  $type=$req['type'];
	  $service=$req['service'];
	  $zipcode=$req['zipcode'];
	  $handlingtime=$req['handling_time'];
	  $returnpolicy=$req['return_policy'];
	  $packageitems=$req['weight_package_items'];
	 $frontview=$req['img_chan'];
	  $backview=$req['img_chan1'];
	  $details_accessories=$req['img_chan2'];
	 // $multiplefiles=$req['files'];
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
	 //Generating sku number for a costume ends here 
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
		if($customer_name!=0){
		$customerid=$customer_name;
		$customer_group="admin";
		}else{
		$customerid="1";
		$customer_group="admin";
		}
       $costume=array('sku_no'=>$sku_val,
		'gender'=>$gender,
		'condition'=>$costume_condition,
		'created_user_group'=>$customer_group,
		'size'=>$size,
		'created_by'=>$customerid,
		'created_at'=>date('y-m-d H:i:s'),
		'updated_at'=>date('y-m-d H:i:s'),
		'item_location'=>$zipcode,
		'quantity'=>$quantity,
		'price'=>$price,
		'donation_amount'=>$charityamount,
		'charity_id'=>$charity_name,
		);
		$insert_costume=DB::table('costumes')->insert($costume);
		if($insert_costume){
		/*
		|Inserted costume id fetching 
		*/
		$costume_id=DB::table('costumes')->max('costume_id');
	 /*
	 |Tbale:costume_description
	 |@costume_id int
	 |@language_id  int
	 |@name varchar
	 |@description text
	 */
		$costume_description=array('costume_id'=>$costume_id,
		'language_id'=>"1",
		'name'=>$costume_name,
		'description'=>$costumedesc);
		$insert_costume_desc=DB::table('costume_description')->insert($costume_description);
	/*
	|Table:costume_to_category
	|@costume_id int
	|@category_id int
	*/
		$costume_category=array('costume_id'=>$costume_id,
		'category_id'=>$category);
		$insert_costume_category=DB::table('costume_to_category')->insert($costume_category);
		
		/**** Url create start here ***/
			Costumes::urlRewrites($costume_id,'insert');
	    /**** Url create end here ***/
			
	/*****************************Attributes insertion code starts here****/

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
			$cosplay_yes=array('costume_id'=>$costume_id,
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
			$uniquefashion_yes=array('costume_id'=>$costume_id,
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
			$activity_yes=array('costume_id'=>$costume_id,
			'attribute_id'=>'28',
			'attribute_option_value_id'=>$get_attr_opt_value_id->option_id,
			'attribute_option_value'=>$request->activity_yes_opt,
			);
			$uniquefashion_insert=DB::table('costume_attribute_options')->insert($activity_yes);
		}
		/*
		|Table:costume_attribute_options
		|Make a costume if yes 
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
		if (isset($request->make_costume_time) && !empty($request->make_costume_time)) {
			$make_costume_time=array('costume_id'=>$costume_id,
			'attribute_id'=>'29',
			'attribute_option_value_id'=>"0",
			'attribute_option_value'=>$request->make_costume_time,
			);
			$make_costume_timeinsert=DB::table('costume_attribute_options')->insert($make_costume_time);
		}
	/*
	|Table:costume_attribute_options
	|Body dimensions (height-ft,height-in,ewight-lbs,waist-lbs,chest-in)
	|@costume_id
	|@attribute_id
	|@attribute_option_value_id
	|@attribute_option_value
	*/
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
	/*
	|Table:costume_attribute_options
	|Costume FAQ (used for cosplay ?,is your costume have unique fashion?,used for an activity?,you make the costume?,Is the costume fit for film quality?)
	|@costume_id
	|@attribute_id
	|@attribute_option_value_id
	|@attribute_option_value
	*/
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
	/*
	|Table:costume_attribute_options
	|Costume Description,costume funfacts abd costume faq
	|@costume_id
	|@attribute_id
	|@attribute_option_value_id
	|@attribute_option_value
	*/
		$description_val=array('costume_id'=>$costume_id,
		'attribute_id'=>'6',
		'attribute_option_value_id'=>'0',
		'attribute_option_value'=>$costumedesc,
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
	/*
	|Table:costume_attribute_options
	|Costume Pricing
	|@costume_id 
	|@attribute_id
	|@attribute_option_value_id
	|@attribute_option_value
	*/
		$shipping_val=array('costume_id'=>$costume_id,
			'attribute_id'=>'9',
			'attribute_option_value_id'=>$shippingoption,
			'attribute_option_value'=>'Free Shipping',
			);
			
		$shipping_quality=DB::table('costume_attribute_options')->insert($shipping_val);
	/*
	|Table:costume_attribute_options
	|Package Information
	|@costume_id 
	|@attribute_id
	|@attribute_option_value_id
	|@attribute_option_value
	*/
	//weight of packaged items
		switch($packageitems){ case '17': $package="1+ -20lbs"; break; case '18': $package="2+ -201lbs"; break; }
		$package_val=array('costume_id'=>$costume_id,
			'attribute_id'=>'10',
			'attribute_option_value_id'=>$packageitems,
			'attribute_option_value'=>$package,
			);
		$insert_package=DB::table('costume_attribute_options')->insert($package_val);
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
	|Table:costume_image
	|Costume iamges(Front view)
	|@image 
	*/
		if(isset($req['img_chan2'])){ 
			$file_name = str_random(10).'.'.$req['img_chan2']->getClientOriginalExtension();  
			$source_image_path=public_path('costumers_images/Original');
			//$thumb_image_path1=public_path('costumers_images/Original');
			$thumb_image_path1=public_path('costumers_images/Medium');
			$thumb_image_path2=public_path('costumers_images/Small');
			$req['img_chan2']->move($source_image_path, $file_name);
			$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,475,650);
			$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,150,150);
			$data1=array(
			'costume_id'=>$costume_id,
			'image'=>$file_name,
			'type'=>"3");
			$image1_insert=DB::table('costume_image')->insert($data1);
			
		}
	/*
	|Table:costume_image
	|Costume iamges(Back view)
	|@image 
	*/
		if(isset($req['img_chan'])){ 
			$file_name = str_random(10).'.'.$req['img_chan']->getClientOriginalExtension();  
			$source_image_path=public_path('costumers_images/Original');
			//$thumb_image_path1=public_path('costumers_images/Original');
			$thumb_image_path1=public_path('costumers_images/Medium');
			$thumb_image_path2=public_path('costumers_images/Small');
			$req['img_chan']->move($source_image_path, $file_name);
			$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,475,650);
			$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,150,150);
			$data2=array(
			'costume_id'=>$costume_id,
			'image'=>$file_name,
			'type'=>"1");
			$image1_insert=DB::table('costume_image')->insert($data2);
		}
		/*
	|Table:costume_image
	|Costume iamges(Details/Accessories)
	|@image 
	*/
		if(isset($req['img_chan1'])){ 
			$file_name = str_random(10).'.'.$req['img_chan1']->getClientOriginalExtension();  
			$source_image_path=public_path('costumers_images/Original');
			//$thumb_image_path1=public_path('costumers_images/Original');
			$thumb_image_path1=public_path('costumers_images/Medium');
			$thumb_image_path2=public_path('costumers_images/Small');
			$req['img_chan1']->move($source_image_path, $file_name);
			$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,475,650);
			$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,150,150);
			$data2=array(
			'costume_id'=>$costume_id,
			'image'=>$file_name,
			'type'=>"2");
			$image1_insert=DB::table('costume_image')->insert($data2);
		}
	/*
	|Table:costume_image
	|Multiple iamges
	|@image 
	*/

		//moving extra images
	            if (isset($req['files']) && !empty($req['files'])) {
	            	foreach ($req['files'] as $file4) {
	            		$file_name = str_random(10).'.'.$file4->getClientOriginalExtension();
	            		$source_image_path=public_path('costumers_images/Original');
	            		//$thumb_image_path1=public_path('costumers_images/Original');
	            		$thumb_image_path2=public_path('costumers_images/Medium');
	            		$thumb_image_path3=public_path('costumers_images/Small');
	            		//file3 moving to folder
			            $file4->move($source_image_path, $file_name);
			            // $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,150,150);
			            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,475,650);
			            $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path3.'/'.$file_name,150,150);
			            //inserting in db
	            		$file_db_array4 = array('costume_id'=>$costume_id,
	            			'image'=>$file_name,
	            			'type'=>4,
	            			'sort_order'=>0,
	            		);
	            		$file_db=DB::table('costume_image')->insert($file_db_array4);
	            	}
	            }
		
		}
		 Session::flash('success', 'Costume Created Successfully');
          return Redirect::back();

		
	}
	/*
	Method Name :editCostume()
	purpose:editCostume Method is used to show the edit page of costumes***/
	public function editCostume(){
	  /*****Show costume edit page***/
	}
	/*
	Method Name :updateCostume()
	Purpose:updateCostume Method is used to update the costume details***/
	public function updateCostume(){
	
	}
	/*
	Method name:deleteCostume()
	purpose:deletCostume Method is used to delete the costume
	*/
	public function deleteCostume(){
	
	}
	/*
	Method Name:searchCostume()
	purpose:searchCostume is used to search the costume
	*/
	public function searchCostume(){
	
	}
	public function post_upload(Request $request){

		        $image = $request->file('file');
				

        $imageName = time().$image->getClientOriginalName();
		echo $imageName;exit;

        $image->move(public_path('img'),$imageName);

        return response()->json(['success'=>$imageName]);
	}


}

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
use Image;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use App\Costumes;
use App\Imageresize;
use App\Helpers\Site_model;

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
	 $customers=DB::table('users')->select('id as id','username')
	 ->where('role_id','!=','1')
	 ->where('active','=','1')
	 ->where('username', '!=', '')
	 ->orderby('username','ASC')
	 ->get();
	 /*******Array push for both categories and subcategories displaying code starts here*****/
	 $categories = array('modules_result'=>array());
		/****Getting the hotel feautures code starts here***/
		$hotelfeautures =\DB::table('category')->where('parent_id','=','0')->orderby('sort_order','asc')->get();
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
           				->select('cc.category_id as subcategoryid','cc.name as subcategoryname')->where('cc.status',1)->where($where)->orderby('cc.sort_order','asc')->get();
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

		$handwashed=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','31')->get();

		$cosplaySubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>66,'status'=>1));
		//$cos_data = DB::table('costume_description')->where('costume_id',$id)->first();

		$cos_data = '';
		$uniqueFashionSubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>143,'status'=>1 ));

		$filmTheatreSubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>147,'status'=>1));

		//print_r($charities);exit;
		/****Array push code ends here***/
	 return view('admin.costumes.costume_create',compact('title','customers','categories','bd_height',
	 'bd_height_in','bd_weight','bd_chest','bd_waist','cosplay_one','cosplay_one_value','cosplay_two','cosplay_two_value','cosplay_three','cosplay_three_value',
	 'cosplay_four','cosplay_four_value','cosplay_five','cosplay_five_value','descriptions','shippingoptions','packageditems','packageditems_value','cos_data','dimensions','dimensions_values','type','type_value','service','service_value','handling','returnpolicy','handling_value','returnpolicy_value','charities','handwashed',
	 'description','description_value','funfacts','funfacts_value','faq','faq_value','cosplaySubCategories','uniqueFashionSubCategories','filmTheatreSubCategories'));
	}
	/*
	Method Name : insertCostume()
	purpose:insertCostume Method is used to insert the costume into the database
	*/
	public function insertCostume(Request $request){
	  /****Inserting costume codes starts here***/

	  	$response=array();
		$req=$request->all();
		//echo "<pre>"; print_r($req); exit;
		//dd($final_keywords);
		$userid = Auth::user()->id;
		$customer_name=$req['customer_name'];
		if($customer_name == 1){
			$customer_group = "admin";
		}else{
			$customer_group = "user";
		}
		$costume_name=$req['costume_name'];
		$costume_cost=$req['costume_cost'];
		$gender=$req['gender'];
		$category=$req['category'];
		$costume_condition=$req['costumecondition'];
		$size=$req['size'];  

		$makecostume=$req['make_costume'];
		$filmquality=$req['fimquality'];
		$description=$req['costume_desc'];
		if(isset($req['cleaned']) && !empty($req['cleaned'])){
			$cleaned = $req['cleaned'];		
		}else{
			$cleaned = "";	
		}
		

		$faq=$req['faq'];
		$price=$req['price'];
		$quantity=$req['quantity'];
		$charityamount=$req['hidden_donation_amount'];
		$charity_name=$req['charity_name'];

		$weight_pounds = $req['pounds'];
		if(isset($req['ounces'])){
	  		$weight_ounces = $req['ounces'];	
	  	}else{
	  		$weight_ounces = 0;
	  	}
		
		if($request->has('dimensionsdimensionsLength')){
			$length = $req['dimensionsdimensionsLength'];	
		}
		if($request->has('dimensionsdimensionsWidth')){
			$width = $req['dimensionsdimensionsWidth'];	
		}
		if($request->has('dimensionsdimensionsHeight')){
			$height = $req['dimensionsdimensionsHeight'];	
		}

		$handlingtime = $req['handling_time'];
		$returnpolicy = $req['return_policy'];
		$frontview = $req['img_chan'];
		
		$customerid = $customer_name;
		$get_cat_id = DB::table('category')->where('category_id',$category)->first();
		$costume = array(
			'weight_pounds'=>$req['pounds'],
			'weight_ounces'=>$weight_ounces,
			'gender'=>$gender,
			'condition'=>$costume_condition,
			'created_user_group'=>$customer_group,
			'size'=>$size,
			'costume_cost'=>$costume_cost,
			'condition_type' => $cleaned,
			'created_by'=>$customerid,
			'created_at'=>date('y-m-d H:i:s'),
			'cat_id'=>$get_cat_id->parent_id
		);
       
		$costume_id = DB::table('costumes')->insertGetId($costume);
		$insert_costume = $costume_id;
		DB::update("UPDATE `cc_costumes` SET `unq_costume_code` = ENCRYPT(costume_id , CONCAT('$6$', SHA2(RANDOM_BYTES(64), '256'))) WHERE unq_costume_code IS NULL");
		if($insert_costume){
			if (isset($request['Imagecrop1']) && !empty($request['Imagecrop1'])) {
				$Imagecrop1 = $request->Imagecrop1;
				$img = str_replace('data:image/jpeg;base64,', '', $Imagecrop1);
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);
				$source = imagecreatefromstring($data);
				$Orand = str_random(10) . '.png';
				$originalPath = public_path('costumers_images/Original/').$Orand;
				$data1 = $Orand;
				$OriginalImage = file_put_contents($originalPath, $data);

				$Mediumresizeimg = Image::make($originalPath);
				//$Mrand = str_random(10) . '.png';
				$Mediumresizeimg->resize(260, 434);

				$Mediumresizeimg->save(public_path('costumers_images/Medium/').$Orand);


				$Smallresizeimg = Image::make($originalPath);
				//$Srand = str_random(10) . '.png';
				$Smallresizeimg->resize(140, 233);

				$Smallresizeimg->save(public_path('costumers_images/Small/').$Orand);


				$Largeresizeimg = Image::make($originalPath);
				//$Lrand = str_random(10) . '.png';
				$Largeresizeimg->resize(475, 792);

				$Largeresizeimg->save(public_path('costumers_images/Large/').$Orand);

				$ExLargeresizeimg = Image::make($originalPath);
			    $ExLargeresizeimg->resize(889, 1482);
			    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Orand);
			    chmod(public_path('costumers_images/ExLarge/').$Orand, 0777);


				if($OriginalImage)
				{
					$file_db_array1 = array('costume_id'=>$costume_id,
						'image'=>$data1,
						'type'=>1,
						'sort_order'=>0,
					);
					$file_db=DB::table('costume_image')->insert($file_db_array1);
				}
			}
			if (isset($request['Imagecrop2']) && !empty($request['Imagecrop2'])) {
				$Imagecrop2 = $request->Imagecrop2;
				$img1 = str_replace('data:image/jpeg;base64,', '', $Imagecrop2);
				$img1 = str_replace(' ', '+', $img1);
				$data1 = base64_decode($img1);
				$source = imagecreatefromstring($data1);
				$Orand = str_random(10) . '.png';
				$originalPath1 = public_path('costumers_images/Original/').$Orand;
				$data2 = $Orand;
				$OriginalImage2 = file_put_contents($originalPath1, $data1);

				$Mediumresizeimg = Image::make($originalPath1);
				//$Mrand = str_random(10) . '.png';
				$Mediumresizeimg->resize(260, 434);

				$Mediumresizeimg->save(public_path('costumers_images/Medium/').$Orand);

				$Smallresizeimg = Image::make($originalPath1);
				//$Srand = str_random(10) . '.png';
				$Smallresizeimg->resize(140, 233);

				$Smallresizeimg->save(public_path('costumers_images/Small/').$Orand);

				$Largeresizeimg = Image::make($originalPath1);
				//$Lrand = str_random(10) . '.png';
				$Largeresizeimg->resize(475, 792);

				$Largeresizeimg->save(public_path('costumers_images/Large/').$Orand);

				$ExLargeresizeimg = Image::make($originalPath1);
			    $ExLargeresizeimg->resize(889, 1482);
			    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Orand);
			    chmod(public_path('costumers_images/ExLarge/').$Orand, 0777);

				//$file2 = Imageresize::CreateCostumeFrontend2($request->file2);

				if($OriginalImage2)
				{
					$file_db_array2 = array('costume_id'=>$costume_id,
						'image'=>$data2,
						'type'=>2,
						'sort_order'=>0,
					);
					$file_db=DB::table('costume_image')->insert($file_db_array2);
				}
			}


			if (isset($request['Imagecrop3']) && !empty($request['Imagecrop3'])) {

				$Imagecrop3 = $request->Imagecrop3;
				$img2 = str_replace('data:image/jpeg;base64,', '', $Imagecrop3);
				$img2 = str_replace(' ', '+', $img2);
				$data2 = base64_decode($img2);
				$source = imagecreatefromstring($data2);
				$Orand = str_random(10) . '.png';
				$originalPath2 = public_path('costumers_images/Original/').$Orand;
				$data3 = $Orand;
				$OriginalImage2 = file_put_contents($originalPath2, $data2);
				$Mediumresizeimg = Image::make($originalPath2);
				//$Mrand = str_random(10) . '.png';
				$Mediumresizeimg->resize(260, 434);

				$Mediumresizeimg->save(public_path('costumers_images/Medium/').$Orand);
				$Smallresizeimg = Image::make($originalPath2);
				//$Srand = str_random(10) . '.png';
				$Smallresizeimg->resize(140, 233);
				$Smallresizeimg->save(public_path('costumers_images/Small/').$Orand);
				$Largeresizeimg = Image::make($originalPath2);
				//$Lrand = str_random(10) . '.png';
				$Largeresizeimg->resize(475, 792);

				$Largeresizeimg->save(public_path('costumers_images/Large/').$Orand);

				$ExLargeresizeimg = Image::make($originalPath2);
			    $ExLargeresizeimg->resize(889, 1482);
			    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Orand);
			    chmod(public_path('costumers_images/ExLarge/').$Orand, 0777);

				//$file3 = Imageresize::CreateCostumeFrontend3($request->file3);

				//inserting in db
				$file_db_array3 = array('costume_id'=>$costume_id,
					'image'=>$data3,
					'type'=>3,
					'sort_order'=>0,
				);
				$file_db=DB::table('costume_image')->insert($file_db_array3);
			}


			if (isset($request['multi']) && !empty($request['multi'])) {
				foreach ($request['multi'] as $file4) {
					$multiImagecrop = $file4;
					$img = str_replace('data:image/jpeg;base64,', '', $multiImagecrop);
					$img = str_replace(' ', '+', $img);
					$data = base64_decode($img);
					//$source = imagecreatefromstring($data);
					$Multiplerand = str_random(10) . '.png';
					$originalPath = public_path('costumers_images/Original/').$Multiplerand;
					$multidata = $Multiplerand;
					$OriginalImage = file_put_contents($originalPath, $data);

					$Mediumresizeimg = Image::make($originalPath);
					//$Mrand = str_random(10) . '.png';
					$Mediumresizeimg->resize(260, 434);

					$Mediumresizeimg->save(public_path('costumers_images/Medium/').$Multiplerand);


					$Smallresizeimg = Image::make($originalPath);
					//$Srand = str_random(10) . '.png';
					$Smallresizeimg->resize(140, 233);

					$Smallresizeimg->save(public_path('costumers_images/Small/').$Multiplerand);


					$Largeresizeimg = Image::make($originalPath);
					//$Lrand = str_random(10) . '.png';
					$Largeresizeimg->resize(475, 792);

					$Largeresizeimg->save(public_path('costumers_images/Large/').$Multiplerand);

					$ExLargeresizeimg = Image::make($originalPath);
				    $ExLargeresizeimg->resize(889, 1482);
				    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Multiplerand);
				    chmod(public_path('costumers_images/ExLarge/').$Multiplerand, 0777);

					$file_db_array4 = array('costume_id'=>$costume_id,
						'image'=>$multidata,
						'type'=>4,
						'sort_order'=>0,
					);
					$file_db=DB::table('costume_image')->insert($file_db_array4);
				}
			}

		 /*
		 |Tbale:costume_description
		 |@costume_id int
		 |@language_id  int
		 |@name varchar
		 |@description text
		 */
 

		    $final_keywords = array();
			if(!empty($request->keyword_10)){
				$final_keywords[1] = $request->keyword_10;
			}
			if(!empty($request->keyword_9)){
				$final_keywords[2] = $request->keyword_9;
			}
			if(!empty($request->keyword_8)){
				$final_keywords[3] = $request->keyword_8;
			}
			if(!empty($request->keyword_7)){
				$final_keywords[4] = $request->keyword_7;
			}
			if(!empty($request->keyword_6)){
				$final_keywords[5] = $request->keyword_6;
			}
			if(!empty($request->keyword_5)){
				$final_keywords[6] = $request->keyword_5;
			}
			if(!empty($request->keyword_4)){
				$final_keywords[7] = $request->keyword_4;
			}
			if(!empty($request->keyword_3)){
				$final_keywords[8] = $request->keyword_3;
			}
			if(!empty($request->keyword_2)){
				$final_keywords[9] = $request->keyword_2;
			}
			if(!empty($request->keyword_1)){
				$final_keywords[10] = $request->keyword_1;
			}
			$final_keywords = implode(",", $final_keywords);

		$costume_description = array('costume_id'=>$costume_id,
									'language_id'=>"1",
									'keywords'=>$final_keywords,
									'name'=>$costume_name,
									'description'=>$description
								);
		$insert_costume_desc = DB::table('costume_description')->insert($costume_description);
		/*
		|Table:costume_to_category
		|@costume_id int
		|@category_id int
		*/
		$costume_category = array('costume_id'=>$costume_id,
								  'category_id'=>$category,
								  'sort_no'=>'1'
								);
		$insert_costume_category = DB::table('costume_to_category')->insert($costume_category);
		
		/**** Url create start here ***/
		Costumes::urlRewrites($costume_id,'insert');
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
			
			$make_costume_time = array('costume_id'=>$insert_costume,
										'attribute_id'=>'29',
										'attribute_option_value_id'=>"0",
										'attribute_option_value'=>$request->make_costume_time,
									);
			$make_costume_timeinsert = DB::table('costume_attribute_options')->insert($make_costume_time);
		}
		/*
		|Table:costume_attribute_options
		|Film Quality if yes 
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
		if (isset($request->film_name) && !empty($request->film_name)) {
			$film_name = array('costume_id'=>$insert_costume,
								'attribute_id'=>'30',
								'attribute_option_value_id'=>"0",
								'attribute_option_value'=>$request->film_name,
							);
			$make_costume_timeinsert = DB::table('costume_attribute_options')->insert($film_name);
		}
		/*
		|Table:costume_attribute_options
		|Cosplay if yes 
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
		/*if (isset($request->cosplayplay_yes_opt) && !empty($request->cosplayplay_yes_opt)) {
			$get_attr_opt_value_id = DB::table('attribute_options')->where('option_value',$request->cosplayplay_yes_opt)->first(['option_id']);
			
			$cosplay_yes = array('costume_id'=>$insert_costume,
			'attribute_id'=>'25',
			'attribute_option_value_id'=>$get_attr_opt_value_id->option_id,
			'attribute_option_value'=>$request->cosplayplay_yes_opt,
			);
			$cosplay_yes_insert=DB::table('costume_attribute_options')->insert($cosplay_yes);
		}*/

		/*
		|Table:costume_attribute_options
		|Unique fashion if yes 
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
		/*if (isset($request->uniquefashion_yes_opt) && !empty($request->uniquefashion_yes_opt)) {
			$get_attr_opt_value_id = DB::table('attribute_options')->where('option_value',$request->uniquefashion_yes_opt)->first(['option_id']);
			$uniquefashion_yes=array('costume_id'=>$insert_costume,
			'attribute_id'=>'26',
			'attribute_option_value_id'=>$get_attr_opt_value_id->option_id,
			'attribute_option_value'=>$request->uniquefashion_yes_opt,
			);
			$uniquefashion_insert=DB::table('costume_attribute_options')->insert($uniquefashion_yes);
		}*/

		/*
		|Table:costume_attribute_options
		|Activity fashion if yes 
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
		/*if (isset($request->activity_yes_opt) && !empty($request->activity_yes_opt)) {
			$get_attr_opt_value_id = DB::table('attribute_options')->where('option_value',$request->activity_yes_opt)->first(['option_id']);
			$activity_yes=array('costume_id'=>$insert_costume,
			'attribute_id'=>'28',
			'attribute_option_value_id'=>$get_attr_opt_value_id->option_id,
			'attribute_option_value'=>$request->activity_yes_opt,
			);
			$uniquefashion_insert=DB::table('costume_attribute_options')->insert($activity_yes);
		}*/


		/*
		|Table:costume_attribute_options
		|Body dimensions (height-ft,height-in,ewight-lbs,waist-lbs,chest-in)
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
		


			/*
			|Table:costume_attribute_options
			|Costume FAQ (used for cosplay ?,is your costume have unique fashion?,used for an activity?,you make the costume?,Is the costume fit for film quality?)
			|@costume_id
			|@attribute_id
			|@attribute_option_value_id
			|@attribute_option_value
			*/
			/*switch($cosplay){ case '7': $cosplay_value="yes"; break; case '8': $cosplay_value="No"; break; }
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
			$activity_val_insert=DB::table('costume_attribute_options')->insert($activity_val);*/

		if($request->has('heightft'))
		{
			$heightft=$req['heightft'];
			$height_ft = array('costume_id'=>$insert_costume,
							'attribute_id'=>'16',
							'attribute_option_value_id'=>'0',
							'attribute_option_value'=>$heightft,
						);
			$height_ft_insert = DB::table('costume_attribute_options')->insert($height_ft);
		}
		if($request->has('heightin'))
		{
			$heightin=$req['heightin'];
			$height_in = array('costume_id'=>$insert_costume,
								'attribute_id'=>'17',
								'attribute_option_value_id'=>'0',
								'attribute_option_value'=>$heightin,
							);
			$height_in_insert = DB::table('costume_attribute_options')->insert($height_in);
		}

		if($request->has('weightlbs'))
		{
			$weightlbs=$req['weightlbs'];
			$weight_lbs = array('costume_id'=>$insert_costume,
								'attribute_id'=>'18',
								'attribute_option_value_id'=>'0',
								'attribute_option_value'=>$weightlbs,
							);
			$weight_lbs_insert = DB::table('costume_attribute_options')->insert($weight_lbs);
		}

		if($request->has('chestin'))
		{
			$chestin=$req['chestin'];
			$chest_in = array('costume_id'=>$insert_costume,
								'attribute_id'=>'19',
								'attribute_option_value_id'=>'0',
								'attribute_option_value'=>$chestin,
							);
			$chest_in_insert = DB::table('costume_attribute_options')->insert($chest_in);
		}
		if($request->has('waistlbs'))
		{
			$waistlbs=$req['waistlbs'];
			$waist_lbs = array('costume_id'=>$insert_costume,
								'attribute_id'=>'20',
								'attribute_option_value_id'=>'0',
								'attribute_option_value'=>$waistlbs,
							);
			$waist_lbs_insert = DB::table('costume_attribute_options')->insert($waist_lbs);
		}	



			//User Costumes
		switch($makecostume){ 
			case '30': 
				$makecostume_value="yes"; 
				break; 
			case '31': 
				$makecostume_value="No"; 
				break; 
		}
		$user_costume = array('costume_id'=>$insert_costume,
								'attribute_id'=>'5',
								'attribute_option_value_id'=>$makecostume,
								'attribute_option_value'=>$makecostume_value,
							);
		$user_costume_insert = DB::table('costume_attribute_options')->insert($user_costume);
		//film Quality
		switch($filmquality){ 
			case '32': 
				$filmquality_value="yes"; 
				break; 
			case '33': 
				$filmquality_value="No"; 
				break; 
		}
		$film_quality = array('costume_id'=>$insert_costume,
								'attribute_id'=>'21',
								'attribute_option_value_id'=>$filmquality,
								'attribute_option_value'=>$filmquality_value,
							);
		$filmquality_insert = DB::table('costume_attribute_options')->insert($film_quality);


		/*
		|Table:costume_attribute_options
		|Costume Description,costume funfacts abd costume faq
		|@costume_id
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/
		$description_val = array('costume_id'=>$insert_costume,
								'attribute_id'=>'6',
								'attribute_option_value_id'=>'0',
								'attribute_option_value'=>$description,
							);
		$description_insert = DB::table('costume_attribute_options')->insert($description_val);
		//Funfact
		/*$funfact_val=array('costume_id'=>$insert_costume,
		'attribute_id'=>'7',
		'attribute_option_value_id'=>'0',
		'attribute_option_value'=>$funfacts,
		);
		$funfact_insert=DB::table('costume_attribute_options')->insert($funfact_val);*/
		//faq
		$faq_value = array('costume_id'=>$insert_costume,
							'attribute_id'=>'8',
							'attribute_option_value_id'=>'0',
							'attribute_option_value'=>$faq,
						);
		$faq_insert = DB::table('costume_attribute_options')->insert($faq_value);

		$price = $req['price'];
	  	$quantity = $req['quantity'];
		  	/*$length = $req['Length'];
		  	$width = $req['Width'];
		  	$height = $req['Height'];*/

		  	/*
			 |Tbale:costumes
			 |@price varchar
			 |@quantity  enum
			 
			 */
			//Check whether the costume inserted by admin or not if the user is selected insert the user id else insert the admin as costumer
		$sku_no = "CS000".$costume_id;
		$costume = array('price'=>$price,
						'sku_no'=>$sku_no,
						'quantity'=>$quantity,
						'updated_at'=>date('y-m-d H:i:s'),
					);

		$update_costume = DB::table('costumes')->where('costume_id',$costume_id)->update($costume);

			//length
		if (!empty($length)) {
			
			$length = array('costume_id'=>$costume_id,
						'attribute_id'=>'22',
						'attribute_option_value_id'=>0,
						'attribute_option_value'=>$length,
					);
			$length_db=DB::table('costume_attribute_options')->insert($length);
		}
			//width
		if (!empty($width)) {
			
			$width = array('costume_id'=>$costume_id,
							'attribute_id'=>'23',
							'attribute_option_value_id'=>0,
							'attribute_option_value'=>$width,
						);
			$width_db=DB::table('costume_attribute_options')->insert($width);
		}
		//height
		if (!empty($height)) {
			
			$height = array('costume_id'=>$costume_id,
							'attribute_id'=>'24',
							'attribute_option_value_id'=>0,
							'attribute_option_value'=>$height,
						);
			$width_db = DB::table('costume_attribute_options')->insert($height);
		}

		$req=$request->all();
		$userid=Auth::user()->id;

		  	//$returnpolicy=$req['returnpolicy'];
		  	//$donate_charity=$req['donate_charity'];
		  	/*
			|Table:costume_attribute_options
			|Preferences
			|@costume_id 
			|@attribute_id
			|@attribute_option_value_id
			|@attribute_option_value
			*/
			//Handling Time
		/*switch($handlingtime){ case '26': $handlingtime_name="Same Business Day"; break; case '27': $handlingtime_name="10 Business Days"; break; }
		$handlingtime_val=array('costume_id'=>$costume_id,
			'attribute_id'=>'14',
			'attribute_option_value_id'=>$handlingtime,
			'attribute_option_value'=>$handlingtime_name,
			);*/

		$handling_name = DB::table('attribute_options')
							->select('option_value as value')
							->where('attribute_id','=','14')
							->where('option_id',$handlingtime)
							->first();

		$handlingtime_val=array('costume_id'=>$costume_id,
			'attribute_id'=>'14',
			'attribute_option_value_id'=>$handlingtime,
			'attribute_option_value'=>$handling_name->value,
			);
		$insert_handlingtime=DB::table('costume_attribute_options')->insert($handlingtime_val);
		//Return Policy
		/*switch($returnpolicy){ case '28': $returnpolicy_name="Return Accepted"; break; case '29': $returnpolicy_name="Return Not Accepted "; break; }
		$returnpolicy_val=array('costume_id'=>$costume_id,
			'attribute_id'=>'15',
			'attribute_option_value_id'=>$returnpolicy,
			'attribute_option_value'=>$returnpolicy_name,
			);*/

		$returnpolicy_name = DB::table('attribute_options')
							->select('option_value as value')
							->where('attribute_id','=','15')
							->where('option_id',$returnpolicy)
							->first();

		$returnpolicy_val=array('costume_id'=>$costume_id,
			'attribute_id'=>'15',
			'attribute_option_value_id'=>$returnpolicy,
			'attribute_option_value'=>$returnpolicy_name->value,
			);
		$insert_returnpolicy=DB::table('costume_attribute_options')->insert($returnpolicy_val);

		if (isset($req['charity_name']) && !empty($req['charity_name'])) {
			
		$costume=array('charity_id'=>$req['charity_name'],
						'donation_amount'=>$req['hidden_donation_amount'],
						'dynamic_percent'=>$req['donate_charity'],
						'updated_at'=>date('y-m-d H:i:s'),
					);

		$update_costume = DB::table('costumes')->where('costume_id',$costume_id)->update($costume);
		}

		DB::update('update cc_costumes set donating_percent = FORMAT(`donation_amount`/`price`,2)*100  where costume_id = ?', [$costume_id]);

		/*if (isset($req['organzation_name']) && !empty($req['organzation_name'])) {
			$organzation_name=$req['organzation_name'];
			$arrayName = array('name' => $organzation_name,
				'costume_id'=>$costume_id,
				'suggested_by'=>$userid,
				'status'=>'0',
				'created_at'=>date('y-m-d H:i:s'),
				'updated_at'=>date('y-m-d H:i:s'),
				 );
			$organzation_name=DB::table('charities')->insert($arrayName);
		}*/

		}
		if ($customerid != 1) {
			$get_user_name = DB::table('users')->where('id',$customerid)->first(['first_name','email']);
			// send mail
			$reg_subject        = "Costume Created";
			$reg_data           = array('name'=>$get_user_name->first_name,'costume_name'=>$costume_name);
			$template           = 'emails.admincreatecostume';
	        $reg_to             = $get_user_name->email;
			$mail_status        = $this->sitehelper->sendmail($reg_to,$reg_subject,$template,$reg_data);
			// end mail
		}
	
		 Session::flash('success', 'Costume Created Successfully');
          return Redirect::to('customes-list');

		
	}
	public function getReportedCostumes(){
        return view('admin.costumes.ReportedCostumes.reported_costumes_list');
	}
    public function getReportedCostumesData(Request $request){
		$req=$request->all();
		$where="where 1";
		if(count($req)){
			if(!empty($req['search']['sku_no']) ){
				$where.=' AND cst.sku_no="'.$req['search']['sku_no'].'"';
			}
			if(!empty($req['search']['cst_name']) ){
					$where.=' AND dsc.name LIKE "%'.$req['search']['cst_name'].'%"';
			}
			if(!empty($req['search']['user_name']) ){
					$where.=' AND report.name LIKE "%'.$req['search']['user_name'].'%"';
			}
		}
		$costume_reports = DB::select('SELECT cst.costume_id,cst.sku_no,dsc.name as cst_name ,report.name as user_name,report.phn_no,report.email,report.reason,DATE_FORMAT(report.created_at,"%m/%d/%Y %h:%i %p") as date FROM `cc_reported_costumes` as report LEFT JOIN cc_costumes as cst on cst.costume_id=report.costume_id LEFT JOIN cc_costume_description as dsc on dsc.costume_id=cst.costume_id '.$where.' order by report.id desc');
		return response()->success(compact('costume_reports'));
	}

	
	public function post_upload(Request $request){

		$image = $request->file('file');
				

        $imageName = time().$image->getClientOriginalName();
		//echo $imageName;exit;

        $image->move(public_path('img'),$imageName);

        return response()->json(['success'=>$imageName]);
	}

	public function Getallcostumes(){
	
		$costumes=DB::table('costumes as c')
		->leftJoin('costume_description as cd','cd.costume_id','=','c.costume_id')
		->leftJoin('users as u','u.id','=','c.created_by')
		->leftJoin('costume_to_category as ctc','ctc.costume_id','=','c.costume_id')
		->leftJoin('category as cat','cat.category_id','=','ctc.category_id')
		->where('c.deleted_status',0)
		->select('c.sku_no as sku_no',
			'cd.name as custome_name',
			'u.display_name as customer_name','cat.name as cat_name',
			'c.condition as custome_condition',
		    DB::Raw("DATE_FORMAT(cc_c.created_at,'%m/%d/%y %h:%i %p') as custome_created_at"),
			'c.status as custome_status','c.is_featured as is_featured',
			'c.costume_id as costumeid','c.price as price')
            ->groupby('costumeid')
		->get();

		//echo "<pre>";print_r($costumes);die;	
		return Datatables::of($costumes)
        ->addColumn('actions', function ($costumes) {
                return '<a href="/custome-listing/'.$costumes->costumeid.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a href="javascript:void(0);" onclick="deletecostume('.$costumes->costumeid.')" class="btn btn-xs btn-danger delete_user"><i class="fa fa-trash-o"></i></a>';
            })
            ->addColumn('price', function ($costumes) {
                return '$'.$costumes->price.'';
            }) 
		->editColumn('status', function ($costumes) {
					if ($costumes->custome_status == 'active') {
						$costume_status = "1";
					}else{
						$costume_status = "0";
					}
                   $a = $costume_status == '1' ? 'checked' : '';
                   return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $costumes->costumeid .'" onClick="changeCostumeStatus('.$costumes->costumeid.','.$costume_status.');">
                                   <div class="slider round"></div>
                               </label>';
                   })
		->editColumn('is_featured', function ($costumes) {
					if ($costumes->is_featured == '1') {
						$costume_status = "1";
					}else{
						$costume_status = "0";
					}
                   $a = $costume_status == '1' ? 'checked' : '';
                   return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $costumes->costumeid .'" onClick="changeFeaturedStatus('.$costumes->costumeid.','.$costume_status.');">
                                   <div class="slider round"></div>
                               </label>';
                   })
                   ->editColumn('custome_condition', function ($costumes) {
                        $costume_cond = "";
                        if ($costumes->custome_condition == 'brand_new') {
                                $costume_cond = "Brand New";
                        }elseif($costumes->custome_condition == 'like_new'){
                                $costume_cond = "Like New";
                        }else{
                                $costume_cond = $costumes->custome_condition;
                        }
			return ucwords($costume_cond);
                   })
        ->make(true);
	}

	public function CostumeList($id){

		//echo "<pre>";print_r($id);die;
		$this->data = array();

		$this->data['costumes_data'] = DB::table('costumes as c')->where('c.costume_id',$id)
		->leftJoin('users as u','c.created_by','u.id')
		->leftJoin('costume_description as cd','c.costume_id','cd.costume_id','c.condition_type')
		->leftjoin('attribute_options as ao','ao.option_id','c.condition_type')
		->select('u.id as u_customer_id','u.display_name as customer_name','cd.name as costume_name',
			'c.costume_cost as costume_cost','c.gender as cos_gender','c.condition as cos_condition',
			'c.price as cos_price','c.condition_type','c.quantity as cos_quantity','c.size as cos_size','ao.*',
			'c.charity_id as cos_charity_id','cd.description as cos_description','cd.keywords as cos_keywords','c.item_location as item_location','c.donation_amount as donation_amount','c.costume_id as costume_id','c.dynamic_percent as donation_percent','c.weight_pounds as weight_pounds','c.weight_ounces as weight_ounces')
		->first();
		//dd($this->data['costumes_data']);
		$this->data['costume_image1'] = DB::table('costume_image')->where('costume_id',$id)->where('type','1')->first();
		$this->data['costume_image2'] = DB::table('costume_image')->where('costume_id',$id)->where('type','2')->first();
		$this->data['costume_image3'] = DB::table('costume_image')->where('costume_id',$id)->where('type','3')->first();
		$this->data['costume_images'] = DB::table('costume_image')->where('costume_id',$id)->where('type','4')->get();
		/*******Array push for both categories and subcategories displaying code starts here*****/
		$this->data['categories']=array('modules_result'=>array());
		/****Getting the hotel feautures code starts here***/
		$hotelfeautures =\DB::table('category')->where('parent_id','=','0')->orderby('sort_order','asc')->get();
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
       				->select('cc.category_id as subcategoryid','cc.name as subcategoryname')->where($where)->orderby('cc.sort_order','asc')->get();
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
				array_push($this->data['categories']['modules_result'],$module_array);
			} 
		}
		//all_attributes_options
		$this->data['get_costume_attribute_options'] = DB::table('costume_attribute_options')->where('costume_id',$id)->get();
		foreach ($this->data['get_costume_attribute_options'] as  $costume_attribute_optionsvalue) {
			$this->data['costume_attribute_options'] = $costume_attribute_optionsvalue;
		}

		//print_r($categories); exit;
		$this->data['bd_height']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',16)->first();
		$this->data['bd_height_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',16)->first();
		$this->data['bd_height_in']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',17)->first();
		$this->data['bd_height_in_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',17)->first();
        $this->data['bd_weight']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',18)->first();
		$this->data['bd_weight_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',18)->first();
		$this->data['bd_chest']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',19)->first();
		$this->data['bd_chest_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',19)->first();
		$this->data['bd_waist']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',20)->first();
		$this->data['bd_waist_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',20)->first();
		/******Costume Faq code starts here*****/
		$this->data['cosplay_one']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',2)->first();
		$this->data['cosplay_one_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',2)->get();
		$this->data['cosplay_one_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',2)->first();
		//echo "<pre>"; print_r($this->data['cosplay_one_value_value']);die;
		$this->data['cosplay_two']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',3)->first();
		$this->data['cosplay_two_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',3)->get();
		$this->data['cosplay_two_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',3)->first();
		$this->data['cosplay_three']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',4)->first();
		$this->data['cosplay_three_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',4)->get();
		$this->data['cosplay_three_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',4)->first();
		$this->data['cosplay_four']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',5)->first();
		$this->data['cosplay_four_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',5)->get();
		$this->data['cosplay_four_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',5)->first();
		$this->data['cosplay_five']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',21)->first();
		$this->data['cosplay_five_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',21)->get();
		$this->data['cosplay_five_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',21)->first();
		$this->data['cosplayplay_yes_opt'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','25')->first();
		$this->data['uniquefashion_yes_opt'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','26')->first();
		$this->data['activity_yes_opt'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','28')->first();
		$this->data['make_costume_time'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','29')->first();
		$this->data['film_name'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','30')->first();

		$this->data['cos_data'] = DB::table('costume_description')->where('costume_id',$id)->first();


		/****Description,funfacts and faq code starts here***/
		$this->data['descriptions']=DB::table('attributes')
		->leftJoin('attribute_options','attribute_options.attribute_id','=','attributes.attribute_id')
		->select('attributes.attribute_id','attributes.code','attributes.label','attributes.type','attribute_options.option_id','attribute_options.option_value')
		->where('attributes.attribute_id','>=',6)
		->where('attributes.attribute_id','<=',8)
		->get();
		
		$this->data['shippingoptions']=DB::table('attributes')
		->leftJoin('attribute_options','attribute_options.attribute_id','=','attributes.attribute_id')
		->select('attributes.attribute_id','attributes.code','attributes.label','attributes.type','attribute_options.option_id','attribute_options.option_value')
		->where('attributes.attribute_id','=',9)
		->first();

		$this->data['shippingoptions_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',9)->first();
		$this->data['packageditems']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',10)->first();
		$this->data['packageditems_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',10)->get();
		$this->data['packageditems_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',10)->first();
		//print_r($this->data['packageditems_value_value']);exit;
		$this->data['dimensions']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',11)->first();

		$this->data['dimensions_length'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','22')->first();
		$this->data['dimensions_width'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','23')->first();
		$this->data['dimensions_height'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','24')->first();
		$this->data['dimensions_values'] = "";
		//echo "<pre>";print_r($this->data['dimensions_values']);exit;
		$this->data['type']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',12)->first();
		$this->data['type_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',12)->get();
		$this->data['type_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',12)->first();
		$this->data['service']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',13)->first();
		$this->data['service_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',13)->get();
		$this->data['service_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',13)->first();
		$this->data['handling']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',14)->first();
		$this->data['handling_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',14)->get();
		$this->data['handling_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',14)->first();
		$this->data['returnpolicy']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',15)->first();
		$this->data['returnpolicy_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',15)->get();
		$this->data['returnpolicy_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',15)->first();
		$this->data['charities']=DB::table('charities')->select('id as id','name as name')->get();
		$this->data['description']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',6)->first();
		$this->data['description_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',6)->get();
		$this->data['funfacts']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',7)->first();
		$this->data['funfacts_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',7)->get();
		$this->data['funfacts_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',7)->first();
		$this->data['faq']=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',8)->first();
		$this->data['faq_value']=DB::table('attribute_options')->select('option_id','option_value','attribute_id')->where('attribute_id','=',8)->get();
		$this->data['faq_value_value'] = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id',8)->first();
		$this->data['sub_cat'] = DB::table('costume_to_category')->where('costume_id',$id)->first();
	 


		$this->data['handling_costume'] = DB::table('costumes as c')
						->leftjoin('attribute_options as ao','ao.option_id','=','c.condition_type')
						->where('c.costume_id',$id)
						->select('c.condition_type','ao.option_id','c.costume_id')
						->first();
		$this->data['customers'] = DB::table('users')
									->select('id as id','display_name as username')
	 								->where('role_id','!=','1')
	 								->where('active','=','1')
	 								->where('display_name','!=', '')
	 								->orderby('display_name','ASC')
	 								->get();

	 	$cosplaySubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>66,'status'=>1));

		$uniqueFashionSubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>143,'status'=>1));

		$filmTheatreSubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>147,'status'=>1));

		$this->data['cosplaySubCategories'] = $cosplaySubCategories;
		$this->data['uniqueFashionSubCategories'] = $uniqueFashionSubCategories;
		$this->data['filmTheatreSubCategories'] = $filmTheatreSubCategories;

		// echo "<pre>";print_r($this->data);die;
		 return view('admin.costumes.costume_edit')->with($this->data);
	}

	public function changeCostumeStatus(Request $request) {
        $status = $request->input('status'); 
		$id     = $request->input('id');
		$get_costume = DB::table('costumes')
            ->leftJoin('users','users.id','=','costumes.created_by')
            ->leftJoin('costume_description','costume_description.costume_id','=','costumes.costume_id')
            ->where('costumes.costume_id', $id)
            ->select('costumes.sku_no as sku','costumes.status as costume_status','costume_description.name as costume_name','users.email as email','users.first_name as first_name','users.last_name as last_name')
            ->first();
		$user_name = $get_costume->first_name.' '.$get_costume->last_name;
		$costume_type = substr($get_costume->sku,0,2);
		if ($get_costume->costume_status == 'active') {
			$user = DB::table('costumes')->where('costume_id', $id)->update(['status' => 'inactive']);
		}else{
			$user = DB::table('costumes')->where('costume_id', $id)->update(['status' => 'active']);
			if($costume_type == "MB"){
                // send mail
                $reg_subject        = "Your Costume Is Public Now";
                $reg_data           = array('user_name'=>$user_name,'costume_name'=>$get_costume->costume_name);
                $template           = 'emails.costume_listed';
                //---- send mail
                $reg_to             = $get_costume->email;
                $mail_status        = $this->sitehelper->sendEmail($reg_to,$reg_subject,$template,$reg_data);
                // end mail
            }
		}
        
        return $user;
    }
    public function changeFeaturedStatus(Request $request) {
    	//echo "<pre>";print_r($request->all());die;	
        $status = $request->input('status'); 
		$id     = $request->input('id');
		$get_costume = DB::table('costumes')->where('costume_id', $id)->first(['is_featured']);
		if ($get_costume->is_featured == '1') {
			$user = DB::table('costumes')->where('costume_id', $id)->update(['is_featured' => '0','is_featured_date' => date('y-m-d H:i:s')]);
		}else{
			$user = DB::table('costumes')->where('costume_id', $id)->update(['is_featured' => '1','is_featured_date' => date('y-m-d H:i:s')]);

		}
        
        return $user;
    }
    /*
	Method name:deleteCostume()
	purpose:deletCostume Method is used to delete the costume
	*/
    public function deleteCostume($id){
    	$costume = DB::table('costumes')->where('costume_id', $id)->update(['deleted_status' => '1']);
    	$cc_url_rewrite_delete = DB::table('url_rewrites')->where('type', 'product')->where('url_offset', $id)->delete();
        $costume_to_category = DB::table('costume_to_category')->where('costume_id', $id)->delete();
        $costume_attribute_options = DB::table('costume_attribute_options')->where('costume_id', $id)->delete();
        $costume_image = DB::table('costume_image')->where('costume_id', $id)->delete();
        return Redirect::back()->with('success', 'Costume deleted Successfully.');

    }


    public function updateCostume(Request $request){
 		$req=$request->all();
 		//echo "<pre>"; print_r($req); exit;
		$delete_costume_attributes = DB::table('costume_attribute_options')->where('costume_id',$request->costume_id)->delete();
		$response=array();
		
		$userid=Auth::user()->id;
		$customer_name=$req['customer_name'];
		
		if($customer_name == 1){
			$customer_group = "admin";
		}else{
			$customer_group = "user";
		}
		$costume_name=$req['costume_name'];
		$costume_cost=$req['costume_cost'];
		$gender=$req['gender'];
		$category=$req['category'];
		$costume_condition=$req['costumecondition'];
		$size=$req['size'];
		$heightft=$req['heightft'];
		$heightin=$req['heightin'];
		$weightlbs=$req['weightlbs'];
		$chestin=$req['chestin'];
		$waistlbs=$req['waistlbs'];
		/*$cosplay=$req['cosplay'];
		$fashion=$req['fashion'];
		$activity=$req['activity'];*/
		$makecostume=$req['make_costume'];
		$filmquality=$req['fimquality'];
		$description=$req['costume_desc'];
		//$funfacts=$req['fun_fact'];
		$faq=$req['faq'];
		$price=$req['price'];
		$quantity=$req['quantity'];
		$charityamount=$req['donate_charity'];
		$charity_name=$req['charity_name'];
		$length=$req['dimensionsdimensionsLength'];
		$width=$req['dimensionsdimensionsWidth'];
		$height=$req['dimensionsdimensionsHeight'];
		// $zipcode=$req['zipcode'];
		$handlingtime=$req['handling_time'];
		$returnpolicy=$req['return_policy'];
		//$frontview=$req['img_chan'];
		//$backview=$req['img_chan1'];
		//$details_accessories=$req['img_chan2'];
		$weight_pounds = $req['pounds'];
		if(isset($req['ounces'])){
	  		$weight_ounces = $req['ounces'];	
	  	}else{
	  		$weight_ounces = 0;
	  	}

	  //$cleaned = $req['cleaned'];
	  	if(isset($req['cleaned']) && !empty($req['cleaned'])){
			$cleaned = $req['cleaned'];		
		}else{
			$cleaned = "";	
		}

	 // $multiplefiles=$req['files'];
	  //Generating sku number for a costume code starts here code format should be (CS(five zeros)incrementing the number form 0 Ex:CS0000012)*****/
	 
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
		
		$customerid=$customer_name;
		
        $costume=array(
			'weight_pounds'=>$req['pounds'],
			'weight_ounces'=>$weight_ounces,
			'gender'=>$gender,
			'condition'=>$costume_condition,
			'created_user_group'=>$customer_group,
			'size'=>$size,
			'costume_cost'=>$costume_cost,
			'condition_type' =>$cleaned,
			'created_by'=>$customerid,
			'created_at'=>date('y-m-d H:i:s'),
		);
        //print_r($costume); exit;

		$costume_id=DB::table('costumes')->where('costume_id',$request->costume_id)->update($costume);
		$insert_costume = $request->costume_id;
		$costume_id = $request->costume_id;
		if($insert_costume) {

			if (isset($request['Imagecrop1']) && !empty($request['Imagecrop1'])) {
				$Imagecrop1 = $request->Imagecrop1;
				$img = str_replace('data:image/jpeg;base64,', '', $Imagecrop1);
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);
				$source = imagecreatefromstring($data);
				$Orand = str_random(10) . '.png';
				$originalPath = public_path('costumers_images/Original/') . $Orand;
				$data1 = $Orand;
				$OriginalImage = file_put_contents($originalPath, $data);
				$Mediumresizeimg = Image::make($originalPath);
				$Mediumresizeimg->resize(260, 434);
				$Mediumresizeimg->save(public_path('costumers_images/Medium/') . $Orand);
				$Smallresizeimg = Image::make($originalPath);
				$Smallresizeimg->resize(140, 233);
				$Smallresizeimg->save(public_path('costumers_images/Small/') . $Orand);
				$Largeresizeimg = Image::make($originalPath);
				$Largeresizeimg->resize(475, 792);
				$Largeresizeimg->save(public_path('costumers_images/Large/') . $Orand);

				$ExLargeresizeimg = Image::make($originalPath);
			    $ExLargeresizeimg->resize(889, 1482);
			    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Orand);
			    chmod(public_path('costumers_images/ExLarge/').$Orand, 0777);
				if ($OriginalImage) {
					DB::table('costume_image')->where('costume_id',$costume_id)->where('type',1)->delete();
					$file_db_array1 = array('costume_id' => $costume_id,
						'image' => $data1,
						'type' => 1,
						'sort_order' => 0,
					);
					//echo "<pre>"; print_r($file_db_array1); exit;
					$file_db = DB::table('costume_image')->insert($file_db_array1);
				}//print_r($file_db);exit;
			}
			if (isset($request['Imagecrop2']) && !empty($request['Imagecrop2'])) {
				$Imagecrop2 = $request->Imagecrop2;
				$img1 = str_replace('data:image/jpeg;base64,', '', $Imagecrop2);
				$img1 = str_replace(' ', '+', $img1);
				$data1 = base64_decode($img1);
				$source = imagecreatefromstring($data1);
				$Orand = str_random(10) . '.png';
				$originalPath1 = public_path('costumers_images/Original/') . $Orand;
				$data2 = $Orand;
				$OriginalImage2 = file_put_contents($originalPath1, $data1);
				$Mediumresizeimg = Image::make($originalPath1);
				$Mediumresizeimg->resize(260, 434);
				$Mediumresizeimg->save(public_path('costumers_images/Medium/') . $Orand);
				$Smallresizeimg = Image::make($originalPath1);
				$Smallresizeimg->resize(140, 233);
				$Smallresizeimg->save(public_path('costumers_images/Small/') . $Orand);
				$Largeresizeimg = Image::make($originalPath1);
				$Largeresizeimg->resize(475, 792);
				$Largeresizeimg->save(public_path('costumers_images/Large/') . $Orand);
				$ExLargeresizeimg = Image::make($originalPath1);
			    $ExLargeresizeimg->resize(889, 1482);
			    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Orand);
			    chmod(public_path('costumers_images/ExLarge/').$Orand, 0777);
				if ($OriginalImage2) {
					DB::table('costume_image')->where('costume_id',$costume_id)->where('type',2)->delete();
					$file_db_array2 = array('costume_id' => $costume_id,
						'image' => $data2,
						'type' => 2,
						'sort_order' => 0,
					);
					$file_db = DB::table('costume_image')->insert($file_db_array2);
				}
			}

			if (isset($request['Imagecrop3']) && !empty($request['Imagecrop3'])){

				$Imagecrop3 = $request->Imagecrop3;
				$img2 = str_replace('data:image/jpeg;base64,', '', $Imagecrop3);
				$img2 = str_replace(' ', '+', $img2);
				$data2 = base64_decode($img2);
				$source = imagecreatefromstring($data2);
				$Orand = str_random(10) . '.png';
				$originalPath2 = public_path('costumers_images/Original/').$Orand;
				$data3 = $Orand;
				$OriginalImage2 = file_put_contents($originalPath2, $data2);
				$Mediumresizeimg = Image::make($originalPath2);
				//$Mrand = str_random(10) . '.png';
				$Mediumresizeimg->resize(260, 434);

				$Mediumresizeimg->save(public_path('costumers_images/Medium/').$Orand);
				$Smallresizeimg = Image::make($originalPath2);
				//$Srand = str_random(10) . '.png';
				$Smallresizeimg->resize(140, 233);
				$Smallresizeimg->save(public_path('costumers_images/Small/').$Orand);
				$Largeresizeimg = Image::make($originalPath2);
				//$Lrand = str_random(10) . '.png';
				$Largeresizeimg->resize(475, 792);

				$Largeresizeimg->save(public_path('costumers_images/Large/').$Orand);

				$ExLargeresizeimg = Image::make($originalPath2);
			    $ExLargeresizeimg->resize(889, 1482);
			    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Orand);
			    chmod(public_path('costumers_images/ExLarge/').$Orand, 0777);

				//$file3 = Imageresize::CreateCostumeFrontend3($request->file3);
			    DB::table('costume_image')->where('costume_id',$costume_id)->where('type',3)->delete();
				//inserting in db
				$file_db_array3 = array('costume_id'=>$costume_id,
					'image'=>$data3,
					'type'=>3,
					'sort_order'=>0,
				);
				$file_db=DB::table('costume_image')->insert($file_db_array3);
			}else{
				DB::table('costume_image')->where('costume_id',$costume_id)->where('type',3)->delete();
			}

			//remove uploaded images

			if (isset($request['multiple']) && !empty($request['multiple'])) {
				foreach ($request['multiple'] as $remove) {
					$file_db = DB::table('costume_image')->where('image',$remove)->where('type', '4')->delete();
				}
			}

			if (isset($request['multi']) && !empty($request['multi'])) {
				foreach ($request['multi'] as $file4) {
					$multiImagecrop = $file4;
					$img = str_replace('data:image/jpeg;base64,', '', $multiImagecrop);
					$img = str_replace(' ', '+', $img);
					$data = base64_decode($img);
					//$source = imagecreatefromstring($data);
					$Multiplerand = str_random(10) . '.png';
					$originalPath = public_path('costumers_images/Original/').$Multiplerand;
					$multidata = $Multiplerand;
					$OriginalImage = file_put_contents($originalPath, $data);

					$Mediumresizeimg = Image::make($originalPath);
					//$Mrand = str_random(10) . '.png';
					$Mediumresizeimg->resize(260, 434);

					$Mediumresizeimg->save(public_path('costumers_images/Medium/').$Multiplerand);


					$Smallresizeimg = Image::make($originalPath);
					//$Srand = str_random(10) . '.png';
					$Smallresizeimg->resize(140, 233);

					$Smallresizeimg->save(public_path('costumers_images/Small/').$Multiplerand);


					$Largeresizeimg = Image::make($originalPath);
					//$Lrand = str_random(10) . '.png';
					$Largeresizeimg->resize(475, 792);

					$Largeresizeimg->save(public_path('costumers_images/Large/').$Multiplerand);

					$ExLargeresizeimg = Image::make($originalPath);
				    $ExLargeresizeimg->resize(889, 1482);
				    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Multiplerand);
				    chmod(public_path('costumers_images/ExLarge/').$Multiplerand, 0777);

					$file_db_array4 = array('costume_id'=>$costume_id,
						'image'=>$multidata,
						'type'=>4,
						'sort_order'=>0,
					);
					$file_db=DB::table('costume_image')->insert($file_db_array4);
				}
			}
		

			/*
			|Tbale:costume_description
			|@costume_id int
			|@language_id  int
			|@name varchar
			|@description text
			*/
			// echo $request->costume_id;die;
			/*if (isset($request->keyword) && !empty($request->keyword)) {
				$keywords=$request->keyword;

				$final_keywords = implode(", ", $keywords);
			}else{
				$final_keywords= "";
			}*/


	   		$final_keywords = array();
			if(!empty($request->keyword_10)){
				$final_keywords[1] = $request->keyword_10;
			}
			if(!empty($request->keyword_9)){
				$final_keywords[2] = $request->keyword_9;
			}
			if(!empty($request->keyword_8)){
				$final_keywords[3] = $request->keyword_8;
			}
			if(!empty($request->keyword_7)){
				$final_keywords[4] = $request->keyword_7;
			}
			if(!empty($request->keyword_6)){
				$final_keywords[5] = $request->keyword_6;
			}
			if(!empty($request->keyword_5)){
				$final_keywords[6] = $request->keyword_5;
			}
			if(!empty($request->keyword_4)){
				$final_keywords[7] = $request->keyword_4;
			}
			if(!empty($request->keyword_3)){
				$final_keywords[8] = $request->keyword_3;
			}
			if(!empty($request->keyword_2)){
				$final_keywords[9] = $request->keyword_2;
			}
			if(!empty($request->keyword_1)){
				$final_keywords[10] = $request->keyword_1;
			}
			$final_keywords = implode(",", $final_keywords);
          

			$costume_description=array(
			'language_id'=>"1",
			'keywords'=>$final_keywords,
			'name'=>$costume_name,
			'description'=>$description);
			$insert_costume_desc=DB::table('costume_description')->where('costume_id',$request->costume_id)->update($costume_description);
			/*
			|Table:costume_to_category
			|@costume_id int
			|@category_id int
			*/
			
			$category_costume_check = DB::table('costume_to_category')->where('costume_id',$request->costume_id)->first();
			if(empty($category_costume_check)){
				$costume_category = array('costume_id'=>$costume_id,
								  'category_id'=>$category,
								  'sort_no'=>'1'
								);
				$insert_costume_category = DB::table('costume_to_category')->insert($costume_category);
			}else{
				$costume_category=array('category_id'=>$category,'sort_no'=>'1');
				$insert_costume_category=DB::table('costume_to_category')->where('costume_id',$request->costume_id)->update($costume_category);	
			}
			
			
		
			/**** Url create start here ***/
			Costumes::urlRewrites($costume_id,'insert');
		    /**** Url create end here ***/
			
			/*****************************Attributes insertion code starts here****/

		    	//$delete_costume_attributes = DB::table('costume_attribute_options')->where('costume_id',$request->costume_id)->delete();

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
			|Film Quality if yes 
			|@costume_id
			|@attribute_id
			|@attribute_option_value_id
			|@attribute_option_value
			*/
			if (isset($request->film_name) && !empty($request->film_name)) {
				$film_name=array('costume_id'=>$insert_costume,
				'attribute_id'=>'30',
				'attribute_option_value_id'=>"0",
				'attribute_option_value'=>$request->film_name,
				);
				$make_costume_timeinsert=DB::table('costume_attribute_options')->insert($film_name);
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
			if($size == 'custom'){
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
			}else{
				DB::table('costume_attribute_options')
					->where('costume_id', $insert_costume)
					->where('attribute_id','16')
					->orWhere('attribute_id','17')
					->orWhere('attribute_id','18')
					->orWhere('attribute_id','19')
					->orWhere('attribute_id','20')
					->delete();
			}
			


			/*
			|Table:costume_attribute_options
			|Costume FAQ (used for cosplay ?,is your costume have unique fashion?,used for an activity?,you make the costume?,Is the costume fit for film quality?)
			|@costume_id
			|@attribute_id
			|@attribute_option_value_id
			|@attribute_option_value
			*/
			/*switch($cosplay){ case '7': $cosplay_value="yes"; break; case '8': $cosplay_value="No"; break; }
			$cosplay_value=array('costume_id'=>$insert_costume,
			'attribute_id'=>'2',
			'attribute_option_value_id'=>$cosplay,
			'attribute_option_value'=>$cosplay_value,
			);
			$cosplay_value_insert=DB::table('costume_attribute_options')->insert($cosplay_value);
			//	dd($cosplay_value_insert);
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
			$activity_val_insert=DB::table('costume_attribute_options')->insert($activity_val);*/
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
			/*$funfact_val=array('costume_id'=>$insert_costume,
			'attribute_id'=>'7',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$funfacts,
			);
			$funfact_insert=DB::table('costume_attribute_options')->insert($funfact_val);*/
			//faq
			$faq_value=array('costume_id'=>$insert_costume,
			'attribute_id'=>'8',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$faq,
			);
			$faq_insert=DB::table('costume_attribute_options')->insert($faq_value);

			$price=$req['price'];
		  	$quantity=$req['quantity'];
		  	/*$length = $req['Length'];
		  	$width = $req['Width'];
		  	$height = $req['Height'];*/

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

			//length
			if (!empty($length)) {
				
			$length=array('costume_id'=>$costume_id,
				'attribute_id'=>'22',
				'attribute_option_value_id'=>0,
				'attribute_option_value'=>$length,
				);
			$length_db=DB::table('costume_attribute_options')->insert($length);
			}
			//width
			if (!empty($width)) {
				
			$width=array('costume_id'=>$costume_id,
				'attribute_id'=>'23',
				'attribute_option_value_id'=>0,
				'attribute_option_value'=>$width,
				);
			$width_db=DB::table('costume_attribute_options')->insert($width);
			}
			//height
			if (!empty($height)) {
				
			$height=array('costume_id'=>$costume_id,
				'attribute_id'=>'24',
				'attribute_option_value_id'=>0,
				'attribute_option_value'=>$height,
				);
			$width_db=DB::table('costume_attribute_options')->insert($height);
			}

			$req=$request->all();
			$userid=Auth::user()->id;

		  	//$returnpolicy=$req['returnpolicy'];
		  	//$donate_charity=$req['donate_charity'];
		  	/*
			|Table:costume_attribute_options
			|Preferences
			|@costume_id 
			|@attribute_id
			|@attribute_option_value_id
			|@attribute_option_value
			*/
			//Handling Time
			/*switch($handlingtime){ case '26': $handlingtime_name="Same Business Day"; break; case '27': $handlingtime_name="10 Business Days"; break; }
			$handlingtime_val=array('costume_id'=>$costume_id,
				'attribute_id'=>'14',
				'attribute_option_value_id'=>$handlingtime,
				'attribute_option_value'=>$handlingtime_name,
				);
			$insert_handlingtime=DB::table('costume_attribute_options')->insert($handlingtime_val);*/
			$handling_name = DB::table('attribute_options')
								->select('option_value as value')
								->where('attribute_id','=','14')
								->where('option_id',$handlingtime)
								->first();

			$handlingtime_val=array('costume_id'=>$costume_id,
				'attribute_id'=>'14',
				'attribute_option_value_id'=>$handlingtime,
				'attribute_option_value'=>$handling_name->value,
				);
			$insert_handlingtime=DB::table('costume_attribute_options')->insert($handlingtime_val);
			//Return Policy
			/*switch($returnpolicy){ case '28': $returnpolicy_name="Return Accepted"; break; case '29': $returnpolicy_name="Return Not Accepted "; break; }
			$returnpolicy_val=array('costume_id'=>$costume_id,
				'attribute_id'=>'15',
				'attribute_option_value_id'=>$returnpolicy,
				'attribute_option_value'=>$returnpolicy_name,
				);
			$insert_returnpolicy=DB::table('costume_attribute_options')->insert($returnpolicy_val);
*/

			$returnpolicy_name = DB::table('attribute_options')
								->select('option_value as value')
								->where('attribute_id','=','15')
								->where('option_id',$returnpolicy)
								->first();

			$returnpolicy_val=array('costume_id'=>$costume_id,
				'attribute_id'=>'15',
				'attribute_option_value_id'=>$returnpolicy,
				'attribute_option_value'=>$returnpolicy_name->value,
				);
			$insert_returnpolicy=DB::table('costume_attribute_options')->insert($returnpolicy_val);
			if (isset($req['charity_name'])) {
				
				$costume=array('charity_id'=>$req['charity_name'],
				'donation_amount'=>$req['hidden_donation_amount'],
				'dynamic_percent'=>$req['donate_charity'],
				'updated_at'=>date('y-m-d H:i:s'),
			);

			$update_costume = DB::table('costumes')->where('costume_id',$costume_id)->update($costume);
			}

		}
		DB::update('update cc_costumes set donating_percent = FORMAT(`donation_amount`/`price`,2)*100  where costume_id = ?', [$costume_id]);
		if ($customerid != 1) {
			$get_user_name = DB::table('users')->where('id',$customerid)->first(['first_name','email']);
		// send mail
			$reg_subject        = "Costume Edited";
			$reg_data           = array('name'=>$get_user_name->first_name,'costume_name'=>$costume_name);
			$template           = 'emails.admineditcostume';
	        $reg_to             = $get_user_name->email;
			$mail_status        = $this->sitehelper->sendmail($reg_to,$reg_subject,$template,$reg_data);
			// end mail
		}
		 Session::flash('success', 'Costume Edited Successfully');
          return Redirect::to('customes-list');
    }

    public function Getallsearchcostumes(Request $request){
		//echo "<pre>";print_r($request->all());die;
		$requests_list=DB::table('costumes as c')
		->leftJoin('costume_description as cd','cd.costume_id','=','c.costume_id')
		->leftJoin('users as u','u.id','=','c.created_by')
		->leftJoin('costume_to_category as ctc','ctc.costume_id','=','c.costume_id')
		->leftJoin('category as cat','cat.category_id','=','ctc.category_id')
		->where('c.deleted_status',0)
		->select('c.sku_no as sku_no',
			'cd.name as custome_name',
			'u.display_name as customer_name','cat.name as cat_name',
			'c.condition as custome_condition',
			DB::Raw("DATE_FORMAT(cc_c.created_at,'%m/%d/%y %h:%i %p') as custome_created_at"),
			'c.status as custome_status','c.is_featured as is_featured',
			'c.costume_id as costumeid','c.price as price');
		if($request->sku!=""){

		    	$requests_list->where('c.sku_no', 'LIKE', "%".$request->sku."%");
		}
		if($request->costume_name!=""){

		    	$requests_list->where('cd.name', 'LIKE', "%".$request->costume_name."%");
		}
		if($request->customer_name!=""){
		    	$requests_list->where('u.display_name','LIKE', "%".$request->customer_name."%");
		}
	   
		if($request->condition!=""){
			$requests_list->where('c.condition','=',$request->condition);
		}if($request->status!=""){
			
			$requests_list->where('c.status','=',$request->status);
		}
		$requests=$requests_list->get();

	//echo "<pre>";print_r($costumes);die;	
	return Datatables::of($requests)
        ->addColumn('actions', function ($requests) {
                return '<a href="/custome-listing/'.$requests->costumeid.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a href="javascript:void(0);" onclick="deletecostume('.$requests->costumeid.')" class="btn btn-xs btn-danger delete_user"><i class="fa fa-trash-o"></i></a>';
            }) 
        ->addColumn('price', function ($costumes) {
                return '$'.$costumes->price.'';
            })
		->editColumn('status', function ($requests) {
					if ($requests->custome_status == 'active') {
						$costume_status = "1";
					}else{
						$costume_status = "0";
					}
                   $a = $costume_status == '1' ? 'checked' : '';
                   return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $requests->costumeid .'" onClick="changeCostumeStatus('.$requests->costumeid.','.$costume_status.');">
                                   <div class="slider round"></div>
                               </label>';
                   })
		->editColumn('is_featured', function ($requests) {
					if ($requests->is_featured == '1') {
						$costume_status = "1";
					}else{
						$costume_status = "0";
					}
                   $a = $costume_status == '1' ? 'checked' : '';
                   return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $requests->costumeid .'" onClick="changeFeaturedStatus('.$requests->costumeid.','.$costume_status.');">
                                   <div class="slider round"></div>
                               </label>';
                   })
                   ->editColumn('custome_condition', function ($costumes) {
			$costume_cond = "";
                        if ($costumes->custome_condition == 'brand_new') {
                                $costume_cond = "Brand New";
                        }elseif($costumes->custome_condition == 'like_new'){
                                $costume_cond = "Like New";
                        }else{
                                $costume_cond = $costumes->custome_condition;
                        }
			return ucwords($costume_cond);
                   })
        ->make(true);
	}

	public function deleteCostumeImage(Request $request){
        if(isset($request->image_name) && !empty($request->image_name) && isset($request->image_type) && !empty($request->image_type)){
            $deleteCostumeImage = DB::table('costume_image')->where(['image'=>$request->image_name,'type'=>$request->image_type])->delete();
            if($deleteCostumeImage){
                return 1;
            }else{
                return 0;
            }
        }
    }

    
}

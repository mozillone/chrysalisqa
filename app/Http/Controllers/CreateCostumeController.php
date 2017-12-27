<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use App\Costumes;
use Image;
use Session;
use Hash;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use Validator;
use App\User;
use App\Imageresize;
use Meta;
use Mail;
use URL;
use App\Helpers\Site_model;
use Carbon\Carbon;
use Exeception;
use Log;

class CreateCostumeController  extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
	    
		Meta::title('Chrysalis');
        Meta::set('robots', 'index,follow');
        $this->middleware(function ($request, $next) {
            if(!Auth::check()){
                Session::put('curentURL',URL::current());
                return Redirect::to('/login')->send();
            }
            else{
                 return $next($request);
            }
        }, ['except' => ['requestaBag','Postrequestabag','Successrequestbag', 'redirectToCharity','GenerateExLarge']]);
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
	  
        if(!Auth::check()){
          	Session::put('curentURL',URL::current());
          	return Redirect::to('/login')->send();
        }
	    
		Meta::set('title', 'Costume Create');
        Meta::set('description', '');
        
		//echo "<pre>";print_r("hello");die;
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
		
		$categories=DB::table('category')->select('category_id as categoryid','name as categoryname')->where('status','=','1')->where('parent_id','=','0')->orderby('sort_order','asc')->get();

		$shippingoptions=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','9')->get();

		$handwashed=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','31')->get();
	
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

		$charities=DB::table('charities')->select('id as id','name as name','image as image')->where('status','1')->limit(8)->get();

		$cosplaySubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>66,'status'=>1));

		$uniqueFashionSubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>143,'status'=>1));

		$filmTheatreSubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>147,'status'=>1));

      
		return view('frontend.costumes.costume_create_two',compact('categories','bodyanddimensions','bodydimensions_val','body_height_ft',
		'body_height_in','body_weight_lbs','body_chest_in','body_waist_lbs','cosplayone','cosplaytwo','cosplaythree','cosplayfour',
		'cosplayfive','cosplayone_values','cosplaytwo_values','cosplaythree_values','cosplayfour_values','cosplayfive_values',
		'shippingoptions','packageditems','type','dimensions','service','handlingtime','handwashed','returnpolicy','charities', 'cosplaySubCategories', 'uniqueFashionSubCategories', 'filmTheatreSubCategories'));
		
	}
	/****Fetching sub category values based on category code starts here***/
	public function ajaxSubCategory(){
	    $id = Input::get('categoryid');

	    if($id == null || $id == "")
	    {
	    	return response()->json('Please Select category');
	    }
	    else
	    {
	    	 $results = DB::table('category')->where('parent_id', '=',$id)->where('status', '=',1)->orderby('sort_order','asc')->get(['category_id as subcategoryid','name as subcategoryname']);
			return $results;
	    }

		
		
	}
	
	/****Sell a costume code starts here***/
	public function sellCostume(){
	  return view('frontend.costumes.sellacostume');
	}


	/****create costume code starts here***/
	public function Costumecreate(Request $request){
		 	//echo ini_get('post_max_size');
		 	//exit;


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
		  	$chestin =$req['chest-in'];
		  	$waistlbs =$req['waist-lbs'];
		  	$cosplay = null;
		  	$fashion = null;
		  	$activity = null;
		  	if(isset($req['cleaned']) && !empty($req['cleaned'])){
		  		$cleaned = $req['cleaned'];	 
		  	}else{
		  		$cleaned = "";	 	
		  	}
		  	
		  	$makecostume=$req['make_costume'];
		  	$filmquality=$req['fimquality'];
		  	$description = $req['description'];		  	 
		  	$faq = $req['faq'];  		  
		  	$customer_group="user";

		 	$costume=array(
			'weight_pounds'=>$req['pounds'],
			'weight_ounces'=>$req['ounces'],
			'gender'=>$gender,
			'condition'=>$costume_condition,
			'created_user_group'=>$customer_group,
			'size'=>$size,
			'cat_id'=>$categoryname,
			'condition_type' => $cleaned,
			'created_by'=>$userid,
			'created_at'=>date('y-m-d H:i:s'),
			'updated_at'=>date('y-m-d H:i:s'),
			);

			$insert_costume=DB::table('costumes')->insertGetId($costume);
			 Session::put('session_costume_id', $insert_costume);
			 $costume_id = $insert_costume;
			 DB::update("UPDATE `cc_costumes` SET `unq_costume_code` = ENCRYPT(costume_id , CONCAT('$6$', SHA2(RANDOM_BYTES(64), '256'))) WHERE unq_costume_code IS NULL");
		 
		 	//image croppind code for Front View

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
		    $Mediumresizeimg->resize(260, 356);

		    $Mediumresizeimg->save(public_path('costumers_images/Medium/').$Orand);


			$Smallresizeimg = Image::make($originalPath);
			//$Srand = str_random(10) . '.png';
		    $Smallresizeimg->resize(140, 190);

		    $Smallresizeimg->save(public_path('costumers_images/Small/').$Orand);


			$Largeresizeimg = Image::make($originalPath);
			//$Lrand = str_random(10) . '.png';
		    $Largeresizeimg->resize(475, 650);

		    $Largeresizeimg->save(public_path('costumers_images/Large/').$Orand);

		    $ExLargeresizeimg = Image::make($originalPath);
		    $ExLargeresizeimg->resize(889, 1217);
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

			//image croppind code for Back View
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
			$Mediumresizeimg->resize(260, 356);

			$Mediumresizeimg->save(public_path('costumers_images/Medium/').$Orand);


			$Smallresizeimg = Image::make($originalPath1);
			//$Srand = str_random(10) . '.png';
			$Smallresizeimg->resize(140, 190);

			$Smallresizeimg->save(public_path('costumers_images/Small/').$Orand);


			$Largeresizeimg = Image::make($originalPath1);
			//$Lrand = str_random(10) . '.png';
			$Largeresizeimg->resize(475, 650);

			$Largeresizeimg->save(public_path('costumers_images/Large/').$Orand);
			$ExLargeresizeimg = Image::make($originalPath1);
		    $ExLargeresizeimg->resize(889, 1217);
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
 
				
            if (isset($request['Imagecrop3']) && !empty($request['Imagecrop3'])) {

				$Imagecrop3 = $request->Imagecrop3;
				$img2 = str_replace('data:image/jpeg;base64,', '', $Imagecrop3);
				$img2 = str_replace(' ', '+', $img2);
				$data2 = base64_decode($img2);
				$source = imagecreatefromstring($data2);
				$Orand = str_random(10) . '.png';
				$originalPath2 = public_path('costumers_images/Original/').$Orand;
				$data3 = $Orand;
				$OriginalImage3 = file_put_contents($originalPath2, $data2);
				$Mediumresizeimg = Image::make($originalPath2);
				//$Mrand = str_random(10) . '.png';
				$Mediumresizeimg->resize(260, 356);

				$Mediumresizeimg->save(public_path('costumers_images/Medium/').$Orand);
				$Smallresizeimg = Image::make($originalPath2);
				//$Srand = str_random(10) . '.png';
				$Smallresizeimg->resize(140, 190);
				$Smallresizeimg->save(public_path('costumers_images/Small/').$Orand);
				$Largeresizeimg = Image::make($originalPath2);
				//$Lrand = str_random(10) . '.png';
				$Largeresizeimg->resize(475, 650);

				$Largeresizeimg->save(public_path('costumers_images/Large/').$Orand);

				$ExLargeresizeimg = Image::make($originalPath2);
			    $ExLargeresizeimg->resize(889, 1217);
			    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Orand);
			    chmod(public_path('costumers_images/ExLarge/').$Orand, 0777);

				if($OriginalImage3)
				{
					$file_db_array3 = array('costume_id'=>$costume_id,
            		'image'=>$data3,
            		'type'=>3,
            		'sort_order'=>0,
            		);
            		$file_db=DB::table('costume_image')->insert($file_db_array3);
				}
            	 
            	
       		 }

	            //moving extra images

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
					$Mediumresizeimg->resize(260, 356);

					$Mediumresizeimg->save(public_path('costumers_images/Medium/').$Multiplerand);


					$Smallresizeimg = Image::make($originalPath);
					//$Srand = str_random(10) . '.png';
					$Smallresizeimg->resize(140, 190);

					$Smallresizeimg->save(public_path('costumers_images/Small/').$Multiplerand);


					$Largeresizeimg = Image::make($originalPath);
					//$Lrand = str_random(10) . '.png';
					$Largeresizeimg->resize(475, 650);

					$Largeresizeimg->save(public_path('costumers_images/Large/').$Multiplerand);

					$ExLargeresizeimg = Image::make($originalPath);
				    $ExLargeresizeimg->resize(889, 1217);
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
		 $customer_group="user";
			
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
			 
			

			 if (isset($request['file4']) && !empty($request['file4'])) {
			 	$file4 = $request['file4'];
			 }else{
			 	$file4 = "";
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
			$costume_description=array('costume_id'=>$insert_costume,
			'language_id'=>"1",
			'keywords'=>$final_keywords,
			'name'=>$costume_name,
			'description'=>$description);
			$insert_costume_desc=DB::table('costume_description')->insertGetId($costume_description);

			/*
			|Table:costume_to_category
			|@costume_id int
			|@category_id int
			*/
				 
			$costume_category=array('costume_id'=>$insert_costume,
			'category_id'=>$subcategory,'sort_no'=>'1');
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
			if (isset($request->make_costume_time1) && !empty($request->make_costume_time1)) {
				$make_costume_time=array('costume_id'=>$insert_costume,
				'attribute_id'=>'29',
				'attribute_option_value_id'=>"0",
				'attribute_option_value'=>$request->make_costume_time1,
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
			$filmquality_insert=DB::table('costume_attribute_options')->insert($film_quality);*/

			/*
			|Table:costume_attribute_options
			|Costume Description,costume funfacts abd costume faq
			|@costume_id
			|@attribute_id
			|@attribute_option_value_id
			|@attribute_option_value
			*/


			switch($makecostume){ case '30': $makecostume_value="yes"; break; case '31': $makecostume_value="No"; break; }
			$user_costume=array('costume_id'=>$insert_costume,
			'attribute_id'=>'5',
			'attribute_option_value_id'=>$makecostume,
			'attribute_option_value'=>$makecostume_value,
			);
			$user_costume_insert=DB::table('costume_attribute_options')->insert($user_costume);


			switch($filmquality){ case '32': $filmquality_value="yes"; break; case '33': $filmquality_value="No"; break; }
			$film_quality=array('costume_id'=>$insert_costume,
			'attribute_id'=>'21',
			'attribute_option_value_id'=>$filmquality,
			'attribute_option_value'=>$filmquality_value,
			);
			$filmquality_insert=DB::table('costume_attribute_options')->insert($film_quality);


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
			// costume description end
			// pricing insertion

			$price=$req['price'];
		  	$quantity=$req['quantity'];
		  	//$shipping=$req['shipping'];
		  	//$packageitems = $req['packageditems'];
		  	$length = $req['Length'];
		  	$width = $req['Width'];
		  	$height = $req['Height'];
		  	//$type = $req['type'];
		  	//$service = $req['service'];

			/*
			 |Tbale:costumes
			 |@price varchar
			 |@quantity  enum
			 
			 */
			 $sku_no = "CS000".$costume_id;
			//Check whether the costume inserted by admin or not if the user is selected insert the user id else insert the admin as costumer
			$costume=array('price'=>$price,
				'sku_no'=> $sku_no,
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
				

			
			//end pricing insertion

			$req=$request->all();
			$userid=Auth::user()->id;

		  	$handlingtime=$req['handlingtime'];
		  	$returnpolicy=$req['returnpolicy'];
		  	$donate_charity=$req['donate_charity'];
		  	//$charity_name=$req['charity_name'];
			/*
			|Table:costume_attribute_options
			|Preferences
			|@costume_id 
			|@attribute_id
			|@attribute_option_value_id
			|@attribute_option_value
			*/
			//Handling Time
			/*switch($handlingtime)
			{ 
				case '26': 
							$handlingtime ="Same Business Day"; 
							break; 
				case '27': 
							$handlingtime ="10 Business Days"; 
							break; 
			}*/

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
			/*switch($returnpolicy){ 
					case '28': 
								$returnpolicy_name="Return Accepted"; 
								break; 
					case '29': 
								$returnpolicy_name="Return Not Accepted "; 
								break; 
			}*/

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

			/*
		 	|Tbale:costumes
		 	|@donation_amount float
		 	|@charity_id  int
		 
		 	*/
			//Check whether the costume inserted by admin or not if the user is selected insert the user id else insert the admin as costumer
			if (isset($req['charity_name']) && !empty($req['charity_name'])) {
				
			$costume=array('charity_id'=>$req['charity_name'],
			'donation_amount'=>$req['hidden_donation_amount'],
			'dynamic_percent'=>$req['donate_charity'],
			'updated_at'=>date('y-m-d H:i:s'),
			);

			$update_costume = DB::table('costumes')->where('costume_id',$costume_id)->update($costume);
			}else{
				$costume1=array('charity_id'=>"0",
				'donation_amount'=>$req['hidden_donation_amount'],
				'dynamic_percent'=>$req['donate_charity'],
				'updated_at'=>date('y-m-d H:i:s'),
				);
			$update_costume = DB::table('costumes')->where('costume_id',$costume_id)->update($costume1);

			}
			

			//charites
			if (isset($req['organzation_name']) && !empty($req['organzation_name'])) {
				$organzation_name=$req['organzation_name'];
				$arrayName = array('name' => $organzation_name,
					'costume_id'=>$costume_id,
					'suggested_by'=>$userid,
					'status'=>'0',
					'created_at'=>date('y-m-d H:i:s'),
					'updated_at'=>date('y-m-d H:i:s'),
					 );
				$organzation_name=DB::table('charities')->insert($arrayName);
			}

			// send mail
			$reg_subject        = "Costume Created";
			$reg_data           = array('name'=>Auth::user()->display_name,'costume_name'=>$costume_name);
			$template           = 'emails.createcostume';
	        $reg_to             = Auth::user()->email;
			$mail_status        = $this->sitehelper->sendmail($reg_to,$reg_subject,$template,$reg_data);
			// end mail
			
			$listUrlObj = \DB::table('url_rewrites')->where('type', 'product')->where('url_offset', $insert_costume)->first();

			$list_url_arr = explode('/', $listUrlObj->url_key);

			/* Added by Gayatri*/
			$share_url = URL::to('/').'/product'.$listUrlObj->url_key; 
			
			Meta::set('url', $share_url);

			DB::update('update cc_costumes set donating_percent = FORMAT(`donation_amount`/`price`,2)*100  where costume_id = ?', [$costume_id]);

			$charity_info = Costumes::leftjoin('charities', 'costumes.charity_id', '=', 'charities.id')
									->join('costume_description','costumes.costume_id','=','costume_description.costume_id')
									->select('charities.name','costume_description.name as cos_name', 'costumes.donation_amount', 'costumes.donating_percent')
									->where('costumes.costume_id',$costume_id)
									->first();
			

									//echo "<pre>"; print_r($charity_info); exit;
			$donation = ''; $amount = '';
			if(isset($charity_info) && !empty($charity_info)){
				//$amount = $charity_info->donation_amount*100;
				$amount = number_format($charity_info->donation_amount,2);
				if($amount > 0){
					$donation.= $charity_info->donating_percent.'% of the sale goes to '.ucfirst($charity_info->name).".";
				}
				$is_amount = 1;
			}
			if ((stripos( $charity_info->cos_name, 'costume' ) != '') || (stripos( $charity_info->cos_name, 'cosplay' ) != '')) {
			  	$name = $charity_info->cos_name;
			}else{
				$name = $charity_info->cos_name." Costume";
			}

			$quote = "I’m selling my ".ucfirst($name)." on Chrysalis.\n".$donation." Check it out!";

			$debugger = Costumes::facebookDebugger($share_url);
			$data=Costumes::getCostumeImages($costume_id);
			$pic = asset('/costumers_images/Large').'/'.$data[0]->image;

			

			/* End*/


			return response()->json(['msg' => 'success', 'cat_url' => '/category/'.$list_url_arr[1].'/'.$list_url_arr[2], 'share_url' => $share_url, 'quote' => $quote, 'first_pic'=> $pic, 'costume_name'=>$name, 'amount'=>$charity_info->donating_percent, 'charity_center'=>ucfirst($charity_info->name) ]);

		}
	public function requestaBag(){

		Meta::set('title', 'Request a Bag');
        Meta::set('description', 'Request a Bag to send your costumes to Chrysalis');
		$this->data = array();
		$this->data['state_table'] = DB::table('states')->get(['name','abbrev']);
		if (Auth::check()){
			$userid 		= Auth::user()->id;
			$this->data['get_details']    = DB::table('users')->where('id',$userid)->first();
			$this->data['basic_address']  = DB::table('address_master')->where('user_id',$userid)->where('address_type','request_a_bag')->orderby("address_id","desc")->first();

		}
	  return view('frontend.costumes.requestabag')->with('total_data',$this->data);
	}

	/* Commented by Gayatri */
	// public function Postrequestabag(Request $request){
	// 	//dd($request->all());
	// 	$cus_email 		= $request->email_address;
	// 	$email_check    = DB::table('users')->where('email',$cus_email)->count();
	// 	$user_info = DB::table('users')->where('email',$cus_email)->first();
	// 	//echo "<pre>";print_r($email_check);die;
	// 	if ($email_check == 1) {
	// 		$req_bag_session = Session::get('auth_user_id_req_bag');
			
	// 		//if (Auth::check() || isset($req_bag_session) && !empty($req_bag_session)) {
	// 			$userid 		= (Auth::check()) ? Auth::user()->id : $user_info->id;
	// 			$is_payout 		= (empty($request->is_payout_no)) ? '1' : '0';
	// 			$cus_name  		= $request->full_name;
	// 			$cus_email 		= $request->email_address;
	// 			$cus_phone 		= $request->phone_number;
                
 //                $is_return = "";                
 //                $is_recycle = "";
	// 			if (isset($request->is_return)) {
					
	// 				if($request->is_return == 1){
	// 					$is_return = "1";
	// 					$is_recycle = "0";
	// 				}else{
	// 					$is_recycle = "1";
	// 					$is_return = "0";
	// 				}
	// 			}else{
	// 				$is_return = "0";
	// 				$is_recycle = "0";
	// 			}
	// 			/*
	// 			if (isset($request->is_recycle) && !empty($request->is_recycle)) {
	// 				$is_recycle 		= $request->is_recycle;
	// 			}else{
	// 				$is_recycle 		= "0";
	// 			}
	// 			*/
	// 			if (isset($request->address2) && !empty($request->address2)) {
	// 				$address2 		= $request->address2;
	// 			}else{
	// 				$address2 		= "";
	// 			}
	// 			$addres_array = array('fname'=>$cus_name,
	// 				'address1'=>$request->address1,
	// 				'address2'=>$address2,
	// 				'city'=>$request->city,
	// 				'state'=>$request->state,
	// 				'zip_code'=>$request->zipcode,
	// 				'phone'=>$cus_phone,
	// 				'user_id'=>$userid,
	// 				'address_type'=>'request_a_bag','created_on'=>date('y-m-d H:i:s'));
	// 			$ref_no = mt_rand(10000, 99999);
	// 			//echo $ref_no;die;
	// 			$addres_insert=DB::table('address_master')->insertGetId($addres_array);

	// 			$conversation_array = array('type'=>'request_a_bag','user_one'=>$userid,
	// 				'subject'=>'Request a bag subject',
	// 				'user_two'=>'1',
	// 				'status'=>'1',
	// 				'created_at'=>date('y-m-d H:i:s'));
	// 			$conversation_insert=DB::table('conversations')->insertGetId($conversation_array);
	// 			$theard_array  = array('message'=>'Hi',
	// 								'is_seen'=>'0',
	// 						        'deleted_from_sender'=>'0',
	// 						        'deleted_from_receiver'=>'0',
	// 						        'user_id'=>$userid,
	// 						        'user_name'=>(Auth::check())?Auth::user()->display_name:$user_info->display_name,
	// 						        'conversation_id'=>$conversation_insert,
	// 						        'created_at'=>date('y-m-d H:i:s'));
	// 			$theard = DB::table('messages')->insertGetId($theard_array);
				
	// 			$requestabag_array = array('user_id'=>$userid,
	// 				'ref_no'=>$ref_no,
	// 				'addres_id'=>$addres_insert,
	// 				'conversation_id'=>$conversation_insert,
	// 				'is_payout'=>$is_payout,
	// 				'is_return'=>$is_return,
	// 				'is_recycle'=>$is_recycle,
	// 				'status'=>'requested',
	// 				'cus_name'=>$cus_name,
	// 				'cus_email'=>$cus_email,
	// 				'cus_phone'=>$cus_phone,
	// 				'created_at'=>date('Y-m-d H:i:s'),
	// 				);

	// 			$requestabag_insert=DB::table('request_bags')->insertGetId($requestabag_array);
	// 			$conversation_array = array('type_id'=>$ref_no);
	// 			$conversation_insert=DB::table('conversations')->where('id',$conversation_insert)->update($conversation_array);
                                
 //                // send mail
 //                $bag_url_admin 		= '/process-bag/'.$requestabag_insert;
 //                $req_subject        = "REQUEST A BAG";
 //                $req_data           = array('cus_name'=>$cus_name,'bag_url'=>$bag_url_admin);
 //                $template           = 'emails.reqabag_requestfromuser';
 //                $req_to             = 'support@chrysaliscostumes.com';
 //                $mail_status        = $this->sitehelper->sendmail($req_to,$req_subject,$template,$req_data);
 //            if (Auth::check()){                    
	// 			return "success";
	// 		}else{
	// 			return "login";
	// 		}
	// 	}else{
	// 		Session::put('curentURL',URL::to('costume/successrequestbag'));
	// 		return "register";
	// 	}
	// }
	
	/**
	 * Written by Gayatri
	 * Storing Request bag data
	 * @param Request $request [description]
	 */
	public function Postrequestabag(Request $request){
		$cus_email = $request->email_address;
		$email_check = DB::table('users')->where('email',$cus_email)->count();
		$user_info = DB::table('users')->where('email',$cus_email)->first();
		//print_r($request->is_payout_no); exit;
		$is_payout 		= (empty($request->is_payout_no)) ? '1' : '0';
		$cus_name  		= $request->full_name;
		$cus_email 		= $request->email_address;
		$cus_phone 		= $request->phone_number;
        
        $is_return = "";                
        $is_recycle = "";
		if (isset($request->is_return)) {
			
			if($request->is_return == 1){
				$is_return = "1";
				$is_recycle = "0";
			}else{
				$is_recycle = "1";
				$is_return = "0";
			}
		}else{
			$is_return = "0";
			$is_recycle = "0";
		}
		if (isset($request->address2) && !empty($request->address2)) {
			$address2 		= $request->address2;
		}else{
			$address2 		= "";
		}
		$ref_no = mt_rand(10000, 99999);

		$addres_array = array(	
								'fname'        => $cus_name,
								'address1'     => $request->address1,
								'address2'     => $address2,
								'city'         => $request->city,
								'state'        => $request->state,
								'zip_code'     => $request->zipcode,
								'phone'        => $cus_phone,
								'user_id'      => '',
								'address_type' => 'request_a_bag',
								'created_on'   => date('y-m-d H:i:s')
							);


		$conversation_array = array('type'=>'request_a_bag','user_one'=>'1',
									'subject'=>'Your Bag created.',
									'user_two'=>'',
									'status'=>'1',
									'type_id'=>$ref_no,
									'created_at'=>date('y-m-d H:i:s'));

		$theard_array  = array('message'=>'Your Bag is under process.',
								'is_seen'=>'0',
						        'deleted_from_sender'=>'0',
						        'deleted_from_receiver'=>'0',
						        'user_id'=>'',
						        'user_name'=>'',
						        'conversation_id'=>'',
						        'created_at'=>date('y-m-d H:i:s'));

		$requestabag_array = array('user_id'=>'',
									'ref_no'=>$ref_no,
									'addres_id'=>'',
									'conversation_id'=>'',
									'is_payout'=>$is_payout,
									'is_return'=>$is_return,
									'is_recycle'=>$is_recycle,
									'status'=>'requested',
									'cus_name'=>$cus_name,
									'cus_email'=>$cus_email,
									'cus_phone'=>$cus_phone,
									'created_at'=>date('Y-m-d H:i:s'),
								);

		if ($email_check == 1) {
			$req_bag_session = Session::get('auth_user_id_req_bag');
			
			$userid 		= (Auth::check()) ? Auth::user()->id : $user_info->id;
			$addres_array['user_id'] = $userid;
			$addres_insert = DB::table('address_master')->insertGetId($addres_array);

			$conversation_array['user_two'] = $userid;
			$conversation_insert = DB::table('conversations')->insertGetId($conversation_array);
			
			$theard_array['user_id'] = "1";
			$theard_array['user_name'] = User::find(1)->pluck('display_name')->first();
			$theard_array['conversation_id'] = $conversation_insert;
			$theard = DB::table('messages')->insertGetId($theard_array);
			
			$requestabag_array['user_id'] = $userid;
			$requestabag_array['conversation_id'] = $conversation_insert;
			$requestabag_array['addres_id'] = $addres_insert;
			$requestabag_insert = DB::table('request_bags')->insertGetId($requestabag_array);
			
			/*Storing Status In Logs Starts Here*/
			DB::table("reqbag_status_log")->insert([
				"user_id" => Auth::user()->id,
				"bag_id" => $requestabag_insert,
				"process" => "Create Request",
				"status" => "Bag has been created with #".$requestabag_insert,
				"created_at" => Carbon::now()
			]);
			/*Storing Status In Logs Ends Here*/   

			// send mail to Admin
			$bag_url_admin 		= '/process-bag/'.$requestabag_insert;
            $req_subject        = "REQUEST A BAG";
            $req_data           = array('cus_name'=>$cus_name,'bag_url'=>$bag_url_admin);
            $template           = 'emails.reqabag_requestfromuser';
            $req_to             = 'gbhyri@dotcomweavers.com';//"support@chrysaliscostumes.com";
            $mail_status        = $this->sitehelper->sendmail($req_to,$req_subject,$template,$req_data);				                
            
            // send mail to user
            $req_subject        = "REQUEST A BAG";
            $req_data           = array('cus_name'=>$cus_name,'username'=>(Auth::check())?Auth::user()->username:$user_info->username);
            $template           = 'emails.reqabag_requestfromuser';
            $req_to             = (Auth::check())?Auth::user()->email:$user_info->email;//"support@chrysaliscostumes.com";
            $mail_status        = $this->sitehelper->sendmail($req_to,$req_subject,$template,$req_data);
            if (Auth::check()){
				return "success";
			}else{
				return "login";
			}
		}else{
			$addres_insert = DB::table('tmp_address_master')->insertGetId($addres_array);
			
			$conversation_insert = DB::table('tmp_conversations')->insertGetId($conversation_array);			
			$theard_array['conversation_id'] = $conversation_insert;
			$theard = DB::table('tmp_messages')->insertGetId($theard_array);
			
			$requestabag_array['conversation_id'] = $conversation_insert;
			$requestabag_array['addres_id'] = $addres_insert;
			$requestabag_insert = DB::table('tmp_request_bags')->insertGetId($requestabag_array);

			Session::put('curentURL',URL::to('costume/successrequestbag'));

			return "register";
		}
	}

	public function Successrequestbag(){
		
	  return view('frontend.costumes.sucess_request_bag');
	}

	public function EditCostume($id){

       
		//echo "<pre>";print_r("hello");die;
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
		$categories=DB::table('category')->select('category_id as categoryid','name as categoryname')->where('status','=','1')->where('parent_id','=','0')->orderby('sort_order','asc')->get();
		//echo "<pre>"; print_r($categories); exit;
		$shippingoptions=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','9')->get();
		$packageditems=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','10')->get();
		$type=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','12')->get();
		$service=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','13')->get();
		$dimensions=DB::table('attribute_options')
		->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','11')->get();
		$handlingtime=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','14')->get();
		$returnpolicy=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','15')->get();

		$charities=DB::table('charities')->select('id as id','name as name','image as image')->where('status','1')->limit(8)->get();
		$front_image = DB::table('costume_image')->where('costume_id',$id)->where('type','1')->first();
		$back_image = DB::table('costume_image')->where('costume_id',$id)->where('type','2')->first();

		$details_image = DB::table('costume_image')->where('costume_id',$id)->where('type','3')->first();
		$more_image = DB::table('costume_image')->where('costume_id',$id)->where('type','4')->get();

		$costume_description = DB::table('costume_description')->where('costume_id',$id)->first();
		$costume_category_1 = DB::table('costume_to_category')->where('costume_id',$id)->first();
		$costume_category_2 = DB::table('costume_to_category')->where('costume_id',$id)->first();
		$costume_details = DB::table('costumes')->where('costume_id',$id)->first();
		//echo "<pre>"; print_r($costume_details); exit;
		$db_body_height_ft = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','16')->first();
		 
		$db_body_height_in = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','17')->first();
		$db_body_weight_lbs = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','18')->first();
		$db_body_chest_in = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','19')->first();
		$db_body_waist_lbs = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','20')->first();
		$db_cosplayone = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','2')->first();
		$db_cosplaytwo = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','3')->first();
		$db_cosplaythree = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','4')->first();
		$db_cosplayfour = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','5')->first();
		$db_cosplayfive = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','21')->first();
		
		$db_des_costume = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','6')->first();
		$db_funfact = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','7')->first();
		$db_faq = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','8')->first();

		$db_shippin_opt = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','9')->first();
		$db_dimensions_length = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','22')->first();
		$db_dimensions_width = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','23')->first();
		$db_dimensions_height = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','24')->first();
		$db_handlingtime = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','14')->first();

        
		$handling_costume = DB::table('costumes as c')
							->leftjoin('attribute_options as ao','ao.option_id','=','c.condition_type')
							->where('c.costume_id',$id)
							->select('c.condition_type','ao.option_id','c.costume_id')
							->first();
		$db_return = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','15')->first();
		$costume_id = $id;
		$db_subcategoryname = DB::table('category')->where('parent_id', $costume_details->cat_id)->where('status', '=',1)->get(['category_id as subcategoryid','name as subcategoryname']);
		$db_cosplayplay_yes_opt = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','25')->first();
		$db_uniquefashion_yes_opt = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','26')->first();
		$db_activity_yes_opt = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','28')->first();
		$db_make_costume_time = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','29')->first();
		$db_film_name = DB::table('costume_attribute_options')->where('costume_id',$id)->where('attribute_id','30')->first();
		//print_r($db_film_name);die;
		if ($costume_details->charity_id == 0) {
			$charities_details = DB::table('charities')->where('costume_id',$id)->first();
		//echo "<pre>";print_r($charities_details);die;
		}

		$cosplaySubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>66,'status'=>1));

		$uniqueFashionSubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>143,'status'=>1));

		$filmTheatreSubCategories=Site_model::Fetch_data('category','*', array('parent_id'=>147,'status'=>1));


		$handwashed=DB::table('attribute_options')->select('option_id as optionid','attribute_id as attribute_id','option_value as value')
		->where('attribute_id','=','31')->get();

// echo "<pre>"; //print_r($db_subcategoryname); 
// print_r($costume_category_2); exit;


		return view('frontend.costumes.costume_create_two_edit',compact('categories','bodyanddimensions','bodydimensions_val','body_height_ft',
		'body_height_in','body_weight_lbs','body_chest_in','body_waist_lbs','cosplayone','cosplaytwo','cosplaythree','cosplayfour',
		'cosplayfive','cosplayone_values','cosplaytwo_values','cosplaythree_values','cosplayfour_values','cosplayfive_values',
		'shippingoptions','packageditems','type','dimensions','service','handlingtime','returnpolicy','charities',
		'front_image','back_image','details_image','more_image','costume_description','costume_category_1','costume_category_2','costume_details',
		'db_body_height_ft','db_body_height_in','db_body_weight_lbs','db_body_chest_in','db_body_waist_lbs',
		'db_cosplayone','db_cosplaytwo','db_cosplaythree','db_cosplayfour','db_cosplayfive','db_des_costume',
		'db_funfact','db_faq','db_shippin_opt','db_dimensions_length','db_dimensions_width','db_dimensions_height',
		'db_handlingtime','handling_costume','db_return','costume_id','db_subcategoryname','db_cosplayplay_yes_opt','db_uniquefashion_yes_opt','handwashed',
		'db_activity_yes_opt','db_make_costume_time','charities_details','db_film_name', 'cosplaySubCategories', 'uniqueFashionSubCategories', 'filmTheatreSubCategories'));
		
	}

	public function EditCostumeAdd(Request $request){
 
	    
		$userid=Auth::user()->id;
		$delete_costume_attributes = DB::table('costume_attribute_options')->where('costume_id',$request->costume_id)->delete();
	 
		$delete_costume_attributes = DB::table('costume_to_category')->where('costume_id',$request->costume_id)->delete();
			$req=$request->all();
		
			$costume_name=$req['costume_name'];
		  	$categoryname=$req['categoryname'];
		  	$costume_condition=$req['condition'];
		  	$gender = $req['gender'];
		  	$size = $req['size'];
		  	$subcategory = $req['subcategory'];
		  	$heightft =$req['height-ft'];
		  	$heightin = $req['height-in'];
		  	$weightlbs = $req['weight-lbs'];
		  	$chestin =$req['chest-in'];
		  	$waistlbs =$req['waist-inches'];
		  	$cosplay = null;
		  	$fashion = null;
		  	$activity = null;

		  	if(isset($req['cleaned']) && !empty($req['cleaned'])){
		  		$cleaned = $req['cleaned'];	
		  	}else{
		  		$cleaned = "";
		  	}
		  	

		  	$makecostume=$req['make_costume'];
		  	$filmquality=$req['fimquality'];
		  	//$makecostumetime = $req['make-costume-time'];
		  	$description = $req['description'];
		  	
		  	$faq = $req['faq'];
		  	$weight_pounds = $req['pounds'];
		  	$weight_ounces = $req['ounces'];
		  	$customer_group="user";
			//Check whether the costume inserted by admin or not if the user is selected insert the user id else insert the admin as costumer
			$costume=array(
			'weight_pounds'=>$weight_pounds,
			'weight_ounces'=>$weight_ounces,
			'gender'=>$gender,
			'condition'=>$costume_condition,
			'created_user_group'=>$customer_group,
			'size'=>$size,
			'cat_id'=>$categoryname,
			'condition_type' =>$cleaned,
			'dynamic_percent'=>$request->dynamic_percent_amount,
			'created_by'=>$userid,
			'updated_at'=>date('y-m-d H:i:s'),
			);

			$insert_costume=DB::table('costumes')->where('costume_id',$request->costume_id)->update($costume);
			 Session::put('session_costume_id', $insert_costume);
			 $costume_id = $insert_costume;

			$costume_id = $request->costume_id;


			if($request->Imagecrop1 != "" || !empty($request->Imagecrop1) ) {

				$file_db = DB::table('costume_image')->where('costume_id', $request->costume_id)->where('type', '1')->delete();
				$Imagecrop1 = $request->Imagecrop1;
				$img = str_replace('data:image/jpeg;base64,', '', $Imagecrop1);
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);
				//$source = imagecreatefromstring($data);
				$Orand = str_random(10) . '.png';
				$originalPath = public_path('costumers_images/Original/') . $Orand;
				$data1 = $Orand;
				$OriginalImage = file_put_contents($originalPath, $data);
				$Mediumresizeimg = Image::make($originalPath);
				$Mediumresizeimg->resize(260, 356);
				$Mediumresizeimg->save(public_path('costumers_images/Medium/') . $Orand);
				$Smallresizeimg = Image::make($originalPath);
				$Smallresizeimg->resize(140, 190);
				$Smallresizeimg->save(public_path('costumers_images/Small/') . $Orand);
				$Largeresizeimg = Image::make($originalPath);
				$Largeresizeimg->resize(475, 650);
				$Largeresizeimg->save(public_path('costumers_images/Large/') . $Orand);
				$ExLargeresizeimg = Image::make($originalPath);
			    $ExLargeresizeimg->resize(889, 1217);
			    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Orand);
			    chmod(public_path('costumers_images/ExLarge/').$Orand, 0777);
				if ($OriginalImage) {
					$file_db_array1 = array('costume_id' => $costume_id,
						'image' => $data1,
						'type' => 1,
						'sort_order' => 0,
					);
					$file_db = DB::table('costume_image')->insert($file_db_array1);
				}
			}

		if($request->Imagecrop2 != "" || !empty($request->Imagecrop2)) {

			$file_db = DB::table('costume_image')->where('costume_id', $request->costume_id)->where('type', '2')->delete();

			$Imagecrop2 = $request->Imagecrop2;
			$img = str_replace('data:image/jpeg;base64,', '', $Imagecrop2);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$Orand = str_random(10) . '.png';
			$originalPath = public_path('costumers_images/Original/') . $Orand;
			$data1 = $Orand;
			$OriginalImage = file_put_contents($originalPath, $data);
			$Mediumresizeimg = Image::make($originalPath);
			$Mediumresizeimg->resize(260, 356);
			$Mediumresizeimg->save(public_path('costumers_images/Medium/') . $Orand);
			$Smallresizeimg = Image::make($originalPath);
			$Smallresizeimg->resize(140, 190);
			$Smallresizeimg->save(public_path('costumers_images/Small/') . $Orand);
			$Largeresizeimg = Image::make($originalPath);
			$Largeresizeimg->resize(475, 650);
			$Largeresizeimg->save(public_path('costumers_images/Large/') . $Orand);

			$ExLargeresizeimg = Image::make($originalPath);
		    $ExLargeresizeimg->resize(889, 1217);
		    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Orand);
		    chmod(public_path('costumers_images/ExLarge/').$Orand, 0777);

			if ($OriginalImage) {
				$file_db_array2 = array('costume_id' => $costume_id,
					'image' => $data1,
					'type' => 2,
					'sort_order' => 0,
				);

				$file_db = DB::table('costume_image')->insert($file_db_array2);
			}

		}


		if($request->Imagecrop3 != "" || !empty($request->Imagecrop3)) {
			$file_db = DB::table('costume_image')->where('costume_id', $request->costume_id)->where('type', '2')->delete();
			$Imagecrop1 = $request->Imagecrop3;
			$img = str_replace('data:image/jpeg;base64,', '', $Imagecrop1);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$Orand = str_random(10) . '.png';
			$originalPath = public_path('costumers_images/Original/') . $Orand;
			$data1 = $Orand;
			$OriginalImage = file_put_contents($originalPath, $data);
			$Mediumresizeimg = Image::make($originalPath);
			$Mediumresizeimg->resize(260, 356);
			$Mediumresizeimg->save(public_path('costumers_images/Medium/') . $Orand);
			$Smallresizeimg = Image::make($originalPath);
			$Smallresizeimg->resize(140, 190);
			$Smallresizeimg->save(public_path('costumers_images/Small/') . $Orand);
			$Largeresizeimg = Image::make($originalPath);
			$Largeresizeimg->resize(475, 650);
			$Largeresizeimg->save(public_path('costumers_images/Large/') . $Orand);
			$ExLargeresizeimg = Image::make($originalPath);
		    $ExLargeresizeimg->resize(889, 1217);
		    $ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$Orand);
		    chmod(public_path('costumers_images/ExLarge/').$Orand, 0777);
			if ($OriginalImage) {
				$file_db_array2 = array('costume_id' => $costume_id,
					'image' => $data1,
					'type' => 3,
					'sort_order' => 0,
				);
				$file_db = DB::table('costume_image')->insert($file_db_array2);
			}

		}


		if($request->Frontone !="" || $request->Frontone !='undefined' || $request->Frontone !=null)
		{
			$file_db = DB::table('costume_image')->where('image',$request->Frontone)->where('type', '1')->delete();
		}

		if($request->Backone !="" || $request->Backone !='undefined' || $request->Backone !=null)
		{
			$file_db = DB::table('costume_image')->where('image',$request->Backone)->where('type', '2')->delete();
		}

		if($request->Addione !="" || $request->Addione !='undefined' || $request->Addione !=null)
		{
			$file_db = DB::table('costume_image')->where('image',$request->Addione)->where('type', '3')->delete();
		}


		//remove uploaded images

		if (isset($request['multiple']) && !empty($request['multiple'])) {
			foreach ($request['multiple'] as $remove) {
				$file_db = DB::table('costume_image')->where('image',$remove)->where('type', '4')->delete();
			}
		}

		//moving extra images

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
				$Mediumresizeimg->resize(260, 356);

				$Mediumresizeimg->save(public_path('costumers_images/Medium/').$Multiplerand);
				$Smallresizeimg = Image::make($originalPath);
				//$Srand = str_random(10) . '.png';
				$Smallresizeimg->resize(140, 190);
				$Smallresizeimg->save(public_path('costumers_images/Small/').$Multiplerand);
				$Largeresizeimg = Image::make($originalPath);
				//$Lrand = str_random(10) . '.png';
				$Largeresizeimg->resize(475, 650);
				$Largeresizeimg->save(public_path('costumers_images/Large/').$Multiplerand);

				$ExLargeresizeimg = Image::make($originalPath);
				$ExLargeresizeimg->resize(889, 1217);
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

		// echo "images insertion";die;
	            $final_keywords = array();
			if($request->has('keyword_10')){
				$final_keywords[1] = $request->keyword_10;
			}
			if($request->has('keyword_9')){
				$final_keywords[2] = $request->keyword_9;
			}
			if($request->has('keyword_8')){
				$final_keywords[3] = $request->keyword_8;
			}
			if($request->has('keyword_7')){
				$final_keywords[4] = $request->keyword_7;
			}
			if($request->has('keyword_6')){
				$final_keywords[5] = $request->keyword_6;
			}
			if($request->has('keyword_5')){
				$final_keywords[6] = $request->keyword_5;
			}
			if($request->has('keyword_4')){
				$final_keywords[7] = $request->keyword_4;
			}
			if($request->has('keyword_3')){
				$final_keywords[8] = $request->keyword_3;
			}
			if($request->has('keyword_2')){
				$final_keywords[9] = $request->keyword_2;
			}
			if($request->has('keyword_1')){
				$final_keywords[10] = $request->keyword_1;
			}
			$final_keywords = implode(",", $final_keywords);
			/*
		 |Tbale:costume_description
		 |@costume_id int
		 |@language_id  int
		 |@name varchar
		 |@description text
		 */
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
			/*$costume_category=array('costume_id'=>$request->costume_id,
			'category_id'=>$categoryname,'sort_no'=>'1');
			$insert_costume_category=DB::table('costume_to_category')->insertGetId($costume_category);*/
			$costume_category=array('costume_id'=>$request->costume_id,
			'category_id'=>$subcategory,'sort_no'=>'1');
			$insert_costume_category=DB::table('costume_to_category')->insertGetId($costume_category);
			/**** Url create start here ***/
			//Costumes::urlRewrites($insert_costume,'insert');
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
			$make_costume_time=array('costume_id'=>$request->costume_id,
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
			$film_name=array('costume_id'=>$request->costume_id,
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
			$cosplay_yes=array('costume_id'=>$request->costume_id,
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
			$uniquefashion_yes=array('costume_id'=>$request->costume_id,
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
			$activity_yes=array('costume_id'=>$request->costume_id,
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
			$height_ft=array('costume_id'=>$request->costume_id,
			'attribute_id'=>'16',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$heightft,
			);
			$height_ft_insert=DB::table('costume_attribute_options')->insert($height_ft);
			//Height-inches
			$height_in=array('costume_id'=>$request->costume_id,
			'attribute_id'=>'17',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$heightin,
			);
			$height_in_insert=DB::table('costume_attribute_options')->insert($height_in);
			//weight-lbs
			$weight_lbs=array('costume_id'=>$request->costume_id,
			'attribute_id'=>'18',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$weightlbs,
			);
			$weight_lbs_insert=DB::table('costume_attribute_options')->insert($weight_lbs);
			//chestin
			$chest_in=array('costume_id'=>$request->costume_id,
			'attribute_id'=>'19',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$chestin,
			);
			$chest_in_insert=DB::table('costume_attribute_options')->insert($chest_in);
			//chestin
			$waist_lbs=array('costume_id'=>$request->costume_id,
			'attribute_id'=>'20',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$waistlbs,
			);
			$waist_lbs_insert=DB::table('costume_attribute_options')->insert($waist_lbs);

			switch($makecostume){ case '30': $makecostume_value="yes"; break; case '31': $makecostume_value="No"; break; }
			$user_costume=array('costume_id'=>$request->costume_id,
			'attribute_id'=>'5',
			'attribute_option_value_id'=>$makecostume,
			'attribute_option_value'=>$makecostume_value,
			);
			$user_costume_insert=DB::table('costume_attribute_options')->insert($user_costume);

			switch($filmquality){ case '32': $filmquality_value="yes"; break; case '33': $filmquality_value="No"; break; }
			$film_quality=array('costume_id'=>$request->costume_id,
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
			$description_val=array('costume_id'=>$request->costume_id,
			'attribute_id'=>'6',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$description,
			);
			$description_insert=DB::table('costume_attribute_options')->insert($description_val);
			//Funfact
			/*$funfact_val=array('costume_id'=>$request->costume_id,
			'attribute_id'=>'7',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$funfacts,
			);
			
			$funfact_insert=DB::table('costume_attribute_options')->insert($funfact_val);*/
			//faq
			$faq_value=array('costume_id'=>$request->costume_id,
			'attribute_id'=>'8',
			'attribute_option_value_id'=>'0',
			'attribute_option_value'=>$faq,
			);
			$faq_insert=DB::table('costume_attribute_options')->insert($faq_value);
			// costume description end
			// pricing insertion
			$price1=$req['price'];
			$price = str_replace(",","",$price1);
		  	$quantity=$req['quantity'];
		  	$length = $req['Length'];
		  	$width = $req['Width'];
		  	$height = $req['Height'];
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
           
			$update_costume = DB::table('costumes')->where('costume_id',$request->costume_id)->update($costume);

		/*
		|Table:costume_attribute_options
		|Package Information
		|@costume_id 
		|@attribute_id
		|@attribute_option_value_id
		|@attribute_option_value
		*/

			//length
			if(!empty($length)){
			$length=array('costume_id'=>$request->costume_id,
				'attribute_id'=>'22',
				'attribute_option_value_id'=>0,
				'attribute_option_value'=>$length,
				);
			$length_db=DB::table('costume_attribute_options')->insert($length);
			}
			//width
			if (!empty($width)) {				
			$width=array('costume_id'=>$request->costume_id,
				'attribute_id'=>'23',
				'attribute_option_value_id'=>0,
				'attribute_option_value'=>$width,
				);
			$width_db=DB::table('costume_attribute_options')->insert($width);
			}
			//height
			if (!empty($height)) {
				
			$height=array('costume_id'=>$request->costume_id,
				'attribute_id'=>'24',
				'attribute_option_value_id'=>0,
				'attribute_option_value'=>$height,
				);
			$width_db=DB::table('costume_attribute_options')->insert($height);
			}
			//end pricing insertion

			$req=$request->all();
			$userid=Auth::user()->id;

		  	$handlingtime=$req['handlingtime'];
		  	$returnpolicy=$req['returnpolicy'];
		  	$donate_charity=$req['donate_charity'];
		  	//$charity_name=$req['charity_name'];
			/*
			|Table:costume_attribute_options
			|Preferences
			|@costume_id 
			|@attribute_id
			|@attribute_option_value_id
			|@attribute_option_value
			*/
			//Handling Time
			$handling_name = DB::table('attribute_options')
								->select('option_value as value')
								->where('attribute_id','=','14')
								->where('option_id',$handlingtime)
								->first();
	
			$handlingtime_val=array('costume_id'=>$request->costume_id,
				'attribute_id'=>'14',
				'attribute_option_value_id'=>$handlingtime,
				'attribute_option_value'=>$handling_name->value,
				);
			$insert_handlingtime=DB::table('costume_attribute_options')->insert($handlingtime_val);
			//Return Policy

			$returnpolicy_name = DB::table('attribute_options')
								->select('option_value as value')
								->where('attribute_id','=','15')
								->where('option_id',$returnpolicy)
								->first();
			$returnpolicy_val=array('costume_id'=>$request->costume_id,
				'attribute_id'=>'15',
				'attribute_option_value_id'=>$returnpolicy,
				'attribute_option_value'=>$returnpolicy_name->value,
				);
			$insert_returnpolicy=DB::table('costume_attribute_options')->insert($returnpolicy_val);

			/*
		 	|Tbale:costumes
		 	|@donation_amount float
		 	|@charity_id  int
		 	*/
		 	
			//Check whether the costume inserted by admin or not if the user is selected insert the user id else insert the admin as costumer
			if (isset($req['charity_name']) && !empty($req['charity_name'])) {
				
			$costume=array('charity_id'=>$req['charity_name'],
			'donation_amount'=>$req['hidden_donation_amount'],
			'dynamic_percent'=>$req['donate_charity'],
			'updated_at'=>date('y-m-d H:i:s'),
			);

			$update_costume = DB::table('costumes')->where('costume_id',$request->costume_id)->update($costume);
			}else{
				$costume=array('charity_id'=>"0",
				'donation_amount'=>$req['hidden_donation_amount'],
				'dynamic_percent'=>$req['donate_charity'],
				'updated_at'=>date('y-m-d H:i:s'),
				);
			$update_costume = DB::table('costumes')->where('costume_id',$request->costume_id)->update($costume);

			}

			//charites
			if (isset($req['organzation_name']) && !empty($req['organzation_name'])) {
				$organzation_name=$req['organzation_name'];
				$arrayName = array('name' => $organzation_name,
					'suggested_by'=>$userid,
					'costume_id'=>$request->costume_id,
					'status'=>'0',
					'created_at'=>date('y-m-d H:i:s'),
					'updated_at'=>date('y-m-d H:i:s'),
					 );
				$char = DB::table('charities')->where('costume_id',$request->costume_id)->first();
				if (count($char) == 0) {
					$organzation_name=DB::table('charities')->insert($arrayName);
				}else{
					$organzation_name=DB::table('charities')->where('costume_id',$request->costume_id)->update($arrayName);
				}
			}

			/* Added by Gayatri*/
			$listUrlObj = \DB::table('url_rewrites')->where('type', 'product')->where('url_offset', $request->costume_id)->first();

			$list_url_arr = explode('/', $listUrlObj->url_key);

			$share_url = URL::to('/').'/product'.$listUrlObj->url_key; 
			
			Meta::set('url', $share_url);

			DB::update('update cc_costumes set donating_percent = FORMAT(`donation_amount`/`price`,2)*100  where costume_id = ?', [$costume_id]);

			$charity_info = Costumes::leftjoin('charities', 'costumes.charity_id', '=', 'charities.id')
									->join('costume_description','costumes.costume_id','=','costume_description.costume_id')
									->select('charities.name','costume_description.name as cos_name', 'costumes.donation_amount', 'costumes.donating_percent')
									->where('costumes.costume_id',$request->costume_id)
									->first();
			$donation = ''; $amount = '';
			if(isset($charity_info) && !empty($charity_info)){
				//$a = str_replace('.','',$charity_info->donation_amount);
				//$amount = $charity_info->donation_amount*100;
				$amount = number_format($charity_info->donation_amount,2);
				if($amount > 0){
					$donation.= $charity_info->donating_percent.'% of the sale goes to '.ucfirst($charity_info->name)."." ;	
				}
				
				$is_amount = 1;
			}

			if ((stripos( $charity_info->cos_name, 'costume' ) != '') || (stripos( $charity_info->cos_name, 'cosplay' ) != '')) {
			  	$name = $charity_info->cos_name;
			}else{
				$name = $charity_info->cos_name." Costume";
			}

			$quote = "I’m selling my ".ucfirst($name)." on Chrysalis.\n".$donation." Check it out!";

			$debugger = Costumes::facebookDebugger($share_url);
			$data=Costumes::getCostumeImages($request->costume_id);
			$pic = asset('/costumers_images/Large').'/'.$data[0]->image;
			$name_costume = $charity_info->cos_name;
			$charity_center = ucfirst($charity_info->name);

			
			/* End*/

			// send mail
			$reg_subject        = "Costume Edited";
			$reg_data           = array('name'=>Auth::user()->display_name,'costume_name'=>$costume_name);
			$template           = 'emails.editcostume';
	         //---- send mail
			$reg_to             = Auth::user()->email;

			
			$mail_status = $this->sitehelper->sendmail($reg_to,$reg_subject,$template,$reg_data);	
			

			return response()->json(['msg'=>'success', 'share_url' => $share_url, 'quote' => $quote, 'first_pic'=> $pic, 'costume_name'=>$name, 'amount'=>$charity_info->donating_percent, 'charity_center'=>ucfirst($charity_info->name)]);

			//return "success";
	}

	public function MyCostumes(){
	    if(Auth::user()){
            $title="My Costumes List";
            return view('frontend.costumes.my_costumes')->with('title',$title);
        }else{
            return Redirect::to('/login');
        }
	}
	/**
	 * Written by Gayatri
	 * delete the Costumes
	 * @param  [Integer] $id [Costume Id]
	 * @return Redirection back
	 */
	public function deleteCostume($id)
	{
		$costume = DB::table('costumes')->where('costume_id', $id)->update(['deleted_status' => '1']);
    	$cc_url_rewrite_delete = DB::table('url_rewrites')->where('type', 'product')->where('url_offset', $id)->delete();
        $costume_to_category = DB::table('costume_to_category')->where('costume_id', $id)->delete();
        $costume_attribute_options = DB::table('costume_attribute_options')->where('costume_id', $id)->delete();
        $costume_image = DB::table('costume_image')->where('costume_id', $id)->delete();
        return Redirect::back()->with('success', 'Costume deleted Successfully.');
	}

	/**
	 * Written by Gayatri
	 * While clicking on a click from mobile redirect the user to desktop version of costume edit page with charity bolck
	 * @param  [string] $encode_costume_id []
	 * @return [array] redirect to charity page
	 */
	public function redirectToCharity($id)
	{
		$costume_info = DB::table('costumes')->where('unq_costume_code', base64_decode($id))->first();
		$user = User::where('id',$costume_info->created_by)->first();
		Auth::login($user, true);
		return Redirect::to('/costume/edit/'.$costume_info->costume_id.'/charity');
	}

	public function GenerateExLarge()
	{
		ini_set('max_execution_time', -1);
		ini_set('memory_limit', -1);
		//$directory = public_path('costumers_images/Original');
		//$files = \File::allFiles($directory);
		$files = DB::table("costume_image")
			->leftjoin("costumes","costumes.costume_id","=","costume_image.costume_id")
			->where([["costumes.deleted_status","0"],["costume_image.isOptimized","N"]])
			->select("costume_image.costume_image_id","costume_image.image")
			->get();
		foreach ($files as $costume)
		{
			try{
				//$name = pathinfo($file)['basename'];
				$name = $costume->image;
				$imageId = $costume->costume_image_id;
			    $originalPath = public_path('costumers_images/Original/').$name;
				$ExLargeresizeimg = Image::make($originalPath);
				$ExLargeresizeimg->resize(889, 1217);
				$ExLargeresizeimg->save(public_path('costumers_images/ExLarge/').$name);
				chmod(public_path('costumers_images/ExLarge/').$name, 0777);
				DB::table("costume_image")->where("costume_image_id",$imageId)->update(["isOptimized" => "Y"]);
			}catch(\Exception $e){
				\Log::info("Failed to Generate X-Large for ". $name);
			}
		}
		
	}

}

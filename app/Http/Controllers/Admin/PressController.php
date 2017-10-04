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
<<<<<<< HEAD
use App\Helpers\Site_model;
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
use Hash;
use Response;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Validator;
use App\User;
<<<<<<< HEAD
use App\Imageresize;

class PressController extends Controller {
  public function __construct(Guard $auth) {
        
         $this->auth       = $auth;
        $this->sitehelper = new SiteHelper();
        $this->table      = 'press_releases';
 }
    
//Press Posts Page
    public function pressPosts() {
        $heading = "Press Posts List";
        $create = "Add Post";
        $breadcrumb = "Press Posts";
        $categories = DB::table('press_categories')
                        ->select('cat_name', 'id')
                        ->get();

        return view('admin.press.press-posts', compact('heading', 'create', 'breadcrumb', 'categories'));
    }
//Add Press Post Page 
    public function addPressPost() {
        $users = DB::table('press_categories')
                ->select('*')
                ->get();
                
                
        return view('admin.press.add-press-post', compact('users'));
    }
//Insert Press Post Functionality
    public function insertPressPost(Request $request) {
        //Validator
        $req=$request->all();
        $validator = Validator::make($request->all(), [
          
                  'postTitle' => 'required|min:5|max:255',
                  'postSource' => 'required',
                  'postDesc' => 'required|min:5',
                  'press_image' => 'required'
=======

class PressController extends Controller {
	

	public function pressPosts() {
		$heading = "Press";
		$create = "+ Add Post";
		$breadcrumb = "Press Posts";
		$categories = DB::table('press_categories')
						->select('cat_name', 'id')
						->get();

		return view('admin.press.press-posts', compact('heading', 'create', 'breadcrumb', 'categories'));
	}

	public function addPressPost() {
		$users = DB::table('press_categories')
				->select('*')
				->get();
				
				
		return view('admin.press.add-press-post', compact('users'));
	}

	public function insertPressPost(Request $request) {
		//Validator
		$req=$request->all();
		
		$validator = Validator::make($request->all(), [
		  
                  'postTitle' => 'required',
                  'postSource' => 'required',
                  'postDesc' => 'required',
                  'postImage' => 'required'
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                ]);
   
   if ($validator->fails()) {
        return Redirect::back()
        ->withErrors($validator)
        ->withInput()->send();

<<<<<<< HEAD
    } else {


        //Variables Declaration
        $postTitle = $request->input('postTitle');
        $postSource = $request->input('postSource');
        $postSourceUrl = $postSource;
        $postDesc = $request->input('postDesc');

        if(count($req)){
            if(isset($req['press_image'])){
                $image = Imageresize::pressInsert($req['press_image']);
                $file_name = $image;
            }
        }

        //Array Declaration
        $pressData = array(
                'press_title' => $postTitle,
                'source' => $postSourceUrl,
                'press_desc' => $postDesc,
                'user_img' =>$file_name,
                'status' => Auth::user()->id,
                'created_at' => date('y-m-d H:i:s')
            );


        
        $press_insert = DB::table('press')->insertGetId($pressData);
        
        
        
    Session::flash('success', 'Press Post Created Successfully');
            return Redirect::to('press-posts');
    
    }
}
//Edit Press Post Page
    public function editPressPost($id) {
        $press_id = $id;
        $users = DB::table('press_categories')
                ->select('press_categories.id', 'press_categories.cat_name')
                ->get();
        
        $presscategories=DB::table('press as p')
        ->leftJoin('press_cat_link as pc','pc.press_id','=','p.press_id')
        ->where('p.press_id','=',$press_id)
        ->select('p.press_id as id','pc.cat_id')
        ->groupBy('pc.cat_id')      
        ->get();


        
        $categories=DB::table('press')
                ->select('press.press_title', 'press.source', 'press.press_desc', 'press.press_id as id','press.user_img as user_img')
                ->where('press.press_id', $press_id)
                ->first();
    
                /*print_r($users); exit;*/
        return view('admin.press.edit-press', compact('users','presscategories','categories'));
    }

//Update Press Post Functionality
    public function updatePressPost(Request $request){
        $req=$request->all();
        $press_id = $request->input('pressid');
         if (count($req)) {
            $rule = array(
                  'postTitle' => 'required|min:5|max:255',
                  'postSource' => 'required',
                  'postDesc' => 'required|min:5',
                  
            );

            $validator = Validator::make($req, $rule);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator->messages())->withInput();
            } else {

                $file_name = null;
                if(!empty($req['imageExists']) && empty($req['press_image']) && $req['imageExists'] != 'removed'){
                    $file_name = $req['imageExists'];
                }else if(!empty($req['imageExists']) && !empty($req['press_image'])){
                    $image = Imageresize::pressInsert($req['press_image']);
                    $file_name = $image;
                }else if(empty($req['imageExists']) && !empty($req['press_image'])){
                    $image = Imageresize::pressInsert($req['press_image']);
                    $file_name = $image;
                }

                 $data = array(
                    'press_title' => $req['postTitle'],
                    'press_desc'        => $req['postDesc'],
                    'user_img' => $file_name,
                    'source'             => $req['postSource'],
                    'updated_at'         => date('Y-m-d H:i:s'),
                );
                $condition = array('press_id' => $press_id);
                $user_meta = Site_model::update_data('press', $data, $condition);
                Session::flash('success', 'Press Post Updated Successfully');
                return Redirect::to('/press-posts');

            }

        }
         Session::flash('fail', 'Unable To Update Press Post.');
        return Redirect::back();

        
    }
 
//delete Press Post Functionality
    public function deletePressPost($id) {
        //Variable Declaration
        $pressid = $id;
        
        // Delete Query
        
            $delete_press_id = DB::table('press')
                                ->where('press.press_id', $pressid)
                                ->leftjoin('press_cat_link', 'press.press_id', '=', 'press_cat_link.press_id')
                                ->delete();

            $delete_category_id = DB::table('press_categories')
                                ->where('press_categories.id', $pressid)
                                ->leftjoin('press_cat_link', 'press_categories.id', '=', 'press_cat_link.cat_id')
                                ->delete();


        Session::flash('success', 'Press Post is Deleted successfully');
          return redirect('/press-posts');
                
    }

//Press Post List
    public function pressPostList(Request $request) {
        $req = $request->all();
        

        $users = DB::table('press')
                ->leftjoin('press_cat_link', 'press_cat_link.press_id', '=', 'press.press_id')
                ->leftjoin('press_categories', 'press_categories.id', '=', 'press_cat_link.cat_id')
                ->select('press.press_id as id', 'press.press_title', 'press.status', 'press.created_at', 'press.updated_at',DB::raw("group_concat(cc_press_categories.cat_name SEPARATOR ', ') as cat_name"),DB::Raw('DATE_FORMAT(cc_press.created_at,"%m/%d/%y %h:%i %p") as date_format'))
                ->groupBy('press.press_id', 'press.press_title', 'press.created_at', 'press.updated_at')
                ->get();
                
                
        

         return Datatables::of($users)
            ->addColumn('actions', function ($usersdetails) {
                return '<a href="/admin/editpress/'.$usersdetails->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
=======
	} else {


		//Variables Declaration
		$postTitle = $request->input('postTitle');
		$postSource = $request->input('postSource');
		$postDesc = $request->input('postDesc');
		
		if(count($req)){


			$name = User::find(Auth::user()->id);
			if(isset($req['postImage'])){
				$file_name = str_random(10).'.'.$req['postImage']->getClientOriginalExtension();
				$source_image_path=public_path('profile_img');
				$thumb_image_path1=public_path('profile_img');
				$thumb_image_path2=public_path('profile_img/thumbs');
				$req['postImage']->move($source_image_path, $file_name);
				/*$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,150,150);
				$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,30,30);*/

			}
			else if(isset($req['is_removed'])){
				$file_name="";
			}
			else{
				$file_name=$name->avatar;
			}
}
		/*$category = $request->input('Categories');
		$implode_categories = implode(',', $category);*/
		

		
		//Array Declaration
		$pressData = array(
				'press_title' => $postTitle,
				'source' => $postSource,
				'press_desc' => $postDesc,
				'user_img' =>$file_name,
				'created_at' => date('y-m-d H:i:s')
			);


		/*$categoryData = array(
			'cat_name' => $implode_categories
			
			);*/

		//Insert Queries
		$press_insert = DB::table('press')->insertGetId($pressData);
		
		
		if($press_insert) {
			$categories=$request->Categories;
		    $count=count($categories);
		    if($count > 0){
		    	foreach ($categories as $category) {
				echo "<pre>";
				
		    		$cat_array = array('press_id'=>$press_insert,
		    			'cat_id'=>$category,);
		    		$category_insert = DB::table('press_cat_link')->insertGetId($cat_array);
		    	}
		    }
			
		}





	Session::flash('success', 'New Press Post Created Successfully');
			return Redirect::to('press-posts');
	
	}
}

	public function editPressPost($id) {
		$press_id = $id;
		$users = DB::table('press_categories')
				->select('press_categories.id', 'press_categories.cat_name')
				->get();
	    
	    $presscategories=DB::table('press as p')
	    ->leftJoin('press_cat_link as pc','pc.press_id','=','p.press_id')
	    ->where('p.press_id','=',$press_id)
	    ->select('p.press_id as id','pc.cat_id')
	    ->groupBy('pc.cat_id')	    
	    ->get();


	    
	    $categories=DB::table('press')
				->select('press.press_title', 'press.source', 'press.press_desc', 'press.press_id as id')
				->where('press.press_id', $press_id)
				->first();
	
                /*print_r($users); exit;*/
		return view('admin.press.edit-press', compact('users','presscategories','categories'));
	}

	public function updatePressPost(Request $request) {
		//Validator
		$req=$request->all();


		
		$validator = Validator::make($request->all(), [
		  
                  'postTitle' => 'required',
                  'postSource' => 'required',
                  'postDesc' => 'required',
                  'postImage' => 'required'
                ]);
   
   if ($validator->fails()) {
        return Redirect::back()
        ->withErrors($validator)
        ->withInput()->send();

	} else {


		//Variables Declaration
		$postTitle = $request->input('postTitle');
		$postSource = $request->input('postSource');
		$postDesc = $request->input('postDesc');
		
		if(count($req)){


			$name = User::find(Auth::user()->id);
			if(isset($req['postImage'])){
				$file_name = str_random(10).'.'.$req['postImage']->getClientOriginalExtension();
				$source_image_path=public_path('profile_img');
				$thumb_image_path1=public_path('profile_img');
				$thumb_image_path2=public_path('profile_img/thumbs');
				$req['postImage']->move($source_image_path, $file_name);
				/*$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,150,150);
				$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,30,30);*/

			}
			else if(isset($req['is_removed'])){
				$file_name="";
			}
			else{
				$file_name=$name->avatar;
			}
}
		/*$category = $request->input('Categories');
		$implode_categories = implode(',', $category);*/
		

		
		//Array Declaration
		$pressData = array(
				'press_title' => $postTitle,
				'source' => $postSource,
				'press_desc' => $postDesc,
				'user_img' =>$file_name,
				'created_at' => date('y-m-d H:i:s')
			);


		

		$press_delete = DB::table('press_cat_link')
							->where('press_id', $press_id)
							->delete();

		//Update Queries
		$press_update = DB::table('press')
							->where('press_id', $press_id)
							->update($pressData);
		
		
		if($press_id) {
			$categories=$request->Categories;
		    $count=count($categories);
		    if($count > 0){
		    	foreach ($categories as $category) {
				echo "<pre>";
				
		    		$cat_array = array('press_id'=>$press_id,
		    			'cat_id'=>$category,);
		    		$category_insert = DB::table('press_cat_link')->insertGetId($cat_array);
		    	}
		    }
			
		}





	Session::flash('success', 'New Press Post Created Successfully');
			return Redirect::to('press-posts');
	
	}
}

	public function deletePressPost($id) {
		//Variable Declaration
		$pressid = $id;
		
		// Delete Query
		// echo $pressid;exit;

		
			$delete_press_id = DB::table('press')
								->where('press.press_id', $pressid)
								->leftjoin('press_cat_link', 'press.press_id', '=', 'press_cat_link.press_id')
								->delete();

			$delete_category_id = DB::table('press_categories')
								->where('press_categories.id', $pressid)
								->leftjoin('press_cat_link', 'press_categories.id', '=', 'press_cat_link.cat_id')
								->delete();


		Session::flash('success', 'Press is Deleted successfully');
		  return redirect('/press-posts');
                
	}

	public function pressPostList(Request $request) {
		$req = $request->all();
		

		$users = DB::table('press')
				->leftjoin('press_cat_link', 'press_cat_link.press_id', '=', 'press.press_id')
				->leftjoin('press_categories', 'press_categories.id', '=', 'press_cat_link.cat_id')
				->select('press.press_id as id', 'press.press_title', 'press.status', 'press.created_at', 'press.updated_at',DB::raw("group_concat(cc_press_categories.cat_name SEPARATOR ', ') as cat_name"),DB::Raw('DATE_FORMAT(cc_press.created_at,"%m/%d/%y %h:%i %p") as date_format'))
				->groupBy('press.press_id', 'press.press_title', 'press.created_at', 'press.updated_at')
				->get();
				
				
		

		 return Datatables::of($users)
            ->addColumn('actions', function ($usersdetails) {
                return '<a href="/admin/editpress/'.$usersdetails->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                       
                       <a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deletePress('.$usersdetails->id.');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i> </a>
                   ';
            })
            ->editColumn('status', function ($users) {
       $a = $users->status == 1?'checked':'';
       return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'.$users->id.'" onClick="changePublishStatus('.$users->id.','.$users->status.');">
                                   <div class="slider round"></div>
                               </label>';
     })

            ->make(true);
<<<<<<< HEAD
    }

//Search Functionality
    public function searchPress(Request $request) {

        $req = $request->all();
        $fromdate = $request->searchFromDate;
        if($fromdate!=""){
        $date_explode = explode('/', $fromdate);
        $month = $date_explode[0];
        $date = $date_explode[1];
        $year = $date_explode[2];
        $fulldate = $year.'-'.$month.'-'.$date;
        $fromdate_one=date($fulldate . ' 00:00:00', time());



        
        }
        $todate = $request->searchToDate;
        if($todate!=""){
        $date_explode_two = explode('/', $todate);
        $month_two = $date_explode_two[0];
        $date_two= $date_explode_two[1];
        $year_two = $date_explode_two[2];
        $fulldate_two = $year_two.'-'.$month_two.'-'.$date_two;
        $fromdate_two=date($fulldate_two . ' 00:00:00', time());

        }
      

        
        
        $users_list = DB::table('press')
                ->leftjoin('press_cat_link', 'press_cat_link.press_id', '=', 'press.press_id')
                ->leftjoin('press_categories', 'press_categories.id', '=', 'press_cat_link.cat_id')
                ->select('press.press_id as id', 'press.press_title', 'press.status','press.updated_at',DB::raw("group_concat(cc_press_categories.cat_name SEPARATOR ', ') as cat_name"),DB::Raw('DATE_FORMAT(cc_press.created_at,"%m/%d/%y %h:%i %p") as date_format'))
                ->groupBy('press.press_id', 'press.press_title','press.status', 'press.created_at', 'press.updated_at');

        
        if(($request->pressTitle) !="") {
            $users_list->where('press_title', 'LIKE', "%".$request->pressTitle."%");
        }

        
        if(($fromdate) != '' && ($todate)!='') {

            
                $dateS = new Carbon($fromdate_one);
                $dateE = new Carbon($fromdate_two);
                $users_list->whereBetween('press.created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"]);
                /*if($fromdate == $todate)
            {
                $users_list->where('press.created_at', $fromdate_one);
            }else
            {*/
                
                //dd($users_list);
                //$users_list->whereBetween('press.created_at', array($fromdate_one,$fromdate_two));
            //}

           
        } /*elseif (($fromdate) == ($todate)) {

            echo "aaaaaa";
            $users_list->where('press.created_at', array($fromdate_one,$fromdate_two));
        }*/

        
        

        $users = $users_list->get();
        
//Datatables
         return Datatables::of($users)
            ->addColumn('actions', function ($usersdetails) {
                return '<a href="/admin/editpress/'.$usersdetails->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                       
                       <a href="/admin/deletepress/'.$usersdetails->id.'"  class="btn btn-xs btn-danger delete_user" onClick="deletePress('.$usersdetails->id.');" ><i class="fa fa-trash-o"></i></a>
=======
	}

	public function searchPress(Request $request) {

		$req = $request->all();
		//print_r($req); exit;
	    $fromdate = $request->searchFromDate;
	    if($fromdate!=""){
	    $date_explode = explode('/', $fromdate);
		$month = $date_explode[0];
		$date = $date_explode[1];
		$year = $date_explode[2];
		$fulldate = $year.'-'.$month.'-'.$date;
		$fromdate_one=date($fulldate . ' 00:00:00', time());

		
	    }
	    $todate = $request->searchToDate;
	    if($todate!=""){
	    $date_explode_two = explode('/', $todate);
		$month_two = $date_explode_two[0];
		$date_two= $date_explode_two[1];
		$year_two = $date_explode_two[2];
		$fulldate_two = $year_two.'-'.$month_two.'-'.$date_two;
		$fromdate_two=date($fulldate_two . ' 00:00:00', time());

	    }
	  

		
		
		$users_list = DB::table('press')
				->leftjoin('press_cat_link', 'press_cat_link.press_id', '=', 'press.press_id')
				->leftjoin('press_categories', 'press_categories.id', '=', 'press_cat_link.cat_id')
				->select('press.press_id as id', 'press.press_title', 'press.status','press.updated_at',DB::raw("group_concat(cc_press_categories.cat_name SEPARATOR ', ') as cat_name"),DB::Raw('DATE_FORMAT(cc_press.created_at,"%m/%d/%y %h:%i %p") as date_format'))
				->groupBy('press.press_id', 'press.press_title','press.status', 'press.created_at', 'press.updated_at');

		
		if(($request->pressTitle) !="") {
			$users_list->where('press_title',$request->pressTitle);
		}

		if($request->searchCategory !="") {
			$users_list->where('press_cat_link.cat_id', $req['searchCategory']);
        }


		if(($fromdate) && ($todate)!="") {
           $users_list->whereBetween('press.created_at', array($fromdate_one,$fromdate_two));
       }

		// if(($request->searchFromDate) !="") {
			
		// 	$users_list->where('created_at', $fullDate);
		// }

		// if(($request->searchToDate) !="") {
		// 	$users_list->where('created_at',$request->searchToDate);
		// }

		
		

		$users = $users_list->get();
		//print_r($users); exit;


				/*->where('events.event_name', '=', $request->searchEvent)
				->where('events.from_date', '=', $request->searchFromDate)
				->where('events.to_date', '=', $request->searchToDate)
				->where('address_master.state', '=', $request->searchState)
				->get();*/

		 return Datatables::of($users)
            ->addColumn('actions', function ($usersdetails) {
                return '<a href="/admin/editpress/'.$usersdetails->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                       
                       <a href="/admin/deletepress/'.$usersdetails->id.'"  class="btn btn-xs btn-danger delete_user" onClick="deletePress('.$usersdetails->id.');" ><i class="fa fa-trash-o"></i> Delete</a>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                   ';
            })

            ->editColumn('status', function ($users) {
       $a = $users->status == 1?'checked':'';
       return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'.$users->id.'" onClick="changePublishStatus('.$users->id.','.$users->status.');">
                                   <div class="slider round"></div>
                               </label>';
     })


            ->make(true);
<<<<<<< HEAD
    }
//Status button Functionality
    public function industryStatus(Request $request) {
        
        $status = $request->input('status') == 1?0:1;
=======
	}

	public function industryStatus(Request $request) {
		
		$status = $request->input('status') == 1?0:1;
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        $id     = $request->input('id');

        $date = [date('y-m-d H:i:s')];

        $user = DB::table('press')->where('press_id', $id)->
        update(
<<<<<<< HEAD
            ['status' => trim($status)]

            );
        $user == 1?true:false;
        return $user;
    }
}
=======
        	['status' => trim($status)]

        	);
        $user == 1?true:false;
        return $user;
	}
}
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

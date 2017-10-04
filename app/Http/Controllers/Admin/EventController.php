<<<<<<< HEAD
<?php
=======
<?php 
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
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
class EventController extends Controller {
    public function __construct(Guard $auth) {
        
         $this->auth       = $auth;
        $this->sitehelper = new SiteHelper();
        $this->table      = 'press_releases';
 }


    public function eventsList() {
        $heading    = "Events List";
        $create     = "Add Event";
        $breadcrumb = "Events List";

        $states = DB::table('states')->select('*')->get();

        return view('admin.events.events-list', compact('states','heading','create','breadcrumb'));
    }

    public function EventsFetch() {
        $users = DB::table('events')
            ->leftjoin('users', 'events.created_by', '=', 'users.id')
            ->select('events.event_id as id', 'events.event_name', 'users.display_name','events.from_date','events.from_time', 'events.to_date','events.to_time', 'events.created_at', 'events.approved',DB::Raw('DATE_FORMAT(cc_events.created_at,"%m/%d/%y %h:%i %p") as date_format') )
            ->get();
        return Datatables::of($users)
            ->addColumn('actions', function ($usersdetails) {
                return
                    '<a href="/admin/editevent/'.$usersdetails->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
=======

class EventController extends Controller {
	

	public function eventsList() {
		$heading    = "Events List";
		$create     = "Add Event";
		$breadcrumb = "Events List";

		$states = DB::table('states')->select('*')->get();

return view('admin.events.events-list', compact('states','heading','create','breadcrumb'));
	}

	public function EventsFetch() {
		$users = DB::table('events')
				->leftjoin('users', 'events.created_by', '=', 'users.id')
				->select('events.event_id as id', 'events.event_name', 'users.display_name','events.from_time', 'events.to_time', 'events.created_at', 'events.approved',DB::Raw('DATE_FORMAT(cc_events.created_at,"%m/%d/%y %h:%i %p") as date_format') )
				->get();

				return Datatables::of($users)
            ->addColumn('actions', function ($usersdetails) {
                return 
                '<a href="/admin/editevent/'.$usersdetails->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                       
                        <a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deleteEvent('.$usersdetails->id.');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i> </a>
                   ';
            })

            ->editColumn('status', function ($users) {
<<<<<<< HEAD
                $a = $users->approved == 1?'checked':'';
                return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'.$users->id.'" onClick="changeStatus('.$users->id.','.$users->approved.');">
                                   <div class="slider round"></div>
                               </label>';
            })

            ->editColumn('from', function ($users) {
                $fromDate = date('m/d/y', strtotime($users->from_date));
                $fromTime = date('h:i:s A', strtotime($users->from_time));
                return $fromDate.' '.$fromTime;
            })

            ->editColumn('to', function ($users) {
                $toDate = date('m/d/y', strtotime($users->to_date));
                $toTime = date('h:i:s A', strtotime($users->to_time));
                return $toDate.' '.$toTime;
            })

            ->make(true);
    }

    public function addEvent(Request $request) {
        /*$userid=Auth::user()->id;
        echo $userid; exit;*/
        $states = DB::table('states')->select('*')->get();
        return view('admin.events.add-event', compact('states'));
    }

    public function insertEvents(Request $request) {

        $req = $request->all();
        $validator = Validator::make($request->all(), [

            'eventname' => 'required|min:5|max:255',
            'eventurl' => 'required',
            'fromdate' => 'required',
            'todate' => 'required',
            'fromtime' => 'required',
            'totime' => 'required',
            'eventDesc' => 'required|min:5|max:350',
            'location' => 'required',
            'event_image'=>'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput()->send();

        } else {
             if(count($req)){
                $name = User::find(Auth::user()->id);
                if(isset($req['event_image'])){
                    $image = Imageresize::eventInsert($req['event_image']);
                    $file_name = $image;
                }
            }
           
            //From date database conversion
            $fromDate = $request->input('fromdate');
            $explode = explode('/', $fromDate);
            $month = $explode[0];
            $date = $explode[1];
            $year = $explode[2];
            $fullFromDate = $year.'-'.$month.'-'.$date;
            //To date database conversion
            $toDate = $request->input('todate');
            $explode = explode('/', $toDate);
            $month = $explode[0];
            $date = $explode[1];
            $year = $explode[2];
            $fullToDate = $year.'-'.$month.'-'.$date;

            $fromTime = $request->input('fromtime');
            $toDate = $request->input('todate');
            $toTime = $request->input('totime');
            $eventDesc = $request->input('eventDesc');
            $locationName = $request->input('location');
            $address1 = $request->input('address1');
            $address2 = $request->input('address2');
            $city = $request->input('city');
            $state = $request->input('state');
            $zipcode = $request->input('zipcode');
            $eventname=$request->input('eventname');
            $eventurl=$request->input('eventurl');



            $addressData = array(
                'location_name' => $locationName,
                'address1' => $address1,
                'address2' => $address2,
                'city' => $city,
                'state' => $state,
                'zip_code' => $zipcode,
                'address_type' => "events"
            );

            $addressinsert=DB::table('address_master')->insertGetId($addressData);
            if($addressinsert){
                $eventData = array(
                    'event_name' => $eventname,
                    'event_url' => $eventurl,
                    'user_img' =>$file_name,
                    'from_date' => $fullFromDate,
                    'from_time' => $fromTime,
                    'to_date' => $fullToDate,
                    'to_time' => $toTime,
                    'event_desc' => $eventDesc,
                    'approved' => Auth::user()->id,
                    'created_at' => date('y-m-d H:i:s'),
                    'address_id' => $addressinsert,
                    'created_by' => Auth::user()->id,
                );
                $lastEventId = DB::table('events')->insertGetId($eventData);

            }else {
                Session::flash('error', 'Address Insertion Failed');
            }

            Session::flash('success', 'Event created successfully');
            return Redirect::to('events-list');

        }
    }

    public function editEvent($id) {
        $eventid=$id;
        $states = DB::table('states')->select('*')->get();
        $users = DB::table('events')
            ->leftjoin('address_master', 'events.address_id', '=', 'address_master.address_id')
            ->select('events.event_id as id', 'events.event_name', 'events.user_img as user_img','events.event_url', 'events.from_date', 'events.from_time', 'events.to_date', 'events.to_time', 'events.event_desc',  'events.created_at', 'events.approved', 'address_master.address1', 'address_master.address2', 'address_master.city', 'address_master.state', 'address_master.zip_code','address_master.location_name')
            ->where('events.event_id', $eventid)
            ->first();
        return view('admin.events.editevents',compact('states','users'));
    }

    public function updateEvent(Request $request) {

        $req=$request->all();

        $rule  = array(
            'eventName' => 'required|min:5|max:255',
            'eventUrl' => 'required',
            'fromDate' => 'required',
            'toDate' => 'required',
            'fromTime' => 'required',
            'toTime' => 'required',
            'eventDesc' => 'required|min:5|max:350',
            'location' => 'required',
        );

        $validator = Validator::make($req,$rule);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }
        else
        {

           

            if(count($req)){
                if (!empty($req['event_image'])) {

                    $profile_img = $req['event_image'];
                    $oldimage    = $req['img_removed'];
                    $file_name   = str_random(10).'.'.$req['event_image']->getClientOriginalExtension();
                    $source_image_path=public_path('event_images');
                    $thumb_image_path1=public_path('event_images');
                    $thumb_image_path2=public_path('event_images/thumbs');
                    $req['event_image']->move($source_image_path, $file_name);
                    $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name, $thumb_image_path1.'/'.$file_name, 160, 160);
                    $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name, $thumb_image_path2.'/'.$file_name, 30, 30);
                    $image      = array('user_img' => $file_name);
                    $whereimage = array('event_id' => $req['eventid']);
                    $user_metaq = Site_model::update_data('events', $image, $whereimage);
                }
                else if(isset($req['is_removed'])){ 
                    $pressimage=DB::table('events')->select('user_img as image')->
                    where('event_id',$req['event_id'])->first();
                    $file_name=$pressimage->image;
                }else {

                    /*****updating image code starts here***/
                    /****From date and to date updating code starts here**/
                       $from_Date = $request->fromDate;
                        $explode = explode('/', $from_Date);
                        $month = $explode[0];
                        $date = $explode[1];
                        $year = $explode[2];
                        $full_FromDate = $year.'-'.$month.'-'.$date;
                    /******to date updating code starts here***/
                       $from_Time = $request->fromTime;
                        $to_Date = $request->toDate;
                        $explode = explode('/', $to_Date);
                        $month = $explode[0];
                        $date = $explode[1];
                        $year = $explode[2];
                        $full_ToDate = $year.'-'.$month.'-'.$date;
                        /*****data regarding request***/
                        $event_Name = $request->eventName;
                        $event_Url = $request->eventUrl;
                        $to_Time = $request->toTime;
                        $event_Desc = $request->eventDesc;
                        $location = $request->location;
                        $address1 = $request->address1;
                        $address2 = $request->address2;
                        $city = $request->city;
                        $state = $request->state;
                        $zip_Code = $request->zipcode;
                        $event_id=$request->eventid;
                        $event_array = array(
                'event_name'=>$event_Name,
                'event_url'=>$event_Url,
                'from_date' => $full_FromDate,
                'from_time' => $from_Time,
                'to_date' => $full_ToDate,
                'to_time' => $to_Time,
                'event_desc' => $event_Desc,
                'updated_at'=>date('y-m-d H:i:s'),
            );
             $condition = array('event_id' => $event_id);
             $update_event = Site_model::update_data('events', $event_array, $condition);   
             if($update_event)  {
                $get_address_id = DB::table('events')
                ->where('event_id',$event_id)
                ->first();
                $address_id = $get_address_id->address_id;
                 $address_array = array(
                 'location_name' => $location,
                'address1' => $address1,
                'address2' => $address2,
                'city' => $city,
                'state' => $state,
                'zip_code' => $zip_Code,
                'created_on'=>date('y-m-d H:i:s'),
            );

            $update_address = DB::table('address_master')
                ->where('address_id',$address_id)
                ->update($address_array);
             }    

        }
            
             
    }
      Session::flash('success', 'Event   Updated Successfully');
        return Redirect::to('events-list');  

}
    }

    public function deleteEvent($id) {
        //Variable Declaration
        $eventid = $id;

        // $event_id = $request->eventid;



        $get_address_id = DB::table('events')
            ->where('event_id', '=', $eventid)
            ->first();

        $address_id = $get_address_id->address_id;


        //echo "<pre>";print_r($address_id);die;

        //delete query
        $delete_events = DB::table('events')
            ->where('event_id', '=', $eventid)
            ->delete();
        //Address Data Deleting Code starts here
        $delete_id = DB::table('address_master')
            ->where('address_id', '=', $address_id)
            ->delete();

        Session::flash('success', 'Event is Deleted successfully');
        return Redirect::to('events-list');
    }


    public function searchEvent(Request $request) {

        $req = $request->all();
        
        $fromdate = $request->fromDate;
        if($fromdate!=""){
            $date_explode = explode('/', $fromdate);
            $month = $date_explode[0];
            $date = $date_explode[1];
            $year = $date_explode[2];
            $fulldate = $year.'-'.$month.'-'.$date;
            $fromdate_one=date($fulldate . ' 00:00:00', time());


        }
        $todate = $request->toDate;
        if($todate!=""){
            $date_explode_two = explode('/', $todate);
            $month_two = $date_explode_two[0];
            $date_two= $date_explode_two[1];
            $year_two = $date_explode_two[2];
            $fulldate_two = $year_two.'-'.$month_two.'-'.$date_two;
            $fromdate_two=date($fulldate_two . ' 00:00:00', time());

        }


        $users_list = DB::table('events')
            ->leftjoin('users', 'events.created_by', '=', 'users.id')
            ->leftjoin('address_master', 'events.address_id', '=', 'address_master.address_id')
            ->select('events.event_id as id', 'events.event_name', 'users.display_name','events.from_time', 'events.to_time', DB::Raw('DATE_FORMAT(cc_events.created_at,"%m/%d/%y %h:%i %p") as date_format'), 'events.approved');


        if($request->eventName !="") {
            $users_list->where('events.event_name', 'LIKE', "%".$request->eventName."%");
        }


        if(($fromdate) != '' && ($todate)!='') {
            $dateS = new Carbon($fromdate_one);
            $dateE = new Carbon($fromdate_two);
            $users_list->whereBetween('events.created_at', [$dateS->format('Y-m-d') . " 00:00:00", $dateE->format('Y-m-d') . " 23:59:59"]);
        }
        if($request->city !="") {
            $users_list->where('address_master.city', 'LIKE', "%".$request->city."%");
        }
            $users = $users_list->get();
            return Datatables::of($users)
                ->addColumn('actions', function ($usersdetails) {
                    return '<a href="/admin/editevent/'.$usersdetails->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                       
                       <a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deleteEvent('.$usersdetails->id.');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i> </a>
                   ';
                })
                ->editColumn('status', function ($users) {
                    $a = $users->approved == 1?'checked':'';
                    return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'.$users->id.'" onClick="changeStatus('.$users->id.','.$users->approved.');">
                                   <div class="slider round"></div>
                               </label>';
                })



                ->make(true);

        
    


    }

    public function industryStatus(Request $request) {

        $status = $request->input('status') == 1?0:1;
=======
       $a = $users->approved == 1?'checked':'';
       return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'.$users->id.'" onClick="changeStatus('.$users->id.','.$users->approved.');">
                                   <div class="slider round"></div>
                               </label>';
     })
            
            ->make(true);
	}

	public function addEvent(Request $request) {
		/*$userid=Auth::user()->id;
		echo $userid; exit;*/

		
		$users = DB::table('states')->select('*')->get();

		
		return view('admin.events.add-event', compact('users'));

	}

	public function insertEvents(Request $request) {

		
		$req = $request->all();
		$validator = Validator::make($request->all(), [
		  
                  'eventName' => 'required',
                  'eventUrl' => 'required',
                  'fromDate' => 'required',
                  'toDate' => 'required',
                  'fromTime' => 'required',
                  'toTime' => 'required',
                  'eventDesc' => 'required',
                  'eventTags' => 'required',
                  'location' => 'required'
                ]);
   
   if ($validator->fails()) {
        return Redirect::back()
        ->withErrors($validator)
        ->withInput()->send();

	} else {



		$eventName = $request->input('eventName');
		$eventUrl = $request->input('eventUrl');
		
		if(count($req)){
			$name = User::find(Auth::user()->id);
			if(isset($req['eventImage'])){
				$file_name = str_random(10).'.'.$req['eventImage']->getClientOriginalExtension();
				$source_image_path=public_path('profile_img');
				$thumb_image_path1=public_path('profile_img');
				$thumb_image_path2=public_path('profile_img/thumbs');
				$req['eventImage']->move($source_image_path, $file_name);
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

		$fromDate = $request->input('fromDate');
		$explode = explode('/', $fromDate);
		$month = $explode[0];
		$date = $explode[1];
		$year = $explode[2];
		$fullFromDate = $year.'-'.$month.'-'.$date;

		$toDate = $request->input('toDate');
		$explode = explode('/', $toDate);
		$month = $explode[0];
		$date = $explode[1];
		$year = $explode[2];
		$fullToDate = $year.'-'.$month.'-'.$date;

		$fromTime = $request->input('fromTime');
		$toDate = $request->input('toDate');
		$toTime = $request->input('toTime');
		$eventDesc = $request->input('eventDesc');
		$eventTags = $request->input('eventTags');
		$locationName = $request->input('location');
		$address1 = $request->input('address1');
		$address2 = $request->input('address2');
		$city = $request->input('city');
		$state = $request->input('state');
		$zipcode = $request->input('zipcode');

		

		$addressData = array(
				'location_name' => $locationName,
				'address1' => $address1,
				'address2' => $address2,
				'city' => $city,
				'state' => $state,
				'zip_code' => $zipcode
			);



		$addressinsert=DB::table('address_master')->insertGetId($addressData);
		if($addressinsert){
			


		$eventData = array(
			'event_name' => $eventName,
			'event_url' => $eventUrl,
			'user_img' =>$file_name,
			'from_date' => $fullFromDate,
			'from_time' => $fromTime,
			'to_date' => $fullToDate,
			'to_time' => $toTime,
			'event_desc' => $eventDesc,
			'event_tags' => $eventTags,
			'created_at' => date('y-m-d H:i:s'),
			'address_id' => $addressinsert,
			'created_by' => Auth::user()->id,
			);



		DB::table('events')->insert($eventData);



		}
	Session::flash('success', 'Event is created successfully');
                  return Redirect::to('events-list');
	



	}
}

	public function editEvent($id) {
		$eventid = $id;
		$states = DB::table('states')->select('*')->get();
		$users = DB::table('events')
				->leftjoin('address_master', 'events.address_id', '=', 'address_master.address_id')
				->select('events.event_id as id', 'events.event_name', 'events.event_url', 'events.from_date', 'events.from_time', 'events.to_date', 'events.to_time', 'events.event_desc', 'events.event_tags',  'events.created_at', 'events.approved', 'address_master.address1', 'address_master.address2', 'address_master.city', 'address_master.state', 'address_master.zip_code' )
				->where('events.event_id', $eventid)
				->first();
			//	print_r($users); exit;
				


				
		
		return view('admin.events.editevents',compact('states','users'));
	}
	
	public function updateEvent(Request $request) {

		$req=$request->all();
		//validator rule
		$rule  = array( 
				  'eventName' => 'required',
                  'eventUrl' => 'required',
                  'fromDate' => 'required',
                  'toDate' => 'required',
                  'fromTime' => 'required',
                  'toTime' => 'required',
                  'eventDesc' => 'required',
                  'eventTags' => 'required',
                  'location' => 'required'
                         );

         $validator = Validator::make($req,$rule);
         if ($validator->fails())
            {
               return Redirect::back()->withErrors($validator->messages())->withInput();
            }
         else
            { 
        // print_r($validator);exit;

        //variables declaration
		$event_Name = $request->eventName;
        $event_Url = $request->eventUrl;
        $from_Date = $request->fromDate;
		$explode = explode('/', $from_Date);
		$month = $explode[0];
		$date = $explode[1];
		$year = $explode[2];
		$full_FromDate = $year.'-'.$month.'-'.$date;
		$from_Time = $request->fromTime;
	    $to_Date = $request->toDate;
		$explode = explode('/', $to_Date);
		$month = $explode[0];
		$date = $explode[1];
		$year = $explode[2];
		$full_ToDate = $year.'-'.$month.'-'.$date;
		$to_Time = $request->toTime;
        $event_Desc = $request->eventDesc;
        $event_Tags = $request->eventTags;
        $address1 = $request->address1;
        $address2 = $request->address2;
        $city = $request->city;
        $state = $request->state;
        $zip_Code = $request->zipcode;
        $event_id=$request->eventid;
// echo $event_id;exit;

       //Event data updating code starts here
       $event_array = array(
       		'event_name'=>$event_Name,
       		'event_url'=>$event_Url,
       		'from_date' => $full_FromDate,
       		'from_time' => $from_Time,
       		'to_date' => $full_ToDate,
       		'to_time' => $to_Time,
       		'event_desc' => $event_Desc,
       		'event_tags' => $event_Tags
       		
       	); 

       //update the event array
       $eventdata=DB::table('events')->where('event_id',$event_id)->update($event_array);
      //if($eventdata){
      	$get_address_id = DB::table('events')
      							->where('event_id',$event_id)
      							->first();

      	$address_id = $get_address_id->address_id;
       //echo $address_id;die;

       //}
       //Address data updating code starts here
       $address_array = array(
       		'address1' => $address1,
       		'address2' => $address2,
       		'city' => $city,
       		'state' => $state,
       		'zip_code' => $zip_Code
       	);

       $update_address_id = DB::table('address_master')
       							->where('address_id',$address_id)
       							->update($address_array);

       	


    }
    	Session::flash('success', 'Event is Updated Successfully');
                  return Redirect::to('events-list');
		
	}

	public function deleteEvent($id) {
		//Variable Declaration
		$eventid = $id;
		
		// $event_id = $request->eventid;
		

		
			$get_address_id = DB::table('events')
								->where('event_id', '=', $eventid)
								->first();

			$address_id = $get_address_id->address_id;		
			
		
		//echo "<pre>";print_r($address_id);die;

		//delete query
		$delete_events = DB::table('events')
							->where('event_id', '=', $eventid)
							->delete();
		//Address Data Deleting Code starts here
		$delete_id = DB::table('address_master')
						->where('address_id', '=', $address_id)
						->delete();

		Session::flash('success', 'Event is Deleted successfully');
                  return Redirect::to('events-list');
	}


	public function searchEvent(Request $request) {
		$req = $request->all();
		/*echo "<pre>";
		print_r($request->all());
		die;*/
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


		$users_list = DB::table('events')
				->leftjoin('users', 'events.created_by', '=', 'users.id')
				->leftjoin('address_master', 'events.address_id', '=', 'address_master.address_id')
				->select('events.event_id as id', 'events.event_name', 'users.display_name','events.from_time', 'events.to_time', DB::Raw('DATE_FORMAT(cc_events.created_at,"%m/%d/%y %h:%i %p") as date_format'), 'events.approved');
		

		if($request->searchEventName !="") {
			$users_list->where('events.event_name', '=', $request->searchEventName);
		}

		if(($fromdate) && ($todate)!="") {
           $users_list->whereBetween('events.created_at', array($fromdate_one,$fromdate_two));
       }

		/*if($request->searchFromDate !="") {
		
		$from_Date = $request->searchFromDate;
		$explode = explode('/', $from_Date);
		$month = $explode[0];
		$date = $explode[1];
		$year = $explode[2];
		$full_FromDate = $year.'-'.$month.'-'.$date;

			$users_list->where('events.from_date', '=', $full_FromDate);
		
		}*/

		/*if($request->searchToDate !="") {

		$to_Date = $request->searchToDate;
		$explode = explode('/', $to_Date);
		$month = $explode[0];
		$date = $explode[1];
		$year = $explode[2];
		$full_ToDate = $year.'-'.$month.'-'.$date;

			$users_list->where('events.to_date', '=', $full_ToDate);
		
		}*/

if($request->searchCity !="") {
			$users_list->where('address_master.city', '=', $request->searchCity);
}

		/*if($request->searchState !="") {
			$users_list->where('address_master.state', '=', $request->searchState);
		}*/

		$users = $users_list->get();


				/*->where('events.event_name', '=', $request->searchEvent)
				->where('events.from_date', '=', $request->searchFromDate)
				->where('events.to_date', '=', $request->searchToDate)
				->where('address_master.state', '=', $request->searchState)
				->get();*/

		 return Datatables::of($users)
            ->addColumn('actions', function ($usersdetails) {
                return '<a href="/admin/editevent/'.$usersdetails->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                       
                       <a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deleteEvent('.$usersdetails->id.');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i> </a>
                   ';
            })
            ->editColumn('status', function ($users) {
       $a = $users->approved == 1?'checked':'';
       return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'.$users->id.'" onClick="changeStatus('.$users->id.','.$users->approved.');">
                                   <div class="slider round"></div>
                               </label>';
     })



            ->make(true);
	}

	public function updateStatus(Request $request) {
		$event_tags = DB::table('event_tags')
		->where('event_tags','LIKE','%'.$request->text.'%')
							->get();
							//echo "<pre>";print_r($event_tags);die;
		return Response::JSON($event_tags);
	}

	public function industryStatus(Request $request) {
		
		$status = $request->input('status') == 1?0:1;
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        $id     = $request->input('id');

        $date = [date('y-m-d H:i:s')];

        $user = DB::table('events')->where('event_id', $id)->
        update(
<<<<<<< HEAD
            ['approved' => trim($status)]

        );
        $user == 1?true:false;
        return $user;
    }

}
=======
        	['approved' => trim($status)]

        	);
        $user == 1?true:false;
        return $user;
	}
	
}
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

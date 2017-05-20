<?php 
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
use Hash;
use Response;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Validator;

class EventController extends Controller {
	

	public function eventsList() {
		$heading    = "Events List";
		$create     = "Create Event";
		$breadcrumb = "Events List";

		$users = DB::table('states')->select('*')->get();

return view('admin.events.events-list', compact('users','heading','create','breadcrumb'));
	}

	public function EventsFetch() {
		$users = DB::table('events')
				->leftjoin('users', 'events.created_by', '=', 'users.id')
				->select('events.event_id as id', 'events.event_name', 'users.display_name','events.from_time', 'events.to_time', 'events.created_at', 'events.approved' )
				->get();

		 return Datatables::of($users)
            ->addColumn('actions', function ($usersdetails) {
                return '<a href="/admin/editevent/'.$usersdetails->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                       
                       <a href="/admin/deleteevent/'.$usersdetails->id.'"  class="btn btn-xs btn-danger delete_user" onClick="deleteCareers('.$usersdetails->id.');" ><i class="fa fa-trash-o"></i> Delete</a>
                   ';
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

		
		/*$req = $request->all();
		print_r($req);exit;*/
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
		$eventid=$id;
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
		$rule  = array( 'eventName' => 'required|max:50',
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
		print_r($req);
		die;*/
		$users_list = DB::table('events')
				->leftjoin('users', 'events.created_by', '=', 'users.id')
				->leftjoin('address_master', 'events.address_id', '=', 'address_master.address_id')
				->select('events.event_id as id', 'events.event_name', 'users.display_name','events.from_time', 'events.to_time', 'events.created_at', 'events.approved');
		

		if($request->searchEventName !="") {
			$users_list->where('events.event_name', '=', $request->searchEventName);
		}

		if($request->searchFromDate !="") {
		
		$from_Date = $request->searchFromDate;
		$explode = explode('/', $from_Date);
		$month = $explode[0];
		$date = $explode[1];
		$year = $explode[2];
		$full_FromDate = $year.'-'.$month.'-'.$date;

			$users_list->where('events.from_date', '=', $full_FromDate);
		
		}

		if($request->searchToDate !="") {

		$to_Date = $request->searchToDate;
		$explode = explode('/', $to_Date);
		$month = $explode[0];
		$date = $explode[1];
		$year = $explode[2];
		$full_ToDate = $year.'-'.$month.'-'.$date;

			$users_list->where('events.to_date', '=', $full_ToDate);
		
		}

		if($request->searchState !="") {
			$users_list->where('address_master.state', '=', $request->searchState);
		}

		$users = $users_list->get();


				/*->where('events.event_name', '=', $request->searchEvent)
				->where('events.from_date', '=', $request->searchFromDate)
				->where('events.to_date', '=', $request->searchToDate)
				->where('address_master.state', '=', $request->searchState)
				->get();*/

		 return Datatables::of($users)
            ->addColumn('actions', function ($usersdetails) {
                return '<a href="/admin/editevent/'.$usersdetails->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                       
                       <a href="/admin/deleteevent/'.$usersdetails->id.'"  class="btn btn-xs btn-danger delete_user" onClick="deleteCareers('.$usersdetails->id.');" ><i class="fa fa-trash-o"></i> Delete</a>
                   ';
            })



            ->make(true);
	}
	
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
use Validator;
use App\User;
use Mail;
use Meta;
class EventsController extends Controller
{

    public function __construct(Guard $auth)
    {
        $this->sitehelper = new SiteHelper();
        Meta::title('Chrysalis');
        Meta::set('robots', 'index,follow');
    }

    public function index(Request $request){
        Meta::set('title', 'Events');
        Meta::set('description', 'Latest happenings around Costumes and Comic World');

        $userData = null;
        $userId = null;
        $userName = null;
        $userEmail = null;
        if(Auth::check()){
            $userData = User::find(Auth::user()->id)->toArray();
            $userId = $userData['id'];
            $userName = $userData['display_name'];
            $userEmail = $userData['email'];
        }
        $events = DB::table('events')
            ->leftJoin('address_master','address_master.address_id','=','events.address_id')
            ->leftjoin('users', 'events.created_by', '=', 'users.id')
            ->where('events.approved',1)
            ->select('events.event_name', 'users.display_name','events.from_time', 'events.to_time','events.from_date','events.to_date','events.user_img','address_master.location_name','events.event_url','events.event_desc','events.created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        return view('frontend.events.index')->with(array('events'=>$events,'userName'=>$userName,'userEmail'=>$userEmail,'userId'=>$userId));
    }

    public function store(Request $request, $userId){
        $req=$request->all();
        $validator = Validator::make($request->all(), [

            'event_name' => 'required|min:5|max:255',
            'event_url' => 'required',
            'from_date' => 'required',
            'from_time' => 'required',
            'to_date' => 'required',
            'to_time' => 'required',
            'location' => 'required',
            'event_desc' => 'required|min:5',
            'user_email' => 'required|email|max:160'
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput()->send();

        } else {

            $eventName = $request->input('event_name');
            $eventUrl = $request->input('event_url');

            $from = $request->input('from_date');
            $explode = explode('-', $from);
            $fromMonth = $explode[0];
            $fromDate = $explode[1];
            $fromYear = $explode[2];
            $fullFromDate = $fromYear.'-'.$fromMonth.'-'.$fromDate;

            $to = $request->input('to_date');
            $explode = explode('-', $to);
            $toMonth = $explode[0];
            $toDate = $explode[1];
            $toYear = $explode[2];
            $fullToDate = $toYear.'-'.$toMonth.'-'.$toDate;

            $eventDesc = $request->input('event_desc');
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
                'zip_code' => $zipcode,
                'address_type' => "events"
            );

            $addressId =DB::table('address_master')->insertGetId($addressData);

            if($addressId){
                $eventData = array(
                    'event_name' => $eventName,
                    'event_url' => $eventUrl,
                    'from_date' => $fullFromDate,
                    'from_time' => $request->input('from_time'),
                    'to_date' => $fullToDate,
                    'to_time' => $request->input('to_time'),
                    'event_desc' => $eventDesc,
                    'address_id' => $addressId,
                    'created_at' => date('y-m-d H:i:s'),
                    'created_by' => $userId,
                );

                $saveEvent = DB::table('events')->insertGetId($eventData);

            }

            // send mail
            $reg_subject        = "Event Created";
            $reg_data           = array('name'=>Auth::user()->display_name,'eventName'=>$eventName);
            $template           = 'emails.createevent';
            //---- send mail
            $reg_to             = Auth::user()->email;
            $mail_status        = $this->sitehelper->sendEmail($reg_to,$reg_subject,$template,$reg_data);
            // end mail

            Session::flash('success', 'Your event listing has been successfully submitted. It will be listed, once it is approved by admin.');
            return Redirect::to('events');

        }

        Session::flash('error', 'The event could not be saved. Pls try again.');
        return Redirect::to('events');
    }

    public function searchByZip(Request $request){
        $zipCode = $_GET['zip'];
        $eventsByZip = DB::table('events')
            ->leftjoin('address_master', 'events.address_id', '=', 'address_master.address_id')
            ->leftjoin('users', 'events.created_by', '=', 'users.id')
            ->where(array('events.approved'=>1,'address_master.zip_code'=>$zipCode))
            ->select('events.event_name', 'users.display_name','events.from_time', 'events.to_time','events.from_date','events.to_date','events.user_img','address_master.location_name','events.event_url','events.event_desc','events.created_at')
            ->orderBy('events.created_at', 'desc')
            ->get();
        return view('frontend.events.search_by_zip')->with('eventsByZip',$eventsByZip);
    }
}

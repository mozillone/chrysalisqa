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
use App\Helpers\Site_model;
use Validator;

class JobController extends Controller
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
	public function jobsList(){
	   /*****Costumes View Page***/
      
	    $title=Auth::user()->display_name." Support List";
      $heading="Jobs List";
      $create=" + Add Job Post";
      return view('admin.jobs.manage-jobs',compact('title','heading','create'));
	}
  /*****Add JObs Code Starts Here***/
  public function createJob(){
    return view('admin.jobs.add-job-post',compact('title','heading','create'));
  }
  /****Insert jobs code starts here***/
  public function insertJob(Request $request){
    $req = $request->all();
  

    if (count($req)) {
      $rule = array(
        'jobcode'  => 'required',
        'jobtitle'    =>'required',
        'postDesc'  =>'required',
       );
      
      $validator = Validator::make($req, $rule);

      if ($validator          ->fails()) {
        return Redirect::back()->withErrors($validator->messages())->withInput();
      } else {

        $data = array(
          'job_code'       => $req['jobcode'],
          'job_title'      => $req['jobtitle'],
          'job_description'=> $req['postDesc'],
          'job_createddate' => date('Y-m-d H:i:s'),
          'job_createdby'=>Auth::user()->id,
         
        );
        $user_meta = Site_model::insert_data('jobs', $data);
        Session::flash('success', 'Job Posted Successfully');
        return Redirect::to('/jobs-list');

      }
    }
    Session::flash('fail', 'Unable To Post a JOb.');
    return view('admin.jobs.add-job-post');

  }
  /*****update job code starts here***/
  public function updateJob(Request $request){
   $req = $request->all();
  
   if (count($req)) {
      $rule = array(
        'jobcode'  => 'required',
        'jobtitle'    =>'required',
        'postDesc'  =>'required',
       );
      
      $validator = Validator::make($req, $rule);

      if ($validator          ->fails()) {
        return Redirect::back()->withErrors($validator->messages())->withInput();
      } else {

        $data = array(
          'job_code'       => $req['jobcode'],
          'job_title'      => $req['jobtitle'],
          'job_description'=> $req['postDesc'],
          'job_updateddate' => date('Y-m-d H:i:s'),
          'job_createdby'=>Auth::user()->id,
         
        );
        $condition = array('job_id' => $req['job_id']);
        $user_meta = Site_model::update_data('jobs', $data, $condition);
        Session::flash('success', 'Job Updated Successfully');
        return Redirect::to('/jobs-list');

      }
    }
    Session::flash('fail', 'Unable To Update a JOb.');
    return view('admin.jobs.update-job-post');

  }
  /*****Get JObs Code starts here***/
  public function getJobs(){
    $jobs = DB::table('jobs')->select('job_id as id','job_code as code','job_title as title',
      'job_description as desc','job_status as job_status',DB::Raw('DATE_FORMAT(cc_jobs.job_createddate,"%m/%d/%y %h:%i %p") as createdate'))->get();
    return Datatables::of($jobs)
      ->addColumn('actions', function ($jobs_list) {
        return '<a href="/jobs_list/edit/'.$jobs_list->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i> </a>
                        <a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deleteJob('.$jobs_list->id.');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i> </a>
                    ';

      })
      ->editColumn('status', function ($jobs_list) {
        $a = $jobs_list->job_status == 1?'checked':'';
        return '<label class="switch">
                                    <input type="checkbox" '.$a.' class="status" id="'.$jobs_list->id.'" onClick="changeStatus('.$jobs_list->id.','.$jobs_list->job_status.');">
                                    <div class="slider round"></div>
                                </label>';
      })

      ->make(true);
  }
  /***Edit Jobs code starts here***/
  public function editJobs($id){
    $jobs=DB::table('jobs')->where('job_id','=',$id)->first();
     return view('admin.jobs.edit-job-post',compact('title','heading','create','jobs'));
  }
  /****Delete jobs code starts here***/
  public function deleteJob($id) {

    $condition = array('job_id' => $id);
    $delete    = Site_model::delete_single('jobs', $condition);
    if ($delete) {
      Session::flash('success', 'Job Deleted Successfully.');
    } else {
      Session::flash('fail', 'Unable To delete Job');
    }

    return redirect('/jobs-list');
  }
  /****Status change code starts here***/
   public function jobStatus(Request $request) {
        
        $status = $request->input('status') == 1?0:1;
        $id     = $request->input('id');

        $date = [date('y-m-d H:i:s')];

        $user = DB::table('jobs')->where('job_id', $id)->
        update(
            ['job_status' => trim($status)]

            );
        $user == 1?true:false;
        return $user;
    }
    /****Search job code starts here****/
    public function searchJObs(Request $request){
      $req=$request->all();
      $jobslist= DB::table('jobs')->select('job_id as id','job_code as code','job_title as title',
      'job_description as desc','job_status as job_status',DB::Raw('DATE_FORMAT(cc_jobs.job_createddate,"%m/%d/%y %h:%i %p") as createdate'));
         if(($request->jobcode) !="") {
            $jobslist->where('job_code', 'LIKE', "%".$request->jobcode."%");
        }
         if(($request->jobtitle) !="") {
            $jobslist->where('job_title', 'LIKE', "%".$request->jobtitle."%");
        }
        if(($request->fromdate) !="" &&  ($request->todate)=='') {
          $timestamp =str_replace('/', '-', $request->fromdate);
          $fdate = date("Y-d-m", strtotime($timestamp));
          $jobslist->where(DB::raw('DATE(job_createddate)'), $fdate);
         }
         if(($request->fromdate) !="" &&  ($request->todate)!="") {

          $timestamp =str_replace('/', '-', $request->fromdate);
          $fdate = date("Y-d-m", strtotime($timestamp));
           list($m,$d,$y) = explode("/",$req['todate']);
        $timestamp = mktime(0,0,0,$m,$d,$y);
        $to_date = date("Y-m-d",$timestamp);
          
          $jobslist->whereBetween(DB::raw('DATE(job_createddate)'), array($fdate,$to_date));
         }
         if(($request->status) !="") {
          $jobslist->where('job_status',$request->status);
        }


         
         
        $jobs=$jobslist->get();

    return Datatables::of($jobs)
      ->addColumn('actions', function ($jobs_list) {
        return '<a href="/jobs_list/edit/'.$jobs_list->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i> </a>
                        <a href="javascript:void(0);"  class="btn btn-xs btn-danger delete_user" onClick="deleteJob('.$jobs_list->id.');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i> </a>
                    ';

      })
      ->editColumn('status', function ($jobs_list) {
        $a = $jobs_list->job_status == 1?'checked':'';
        return '<label class="switch">
                                    <input type="checkbox" '.$a.' class="status" id="'.$jobs_list->id.'" onClick="changeStatus('.$jobs_list->id.','.$jobs_list->job_status.');">
                                    <div class="slider round"></div>
                                </label>';
      })

      ->make(true);

    }

	

    
}



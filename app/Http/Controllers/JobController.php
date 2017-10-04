<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use App\Costumes;
use App\Helpers\Site_model;
use App\Category;
use Session;
use Hash;
use DB;
use Response;
use Mail;
use File;
use Meta;

class JobController extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	  public function __construct(Guard $auth) {
        
         $this->auth       = $auth;
        $this->sitehelper = new SiteHelper();
        $this->table      = 'press_releases';

          Meta::title('Chrysalis');
          Meta::set('robots', 'index,follow');
 }
	/******Support contact page code starts here****/
	public function jobsList(){
        Meta::set('title', 'Jobs');
        Meta::set('description', 'Jobs');
		$jobs=DB::table('jobs')->select('*')->where('job_status','=',1)->orderby('job_id','DESC')->where('job_status',1)->get();
		$job_mainid=DB::table('jobs')->select('job_id as jobid')->where('job_status','=',1)->orderby('job_id','DESC')->where('job_status',1)->limit(1)->first();
		$job_id=$job_mainid->jobid;
		$pageData = DB::table('cms_blocks')->where('cms_blocks.slug','=','jobs')->first();
		if(count($pageData)){
		 return view('frontend.jobs.jobs',compact('jobs','pageData','job_id'));
		}
		return view('frontend.jobs.jobs',compact('jobs','job_id'));
	}
	public function contactChrysalis(Request $request){
		$req=$request->all();
		// /print_r($req); exit;
		$fullname=$request->fullname;
	    $linkedinurl=$request->linkedinurl;
		$email=$request->email;
		$website=$request->website;
		$phone=$request->phone;
		$portfolio_link=$request->portfolio_link;
		$resume=$request->resume;
		$cover_letter=$request->document_upload;
		$personal_hero=$request->personal_hero;
		$dest=public_path('jobs_docs/resumes');
		$file_name = str_random(10).'.'.$req['resume']->getClientOriginalExtension();
		$source_image_path=public_path('jobs_docs');
    	$thumb_image_path2=public_path('jobs_docs/resumes');
        $req['resume']->move($source_image_path, $file_name);
        

        
     
		
		
				$all_data = array();
				$all_data['fullname'] = $request->fullname;
				$all_data['linkedin_url'] = $request->linkedinurl;
				$all_data['email']    = $request->email;
				$all_data['website']    = $request->website;
				$all_data['phone']    = $request->phone;
				$all_data['portfolio_link']= $request->portfolio_link;
				$all_data['resume']= $request->resume;
				$all_data['coverletter']= $request->document_upload;

				$filepath=$source_image_path.'/'.$file_name; 
				$sent=Mail::send('emails.jobs',array("data"=>$all_data), function ($message) use($req) {
				    $mailTo = config('services.chyrsalis_mail_add.job_email');
					$message->to($mailTo);
				    $message->subject('Jobs');
				    $message->attachData($req['resume'], $req['resume']->getClientOriginalName());
				    $message->attachData($req['document_upload'], $req['document_upload']->getClientOriginalName());



				});
				Session::flash('success', 'Job Applied Successfully');	
				return Redirect::back();	
	}
	
	
	
	
	
}

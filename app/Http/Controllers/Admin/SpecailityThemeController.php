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

class SpecailityThemeController extends Controller
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
    /******Specaility admin view code starts here***/
    public function themePriority(){
      $categories=DB::table('category')->select('category_id as id','name as name','speciality_theme as priority')->whereIn('category_id', array(147, 66, 143))->get();

     // /print_r($categories);
      return view('admin.specialitytheme.themepriority',compact('categories'));
    }
    /***update priority function code starts here***/
    public function updatePriority(Request $request){

    $req=$request->all();
     
      $categoryid=$request->categoryid;
      $priority=$request->priority;
      $count=count($categoryid);
      if($count  > 0){
        for($i=0;$i<$count;$i++){
          $array=array('speciality_theme'=>$priority[$i],'updated_at'=>date('y-m-d H:i:s'));
           $update=DB::table('category')->where('category_id',$categoryid[$i])->update($array);
        }   
        if($update){

         Session::flash('success', 'Specialty Theme Priority Updated Successfully');
         return redirect::back();
         
       }                                                                                                          
      
      }
       
         


    }
    /******check priority code starts here***/
    public function checkPriority(Request $request){
      $req=$request->all();
      $priorityid=$request->id;
      //check the priority in db
      $check_priority=DB::table('category')->where('speciality_theme',$priorityid)->get();
      //echo "<pre>";print_r($check_priority);die;
      $count=count($check_priority);
      //echo $count;die; 
      if($count != 0 ){
        Session::flash('error', 'Priority is already updated ');
        return $count;
      }


    }
	

    
}

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

class RequestabagController extends Controller
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
	Method Name : manageBag()
	Purpose :
	*/
	public function manageBag(){
	   return view('admin.request-a-bag.managebag');
	}

	/*
	Method Name : processBag()()
	Purpose :
	*/
	public function processBag($id){
		$this->data = array();
		$this->data['request_a_bag'] = DB::table('request_bags')->where('id',$id)
		->leftJoin('address_master','request_bags.addres_id','address_master.address_id')->first();
	   return view('admin.request-a-bag.processabag')->with('total_data',$this->data);
	}
	public function Getallmanagebags(){
		$request_bags=DB::table('request_bags')->get();
	return Datatables::of($request_bags)
        ->addColumn('actions', function ($request_bagso) {
                return '<a href="/process-bag/'.$request_bagso->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>';
            })
        ->make(true);
	}
}
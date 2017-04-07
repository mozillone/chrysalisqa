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
					$where.=' AND cst.name LIKE "%'.$req['search']['cst_name'].'%"';
			}
			if(!empty($req['search']['user_name']) ){
					$where.=' AND report.name LIKE "%'.$req['search']['user_name'].'%"';
			}
		}
		$costume_reports = DB::select('SELECT cst.costume_id,cst.sku_no,cst.name as cst_name,report.name as user_name,report.phn_no,report.email,report.reason,DATE_FORMAT(report.created_at,"%m/%d/%Y %h:%i %p") as date FROM `cc_reported_costumes` as report LEFT JOIN cc_costumes as cst on cst.costume_id=report.costume_id '.$where.'');
		return response()->success(compact('costume_reports'));
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
	public function addCostume(){
	 /****Add Costumes View page ***/
	}
	/*
	Method Name : insertCostume()
	purpose:insertCostume Method is used to insert the costume into the database
	*/
	public function insertCostume(){
	  /****Inserting costume codes starts here***/
	}
	/*
	Method Name :editCostume()
	purpose:editCostume Method is used to show the edit page of costumes***/
	public function editCostume(){
	  /*****Show costume edit page***/
	}
	/*
	Method Name :updateCostume()
	Purpose:updateCostume Method is used to update the costume details***/
	public function updateCostume(){
	
	}
	/*
	Method name:deleteCostume()
	purpose:deletCostume Method is used to delete the costume
	*/
	public function deleteCostume(){
	
	}
	/*
	Method Name:searchCostume()
	purpose:searchCostume is used to search the costume
	*/
	public function searchCostume(){
	
	}

}

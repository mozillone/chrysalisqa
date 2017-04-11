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
	public function createCostume(){
	 /****Add Costumes View page ***/
	 $customers=DB::table('users')->select('display_name as username')
	 ->where('role_id','!=','1')
	 ->where('active','=','1')
	 ->orderby('display_name','ASC')
	 ->get();
	 /*******Array push for both categories and subcategories displaying code starts here*****/
	 $categories=array('modules_result'=>array());
		/****Getting the hotel feautures code starts here***/
		$hotelfeautures =\DB::table('category')->where('parent_id','=','0')->get();
		//print_r($hotelfeautures);exit;
		 $hotelcount=count($hotelfeautures);
		if($hotelcount > 0)
		{
			 $module_array=array();
			 foreach($hotelfeautures as $feautures_response)
			 {
				 foreach($feautures_response as $feauture_key=>$feauture_val)
				 {
					  $module_array[$feauture_key]=$feauture_val;
				 }
				  $module_array['submodule_result']=array();
				  /* >> sub module code start*/
				  $where=array('cc.parent_id'=>$feautures_response->category_id);
					  $hotelfeautures=\DB::table('category as cc')
					 ->join('category', 'category.category_id', '=', 'cc.parent_id')
           ->select('cc.category_id as subcategoryid','cc.name as subcategoryname')->where($where)->get();
					  $sub_count=count($hotelfeautures);
					  if($sub_count > 0)
					  {
						  $submodule_array=array();
						  foreach($hotelfeautures as $sub_response)
							{
								$submodule_array['count']=$feautures_response->category_id;
								foreach($sub_response as $sub_key=>$sub_val)
								{
									$submodule_array[$sub_key]=$sub_val;
								}
								array_push($module_array['submodule_result'],$submodule_array);
								
							}
					  }
				 array_push($categories['modules_result'],$module_array);
			 }
			 
		}
		//print_r($categories); exit;
		//Fetching attributes code starts here***/
		/*****************Body and dimensions code starts here***/
		$bd_height=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',16)->first();
		$bd_height_in=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',17)->first();
        $bd_height_in=DB::table('attributes')->select('attribute_id','code','label','type')->where('attribute_id','=',17)->first();

		/****Array push code ends here***/
	 return view('admin.costumes.costume_create',compact('title','customers','categories','bd_height','bd_height_in'));
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

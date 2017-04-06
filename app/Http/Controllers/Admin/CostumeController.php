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

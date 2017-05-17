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

class PressController extends Controller {
	

	public function pressPosts() {
		$heading = "Press";
		$create = "+ Add Post";
		$breadcrumb = "Press Posts";

		return view('admin.press.press-posts', compact('heading', 'create', 'breadcrumb'));
	}
	public function addPressPost() {
		$users = DB::table('press')->select('*')->get();
		return view('admin.press.add-press-post');
	}

	public function insertPressPost() {
		$validator = Validator::make($request->all(), [
		  
                  'postTitle' => 'required',
                  'postDesc' => 'required',
                  'status' => 'required'
                ]);
   
   if ($validator->fails()) {
        return Redirect::back()
        ->withErrors($validator)
        ->withInput()->send();

	} else {



		$postTitle = $request->input('postTitle');
		$postDesc = $request->input('postDesc');
		$status = $request->input('status');
		
		/*$fromDate = $request->input('fromDate');
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
		$fullToDate = $year.'-'.$month.'-'.$date;*/

		
		$category = $request->input('Categories');
		$implode_categories = implode(',', $category)
		

		

		$pressData = array(
				'press_title' => $postTitle,
				'press_desc' => $postDesc,
				'status' => $status,
				'created_at' => date('y-m-d H:i:s')
			);

		$categoryData = array(
			'cat_name' => $implode_categories
			
			);

		$press_insert = DB::table('press')->insert($pressData);
		$category_insert = DB::table('press_categories')->insert($categoryData);
	return "Success";
	
}
	public function pressPostList() {

	}
}
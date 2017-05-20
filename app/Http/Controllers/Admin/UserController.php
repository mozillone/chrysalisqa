<?php namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Datatables;
use DB;
use Session;
use App\Helpers\SiteHelper;
use App\Helpers\ExportFile;
use Hash;
use Response;
use App\Helpers\StripeApp;
use Exception;
class UserController extends Controller
{
    protected $messageBag = null;
    

    public function __construct()
    {
      $this->csv = new ExportFile();
      $this->sitehelper = new SiteHelper();
      $this->stripe=new StripeApp();
      $this->middleware(function ($request, $next) {
          if(!Auth::check()){
            return Redirect::to('/admin/login')->send();
          }
          else{
               return $next($request);
          }
      });
    }
    public function adminProfile()
    {
      $title=Auth::user()->display_name." Edit";
      return view('admin.profile_edit')->with('title',$title);
    }
    public function adminProfileUpdate(Request $request)
    {
      $req=$request->all();
      $name = User::find(Auth::user()->id);
      if(isset($req['avatar'])){
        $file_name = str_random(10).'.'.$req['avatar']->getClientOriginalExtension();
        $source_image_path=public_path('profile_img');
        $thumb_image_path1=public_path('profile_img');
        $thumb_image_path2=public_path('profile_img/thumbs');
        $req['avatar']->move($source_image_path, $file_name);
        $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,150,150);
        $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,30,30);
    
      }
      else if(isset($req['is_removed'])){
        $file_name="";
      }
      else{
        $file_name=$name->avatar;
      }
      $userData = [
          'first_name' => $req['first_name'],
          'last_name' => $req['last_name'],
		  'display_name'=>$req['user_name'],
          'email'=>$req['email'],
          'user_img' =>$file_name
      ];
      if(!empty($req['password'])){
        $userData['password'] =  Hash::make($req['password']);
      }
      $affectedRows = User::where('id', '=', Auth::user()->id)->update($userData);
      Session::flash('success', 'Your profile is upadated successfully');
      return Redirect::back();
    }
    public function customersList()
    {
      $title="Users List";
      return view('admin.usermanagemnt.customers_list')->with('title',$title);
    }
	/****costumes list coding starts here***/
	public function customesList()
    {
      $title="Costumes List";
      return view('admin.costumes.costumes_list')->with('title',$title);
    }
    public function customersListData(Request $request)
    {
        $req=$request->all();
		$userslist=DB::table('users as user')
		->select('user.id',DB::Raw("CONCAT(cc_user.first_name,' ',cc_user.last_name) as display_name")  ,'user.phone_number','user.email','user.active','user.deleted',DB::Raw('DATE_FORMAT(cc_user.created_at,"%m/%d/%y %h:%i %p") as date_format'),DB::Raw('DATE_FORMAT(cc_user.created_at,"%m/%d/%y %h:%i %p") as lastlogin'))
		->orderby('user.created_at','DESC')
		->where('user.role_id','!=','1');
		if(!empty($req['search'])){
		
		if(!empty($req['search']['name']) ){
		$userslist->where('user.display_name', 'LIKE', "%".$req['search']['name']."%");
		 }
		 if(!empty($req['search']['email']) ){
		$userslist->where('user.email',$req['search']['email']);
		 }
		 if(!empty($req['search']['phone']) ){
		$userslist->where('user.phone_number', 'like','%'.$req['search']['phone'] .'%');
		 }
		 if(isset($req['search']['status'])){
            if($req['search']['status']==""){
			$userslist->whereIn('user.active',array('0','1'));
             }
            if($req['search']['status']!=""){
              $userslist->where('user.active',$req['search']['status']);
            }
          }
		 if(isset($req['search']['count'])){
            if($req['search']['count']==""){
			$userslist->whereIn('user.deleted',array('0','1'));
             }
            if($req['search']['count']!=""){
              $userslist->where('user.deleted',$req['search']['count']);
            }
          }

		  }
		 $users=$userslist->get();
		
		//->where('users.role_id','!=',1);
		//$users=$userslist->get();
		//$userslist=DB::table('users')->select('users.*')->order_by('users.created_at','DESC')->get();
       // $users = DB::select('SELECT user.id,user.display_name as name,user.phone_number,user.email,user.active,DATE_FORMAT(user.created_at,"%m/%d/%y %h:%i %p") as date, FROM `cc_users` as user where '.$where.' ORDER BY user.created_at DESC');
        return response()->success(compact('users','credit'));
  
    }

    public function userCsvExport(Request $request){
	
		$req = $request->all();
		if(!empty($req['data'])){
			$data = User::whereIn('id',$req['data'])->selectRaw("id as ID, display_name as Name, email as Email, phone_number as Phone, if(active='1', 'Active','InActive') as status,  DATE_FORMAT(created_at,'%m/%d/%Y %h:%i %p') as 'Created At'")->get();
		 	$this->csv->csvExportFile($data);
		}
		else{
			$result = DB::select("SELECT id as ID, display_name as Name,phone_number as Phone, if(active='1', 'Active','InActive') as status,  DATE_FORMAT(created_at,'%m/%d/%Y %h:%i %p') as 'Created At' FROM `vmd_users` where role_id NOT IN ('1')");
			$data = json_decode(json_encode($result), true);
			$this->csv->csvExportFile($data);
		}
	}
 	public function customerAdd(Request $request)
    {
		$req=$request->all(); 
		//print_r($req); exit;
		if(empty($req)){
			return view('admin.usermanagemnt.customer_create');
		}
		if(isset($req['avatar'])){ 
			$file_name = str_random(10).'.'.$req['avatar']->getClientOriginalExtension();  
			$source_image_path=public_path('profile_img');
			$thumb_image_path1=public_path('profile_img');
			$thumb_image_path2=public_path('profile_img/thumbs');
			$req['avatar']->move($source_image_path, $file_name);
			$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,150,150);
			$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,30,30);
		}
		else{
			$file_name="";
		}
			$customer=$this->stripe->customers($req['email']);
			$user = new User();
			$user->first_name    = $req['first_name'];
			$user->last_name     = $req['last_name'];
			$user->display_name  = $req['user_name'];
			$user->phone_number	 = $req['phone_number'];
			//$user->display_name  = $user->first_name." ".$user->last_name;
			$user->email         = $req['email'];
			$user->password      = Hash::make($req['password']);
			$user->active        = "1";
			$user->user_img =$file_name;
			$user->api_customer_id =$customer['id'];
			
			
			if($user->save()){
				Session::flash('success', 'User created successfully');
					return Redirect::to('customers-list');
				}else{
					$message = array();
					Session::flash('error', 'User not created successfully.Database error');
					return Redirect::back();
				} 
	}
	public function customerEdit($id){
	$title="Users List";
		$user = User::find($id);
		return view('admin.usermanagemnt.customer_edit')->with('user_id',$id)->with('user', $user)->with('title',$title);
	}
	public function customerUpdated(Request $request){
		$req=$request->all();
		$name = User::find($req['user_id']);
		if(!empty($request->avatar))
        {
	        $file_name = str_random(10).'.'.$req['avatar']->getClientOriginalExtension();
			$source_image_path=public_path('profile_img');
			$thumb_image_path1=public_path('profile_img');
			$thumb_image_path2=public_path('profile_img/thumbs');
			$req['avatar']->move($source_image_path, $file_name);
			$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,150,150);
			$this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,30,30);
	
		}
		else{
			$file_name=$name->user_img;
		}
		if(!empty($req['vacationstatus'])){$vacationstatus=$req['vacationstatus'];}else{$vacationstatus="0";}
		$userData = [
				'first_name' => $req['first_name'],
				'last_name' => $req['last_name'],
				'phone_number'=>$req['phone_number'],
				'display_name' =>  $req['first_name']." ".$req['last_name'],
				'email'=>$req['email'],
				'user_img' =>$file_name,
				'vacation_status'=>$vacationstatus,
				'vacation_from'=>$req['date_timepicker_end_ticket'],
				'vacation_to'=>$req['date_timepicker_end1_ticket'],
				
		];
		if(!empty($req['password'])){
			$userData['password'] =  Hash::make($req['password']);
		}
		$affectedRows = User::where('id', '=', $req['user_id'])->update($userData);
		Session::flash('success', 'User is updated  successfully');
		return Redirect::to('customers-list');
	
	
	}
    public function customerDelete($id)
    {

      $data=User::find($id)->toArray();
      $apiId=$data['api_customer_id'];
       $res = User::where('id',$id)->delete();
      if($res){
      	try{
        	$this->stripe->customerDelete($apiId);
        }catch(Exception $e){
        	
        }
      	Session::flash('success', 'User is Deleted Successfully');
        return Redirect::back();
      }else{
        Session::flash('error', 'User is deleted.Database error occured');
        return Redirect::back();
      }
        
    }
    public function changeUserStatus(Request $request)
    {
    	$req = $request->all();
    	$user = User::where('id', $req['data']['id'])->update(['active'=>$req['data']['status']]);
    	//$users = DB::select('SELECT user.id,user.display_name as name,user.email,user.active,DATE_FORMAT(user.created_at,"%m/%d/%y %h:%i %p") as date FROM `iv_users` as user where role_id!="1" ORDER BY user.created_at DESC');
        return response()->success(true);
    }
    public function EmailNameCheck(Request $request)
    {
    	$req=$request->all();
    	if(!isset($req['user_id'])){
    		$email=User::where('email', '=', $req['email']) ->count();
    	}
    	else{
    
    		$email=User::where('email', '=', $req['email'])->where('id',"!=",$req['user_id'])->count();
    	}
    	if($email){
    		return Response::JSON(false);
    	}
    	else{
    		return Response::JSON(true);
    	}
    }
	/*****user costumes list fetching code starts here***/
	public function userCostumes($id){
	$title=Auth::user()->display_name."Costumes";
	$userid=$id;
	//$costumes=DB::table('costumes')->
	//select('costume_id as id','name as costume_name',
	//'users.display_name as username','condition as condition',
	//DB::Raw('DATE_FORMAT(cc_users.created_at,"%m/%d/%y %h:%i") as date_format','status as active'))
	//->leftJoin('users','costumes.created_by','=','users.id')
	//->where('created_by','=',8)
	//->get();
	return view('admin.usermanagemnt.user_customes_list',compact('title','userid'));
	}
	/****user sold costumes code starts here************/
	public function userSoldcostumes($id){
	$userid=$id;
	$title=Auth::user()->display_name."Costumes Sold";
	return view('admin.usermanagemnt.user_customessold_list',compact('title','userid'));
	}
	/****User Recent Orders Code Starts Here****/
	public function recentOrders($id){
	$userid=$id;
	$title=Auth::user()->display_name."Recent Orders";
	return view('admin.usermanagemnt.user_recentorders',compact('title','userid'));
	}
	/****User Credit history code starts here***/
	public function creditHistory($id){
	$userid=$id;
	$title=Auth::user()->display_name."Credit History";
	return view('admin.usermanagemnt.user_credit_history',compact('title','userid'));
	}
	/****Payement Profiles Code starts here***/
	public function payementProfiles($id){
	$userid=$id;
	$title=Auth::user()->display_name."Payement Profiles";
	return view('admin.usermanagemnt.user_payement_profiles',compact('title','userid'));
	}

	public function Getallpaymentprofile(Request $request){
		//echo "<pre>";print_r($request->id);die;

		$creditcard=DB::table('creditcard')->where('user_id',$request->id)->get();
	return Datatables::of($creditcard)
        ->addColumn('actions', function ($creditcardso) {
                return '<a href="javascript:void(0);" onclick="deleteccard('.$creditcardso->id.')" class="btn btn-xs btn-danger delete_user"><i class="fa fa-trash-o"></i></a>';
            })
        ->make(true);
	}

	public function Deleteccard($id){
		//echo $id;die;
		$delete_card = DB::table('creditcard')->where('id',$id)->delete();
		return Redirect::back()->with('success','Card deleted successfully.');
	}
 
}

<?php namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\UserMeta;
use Datatables;
use DB;
use Session;
use App\Helpers\SiteHelper;
use App\Helpers\Site_model;
use App\Helpers\ExportFile;
use Hash;
use Response;
//use App\BraintreeApp;
use App\Helpers\StripeApp;
use Exception;
use App\Address;
use App\Imageresize;
class UserController extends Controller
{
    protected $messageBag = null;
    

    public function __construct()
    {
      $this->csv = new ExportFile();
      $this->sitehelper = new SiteHelper();
      //$this->braintreeApi = new BraintreeApp();
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
        $source_image_path=public_path('profile_img/resize');
        $thumb_image_path1=public_path('profile_img/resize');
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

    public function customersListData(){

        $query = "select `cu`.`id` AS `id`,concat(`cu`.`first_name`,' ',`cu`.`last_name`) AS `user_name`,`cu`.`credits` AS `credits`,`cu`.`email` AS `email`,`cu`.`role_id` AS `role_id`,`cu`.`active` AS `active`,`cu`.`deleted` AS `deleted`,date_format(`cu`.`created_at`,'%m/%d/%y %h:%i %p') AS `created_at`,date_format(`cu`.`last_login`,'%m/%d/%y %h:%i %p') AS `last_login`,(case when ((select count(`cc_costumes`.`costume_id`) AS `cnt` from `cc_costumes` where (`cu`.`id` = `cc_costumes`.`created_by`)) > 0) then 'Yes' else 'No' end) AS `is_seller` from `cc_users` `cu` where (`cu`.`role_id` <> 1) HAVING 1";
        $usersList = DB::select(DB::Raw($query));
        $usersList = collect($usersList);

        return Datatables::of($usersList)
            ->editColumn('credits', function ($usersList) {
                return '$'.number_format(floatval($usersList->credits),2,'.','');
            })
            ->editColumn('active', function ($usersList) {
                $a = $usersList->active == '1' ? 'checked' : '';
                return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $usersList->id .'" onClick="changeUserStatus('.$usersList->id.','.$usersList->active.');">
                                   <div class="slider round"></div>
                               </label>';
            })
            ->addColumn('actions', function ($usersList) {
                return '<a href="/customer-edit/'.$usersList->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a href="javascript:void(0);" onclick="deleteUser('.$usersList->id.')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
            })
            ->make(true);
    }

    public function searchCustomers(Request $request){

        $req = $request->all();

        $query = "select `cu`.`id` AS `id`,concat(`cu`.`first_name`,' ',`cu`.`last_name`) AS `user_name`,`cu`.`credits` AS `credits`,`cu`.`email` AS `email`,`cu`.`role_id` AS `role_id`,`cu`.`active` AS `active`,`cu`.`deleted` AS `deleted`,date_format(`cu`.`created_at`,'%m/%d/%y %h:%i %p') AS `created_at`,date_format(`cu`.`last_login`,'%m/%d/%y %h:%i %p') AS `last_login`,(case when ((select count(`cc_costumes`.`costume_id`) AS `cnt` from `cc_costumes` where (`cu`.`id` = `cc_costumes`.`created_by`)) > 0) then 'Yes' else 'No' end) AS `is_seller` from `cc_users` `cu` where (`cu`.`role_id` <> 1) HAVING 1";

        if(isset($req['user_name']) && !empty($req['user_name'])){
            $query .= " AND user_name LIKE '%".$req['user_name']."%'";
        }

        if(isset($req['email']) && !empty($req['email'])){
            $query .= " AND email LIKE '%".$req['email']."%'";
        }

        if(isset($req['is_seller']) && !empty($req['is_seller'])){
            $query .= " AND is_seller  = '".$req['is_seller']."'";
        }

        if(isset($req['status']) && !empty($req['status'])){
            if($req['status'] == 'active'){
                $status = '1';
            }else if($req['status'] == 'inactive'){
                $status = '0';
            }
            $query .= " AND active = '".$status."'";
        }

        $usersList = DB::select(DB::Raw($query));
        $usersList = collect($usersList);

        return Datatables::of($usersList)
            ->editColumn('credits', function ($usersList) {
                return '$'.number_format(floatval($usersList->credits),2,'.','');
            })
            ->editColumn('status', function ($usersList) {
                $a = $usersList->active == '1' ? 'checked' : '';
                return '<label class="switch">
                                   <input type="checkbox" '.$a.' class="status" id="'. $usersList->id .'" onClick="changeUserStatus('.$usersList->id.','.$usersList->active.');">
                                   <div class="slider round"></div>
                               </label>';
            })
            ->addColumn('actions', function ($usersList) {
                return '<a href="/customer-edit/'.$usersList->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a href="javascript:void(0);" onclick="deleteUser('.$usersList->id.')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
            })
            ->make(true);
    }


//    public function customersListData(Request $request)
//    {
//        $req=$request->all();
//		$userslist=DB::table('users as user')
//		->select('user.id','user.username','user.phone_number','user.email','user.active','user.deleted',DB::Raw('DATE_FORMAT(cc_user.created_at,"%m/%d/%y %h:%i %p") as date_format'),DB::Raw('DATE_FORMAT(cc_user.created_at,"%m/%d/%y %h:%i %p") as lastlogin'))
//		->orderby('user.created_at','DESC')
//		->where('user.role_id','!=','1');
//		if(!empty($req['search'])){
//
//		if(!empty($req['search']['name']) ){
//		$userslist->where('user.username', 'LIKE', "%".$req['search']['name']."%");
//		 }
//		 if(!empty($req['search']['email']) ){
//		$userslist->where('user.email',$req['search']['email']);
//		 }
//		 if(!empty($req['search']['phone']) ){
//		$userslist->where('user.phone_number', 'like','%'.$req['search']['phone'] .'%');
//		 }
//		 if(isset($req['search']['status'])){
//            if($req['search']['status']==""){
//			$userslist->whereIn('user.active',array('0','1'));
//             }
//            if($req['search']['status']!=""){
//              $userslist->where('user.active',$req['search']['status']);
//            }
//          }
//		 if(isset($req['search']['count'])){
//            if($req['search']['count']==""){
//			$userslist->whereIn('user.deleted',array('0','1'));
//             }
//            if($req['search']['count']!=""){
//              $userslist->where('user.deleted',$req['search']['count']);
//            }
//          }
//
//		  }
//		 $users=$userslist->get();
//
//		//->where('users.role_id','!=',1);
//		//$users=$userslist->get();
//		//$userslist=DB::table('users')->select('users.*')->order_by('users.created_at','DESC')->get();
//       // $users = DB::select('SELECT user.id,user.display_name as name,user.phone_number,user.email,user.active,DATE_FORMAT(user.created_at,"%m/%d/%y %h:%i %p") as date, FROM `cc_users` as user where '.$where.' ORDER BY user.created_at DESC');
//        return response()->success(compact('users','credit'));
//
//    }

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
        try{
         $customer=$this->stripe->customers($req['email']);
        }catch(Exception $e){
           Session::flash('error', $e->getMessage());
           return Redirect::back();
        }
       $users = User::create([
                                    'role_id'         =>4,
                                    'first_name'      => $req['first_name'],
                                    'last_name'       => $req['last_name'],
                                    'username'    => $req['username'],
                                    'email'           => $req['email'],
                                    'password'        => Hash::make($req['password']),
                                    'user_img'            =>$file_name,
                                    'active'            =>'1',
                                    'api_customer_id' =>$customer['id']
                                   
                                ])->id;

			
			// $user = new User();
			// $user->first_name    = $req['first_name'];
			// $user->last_name     = $req['last_name'];
			// $user->display_name  = $req['user_name'];
			// $user->phone_number	 = $req['phone_number'];
			// //$user->display_name  = $user->first_name." ".$user->last_name;
			// $user->email         = $req['email'];
			// $user->password      = Hash::make($req['password']);
			// $user->active        = "1";
			// $user->user_img =$file_name;
   //    $user->api_customer_id =$customer['id'];
			
			    // $customerData = [
       //                                      'firstName' => $req['first_name'],
       //                                      'lastName' => $req['last_name'],
       //                                      'email' => $req['email'],
                                           
       //                                  ];  

			// $this->braintreeApi->createCustomer($customerData,$users);
			if($users){
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
    //echo "<pre>";print_r($request->all());die;
		$name = User::find($req['user_id']);
		if(!empty($request->avatar))
        {
	        $image = Imageresize::DashboardProfile($req['avatar']);
          
          $file_name = $image;
	
		}
		else{
			$file_name=$name->user_img;
		}
    $vacation_from = date('Y-m-d',strtotime($req['date_timepicker_end_ticket']));
    $vacation_to = date('Y-m-d',strtotime($req['date_timepicker_end1_ticket']));
    if(!empty($req['vacationstatus'])){$vacationstatus=$req['vacationstatus'];}else{$vacationstatus="0";}
		$userData = [
				'first_name' => $req['first_name'],
				'last_name' => $req['last_name'],
				'display_name' =>  $req['first_name']." ".$req['last_name'],
				'email'=>$req['email'],
        'username'=>$req['username'],
				'user_img' =>$file_name,
				'vacation_status'=>$vacationstatus,
				'vacation_from'=>$vacation_from,
				'vacation_to'=>$vacation_to,
				
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
        	//$this->braintreeApi->deleteCustomer($apiId);
          $this->stripe->customerDelete($apiId);
        }catch(Exception $e){
        	Session::flash('error', $e->getMessage());
           return Redirect::back();
        }
      	Session::flash('success', 'User is Deleted Successfully');
        return Redirect::back();
      }else{
        Session::flash('error', 'User is deleted.Database error occured');
        return Redirect::back();
      }
        
    }
    public function changeUserStatus(Request $request){
        $id     = $request->input('id');
        $getUser = DB::table('users')->where('id', $id)->first(['active']);
        if ($getUser->active == 1) {
            $user = DB::table('users')->where('id', $id)->update(['active' => '0']);
        }else{
            $user = DB::table('users')->where('id', $id)->update(['active' => '1']);
        }

        return $user;
    }
//    public function changeUserStatus(Request $request)
//    {
//    	$req = $request->all();
//    	$user = User::where('id', $req['data']['id'])->update(['active'=>$req['data']['status']]);
//    	//$users = DB::select('SELECT user.id,user.display_name as name,user.email,user.active,DATE_FORMAT(user.created_at,"%m/%d/%y %h:%i %p") as date FROM `iv_users` as user where role_id!="1" ORDER BY user.created_at DESC');
//        return response()->success(true);
//    }
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
	$info=User::find($userid)->toArray();
	$title=$info['first_name']." ".$info['first_name']."Costumes Sold";
	return view('admin.usermanagemnt.user_customessold_list',compact('userid',$userid))->with('user_name',$info['first_name']." ".$info['first_name'])->with('title',$title);
	}
	public function userCostumeSoldListData(Request $request,$user_id)
    {
        $req=$request->all();
        $where='where ord.seller_id='.$user_id.'';
        $having='';
        if(!empty($req['search'])){
          if(!empty($req['search']['order_id']) ){
            $where.=' AND ord.order_id ='.$req['search']['order_id'];
          }
          if (!empty($req['search']['from_date'])) {
            $where .= ' AND  ord.created_at >="'.date('Y-m-d 00:00:01', strtotime($req['search']['from_date'])).'"';
          }
          if (!empty($req['search']['date_end'])) {
            $where .= ' AND  ord.created_at  <= "'.date('Y-m-d 23:59:59', strtotime($req['search']['date_end'])).'"';
          }
          if(isset($req['search']['status'])){
          if($req['search']['status']!=""){
              $where.=' AND sts.name="'.$req['search']['status'].'"';
          }
        }
        }
         $orders = DB::select('SELECT Date_format(ord.created_at,"%m/%d/%Y %h:%i %p") as date,ord.order_id,concat("$",ord.total) as price,concat(buyer.first_name," ",buyer.last_name) as buyer_name,sts.name as status FROM `cc_order` as ord LEFT JOIN cc_users as buyer on buyer.id=ord.buyer_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id  '.$where.' GROUP BY ord.order_id ORDER BY `order_id` DESC');
        return response()->success(compact('orders'));
  
    }
	/****User Recent Orders Code Starts Here****/
	public function recentOrders($id){
	$userid=$id;
	$info=User::find($userid)->toArray();
	$title=$info['first_name']." ".$info['first_name']."Costumes Sold";
	return view('admin.usermanagemnt.user_recentorders',compact('userid',$userid))->with('user_name',$info['first_name']." ".$info['first_name'])->with('title',$title);
	}
	public function userOrdersListData(Request $request,$user_id)
    {
        $req=$request->all();
        $where='where ord.buyer_id='.$user_id.'';
        $having='';
        if(!empty($req['search'])){
          if(!empty($req['search']['order_id']) ){
            $where.=' AND ord.order_id ='.$req['search']['order_id'];
          }
          if (!empty($req['search']['from_date'])) {
            $where .= ' AND  ord.created_at >="'.date('Y-m-d 00:00:01', strtotime($req['search']['from_date'])).'"';
          }
          if (!empty($req['search']['date_end'])) {
            $where .= ' AND  ord.created_at  <= "'.date('Y-m-d 23:59:59', strtotime($req['search']['date_end'])).'"';
          }
          if(isset($req['search']['status'])){
          if($req['search']['status']!=""){
              $where.=' AND sts.name="'.$req['search']['status'].'"';
          }
        }
        }
         $orders = DB::select('SELECT Date_format(ord.created_at,"%m/%d/%Y %h:%i %p") as date,concat("$",ord.total) as price,ord.order_id,concat(seller.first_name," ",seller.last_name) as seller_name,sts.name as status FROM `cc_order` as ord LEFT JOIN cc_users as seller on seller.id=ord.seller_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id '.$where.' GROUP BY ord.order_id ORDER BY `order_id` DESC');
        return response()->success(compact('orders'));
  
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

		$creditcard=DB::table('creditcard')
    ->select('creditcard.id','creditcard.cardholder_name','creditcard.credit_card_mask',
      'creditcard.card_type','creditcard.exp_year',
      DB::Raw('DATE_FORMAT(cc_creditcard.created_at,"%m/%d/%y %h:%i %p") as date_format'))
    ->where('user_id',$request->id)->get();
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

	public function Getallusercostumes(Request $request){

		$costumes_list=DB::table('costumes')
    ->leftJoin('costume_description','costume_description.costume_id','costumes.costume_id')
    ->leftJoin('costume_to_category','costume_to_category.costume_id','costumes.costume_id')
		->leftJoin('category','category.category_id','costume_to_category.category_id')
    ->select('costumes.costume_id as costume_id','costume_description.name as cos_name','category.name as cat_name',
      'costumes.condition as cos_condition','costumes.quantity as cos_qan',
      DB::Raw('DATE_FORMAT(cc_costumes.created_at,"%m/%d/%y %h:%i %p") as date_format'),
      'costumes.status as cos_status')
		->where('costumes.created_by',$request->id)
    ->where('costumes.deleted_status',"0")
		->get();
		//echo "<pre>";print_r($request->costume_id);die;
	return Datatables::of($costumes_list)
        ->addColumn('actions', function ($costumes_lists) {
                return '<a href="javascript:void(0);" onclick="deletecostume('.$costumes_lists->costume_id.')" class="btn btn-xs btn-danger delete_user"><i class="fa fa-trash-o"></i></a>';
            })
        ->make(true);
	}
  public function adminSettings(){
      $title="Settings";
      $this->data['seller_address'] = DB::table('address_master')->where('user_id',Auth::user()->id)->where('address_type','selling')->get();
      $states = Address::getStatesList();
      $request_bag = Site_model::find_user_and_meta('user_meta',Auth::user()->id);
      $search_banner_settings = DB::table('search_banner_settings')->first();
     return view('admin.settings.settings')->with($this->data)->with('states',$states)->with('request_bag',$request_bag)->with('search_banner_settings',$search_banner_settings);
  }
  public function requesBagSettings(Request $request){
      $req = $request->all();
      Site_model::save_meta_for('user_meta',$req['request_bag'],Auth::user()->id);
      Session::flash('success', 'Settings updated successfully');
      return Redirect::back();
  }

  /**
   * Created By Gayatri on 2nd Nov 2017
   * [Adding/Updating a new search banner image]
   * @param  Request $request [baneer image details]
   * @return [file]           [image]
   */
  public function searchBannerSettings(Request $request)
  {
    //echo "<pre>"; print_r($request->all());
    $request = $request->all();
    if(isset($request['banner_image'])){
      $file = $request['banner_image'];
      $destination_path = public_path('category_images/Banner');

      $file_name = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension() ?: 'png';
      $safeName = str_random(10).'.'.$extension;
      $file->move($destination_path,$safeName);
    }else{
      $safeName = '';
    }
    //echo $safeName; exit;
    $store_or_update_image = DB::table('search_banner_settings')->update(['file_name' => $safeName]);

    Session::flash('success', 'Settings updated successfully');
    return Redirect::back();
  }
 
}

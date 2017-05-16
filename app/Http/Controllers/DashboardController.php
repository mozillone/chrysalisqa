<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use App\User;
use Session;
use Hash;
use DB;
use App\Helpers\Site_model;
use App\Address;
class DashboardController extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		  $this->sitehelper = new SiteHelper();
		$this->middleware(function ($request, $next) {
              if(!Auth::check() && !$request->is('coming-soon') && !$request->is('find-your-space') && !$request->is('list-your-space')){
                return Redirect::to('/login')->send();
            }
            else{
                 return $next($request);
            }
        });

	}
	public function dashboard()
	{
		if(Auth::user()->id!="1"){
			$this->data = array();
			$this->data['default_billing_address'] = DB::table('address_master')->where('user_id',Auth::user()->id)->where('address_type','billing')->first();
			$this->data['default_shipping_address'] = DB::table('address_master')->where('user_id',Auth::user()->id)->where('address_type','shipping')->first();
			$this->data['states']   = Site_model::Fetch_all_data('states', '*');
    $this->data['countries']   = Site_model::Fetch_all_data('countries', '*');
			return view('frontend.dashboard.dashboard')->with($this->data);
			
		}else{
			return Redirect::to('admin/dashboard');
		}

		
	}
	
	public function  EditProfile(Request $request)
  {
	
    $req=$request->all();
	//echo "<pre>";print_r($req);die;
                                          if(count($req)){
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
                                              'display_name' =>  $req['first_name']." ".$req['last_name'],
                                              'email'=>$req['email'],
                                              'user_img' =>$file_name
                                          ];
                                          if(!empty($req['password'])){
                                            $userData['password'] =  Hash::make($req['password']);
                                          }
                                          $affectedRows = User::where('id', '=', Auth::user()->id)->update($userData);
                                          Session::flash('success', 'Your profile is upadated successfully');
                                          return Redirect::back();
    return view('frontend.dashboard.dashboard');
  }
}
public function addShippingAddress(Request $req){
  //echo "<pre>";print_r($req->all());die;

  $address_id=Address::addShippingAddressDashboard($req);
  return Redirect::back();

}
public function addBillingAddress(Request $req){
 // echo "<pre>";print_r($req->all());die;
  $address_id=Address::addBillingAddressDashboard($req);
  return Redirect::back();

}
public function deleteAddress(Request $req){
  //echo "<pre>";print_r($req->all());die;
$deleteAddress = DB::table('address_master')->where('address_id',$req->id)->delete();

return "success";

}
}

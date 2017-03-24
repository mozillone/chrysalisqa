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
			return view('frontend.dashboard.dashboard');
		}else{
			return Redirect::to('admin/dashboard');
		}
	}
	public function comingSoon()
	{
		return view('frontend.coming_soon.coming_soon');
	}
	public function findYourSpace()
	{
		return view('frontend.find-your-space');
	}
	public function listYourSpace()
	{
		return view('frontend.list-your-space');
	}
	public function  EditProfile(Request $request)
	{
		$req=$request->all();
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
		}
		return view('profile.editProfile');
	}
}

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
}

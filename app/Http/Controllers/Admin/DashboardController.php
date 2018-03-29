<?php namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;


class DashboardController extends Controller {
    
    public function __construct(Guard $auth)
    {
        $this->middleware(function ($request, $next) {
              if(!Auth::check()){
                return Redirect::to('/login')->send();
            }
            else{
                 return $next($request);
            }
        });

    }
    public function dashboard()
    {
        $title="Dashboard";
     return view('admin.dashboard.index')->with('title',$title);
    }
}
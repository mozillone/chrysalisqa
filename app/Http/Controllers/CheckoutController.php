<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use App\Helpers\Site_model;
use Illuminate\Http\Request;
use Session;
use Hash;
use Response;
use App\Cart;
use App\Creditcard;
class CheckoutController extends Controller {

  protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
      $this->middleware(function ($request, $next) {
              if(!Auth::check()){
                return Redirect::to('/login')->send();
            }
            else{
                 return $next($request);
            }
        });
	}
  public function checkout(Request $request){
    $req=$request->all();
    if(count($req)){
      Creditcard:Creditcard();
      
    }else{
       $data=Cart::getCartProducts();
    }
    $countries   = Site_model::Fetch_all_data('countries', '*');
    return view('frontend.costumes.checkout.checkout',compact('data',$data))->with('countries',$countries);
  }
  public function addCreditCard(Request $request){
    $req=$request->all();
    Creditcard:Creditcard();
  }
	
}

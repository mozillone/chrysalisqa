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
use App\Order;
use App\Address;
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
    $data['basic']=Cart::getCartProducts();
    $countries   = Site_model::Fetch_all_data('countries', '*');
    $data['billing_address']=Address::getAddressinfo(Auth::user()->id,'billling');
    $data['shipping_address']=Address::getAddressinfo(Auth::user()->id,'shipping');
    $data['cc_details']=Creditcard::getCCList(Auth::user()->id);
    return view('frontend.costumes.checkout.checkout',compact('data',$data))->with('countries',$countries);
  }
  public function placeOrder(Request $request){
    $req=$request->all();
    $result=Order::placeOrder($req);
    if($result['result']=="0"){
       Session::flash('error',$result['message']);
       return Redirect::back();

    }
    }
  public function addShippingAddress(Request $request){
    $req=$request->all();
    dd($req);
    Address:addAddress($req);
  }
  public function addBillingAddress(Request $request){
    $req=$request->all();
    dd($req);
    Address:addAddress($req);
  }
  public function addCreditCard(Request $request){
    $req=$request->all();
    Creditcard:Creditcard();
  }
	
}

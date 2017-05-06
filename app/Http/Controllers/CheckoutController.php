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
    if(count($data['basic'])){
         $cart_info=Cart::cartMetaInfo($data['basic'][0]->cart_id);
         if(!empty($cart_info[0]->shipping_address_1)){
             $data['cart_shipping_address']=$cart_info;
         }else{
             $data['shipping_address']=Address::getAddressinfo('shipping',"latest"); 
         }

         if(!empty($cart_info[0]->pay_address_1)){
             $data['cart_billing_address']=$cart_info;
         }else{
             $data['billing_address']=Address::getAddressinfo('billing',"latest"); 
         }

         if(!empty($cart_info[0]->cc_id)){
             $data['cart_cc_details']=Creditcard::getCCList(Auth::user()->id,$cart_info[0]->cc_id);
         }else{
             $data['cc_details']=Creditcard::getCCList(Auth::user()->id);
         }
    }else{
       return Redirect::to('/');
   }
  return view('frontend.costumes.checkout.checkout',compact('data',$data))->with('countries',$countries);
  }
  public function placeOrder(Request $request){
    $req=$request->all();
    $result=Order::placeOrder($req);
    if($result['result']=="0"){
       Session::flash('error',$result['message']);
       return Redirect::back();

    }else{
      $charities_list=Order::getCharitiesList();
      return view('frontend.costumes.checkout.order_thanku')->with('order_id',$result['message'])->with('charities_list',$charities_list);
    }
    }
  public function addShippingAddress(Request $request){
    $req=$request->all();
    $address_id=Address::addShippingAddress($req);
    return Response::JSON($address_id);
  }
  public function addBillingAddress(Request $request){
    $req=$request->all();
    $address_id=Address::addBillingAddress($req);
    return Response::JSON($address_id);
  }
  public function addCreditCard(Request $request){
    $req=$request->all();
    $cc_id=Creditcard::addCreditCard($req,Auth::user()->id);
    return Response::JSON($cc_id);
  }
  public function getCreditCard($card_id=null){
    if($card_id==null){
      $card_list=Creditcard::getCCList(Auth::user()->id);
    }else{
      $card_list=Creditcard::getCCList(Auth::user()->id,$card_id);
    }
    return Response::JSON($card_list);
  }
  public function getAddressInfo($type,$adress_id=null){
   $shipping_address=Address::getAddressinfo($type,$latest=null,$adress_id);
   return Response::JSON($shipping_address);
    
  }
	
}

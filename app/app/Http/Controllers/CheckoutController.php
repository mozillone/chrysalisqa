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
use Validator;
use cookie;
use App\Helpers\StripeApp;
use Meta;
use URL;
use App\Promotions;

class CheckoutController extends Controller {

  protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
   // $this->stripe=new StripeApp();
      $this->middleware(function ($request, $next) {
              if(!Auth::check()){
                 Session::put('curentURL',URL::current());
                return Redirect::to('/login')->send();
            }
            else{
                 return $next($request);
            }
        });
    Meta::title('Chrysalis');
    Meta::set('robots', 'index,follow');
	}
  public function checkout(){
     $coupan_code=Cart::verifyCoupanCode();
    if(!$coupan_code){
      $data['basic']=Cart::getCartProducts();
    }else{
        $res=Promotions::verifyCoupanCode($coupan_code);
        if($res[0]->is_exists){
            $data['basic']=Cart::getCartProductswithCoupan($coupan_code, $res[0]->coupon_id);
        }
    }
    foreach($data['basic']['basic'] as $cart){
       if(!empty($data['basic']['type']) && $cart->created_user_group=="admin"){  
           $costumer_costumes[$cart->user_name]['type']='free';
         }else{
          $costumer_costumes[$cart->user_name]['type']='none';
         }
         $costumer_costumes[$cart->user_name]['products'][]=$cart;
         $costumer_costumes[$cart->user_name]['address']=Address::getUserSellerAddress($cart->created_by); 
        
     }
   //  dd($costumer_costumes);
    $states   = Site_model::Fetch_all_data('states', '*');
    $countries   = Site_model::Fetch_all_data('countries', '*');
    if(count($data['basic']['basic'])){
         $cart_info=Cart::cartMetaInfo($data['basic']['basic'][0]->cart_id);
         if(!empty($cart_info[0]->shipping_address_2)){
             $data['cart_shipping_address']=$cart_info;
         }else{
             $data['shipping_address']=Address::getAddressinfo('shipping',"latest"); 
         }

         if(!empty($cart_info[0]->pay_address_2)){
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
//dd($costumer_costumes);
   Meta::set('title', 'Checkout');
  return view('frontend.costumes.checkout.checkout',compact('data',$data))->with('countries',$countries)->with('states',$states)->with('costumer_costumes',$costumer_costumes);
  }
  public function placeOrder(Request $request){
     $req=$request->all();
   //  dd($req);
     if(!isset($req['shipping_type'])){
       Session::flash('error','Shipping methods are not found');
       return Redirect::back();
    }
    $rule  =  array(  
                'shipping_address_2' => 'required',
                'pay_address_2' => 'required',
                'card_id' => 'required',
                'card_id' => 'required',
                 );
  $messages = [
        'shipping_address_2.required' => 'Shipping address is required',
        'pay_address_2.required' => 'Billing address is required',
        'card_id.required' => 'Payment method is required',
    ];

    $validator = Validator::make($req,$rule,$messages);
    if ($validator->fails()) {
      return Redirect::back()
      ->withErrors($validator)
      ->withInput()->send();
    }

    $result=Order::placeOrder($req);
    if($result['result']=="0"){
       Session::flash('error',$result['message']);
       return Redirect::back();

    }else{
     // $result['message']*/
      $charities_list=Order::getCharitiesList(); 
      $order_donations=false;
       Meta::set('title', 'Order Review');
      return view('frontend.costumes.checkout.order_thanku')->with('order_id',$result['message'])->with('charities_list',$charities_list)->with('order_donations',$order_donations);
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
    $result=Creditcard::addCreditCard($req,Auth::user()->id);
    if($result['result']=="0"){
      Session::flash('error',$result['message']);
    }
    return Response::JSON($result);
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
  public function orderCharityFund(Request $request){
    $req=$request->all();
    if(!count($req)){
      return Redirect::to('/');
    }
    $charity_info=Order::orderCharityFund($req);
    if(count($charity_info)){
      Session::flash('success','Your fund transfer to '.$charity_info[0]->name.' is successful');
      $charities_list=Order::getCharitiesList(); 
      $order_donations=true;
      return view('frontend.costumes.checkout.order_thanku')->with('order_id',array('order_id'=>$req['order_id']))->with('charities_list',$charities_list)->with('order_donations',$order_donations);
    }else{
      Session::flash('error','Database error');
      return Redirect::back();
    }

  }
  public function orderCharityRedirect(){
      return Redirect::to('/');
  }
  public function buyItNow(Request $request,$cst_id=null){
      if($request->all()==null){
        $req=array('costume_id'=>$cst_id);
      }else{
        $req=$request->all();
      }
      if($cst_id==null){
        $costume_id=$req['costume_id'];
      }else{
        $costume_id=$cst_id;
      }
      $cookie_id=SiteHelper::currentCookieKey();
        $cart_id=Cart::verifyCostumeCart( $costume_id,$cookie_id);
        if($cart_id){
          $qty=Cart::verifyCostumeCartQuantity( $costume_id,$cookie_id);
          $res=Cart::verifyCostumeQuantity( $costume_id,$qty);
         if(count($res)){
            Cart::updateCartDetails( $costume_id,$cart_id,$qty+1);
            $res=$this->updateCartDetails( $costume_id,$qty+1);
            return Redirect::to('/checkout');
          }else{
            return Redirect::back();
          }
        }
        else{
             $cookie_id=$this->currentCookieKey();
             $costume_id= $costume_id;
             $qty=Cart::verifyCostumeCartQuantity($costume_id,$cookie_id);
             $res=Cart::verifyCostumeQuantity($costume_id,$qty);
             if(count($res)){
               $product[$cookie_id][]=array($costume_id=>$qty);
               Cart::addToCart($req,$cookie_id,$qty);
               $reslt=$this->productsAddToCookie($product);
               return Redirect::to('/checkout');
           }
           else{
                  return Redirect::back();
         }
        }
      }
	  private function getCookieAllProducts(){
        $cookie = cookie::get('min-cart');
        return $cookie;

    }
    private function productsAddToCookie($product){
 
       $cookie=cookie('min-cart',$product, 5*60);
       return $cookie;

    }
    private function updateCartDetails($costume_id,$qnty){
      $cart_list=$this->getCookieAllProducts();
      $cookie_id=$this->currentCookieKey();
      $cart_list[$cookie_id][$costume_id]=$qnty;
      $res=$this->productsAddToCookie($cart_list);
      return $res;

    }
    private function cookieKeyGenarater(){
        $key=str_random(64);
        return $key;
    }
    private function verifieCookie(){
        $res=$this->getCookieAllProducts();
        if($res!=null){
            return true;
        }else{
            return false;
        }
    }
    private function currentCookieKey(){
        $cookie=cookie::get('min-cart');
        if(is_array($cookie)){
          return key($cookie);
        }else{
          return $this->cookieKeyGenarater();
        }
    }
}

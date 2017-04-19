<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use Session;
use Hash;
use Response;
use App\Cart;
use Cookie;
class CartController extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
	}
	public function addToCart(Request $request){
		$req=$request->all();
		dd($this->getCookieAllProducts());
		//Cart::addToCart($req);
		$verify=$this->verifieCookie();
             if($verify){
             	$result=$this->getCookieAllProducts();
             	// foreach($result as $value){
             	// 	print_r($value);
             	// }
             	$result=$req['costume_id'];
                 return response('')->cookie($this->productsAddToCookie($result));
             
             }else{
               $product[$this->cookieKeyGenarater()]=$req['costume_id'];
               $res=$this->productsAddToCookie($product);
               return response('')->cookie($res);
             }
		
	}
	
    private function verifyCookie($cookie_id){
        dd($cookie_id);

    }
    private function getCookieAllProducts(){
        $cookie = cookie::get('min-cart');
        return $cookie;

    }
    private function productsAddToCookie($product){
 
       $cookie=cookie('min-cart',$product, 5*60);
       return $cookie;

    }
    private function productsUpdateToCookie(){
      $cart_list=$this->getCookieAllProducts();
      foreach ($cart_list as $key => $value) {
        echo $value;
      }
      return true;

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
        return key($cookie);
    }
}

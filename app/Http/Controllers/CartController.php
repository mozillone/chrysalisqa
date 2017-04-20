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
		//Cart::addToCart($req);
		$verify=$this->verifieCookie();
             if($verify){
             	$result=$this->getCookieAllProducts();
             	//dd($result);
             	 foreach($result as $value){
             	 	$costume_id=$req['costume_id'];
             	 	$cookie_id=$this->currentCookieKey();
             	 	$cart_id=Cart::verifyCostumeCart($costume_id,$cookie_id);
             	 	if($cart_id){
             	 		$qty=Cart::verifyCostumeCartQuantity($costume_id,$cookie_id);
             	 		$res=Cart::verifyCostumeQuantity($costume_id,$qty);
             	 		if(count($res)){
	             	 		Cart::updateCartDetails($costume_id,$cart_id,$qty+1);
	             	 		$res=$this->updateCartDetails($costume_id,$qty+1);
	             	 		return response('')->cookie($res);
             	 		}else{
	             	 		return response('out of stock');

             	 		}
             	 	}else{
             	 		 $cookie_id=$this->currentCookieKey();
			             $costume_id=$req['costume_id'];
			             $qty=Cart::verifyCostumeCartQuantity($costume_id,$cookie_id);
			             $res=Cart::verifyCostumeQuantity($costume_id,$qty);
             	 		 if(count($res)){
				             $product[$cookie_id][]=array($req['costume_id']=>$qty);
				             Cart::addToCart($req,$cookie_id,$qty);
				             $reslt=$this->productsAddToCookie($product);
				             return response('')->cookie($reslt);
				         }else{
				         	return response('out of stock');
				         }
             	 	}
            	 }
            	
		
                
             }else{
               $cookie_id=$this->cookieKeyGenarater();
               $costume_id=$req['costume_id'];
               $qty=Cart::verifyCostumeCartQuantity($costume_id,$cookie_id);
               $product[$cookie_id]=array($req['costume_id']=>$qty);
               Cart::addToCart($req,$cookie_id,$qty);
               $res=$this->productsAddToCookie($product);
               return response('')->cookie($res);
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
        return key($cookie);
    }
}

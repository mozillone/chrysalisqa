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
use App\Promotions;
use Cookie;
class CartController extends Controller {

  protected $messageBag = null;
  protected $auth;
  
  public function __construct(Guard $auth)
  {
    $this->sitehelper = new SiteHelper();
  }
  public function cart(Request $request){
    $req=$request->all();
    if(count($req)){
      $res=Promotions::verifyCoupanCode($req['coupan_code']);
      if(!$res){
         Session::flash('error','The coupan code is not invalid.');
         return Redirect::back();
      }else{
        $data=Cart::getCartProductswithCoupan($req['coupan_code']);
        dd("testing");
      }
    }else{
      $data=Cart::getCartProducts();
    }
    return view('frontend.costumes.cart.cart_list',compact('data',$data));
  }
  public function addToCart(Request $request){
    $req=$request->all();
    $verify=$this->verifieCookie();
             if($verify){
              $result=$this->getCookieAllProducts();
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
                    $count=Cart::getCartCount();
                    return response($count)->cookie($res);
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
                     $count=Cart::getCartCount();
                     return response($count)->cookie($reslt);
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
               $reslt=$this->productsAddToCookie($product);
               $count=Cart::getCartCount();
               return response($count)->cookie($res);
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
    public function updateCart(Request $request){
        $req=$request->all();
        $verify=Cart::verifyCostumeQuantity($req['costume_id'],$req['qty']);
        if(count($verify)){
          Cart::updateCartDetails($req['costume_id'],$req['cart_id'],$req['qty']);
        }else{
          Session::flash('error','The requested quantity for \'"'.$req['costume_name'].'"\' is not available.');
        }
        return Redirect::to('cart');
    }
    public function productRemoveFromCart($cart_item_id,$cart_id){
      Cart::productRemoveFromCart($cart_item_id,$cart_id);
      return Redirect::back();
    }
    public function getMiniCartProducts(){
      $cart_list=Cart::getCartProducts();
      return Response::JSON($cart_list);
    }
}

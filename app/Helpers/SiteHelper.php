<?php namespace App\Helpers;
use Session;
use Redirect;
use App\Helpers\Site_model;
use Auth;
use App\Wishlist;
use App\Category;
use App\Cart;
use App\Address;
use Cookie;
use Usps\Rate;
use Usps\RatePackage;
use Config;

class SiteHelper  {

	public static function getMenus(){
		$categories_list=[];
		$cond=array("parent_id"=>"0");
		$getTopCategoriesList=Site_model::Fetch_data('category','*',$cond);
		foreach($getTopCategoriesList as $menus){
			$cond=array('parent_id'=>$menus->category_id);
			$getSubCategories=Site_model::Fetch_data('category','*',$cond);
			$categories_list[$menus->name][]="None";
			foreach ($getSubCategories as $subCat) {
				$link=Category::getUrlLinks($subCat->category_id);
				$categories_list[$menus->name][]=$link.'_'.$subCat->name;
				//$categories_list[$menus->name][]=$subCat->category_id.'_'.$subCat->name;
			}
			
		}
		return $categories_list;
	}
	public static function getMyWishlistCount(){
		$count=Wishlist::getMyWishlistCount(Auth::user()->id)[0]->count;
		return $count;
	}
	public static function generate_image_thumbnail($source_image_path, $thumbnail_image_path,$thumbnail_with,$thumbnail_height) {
   	//dd($source_image_path);
		list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
		switch ($source_image_type) {
			case IMAGETYPE_GIF :
				$source_gd_image = imagecreatefromgif($source_image_path);
				break;
			case IMAGETYPE_JPEG :
				$source_gd_image = imagecreatefromjpeg($source_image_path);
				break;
			case IMAGETYPE_PNG :
				$source_gd_image = imagecreatefrompng($source_image_path);
				break;
		}
		if ($source_gd_image === false) {
			return false;
		}
		$source_aspect_ratio = $source_image_width / $source_image_height;
		$thumbnail_aspect_ratio = $thumbnail_with / $thumbnail_height;
		if ($source_image_width <= $thumbnail_with && $source_image_height <= $thumbnail_height) {
			$thumbnail_image_width = $source_image_width;
			$thumbnail_image_height = $source_image_height;
		} elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
			$thumbnail_image_width = (int)($thumbnail_with * $source_aspect_ratio);
			$thumbnail_image_height = $thumbnail_height;
		} else {
			$thumbnail_image_width = $thumbnail_with;
			$thumbnail_image_height = (int)($thumbnail_height / $source_aspect_ratio);
		}
		$thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
		imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
		imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 95);
		imagedestroy($source_gd_image);
		imagedestroy($thumbnail_gd_image);
		return true;
	}
	public static function getCartCount(){
		$cookie=cookie::get('min-cart');
        if(is_array($cookie)){
        	$cookie_id=key($cookie);
        }else{
        	$cookie_id=0;
        }
		$count=Cart::getCartCount($cookie_id);
		return $count;
	}
	public static function currentCookieKey(){
        $cookie=cookie::get('min-cart');
        if(is_array($cookie)){
        	return key($cookie);
        }else{
        	return 0;
        }
    }
    public static function getCartProducts(){
        $cookie=cookie::get('min-cart');
        if(is_array($cookie)){
        	return key($cookie);
        }else{
        	return 0;
        }
    }
	public static function getMiniCartProducts(){
		$cart_products=Cart::getMiniCartProducts();
		return $cart_products;
	}
	public static function getCartSubtotalPrice(){
		$SubtotalPrice=Cart::getCartSubtotalPrice();
		return $SubtotalPrice;
	}
	public static function verifyCostumeQuantity($costume_id){
		if(cookie::get('min-cart')!=null){
			$cookie_id=key(cookie::get('min-cart'));
			$qty=Cart::verifyCostumeCartQuantity($costume_id,$cookie_id);
			$res=Cart::verifyCostumeQuantity($costume_id,$qty);
			if($res){
	        	return true;
	        }else{
	        	return false;
	        }
    	}else{
    			return true;
    	}
	}
	public static function userCartShippingAddress($cart_id){
		$address=Address::userCartShippingAddress($cart_id);
		return $address;
	}
	public static function domesticRate($originationZip,$cart_id)
	{	
			
			 $destinationZipCode=Address::userCartShippingAddress($cart_id);
			 $rate = new Rate(Config::get('constants.USPS'));
			 $package = new RatePackage;
			 $package->setService(RatePackage::SERVICE_EXPRESS);
			 $package->setZipOrigination(62858); //62858 originationZip
			 $package->setZipDestination(62858); //destinationZipCode
			 $package->setPounds(30);
			 $package->setOunces(0);
			 $package->setContainer('');
			 $package->setSize(RatePackage::SIZE_REGULAR);
			 $package->setField('Machinable', true);

			 $rate->addPackage($package);
			 $rate->getRate();
			 $rate->getArrayResponse();
			 
			 if ($rate->isSuccess()) {
   				$res=$rate->getArrayResponse();
   				$est=explode('-',filter_var($res['RateV4Response']['Package']['Postage']['MailService'], FILTER_SANITIZE_NUMBER_INT));
   				$data['rate']=$res['RateV4Response']['Package']['Postage']['Rate'];
   				$data['MailService']=$est[0];
   				$res=array('result'=>1,'msg'=>$data);
    			return $res;
			 } else {
			 	$res=array('result'=>0,'msg'=>'Error:' . $rate->getErrorMessage());
				return $res;
    		 }
	
	}
	
}

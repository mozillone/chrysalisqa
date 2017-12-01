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
use DateTime;
use DB;
use Mail;
class SiteHelper  {

	public static function getMenus(){
		$categories_list=[];
		$cond=array("parent_id"=>"0");
		$getTopCategoriesList=DB::table('category')
                              ->orderBy('sort_order','ASC')
                              ->orderBy('category_id','ASC') 
                              ->where('parent_id',$cond)
                              ->get();  

        //$getTopCategoriesList=Site_model::Fetch_data('category','*',$cond);
		foreach($getTopCategoriesList as $menus){

			$cond=array('parent_id'=>$menus->category_id,'status'=>1);


            $getSubCategories=DB::table('category')
                              ->orderBy('sort_order','ASC')
                              ->orderBy('category_id','ASC') 
                              ->where('parent_id',$cond)
                              ->get();


			//$getSubCategories = Site_model::Fetch_data('category','*',$cond);
			$categories_list[$menus->name][]="None";
            $catids = array();
            $subcat_names = array();
			foreach ($getSubCategories as $subCat) {
                $catids[] = $subCat->category_id;
				$subcat_names[]  = $subCat->name;
				//$categories_list[$menus->name][]=$subCat->category_id.'_'.$subCat->name;
			}
            $cat_ids_implode = implode(",", $catids);
            
            $links =Category::getUrlLinksMulti($cat_ids_implode);
            
            $uTemp = 0;
            foreach($links  as $link_name)
            {
                 $categories_list[$menus->name][]= $link_name.'_'.$subcat_names[$uTemp];  
                 $uTemp++;
            }
           
			
		}
	
		return $categories_list;
	}

    public static function getPromo(){
        $promo = DB::table('cms_blocks')
            ->where(array('cms_blocks.status'=>1,'cms_blocks.slug'=>'header'))
            ->first();
        return $promo;
    }

	public static function getSupportFaqs(){
        $faqs = DB::table('faqs')
            ->where(array('faqs.status'=>1,'faqs.block'=>'support-and-contact'))
            ->orderBy('faqs.sort_no','asc')
            ->get();
        return $faqs;
    }

	public static function getMyWishlistCount(){
		$count=Wishlist::getMyWishlistCount(Auth::user()->id)[0]->count;
		return $count;
	}
	public static function getMessagesCount(){
        $msgs_count = DB::Select('SELECT count(cnvs.id) as count_dt FROM cc_messages as msg LEFT JOIN `cc_conversations` as cnvs on msg.conversation_id=cnvs.id where msg.is_seen="0" AND (cnvs.user_two ='.Auth::user()->id.' OR cnvs.user_one = '.Auth::user()->id.') and msg.user_id != '.Auth::user()->id.'');
		//$msgs_count[0]->count_dt;
		return $msgs_count[0]->count_dt;
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
	public static function domesticRate($originationZip,$cart_id,$service,$pounds="0",$ounces="0")
	{
	 $destinationZipCode=Address::userCartShippingAddress($cart_id);
//	dd($originationZip.' '.$destinationZipCode);
	$user_id=Config::get('constants.USPS');
    $rate_url=Config::get('constants.USPS_RATE_URL');
  //	$originationZip=$originationZip;
//	$destinationZipCode=$destinationZipCode;
//	$pounds="3";
//	$ounces="0";
	$container="Variable";
	$size="Regular";
	$width="0";
	$length="0";
	$height="0";
	$girth="0";

  $xml='<RateV4Request%20USERID="'.$user_id.'">%20<Revision>2</Revision>%20<Package%20ID="0">%20<Service>'.$service.'</Service>%20<FirstClassMailType></FirstClassMailType>%20<ZipOrigination>'.$originationZip.'</ZipOrigination>%20<ZipDestination>'.$destinationZipCode.'</ZipDestination>%20<Pounds>'.$pounds.'</Pounds>%20<Ounces>'.$ounces.'</Ounces>%20<Container>'.$container.'</Container>%20<Size>'.$size.'</Size>%20<Width>'.$width.'</Width>%20<Length>'.$length.'</Length>%20<Height>'.$height.'</Height>%20<Girth>'.$girth.'</Girth>%20<Machinable>TRUE</Machinable>%20</Package>%20</RateV4Request>';
//dd($xml);
         $ch = curl_init($rate_url.'&&XML='.($xml));
	  
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
	    curl_close($ch);
        $collection = new \Illuminate\Support\Collection(json_decode(json_encode(simplexml_load_string(self::removeNamespaceFromXML($output))), true));
		/// Mohan
//return 1;
	if(!isset($collection->toArray()['Number'])){
			if(!isset($collection->toArray()['Package']['Error'])){
        
        			$res=$collection->toArray();
        			$est=explode('-',filter_var($res['Package']['Postage']['MailService'], FILTER_SANITIZE_NUMBER_INT));
	  				$data['rate']=$res['Package']['Postage']['Rate'];
	  				$data['MailService']=$est[0];
  					$res=array('result'=>1,'msg'=>$data);
  					//echo "<pre>";print_r($res);
  		 			return $res;
    	 	}else{
    	 		 $res=array('result'=>0,'msg'=>'Error:' . $collection->toArray()['Package']['Error']['Description'],'error_code'=>$collection->toArray()['Package']['Error']['Number']);
    	 		    return $res;
    	 	}
        }else{
          $res=array('result'=>0,'msg'=>'Error:' . $collection->toArray()['Description'],'error_code'=>"");
         	return $res;
        }	

}
public static function domesticRateSingleCostume($originationZip,$destinationZipCode,$pounds,$ounces)
	{	 
   //dd($originationZip.' '.$destinationZipCode);	
    $user_id=Config::get('constants.USPS');
	$rate_url=Config::get('constants.USPS_RATE_URL');
	$originationZip=$originationZip;
	$destinationZipCode=$destinationZipCode;
//	$pounds="3";
//	$ounces="0";
	$container="Variable";
	$size="Regular";
	$width="0";
	$length="0";
	$height="0";
	$girth="0";
	$service="priority";

  $xml='<RateV4Request%20USERID="'.$user_id.'">%20<Revision>2</Revision>%20<Package%20ID="0">%20<Service>'.$service.'</Service>%20<FirstClassMailType></FirstClassMailType>%20<ZipOrigination>'.$originationZip.'</ZipOrigination>%20<ZipDestination>'.$destinationZipCode.'</ZipDestination>%20<Pounds>'.$pounds.'</Pounds>%20<Ounces>'.$ounces.'</Ounces>%20<Container>'.$container.'</Container>%20<Size>'.$size.'</Size>%20<Width>'.$width.'</Width>%20<Length>'.$length.'</Length>%20<Height>'.$height.'</Height>%20<Girth>'.$girth.'</Girth>%20<Machinable>TRUE</Machinable>%20</Package>%20</RateV4Request>';
//dd(($xml));
      $ch = curl_init($rate_url.'&&XML='.($xml));
	  
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
	    curl_close($ch);
        $collection = new \Illuminate\Support\Collection(json_decode(json_encode(simplexml_load_string(self::removeNamespaceFromXML($output))), true));
/// Mohan
//return 1;
    		if(!isset($collection->toArray()['Number'])){
			if(!isset($collection->toArray()['Package']['Error'])){
        
        			$res=$collection->toArray();
        			$est=explode('-',filter_var($res['Package']['Postage']['MailService'], FILTER_SANITIZE_NUMBER_INT));
	  				$data['rate']=$res['Package']['Postage']['Rate'];
	  				$data['MailService']=$est[0];
  					$res=array('result'=>1,'msg'=>$data);
  					//echo "<pre>";print_r($res);
  		 			return $res;
    	 	}else{
    	 		 $res=array('result'=>0,'msg'=>'Error:' . $collection->toArray()['Package']['Error']['Description'],'error_code'=>$collection->toArray()['Package']['Error']['Number']);
    	 		    return $res;
    	 	}
        }else{
          $res=array('result'=>0,'msg'=>'Error:' . $collection->toArray()['Description'],'error_code'=>"");
         	return $res;
        }	

}
	public static function removeNamespaceFromXML( $xml )
      {
        // Because I know all of the the namespaces that will possibly appear in 
        // in the XML string I can just hard code them and check for 
        // them to remove them
        $toRemove = ['rap', 'turss', 'crim', 'cred', 'j', 'rap-code', 'evic'];
        // This is part of a regex I will use to remove the namespace declaration from string
        $nameSpaceDefRegEx = '(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?';

        // Cycle through each namespace and remove it from the XML string
       foreach( $toRemove as $remove ) {
            // First remove the namespace from the opening of the tag
            $xml = str_replace('<' . $remove . ':', '<', $xml);
            // Now remove the namespace from the closing of the tag
            $xml = str_replace('</' . $remove . ':', '</', $xml);
            // This XML uses the name space with CommentText, so remove that too
            $xml = str_replace($remove . ':commentText', 'commentText', $xml);
            // Complete the pattern for RegEx to remove this namespace declaration
            $pattern = "/xmlns:{$remove}{$nameSpaceDefRegEx}/";
            // Remove the actual namespace declaration using the Pattern
            $xml = preg_replace($pattern, '', $xml, 1);
        }

        // Return sanitized and cleaned up XML with no namespaces
        return $xml;
    }

	public static function time_elapsed_string($datetime, $full = false) {
		date_default_timezone_set('America/New_York');
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

	public static function DateFormat($date){
		$format_date = date('m/d/Y h:i:s', strtotime($date));
    	return $format_date;
    }
    public static function getUserShippingAddress(){
		return Cart::getUserShippingAddress();
    }
    public static function getSellerShippingAddress($user_id){
		return Cart::getSellerShippingAddress($user_id);
    }

    public static function sendmail($to,$subject,$template,$mail_data){
        $contact_email = (string)$to;
        $mail_subject = (string)$subject;
        $mail_status    = Mail::send($template, $mail_data, function ($message)  use ($contact_email, $mail_subject)
        {
            $message->from('support@chrysaliscostumes.com', 'Chrysalis');
            $message->to($contact_email)->subject($mail_subject);
        });
        return $mail_status;
   }


    public static function sendEmail($to,$subject,$template,$mail_data){
        $contact_email = (string)$to;
        $mail_subject = (string)$subject;
        $mail_status    = Mail::send($template, $mail_data, function ($message)  use ($contact_email, $mail_subject)
        {
            $message->from('support@chrysaliscostumes.com', 'Chrysalis');
            $message->to($contact_email)->subject($mail_subject);
        });
        return $mail_status;
    }

     public static  function specialCharectorsRemove($string) {
            $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
            $string =str_replace(array('\'', '"'), '', $string); 
            $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
            return strtolower(trim($string, '-'));
    }

    public static function checkCostumeName($costume_name){
        $url_count = DB::table('url_rewrites')
            ->where(array('url_rewrites.url_key'=>$costume_name))
            ->count();
        return $url_count;
    }

    public static function getMyMessageCount()
    {
        //$message_count = DB::Select('SELECT count(cnvs.id) as count_dt FROM cc_messages as msg LEFT JOIN `cc_conversations` as cnvs on msg.conversation_id=cnvs.id where msg.is_seen="0" AND (cnvs.user_two ='.Auth::user()->id.') and msg.user_id != '.Auth::user()->id.'');
        /*$message_count = DB::Select('SELECT count(cnvs.id) as count_dt FROM cc_messages as msg LEFT JOIN `cc_conversations` as cnvs on msg.conversation_id=cnvs.id where msg.is_seen="0" AND (cnvs.user_two ='.Auth::user()->id.' OR cnvs.user_one = 1) and msg.user_id != '.Auth::user()->id.'');*/
        $message_count = DB::Select('SELECT count(cnvs.id) as count_dt FROM cc_messages as msg LEFT JOIN `cc_conversations` as cnvs on msg.conversation_id=cnvs.id where msg.is_seen="0" AND (cnvs.user_two ='.Auth::user()->id.') and msg.user_id != '.Auth::user()->id.'');
        return $message_count[0]->count_dt;
    }   
	
}

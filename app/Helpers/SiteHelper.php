<?php namespace App\Helpers;
use Session;
use Redirect;
use App\Helpers\Site_model;
use Auth;
class SiteHelper  {

	public static function hasPermission($permissions){
        $count=0;
        $userPermssions=Site_model::userPermissions(Auth::user()->id);
        if(!empty($userPermssions)){
        for($i=0;$i<count($permissions);$i++){
            foreach($userPermssions as $data){
                
                if($data->slug==$permissions[$i]){
                    $count++;
                }
            }
        }
        if($count>=1){
            return true;
        }
        else{
            return false;    
        }
    }
    else{
        return false;
    }
    }

     public static function restrictPermission($permisions)
    {
        $count=0;
        $userPermsiosn=Site_model::userPermissions(Auth::user()->id);
            for($i=0;$i<count($permisions);$i++){
            foreach($userPermsiosn as $data){
                if($data->slug==$permisions[$i]){
                    $count++;
                }
            }
        }
        if(!$count>=1){
            Session::flash('error', 'You don \'t have permission to access this page');
            return Redirect::to('/home')->send();
        }
        
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
	public static function getLatitudeValue($address)
	{
		$address = urlencode($address);
		$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
		
		$decoded = json_decode($json);
		if($decoded->status=="OK")
		{
			return array('lat'=>$decoded->results[0]->geometry->location->lat,'lng'=>$decoded->results[0]->geometry->location->lng);
		}
		else
		{
			return "No";
		}
	}
	
	
}

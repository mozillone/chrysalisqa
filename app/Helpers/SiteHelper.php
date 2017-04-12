<?php namespace App\Helpers;
use Session;
use Redirect;
use App\Helpers\Site_model;
use Auth;
use App\Wishlist;
use App\Category;
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

	
	
	
}

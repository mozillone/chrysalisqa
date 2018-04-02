<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Mail;
use URL;
use App\Helpers\Site_model;
use DB;
use Meta;
use Sitemap;
use Config;
use Log;

class HomePageController extends Controller {

	public function __construct()
	{
		//Meta::title('Chrysalis');
    	Meta::set('robots', 'index,follow');
	}
	public function index()
	{
		$insta = array();
		
		Meta::set('title', "Chrysalis - The Costume Enthusiast's Marketplace");
        Meta::set('description', 'Affordable, Environment Friendly Costumes. Buy and Sell Costumes online.');
		$featured_costumes = DB::table('costumes')
		->leftJoin('costume_description','costumes.costume_id','costume_description.costume_id')
		->leftJoin('costume_image','costumes.costume_id','costume_image.costume_id')
		->leftJoin('costume_attribute_options as cao','costumes.costume_id','cao.costume_id')
		->leftJoin('url_rewrites', function($join)
                         {
                             $join->on('url_rewrites.url_offset', '=', 'costumes.costume_id');
                         })
		->where('costumes.is_featured',"1")
		->where('costume_image.type',"1")
		->where('url_rewrites.type','product')
		->where('cao.attribute_id','21')
		->where('url_rewrites.id','=',DB::Raw('(select id from cc_url_rewrites where url_offset=cc_costumes.costume_id  order by id desc limit 0,1)'))
		->select('costume_description.name as cos_name','costumes.created_user_group','costumes.price as cos_price','costume_image.image as cos_image','url_rewrites.url_key as url','costumes.created_by as created_by','cao.attribute_option_value_id as film_qlty')
		->groupBy('costumes.costume_id')
		->orderBy('costumes.is_featured_date',"DESC")
		->take(20)->get();

        $pageData = DB::table('cms_blocks')->where(array('cms_blocks.slug'=>'home','cms_blocks.status'=>1))->first();

        $access_token = Config::get('constants.INSTAGRAM_ACCESS_TOKEN');
		$username = Config::get('constants.INSTAGRAM_USERNAME');
		$insta_cnt = 6;
		try{
			$user_search = self::instagramApiCurlConnect("https://api.instagram.com/v1/users/search?q=" . $username . "&access_token=" . $access_token);
			$user_id = $user_search->data[0]->id; 
			$return = self::instagramApiCurlConnect("https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $access_token);

			/* Accesing Images & Links from instagram */
			$i=0;
			foreach ($return->data as $post) {
				if($i == 0){
					$insta[$i]['image'] = $post->images->standard_resolution->url;
					$insta[$i]['link'] = $post->link;
				}else{
					$insta[$i]['image'] = $post->images->thumbnail->url;
					$insta[$i]['link'] = $post->link;	
				}
				if($i == 6){
					break;
				}else{
					$i++;
				}
			}
			$insta_cnt = 7-count($insta);	
		}catch(\Exception $e){
			Log::info('instagram Exception');
			Log::info($e->getMessage());
		}
		
        if (!empty($pageData)){
            return view('frontend.index')->with(array('featured_costumes'=>$featured_costumes,'pageData'=>$pageData, 'insta'=>$insta, 'insta_cnt' =>$insta_cnt));
        }else{
            return view('frontend.index')->with(array('featured_costumes'=>$featured_costumes));
        }
	}

	/**
	 * Connecting Instagram through API for pulling the recently uploaded costumes in Instagram
	 * @param  [url] $api_url [API url with username & accesstoken for that user]
	 * @return [json] [User posted feed response]
	 */
	private function instagramApiCurlConnect( $api_url ){
		$connection_c = curl_init(); // initializing
		curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
		curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
		curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
		$json_return = curl_exec( $connection_c ); // connect and get json data
		curl_close( $connection_c ); // close connection
		return json_decode( $json_return ); // decode and return
	}	
}

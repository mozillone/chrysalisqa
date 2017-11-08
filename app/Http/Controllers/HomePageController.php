<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Mail;
use URL;
use App\Helpers\Site_model;
use DB;
use Meta;
use Sitemap;


class HomePageController extends Controller {

	public function __construct()
	{
		Meta::title('Chrysalis');
    	Meta::set('robots', 'index,follow');
	}
	public function index()
	{
		/*$activation_link=URL::to('/').'/password/change/';
				 		$data['name']="hai";
						$data['activation_link']=$activation_link;
						$email= "";
						$sent=Mail::send('emails.registration',array("email"=>$data), function ($m) use($email){
							$m->to("mohan@dotcomweavers.com", "Mruduramai");
						    $m->subject('Forgot Password');

						});*/
		Meta::set('title', 'Home');
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
		->select('costume_description.name as cos_name','costumes.created_user_group','costumes.price as cos_price','costume_image.image as cos_image','url_rewrites.url_key as url','costumes.created_by as created_by','cao.attribute_option_value_id as film_qlty')
		->groupBy('costumes.costume_id')
		->orderBy('costumes.is_featured_date',"DESC")
		->take(20)->get();

		
		//echo "<pre>";print_r($featured_costumes);die;
        $pageData = DB::table('cms_blocks')->where(array('cms_blocks.slug'=>'home','cms_blocks.status'=>1))->first();
        if (!empty($pageData)){
            return view('frontend.index')->with(array('featured_costumes'=>$featured_costumes,'pageData'=>$pageData));
        }else{
            return view('frontend.index')->with(array('featured_costumes'=>$featured_costumes));
        }

	}
	
}

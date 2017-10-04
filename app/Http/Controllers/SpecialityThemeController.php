<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use App\Costumes;
use App\Category;
use Session;
use Hash;
use DB;
use Response;
use Meta;
class SpecialityThemeController extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
        Meta::title('Chrysalis');
        Meta::set('robots', 'index,follow');
		
	}
	/*****Speciality theme index page code starts here****/
	public function specialityTheme(){
        Meta::set('title', 'Speciality Themes');
        Meta::set('description', 'Speciality Themes');
		$cosplaycategories=DB::table('category')
		->select('category_id as categoryid','name as name','thumb_image as image','updated_at')
		->wherein('category_id',array('147','78','143'))
		->orderBy('speciality_theme','ASC')
		->orderBy('updated_at','DESC')
		->get();
		
		
		$cosplay=DB::table('category')->select('category_id as categoryid','name as name','thumb_image as image')->where('category_id',147)->first();

		$uniquefashion=DB::table('category')->select('category_id as categoryid','name as name','thumb_image as image')->where('category_id',143)->first();
		$film_theatre=DB::table('category')
		->select('category_id as categoryid','name as name','thumb_image as image')->where('category_id',78)->first();
		$cosplay_subcategories=DB::table('category')
		->select('category.category_id as categoryid','category.name as name','category.thumb_image as image','url.type as type','url.url_offset as urloffest','url.url_key as urlkey')
		->leftJOin('url_rewrites as url','url.url_offset','category.category_id')
		->where('parent_id',147)->where('url.type',"=","category")->orderBy('category_id')->get();
		$uniquefashion_categories=DB::table('category')
		->select('category.category_id as categoryid','category.name as name','category.thumb_image as image','url.type as type','url.url_offset as urloffest','url.url_key as urlkey')
		->leftJOin('url_rewrites as url','url.url_offset','category.category_id')
		->where('parent_id',143)->where('url.type',"=","category")->orderBy('category_id')->get();
		//print_r($uniquefashion_categories);
		$filmtheatrecategories=DB::table('category')
		->select('category.category_id as categoryid','category.name as name','category.thumb_image as image','url.type as type','url.url_offset as urloffest','url.url_key as urlkey')
		->leftJOin('url_rewrites as url','url.url_offset','category.category_id')
		->where('parent_id',78)->where('url.type',"=","category")->orderBy('category_id')->get();
		//print_r($filmtheatrecategories);
		//dd($cosplay_subcategories);
		return view('frontend.specalitythemes.specialitytheme',compact('cosplaycategories','cosplay_subcategories','uniquefashion_categories','filmtheatrecategories','cosplay','uniquefashion','film_theatre'));
	}
}
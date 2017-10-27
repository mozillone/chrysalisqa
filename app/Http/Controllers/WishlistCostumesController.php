<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use App\Wishlist;
use Session;
use DB;
use Response;
use Meta;
class WishlistCostumesController extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
		 $this->middleware(function ($request, $next) {
          if(!Auth::check()){
            return Redirect::to('/login')->send();
          }
          else{
               return $next($request);
          }
      });

        Meta::title('Chrysalis');
        Meta::set('robots', 'index,follow');
	}
	public function myWishlistList()
	{
        Meta::set('title', 'Favorites');
        Meta::set('description', 'Favorites - Chrysalis');

		$data=Wishlist::myWishlistList(Auth::user()->id);
		//echo "<pre>"; print_r($data); exit;
		return view('frontend.costumes.wishlist.wishlist_list',compact('data',$data));
	}
	public function removeWishlistCostume($costume_id){
		$data=Wishlist::removeWishlistCostume(Auth::user()->id,$costume_id);
		if($data){
			Session::flash('success', 'Costume is removed from your wishlist.');
		}else{
			Session::flash('error', 'Costume is not removed from your wishlist.Due to DB error');
		}
        return Redirect::back();
	}
	
}

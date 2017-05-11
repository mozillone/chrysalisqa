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
class CostumesController extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
		
	}
	//public function costumeListings($sub_cat_id,$parent_cat_name)
	public function costumeListings($slug1,$slug2)
	{
		$key_url='/'.$slug1.'/'.$slug2;
		$cat_info=Category::getUrlCategoryId($key_url);
		if(count($cat_info)){
			$categories_list=[];
			$sub_cat_id=$cat_info[0]->url_offset;
			$data['sub_cat_info']=Costumes::getCategoryInfo($sub_cat_id);
			$parent_cat_id=$data['sub_cat_info'][0]->parent_id;
			$sub_cats_list=Costumes::getParentCategories($parent_cat_id);
			$categories_list[$sub_cats_list[0]->name][]="None";
			foreach ($sub_cats_list as $subCat) {
				$link=Category::getUrlLinks($subCat->category_id);
				$categories_list[$subCat->name]=$link;
			}
			return view('frontend.costumes.costumes_list',compact('data',$data))->with('parent_cat_name',$slug1)->with('categories_list',$categories_list);
		}
		else{
			return view('frontend.404');
			
		}
	}
	public function getCostumesData(Request $request)
	{
		$req=$request->all();
		$where='where cat.category_id='.$req['cat_id'].'';
		$order_by='order by cst.created_at ASC';

		if(!empty($req['search'])){
			if(!empty($req['search']['gender'])){
				$where.=' AND  cst.gender="'.$req['search']['gender'].'"';
			}
			if(!empty($req['search']['created_user_group']) ){
				$cond='"'.implode('","', $req['search']['created_user_group']).'"';
				$where.=' AND cst.created_user_group in('.$cond.')';
			}
			if(!empty($req['search']['zip_code'])){
				$where.=' AND  cst.item_location="'.$req['search']['zip_code'].'"';
			}
			if(!empty($req['search']['condition'])){
				$cond='"'.implode('","', $req['search']['condition']).'"';
				$where.=' AND cst.condition in('.$cond.')';
			}
			if(!empty($req['search']['price'])){
				$cond=explode("-",$req['search']['price']);
				$where.=' AND cst.price between '.$cond[0].' and '.$cond[1].'';
				$order_by='order by cst.price ASC';
			}
			if(!empty($req['search']['sizes'])){
				$where.=' AND cst.size in('.$req['search']['sizes'].')';
			}
			if(!empty($req['search']['sort_by'])){
				if($req['search']['sort_by']=="price_high"){
					$order_by='order by cst.price DESC';
				}
				if($req['search']['sort_by']=="price_low"){
					$order_by=' order by cst.price ASC';
				}
				if($req['search']['sort_by']=="a-z"){
					$order_by=' order by dsr.name ASC';
				}
				if($req['search']['sort_by']=="z-a"){
					$order_by=' order by dsr.name DESC';
				}
			}
		}
		// $costumes = DB::select('SELECT  cst.costume_id,dsr.name,cst.price as price,if((select count(*) from cc_costumes_like as likes where likes.user_id=cst.created_by and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id=cst.created_by and  wsh_lst.	costume_id=cst.costume_id )>=1,true,false) as is_fav,(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,img.image,cst.created_user_group,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer,link.url_key FROM `cc_costumes` as cst LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id  LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.sort_order="0" LEFT JOIN cc_coupon_costumes as cst_cupn on cst_cupn.costume_id=cst.costume_id LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id RIGHT JOIN  cc_promotion_coupon as prom on prom.coupon_id=cst_cupn.coupon_id LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id and link.type="product" '.$where.' group by cst.costume_id '.$order_by.' ');
		if(Auth::check()){
		$is_login=',if((select count(*) from cc_costumes_like as likes where likes.user_id='.Auth::user()->id.' and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id='.Auth::user()->id.'  and  wsh_lst.costume_id=cst.costume_id )>=1,true,false) as is_fav';
		}else{
			$is_login=' ';
		}
		$costumes = DB::select('SELECT cst.costume_id,dsr.name,FORMAT(cst.price,2) as price'.$is_login.',(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,img.image,cst.created_user_group,cst.quantity,link.url_key,created_user_group,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer FROM `cc_costumes` as cst LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id  LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.type="1"  LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id and link.type="product" LEFT JOIN cc_coupon_category as cpn_cat on cpn_cat.category_id=cat.category_id LEFT JOIN cc_promotion_coupon as prom on prom.coupon_id=cpn_cat.coupon_id and prom.code="" LEFT JOIN cc_coupon_costumes as cpn_cst on cpn_cst.costume_id=cst.costume_id '.$where.' group by cst.costume_id '.$order_by.' ');
		return response()->success(compact('costumes'));
	}
	public function costumeSingleView($slug1=null,$slug2=null,$slug3=null)
	{
		$key_url='/'.$slug1.'/'.$slug2.'/'.$slug3;
		$cat_info=Category::getUrlCategoryId($key_url);
		if(count($cat_info)){
			$costume_id=$cat_info[0]->url_offset;
			$data=Costumes::getCostumeDetails($costume_id);
			if(count($data)){
				$data['random_costumes']=Costumes::getRandomCategoyCostumesList($data[0]->category_id);
				$data['images']=Costumes::getCostumeImages($costume_id);
				$data['seller_info']=Costumes::costumeSellerInfo($data[0]->created_by);
				return view('frontend.costumes.costumes_single_view',compact('data',$data))->with('parent_cat_name',$slug1)->with('sub_cat_name',$slug2);
			}else{
		     	return view('frontend.404');
			}
		}
		else{
			return view('frontend.404');
			
		}
		
	}
	public function costumeLike(Request $request){
		$req=$request->all();
		$res=Costumes::costumeLike($req['costume_id'],Auth::user()->id);
		return Response::JSON($res);
	}
	public function costumeFavourite(Request $request){
		$req=$request->all();
		$res=Costumes::costumeFavourite($req['costume_id'],Auth::user()->id);
		return Response::JSON($res);
	}
	public function costumeReport(Request $request){
		$req=$request->all();
		$res=Costumes::costumeReport($req);
		Session::flash('success', 'Your report is sent to admin.');
        return Redirect::back();

	}
	
}

<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use App\Costumes;
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
	public function costumeListings($sub_cat_id,$parent_cat_name)
	{
		$data['sub_cat_info']=Costumes::getCategoryInfo($sub_cat_id);
		$parent_cat_id=$data['sub_cat_info'][0]->parent_id;
		$data['sub_cats_list']=Costumes::getParentCategories($parent_cat_id);
		return view('frontend.costumes.costumes_list',compact('data',$data))->with('parent_cat_name',$parent_cat_name);
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
					$order_by=' order by cst.name ASC';
				}
				if($req['search']['sort_by']=="z-a"){
					$order_by=' order by cst.name DESC';
				}
			}
		}
		$costumes = DB::select('SELECT  cst.costume_id,cst.name,CONCAT("$",FORMAT(cst.price,2)) as price,if((select count(*) from cc_costumes_like as likes where likes.user_id=cst.created_by and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id=cst.created_by and  wsh_lst.	costume_id=cst.costume_id )>=1,true,false) as is_fav,(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,img.image FROM `cc_costumes` as cst LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id  LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.sort_order="0"'.$where.' '.$order_by.'');
		return response()->success(compact('costumes'));
	}
	public function costumeSingleView($costume_id,$parent_cat_name)
	{
		$data=Costumes::getCostumeDetails($costume_id);
		if(count($data)){
			$data['random_costumes']=Costumes::getRandomCategoyCostumesList($data[0]->category_id);
			$data['images']=Costumes::getCostumeImages($costume_id);
			$data['seller_info']=Costumes::costumeSellerInfo($data[0]->created_by);
			return view('frontend.costumes.costumes_single_view',compact('data',$data))->with('parent_cat_name',$parent_cat_name);
		}else{
	      Session::flash('error', 'Costume information not found..');
          return Redirect::back();
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
}

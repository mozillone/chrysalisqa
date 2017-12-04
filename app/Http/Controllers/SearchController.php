<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
//use Illuminate\Http\Request;
use App\Search;
use Session;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use URL;
use App\Exceptions\Handler;
use Request; 


class SearchController extends Controller {

	
	public function search(Request $request)
	{
	    $req=Request::all();
        $pageData = '';
        $search_banner_settings = DB::table('search_banner_settings')->first();
      
        $req=Request::all();
		$where='where (MATCH (dsr.name,dsr.description) AGAINST ("'.$req['key'].'") or dsr.name  LIKE "%'.$req['key'].'%" or dsr.description LIKE "%'.$req['key'].'%" or cst.condition LIKE "%'.$req['key'].'%" or gender LIKE "%'.$req['key'].'%" or dsr.keywords LIKE "%'.$req['key'].'%" or cst.price LIKE "%'.$req['key'].'%")';
		$order_by='order by cst.created_at ASC';
                
        $where.=' AND cst.deleted_status=0 AND cao.attribute_id=21  AND cst.status="active"';
                
		if(!empty($req['search'])){
			if(!empty($req['search']['gender'])){
				$where.=' AND  cst.gender="'.$req['search']['gender'].'"';
			}
			if(!empty($req['search']['created_user_group']) ){
				$cond='"'.implode('","', $req['search']['created_user_group']).'"';
				$where.=' AND cst.created_user_group in('.$cond.')';
			}
			if(!empty($req['search']['zip_code'])){
				$where.=' AND  adder.zip_code="'.$req['search']['zip_code'].'"';
			}
			if(!empty($req['search']['zip_code_mbl'])){
				$where.=' AND  adder.zip_code="'.$req['search']['zip_code_mbl'].'"';
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
			if(!empty($req['search']['price_mbl'])){
				$cond=explode("-",$req['search']['price_mbl']);
				$where.=' AND cst.price between '.$cond[0].' and '.$cond[1].'';
				$order_by='order by cst.price ASC';
			}
			if(!empty($req['search']['sizes'])){
				$where.=' AND cst.size in('.$req['search']['sizes'].')';
			}
			if(!empty($req['search']['sort_by'])){
				if($req['search']['sort_by']=="recently_listed"){
					$order_by='order by cst.created_at DESC';
				}
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
			if(!empty($req['search']['mbl_sort'])){
				if($req['search']['mbl_sort']=="DESC"){
					$order_by='order by cst.price DESC';
				}
				if($req['search']['mbl_sort']=="ASC"){
					$order_by=' order by cst.price ASC';
				}
			}
		}
		if(Auth::check()){
		$is_login=',if((select count(*) from cc_costumes_like as likes where likes.user_id='.Auth::user()->id.' and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id='.Auth::user()->id.'  and  wsh_lst.costume_id=cst.costume_id )>=1,true,false) as is_fav';
		}else{
			$is_login=' ';
		}
			$costumes = DB::select('SELECT cst.costume_id,dsr.name,FORMAT(cst.price,2) as price'.$is_login.',(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,img.image,cst.created_user_group,cst.quantity,(select url_key from cc_url_rewrites where url_offset=cst.costume_id order by id desc limit 0,1) as url_key,created_user_group,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer, cao.attribute_option_value_id as film_qlty FROM `cc_costumes` as cst LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id  LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.type="1"  LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id and link.type="product" LEFT JOIN cc_coupon_category as cpn_cat on cpn_cat.category_id=cat.category_id LEFT JOIN cc_promotion_coupon as prom on prom.coupon_id=cpn_cat.coupon_id and prom.code="" LEFT JOIN cc_coupon_costumes as cpn_cst on cpn_cst.costume_id=cst.costume_id LEFT JOIN cc_address_master as adder on adder.user_id=cst.created_by and adder.address_type="selling" LEFT JOIN cc_costume_attribute_options as cao on cst.costume_id=cao.costume_id '.$where.' group by cst.costume_id '.$order_by.' ');
			
			    $total = count($costumes);
          
			    if(!empty($req['page']))
			    {
			        $page = $req['page'];
			    }
			    else
			    {
			         $page = 1;
			    }
				if(!empty($req['perpage']))
				{
					$paginate =  $req['perpage'];
					\Session::set('perpage', $paginate);
				}
				else
				{
					$paginate = (session('perpage')!==null) ? session('perpage') : 12;
				}
	         	$offSet = ($page * $paginate) - $paginate;
	         	$itemsForCurrentPage = array_slice($costumes, $offSet, $paginate, true);
	         	
	         	if(count($itemsForCurrentPage) == 0)
	         	{
	         	    $page = 1;
	         	    $offSet = ($page * $paginate) - $paginate;
	              	$itemsForCurrentPage = array_slice($costumes, $offSet, $paginate, true);
	         	}
         	$costumes = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($costumes), $paginate, $page);
  
		return view('frontend.search.costumes_list')->with('costumes',$costumes)->with('pageData',$pageData)->with('search_banner_settings',$search_banner_settings)->with('count',$total);
	}
	public function getSearchCostumesData(Request $request)
	{
	    
		$req=Request::all();
		$where='where (MATCH (dsr.name,dsr.description) AGAINST ("'.$req['key'].'") or dsr.name  LIKE "%'.$req['key'].'%" or dsr.description LIKE "%'.$req['key'].'%" or cst.condition LIKE "%'.$req['key'].'%" or gender LIKE "%'.$req['key'].'%" or dsr.keywords LIKE "%'.$req['key'].'%" or cst.price LIKE "%'.$req['key'].'%")';
		$order_by='order by cst.created_at ASC';
                
        $where.=' AND cst.deleted_status=0 AND cao.attribute_id=21  AND cst.status="active"';
                
		if(!empty($req['search'])){
			if(!empty($req['search']['gender'])){
				$where.=' AND  cst.gender="'.$req['search']['gender'].'"';
			}
			if(!empty($req['search']['created_user_group']) ){
				$cond='"'.implode('","', $req['search']['created_user_group']).'"';
				$where.=' AND cst.created_user_group in('.$cond.')';
			}
			if(!empty($req['search']['zip_code'])){
				$where.=' AND  adder.zip_code="'.$req['search']['zip_code'].'"';
			}
			if(!empty($req['search']['zip_code_mbl'])){
				$where.=' AND  adder.zip_code="'.$req['search']['zip_code_mbl'].'"';
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
			if(!empty($req['search']['price_mbl'])){
				$cond=explode("-",$req['search']['price_mbl']);
				$where.=' AND cst.price between '.$cond[0].' and '.$cond[1].'';
				$order_by='order by cst.price ASC';
			}
			if(!empty($req['search']['sizes'])){
				$where.=' AND cst.size in('.$req['search']['sizes'].')';
			}
			if(!empty($req['search']['sort_by'])){
				if($req['search']['sort_by']=="recently_listed"){
					$order_by='order by cst.created_at ASC';
				}
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
			if(!empty($req['search']['mbl_sort'])){
				if($req['search']['mbl_sort']=="DESC"){
					$order_by='order by cst.price DESC';
				}
				if($req['search']['mbl_sort']=="ASC"){
					$order_by=' order by cst.price ASC';
				}
			}
		}
		if(Auth::check()){
		$is_login=',if((select count(*) from cc_costumes_like as likes where likes.user_id='.Auth::user()->id.' and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id='.Auth::user()->id.'  and  wsh_lst.costume_id=cst.costume_id )>=1,true,false) as is_fav';
		}else{
			$is_login=' ';
		}
			$costumes = DB::select('SELECT cst.costume_id,dsr.name,FORMAT(cst.price,2) as price'.$is_login.',(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,img.image,cst.created_user_group,cst.quantity,(select url_key from cc_url_rewrites where url_offset=cst.costume_id order by id desc limit 0,1) as url_key,created_user_group,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer, cao.attribute_option_value_id as film_qlty FROM `cc_costumes` as cst LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id  LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.type="1"  LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id and link.type="product" LEFT JOIN cc_coupon_category as cpn_cat on cpn_cat.category_id=cat.category_id LEFT JOIN cc_promotion_coupon as prom on prom.coupon_id=cpn_cat.coupon_id and prom.code="" LEFT JOIN cc_coupon_costumes as cpn_cst on cpn_cst.costume_id=cst.costume_id LEFT JOIN cc_address_master as adder on adder.user_id=cst.created_by and adder.address_type="selling" LEFT JOIN cc_costume_attribute_options as cao on cst.costume_id=cao.costume_id '.$where.' group by cst.costume_id '.$order_by.' ');
			
			     $total = count($costumes);
			     
			    if(!empty($req['page']))
			    {
			        $page = $req['page'];
			    }
			    else
			    {
			         $page = 1;
			    }
				if(!empty($req['perpage']))
				{
					$paginate =  $req['perpage'];
					\Session::set('perpage', $paginate);
				}
				else
				{
					$paginate = (session('perpage')!==null) ? session('perpage') : 12;
				}
	         	$offSet = ($page * $paginate) - $paginate;
	         	$itemsForCurrentPage = array_slice($costumes, $offSet, $paginate, true);
	         	
	         	if(count($itemsForCurrentPage) == 0)
	         	{
	         	    $page = 1;
	         	    $offSet = ($page * $paginate) - $paginate;
	              	$itemsForCurrentPage = array_slice($costumes, $offSet, $paginate, true);
	         	}
	         	$costumes = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($costumes), $paginate, $page);
	         	
	            //$costumes = $costumes->setPath(Request::url());
	            
	          	$view = view('frontend.costumes.filter-costumes')->with('costumes',$costumes)->with('count',$total)->render();
	         	return response()->json($view, 200);
	         	
	}
	
	
}

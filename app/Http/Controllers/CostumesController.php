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
class CostumesController extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
	
	}
	public function costumeListings($sub_cat_id)
	{
		$data['sub_cat_info']=Costumes::getCategoryInfo($sub_cat_id);
		$parent_cat_id=$data['sub_cat_info'][0]->parent_id;
		$parent_cat_name=$data['sub_cat_info'][0]->name;
		$data['sub_cats_list']=Costumes::getParentCategories($parent_cat_id);
		return view('frontend.costumes.costumes_list',compact('data',$data))->with('parent_cat_name',$parent_cat_name);
	}
	public function getCostumesData(Request $request)
	{
		$req=$request->all();
		if(Auth::user()->id!="1"){
			$where='created_by='.Auth::user()->id;
		}else{
			$where='1';
		}
		if(!empty($req['search'])){
			if(!empty($req['search']['name']) ){
				$where.=' AND name LIKE "%'.$req['search']['name'].'%"';
			}
			if(!empty($req['search']['from']) ){
				$where.=' AND  created_at >="'.date('Y-m-d 00:00:01',strtotime($req['search']['from'])).'"';
			}
			if(!empty($req['search']['to']) ){
				$where.=' AND  created_at  <= "'.date('Y-m-d 23:59:59',strtotime($req['search']['to'])).'"';
			}
			if(isset($req['search']['status'])){
				if($req['search']['status']==""){
					$where.=' AND  status in("0","1")';
				}
				if($req['search']['status']!=""){
					$where.=' AND  status="'.$req['search']['status'].'"';
				}
			}
		}
		$costumes = DB::select('SELECT  cst.costume_id,cst.name,cst.price,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id='.Auth::user()->id.' and  wsh_lst.	costume_id=cst.costume_id )>=1,true,false) as is_fav FROM `cc_costumes` as cst');
		return response()->success(compact('costumes'));
	}
	public function costumeSingleView()
	{
		return view('frontend.costumes.costumes_single_view');
	}
}

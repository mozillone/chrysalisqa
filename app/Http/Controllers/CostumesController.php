<?php 
namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Request;
use App\Costumes;
use App\Category;
use Session;
use Hash;
use DB;
use Response;
use Meta;
use Debugbar;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Input;
use URL;


class CostumesController extends Controller {

	protected $messageBag = null;
	protected $auth;

	
	public function __construct(Guard $auth)
	{
		$this->sitehelper = new SiteHelper();
    	Meta::title('Chrysalis');
        Meta::set('robots', 'index,follow');
		
	}

	public function categoryCostumeListings(Request $request,$slug1)
	{
	    $req=Request::all();
	    //echo '<pre>'; print_r($req); exit;
		Meta::set('title', ucfirst($slug1));
        Meta::set('description', ucfirst($slug1).' Buy and Sell Affordable, Environment Friendly Costumes');
        $key_url='/'.$slug1;
		$cat_info=Category::getUrlCategoryId($key_url);
        $search = '';

		if(count($cat_info)){
			$categories_list=[];
			$sub_cat_id=$cat_info[0]->url_offset;
			$data['sub_cat_info']=Costumes::getCategoryInfo($sub_cat_id);
			$category_id=$data['sub_cat_info'][0]->category_id;
			$sub_cats_list=Costumes::getParentCategories($category_id);
			
			if(count($sub_cats_list)){
			    
			$categories_list[$sub_cats_list[0]->name][]="None";
			
			foreach ($sub_cats_list as $subCat) {
				$link=Category::getUrlLinks($subCat->category_id);
				$categories_list[$subCat->name]=$link;
			}
			
			$where='where cats.parent_id='.$sub_cat_id.' and deleted_status="0"';
            $where.=' AND cst.deleted_status=0 AND cst.status="active" AND cao.attribute_id=21  AND link.id=(select id from cc_url_rewrites where url_offset=cst.costume_id  order by id desc limit 0,1)';
            
			if(Auth::check()){
					$is_login=',if((select count(*) from cc_costumes_like as likes where likes.user_id='.Auth::user()->id.' and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id='.Auth::user()->id.'  and  wsh_lst.costume_id=cst.costume_id )>=1,true,false) as is_fav';
				}else{
					$is_login=' ';
				}
			   
	           $order_by='order by cst.created_at DESC';
	           
		       $costumes = DB::select('SELECT cst.costume_id,dsr.name,FORMAT(cst.price,2) as price'.$is_login.',(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,img.image,cst.created_user_group,cst.quantity,link.url_key,created_user_group,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer, cao.attribute_option_value_id as film_qlty FROM `cc_costumes` as cst LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id LEFT JOIN cc_category as cats on cats.category_id=cat.category_id  LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.type="1"  LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id and link.type="product" LEFT JOIN cc_coupon_category as cpn_cat on cpn_cat.category_id=cat.category_id LEFT JOIN cc_promotion_coupon as prom on prom.coupon_id=cpn_cat.coupon_id and prom.code="" LEFT JOIN cc_coupon_costumes as cpn_cst on cpn_cst.costume_id=cst.costume_id LEFT JOIN cc_address_master as adder on adder.user_id=cst.created_by and adder.address_type="selling" LEFT JOIN cc_costume_attribute_options as cao on cst.costume_id=cao.costume_id  '.$where.' group by cst.costume_id '.$order_by.' ');
		        
		       $page = Input::get('page', 1); 
		        
		       if(!empty($req['perpage']))
				{
					$paginate =  $req['perpage'];
					\Session::set('perpage', $paginate);
				}
				else
				{
					$paginate = (session('perpage')!==null) ? session('perpage') : 12;
				}
				
				$total_count = count($costumes);
	         	
	         	$offSet = ($page * $paginate) - $paginate;
	         	$itemsForCurrentPage = array_slice($costumes, $offSet, $paginate, true);
	         	$costumes = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($costumes), $paginate, $page);
	           $costumes = $costumes->setPath(Request::url());
		     
				return view('frontend.costumes.costumes_list',compact('data','costumes'))->with('parent_cat_name',$slug1)->with('categories_list',$categories_list)->with('listings_search',$search)->with('parent_cat',true)->with('count',$total_count);
		 }
		 else{
		 	return Redirect::back();
		 }

		}
		else{
			return view('frontend.404');
			
		}
	}
	
	
	
	public function searchFilters(Request $request)
	{
		try
		{
			$req=Request::all();
			//echo "<pre>"; print_r($req); exit;
			$key_url='/'.$req['parent_cat_name'];
			$cat_info=Category::getUrlCategoryId($key_url);
			if(count($cat_info)){
			        $categories_list=[];			 
					$sub_cat_id=$cat_info[0]->url_offset;
					$data['sub_cat_info']=Costumes::getCategoryInfo($sub_cat_id);
					$category_id=$data['sub_cat_info'][0]->category_id;		 
					$sub_cats_list=Costumes::getParentCategories($category_id);
					if(count($sub_cats_list)){
					$categories_list[$sub_cats_list[0]->name][]="None";
					foreach ($sub_cats_list as $subCat) {
						$link=Category::getUrlLinks($subCat->category_id);
						$categories_list[$subCat->name]=$link;
					}
			 	
				if(!empty($req['is_main'])){
					$where='where cats.parent_id='.$req['cat_id'].' and deleted_status="0"';
				}else{
					$where='where cat.category_id='.$req['cat_id'].'';
				}
		        $where.=' AND cst.deleted_status=0 AND cst.status="active" AND cao.attribute_id=21  AND link.id=(select id from cc_url_rewrites where url_offset=cst.costume_id  order by id desc limit 0,1)';
		                
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
		 
			   $costumes = DB::select('SELECT cst.costume_id,dsr.name,FORMAT(cst.price,2) as price'.$is_login.',(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,img.image,cst.created_user_group,cst.quantity,link.url_key,created_user_group,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer, cao.attribute_option_value_id as film_qlty FROM `cc_costumes` as cst LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id LEFT JOIN cc_category as cats on cats.category_id=cat.category_id  LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.type="1"  LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id and link.type="product" LEFT JOIN cc_coupon_category as cpn_cat on cpn_cat.category_id=cat.category_id LEFT JOIN cc_promotion_coupon as prom on prom.coupon_id=cpn_cat.coupon_id and prom.code="" LEFT JOIN cc_coupon_costumes as cpn_cst on cpn_cst.costume_id=cst.costume_id LEFT JOIN cc_address_master as adder on adder.user_id=cst.created_by and adder.address_type="selling" LEFT JOIN cc_costume_attribute_options as cao on cst.costume_id=cao.costume_id  '.$where.' group by cst.costume_id '.$order_by.' ');
			     
			     $page = Input::get('page', 1); 
			    
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
		        $total = count($costumes);
	         	$offSet = ($page * $paginate) - $paginate;
	         	$itemsForCurrentPage = array_slice($costumes, $offSet, $paginate, true);
	         	
	         	if(count($itemsForCurrentPage) == 0)
	         	{
	         	    $page = 1;
	         	    $offSet = ($page * $paginate) - $paginate;
	              	$itemsForCurrentPage = array_slice($costumes, $offSet, $paginate, true);
	         	}
	         	$costumes = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($costumes), $paginate, $page);
	         	//dd($costumes);
	            $costumes = $costumes->setPath(Request::url());
	         	$view = view('frontend.costumes.filter-costumes')->with('costumes',$costumes)->with('count',$total)->render();
	         	return response()->json($view, 200);
	         }
		}
		}catch(\Exception $e)
		{
			return redirect(abort(404));
		}
	}
	
	
	
	public function costumeListings($slug1,$slug2)
	{
		Meta::set('title', ucfirst($slug2));
        Meta::set('description', ucfirst($slug2).' Buy and Sell Affordable, Environment Friendly Costumes');
        $key_url='/'.$slug1.'/'.$slug2;
      	$cat_info=Category::getUrlCategoryId($key_url);
      	$search = '';
		if(count($cat_info)){
			$categories_list=[];
			$sub_cat_id=$cat_info[0]->url_offset;
			$data['sub_cat_info']=Costumes::getCategoryInfo($sub_cat_id);
			$parent_cat_id=$data['sub_cat_info'][0]->parent_id;
			$sub_cats_list=Costumes::getParentCategories($parent_cat_id);
			$categories_list[$sub_cats_list[0]->name][]="None";
			foreach ($sub_cats_list as $subCat) {
				$link = Category::getUrlLinks($subCat->category_id);
				$categories_list[$subCat->name]=$link;
			}
		    
			/*	if(isset($_GET['perpage']))
				{
					$paginate =  $_GET['perpage'];
					\Session::set('perpage', $paginate);
				}
				else
				{
					$paginate = (session('perpage')!==null) ? session('perpage') : 12;
				}*/
		          
		       /* $costumes = DB::table('costumes as cst')
		           ->leftjoin('costume_to_category as cat','cat.costume_id','=','cst.costume_id')
		           ->leftjoin('category as cats','cats.category_id','=','cat.category_id')
		           ->leftjoin('costume_image as img','img.costume_id','=','cst.costume_id')
		           ->leftjoin('costume_description as dsr','dsr.costume_id','=','cst.costume_id')
		           ->leftjoin('url_rewrites as link','link.url_offset','=','cst.costume_id')
		           ->leftjoin('coupon_category as cpn_cat','cpn_cat.category_id','=','cat.category_id')
		           ->leftjoin('promotion_coupon as prom','prom.coupon_id','=','cpn_cat.coupon_id')
		           ->leftjoin('coupon_costumes as cpn_cst','cpn_cst.costume_id','=','cst.costume_id')
		           ->leftjoin('address_master as adder','adder.user_id','=','cst.created_by')
		           ->leftjoin('costume_attribute_options as cao','cst.costume_id','=','cao.costume_id')
		           ->select(DB::raw("(SELECT count(*) FROM `cc_costumes_like` as ccl,cc_costumes as cst where ccl.costume_id=cst.costume_id) as like_count"),'cst.price',"cst.costume_id","dsr.name","img.image","cst.created_user_group","cst.quantity","link.url_key","created_user_group","prom.discount","prom.type","prom.date_start","prom.date_end","prom.uses_total","prom.uses_customer", "cao.attribute_option_value_id as film_qlty")
		           ->where('img.type',1)
		           ->where('cat.category_id',$sub_cat_id)	
		           ->groupBy('cst.costume_id')
		           ->orderBy('cst.created_at','DESC')
		           ->paginate($paginate);*/
		           
		           
		           
		    $where='where cat.category_id='.$sub_cat_id.' and deleted_status="0"';
            $where.=' AND cst.deleted_status=0 AND cst.status="active" AND cao.attribute_id=21 AND link.id=(select 
            id from cc_url_rewrites where url_offset=cst.costume_id  order by id desc limit 0,1)';

			if(Auth::check()){
					$is_login=',if((select count(*) from cc_costumes_like as likes where likes.user_id='.Auth::user()->id.' and  likes.costume_id=cst.costume_id )>=1,true,false) as is_like,if((select count(*) from cc_customer_wishlist as wsh_lst where wsh_lst.user_id='.Auth::user()->id.'  and  wsh_lst.costume_id=cst.costume_id )>=1,true,false) as is_fav';
				}else{
					$is_login=' ';
				}
			   
	           $order_by='order by cst.created_at DESC';
	           
		       $costumes = DB::select('SELECT cst.costume_id,dsr.name,FORMAT(cst.price,2) as price'.$is_login.',(SELECT count(*) FROM `cc_costumes_like` where costume_id=cst.costume_id) as like_count,img.image,cst.created_user_group,cst.quantity,link.url_key,created_user_group,prom.discount,prom.type,prom.date_start,prom.date_end,prom.uses_total,prom.uses_customer, cao.attribute_option_value_id as film_qlty,cat.category_id FROM `cc_costumes` as cst 
		       	LEFT JOIN cc_costume_to_category as cat on cat.costume_id=cst.costume_id 
		       	LEFT JOIN cc_category as cats on cats.category_id=cat.category_id  
		       	LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.type="1"  
		       	LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id 
		       	LEFT JOIN cc_url_rewrites as link on link.url_offset=cst.costume_id 
		       	LEFT JOIN cc_coupon_category as cpn_cat on cpn_cat.category_id=cat.category_id 
		       	LEFT JOIN cc_promotion_coupon as prom on prom.coupon_id=cpn_cat.coupon_id 
		       	LEFT JOIN cc_coupon_costumes as cpn_cst on cpn_cst.costume_id=cst.costume_id 
		       	LEFT JOIN cc_address_master as adder on adder.user_id=cst.created_by and adder.address_type="selling" 
		       	LEFT JOIN cc_costume_attribute_options as cao on cst.costume_id=cao.costume_id  '.$where.' group by cst.costume_id '.$order_by.'');
		         $total_count = count($costumes);
		       $page = Input::get('page', 1); 
		        
		       if(!empty($req['perpage']))
				{
					$paginate =  $req['perpage'];
					\Session::set('perpage', $paginate);
				}
				else
				{
					$paginate = (session('perpage')!==null) ? session('perpage') : 12;
				}
				
				$total_count = count($costumes);
	         	
	         	$offSet = ($page * $paginate) - $paginate;
	         	$itemsForCurrentPage = array_slice($costumes, $offSet, $paginate, true);
	         	$costumes = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($costumes), $paginate, $page);
	           $costumes = $costumes->setPath(Request::url());
		     
				return view('frontend.costumes.costumes_list',compact('data','costumes'))->with('count',$total_count)->with('parent_cat_name',$slug1)->with('categories_list',$categories_list)->with('listings_search',$search)->with('parent_cat',false);

		 
		}
		else{
			return view('frontend.404');
			
		}
	}

	public function costumeSingleView($slug1=null,$slug2=null,$slug3=null)
	{
		try
	    {
	        Meta::set('description', ucfirst($slug2).' Buy and Sell Affordable, Environment Friendly Costumes');
            /* Code added by Gayatri */
            Meta::set('url', url()->current());
            /* End */
            $key_url='/'.$slug1.'/'.$slug2.'/'.$slug3;
            $cat_url='/'.$slug1.'/'.$slug2;
            
            $cat_info=Category::getUrlCategoryId($key_url);
    		
    		if(count($cat_info)){
    			$costume_id=$cat_info[0]->url_offset;
    			$data=Costumes::getCostumeDetails($costume_id,$cat_url);

    			if(isset($data[0])){
                                    
                    if($data[0]->deleted_status == 1 && $data[0]->cos_act_status == "inactive"){
                        return \Redirect::to('/');
                    }
    
                    if($data[0]->size == 'custom'){
    					$custom_info = DB::table('costume_attribute_options')
    									->select(DB::Raw('GROUP_CONCAT(attribute_option_value) as dimensions' ))
    									->where('costume_id', $costume_id)
    									->where(function($query){
    						                return $query
    						                    ->where('attribute_id',16)
    											->orWhere('attribute_id',17)
    											->orWhere('attribute_id',18)
    											->orWhere('attribute_id',19)
    											->orWhere('attribute_id',20);
    									});
    					$result = $custom_info->first();
    				}else{
    					$result = '';
    				}
    			
    				$data[0]->custom_sizes = !empty($result)?explode(',', $result->dimensions):'';
    				$data['random_costumes']=Costumes::getRandomCategoyCostumesList($data[0]->category_id,$data[0]->parent_id, $costume_id);
    				$data['images']=Costumes::getCostumeImages($costume_id);

    				if($data['est_time']->attribute_option_value == '1-2 Business Days'){
						$est_date = date('D . M .d',strtotime('+2 days'));
						$add = 2;
					}else if($data['est_time']->attribute_option_value == '3-4 Business Days'){
						$est_date = date('D . M .d',strtotime('+4 days'));
						$add = 4;
					}else if($data['est_time']->attribute_option_value == '5-6 Business Days'){
						$est_date = date('D . M .d',strtotime('+6 days'));
						$add = 6;
					}else if($data['est_time']->attribute_option_value == '7 Business Days'){
						$est_date = date('D . M .d',strtotime('+7 days'));
						$add = 7;
					}else{
						$est_date = date('D . M .d');
						$add = 0;
					}
					$data['seller_info'] = Costumes::costumeSellerInfo($data[0]->created_by);
					if(!empty($data['seller_info']['shipping_location'])){
						$priority_info = SiteHelper::domesticRateSingleCostume($data['seller_info']['shipping_location'][0]->zip_code,SiteHelper::getUserShippingAddress()['zip_code'],$data[0]->weight_pounds,$data[0]->weight_ounces);
						if($priority_info['result']=="1"){
							$est_delivery_date = 'Est. between '.$est_date.' and '.date('D . M .d',strtotime('+'.($priority_info["msg"]["MailService"]+$add).' days'));
							$rate = '$'.$priority_info['msg']['rate'].' Expedited Shipping ';
						}else{
							$est_delivery_date = $priority_info['msg'];
							$rate = $priority_info['msg'];
						}
					}else{
						$rate = '';
						$est_delivery_date = '';
					}
    				/* Code added by Gayatri */
    
    				$costume_name = DB::table('costume_description')->where('costume_id',$costume_id)->first();
    								
    				$pic = asset('/costumers_images/Small').'/'.$data['images'][0]->image;
    				
    				Meta::set('image',$pic);
    				
    				if ((stripos( $costume_name->name, 'costume' ) != '') || (stripos( $costume_name->name, 'cosplay' ) != '')) {
					  	$name = $costume_name->name;
					}else{
						$name = $costume_name->name." Costume";
					}

    				Meta::set('title', ucfirst($name));
    				
    				/* End */		
    				$data['is_film_quality_cos'] = (\DB::table('costume_attribute_options')->where('costume_id', $costume_id)->where('attribute_option_value_id', 32)->first()) ? 'yes' : '';

    				return view('frontend.costumes.costumes_single_view',compact('data',$data))->with('parent_cat_name',$slug1)->with('sub_cat_name',$slug2)->with('est_delivery_date', $est_delivery_date)->with('rate', $rate)->with('costume_detail_name', $name);
    			}
    		}
    		else
    		{
    		    return view('errors.404');
    		}
	    }catch(\Exception $e)
	    {
	        return view('errors.404');
	    }
	        
	     

	}
	/*public function costumeLike(Request $request){
		$req=$request->all();
		$res=Costumes::costumeLike($req['costume_id'],Auth::user()->id);
		return Response::JSON($res);
	}*/

	public function costumeLike($id){
		$res=Costumes::costumeLike($id,Auth::user()->id);
		return Response::JSON($res);
	}

	public function costumeFavourite($id){
		$res=Costumes::costumeFavourite($id,Auth::user()->id);
		return Response::JSON($res);
	}

	/*public function costumeFavourite(Request $request){
		$req=$request->all();
		//echo "<pre>"; print_r($request->input('costume_id'));exit;
		$res=Costumes::costumeFavourite($req['costume_id'],Auth::user()->id);
		return Response::JSON($res);
	}*/
	public function costumeReport(Request $request){

		$req=Request::all();
		$res=Costumes::costumeReport($req);
		Session::flash('success', 'Your report is sent to admin.');
        return Redirect::back();

	}

	public function inquireCostume(Request $request){

	    $req = Request::all();
        if(isset($req) && !empty($req)){
            if(!Auth::check()){
                $seller_details = DB::table('users')
                    ->select('users.email','users.first_name','users.last_name')
                    ->where('users.id','=',$req['seller_id'])
                    ->first();
                $seller_name = $seller_details->first_name.' '.$seller_details->last_name;
                // send mail
                $reg_subject        = "Inquiry About ".$req['costume_name'];
                $reg_data           = array('user_email'=>$req['user_email'],
                    'user_name'=>$req['user_name'],
                    'seller_name'=>$seller_name,
                    'costume_name'=>$req['costume_name'],
                    'user_message'=>$req['user_message']
                );
                $template           = 'emails.inquire_costume';
                //---- send mail
                $reg_to             = $seller_details->email;
                $mail_status        = $this->sitehelper->sendEmail($reg_to,$reg_subject,$template,$reg_data);
                // end mail
                return Redirect::back();
            }else{
                $conversation_array = array('type'=>'costume_inquiry','type_id'=>$req['type_id'],'costume_id'=>$req['costume_id'],'user_one'=>$req['user_id'],
                    'subject'=>'Inquiry About '.$req['costume_name'],
                    'user_two'=>$req['seller_id'],
                    'status'=>'1',
                    'created_at'=>date('y-m-d H:i:s'));
                $conversation_insert = DB::table('conversations')->insertGetId($conversation_array);
                if($conversation_insert){
                    $thread_array  = array('message'=>$req['user_message'],
                        'is_seen'=>'0',
                        'deleted_from_sender'=>'0',
                        'deleted_from_receiver'=>'0',
                        'user_id'=>$req['user_id'],
                        'user_name'=>$req['user_name'],
                        'conversation_id'=>$conversation_insert,
                        'created_at'=>date('y-m-d H:i:s'));
                    $thread = DB::table('messages')->insertGetId($thread_array);
                }
                if($thread){
                    $seller_details = DB::table('users')
                        ->select('users.email','users.first_name','users.last_name')
                        ->where('users.id','=',$req['seller_id'])
                        ->first();
                    $seller_name = $seller_details->first_name.' '.$seller_details->last_name;
                    // send mail
                    $reg_subject        = "Inquiry About ".$req['costume_name'];
                    $reg_data           = array('user_email'=>$req['user_email'],
                        'user_name'=>$req['user_name'],
                        'seller_name'=>$seller_name,
                        'costume_name'=>$req['costume_name'],
                        'user_message'=>$req['user_message']
                    );

                    $template           = 'emails.inquire_costume';
                    //---- send mail
                    $reg_to             = $seller_details->email;
                    $mail_status        = $this->sitehelper->sendEmail($reg_to,$reg_subject,$template,$reg_data);
                    // end mail
                    return Redirect::back();
                }
            }
        }
    }

}

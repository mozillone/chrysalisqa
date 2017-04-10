<?php
	
namespace App\Http\Controllers\Admin;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use DB;
use Session;
use Hash;
use Response;
use Validator;
use App\Promotions;
use App\Category;
use App\Costumes;
use App\Helpers\Site_model;

class PromotionsController extends Controller
{
    protected $messageBag = null;
    

    public function __construct()
    {
      $this->middleware(function ($request, $next) {
          if(!Auth::check()){
            return Redirect::to('/admin/login')->send();
          }
          else{
               return $next($request);
          }
      });
    }
   public function promotionsList()
   {
      $cats_list=Category::getCategories();
      $costumes_list=Costumes::getCostumesList();
      return view('admin.promotions.promotions_list')
                ->with('cats_list',$cats_list)
                ->with('costumes_list',$costumes_list);
   }
   public function promotionsData(Request $request)
   {
        $req=$request->all();
        $where='where 1';
        $having='HAVING 1';
        if(!empty($req['search'])){
          if(!empty($req['search']['name']) ){
            $where.=' AND prom.name LIKE "%'.$req['search']['name'].'%"';
          }
          if(!empty($req['search']['from_date']) ){
            $where.=' AND  prom.date_start >="'.date('Y-m-d 00:00:01',strtotime($req['search']['from_date'])).'"';
          }
          if(!empty($req['search']['date_end']) ){
              $where.=' AND  prom.date_end  <= "'.date('Y-m-d 23:59:59',strtotime($req['search']['date_end'])).'"';
          }
          if(!empty($req['search']['cats'])){
              $res=Category::getCategoryInfo($req['search']['cats']);
              if($res=="0"){
                $having.=' AND FIND_IN_SET('.$req['search']['cats'].',cats)> 0';
              }else{
                  $having.=' AND cats in('.$res[0]->cat_id.')';
              }
          }
          if(!empty($req['search']['costumes'])){
              $having.=' AND FIND_IN_SET('.$req['search']['costumes'].',costumes)> 0';
          }
        }
         $promotions = DB::select("SELECT prom.coupon_id, prom.name, prom.code, prom.type, prom.discount, DATE_FORMAT(prom.date_start,'%m/%d/%Y %h:%i %p') as datestart,DATE_FORMAT(prom.date_end,'%m/%d/%Y %h:%i %p') as dateend , prom.uses_total,prom.status,GROUP_CONCAT(DISTINCT(coup.costume_id) SEPARATOR ',') as costumes,GROUP_CONCAT(DISTINCT(cats.category_id) SEPARATOR ',') as cats FROM cc_promotion_coupon as prom LEFT JOIN cc_coupon_costumes as coup on coup.coupon_id=prom.coupon_id LEFT JOIN cc_coupon_category as cats on cats.coupon_id=prom.coupon_id ".$where." group by prom.coupon_id ".$having."");
        return response()->success(compact('promotions'));
   }
   public function createPromotions(Request $request)
   {
         $req=$request->all();
         if(count($req))
         {
            $rule  = array('name' => 'required|max:50',
                          'type' => 'required',
                          'discount' => 'required',
                          'date_start'=>'required',
                          'date_end'=>'required');
            $validator = Validator::make($req,$rule);
            if ($validator->fails())
            {
               return Redirect::back()->withErrors($validator->messages())->withInput();
            }
            else
              { 
                  Promotions::createPromotions($req);
                  Session::flash('success', 'Promotion is created successfully');
                  return Redirect::back();
              }
         }
         else
         {
            $cats_list=Category::getCategories();
            $costumes_list=Costumes::getCostumesList();
            return view('admin.promotions.promotions_create',compact('cats_list',$cats_list))->with('costumes_list',$costumes_list);
         }
   }
   public function editPromotions(Request $request,$coupon_id=null)
   {
         $req=$request->all();
         if(count($req))
         {
           $rule  = array('name' => 'required|max:50',
                          'type' => 'required',
                          'discount' => 'required',
                          'date_start'=>'required',
                          'date_end'=>'required');
           $validator = Validator::make($req,$rule);
            if ($validator->fails())
            {
               return Redirect::back()->withErrors($validator->messages())->withInput();
            }
            else
              { 
                  
                  Promotions::updatePromotions($req);
                  Session::flash('success', 'Promotion is updated successfully');
                  return Redirect::to('promotions');
              }
         }
         else
         {
            $data=Promotions::getPromotionInfo($coupon_id);
            $cats_list=Category::getCategories();
            $costumes_list=Costumes::getCostumesList();
            return view('admin.promotions.promotions_edit',compact('data',$data))
                        ->with('costumes_list',$costumes_list)
                        ->with('cats_list',$cats_list);
         }
   }
   public function deletePromotion($id)
   {   
         $cond = array('coupon_id'=>$id);
         Site_model::delete_single('promotion_coupon',$cond);
         Session::flash('success', 'Promotion is deleted successfully');
         return Redirect::back();
   }
   public function getSelectedCategories($cat_id){
       $res=Promotions::getSelectedCategories($cat_id);
       return Response::JSON($res);
   }
   public function changePromotionStatus(Request $request)
  {
    $req = $request->all(); 
    $data=array('status'=>$req['data']['status']);
    $cond=array('coupon_id'=>$req['data']['id']);
    Site_model::update_data('promotion_coupon',$data,$cond);
    return Response::JSON(true);
  }

}

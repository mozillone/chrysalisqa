<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Order;
use Session;


class OrdersController extends Controller {
    
    public function __construct(Guard $auth)
    {
        $this->middleware(function ($request, $next) {
              if(!Auth::check()){
                return Redirect::to('/login')->send();
            }
            else{
                 return $next($request);
            }
        });

    }
    public function myOrdersList()
    {
      $title="Orders List";
      return view('frontend.orders.orders_list')->with('title',$title);
    }
     public function myOrdersListData(Request $request)
    {
        $req=$request->all();
        $where='where ord.buyer_id='.Auth::user()->id.'';
        $having='';
        if(!empty($req['search'])){
          if(!empty($req['search']['order_id']) ){
            $where.=' AND ord.order_id ='.$req['search']['order_id'];
          }
          if (!empty($req['search']['from_date'])) {
            $where .= ' AND  ord.created_at >="'.date('Y-m-d 00:00:01', strtotime($req['search']['from_date'])).'"';
          }
          if (!empty($req['search']['date_end'])) {
            $where .= ' AND  ord.created_at  <= "'.date('Y-m-d 23:59:59', strtotime($req['search']['date_end'])).'"';
          }
          if(isset($req['search']['status'])){
          if($req['search']['status']!=""){
              $where.=' AND sts.name="'.$req['search']['status'].'"';
          }
        }
        }
         $orders = DB::select('SELECT ord.created_at as date,ord.order_id,concat(seller.first_name," ",seller.last_name) as seller_name,sts.name as status FROM `cc_order` as ord LEFT JOIN cc_users as seller on seller.id=ord.seller_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id '.$where.' GROUP BY ord.order_id ORDER BY `order_id` DESC');
        return response()->success(compact('orders'));
  
    }
    public function myOrderSummary($order_id){
      $res=Order::orderBuyerCheck($order_id);
      if($res=="true"){
        $order=Order::userOrderSummary($order_id);
        if(count($order)){
          return view('frontend.orders.order_summary',compact('order',$order))->with('order_id',$order_id);
        }else{
          Session::flash('error', 'Order information not found.'); 
          return Redirect::to('/orders'); 
        }
      }else{
         Session::flash('error', 'Order info not found');
         return Redirect::to('/dashboard');
      }

    }

     public function costumeSoldList()
    {
      $title="Orders List";
      return view('frontend.orders.soldorders_list')->with('title',$title);
    }
     public function costumeSoldListData(Request $request)
    {
        $req=$request->all();
        $where='where ord.seller_id='.Auth::user()->id.'';
        $having='';
        if(!empty($req['search'])){
          if(!empty($req['search']['order_id']) ){
            $where.=' AND ord.order_id ='.$req['search']['order_id'];
          }
          if (!empty($req['search']['from_date'])) {
            $where .= ' AND  ord.created_at >="'.date('Y-m-d 00:00:01', strtotime($req['search']['from_date'])).'"';
          }
          if (!empty($req['search']['date_end'])) {
            $where .= ' AND  ord.created_at  <= "'.date('Y-m-d 23:59:59', strtotime($req['search']['date_end'])).'"';
          }
          if(isset($req['search']['status'])){
          if($req['search']['status']!=""){
              $where.=' AND sts.name="'.$req['search']['status'].'"';
          }
        }
        }
         $orders = DB::select('SELECT ord.created_at as date,ord.order_id,concat(buyer.first_name," ",buyer.last_name) as buyer_name,sts.name as status FROM `cc_order` as ord LEFT JOIN cc_users as buyer on buyer.id=ord.buyer_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id  '.$where.' GROUP BY ord.order_id ORDER BY `order_id` DESC');
        return response()->success(compact('orders'));
  
    }
    public function costumeSoldSummary($order_id){
      $res=Order::orderSellerCheck($order_id);
      if($res=="true"){
        $order=Order::userOrderSummary($order_id);
        if(count($order)){
          return view('frontend.orders.ordersold_summary',compact('order',$order))->with('order_id',$order_id);
        }else{
          Session::flash('error', 'Order information not found.'); 
          return Redirect::to('/orders'); 
        }
      }else{
         Session::flash('error', 'Order info not found');
         return Redirect::to('/dashboard');
      }

    }

}
<?php namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use DB;


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
    public function ordersList()
    {
      $title="Orders List";
      return view('admin.orders.orders_list')->with('title',$title);
    }
     public function ordersListData(Request $request)
    {
        $req=$request->all();
        $where='where 1';
        if(!empty($req['search'])){
          if(!empty($req['search']['order_id']) ){
            $where.=' AND ord.order_id ='.$req['search']['order_id'];
          }
          if(!empty($req['search']['user_name']) ){
            $where.=' AND concat(usr.first_name," ",usr.last_name) LIKE "%'.$req['search']['user_name'].'%"';
          }
        if(!empty($req['search']['costume_name']) ){
            $where.=' AND GROUP_CONCAT(DISTINCT(itms.costume_name) SEPARATOR ",") LIKE "%'.$req['search']['costume_name'].'%"';
          }
           if(isset($req['search']['status'])){
            if($req['search']['status']==""){
              $where.=' AND  user.active in("0","1")';
            }
            if($req['search']['status']!=""){
              $where.=' AND  user.active="'.$req['search']['status'].'"';
            }
          }
        }
        $orders = DB::select('SELECT ord.order_id,concat(usr.first_name," ",usr.last_name) as user_name,concat("$",ord.total) as amount,DATE_FORMAT(ord.created_at,"%m/%d/%Y %h:%i %p") as date,sts.name as status,GROUP_CONCAT(DISTINCT(itms.costume_name) SEPARATOR ",") as costume_name FROM `cc_order` as ord LEFT JOIN cc_order_items as itms on itms.order_id=ord.order_id LEFT JOIN cc_users as usr on usr.id=ord.user_id LEFT JOIN cc_order_status as ord_st on ord_st.order_id=ord.order_id LEFT JOIN cc_status as sts on sts.status_id=ord_st.status_id  '.$where.' GROUP BY ord.order_id ORDER BY `order_id` DESC');
        return response()->success(compact('orders'));
  
    }
}
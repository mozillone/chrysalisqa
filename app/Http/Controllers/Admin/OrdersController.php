<?php namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Order;
use Session;
use Usps\PriorityLabel;
use Config;

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
        $having='';
        if(!empty($req['search'])){
          if(!empty($req['search']['order_id']) ){
            $where.=' AND ord.order_id ='.$req['search']['order_id'];
          }
          if(!empty($req['search']['user_name']) ){
            $where.=' AND concat(usr.first_name," ",usr.last_name) LIKE "%'.$req['search']['user_name'].'%"';
          }
          if(!empty($req['search']['costume_name']) ){
            $having.='having costume_name LIKE "%'.$req['search']['costume_name'].'%"';
          }
          if (!empty($req['search']['from_date'])) {
            $where .= ' AND  ord.created_at >="'.date('Y-m-d 00:00:01', strtotime($req['search']['from_date'])).'"';
          }
          if (!empty($req['search']['date_end'])) {
            $where .= ' AND  ord.created_at  <= "'.date('Y-m-d 23:59:59', strtotime($req['search']['date_end'])).'"';
          }
          if(isset($req['search']['status'])){
          // if($req['search']['status']==""){
          //   $where.=' AND sts.name="'.$req['search']['status'].'"';
          // }
          if($req['search']['status']!=""){
              $where.=' AND sts.name="'.$req['search']['status'].'"';
          }
        }
        }
        $orders = DB::select('SELECT ord.order_id,concat(usr.first_name," ",usr.last_name) as user_name,concat("$",ord.total) as amount,DATE_FORMAT(ord.created_at,"%m/%d/%Y %h:%i %p") as date,sts.name as status,GROUP_CONCAT(DISTINCT(itms.costume_name) SEPARATOR ",") as costume_name FROM `cc_order` as ord LEFT JOIN cc_order_items as itms on itms.order_id=ord.order_id LEFT JOIN cc_users as usr on usr.id=ord.buyer_id LEFT JOIN cc_order_status as ord_st on ord_st.order_id=ord.order_id LEFT JOIN cc_status as sts on sts.status_id=ord_st.status_id  '.$where.' GROUP BY ord.order_id '.$having.' ORDER BY `order_id` DESC');
        return response()->success(compact('orders'));
  
    }
    public function orderSummary($order_id){
      $order=Order::orderSummary($order_id);
      //dd($order);
      if(count($order)){
        return view('admin.orders.order_summary',compact('order',$order))->with('order_id',$order_id);
      }else{
        Session::flash('error', 'Order information not found.'); 
        return Redirect::to('/orders'); 
      }

    }
    public function orderStatusUpdate(Request $request){
       $req=$request->all();
       Order::orderStatusUpdate($req);
       Session::flash('success', 'Order status is updated successfully'); 
       return Redirect::back(); 
      }
     public function orderAdditionalTransaction(Request $request){
       $req=$request->all();
       Order::orderAdditionalTransaction($req);
       Session::flash('success', 'Order Transacrtion is completed successfully'); 
       return Redirect::back(); 
      }
    public function OrderBillingAddressUpate(Request $request){
       $req=$request->all();
       Order::OrderBillingAddressUpate($req);
       Session::flash('success', 'Billing address is updated successfully'); 
       return Redirect::back(); 
    }
     public function OrderShippingAddressUpate(Request $request){
       $req=$request->all();
       Order::OrderShippingAddressUpate($req);
       Session::flash('success', 'Shipping address is updated successfully'); 
       return Redirect::back(); 
    }
    public function orderLabelGenate(Request $request){
       $req=$request->all();
     //  dd(Config::get('constants.USPS'));
     // $label = new InternationalLabel('402SAMPL6330');

    $label = new PriorityLabel('466CHERR0126');
// During test mode this seems not to always work as expected
$label->setTestMode(true);
$label->setFromAddress('John', 'Doe', '', '5161 Lankershim Blvd', 'North Hollywood', 'CA', '91601', '# 204', '', '8882721214');
$label->setToAddress('Vincent', 'Gabriel', '', '230 Murray St', 'New York', 'NY', '10282');
$label->setWeightOunces(1);
$label->setField(36, 'LabelDate', '03/12/2014');
//$label->setField(32, 'SeparateReceiptPage', 'true');
// Perform the request and return result

$label->createLabel();
dd($label);
//print_r($label->getArrayResponse());
//print_r($label->getPostData());
//var_dump($label->isError());
// See if it was successful
if ($label->isSuccess()) {
    //echo 'Done';
    //echo "\n Confirmation:" . $label->getConfirmationNumber();
    $label = $label->getLabelContents();
    if ($label) {
        $contents = base64_decode($label);
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="label.pdf"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($contents));
        echo $contents;
        exit;
    }
} else {
    echo 'Error: ' . $label->getErrorMessage();
}
    }

}
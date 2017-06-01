<?php namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Order;
use Session;
use Usps\InternationalLabel;
use Config;
use Mail;
use Response;
class OrdersController extends Controller {
    
        protected $user_id            = '';
        protected $secure             = TRUE;
        protected $test               = TRUE;
        protected $host               = 'production.shippingapis.com';
        protected $secure_host        = 'secure.shippingapis.com';
        protected $test_api           = 'ShippingAPITest.dll';
        protected $prod_api           = 'ShippingAPI.dll';
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
      if(count($order)){
        return view('admin.orders.order_summary',compact('order',$order))->with('order_id',$order_id);
      }else{
        Session::flash('error', 'Order information not found.'); 
        return Redirect::to('/orders'); 
      }

    }
    public function orderStatusUpdate(Request $request){
        $req=$request->all();
        $order=Order::orderSummary($req['order_id']);
        Order::orderStatusUpdate($req);
        if(isset($req['is_notify'])){
        $order['status']=Order::getOrderStatus($req['status_id']);
        $order['comment']=$req['comment'];
        $sent=Mail::send('emails.order_status_notification',array("order"=>$order), function ($m) use($order){
              $m->to($order['basic'][0]->buyer_email, $order['basic'][0]->buyer_name);
                $m->subject('#'.$order["basic"][0]->order_id.' status report');
            });
       }
       Session::flash('success', 'Order status is updated successfully'); 
       return Redirect::back(); 
      }
     public function orderAdditionalTransaction(Request $request){
       $req=$request->all();
       $result=Order::orderAdditionalTransaction($req);
       if($result['result']=="0"){
         Session::flash('error',$result['message']);
         return Redirect::back();
       }else{
         if(isset($req['is_notify'])){
          $sent=Mail::send('emails.order_transaction_notification',array("transacrtion"=>$result['message']), function ($m) use($result){
                $m->to($result['message']['buyer_email'], $result['message']['buyer_name']);
                  $m->subject('#'.$result["message"]['order_id'].' Transaction report');
              });
         }
         Session::flash('success', 'Order Transacrtion is completed successfully'); 
         return Redirect::back(); 
       }
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
    $order=Order::orderSummary($req['order_id']);
    $user_id=Config::get('constants.USPS');
    $from = array(
               'from_name' => 'chrysalis',
               'from_firm' => '',
               'from_address1' => '846 Haymond Rocks Road',
               'from_address2' => '846 Haymond Rocks Road',
               'from_city' => 'ANN ARBOR',
               'from_state' => 'MI',
               'from_zip5' =>  '48113');
     if(!empty($order['basic'][0]->shipping_state)){
      $state=Order::getStateAbbrev($order['basic'][0]->shipping_state);
     }else{
      $state="";
     }
     $to = array(
               'to_name' =>  $order['basic'][0]->shipping_firstname.' '.$order['basic'][0]->shipping_lastname,
               'to_firm' => '',
               'to_address1' => $order['basic'][0]->shipping_address_1,
               'to_address2' => $order['basic'][0]->shipping_address_2,
               'to_city' =>$order['basic'][0]->shipping_city,
               'to_state' => $state,
               'to_zip5' => $order['basic'][0]->shipping_postcode);

      $container = "VARIABLE";
      $size = "REGULAR";
      $insured_amount = 0;
      $weight_in_ounces = $req['weight'] ;
      $service_type =$req['method'];
      $xml='<?xml version="1.0" encoding="UTF-8" ?><DelivConfirmCertifyV4.0Request USERID="'.$user_id.'"><Revision>2</Revision><ImageParameters /><FromName>'.$from['from_name'].'</FromName><FromFirm> </FromFirm><FromAddress1>'.$from['from_address1'].'</FromAddress1><FromAddress2>'.$from['from_address2'].'</FromAddress2><FromCity>'.$from['from_city'].'</FromCity><FromState>'.$from['from_state'].'</FromState><FromZip5>'.$from['from_zip5'].'</FromZip5><FromZip4/><ToName>'.$to['to_name'].'</ToName><ToFirm> </ToFirm><ToAddress1>'.$to['to_address2'].'</ToAddress1><ToAddress2>'.$to['to_address2'].'</ToAddress2><ToCity>'.$to['to_city'].'</ToCity><ToState>'.$to['to_state'].'</ToState><ToZip5>'.$to['to_zip5'].'</ToZip5><ToZip4 /><WeightInOunces>'.$weight_in_ounces.'</WeightInOunces><ServiceType>'.$service_type.'</ServiceType><ImageType>TIF</ImageType></DelivConfirmCertifyV4.0Request>';
        $ch = curl_init('https://secure.shippingapis.com/ShippingAPI.dll?API=DelivConfirmCertifyV4&XML='.urlencode($xml));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        $collection = new \Illuminate\Support\Collection(json_decode(json_encode(simplexml_load_string($this->removeNamespaceFromXML($output))), true));
        if(!isset($collection->toArray()['Number'])){
          $track_id=$collection->toArray()['DeliveryConfirmationNumber'];
          $fileName = 'uspslabel/'.$track_id.'.pdf';
          $array_text = array("_");
          $array_replace =  "+";
          $contents = base64_decode(str_replace($array_text, $array_replace, $collection->toArray()['DeliveryConfirmationLabel']))  ;
          file_put_contents($fileName,$contents);
          Order::orderShippingmentProcess($req,$track_id);
          Session::flash('success', 'Order Shipping process started'); 
          return Redirect::back(); 
        }else{
          Session::flash('error', $collection->toArray()['Description']); 
          return Redirect::back(); 
        }

      }
 
      function removeNamespaceFromXML( $xml )
      {
        // Because I know all of the the namespaces that will possibly appear in 
        // in the XML string I can just hard code them and check for 
        // them to remove them
        $toRemove = ['rap', 'turss', 'crim', 'cred', 'j', 'rap-code', 'evic'];
        // This is part of a regex I will use to remove the namespace declaration from string
        $nameSpaceDefRegEx = '(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?';

        // Cycle through each namespace and remove it from the XML string
       foreach( $toRemove as $remove ) {
            // First remove the namespace from the opening of the tag
            $xml = str_replace('<' . $remove . ':', '<', $xml);
            // Now remove the namespace from the closing of the tag
            $xml = str_replace('</' . $remove . ':', '</', $xml);
            // This XML uses the name space with CommentText, so remove that too
            $xml = str_replace($remove . ':commentText', 'commentText', $xml);
            // Complete the pattern for RegEx to remove this namespace declaration
            $pattern = "/xmlns:{$remove}{$nameSpaceDefRegEx}/";
            // Remove the actual namespace declaration using the Pattern
            $xml = preg_replace($pattern, '', $xml, 1);
        }

        // Return sanitized and cleaned up XML with no namespaces
        return $xml;
    }
    public function downlaodTrankDetails($track_id){
        $file=public_path("uspslabel/".$track_id.".pdf");
        return Response::download($file);
    }


}
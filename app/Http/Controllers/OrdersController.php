<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Order;
use Session;
use Response;
use Config;
<<<<<<< HEAD
use App\Helpers\StripeApp;
use App\Helpers\Site_model;
use App\Helpers\Endicia\Endicia;
use App\Address;
use Mail;
=======

>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

class OrdersController extends Controller {
    
    public function __construct(Guard $auth)
    {
<<<<<<< HEAD
          $this->stripe=new StripeApp();
          $this->middleware(function ($request, $next) {
=======
        $this->middleware(function ($request, $next) {
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
           // $where.=' AND ord.order_id ='.$req['search']['order_id'];
              $where.=' AND ord.order_id LIKE "%'.$req['search']['order_id'].'%"';

=======
            $where.=' AND ord.order_id ='.$req['search']['order_id'];
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
         $orders = DB::select('SELECT DATE_FORMAT(ord.created_at,"%m/%d/%Y %h:%i:%s") as date,ord.order_id,concat(seller.first_name," ",seller.last_name) as seller_name,sts.name as status FROM `cc_order` as ord LEFT JOIN cc_users as seller on seller.id=ord.seller_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id '.$where.' GROUP BY ord.order_id ORDER BY `order_id` DESC');
=======
         $orders = DB::select('SELECT ord.created_at as date,ord.order_id,concat(seller.first_name," ",seller.last_name) as seller_name,sts.name as status FROM `cc_order` as ord LEFT JOIN cc_users as seller on seller.id=ord.seller_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id '.$where.' GROUP BY ord.order_id ORDER BY `order_id` DESC');
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
            //$where.=' AND ord.order_id ='.$req['search']['order_id'];
              $where.=' AND ord.order_id LIKE "%'.$req['search']['order_id'].'%"';

=======
            $where.=' AND ord.order_id ='.$req['search']['order_id'];
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
         $orders = DB::select('SELECT DATE_FORMAT(ord.created_at,"%m/%d/%Y %h:%i:%s") as date,ord.order_id,concat(buyer.first_name," ",buyer.last_name) as buyer_name,sts.name as status FROM `cc_order` as ord LEFT JOIN cc_users as buyer on buyer.id=ord.buyer_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id  '.$where.' GROUP BY ord.order_id ORDER BY `order_id` DESC');
=======
         $orders = DB::select('SELECT ord.created_at as date,ord.order_id,concat(buyer.first_name," ",buyer.last_name) as buyer_name,sts.name as status FROM `cc_order` as ord LEFT JOIN cc_users as buyer on buyer.id=ord.buyer_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id  '.$where.' GROUP BY ord.order_id ORDER BY `order_id` DESC');
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
    public function orderLabelGenate(Request $request){
<<<<<<< HEAD
      $req=$request->all();
              $order=Order::orderSummary($req['order_id']);
              $seller_address=Address::getUserSellerAddress($order['basic'][0]->seller_id);
              $from_state=$seller_address[0]->state;
              $from = array(
                 'from_name' => $seller_address[0]->fname." ".$seller_address[0]->lname,
                 'from_firm' => '',
                 'from_address1' => $seller_address[0]->address1,
                 'from_address2' =>  $seller_address[0]->address2,
                 'from_city' =>  $seller_address[0]->city,
                 'from_state' => $from_state,
                 'from_zip5' =>  $seller_address[0]->zip_code);
              
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
        $weight_in_ounces = round(\DB::table('order_items')->where('order_id', $order['basic'][0]->order_id)->sum('weight'),1);
        $service_type ='Priority';
        
        
              // TESTING Credentials 
        $RequesterID = env('ENDICIA_REQUESTER_ID', 'lxxx');
        $AccountID = env('ENDICIA_ACCOUNT_ID','2541903'); 
        $PassPhrase = env('ENDICIA_PASS_PHRASE','Dotcom123');

        

        

        /*
        //LIVE Credentials
        $RequesterID = env('ENDICIA_REQUESTER_ID', '1234');
        $AccountID = env('ENDICIA_ACCOUNT_ID','1246166'); 
        $PassPhrase = env('ENDICIA_PASS_PHRASE','ChrysalisCostumes29');  

        */

        $endicia_xml = '<x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:lab="www.envmgr.com/LabelService">
        <x:Header/>
        <x:Body>
            <lab:GetPostageLabel>
                <lab:LabelRequest LabelType="Default" LabelSize="4X6" ImageFormat="PDF">
                    <lab:MailClass>'.$service_type.'</lab:MailClass>
                    <lab:WeightOz>'.$weight_in_ounces.'</lab:WeightOz>
                    <lab:RequesterID>'.$RequesterID.'</lab:RequesterID>
                    <lab:AccountID>'.$AccountID.'</lab:AccountID>
                    <lab:PassPhrase>'.$PassPhrase.'</lab:PassPhrase>
                    <lab:PartnerCustomerID>100</lab:PartnerCustomerID>
                    <lab:PartnerTransactionID>200</lab:PartnerTransactionID>
                    <lab:FromName>'.$from['from_name'].'</lab:FromName>
                    <lab:FromCompany></lab:FromCompany>
                    <lab:ReturnAddress1>'.$from['from_address2'].'</lab:ReturnAddress1>
                    <lab:ReturnAddress2>'.$from['from_address1'].'</lab:ReturnAddress2>
                    <lab:FromCity>'.$from['from_city'].'</lab:FromCity>
                    <lab:FromState>'.$from['from_state'].'</lab:FromState>
                    <lab:FromPostalCode>'.$from['from_zip5'].'</lab:FromPostalCode>
                    <lab:ToName>'.$to['to_name'].'</lab:ToName>
                    <lab:ToCompany></lab:ToCompany>
                    <lab:ToAddress1>'.$to['to_address2'].'</lab:ToAddress1>
                    <lab:ToAddress2>'.$to['to_address1'].'</lab:ToAddress2>
                    <lab:ToCity>'.$to['to_city'].'</lab:ToCity>
                    <lab:ToState>'.$to['to_state'].'</lab:ToState>
                    <lab:ToPostalCode>'.$to['to_zip5'].'</lab:ToPostalCode>
                </lab:LabelRequest>
            </lab:GetPostageLabel>
            </x:Body>
        </x:Envelope>';
        
        //dd($endicia_xml);
        
         //$endicia_api_endpoint = Config::get('constants.ENDICIA_APIENDPOINT');
       //TEST Credentials
         $endicia_api_endpoint = env('ENDICIA_API_ENDPOINT','http://elstestserver.endicia.com/LabelService/EwsLabelService.asmx');

          // LIVE Credentials
        // $endicia_api_endpoint = env('ENDICIA_API_ENDPOINT','https://labelserver.endicia.com/LabelService/EwsLabelService.asmx');

        try {
            $ch = curl_init();

            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            curl_setopt($ch, CURLOPT_URL, $endicia_api_endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $endicia_xml );

            $response = curl_exec($ch);
            
            //dd($response);
            
            $namespaceResponse = str_replace("www.envmgr.com/LabelService", "http://www.envmgr.com/LabelService", $response);
            
            $plainXML = $this->mungXML($namespaceResponse);
            $arrayResult = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

            if(isset($arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['Status'])){
                if($arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['Status'] == 0){
                    $resArr = $arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse'];
                    $track_id=$resArr['TrackingNumber'];
                    $amount=$resArr['FinalPostage'];
                    $fileName = 'uspslabel/'.$track_id.'.pdf';
                    $contents = base64_decode($resArr['Base64LabelImage']);
                    file_put_contents($fileName,$contents);
                    Order::orderShippingmentProcess($req,$track_id,$amount);
                    if($req['status']=="authorized"){
                        $this->submitForSettlement($req);
                    }
                    $this->shippingMail($req,$track_id,'USPS');
                     $this->my_api_log("Generated Label for Order #".$req['order_id'], $endicia_xml, $response, "Endicia");
                    Session::flash('success', 'Order Shipping process started'); 
                    return Redirect::back();
                }else{
                   $this->my_api_log("Error in generating Label for Order #".$req['order_id'].". Error:".$arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['ErrorMessage'], $endicia_xml, $response, "Endicia");
                    Session::flash('error', $arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['ErrorMessage']); 
                    return Redirect::back();
                }
            }else{
               $this->my_api_log("Error in generating Label for Order #".$req['order_id'].". Error:".$arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['ErrorMessage'], $endicia_xml, $response, "Endicia");
                Session::flash('error', 'label not generated. Try Again'); 
                return Redirect::back();
            }
            if (FALSE === $response)
                throw new Exception(curl_error($ch), curl_errno($ch));

            // ...process $content now
        } catch(\Exception $e) {
            //trigger_error(sprintf('Curl failed with error #%d: %s',$e->getCode(), $e->getMessage()),E_USER_ERROR);
            Session::flash('error', $e->getMessage()); 
            return Redirect::back();
        }
      }
      
       public function  my_api_log($message, $api_request, $api_result, $api_type)
      {
        
       
        // Check message
        if($message == '') {
           $message = 'Message is empty';
        }
       
        // Get IP address
        if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
          $remote_addr = "REMOTE_ADDR_UNKNOWN";
        }
       
        // Get requested script
        if( ($request_uri = $_SERVER['REQUEST_URI']) == '') {
          $request_uri = "REQUEST_URI_UNKNOWN";
        }
       
        // Escape values
       
       
         $api_data = array(
                'api_type' => $api_type,
                'remote_addr' => $remote_addr,
                'request_uri' => $request_uri,
                'api_request' => $api_request,
                'api_response' => $api_result,
                'message' => $message,
                'log_date' => date('Y-m-d H:i:s')
            );
        $savePostData =DB::table('api_log')->insert($api_data);
      }



      public function usps($req){
        $order=Order::orderSummary($req['order_id']);
        $user_id=Config::get('constants.USPS');
        $shipping_url=Config::get('constants.USPS_SHIPPING_URL');
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
          $weight_in_ounces = 0.1;
          $service_type ='PRIORITY';
          $xml='<?xml version="1.0" encoding="UTF-8" ?><DelivConfirmCertifyV4.0Request USERID="'.$user_id.'"><Revision>2</Revision><ImageParameters /><FromName>'.$from['from_name'].'</FromName><FromFirm> </FromFirm><FromAddress1>'.$from['from_address1'].'</FromAddress1><FromAddress2>'.$from['from_address2'].'</FromAddress2><FromCity>'.$from['from_city'].'</FromCity><FromState>'.$from['from_state'].'</FromState><FromZip5>'.$from['from_zip5'].'</FromZip5><FromZip4/><ToName>'.$to['to_name'].'</ToName><ToFirm> </ToFirm><ToAddress1>'.$to['to_address2'].'</ToAddress1><ToAddress2>'.$to['to_address2'].'</ToAddress2><ToCity>'.$to['to_city'].'</ToCity><ToState>'.$to['to_state'].'</ToState><ToZip5>'.$to['to_zip5'].'</ToZip5><ToZip4 /><WeightInOunces>'.$weight_in_ounces.'</WeightInOunces><ServiceType>'.$service_type.'</ServiceType><ImageType>TIF</ImageType></DelivConfirmCertifyV4.0Request>';
            $ch = curl_init($shipping_url.'&XML='.urlencode($xml));
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $output = curl_exec($ch);
            curl_close($ch);
            $collection = new \Illuminate\Support\Collection(json_decode(json_encode(simplexml_load_string($this->removeNamespaceFromXML($output))), true));
            if(!isset($collection->toArray()['Number'])){
              $track_id=$collection->toArray()['DeliveryConfirmationNumber'];
              $amount=$collection->toArray()['Postage'];
              $fileName = 'uspslabel/'.$track_id.'.pdf';
              $array_text = array("_");
              $array_replace =  "+";
              $contents = base64_decode(str_replace($array_text, $array_replace, $collection->toArray()['DeliveryConfirmationLabel']))  ;
              file_put_contents($fileName,$contents);
              Order::orderShippingmentProcess($req,$track_id,$amount);
              if($req['status']=="authorized"){
                    $this->submitForSettlement($req);
              }
              Session::flash('success', 'Order Shipping process started'); 
              return Redirect::back(); 
            }else{
              Session::flash('error', $collection->toArray()['Description']); 
              return Redirect::back(); 
            }
      }

    private function endiciaUsps($req){
        $order=Order::orderSummary($req['order_id']);
        $from = array(
                   'from_name' => $order['basic'][0]->pay_firstname.' '.$order['basic'][0]->pay_lastname,
                   'from_firm' => '',
                   'from_address1' => $order['basic'][0]->pay_address_1,
                   'from_address2' => $order['basic'][0]->pay_address_2,
                   'from_city' => $order['basic'][0]->pay_city,
                   'from_state' => $order['basic'][0]->pay_state,
                   'from_zip5' =>  $order['basic'][0]->pay_zipcode);
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
        $weight_in_ounces = round(\DB::table('order_items')->where('order_id', $order['basic'][0]->order_id)->sum('weight'),1);
        $service_type ='Priority';
        
        $RequesterID = "lxxx"; 
        $AccountID = "2541903"; 
        $PassPhrase = "Dotcom123"; 

        $endicia_xml = '<x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:lab="www.envmgr.com/LabelService">
        <x:Header/>
        <x:Body>
            <lab:GetPostageLabel>
                <lab:LabelRequest LabelType="Default" LabelSize="4X6" ImageFormat="PDF">
                    <lab:MailClass>'.$service_type.'</lab:MailClass>
                    <lab:WeightOz>'.$weight_in_ounces.'</lab:WeightOz>
                    <lab:RequesterID>'.$RequesterID.'</lab:RequesterID>
                    <lab:AccountID>'.$AccountID.'</lab:AccountID>
                    <lab:PassPhrase>'.$PassPhrase.'</lab:PassPhrase>
                    <lab:PartnerCustomerID>100</lab:PartnerCustomerID>
                    <lab:PartnerTransactionID>200</lab:PartnerTransactionID>
                    <lab:FromName>'.$from['from_name'].'</lab:FromName>
                    <lab:FromCompany></lab:FromCompany>
                    <lab:ReturnAddress1>'.$from['from_address2'].'</lab:ReturnAddress1>
                    <lab:ReturnAddress2>'.$from['from_address1'].'</lab:ReturnAddress2>
                    <lab:FromCity>'.$from['from_city'].'</lab:FromCity>
                    <lab:FromState>'.$from['from_state'].'</lab:FromState>
                    <lab:FromPostalCode>'.$from['from_zip5'].'</lab:FromPostalCode>
                    <lab:ToName>'.$to['to_name'].'</lab:ToName>
                    <lab:ToCompany></lab:ToCompany>
                    <lab:ToAddress1>'.$to['to_address2'].'</lab:ToAddress1>
                    <lab:ToAddress2>'.$to['to_address1'].'</lab:ToAddress2>
                    <lab:ToCity>'.$to['to_city'].'</lab:ToCity>
                    <lab:ToState>'.$to['to_state'].'</lab:ToState>
                    <lab:ToPostalCode>'.$to['to_zip5'].'</lab:ToPostalCode>
                </lab:LabelRequest>
            </lab:GetPostageLabel>
            </x:Body>
        </x:Envelope>';
        
        //dd($endicia_xml);
        
        $endicia_api_endpoint = 'http://elstestserver.endicia.com/LabelService/EwsLabelService.asmx';

        try {
            $ch = curl_init();

            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            curl_setopt($ch, CURLOPT_URL, $endicia_api_endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $endicia_xml );

            $response = curl_exec($ch);
            
            //dd($response);
            
            $namespaceResponse = str_replace("www.envmgr.com/LabelService", "http://www.envmgr.com/LabelService", $response);
            
            $plainXML = $this->mungXML($namespaceResponse);
            $arrayResult = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

            if(isset($arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['Status'])){
                if($arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['Status'] == 0){
                    $resArr = $arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse'];
                    $track_id=$resArr['TrackingNumber'];
                    $amount=$resArr['FinalPostage'];
                    $fileName = 'uspslabel/'.$track_id.'.pdf';
                    $contents = base64_decode($resArr['Base64LabelImage']);
                    file_put_contents($fileName,$contents);
                    Order::orderShippingmentProcess($req,$track_id,$amount);
                    if($req['status']=="authorized"){
                        //$this->submitForSettlement($req);
                    }
                    $this->shippingMail($req,$track_id,'USPS');
                    Session::flash('success', 'Order Shipping process started'); 
                    return Redirect::back();
                }else{
                    Session::flash('error', $arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['ErrorMessage']); 
                    return Redirect::back();
                }
            }else{
                Session::flash('error', 'label not generated. Try Again'); 
                return Redirect::back();
            }
            if (FALSE === $response)
                throw new Exception(curl_error($ch), curl_errno($ch));

            // ...process $content now
        } catch(\Exception $e) {
            //trigger_error(sprintf('Curl failed with error #%d: %s',$e->getCode(), $e->getMessage()),E_USER_ERROR);
            Session::flash('error', $e->getMessage()); 
            return Redirect::back();
        }
      }
      
      
    private function shippingMail($req,$track_id,$type){
      $subtotal="0.00";
      $total_shiping="0.00";
      $store_credits  ="0.00";
      $coupon_code  ="0.00";
      $order_info=Order::orderMetaInfo($req['order_id']);
      $order_id=$req['order_id'];
      $address=array('shipping_firstname'=>$order_info[0]->shipping_firstname,
                                 'shipping_lastname'=>$order_info[0]->shipping_lastname,
                                 'shipping_address_1'=>$order_info[0]->shipping_address_1,
                                 'shipping_address_2'=>$order_info[0]->shipping_address_2,
                                 'shipping_city'=>$order_info[0]->shipping_city,
                                 'shipping_state'=>$order_info[0]->shipping_state,
                                 'shipping_postcode'=>$order_info[0]->shipping_postcode,
                              );
      $seller_info=Order::getUserInfo($order_info[0]->seller_id);
      $cc_details=DB::Select('SELECT *  FROM `cc_creditcard` WHERE `id` ='.$order_info[0]->cc_id)[0];
      $price=DB::Select('SELECT *  FROM `cc_order_total` WHERE `order_id` ='.$order_id);
      $items=DB::Select('SELECT *  FROM `cc_order_items` WHERE `order_id` ='.$order_id);
      foreach ($items as $key => $value) {
        $costumes=DB::Select('SELECT dsr.name as costume_name,cst.*,cstopt.attribute_option_value  as is_film,img.image,itms.*,ord.shipping_est FROM cc_costumes as cst LEFT JOIN cc_costume_description as dsr on dsr.costume_id=cst.costume_id  LEFT JOIN cc_costume_attribute_options as cstopt on cstopt.costume_id=cst.costume_id and cstopt.attribute_id="'.Config::get('constants.IS_FILMY').'" LEFT JOIN cc_costume_image as img on img.costume_id=cst.costume_id and img.type="1" RIGHT JOIN cc_order_items as itms on itms.costume_id=cst.costume_id and itms.order_id='.$order_id.' LEFT JOIN cc_order as ord on ord.order_id=itms.order_id WHERE cst.costume_id='.$value->costume_id);
        $mail_costumes=array('costume_name'=>$costumes[0]->costume_name, 
                                 'size'=>$costumes[0]->size, 
                                 'condition'=>$costumes[0]->condition, 
                                 'is_film'=>$costumes[0]->is_film, 
                                 'price'=>$costumes[0]->price, 
                                 'order_id'=>  $order_id, 
                                  'qty'=> $costumes[0]->qty, 
                                 'image'=>$costumes[0]->image,
                                 'shipping_est'=>$costumes[0]->shipping_est,
                        );
     
        $mail_order['items'][]= $mail_costumes;
      }
      foreach($price as $prc){
        if($prc->title=="Subtotal"){
            $subtotal=$prc->value;
        }
        if($prc->title=="Shipping"){
            $total_shiping=$prc->value;
        }
        if($prc->title=="Store Credits"){
            $store_credits=$prc->value;
        }
         if($prc->title=="Coupon code"){
            $coupon_code=$prc->value;
        }
      }
                $mail_order['subtotal']=$subtotal;
                $mail_order['shipping']=$total_shiping;
                $mail_order['store_credits']=$store_credits;
                $mail_order['coupon_code']=$coupon_code;
                $mail_order['total']=$order_info[0]->total;
                $mail_order['seller_name']=$seller_info[0]->first_name." ".$seller_info[0]->last_name;
                $mail_order['location_from']="Expected Shipping from ".$seller_info[0]->city.", ".$seller_info[0]->state;
                $mail_order['zip_code']=$seller_info[0]->zip_code;
                $mail_order['order_id']=$order_id;
                $mail_order['address']=$address;
                $mail_order['card_details']=$cc_details;
                $mail_order['type']=$type;
                $mail_order['track_id']=$track_id;
                $buyer_id=$order_info[0]->buyer_id;
               
                $sent=Mail::send('emails.order_shipping',array("mail_order"=>$mail_order), function ($m) use( $buyer_id,$order_id) {
                $buyer_info=Order::getUserInfo($buyer_id);
       
                $m->to($buyer_info[0]->email, $buyer_info[0]->first_name." ".$buyer_info[0]->last_name);
                    $m->subject('Order #'.$order_id.' Shipping Details');
                });
    }
      
      
      // FUNCTION TO MUNG THE XML SO WE DO NOT HAVE TO DEAL WITH NAMESPACE
      private function mungXML($xml)
      {
            $obj = SimpleXML_Load_String($xml);
            if ($obj === FALSE) return $xml;

            // GET NAMESPACES, IF ANY
            $nss = $obj->getNamespaces(TRUE);
            if (empty($nss)) return $xml;

            // CHANGE ns: INTO ns_
            $nsm = array_keys($nss);
            foreach ($nsm as $key)
            {
                // A REGULAR EXPRESSION TO MUNG THE XML
                $rgx
                = '#'               // REGEX DELIMITER
                . '('               // GROUP PATTERN 1
                . '\<'              // LOCATE A LEFT WICKET
                . '/?'              // MAYBE FOLLOWED BY A SLASH
                . preg_quote($key)  // THE NAMESPACE
                . ')'               // END GROUP PATTERN
                . '('               // GROUP PATTERN 2
                . ':{1}'            // A COLON (EXACTLY ONE)
                . ')'               // END GROUP PATTERN
                . '#'               // REGEX DELIMITER
                ;
                // INSERT THE UNDERSCORE INTO THE TAG NAME
                $rep
                = '$1'          // BACKREFERENCE TO GROUP 1
                . '_'           // LITERAL UNDERSCORE IN PLACE OF GROUP 2
                ;
                // PERFORM THE REPLACEMENT
                $xml =  preg_replace($rgx, $rep, $xml);
            }
            return $xml;
        }
      
      
=======
    // $req=$request->all();
    //    $from = array(
    //            'from_name' => 'John Smith',
    //            'from_firm' => 'ABC Inc.',
    //            'from_address1' => '123 Main St.',
    //            'from_address2' => 'Suite 100',
    //            'from_city' => 'Anytown',
    //            'from_state' => 'PA',
    //            'from_zip5' => '12345');
    
    //  $to = array(
    //            'to_name' => 'Mike Smith',
    //            'to_firm' => 'XYZ Inc.',
    //            'to_address1' => '456 2nd St.',
    //            'to_address2' => 'Apt B',
    //            'to_city' => 'Othertown',
    //            'to_state' => 'NY',
    //            'to_zip5' => '67890');
    
    // $dimensions = array(
    //            'width' => 5.5,
    //            'length' => 11,
    //            'height' => 11,
    //            'girth' => 11);
    //   $container = "VARIABLE";
    //   $size = "REGULAR";
    //   $insured_amount = 0;
    //   $weight_in_ounces = 0;
    //   $service_type = 'Retail Ground';

    //   $ch = curl_init('https://secure.shippingapis.com/ShippingAPI.dll?API=DelivConfirmCertifyV4&XML=%3C?xml%20version=%221.0%22%20encoding=%22UTF-8%22%20?%3E%3CDelivConfirmCertifyV4.0Request%20USERID=%22228OURBA2607%22%20PASSWORD=%22728ZK94KL112%22%3E%3CRevision%3E2%3C/Revision%3E%3CImageParameters%20/%3E%3CFromName%3EJohn%3C/FromName%3E%3CFromFirm%3E%20%3C/FromFirm%3E%3CFromAddress1%3EFlat%201%3C/FromAddress1%3E%3CFromAddress2%3ERoad%201%3C/FromAddress2%3E%3CFromCity%3ENY%3C/FromCity%3E%3CFromState%3ENY%3C/FromState%3E%3CFromZip5%3E12345%20%3C/FromZip5%3E%3CFromZip4/%3E%3CToName%3E%20Mozilla%20Foundation%20%3C/ToName%3E%3CToFirm%3E%20%3C/ToFirm%3E%3CToAddress1%3E%20Building%20K%20%3C/ToAddress1%3E%3CToAddress2%3E%201981%20Landings%20Drive%20%3C/ToAddress2%3E%3CToCity%3E%20Mountain%20View%3C/ToCity%3E%3CToState%3E%20CA%20%3C/ToState%3E%3CToZip5%3E%20%20%2094043%20%3C/ToZip5%3E%3CToZip4%20/%3E%3CWeightInOunces%3E%203%20%3C/WeightInOunces%3E%3CServiceType%3EPriority%3C/ServiceType%3E%3CImageType%3ETIF%3C/ImageType%3E%3C/DelivConfirmCertifyV4.0Request%3E');

    //     curl_setopt($ch, CURLOPT_HEADER, false);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    //     $output = curl_exec($ch);
    //     curl_close($ch);
    //     $collection = new \Illuminate\Support\Collection(json_decode(json_encode(simplexml_load_string($this->removeNamespaceFromXML($output))), true));
    //     if(!isset($collection->toArray()['Number'])){
    //       $track_id=$collection->toArray()['DeliveryConfirmationNumber'];
    //       $fileName = 'uspslabel/'.$track_id.'.pdf';
    //       $array_text = array("_");
    //       $array_replace =  "+";
    //       $contents = base64_decode(str_replace($array_text, $array_replace, $collection->toArray()['DeliveryConfirmationLabel']))  ;
    //       file_put_contents($fileName,$contents);
    //       Order::orderShippingmentProcess($req,$track_id);
    //       Session::flash('success', 'Order Shipping process started'); 
    //       return Redirect::back(); 
    //     }else{
    //       Session::flash('success', $collection->toArray()['Description']); 
    //       return Redirect::back(); 
    //     }
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
      $weight_in_ounces = 0.1;
      $service_type ='PRIORITY';
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
 
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
     public function downlaodTrankDetails($track_id,$type="usps"){
        // $file=public_path("uspslabel/".$track_id.".pdf");
        // return Response::download($file);
        if($type=="usps"){
          $file=public_path("uspslabel/".$track_id.".pdf");
          return Response::download($file);
        }
        if($type=="fedex"){
          $file=public_path("fedexlabel/".$track_id.".pdf");
          return Response::download($file);
        }
    }
     public function orderShippingList($order_id){
        $res=Order::orderbuyerCheck($order_id);
        if($res=="true"){
          $title="Order Shippings";
          return view('frontend.orders.order_shippings',compact('order_id',$order_id))->with('title',$title);
        }else{
         Session::flash('error', 'Order info not found');
         return Redirect::to('/dashboard');
      }
    }
    public function orderShippingData(Request $request,$order_id)
    {
        $req=$request->all();   
        $shippings = DB::select('SELECT id,Ucase(carrier_type) as type,carrier_code,Date_format(created_at,"%m/%d/%Y %h:%i %p") as date,if(is_notify="1","Yes","No") as is_notified,concat("$",amount) as price FROM cc_order_ship_track where order_id='.$order_id.' ORDER BY `order_id` DESC');
        return response()->success(compact('shippings'));
  
    }
     public function orderTransactionsList($order_id){
        $res=Order::orderbuyerCheck($order_id);
        if($res=="true"){
          $title="Order Transactions";
          return view('frontend.orders.order_transactions',compact('order_id',$order_id))->with('title',$title);
        }else{
         Session::flash('error', 'Order info not found');
         return Redirect::to('/dashboard');
      }
    }
    public function orderTransactionsData(Request $request,$order_id)
    {
       $req=$request->all();   
        $transactions = DB::select('SELECT id,CONCAT(UCASE(LEFT(type, 1)), SUBSTRING(type, 2)) as transaction_type,CONCAT(UCASE(LEFT(status, 1)), SUBSTRING(status, 2)) as transaction_status,DATE_FORMAT(created_at,"%m/%d/%Y %h:%i %p") as date,concat("$",FORMAT(amount,2)) as price  FROM `cc_transactions` WHERE `order_id`='.$order_id.' ORDER BY `id` DESC');
        return response()->success(compact('transactions'));
  
    }

    public function myCostumesListData(Request $request)
    {
        $req=$request->all();
        $where='where cst.created_by='.Auth::user()->id.'';
        $having='';
        if(!empty($req['search'])){
           if(!empty($req['search']['costume_name']) ){
              $where.=' AND dscr.name LIKE "%'.$req['search']['costume_name'].'%"';
          }
          if (!empty($req['search']['from_date'])) {
            $where .= ' AND  cst.created_at >="'.date('Y-m-d 00:00:01', strtotime($req['search']['from_date'])).'"';
          }
          if (!empty($req['search']['date_end'])) {
            $where .= ' AND  cst.created_at  <= "'.date('Y-m-d 23:59:59', strtotime($req['search']['date_end'])).'"';
          }
          if(isset($req['search']['status'])){
          if($req['search']['status']!=""){
              $where.=' AND cst.status="'.$req['search']['status'].'"';
          }
        }
        }
       $my_costumes = DB::Select('SELECT cst.costume_id,dscr.name,CONCAT(UCASE(LEFT(cst.status, 1)),LCASE(SUBSTRING(cst.status, 2))) as status,DATE_FORMAT(cst.created_at,"%m/%d/%Y %h:%i:%s") as date from cc_costumes as cst LEFT JOIN cc_costume_description as dscr on dscr.costume_id=cst.costume_id '.$where.'');
        return response()->success(compact('my_costumes'));
  
    }
      private function submitForSettlement($req){
        try {
              $data=$this->stripe->charge_uncapture($req['transation_api_id']);
         }catch(Exception $e){
                $data=array('result'=>0,'message'=>$e->getMessage());
                return $data;
         }
  
    
       $transaction=array('order_id'=>$req['order_id'],
                    'user_id'=>Auth::user()->id,
                    'amount'=>$data['amount']/100,
                    'api_transaction_no'=>$data['id'],
                    'status'=>'Charged',
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s')
                      );
       $transaction_id=Site_model::insert_get_id('transactions',$transaction);
       $data=array('status'=>"Charged",
                   'updated_at'=>date('Y-m-d h:i:s')
                      );
       $cond=array('id'=>$req['transation_id']);
       Site_model::update_data('transactions',$data,$cond);
       return true;
      
      }
=======
     public function downlaodTrankDetails($track_id){
        $file=public_path("uspslabel/".$track_id.".pdf");
        return Response::download($file);
    }
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

}
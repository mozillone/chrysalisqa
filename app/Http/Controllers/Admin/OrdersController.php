<?php namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Order;
use App\Address;
use Session;
use Usps\InternationalLabel;
use Config;
use Mail;
use Response;
use App\Helpers\Site_model;
//use App\BraintreeApp;
use App\Helpers\StripeApp;
use Exception;
use App\Helpers\ExportFile;
use App\Helpers\Endicia\Endicia;

use App\Helpers\FedEx\ShipService,
    App\Helpers\FedEx\ShipService\ComplexType,
    App\Helpers\FedEx\ShipService\SimpleType;  
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
       //$this->braintreeApi = new BraintreeApp();
       $this->stripe=new StripeApp();
       $this->csv = new ExportFile();
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
            $where.=' AND ord.order_id ="'.$req['search']['order_id'].'"';
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
        $orders = DB::select('SELECT ord.order_id,concat(usr.first_name," ",usr.last_name) as user_name,concat(usr1.first_name," ",usr1.last_name) as seller_name,concat("$",ord.total) as amount,DATE_FORMAT(ord.created_at,"%m/%d/%Y %h:%i %p") as date,sts.name as status,GROUP_CONCAT(DISTINCT(itms.costume_name) SEPARATOR ",") as costume_name FROM `cc_order` as ord LEFT JOIN cc_order_items as itms on itms.order_id=ord.order_id LEFT JOIN cc_users as usr on usr.id=ord.buyer_id  LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id  LEFT JOIN cc_users as usr1 on usr1.id=ord.seller_id  '.$where.' GROUP BY ord.order_id '.$having.' ORDER BY `order_id` DESC');
        return response()->success(compact('orders'));
  
    }
    public function ordersCsvExport(Request $request){
       $req = $request->all();
       if(!empty($req['data'])){
        $ids=implode($req['data'],",");
 
      $result = DB::Select('SELECT ord.order_id as OrderID,concat(usr.first_name," ",usr.last_name) as UserName,concat(usr1.first_name," ",usr1.last_name) as SellerName,concat("$",ord.total) as Amount,DATE_FORMAT(ord.created_at,"%m/%d/%Y %h:%i %p") as Date,sts.name as Status FROM `cc_order` as ord LEFT JOIN cc_users as usr on usr.id=ord.buyer_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id LEFT JOIN cc_users as usr1 on usr1.id=ord.seller_id where ord.order_id in ('. $ids.')');
        $data = json_decode(json_encode($result), true);
      $this->csv->csvExportFile($data);
    }
    else{
       $result = DB::select('SELECT ord.order_id as OrderID,concat(usr.first_name," ",usr.last_name) as UserName,concat(usr1.first_name," ",usr1.last_name) as SellerName,concat("$",ord.total) as Amount,DATE_FORMAT(ord.created_at,"%m/%d/%Y %h:%i %p") as Date,sts.name as Status FROM `cc_order` as ord LEFT JOIN cc_users as usr on usr.id=ord.buyer_id LEFT JOIN cc_users as usr1 on usr1.id=ord.seller_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id');
       $data = json_decode(json_encode($result), true);
       $this->csv->csvExportFile($data);
    }
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
         Session::flash('success', 'Order Transaction is completed successfully'); 
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
      if($req['carrier_type']=="USPS"){
        //$this->usps($req);
        $this->endiciaUsps($req);
        return Redirect::back();
      }
      if($req['carrier_type']=="FedEx"){
        $this->fedex($req);
        return Redirect::back();
      }
    }
    private function usps($req){
      $order=Order::orderSummary($req['order_id']);
      $seller_address=Address::getUserSellerAddress($order['basic'][0]->seller_id);
      $user_id=Config::get('constants.USPS');
      $password=Config::get('constants.USPS_Password');
      $shipping_url=Config::get('constants.USPS_SHIPPING_URL');
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
        $weight_in_ounces = $req['weight'] ;
        $service_type =$req['method'];
        
        $xml='<?xml version="1.0" encoding="UTF-8" ?><DeliveryConfirmationV4.0Request USERID="'.$user_id.'"><Revision>2</Revision><ImageParameters /><FromName>'.$from['from_name'].'</FromName><FromFirm> </FromFirm><FromAddress1>'.$from['from_address1'].'</FromAddress1><FromAddress2>'.$from['from_address2'].'</FromAddress2><FromCity>'.$from['from_city'].'</FromCity><FromState>'.$from['from_state'].'</FromState><FromZip5>'.$from['from_zip5'].'</FromZip5><FromZip4/><ToName>'.$to['to_name'].'</ToName><ToFirm> </ToFirm><ToAddress1>'.$to['to_address2'].'</ToAddress1><ToAddress2>'.$to['to_address2'].'</ToAddress2><ToCity>'.$to['to_city'].'</ToCity><ToState>'.$to['to_state'].'</ToState><ToZip5>'.$to['to_zip5'].'</ToZip5><ToZip4 /><WeightInOunces>'.$weight_in_ounces.'</WeightInOunces><ServiceType>'.$service_type.'</ServiceType><ImageType>TIF</ImageType></DeliveryConfirmationV4.0Request>';
        //dd($shipping_url.'&XML='.$xml);
        
          $ch = curl_init($endicia_api_endpoint.'&XML='.urlencode($xml));
          curl_setopt($ch, CURLOPT_HEADER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          $output = curl_exec($ch);
          curl_close($ch);
          //dd($output);
          $collection = new \Illuminate\Support\Collection(json_decode(json_encode(simplexml_load_string($this->removeNamespaceFromXML($output))), true));

          //dd($collection);
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
            $this->shippingMail($req,$track_id,'USPS');
            Session::flash('success', 'Order Shipping process started'); 
            return true;
          }else{
            Session::flash('error', $collection->toArray()['Description']); 
            return true;
          }

    }
      
    private function endiciaUsps($req){
    
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
        $weight_in_ounces = round($req['weight']) ;
        $service_type =$req['method'];
         
        // $RequesterID = Config::get('constants.ENDICIA_REQUESTERID'); 
        // $AccountID = Config::get('constants.ENDICIA_ACCOUNTID'); 
        // $PassPhrase = Config::get('constants.ENDICIA_PASSPHRASE');
        
        // TESTING Credentials 
        $RequesterID = env('ENDICIA_REQUESTER_ID', 'lxxx');
        $AccountID = env('ENDICIA_ACCOUNT_ID','2541903'); 
        $PassPhrase = env('ENDICIA_PASS_PHRASE','Dotcom123');

        

        /*
        //LIVE Credentials
         $RequesterID = env('ENDICIA_REQUESTER_ID', '1234');
        $AccountID = env('ENDICIA_ACCOUNT_ID','1246166'); 
        $PassPhrase = env('ENDICIA_PASS_PHRASE','ChrysalisCostumes29');*/


        $endicia_xml = '<x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:lab="www.envmgr.com/LabelService" >
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
                    <lab:ReturnAddress1>'.trim($from['from_address2']).'</lab:ReturnAddress1>
                    <lab:ReturnAddress2>'.$from['from_address1'].'</lab:ReturnAddress2>
                    <lab:FromCity>'.$from['from_city'].'</lab:FromCity>
                    <lab:FromState>'.$from['from_state'].'</lab:FromState>
                    <lab:FromPostalCode>'.$from['from_zip5'].'</lab:FromPostalCode>
                    <lab:ToName>'.trim($to['to_name']).'</lab:ToName>
                    <lab:ToCompany></lab:ToCompany>
                    <lab:ToAddress1>'.trim($to['to_address2']).'</lab:ToAddress1>
                    <lab:ToAddress2>'.$to['to_address1'].'</lab:ToAddress2>
                    <lab:ToCity>'.$to['to_city'].'</lab:ToCity>
                    <lab:ToState>'.$to['to_state'].'</lab:ToState>
                    <lab:ToPostalCode>'.$to['to_zip5'].'</lab:ToPostalCode>
                </lab:LabelRequest>
            </lab:GetPostageLabel>
            </x:Body>
        </x:Envelope>';
       // echo "<pre>";
       // print_r($endicia_xml);
        //  echo "</pre>";
        
        //$endicia_api_endpoint = Config::get('constants.ENDICIA_APIENDPOINT');
       //TEST Credentials
       $endicia_api_endpoint = env('ENDICIA_API_ENDPOINT','http://elstestserver.endicia.com/LabelService/EwsLabelService.asmx');

          // LIVE Credentials
         //$endicia_api_endpoint = env('ENDICIA_API_ENDPOINT','https://labelserver.endicia.com/LabelService/EwsLabelService.asmx');
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
                     $this->my_api_log("Generated Label for Order #".$req['order_id'], $endicia_xml, $response, "Endicia");
                    $this->shippingMail($req,$track_id,'USPS');
                    Session::flash('success', 'Order Shipping process started'); 
                    return true;
                }else{
                     $this->my_api_log("Error in generating Label for Order #".$req['order_id'].". Error:".$arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['ErrorMessage'], $endicia_xml, $response, "Endicia");
                    Session::flash('error', $arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['ErrorMessage']); 
                    Session::flash('error', $arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['ErrorMessage']); 
                    return true;
                }
            }else{
                 $this->my_api_log("Error in generating Label for Order #".$req['order_id'].". Error:".$arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['ErrorMessage'], $endicia_xml, $response, "Endicia");
                    Session::flash('error', $arrayResult['soap_Body']['GetPostageLabelResponse']['LabelRequestResponse']['ErrorMessage']); 
                Session::flash('error', 'label not generated. Try Again'); 
                return true;
            }
            if (FALSE === $response)
                throw new Exception(curl_error($ch), curl_errno($ch));

            // ...process $content now
        } catch(\Exception $e) {
            //trigger_error(sprintf('Curl failed with error #%d: %s',$e->getCode(), $e->getMessage()),E_USER_ERROR);
            Session::flash('error', $e->getMessage()); 
            return true;
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
      
      private function fedex($req){
          $order=Order::orderSummary($req['order_id']);
          $seller_email=$order['basic'][0]->seller_email;
          $seller_name=$order['basic'][0]->seller_name;
          if($order['basic'][0]->seller_phone){
            $seller_phone_no=$order['basic'][0]->seller_phone;
          }else{
            $seller_phone_no="1234567891";
          }
          $buyer_email=$order['basic'][0]->buyer_email;
          $buyer_name=$order['basic'][0]->buyer_name;
          if($order['basic'][0]->buyer_phone){
            $buyer_phone_no=$order['basic'][0]->buyer_phone;
          }else{
            $buyer_phone_no="1234567891";
          }

         
         // $from_address=Address::getUserSellerAddress($order['basic'][0]->seller_id);
          $from_address=Address::getUserSellerAddress($order['basic'][0]->seller_id);
          $from_addr=$from_address[0]->address2;
          $from_addr1=$from_address[0]->address1;
          $from_city=$from_address[0]->city;
          $from_state=$from_address[0]->state;
          $from_zip_code=$from_address[0]->zip_code;

         // $to_address=Address::getUserSellerAddress($order['basic'][0]->buyer_id);
          $shipping_state=Order::getStateAbbrev($order['basic'][0]->shipping_state);
          $to_addr=$order['basic'][0]->shipping_address_2;
          $to_addr1=$order['basic'][0]->shipping_address_1;
          $to_city=$order['basic'][0]->shipping_city;
          $to_state=$shipping_state;
          $to_zip_code=$order['basic'][0]->shipping_postcode;
         
          $userCredential = new ComplexType\WebAuthenticationCredential();
          $userCredential
              //->setKey(Config::get('constants.FedEx_Key'))
              //->setPassword(Config::get('constants.FedEx_Password'));
              ->setKey(env('FEDEX_KEY','Jrgrh9ckHvvUhvvF'))
              ->setPassword(env('FEDEX_PASSWORD','azVVnJyD7ehrYQKfpDjhBTKRA'));
          $webAuthenticationDetail = new ComplexType\WebAuthenticationDetail();
          $webAuthenticationDetail->setUserCredential($userCredential);
          $clientDetail = new ComplexType\ClientDetail();
          $clientDetail
              // ->setAccountNumber(Config::get('constants.FedEx_AccountNumber'))
              // ->setMeterNumber(Config::get('constants.FedEx_MeterNumber'));
              ->setAccountNumber(env('FEDEX_ACCOUNT_NUMBER','510087720'))
              ->setMeterNumber(env('FEDEX_METER_NUMBER','100336246'));
          $version = new ComplexType\VersionId();
          $version
              ->setMajor(12)
              ->setIntermediate(1)
              ->setMinor(0)
              ->setServiceId('ship');
          $shipperAddress = new ComplexType\Address();
          $shipperAddress
              ->setStreetLines([$from_addr])
              ->setCity($from_city)
              ->setStateOrProvinceCode($from_state)
              ->setPostalCode($from_zip_code)
              ->setCountryCode('US');
          $shipperContact = new ComplexType\Contact();
          $shipperContact
              ->setCompanyName('')
              ->setEMailAddress($seller_email)
              ->setPersonName($seller_name)
              ->setPhoneNumber($seller_phone_no);
          $shipper = new ComplexType\Party();
          $shipper
              //->setAccountNumber(Config::get('constants.FedEx_AccountNumber'))
              ->setAccountNumber(env('FEDEX_ACCOUNT_NUMBER','510087720'))
              ->setAddress($shipperAddress)
              ->setContact($shipperContact);
          $recipientAddress = new ComplexType\Address();
          $recipientAddress
              ->setStreetLines([$to_addr])
              ->setCity($to_city)
              ->setStateOrProvinceCode($to_state)
              ->setPostalCode($to_zip_code)
              ->setCountryCode('US');
          $recipientContact = new ComplexType\Contact();
          $recipientContact
              ->setPersonName($buyer_name)
              ->setPhoneNumber($buyer_phone_no);
          $recipient = new ComplexType\Party();
          $recipient
              ->setAddress($recipientAddress)
              ->setContact($recipientContact);
          $labelSpecification = new ComplexType\LabelSpecification();
          $labelSpecification
              ->setLabelStockType(new SimpleType\LabelStockType(SimpleType\LabelStockType::_PAPER_7X4point75))
              ->setImageType(new SimpleType\ShippingDocumentImageType(SimpleType\ShippingDocumentImageType::_PDF))
              ->setLabelFormatType(new SimpleType\LabelFormatType(SimpleType\LabelFormatType::_COMMON2D));
          $packageLineItem1 = new ComplexType\RequestedPackageLineItem();
          $packageLineItem1
              ->setSequenceNumber(1)
              // ->setItemDescription('Product description')
              // ->setDimensions(new ComplexType\Dimensions(array(
              //     'Width' => 10,
              //     'Height' => 10,
              //     'Length' => 25,
              //     'Units' => SimpleType\LinearUnits::_IN
              // )))
              ->setWeight(new ComplexType\Weight(array(
                  'Value' => round($req['weight']),
                  'Units' => SimpleType\WeightUnits::_LB
              )));

          $shippingChargesPayor = new ComplexType\Payor();
          $shippingChargesPayor->setResponsibleParty($shipper);
          $shippingChargesPayment = new ComplexType\Payment();
          $shippingChargesPayment
              ->setPaymentType(SimpleType\PaymentType::_SENDER)
              ->setPayor($shippingChargesPayor);
          $requestedShipment = new ComplexType\RequestedShipment();
          $requestedShipment->setShipTimestamp(date('c'));
          $requestedShipment->setDropoffType(new SimpleType\DropoffType(SimpleType\DropoffType::_REGULAR_PICKUP));
          $requestedShipment->setServiceType(new SimpleType\ServiceType(SimpleType\ServiceType::_FEDEX_GROUND));
          $requestedShipment->setPackagingType(new SimpleType\PackagingType(SimpleType\PackagingType::_YOUR_PACKAGING));
          $requestedShipment->setShipper($shipper);
          $requestedShipment->setRecipient($recipient);
          $requestedShipment->setLabelSpecification($labelSpecification);
          $requestedShipment->setRateRequestTypes(array(new SimpleType\RateRequestType(SimpleType\RateRequestType::_ACCOUNT)));
          $requestedShipment->setPackageCount(1);
          $requestedShipment->setRequestedPackageLineItems([
              $packageLineItem1
          ]);
          $requestedShipment->setShippingChargesPayment($shippingChargesPayment);
          $processShipmentRequest = new ComplexType\ProcessShipmentRequest();
          $processShipmentRequest->setWebAuthenticationDetail($webAuthenticationDetail);
          $processShipmentRequest->setClientDetail($clientDetail);
          $processShipmentRequest->setVersion($version);
          $processShipmentRequest->setRequestedShipment($requestedShipment);
          $shipService = new ShipService\Request();
          $shipService->getSoapClient()->__setLocation(env('FEDEX_SHIP_URL','https://wsbeta.fedex.com:443/web-services/ship'));
          $response = $shipService->getProcessShipmentReply($processShipmentRequest);
          //dd($response);
          if($response->HighestSeverity=="SUCCESS"){
              $track_id=$response->CompletedShipmentDetail->CompletedPackageDetails->TrackingIds->TrackingNumber;
              $amount=$response->CompletedShipmentDetail->ShipmentRating->ShipmentRateDetails->TotalNetChargeWithDutiesAndTaxes->Amount;
              $fileName = 'fedexlabel/'.$track_id.".pdf";
              $fp = fopen($fileName, 'wb');   
              fwrite($fp, $response->CompletedShipmentDetail->CompletedPackageDetails->Label->Parts->Image);
              Order::orderShippingmentProcess($req,$track_id,$amount);
              if($req['status']=="authorized"){
                $this->submitForSettlement($req);
              }
              //$this->shippingMail($req,$track_id,"FedEx");
             Session::flash('success', 'Order Shipping process started'); 
             return true;
          }else{
            if(count($response->Notifications)>1){
              $msg="";
              foreach($response->Notifications as $noti){
                $msg.= $noti->Message." ";
              }
              Session::flash('error', $msg); 
              return true;
            }
            else{
               Session::flash('error', $response->Notifications->Message); 
                return true;
            }
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
    public function downlaodTrankDetails($track_id,$type="usps"){
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
        $title="Order Shippings";
        return view('admin.orders.order_shippings',compact('order_id',$order_id))->with('title',$title);
    }
    public function orderShippingData(Request $request,$order_id)
    {
        $req=$request->all();   
        $shippings = DB::select('SELECT id,Ucase(carrier_type) as type,carrier_code,Date_format(created_at,"%m/%d/%Y %h:%i %p") as date,if(is_notify="1","Yes","No") as is_notified,concat("$",FORMAT(amount,2)) as price,track_no FROM cc_order_ship_track where order_id='.$order_id.' ORDER BY `order_id` DESC');
        return response()->success(compact('shippings'));
  
    }
     public function orderTransactionsList($order_id){
        $title="Order Transactions";
        return view('admin.orders.order_transactions',compact('order_id',$order_id))->with('title',$title);
    }
    public function orderTransactionsData(Request $request,$order_id)
    {
        $req=$request->all();   
        $transactions = DB::select('SELECT id,CONCAT(UCASE(LEFT(type, 1)), SUBSTRING(type, 2)) as transaction_type,CONCAT(UCASE(LEFT(status, 1)), SUBSTRING(status, 2)) as transaction_status,DATE_FORMAT(created_at,"%m/%d/%Y %h:%i %p") as date,concat("$",FORMAT(amount,2)) as price  FROM `cc_transactions` WHERE `order_id`='.$order_id.' GROUP BY order_id ORDER BY `id` DESC');
        return response()->success(compact('transactions'));
  
    }
    public function orderDesputes($order_id){
      $this->data = array();
      $get_details = DB::table('order')->where('order_id',$order_id)->first();
      $this->data['conversations'] = DB::table('conversations')->where('user_one',$get_details->buyer_id)->where('user_two',$get_details->seller_id)->first();
      if(isset($this->data['conversations'])){
      $this->data['messages']      = DB::table('messages')->where('conversation_id',$this->data['conversations']->id)->orderBy('messages.created_at','ASC')
    ->leftJoin('users','messages.user_id','users.id')->get();
      }
    $this->data['order_id'] = $order_id;
      //echo "<pre>";print_r($this->data['messages']);die;
        return view('admin.orders.order_deputes',compact('order_id',$order_id))->with('total_data',$this->data);

    }
    private function submitForSettlement($req){
       try {
              $data=$this->stripe->charge_uncapture($req['transation_api_id']);
         }catch(Exception $e){
                $data=array('result'=>0,'message'=>$e->getMessage());
                return $data;
         }
  
    
       // $transaction=array('order_id'=>$req['order_id'],
       //              'user_id'=>Auth::user()->id,
       //              'amount'=>$data['amount']/100,
       //              'api_transaction_no'=>$data['id'],
       //              'status'=>'Charged',
       //              'created_at'=>date('Y-m-d h:i:s'),
       //              'updated_at'=>date('Y-m-d h:i:s')
       //                );
       // $transaction_id=Site_model::insert_get_id('transactions',$transaction);
       $data=array('status'=>"Charged",
                   'updated_at'=>date('Y-m-d h:i:s')
                      );
       $cond=array('id'=>$req['transation_id']);
       Site_model::update_data('transactions',$data,$cond);
       return true;
      
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
}


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
                $m->subject('#{{$order["basic"][0]->order_id}} status report');
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
       //  dd(Config::get('constants.USPS'));
        //      // $label = new InternationalLabel('402SAMPL6330');
         $from = array(
               'from_name' => 'John Smith',
               'from_firm' => 'ABC Inc.',
               'from_address1' => '123 Main St.',
               'from_address2' => 'Suite 100',
               'from_city' => 'Anytown',
               'from_state' => 'PA',
               'from_zip5' => '12345');
    
     $to = array(
               'to_name' => 'Mike Smith',
               'to_firm' => 'XYZ Inc.',
               'to_address1' => '456 2nd St.',
               'to_address2' => 'Apt B',
               'to_city' => 'Othertown',
               'to_state' => 'NY',
               'to_zip5' => '67890');
    
    $dimensions = array(
               'width' => 5.5,
               'length' => 11,
               'height' => 11,
               'girth' => 11);
  $container = "VARIABLE";
  $size = "REGULAR";
  $insured_amount = 0;
  $weight_in_ounces = 0;
  $service_type = 'Priority';
  $xml = '<?xml version="1.0" encoding="UTF-8" ?><DelivConfirmCertifyV4.0Request USERID="402SAMPL6330"&&Password="296AQ64IT776">';
  $xml .= '<Revision>2</Revision>';
  $xml .= '<ImageParameters />'; //Not yet implemented by this function
        
        /**
         * The FROM (origination) information
         */
        $xml .= '<FromName>'.$from['from_name'].'</FromName>';
        $xml .= '<FromFirm>'.isset($from['from_firm'])? $from['from_firm'] : ''.'</FromFirm>'; //can be blank
        //Address 1 and Address 2 are reverse from what is typically standard
        $xml .= '<FromAddress1>'.isset($from['from_address2']) ? $from['from_address2'] : ''.'</FromAddress1>';
  $xml .= '<FromAddress2>'.$from['from_address1'].'</FromAddress2>';
        $xml .= '<FromCity>'.$from['from_city'].'</FromCity>';
        $xml .= '<FromState>'.strtoupper($from['from_state']).'</FromState>';
        $xml .= '<FromZip5>'.$from['from_zip5'].'</FromZip5>';
        $xml .= '<FromZip4/>'; //Not yet implemented
        
        /**
         * The TO (destination) information
         */
        $xml .= '<ToName>'.$to['to_name'].'</ToName>';
        $xml .= '<ToFirm>'.isset($to['to_firm'])? $to['to_firm'] : ''.'</ToFirm>'; //can be blank
        //Address 1 and Address 2 are reverse from what is typically standard
        $xml .= '<ToAddress1>'.isset($to['to_address2']) ? $to['to_address2'] : ''.'</ToAddress1>';
  $xml .= '<ToAddress2>'.$to['to_address1'].'</ToAddress2>';
        $xml .= '<ToCity>'.$to['to_city'].'</ToCity>';
        $xml .= '<ToState>'.strtoupper($to['to_state']).'</ToState>';
        $xml .= '<ToZip5>'.$to['to_zip5'].'</ToZip5>';
        $xml .= '<ToZip4/>'; //Not yet implemented
        
        /**
         * Container Type, Weight and Size plus requested Service
         */
        $xml .= '<WeightInOunces>'.$weight_in_ounces.'</WeightInOunces>';
        $xml .= '<ServiceType>'.$service_type.'</ServiceType>';
        if ($insured_amount > 0) $xml .= '<InsuredAmount>'.$insured_amount.'</InsuredAmount>';
        $xml .= '<ImageType>GIF</ImageType>'; //Eventually could make this an option in the parameters - either PDF, TIF or GIF is accepted by API
        $xml .= '<Container>'.strtoupper($container).'</Container>';
        $xml .= '<Size>'.strtoupper($size).'</Size>';
        $this->_request('DelivConfirmCertifyV4',$xml);
            }
private function _request($function,$xml)
  {
    
  // $protocol = (($this->secure AND !$this->test) ? 'https' : 'http');
  // $host = (($this->secure AND !$this->test) ? $this->secure_host : $this->host);
  // $api = ($this->test ? $this->test_api : $this->prod_api);
       /*$ch = curl_init($this->host.'/?API='. $function .'&XML='.urlencode('https://secure.shippingapis.com/ShippingAPI.dll/?API=DelivConfirmCertifyV4&XML=https://secure.shippingapis.com/ShippingAPI.dll?API=DelivConfirmCertifyV4&XML=<?xml version="1.0" encoding="UTF-8" ?><DelivConfirmCertifyV4.0Request USERID="402SAMPL6330"><Revision>2</Revision><ImageParameters /><FromName>John</FromName><FromFirm> </FromFirm><FromAddress1>Flat 1</FromAddress1><FromAddress2>Road 1</FromAddress2><FromCity>NY</FromCity><FromState>NY</FromState><FromZip5>12345 </FromZip5><FromZip4/><ToName> Mozilla Foundation </ToName><ToFirm> </ToFirm><ToAddress1> Building K </ToAddress1><ToAddress2> 1981 Landings Drive </ToAddress2><ToCity> Mountain View</ToCity><ToState> CA </ToState><ToZip5>   94043 </ToZip5><ToZip4 /><WeightInOunces> 3 </WeightInOunces><ServiceType>Priority</ServiceType><ImageType>TIF</ImageType></DelivConfirmCertifyV4.0Request>'));*/
$ch = curl_init('https://secure.shippingapis.com/ShippingAPI.dll?API=DelivConfirmCertifyV4&XML=%3C?xml%20version=%221.0%22%20encoding=%22UTF-8%22%20?%3E%3CDelivConfirmCertifyV4.0Request%20USERID=%22228OURBA2607%22%20PASSWORD=%22728ZK94KL112%22%3E%3CRevision%3E2%3C/Revision%3E%3CImageParameters%20/%3E%3CFromName%3EJohn%3C/FromName%3E%3CFromFirm%3E%20%3C/FromFirm%3E%3CFromAddress1%3EFlat%201%3C/FromAddress1%3E%3CFromAddress2%3ERoad%201%3C/FromAddress2%3E%3CFromCity%3ENY%3C/FromCity%3E%3CFromState%3ENY%3C/FromState%3E%3CFromZip5%3E12345%20%3C/FromZip5%3E%3CFromZip4/%3E%3CToName%3E%20Mozilla%20Foundation%20%3C/ToName%3E%3CToFirm%3E%20%3C/ToFirm%3E%3CToAddress1%3E%20Building%20K%20%3C/ToAddress1%3E%3CToAddress2%3E%201981%20Landings%20Drive%20%3C/ToAddress2%3E%3CToCity%3E%20Mountain%20View%3C/ToCity%3E%3CToState%3E%20CA%20%3C/ToState%3E%3CToZip5%3E%20%20%2094043%20%3C/ToZip5%3E%3CToZip4%20/%3E%3CWeightInOunces%3E%203%20%3C/WeightInOunces%3E%3CServiceType%3EPriority%3C/ServiceType%3E%3CImageType%3ETIF%3C/ImageType%3E%3C/DelivConfirmCertifyV4.0Request%3E');

       curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      $output = curl_exec($ch);
      curl_close($ch);
      $collection = new \Illuminate\Support\Collection(json_decode(json_encode(simplexml_load_string($this->removeNamespaceFromXML($output))), true));
    
      //dd($collection->toArray());
      $contents = base64_decode($collection->toArray()['DeliveryConfirmationLabel']);
      header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="label.pdf"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($contents));
        exit;
  
  //$this->XML2JSON($output);
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


}
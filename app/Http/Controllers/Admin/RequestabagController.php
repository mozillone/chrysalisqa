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
use App\Helpers\SiteHelper;
use App\Helpers\PaypalPayout;
use App\Helpers\Paypal;
use Hash;
use Response;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use App\Costumes;
use Nahid\Talk\Conversations\ConversationRepository;
use App\Helpers\Site_model;
use App\User;
use Config;
use App\Helpers\FedEx\ShipService,
    App\Helpers\FedEx\ShipService\ComplexType,
    App\Helpers\FedEx\ShipService\SimpleType;  
use Log;

class RequestabagController extends Controller
{
	protected $messageBag = null;
    

    public function __construct()
    {
      $this->sitehelper = new SiteHelper();
      $this->middleware(function ($request, $next) {
          if(!Auth::check()){
            return Redirect::to('/admin/login')->send();
          }
          else{
               return $next($request);
          }
      });
    }

    /*
	Method Name : manageBag()
	Purpose :
	*/
	public function manageBag(){
	   return view('admin.request-a-bag.managebag');
	}

	/*
	Method Name : processBag()()
	Purpose :
	*/
	public function processBag($id){

		$this->data = array();
		$this->data['request_a_bag'] = DB::table('request_bags')
										->where('request_bags.id',$id)		
										->leftJoin('address_master','request_bags.addres_id','address_master.address_id')
										->leftJoin('states','address_master.state','states.abbrev')
										->select('request_bags.*','address_master.*','states.name','states.abbrev')		 
										->first();
		//echo "<pre>";print_r($this->data['request_a_bag']);exit;										
		$generated_lables = DB::table('request_shippings')
							->where('request_id',$id)->get();
		$count_generated_lable =  count($generated_lables);
		$this->data['generated_lables_html'] = '0';
		if ($count_generated_lable != 0) {
		
			$html = '<div>';
			foreach ($generated_lables as $label_html) {
				if ($label_html->type == 'pick') {
					$html .= '<p>Empty Bag Tracking Number: <a href="/request-bag/label/'.$label_html->shipping_no.'">UX'.$label_html->shipping_no.'</a> <i> via FedEx generated '.$label_html->created_at.' </i> </p> ';
				}else if($label_html->type == 'drop'){
					$html .= '<p>Customer Tracking Number: <a href="/request-bag/label/'.$label_html->shipping_no.'">UX'.$label_html->shipping_no.'</a> <i> via FedEx SmartPost generated '.$label_html->created_at.'</i> </p>';
				}				
			}
			$html .= '</div>';
		$this->data['generated_lables_html'] = $html;
		}
		$store_payout_details = DB::table('request_credits')->where('request_id',$id)->first();
		$store_count_payout = count($store_payout_details);
		$paypal_payout_details = DB::table('paypal_payouts')->where('type_id',$id)->first();
		$paypal_count_payout = count($paypal_payout_details);
		$this->data['payout_html'] = "0";
		if ($store_count_payout != 0 || $paypal_count_payout != 0) {
			$html = "";
			if ($store_count_payout != 0) {
				$credit = $store_payout_details->credit;
				$html = '<p> Payout Amount Credited $ '.$credit.' </p>';
			}else if($paypal_count_payout != 0){
				$credit = $paypal_payout_details->amount;
				$html = '<p> Payout Amount Credited $ '.$credit.' </p>';				
			}
			$this->data['payout_html'] = $html;
		}
		$return_details = DB::table('request_credits')->where('request_id',$id)->where('type','return')->first();
		$count_return = count($return_details);
		$this->data['return_html'] = "0";
		if ($count_return != 0 ) {
			$html = '<p> Return initiated $ '.$return_details->credit.' </p>';
			$this->data['return_html'] = $html;
		}

		$this->data['messagingtheard'] = DB::table('messages')
					->where('conversation_id',$this->data['request_a_bag']->conversation_id)
					->orderBy('messages.created_at','ASC')
					->leftJoin('users','messages.user_id','users.id')
					->select('users.user_img as user_img','users.display_name as display_name','messages.message as message','messages.created_at')
					->orderBy('messages.created_at','ASC')->get();
		
        return view('admin.request-a-bag.processabag')->with('total_data',$this->data)->with('is_label_generated', $count_generated_lable);
	}
	public function Getallmanagebags(){
		$request_bags=DB::Select('SELECT `id`, `user_id`, `conversation_id`, `ref_no`, `addres_id`, `is_payout`, `is_return`, `is_recycle`, `status`, `cus_name`, `cus_email`, `cus_phone`, DATE_FORMAT(`created_at`,"%m/%d/%Y %h:%i %p") as date FROM `cc_request_bags`');
		
		return Datatables::of(collect($request_bags))
        ->addColumn('actions', function ($request_bagso) {
                return '<a href="/process-bag/'.$request_bagso->id.'" class="btn btn-xs  btn-warning" data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
            })
        ->make(true);
	}   
	public function Payoutamount(Request $request){
		try{
            DB::beginTransaction();
			$this->data = array();
			$get_user_id = DB::table('request_bags')->where('id',$request->type_id)->first();
			$html = "";
			if($request->payout_type == "credit"){
                $is_payout_type = "store_credit";
                $payout_amount_array = array('user_id'=>$get_user_id->user_id,
                        'request_id'=>$get_user_id->id,
                        'type'=>'payout',
                        'credit'=>$request->payout_amount,
                        'created_at'=>date('y-m-d H:i:s'),);
                $credit_array = array('user_id'=>$get_user_id->user_id,
                        'credit'=>$request->payout_amount,
                        'request_id'=>$get_user_id->id,
                        'notes'=>'Store credit',
                        'created_at'=>date('y-m-d H:i:s'));
                $credit_log = User::CreditLog($credit_array);
                $payout_amount_insert = DB::table('request_credits')->insertGetId($payout_amount_array);
                $userObj = User::where('id', $get_user_id->user_id)->first();

                $userObj->credits = $userObj->credits+$request->payout_amount;
                $userObj->save();
                // send mail
                $reg_subject        = "Store credit amount";
                $reg_data           = array('name'=>$get_user_id->cus_name,'amount'=>$request->payout_amount);
                $template           = 'emails.reqabag_storecredit';
        		$reg_to             = $get_user_id->cus_email;
                $mail_status        = $this->sitehelper->sendmail($reg_to,$reg_subject,$template,$reg_data);
                        // end mail
                $html = '<p> Payout Amount Credited $ '.$request->payout_amount.' </p>';
				$this->data['status'] = "Payout Amount Credited.";    
			}else{
				$is_payout_type = "paypal_payout";
                $userObj = User::where('id', $get_user_id->user_id)->first();
                //Log::info($userObj->paypal_email);
                if(!empty($userObj->paypal_email)){
                    $single_payout  = PaypalPayout::SinglePayout($userObj->paypal_email,$request->payout_amount);
                    Log::info($single_payout);
                    if($single_payout['status'] == 1){
                    	Log::info('if');
                		$output = $single_payout['output'];
						$payout_batch_id = $output->batch_header->payout_batch_id;
	                    $batch_status    = $output->batch_header->batch_status;
	                    $sender_batch_id    = $output->batch_header->sender_batch_header->sender_batch_id;
	                    $log_array = array('type'=>'request_a_bag',
	                                'type_id'=>$get_user_id->id,
	                                'user_id'=>$get_user_id->user_id,
	                                'note'=>'SinglePayout Request a bag',
	                                'payout_batch_id'=>$payout_batch_id,
	                                'batch_status'=>$batch_status,
	                                'sender_batch_id'=>$sender_batch_id,
	                                'created_at'=>date('y-m-d H:i:s'));
	                    $insertin_log   = Site_model::insert_get_id('payout_log',$log_array);
	                    $credit_array = array('user_id'=>$get_user_id->user_id,
	                                'amount'=>$request->payout_amount,
	                                'type_id'=>$get_user_id->id,
	                                'type'=>'requestabag',
	                                'note'=>'Paypal Payout credit',
	                                'status'=>'pending',
	                                'created_at'=>date('y-m-d H:i:s'),);
	                    $payout_amount_insert = DB::table('paypal_payouts')->insertGetId($credit_array);
	                    // send mail
	                    $reg_subject        = "Paypal payout amount";
	                    $reg_data           = array('name'=>$get_user_id->cus_name,'amount'=>$request->payout_amount);
	                    $template           = 'emails.reqabag_paypalpayoutcredit';
	                    $reg_to             = $get_user_id->cus_email;
	                    $mail_status        = $this->sitehelper->sendmail($reg_to,$reg_subject,$template,$reg_data);
	                    // end mail

	                    $html = '<p> Payout Amount Credited $ '.$request->payout_amount.' </p>';
	                                $this->data['status'] = "Payout Amount Credited.";
	                }else{
	                	Log::info('else');
	                	$error = $single_payout['output'];
                		//\Session::flash('error', $error);
                		return response()->json(['error' => $error],400);
	                }
                }else{
                    return response()->json(['error' => 'please update paypal email in your dashboard.'], 404);
                }
			}
			$status_update = DB::table('request_bags')->where('id',$request->type_id)->update(['status'=>'paid','is_payout_type'=>$is_payout_type]);
			//send mail
	        $reg_subject = "REQUEST A BAG Status";
	        $reg_data = array('name'=>$get_user_id->cus_name,'refno'=>$get_user_id->ref_no, 'status'=>'paid');
	        $template_admin = 'emails.reqabag_status_change_admin';
	        $admin_mail_status = $this->sitehelper->sendmail("gbhyri@dotcomweavers.com",$reg_subject,$template_admin,$reg_data);
			$this->data['html'] = $html;
			DB::commit();
			return $this->data;
        }catch(\Exception $e){
            DB::rollBack();
            //$e->getMessage();
            return response()->json(['error' => 'Something went wrong.'], 404);
        }
    }
	
        
    public function Returnamount(Request $request){
        try{
	       DB::beginTransaction();
			$this->data = array();
			$get_user_id = DB::table('request_bags')->where('id',$request->type_id)->first();
                        
			//echo "<pre>"; print_r($get_user_id);die;
			//$get_credit_amount = DB::table('request_credits')->where('request_id',$get_user_id->id)->where('user_id',$get_user_id->user_id)->where('type','payout')->first();
			$userObj = User::where('id', $get_user_id->user_id)->first();
            
			if ($userObj->credits == 0) {
                                return response()->json(['error' => 'No Credit Amount'], 404);
			}
			if ($request->checkbox_value == 0) {
				if($userObj->credits >= 9.99){
                      
                $request_bag= Site_model::find_user_and_meta('user_meta',Auth::user()->id);
		if(isset($request_bag['service'])){ $service=$request_bag['service'];}else{$service="";}
		if($request->return_amount >= 10){ $weight=$request->return_amount; }else{$weight="0";}
                $this->data = array();
		$random_drop = str_random(13);
		$random_pick = str_random(13);
		$address=Site_model::Fetch_data('address_master','*',array('address_id'=>$get_user_id->addres_id));
		$sellerAddress = DB::table('address_master')->where('user_id',Auth::user()->id)->where('address_type','selling')->get();
		//dd($sellerAddress);
		$response=$this->fedex($request->all(),$address[0],$service,$sellerAddress[0]);
		if($response['result']=="0"){
                        return response()->json(['error' => $response['msg']], 404);
		}
		$track_id=$response['msg'];
		$shipping_array_pick = array('request_id'=>$request->type_id,
			'type'=>'return',
			'weight'=>$weight,
			'shipping_no'=>$track_id,
			'created_at'=>date('y-m-d H:i:s'),
			);
		$shpippin_return_insert = DB::table('request_shippings')->insertGetId($shipping_array_pick);
                        
                        $userObj->credits = $userObj->credits-9.99;
                        $userObj->save();
				}else{
                                    return response()->json(['error' => 'No Credit Amount.'], 404);
				}
			}
			
			$return_amount_array = array('user_id'=>$get_user_id->user_id,
				'request_id'=>$get_user_id->id,
				'type'=>'return',
				'credit'=>9.99,
				'created_at'=>date('y-m-d H:i:s'),);
			$return_amount_insert = DB::table('request_credits')->insertGetId($return_amount_array);
			/*$update_amount = DB::table('request_credits')->where('request_id',$request->request_id)->where('user_id',$get_user_id->user_id)->where('type','return')->update(['credit'=>$total]);*/
			$status_update = DB::table('request_bags')->where('user_id',$get_user_id->user_id)->where('id',$request->request_id)->update(['status'=>'return']);
			$html = '<p> Return initiated </p>';
			$this->data['html'] = $html;
			$this->data['status'] = "Return initiated.";
		// send mail
			$reg_subject        = "Return initiated";
			$reg_data           = array('name'=>$get_user_id->cus_name);
			$template           = 'emails.reqabag_returnamount';
                        $reg_to             = $get_user_id->cus_email;
			$mail_status        = $this->sitehelper->sendmail($reg_to,$reg_subject,$template,$reg_data);
			// end mail

			$reg_subject1 = "REQUEST A BAG Status";
        	$reg_data1 = array('name'=>$get_user_id->cus_name,'refno'=>$get_user_id->ref_no, 'status'=>'return');
        	$template_admin = 'emails.reqabag_status_change_admin';
        	$admin_mail_status = $this->sitehelper->sendmail("ndepa@dotcomweavers.com",$reg_subject1,$template_admin,$reg_data1);

			DB::commit();	
			return $this->data;
		}catch(\Exception $e){
            DB::rollBack();
            //$e->getMessage();
            return response()->json(['error' => $e->getMessage()], 404);
        }

	}

	public function Closerequest(Request $request){
		//echo "<pre>";print_r($request->all());die;
		$this->data = array();
		$get_user_id = DB::table('request_bags')->where('id',$request->type_id)->first();
		$status_update = DB::table('request_bags')->where('user_id',$get_user_id->user_id)->where('id',$get_user_id->id)->update(['status'=>'closed']);
		$this->data['status'] = "Request Closed";
		// send mail
			$reg_subject        = "Request Closed";
			$reg_data           = array('name'=>$get_user_id->cus_name,'amount'=>$request->return_amount);
			$template           = 'emails.reqabag_statusclosed';
	        $reg_to             = $get_user_id->cus_email;
			$mail_status        = $this->sitehelper->sendmail($reg_to,$reg_subject,$template,$reg_data);
			// end mail
		return $this->data;
	}

	public function RequestabagMessage(Request $request){
		//echo "fdge";die;
		$conversation_id = $request->conversation_id;
		$userid = $request->user_id;
		$hidden_id = $request->hidden_id;
		$conversations_data = DB::table('conversations')->where('id',$conversation_id)->first();
		$count_con = count($conversations_data);
		//echo "<pre>";print_r($count_con);die;
		if($count_con>0){
			$message_array  = array('message'=>$request->message_theard,
	        'is_seen'=>'0',
	        'deleted_from_sender'=>'0',
	        'deleted_from_receiver'=>'0',
	        'user_id'=>'1',
	        'user_name'=>Auth::user()->display_name,
	        'conversation_id'=>$request->conversation_id,
	        'created_at'=>date('y-m-d H:i:s'));
        
      		$converstion_id = Site_model::insert_get_id('messages',$message_array);
  		}else{
  			//echo "string";die;
  			$conversation_array = array('type'=>'request_a_bag',
  					'user_two'=>$userid,
  					'type_id'=>$hidden_id,
					'subject'=>'Request a bag subject from admin',
					'user_one'=>'1',
					'status'=>'1',
					'created_at'=>date('y-m-d H:i:s'));
				$conversation_insert=DB::table('conversations')->insertGetId($conversation_array);
      		$update_conversation_id = DB::table('request_bags')->where('ref_no',$hidden_id)->update(['conversation_id'=>$conversation_insert]);
  			$message_array  = array('message'=>$request->message_theard,
	        	'is_seen'=>'0',
	        	'deleted_from_sender'=>'0',
	        	'deleted_from_receiver'=>'0',
	        	'user_id'=>'1',
	        	'user_name'=>Auth::user()->display_name,
	        	'conversation_id'=>$conversation_insert,'created_at'=>date('y-m-d H:i:s'));
        
      		$converstion_id = Site_model::insert_get_id('messages',$message_array);

  		}
      return "success";
	}

	public function Generatelables(Request $request){
		//print_r(Config::get('constants.FedEx_Ship_Url')); exit;
		//print_r($request->hidden_id); exit;
        try{
	        $islabelGenerated = DB::table('request_shippings')->where('request_id', $request->hidden_id)->first(); 

		        if(! $islabelGenerated)
		        {
			        DB::beginTransaction();
					$req=$request->all();
					//print_r($req['hidden_id']); exit;
					$address=Site_model::Fetch_data('address_master','*',array('address_id'=>$req['address_id']));
					$request_bag= Site_model::find_user_and_meta('user_meta',Auth::user()->id);
					if(isset($request_bag['service'])){ 
						$service=$request_bag['service'];
					}else{
						$service="";
					}
					if(isset($request_bag['weight'])){ 
						$weight=$request_bag['weight'];
					}else{
						$weight="0";
					}
			     	$this->data = array();
					$random_drop = str_random(13);
					$random_pick = str_random(13);
					$address=Site_model::Fetch_data('address_master','*',array('address_id'=>$req['address_id']));
					$sellerAddress = DB::table('address_master')->where('user_id',Auth::user()->id)->where('address_type','selling')->get();
					//dd($sellerAddress);
					$response=$this->fedex($req,$address[0],$service,$sellerAddress[0]);
					//dd($response);
					if($response['result']=="0"){
						Session::flash('error',$response['msg']);
			            return Redirect::back();
					}
					$track_id=$response['msg'];
					$shipping_array_pick = array('request_id'=>$req['hidden_id'],
												'type'=>'pick',
												'weight'=>'',
												'shipping_no'=>$track_id,
												'created_at'=>date('y-m-d H:i:s'),
												);
					Log::info($shipping_array_pick);
					$shpippin_pick_insert = DB::table('request_shippings')->insertGetId($shipping_array_pick);
					Log::info($shpippin_pick_insert);
					$response=$this->smartPost($req,$address[0],'SMART_POST',$weight,$sellerAddress[0]);
					Log::info('Samrt post');
					Log::info($response);
					//dd($response);
					$track_id=$response['msg'];
					if($response['result']=="0"){
						 Session::flash('error',$response['msg']);
			      		 return Redirect::back();
					}
					$shipping_array_drop = array('request_id'=>$req['hidden_id'],
						'type'=>'drop',
						'weight'=>'',
						'shipping_no'=>$track_id,
						'created_at'=>date('y-m-d H:i:s'),
						);
					Log::info($shipping_array_drop);
					$shpippin_drop_insert = DB::table('request_shippings')->insertGetId($shipping_array_drop);
			                Log::info($shpippin_drop_insert);
					$status_update = DB::table('request_bags')->where('id',$request->hidden_id)->update(['status'=>'shipped']);
		                
		            $oRequestBag = DB::table('request_bags')->where('id',$request->hidden_id)->first();
		            
		            //send mail
		            $reg_subject = "REQUEST A BAG Status";
		            $reg_data = array('name'=>$oRequestBag->cus_name,'refno'=>$oRequestBag->ref_no, 'status'=>'shipped');
		            $template = 'emails.reqabag_statusshipped';
		        	$reg_to = $oRequestBag->cus_email;
		            $mail_status = $this->sitehelper->sendmail($reg_to,$reg_subject,$template,$reg_data);
		            $template_admin = 'emails.reqabag_status_change_admin';
		            $admin_mail_status = $this->sitehelper->sendmail("ndepa@dotcomweavers.com",$reg_subject,$template_admin,$reg_data);
		            // end mail
		            
		            DB::commit();
					Session::flash('success','Label generated successfully');
		            return Redirect::back();
		    }
		    else{
    			Session::flash('error','Label already generated.');
            	return Redirect::back();
    		}   
        }catch(\Exception $e){
            DB::rollBack();
            Session::flash('error',$e->getMessage());
            return Redirect::back();
        }
	}

	 private function fedex($req,$address,$service,$sellerAddress){
 
          $userCredential = new ComplexType\WebAuthenticationCredential();
          $userCredential
              ->setKey(Config::get('constants.FedEx_Key'))
              ->setPassword(Config::get('constants.FedEx_Password'));
          $webAuthenticationDetail = new ComplexType\WebAuthenticationDetail();
          $webAuthenticationDetail->setUserCredential($userCredential);
          $clientDetail = new ComplexType\ClientDetail();
          $clientDetail
              ->setAccountNumber(Config::get('constants.FedEx_AccountNumber'))
              ->setMeterNumber(Config::get('constants.FedEx_MeterNumber'));
          $version = new ComplexType\VersionId();
          $version
              ->setMajor(12)
              ->setIntermediate(1)
              ->setMinor(0)
              ->setServiceId('ship');
          $shipperAddress = new ComplexType\Address();
          $shipperAddress
              ->setStreetLines([$sellerAddress->address2])
              ->setCity($sellerAddress->city)
              ->setStateOrProvinceCode($sellerAddress->state)
              ->setPostalCode($sellerAddress->zip_code)
              ->setCountryCode('US');
          $shipperContact = new ComplexType\Contact();
          $shipperContact
              ->setCompanyName('Chrysalis')
              ->setEMailAddress('support@chrysalis.com')
              ->setPersonName('SUPPORT')
              ->setPhoneNumber(('732-618-8533'));
          $shipper = new ComplexType\Party();
          $shipper
              ->setAccountNumber(Config::get('constants.FedEx_AccountNumber'))
              ->setAddress($shipperAddress)
              ->setContact($shipperContact);
          $recipientAddress = new ComplexType\Address();
          //dd($address[0]);
          $recipientAddress
              ->setStreetLines([$address->address1])
              ->setCity($address->city)
              ->setStateOrProvinceCode($address->state)
              ->setPostalCode($address->zip_code)
              ->setCountryCode('US');
          $recipientContact = new ComplexType\Contact();
          $recipientContact
              ->setPersonName($address->fname.$address->lname)
              ->setPhoneNumber($address->phone);
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
                  'Value' => '10',
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
          $requestedShipment->setServiceType(new SimpleType\ServiceType($service));
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
          //dd($processShipmentRequest);
          $shipService = new ShipService\Request();
          
          $shipService->getSoapClient()->__setLocation(Config::get('constants.FedEx_Ship_Url'));
          //$shipService->getSoapClient()->__setLocation('https://ws.fedex.com:443/web-services/ship');
          //dd($shipService);
          $response = $shipService->getProcessShipmentReply($processShipmentRequest);
          //dd($response);
          if($response->HighestSeverity=="SUCCESS"){
              $track_id=$response->CompletedShipmentDetail->CompletedPackageDetails->TrackingIds->TrackingNumber;
              $amount=$response->CompletedShipmentDetail->ShipmentRating->ShipmentRateDetails->TotalNetChargeWithDutiesAndTaxes->Amount;
              $fileName = 'fedexlabel/'.$track_id.".pdf";
              $fp = fopen($fileName, 'wb');   
              fwrite($fp, $response->CompletedShipmentDetail->CompletedPackageDetails->Label->Parts->Image);
              $res=array('result'=>'1', 'msg'=> $track_id); 
              //print_r($res);exit;
              return  $res;
          }else{
          	//echo "string"; exit;
          	$msg = "";
          	//dd($response);
          	if(is_array($response->Notifications)){
          		$msg = $response->Notifications[0]->Message;
          	}else{
          		$msg = $response->Notifications->Message;
          	}
            $res=array('result'=>'0', 'msg'=>$msg); 
            return $res;
          }
        
      }
       	private function smartPost($req,$address,$service,$weight,$sellerAddress){
        
          	$key = Config::get('constants.FedEx_Key');
            $password = Config::get('constants.FedEx_Password');
            $account_number = Config::get('constants.FedEx_SmartPostAccountNumber');
            $meter_number = Config::get('constants.FedEx_SmartPostMeterNumber');

            $xml = '<?xml version="1.0" encoding="UTF-8"?>
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:v17="http://fedex.com/ws/ship/v17">
			   <soapenv:Header/>
			   <soapenv:Body>
			      <v17:ProcessShipmentRequest>
			         <v17:WebAuthenticationDetail>
			           
			            <v17:UserCredential>
			               <v17:Key>'.$key.'</v17:Key>
			               <v17:Password>'.$password.'</v17:Password>
			            </v17:UserCredential>
			         </v17:WebAuthenticationDetail>
			         <v17:ClientDetail>
			            <v17:AccountNumber>'.$account_number.'</v17:AccountNumber>
			            <v17:MeterNumber>'.$meter_number.'</v17:MeterNumber>
			         </v17:ClientDetail>
			         <v17:TransactionDetail>
			            <v17:CustomerTransactionId>IMPB On Print Returns</v17:CustomerTransactionId>
			         </v17:TransactionDetail>
			         <v17:Version>
			            <v17:ServiceId>ship</v17:ServiceId>
			            <v17:Major>17</v17:Major>
			            <v17:Intermediate>0</v17:Intermediate>
			            <v17:Minor>0</v17:Minor>
			         </v17:Version>
			         <v17:RequestedShipment>
			            <v17:ShipTimestamp>'.date('c').'</v17:ShipTimestamp>
			            <v17:DropoffType>REGULAR_PICKUP</v17:DropoffType>
			            <v17:ServiceType>SMART_POST</v17:ServiceType>
			            <v17:PackagingType>YOUR_PACKAGING</v17:PackagingType>
			            <v17:Shipper>
			               <v17:AccountNumber>'.$account_number.'</v17:AccountNumber>
			               <v17:Contact>
			                  <v17:PersonName>SUPPORT</v17:PersonName>
			                  <v17:CompanyName>Chrysalis</v17:CompanyName>
			                  <v17:PhoneNumber>732-618-8533</v17:PhoneNumber>
			               </v17:Contact>
			               <v17:Address>
			                  <v17:StreetLines>'.$address->address1.'</v17:StreetLines>
			                  <v17:City>'.$address->city.'</v17:City>
			                  <v17:StateOrProvinceCode>'.$address->state.'</v17:StateOrProvinceCode>
			                  <v17:PostalCode>'.$address->zip_code.'</v17:PostalCode>
			                  <v17:CountryCode>US</v17:CountryCode>
			               </v17:Address>
			            </v17:Shipper>
			            <v17:Recipient>
			               <v17:AccountNumber>'.$account_number.'</v17:AccountNumber>
			               <v17:Contact>
			                  <v17:PersonName>'.$address->fname.$address->lname.'</v17:PersonName>
			                  <v17:CompanyName>SMARTPOST / RETURNS</v17:CompanyName>
			                  <v17:PhoneNumber>'.$address->phone.'</v17:PhoneNumber>
			               </v17:Contact>
                                       
                                       <v17:Address>
			                  <v17:StreetLines>'.$sellerAddress->address2.'</v17:StreetLines>
			                  <v17:StreetLines>'.$sellerAddress->address2.'</v17:StreetLines>
			                  <v17:City>'.$sellerAddress->city.'</v17:City>
			                  <v17:StateOrProvinceCode>'.$sellerAddress->state.'</v17:StateOrProvinceCode>
			                  <v17:PostalCode>'.$sellerAddress->zip_code.'</v17:PostalCode>
			                  <v17:CountryCode>US</v17:CountryCode>
			               </v17:Address>
			            </v17:Recipient>
			            <v17:ShippingChargesPayment>
			               <v17:PaymentType>SENDER</v17:PaymentType>
			               <v17:Payor>
			                  <v17:ResponsibleParty>
			                     <v17:AccountNumber>'.$account_number.'</v17:AccountNumber>
			                     <v17:Contact>
			                        <v17:PersonName>SUPPORT</v17:PersonName>
			                        <v17:CompanyName>Chrysalis</v17:CompanyName>
			                        <v17:PhoneNumber>732-618-8533</v17:PhoneNumber>
			                     </v17:Contact>
			                     <v17:Address>
			                        <v17:StreetLines>'.$sellerAddress->address2.'</v17:StreetLines>
			                        <v17:StreetLines>'.$sellerAddress->address2.'</v17:StreetLines>
			                        <v17:City>'.$sellerAddress->city.'</v17:City>
			                        <v17:StateOrProvinceCode>'.$sellerAddress->state.'</v17:StateOrProvinceCode>
			                        <v17:PostalCode>'.$sellerAddress->zip_code.'</v17:PostalCode>
			                        <v17:CountryCode>US</v17:CountryCode>
			                     </v17:Address>
			                  </v17:ResponsibleParty>
			               </v17:Payor>
			            </v17:ShippingChargesPayment>
			            <v17:SpecialServicesRequested>
			               <v17:SpecialServiceTypes>EMAIL_NOTIFICATION</v17:SpecialServiceTypes>
			               <v17:SpecialServiceTypes>RETURN_SHIPMENT</v17:SpecialServiceTypes>
			               <v17:EMailNotificationDetail>
			                  <v17:Recipients>
			                     <v17:EMailNotificationRecipientType>SHIPPER</v17:EMailNotificationRecipientType>
			                     <v17:EMailAddress>support@chrysaliscostumes.com</v17:EMailAddress>
			                     <v17:Format>HTML</v17:Format>
			                     <v17:Localization>
			                        <v17:LanguageCode>es</v17:LanguageCode>
			                        <v17:LocaleCode>ES</v17:LocaleCode>
			                     </v17:Localization>
			                  </v17:Recipients>
			               </v17:EMailNotificationDetail>
			               <v17:ReturnShipmentDetail>
			                  <v17:ReturnType>PRINT_RETURN_LABEL</v17:ReturnType>
			                  <v17:Rma>
			                     <v17:Reason>string</v17:Reason>
			                  </v17:Rma>
			               </v17:ReturnShipmentDetail>
			            </v17:SpecialServicesRequested>
			            <v17:SmartPostDetail>
			               <v17:Indicia>PARCEL_RETURN</v17:Indicia>
			               <v17:HubId>5531</v17:HubId>
			            </v17:SmartPostDetail>
			            <v17:LabelSpecification>
			               <v17:LabelFormatType>COMMON2D</v17:LabelFormatType>
			               <v17:ImageType>PDF</v17:ImageType>
			               <v17:LabelStockType>PAPER_8.5X11_TOP_HALF_LABEL</v17:LabelStockType>
			            </v17:LabelSpecification>
			            <v17:RateRequestTypes>LIST</v17:RateRequestTypes>
			            <v17:PackageCount>1</v17:PackageCount>
			            <v17:RequestedPackageLineItems>
			               <v17:SequenceNumber>1</v17:SequenceNumber>
			               <v17:InsuredValue>
			                  <v17:Currency>USD</v17:Currency>
			                  <v17:Amount>0.00</v17:Amount>
			               </v17:InsuredValue>
			               <v17:Weight>
			                  <v17:Units>LB</v17:Units>
			                  <v17:Value>'.$weight.'</v17:Value>
			               </v17:Weight>
			               <v17:CustomerReferences>
			                  <v17:CustomerReferenceType>CUSTOMER_REFERENCE</v17:CustomerReferenceType>
			                  <v17:Value>string</v17:Value>
			               </v17:CustomerReferences>
			            </v17:RequestedPackageLineItems>
			         </v17:RequestedShipment>
			      </v17:ProcessShipmentRequest>
			   </soapenv:Body>
			</soapenv:Envelope>';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://wsbeta.fedex.com:443/web-services');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            $result_xml = curl_exec($ch);

            // remove colons and dashes to simplify the xml
            $result_xml = str_replace(array(':','-'), '', $result_xml);
            $response = @simplexml_load_string($result_xml);
            $result=json_decode(json_encode($response), TRUE);
             //dd($result);
            if(!isset($result['SOAPENVBody']['SOAPENVFault'])){

            	$track_id=$result['SOAPENVBody']['ProcessShipmentReply']['CompletedShipmentDetail']['CompletedPackageDetails']['TrackingIds']['TrackingNumber'];
              $fileName = 'fedexlabel/'.$track_id.".pdf";
              $fp = fopen($fileName, 'wb');   
               $array_text = array("_");
            $array_replace =  "+";
            $contents = base64_decode(str_replace($array_text, $array_replace,$result['SOAPENVBody']['ProcessShipmentReply']['CompletedShipmentDetail']['CompletedPackageDetails']['Label']['Parts']['Image']	))  ;
            file_put_contents($fileName,$contents);
             
              $res=array('result'=>'1', 'msg'=> $track_id); 
             }else{
             	$res=array('result'=>'0', 'msg'=> $result['SOAPENVBody']['SOAPENVFault']['detail']['desc']); 
             }
           return $res;
        
      }
       public function downlaodRequestBagLabels($track_id){
          $file=public_path("fedexlabel/".$track_id.".pdf");
          return Response::download($file);
    }

}
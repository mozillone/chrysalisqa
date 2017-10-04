<?php namespace App\Http\Controllers;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use App\User;
use Session;
use Hash;
use DB;
use App\Helpers\Site_model;
use App\Address;
use App\Creditcard;
use Response;
<<<<<<< HEAD
use App\Imageresize;

=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
class DashboardController extends Controller {

	protected $messageBag = null;
	protected $auth;
	
	public function __construct(Guard $auth)
	{
		  $this->sitehelper = new SiteHelper();
		$this->middleware(function ($request, $next) {
              if(!Auth::check() && !$request->is('coming-soon') && !$request->is('find-your-space') && !$request->is('list-your-space')){
                return Redirect::to('/login')->send();
            }
            else{
                 return $next($request);
            }
        });

	}
	public function dashboard()
	{
		if(Auth::user()->id!="1"){
    	$this->data = array();
<<<<<<< HEAD
      $this->data['default_billing_address'] = DB::table('address_master')->where('user_id',Auth::user()->id)->where('address_type','billing')->get();
       $this->data['seller_address'] = DB::table('address_master')->where('user_id',Auth::user()->id)->where('address_type','selling')->get();
			//print_r($this->data['default_billing_address']);die;
      $this->data['user_details'] = DB::table('users')->where('id',Auth::user()->id)->first();
			$this->data['default_shipping_address'] = DB::table('address_master')->where('user_id',Auth::user()->id)->where('address_type','shipping')->get();
=======
			$this->data['default_billing_address'] = DB::table('address_master')->where('user_id',Auth::user()->id)->where('address_type','billing')->first();
			$this->data['default_shipping_address'] = DB::table('address_master')->where('user_id',Auth::user()->id)->where('address_type','shipping')->first();
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
			$this->data['states']   = Site_model::Fetch_all_data('states', '*');
    $this->data['countries']   = Site_model::Fetch_all_data('countries', '*');
    $this->data['recent_orders'] = DB::Select('SELECT ord.created_at as date,ord.order_id,concat(seller.first_name," ",seller.last_name) as seller_name,sts.name as status FROM `cc_order` as ord LEFT JOIN cc_users as seller on seller.id=ord.seller_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id   where ord.buyer_id='.Auth::user()->id.' ORDER BY `order_id` DESC LIMIt 0,5');
    $this->data['costumes_sold'] = DB::Select('SELECT ord.created_at as date,ord.order_id,concat(buyer.first_name," ",buyer.last_name) as buyer_name,sts.name as status FROM `cc_order` as ord LEFT JOIN cc_users as buyer on buyer.id=ord.buyer_id LEFT JOIN cc_status as sts on sts.status_id=ord.order_status_id where ord.seller_id='.Auth::user()->id.' ORDER BY ord.order_id DESC LIMIt 0,5');
    $this->data['creditcard_list'] = DB::table('creditcard')->where('user_id',Auth::user()->id)->get();
<<<<<<< HEAD
    $this->data['my_costumes'] = DB::table('costumes')->where('created_by',Auth::user()->id)
    ->leftJoin('costume_description','costumes.costume_id','costume_description.costume_id')
    ->take(5)
    ->where('deleted_status','0')
    ->orderBy('created_at','DESC')
    ->get();
    $states=Address::getStatesList();
    //echo "<pre>";print_r($this->data['my_costumes']);die; 
   		return view('frontend.dashboard.dashboard')->with($this->data)->with('states',$states);
=======
//print_r($this->data['recent_orders']);
			return view('frontend.dashboard.dashboard')->with($this->data);
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
			
		}else{
			return Redirect::to('admin/dashboard');
		}

		
	}
	
	public function  EditProfile(Request $request)
  {
	
    $req=$request->all();
<<<<<<< HEAD
  
//echo "<pre>";print_r($req);die;
        if(count($req)){
        $name = User::find(Auth::user()->id);
        if(isset($req['avatar'])){
          $image = Imageresize::DashboardProfile($req['avatar']);
          
          $file_name = $image;
        }
        else{
          $file_name=$req['is_removed'];
        }

        $total_name = explode(" ",$req['last_name']);
        $iTemp = 0;
        $splits_arr = array();
        foreach($total_name as $splits)
        {
          if($iTemp >0 )
          {
            $splits_arr[] = $total_name[$iTemp];
          }
          $iTemp++;
        }
        $last_name_split = implode(" ",  $splits_arr);
        $userData = [
            'title'=>$req['title'],
            'username' => $req['username'],
            'first_name' => $total_name[0],
            'last_name' => $last_name_split,
            'display_name' => $req['last_name'],
=======
	//echo "<pre>";print_r($req);die;
        if(count($req)){
        $name = User::find(Auth::user()->id);
        if(isset($req['avatar'])){
          $file_name = str_random(10).'.'.$req['avatar']->getClientOriginalExtension();
          $source_image_path=public_path('profile_img');
          $thumb_image_path1=public_path('profile_img');
          $thumb_image_path2=public_path('profile_img/thumbs');
          $req['avatar']->move($source_image_path, $file_name);
          $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path1.'/'.$file_name,150,150);
          $this->sitehelper->generate_image_thumbnail($source_image_path.'/'.$file_name,$thumb_image_path2.'/'.$file_name,30,30);

        }
        else if(isset($req['is_removed'])){
          $file_name="";
        }
        else{
          $file_name=$name->avatar;
        }
        $userData = [
            'first_name' => $req['first_name'],
            'last_name' => $req['last_name'],
            'display_name' =>  $req['first_name']." ".$req['last_name'],
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
            'email'=>$req['email'],
            'user_img' =>$file_name
        ];
        if(!empty($req['password'])){
          $userData['password'] =  Hash::make($req['password']);
        }
        $affectedRows = User::where('id', '=', Auth::user()->id)->update($userData);
<<<<<<< HEAD
        // send mail
        $reg_subject        = "Profile Updated";
        $reg_data           = array('name'=>$total_name[0]);
        $template           = 'emails.profile_edit';
        $reg_to             = Auth::user()->email;
        $mail_status        = $this->sitehelper->sendmail($reg_to,$reg_subject,$template,$reg_data);
        // end mail
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        Session::flash('success', 'Your profile is updated successfully');
        return Redirect::back();
    return view('frontend.dashboard.dashboard');
  }
}
public function addShippingAddress(Request $req){
  //echo "<pre>";print_r($req->all());die;

  $address_id=Address::addShippingAddressDashboard($req);
  Session::flash('success', 'Shipping address updated successfully.');
  return Redirect::back();

}
public function addBillingAddress(Request $req){
 // echo "<pre>";print_r($req->all());die;
  $address_id=Address::addBillingAddressDashboard($req);
  Session::flash('success', 'Billing address updated successfully.');
  return Redirect::back();

}
<<<<<<< HEAD
public function deleteAddress($id){
  //echo "<pre>";print_r($id);die;
$deleteAddress = DB::table('address_master')->where('address_id',$id)->delete();
Session::flash('success', 'Address deleted successfully.');
return Redirect::back();

}
public function creditcradAdd(Request $req){
  $result=Creditcard::addCreditCardDashboard($req,Auth::user()->id);
  //echo "<pre>";print_r($result);die;
  if ($result['result'] == 0) {
    Session::flash('error', $result['message']);
  }else{

    Session::flash('success', 'Card added successfully.');
  }
  return Redirect::back();
}
public function Deleteccard($id){
    //echo $id;die;
    $delete_card = DB::table('creditcard')->where('id',$id)->delete();
    
      $change_default = DB::table('creditcard')->where('user_id',Auth::user()->id)->first();
      if(count($change_default)>0){
        $update_default = DB::table('creditcard')->where('user_id',Auth::user()->id)->where('id',$change_default->id)->update(['is_default'=>"1"]);
      }
    
    Session::flash('success', 'Card deleted successfully.');
    return Redirect::back();
  }

public function ShippingDetails(Request $request){
    $req = $request->all();
    $sd_id=User::ShippingDetails($req);
    if (is_numeric($sd_id)) {
      Session::flash('success', 'Shipping Details added Successfully');
    }else{
      Session::flash('error', $sd_id);
    }
    return Redirect::back();
  }
  public function sellerLocationAddress(Request $request){
    $req = $request->all();
    $res=Address::sellerLocationAddress($req);
    Session::flash('success', $res);
    return Redirect::back();
  }
  public function deletSellerLocationAddress($add_id){
    $res=Address::deletSellerLocationAddress($add_id);
    Session::flash('success', 'Seller address is deleted successfully');
    return Redirect::back();
  }

  public function ccUpdate(Request $request){
    $cc_id=Creditcard::updateCreditCardDashboard($request->all());
    return "success";
  }
  public function emailCheck(Request $request){
    $mail_check = DB::table('users')->where('email',$request->email)->where('id','!=',Auth::user()->id)->first(['email']);
    if (count($mail_check) == "1") {
      echo 'false';
    }else{
      echo "true";
    }
  } 
  public function getAddressData($address_id){
    $result=Address::getAddressData($address_id);
    return Response::JSON($result);
  }

  public function checkPaypalId($data)
       {  
            if(count($data)==0)
            {
                
                return false;
            }
            
            $paypalEmail  = $data['email'];
            $paypalFirstName = $data['fname'];
            $paypalLastName = $data['lname'];            
              

            try{            
                $sandbox="";
                $apiAppID = "APP-80W284485P519543T";
                if($mode == 'sandbox')
                {
                    $apiAppID = "APP-80W284485P519543T";
                    $url = trim("https://svcs.".$sandbox."paypal.com/AdaptiveAccounts/GetVerifiedStatus");
                }
                else
                {
                    $apiAppID = ""; // put production appId here
                    $url = trim("https://svcs.paypal.com/AdaptiveAccounts/GetVerifiedStatus");
                }
                
                $apiUserName = 'sbasireddy_api1.dotcomweavers.com'; // Put Api user name here
                $apiPassword =  'ZFVZNUDSPSJJ5WXV'; // Put Api password here
                $apiSignature =  'AFcWxV21C7fd0v3bYYYRCpSSRl31A376jcebKr6QW7ZvLOrsncZxqe6a'; // Put Api Signature here
                //Default App ID for Sandbox    
                
                $apiRequestFormat = "NV";
                $apiResponseFormat = "JSON";
                $actionType="GetVerifiedStatus";
                $bodyparams = array (
                    "emailAddress"=>$paypalEmail,
                    "firstName"=>$paypalFirstName,
                    "lastName"=>$paypalLastName,
                    "matchCriteria"=>"NAME",
                    );

                $bodyData = http_build_query($bodyparams, "", chr(38));
                $headers = array(
                "X-PAYPAL-SECURITY-USERID: ".$apiUserName,
                "X-PAYPAL-SECURITY-PASSWORD: ".$apiPassword,
                "X-PAYPAL-SECURITY-SIGNATURE: ".$apiSignature,
                "X-PAYPAL-REQUEST-DATA-FORMAT: ".$apiRequestFormat,
                "X-PAYPAL-RESPONSE-DATA-FORMAT: ".$apiResponseFormat,
                "X-PAYPAL-APPLICATION-ID: ".$apiAppID,
                );
                  
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSLVERSION, 6);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $keyArray = json_decode(curl_exec($ch), true);
                
                if (curl_errno($ch) != 0)
                {
                    $message = "Can't connect to PayPal to get Verified Status for given paypal account";  
                    $message = curl_error($ch);
                    curl_close($ch);  
                    return false;
                }
                
                curl_close($ch);  
            
                If ($keyArray['responseEnvelope']['ack']== "Success")
                {  
                     $message = "success";   // Paypal Id Exists
                     return true;
                }
                else {
                    
                    $message = "Invalid Paypal ID";   // Paypal Id Not Exist
                    return false;
                }
            }catch(Exception $e) {  
                 $message = $e->getMessage();  
                return false;
            }          
        }

        public function Test(){
          return view('frontend.dashboard.test');
        }

        public function PostTest(Request $request){
          echo "<pre>";print_r($request->all());die;
        }

=======
public function deleteAddress(Request $req){
  //echo "<pre>";print_r($req->all());die;
$deleteAddress = DB::table('address_master')->where('address_id',$req->id)->delete();
Session::flash('success', 'Address deleted successfully.');
return "success";

}
public function creditcradAdd(Request $req){
  //echo "<pre>";print_r($req->all());die;
  $cc_id=Creditcard::addCreditCardDashboard($req,Auth::user()->id);
  Session::flash('success', 'Card added successfully.');
  return Redirect::back();
}
public function Deleteccard(Request $req){
    //echo $id;die;
    $delete_card = DB::table('creditcard')->where('id',$req->id)->delete();
    Session::flash('success', 'Card deleted successfully.');
    return "success";
  }

public function allOrders(){
  /*$this->data = array();
  $this->data['recent_orders'] = DB::Select('SELECT DATE_FORMAT(created_at,"%m/%d/%y") as date,ord.order_id,st.name as status FROM `cc_order` as ord LEFT JOIN cc_order_status as sts on sts.order_id=ord.order_id LEFT JOIN cc_status as st on st.status_id=sts.status_id  where ord.order_id='.Auth::user()->id.'
ORDER BY `order_id` DESC');
  return view('frontend.dashboard.allorders')->with('all_data',$this->data);*/
}
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
}

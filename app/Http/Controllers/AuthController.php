<?php namespace App\Http\Controllers;
use Auth;
use Validator;
use Mail;
use Session;
use Response;
use App\User;
use App\Cart;
use App\Helpers\Site_model;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Socialite;
use URL;
use Cookie;
use DB;
use Meta;
use Carbon\Carbon;
//use App\BraintreeApp;
use App\Costumes;
use App\Helpers\StripeApp;
class AuthController extends Controller {

	protected $auth;
	protected $layout = 'layouts.main';
	
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
		//$this->braintreeApi = new BraintreeApp();
		$this->stripe=new StripeApp();
		 		
	}
	public function index()
	{
	   if (Auth::check()) 
        {
        	   return Redirect::route('dashboard');
        }
        Session::put('is_loginPage');
        return view('auth.login');		
 	}
   public function getSignin()
   {   
    	Session::put('is_loginPage');
    	if(Auth::check()){
    		return Redirect::to('/dashboard');
    	}else{
            Meta::set('title', 'Customer Login | Chrysalis Costumes');
            Meta::set('description', 'Login into Chrysalis Costumes');
            return View('auth.login');
    	}	
   }
   public function postLogin(Request $request)
   {

   	$req = $request->all();
   	$rule  =  array(  
	              'email' => 'required|email',
                  'password' => 'required',
                 );
    $validator = Validator::make($req,$rule);
    if ($validator->fails()) {
		return Redirect::to('/login')
		->withErrors($validator)
		->withInput()->send();
	}

	 if (!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) === false) {
		  $field='email';
		} else {
		   Session::flash('Invalid Email address'); 
		}
	 	$request->merge([$field => $request->input('email')]);
 		$credentials = $request->only($field,'password');
		$user=User::where("email","=", $request->input('email'))->where('role_id','!=',"1")->count();
		if($user){
			if ($this->auth->attempt($credentials, $request->has('remember')))
			{
                $userData = User::where("email","=", $request->input('email'))->first();
                Session::put('userId', $userData->id);
				$activation=User::where("email","=", $request->input('email'))->where("active","=", "0")->count();
	
				if($activation){
					Auth::logout();
					Session::flash('error', 'Your account is not activated yet. Please check your email.'); 
					return Redirect::to('/login')->withInput($request->except('password'));	
				}
				if (!empty($req['plan_id'])){
					return Redirect::to('/subscription/'.$req['plan_id']);
				}
				 $currentCookieKeyID=SiteHelper::currentCookieKey();
				 if($currentCookieKeyID!="0"){
				   	Cart::updateCartToUser();
				  }
				 $cookie = \Cookie::forget('min-cart');
				 /*$fav_url_redirect=strrev(explode("/",strrev(URL::previous()))[3]);
				 if(!empty($req['costume_id']) && $fav_url_redirect=="product"){
				 	return Redirect::to('/buy-it-now/'.trim($req['costume_id']));
				 }
				 if(!empty($req['is_cart']) && $fav_url_redirect!="product"){
				 	return Redirect::to('/checkout');
				 }*/
				 if(Session::has('curentURL')){
				 	return Redirect::to(Session::get('curentURL'))->withCookie($cookie);
				 }
				 if(Session::has('is_loginPage')){
					return Redirect::to('/dashboard')->withCookie($cookie);
				 }else if($request->session()->get('_previous')['url'] == url('/')){
				 	return Redirect::to('/dashboard');
				 }else if(Session::has('is_blog')){
                     return Redirect::to('/blog')->withCookie($cookie);
                 }else if(Session::has('is_event')){
                     return Redirect::to('/events')->withCookie($cookie);
                 }else{
                 	 //return Redirect::to('/dashboard')->withCookie($cookie);
                     $loginTime['last_login'] = Carbon::now();
                     $updateUserTime= User::where("email","=", $request->input('email'))->update($loginTime);
                 	return Redirect::back()->withCookie($cookie);
					}
			}
			else 
			{ 
				Session::flash('error', 'Invalid Email or Password'); 
				return Redirect::to('/login');	
			}
		}
		else{
			Session::flash('error', 'Invalid Email or Password');
			return Redirect::to('/login');
		}
	}
	/**
	 * Edited by Gaytari
	 * User Registration
	 * @param  Request $request [description]
	 * @return login Page           [description]
	 */
	public function postRegisterUser(Request $request)
	{
		$req = $request->all();
		$flag = 0;

		if($request->session()->get('curentURL') == URL::to('costume/successrequestbag')){
			$flag = 1;
			$rule  =  array(
                      'email' => 'required|email|unique:users|max:255',
                      'password' => 'required|min:5',
	                 );
		}else{
			$rule  =  array(  
    	              'first_name' => 'required|max:255',
                      'last_name' => 'required|max:255',
                      'email' => 'required|email|unique:users|max:255',
                      'password' => 'required|min:5',
	                 );
		}
		
	    $validator = Validator::make($req,$rule);
        if ($validator->fails()) {
			return Redirect::to('login#signup_tab')
			->withErrors($validator)
			->withInput()->send();
		}
	    
	    $rand = md5(uniqid(rand(), true));
	    
	    if(count(Session::get('social_data'))){ 
	    	$active = "1";
	    }else{ 
	    	$active = "0";
	    }

	    try{
         $customer = $this->stripe->customers($req['email']);
        }catch(Exception $e){
           Session::flash('error', $e->getMessage());
           return Redirect::back();
        }
        if($flag == 0){
        	$display_name = trim($req['first_name']).' '.trim($req['last_name']);
        	$first_name = $req['first_name'];
        	$last_name = $req['last_name'];
        }else{
        	$uname = explode(" ", $req['reg_full_name'], 2);
        	$display_name = $req['reg_full_name'];
        	$first_name = $uname[0];
        	$last_name = (count($uname)>1)? end($uname): '';
        }
        
	    $users = User::create([ 'username' =>	$req['username'],
	   							'first_name' => $first_name,
			                    'last_name' => $last_name,
			                    'display_name' => $display_name,
			                    'email' => $req['email'],
			                    'password' => bcrypt($req['password']),
			                    'active' => $active,
							    'activate_hash' => $rand,
							    'api_customer_id' => $customer['id']
							])->id;

  		if($users){
  			/* Added by Gayatri */
  			$curentURL = '';
  			if($request->session()->get('curentURL') == URL::to('costume/successrequestbag')){
  				$curentURL = URL::to('costume/successrequestbag');
  				Costumes::createRequestBag($users);
  				Session::flush();
	  			//$request->session()->put('curentURL', $curentURL);

	  			$email['name'] = $display_name;
  				$email['activation_link'] = URL::to('/').'/verification/'.$rand;
				$sent = Mail::send('emails.registration',array("email"=>$email), function ($m) use($req, $display_name) {
					$admin_settings=Site_model::Fetch_data('users','*',array("role_id"=>"1"));
					$m->to($req['email'], $display_name);
				    $m->subject('Activation Link');
				});
				return Redirect::to('costume/successrequestbag'); 
  			}else{
  				Session::flush();
	  			//$request->session()->put('curentURL', $curentURL);
	  			/* End */
	  			if($active){
	  				Session::flash('success', 'Your account has been activated. You can login into your account now.');
	  			}else{
	  				$email['name'] = $display_name;
	  				$email['activation_link'] = URL::to('/').'/verification/'.$rand;
					$sent = Mail::send('emails.registration',array("email"=>$email), function ($m) use($req, $display_name) {
						$admin_settings=Site_model::Fetch_data('users','*',array("role_id"=>"1"));
						$m->to($req['email'], $display_name);
					    $m->subject('Activation Link');
					});
					Session::flash('success', 'Registration is completed successfully. Activation Link is sent to your registered email.');	
			 	}
			}
		}
		else
		{
			 Session::flash('error', 'Registration completed successfully.Due database error');
		}
		return Redirect::to('login'); 
	}

 	/*public function postRegisterUser(Request $request){
		$req = $request->all();
		//echo "<pre>";print_r($req);die;
		$rule  =  array(  
    	              'first_name' => 'required|max:255',
                      'last_name' => 'required|max:255',
                      'email' => 'required|email|unique:users|max:255',
                      'password' => 'required|min:5',
	                 );
	    $validator = Validator::make($req,$rule);
        if ($validator->fails()) {
			return Redirect::to('login#signup_tab')
			->withErrors($validator)
			->withInput()->send();
		}
	    $rand=md5(uniqid(rand(), true));
	    if(count(Session::get('social_data'))){ $active="1";}else{ $active="0";}
	    try{
         $customer=$this->stripe->customers($req['email']);
        }catch(Exception $e){
           Session::flash('error', $e->getMessage());
           return Redirect::back();
        }
	    $users = User::create([ 'username' =>$req['username'],
	   							'first_name'      => $req['first_name'],
			                   'last_name'       => $req['last_name'],
			                   'display_name'    => trim($req['first_name']).' '.trim($req['last_name']),
			                   'email'           => $req['email'],
			                   'password'   => bcrypt($req['password']),
			                   'active'=>$active,
							   'activate_hash'=>$rand,
							    'api_customer_id'=>$customer['id']
							   ])->id;
	 //   $customerData = [
		// 		'firstName' => $req['first_name'],
		// 		'lastName' => $req['last_name'],
		// 		'email' => $req['email'],
		// ];
	 //    $this->braintreeApi->createCustomer($customerData,$users);

                         
  		if($users){
  			//Session::flush();
  			
  			$curentURL = '';
  			if($request->session()->get('curentURL') == URL::to('costume/successrequestbag')){
  				$curentURL = URL::to('costume/successrequestbag');
  				Costumes::createRequestBag($users);
  			}
  			Session::flush();
  			$request->session()->put('curentURL', $curentURL);
  			
  			if($active){
  				Session::flash('success', 'Your account has been activated. You can login into your account now.');
  			}else{
  				$email['name']=trim($req['first_name']).' '.trim($req['last_name']);
  				$email['activation_link']=URL::to('/').'/verification/'.$rand;
				$sent=Mail::send('emails.registration',array("email"=>$email), function ($m) use($req) {
					$admin_settings=Site_model::Fetch_data('users','*',array("role_id"=>"1"));
					$m->to($req['email'], trim($req['first_name']).' '.trim($req['last_name']));
				    $m->subject('Activation Link');
				});
				Session::flash('success', 'Registration is completed successfully. Activation Link is sent to your registered email.');	
		 	}
		}
		else
		{
			 Session::flash('error', 'Registration completed successfully.Due database error');
		}
		return Redirect::to('login'); 
	}*/
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider,Request $request)
    {
       	if (!$request->has('code') || $request->has('denied')) {
           return redirect('/login');
       }


         try {

           $user = Socialite::driver($provider)->user();

       }

       catch (Exception $e) {
           
           return redirect ('/login');
       }
        $data = [
                'name'  => $user->getName(),
                'email' => $user->getEmail(),
                'profile_img' => $user->getAvatar()
        ];
        
        $users=User::where("email","=", $user->getEmail())->first();
        
        if($users)
        {
                $this->auth->login($users,true);
                return Redirect::to('/dashboard');
        }
        else
        {    
            
            Session::put('social_data',$data);
            return Redirect::to('/login#signup_tab');
    
        }
    
    }
    public function getAdminSignin()
    {
    	if (Auth::check())
    	{
    		if(Auth::user()->role_id==1)
    		{
    			$title = "Dashboard";
    			return view('admin.dashboard.index',  compact('title'));
    		}
    		else
    		{
    			Session::flush();
				Auth::logout();
    			return Redirect::to('/admin');
    		}
    	}
     return View('admin.login');
    }
    //check admin login details
     
    public function postAdminSignin(Request $request)
    {
	    $req = $request->all();
	  	$rule  =  array(  
		              'email' => 'required|email',
	                  'password' => 'required',
	                 );

	    $validator = Validator::make($req,$rule);
	    if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput()->send();
		}
	   if (!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) === false) {
		  $field='email';
		} else {
		   Session::flash('Invalid Email address'); 
		}
	 	$request->merge([$field => $request->input('email')]);
 		$credentials = $request->only($field,'password');
		$user=User::where("email","=", $request->input('email'))->where('role_id','=',"1")->orwhere('role_id','=',"2")->count();
		if($user){
			if ($this->auth->attempt($credentials, $request->has('remember')))
			{
				return Redirect::to('admin/dashboard');
			}
			else 
			{ 
				Session::flash('error', 'Invalid Email or Password'); 
				return Redirect::back();	
			}
		}
		else{
			Session::flash('error', 'Invalid Email or Password');
			return Redirect::back();
		}
    }
    public function verification($verification)
    {
    	$data=User::where('activate_hash', '=', $verification) ->get();
    	if(count($data)){
				User::where('activate_hash', '=', $verification)->update(array('activate_hash' => "",'active' => '1'));
    			Session::flash('success', 'Your account has been activated. You can login into your account now.');
    			return Redirect::to('/login');
    	}
		else{
    			Session::flash('error', 'Activation code is invalid');
    			return Redirect::to('/login');
    		}
    	
    }
    public function forgotPassword(Request $request)
	{   
		$req = $request->all();
		$rule  =  array(
		                  'email' => 'required|email|max:255'
		             );
		$validator = Validator::make($req,$rule);
		if ($validator->fails())
			{
				 return Redirect::to('login#forget_password')->withErrors($validator->messages())->withInput();
			}
		else
		{
			$email=User::where("email","=",$req['email'])->get()->toArray();
	    	$rand=md5(uniqid(rand(), true));
			if(count($email))
	      		{ 
		     		if($email[0]['active']==1)
		     		{  
		     			$activation_link=URL::to('/').'/password/change/'.$rand;
				 		$data['name']=$email[0]['display_name'];
						$data['activation_link']=$activation_link;
						$sent=Mail::send('emails.forget_email',array("data"=>$data), function ($m) use($email){
							$m->to($email[0]['email'], $email[0]['display_name']);
						    $m->subject('Forgot Password');
						});
						User::where('email', '=', $email[0]['email'])->update(array('reset_hash'=>$rand));
		     			Session::flash('success', 'Your forgot password activation link sent to your mail');
				 		
				 		return Redirect::to("/login");
			 		}
					else
					 {
				    	$activation_link=URL::to('/').'/verification/'.$rand;
						User::where('email', '=',$req['email'])->update(array('activate_hash'=> $rand));
				 		$email['name']=$email[0]['display_name'];
		  				$email['activation_link']=$activation_link;
						$sent=Mail::send('emails.registration',array("email"=>$email), function ($m) use($email) {
							$m->to($email[0]['email'], $email[0]['display_name']);
						    $m->subject('Activation Link');
						});
						User::where('email', '=', $req['email'])->update(array('reset_hash'=> $rand));
    					if($sent){
				 			Session::flash('success', 'Your account not been activated yet.New verification code is sent your mail');
				 		}
				 		else{
				 			Session::flash('error', 'Your account not been activated yet.New verification code is sent your mail');		
				 		}
						return Redirect::to("/login");
					 }  
		      }
	      else{ 
	      	   	Session::flash('error', "Email id doesn't exists");
	      	   	return Redirect::to('login#forget_password');
	           }

		}
	}
	public function adminForgotPassword()
	{   
			return View('admin.forgotpassowrd');
	}
	 public function adminForgotPasswordPost(Request $request)
	{   
		$req = $request->all();
		$rule  =  array(
		                  'email' => 'required|email|max:255'
		             );
		$validator = Validator::make($req,$rule);
		if ($validator->fails())
			{
				 return Redirect::to('admin/forgotpassword')->withErrors($validator->messages())->withInput();
			}
		else
		{
			$email=User::where("email","=",$req['email'])->where('role_id','=',"1")->get()->toArray();
	    	$rand=md5(uniqid(rand(), true));
			if(count($email))
	      		{ 
		     		$activation_link=URL::to('/').'/admin/password/change/'.$rand;
				 		$data['name']=$email[0]['display_name'];
						$data['activation_link']=$activation_link;
						$sent=Mail::send('emails.forget_email',array("data"=>$data), function ($m) use($email){
							$m->to($email[0]['email'], $email[0]['display_name']);
						    $m->subject('Forgot Password');
						});
						User::where('email', '=', $email[0]['email'])->where('role_id','=',"1")->update(array('reset_hash'=>$rand));
		     			Session::flash('success', 'Your forgot password activation link sent to your mail');
				 		
				 		return Redirect::back();
			 		
		      }
	      else{ 
	      	   	Session::flash('error', "Email id doesn't exists");
	      	   	return Redirect::back();
	           }

		}
	}
	public function forgotPasswordChange(Request $request,$verification=null){
		$req = $request->all();
		if(count($req)){
			$rule  =  array(
		                  'password' => 'required|max:50'
		             );
			$validator = Validator::make($req,$rule);
			if ($validator->fails())
				{
					 return Redirect::back()->withErrors($validator->messages())->withInput();
				}
			$data=User::where('id', '=', $req['user_id'])->update(['password' => bcrypt($req['password']),"reset_hash"=>""]);
			Session::flash('success', 'Your Password is changed successfully.');
			return Redirect::to("/login");
		}
		if($verification==null){
			Session::flash('error', 'Verification code is invalid.');
			return Redirect::to("/login");
		}else{
			$data=User::where("reset_hash","=",$verification)->get()->toArray();
			return view('auth.change_password')->with('id',$data[0]['id']);
		}
		
	}
	public function adminForgotPasswordChange(Request $request,$verification=null){
		$req = $request->all();
		if(count($req)){
			$rule  =  array(
		                  'password' => 'required|max:50'
		             );
			$validator = Validator::make($req,$rule);
			if ($validator->fails())
				{
					 return Redirect::back()->withErrors($validator->messages())->withInput();
				}
			$data=User::where('id', '=', $req['user_id'])->update(['password' => bcrypt($req['password']),"reset_hash"=>""]);
			Session::flash('success', 'Your Password is changed successfully.');
			return Redirect::to("/admin");
		}
		if($verification==null){
			Session::flash('error', 'Verification code is invalid.');
			return Redirect::to("/admin");
		}else{
			$data=User::where("reset_hash","=",$verification)->get()->toArray();
			if(count($data)){
				return view('admin.change_password')->with('id',$data[0]['id']);
			}else{
				Session::flash('error', 'Verification code is invalid.');
				return Redirect::to("/admin");
			}
		}
		
	}
	public function EmailNameCheck(Request $request)
	{
		$req=$request->all();
		if(!isset($req['user_id'])){
			$email=User::where('email', '=', $req['email']) ->count();
		}
		else{
	
			$email=User::where('email', '=', $req['email'])->where('id',"!=",$req['user_id'])->count();
		}
		if($email){
			return Response::JSON(false);
		}
		else{
			return Response::JSON(true);
		}
	}
	public function UserNameCheck(Request $request)
	{
		$req=$request->all();
		if(!isset($req['user_id'])){
			$email=User::where('username', '=', $req['username']) ->count();
		}
		else{
	
			$email=User::where('username', '=', $req['username'])->where('id',"!=",$req['user_id'])->count();
		}
		if($email){
			return Response::JSON(false);
		}
		else{
			return Response::JSON(true);
		}
	}
	public function forgorpasswordEmailCheck(Request $request)
	{
		$req=$request->all();
		$email=User::where('email', '=', $req['email']) ->count();
		if($email){
			return Response::JSON(true);
		}
		else{
			return Response::JSON(false);
		}
	}
	public function logout()
	{       
		Session::flush();
		Auth::logout();
		$cookie = \Cookie::forget('min-cart');
		return Redirect::to('/');
	}

	public function postrequestabagLogin(Request $request){
		$req = $request->all();
   	$rule  =  array(  
	              'email' => 'required|email',
                  'password' => 'required',
                 );
    $validator = Validator::make($req,$rule);
    if ($validator->fails()) {
		return Redirect::to('/login')
		->withErrors($validator)
		->withInput()->send();
	}

	 if (!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) === false) {
		  $field='email';
		} else {
		   Session::flash('Invalid Email address'); 
		}
	 	$request->merge([$field => $request->input('email')]);
 		$credentials = $request->only($field,'password');
		$user=User::where("email","=", $request->input('email'))->where('role_id','!=',"1")->count();
		if($user){
			if ($this->auth->attempt($credentials, $request->has('remember')))
			{
				
				$activation=User::where("email","=", $request->input('email'))->where("active","=", "0")->count();
	
				if($activation){
					Auth::logout();
					Session::flash('error', 'Your account is not activated yet. Please check your email.'); 
					return Redirect::to('/login')->withInput($request->except('password'));	
				}
				if (!empty($req['plan_id'])){
					return Redirect::to('/subscription/'.$req['plan_id']);
				}
				  $currentCookieKeyID=SiteHelper::currentCookieKey();
				  if($currentCookieKeyID!="0"){
				   //	Cart::updateCartToUser();
				  }
				 $cookie = \Cookie::forget('min-cart');
				 if(Session::has('is_loginPage')){
					return Redirect::to('/dashboard')->withCookie($cookie);
				 }else{
						if (Auth::check() || isset($req_bag_session) && !empty($req_bag_session)) {
							$userid 		= Auth::user()->id;
							$is_payout 		= $request->is_payout;
							$cus_name  		= $request->full_name;
							$cus_email 		= $request->email_address;
							$cus_phone 		= $request->phone_number;
							
							if (isset($request->is_return) && !empty($request->is_return)) {
								$is_return 		= $request->is_return;
							}else{
								$is_return 		= "0";
							}
							if (isset($request->is_recycle) && !empty($request->is_recycle)) {
								$is_recycle 		= $request->is_recycle;
							}else{
								$is_recycle 		= "0";
							}
							if (isset($request->address2) && !empty($request->address2)) {
								$address2 		= $request->address2;
							}else{
								$address2 		= "";
							}
							$addres_array = array('fname'=>$cus_name,
								'address1'=>$request->address1,
								'address2'=>$address2,
								'city'=>$request->city,
								'state'=>$request->state,
								'zip_code'=>$request->zipcode,
								'phone'=>$cus_phone,
								'user_id'=>$userid,
								'address_type'=>'request_a_bag','created_on'=>date('y-m-d H:i:s'));
							$ref_no = mt_rand(10000, 99999);
							//echo $ref_no;die;
							$addres_insert=DB::table('address_master')->insertGetId($addres_array);

							$conversation_array = array('type'=>'request_a_bag','user_one'=>$userid,

								'subject'=>'Your Bag created.',

								'user_two'=>'1',
								'status'=>'1',
								'created_at'=>date('y-m-d H:i:s'));
							$conversation_insert=DB::table('conversations')->insertGetId($conversation_array);

							$theard_array  = array('message'=>'Your Bag is under process.',
									'is_seen'=>'0',
							        'deleted_from_sender'=>'0',
							        'deleted_from_receiver'=>'0',
							        'user_id'=>$userid,
							        'user_name'=>Auth::user()->display_name,
							        'conversation_id'=>$conversation_insert,
							        'created_at'=>date('y-m-d H:i:s'));
							$theard = DB::table('messages')->insertGetId($theard_array);
							$requestabag_array = array('user_id'=>$userid,
								'ref_no'=>$ref_no,
								'addres_id'=>$addres_insert,
								'conversation_id'=>$conversation_insert,
								'is_payout'=>$is_payout,
								'is_return'=>$is_return,
								'is_recycle'=>$is_recycle,
								'status'=>'requested',
								'cus_name'=>$cus_name,
								'cus_email'=>$cus_email,
								'cus_phone'=>$cus_phone,
								'created_at'=>date('y-m-d H:i:s'),
								);

							$requestabag_insert=DB::table('request_bags')->insertGetId($requestabag_array);
							$conversation_array = array('type_id'=>$requestabag_insert);
				$conversation_insert=DB::table('conversations')->where('id',$conversation_insert)->update($conversation_array);

							return "success";

					}else {
						Session::flash('error', 'Invalid Email or Password'); 
						return Redirect::to('/login');
					}
				}
			}
			else 
			{ 
				Session::flash('error', 'Invalid Email or Password'); 
				return Redirect::to('/login');	
			}
		}
		else{

			Session::flash('error', 'Invalid Email or Password');
			return Redirect::to('/login');
		}
		Session::flash('error', 'Invalid Email or Password');
	}
	
}

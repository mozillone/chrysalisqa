<section class="newsletter-container subscribe-btn-align">
<<<<<<< HEAD
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-12 col-xs-12"><h3>SIGN UP FOR OUR NEWSLETTER</h3>
				<form id="register-newsletter" name="newsletter" method="post">
					<div class="news_ltr">
						<input type="text" name="subscribe_email" id="subscribe_email" required="" autocomplete="off"   placeholder="Enter your email address">
						<p style="position: absolute;text-align: left;color:red;"><span id="subscribeerror"></p>
							<input type="submit" name="submit" id="submit" class="btn btn-custom-3" value="Subscribe">
						</div>
					</form>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12 social-media">
					<div class="row">
						<div class="col-md-4 col-sm-12 col-xs-12 social-fallow">
							<h3>FOLLOW US</h3>
						</div>
						<div class="col-md-8 col-sm-12 col-xs-12 social-img">
							<div class="social-icons">
								<a target="_blank" href="https://www.facebook.com/Chrysalis-Costumes-1571674966183606/"><img class="img-responsive" src="{{asset('/assets/frontend/img/fb-icon.png')}}"></a>
								<a target="_blank" href="https://twitter.com/MaxGarweg"><img class="img-responsive" src="{{asset('/assets/frontend/img/twit-icon.png')}}"></a>
								<a target="_blank" href="https://www.instagram.com/chrysaliscostumes/?hl=en/"><img class="img-responsive" src="{{asset('/assets/frontend/img/insta-icon.png')}}"></a>
								<a target="_blank" href=""><img class="img-responsive" src="{{asset('/assets/frontend/img/youtube-icon.png')}}"></a>
=======
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-12 col-xs-12"><h3>SIGN UP FOR OUR NEWSLETTER</h3>
						<form id="register-newsletter">
							<input type="text" name="newsletter" required="" placeholder="Enter your email address">
							<input type="submit" class="btn btn-custom-3" value="Subscribe">
						</form>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 social-media">
						<div class="row">
							<div class="col-md-4 col-sm-12 col-xs-12 social-fallow">
								<h3>FOLLOW US</h3>
							</div>
							<div class="col-md-8 col-sm-12 col-xs-12 social-img">
								<div class="social-icons">
									<a href=""><img class="img-responsive" src="{{asset('/assets/frontend/img/fb-icon.png')}}"></a>
									<a href=""><img class="img-responsive" src="{{asset('/assets/frontend/img/twit-icon.png')}}"></a>
									<a href=""><img class="img-responsive" src="{{asset('/assets/frontend/img/insta-icon.png')}}"></a>
									<a href=""><img class="img-responsive" src="{{asset('/assets/frontend/img/youtube-icon.png')}}"></a>
								</div>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
							</div>
						</div>
					</div>
				</div>
			</div>
<<<<<<< HEAD
		</div>
	</section>
	<section class="footer">
		<div class="container">
			<div class="row">
				<div class="footer_links" id="footer-middle">
					<div class="col-md-4 col-sm-12 co-xs-12 ft-logo">
						<div class="footer_head ">
							<img class="img-responsive" src="{{asset('/assets/frontend/img/brand.png')}}">
							<h5>OUR MISSION <i class="fa fa-plus pull-right hidden-lg  hidden-md"></i></h5>
							<p style="display: none;">Revolutionize the costume industry, by giving people access to more affordable, environmentally friendly costumes. More on our mission <a style="border-bottom: 1px solid #ccc" href="/pages/about-us">here</a>.</p>
						</div>
					</div>
					<div class="col-md-4 co-sm-12 co-xs-12 quick_links">
						<div class="footer_head mid_ft">
							<h5>QUICK LINKS <i class="fa fa-plus pull-right hidden-lg hidden-md"></i></h5>
							<ul class="col-md-6 col-sm-6 col-xs-12">
								<li><a href="/pages/about-us">About</a></li>
								<li><a href="/pages/how-it-works">How It Works</a></li>
								<li><a href="/contact-support">Support & Contact</a></li>
								<li><a href="{{ route('events') }}">Events</a></li>
							</ul>
							<ul class="col-md-6 col-sm-6 col-xs-12 snd-ul">
								<li><a href="{{ route('blog') }}">Blog</a></li>
								<li><a href="{{ route('press') }}">Press</a></li>
								<li><a href="/jobs">Jobs</a></li>
								<li><a href="/giving-back">Giving Back</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-4 co-sm-12 co-xs-12 app_img ">
						<div class="footer_head ">
							<h5><span class="hidden-lg hidden-md">THE CHRYSALIS APP</span> <i class="fa fa-plus pull-right hidden-lg  hidden-md"></i></h5>
							<div class="row ftr-app">
								<div class="col-md-6 col-xs-6 col-sm-3 col-lg-6">
									<img class="img-responsive" src="{{asset('/assets/frontend/img/footer-mobile.png')}}">		
								</div>
								<div class="col-md-6 col-xs-6 col-sm-3 col-lg-6">
									<h5>THE CHRYSALIS APP</h5>
									<p>Browse on the Go!</p>
									<a href="#" data-toggle="modal" data-target="#coming_soon">
										<img class="img-responsive" src="{{asset('/assets/frontend/img/appstore.png')}}">
									</a>
									<a href="#">
										<img class="img-responsive" src="{{asset('/assets/frontend/img/google-play.png')}}">
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="btm-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p>© 2017 CHRYSALIS. ALL RIGHTS RESERVED​​​​​​​ | <a href="/pages/terms-of-use/" style="color: #fff;">TERMS OF USE</a> | <a href="/pages/privacy-policy/" style="color: #fff;"> PRIVACY POLICY </a></p>
			</div>
		</div>
	</div>
</section>
<div class="modal fade window-popup" id="signup_popup" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="login-register" id="loginModal">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#login_tab1" data-toggle="tab" class="first_active">Sign In</a></li>
							<li><a href="#signup_tab1" data-toggle="tab">Register</a></li>
							<li class="hide"><a href="#forget_password1" data-toggle="tab">Reset Password</a></li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active  in lgn" id="login_tab1">
								<form class="" action="{{route('login.post')}}" method="POST" id="loginpopup">   
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="costume_id" value="@if(!empty($data[0]->costume_id)){{$data[0]->costume_id}}@endif">
									<input type="hidden" name="is_cart" value="@if(!empty($data['basic'])){{count($data['basic'])}}@endif">
									<div class="form-group">
										<label>Email</label>
										<input type="text" id="loginpopup_email" name="email" class="form-control">
										<p class="error">{{ $errors->first('email') }}</p>
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" id="loginopup_password" name="password"  class="form-control">
										<p class="error">{{ $errors->first('password') }}</p>
									</div>
									<div class=" form-group loign-adtnl forgot"> 
										<label><a href="#forget_password1" data-toggle="tab">Help! I forgot my password.</a></label>
									</div>
									<div class="form-group">
										<div class="login-btn">
											<button class="btn btn-primary">Log In</button>
										</div>
									</div>
								</form>                  
							</div>
							<div class="tab-pane fade sign" id="signup_tab1">
								<form role="form" action="{{route('register')}}" method="POST" id="signup_pop">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="form-group">
										<div class="form-group">
											<label>Username</label>
											<input type="text" id="pop_username" name="username"  class="form-control">
										</div>
										<label>First Name</label>
										<input type="text" name="first_name" id="pop_first_name" class="form-control " >
									</div>
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" name="last_name" id="pop_last_name" class="form-control " >
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="text" id="popup_email" name="email"  class="form-control">
									</div>
									<div class="row sinup-pswrd"> 
										<div class="col-md-12 col-sm-12 col-xs-12 "> 
											<div class="form-group">
												<label>Password</label>
												<input type="password" id="popup_password" name="password" class="form-control">
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12 "> 
											<div class="form-group">
												<label>Confirm Password</label>
												<input type="password" id="pop_cpassword"  name="cpassword"  class="form-control">
											</div>
										</div>
									</div> 
									<div class="row"> 
										<div class="col-md-12 col-sm-12 col-xs-12 "> 
											<div class="form-group">
												<div class="text-center creat_btn">
													<button class="btn btn-primary">Create Account!</button>
												</div>
											</div>
										</div>
									</div>
								</form>   
							</div>
							<div class="tab-pane fade fpswd" id="forget_password1">
								<form class="" action="{{route('forgotpassword.post')}}" method="POST" id="forgetpopup_password">   
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="form-group">
										<input type="text" id="forgotpop_email" name="email" placeholder="Email" class="form-control">
										<p class="error">{{ $errors->first('email') }}</p>
									</div>
									<div class="form-group">
										<div class="text-center rect_pswrd">
											<button class="btn btn-primary">Reset Password</button>
										</div>
									</div>
								</form>             
							</div>
							<div class="form-group or text-center">
								<p>Or</p>
							</div>
							<div class="social-login">
								<div class="form-group socil-btn">
									<a class="btn btn-primary social-login-btn social-facebook" href="{{ route('social.login', ['facebook']) }}"><i class="fa fa-facebook" aria-hidden="true"></i> &nbsp;Log In With Facebook</a>
								</div>
							</div>
							<div class="text-center close_icon">
								<button type="button" class="close" data-dismiss="modal"><span>&times;</span> Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
=======
		</section>
		<section class="footer">
			<div class="container">
				<div class="row">
				<div class="footer_links" id="footer-middle">
					<div class="col-md-4 col-sm-12 co-xs-12 ft-logo">
					<div class="footer_head ">
						
						<img class="img-responsive" src="{{asset('/assets/frontend/img/brand.png')}}">
						<h5>OUR MISSION <i class="fa fa-plus pull-right hidden-lg  hidden-md"></i></h5>
						<p style="display: none;">Revolutionize the costume industry, by giving people access to more affordable, environmentally friendly costumes. More on our mission <a style="border-bottom: 1px solid #ccc">here</a>.</p>
						
					</div>
					</div>

					<div class="col-md-4 co-sm-12 co-xs-12 quick_links">
					<div class="footer_head mid_ft ">
						<h5>QUICK LINKS <i class="fa fa-plus pull-right hidden-lg hidden-md"></i></h5>
						<ul class="col-md-6 col-sm-6 col-xs-12">
							<li>About</li>
							<li>How It Works</li>
							<li>Support & Contact</li>
							<li>Events</li>
						</ul>
						<ul class="col-md-6 col-sm-6 col-xs-12">
							<li>Blog</li>
							<li>Press</li>
							<li>Jobs</li>
							<li>Giving Back</li>
						</ul>
					</div>
					</div>

					<div class="col-md-4 co-sm-12 co-xs-12 app_img">
					<div class="footer_head ">
						<h5><span class="hidden-lg hidden-md">THE CHRYSALIS APP</span> <i class="fa fa-plus pull-right hidden-lg  hidden-md"></i></h5>
						<img class="img-responsive" src="{{asset('/assets/frontend/img/app-img.png')}}">
						</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</section>
		<section class="btm-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p>© 2017 CHRYSALIS. ALL RIGHTS RESERVED​​​​​​​ | TERMS OF USE | PRIVACY POLICY</p>
					</div>
				</div>
			</div>
		</section>
<div class="modal fade window-popup" id="signup_popup" tabindex="-1">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="login-register" id="loginModal">
				<ul class="nav nav-tabs">
                    <li class="active"><a href="#login_tab1" data-toggle="tab" class="first_active">Sign In</a></li>
                    <li><a href="#signup_tab1" data-toggle="tab">Register</a></li>
                    <li class="hide"><a href="#forget_password1" data-toggle="tab">Reset Password</a></li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane active  in" id="login_tab1">
						<form class="" action="{{route('login.post')}}" method="POST" id="loginpopup">   
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="costume_id" value="@if(!empty($data[0]->costume_id)){{$data[0]->costume_id}}@endif">
							<input type="hidden" name="is_cart" value="@if(!empty($data['basic'])){{count($data['basic'])}}@endif">
							<div class="form-group">
							<label>Email</label>
								<input type="text" id="loginpopup_email" name="email" class="form-control">
								<p class="error">{{ $errors->first('email') }}</p>
							</div>
							<div class="form-group">
							<label>Password</label>
								<input type="password" id="loginopup_password" name="password"  class="form-control">
								<p class="error">{{ $errors->first('password') }}</p>
							</div>
							<div class=" form-group loign-adtnl forgot"> 
								<label><a href="#forget_password1" data-toggle="tab">Help! I forgot my password.</a></label>
							</div>
							<div class="form-group">
								<div class="login-btn">
									<button class="btn btn-primary">Log In</button>
								</div>
							</div>
							
					</form>                  
					</div>
                    <div class="tab-pane fade" id="signup_tab1">
						<form role="form" action="{{route('register')}}" method="POST" id="signup_pop">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
						<label>First Name</label>
			                <input type="text" name="first_name" id="pop_first_name" class="form-control " >
						</div>
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" name="last_name" id="pop_last_name" class="form-control " >
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" id="popup_email" name="email"  class="form-control">
						</div>
						<div class="row sinup-pswrd"> 
							<div class="col-md-12 col-sm-12 col-xs-12 "> 
								<div class="form-group">
									<label>Password</label>
									<input type="password" id="popup_password" name="password" class="form-control">
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 "> 
								<div class="form-group">
								<label>Confirm Password</label>
									<input type="password" id="pop_cpassword"  name="cpassword"  class="form-control">
								</div>
							</div>
						</div> 
						<div class="row"> 
							<div class="col-md-12 col-sm-12 col-xs-12 "> 
								<div class="form-group">
									<div class="text-center creat_btn">
										<button class="btn btn-primary">Create Account!</button>
									</div>
								</div>
							</div>
						</div>
						
					</form>   
					</div>
					  <div class="tab-pane fade" id="forget_password1">
						<form class="" action="{{route('forgotpassword.post')}}" method="POST" id="forgetpopup_password">   
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<input type="text" id="forgotpop_email" name="email" placeholder="Email" class="form-control">
								<p class="error">{{ $errors->first('email') }}</p>
							</div>
							<div class="form-group">
								<div class="text-center rect_pswrd">
									<button class="btn btn-primary">Reset Password</button>
								</div>
							</div>
						</form>             
					</div>
                    <div class="form-group or text-center">
								<p>Or</p>
				</div>
				<div class="social-login">
					<div class="form-group socil-btn">
						<a class="btn btn-primary social-login-btn social-facebook" href="{{ route('social.login', ['facebook']) }}"><i class="fa fa-facebook" aria-hidden="true"></i> &nbsp;Log In With Facebook</a>
					</div>
				</div>
				<div class="text-center close_icon">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span> Close</button>
				</div>
				</div>
				
			</div>
		</div>
	</div>
		</div>
	</div>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
</div>
<div class="modal fade window-popup" id="login_popup" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
<<<<<<< HEAD
			<div class=" modal-header indi_close_icons">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="login-register" id="loginModal">
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active in" id="login_tab1">
								<h2>Sign In To Your Account</h2>
								<form class="" action="{{route('login.post')}}" method="POST" id="loginpopup1">   
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="costume_id" value="@if(!empty($data[0]->costume_id)){{$data[0]->costume_id}}@endif">
									<input type="hidden" name="is_cart" value="@if(!empty($data['basic'])){{count($data['basic'])}}@endif">
									<div class="form-group">
										<label>Email</label>
										<input type="text" id="loginpopup_email1" name="email" placeholder="Email *" class="form-control">
										<p class="error">{{ $errors->first('email') }}</p>
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" id="loginopup_password1" name="password" placeholder="Password *" class="form-control">
										<p class="error">{{ $errors->first('password') }}</p>
									</div>
									<div class="form-group loign-adtnl forgot"> 
										<a data-toggle="modal" data-target="#single_forgot_popup" data-dismiss="modal">Help! I forgot my password.</a>
									</div>
									<div class="form-group">
										<div class="login-btn">
											<button class="btn btn-primary">Log In</button>
										</div>
									</div>
								</form>                  
							</div>
							<div class="form-group or text-center">
								<p>Or</p>
							</div>
							<div class="social-login">
								<div class="form-group socil-btn">
									<a class="btn btn-primary social-login-btn social-facebook" href="{{ route('social.login', ['facebook']) }}"><i class="fa fa-facebook" aria-hidden="true"></i> Log In with Facebook</a>
								</div>
							</div>
							<div class="form-group agn_regstr">
								<p>Don't have an account with us? <span><a data-toggle="modal" data-target="#single_signup_popup" data-dismiss="modal">Register!</a></span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
=======
				<div class=" modal-header indi_close_icons">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="login-register" id="loginModal">
			
				<div id="myTabContent" class="tab-content">
			
					<div class="tab-pane active in" id="login_tab1">
						<h2>Sign In To Your Account</h2>
						<form class="" action="{{route('login.post')}}" method="POST" id="loginpopup">   
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="costume_id" value="@if(!empty($data[0]->costume_id)){{$data[0]->costume_id}}@endif">
							<input type="hidden" name="is_cart" value="@if(!empty($data['basic'])){{count($data['basic'])}}@endif">
						
							<div class="form-group">
							<label>Email or Username</label>
								<input type="text" id="loginpopup_email" name="email" placeholder="Email *" class="form-control">
								<p class="error">{{ $errors->first('email') }}</p>
							</div>
							<div class="form-group">
							<label>Password</label>
								<input type="password" id="loginopup_password" name="password" placeholder="Password *" class="form-control">
								<p class="error">{{ $errors->first('password') }}</p>
							</div>
							<div class=" form-group loign-adtnl forgot mbl-frgt_sign"> 
								<label><a href="#forget_password1" data-toggle="tab">Help! I forgot my password</a></label>
							</div>
							<div class="form-group">
								<div class="login-btn">
									<button class="btn btn-primary">Log In</button>
								</div>
							</div>
							
							
					</form>                  
					</div>
           
                    <div class="form-group or text-center">
								<p>Or</p>
				</div>
				<div class="social-login">
					<div class="form-group socil-btn">
						<a class="btn btn-primary social-login-btn social-facebook" href="{{ route('social.login', ['facebook']) }}"><i class="fa fa-facebook" aria-hidden="true"></i> Log In with Facebook</a>
					</div>
				</div>
				<div class="form-group agn_regstr">
								<p>Don't have an account with us? <span><a data-toggle="modal" data-target="#single_signup_popup" data-dismiss="modal">Register!</a></span></p>
							</div>
				</div>
				
			</div>
		</div>
	</div>
		</div>
	</div>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
</div>
<div class="modal fade window-popup" id="login_popup_fav" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
<<<<<<< HEAD
			<div class=" modal-header indi_close_icons">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="login-register" id="loginModal">
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active in" id="login_tab1">
								<h2>Sign In To Your Account</h2>
								<form class="" action="{{route('login.post')}}" method="POST" id="loginpopup">   
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="form-group">
										<label>Email</label>
										<input type="text" id="loginpopup_email" name="email" placeholder="Email *" class="form-control">
										<p class="error">{{ $errors->first('email') }}</p>
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" id="loginopup_password" name="password" placeholder="Password *" class="form-control">
										<p class="error">{{ $errors->first('password') }}</p>
									</div>
									<div class="form-group">
										<div class="login-btn">
											<button class="btn btn-primary">Log In</button>
										</div>
									</div>
								</form>                  
							</div>
							<div class="form-group or text-center">
								<p>Or</p>
							</div>
							<div class="social-login">
								<div class="form-group socil-btn">
									<a class="btn btn-primary social-login-btn social-facebook" href="{{ route('social.login', ['facebook']) }}"><i class="fa fa-facebook" aria-hidden="true"></i> Log In with Facebook</a>
								</div>
							</div>
							<div class="form-group agn_regstr">
								<p>Don't have an account with us? <span><a data-toggle="modal" data-target="#single_signup_popup" data-dismiss="modal">Register!</a></span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade window-popup" id="single_forgot_popup" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class=" modal-header indi_close_icons">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active in" id="login_tab1">
							<h2>Forgot Password</h2>
							<form class="" action="{{route('forgotpassword.post')}}" method="POST" id="single_forgetpopup_password">   
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<input type="text" id="sing_forgotpop_email" name="email" placeholder="Email" class="form-control">
									<p class="error">{{ $errors->first('email') }}</p>
								</div>
								<div class="form-group">
									<div class="text-center rect_pswrd">
										<button class="btn btn-primary">Reset Password</button>
									</div>
								</div>
							</form>   
						</div>
					</div>
				</div>
			</div>
=======
				<div class=" modal-header indi_close_icons">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="login-register" id="loginModal">
			
				<div id="myTabContent" class="tab-content">
			
					<div class="tab-pane active in" id="login_tab1">
						<h2>Sign In To Your Account</h2>
						<form class="" action="{{route('login.post')}}" method="POST" id="loginpopup">   
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
							<label>Email or Username</label>
								<input type="text" id="loginpopup_email" name="email" placeholder="Email *" class="form-control">
								<p class="error">{{ $errors->first('email') }}</p>
							</div>
							<div class="form-group">
							<label>Password</label>
								<input type="password" id="loginopup_password" name="password" placeholder="Password *" class="form-control">
								<p class="error">{{ $errors->first('password') }}</p>
							</div>
							<div class=" form-group loign-adtnl forgot mbl-frgt_sign"> 
								<label><a href="#forget_password1" data-toggle="tab">Help! I forgot my password</a></label>
							</div>
							<div class="form-group">
								<div class="login-btn">
									<button class="btn btn-primary">Log In</button>
								</div>
							</div>
							
							
					</form>                  
					</div>
           
                    <div class="form-group or text-center">
								<p>Or</p>
				</div>
				<div class="social-login">
					<div class="form-group socil-btn">
						<a class="btn btn-primary social-login-btn social-facebook" href="{{ route('social.login', ['facebook']) }}"><i class="fa fa-facebook" aria-hidden="true"></i> Log In with Facebook</a>
					</div>
				</div>
				<div class="form-group agn_regstr">
								<p>Don't have an account with us? <span><a data-toggle="modal" data-target="#single_signup_popup" data-dismiss="modal">Register!</a></span></p>
							</div>
				</div>
				
			</div>
		</div>
	</div>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
		</div>
	</div>
</div>

<<<<<<< HEAD
	<!--coming-soon modal start here-->
<div id="coming_soon" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
	  
        <h2>Coming Soon...</h2>
      </div>
    </div>

  </div>
</div>
<!--coming-soon modal End here-->

<div class="modal fade window-popup" id="single_signup_popup" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class=" modal-header indi_close_icons">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="login-register" id="loginModal">
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active in" id="login_tab1">
								<h2>Register Your Account</h2>
								<form role="form" action="{{route('register')}}" method="POST" id="signup_pop1">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="form-group">
										<div class="form-group">
											<label>Username</label>
											<input type="text" id="pop_username" name="username"  class="form-control">
										</div>
										<div class="form-group">
											<label>First Name</label>
											<input type="text" name="first_name" id="first_name" class="form-control " >
										</div>
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" name="last_name" id="last_name" class="form-control " >
										</div>
										<div class="form-group">
											<label>Email</label>
											<input type="text" id="email" name="email"  class="form-control">
										</div>
										<div class="row sinup-pswrd"> 
											<div class="col-md-12 col-sm-12 col-xs-12 "> 
												<div class="form-group">
													<label>Password</label>
													<input type="password" id="password1" name="password" class="form-control">
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 "> 
												<div class="form-group">
													<label>Confirm Password</label>
													<input type="password" id="cpassword1"  name="cpassword"  class="form-control">
												</div>
											</div>
										</div> 
										<div class="row"> 
											<div class="col-md-12 col-sm-12 col-xs-12 "> 
												<div class="form-group">
													<div class="text-center creat_btn">
														<button class="btn btn-primary">Create Account!</button>
													</div>
												</div>
											</div>
										</div>
									</form>   
								</div>
								<div class="form-group or text-center">
									<p>Or</p>
								</div>
								<div class="social-login">
									<div class="form-group socil-btn">
										<a class="btn btn-primary social-login-btn social-facebook" href="{{ route('social.login', ['facebook']) }}"><i class="fa fa-facebook" aria-hidden="true"></i> Log In with Facebook</a>
									</div>
								</div>
								<div class="form-group agn_regstr">
									<div class="text-center close_icon">
								<button type="button" class="close" data-dismiss="modal"><span>×</span> Close</button>
							</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<script type="text/javascript">
		
	</script>	
=======
<div class="modal fade window-popup" id="single_signup_popup" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class=" modal-header indi_close_icons">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="login-register" id="loginModal">
			
				<div id="myTabContent" class="tab-content">
			
					<div class="tab-pane active in" id="login_tab1">
					<h2>Register Your Account</h2>
						<form role="form" action="{{route('register')}}" method="POST" id="signup_pop1">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
						<label>First Name</label>
			                <input type="text" name="first_name" id="first_name" class="form-control " >
						</div>
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" name="last_name" id="last_name" class="form-control " >
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" id="email" name="email"  class="form-control">
						</div>
						<div class="row sinup-pswrd"> 
							<div class="col-md-12 col-sm-12 col-xs-12 "> 
								<div class="form-group">
									<label>Password</label>
									<input type="password" id="password1" name="password" class="form-control">
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 "> 
								<div class="form-group">
								<label>Confirm Password</label>
									<input type="password" id="cpassword1"  name="cpassword"  class="form-control">
								</div>
							</div>
						</div> 
						<div class="row"> 
							<div class="col-md-12 col-sm-12 col-xs-12 "> 
								<div class="form-group">
									<div class="text-center creat_btn">
										<button class="btn btn-primary">Create Account!</button>
									</div>
								</div>
							</div>
						</div>
						
					</form>   
					</div>
           
                    <div class="form-group or text-center">
								<p>Or</p>
				</div>
				<div class="social-login">
					<div class="form-group socil-btn">
						<a class="btn btn-primary social-login-btn social-facebook" href="{{ route('social.login', ['facebook']) }}"><i class="fa fa-facebook" aria-hidden="true"></i> Log In with Facebook</a>
					</div>
				</div>
				<div class="form-group agn_regstr">
								<p><a data-toggle="modal" data-target="#login_popup" data-dismiss="modal">Login</a></p>
							</div>
				</div>
				
			</div>
		</div>
	</div>
		</div>
	</div>
</div>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

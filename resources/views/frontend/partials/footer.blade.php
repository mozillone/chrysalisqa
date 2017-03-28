 <section class="newsletter-container">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-12"><h3>SIGN UP FOR OUR NEWSLETTER</h3>
                <form id="register-newsletter">
                    <input type="text" name="newsletter" required="" placeholder="Enter your email address">
                        <input type="submit" class="btn btn-custom-3" value="Subscribe">
                </form>
				</div>
					<div class="col-md-4 col-sm-4 col-xs-12 social-media">
					<div class="row">
					<div class="col-md-4 social-fallow">
					<h3>FALLOW US</h3>
					</div>
					<div class="col-md-8 social-img">
					<div class="social-icons">
						<a href=""><img class="img-responsive" src="{{asset('/assets/frontend/img/fb-icon.png')}}"></a>
						<a href=""><img class="img-responsive" src="{{asset('/assets/frontend/img/twit-icon.png')}}"></a>
						<a href=""><img class="img-responsive" src="{{asset('/assets/frontend/img/insta-icon.png')}}"></a>
						<a href=""><img class="img-responsive" src="{{asset('/assets/frontend/img/youtube-icon.png')}}"></a>
					</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	 </section>
	 
	 	<section class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4 co-xs-12 ft-logo">
						<img class="img-responsive" src="{{asset('/img/brand.png')}}">
						<h3>OUR MISSION</h3>
						<P>Revolutionize the costume industry, by giving people access to more affordable, environmentally friendly costumes. More on our mission here.</P>
					</div>
					<div class="col-md-4 co-sm-4 co-xs-12 quick_links">
						<h3>QUICK LINKS</h3>
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
					<div class="col-md-4 co-sm-4 co-xs-12 app_img">
						<img class="img-responsive" src="{{asset('/assets/frontend/img/app-img.png')}}">
					</div>
				</div>
			</div>
		</section>
<section class="btm-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p>© 2016 CHRYSALIS. ALL RIGHTS RESERVED​​​​​​​ |  TERMS OF USE  |  PRIVACY POLICY</p>
			</div>
		</div>
	</div>
</section>
<div class="modal fade window-popup" id="signup_popup">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="row">
        <div class="col-md-12">
			<div class="login-register" id="loginModal">
				<ul class="nav nav-tabs">
                    <li class="active"><a href="#login_tab1" data-toggle="tab">Login</a></li>
                    <li><a href="#signup_tab1" data-toggle="tab">Signup</a></li>
                    <li class="hide"><a href="#forget_password1" data-toggle="tab">Reset Password</a></li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane active in" id="login_tab1">
						<form class="" action="{{route('login.post')}}" method="POST" id="loginpopup">   
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="plan_id" value="">
							<div class="form-group">
								<input type="text" id="loginpopup_email" name="email" placeholder="Email *" class="form-control">
								<p class="error">{{ $errors->first('email') }}</p>
							</div>
							<div class="form-group">
								<input type="password" id="loginopup_password" name="password" placeholder="Password *" class="form-control">
								<p class="error">{{ $errors->first('password') }}</p>
							</div>
							<div class="form-group">
								<div class="text-center">
									<button class="btn btn-primary">Log In</button>
								</div>
							</div>
							<div class="col-md-12 loign-adtnl"> 
								<label><a href="#forget_password1" data-toggle="tab">Forgot Password?</a></label>
							</div>
					</form>                  
					</div>
                    <div class="tab-pane fade" id="signup_tab1">
						<form role="form" action="{{route('register')}}" method="POST" id="signup_pop">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
			                <input type="text" name="first_name" id="pop_first_name" class="form-control " placeholder="First Name *">
						</div>
						<div class="form-group">
							<input type="text" name="last_name" id="pop_last_name" class="form-control " placeholder="Last Name *">
						</div>
						<div class="form-group">
							<input type="text" id="popup_email" name="email" placeholder="Email Address *" class="form-control">
						</div>
						<div class="row sinup-pswrd"> 
							<div class="col-md-6 "> 
								<div class="form-group">
									<input type="password" id="popup_password" name="password" placeholder="Create Password *" class="form-control">
								</div>
							</div>
							<div class="col-md-6"> 
								<div class="form-group">
									<input type="password" id="pop_cpassword"  name="cpassword" placeholder="Confirm Password *" class="form-control">
								</div>
							</div>
						</div> 
						<div class="row"> 
							<div class="col-md-12"> 
								<div class="form-group">
									<div class="text-center">
										<button class="btn btn-primary">Sign Up</button>
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
								<div class="text-center">
									<button class="btn btn-primary">Reset Password</button>
								</div>
							</div>
						</form>             
					</div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
								<p>Or</p>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<a class="btn btn-primary social-login-btn social-facebook" href="{{ route('social.login', ['facebook']) }}"><i class="fa fa-facebook" aria-hidden="true"></i> Continue with Facebook</a>
					</div>
				</div>
				</div>
				
			</div>
		</div>
	</div>
		</div>
	</div>
</div>

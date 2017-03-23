<div class="modal fade window-popup" id="signup_popup">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="row">
        <div class="col-md-12">
			<div class="login-register" id="loginModal">
				<ul class="nav nav-tabs">
                    <li class="active"><a href="#login_tab" data-toggle="tab">Login</a></li>
                    <li><a href="#signup_tab" data-toggle="tab" id="signup1_tab">Signup</a></li>
                    <li class="hide"><a href="#forget_password" data-toggle="tab">Reset Password</a></li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane active in" id="login_tab">
						<form  action="{{route('login.post')}}" method="POST" id="login">   
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<input type="text" id="login_email" name="email" placeholder="Email *" class="form-control">
								<p class="error">{{ $errors->first('email') }}</p>
							</div>
							<div class="form-group">
								<input type="password" id="login_password" name="password" placeholder="Password *" class="form-control">
								<p class="error">{{ $errors->first('password') }}</p>
							</div>
							<div class="form-group">
								<div class=" text-right">
									<a href="#forget_password" data-toggle="tab" >Reset Password</a>
								</div>
							</div>
							<div class="form-group">
								<div class="text-center">
									<button class="btn btn-primary">Log In</button>
								</div>
							</div>
						</form>                
					</div>
                    <div class="tab-pane fade" id="signup_tab">
						<form role="form" action="{{route('register')}}" method="POST" id="signup">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
        	    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                			<input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name *"  @if(!empty(Session::get('social_data'))) value="<?= explode(" ",Session::get('social_data')['name'])[0];?>" @endif>
			                			<p class="error">{{ $errors->first('first_name') }}</p>
									</div>
								</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name *" @if(!empty(Session::get('social_data'))) value="<?= explode(" ",Session::get('social_data')['name'])[1];?>" @endif>
			    						<p class="error">{{ $errors->first('last_name') }}</p>
									</div>
								</div>
							</div>
			    			<div class="form-group">
			    				<input type="text" name="email" id="signup_email" class="form-control input-sm" placeholder="Email *" @if(!empty(Session::get('social_data'))) value="{{Session::get('social_data')['email']}}" @endif>
	    						<p class="error">{{ $errors->first('email') }}</p>
							</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
										<input type="password" name="password" id="signup_password" class="form-control input-sm" placeholder="Create Password *">
										<p class="error">{{ $errors->first('password') }}</p>
									</div>
								</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password"  id="cpassword" name="cpassword" class="form-control input-sm" placeholder="Confirm Password *">
									</div>
								</div>
							</div>
							<div class="form-group">
	                            <div class="text-center">
									<button class="btn btn-primary">Sign Up</button>
								</div>
							</div>
						</form>
					</div>
                    
				</div>
			</div>
		</div>
	</div>
		</div>
	</div>
</div>

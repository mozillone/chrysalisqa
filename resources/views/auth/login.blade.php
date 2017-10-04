	@extends('/frontend/app')
	@section('title')
		Login
	    @parent
	@stop

	@section('styles')
	@endsection
	@section('content')
	<div class="container">
		<div class="row">
	        <div class="col-md-12">
				<div class="login-register-main" id="loginModal">
					<ul class="nav nav-tabs">
	                    <li class="active"><a href="#login_tab" data-toggle="tab">Sign In</a></li>
	                    <li><a href="#signup_tab" data-toggle="tab" id="signup1_tab">Register</a></li>
	                    <li class="hide"><a href="#forget_password" data-toggle="tab">Reset Password</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="login-social">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<a class="btn btn-primary social-login-btn social-facebook" href="{{ route('social.login', ['facebook']) }}"><i class="fa fa-facebook" aria-hidden="true"></i> Log In With Facebook</a>
								</div>


		<div class="clearfix">
		</div>
							<div class="form-group or text-center">
									<p>Or</p>
								</div>

								<div class="col-md-12 col-sm-12 col-xs-12 text-center cnt_with">
									<p>Connect With Email</p>
								</div>
								</div>
						</div>
	                    <div class="tab-pane active in" id="login_tab">
							@if (Session::has('error'))
				            <div class="alert alert-danger alert-dismissable">
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
								{{ Session::get('error') }}
							</div>
				            @elseif(Session::has('success'))
							<div class="alert alert-success alert-dismissable">
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
								{{ Session::get('success') }}
							</div>
							@endif
							<form  action="{{route('login.post')}}" method="POST" id="login">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
								<label>Email</label>
									<input type="text" id="login_email" name="email"  class="form-control">
<<<<<<< HEAD
									<p class="error" style="color :red;">{{ $errors->first('email') }}</p>
=======
									<p class="error">{{ $errors->first('email') }}</p>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" id="login_password" name="password"  class="form-control">
<<<<<<< HEAD
									<p class="error" style="color :red;">{{ $errors->first('password') }}</p>
=======
									<p class="error">{{ $errors->first('password') }}</p>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
								</div>
								<div class="form-group">
									<div class=" text-right rect_pswrd">
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
<<<<<<< HEAD
				    				<div class="col-xs-12 col-sm-12 col-md-12">
				    					<div class="form-group">
				    					<label>Username </label>
				                			<input type="text" name="username" id="username" class="form-control input-sm">
				                			<p class="error">{{ $errors->first('username') }}</p>
										</div>
									</div>
								</div>
								<div class="row">
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				    					<label>First Name </label>
				                			<input type="text" name="first_name" id="first_name" class="form-control input-sm"   @if(!empty(Session::get('social_data'))) value="<?=explode(" ", Session::get('social_data')['name'])[0];?>" @endif>
				                			<p class="error">{{ $errors->first('first_name') }}</p>
										</div>
									</div>
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				    					<label>Last Name </label>
				    						<input type="text" name="last_name" id="last_name" class="form-control input-sm"  @if(!empty(Session::get('social_data'))) value="<?=explode(" ", Session::get('social_data')['name'])[1];?>" @endif>
				    						<p class="error">{{ $errors->first('last_name') }}</p>
										</div>
									</div>
								</div>
				    			<div class="form-group">
				    			<label>Email </label>
				    				<input type="text" name="email" id="signup_email" class="form-control input-sm" @if(!empty(Session::get('social_data'))) value="{{Session::get('social_data')['email']}}" @endif>
		    						<p class="error">{{ $errors->first('email') }}</p>
								</div>
				    			<div class="row">
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				    					<label>Create Password </label>
<<<<<<< HEAD
											<input type="password" name="password" id="signup_password" class="form-control input-sm">
=======
											<input type="password" name="password" id="signup_password" class="form-control input-sm" placeholder=" *">
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
											<p class="error">{{ $errors->first('password') }}</p>
										</div>
									</div>
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				    						<label>Confirm Password </label>
				    						<input type="password"  id="cpassword" name="cpassword" class="form-control input-sm">
										</div>
									</div>
								</div>
								<div class="form-group">
		                            <div class="text-center">
										<button class="btn btn-primary">Create Account!</button>
									</div>
								</div>
							</form>
						</div>
	                    <div class="tab-pane fade" id="forget_password">
							@if (Session::has('error'))
				            <div class="alert alert-danger alert-dismissable">
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
								{{ Session::get('error') }}
							</div>
				            @elseif(Session::has('success'))
							<div class="alert alert-success alert-dismissable">
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
								{{ Session::get('success') }}
							</div>
							@endif
							<form class="" action="{{route('forgotpassword.post')}}" method="POST" id="forgotpassword">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<input type="text" id="forgot_email" name="email" placeholder="Email" class="form-control">
									<p class="error">{{ $errors->first('email') }}</p>
								</div>
								<div class="form-group">
									<div class="text-center reset_psrd">
										<button class="btn btn-primary">Reset Password</button>
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
	@endsection
	{{-- page level scripts --}}
	@section('footer_scripts')
	<script src="{{asset('/assets/frontend/js/pages/login.js')}}"></script>
	@stop
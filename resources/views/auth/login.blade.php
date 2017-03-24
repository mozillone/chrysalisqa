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
			<div class="login-register" id="loginModal">
				<ul class="nav nav-tabs">
                    <li class="active"><a href="#login_tab" data-toggle="tab">Login</a></li>
                    <li><a href="#signup_tab" data-toggle="tab" id="signup1_tab">Signup</a></li>
                    <li class="hide"><a href="#forget_password" data-toggle="tab">Reset Password</a></li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div class="login-social">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<a class="btn btn-primary social-login-btn social-facebook" href="{{ route('social.login', ['facebook']) }}"><i class="fa fa-facebook" aria-hidden="true"></i> Continue with Facebook</a>
							</div>
						</div>
						<div class="row divider-div">
							<div class="col-md-5 col-sm-5 col-xs-5">
								<p class="divider"></p>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-2">
								<p>Or</p>
							</div>
							<div class="col-md-5 col-sm-5 col-xs-5">
								<p class="divider"></p>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<p>CONNECT WITH EMAIL</p>
							</div>
						</div>
					</div>
                    <div class="tab-pane active in" id="login_tab">
						@if (Session::has('error'))
			            <div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							{{ Session::get('error') }}
						</div>
			            @elseif(Session::has('success'))
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							{{ Session::get('success') }}
						</div>
						@endif
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
                    <div class="tab-pane fade" id="forget_password">
						@if (Session::has('error'))
			            <div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							{{ Session::get('error') }}
						</div>
			            @elseif(Session::has('success'))
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
								<div class="text-center">
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
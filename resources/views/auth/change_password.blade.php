@extends('app')

@section('styles')

	<style type="text/css">
		
	</style>

@endsection
@section('content')
	<div class="container">
	<div class="row">
        <div class="col-md-12">
           <div class="login-register" id="loginModal">
                  <div id="myTabContent" class="tab-content">
				    <div>
                  	 <h1 class="chng_ps">Change Password</h1>
                      <form  action="{{route('forgotpassword.change')}}" method="POST" id="changePassword_form">   
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="user_id" value="{{ $id}}" >
        	    	   <div class="form-group">
                        		<input type="password" id="password" name="password" placeholder="Password" class="form-control">
                              <p class="error">{{ $errors->first('password') }}</p>
			    	   </div>
                       <div class="form-group">
                              <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" class="form-control">
                	   </div>
                      	<div class="form-group">
                            <div class="text-center">
                              <button class="btn btn-primary">Submit</button>
                            </div>
                       </div>
                      </form>                
                    </div>
           </div>
                     
        </div>
	</div>
</div>
</div>
@endsection
{{-- page level scripts --}}
@section('footer_scripts')
	<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
	<script src="{{asset('assets/js/pages/change_password.js')}}"></script>
@stop
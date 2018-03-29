@extends('/frontend/app')

@section('styles')

	<style type="text/css">
		.change_passwords {
    width: 500px;
    margin: 40px auto;
}
.change_passwords h1 {
    font-size: 22px;
    font-family: Proxima-Nova-Extrabold;
    border: none;
    color: #000;    text-align: center;    margin-bottom: 30px;
}
.change_passwords button {
    height: 45px;
    background: #60c5ac;
    width: 100%;
    border: 1px solid #60c5ac;
    font-size: 20px;
    font-family: Proxima-Nova-Extrabold;
}
	</style>

@endsection
@section('content')
	<div class="container">
	<div class="row">
        <div class="col-md-12">
           <div class="change_passwords" id="loginModal">
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
                            <div class="text-center chnge-subt-btn">
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
	<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
	<script src="{{asset('/assets/frontend/js/pages/change_password.js')}}"></script>
@stop
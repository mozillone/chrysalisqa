@extends('/frontend/app')
@section('styles')
   <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
 @endsection
@section('content')

<?php 
if (isset($total_data) && !empty($total_data)) {
 	$all_details = $total_data;
 }else{
 	$all_details = "";
 } 

/* echo "<pre>";
 print_r($all_details['get_details']);
 die;*/

 ?>

<form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="request_a_bag_form" id="request_a_bag_form" method="post">
<section class="request_bag_page">
<div class="container" id="process_bar_hide">
    <div class="row">
        <div class= "col-md-12">
            <div class="progressbar_main request-bag">
                <h2>REQUEST A BAG</h2><i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </div>
        </div>
        <div class="col-md-12 request-icon-sec">
         <h4>Join millions of people across America who are cleaning out their closets right now!</h4>
            <div class="row">
                <div class="col-md-4 col-sm-4 request-bag-steps">
                   <img class="step1-img" src="{{URL::asset('assets/frontend/img/step-1-bag.png')}}">
                    <span class="mbl-step1-header hidden-md hidden-sm hidden-lg">
                        <span class="step-header">Step 1</span> <br>
                            Fill Your Bag
                    </span>
                </div>
                <div class="col-md-4 col-sm-4 request-bag-steps">
                    <img class="step2-img" src="{{URL::asset('assets/frontend/img/Step-2-bag.png')}}">
                     <span class="mbl-step2-header hidden-md hidden-sm hidden-lg">
                         <span class="step-header">Step 1</span> <br>
                            Fill Your Bag
                     </span>
                </div>
                <div class="col-md-4 col-sm-4 request-bag-steps">
                    <img class="step3-img" src="{{URL::asset('assets/frontend/img/Step-3-piggy.png')}}">
                    <span class="mbl-step3-header hidden-md hidden-sm hidden-lg">
                        <span class="step-header">Step 1</span> <br>
                            Fill Your Bag
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="request-progress-bar">

                <ul id="progressbar" class="progressbar_rm hidden-xs">
                	 <li class="active" id="step1">

                	    <span class="s-head">Step 1</span>
                	    <span class="request-steps">Fill Your Bag</span></li>
                	 <li class="active" id="step2">

                         <span class="s-head">Step 2</span>
                         <span class="request-steps">Send It In</span></li>
                     <li class="active" id="step3">

                         <span class="s-head">Step 3</span>
                         <span class="request-steps">Earn Some Cash <br> or Donate to Charity</span></li>
                     </ul>
            </div>
        </div>
    </div>
</div>

<div class="container" id="h4_tag_hide" >
    <div class="row option-sec">
        <div class="col-md-10 col-md-offset-1">
        <h4>Choose an option of how you would like to receive your Bag and payout.</h4>
             <div id="choose_an_option_for_bag_div">
                					<p class="cst2-rms-chck"><input type="checkbox" name="is_payout" id="is_payout" value="0">Don't send me a payout. I want to support Chrysalis' waste reduction and charitable donation program.</p>
                					<p class="notes">*Note: At this time, Chrysalis does NOT issue tax receipts. </p>
                					<p class="cst2-rms-chck"><input type="checkbox" checked name="is_payout" value="1" id="is_payout">I want to pay a $9.99 Shipping & Handling fee to receive my bag (fee deducted after bag has been processed).</p>
                					<span id="is_payout_error" style="color:red"></span>
                					<div class="form-rms-btn">
                						<a type="button" id="choose_an_option_for_bag_next" class="btn-rm-nxt nxt">
                						Next</a>
                					</div>
                					<div class="text-center">
                						<h3>Costume too big for a bag?</h>
                						<p><a href="{{URL::to('costume/createtwo')}}"> Sell it Yourself! </a></p>
                					</div>
                			</div>
        </div>
    </div>

</div>

<div class="container" id="average_payouts_div">
	<div class="row average-payout-sec">
        <div class= "col-md-12">
            <div class="progressbar_main request-bag">
                <h2>REQUEST A BAG</h2><i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </div>
        </div>
        <h4>Average Payouts</h4>
        <div class="col-md-8 col-md-offset-2">

                 <div class="costumes-label">
                                <span>AVERAGE COSTUMES</span>
                                <span><i class="fa fa-usd" aria-hidden="true"></i> 2.00 - 5.00</span>
                 </div>
                <div class="row costumes">
                    <div class="costumes-desktop">
                        <div class="col-md-4 col-sm-4">
                            <img  src="{{URL::asset('assets/frontend/img/Item-2.1.png')}}">
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <img  src="{{URL::asset('assets/frontend/img/Item2.2.png')}}">
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <img  src="{{URL::asset('assets/frontend/img/Item-2.png')}}">
                        </div>
                    </div>
                 </div>

             <div id="myCarousel" class="carousel costumes-carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                  <div class="item active">
                    <img  src="{{URL::asset('assets/frontend/img/Item-2.1.png')}}">
                  </div>

                  <div class="item">
                    <img  src="{{URL::asset('assets/frontend/img/Item2.2.png')}}">
                  </div>

                  <div class="item">
                    <img  src="{{URL::asset('assets/frontend/img/Item-2.png')}}">
                  </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>


        </div>
        <div class="col-md-8 col-md-offset-2">


            <div class="costumes-label">
                <span>MEDIUM QUALITY / HOMEMADE</span>
                <span><i class="fa fa-usd" aria-hidden="true"></i> 2.00 - 5.00</span>
            </div>
            <div class="row costumes">
                <div class="costumes-desktop">
                    <div class="col-md-4 col-sm-4">
                        <img  src="{{URL::asset('assets/frontend/img/Item-3.png')}}">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <img  src="{{URL::asset('assets/frontend/img/Item-2.png')}}">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <img  src="{{URL::asset('assets/frontend/img/Item-3.1.png')}}">
                    </div>
                </div>
            </div>
            <div id="myCarousel1" class="carousel costumes-carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                              <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
                              <li data-target="#myCarousel1" data-slide-to="1"></li>
                              <li data-target="#myCarousel1" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                              <div class="item active">
                                <img  src="{{URL::asset('assets/frontend/img/Item-2.1.png')}}">
                              </div>

                              <div class="item">
                                <img  src="{{URL::asset('assets/frontend/img/Item2.2.png')}}">
                              </div>

                              <div class="item">
                                <img  src="{{URL::asset('assets/frontend/img/Item-2.png')}}">
                              </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel1" data-slide="prev">
                              <span class="glyphicon glyphicon-chevron-left"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel1" data-slide="next">
                              <span class="glyphicon glyphicon-chevron-right"></span>
                              <span class="sr-only">Next</span>
                            </a>
          </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="costumes-desktop">

                <div class="costumes-label">
                    <span class="film-sec"><img  src="{{URL::asset('assets/frontend/img/film.png')}}">FILM QUALITY</span>
                    <span class="film-sec-price"><i class="fa fa-usd" aria-hidden="true"></i> 2.00 - 5.00</span>
                </div>
                <div class="row costumes">
                    <div class="col-md-4 col-sm-4">
                        <img  src="{{URL::asset('assets/frontend/img/Item-3.png')}}">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <img  src="{{URL::asset('assets/frontend/img/Item-2.png')}}">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <img  src="{{URL::asset('assets/frontend/img/Item-3.1.png')}}">
                    </div>
                </div>
            </div>
        </div>
	</div>
    <div>

        <div class="form-rms-btn average-payout-sec-next">
            <a type="button" id="average_payouts_next" class="btn-rm-nxt nxt">Next</a>
        </div>
    </div>
</div>
<div id="send_my_bag_div" style="display: none;">
	<div class="container">
	<div class="row">
	    <div class= "col-md-12">
            <div class="progressbar_main request-bag">
                <h2>REQUEST A BAG</h2><i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </div>
        </div>
        <div class="request-address-sec">

					<div class="col-md-6">
                       <!--  <form> -->
                            <h4>Send My Bag To...</h4>
                            <div class="form-rms">
                                <p class="form-rms-que">Full Name</p>
                                <p class="form-rms-input"><input type="text" name="full_name" id="full_name" value="<?php if (isset($all_details['get_details']->display_name) && !empty($all_details['get_details']->display_name)) { echo $all_details['get_details']->display_name; } ?>" tab-index="1" ></p>
                                <span id="fullname_error" style="color:red"></span>

                            </div>
                            <div class="form-rms">
                                <p class="form-rms-que">Address 1</p>
                                <p class="form-rms-input"><input type="text" name="address1" id="address1" value="<?php if (isset($all_details['basic_address']->address1) && !empty($all_details['basic_address']->address1)) { echo $all_details['basic_address']->address1; } ?>" tab-index="1" ></p>
                                <span id="address1_error" style="color:red"></span>

                            </div>
                            <div class="form-rms">
                                <p class="form-rms-que">Address 2 (Optional)</p>
                                <p class="form-rms-input"><input type="text" value="<?php if (isset($all_details['basic_address']->address2) && !empty($all_details['basic_address']->address2)) { echo $all_details['basic_address']->address2; } ?>" name="address2" id="address2"  tab-index="1" ></p>

                            </div>
                            <div class="form-rms">
                                <p class="form-rms-que">City</p>
                                <p class="form-rms-input"><input type="text" name="city" id="city" value="<?php if (isset($all_details['basic_address']->city) && !empty($all_details['basic_address']->city)) { echo $all_details['basic_address']->city; } ?>" tab-index="1" ></p>
                                <span id="city_error" style="color:red"></span>

                            </div>
                            <div class="form-rms form-align">
								
									<p class="form-rms-que">State</p>
									<p class="form-rms-input">
									<?php if (isset($all_details['basic_address']->state) && !empty($all_details['basic_address']->state)) {
                                	$db_state = $all_details['basic_address']->state;
									} ?>
										<select name="state" id="state">
											<option value="">Select s State</option>
												@foreach($all_details['state_table'] as $state)
											<option <?php if (!empty($db_state) == $state->abbrev): ?>
												selected="selected"
											<?php endif ?> value="{{$state->abbrev}}">{{$state->name}}</option>
												@endforeach
										</select>
									</p>
									<span id="state_error" style="color:red"></span>
								
							
                                

                                <p class="form-rms-que">Zip Code</p>
                                <p class="form-rms-input"><input type="text" name="zipcode" id="zipcode" value="<?php if (isset($all_details['basic_address']->zip_code) && !empty($all_details['basic_address']->zip_code)) { echo $all_details['basic_address']->zip_code; } ?>" tab-index="1" ></p>
                                <span id="zipcode_error" style="color:red"></span>

                            </div>
                            <div class="form-rms">
                                <p class="form-rms-que">Phone Number</p>
                                <p class="form-rms-input"><input type="text" name="phone_number" id="phone_number" value="<?php if (isset($all_details['get_details']->phone_number) && !empty($all_details['get_details']->phone_number)) { echo $all_details['get_details']->phone_number; } ?>" tab-index="1" ></p>
                                <span id="phone_number_error" style="color:red"></span>

                            </div>
                        <!-- </form> -->
						<div class="condition-option">
                            <p><input class="condition-check" type="checkbox" name="quality_standards" value="">All items meet our Quality Standards
                            <span id="quality_standards_error" style="color:red; display: block;"></span>
                            </p>
                            <p><input type="checkbox" name="reject_terms" checked value="">I agree with Chrysalis' Reject Terms
							<span id="reject_terms_error" style="color:red; display: block;"></span>
                            </p>
						</div>
					</div>
					<div class="col-md-6">
						<h4>What would you like to do with unaccepted items?</h4>
						<div class="unaccepted-option">
                            <p class="cst2-rms-chck"><input type="checkbox" name="is_return" value="1">Please opt me into Return Assurance and return my unaccepted items for an additional $9.99* (I understand that up to $19.98 could be deduted from mybag earnings). </p>
                            <p class="cst2-rms-chck">*Fee will be deduted from your earnings once your bag is processed.</p>
                            <p class="cst2-rms-chck"><input type="checkbox" checked name="is_recycle" value="1">Please responsibly recycle my unaccepted items</p>
						</div>
						<h4>Have you registerd yet? Add your email!</h4>
                        <!-- <form> -->
                            <div class="form-rms" style="margin-bottom: 18px">
                                <p class="form-rms-que">Email Address</p>
                                <p class="form-rms-input"><input type="text" name="email_address" id="email_address" value="<?php if (isset($all_details['get_details']->email) && !empty($all_details['get_details']->email)) { echo $all_details['get_details']->email; } ?>" <?php if (isset($all_details['get_details']->email) && !empty($all_details['get_details']->email)) {  ?> readonly <?php } ?> tab-index="1" ></p>
                                <span id="email_address_error" style="color:red"></span>
                        <!-- </form> -->

                    </div>
                    <div class="form-rms-btn">
                        <a type="button" id="send_my_bag_next" class="btn-rm-nxt nxt">Next</a>
                    </div>
					</div>
        </div>
				

		</div>
    </div>
</div><!-- send_my_bag_div -->
</form>
<div id="your_bag_on_itsway" style="display: none;">
	<div class="container">
		<div class="row">
		     <div class= "col-md-12">
                <div class="progressbar_main request-bag">
                    <h2>REQUEST A BAG</h2><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </div>
            </div>
            <div class="col-md-12 request-success">
                <img src="{{URL::asset('assets/frontend/img/bag-sucess.png')}}">
                <h4>Hand in There!</h4>
                <p>Your bag is on it's way</p>
                <a type="button" id="average_payouts_next" class="btn-rm-nxt nxt">Browse Costumes</a>
			</div>
		</div>
	</div>
</div>


<div class="modal fade window-popup in" id="request_bag_signup_popup" tabindex="-1">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="login-register" id="loginModal">
				<ul class="nav nav-tabs">
                    <li class="active"><a href="#login_tab1" data-toggle="tab" class="first_active">Sign In</a></li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane active in" id="login_tab1">
						<form class=""  method="POST" id="loginpopup">   
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="plan_id" value="">
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
									<button class="btn btn-primary" id="request_a_bag_login">Log In</button>
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
</div>
	</section>
		@stop
{{-- page level scripts --}}
@section('footer_scripts')
<!-- <script type="text/javascript">
$(document).ready(function()
{
	$('#choose_an_option_for_bag_div').css('display','block');
	$('#average_payouts_div').css('display','none');
	$('#send_my_bag_div').css('display','none');
	$('#your_bag_on_itsway').css('display','none');
	$('#total_content_div').css('display','none');

	$('#choose_an_option_for_bag_next').click(function(){
		$('#process_bar_hide').css('display','none');
		$('#h4_tag_hide').remove();
		$('#choose_an_option_for_bag_div').css('display','none');
		$('#average_payouts_div').css('display','block');
		$('#send_my_bag_div').css('display','none');
		$('#your_bag_on_itsway').css('display','none');
	});

	$('#average_payouts_next').click(function(){
		$('#process_bar_hide').css('display','none');
		$('#h4_tag_hide').remove();
		$('#choose_an_option_for_bag_div').css('display','none');
		$('#average_payouts_div').css('display','none');
		$('#send_my_bag_div').css('display','block');
		$('#your_bag_on_itsway').css('display','none');		
	});
	$('#send_my_bag_next').click(function(){
		$('#process_bar_hide').css('display','none');
		$('#h4_tag_hide').remove();
		$('#choose_an_option_for_bag_div').css('display','none');
		$('#average_payouts_div').css('display','none');
		$('#send_my_bag_div').css('display','none');
		$('#your_bag_on_itsway').css('display','block');
	});
});
</script> -->
<script type="text/javascript">
$(document).ready(function()
{
	$('#choose_an_option_for_bag_div').css('display','block');
	$('#average_payouts_div').css('display','none');
	$('#send_my_bag_div').css('display','none');
	$('#your_bag_on_itsway').css('display','none');

	$('#choose_an_option_for_bag_next').click(function(a){
		a.preventDefault();
		str=true;
		$('#is_payout_error').html('');
		if($('input[name=is_payout]:checked').length<=0){
			$('#is_payout_error').html('This field is required.');
			str=false;			
		}		
		if (str == true) {
			$('#choose_an_option_for_bag_div').css('display','none');
			$('#process_bar_hide').css('display','none');
			$('#h4_tag_hide').css('display','none');
			$('#average_payouts_div').css('display','block');
			$('#send_my_bag_div').css('display','none');
			$('#your_bag_on_itsway').css('display','none');			 	
		}
		return str;
		
	});

	$('#average_payouts_next').click(function(){
		$('#choose_an_option_for_bag_div').css('display','none');
		$('#process_bar_hide').css('display','none');
		$('#h4_tag_hide').css('display','none');
		$('#average_payouts_div').css('display','none');
		$('#send_my_bag_div').css('display','block');
		$('#your_bag_on_itsway').css('display','none');		
	});
	function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    };
	$('#send_my_bag_next').click(function(a){
		a.preventDefault();
		str=true;
		var full_name = $('#full_name').val();
		var address1  = $('#address1').val();
		var city      = $('#city').val();
		var state     = $('#state').val();
		var zipcode   = $('#zipcode').val();
		var phone_number = $('#phone_number').val();
		var email_address = $('#email_address').val();
		$('#full_name,#address1,#city,#state,#zipcode,#phone_number,#email_address').css('border','');
		$('#fullname_error,#address1_error,#city_error,#state_error,#zipcode_error,#phone_number_error,#quality_standards_error,#reject_terms_error,#email_address_error,#is_return_error,#is_recycle_error').html('');
		if(full_name == ""){
			$('#full_name').css('border','1px solid red');
			$('#fullname_error').html('This field is required.');
			str=false;			
		}
		if(address1 == ""){
			$('#address1').css('border','1px solid red');
			$('#address1_error').html('This field is required.');
			str=false;			
		}
		if (city == "") {
			$('#city').css('border','1px solid red');
			$('#city_error').html('This field is required.');
			str=false;
		}
		if (state == "") {
			$('#state').css('border','1px solid red');
			$('#state_error').html('This field is required.');
			str=false;
		}
		if (zipcode == "") {
			$('#zipcode').css('border','1px solid red');
			$('#zipcode_error').html('This field is required.');
			str=false;
		}
		if (phone_number == "") {
			$('#phone_number').css('border','1px solid red');
			$('#phone_number_error').html('This field is required.');
			str=false;
		}
		if($('input[name=quality_standards]:checked').length<=0){
			$('#quality_standards_error').html('This field is required.');
			str=false;			
		}
		if($('input[name=reject_terms]:checked').length<=0){
			$('#reject_terms_error').html('This field is required.');
			str=false;			
		}
		/*if($('input[name=is_return]:checked').length<=0){
			$('#is_return_error').html('This field is required.');
			str=false;			
		}
		if($('input[name=is_recycle]:checked').length<=0){
			$('#is_recycle_error').html('This field is required.');
			str=false;			
		}*/

		if(!ValidateEmail(email_address)) { 
			$('#email_address').css('border','1px solid red');
			$('#email_address_error').html('Please enter valid email address.');
			str=false;
		 }
		if (email_address == "" ) {
			$('#email_address').css('border','1px solid red');
			$('#email_address_error').html('This field is required.');
			str=false;
		}
		if (str == true) {
			$('#send_my_bag_next').html("Submitting");
			$('#send_my_bag_next').append('<img id="ajax_loader" src="{{asset("img/ajax-loader.gif")}}" >');
			$.ajax({
			 url: "{{URL::to('costume/postrequestabag')}}",
			 type: "POST",
			 data: new FormData($('#request_a_bag_form')[0]),
			 contentType:false,
			 cache: false,
			 processData: false,
			 success: function(data){
			 	if (data == "login") {
			 		$('#send_my_bag_next').append('<div class="modal-backdrop fade in"></div>');
			 		$('#request_bag_signup_popup').css('display','block');
			 	}
			 	else if(data == "register"){
			 		window.location.href = "{{URL::to('login#signup_tab')}}";
			 	}
			 	if (data == "success") {
			 		$('#ajax_loader').remove();
			 		$('#process_bar_hide').css('display','none');
			 		$('#h4_tag_hide').css('display','none');
			 		$('#choose_an_option_for_bag_div').css('display','none');
					$('#average_payouts_div').css('display','none');
					$('#send_my_bag_div').css('display','none');
					$('#your_bag_on_itsway').css('display','block');
			 	}
			 }
			});
						 	
		}
		return str;
		
	});

	$('#request_a_bag_login').click(function(){
		var loginpopup_email = $('#loginpopup_email').val();
		var loginopup_password = $('#loginopup_password').val();
		if (loginpopup_email != "" && loginopup_password !="") {
			$.ajax({
			 url: "{{URL::to('/postrequestabaglogin')}}",
			 type: "POST",
			 data: new FormData($('#loginpopup')[0]),
			 contentType:false,
			 cache: false,
			 processData: false,
			 success: function(data){
			 	if (data == "login_sucess") {
			 		$('#ajax_loader').remove();
			 		$('#send_my_bag_next').html("Next");
			 		$('#modal-backdrop').remove();
			 		$('#request_bag_signup_popup').css('display','none');
			 	}
			 }
			});
		}
	});

	//numeric condition
	$("#zipcode,#phone_number").on("keyup", function(){
        var valid = /^\d{0,20}(\.\d{0,20})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
});
</script>
@stop
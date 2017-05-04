@extends('/frontend/app')
@section('styles')
   <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
 @endsection
@section('content')
<section class="request_bag_page">
<div id="total_content_div">
	<div class="container">
		<form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="request_a_bag_form" id="request_a_bag_form" method="post">
			<div id="choose_an_option_for_bag_div">
					<p class="cst2-rms-chck"><input type="radio" name="is_payout" value="0">Don't send me a payout. I want to support Chrysalis' waste reduction and charitable donation program.</p>
					<p>*Note: At this time, Chrysalis does NOT issue tax receipts. </p>
					<p class="cst2-rms-chck"><input type="radio" name="is_payout" value="1">I want to pay a $9.99 Shipping & Handling fee to receive my bag (fee deducted after bag has been processed).</p>
						<span id="is_payout_error" style="color:red"></span>
					<div class="form-rms-btn">
						<a type="button" id="choose_an_option_for_bag_next" class="btn-rm-nxt nxt">Next</a>
					</div>
					<div>
						<p>Costume too big for a bag?</p>
						<p><a href="{{URL::to('costume/createtwo')}}"> Sell it Yourself! </a></p>
					</div>

			</div>

			<div id="average_payouts_div" style="display: none;">
			Average Payouts	
				<div>
					<p><a href="{{URL::to('costume/createtwo')}}"> Upload it Yourself! </a></p>
				</div>

				<div class="form-rms-btn">
					<a type="button" id="average_payouts_next" class="btn-rm-nxt nxt">Next</a>
				</div>
			</div>

			<div id="send_my_bag_div" style="display: none;">
				<div class="col-md-6">
					<p>Send My Bag To...</p>
					<div class="form-rms">
						<p class="form-rms-que">Full Name</p>
						<p class="form-rms-input"><input type="text" name="full_name" id="full_name"  tab-index="1" ></p>
						<span id="fullname_error" style="color:red"></span>

					</div>
					<div class="form-rms">
						<p class="form-rms-que">Address 1</p>
						<p class="form-rms-input"><input type="text" name="address1" id="address1"  tab-index="1" ></p>
						<span id="address1_error" style="color:red"></span>

					</div>
					<div class="form-rms">
						<p class="form-rms-que">Address 2 (Optional)</p>
						<p class="form-rms-input"><input type="text" name="address2" id="address2"  tab-index="1" ></p>
						<span id="address1_error" style="color:red"></span>

					</div>
					<div class="form-rms">
						<p class="form-rms-que">City</p>
						<p class="form-rms-input"><input type="text" name="city" id="city"  tab-index="1" ></p>
						<span id="city_error" style="color:red"></span>

					</div>
					<div class="form-rms">
						<p class="form-rms-que">State</p>
						<p class="form-rms-input">
						<select name="state" id="state">
						<option value="">Select s State</option>
							@foreach($states as $state)
							<option value="{{$state->abbrev}}">{{$state->name}}</option>
							@endforeach
						</select>
						</p>
						<span id="state_error" style="color:red"></span>

						<p class="form-rms-que">Zip Code</p>
						<p class="form-rms-input"><input type="text" name="zipcode" id="zipcode"  tab-index="1" ></p>
						<span id="zipcode_error" style="color:red"></span>

					</div>
					<div class="form-rms">
						<p class="form-rms-que">Phone Number</p>
						<p class="form-rms-input"><input type="text" name="phone_number" id="phone_number"  tab-index="1" ></p>
						<span id="phone_number_error" style="color:red"></span>

					</div>
					<p class="cst2-rms-chck"><input type="checkbox" name="quality_standards" value="1">All items meet our Quality Standards</p>
						<span id="quality_standards_error" style="color:red"></span>

					<p class="cst2-rms-chck"><input type="checkbox" name="reject_terms" value="1">I agree with Chrysalis' Reject Terms</p>
						<span id="reject_terms_error" style="color:red"></span>

				</div>
				<div class="col-md-6">
					<p class="cst2-rms-chck">What would you like to do with unaccepted items?</p>
					<p class="cst2-rms-chck"><input type="checkbox" name="is_return" value="1">Please opt me into Return Assurance and return my unaccepted items for an additional $9.99* (I understand that up to $19.98 could be deduted from mybag earnings). </p>
						<span id="is_return_error" style="color:red"></span>

					<p class="cst2-rms-chck">*Fee will be deduted from your earnings once your bag is processed.</p>
					<p class="cst2-rms-chck"><input type="checkbox" name="is_recycle" value="1">Please responsibly recycle my unaccepted items</p>
						<span id="is_recycle_error" style="color:red"></span>

					<p class="cst2-rms-chck">Have you registerd yet? Add your email!</p>
					<div class="form-rms">
						<p class="form-rms-que">Email Address</p>
						<p class="form-rms-input"><input type="text" name="email_address" id="email_address"  tab-index="1" ></p>
						<span id="email_address_error" style="color:red"></span>

					</div>
					<div class="form-rms-btn">
						<a type="button" id="send_my_bag_next" class="btn-rm-nxt nxt">Next</a>
					</div>
				</div>
			</div>
			<div id="your_bag_on_itsway" style="display: none;">
				<p class="form-rms-que">Hand in There!</p>
				<p class="form-rms-que">Your bag is on it's way</p>
				<a type="button" id="average_payouts_next" class="btn-rm-nxt nxt">Browse Costumes</a>
			</div>
		</form> 
	</div>
</div><!-- total content div -->
	</section>
		@stop
{{-- page level scripts --}}
@section('footer_scripts')
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
			$('#average_payouts_div').css('display','block');
			$('#send_my_bag_div').css('display','none');
			$('#your_bag_on_itsway').css('display','none');			 	
		}
		return str;
		
	});

	$('#average_payouts_next').click(function(){
		$('#choose_an_option_for_bag_div').css('display','none');
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
			 	if (data == "success") {
			 		$('#ajax_loader').remove();
			 		$('#choose_an_option_for_bag_div').css('display','none');
					$('#average_payouts_div').css('display','none');
					$('#send_my_bag_div').css('display','none');
					$('#your_bag_on_itsway').css('display','block');
			 	}
			 }});
						 	
		}
		return str;
		
	});
});
</script>
@stop
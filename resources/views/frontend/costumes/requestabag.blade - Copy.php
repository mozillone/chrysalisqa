@extends('/frontend/app')
@section('styles')
   <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
 @endsection
@section('content')
<section class="request_bag_page">
<div id="total_content_div">
	<div class="container">
		<form>
			<div id="choose_an_option_for_bag_div">
					<p class="cst2-rms-chck"><input type="checkbox" name="choose_an_option_for_bag" value="">Don't send me a payout. I want to support Chrysalis' waste reduction and charitable donation program.</p>
					<p>*Note: At this time, Chrysalis does NOT issue tax receipts. </p>
					<p class="cst2-rms-chck"><input type="checkbox" name="choose_an_option_for_bag" value="">I want to pay a $9.99 Shipping & Handling fee to receive my bag (fee deducted after bag has been processed).</p>

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
						<p class="form-rms-input"><input type="text" name="address1" id="address1"  tab-index="1" ></p>
						<span id="address1_error" style="color:red"></span>

					</div>
					<div class="form-rms">
						<p class="form-rms-que">City</p>
						<p class="form-rms-input"><input type="text" name="city" id="city"  tab-index="1" ></p>
						<span id="city_error" style="color:red"></span>

					</div>
					<div class="form-rms">
						<p class="form-rms-que">State</p>
						<p class="form-rms-input"><input type="text" name="state" id="state"  tab-index="1" ></p>
						<span id="state_error" style="color:red"></span>

						<p class="form-rms-que">Zip Code</p>
						<p class="form-rms-input"><input type="text" name="zipcode" id="state"  tab-index="1" ></p>
						<span id="state_error" style="color:red"></span>

					</div>
					<div class="form-rms">
						<p class="form-rms-que">Phone Number</p>
						<p class="form-rms-input"><input type="text" name="phone_number" id="phone_number"  tab-index="1" ></p>
						<span id="phone_number_error" style="color:red"></span>

					</div>
					<p class="cst2-rms-chck"><input type="checkbox" name="quality_standards" value="">All items meet our Quality Standards</p>
					<p class="cst2-rms-chck"><input type="checkbox" name="reject_terms" value="">I agree with Chrysalis' Reject Terms</p>
				</div>
				<div class="col-md-6">
					<p class="cst2-rms-chck">What would you like to do with unaccepted items?</p>
					<p class="cst2-rms-chck"><input type="checkbox" name="return_accurance" value="">Please opt me into Return Assurance and return my unaccepted items for an additional $9.99* (I understand that up to $19.98 could be deduted from mybag earnings). </p>
					<p class="cst2-rms-chck">*Fee will be deduted from your earnings once your bag is processed.</p>
					<p class="cst2-rms-chck"><input type="checkbox" name="recycle_items" value="">Please responsibly recycle my unaccepted items</p>
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

	$('#choose_an_option_for_bag_next').click(function(){
		$('#choose_an_option_for_bag_div').css('display','none');
		$('#average_payouts_div').css('display','block');
		$('#send_my_bag_div').css('display','none');
		$('#your_bag_on_itsway').css('display','none');
	});

	$('#average_payouts_next').click(function(){
		$('#choose_an_option_for_bag_div').css('display','none');
		$('#average_payouts_div').css('display','none');
		$('#send_my_bag_div').css('display','block');
		$('#your_bag_on_itsway').css('display','none');		
	});
	$('#send_my_bag_next').click(function(){
		$('#choose_an_option_for_bag_div').css('display','none');
		$('#average_payouts_div').css('display','none');
		$('#send_my_bag_div').css('display','none');
		$('#your_bag_on_itsway').css('display','block');
	});
});
</script>
@stop
@extends('/frontend/app')
@section('styles')
<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
<style>
.costume-error_dup{margin-top:10px !important;}
.costume-error_dup .form-rms-input{display: initial; }
.costume-error_dup .form-rms-input input + label{font-size:12px; }	
.costume-error_dup .form-rms-input input{box-shadow: 0px 0px 0px; border-radius: 0px;   color: #333;}

</style>
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
				<div class= "col-md-12 col-sm-12 col-xs-12">
					<div class="progressbar_main request-bag">
						<h2>REQUEST A BAG <img  src="{{URL::asset('assets/frontend/img/bag-min.png')}}"></h2>
					</div>
				</div> 
				<div class="col-md-12 col-sm-12 col-xs-12 request-icon-sec">
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
								<span class="step-header">Step 2</span> <br>
								Send It In
							</span>
						</div>
						<div class="col-md-4 col-sm-4 request-bag-steps">
							<img class="step3-img" src="{{URL::asset('assets/frontend/img/Step-3-piggy.png')}}">
							<span class="mbl-step3-header hidden-md hidden-sm hidden-lg">
								<span class="step-header">Step 3</span> <br>
								Earn Some Cash or Donate to Charity
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
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
					<h4>Choose an option of how you would like to receive your bag and payout.</h4>
					<div id="choose_an_option_for_bag_div">
						<p class="cst2-rms-chck">
							<!-- <input type="checkbox" checked name="is_payout_no" id="is_payout_no" value="1">Don't send me a payout. I want to support Chrysalis' waste reduction and charitable donation program. -->
							<input type="checkbox" checked name="is_payout_no" class="bag_payout_options" id="is_payout_no" value="1">Don't send me a payout. I want to support Chrysalis' waste reduction and charitable donation program.
						</p>
						<p class="notes request_not_btm">*Note: At this time, Chrysalis does NOT issue tax receipts. <i class="fa fa-exclamation-circle" aria-hidden="true"></i> </p>
						<p class="cst2-rms-chck">
							<input type="checkbox" class="bag_payout_options" name="is_payout" value="1" id="is_payout">I agree that $9.99 will be deducted from my bag payout for the shipping and handling fee.
						</p>
						<span id="is_payout_error" style="color:red"></span>
						<div class="form-rms-btn">
							<a type="button" id="choose_an_option_for_bag_next" class="btn-rm-nxt nxt">
							Next</a>
						</div>
						<div class="text-center">
							<h3>Costume too big for a bag?</h>
							<p><a href="{{URL::to('costume/create')}}"> Sell it Yourself! </a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container" id="average_payouts_div">
			<div class="row average-payout-sec">
				<div class= "col-md-12">
					<div class="progressbar_main request-bag">
						<h2>REQUEST A BAG <img  src="{{URL::asset('assets/frontend/img/bag-min.png')}}"></h2>
					</div>
				</div>
			</div>
			<div class="r-bag_div col-md-8 col-md-offset-2 average-payout-sec">	
				<div class="col-md-12 col-sm-12 col-xs-12">
					<ul class="nav nav-pills">
						<li class="active"><a data-toggle="pill" href="#payouts">Average Payouts</a></li>
						<li><a data-toggle="pill" href="#calculator">Payout Calculator</a></li>
					</ul>
					<div class="tab-content">
						<div id="payouts" class="tab-pane fade in active">
							<!--AVERAGE COSTUMES div start here-->
							
							<div class="col-md-12 col-sm-12 ">
								<div class="costumes-label">
									<span>AVERAGE COSTUMES</span>
									<span><i class="fa fa-usd" aria-hidden="true"></i>1.00 - 5.00</span>
								</div>
								<div class="row costumes">
									<div class="costumes-desktop">
										<div class="col-md-4 col-sm-4">
											<div class="cart-img">
												<img  src="{{URL::asset('assets/frontend/img/item-1.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>2</span>
												</span>
											</div>
										</div>
										<div class="col-md-4 col-sm-4">
											<div class="cart-img">
												<img  src="{{URL::asset('assets/frontend/img/Item-2.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>4</span>
												</span>
											</div>
										</div>
										<div class="col-md-4 col-sm-4">
											<div class="cart-img">
												<img  src="{{URL::asset('assets/frontend/img/Item-3.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>5</span>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div id="myCarousel" data-interval="false" class="carousel costumes-carousel slide" data-ride="carousel">
									<!-- Indicators -->
									<ol class="carousel-indicators">
										<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
										<li data-target="#myCarousel" data-slide-to="1"></li>
										<li data-target="#myCarousel" data-slide-to="2"></li>
									</ol>
									<!-- Wrapper for slides -->
									<div class="carousel-inner">
										<div class="item active">
											<div class="carousel-cart-img">
												<img  src="{{URL::asset('assets/frontend/img/item-1.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>12</span>
												</span>
											</div>
										</div>
										<div class="item">
											<div class="carousel-cart-img">
												<img  src="{{URL::asset('assets/frontend/img/Item-2.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>4</span>
												</span>
											</div>
										</div>
										<div class="item">
											<div class="carousel-cart-img">
												<img  src="{{URL::asset('assets/frontend/img/Item-3.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>5</span>
												</span>
											</div>
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
							
							<!--End here-->
							
							
							
							
							<!--MEDIUM QUALITY start here-->
							
							<div class="col-md-12 col-sm-12 ">
								<div class="costumes-label">
									<span>MEDIUM QUALITY</span>
									<span><i class="fa fa-usd" aria-hidden="true"></i>5.00 - 25.00</span>
								</div>
								<div class="row costumes">
									<div class="costumes-desktop">
										<div class="col-md-4 col-sm-4">
											<div class="cart-img">
												<img  src="{{URL::asset('assets/frontend/img/item-1.1.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>3</span>
												</span>
											</div>
										</div>
										<div class="col-md-4 col-sm-4">
											<div class="cart-img">
												<img  src="{{URL::asset('assets/frontend/img/Item-2.1.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>5</span>
												</span>
											</div>
										</div>
										<div class="col-md-4 col-sm-4">
											<div class="cart-img">
												<img  src="{{URL::asset('assets/frontend/img/Item-3.1.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>8</span>
												</span>
											</div>
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
											<div class="carousel-cart-img">
												<img  src="{{URL::asset('assets/frontend/img/item-1.1.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>9</span>
												</span>
											</div>
										</div>
										<div class="item">
											<div class="carousel-cart-img">
												<img  src="{{URL::asset('assets/frontend/img/Item-2.1.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>15</span>
												</span>
											</div>
										</div>
										<div class="item">
											<div class="carousel-cart-img">
												<img  src="{{URL::asset('assets/frontend/img/Item-3.1.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>6</span>
												</span>
											</div>
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
							
							<!--End here-->
							
							
							
							
							<!--FILM QUALITY start here-->
							
							<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="costumes-label hidden-lg hidden-md hidden-sm">
									<span class="film-sec"><img src="{{URL::asset('/assets/frontend/img/film.png')}}"> FILM QUALITY</span>
									<span class="mb_price_tag"><i class="fa fa-usd" aria-hidden="true"></i>25.00 &amp; up</span>
							</div>
								<div class="row costumes tabs_view_film"> 
									<div class="costumes-desktop">
										<div class="costumes-label">
											<span class="film-sec"><img src="{{URL::asset('/assets/frontend/img/film.png')}}"> FILM QUALITY</span>
											<span class="film-sec-price"><i class="fa fa-usd" aria-hidden="true"></i>25.00 & up</span>
										</div>
										<div class="row costumes">
											<div class="col-md-4 col-sm-4">
												<div class="cart-img">
													<img  src="{{URL::asset('assets/frontend/img/Item2.2.png')}}">
													<span class="price-tag">
														Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>10</span>
													</span>
												</div>
											</div>
											<div class="col-md-4 col-sm-4">
												<div class="cart-img">
													<img  src="{{URL::asset('assets/frontend/img/Item-1.3.png')}}">
													<span class="price-tag">
														Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>15</span>
													</span>
												</div>
											</div>
											<div class="col-md-4 col-sm-4">
												<div class="cart-img">
													<img  src="{{URL::asset('assets/frontend/img/item-3.3.png')}}">
													<span class="price-tag">
														Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>15</span>
													</span>
												</div>
											</div>
										</div>
										<div class="tip-sec">
											<p><span class="up_tip">Tip</span>
												If your costume is just too <br>
												awesome, we suggest you
											</p>
											<a href="{{URL::to('costume/create')}}">Upload it Yourself!</a>
											<img  src="{{URL::asset('assets/frontend/img/Tip-arrow_right.png')}}">
										</div>
									</div>
								</div>
								
								
								<div id="myCarousel2" class="carousel costumes-carousel slide" data-ride="carousel">
									<!-- Indicators -->
									<ol class="carousel-indicators">
										<li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
										<li data-target="#myCarousel2" data-slide-to="1"></li>
										<li data-target="#myCarousel2" data-slide-to="2"></li>
									</ol>
									<!-- Wrapper for slides -->
									<div class="carousel-inner">
										<div class="item active">
											<div class="carousel-cart-img">
												<img  src="{{URL::asset('assets/frontend/img/Item2.2.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>9</span>
												</span>
											</div>
										</div>
										<div class="item">
											<div class="carousel-cart-img">
												<img  src="{{URL::asset('assets/frontend/img/Item-1.3.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>15</span>
												</span>
											</div>
										</div>
										<div class="item">
											<div class="carousel-cart-img">
												<img  src="{{URL::asset('assets/frontend/img/item-3.3.png')}}">
												<span class="price-tag">
													Avg Payout <span class="price-doller"> <i class="fa fa-usd" aria-hidden="true"></i>6</span>
												</span>
											</div>
										</div>
										<p class="price_tip_crsl hidden-lg hidden-md hidden-sm">
										<span><b>*TIP: </b>If your costume is just too awesome, <br>we suggest you <b><a href="{{URL::to('costume/create')}}">Upload it Yourself!</a></b></span>
										</p>
									</div>
									<!-- Left and right controls -->
									<a class="left carousel-control" href="#myCarousel2" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="right carousel-control" href="#myCarousel2" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
										<span class="sr-only">Next</span>
									</a>
								</div>
								
							</div>
							
							<!--End here-->
							
							
							
						</div>
						<div id="calculator" class="tab-pane fade table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Initial Chrysalis Listing Price</th>
										<th>% Paid Out</th>
										<th>Payment Method</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><$14.99</td>
											<td>10%</td>
											<td>Upfront Payout</td>
										</tr>
										<tr>
											<td>$15-$19.99</td>
											<td>15%</td>
											<td>Upfront Payout</td>
										</tr>
										<tr>
											<td>$20-$29.99</td>
											<td>20%</td>
											<td>Upfront Payout</td>
										</tr>
										<tr>
											<td>$30-$39.99</td>
											<td>25%</td>
											<td>Upfront Payout</td>
										</tr>
										<tr>
											<td>$40-$49.99</td>
											<td>30%</td>
											<td>Upfront Payout</td>
										</tr>
										<tr>
											<td>$50-$59.99</td>
											<td>40%</td>
											<td>Consignment</td>
										</tr>
										<tr>
											<td>$60-$74.99</td>
											<td>45%</td>
											<td>Consignment</td>
										</tr>
										<tr>
											<td>$75-$89.99</td>
											<td>50%</td>
											<td>Consignment</td>
										</tr>
										<tr>
											<td>$90-$124.99</td>
											<td>55%</td>
											<td>Consignment</td>
										</tr>
										<tr>
											<td>$125-$199.99</td>
											<td>65%</td>
											<td>Consignment</td>
										</tr>
										<tr>
											<td>$200 and up</td>
											<td>80%</td>
											<td>Consignment</td>
										</tr>
										</tbody>
									</table>
									<div class="tbl_cnt">
										<h2>Payout Method Examples:</h2>
										<h3>Upfront Payout: </h3>
										<p>We list your costume for $20. You receive $4 instantly 
										when we accept the costume.</p>
										<h3>Consignment: </h3>
										<p>We list your costume for $200. You receive $160
										when it sells.</p>
									</div>			
								</div>
							</div>	</div>
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
							<div class= "col-md-12 col-sm-12 col-xs-12">
								<div class="progressbar_main request-bag">
									<h2>REQUEST A BAG <img  src="{{URL::asset('assets/frontend/img/bag-min.png')}}"></h2>
								</div>
							</div>
							<div class="request-address-sec col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-6">
									<!--  <form> -->
									<h4>Send My Bag To...</h4>
									<div class="form-rms costume-error">
										<p class="form-rms-que">Full Name<span style="color: red">*</span></p>
										<p class="form-rms-input"><input type="text" name="full_name" id="full_name" value="<?php if (isset($all_details['get_details']->display_name) && !empty($all_details['get_details']->display_name)) { echo $all_details['get_details']->display_name; } ?>" tab-index="1" ></p>
										<span id="fullname_error" style="color:red"></span>
									</div>

									<div class="form-rms costume-error">
										<p class="form-rms-que">Address 1<span style="color: red">*</span></p>
										<input type="hidden" class="field form-control" id="country" name="country">
										<p class="form-rms-input"><input type="text" name="address1" id="route" value="<?php if (isset($all_details['basic_address']->address1) && !empty($all_details['basic_address']->address1)) { echo $all_details['basic_address']->address1; } ?>" tab-index="1" onFocus="geolocate()"></p>
										<span id="address1_error" style="color:red"></span>
									</div>
									<div class="form-rms costume-error">
										<input type="hidden" class="field form-control" id="street_number">
										<p class="form-rms-que">Address 2 (Optional)</p>
										<p class="form-rms-input"><input type="text" value="<?php if (isset($all_details['basic_address']->address2) && !empty($all_details['basic_address']->address2)) { echo $all_details['basic_address']->address2; } ?>" name="address2" id="address2"  tab-index="1" ></p>
									</div>
									<div class="form-rms costume-error">
										<p class="form-rms-que">City<span style="color: red">*</span></p>
										<p class="form-rms-input"><input type="text" name="city" id="locality" value="<?php if (isset($all_details['basic_address']->city) && !empty($all_details['basic_address']->city)) { echo $all_details['basic_address']->city; } ?>" tab-index="1" ></p>
										<span id="city_error" style="color:red"></span>
									</div>
									<div class="form-rms form-align costume-error">
										<p class="form-rms-que">State<span style="color: red">*</span></p>
										<p class="form-rms-input">
											<?php if (isset($all_details['basic_address']->state) && !empty($all_details['basic_address']->state)) {
												$db_state = $all_details['basic_address']->state;
											} ?>
											<select name="state" id="administrative_area_level_1">
												<option value="" selected>Select a State</option>
												@foreach($all_details['state_table'] as $state)
												<option <?php if (!empty($db_state) == $state->abbrev): ?>
												selected="selected"
												<?php endif ?> value="{{$state->abbrev}}">{{$state->name}}</option>
												@endforeach
											</select>
										</p>
										<span id="state_error" style="color:red"></span>
										<p class="form-rms-que">Zip Code<span style="color: red">*</span></p>
										<p class="form-rms-input"><input type="text" name="zipcode" id="postal_code" value="<?php if (isset($all_details['basic_address']->zip_code) && !empty($all_details['basic_address']->zip_code)) { echo $all_details['basic_address']->zip_code; } ?>" tab-index="1" ></p>
										<span id="zipcode_error" style="color:red"></span>
									</div>
									<div class="form-rms costume-error">
										<p class="form-rms-que">Phone Number<span style="color: red">*</span></p>
										<p class="form-rms-input"><input type="text" name="phone_number" id="phone_number" value="<?php if (isset($all_details['get_details']->phone_number) && !empty($all_details['get_details']->phone_number)) { echo $all_details['get_details']->phone_number; } ?>" tab-index="1" ></p>
										<span id="phone_number_error" style="color:red"></span>
									</div>
									<!-- </form> -->
									<div class="condition-option clearfix">
										<p><input class="condition-check" type="checkbox" name="quality_standards" value="" checked>All items meet our   <a href="javascript:void(0)" id="quality_tooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="All costumes must be in excellent condition! <br> <b>Items have no:</b> <br> . Tears/rips/holes<br>. Missing parts<br> . Stains<br> . Significant wear">Quality Standards</a>
											<span id="quality_standards_error" style="color:red; display: block;"></span>
										</p>
										<p><input type="checkbox" name="reject_terms" value="">I have read and agree with Chrysalis' <a href="{{ route('terms-of-use') }}" target="_blank">Terms of Use</a>
											<span id="reject_terms_error" style="color:red; display: block;"></span>
										</p>
									</div>
								</div>
								<div class="col-md-6">
									<h4>What would you like to do with unaccepted items?</h4>
									<div class="unaccepted-option">
										<p class="cst2-rms-chck"><input checked type="radio" name="is_return" value="0">Please responsibly recycle my unaccepted items</p>
										<p class="cst2-rms-chck"><input type="radio" name="is_return" value="1">Please opt me into Return Assurance and return my unaccepted items for an additional $9.99* (I understand that up to $19.98 could be deducted from my bag earnings). </p>
										<p class="cst2-rms-chck" style="margin-top: 0">*Fee will be deducted from your earnings once your bag is processed.</p>
										<span id="is_recycle_error" style="color:red; display: block;"></span>
									</div>
									<h4>Have you registered yet? Add your email!</h4>
									<!-- <form> -->
									<div class="form-rms" style="margin-bottom: 18px">
										<p class="form-rms-que">Email Address<span style="color: red">*</span></p>
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
						<div class= "col-md-12 col-sm-12 col-xs-12">
							<div class="progressbar_main request-bag">
								<h2>REQUEST A BAG <img  src="{{URL::asset('assets/frontend/img/bag-min.png')}}"></h2>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 request-success">
							<img src="{{URL::asset('assets/frontend/img/bag-sucess.png')}}">
							<h4>Hand in There!</h4>
							<p>Your bag is on it's way</p>
							<a type="button" id="average_payouts_next" href="{{URL::to('/')}}" class="btn-rm-nxt nxt">Browse Costumes</a>
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
										<p>Email address is already registered sign in using your password</p>
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
												<div class="form-group">
													<div class="login-btn">
														<button class="btn btn-primary" id="request_a_bag_login">Log In</button>
													</div>
												</div>
											</form>                  
										</div>
										<div class="text-center close_icon">
											<button type="button" class="close" id="close_req" data-dismiss="modal"><span>&times;</span> Close</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="request_bag_registration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog request_login" role="document">
					<div class="modal-content">
					<div class=" modal-header indi_close_icons">
						<!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
					</div>
					 	<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="report_item_pupup " id="loginModal">
										<h2>Register</h2>
									<div id="myTabContent" class="tab-content">
										<p>The Email address <span id="add_email"></span> does not exist in our records. In order to create account and proceed requesting bag, fill up the following details:</p>
										<form role="form" action="{{route('register')}}" method="POST" id="reg_form">
									  		<input type="hidden" name="_token" value="{{ csrf_token() }}">
									  		<input type="hidden" name="email" value="" id="reg_email">
									  		<input type="hidden" name="reg_full_name" value="" id="reg_full_name">
									  		<div class="form-group">
												<label>Username</label>
												<input type="text" name="username" id="username" class="form-control">
												<p class="error">{{ $errors->first('email') }}</p>
											</div>
											<div class="form-group">
												<label>Password</label>
												<input type="password" name="password" id="signup_password" class="form-control input-sm">
												<p class="error">{{ $errors->first('password') }}</p>
											</div>
											<div class="form-group">
												<div class="login-btn">
													<img id="loader" class="hidden" src="{{asset('img/ajax-loader.gif')}}" >
													<button type="submit" class="btn btn-primary" id="reg_submit" >Register</button>
												</div>
											</div>
									  	</form>
									</div>
									<div class="text-center close_icon">
										<button type="button" class="close" id="close_reg" data-dismiss="modal"><span>&times;</span> Close</button>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
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
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD7L6zG6Z8ws4mRa1l2eAhVPDViUX6id0&libraries=places&callback=initAutocomplete"
	async defer></script>
		<script>
			$(document).on('click','.selling_popup_add',function(){
				$('#selling_popup_add').modal('show'); 
			});
			$(document).on('click','.edit_selling_addr',function(){
				$('#selling_popup_add').modal('show'); 
			});
			var placeSearch, autocomplete;
			var componentForm = {
				street_number: 'short_name',
				route: 'long_name',
				locality: 'long_name',
				administrative_area_level_1: 'short_name',
				country: 'long_name',
				postal_code: 'short_name'
			};
			
			function initAutocomplete() {
				// Create the autocomplete object, restricting the search to geographical
				// location types.
				$("#route").attr("placeholder","");
				autocomplete = new google.maps.places.Autocomplete(
	            /** @type {!HTMLInputElement} */(document.getElementById('route')),
					{types: ['geocode']});
					
					// When the user selects an address from the dropdown, populate the address
					// fields in the form.
					autocomplete.addListener('place_changed', fillInAddress);
			}
				
			function fillInAddress() {
				// Get the place details from the autocomplete object.
				var place = autocomplete.getPlace();
				for (var component in componentForm) {
					document.getElementById(component).value = '';
					document.getElementById(component).disabled = false;

				}
				$("#address2").val("");
				// Get each component of the address from the place details
				// and fill the corresponding field on the form.
				for (var i = 0; i < place.address_components.length; i++) {
					var addressType = place.address_components[i].types[0];
					if (componentForm[addressType]) {
						var val = place.address_components[i][componentForm[addressType]];
						if(addressType=="route"){
							$('#route').val($('#street_number').val()+" "+val);
						}
						else if(addressType=="administrative_area_level_1"){
							$("#administrative_area_level_1").val(val);
							}else{
							document.getElementById(addressType).value = val;
						}
					}
				}
			}
				
				// Bias the autocomplete object to the user's geographical location,
				// as supplied by the browser's 'navigator.geolocation' object.
			function geolocate() {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(function(position) {
						var geolocation = {
							lat: position.coords.latitude,
							lng: position.coords.longitude
						};
						var circle = new google.maps.Circle({
							center: geolocation,
							radius: position.coords.accuracy
						});
						autocomplete.setBounds(circle.getBounds());
					});
				}
			}
		</script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$("#reg_form").validate({
		            rules: {
		                username:{
		                	required: true,
		                	remote: {url: "/usernameValidation",type: "post"}
		                },
		                password:{
		                 	required:true,
		                 	minlength:8
		                }
		            },
	                messages:{
	                 	username:{
	                 		remote: "Username already taken."
	                 	}
	                },
	                submitHandler: function(form) {
	                	$('#loader').removeClass('hidden');
	                	form.submit();
	                }	
		        });

				/*$("#reg_submit").click(function(event){
					$('#loader').removeClass('hidden');
					return true;
				});*/
			$("#quality_tooltip").tooltip();
				$(".bag_payout_options").change(function() {
					var checked = $(this).is(':checked');
					$(".bag_payout_options").prop('checked',false);
					if(checked) {
						$(this).prop('checked',true);
					}
				});
				$(document).on('click','.nxt',function() {
					$("html, body").animate({ scrollTop: 0 }, "slow");
					return false;
				});
				$('#choose_an_option_for_bag_div').css('display','block');
				$('#average_payouts_div').css('display','none');
				$('#send_my_bag_div').css('display','none');
				$('#your_bag_on_itsway').css('display','none');
				$('#choose_an_option_for_bag_next').click(function(a){
					a.preventDefault();
					str=true;
					$('#is_payout_error').html('');
					/*if($('input[name=is_payout]:checked').length<=0){
						$('#is_payout_error').html('This field is required.');
						str=false;			
					}*/		
					if($('.bag_payout_options:checked').length<=0){
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
				$('#close_req').click(function(){
					$('.modal-backdrop').remove();
					$('#request_bag_signup_popup').css('display','none');
				});
				$('#close_reg').click(function(){
					$('.modal-backdrop').remove();
					$('#request_bag_registration').modal('hide');
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
					var address1  = $('#route').val();
					var city      = $('#locality').val();
					var state     = $('#administrative_area_level_1').val();
					var zipcode   = $('#postal_code').val();
					var phone_number = $('#phone_number').val();
					var len_phone    = $('#phone_number').val().length;
					var email_address = $('#email_address').val();
					$('#full_name,#route,#locality,#administrative_area_level_1,#postal_code,#phone_number,#email_address').css('border','');
					$('#fullname_error,#address1_error,#city_error,#state_error,#zipcode_error,#phone_number_error,#quality_standards_error,#reject_terms_error,#email_address_error,#is_return_error,#is_recycle_error').html('');
					if(full_name == ""){
						$('#full_name').css('border','1px solid red');
						$('#fullname_error').html('This field is required.');
						str=false;			
					}
					if(address1 == ""){
						$('#route').css('border','1px solid red');
						$('#address1_error').html('This field is required.');
						str=false;			
					}
					if (city == "") {
						$('#locality').css('border','1px solid red');
						$('#city_error').html('This field is required.');
						str=false;
					}
					if (state == "") {
						$('#administrative_area_level_1').css('border','1px solid red');
						$('#state_error').html('This field is required.');
						str=false;
					}
					if (zipcode == "") {
						$('#postal_code').css('border','1px solid red');
						$('#zipcode_error').html('This field is required.');
						str=false;
					}
					if (phone_number == "") {
						$('#phone_number').css('border','1px solid red');
						$('#phone_number_error').html('This field is required.');
						str=false;
					}
					if((phone_number != "") && (len_phone < 10)){
						$('#phone_number').css('border','1px solid red');
						$('#phone_number_error').html('Enter 10 digits');
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
					}*/
					/*
						if($('input[name=is_recycle]:checked').length<=0){
						$('#is_recycle_error').html('This field is required.');
						str=false;			
						}
					*/
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
					var loading = false;
					if (loading) {
						return ;
					}
					loading = true;
					if (str == true) {
						$('#send_my_bag_next').html("Submitting");
						$('#send_my_bag_next').append('<img id="ajax_loader" src="{{asset("img/ajax-loader.gif")}}" >');
						$("#reg_email").val($("#email_address").val());
						$('#add_email').text($("#email_address").val());
						$("#reg_full_name").val(full_name);
						$.ajax({
							url: "{{URL::to('costume/postrequestabag')}}",
							type: "POST",
							data: new FormData($('#request_a_bag_form')[0]),
							contentType:false,
							cache: false,
							processData: false,
							success: function(data){
								if (data == "login") {
									$('#send_my_bag_next').html("Next");
									$('#ajax_loader').remove();
									$('#send_my_bag_next').append('<div class="modal-backdrop fade in"></div>');
									$('#request_bag_signup_popup').css('display','block');
									loading = false;
								}
								else if(data == "register"){
									//window.location.href = "{{URL::to('login#signup_tab')}}";
									$('#send_my_bag_next').html("Next");
									$('#ajax_loader').remove();
									$('#send_my_bag_next').append('<div class="modal-backdrop fade in"></div>');
									$('#request_bag_registration').modal('show');
									loading = false;
								}
								else if (data.trim() == "success") {
									window.location.href = "{{URL::to('costume/successrequestbag')}}";
									loading = false;
								}
							}
						}); 
					}
					var errorDiv = $('.costume-error').first();
					var scrollPos = errorDiv.offset().top;
					$(window).scrollTop(scrollPos);
					return str;
				});
				$(function() {
    $("#phone_number").on("keyup paste", function() {
      // Remove invalid chars from the input
      var input = this.value.replace(/[^0-9\(\)\s\-]/g, "");
      var inputlen = input.length;
      // Get just the numbers in the input
      var numbers = this.value.replace(/\D/g,'');
      var numberslen = numbers.length;
      // Value to store the masked input
      var newval = "";

      // Loop through the existing numbers and apply the mask
      for(var i=0;i<numberslen;i++){
          if(i==0) newval="("+numbers[i];
          else if(i==3) newval+=") "+numbers[i];
          else if(i==6) newval+="-"+numbers[i];
          else newval+=numbers[i];
      }

      // Re-add the non-digit characters to the end of the input that the user entered and that match the mask.
      if(inputlen>=1&&numberslen==0&&input[0]=="(") newval="(";
      else if(inputlen>=6&&numberslen==3&&input[4]==")"&&input[5]==" ") newval+=") ";
      else if(inputlen>=5&&numberslen==3&&input[4]==")") newval+=")";
      else if(inputlen>=6&&numberslen==3&&input[5]==" ") newval+=" ";
      else if(inputlen>=10&&numberslen==6&&input[9]=="-") newval+="-";

      $(this).val(newval.substring(0,14));
   });
});
				$('#request_a_bag_login').click(function(){
					var loginpopup_email = $('#loginpopup_email').val();
					var loginopup_password = $('#loginopup_password').val();
					if($('input[name=is_payout]:checked').length<=0){
						var is_payout = "0";		
						}else{
						var is_payout = "1";
					}
					if($('input[name=is_return]:checked').length<=0){
						var is_return = "0";		
						}else{
						var is_return = "1";
					}
					if($('input[name=is_recycle]:checked').length<=0){
						var is_recycle = "0";		
						}else{
						var is_recycle = "1";
					}
					var full_name = $('#full_name').val();
					var address1  = $('#route').val();
					var address2  = $('#address2').val();
					var city      = $('#locality').val();
					var state     = $('#administrative_area_level_1').val();
					var  zipcode  = $('#postal_code').val();
					var phone_number = $('#phone_number').val();
					var email_address = $('#email_address').val(); 
					var total_data    = {email: loginpopup_email,password:loginopup_password,is_payout: is_payout,full_name: full_name,address1: address1,address2:address2,city: city,state: state,zipcode: zipcode,phone_number: phone_number,is_return: is_return,is_recycle: is_recycle,email_address: email_address}
					if (loginpopup_email != "" && loginopup_password !="") {
						$.ajax({
							url: "{{URL::to('/postrequestabaglogin')}}",
							type: "POST",
							data: total_data,
							success: function(data){
								if (data == "login_sucess") {
									$('#ajax_loader').remove();
									$('#send_my_bag_next').html("Next");
									$('#modal-backdrop').remove();
									$('#request_bag_signup_popup').css('display','none');
								}
								else if (data == "success") {
									window.location.href = "{{URL::to('costume/successrequestbag')}}";
								}
								else{
									window.location.href = "{{URL::to('/login')}}";
								}
							}
						}); 
					}
				});
				//numeric condition
				$("#postal_code").on("keyup", function(){
					var valid = /^\d{0,10}(\.\d{0,10})?$/.test(this.value),
					val = this.value;
					if(!valid){
						console.log("Invalid input!");
						this.value = val.substring(0, val.length - 1);
					}
				

				});
			});
		</script>
	@stop		
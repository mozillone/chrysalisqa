@extends('/frontend/app')
@section('styles')
<style type="text/css">
	.pac-container {
    z-index: 10000 !important;
	}
</style>
@endsection
@section('content')
<section class="content create_section_page">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
				<!--<h1>Dashboard</h1>-->
			</div>
		</div>
	</div>
</section>    
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<section class="content ">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@if (Session::has('error'))
				<div class="alert alert-danger alert-dismissable dashboard_eror-paypal">
					<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
					{{ Session::get('error') }}
				</div>
				@elseif(Session::has('success'))
				<div class="alert alert-success alert-dismissable">
					<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
					{{ Session::get('success') }}
				</div>
				@endif
				<div class="dashboard-top-box">
					<p class="left_heading"><span>MY ACCOUNT</span> Keep your account info up to date for a smooth checkout process!</p>
					<p class="right_heading">
						<span class="my_msg"><a href="{{URL::to('conversations')}}"> <i class="fa fa-envelope" aria-hidden="true"></i> My Messages </a></span>
						<span class="my_facvrs"><a href="{{URL::to('wishlist')}}"><i class="fa fa-heart" aria-hidden="true"></i>  My Favorites </a></span>
					</p>
				</div>
				
			</div>
			<div class="col-md-12 pay_main_div" @if(Auth::user()->paypal_verified == "verified") style="display: none;" @endif >
				<p class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="205">Note: Your paypal account is not verified</p>
			</div>
		</div>
		<div class="row">
			<div class="dashboard-boxs">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="dashboad_left_side">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2>PROFILE DETAILS</h2>
							</div>
							<div class="panel-body p_details">
								<form id="edit_customer" class="form-horizontal defult-form" action="{{route('edit-profile')}}" method="POST" novalidate enctype="multipart/form-data">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
									
									<div class="col-md-12 dashboard_md_pflt_0">
										
										<div class="col-md-6 col-sm-6 dash_pic_upld">
											<div class="form-group">
												@if(!empty($user_details->user_img)) 
												<?php $image = URL::asset('profile_img/resize').'/'.$user_details->user_img;   ?>
												@else 
												<?php $image = URL::asset('/img/default.png');   ?>
												@endif
												<div class="fileupload fileupload-new" data-provides="fileupload" style="background-image: url(<?php echo $image; ?>);"> 
													
													<span class="remove_pic" id="profile_X" style="display: none;" ><i class="fa fa-times-circle" aria-hidden="true"></i></span>
													<div class="row upload_bx">
														<div class="col-md-8 col-sm-10 col-xs-12">
															<div class=" upload_btns">
																<span class=" btn-file">
																	<span class="fileupload-exists"></span>     
																	<span class="camera-icon"><i class="fa fa-camera" aria-hidden="true"></i></span><br>
																	<input id="profile_logo" name="avatar" type="file" placeholder="Profile Image" class="form-control">
																	<input type="hidden" name="is_removed" value="{{$user_details->user_img}}"/>
																</span> 
															</div>
															<!-- <p class="noteices-text">Note: The file could not be exceed above 3MB and allowed .JPG, .JPEG, .PNG formats only.</p>  -->
														</div>
													</div>
													<span class="fileupload-preview"></span>
													<a href="javascript:void(0);" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
												</div>
												<p class="error">{{ $errors->first('avatar') }}</p> 
											</div>
										</div>
										<div class="col-md-6 col-sm-6 dash_sr_crdt">
											<div class="dash_store_box">
												<p>Chrysalis Store Credit</p>
												<h3>${{number_format(Auth::user()->credits, 2, '.', ',')}}</h3>
											</div>
										</div>
									</div>
									<div class="form-group dashboad_title-input">
										<label for="title">Title</label>
										<select class="form-control" id="title" name="title">
											<option <?php if($user_details->title == "Ms.") {?> selected="selected" <?php } ?> >Ms.</option>
											<option <?php if(empty($user_details->title)){ ?> selected="selected" <?php } ?> <?php if($user_details->title == "Mr.") {?> selected="selected" <?php } ?>>Mr.</option>
										</select>
									</div>
									<div class="form-group">
										<label for="pwd">Username</label>
										<input type="text" class="form-control" value="{{$user_details->username}}" name="username" id="username">
									</div>
									<div class="form-group">
										<label for="text">Full Name</label>
										<input type="text" class="form-control" value="{{$user_details->first_name}} {{$user_details->last_name}}" name="last_name" id="last_name">
									</div>
									<div class="form-group">
										<label for="pwd">Password:</label>
										<input type="password" class="form-control" name="password" id="password">
									</div>
									<div class="form-group">
										<label for="pwd">Email Address</label>
										<input type="text" class="form-control" value="{{$user_details->email}}" name="email" id="email">
									</div>
									<div class="form-group">
									</div>
									<div class="form-group update_btn">
										<button type="submit" class="btn btn-primary pull-right update_btn common-btn">Update</button>
									</div>
									
								</form>
								
							</div>
						</div>
						<div class="panel panel-default shipping_block">
							<div class="panel-heading">
							<h2>SHIPPING SETTINGS</h2></div>
							<div class="panel-body billing_addres_1">
								
								<p class="bill_adrs">
									<form id="edit_shipping" class="form-horizontal defult-form" action="{{route('shipping-details')}}" method="POST" novalidate enctype="multipart/form-data">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
										
										
										<div class="checkbox">
										<label class="shiping_checkbox"><input type="checkbox" <?php if (Auth::user()->is_free == 1) { ?> checked="checked" <?php } ?> name="free_shipping" id="free_shipping">I want to Offer Free Shipping</label></div>
										 Paypal Account <span class="pay_pal_desc">(Do you intend to receive payouts?)</span>
										<!-- <label>Please enter your PayPal email address to receive payouts.</label> -->
										<div class="input-group paypal_field">
											<span class="input-group-addon" id="basic-addon1"><img src="{{URL::asset('assets/frontend/img/paypal.png')}}"></span>
											<input type="text" class="form-control"  name="paypal_email" value="{{Auth::user()->paypal_email}}" id="paypal_email" placeholder="Paypal email">
										</div>
										
										<div class="form-group ">
										</div>
										<div class="form-group update_btn">
											<button type="submit" class="btn btn-primary pull-right update_btn common-btn">Update</button>
										</div>
									</form>
								</p> 
								
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2>WHERE WILL YOU BE SHIPPING YOUR COSTUMES FROM?</h2>
							</div>
							
							
							<div class="panel-body billing_addres_1">
								@if(count($seller_address))
								<p class="bill_adrs">
									
									<span> <strong>{{$seller_address[0]->fname}} {{$seller_address[0]->lname}}</strong><br>
										{{$seller_address[0]->address1}}@if(!empty($seller_address[0]->address1))<br>@endif{{$seller_address[0]->address2}}<br>
										{{$seller_address[0]->city}}, {{$seller_address[0]->state}}
									{{$seller_address[0]->zip_code}}</span>
								</p>
								<p class="bill_adrs_dlte">
									<span><a href="javascript::void(0);" class="edit_selling_addr"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span> <span><a href="javascript::void(0);" onclick="delete_seller_address({{$seller_address[0]->address_id}})" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></span>
								</p>
								@else
								<p class="bill_adrs"><span>No Shipping from location found</span></p>
								@endif 
								
								@if(!count($seller_address))
								<div class="form-group add_new_btn">
									<a type="submit" href="javascript::void(0);" class="btn btn-default selling_popup_add">Add New</a>
								</div>
								@endif
								
								
							</div>
						</div>
						
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2>PAYMENT DETAILS</h2>
							</div>
							
							<div class="panel-body pay_details">@if(count($creditcard_list) > 0)
								@foreach ($creditcard_list as $cc_list)
								<div class="checkbox">
									<?php //print_r($creditcard_list);die; ?>
									
									<label><input type="radio" name="cc_radio" id="cc_radio_{{$cc_list->id}}" @if($cc_list->is_default == "1") checked="checked" @endif>{{$cc_list->card_type}} ending in {{$cc_list->last_digits}} @if($cc_list->is_default == "1") (Default)  @endif</label>
									<p class="pymnt_right_box"><span></span> <span><a href="javascript:void(0);" data-toggle="tooltip" title="Delete" onclick="deleteccard({{$cc_list->id}})"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span></p>
								</div>
								@endforeach
								@else
								No Cards Are Available.
								@endif
								<!-- <div class="checkbox">
									<label><input type="checkbox">Amex ending in 3456</label>
									<p class="pymnt_right_box"><span><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span> <span><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span></p>
									</div>
									<div class="checkbox">
									<label><input type="checkbox">Paypal</label>
									<p class="pymnt_right_box"><span><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span> <span><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span></p>
								</div> -->
							</div>
							
							<div class="panel-body add_new_card">
								<div class="panel-heading">ADD NEW CARD</div>
								<form class="" action="{{route('creditcard-add')}}" method="POST" id="cc_dashboard_form">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="form-group">
										<label for="title">Full Name On Card</label>
										<input type="text" class="form-control" name="cardholder_name" id="cardholder_name">
									</div>
									
									
									<div class="form-group">
										<label for="pwd" style="display: block">Expiration Date</label>
										<div class="col-md-6 col-sm-6 field-align-xs">
											<select name="exp_month" class="form-control" id="exp_month">
												<option value="">MM</option>
												<option value="01">Jan</option>
												<option value="02">Feb</option>
												<option value="03">Mar</option>
												<option value="04">Apr</option>
												<option value="05">May</option>
												<option value="06">Jun</option>
												<option value="07">Jul</option>
												<option value="08">Aug</option>
												<option value="09">Sep</option>
												<option value="10">Oct</option>
												<option value="11">Nov</option>
												<option value="12">Dec</option>
											</select>
										</div>
										<div class="col-md-6 col-sm-6 exp_year">
											<select name="exp_year" class="form-control" id="exp_year">
												<option value="">YYYY</option>
												@for($i=0;$i<=30;$i++)
												<option value="{{date('Y',strtotime('now'))+$i}}">{{date('Y',strtotime('now'))+$i}}</option>
												@endfor
											</select>
										</div>
										
									</div>
									<!-- <div class="form-group">
										<label for="pwd">Expiration Date</label>
										<input type="text" class="form-control" name="expiration_date" id="expiration_date">
									</div> -->
									<div class="form-group">
										<label for="text">Card Number</label>
										<input type="text" class="form-control" name="cc_number" id="cc_number">
									</div>
									<div class="form-group">
										<label for="pwd">CVN Code</label>
										<input type="password" class="form-control" name="cvn_pin" id="cvn_pin">
									</div>
									<div class="form-group">
									</div>
									<div class="form-group">
										
										
										
										<div class="update_btn">
											<button class="btn common-btn">Save Card</button>
										</div></div>
										
								</form>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
							<h2>BILLING ADDRESS</h2></div>
							<div class="panel-body billing_addres_1">
								<?php if(isset($default_billing_address) && !empty($default_billing_address) &&  count($default_billing_address)>0){
									$billing_address = $default_billing_address; 
									
									//echo "<pre>";print_r($billing_address);die;
								?>
								@foreach ($billing_address as $b_address)
								<p class="bill_adrs">
									
									<span> <strong>{{$b_address->fname}} {{$b_address->lname}}</strong><br>
										@if(!empty($b_address->address1)){{$b_address->address1}}<br>@endif
										{{$b_address->address2}}<br>
										{{$b_address->city}}, @foreach($states as $st) @if($st->name==$b_address->state ){{$st->abbrev}} @endif @endforeach {{$b_address->zip_code}}
									</span>
								</p> 
								<p class="bill_adrs_dlte">
									<span><a href="javascript:void(0);" data-toggle="tooltip" title="Edit" onclick="edit_billing({{$b_address->address_id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span> <span><a href="javascript:void(0);" data-toggle="tooltip" title="Delete" onclick="delete_address({{$b_address->address_id}})"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span>
								</p>
								@endforeach
								<?php }else{
									$billing_address = "<p>Billing address is not added yet.</p>";
									echo $billing_address;
								} ?>
								<div class="form-group add_new_btn">
									<a type="submit" id="billing_popup_add" class="btn btn-default">Add New</a>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
							<h2>SHIPPING ADDRESS</h2></div>
							<div class="panel-body billing_addres_1">
								<?php if(isset($default_shipping_address) && !empty($default_shipping_address) && count($default_shipping_address)>0  ){
									$shipping_address = $default_shipping_address; 
									
									//echo "<pre>";print_r($states);die;
								?>
								@foreach ($shipping_address as $index=>$s_address)
								<p class="bill_adrs">
									
									<span> <strong>{{$s_address->fname}} {{$s_address->lname}}</strong><br>
										@if(!empty($s_address->address1)){{$s_address->address1}}<br>@endif
										{{$s_address->address2}}<br>
										{{$s_address->city}}, @foreach($states as $st) @if($st->name==$s_address->state ){{$st->abbrev}} @endif @endforeach
									{{$s_address->zip_code}}</span>
								</p> 
								<p class="bill_adrs_dlte">
									<span><a href="javascript:void(0);" data-toggle="tooltip" title="Edit" onclick="edit_shipping({{$s_address->address_id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span> <span><a href="javascript:void(0);" data-toggle="tooltip" title="Delete" onclick="delete_address({{$s_address->address_id}})"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span>
								</p>
								@endforeach
								<?php }else{
									$shipping_address = "<p>Shipping address is not added yet.</p>";
									echo $shipping_address;
								} ?>
								<div class="form-group add_new_btn">
									<a type="submit" class="btn btn-default" id="shipping_popup_add">Add New</a>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="dashboad_right_side ">
						<div class="rencemt_order_table table-responsive">
							<div class="clearfix">
								<h2>MY COSTUMES <span class="pull-right"><a href="{{URL::to('my/costumes')}}">View All</a></span></h2>
								
							</div>
							<table class="table table-striped">
								<thead> <tr>  <th>Costume Name</th> <th>Status</th>  <th>Created Date</th> </tr> </thead> 
								<tbody> 
									@if(count($my_costumes))
									@foreach ($my_costumes as $orders)
									<tr> <td><a href="{{URL::to('costume/edit/')}}<?php echo '/'.$orders->costume_id ?>"> <?php if(strlen($orders->name) < 25) {echo $orders->name;} else { echo substr($orders->name, 0,25)."..."; } ?> </a> </td>  
										<td><a href="{{URL::to('costume/edit/')}}<?php echo '/'.$orders->costume_id ?>">{{ucfirst($orders->status)}} </a></td> 
									<td><a href="{{URL::to('costume/edit/')}}<?php echo '/'.$orders->costume_id ?>">{{helper::DateFormat($orders->created_at)}}  </a></td> </tr>
									@endforeach
									@else
									<tr> <td colspan="3">No Costumes are found</td> </tr>
									@endif 
									
								</tbody> 
							</table>
						</div>
						<div class="rencemt_order_table">
							<div>
								<h2>RECENT ORDERS <span class="pull-right"><a href="/my/orders">View All</a></span></h2>
								
							</div>
							<table class="table table-striped">
								<thead> <tr>  <th>Date</th> <th>Order No.</th> <th>Seller</th> <th>Status</th>  </tr> </thead> 
								<tbody> 
									@if(count($recent_orders))
									@foreach ($recent_orders as $orders)
									
									<tr> 
										<td><a href="{{URL::to('order/')}}<?php echo '/'.$orders->order_id; ?>">{{helper::DateFormat($orders->date)}}</a></td> 
										<td><a href="{{URL::to('order/')}}<?php echo '/'.$orders->order_id; ?>">{{$orders->order_id}}</a></td> 
										<td><a href="{{URL::to('order/')}}<?php echo '/'.$orders->order_id; ?>"><?php if(strlen($orders->seller_name) < 25) {echo ucfirst($orders->seller_name);} else { echo substr(ucfirst($orders->seller_name), 0,25)."..."; } ?></a></td> 
										<td><a href="{{URL::to('order/')}}<?php echo '/'.$orders->order_id; ?>">{{ucfirst($orders->status)}}</a></td> 
									</tr>
									@endforeach
									@else
									<tr> <td colspan="4">No Recent Orders are found</td> </tr>
									@endif 
									
								</tbody> 
							</table>
						</div>
						<div class="rencemt_order_table">
							<div>
								<h2>COSTUMES SOLD <span class="pull-right"><a href="/my/costumes-slod">View All</a></span></</h2>
							</div>
							<table class="table table-striped">
								<thead> <tr>  <th>Date</th> <th>Order No.</th> <th>Buyer</th> <th> Status</th>  </tr> </thead> 
								<tbody>
									@if(count($costumes_sold)) 
									@foreach ($costumes_sold as $sold_costumes)
									<tr> 
										<td><a href="{{URL::to('sold/order/')}}<?php echo '/'.$sold_costumes->order_id; ?>">{{helper::DateFormat($sold_costumes->date)}}</a></td> 
										<td><a href="{{URL::to('sold/order/')}}<?php echo '/'.$sold_costumes->order_id; ?>">{{$sold_costumes->order_id}} </a> </td> 
										<td><a href="{{URL::to('sold/order/')}}<?php echo '/'.$sold_costumes->order_id; ?>"><?php if(strlen($sold_costumes->buyer_name) < 25) {echo ucfirst($sold_costumes->buyer_name);} else { echo substr(ucfirst($sold_costumes->buyer_name), 0,25)."..."; } ?></a></td> 
										<td><a href="{{URL::to('sold/order/')}}<?php echo '/'.$sold_costumes->order_id; ?>">{{ucfirst($sold_costumes->status)}}</a></td> 
									</tr>
									@endforeach 
									@else
									<tr> <td colspan="4">No costumes sold are found</td></tr>
									@endif 
									
								</tbody> 
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade window-popup in" id="shipping_popup" tabindex="-1">
		<div class="modal-dialog shopping-address-modal">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" id="shi_close" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Shipping Address</h4>
				</div>
				<div class="modal-body">
					<form class="" action="{{route('shipping-address')}}" method="POST" id="shipping_address">   
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="is_edit" value="no">
						
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="chek-out">
								<div class="new_address">
									<div class="address-form">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_firstname" placeholder="First Name *" name="firstname" value="{{Auth::user()->first_name}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_lastname" placeholder="Last Name" name="lastname" value="{{Auth::user()->last_name}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_address_2" placeholder="Street Address *" name="address_2">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_address_1" placeholder="Apt or Suite no (Optional)" name="address_1">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_city" placeholder="City *" name="city">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<select class="form-control state_dropdown" name="shiping_state_dropdown" id="shiping_state_dropdown">
													<option value="" selected>State</option>
													@foreach($states as $st)
													<option value="{{$st->name}}">{{$st->name}}</option>
													@endforeach
													
												</select>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_postcode" placeholder="Zipcode *" name="postcode">
											</div>
										</div>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group checkbox-align">
												<input type="checkbox" class="form-control" id="is_billing" name="is_billing"><label for="billing:use_for_shipping_yes">Bill to this address</label>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<button class="btn btn-primary submit-btn">Submit</button>
										</div>			
										
									</div>
								</div>
								
								
								
							</div>
						</div>
					</form>  
				</div>
				<div class="modal-footer">
					<button type="button" class="close close-btn" data-dismiss="modal" id="shipping_close"><span>×</span> Close</button>
				</div>
			</div>
			
		</div>
	</div>
	<div class="modal fade window-popup" id="shipping_popup_edit" tabindex="-1">
		<div class="modal-dialog shopping-address-modal">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" id="shi_close" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Shipping Address</h4>
				</div>
				<div class="modal-body">
					<form class="" action="{{route('shipping-address')}}" method="POST" id="shipping_address1">   
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="is_edit" value="yes">
						<input type="hidden" name="shipping_address_id" id="shipping_address_id" value="">
						
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="chek-out">
								<div class="new_address">
									<div class="address-form">
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_firstname_edit" placeholder="First Name *" name="firstname" value="">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_lastname_edit" placeholder="Last Name" name="lastname" value="">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_address_2_edit" placeholder="Street Address *" name="address_2" value="">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_address_1_edit" placeholder="Apt or Suite no (Optional)" name="address_1" value="">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_city_edit" placeholder="City *" name="city" value="">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="hidden" class="form-control" id="shipping_state_hidden_edit" name="hidden_state" value="">
												
												<select class="form-control state_dropdown" name="state" id="shipping_state_dropdown_edit">
													<option value="" >State</option>
													@foreach($states as $st)
													<option value="{{$st->name}}">{{$st->name}}</option>
													@endforeach
													
												</select>
												<input type="text" class="form-control normal-states hide" id="shipping_state" placeholder="State *" name="shiping_state_dropdown">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="shipping_postcode_edit"  name="postcode" value="">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group checkbox-align">
												<input type="checkbox" class="form-control" id="is_billing" name="is_billing"><label for="billing:use_for_shipping_yes">Bill to this address</label>
											</div>
										</div>
										<div class="col-md-12">
											<button class="btn btn-primary submit-btn">Update</button>
										</div>			
										
									</div>
								</div>
								
								
								
							</div>
						</div>
					</form>  
				</div>
				<div class="modal-footer">
					<button type="button" class="close close-btn" data-dismiss="modal" id="shipping_close"><span>×</span> Close</button>
				</div>
			</div>
			
		</div>
	</div>
	<div class="modal fade window-popup" id="billing_popup" tabindex="-1">
		<div class="modal-dialog shopping-address-modal">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" id="bil_close" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Billing Address</h4>
				</div>
				<div class="modal-body">
					<form class="" action="{{route('billing-address')}}" method="POST" id="billing_address">   
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="is_edit" value="no">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="chek-out">
								<div class="new_address">
									<div class="address-form">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_firstname" placeholder="First Name *" name="firstname" value="{{Auth::user()->first_name}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_lastname" placeholder="Last Name" name="lastname" value="{{Auth::user()->last_name}}">
											</div>
										</div>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_address_2" placeholder="Street Address *" name="address_2">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_address_1" placeholder="Apt or Suite no (Optional)" name="address_1">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_city" placeholder="City *" name="city">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<select class="form-control state_dropdown" name="billing_state_dropdown" id="billing_state_dropdown">
													<option value="" selected>State</option>
													@foreach($states as $st)
													<option value="{{$st->name}}">{{$st->name}}</option>
													@endforeach
													
												</select>
												<input type="text" class="form-control normal-states hide" id="billing_state" placeholder="State *" name="state">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_postcode" placeholder="Zipcode *" name="postcode">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
											</div>
										</div>
										
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group checkbox-align">
												<input type="checkbox" class="form-control" id="is_shipping" name="is_shipping"><label for="billing:use_for_shipping_yes">Ship to this address</label>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<button class="btn btn-primary submit-btn">Submit</button>
										</div>
										
										
									</div>
								</div>
								
								
								
							</div>
						</div>
					</form>  
				</div>
				<div class="modal-footer">
					<button type="button" class="close close-btn" id="billing_close" data-dismiss="modal"><span>×</span> Close</button>
				</div>
			</div>
			
		</div>
	</div>
	<div class="modal fade window-popup" id="billing_popup_edit" tabindex="-1">
		<div class="modal-dialog shopping-address-modal">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" id="bil_close" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Billing Address</h4>
				</div>
				<div class="modal-body">
					<form class="" action="{{route('billing-address')}}" method="POST" id="billing_address1">   
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="is_edit" value="yes">
						<input type="hidden" name="billing_address_id" id="billing_address_id"value="">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="chek-out">
								<div class="new_address">
									<div class="address-form">
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_firstname_edit" placeholder="First Name *" name="firstname" value="{{Auth::user()->first_name}}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_lastname_edit" placeholder="Last Name" name="lastname" value="{{Auth::user()->last_name}}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_address_2_edit" placeholder="Street Address *" name="address_2" value="@if (isset($billing_address->address2)){{$billing_address->address2}}@endif">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_address_1_edit" placeholder="Apt or Suite no (Optional)" name="address_1" value="@if (isset($billing_address->address1)){{$billing_address->address1}}@endif">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_city_edit" placeholder="City *" name="city" value="@if (isset($billing_address->city)){{$billing_address->city}}@endif">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<select class="form-control state_dropdown" name="billing_state_dropdown" id="billing_state_dropdown_edit">
													<option value="" selected>State</option>
													@foreach($states as $st)
													<option value="{{$st->name}}">{{$st->name}}</option>
													@endforeach
													
												</select>
												<input type="text" class="form-control normal-states hide" id="billing_state" placeholder="State *" name="state">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_postcode_edit" placeholder="Zipcode *" name="postcode" value="@if (isset($billing_address->zip_code)){{$billing_address->zip_code}}@endif">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group checkbox-align">
												<input type="checkbox" class="form-control" id="is_shipping" name="is_shipping"><label for="billing:use_for_shipping_yes">Ship to this address</label>
											</div>
										</div>
										<div class="col-md-12">
											<button class="btn btn-primary submit-btn">Update</button>
										</div>
										
										
									</div>
								</div>
								
								
								
							</div>
						</div>
					</form>  
				</div>
				<div class="modal-footer">
					<button type="button" class="close close-btn" id="billing_close" data-dismiss="modal"><span>×</span> Close</button>
				</div>
			</div>
			
		</div>
	</div>
    <div id="selling_popup_add" class="modal fade" role="dialog" class="modal fade window-popup" >
		<div class="modal-dialog shopping-address-modal">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">SHIPPING FROM LOCATION</h4>
				</div>
				<div class="modal-body">
					<form class="" action="{{route('seller-location-address')}}" method="POST" id="seller_address">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="chek-out">
								<div class="new_address">
									<div class="address-form">
										<div class="row">
											<div class="col-md-12 location-div">
												<div class="form-group has-feedback add-event-error" >
													<div id="locationField">
														<input type="text" class="form-control" placeholder="Enter Location"  id="autocomplete" onFocus="geolocate()" >
														<label class="note">Note: Type the location name and select  to populate in address fields</label>
														<p class="error">{{ $errors->first('location') }}</p>
														
													</div>
													
												</div>
												<div class="locl-cnts has-feedback selling_location_note" >
													
													
													<input type="hidden" class="field form-control" id="country" name="country">
													@if(count($seller_address))  <input type="hidden" class="field form-control" name="add_id" value="{{$seller_address[0]->address_id}}">  <input type="hidden" class="field form-control" name="is_edit" value="0"> @endif
													
												</div>
												<div class="clearfix"></div> 
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="field form-control" name="address_2" id="route" placeholder="Street Address *" value="@if(count($seller_address)) {{$seller_address[0]->address2}} @endif">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="hidden" class="field form-control" id="street_number">
													<input type="text" class="field form-control" id="" name="address_1" disable="true" placeholder="Apt or Suite no (Optional)" value="@if(count($seller_address)){{$seller_address[0]->address1}}@endif">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="field form-control" id="locality" name="city" placeholder="City *" value="@if(count($seller_address)) {{$seller_address[0]->city}} @endif">
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<select class="form-control state_dropdown" id="administrative_area_level_1" name="state" >
														<option value="" selected>State</option>
														@foreach($states as $st)
														<option value="{{$st->abbrev}}" @if(count($seller_address) && $seller_address[0]->state==$st->abbrev) selected @endif>{{$st->name}}</option>
														@endforeach
														
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="field form-control" id="postal_code" name="zipcode" placeholder="Zip code *" value="@if(count($seller_address)){{$seller_address[0]->zip_code}}@endif">
												</div>
											</div>
											<div class="col-md-12">
												@if(count($seller_address)) <button class="btn btn-primary submit-btn">Update</button> @else <button class="btn btn-primary submit-btn">Submit</button> @endif
											</div>
											
											
										</div>
									</div>
									
									
									
								</div>
							</div>
							
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="close close-btn" id="billing_close" data-dismiss="modal"><span>×</span> Close</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	@stop
	{{-- page level scripts --}}
	@section('footer_scripts')
	<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('/js/credit-card-validation.js') }}"></script>
	<script src="{{ asset('/js/dashboard.js') }}"></script>
	<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
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
			autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
				{types: ['geocode']});
				
				// When the user selects an address from the dropdown, populate the address
				// fields in the form.
				autocomplete.addListener('place_changed', fillInAddress);
			}
			
			function fillInAddress() {
				// Get the place details from the autocomplete object.
				var place = autocomplete.getPlace();
				
				for (var component in componentForm) {
					console.log(document.getElementById(component).value);
					document.getElementById(component).value = '';
					document.getElementById(component).disabled = false;
				}
				
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
			
			
			var shipping_address=$("#seller_address").validate({ignore: ":hidden" });
			
			
			//$("#street_number").rules("add", {required:true,maxlength: 100});
			$("#route").rules("add", {required:true,maxlength: 100});
			$("#locality").rules("add", {required:true});
			$("#postal_code").rules("add", {required:true,number:true});
			$("#administrative_area_level_1").rules("add", {required:true,maxlength:100});
			
			function delete_seller_address($id){
				var id=$id;
				
				swal({
					title: "Are you sure want to delete this Address?",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55 ",
					confirmButtonText: "Yes, delete",
					closeOnConfirm: false,
					closeOnCancel: true
				},
				
				function(){
					url = "{{URL::to('/deleteSellerAddress/')}}"+"/"+id;
					window.location = url;
					
				});
			}
			
			$(document).on('change','#shipping_country,#billing_country',function(){
				if($(this).val()!="United States"){
					$('.state_dropdown').addClass('hide');
					$('.normal-states').removeClass('hide');
					}else{
					$('.state_dropdown').removeClass('hide');
					$('.normal-states').addClass('hide');
				}
			});
			function  edit_shipping(id){
				$.ajax({
					type: 'GET',
					url: '/getAddressInfo/'+id,
					success: function(response){
						$('#shipping_address_id').val(response[0].address_id);
						$("#shipping_address_1_edit").val(response[0].address1);
						$("#shipping_address_2_edit").val(response[0].address2);
						$("#shipping_firstname_edit").val(response[0].fname);
						$("#shipping_lastname_edit").val(response[0].lname);
						$("#shipping_city_edit").val(response[0].city);
						$("#shipping_postcode_edit").val(response[0].zip_code);
						$("#shipping_state_dropdown_edit").val(response[0].state);
						$("#shipping_state_hidden_edit").val(response[0].state);
						
					}
				});	
				$("#shipping_popup_edit").modal("show");
			}
			function  edit_billing(id){
				$.ajax({
					type: 'GET',
					url: '/getAddressInfo/'+id,
					success: function(response){
						$('#billing_address_id').val(response[0].address_id);
						$("#billing_address_1_edit").val(response[0].address1);
						$("#billing_address_2_edit").val(response[0].address2);
						$("#billing_firstname_edit").val(response[0].fname);
						$("#billing_lastname_edit").val(response[0].lname);
						$("#billing_city_edit").val(response[0].city);
						$("#billing_postcode_edit").val(response[0].zip_code);
						$("#billing_state_dropdown_edit").val(response[0].state);
						$("#billing_state_hidden_edit").val(response[0].state);
						
					}
				});	
				$("#billing_popup_edit").modal("show");
			}
			
			function delete_address($id){
				var id=$id;
				
				swal({
					title: "Are you sure want to delete this Address?",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55 ",
					confirmButtonText: "Yes, delete",
					closeOnConfirm: false,
					closeOnCancel: true
				},
				
				function(){
					url = "{{URL::to('/deleteaddress/')}}"+"/"+id;
					window.location = url;
					
				});
			}
			
			function deleteccard($id){
				var id=$id;
				
				swal({
					title: "Are you sure want to delete this Card?",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55 ",
					confirmButtonText: "Yes, delete",
					closeOnConfirm: false,
					closeOnCancel: true
				},
				
				function(){
					url = "{{URL::to('/deleteccard/')}}"+"/"+id;
					window.location = url;
					
				});
			}
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip(); 
				
				$('#shipping_popup_add').click(function(){
					$('#shipping_popup').css('display','block');
					$('#shipping_popup').addClass('in');
					$('#shipping_popup_add').append('<div class="modal-backdrop fade in"></div>');
				});
				$('#billing_popup_add').click(function(){
					$('#billing_popup').css('display','block');
					$('#billing_popup').addClass('in');
					$('#billing_popup_add').append('<div class="modal-backdrop fade in"></div>');
				});
				$('#shipping_close,#shi_close,#billing_close,#bil_close').click(function(){
					$('#shipping_popup,#billing_popup,#shipping_popup_edit,#billing_popup_edit').css('display','none');
					$('#shipping_popup,#billing_popup,#shipping_popup_edit,#billing_popup_edit').removeClass('in');
					$('.modal-backdrop').remove();
				});
				var cc_details=$("#cc_dashboard_form").validate();
				$("#cardholder_name").rules("add", {required:true,maxlength: 50});
				$("#exp_month").rules("add", {required:true});
				$("#exp_year").rules("add", {required:true});
				$("#cc_number").rules("add", {required:true,cc_chk:true});
				$("#cvn_pin").rules("add", {required: true,number:true,minlength:3,maxlength: 4});
				
			});
			jQuery.validator.addMethod("cc_chk", function(value, element) 
			{
				
				result = $('#cc_number').validateCreditCard();
				
				if(result.valid  == true)
				{
					
					var name 		= result.card_type.name
					
					if(name == 'amex')
					{
						name = 'American Express';	
					}
					else if(name == 'visa')
					{
						name = 'Visa';	
					}
					else if(name == 'mastercard')
					{
						name = 'MasterCard';	
					}		
					
					
					
					return true;
				}
				else
				{
					$.validator.messages.cc_chk =  "Please enter valid credit card.";
					
					return false;
				}
				
				
				
				
				
			}, 	 $.validator.messages.cc_chk);
			input_credit_card = function(input)
			{
				var format_and_pos = function(char, backspace)
				{
					var start = 0;
					var end = 0;
					var pos = 0;
					var separator = " ";
					var value = input.value;
					
					if (char !== false)
					{
						start = input.selectionStart;
						end = input.selectionEnd;
						
						if (backspace && start > 0) // handle backspace onkeydown
						{
							start--;
							
							if (value[start] == separator)
							{ start--; }
						}
						// To be able to replace the selection if there is one
						value = value.substring(0, start) + char + value.substring(end);
						
						pos = start + char.length; // caret position
					}
					
					var d = 0; // digit count
					var dd = 0; // total
					var gi = 0; // group index
					var newV = "";
					var groups = /^\D*3[47]/.test(value) ? // check for American Express
					[4, 6, 5] : [4, 4, 4, 4];
					
					for (var i = 0; i < value.length; i++)
					{
						if (/\D/.test(value[i]))
						{
							if (start > i)
							{ pos--; }
						}
						else
						{
							if (d === groups[gi])
							{
								newV += separator;
								d = 0;
								gi++;
								
								if (start >= i)
								{ pos++; }
							}
							newV += value[i];
							d++;
							dd++;
						}
						if (d === groups[gi] && groups.length === gi + 1) // max length
						{ break; }
					}
					input.value = newV;
					
					if (char !== false)
					{ input.setSelectionRange(pos, pos); }
				};
				
				input.addEventListener('keypress', function(e)
				{
					var code = e.charCode || e.keyCode || e.which;
					
					// Check for tab and arrow keys (needed in Firefox)
					if (code !== 9 && (code < 37 || code > 40) &&
					// and CTRL+C / CTRL+V
					!(e.ctrlKey && (code === 99 || code === 118)))
					{
						e.preventDefault();
						
						var char = String.fromCharCode(code);
						
						// if the character is non-digit
						// OR
						// if the value already contains 15/16 digits and there is no selection
						// -> return false (the character is not inserted)
						
						if (/\D/.test(char) || (this.selectionStart === this.selectionEnd &&
						this.value.replace(/\D/g, '').length >=
						(/^\D*3[47]/.test(this.value) ? 15 : 16))) // 15 digits if Amex
						{
							return false;
						}
						format_and_pos(char);
					}
				});
				
				// backspace doesn't fire the keypress event
				input.addEventListener('keydown', function(e)
				{
					if (e.keyCode === 8 || e.keyCode === 46) // backspace or delete
					{
						e.preventDefault();
						format_and_pos('', this.selectionStart === this.selectionEnd);
					}
				});
				
				input.addEventListener('paste', function()
				{
					// A timeout is needed to get the new value pasted
					setTimeout(function(){ format_and_pos(''); }, 50);
				});
				
				input.addEventListener('blur', function()
				{
					// reformat onblur just in case (optional)
					format_and_pos(this, false);
				});
			};
			
			input_credit_card(document.getElementById('cc_number'));	
		</script>
	</section>
	<script>
		$('.camera-icon').bind("click" , function () {
			$('#profile_logo').click();
		});	
		function readURL(input) {
			
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					$('.fileupload').attr('style', 'background-image: url('+e.target.result+')');
					//style="background-image: url(e.target.result)
				}
				
				$('#profile_X').css('display','block');
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$("#profile_logo").change(function(){
			readURL(this);
		});
		$('#profile_X').click(function(){
			$('#img-chan').val('');
			$('.fileupload').attr('style', 'background-image: url({{asset("/img/default.png")}})');
			$('#profile_X').css('display','none');
		});
	</script>
	
	@stop
	

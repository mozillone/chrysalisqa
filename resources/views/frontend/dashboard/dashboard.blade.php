@extends('/frontend/app')
@section('styles')
@endsection
@section('content')
	<section class="content create_section_page">
 <div class="container">
	<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
        	<h1>Dashboard</h1>
        </div>
    </div>
 </div>
</section>    
	<section class="content create_section_page">
		<div class="row">
			<div class="col-md-12 col-sm-12">
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
			</div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="dashboard-top-box">
					<p class="left_heading"><span>MY ACCOUNT</span> Keep your account info up to date for a smooth checkout process!</p>
					<p class="right_heading">
						<span class="my_msg"> My Messages</span>
						<span class="my_facvrs"> My Favorites</span>
					</p>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="dashboard-boxs">
				<div class="col-md-6">
					<div class="dashboad_left_side">
						<div class="panel panel-default">
							<div class="panel-heading">PROFILE DETAILS</div>
							<div class="panel-body p_details">
								<form id="edit_customer" class="form-horizontal defult-form" action="{{route('edit-profile')}}" method="POST" novalidate enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								 <div class="col-md-12">
          <h2 class="heading-agent">Profile Image</h2>
          <div class="col-md-12">
            <div class="form-group">
              
              <div class="fileupload fileupload-new" data-provides="fileupload"> 
                <img  @if(empty(Auth::user()->user_img)) src="{{asset('/img/default.png')}}" @else src="/profile_img/{{Auth::user()->user_img}}" @endif class="img-pview img-responsive" id="img-chan" name="img-chan">
                <span class="remove_pic">
                  <i class="fa fa-times-circle" aria-hidden="true"></i>
                </span>
			<div class="row upload_bx">
			<div class="col-md-8 col-sm-10 col-xs-12">
				<div class=" upload_btns">
                <span class=" btn-file">
                  <span class="fileupload-exists"></span>     
                  <input id="profile_logo" name="avatar" type="file" placeholder="Profile Image" class="form-control">
                  <input type="hidden" name="is_removed"/>
					</span> 
					</div>
                <!--<p class="noteices-text">Note: The file could not be exceed above 3MB and allowed .JPG, .JPEG, .PNG formats only.</p> -->
				</div>
				</div>
                <span class="fileupload-preview"></span>
                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
              </div>
              <p class="error">{{ $errors->first('avatar') }}</p> 
            </div>
          </div>
        </div>
									<div class="form-group">
										<label for="title">Title</label>
										<select class="form-control" id="title">
										<option>Ms.</option>
										<option>Mr.</option>
										</select>
									</div>
									<div class="form-group">
										<label for="pwd">Username</label>
										<input type="text" class="form-control" value="{{Auth::user()->first_name}}" name="first_name" id="first_name">
									</div>
									<div class="form-group">
										<label for="text">Full Name</label>
										<input type="text" class="form-control" value="{{Auth::user()->first_name}}{{Auth::user()->last_name}}" name="last_name" id="last_name">
									</div>
									<div class="form-group">
										<label for="pwd">Password:</label>
										<input type="password" class="form-control" name="password" id="password">
									</div>
									<div class="form-group">
										<label for="pwd">Email Address</label>
										<input type="text" class="form-control" value="{{Auth::user()->email}}" name="email" id="email">
									</div>
									<div class="form-group update_btn">
										<button type="submit" class="btn btn-primary pull-right update_btn">Update</button>
									</div>
									
								</form>
								
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">PAYMENT DETAILS</div>
							<div class="panel-body pay_details">
								<div class="checkbox">
									<label><input type="checkbox">Visa ending in 1234 (default)</label>
									<p class="pymnt_right_box"><span><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span> <span><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span></p>
								</div>
								<div class="checkbox">
									<label><input type="checkbox">Amex ending in 3456</label>
									<p class="pymnt_right_box"><span><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span> <span><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span></p>
								</div>
								<div class="checkbox">
									<label><input type="checkbox">Paypal</label>
									<p class="pymnt_right_box"><span><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span> <span><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span></p>
								</div>
							</div>
							<div class="panel-heading">ADD NEW CARD</div>
							<div class="panel-body add_new_card">
								<form class="" action="{{route('creditcard-add')}}" method="POST" id="cc_dashboard_form">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="form-group">
										<label for="title">Full Name On Card</label>
										<input type="text" class="form-control" name="full_name_on_card" id="full_name_on_card">
									</div>
									<div class="col-md-6">
										<label for="pwd">Expiration Date</label>
										<div class="form-group">
										<div class="col-md-6 field-align-xs" style="padding: 0">
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
										<div class="col-md-6" style="padding: 0">
											 <select name="exp_year" class="form-control" id="exp_year">
												<option value="">YYYY</option>
												@for($i=0;$i<=30;$i++)
												<option value="{{date('Y',strtotime('now'))+$i}}">{{date('Y',strtotime('now'))+$i}}</option>
												 @endfor
											 </select>
										</div>
									</div>
									</div>
									<!-- <div class="form-group">
										<label for="pwd">Expiration Date</label>
										<input type="text" class="form-control" name="expiration_date" id="expiration_date">
									</div> -->
									<div class="form-group">
										<label for="text">Card Number</label>
										<input type="text" class="form-control" name="card_number" id="card_number">
									</div>
									<div class="form-group">
										<label for="pwd">CVN Code</label>
										<input type="password" class="form-control" name="cvn_pin" id="cvn_pin">
									</div>
									<div class="form-group">
										
									</div>
									
									<div class="form-group update_btn">
										<button class="btn btn-default">Save Card</button>
									</div>
									
								</form>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">BILLING ADDRESS</div>
							<div class="panel-body billing_addres_1">
							<?php if(isset($default_billing_address) && !empty($default_billing_address)){
								$billing_address = $default_billing_address; 
								
								//echo "<pre>";print_r($billing_address);die;
								?>
								<p class="bill_adrs">
									
									<span> {{$billing_address->fname}}{{$billing_address->lname}}<br>
										{{$billing_address->address1}}
										{{$billing_address->city}}{{$billing_address->state}}<br>
										{{$billing_address->country}}{{$billing_address->zip_code}}</span>
								</p> 
								<p class="bill_adrs_dlte">
									<span><a href="#" onclick="edit_billing({{$billing_address->address_id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span> <span><a href="#" onclick="delete_address({{$billing_address->address_id}})"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span>
								</p>
								<?php }else{
									$billing_address = "";
								} ?>
								<div class="form-group add_new_btn">
									<a type="submit" id="billing_popup_add" class="btn btn-default">Add New</a>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">SHIPPING ADDRESS</div>
							<div class="panel-body billing_addres_1">
							<?php if(isset($default_shipping_address) && !empty($default_shipping_address)){
								$shipping_address = $default_shipping_address; 
								
								//echo "<pre>";print_r($billing_address);die;
								?>
								<p class="bill_adrs">
									
									<span> {{$shipping_address->fname}}{{$shipping_address->lname}}<br>
										{{$shipping_address->address1}}
										{{$shipping_address->city}}{{$shipping_address->state}}<br>
										{{$shipping_address->country}}{{$shipping_address->zip_code}}</span>
								</p> 
								<p class="bill_adrs_dlte">
									<span><a href="#" onclick="edit_shipping({{$shipping_address->address_id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span> <span><a href="#" onclick="delete_address({{$shipping_address->address_id}})"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span>
								</p>
								<?php }else{
								$shipping_address = "";
								} ?>
								<div class="form-group add_new_btn">
									<a type="submit" class="btn btn-default" id="shipping_popup_add">Add New</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="dashboad_right_side">
						<div class="rencemt_order_table">
							<h2>RECENT ORDERS</H2>
							<table class="table table-striped">
								<thead> <tr>  <th>Date</th> <th>Order No.</th> <th>Seller</th> <th>Status</th>  </tr> </thead> 
								<tbody> <tr> <td>0/02/2017</td> <td>12345</td> <td>@mdo</td> <td>Print Label</td> </tr>
									<tr>  <td>0/02/2017</td> <td>12345</td> <td>@fat</td> <td>Deleverd</td> </tr>
									<tr>  <td>0/02/2017</td> <td>12345</td> <td>@twitter</td> <td>Deleverd</td> </tr> 
								</tbody> 
							</table>
						</div>
						<div class="rencemt_order_table">
							<h2>COSTUMES SOLD</H2>
							<table class="table table-striped">
								<thead> <tr>  <th>Date</th> <th>Order No.</th> <th>Buyer</th> <th> Status</th>  </tr> </thead> 
								<tbody> <tr> <td>0/02/2017</td> <td>12345</td> <td>@mdo</td> <td>Print Label</td> </tr>
									<tr>  <td>0/02/2017</td> <td>12345</td> <td>@fat</td> <td>Deleverd</td> </tr>
									<tr>  <td>0/02/2017</td> <td>12345	</td> <td>@twitter</td> <td>Deleverd</td> </tr> 
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
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_firstname" placeholder="First Name *" name="firstname" value="{{Auth::user()->first_name}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_lastname" placeholder="Last Name" name="lastname" value="{{Auth::user()->last_name}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_address_1" placeholder="Address1 *" name="address_1">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_address_2" placeholder="Address2" name="address_2">
								</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_city" placeholder="City *" name="city">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_postcode" placeholder="Zipcode *" name="postcode">
									</div>
								</div>
								<div class="col-md-6">
										<div class="form-group">
											<select class="form-control state_dropdown" name="shiping_state_dropdown" id="billing_state_dropdown">
												<option value="" selected>State</option>
												@foreach($states as $st)
												<option value="{{$st->name}}">{{$st->name}}</option>
												@endforeach

											</select>
											<input type="text" class="form-control normal-states hide" id="shipping_state" placeholder="State *" name="state">
										</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<select class="form-control" name="country" id="shipping_country">
												<option value="" selected> Select</option>
												@foreach($countries as $cnt)
												<option value="{{$cnt->country_name}}" @if($cnt->id=="230") selected @endif>{{$cnt->country_name}}</option>
												@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group checkbox-align">
										<input type="checkbox" class="form-control" id="is_billing" name="is_billing"><label for="billing:use_for_shipping_yes">Bill to this address</label>
									</div>
								</div>
								<div class="col-md-12">
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
       <form class="" action="{{route('shipping-address')}}" method="POST" id="shipping_address">   
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <input type="hidden" name="is_edit" value="yes">
					
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="chek-out">
							<div class="new_address">
							<div class="address-form">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_firstname" placeholder="First Name *" name="firstname" value="{{Auth::user()->first_name}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_lastname" placeholder="Last Name" name="lastname" value="{{Auth::user()->last_name}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_address_1" placeholder="Address1 *" name="address_1" value="@if (!empty($shipping_address->address1)){{$shipping_address->address1}} @endif">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_address_2" placeholder="Address2" name="address_2" value="@if (!empty($shipping_address->address2)){{$shipping_address->address2}}@endif">
								</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_city" placeholder="City *" name="city" value="@if (!empty($shipping_address->city)){{$shipping_address->city}}@endif">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="shipping_postcode" placeholder="Zipcode *" name="postcode" value="@if (!empty($shipping_address->zip_code)){{$shipping_address->zip_code}}@endif">
									</div>
								</div>
								<div class="col-md-6">
										<div class="form-group">
											<select class="form-control state_dropdown" name="state" id="shipping_state_dropdown">
												<option value="" >State</option>
												@foreach($states as $st)
												<option value="{{$st->name}}">{{$st->name}}</option>
												@endforeach

											</select>
											<input type="text" class="form-control normal-states hide" id="shipping_state" placeholder="State *" name="state">
										</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<select class="form-control" name="country" id="shipping_country">
												<option value="" selected> Select</option>
												@foreach($countries as $cnt)
												<option value="{{$cnt->country_name}}" <?php if (!empty($shipping_address->country) == $cnt->country_name) { ?> selected="selected" <?php } ?>>{{$cnt->country_name}}</option>
												@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group checkbox-align">
										<input type="checkbox" class="form-control" id="is_billing" name="is_billing"><label for="billing:use_for_shipping_yes">Bill to this address</label>
									</div>
								</div>
								<div class="col-md-12">
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
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_firstname" placeholder="First Name *" name="firstname" value="{{Auth::user()->first_name}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_lastname" placeholder="Last Name" name="lastname" value="{{Auth::user()->last_name}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_address_1" placeholder="Address1 *" name="address_1">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_address_2" placeholder="Address2" name="address_2">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_city" placeholder="City *" name="city">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_postcode" placeholder="Zipcode *" name="postcode">
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
									<div class="col-md-6">
										<div class="form-group">
											<select class="form-control" name="country" id="billing_country">
													<option value="" selected> Select</option>
													@foreach($countries as $cnt)
													<option value="{{$cnt->country_name}}" @if($cnt->id=="230") selected @endif>{{$cnt->country_name}}</option>
													@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group checkbox-align">
											<input type="checkbox" class="form-control" id="is_shipping" name="is_shipping"><label for="billing:use_for_shipping_yes">Ship to this address</label>
										</div>
									</div>
									<div class="col-md-12">
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
       <form class="" action="{{route('billing-address')}}" method="POST" id="billing_address">   
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <input type="hidden" name="is_edit" value="yes">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="chek-out">
							<div class="new_address">
								<div class="address-form">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_firstname" placeholder="First Name *" name="firstname" value="{{Auth::user()->first_name}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_lastname" placeholder="Last Name" name="lastname" value="{{Auth::user()->last_name}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_address_1" placeholder="Address1 *" name="address_1" value="@if (isset($billing_address->address1)){{$billing_address->address1}}@endif">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_address_2" placeholder="Address2" name="address_2" value="@if (isset($billing_address->address2)){{$billing_address->address2}}@endif">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_city" placeholder="City *" name="city" value="@if (isset($billing_address->city)){{$billing_address->city}}@endif">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="billing_postcode" placeholder="Zipcode *" name="postcode" value="@if (isset($billing_address->zip_code)){{$billing_address->zip_code}}@endif">
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
									<div class="col-md-6">
										<div class="form-group">
											<select class="form-control" name="country" id="billing_country">
													<option value="" selected> Select</option>
													@foreach($countries as $cnt)
													<option value="{{$cnt->country_name}}" <?php if (!empty($billing_address->country) == $cnt->country_name) { ?> selected="selected" <?php } ?>>{{$cnt->country_name}}</option>
													@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group checkbox-align">
											<input type="checkbox" class="form-control" id="is_shipping" name="is_shipping"><label for="billing:use_for_shipping_yes">Ship to this address</label>
										</div>
									</div>
									<div class="col-md-12">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								
									
								</div>
							</div>
		
								
							
					</div>
				</div>
			</form>  
      </div>
      <div class="modal-footer">
        <button type="button" class="close close-btn" data-dismiss="modal"><span>×</span> Close</button>
      </div>
    </div>

</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).on('change','#shipping_country,#billing_country',function(){
		if($(this).val()!="United States"){
			$('.state_dropdown').addClass('hide');
			$('.normal-states').removeClass('hide');
		}else{
			$('.state_dropdown').removeClass('hide');
			$('.normal-states').addClass('hide');
		}
});
function  edit_shipping($id){
	$('#shipping_popup_edit').css('display','block');
	$('#shipping_popup_edit').addClass('in');
	$('#shipping_popup_add').append('<div class="modal-backdrop fade in"></div>');
	}
function  edit_billing($id){
	$('#billing_popup_edit').css('display','block');
	$('#billing_popup_edit').addClass('in');
	$('#billing_popup_add').append('<div class="modal-backdrop fade in"></div>');
	}
function  delete_address($id){
	var id = $id;
	if (confirm("Are you sure?")) {
		$.ajax({
		 url: "{{URL::to('/deleteaddress')}}",
		 type: "POST",
		 data: {'id':id},
		 success: function(data){
		 	if (data == "success") {
		 		window.location.href = "{{URL::to('/dashboard')}}";
		 	}
		 }});
	    }
	    return false;
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
		$("#full_name_on_card").rules("add", {required:true,maxlength: 50});
		$("#exp_month").rules("add", {required:true});
		$("#exp_year").rules("add", {required:true});
		$("#card_number").rules("add", {required:true,cc_chk:true});
		$("#cvn_pin").rules("add", {required: true,number:true,minlength:3,maxlength: 4});

	});
			
	</script>
</section>

@stop


@extends('/frontend/app')
@section('styles')
<style type="text/css">
	.chek-out .form-group {
    width: 45%;
    float: left;
    margin-right: 20px;
}

</style>
  @endsection
@section('content')
 <div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="checkout_page_total">
						<h1>Checkout</h1>
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
						<form action="/checkout/placeorder" method="POST" id="placeorder">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-9 col-sm-8 col-xs-12">
								<div class="check_out_page_left">
									<h2>Review Your Order</h2>
									<div class="well">
										<div class="row">
											<div class="shipping_div methods">
												<div class="col-md-4 col-sm-4 col-xs-12">
													<h4>Shipping Adress:</h4>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
													@if(!empty($data['cart_shipping_address']))
														<div class="shipping_add">
															<p>{{$data['cart_shipping_address'][0]->shipping_address_1}},<br>
															{{$data['cart_shipping_address'][0]->shipping_address_2	}}<br>
															{{$data['cart_shipping_address'][0]->shipping_city	}},{{$data['cart_shipping_address'][0]->shipping_state}},{{$data['cart_shipping_address'][0]->shipping_postcode}},{{$data['cart_shipping_address'][0]->shipping_country}} <br></p>
														</div>
													@else
													@if(!empty($data['shipping_address']))
														<div class="shipping_add">
															<p>{{$data['shipping_address'][0]->address1}},<br>
															{{$data['shipping_address'][0]->address2}}<br>
															{{$data['shipping_address'][0]->city}},{{$data['shipping_address'][0]->state}},{{$data['shipping_address'][0]->zip_code}},{{$data['shipping_address'][0]->country}} <br></p>
														</div>
													@else
														<div class="shipping_add"></div>
														<span class="shipping-empty">No Shipping Address Found</span>
													@endif
													@endif
													
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
													@if(!empty($data['shipping_address']) || !empty($data['cart_shipping_address']))
														<p class="cehck_edit"><a href="javascript::void(0);" class="shipping_popup">Edit</a></p>
													@else
														<p class="cehck_edit" data-toggle="modal" data-target="#shipping_popup"><a href="javascript::void(0);" class="shipping_popup">New</a></p>
													@endif
												</div>
											</div>
											<div class="billing_div methods">
												<div class="col-md-4 col-sm-4 col-xs-12">
													<h4>Billing Adress:</h4>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
												@if(!empty($data['cart_billing_address']))
													<div class="billing_add">
														<p>{{$data['cart_billing_address'][0]->pay_address_1}},<br>
														{{$data['cart_billing_address'][0]->pay_address_2}}<br>
														{{$data['cart_billing_address'][0]->pay_city}},{{$data['cart_billing_address'][0]->pay_state}},{{$data['cart_billing_address'][0]->pay_zipcode}},{{$data['cart_billing_address'][0]->pay_country}} <br>
														</p>
													</div>
												@else
												@if(!empty($data['billing_address']))
													<div class="billing_add">
														<p>{{$data['billing_address'][0]->address1}},<br>
														{{$data['billing_address'][0]->address2}}<br>
														{{$data['billing_address'][0]->city}},{{$data['billing_address'][0]->state}},{{$data['billing_address'][0]->zip_code}},{{$data['billing_address'][0]->country}} <br>
														</p>
													</div>
												@else
													<div class="billing_add"></div>
													<span class="shipping-empty">No Billing Address Found</span>
												@endif
												@endif
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
												@if(!empty($data['billing_address']) || !empty($data['cart_billing_address']))
													<p class="cehck_edit"><a href="javascript::void(0);" class="billing_popup">Edit</a></p>
												@else
													<p class="cehck_edit"><a href="javascript::void(0);" class="billing_popup">New</a></p>
												@endif
												</div>
											</div>
											<div class="payment_div methods">
												<div class="col-md-4 col-sm-4 col-xs-12">
														<h4>Payment Method:</h4>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
												@if(!empty($data['cart_cc_details']))
													<p class="card_exp">Ending in {{$data['cart_cc_details'][0]->exp_year}}</p>
												@else
													@if(!empty($data['cc_details']))
														<p class="card_exp">Ending in {{$data['cc_details'][0]->exp_year}}</p>
													@else
														<p class="card_exp"></p>
														<span class="payment-empty">No Payment Method Found</span>
													@endif
												@endif
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
													@if(!empty($data['cc_details']) || !empty($data['cart_cc_details']))
														<p class="cehck_edit"><a href="javascript::void(0);" class="cc_popup">Edit</a></p>
													@else
														<p class="cehck_edit"><a href="javascript::void(0);" class="cc_popup">New</a></p>
													@endif
												</div>
										</div>
									</div>
									</div>	
									<div class="checkout_review_box">
										<h2>Review Shipping & Delivery Time</h2>
										@foreach($data['basic']['basic'] as $cart)
										<div class="well">
											 <div class="shipping_date">
												<span>Free Shipping from Chrysalis, NY <span class="in_prc">($0.00)</span></span><span class="shi_date_right text-right right"> Estimated Shipping from Brooklyn, NY <i class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" title="Hooray!"></i></span>
											</div>
											<div class="row">
												<div class="col-md-9 col-sm-9 col-xs-12">
													<div class="media">
														<div class="media-left">
															@if($cart->image!=null && file_exists(public_path('/costumers_images/Medium/'.$cart->image)))<img src="costumers_images/Medium/{{$cart->image}}" class="media-object"> @else <img src="costumers_images/default-placeholder.jpg" class="media-object"> @endif
														</div>
														<div class="media-body">
															<h4 class="media-heading"><a href="/product{{$cart->url_key}}">{{$cart->costume_name}}</a></h4>
															<p>@if($cart->is_film=="yes")<p class="f_quality1">Film Quality</p> @else  @endif</p>
															<p><b>Item Condition:</b> {{ucwords(str_replace('_', ' ',$cart->condition))}}</p>
															<p><b>Size:</b> Small</p>
															<p class="upload_id">Uploaded by<span> {{$cart->user_name}}</span></p>
														</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-3 col-xs-12">
													<p class="price_right text-right"><span class="check_price">@if($cart->created_user_group=="admin" && $cart->discount!=null && $cart->uses_customer<$cart->uses_total && date('Y-m-d H:i:s')>=$cart->date_start && date('Y-m-d H:i:s')<=$cart->date_end)
														<?php $discount=($cart->price/100)*$cart->discount;
															   $new_price=$cart->price-$discount;
													    ?>
													  @else
															 <?php $new_price=$cart->price;?>
													@endif
													${{number_format(($cart->qty)*($new_price), 2, '.', ',')}}</span>
													<span><a href="/cart/delete/{{$cart->cart_item_id}}/{{$cart->cart_id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></span></p>
												</div>
											</div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<div class="check_out_page_right">
									<div class="order_summery">
										<div class="well">
											<h3>Order Summary  </h3> 
											<p class="sub-all"><span>Subtotal: </span> <span class="sub-price">${{number_format($data['basic']['basic'][0]->total, 2, '.', ',')}} <em>({{count($data['basic'])}} Items)</em></span></p>
											@if(!empty($data['basic']['dis_count'])) <p class="sub-all"><span>Shipping: </span> <span class="sub-price">-${{$data['basic']['dis_total']}} <em>({{$data['basic']['dis_count']}} Items)</em></span></p>@endif
											<!-- <p class="sub-all s_credit"><span>Store Credit Apllied: </span> <span class="sub-price">$0.00 </span></p> -->
											<p class="sub-all total_price"><span>Total: </span> <span class="sub-price">@if(!empty($data['basic']['dis_count']))${{number_format($data['basic']['basic'][0]->total-$data['basic']['dis_total'], 2, '.', ',')}} @else ${{number_format($data['basic']['basic'][0]->total, 2, '.', ',')}}@endif </span></p>
											<button class="btn btn-primary">Place Order</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
<div class="modal fade window-popup" id="shipping_popup" tabindex="-1">
	<div class="modal-dialog shopping-address-modal">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Shipping Address</h4>
	      </div>
	      <div class="modal-body">
	       <form class="" action="javascript::void(0);" method="POST" id="shipping_address">   
	       <input type="hidden" name="_token" value="{{ csrf_token() }}">
	       <input type="hidden" name="cart_id" value="{{ $data['basic']['basic'][0]->cart_id}}">
						
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="chek-out">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<label for="">Choose Saved</label>
											<select class="form-control shpng-adr-mdl-seletor"  name="address_id" id="shipping">
											</select>
									</div>
								<div class="new_address">
								<div class="text-center">
									<p>Or</p>
								</div>
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
												<input type="text" class="form-control" id="shipping_state" placeholder="State *" name="state">
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
	        <button type="button" class="close close-btn" data-dismiss="modal"><span>×</span> Close</button>
	      </div>
	    </div>

	</div>
</div>
<div class="modal fade window-popup" id="billing_popup" tabindex="-1">
	<div class="modal-dialog shopping-address-modal">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Billing Address</h4>
	      </div>
	      <div class="modal-body">
	       <form class="" action="javascript::void(0);" method="POST" id="billing_address">   
	       <input type="hidden" name="_token" value="{{ csrf_token() }}">
		   <input type="hidden" name="cart_id" value="{{ $data['basic']['basic'][0]->cart_id}}">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="chek-out">
								<div class="col-md-12 col-sm-12 col-xs-12">
											<label for="">Choose Saved</label>
											<select class="form-control shpng-adr-mdl-seletor" id="billing">
											</select>
								</div>
								<div class="new_address">
									<div class="text-center">
										<p>Or</p>
									</div>
									
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
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_state" placeholder="State *" name="state">
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
	        <button type="button" class="close close-btn" data-dismiss="modal"><span>×</span> Close</button>
	      </div>
	    </div>

	</div>
</div>
<div class="modal fade window-popup" id="cc_popup" tabindex="-1">
	<div class="modal-dialog  shopping-address-modal">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Payment Method</h4>
	      </div>
	      <div class="modal-body">
	       <form class="" action="javascript::void(0);" method="POST" id="cc_form">   
	       <input type="hidden" name="_token" value="{{ csrf_token() }}">
		   <input type="hidden" name="cart_id" value="{{ $data['basic']['basic'][0]->cart_id}}">
		   	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="chek-out">
								<div class="col-md-12 col-sm-12 col-xs-12">
											<label for="">Choose Saved</label>
											<select class="form-control shpng-adr-mdl-seletor" id="cc_list">
											</select>
								</div>
								<div class="new_cc">
								<div class="text-center">
									<p>Or</p>
								</div>
								<div class="address-form">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="cardholder_name" placeholder="Full Name on Card *" name="cardholder_name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="cc_number" placeholder="Card Number *" name="cc_number">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 field-align-xs">
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
										<div class="col-md-6">
											 <select name="exp_year" class="form-control" id="exp_year">
												<option value="">YYYY</option>
												@for($i=0;$i<=30;$i++)
												<option value="{{date('Y',strtotime('now'))+$i}}">{{date('Y',strtotime('now'))+$i}}</option>
												 @endfor
											 </select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="cvn_pin" placeholder="CVN Code*" name="cvn_pin">
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
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/placeorder.js') }}"></script>
<script src="{{ asset('/js/credit-card-validation.js') }}"></script>

@stop

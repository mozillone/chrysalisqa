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
						<form action="/checkout/placeorder" method="POST" id="placeorder">
						<div class="row">
							<div class="col-md-9 col-sm-8 col-xs-12">
								<div class="check_out_page_left">
									<h2>Review Your Order</h2>
									<div class="well">
										<div class="row">
											<div class="shipping_div methods">
												<div class="">
													<h4>Shipping Adress:</h4>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="chek-out">
																<div class="form-group">
																	<input type="text" class="form-control" id="shipping_firstname" placeholder="First Name *" name="shipping_firstname">
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" id="shipping_lastname" placeholder="Last Name" name="shipping_lastname">
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" id="shipping_address_1" placeholder="Address1 *" name="shipping_address_1">
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" id="shipping_address_2" placeholder="Address2" name="shipping_address_2">
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" id="shipping_city" placeholder="City *" name="shipping_city">
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" id="shipping_postcode" placeholder="Zipcode *" name="shipping_postcode">
																</div>
																<div class="form-group">
																<select class="form-control" name="shipping_country" id="shipping_country">
																		<option value="" selected> Select</option>
																		@foreach($countries as $cnt)
																		<option value="{{$cnt->id}}" @if($cnt->id=="230") selected @endif>{{$cnt->country_name}}</option>
																		@endforeach
																</select>
																</div>
																	
																
														</div>
												</div>
											</div>
											<div class="billing_div methods">
												<div class="col-md-4 col-sm-4 col-xs-12">
													<h4>Billing Adress:</h4>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="chek-out">
																<div class="form-group">
																	<input type="text" class="form-control" id="pay_firstname" placeholder="First Name *" name="pay_firstname">
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" id="pay_lastname" placeholder="Last Name" name="pay_lastname">
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" id="pay_address_1" placeholder="Address1 *" name="pay_address_1">
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" id="pay_address_2" placeholder="Address2" name="pay_address_2">
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" id="pay_city" placeholder="City *" name="pay_city">
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" id="pay_zipcode" placeholder="Zipcode *" name="pay_zipcode">
																</div>
																<div class="form-group">
																<select class="form-control" name="pay_country" id="pay_country">
																		<option value="" selected> Select</option>
																		@foreach($countries as $cnt)
																		<option value="{{$cnt->id}}" @if($cnt->id=="230") selected @endif>{{$cnt->country_name}}</option>
																		@endforeach
																</select>
																</div>
																	
																
														</div>
												</div>
											</div>
											<div class="payment_div methods">
											<div class="col-md-4 col-sm-4 col-xs-12">
													<h4>Payment Method:</h4>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="">
																<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<label for="title">Full Name On Card</label>
																	<input type="text" class="form-control" id="cardholder_name" name="cardholder_name">
																</div>
																<div class="form-group">
																	<label for="pwd">Expiration Date</label>
																	<input type="text" class="form-control" id="cc_exp" name="cc_exp">
																</div>
																</div>
																<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<label for="text">Card Number</label>
																	<input type="text" class="form-control" id="cc_number" name="cc_number">
																</div>
																<div class="form-group">
																	<label for="pwd">CVN Code</label>
																	<input type="text" class="form-control" id="cc_cvn" name="cc_cvn">
																</div>
																<div class="form-group">
																	
																</div>
																
																</div>
																
														</div>
												</div>
											</div>
										</div>
									</div>
									<div class="checkout_review_box">
										<h2>Review Shipping & Delivery Time</h2>
										@foreach($data as $cart)
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
													<p class="price_right text-right"><span class="check_price">${{number_format(($cart->qty)*($cart->price), 2, '.', ',')}}</span>
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
											<p class="sub-all"><span>Subtotal: </span> <span class="sub-price">${{number_format($data[0]->total, 2, '.', ',')}} <em>({{count($data)}} Items)</em></span></p>
											<p class="sub-all"><span>Shipping: </span> <span class="sub-price">$0.00 <em>(0 Items)</em></span></p>
											<p class="sub-all s_credit"><span>Store Credit Apllied: </span> <span class="sub-price">$0.00 </span></p>
											<p class="sub-all total_price"><span>Total: </span> <span class="sub-price">${{number_format($data[0]->total, 2, '.', ',')}} </span></p>
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
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/placeorder.js') }}"></script>

@stop

@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="{{ asset('/assets/frontend/css/pages/checkout.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
  @endsection
@section('content')
 <div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="checkout_page_total checkout-content">
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
													<h4>Shipping Address:</h4>
												</div>
												<div class="col-md-5 col-sm-4 col-xs-10">
													@if(!empty($data['cart_shipping_address']))
													<input type="hidden" value="{{$data['cart_shipping_address'][0]->shipping_address_2}}" name="shipping_address_2" data-cart="true"data-address="{{json_encode($data['cart_shipping_address'][0])}}">
														<div class="shipping_add">
															<p>@if(!empty($data['cart_shipping_address'][0]->shipping_address_1)){{$data['cart_shipping_address'][0]->shipping_address_1}}<br>@endif
															@if(!empty($data['cart_shipping_address'][0]->shipping_address_2)){{$data['cart_shipping_address'][0]->shipping_address_2}}<br>@endif 
															{{$data['cart_shipping_address'][0]->shipping_city	}}, {{$data['cart_shipping_address'][0]->shipping_state}} {{$data['cart_shipping_address'][0]->shipping_postcode}}<br></p>
														</div>
													@else
													@if(!empty($data['shipping_address']))
													<input type="hidden"  value="{{$data['shipping_address'][0]->address2}}" name="shipping_address_2" data-cart="false" data-address="{{json_encode($data['shipping_address'][0])}}">
														<div class="shipping_add">
															<p>@if(!empty($data['shipping_address'][0]->address1)){{$data['shipping_address'][0]->address1}}<br>@endif
															@if(!empty($data['shipping_address'][0]->address2)){{$data['shipping_address'][0]->address2}}<br>@endif 
															{{$data['shipping_address'][0]->city}}, {{$data['shipping_address'][0]->state}} {{$data['shipping_address'][0]->zip_code}}<br></p> 
														</div>
													@else
														<input type="hidden"  name="shipping_address_2">
														<div class="shipping_add"></div>
														<span class="shipping-empty">No Shipping Address Found</span>
													@endif
													@endif
													<span class="error">{{ $errors->first('shipping_address_1') }}</span>
													
												</div>
												<div class="col-md-3 col-sm-4 col-xs-2">
													@if(!empty($data['shipping_address']) || !empty($data['cart_shipping_address']))
														<p class="cehck_edit"><a href="javascript::void(0);" class="shipping_popup" data-address-id="">Edit</a></p>
													@else
														<p class="cehck_edit" data-toggle="modal" data-target="#shipping_popup"><a href="javascript::void(0);" class="shipping_popup">New</a></p>
													@endif
													<span class="error shipping-error"></span>
												</div>
												
											</div>
											<div class="billing_div methods">
												<div class="col-md-4 col-sm-4 col-xs-12">
													<h4>Billing Address:</h4>
												</div>
												<div class="col-md-5 col-sm-4 col-xs-10">
												@if(!empty($data['cart_billing_address']))
												<input type="hidden" name="pay_address_2" value="{{$data['cart_billing_address'][0]->pay_address_2}}" data-cart="true" data-address="{{json_encode($data['cart_billing_address'][0])}}"/>
													<div class="billing_add">
														<p>@if(!empty($data['cart_billing_address'][0]->pay_address_1)){{$data['cart_billing_address'][0]->pay_address_1}}<br>@endif
														@if(!empty($data['cart_billing_address'][0]->pay_address_2)){{$data['cart_billing_address'][0]->pay_address_2}}<br>@endif 
														{{$data['cart_billing_address'][0]->pay_city}}, {{$data['cart_billing_address'][0]->pay_state}} {{$data['cart_billing_address'][0]->pay_zipcode}}<br>
														</p>
													</div>
												@else
												@if(!empty($data['billing_address']))
													<input type="hidden" name="pay_address_2" value="{{$data['billing_address'][0]->address2}}" data-cart="false" data-address="{{json_encode($data['billing_address'][0])}}"/> 
													<div class="billing_add">
														<p>@if(!empty($data['billing_address'][0]->address1)){{$data['billing_address'][0]->address1}}<br>@endif
														@if(!empty($data['billing_address'][0]->address2)){{$data['billing_address'][0]->address2}}<br>@endif 
														{{$data['billing_address'][0]->city}}, {{$data['billing_address'][0]->state}} {{$data['billing_address'][0]->zip_code}}<br>
														</p>
													</div>
												@else
													<input type="hidden"  name="pay_address_2">
													<div class="billing_add"></div>
													<span class="billing-empty">No Billing Address Found</span>
												@endif
												@endif
												<span class="error">{{ $errors->first('pay_address_1') }}</span>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-2">
												@if(!empty($data['billing_address']) || !empty($data['cart_billing_address']))
													<p class="cehck_edit"><a href="javascript::void(0);" class="billing_popup">Edit</a></p>
												@else
													<p class="cehck_edit"><a href="javascript::void(0);" class="billing_popup">New</a></p>
												@endif
												<span class="error billing-error"></span>
												</div>
												
											</div>
											<div class="payment_div methods">
												<div class="col-md-4 col-sm-4 col-xs-12">
														<h4>Payment Method:</h4>
												</div>
												<div class="col-md-5 col-sm-6 col-xs-12">
												@if(!empty($data['cart_cc_details']))
												<input type="hidden" name="card_id" value="{{$data['cart_cc_details'][0]->id}}"/> 
													<p class="card_exp">@if($data['cart_cc_details'][0]->card_type=="Visa") <img src="/img/visa.png">  @elseif($data['cart_cc_details'][0]->card_type=="American Express") <img src="/img/americanexpress.png"> @elseif($data['cart_cc_details'][0]->card_type=="MasterCard") <img src="/img/mastercard.png"> @endif Ending in {{$data['cart_cc_details'][0]->last_digits}}</p>
												@else
													@if(!empty($data['cc_details']))
													<input type="hidden" name="card_id" value="{{$data['cc_details'][0]->id}}"/>
														<p class="card_exp"> @if($data['cc_details'][0]->card_type=="Visa") <img src="/img/visa.png">  @elseif($data['cc_details'][0]->card_type=="American Express") <img src="/img/americanexpress.png"> @elseif($data['cc_details'][0]->card_type=="MasterCard") <img src="/img/mastercard.png"> @endif  Ending in {{$data['cc_details'][0]->last_digits}}</p>
													@else
														<input type="hidden"  name="card_id">
														<p class="card_exp"></p>
														<span class="payment-empty">No Payment Method Found</span>
													@endif
												@endif
												<span class="error">{{ $errors->first('card_id') }}</span>
												</div>
												<div class="col-md-3 col-sm-2 col-xs-12">
													@if(!empty($data['cc_details']) || !empty($data['cart_cc_details']))
														<p class="cehck_edit"><a href="javascript::void(0);" class="cc_popup">Edit</a></p>
													@else
														<p class="cehck_edit"><a href="javascript::void(0);" class="cc_popup">New</a></p>
													@endif
												<span class="error payment-error"></span>
												</div>
												
										</div>
									</div>
									</div>	
									<div class="checkout_review_box">
										<h2>Review Shipping & Delivery Time</h2>
										<?php	  $shipping_count=0;
												  $costumes_count=0;
												  $shipping_amount=0;
												 
										?>
											@foreach($costumer_costumes as $key=>$items)
											<div class="checkout_idi_box">
												<div class="well">
													<h3>Costumes by: {{$key}}</h3>
													<?php $shipping_priority_amount=0;
												  			  $shipping_express_amount=0;
												  			  $pounds=0;
															  $ounce=0;
														?>
														<?php
																$costume_id='';
																for ($i=0; $i < count($items['products']); $i++) { 
																	$costume_id.=$items['products'][$i]->costume_id.',';
																}
																$costume_id = rtrim($costume_id,',');
															?>
													@foreach($items['products'] as $type=>$cart)
													<?php $costumes_count+=$cart->qty;
														  $shipping_amount++;
														  $pounds+=($cart->weight_pounds*$cart->qty);
														  $ounce+=($cart->weight_ounces*$cart->qty);
													?>
													@if(count($items['address']))
													<div class="shipping_date">
														  <span> Shipping from  {{$items['address'][0]->city}}, {{$items['address'][0]->state}}
														  <span class="shi_date_right shi_date_right_{{$cart->costume_id}} text-right right">
														 
														    <i class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" title=""></i>
														</span>
														</span>
													</div>
													 @endif 
													<div class="row">
												<div class="col-md-9 col-sm-9 col-xs-12">
													<div class="media">
														<div class="media-left">
															@if($cart->image!=null && file_exists(public_path('/costumers_images/Medium/'.$cart->image)))<img src="costumers_images/Medium/{{$cart->image}}" class="media-object"> @else <img src="costumers_images/default-placeholder.jpg" class="media-object"> @endif
														</div>
														<div class="media-body">
															<h4 class="media-heading"><a href="/product{{$cart->url_key}}">{{$cart->costume_name}}</a></h4>
															@if($cart->created_user_group=="admin")<span class="cc_brand"><img src="/img/chrysalis_brand.png"></span>@endif
															<p>@if($cart->is_film=="yes")<p class="f_quality"><img class="img-responsive" src="{{asset('assets/frontend/img/film.png')}}"> Film Quality</p> @else  @endif</p>
															<p><b>Item Condition:</b> {{ucwords(str_replace('_', ' ',$cart->condition))}}</p>
															<p><b>Size:</b> {{ucfirst($cart->size)}}</p>
															<p><b>Quantity:</b> {{$cart->qty}}</p>
															
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
													<span><a data-item-id="{{$cart->cart_item_id}}" data-cart_id="{{$cart->cart_id}}" class="delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span></p>
												</div>
											</div>
											<?php  $seller_id=$cart->created_by;
											//echo $seller_id;
										//die();
											?>
													@endforeach
												</div>
												<div class="pull-right">
														<h2>Select Shipping Options</h2>
														@if(empty($data['cart_shipping_address']) && empty($data['shipping_address']))
														<p>Add shipping address to display rates.Click <a href="javascript::void(0);" class="shipping_popup">here</a></p>
														@elseif(!count($items['address']))
														<span class="error seller_location" data-seller-id="{{$seller_id}}" id="seller_location_{{$seller_id}}">Seller location is not present</span> 
														@elseif(count($items['address']))
														<?php $priority_info=helper::domesticRate($items['address'][0]->zip_code,$cart->cart_id,'priority',$pounds,$ounce);
															$express_info=helper::domesticRate($items['address'][0]->zip_code,$cart->cart_id,'express',$pounds,$ounce);
													
														?>
														@if($priority_info['result']=="1")
															@if($cart->is_free  || $items['type']=="free")
															<div class="radio">
															  <label><input type="radio" name="shipping_type[{{$seller_id}}]" value="0.00_free" class="shipping_amount" data-seller-id="{{$seller_id}}" data-type='free' data-costume-id="{{$costume_id}}" data-free-value="0.00_free">Free shipping</label> <span class="shiping_amount">$0.00</span>
															</div>
															@endif
														<div class="radio">
														
														  <label><input type="radio" name="shipping_type[{{$seller_id}}]" value="{{$priority_info['msg']['rate']}}_priority" class="shipping_amount" data-seller-id="{{$seller_id}}" data-type='priority' data-shipping-days="{{$priority_info['msg']['MailService']}}" data-costume-id="{{$costume_id}}" data-priority-value="{{$priority_info['msg']['rate']}}_priority">Priority shipping</label> <span class="shiping_amount">${{number_format($priority_info['msg']['rate'], 2, '.', ',')}}</span>
														</div>
														<div class="radio">
														  <label><input type="radio" name="shipping_type[{{$seller_id}}]" value="{{$express_info['msg']['rate']}}_express" class="shipping_amount" data-seller-id="{{$seller_id}}" data-type='express' data-shipping-days="{{$express_info['msg']['MailService']}}" data-costume-id="{{$costume_id}}" data-express-value="{{$express_info['msg']['rate']}}_express">Express shipping</label> <span class="shiping_amount">${{number_format($express_info['msg']['rate'], 2, '.', ',')}}</span>
													</div>
													<span class="error" id="sipping_{{$seller_id}}"></span>
													@endif
													@if($priority_info['result']=="0" && $priority_info['error_code']=="-2147219498")
													test
													<span class="error shipping_api_errors" data-seller-id="{{$seller_id}}" id="api_error_{{$seller_id}}" data-error="Seller location is not present">Seller location is not present</span> 
													@endif
													@if($priority_info['result']=="0" && $priority_info['error_code']!="-2147219498")
													<span class="error shipping_api_errors" data-seller-id="{{$seller_id}}" id="api_error_{{$seller_id}}" data-error="{{$priority_info['msg']}}">{{$priority_info['msg']}}</span>
													@endif
													@endif
													</div>

													<div class="clearfix"></div>
											

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
											<p class="sub-all"><span>Subtotal: </span> <span class="sub-price">$<span class="sub-total sub-p" data-subtotal="{{$data['basic']['basic'][0]->total}}">{{number_format($data['basic']['basic'][0]->total, 2, '.', ',')}}</span> <em>({{$costumes_count}} Items)</em></span></p>
											<p class="sub-all"><span>Shipping: </span> <span class="sub-price">$
											<span class="shipping_total">0.00</span><em>({{$costumes_count}} Items)</em></span></p>
											@if(!empty($data['basic']['dis_count']))  <p class="sub-all"><span>Discount Amount: </span> <span class="sub-price coupan-p" data-coupan="{{$data['basic']['dis_total']}}">- ${{number_format($data['basic']['dis_total'], 2, '.', ',')}} <em>({{$data['basic']['dis_count']}} Items)</em></span></p>@endif
											<p class="sub-all s_credit"><span>Store Credit Applied: </span> <span class="sub-price str-credts" data-credits="{{$data['basic']['basic'][0]->store_credits}}">- ${{number_format($data['basic']['basic'][0]->store_credits, 2, '.', ',')}} </span></p>
											<p class="sub-all total_price"><span>Total: </span> <span class="sub-price">@if(!empty($data['basic']['dis_count']))$<span class="total-amount">{{number_format($data['basic']['basic'][0]->total-$data['basic']['dis_total']-$data['basic']['basic'][0]->store_credits, 2, '.', ',')}}</span> @else $<span class="total-amount">{{number_format($data['basic']['basic'][0]->total-$data['basic']['basic'][0]->store_credits, 2, '.', ',')}}</span>@endif </span></p>
											<button class="btn btn-primary submit-order">Place Order</button>
										</div>
										<div class="chckot_cards_imgs">
										<img class="img-responsive" src="{{asset('/assets/frontend/img/cards.png')}}">
										</div>
									</div>
								</div>
								<div class="cards-section">
									<img src="">
									
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
									<div class="col-md-12 col-sm-12 col-xs-12 shipping-dropdown">
										<label for="">Choose Saved</label>
											<select class="form-control shpng-adr-mdl-seletor"  name="address_id" id="shipping">
											</select>
									</div>
								<div class="new_address">
								<div class="text-center shipping-or">
									<p>Or</p>
								</div>
								<div class="address-form">
									<div class="col-md-6 col-sm-6 col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" id="shipping_firstname" placeholder="First Name *" name="firstname" value="{{Auth::user()->first_name}}">
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" id="shipping_lastname" placeholder="Last Name" name="lastname" value="{{Auth::user()->last_name}}">
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" id="shipping_address_2" placeholder="Street Address *" name="address_2">
									</div>
									</div>
									<div class="col-md-6 col-sm-6 col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" id="shipping_address_1" placeholder="Apt or Suite no (Optional)" name="address_1">
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" id="shipping_city" placeholder="City *" name="city">
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-sm-12">
									<div class="form-group">
												<select class="form-control state_dropdown" name="state" id="shipping_state">
													<option value="" selected>State</option>
													@foreach($states as $st)
													<option value="{{$st->name}}">{{$st->name}}</option>
													@endforeach

												</select>
											</div>
									</div>
									<div class="col-md-6 col-sm-6 col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" id="shipping_postcode" placeholder="Zipcode *" name="postcode">
										</div>	
									</div>
									
									<div class="col-md-6 col-md-6 col-xs-12">
										<div class="form-group checkbox-align">
											<input type="checkbox" class="form-control" id="is_billing" name="is_billing"><label for="billing:use_for_shipping_yes">Bill to this address</label>
										</div>
									</div>
									<div class="col-md-12 col-xs-12">
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
								<div class="col-md-12 col-sm-12 col-xs-12 billing-dropdown">
											<label for="">Choose Saved</label>
											<select class="form-control shpng-adr-mdl-seletor" name="address_id" id="billing">
											</select>
								</div>
								<div class="new_address">
									<div class="text-center billing-or">
										<p>Or</p>
									</div>
									
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
										<div class="col-md-6  col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_address_1" placeholder="Apt or Suite no (Optional)" name="address_1">
											</div>
										</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_city" placeholder="City *" name="city">
											</div>
										</div>
										<div class="col-md-6  col-sm-6 col-xs-12">
												<div class="form-group">
												<select class="form-control state_dropdown" name="state" id="billing_state">
													<option value="" selected>State</option>
													@foreach($states as $st)
													<option value="{{$st->name}}">{{$st->name}}</option>
													@endforeach

												</select>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
												<input type="text" class="form-control" id="billing_postcode" placeholder="Zipcode *" name="postcode">
										</div>
										
										</div>
											<div class="col-md-6  ship-chckbox">
											<div class="form-group checkbox-align">
												<input type="checkbox" class="form-control" id="is_shipping" name="is_shipping"><label for="billing:use_for_shipping_yes">Ship to this address</label>
											</div>
										</div>
										<div class="col-md-12 col-sm-12  col-xs-12">
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
								<div class="payment-fail"></div>
								<div class="col-md-12 col-sm-12 col-xs-12 payment-dropdown">
											<label for="">Choose Saved</label>
											<select class="form-control shpng-adr-mdl-seletor" id="cc_list">
											</select>
								</div>
								<div class="new_cc">
								<div class="text-center payment-or">
									<p>Or</p>
								</div>
								<div class="address-form">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<input type="text" class="form-control" id="cardholder_name" placeholder="Full Name on Card *" name="cardholder_name">
										</div>
									</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
				                                <select name="card_type" id="card_type"  class="form-control">
				                                    <option value="">Choose Card Type</option>
				                                    <option value="Visa">Visa</option>
				                                    <option value="American Express">American Express</option>
				                                    <option value="MasterCard">Master Card</option>
				                                </select>
				                    		<div class="col-sm-3" id="creditcardimage"></div>
				                        </div>
									</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<input type="text" class="form-control" id="cc_number" placeholder="Card Number *" name="cc_number">
										</div>
									</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
										<div class="col-md-6 col-xs-6 field-align-xs" style="padding: 0; padding-right: 5px;">
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
										<div class="col-md-6 col-xs-6" style="padding: 0; padding-left: 5px;">
											 <select name="exp_year" class="form-control" id="exp_year">
												<option value="">YYYY</option>
												@for($i=0;$i<=30;$i++)
												<option value="{{date('Y',strtotime('now'))+$i}}">{{date('Y',strtotime('now'))+$i}}</option>
												 @endfor
											 </select>
										</div>
									</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<input type="password" class="form-control" id="cvn_pin" placeholder="CVN Code*" name="cvn_pin">
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
	        <button type="button" class="close close-btn" data-dismiss="modal"><span>×</span> Close</button>
	      </div>
	    </div>

	</div>
</div>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('/assets/frontend/js/jquery-ui.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/placeorder.js') }}"></script>
<script src="{{ asset('/js/credit-card-validation.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>

@stop

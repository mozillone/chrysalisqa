@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
  @endsection
@section('content')
 <div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="cart_page_total">
						<h1>SHOPPING CART</h1>
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
						<div class="row">
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="cart_page_vew span-align">
									@if(count($data['basic']))
									<?php $shipping_amount=0;$shipping_count=0;$costumes_count=0;?>
									@foreach($data['basic'] as $cart)
									<?php $costumes_count+=$cart->qty;?>
										<div class="well">
											<div class="shipping_date">
											   <span>@if($cart->shipping!="Free Shipping" ) Expedited Shipping {{$cart->city}}, {{$cart->state}}  <span class="in_prc">@if(helper::userCartShippingAddress($cart->cart_id))
											   <?php $amount=helper::domesticRate($cart->item_location,$cart->cart_id);?>
											   @if(helper::domesticRate($cart->item_location,$cart->cart_id)['result']!="0" ) 
											         <?php $shipping_amount+=$shipping_amount+helper::domesticRate($cart->item_location,$cart->cart_id)['msg']['rate'];$shipping_count++?>
											    @endif
											    @if(helper::domesticRate($cart->item_location,$cart->cart_id)['result']!="0")
											    	({{helper::domesticRate($cart->item_location,$cart->cart_id)['msg']['rate']}})
											    @else
											    	({{helper::domesticRate($cart->item_location,$cart->cart_id)['msg']}})
											    @endif
											  @endif </span>  @else Free Shipping {{$cart->city}}, {{$cart->state}}  <span class="in_prc">($0.00)</span> @endif </span><span class="shi_date_right text-right right">@if($cart->shipping!="Free Shipping" && helper::domesticRate($cart->item_location,$cart->cart_id)['result']!="0") @if(helper::userCartShippingAddress($cart->cart_id))
											    Est delivery between {{date('D M d')}}  and {{date('D M d',strtotime('+'.helper::domesticRate($cart->item_location,$cart->cart_id)['msg']['MailService'].' day'))}}
											  <i class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" title="Hooray!"></i>  @endif @endif </span>
											</div>
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div class="media">
														<div class="media-left">
														@if($cart->image!=null && file_exists(public_path('/costumers_images/Medium/'.$cart->image)))<img src="costumers_images/Medium/{{$cart->image}}" class="media-object"> @else <img src="costumers_images/default-placeholder.jpg" class="media-object"> @endif

														</div>
														<div class="media-body">
															<h4 class="media-heading"><a href="/product{{$cart->url_key}}">{{$cart->costume_name}}</a></h4>
															@if($cart->is_film=="yes")<p class="f_quality">Film Quality</p> @else  @endif
															<p><b>Item Condition:</b> {{ucwords(str_replace('_', ' ',$cart->condition))}}</p>
															<p><b>Size:</b> {{ucfirst($cart->size)}}</p>
															<p class="upload_id"><b>Uploaded by</b><span> {{$cart->user_name}}</p>
															</div>
														</div>
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12">
													<p class="price_right text-right"><span class="check_price">@if($cart->created_user_group=="admin" && $cart->discount!=null && $cart->uses_customer<$cart->uses_total && date('Y-m-d H:i:s')>=$cart->date_start && date('Y-m-d H:i:s')<=$cart->date_end)
														<?php $discount=($cart->price/100)*$cart->discount;
															   $new_price=$cart->price-$discount;
													    ?>
															<p><span class="old-price"><strike>${{number_format($cart->price, 2, '.', ',')}}</strike></span> <span class="new-price">${{number_format($new_price, 2, '.', ',')}}</span></p>
															@else
															 <?php $new_price=$cart->price;?>
															 <p><span class="new-price">${{number_format($cart->price, 2, '.', ',')}}</span></p>
															@endif
													</div>
													<div class="col-md-1 col-sm-1 col-xs-8">
													<p class="price_right text-right"><form action="{{route('Update.Cart')}}" method="POST" class="items"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="cart_id" value="{{$cart->cart_id}}"/><input type="hidden" name="costume_name" value="{{$cart->costume_name}}"/><input type="hidden" name="costume_id" value="{{$cart->costume_id}}"/><input name="qty" value="{{$cart->qty}}" class="form-control"/><button class="btn btn-primary item-update">Update</button></form></p>
													</div>
													<div class="col-md-3 col-sm-3 col-xs-12">
														<p class="price_right text-right"><span class="check_price">${{number_format(($cart->qty)*($new_price), 2, '.', ',')}}</span> 
														<span><a href="javascript::void(0);" data-item-id="{{$cart->cart_item_id}}" data-cart_id="{{$cart->cart_id}}" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></span></p>
													</div>
												</div>
											</div>
									@endforeach
									@else
										<div class="empty-cart">
										<h3>Shopping Cart is Empty</h3>
										<p>You have no items in your shopping cart.</p>
										<p>Click <a href="/">here</a> to continue shopping.</p>
										</div>
									@endif
										</div>
									</div>
									@if(count($data['basic']))
									<div class="col-md-3 col-sm-3 col-xs-12">
										<div class="cart_page_right">
											<div class="well">
												<div class="store_credit">
													<h3>My Store Credit</h3> 
													<p class="store_price">$0.00</p>
													<a class="btn btn-primary">Apply Credit</a>
												</div>
											</div>
											<div class="coupn_code">
												<div class="well">
													<h3>Have a Promotional Code? </h3> 
													<form action="/cart" method="post">
													<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
													<input type="hidden" name="cart_id" value="{{$data['basic'][0]->cart_id }}"> 
														<input type="text" class="form-control" name="coupan_code"> 
														<button class="btn btn-primary">Apply Code</button>
														</form>
												</div>
											</div>
											<div class="order_summery">
												<div class="well">
													<h3>Order Summary  </h3> 
													<p class="sub-all"><span>Subtotal: </span> <span class="sub-price">${{number_format($data['basic'][0]->total, 2, '.', ',')}} <em>({{$costumes_count}} Items)</em></span></p>
													<p class="sub-all"><span>Shipping: </span> <span class="sub-price">$
													{{number_format($shipping_amount, 2, '.', ',')}}<em>({{$shipping_count}} Items)</em></span></p>
													@if(!empty($data['dis_count'])) <p class="sub-all"><span>Coupon code: </span> <span class="sub-price">-${{$data['dis_total']}} <em>({{$data['dis_count']}} Items)</em></span></p>@endif
													<!-- <p class="sub-all s_credit"><span>Store Credit Apllied: </span> <span class="sub-price">$19.00 </span></p>   -->
													<p class="sub-all total_price"><span>Total: </span> <span class="sub-price">@if(!empty($data['dis_count']))${{number_format($data['basic'][0]->total+$shipping_amount-$data['dis_total'], 2, '.', ',')}} @else ${{number_format($data['basic'][0]->total+$shipping_amount, 2, '.', ',')}}@endif</span></p>
													@if(!Auth::check())<a data-toggle="modal" data-target="#login_popup" class="btn btn-primary">Continue to Checkout</a>  @else <a href="/checkout" class="btn btn-primary">Continue to Checkout</a>@endif
												</div>
											</div>
										</div>
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('/assets/frontend/js/pages/cart.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
@stop

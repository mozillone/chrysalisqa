@extends('/frontend/app')
@section('styles')
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
								<div class="cart_page_vew">
									@if(count($data))
									@foreach($data as $cart)
										<div class="well">
											<div class="shipping_date">
												<span>Shipping from Brooklyn, NY</span><span class="shi_date_right text-right right"> Estimated Shipping from Brooklyn, NY <i class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" title="Hooray!"></i></span>
											</div>
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div class="media">
														<div class="media-left">
															<img src="http://chrysalis.local.dotcomweavers.net/assets/frontend/img/captain-1.png" class="media-object">
														</div>
														<div class="media-body">
															<h4 class="media-heading">{{$cart->costume_name}}</h4>
															@if($cart->is_film=="yes")<p class="f_quality">Film Quality</p> @else  @endif
															<p><b>Item Condition:</b> {{ucwords(str_replace('_', ' ',$cart->condition))}}</p>
															<p><b>Size:</b> {{ucfirst($cart->size)}}</p>
															<p class="upload_id"><b>Uploaded by</b><span> {{$cart->user_name}}</p>
															</div>
														</div>
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12">
													<p class="price_right text-right"><span class="check_price">${{number_format($cart->price, 2, '.', ',')}}</span></p>
													</div>
													<div class="col-md-1 col-sm-1 col-xs-12">
													<p class="price_right text-right"><form action="{{route('Update.Cart')}}" method="POST" class="items"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="cart_id" value="{{$cart->cart_id}}"/><input type="hidden" name="costume_name" value="{{$cart->costume_name}}"/><input type="hidden" name="costume_id" value="{{$cart->costume_id}}"/><input name="qty" value="{{$cart->qty}}" class="form-control"/><button class="btn btn-primary item-update">Update</button></form></p>
													</div>
													<div class="col-md-3 col-sm-3 col-xs-12">
														<p class="price_right text-right"><span class="check_price">${{number_format(($cart->qty)*($cart->price), 2, '.', ',')}}</span> 
														<span><a href="/cart/delete/{{$cart->cart_id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></span></p>
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
									<div class="col-md-3 col-sm-3 col-xs-12">
										<div class="cart_page_right">
											<div class="well">
												<div class="store_credit">
													<h3>My Store Credit</h3> 
													<p class="store_price">$10.00</p>
													<a class="btn btn-primary">Apply Credit</a>
												</div>
											</div>
											<div class="coupn_code">
												<div class="well">
													<h3>Have a Promotional Code? </h3> 
													<input type"text" class="form-control"> 
													<a class="btn btn-primary">Apply Code</a>
												</div>
											</div>
											<div class="order_summery">
												<div class="well">
													<h3>Order Summary  </h3> 
													<p class="sub-all"><span>Subtotal: </span> <span class="sub-price">$159.00 <em>(2 Items)</em></span></p>
													<p class="sub-all"><span>Shipping: </span> <span class="sub-price">$1.00 <em>(2 Items)</em></span></p>
													<p class="sub-all s_credit"><span>Store Credit Apllied: </span> <span class="sub-price">$19.00 </span></p>
													<p class="sub-all total_price"><span>Total: </span> <span class="sub-price">$160.00 </span></p>
													<a class="btn btn-primary">Continue to Checkout</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
@stop
{{-- page level scripts --}}
@section('footer_scripts')

@stop

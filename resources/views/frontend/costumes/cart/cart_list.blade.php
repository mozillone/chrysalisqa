@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/frontend/css/pages/cart.css') }}">
 @endsection
@section('content')
 <div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
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
							<div class="col-md-9 col-sm-8 col-xs-12">
								<div class="cart_page_vew span-align">
									@if(count($data['basic']))
									<?php $shipping_amount=0;$shipping_count=0;$costumes_count=0;?>
									@foreach($data['basic'] as $cart)
									<?php $costumes_count+=$cart->qty;?>
										<div class="well">
										 	<div class="shipping_date">
											  @if(!empty($cart->zip_code))
											   <span>Selling from {{$cart->city}}, <b>{{$cart->state}}</b></span>
											  @else
											  <span>No seller address found</span>
										   	  @endif	
											</div>
										  	<div class="row">
												<div class="col-md-6 col-sm-12 col-xs-12">
													<div class="media">
														<div class="media-left">
														@if($cart->image!=null && file_exists(public_path('/costumers_images/Small/'.$cart->image)))<img src="costumers_images/Small/{{$cart->image}}" class="media-object"> @else <img src="costumers_images/default-placeholder.jpg" class="media-object"> @endif

														</div>
														<div class="media-body">
															<h4 class="media-heading"><a href="/product{{$cart->url_key}}">{{$cart->costume_name}}</a></h4>
															@if($cart->is_film=="yes")<p class="f_quality">Film Quality</p> @else  @endif
															<p><b>Item Condition:</b> {{ucwords(str_replace('_', ' ',$cart->condition))}}</p>
															<p><b>Size:</b> {{ucfirst($cart->size)}}</p>
															<p class="upload_id"><b>Uploaded by</b><span> {{$cart->user_name}}</p>
															@if($cart->created_user_group=="admin")<span class="cc_brand"><img src="/img/chrysalis_brand.png"></span>@endif
															</div>
														</div>
													</div>
													<div class="col-md-2 col-sm-3 col-xs-3">
													<p class="price_right text-right"><span class="check_price">@if($cart->created_user_group=="admin" && $cart->discount!=null && $cart->uses_customer<$cart->uses_total && date('Y-m-d')>=$cart->date_start && date('Y-m-d')<=$cart->date_end)
														<?php $discount=($cart->price/100)*$cart->discount;
															   $new_price=$cart->price-$discount;
													    ?>
															<p><span class="old-price"><strike>${{number_format($cart->price, 2, '.', ',')}}</strike></span> <span class="new-price">${{number_format($new_price, 2, '.', ',')}}</span></p>
															@else
															 <?php $new_price=$cart->price;?>
															 <p><span class="new-price">${{number_format($cart->price, 2, '.', ',')}}</span></p>
															@endif
													</div>
													<div class="col-md-1 col-sm-3 col-xs-3 cart_iput_udpate">
													<p class="price_right text-right"><form action="{{route('Update.Cart')}}" method="POST" class="items"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="cart_id" value="{{$cart->cart_id}}"/><input type="hidden" name="costume_name" value="{{$cart->costume_name}}"/><input type="hidden" name="costume_id" value="{{$cart->costume_id}}"/><input name="qty" value="{{$cart->qty}}" class="form-control"/><button class="btn btn-primary item-update">Update</button></form></p>
													</div>
													<div class="col-md-3 col-sm-6 col-xs-6">
														<p class="price_right text-right"><span class="check_price">${{number_format(($cart->qty)*($new_price), 2, '.', ',')}}</span> 
														<span><a href="javascript::void(0);" data-item-id="{{$cart->cart_item_id}}" data-cart_id="{{$cart->cart_id}}" class="delete btn" data-toggle="tooltip" data-placement="right" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></span></p>
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
									<div class="col-md-3 col-sm-4 col-xs-12">
										<div class="cart_page_right affix"  data-spy="affix" data-offset-top="230" data-offset-bottom="450">
											@if(Auth::check())<div class="well">
												<div class="store_credit clearfix">
													<h3>My Store Credit</h3> 
													<?php  if(!empty($data['dis_count'])){$total=$data['basic'][0]->total-$data['dis_total']; 
													}else{ $total=$data['basic'][0]->total;}?>
													<p class="store_price @if($data['credits']!="0.00") strike-price @endif">$<span class="store-p" data-max-credits="@if($total>=Auth::user()->credits) {{Auth::user()->credits}} @else {{$total}} @endif">@if($data['credits']=="0.00") {{number_format(Auth::user()->credits, 2, '.', ',')}} @else {{number_format($data['credits'], 2, '.', ',')}} @endif
													</span></p>@if(Auth::user()->credits!='0.00')
													<a href="javascript::void(0);" class="btn edit-store-credits" data-toggle="tooltip" data-placement="right" title=""  data-original-title="Edit">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
													<a class="btn btn-primary cpn @if($data['credits']=="0.00") credits-apply @else remove-apply @endif">@if($data['credits']=="0.00")Apply Credit @else Remove Credit @endif</a>@endif
													 <div class="credits-error"></div>
												</div>
											</div>
										 	@endif
										 	
											<div class="coupn_code">
												<div class="well">
													<h3>Have a Promotional Code? </h3> 
													@if(empty($data['dis_total']))
													<form action="/cart" method="post" id="coupan_submit">
													<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
													@if(!empty($data['dis_count']))<input type="hidden" name="coupna_amount" value="{{$data['dis_total']}}"> @endif
													<input type="hidden" name="cart_id" value="{{$data['basic'][0]->cart_id }}"> 
														<input type="text" class="form-control" name="coupan_code" id="coupan"> 
														<button class="btn btn-primary">Apply Code</button>
														</form>
													@else
													<p>Promotional Code Applied</p><button class="btn btn-primary" onclick="window.location='/cart'
													">Cancel Code</button>
													@endif
												</div>
											</div>

											<div class="order_summery">
												<div class="well">
													<h3>Order Summary  </h3> 
													<p class="sub-all"><span>Subtotal: </span> <span class="sub-price">$<span class="sub-p" data-subtotal="@if(!empty($data['dis_count'])) {{$data['basic'][0]->total-$data['dis_total']}} @else {{$data['basic'][0]->total}} @endif">{{number_format($data['basic'][0]->total, 2, '.', ',')}}</span> <em>({{$costumes_count}} Items)</em></span></p>
													@if(!empty($data['dis_count'])) <p class="sub-all"><span>Discount Amount: </span> <span class="sub-price">- $<span class="coupan-p" data-coupan="{{$data['dis_total']}}">{{number_format($data['dis_total'],2, '.', ',')}}</span> <em>({{$data['dis_count']}} Items)</em></span></p>@endif
													@if(Auth::check()) <p class="sub-all s_credit"><span>Store Credit Applied: </span> <span class="sub-price">- $<span class="store-credits">{{number_format($data['credits'],2, '.', ',')}}</span> </span></p>@endif
													<p class="sub-all total_price"><span>Total: </span> <span class="sub-price">$ <span class="total-price">@if(empty($data['credits']) && !empty($data['dis_count']))
													{{number_format($data['basic'][0]->total+$shipping_amount-$data['dis_total'], 2, '.', ',')}} 
													@elseif(!empty($data['credits'])&& empty($data['dis_count']))
													{{number_format($data['basic'][0]->total+$shipping_amount-$data['credits'], 2,'.', ',')}} 
													@elseif(!empty($data['credits']) && !empty($data['dis_count']))
													{{number_format($data['basic'][0]->total+$shipping_amount-$data['credits']-$data['dis_total'], 2,'.', ',')}}  
													@else {{number_format($data['basic'][0]->total+$shipping_amount, 2, '.', ',')}}@endif</span></span></p>
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

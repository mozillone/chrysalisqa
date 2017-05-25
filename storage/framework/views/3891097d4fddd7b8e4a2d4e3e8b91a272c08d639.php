<?php $__env->startSection('styles'); ?>
<style type="text/css">
	.chek-out .form-group {
    width: 45%;
    float: left;
    margin-right: 20px;
}

</style>
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="checkout_page_total checkout-content">
						<h1>Checkout</h1>
						<?php if(Session::has('error')): ?>
			            <div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo e(Session::get('error')); ?>

						</div>
			            <?php elseif(Session::has('success')): ?>
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo e(Session::get('success')); ?>

						</div>
						<?php endif; ?>
						<form action="/checkout/placeorder" method="POST" id="placeorder">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
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
												<div class="col-md-5 col-sm-4 col-xs-12">
													<?php if(!empty($data['cart_shipping_address'])): ?>
													<input type="hidden" value="<?php echo e($data['cart_shipping_address'][0]->shipping_address_1); ?>" name="shipping_address_1">
														<div class="shipping_add">
															<p><?php echo e($data['cart_shipping_address'][0]->shipping_address_1); ?>,<br>
															<?php if(!empty($data['cart_shipping_address'][0]->shipping_address_2)): ?><?php echo e($data['cart_shipping_address'][0]->shipping_address_2); ?><br><?php endif; ?>
															<?php echo e($data['cart_shipping_address'][0]->shipping_city); ?>,<?php echo e($data['cart_shipping_address'][0]->shipping_state); ?>,<?php echo e($data['cart_shipping_address'][0]->shipping_postcode); ?>,<?php echo e($data['cart_shipping_address'][0]->shipping_country); ?> <br></p>
														</div>
													<?php else: ?>
													<?php if(!empty($data['shipping_address'])): ?>
													<input type="hidden"  value="<?php echo e($data['shipping_address'][0]->address1); ?>" name="shipping_address_1">
														<div class="shipping_add">
															<p><?php echo e($data['shipping_address'][0]->address1); ?>,<br>
															<?php if(!empty($data['shipping_address'][0]->address2)): ?><?php echo e($data['shipping_address'][0]->address2); ?><br><?php endif; ?>
															<?php echo e($data['shipping_address'][0]->city); ?>,<?php echo e($data['shipping_address'][0]->state); ?>,<?php echo e($data['shipping_address'][0]->zip_code); ?>,<?php echo e($data['shipping_address'][0]->country); ?> <br></p>
														</div>
													<?php else: ?>
														<input type="hidden"  name="shipping_address_1">
														<div class="shipping_add"></div>
														<span class="shipping-empty">No Shipping Address Found</span>
													<?php endif; ?>
													<?php endif; ?>
													<span class="error"><?php echo e($errors->first('shipping_address_1')); ?></span>
													
												</div>
												<div class="col-md-3 col-sm-4 col-xs-12">
													<?php if(!empty($data['shipping_address']) || !empty($data['cart_shipping_address'])): ?>
														<p class="cehck_edit"><a href="javascript::void(0);" class="shipping_popup">Edit</a></p>
													<?php else: ?>
														<p class="cehck_edit" data-toggle="modal" data-target="#shipping_popup"><a href="javascript::void(0);" class="shipping_popup">New</a></p>
													<?php endif; ?>
												</div>
												
											</div>
											<div class="billing_div methods">
												<div class="col-md-4 col-sm-4 col-xs-12">
													<h4>Billing Adress:</h4>
												</div>
												<div class="col-md-5 col-sm-4 col-xs-12">
												<?php if(!empty($data['cart_billing_address'])): ?>
												<input type="hidden" name="pay_address_1" value="<?php echo e($data['cart_billing_address'][0]->pay_address_1); ?>"/>
													<div class="billing_add">
														<p><?php echo e($data['cart_billing_address'][0]->pay_address_1); ?>,<br>
														<?php if(!empty($data['cart_billing_address'][0]->pay_address_2)): ?><?php echo e($data['cart_billing_address'][0]->pay_address_2); ?><br><?php endif; ?>
														<?php echo e($data['cart_billing_address'][0]->pay_city); ?>,<?php echo e($data['cart_billing_address'][0]->pay_state); ?>,<?php echo e($data['cart_billing_address'][0]->pay_zipcode); ?>,<?php echo e($data['cart_billing_address'][0]->pay_country); ?> <br>
														</p>
													</div>
												<?php else: ?>
												<?php if(!empty($data['billing_address'])): ?>
													<input type="hidden" name="pay_address_1" value="<?php echo e($data['billing_address'][0]->address1); ?>"/> 
													<div class="billing_add">
														<p><?php echo e($data['billing_address'][0]->address1); ?>,<br>
														<?php if(!empty($data['billing_address'][0]->address2)): ?><?php echo e($data['billing_address'][0]->address2); ?><br><?php endif; ?>
														<?php echo e($data['billing_address'][0]->city); ?>,<?php echo e($data['billing_address'][0]->state); ?>,<?php echo e($data['billing_address'][0]->zip_code); ?>,<?php echo e($data['billing_address'][0]->country); ?> <br>
														</p>
													</div>
												<?php else: ?>
													<input type="hidden"  name="pay_address_1">
													<div class="billing_add"></div>
													<span class="billing-empty">No Billing Address Found</span>
												<?php endif; ?>
												<?php endif; ?>
												<span class="error"><?php echo e($errors->first('pay_address_1')); ?></span>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-12">
												<?php if(!empty($data['billing_address']) || !empty($data['cart_billing_address'])): ?>
													<p class="cehck_edit"><a href="javascript::void(0);" class="billing_popup">Edit</a></p>
												<?php else: ?>
													<p class="cehck_edit"><a href="javascript::void(0);" class="billing_popup">New</a></p>
												<?php endif; ?>
												</div>
												
											</div>
											<div class="payment_div methods">
												<div class="col-md-4 col-sm-4 col-xs-12">
														<h4>Payment Method:</h4>
												</div>
												<div class="col-md-5 col-sm-4 col-xs-12">
												<?php if(!empty($data['cart_cc_details'])): ?>
												<input type="hidden" name="card_id" value="<?php echo e($data['cart_cc_details'][0]->id); ?>"/> 
													<p class="card_exp"><?php if($data['cart_cc_details'][0]->card_type=="Visa"): ?> <img src="/img/visa.png">  <?php elseif($data['cart_cc_details'][0]->card_type=="American Express"): ?> <img src="/img/americanexpress.png"> <?php elseif($data['cart_cc_details'][0]->card_type=="MasterCard"): ?> <img src="/img/mastercard.png"> <?php endif; ?> Ending in <?php echo e($data['cart_cc_details'][0]->exp_year); ?></p>
												<?php else: ?>
													<?php if(!empty($data['cc_details'])): ?>
													<input type="hidden" name="card_id" value="<?php echo e($data['cc_details'][0]->id); ?>"/>
														<p class="card_exp"> <?php if($data['cc_details'][0]->card_type=="Visa"): ?> <img src="/img/visa.png">  <?php elseif($data['cc_details'][0]->card_type=="American Express"): ?> <img src="/img/americanexpress.png"> <?php elseif($data['cc_details'][0]->card_type=="MasterCard"): ?> <img src="/img/mastercard.png"> <?php endif; ?>  Ending in <?php echo e($data['cc_details'][0]->exp_year); ?></p>
													<?php else: ?>
														<input type="hidden"  name="card_id">
														<p class="card_exp"></p>
														<span class="payment-empty">No Payment Method Found</span>
													<?php endif; ?>
												<?php endif; ?>
												<span class="error"><?php echo e($errors->first('card_id')); ?></span>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-12">
													<?php if(!empty($data['cc_details']) || !empty($data['cart_cc_details'])): ?>
														<p class="cehck_edit"><a href="javascript::void(0);" class="cc_popup">Edit</a></p>
													<?php else: ?>
														<p class="cehck_edit"><a href="javascript::void(0);" class="cc_popup">New</a></p>
													<?php endif; ?>
												</div>
												
										</div>
									</div>
									</div>	
									<div class="checkout_review_box">
										<h2>Review Shipping & Delivery Time</h2>
										<?php $shipping_amount=0;$shipping_count=0;$costumes_count=0;?>
										<?php $__currentLoopData = $data['basic']['basic']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<?php $costumes_count+=$cart->qty;?>
										<div class="well">
											 <div class="shipping_date"><div class="shipping_date">
											   <span><?php if($cart->shipping!="Free Shipping" ): ?> Expedited Shipping <?php echo e($cart->city); ?>, <?php echo e($cart->state); ?>  <span class="in_prc"><?php if(helper::userCartShippingAddress($cart->cart_id)): ?>
											   <?php $amount=helper::domesticRate($cart->item_location,$cart->cart_id);?>
											   <?php if(helper::domesticRate($cart->item_location,$cart->cart_id)['result']!="0" ): ?> 
											         <?php $shipping_amount+=$shipping_amount+helper::domesticRate($cart->item_location,$cart->cart_id)['msg']['rate'];$shipping_count++?>
											    <?php endif; ?>
											    <?php if(helper::domesticRate($cart->item_location,$cart->cart_id)['result']!="0"): ?>
											    	(<?php echo e(helper::domesticRate($cart->item_location,$cart->cart_id)['msg']['rate']); ?>)
											    <?php else: ?>
											    	(<?php echo e(helper::domesticRate($cart->item_location,$cart->cart_id)['msg']); ?>)
											    <?php endif; ?>
											  <?php endif; ?> </span>  <?php else: ?> Free Shipping <?php echo e($cart->city); ?>, <?php echo e($cart->state); ?>  <span class="in_prc">($0.00)</span> <?php endif; ?> </span><span class="shi_date_right text-right right"><?php if($cart->shipping!="Free Shipping" && helper::domesticRate($cart->item_location,$cart->cart_id)['result']!="0"): ?> <?php if(helper::userCartShippingAddress($cart->cart_id)): ?>
											    Est delivery between <?php echo e(date('D M d')); ?>  and <?php echo e(date('D M d',strtotime('+'.helper::domesticRate($cart->item_location,$cart->cart_id)['msg']['MailService'].' day'))); ?>

											  <i class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" title="Hooray!"></i>  <?php endif; ?> <?php endif; ?> </span>
											</div></div>
											<div class="row">
												<div class="col-md-9 col-sm-9 col-xs-12">
													<div class="media">
														<div class="media-left">
															<?php if($cart->image!=null && file_exists(public_path('/costumers_images/Medium/'.$cart->image))): ?><img src="costumers_images/Medium/<?php echo e($cart->image); ?>" class="media-object"> <?php else: ?> <img src="costumers_images/default-placeholder.jpg" class="media-object"> <?php endif; ?>
														</div>
														<div class="media-body">
															<h4 class="media-heading"><a href="/product<?php echo e($cart->url_key); ?>"><?php echo e($cart->costume_name); ?></a></h4>
															<p><?php if($cart->is_film=="yes"): ?><p class="f_quality1">Film Quality</p> <?php else: ?>  <?php endif; ?></p>
															<p><b>Item Condition:</b> <?php echo e(ucwords(str_replace('_', ' ',$cart->condition))); ?></p>
															<p><b>Size:</b> Small</p>
															<p class="upload_id">Uploaded by<span> <?php echo e($cart->user_name); ?></span></p>
														</div>
													</div>
												</div>
												<div class="col-md-3 col-sm-3 col-xs-12">
													<p class="price_right text-right"><span class="check_price"><?php if($cart->created_user_group=="admin" && $cart->discount!=null && $cart->uses_customer<$cart->uses_total && date('Y-m-d H:i:s')>=$cart->date_start && date('Y-m-d H:i:s')<=$cart->date_end): ?>
														<?php $discount=($cart->price/100)*$cart->discount;
															   $new_price=$cart->price-$discount;
													    ?>
													  <?php else: ?>
															 <?php $new_price=$cart->price;?>
													<?php endif; ?>
													$<?php echo e(number_format(($cart->qty)*($new_price), 2, '.', ',')); ?></span>
													<span><a data-item-id="<?php echo e($cart->cart_item_id); ?>" data-cart_id="<?php echo e($cart->cart_id); ?>" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></span></p>
												</div>
											</div>
										</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<div class="check_out_page_right">
									<div class="order_summery">
										<div class="well">
											<h3>Order Summary  </h3> 
											<p class="sub-all"><span>Subtotal: </span> <span class="sub-price">$<?php echo e(number_format($data['basic']['basic'][0]->total, 2, '.', ',')); ?> <em>(<?php echo e($costumes_count); ?> Items)</em></span></p>
											<p class="sub-all"><span>Shipping: </span> <span class="sub-price">$
											<?php echo e(number_format($shipping_amount, 2, '.', ',')); ?><em>(<?php echo e($shipping_count); ?> Items)</em></span></p>
											<?php if(!empty($data['dis_count'])): ?> <p class="sub-all"><span>Coupon code: </span> <span class="sub-price">-$<?php echo e($data['dis_total']); ?> <em>(<?php echo e($data['dis_count']); ?> Items)</em></span></p><?php endif; ?>
											<!-- <p class="sub-all s_credit"><span>Store Credit Apllied: </span> <span class="sub-price">$0.00 </span></p> -->
											<p class="sub-all total_price"><span>Total: </span> <span class="sub-price"><?php if(!empty($data['basic']['dis_count'])): ?>$<?php echo e(number_format($data['basic']['basic'][0]->total+$shipping_amount-$data['basic']['dis_total'], 2, '.', ',')); ?> <?php else: ?> $<?php echo e(number_format($data['basic']['basic'][0]->total+$shipping_amount, 2, '.', ',')); ?><?php endif; ?> </span></p>
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
	       <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
	       <input type="hidden" name="cart_id" value="<?php echo e($data['basic']['basic'][0]->cart_id); ?>">
						
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
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="shipping_firstname" placeholder="First Name *" name="firstname" value="<?php echo e(Auth::user()->first_name); ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="shipping_lastname" placeholder="Last Name" name="lastname" value="<?php echo e(Auth::user()->last_name); ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="shipping_address_1" placeholder="Address1 *" name="address_1">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="shipping_address_2" placeholder="Address2 *" name="address_2">
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
												<select class="form-control state_dropdown" name="shipping_state_dropdown" id="shipping_state_dropdown">
													<option value="" selected>State</option>
													<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($st->name); ?>"><?php echo e($st->name); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

												</select>
												<input type="text" class="form-control normal-states hide" id="shipping_state" placeholder="State *" name="state">
											</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<select class="form-control" name="country" id="shipping_country">
													<option value="" selected> Select</option>
													<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cnt): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($cnt->country_name); ?>" <?php if($cnt->id=="230"): ?> selected <?php endif; ?>><?php echo e($cnt->country_name); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
	       <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
		   <input type="hidden" name="cart_id" value="<?php echo e($data['basic']['basic'][0]->cart_id); ?>">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="chek-out">
								<div class="col-md-12 col-sm-12 col-xs-12 billing-dropdown">
											<label for="">Choose Saved</label>
											<select class="form-control shpng-adr-mdl-seletor" id="billing">
											</select>
								</div>
								<div class="new_address">
									<div class="text-center billing-or">
										<p>Or</p>
									</div>
									
									<div class="address-form">
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_firstname" placeholder="First Name *" name="firstname" value="<?php echo e(Auth::user()->first_name); ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_lastname" placeholder="Last Name" name="lastname" value="<?php echo e(Auth::user()->last_name); ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_address_1" placeholder="Address1 *" name="address_1">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" id="billing_address_2" placeholder="Address2 *" name="address_2">
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
													<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($st->name); ?>"><?php echo e($st->name); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

												</select>
												<input type="text" class="form-control normal-states hide" id="billing_state" placeholder="State *" name="state">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<select class="form-control" name="country" id="billing_country">
														<option value="" selected> Select</option>
														<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cnt): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($cnt->country_name); ?>" <?php if($cnt->id=="230"): ?> selected <?php endif; ?>><?php echo e($cnt->country_name); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
	       <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
		   <input type="hidden" name="cart_id" value="<?php echo e($data['basic']['basic'][0]->cart_id); ?>">
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
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="cardholder_name" placeholder="Full Name on Card *" name="cardholder_name">
										</div>
									</div>
									<div class="col-md-6">
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
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="cc_number" placeholder="Card Number *" name="cc_number">
										</div>
									</div>
									<div class="col-md-6">
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
												<?php for($i=0;$i<=30;$i++): ?>
												<option value="<?php echo e(date('Y',strtotime('now'))+$i); ?>"><?php echo e(date('Y',strtotime('now'))+$i); ?></option>
												 <?php endfor; ?>
											 </select>
										</div>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/js/pages/placeorder.js')); ?>"></script>
<script src="<?php echo e(asset('/js/credit-card-validation.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
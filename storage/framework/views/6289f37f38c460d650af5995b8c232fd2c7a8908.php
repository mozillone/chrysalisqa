<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="cart_page_total">
						<h1>SHOPPING CART</h1>
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
						<div class="row">
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="cart_page_vew span-align">
									<?php if(count($data['basic'])): ?>
									<?php $shipping_amount=0;$shipping_count=0;$costumes_count=0;?>
									<?php $__currentLoopData = $data['basic']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<?php $costumes_count+=$cart->qty;?>
										<div class="well">
											<div class="shipping_date">
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
											</div>
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div class="media">
														<div class="media-left">
														<?php if($cart->image!=null && file_exists(public_path('/costumers_images/Medium/'.$cart->image))): ?><img src="costumers_images/Medium/<?php echo e($cart->image); ?>" class="media-object"> <?php else: ?> <img src="costumers_images/default-placeholder.jpg" class="media-object"> <?php endif; ?>

														</div>
														<div class="media-body">
															<h4 class="media-heading"><a href="/product<?php echo e($cart->url_key); ?>"><?php echo e($cart->costume_name); ?></a></h4>
															<?php if($cart->is_film=="yes"): ?><p class="f_quality">Film Quality</p> <?php else: ?>  <?php endif; ?>
															<p><b>Item Condition:</b> <?php echo e(ucwords(str_replace('_', ' ',$cart->condition))); ?></p>
															<p><b>Size:</b> <?php echo e(ucfirst($cart->size)); ?></p>
															<p class="upload_id"><b>Uploaded by</b><span> <?php echo e($cart->user_name); ?></p>
															</div>
														</div>
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12">
													<p class="price_right text-right"><span class="check_price"><?php if($cart->created_user_group=="admin" && $cart->discount!=null && $cart->uses_customer<$cart->uses_total && date('Y-m-d H:i:s')>=$cart->date_start && date('Y-m-d H:i:s')<=$cart->date_end): ?>
														<?php $discount=($cart->price/100)*$cart->discount;
															   $new_price=$cart->price-$discount;
													    ?>
															<p><span class="old-price"><strike>$<?php echo e(number_format($cart->price, 2, '.', ',')); ?></strike></span> <span class="new-price">$<?php echo e(number_format($new_price, 2, '.', ',')); ?></span></p>
															<?php else: ?>
															 <?php $new_price=$cart->price;?>
															 <p><span class="new-price">$<?php echo e(number_format($cart->price, 2, '.', ',')); ?></span></p>
															<?php endif; ?>
													</div>
													<div class="col-md-1 col-sm-1 col-xs-8">
													<p class="price_right text-right"><form action="<?php echo e(route('Update.Cart')); ?>" method="POST" class="items"><input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="cart_id" value="<?php echo e($cart->cart_id); ?>"/><input type="hidden" name="costume_name" value="<?php echo e($cart->costume_name); ?>"/><input type="hidden" name="costume_id" value="<?php echo e($cart->costume_id); ?>"/><input name="qty" value="<?php echo e($cart->qty); ?>" class="form-control"/><button class="btn btn-primary item-update">Update</button></form></p>
													</div>
													<div class="col-md-3 col-sm-3 col-xs-12">
														<p class="price_right text-right"><span class="check_price">$<?php echo e(number_format(($cart->qty)*($new_price), 2, '.', ',')); ?></span> 
														<span><a href="javascript::void(0);" data-item-id="<?php echo e($cart->cart_item_id); ?>" data-cart_id="<?php echo e($cart->cart_id); ?>" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></span></p>
													</div>
												</div>
											</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									<?php else: ?>
										<div class="empty-cart">
										<h3>Shopping Cart is Empty</h3>
										<p>You have no items in your shopping cart.</p>
										<p>Click <a href="/">here</a> to continue shopping.</p>
										</div>
									<?php endif; ?>
										</div>
									</div>
									<?php if(count($data['basic'])): ?>
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
													<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
													<input type="hidden" name="cart_id" value="<?php echo e($data['basic'][0]->cart_id); ?>"> 
														<input type="text" class="form-control" name="coupan_code"> 
														<button class="btn btn-primary">Apply Code</button>
														</form>
												</div>
											</div>
											<div class="order_summery">
												<div class="well">
													<h3>Order Summary  </h3> 
													<p class="sub-all"><span>Subtotal: </span> <span class="sub-price">$<?php echo e(number_format($data['basic'][0]->total, 2, '.', ',')); ?> <em>(<?php echo e($costumes_count); ?> Items)</em></span></p>
													<p class="sub-all"><span>Shipping: </span> <span class="sub-price">$
													<?php echo e(number_format($shipping_amount, 2, '.', ',')); ?><em>(<?php echo e($shipping_count); ?> Items)</em></span></p>
													<?php if(!empty($data['dis_count'])): ?> <p class="sub-all"><span>Coupon code: </span> <span class="sub-price">-$<?php echo e($data['dis_total']); ?> <em>(<?php echo e($data['dis_count']); ?> Items)</em></span></p><?php endif; ?>
													<!-- <p class="sub-all s_credit"><span>Store Credit Apllied: </span> <span class="sub-price">$19.00 </span></p>   -->
													<p class="sub-all total_price"><span>Total: </span> <span class="sub-price"><?php if(!empty($data['dis_count'])): ?>$<?php echo e(number_format($data['basic'][0]->total+$shipping_amount-$data['dis_total'], 2, '.', ',')); ?> <?php else: ?> $<?php echo e(number_format($data['basic'][0]->total+$shipping_amount, 2, '.', ',')); ?><?php endif; ?></span></p>
													<?php if(!Auth::check()): ?><a data-toggle="modal" data-target="#login_popup" class="btn btn-primary">Continue to Checkout</a>  <?php else: ?> <a href="/checkout" class="btn btn-primary">Continue to Checkout</a><?php endif; ?>
												</div>
											</div>
										</div>
									</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('/assets/frontend/js/pages/cart.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
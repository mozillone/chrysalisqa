<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/pages/cart.css')); ?>">
 <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
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
							<div class="col-md-9 col-sm-8 col-xs-12">
								<div class="cart_page_vew span-align">
									<?php if(count($data['basic'])): ?>
									<?php $shipping_amount=0;$shipping_count=0;$costumes_count=0;?>
									<?php $__currentLoopData = $data['basic']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<?php $costumes_count+=$cart->qty;?>
										<div class="well">
										 	<div class="shipping_date">
											  <?php if(!empty($cart->zip_code)): ?>
											   <span>Selling from <?php echo e($cart->city); ?>, <b><?php echo e($cart->state); ?></b></span>
											  <?php else: ?>
											  <span>No seller address found</span>
										   	  <?php endif; ?>	
											</div>
										  	<div class="row">
												<div class="col-md-6 col-sm-12 col-xs-12">
													<div class="media">
														<div class="media-left">
														<?php if($cart->image!=null && file_exists(public_path('/costumers_images/Small/'.$cart->image))): ?><img src="costumers_images/Small/<?php echo e($cart->image); ?>" class="media-object"> <?php else: ?> <img src="costumers_images/default-placeholder.jpg" class="media-object"> <?php endif; ?>

														</div>
														<div class="media-body">
															<h4 class="media-heading"><a href="/product<?php echo e($cart->url_key); ?>"><?php echo e($cart->costume_name); ?></a></h4>
															<?php if($cart->is_film=="yes"): ?><p class="f_quality">Film Quality</p> <?php else: ?>  <?php endif; ?>
															<p><b>Item Condition:</b> <?php echo e(ucwords(str_replace('_', ' ',$cart->condition))); ?></p>
															<p><b>Size:</b> <?php echo e(ucfirst($cart->size)); ?></p>
															<p class="upload_id"><b>Uploaded by</b><span> <?php echo e($cart->user_name); ?></p>
															<?php if($cart->created_user_group=="admin"): ?><span class="cc_brand"><img src="/img/chrysalis_brand.png"></span><?php endif; ?>
															</div>
														</div>
													</div>
													<div class="col-md-2 col-sm-3 col-xs-3">
													<p class="price_right text-right"><span class="check_price"><?php if($cart->created_user_group=="admin" && $cart->discount!=null && $cart->uses_customer<$cart->uses_total && date('Y-m-d')>=$cart->date_start && date('Y-m-d')<=$cart->date_end): ?>
														<?php $discount=($cart->price/100)*$cart->discount;
															   $new_price=$cart->price-$discount;
													    ?>
															<p><span class="old-price"><strike>$<?php echo e(number_format($cart->price, 2, '.', ',')); ?></strike></span> <span class="new-price">$<?php echo e(number_format($new_price, 2, '.', ',')); ?></span></p>
															<?php else: ?>
															 <?php $new_price=$cart->price;?>
															 <p><span class="new-price">$<?php echo e(number_format($cart->price, 2, '.', ',')); ?></span></p>
															<?php endif; ?>
													</div>
													<div class="col-md-1 col-sm-3 col-xs-3 cart_iput_udpate">
													<p class="price_right text-right"><form action="<?php echo e(route('Update.Cart')); ?>" method="POST" class="items"><input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="cart_id" value="<?php echo e($cart->cart_id); ?>"/><input type="hidden" name="costume_name" value="<?php echo e($cart->costume_name); ?>"/><input type="hidden" name="costume_id" value="<?php echo e($cart->costume_id); ?>"/><input name="qty" value="<?php echo e($cart->qty); ?>" class="form-control"/><button class="btn btn-primary item-update">Update</button></form></p>
													</div>
													<div class="col-md-3 col-sm-6 col-xs-6">
														<p class="price_right text-right"><span class="check_price">$<?php echo e(number_format(($cart->qty)*($new_price), 2, '.', ',')); ?></span> 
														<span><a href="javascript::void(0);" data-item-id="<?php echo e($cart->cart_item_id); ?>" data-cart_id="<?php echo e($cart->cart_id); ?>" class="delete btn" data-toggle="tooltip" data-placement="right" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></span></p>
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
									<div class="col-md-3 col-sm-4 col-xs-12">
										<div class="cart_page_right affix"  data-spy="affix" data-offset-top="230" data-offset-bottom="450">
											<?php if(Auth::check()): ?><div class="well">
												<div class="store_credit clearfix">
													<h3>My Store Credit</h3> 
													<?php  if(!empty($data['dis_count'])){$total=$data['basic'][0]->total-$data['dis_total']; 
													}else{ $total=$data['basic'][0]->total;}?>
													<p class="store_price <?php if($data['credits']!="0.00"): ?> strike-price <?php endif; ?>">$<span class="store-p" data-max-credits="<?php if($total>=Auth::user()->credits): ?> <?php echo e(Auth::user()->credits); ?> <?php else: ?> <?php echo e($total); ?> <?php endif; ?>"><?php if($data['credits']=="0.00"): ?> <?php echo e(number_format(Auth::user()->credits, 2, '.', ',')); ?> <?php else: ?> <?php echo e(number_format($data['credits'], 2, '.', ',')); ?> <?php endif; ?>
													</span></p><?php if(Auth::user()->credits!='0.00'): ?>
													<a href="javascript::void(0);" class="btn edit-store-credits" data-toggle="tooltip" data-placement="right" title=""  data-original-title="Edit">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
													<a class="btn btn-primary cpn <?php if($data['credits']=="0.00"): ?> credits-apply <?php else: ?> remove-apply <?php endif; ?>"><?php if($data['credits']=="0.00"): ?>Apply Credit <?php else: ?> Remove Credit <?php endif; ?></a><?php endif; ?>
													 <div class="credits-error"></div>
												</div>
											</div>
										 	<?php endif; ?>
										 	
											<div class="coupn_code">
												<div class="well">
													<h3>Have a Promotional Code? </h3> 
													<?php if(empty($data['dis_total'])): ?>
													<form action="/cart" method="post" id="coupan_submit">
													<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
													<?php if(!empty($data['dis_count'])): ?><input type="hidden" name="coupna_amount" value="<?php echo e($data['dis_total']); ?>"> <?php endif; ?>
													<input type="hidden" name="cart_id" value="<?php echo e($data['basic'][0]->cart_id); ?>"> 
														<input type="text" class="form-control" name="coupan_code" id="coupan"> 
														<button class="btn btn-primary">Apply Code</button>
														</form>
													<?php else: ?>
													<p>Promotional Code Applied</p><button class="btn btn-primary" onclick="window.location='/cart'
													">Cancel Code</button>
													<?php endif; ?>
												</div>
											</div>

											<div class="order_summery">
												<div class="well">
													<h3>Order Summary  </h3> 
													<p class="sub-all"><span>Subtotal: </span> <span class="sub-price">$<span class="sub-p" data-subtotal="<?php if(!empty($data['dis_count'])): ?> <?php echo e($data['basic'][0]->total-$data['dis_total']); ?> <?php else: ?> <?php echo e($data['basic'][0]->total); ?> <?php endif; ?>"><?php echo e(number_format($data['basic'][0]->total, 2, '.', ',')); ?></span> <em>(<?php echo e($costumes_count); ?> Items)</em></span></p>
													<?php if(!empty($data['dis_count'])): ?> <p class="sub-all"><span>Discount Amount: </span> <span class="sub-price">- $<span class="coupan-p" data-coupan="<?php echo e($data['dis_total']); ?>"><?php echo e(number_format($data['dis_total'],2, '.', ',')); ?></span> <em>(<?php echo e($data['dis_count']); ?> Items)</em></span></p><?php endif; ?>
													<?php if(Auth::check()): ?> <p class="sub-all s_credit"><span>Store Credit Applied: </span> <span class="sub-price">- $<span class="store-credits"><?php echo e(number_format($data['credits'],2, '.', ',')); ?></span> </span></p><?php endif; ?>
													<p class="sub-all total_price"><span>Total: </span> <span class="sub-price">$ <span class="total-price"><?php if(empty($data['credits']) && !empty($data['dis_count'])): ?>
													<?php echo e(number_format($data['basic'][0]->total+$shipping_amount-$data['dis_total'], 2, '.', ',')); ?> 
													<?php elseif(!empty($data['credits'])&& empty($data['dis_count'])): ?>
													<?php echo e(number_format($data['basic'][0]->total+$shipping_amount-$data['credits'], 2,'.', ',')); ?> 
													<?php elseif(!empty($data['credits']) && !empty($data['dis_count'])): ?>
													<?php echo e(number_format($data['basic'][0]->total+$shipping_amount-$data['credits']-$data['dis_total'], 2,'.', ',')); ?>  
													<?php else: ?> <?php echo e(number_format($data['basic'][0]->total+$shipping_amount, 2, '.', ',')); ?><?php endif; ?></span></span></p>
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
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/owl.carousel.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/owl.theme.default.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/frontend/vendors/jquery.bxslider/jquery.bxslider.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/vendors/lobibox-master/css/lobibox.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/pages/costume_single.css')); ?>">
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5980685de0404c0012139258&product=inline-share-buttons' async='async'></script>
<style>
	.red.sizes_chart{display:block;}
	div#size-chart label input.size_chekd {    vertical-align: text-bottom;}
	div#size-chart label{ margin-right: 15px; }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="product_Details_page">
	<div class="container">
		<div class="row">
			<nav class="breadcrumb">
				<a class="breadcrumb-item" href="/">Home &nbsp;&nbsp;>&nbsp;&nbsp;</a>
				<a class="breadcrumb-item" href="/category/<?php echo e($parent_cat_name); ?>/<?php echo e($sub_cat_name); ?>"><?php echo e($data[0]->cat_name); ?> &nbsp;&nbsp;> &nbsp;</a>
				<span class="breadcrumb-item active"><?php echo e($data[0]->name); ?></span>
			</nav>
			<div class="col-md-5 col-sm-5 col-xs-12 carousel-bg-style bxslider-strt">
				
				<ul class="bxslider">
					<?php $__currentLoopData = $data['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<li><img class="img-responsive" src="<?php echo e(asset('/costumers_images/Large')); ?>/<?= $images->image?>"></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</ul>
				
				<div id="bx-pager" class="bxslider-rm">
					<?php $count=0;?>
					<?php $__currentLoopData = $data['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<a data-slide-index="<?php echo e($count); ?>" href=""><img class="img-responsive" src="<?php echo e(asset('/costumers_images/Small')); ?>/<?= $images->image?>"></a>
					<?php $count++;?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</div>
				
			</div>
			
			<div class="col-md-7 col-sm-7 col-xs-12">
				<div class="product_view_rm">
					<?php if(Session::has('error')): ?>
					<div class="alert alert-danger alert-dismissable">
						<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
						<?php echo e(Session::get('error')); ?>

					</div>
					<?php elseif(Session::has('success')): ?>
					<div class="alert alert-success alert-dismissable">
						<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
						<?php echo e(Session::get('success')); ?>

					</div>
					<?php endif; ?>
					<h1 class="social-media-sec">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<h2><?php echo e($data[0]->name); ?></h2>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 single-view_social">
							<?php if(Auth::check()): ?>
							<a href="#" onclick="return false;" class="fav_costume" data-costume-id='<?php echo e($data[0]->costume_id); ?>'>
								<?php else: ?>
								<a data-toggle="modal" data-target="#login_popup_fav">
									<?php endif; ?>
									<span <?php if(isset($data[0]->is_fav)): ?> class="active" <?php endif; ?>>
										<?php if(isset($data[0]->is_fav) && $data[0]->is_fav == 1): ?>
										<i aria-hidden=true class="fa fa-heart"></i> 
										<?php else: ?> 
										<i aria-hidden=true class="fa fa-heart-o"></i>
										<?php endif; ?>
									</span>
								</a>
                                <a href="#" data-toggle="modal" data-target="#messageModal"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
								<!-- <div class="sharethis-inline-share-buttons"></div> -->
							</div>
						</h1>
						
						
						<!---Price section start -->
						<div class="row">
							<div class="priceview_rm">
								<div class="col-xs-12 col-md-6 col-sm-8 viewpr_rm">
									<div class="mobile_list_view">
										<h2><?php if($data[0]->created_user_group=="admin" && $data[0]->discount!=null && $data[0]->uses_customer<$data[0]->uses_total && date('Y-m-d',strtotime("now"))>=date('Y-m-d',strtotime($data[0]->date_start)) && date('Y-m-d',strtotime("now"))<=date('Y-m-d',strtotime($data[0]->date_end))): ?>
											<?php $discount=($data[0]->price/100)*($data[0]->discount);
                                                $new_price=$data[0]->price-$discount;
											?>
											<p><span class="old-price"><strike>$<?php echo e(number_format($data[0]->price,2, '.', ',')); ?></strike></span> <span class="new-price">$<?php echo e(number_format($new_price,2, '.', ',')); ?></span></p>
											<?php else: ?>
											<p><span class="new-price">$<?php echo e(number_format($data[0]->price,2, '.', ',')); ?></span></p>
											<?php endif; ?>
										</h2>
										<?php if($data['is_film_quality_cos'] == 'yes'): ?>
										<p class="ystrip-rm"><span><img class="img-responsive" src="<?php echo e(asset('assets/frontend/img/film.png')); ?>"> Film Quality</span></p>
										<?php endif; ?>
										</div>
										<div class="single_view_details col-xs-12">
											<p class="iCondition-rm"><span class="iBold-rm">Item Condition:</span><small>  <?php if($data[0]->condition=="brand_new"): ?> Brand New <?php elseif($data[0]->condition=="like_new"): ?> Like New <?php else: ?> <?php echo e(ucfirst($data[0]->condition)); ?> <?php endif; ?> </small></p>
											<p class="iCondition-rm"><span class="iBold-rm">Size:</span><small> <?php echo e(ucfirst($data[0]->gender)); ?> <?php if($data[0]->size=="s"): ?> small <?php elseif($data[0]->size=="m"): ?> medium <?php elseif($data[0]->size=="l"): ?> large <?php else: ?> <?php echo e(strtoupper($data[0]->size)); ?> <?php endif; ?></small> 
												<a href="#" class="size_chrtcls" id="szchart" data-toggle="modal" data-target="#size-chart" >Size Chart</a>	
											</p>
											<div class="clearfix"></div>
											<?php if($data[0]->size == 'custom'): ?>
												<div class="charts_div">
													<table class="table table-bordered">
														<tbody>
															<tr>
																<td class="text-center" colspan="2">Height</td>
																<td>Weight</td>
																<td>Chest</td>
																<td>Waist</td>
															</tr>
															<tr>
																<td class="text-center"><?php echo e($data[0]->custom_sizes[0]); ?> ft</td>
																<td class="text-center"><?php echo e($data[0]->custom_sizes[1]); ?> in</td>
																<td class="text-center"><?php echo e($data[0]->custom_sizes[2]); ?> lbs</td>
																<td class="text-center"><?php echo e($data[0]->custom_sizes[3]); ?> in</td>
																<td class="text-center"><?php echo e($data[0]->custom_sizes[4]); ?> in</td>
															</tr>
														</tbody>
													</table>
												</div>
											<?php endif; ?>
										</div>
										</div>
										
										<div class="col-md-6 col-xs-12 col-sm-4 viewBtn_rm">
											<?php if(helper::verifyCostumeQuantity($data[0]->costume_id,$data[0]->quantity+1) && $data[0]->quantity>0): ?>
											<button type="button" class="addtocart-rm add-cart" data-costume-id="<?php echo e($data[0]->costume_id); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</button>
											<?php if(!Auth::check()): ?>
											<a data-toggle="modal" data-target="#login_popup" class="buynow-rm">Buy it Now!</a>
											<?php else: ?>
											<form action="<?php echo e(route('buy-it-now')); ?>" method="POST"><input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="costume_id" value="<?php echo e($data[0]->costume_id); ?>">
												<input type="submit" class="addtocart-rm" value="Buy it Now!">
											</form>
											<?php endif; ?>
											<?php else: ?>
											<button type="button" class="addtocart-rm" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Out of stock</button>
											<?php endif; ?>
										</div>
										
									</div>
								</div>
								
								<?php if(Auth::check() && !empty($data['seller_info']['shipping_location'])  && helper::getSellerShippingAddress($data[0]->created_by) && helper::getUserShippingAddress()): ?>
								
								<div class="shipping_rm">
									<p class="shipp-rm"><label>Shipping:</label>
										<?php echo e($rate); ?>

									</p>
									
									<p class="shipp-rm1">Item location: <?php echo e($data['seller_info']['shipping_location'][0]->city); ?>, <?php echo e($data['seller_info']['shipping_location'][0]->state); ?> USA <br/>Ships to: <?php echo e(helper::getUserShippingAddress()['city']); ?>, <?php echo e(helper::getUserShippingAddress()['state']); ?> USA</p>
									<p class="shipp-rm shipp-rm-20">
										<label>Delivery: &nbsp; </label> 
											<?php echo e($est_delivery_date); ?>

										<i class="fa fa-info-circle" aria-hidden="true"></i>
									</p>
								</div>
								<?php endif; ?>
								
								<p class="returns-rm">Returns: <span>Seller <?php if(isset($data['returns'][0])){ echo $data['returns'][0]->attribute_option_value; }else{ echo " Return Not Accepted"; } ?></span></p>
								
								
								<div class="viewTabs_rm" style="display:none;">
									<ul class="nav nav-tabs viewTabs">
										<li class="active">
											<a  href="#viewTabs1" data-toggle="tab">Costume Description</a>
										</li>
										<li><a href="#viewTabs2" data-toggle="tab">FAQ</a>
										</li>
										<li><a href="#viewTabs3" data-toggle="tab">Seller Information</a>
										</li>
									</ul>
									<div class="tab-content viewTabs-content">
										
										<div class="tab-pane active" id="viewTabs1">
											<p class="viewTabs-text"><?php echo e($data[0]->description); ?></p>
										</div>
										
										<div class="tab-pane" id="viewTabs2">
											<p class="viewTabs-text"><?php if(count($data['faq'])): ?> 
											<?php echo nl2br($data['faq'][0]->attribute_option_value); ?> <?php else: ?> <span>No FAQ found</span> <?php endif; ?></p>
										</div>
										
											
										<div class="tab-pane" id="viewTabs3">
											<p class="viewTabs-text">
												<?php if(!empty($data['seller_info'][0])): ?>
												<?php if($data['seller_info'][0]->id != 1): ?>
												<p>Name: <span><?php echo e($data['seller_info'][0]->display_name); ?></span></p>
												<p>Username: <span><?php echo e($data['seller_info'][0]->username); ?></span></p>
												<p>Phone: <span><?php echo e($data['seller_info'][0]->phone_number); ?><span></p>
													<?php else: ?>
													<p>Name: <span>Chrysalis Support</span></p>
													<p>Username: <span>ChrysalisCostumes</span></p>
													<?php endif; ?>
													<?php else: ?>
													<p class="no-data-tab">No data found</p>
													<?php endif; ?>
												</p>
												</div>
												
											</div>
											
											
										</div>
										
										<!-- .tab_container_list_view -->
										<div class="single_view_multi_view_tabs">
											<ul class="mobile_list_tabs nav nav-tabs viewTabs">
												<li class="active" rel="tab1">Costume Description</li>
												<li rel="tab2">FAQ</li>
												<li rel="tab3">Seller Information</li>
											</ul>
											<div class="tab_container_list_view">
												<h3 class="d_active tab_drawer_heading" rel="tab1">Costume Description</h3>
												<div id="tab1" class="tab_content">
													<p class="viewTabs-text"><?php echo e($data[0]->description); ?></p>
												</div>
												<!-- #tab1 -->
												<h3 class="tab_drawer_heading" rel="tab2">FAQ</h3>
												<div id="tab2" class="tab_content">
													<p class="viewTabs-text"><?php if(count($data['faq'])): ?> <?php echo e($data['faq'][0]->attribute_option_value); ?> <?php else: ?> <span>No FAQ found</span> <?php endif; ?></p>
												</div>
												<!-- #tab2 -->
												<h3 class="tab_drawer_heading" rel="tab3">Seller Information</h3>
												<div id="tab3" class="tab_content">
													<p class="viewTabs-text">
														<?php if(!empty($data['seller_info'][0])): ?>
														<?php if($data['seller_info'][0]->id != 1): ?>
														<p>Name: <span><?php echo e($data['seller_info'][0]->display_name); ?></span>
														</p>
														<p>Username: <span><?php echo e($data['seller_info'][0]->username); ?></span>
															<!--<p>Phone: <span><?php echo e($data['seller_info'][0]->phone_number); ?><span></p>-->
														</p>
														<?php else: ?>
														<p>Name: <span>Chrysalis Support</span>
														</p>
														<p>Username: <span>ChrysalisCostumes</span>
															<!--<p>Phone: <span><?php echo e($data['seller_info'][0]->phone_number); ?><span></p>-->
														</p>
														<?php endif; ?>
														<?php else: ?>
														<p class="no-data-tab">No data found</p>
														<?php endif; ?>
													</p>
												</div>
												<!-- #tab3 -->
												
											</div>
											<!-- .tab_container_list_view -->
										</div>
										<!-- .tab_container_list_view -->
									
										
									
										<div class="likeview-rm">
											<p class="likeview-rm1">
												<span>Like this costume? </span>
												<?php if(Auth::check()): ?>
												<a href="#" onclick="return false;" class="like_costume_view" data-costume-id="<?php echo e($data[0]->costume_id); ?>"><span class="like-span">Vote Up!<i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span></a>
												<?php else: ?>
												<a data-toggle="modal" data-target="#login_popup"><span class="like-span">Vote Up!<i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span></a>
												<?php endif; ?>
												<span class="like-span1 <?php if(isset($data[0]->is_like)): ?> active <?php endif; ?>"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo e($data[0]->like_count); ?></span>
												
											</p>
											
											
											<p class="likeview-rm2"><a href="javascript:void(0);"  data-toggle="modal" data-target="#report_item"><i class="fa fa-flag" aria-hidden="true"></i> Report Item</a></p>
										</div>
										
									</div>
								</div>
								
								<div class="clearfix"></div>
								<div class="col-md-12 detailes_view_slider">
									<h2 class="viewHead-rm">People Also Viewing</h2>
									<div class="home_product_slider recently-viewed">
										<div class="container">
											<div class="row">
												<div class="col-xs-12">
													<div class="owl-carousel owl-theme">
														<?php $__currentLoopData = $data['random_costumes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rand): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<div class="item">
															<div class="prod_box">
																<div class="img_layer" >
																	<a href="/product<?php echo e($rand->url_key); ?>" style="background-image: url(<?php if($rand->image!=null): ?> /costumers_images/Medium/<?php echo e($rand->image); ?> <?php else: ?> <?php echo e(asset('/costumers_images/default-placeholder.jpg')); ?> <?php endif; ?> )">
																	</a>
																	<div class="hover_box">
																		<p class="like_fav"><a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-thumbs-o-up"></i>1</span></a> <a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-heart-o"></i></span></a> </p>
																		<p class="hover_crt add-cart" data-costume-id="145"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart</p>
																	</div>
																</div>
																<?php if($rand->film_qlty == '32'): ?>
																<p class="ystrip-rm"><span><img class="img-responsive" src="http://chrysaliscostumes.com/assets/frontend/img/film.png"> Film Quality</span></p>
																<?php endif; ?>
																<div class="slider_cnt">
																	<h4><a href="/product<?php echo e($rand->url_key); ?>"><?php echo e($rand->name); ?></a></h4>
																	<p>$<?php echo e(number_format($rand->price, 2, '.', ',')); ?></p>
																</div>
															</div>
														</div>
														
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								
							</div>
						</div>
						
							
						<div class="modal fade window-popup" id="report_item">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class=" modal-header indi_close_icons">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="report_item_pupup" id="loginModal">
												
												<div id="myTabContent" class="tab-content">
													<h2>Report Item</h2>
													
													<div class="tab-pane active in" id="login_tab1">
														<form class="" action="<?php echo e(route('report.post')); ?>" method="POST" id="report">
															<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
															<input type="hidden" name="costume_id" value="<?php echo e($data[0]->costume_id); ?>">
															<div class="form-group">
																<label>Name</label>
																<input type="text"  name="name" placeholder="Enter your name" class="form-control" <?php if(Auth::check()): ?> value="<?php echo e(Auth::user()->display_name); ?>" <?php endif; ?>>
																<p class="error"><?php echo e($errors->first('name')); ?></p>
															</div>
															<div class="form-group">
																<label>Email</label>
																<input type="text"  name="email" placeholder="Enter your email" class="form-control" <?php if(Auth::check()): ?> value="<?php echo e(Auth::user()->email); ?>" <?php endif; ?>>
																<p class="error"><?php echo e($errors->first('email')); ?></p>
															</div>
															<div class="form-group">
																<label>Phone</label>
																<input type="text" name="phone" placeholder="Enter phone number" class="form-control" <?php if(Auth::check()): ?> value="<?php echo e(Auth::user()->phone_number); ?>" <?php endif; ?>>
																<p class="error"><?php echo e($errors->first('phone')); ?></p>
															</div>
															<div class="form-group">
																<label>Reason</label>
																<select class="form-control" name="reason">
																	<option value="">--Select--</option>
																	<option value="Technical issue">Technical issue</option>
																	<option value="Site issue">Site issue</option>
																</select>
																<p class="error"><?php echo e($errors->first('password')); ?></p>
															</div>
															<div class="form-group">
																<div class="login-btn">
																	<button class="btn btn-primary">Submit</button>
																</div>
															</div>
															
															
														</form>
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
						
				<?php if(Auth::user() !=''): ?>
					<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<form action="<?php echo e(route('inquire-costume')); ?>" method="POST" id="inquire_costume">
									<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
									<input type="hidden" name="user_id" value="<?php if(Auth::check()){ echo Auth::user()->id; } ?>">
									<input type="hidden" name="seller_id" value="<?php echo e($data['seller_info'][0]->id); ?>">
									<input type="hidden" name="costume_name" value="<?php echo e($data[0]->name); ?>">
									<input type="hidden" name="costume_id" value="<?php echo e($data[0]->costume_id); ?>">
									<input type="hidden" name="type_id" value="<?php echo e($data[0]->sku_no); ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Contact About <?php echo e($data[0]->name); ?></h4>
									</div>
									
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group has-feedback">
													<label>Name</label>
													<input type="text" name="user_name" class="form-control" value="<?php if(Auth::check()){ echo Auth::user()->display_name; } ?>">
													<p class="error"><?php echo e($errors->first('user_name')); ?></p>
												</div>
												<div class="form-group has-feedback">
													<label>Email</label>
													<input type="email" name="user_email" class="form-control" value="<?php if(Auth::check()){ echo Auth::user()->email; } ?>">
													<p class="error"><?php echo e($errors->first('user_email')); ?></p>
												</div>
												<div class="form-group has-feedback">
													<label>Message</label>
													<textarea rows="5" name="user_message" class="form-control"></textarea>
													<p class="error"><?php echo e($errors->first('user_message')); ?></p>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Send Message</button>
									</div>
									
								</form>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<!-- size chart modal start here -->
				
					<div id="size-chart"  class="modal fade" role="dialog">
						<div class="modal-dialog">
							
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Size Chart</h4>
								</div>
								<div class="modal-body">
									<div class="size_chart_div">
										<div class="size_chart_div1">
											<p>Please note that this is a guide only and that measurements may vary according to manufacturer and style. </p>
											
											<ul class="nav nav-tabs">
												<li class="active"><a data-toggle="tab"  id="mens_chart" href="#men">Men</a></li>
												<li><a data-toggle="tab"  id="womens_chart" href="#women">Women</a></li>
												<li><a data-toggle="tab"  id="boys_chart" href="#boys">Boys</a></li>
												<li><a data-toggle="tab"  id="girls_chart" href="#gilrs">Girls</a></li>
												<li><a data-toggle="tab"  id="pets_chart" href="#pets">Pets</a></li>
												<li><a data-toggle="tab"  id="infants_chart" href="#infants">Infants</a></li>
											</ul>
										</div>
										
										<div class="tab-content ">
											<div id="men" class="tab-pane fade in active">
												
												
												<ul class="nav nav-pills in-tab">
													<!--	<label><input class="size_chekd"  id="sizechart_1" type="radio" name="colorRadio" value="red" checked> In Inches</label>
													<label><input class="size_chekd" id="sny1"  type="radio" name="colorRadio" value="green">   Centimeters</label>-->
													
												</ul>
												
												<div class="tab-content table-responsive">
													<div id="home" class="tab-pane fade in sizes_chart red">
														
														<table class="table table-striped">
															<thead>
																<tr>
																	<th>In Inches</th>
																	<th>S</th>
																	<th>M</th>
																	<th>L</th>
																	<th>XL</th>
																	<th>Plus</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Chest</td>
																	<td>36-40</td>
																	<td>42-46</td>
																	<td>46-50</td>
																	<td>46-50</td>
																	<td>50-56</td>
																</tr>
																<tr>
																	<td>Waist</td>
																	<td>26-28</td>
																	<td>30-34</td>
																	<td>36-40</td>
																	<td>34-38</td>
																	<td>42-46</td>
																</tr>
																
																
															</tbody>
														</table>
													</div>
													<div id="menu1" class="tab-pane fade in sizes_chart green">
														
														<table class="table table-striped">
															<thead>
																<tr>
																	<th>In Inches</th>
																	<th>S</th>
																	<th>M</th>
																	<th>L</th>
																	<th>XL</th>
																	<th>Plus</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Chest</td>
																	<td>36-40</td>
																	<td>42-46</td>
																	<td>46-50</td>
																	<td>46-50</td>
																	<td>50-56</td>
																</tr>
																<tr>
																	<td>Waist</td>
																	<td>26-28</td>
																	<td>30-34</td>
																	<td>36-40</td>
																	<td>34-38</td>
																	<td>42-46</td>
																</tr>
																
																
															</tbody>
														</table>
													</div>
													
												</div>											
												
												
												
												
												
											</div>
											
											
											
											<div id="women" class="tab-pane fade">
												
												<div id="men" class="tab-pane fade in active">
													
													
													<ul class="nav nav-pills in-tab">
														<!--<label><input class="size_chekd"  id="sizechart_2" type="radio" name="colorRadio" value="red" checked> Inches</label>
														<label><input class="size_chekd" type="radio" name="colorRadio" value="green">   Centimeters</label>-->
														
													</ul>
													
													<div class="tab-content  table-responsive">
														<div id="home" class="tab-pane fade in sizes_chart red">
															
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th>In Inches</th>
																		<th>XS</th>
																		<th>S</th>
																		<th>M</th>
																		<th>L</th>
																		<th>Plus</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Chest</td>
																		<td>30-31</td>
																		<td>32-35</td>
																		<td>36-38</td>
																		<td>39-42</td>
																		<td>42-44</td>
																	</tr>
																	<tr>
																		<td>Waist</td>
																		<td>22-24</td>
																		<td>25-27</td>
																		<td>28-30</td>
																		<td>31-34</td>
																		<td>35-38</td>
																	</tr>
																	
																	
																</tbody>
															</table>
														</div>
														<div id="menu1" class="tab-pane fade in sizes_chart green">
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th></th>
																		<th>XS</th>
																		<th>S</th>
																		<th>M</th>
																		<th>L</th>
																		<th>Plus</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Chest</td>
																		<td>30-31</td>
																		<td>32-35</td>
																		<td>36-38</td>
																		<td>39-42</td>
																		<td>42-44</td>
																	</tr>
																	<tr>
																		<td>Waist</td>
																		<td>22-24</td>
																		<td>25-27</td>
																		<td>28-30</td>
																		<td>31-34</td>
																		<td>35-38</td>
																	</tr>
																	
																	
																</tbody>
															</table>
														</div>
														
													</div>											
													
												
													
													
													
												</div>
												
											</div>
											<div id="boys" class="tab-pane fade">
												
												<ul class="nav nav-pills in-tab">
													<!--	<label><input class="size_chekd"  id="sizechart_3" type="radio" name="colorRadio" value="red" checked > Inches</label>
													<label><input class="size_chekd" type="radio" name="colorRadio" value="green">   Centimeters</label>-->
													
												</ul>
												
												<div class="tab-content  table-responsive">
													<div id="home" class="tab-pane fade in sizes_chart red">
														
														<table class="table table-striped">
															<thead>
																<tr>
																	<th>In Inches</th>
																	<th>Toddler</th>
																	<th>Small</th>
																	<th>Medium</th>
																	<th>Large</th>
																	
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Chest</td>
																	<td>23-24</td>
																	<td>25-28</td>
																	<td>29-32</td>
																	<td>35-39</td>
																	
																</tr>
																<tr>
																	<td>Waist</td>
																	<td>22-24</td>
																	<td>25-26</td>
																	<td>27-30</td>
																	<td>31-34</td>
																	
																</tr>
																
																
															</tbody>
														</table>
													</div>
													<div id="menu1" class="tab-pane fade in sizes_chart green">
														<table class="table table-striped">
															<thead>
																<tr>
																	<th></th>
																	<th>Toddler</th>
																	<th>Small</th>
																	<th>Medium</th>
																	<th>Large</th>
																	
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Chest</td>
																	<td>23-24</td>
																	<td>25-28</td>
																	<td>29-32</td>
																	<td>35-39</td>
																	
																</tr>
																<tr>
																	<td>Waist</td>
																	<td>22-24</td>
																	<td>25-26</td>
																	<td>27-30</td>
																	<td>31-34</td>
																	
																</tr>
																
																
															</tbody>
														</table>
													</div>
													
												</div>	
												
											</div>
											<div id="gilrs" class="tab-pane fade">
												<ul class="nav nav-pills in-tab">
													<!--	<label><input class="size_chekd" type="radio"  id="sizechart_4" name="colorRadio" value="red"  checked > Inches</label>
													<label><input class="size_chekd" type="radio" name="colorRadio" value="green">   Centimeters</label>-->
													
												</ul>
												
												<div class="tab-content  table-responsive">
													<div id="home" class="tab-pane fade in sizes_chart red">
														
														<table class="table table-striped">
															<thead>
																<tr>
																	<th>In Inches</th>
																	<th>Toddler</th>
																	<th>Small</th>
																	<th>Medium</th>
																	<th>Large</th>
																	
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Chest</td>
																	<td>23-24</td>
																	<td>25-28</td>
																	<td>29-32</td>
																	<td>35-39</td>
																	
																</tr>
																<tr>
																	<td>Waist</td>
																	<td>22-24</td>
																	<td>25-26</td>
																	<td>27-30</td>
																	<td>31-34</td>
																	
																</tr>
																
																
															</tbody>
														</table>
													</div>
													<div id="menu1" class="tab-pane fade in sizes_chart green">
														<table class="table table-striped">
															<thead>
																<tr>
																	<th></th>
																	<th>Toddler</th>
																	<th>Small</th>
																	<th>Medium</th>
																	<th>Large</th>
																	
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Chest</td>
																	<td>23-24</td>
																	<td>25-28</td>
																	<td>29-32</td>
																	<td>35-39</td>
																	
																</tr>
																<tr>
																	<td>Waist</td>
																	<td>22-24</td>
																	<td>25-26</td>
																	<td>27-30</td>
																	<td>31-34</td>
																	
																</tr>
																
																
															</tbody>
														</table>
													</div>
													
												</div>	
											</div>
											<div id="pets" class="tab-pane fade">
												<ul class="nav nav-pills in-tab">
													<!--<label><input class="size_chekd" id="sizechart_5" type="radio" name="colorRadio" value="red"  checked > Inches</label>
													<label><input class="size_chekd" type="radio" name="colorRadio" value="green">   Centimeters</label>-->
													
												</ul>
												
												<div class="tab-content  table-responsive">
													<div id="home" class="tab-pane fade in sizes_chart red">
														
														<table class="table table-striped">
															<thead>
																<tr>
																	<th>In Inches</th>
																	<th>Small</th>
																	<th>Medium</th>
																	<th>Large</th>
																	<th>Extra Large</th>
																	
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Neck to Tail</td>
																	<td>10-14</td>
																	<td>14-20</td>
																	<td>22-28</td>
																	<td>28+</td>
																	
																</tr>
																<tr>
																	<td>Chest</td>
																	<td>10-14</td>
																	<td>14-18</td>
																	<td>18-24</td>
																	<td>24+</td>
																	
																</tr>
																
																
															</tbody>
														</table>
													</div>
													<div id="menu1" class="tab-pane fade in sizes_chart green">
														<table class="table table-striped">
															<thead>
																<tr>
																	<th></th>
																	<th>Small</th>
																	<th>Medium</th>
																	<th>Large</th>
																	<th>Extra Large</th>
																	
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Neck to Tail</td>
																	<td>10-14</td>
																	<td>14-20</td>
																	<td>22-28</td>
																	<td>28+</td>
																	
																</tr>
																<tr>
																	<td>Chest</td>
																	<td>10-14</td>
																	<td>14-18</td>
																	<td>18-24</td>
																	<td>24+</td>
																	
																</tr>
																
																
															</tbody>
														</table>
													</div>
													
												</div>	
											</div>
											<div id="infants" class="tab-pane fade">
												
												<ul class="nav nav-pills in-tab">
													<!--<label><input class="size_chekd"  id="sizechart_6" type="radio" name="colorRadio" value="red"  checked="checked"  > Inches</label>-->
													
												</ul>
												
												<div class="tab-content  table-responsive">
													<div id="home" class="tab-pane fade in sizes_chart red">
														
														<table class="table table-striped">
															<thead>
																<tr>
																	<th>In Inches</th>
																	<th>Newborn</th>
																	<th>Infant</th>
																	
																	
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Age</td>
																	<td>0-6 Months</td>
																	<td>6-12 Months</td>
																	
																</tr>
																
																
																
															</tbody>
														</table>
													</div>
													
													
												</div>	
												
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					
					<!-- size chart modal End  here -->
					
					
					
					
					
					<?php $__env->stopSection(); ?>
					
					<?php $__env->startSection('footer_scripts'); ?>
					<script>
						$(".mobile-plus").click(function(){
							$(this).toggleClass("mobile-minus");	
							$(this).parent("li").find(".responsive-inner").toggleClass("none-rm");
						});
						
						$(".icon-rm .toggle-btn").click(function(){
							$(this).parent(".icon-rm").toggleClass("btn-cross");	
							$(".mobile-rm").toggleClass("toggle");	
						});	
					</script>
					
					<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
					<script src="<?php echo e(asset('/assets/frontend/js/owl.carousel.min.js')); ?>"></script>
					<script src="<?php echo e(asset('/assets/frontend/js/pages/costumes_view.js')); ?>"></script>
					<script src="<?php echo e(asset('/assets/frontend/js/pages/home.js')); ?>"></script>
					<script src="<?php echo e(asset('/assets/frontend/js/pages/view_costume.js')); ?>"></script>
					<script src="<?php echo e(asset('/assets/frontend/js/pages/costume-fav.js')); ?>"></script>
					<script src="<?php echo e(asset('/assets/frontend/js/pages/costume-like.js')); ?>"></script>
					<script src="<?php echo e(asset('/assets/frontend/vendors/jquery.bxslider/jquery.bxslider.js')); ?>"></script>
					<script src="<?php echo e(asset('/assets/frontend/js/pages/mini_cart.js')); ?>"></script>
					<script src="<?php echo e(asset('/assets/frontend/vendors/lobibox-master/js/notifications.js')); ?>"></script>
					
					<script type="text/javascript">
						$(document).ready(function(){
							$(".size_chekd").click(function(){
								var inputValue = $(this).attr("value");
								var targetsizes_chart = $("." + inputValue);
								$(".sizes_chart").not(targetsizes_chart).hide();
								$(targetsizes_chart).show();
							});
							
							
							$("#szchart,#mens_chart").click(function(){
								var radiobtn = document.getElementById("sizechart_1");
								radiobtn.checked = true;
							});
							$("#womens_chart").click(function(){
								var radiobtn = document.getElementById("sizechart_2");
								radiobtn.checked = true;
							});
							$("#boys_chart").click(function(){
								var radiobtn = document.getElementById("sizechart_3");
								radiobtn.checked = true;
							});
							$("#girls_chart").click(function(){
								var radiobtn = document.getElementById("sizechart_4");
								radiobtn.checked = true;
							});
							$("#pets_chart").click(function(){
								var radiobtn = document.getElementById("sizechart_5");
								radiobtn.checked = true;
							});
							$("#infants_chart").click(function(){
								var radiobtn = document.getElementById("sizechart_6");
								radiobtn.checked = true;
							});
							
						</script>
					<?php $__env->stopSection(); ?>					
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
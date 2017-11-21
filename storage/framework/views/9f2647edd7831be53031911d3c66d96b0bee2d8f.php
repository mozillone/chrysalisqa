<?php $__env->startSection('title'); ?>
Home@parent
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/pages/home.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/owl.carousel.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/owl.theme.default.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- responsive banner start here sample-->
<?php echo (isset($pageData->description) && !empty($pageData->description) ? $pageData->description : ''); ?>
<div class="container">
</div>
<div class="home_product_slider">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h2>Featured Costumes</h2>
				<?php //echo "<pre>";print_r($featured_costumes); ?>
				<div class="owl-carousel owl-theme">
					<?php  foreach ($featured_costumes as $cos) { ?>
						<div class="item">
							<div class="prod_box">
								<div class="img_layer">
									<a href="/product<?php echo e($cos->url); ?>" style="background-image: url(<?php echo e(asset('costumers_images/Medium')); ?><?php echo "/".$cos->cos_image; ?>)">
									</a>
									<div class="hover_box"><p class="like_fav"><a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-thumbs-up"></i>1</span></a> <a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-heart-o"></i></span></a> </p><p class="hover_crt add-cart" data-costume-id="145"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart</p></div>
								</div>
								<?php if($cos->film_qlty == '32'): ?>
									<p class="ystrip-rm"><span><img class="img-responsive" src="http://chrysaliscostumes.com/assets/frontend/img/film.png"> Film Quality</span></p>
								<?php endif; ?>
								<div class="slider_cnt <?php if($cos->created_user_group != "admin" ): ?>no_brand <?php endif; ?> <?php if(strlen($cos->cos_name)<20): ?> sml_name <?php endif; ?>">
									<?php if($cos->created_user_group == "admin"): ?>
									<?php $is_admin=20;?>
									<span class="cc_brand"><img src="<?php echo e(asset('img/chrysalis_brand.png')); ?>"></span>
									
									<?php else: ?>
									<?php $is_admin=40;?>
									<?php endif; ?>
									<?php if(strlen($cos->cos_name) < 20) { ?>
										
										<h4><a href="/product<?php echo e($cos->url); ?>"><?php echo e($cos->cos_name); ?></a></h4>
										<?php } else { ?>
										<h4><a href="/product<?php echo e($cos->url); ?>"><?php echo e(substr($cos->cos_name, 0,$is_admin)."..."); ?></a></h4>
									<?php } ?>
									
									
									<p>$<?php echo e(number_format($cos->cos_price, 2, '.', ',')); ?></p>
								</div>
								</div>
							</div>
						<?php } ?>
						
					</div>
					<input type="hidden" name="costumes_cnt" id="costumes_cnt" value="<?php echo e(count($featured_costumes)); ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="home-adds">
		<div class="container">
			<div class="row">
				<div class="col-md-8  add1">
					<a href="/pages/how-it-works">
						<img class="img-responsive hidden-sm hidden-xs" src="<?php echo e(asset('/assets/frontend/img/add11.png')); ?>">
						<img class="img-responsive hidden-md hidden-lg" src="<?php echo e(asset('/assets/frontend/img/home-mini1.png')); ?>">
					</a>
				</div>
				<div class="col-md-4 add2">
					<a href="/giving-back">
						<img class="img-responsive hidden-sm hidden-xs" src="<?php echo e(asset('/assets/frontend/img/add22.png')); ?>">
						<img class="img-responsive hidden-md hidden-lg" src="<?php echo e(asset('/assets/frontend/img/home-mini2.png')); ?>">
					</a>
				</div>
			</div>
		</div>
	</div> 
	<!-- git -->
	<?php $__env->stopSection(); ?>
	<?php $__env->startSection('footer_scripts'); ?>

	<script src="<?php echo e(asset('/assets/frontend/js/jquery.touchSwipe.min.js')); ?>"></script>
	<script src="<?php echo e(asset('/assets/frontend/js/owl.carousel.min.js')); ?>"></script>
	<script src="<?php echo e(asset('/assets/frontend/js/pages/home.js')); ?>"></script>
		<script>
			$(document).ready(function() {
				if($("#costumes_cnt").val() > "4"){
					$(".owl-controls.clickable").show();	
				}
				if (jQuery(window).width() < 767) 
				{
					$(".carousel").swipe({
						
					  swipe: function(event, direction, distance, duration, fingerCount, fingerData) {

					    if (direction == 'left') $(this).carousel('next');
					    if (direction == 'right') $(this).carousel('prev');

					  },
					  allowPageScroll:"vertical"

					});
				}
			});
		</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
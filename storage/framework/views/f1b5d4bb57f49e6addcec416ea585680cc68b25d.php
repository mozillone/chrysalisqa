<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/costumes_list.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/vendors/lobibox-master/css/lobibox.css')); ?>">

 <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 	<section class="content create_section_page">
 	 	<div id="ohsnap"></div>
		<div class="prodcut_list_page wish_lists_main_div">
			<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="list-sec-rm">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<p class="list-sec-rm1 fav_costume"><span class="active"><i aria-hidden=true class="fa fa-heart"></i></span> My Favorites <span class="fav_pg_cnt">(<?php echo e(helper::getMyWishlistCount()); ?>)</span></p>
						</div> 
						<div class="col-md-6 text-right pull-right back-link">
							<a href="/dashboard">Back to My Account</a>
						</div>

					</div>
					</div>
				</div>
			<div class="list_products wish_lists">
				<div class="row">
				<?php if(count($data)): ?>
				<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wish): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

					<div class="col-md-3 col-sm-4 col-xs-6" >
					    <div class="prod_box">
					        <div class="img_layer">
					            <a href="/product<?php echo e($wish->url_key); ?>" style="background-image: url(<?php if($wish->image!=null && file_exists(public_path
					            ('costumers_images/Medium/'.$wish->image.''))): ?> /costumers_images/Medium/<?php echo e($wish->image); ?> <?php else: ?> /costumers_images/default-placeholder.jpg <?php endif; ?>)">&nbsp;</a>
					            <div class="hover_box">
					                <p class="like_fav">
					                	<a href="#" onclick="return false;" class="like_costume" data-costume-id="<?php echo e($wish->costume_id); ?>">
					                		<span  <?php if($wish->is_like=='1'): ?> class="active" <?php endif; ?>><i aria-hidden="true" class="fa fa-thumbs-o-up"></i><?php echo e($wish->like_count); ?></span>
					                	</a>
					                  	<a href="#" onclick="return false;" class="delete" data-costume-id="<?php echo e($wish->costume_id); ?>">
					                		<span class="active"><i aria-hidden="true" class="fa fa-heart"></i></span>
					                	</a>
					                </p>
					                <?php if($wish->quantity>=1): ?>
					                	<p class="hover_crt add-cart" data-costume-id="<?php echo e($wish->costume_id); ?>"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart</p>
					                <?php else: ?>
					                	<p class="hover_crt"><i aria-hidden=true class="fa fa-shopping-cart"></i> Out of stock</p>
					                <?php endif; ?>
					            </div>
					        </div>
					        <div class="slider_cnt">
					            <h4><a href="/product<?php echo e($wish->url_key); ?>"></a></h4>
					            <span class="cc_brand"><img src="/img/chrysalis_brand.png"></span>
								<p><?php echo e($wish->name); ?></p>
								<p class="fav-drs-size"><?php echo e(ucfirst($wish->gender)); ?> <?php if($wish->size=="s"): ?> Small <?php elseif($wish->size=="m"): ?> Medium <?php elseif($wish->size=="l"): ?> Large <?php else: ?> <?php echo e(strtoupper($data[0]->size)); ?> <?php endif; ?></p>
					            <p><?php echo e($wish->price); ?></p>
								<div class="fav_social">
								 <!-- <a href="https://www.facebook.com/bootsnipp"><i id="social-fb" class="fa fa-facebook fa-1x social"></i></a>
								<a href="https://twitter.com/bootsnipp"><i id="social-tw" class="fa fa-twitter fa-1x social"></i></a>
								<a href="https://plus.google.com/+Bootsnipp-page"><i id="social-gp" class="fa fa-envelope fa-1x social"></i></a> -->
								<div class="sharethis-inline-share-buttons" data-url="<?php echo e(URL::to('/product'.$wish->url_key.'')); ?>" data-title="<?php echo e($wish->name); ?>"></div>

								
					        </div>
							</div>
					    </div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				<?php else: ?>
					<div  class="col-md-3 col-sm-4 col-xs-6">There are no items in your list.</div>
				<?php endif; ?>

				</div>
			</div>
	</div>


   </section>    
       
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('/assets/frontend/js/jquery-ui.js')); ?>"></script>
<script src="<?php echo e(asset('/js/ohsnap.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/js/pages/costume-fav.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/js/pages/costume-like.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/js/pages/mini_cart.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/vendors/lobibox-master/js/notifications.js')); ?>"></script>
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=595c7a060f8114001101959f&product=inline-share-buttons"></script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
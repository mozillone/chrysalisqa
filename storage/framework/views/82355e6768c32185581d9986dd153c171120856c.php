<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/costumes_list.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/vendors/lobibox-master/css/lobibox.css')); ?>">
<style>
.list_products.wish_lists .col-md-3.col-sm-4.col-xs-6 {
    width: 20%;
}
p.list-sec-rm1.fav_costume {
    text-transform: uppercase;
}
p.list-sec-rm1.fav_costume i {
    color: #ee4266;
}
p.list-sec-rm1.fav_costume sapn.active {
    margin-right: 5px;
}
.fav_social a i {
    color: #60c5ac;
    margin-right: 10px;    font-size: 16px;
}
.wish_lists .prod_box .slider_cnt p {
    color: #000;
    font-size: 14px;
    font-family: Proxima-Nova-Regular;
    font-weight: 600;
    margin-bottom: 0px;
}
.wish_lists .prod_box .slider_cnt p.fav-drs-size {
    font-size: 13px;
    color: #b2b2b2;
    font-family: Proxima-Nova-Semibold;
    margin: 3px 0px 10px 0px;
}
.fav_social {
    margin-top: 15px;
}
</style>
 <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 	<section class="content create_section_page">
 	 	<div id="ohsnap"></div>
		<div class="prodcut_list_page">
			<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="list-sec-rm">
						<div class="col-md-6">
							<p class="list-sec-rm1 fav_costume"><sapn class="active"><i aria-hidden=true class="fa fa-heart-o"></i></sapn> My Favorties (<?php echo e(helper::getMyWishlistCount()); ?>)</p>
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
					            <a href="/product<?php echo e($wish->url_key); ?>"><img class="img-responsive" <?php if($wish->image!=null && file_exists(public_path
					            ('costumers_images/Medium/'.$wish->image.''))): ?> src="/costumers_images/Medium/<?php echo e($wish->image); ?>" <?php else: ?> src="/costumers_images/default-placeholder.jpg" <?php endif; ?>/></a>
					            <div class="hover_box">
					                <p class="like_fav">
					                	<a href="#" onclick="return false;" class="like_costume" data-costume-id="<?php echo e($wish->costume_id); ?>">
					                		<span  <?php if($wish->is_like=='1'): ?> class="active" <?php endif; ?>><i aria-hidden="true" class="fa fa-thumbs-up"></i><?php echo e($wish->like_count); ?></span>
					                	</a>
					                  	<a href="#" onclick="return false;" class="delete" data-costume-id="<?php echo e($wish->costume_id); ?>">
					                		<span class="active"><i aria-hidden="true" class="fa fa-heart"></i></span>
					                	</a>
					                </p>
					                <p class="hover_crt add-cart" data-costume-id="<?php echo e($wish->costume_id); ?>"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart</p>
					            </div>
					        </div>
					        <div class="slider_cnt">
					            <h4><a href="/product<?php echo e($wish->url_key); ?>"></a></h4>
								<p><?php echo e($wish->name); ?></p>
								<p class="fav-drs-size"><?php echo e(ucfirst($wish->gender)); ?> <?php if($wish->condition=="brand_new"): ?> Brand New <?php elseif($wish->condition=="like_new"): ?> Like New <?php else: ?> <?php echo e(ucfirst($data[0]->condition)); ?> <?php endif; ?></p>
					            <p><?php echo e($wish->price); ?></p>
								<div class="fav_social">
								 <a href="https://www.facebook.com/bootsnipp"><i id="social-fb" class="fa fa-facebook fa-1x social"></i></a>
								<a href="https://twitter.com/bootsnipp"><i id="social-tw" class="fa fa-twitter fa-1x social"></i></a>
								<a href="https://plus.google.com/+Bootsnipp-page"><i id="social-gp" class="fa fa-envelope fa-1x social"></i></a>
								
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
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo e(asset('/js/ohsnap.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/js/pages/costume-fav.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/js/pages/costume-like.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/js/pages/mini_cart.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/vendors/lobibox-master/js/notifications.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
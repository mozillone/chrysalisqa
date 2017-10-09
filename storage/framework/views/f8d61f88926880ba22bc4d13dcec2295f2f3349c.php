<?php $__env->startSection('title'); ?>
	Home@parent
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="content create_section_page" ng-controller="ListingsController">
     <div class="container">
    	<div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
	        <div class="col-md-6 col-sm-5 pull-right">
				<div class="page-not-found-img"><img alt="404" src="<?php echo e(asset('img/404.png')); ?>" /></div>
			</div>
			<div class="col-md-6 col-sm-7">
			<h1>Sorry , the page was not found</h1>
			<p>The link you followed probably broken,or the page has been removed.</p>
			<p>Return to <a href="/">home page</a></p>
			</div>
        </div>
        </div>
     </div>
   </section>    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
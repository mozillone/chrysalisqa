<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta property="fb:app_id" content="1984025911869654"/> 
		<meta property="og:type" content="website">
        <?php echo Meta::tag('title'); ?>

        <?php echo Meta::tag('description'); ?>

        <!-- Added by Gayatri -->
        <?php echo Meta::tag('url'); ?>

        <?php echo Meta::tag('image'); ?>

		<meta property="og:image:width" content="200">
		<meta property="og:image:height" content="200">
		<!-- End  -->
		<link rel="icon" type="image/png" href="<?php echo e(asset('img/favicon.png')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/chrysalis.css')); ?>">
		<link href="<?php echo e(asset('/assets/frontend/vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/vendors/lobibox-master/css/lobibox.css')); ?>">
		<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=59ca6d8233c1af00121cdbbe&product=unknown' async='async'></script>
		<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=59ca6d8233c1af00121cdbbe&product=custom-share-buttons"></script>
		
		<?php echo $__env->yieldContent('styles'); ?>
	</head>
	<body ng-app="app">
		<div class="main-container">
			<section class="main_header">
			<?php echo $__env->make('frontend.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('frontend.partials.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</section>
			<?php echo $__env->yieldContent('content'); ?>
			<?php echo $__env->make('frontend.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		<div class="img-loading hide"><img src="/img/chackout.gif"/></div>
      		
		<script src="<?php echo e(asset('/js/jquery-2.2.4.js')); ?>"></script>
		<script src="<?php echo e(asset('/vendors/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
		<script src="<?php echo e(asset('/angular/lib/angular.js')); ?>"></script>
		<script src="<?php echo e(asset('/angular/lib/angular-datatables.min.js')); ?>"></script>
		<script src="<?php echo e(asset('/vendors/datatables/jquery.dataTables.min.js')); ?>"></script>
		<script src="<?php echo e(asset('angular/lib/angular-datatables.min.js')); ?>"></script>
		<script src="<?php echo e(asset('/angular/app.js')); ?>"></script>
		<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
		<script src="<?php echo e(asset('/assets/frontend/js/custom.js')); ?>"></script>
		<script src="<?php echo e(asset('/angular/directives/datepicker.js')); ?>"></script>
		<script src="<?php echo e(asset('/assets/frontend/vendors/lobibox-master/js/notifications.js')); ?>"></script>
		
		
		
		<?php echo $__env->yieldContent('footer_scripts'); ?>
	</body>
</html>
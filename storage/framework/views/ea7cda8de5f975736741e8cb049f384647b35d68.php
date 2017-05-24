<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>
        	<?php $__env->startSection('title'); ?>
            Chrysalis
        	<?php echo $__env->yieldSection(); ?>
   		 </title>
		<link rel="icon" type="image/png" href="<?php echo e(asset('img/favicon.png')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/chrysalis.css')); ?>">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<?php echo $__env->yieldContent('styles'); ?>
	</head>
	<body ng-app="app">
		<section class="main_header">
		<?php echo $__env->make('frontend.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('frontend.partials.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</section>
		<?php echo $__env->yieldContent('content'); ?>
		<?php echo $__env->make('frontend.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      		
		<script src="<?php echo e(asset('/js/jquery-2.2.4.js')); ?>"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
		<script src="<?php echo e(asset('/vendors/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
		<script src="<?php echo e(asset('/angular/lib/angular.js')); ?>"></script>
		<script src="<?php echo e(asset('/angular/lib/angular-datatables.min.js')); ?>"></script>
		<script src="<?php echo e(asset('/vendors/datatables/jquery.dataTables.min.js')); ?>"></script>
		<script src="<?php echo e(asset('angular/lib/angular-datatables.min.js')); ?>"></script>
		<script src="<?php echo e(asset('/angular/app.js')); ?>"></script>
		<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
		<script src="<?php echo e(asset('/assets/frontend/js/custom.js')); ?>"></script>
		<script src="<?php echo e(asset('/angular/directives/datepicker.js')); ?>"></script>
		
		
		<?php echo $__env->yieldContent('footer_scripts'); ?>
	</body>
</html>
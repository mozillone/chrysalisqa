<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
    <title><?php $__env->startSection('title'); ?>
           <?php echo e(!empty($title) ? $title.' |' : ''); ?>  Chrysalis
       <?php echo $__env->yieldSection(); ?></title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" href="<?php echo e(asset('/img/favicon.png')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/bootstrap/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/dist/css/AdminLTE.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/dist/css/skins/_all-skins.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('/assets/admin/css/custom.css')); ?>">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">


  
<!-- <link rel="<?php echo e(asset('/assets/admin/css/bootstrap.css')); ?>"></script>
<link rel="<?php echo e(asset('/assets/admin/css/bootstrap-theme.css')); ?>"></script>
<link rel="<?php echo e(asset('/assets/admin/css/bootstrap-theme.min.css')); ?>"></script>
<link rel="<?php echo e(asset('/assets/admin/css/github.min.css')); ?>"></script>
  <link rel="<?php echo e(asset('/assets/admin/css/clockpicker.css')); ?>"></script> -->
  
  
  <?php echo $__env->yieldContent('header_styles'); ?>

 </head>
<body class="hold-transition skin-blue sidebar-mini" ng-app="app">
<div class="wrapper">
    <?php echo $__env->make('admin.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('admin.partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="content-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
   <?php echo $__env->make('admin.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script src="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/bootstrap/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/dist/js/app.min.js')); ?>"></script>
<script src="<?php echo e(asset('/angular/lib/angular.js')); ?>"></script>
<script src="<?php echo e(asset('/angular/lib/angular-datatables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('/angular/Admin/app.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/admin/js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('/angular/Admin/directives/datepicker.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('angular/lib/angular-datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('/angular/directives/datepicker.js')); ?>"></script>


	   

 <?php echo $__env->yieldContent('footer_scripts'); ?>
 
 
</body>
</html>

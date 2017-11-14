<?php $__env->startSection('title'); ?>
Categories List@parent
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
 <section class="content-header">
    <h1>Categories</h1>
    <ol class="breadcrumb">
    <li>
        <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Categories List</li>
  </ol>
</section>
<section class="content" ng-controller="CategoriesController">
    <div class="row">
        <div class="col-md-12">
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
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Categories List</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                    <a href="<?php echo e(route('categories-create')); ?>" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add Category</a>
                    </div>
                </div>
                <div class="box-body">
			           <div class="table-responsive cate_search_div">
          					<table datatable dt-options="dtOptions" dt-columns="dtColumns"
                           				class="table table-bordered table-hover table-striped" id="dtTable">
          					</table>
					       </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?> 
<script src="<?php echo e(asset('/angular/Admin/Categories/Controllers/categories-lists.js')); ?>"></script>
<script src="<?php echo e(asset('/angular/Admin/Categories/Services/attributes.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('title'); ?>
Promotions List@parent
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
 <section class="content-header">
    <h1>Promotions</h1>
    <ol class="breadcrumb">
    <li>
        <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Promotions List</li>
  </ol>
</section>
<section class="content" ng-controller="PromotionsController">
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
                    <h3 class="box-title">Promotions List</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                    <a href="<?php echo e(route('promotion-create')); ?>" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add promotion</a>
                    </div>
                </div>
                <div class="box-body">
			           <div class="table-responsive">
                 <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>Coupon Name</th>
                    <th>Applied From</th>
                    <th>Applied To</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <tr>
                      <input type="hidden" class="form-control token"  name="csrf-token" value="<?php echo e(csrf_token()); ?>">
                      <td><input type="text" class="form-control" ng-model="search.name" name="name" placeholder="Coupon Name"></td>
                      <td><input type="text" class="form-control" datepicker ng-model="search.from_date" name="from_date" placeholder="Applied From"></td>
                      <td><input type="text" class="form-control" datepicker ng-model="search.date_end" name="date_end" placeholder="Applied To"></td>
                      <td>
                        <select name="count" class="form-control" id="count" ng-model="search.cats" >
                            <option value=""> All </option>  
                            <?php $__currentLoopData = $cats_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cats): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <option value="<?php echo e($cats->category_id); ?>"><?php echo e($cats->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </select>
                      </td>
                      <td>
                        <select name="mySelect" class="form-control" id="mySelect" ng-model="search.costumes">
                          <option value=""> All </option>  
                          <?php $__currentLoopData = $costumes_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $costumes): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <option value="<?php echo e($costumes->costume_id); ?>"><?php echo e($costumes->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </select>
                      </td>
                      <td><button class="btn btn-primary user-list-search" ng-click="seachPromotions(search)">Search</button></td>
                    </tr>
                  </tbody>
              </table>
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
<script src="<?php echo e(asset('/angular/Admin/Promotions/Controllers/promotions-lists.js')); ?>"></script>
<script src="<?php echo e(asset('/angular/Admin/Promotions/Services/promotions.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('/angular/Admin/directives/datepicker.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
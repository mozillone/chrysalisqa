<?php $__env->startSection('title'); ?> 
Reported Costumes List @parent
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
 <section class="content-header">
    <h1>Reported Costumes</h1>
    <ol class="breadcrumb">
    <li>
        <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Reported Costumes</li>
  </ol>
</section>
<section class="content" ng-controller="CostumeReportsController">
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
                    <h3 class="box-title">Reported Costumes</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                    </div>
                </div>
                <div class="box-body">
        <div class="table-responsive">
                <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>Sku</th>
                    <th>Costume Name</th>
                    <th>Reporter Name</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <tr>
                      <input type="hidden" class="form-control token"  name="csrf-token" value="<?php echo e(csrf_token()); ?>">
                      <td><input type="text" class="form-control" ng-model="search.sku_no" name="sku_no" placeholder="SKU #"></td>
                      <td><input type="text" class="form-control" ng-model="search.cst_name" name="cst_name" placeholder="Costume Name"></td>
                      <td><input type="text" class="form-control" ng-model="search.user_name" name="user_name" placeholder="Reporter Name"></td>
                      <td><button class="btn btn-primary user-list-search" ng-click="seachUsers(search)">Search</button></td>
                    </tr>
                  </tbody>
              </table>
        </div>
          <div class="table-responsive">
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
<script src="<?php echo e(asset('angular/Admin/Costumes/Controllers/costume-reports-lists.js')); ?>"></script>
<script src="<?php echo e(asset('angular/Admin/Costumes/Services/reports.js')); ?>"></script>
<script src="<?php echo e(asset('angular/Admin/ExportCsv/Services/ExportCsv.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>































<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
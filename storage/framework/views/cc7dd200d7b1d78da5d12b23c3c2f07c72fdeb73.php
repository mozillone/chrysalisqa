<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
 <section class="content-header">
    <h1>Transactions</h1>
    <ol class="breadcrumb">
    <li>
        <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Transactions</li>
  </ol>
</section>
<section class="content" ng-controller="TransactionsController">
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
                    <h3 class="box-title">Transactions List</h3>
                   </div>
                <div class="box-body">
        <div class="table-responsive">
                <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>Order ID</th>
					          <th>Transaction ID</th>
					          <th>Customer Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Transaction type</th>
                  </thead>
                  <tbody>
                    <tr>
                      <input type="hidden" class="form-control token"  name="csrf-token" value="<?php echo e(csrf_token()); ?>">
                      <td><input type="text" class="form-control" ng-model="search.order_id"  placeholder=""></td>
                      <td><input type="text" class="form-control" ng-model="search.id"  placeholder=""></td>
					            <td><input type="text" class="form-control" ng-model="search.user_name"  placeholder=""></td>
					             <td><input type="text" class="form-control" datepicker ng-model="search.from_date" placeholder="Order From"></td>
                      <td><input type="text" class="form-control" datepicker ng-model="search.date_end" placeholder="Order To"></td>
                   
                     <td>
                        <select name="count" class="form-control" id="count" ng-model="search.status" >
                          <option value=""> All </option>  
                          <option value="authorized">Authorized</option>
                          <option value="captured">Captured</option>
                          <option value="voided">Voided</option>
                          <option value="reunded">Refunded</option>
                        </select>
                      </td>
					   
                      <td><button class="btn btn-primary user-list-search" ng-click="seachTransactions(search)">Search</button></td>
                    </tr>
                  </tbody>
              </table>
        </div>
        <div class="row">
                    <div class="col-md-12">
                      <div class="pull-right user-list">
                        <a href="javascript:void(0);" class="btn btn-xs btn-success" id="export" ng-click="ordersExportCSV()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="fa fa-download"></i></a>
                       </div>
                    </div>
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

<script src="<?php echo e(asset('angular/Admin/Transactions/Controllers/transactions-lists.js')); ?>"></script>
<script src="<?php echo e(asset('angular/Admin/Transactions/Services/transactions.js')); ?>"></script>
<script src="<?php echo e(asset('angular/Admin/ExportCsv/Services/ExportCsv.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>































<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
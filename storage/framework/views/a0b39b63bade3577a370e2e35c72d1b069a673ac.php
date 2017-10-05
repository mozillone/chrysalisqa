<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>Users</h1>
    <ol class="breadcrumb">
    <li>
        <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Recent Orders</li>
  </ol>
</section>
<section class="content" ng-controller="BuyerOrdersController">

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
             <div class="box-header">
					<h3 class="box-title heading-agent col-md-12">Recent Orders</h3>
				</div>
  				  <ul class="nav nav-tabs">
					  <li ><a  href="/customer-edit/<?php echo e($userid); ?>">Profile</a></li>
					  <li><a href="/user-costumes-list/<?php echo e($userid); ?>">Costumes</a></li>
					  <li><a href="/user-costumessold-list/<?php echo e($userid); ?>">Costumes Sold</a></li>
					  <li  class="active"><a  href="/user-recentorders-list/<?php echo e($userid); ?>">Recent Orders</a></li>
					  <li><a  href="/user-credithistory-list/<?php echo e($userid); ?>">Credit History</a></li>
					  <li><a  href="/user-payementprofiles-list/<?php echo e($userid); ?>">Payment Profiles</a></li>
				</ul>
	              <div class="box-body">
        			<div class="table-responsive">
		                <table class="table table-striped table-bordered user-list-table">
		                  <thead>
		                    <th>Order ID</th>
					        <th>From</th>
		                    <th>To</th>
		                    <th>Status</th>
		                  </thead>
		                  <tbody>
		                    <tr>
		                      <input type="hidden" class="form-control token"  name="csrf-token" value="<?php echo e(csrf_token()); ?>">
		                      <input type="hidden" class="form-control"  name="user_id" value="<?php echo e($userid); ?>">
		                      <td><input type="text" class="form-control" ng-model="search.order_id"  placeholder=""></td>
		                 	  <td><input type="text" class="form-control" datepicker ng-model="search.from_date" placeholder="Order From"></td>
		                  	  <td><input type="text" class="form-control" datepicker ng-model="search.date_end" placeholder="Order To"></td>
		                   
		                     <td>
		                        <select name="count" class="form-control" id="count" ng-model="search.status" >
		                          <option value=""> All </option>  
		                          <option value="Processing">Processing</option>
		                          <option value="Shipping">Shipping</option>
		                          <option value="Shipped">Shipped</option>
		                          <option value="Dispatched">Dispatched</option>
		                          <option value="Delivered">Delivered</option>
		                          <option value="Returned">Returned</option>
								            </select>
		                      </td>
							   
		                      <td><button class="btn btn-primary user-list-search" ng-click="seachOrders(search)">Search</button></td>
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
<script src="<?php echo e(asset('angular/Admin/UserManagement/Controllers/buyerorders-lists.js')); ?>"></script>
<script src="<?php echo e(asset('angular/Admin/UserManagement/Services/orders.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>

<script src="<?php echo e(asset('/assets/frontend/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/js/buttons.print.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
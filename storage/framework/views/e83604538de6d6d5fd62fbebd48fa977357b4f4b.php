<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/sweetalert/dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<section class="content-header">
	<h1>Users</h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
		</li>
		<li>
			<a href="<?php echo e(url('Users-list')); ?>">Users List</a>
		</li>
		<li class="active"> Payment Profiles</li>
	</ol>
	
</section>
<?php
	$usersdid=Request::segment(2);
?>
<section class="content" >
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title heading-agent col-md-12">Users</h3>
				</div>
				<div class="box-body">
				<!--Tabs code starts here-->
				 <ul class="nav nav-tabs">
  <li><a  href="/customer-edit/<?php echo e($userid); ?>">Profile</a></li>
  <li><a href="/user-costumes-list/<?php echo e($userid); ?>">Costumes</a></li>
  <li><a href="/user-costumessold-list/<?php echo e($userid); ?>">Costumes Sold</a></li>
  <li><a  href="/user-recentorders-list/<?php echo e($userid); ?>">Recent Orders</a></li>
  <li><a  href="/user-credithistory-list/<?php echo e($userid); ?>">Credit History</a></li>
  <li class="active"><a  href="/user-payementprofiles-list/<?php echo e($userid); ?>">Payment Profiles</a></li>
</ul>
<!--Tab code ends here-->
				
				
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
					<fiv class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Payment Profiles</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                   
                    </div>
                </div>
                <div class="box-body">
        
          <div class="table-responsive">
          <table datatable dt-options="dtOptions" dt-columns="dtColumns"
                        class="table table-bordered table-hover table-striped" id="dtTable">
						<tr>
						<th>Card Holder Name
</th>
						<th>Card No
</th>
						<th>Card Type
</th>
						<th>Exp. Date

</th>
						<th>Created Date
</th>
						<th>Status</th>
						</tr>
						<tr>
						<td colspan="7"><center>No Data Avialable..!!</center></td>
						</tr>
          </table>
          </div>
         </div>
            </div>
			</div>
    </div>
</section>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer_scripts'); ?> 
<script src="<?php echo e(asset('angular/Admin/UserManagement/Controllers/users-lists.js')); ?>"></script>
<script src="<?php echo e(asset('angular/Admin/UserManagement/Services/user_management.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('title'); ?> View Order #<?php echo e($order_id); ?> @parent  <?php $__env->stopSection(); ?>

<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/css/pages/order_summary.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="container content-header view-order_tl_div">
  	<div class="row">
		<div class="col-md-12">
			<nav class="breadcrumb ">
				<a class="breadcrumb-item" href="<?php echo e(url('dashboard')); ?>">Dashboard &nbsp;></a>
				<a class="breadcrumb-item" href="/my/orders">Orders List > &nbsp;</a>
				<span class="breadcrumb-item active">#<?php echo e($order_id); ?> Transactions Info</span>
			</nav>
		</div>
	</div>
</section>
<div class="view-order">
	<section class="container content" ng-controller="OrderShippingsController  ">
		<div class="bg-card">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info view_order_div_blog">
						<div class="viewTabs_rm">
							<?php echo $__env->make('frontend.orders.orders_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="summery">
								<div class="summery-details">
									<div class="summery-info">
										<div class="row">
											<?php if(Session::has('error')): ?>
											<div class="alert alert-danger alert-dismissable">
												<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
												<?php echo e(Session::get('error')); ?>

											</div>
											<?php elseif(Session::has('success')): ?>
											<div class="alert alert-success alert-dismissable">
												<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
												<?php echo e(Session::get('success')); ?>

											</div>
											<?php endif; ?>
											<div class="rencemt_order_table">
												<input type="hidden" name="order_id" value="<?php echo e($order_id); ?>">
												<div class="box-header with-border">
													<h2 class="box-title">#<?php echo e($order_id); ?> Transactions Info</h2>
													</div>
													<div class="box-body">
														<div class="table-responsive auto-scroll-none">
														</div>
														<div class="table-responsive auto-scroll-none">
															<table datatable dt-options="dtOptions" dt-columns="dtColumns"
															class="table table-striped" id="dtTable">
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('footer_scripts'); ?>
	<script src="<?php echo e(asset('angular/Frontend/Orders/Controllers/order-transactions.js')); ?>"></script>
	<script src="<?php echo e(asset('/vendors/datatables/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
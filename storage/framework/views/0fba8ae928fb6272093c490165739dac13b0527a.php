<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/css/pages/order_summary.css')); ?>">
<?php $__env->stopSection(); ?>
<style>

</style>

<?php $__env->startSection('content'); ?>
 <section class="content-header">
    <h1>View Order #<?php echo e($order_id); ?></h1>
    <ol class="breadcrumb">
    <li>
        <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li>
        <a href="<?php echo e(url('orders')); ?>"><i class="fa fa-dashboard"></i> Orders</a>
    </li>
    <li class="active">#<?php echo e($order_id); ?> Shipping Info</li>
  </ol>
</section>
<section class="content" ng-controller="OrderShippingsController">
<div class="view-order">
  <section class="content">
    <div class="bg-card">
      <div class="row">
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
            <input type="hidden" name="order_id" value="<?php echo e($order_id); ?>">
               <?php echo $__env->make('admin.orders.orders_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="box-header with-border">
                    <h3 class="box-title">Dispute Messages</h3>
                   </div>
                <div class="box-body">
      
          <div class="table-responsive">
          <table class="table table-hover">
                  <tr>
                    <th>Message</th>
                    <th>Messaged By</th>
                    <th>Dispute Comment Date</th>
                  </tr>
                    <?php if(isset($total_data['messages'])): ?>
                    <?php $__currentLoopData = $total_data['messages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $messages): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                  <tr>
                    <?php //echo "<pre>";print_r($messages);die; ?>
                    <td><?php echo e($messages->message); ?></td>
                    <td><?php echo e($messages->display_name); ?></td>
                    <td><?php echo e($messages->created_at); ?></td>
                  </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                </table>
          </div>
            </div>
        </div>
    </div>
  </div>
</section>
</div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer_scripts'); ?>
  <script src="<?php echo e(asset('angular/Admin/Orders/Controllers/order-shippings.js')); ?>"></script>
<?php $__env->stopSection(); ?>































<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
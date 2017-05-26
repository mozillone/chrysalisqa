<?php $__env->startSection('title'); ?> View Transaction #<?php echo e($transaction_info[0]->transaction_id); ?> @parent  <?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/css/pages/order_summary.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <section class="content-header">
    <h1>View Transaction #<?php echo e($transaction_info[0]->transaction_id); ?></h1>
  <nav class="breadcrumb">
  <a class="breadcrumb-item" href="<?php echo e(url('dashboard')); ?>">Dashboard &nbsp;&nbsp;></a>
  <a class="breadcrumb-item" href="/transactions">Transactions > &nbsp;</a>
  <span class="breadcrumb-item active">View Transaction #<?php echo e($transaction_info[0]->transaction_id); ?></span>
</nav>
  
</section>
<div class="view-order">
<section class="content">
<div class="bg-card">
    <div class="row">
        <div class="col-md-12">
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
            <div class="box box-info">
                <div class="tab-content">
                <div class="payment-sec">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Transaction Information</h3>
                                        <table>
                                            <tbody>
                                             <tr>
                                                <td>Transaction#:</td>
                                                <td><?php echo e($transaction_info[0]->transaction_id); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Order#:</td>
                                                <td><?php echo e($transaction_info[0]->order_id); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Customer Name:</td>
                                                <td><?php echo e($transaction_info[0]->user_name); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Amount:</td>
                                                <td><?php echo e($transaction_info[0]->price); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Date :</td>
                                                <td><?php echo e($transaction_info[0]->date); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status :</td>
                                                <td><?php echo e($transaction_info[0]->status); ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                  </div>

                            </div>
                  </div>
                </div><!-- tab content -->
               
            </div>

        </div>
    </div>
  </section>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
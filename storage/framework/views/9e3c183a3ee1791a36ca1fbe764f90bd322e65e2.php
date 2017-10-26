<?php $__env->startSection('title'); ?>  @parent  <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->

             <section class="content-header">
                <h1>Dashboard</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo e(url('/admin/dashboard')); ?>">
                            <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                            Dashboard
                        </a>
                    </li>
                </ol>
            </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
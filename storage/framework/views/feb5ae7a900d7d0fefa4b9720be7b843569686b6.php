<?php if(count($errors->all()) > 0): ?>
<div class="alert alert-danger alert-block alert-dismissable">
	<button type="button" class="close" data-dismiss="alert">&times;</button>	
	Please check the form below for errors
</div>
<?php endif; ?> <?php if($message = Session::get('success')): ?>
<div class="alert alert-success alert-block alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<?php if(is_array($message)): ?> <?php $__currentLoopData = $message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> <?php echo e($m); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	<?php else: ?> <?php echo e($message); ?> <?php endif; ?>
</div>
<?php endif; ?> <?php if($message = Session::get('error')): ?>
<div class="alert alert-danger alert-block alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<?php if(is_array($message)): ?> <?php $__currentLoopData = $message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> <?php echo e($m); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	<?php else: ?> <?php echo e($message); ?> <?php endif; ?>
</div>
<?php endif; ?> <?php if($message = Session::get('warning')): ?>
<div class="alert alert-warning alert-block alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<?php if(is_array($message)): ?> <?php $__currentLoopData = $message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> <?php echo e($m); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	<?php else: ?> <?php echo e($message); ?> <?php endif; ?>
</div>
<?php endif; ?> <?php if($message = Session::get('info')): ?>
<div class="alert alert-info alert-block alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<?php if(is_array($message)): ?> <?php $__currentLoopData = $message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> <?php echo e($m); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	<?php else: ?> <?php echo e($message); ?> <?php endif; ?>
</div>
<?php endif; ?>

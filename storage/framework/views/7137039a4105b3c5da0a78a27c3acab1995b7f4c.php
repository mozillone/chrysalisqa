<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="content create_section_page">
 <div class="container">
	<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
        	<h1>Messages</h1>
        </div>
    </div>
 </div>
</section>
<section class="content create_section_page">
	<div class="container">
		<div class="row">
			<?php echo "<pre>";
			print_r($all_data);die;
			if (isset($all_data) && !empty($all_data)) {
				$conversations = $all_data;
			}else{
         		$conversations = "";
			}


			 ?>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
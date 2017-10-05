<?php $__env->startSection('styles'); ?>
<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/costumes_list.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<?php echo $pageData->description ?>
	<div class="row">
		<div class="col-md-12 upload_page_accordians">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?php if(count($faqs)): ?>
				<?php $counter = 0; ?>
				<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne-<?php echo e($faq->id); ?>">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne-<?php echo e($faq->id); ?>" <?php echo (($counter == 0) ? "aria-expanded='true'" : "aria-expanded='false'") ?> aria-controls="collapseOne<?php echo e($faq->id); ?>" class="clps">
								<?php echo e($faq->title); ?>

								<span class="more-expnd"><i class="more-less glyphicon glyphicon-triangle-bottom"></i></span>
							</a>
						</h4>
					</div>
					<div id="collapseOne-<?php echo e($faq->id); ?>" class="panel-collapse collapse <?php if($counter==0): ?> <?php endif; ?>" role="tabpanel" aria-labelledby="headingOne-<?php echo e($faq->id); ?>">
						<div class="panel-body">
							<?php echo e($faq->description); ?>

						</div>
					</div>
				</div>
				<?php $counter++; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				<?php else: ?>
				<div>No Results Found</div>
				<?php endif; ?>
			</div><!-- panel-group -->
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
	});
    function toggleIcon(e) {
        $(e.target)
		.prev('.panel-heading')
		.find(".more-less")
		.toggleClass('glyphicon-triangle-bottom glyphicon-triangle-top');
	}
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css" rel="stylesheet">
    <meta name="<?php echo e($pageData->meta_title); ?>" content="<?php echo e($pageData->meta_desc); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?= $pageData->description; ?>
    <div class="container how-it-works-page steps_slider1"> 
        <div class="additional-info">
            <h3>Additional Information</h3>
            <?php if(count($faqs)): ?>
                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <p><?php echo e($faq->title); ?></p>
            <div class="panel-body">
                <?php echo $faq->description; ?>

            </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php else: ?>
                <div>No Results Found</div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
				<script>
				$(document).ready(function() {
				$('.steps_slider1.owl-carousel').owlCarousel({
					loop:true,
					margin:10,
					responsiveClass:true,
					navigation:true,
					navigationText: [
					"<i class='fa fa-chevron-left'></i>",
					"<i class='fa fa-chevron-right'></i>"
					],
					items : 4,
					itemsDesktop : [1199,4],
					itemsDesktopSmall : [979,4],
					itemsTablet: [768,4],
					itemsMobile: [767,1]
				});
				});
				</script>
				
				
				<script type="text/javascript">
	if (jQuery(window).width() < 767) 
	{
		var $accordionIO = $('.accordion .pluss');
		$accordionIO.prev('.infos').hide();
		
		$accordionIO.click(function() {
			$(this).prev('.infoss').slideToggle();
		});
		
		$(".accordion h3").click(function() {
			//Inner 
			var jqInner = $(this).next();
			if (jqInner.is(":visible")) {
				jqInner.slideUp()
				
			} else
			
			{
				jqInner.slideDown()
				
			}
			$(this).toggleClass('pluss minuss');
		})
	}
</script>
    <script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/frontend/js/pages/event.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/owl.carousel.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
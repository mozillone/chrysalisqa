<?php $faqs = helper::getSupportFaqs();?>

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/drop_uploader.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/costumes_list.css')); ?>">
<style type="text/css">.cstm-alrt {
    padding: 15px;    margin-bottom: 30px;}
	.alrt-div{clear: left;}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container press-page">
	<div class="row contact-page">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="progressbar_main request-bag">
                <h2>SUPPORT & CONTACT</h2>
			</div>
		</div>
		<div  class="alrt-div col-md-12 col-sm-12 col-xs-12   ">
			<?php if(Session::has('error')): ?>
			<div class=" cstm-alrt alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?php echo e(Session::get('error')); ?>

			</div>
			<?php elseif(Session::has('success')): ?>
			<div class=" cstm-alrt  alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?php echo e(Session::get('success')); ?>

			</div>
			<?php endif; ?>
			</div>  
			<div class="col-md-12 col-sm-12 col-xs-12 ccnt_suprt_head">
            <p>Please take a moment to review the FAQs below. We might have already answered your question!</p>
		</div> 
	</div>
	<div class="col-md-12 upload_page_accordians cnt_sprt_page">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php $counter = 0; ?>
            <?php if(isset($faqs) && count($faqs)): ?>
			<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="heading-<?php echo e($faq->id); ?>">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo e($faq->id); ?>" <?php echo (($counter == 0) ? "aria-expanded='true'" : "aria-expanded='false'") ?> aria-controls="collapse-<?php echo e($faq->id); ?>" class="clps">
							<?php echo e($faq->title); ?>

							<span class="more-expnd">
								<i class="more-less1 glyphicon glyphicon-plus hidden-sm hidden-md hidden-lg"></i>
								<i class="more-less glyphicon glyphicon-triangle-top "></i>
							</span>
						</a>
					</h4>
				</div>
				<div id="collapse-<?php echo e($faq->id); ?>" class="panel-collapse collapse  <?php if($counter==0): ?>  <?php endif; ?>" role="tabpanel" aria-labelledby="heading-<?php echo e($faq->id); ?>" role="tabpanel"
				aria-labelledby="heading-<?php echo e($faq->id); ?>">
					<div class="panel-body">
						<?php echo $faq->description; ?>

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
	<div class="col-md-6 col-sm-6 col-xs-12 cnt_sprt_map ">
		<div id="map" style="width:100%;height:540px;background:#f1f1f1;">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2648.833038448318!2d-89.2826271!3d48.402149400000006!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4d59202c99c9252f%3A0x4cb61e2f5a8d87e!2s218+Humber+Crescent%2C+Thunder+Bay%2C+ON+P7C+5X2!5e0!3m2!1sen!2sca!4v1424370904204" width=100% height="800" frameborder="0" style="border:0"></iframe></div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 submission-form contact-page">
		<h3>Contact Chrysalis</h3>
		<p class="cnt_phone">732-618-8533</p>
		<form   method="POST" id="support-insert" name="support-insert" action="insert-support">
			<?php echo e(csrf_field()); ?>

			<div class="form-group">
				<label>Title*</label>
				<input type="text"  name="reason"  id="reason" class="form-control" autocomplete="off" >
			</div>
			<div class="form-group">
				<label>Full Name*</label>
				<input type="text"  name="fullname" id="fullname" autocomplete="off"  class="form-control" 
				value="<?php if(Auth::user()){ 
					echo $support_details->first_name;
					echo $support_details->last_name; 
					} else { 
					echo ""; 
				}
				?>">
                </div>
                <div class="form-group">
                    <label>Username*</label>
                    <input type="text"  name="username" id="username"   autocomplete="off" class="form-control" value="<?php if(Auth::user()){ echo $support_details->display_name;  } else { echo ""; } ?>">
				</div>
				<div class="form-group">
                    <label>Order Id*</label>
                    <input type="text"  name="orderid" id="orderid" autocomplete="off"   class="form-control">
				</div>
                <div class="form-group">
                    <label>Email Address*</label>
                    <input type="text"  name="email"  id="email"  autocomplete="off" class="form-control" value="<?php if(Auth::user()){  echo $support_details->email; } else { echo "";} ?>">
				</div>
                <div class="form-group">
                    <label>Select Type*</label>
                    <select name="ticket_type" id="ticket_type" class="form-control" autocomplete="off">
                        <option value="">Select Type</option>
                        <option value="Order">Order</option>
                        <option value="Dispute">Dispute</option>
                        <option value="Unique">Unique</option>
                        <option value="shipping">Shipping</option>
					</select>
				</div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea rows="5"  name="ticket_message" autocomplete="off"  id="ticket-message" class="form-control"></textarea>
				</div>
                <div class="form-group">
                    <div class="login-btn">
                        <button class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script>
    function triggerToggle(){
        var counter = '<?=$counter;?>';
        if(counter == 0){
            $('.collapse').collapse.in();
		}
	}
    triggerToggle();
	if (jQuery(window).width() > 768) 
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
	});
    function toggleIcon(e) {
        $(e.target)
		.prev('.panel-heading')
		.find(".more-less")
		.toggleClass('glyphicon-triangle-bottom glyphicon-triangle-top ');
	}
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
<script>
	if (jQuery(window).width() < 767) 
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
	});
    function toggleIcon(e) {
        $(e.target)
		.prev('.panel-heading')
		.find(".more-less1")
		.toggleClass('glyphicon-plus glyphicon-minus ');
	}
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript">
	$("#support-insert").validate({
		rules: {
			reason:{
				required: true,
			},
			ticket_message:{
				required: true,
			},
			ticket_type:{
				required: true,
			},
			orderid:{
				required: true,
				number:true,
			},
			username:{
				required:true,
			},
			fullname:{
				required:true,
			},
			email:{
				required:true,
				email:true,
			},
		}
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
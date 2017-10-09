<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/drop_uploader.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/costumes_list.css')); ?>">
  <style type="text/css">

    </style>
 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('content'); ?>
<div class="container jobs-page">


    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="progressbar_main request-bag">
                <h2><?php if(!empty($pageData->title)): ?><?php echo e($pageData->title); ?> <?php endif; ?></h2>

            </div>
            <div class="alrt-div ">
             <?php if(Session::has('error')): ?>
                    <div class=" cstm-alrt alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo e(Session::get('error')); ?>

                    </div>
                    <?php elseif(Session::has('success')): ?>
                <!--     <div class=" cstm-alrt  alert-success alert-dismissable" style="margin-top: 101px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo e(Session::get('success')); ?>

                    </div> -->

                     <div class="alert alert-success jobs_sucs">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong></strong> <?php echo e(Session::get('success')); ?>

  </div>
                    <?php endif; ?>
                  
  </div> 

			<?php
                if(!empty($pageData->description)){
                    echo $pageData->description;
                }
            ?>
			
			<div class="col-md-12  col-sm-12 col-xs-12 upload_page_accordians job-acrnds">
			<h4 class="acrdin_tle">If you think you’re the right fit for Chrysalis, have a look at our available job opportunities below!</h4>
			
		 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php $counter = 0; ?>
       <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading-<?php echo e($job->job_id); ?>">
                <h4 class="panel-title">

                    <a role="button" data-toggle="collapse" data-parent="#accordion" id="jobappen-<?php echo e($job->job_id); ?>" href="#collapse-<?php echo e($job->job_id); ?>" <?php echo (($counter == 0) ? "aria-expanded='true'" : "aria-expanded='false'") ?> aria-controls="collapse-<?php echo e($job->job_id); ?>" class="clps jobsollut<?php echo e($job->job_id); ?>">
                      <input type="hidden" name="jobs_id" id="jobs_id" value="<?php echo e($job->job_id); ?>"> 
                       <?php echo e($job->job_title); ?>

                       
					      <span class="more-expnd">
										<!--<i class="more-less1 glyphicon glyphicon-plus hidden-sm hidden-md hidden-lg"></i>-->
								<i class="more-less glyphicon glyphicon-triangle-top "></i> 
						  </span>
                           
                    </a>
                </h4>
            </div>
            <div id="collapse-<?php echo e($job->job_id); ?>" class="panel-collapse collapse <?php if($counter==0): ?>  <?php endif; ?>" role="tabpanel" aria-labelledby="heading-<?php echo e($job->job_id); ?>">
                <div class="panel-body">
                     <?php echo $job->job_description; ?>

                </div>
            </div>
        </div>
        <?php $counter++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 
        <input type="hidden" name="jobid" id="jobid" value="<?php echo e($job_id); ?>" > 

        
	


    </div><!-- panel-group -->
    
				</div>
			
			 <form name="insert_jobs" id="insert_jobs" method="post" action="/contactchrysalis" enctype="multipart/form-data" novalidate autocomplete="off">
              <?php echo e(csrf_field()); ?>

			<div class="col-md-12 col-sm-12  col-xs-12   jobs_frm">
				<div class="form-group col-lg-6 col-md-6">
					<label>Full Name*</label>
					<input type="text" name="fullname" id="fullname" class="form-control" id="" value="">
				</div>
				<div class="form-group col-lg-6">
					<label>Linked In Profile URL*</label>
					<input type="text" name="linkedinurl" class="form-control" id="linkedinurl" value="">
				    <span id="linkedinerror" style="color:red;font-weight:bold"></span>
                </div>
					<div class="form-group col-lg-6">
					<label>Email*</label>
					<input type="text" name="email" class="form-control" id="email" value="">
				</div>
				<div class="form-group col-lg-6">
					<label>Website*</label>
					<input type="text" name="website" class="form-control" id="website" value="">
				    <span id="websiteerror" style="color:red;font-weight:bold">
                </div>
					<div class="form-group col-lg-6">
					<label>Phone*</label>
					<input type="text" name="phone" maxlength="12" class="form-control" id="phone">
				</div>
					<div class="form-group col-lg-6">
					<label>Portfolio Link*</label>
					<input type="text" name="portfolio_link" class="form-control" id="portfolio_link" value="">
				     <span id="portfolioerror" style="color:red;font-weight:bold">
                </div>
					<div class="form-group col-lg-6">
					<label>Resume/CV*</label>
				<input type="file" name="resume" id="resume" class="form-control">
				<span id="resumeerror" style="color:red;font-weight:bold">
                </div>
					<div class="form-group col-lg-6">
					<label>Personal Hero</label>
					<input type="text" name="personal_hero" class="form-control" id="personal_hero" value="">
				</div>
						<div class="form-group col-lg-6">
					<label>Cover Letter*</label>
					<input type="file" name="document_upload" id="document_upload" class="form-control">
				    <span id="documenterror" style="color:red;font-weight:bold">
                </div>
								<div class="form-group1 form-group col-lg-6 col-xs-12">
								<p class="job-btn"><input type="submit" name="submit" value="Submit" class="btn btn-primary"></p>
				</div>
			</div>
		</form>
        </div>
        

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script>
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
	

    
    function triggerToggle(){
        var counter = '<?=$counter;?>';
        if(counter == 0){
            $('.collapse').collapse.in();   
        }
    }

	$(document).ready(function(){
	
    $('[data-toggle="tooltip"]').tooltip();

    triggerToggle();

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
<!--Validations for form code starts here-->
<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/admin/js/pages/events.js')); ?>"></script>
<script type="text/javascript">
$('.more-expnd').on('click',function(a){
var jobid=$('#jobid').val();


});
 $("#insert_jobs").validate({
   
            rules: {
                fullname:{
                        required: true,
                       
                    },
                linkedinurl:{
                        required: true,
                        
                    },
                email:{
                        required: true,
                        email:true,
                    },

                website:{
                     required: true,
            
                },
                phone:{
                    required:true,
                    number:true,
                },
                portfolio_link:{
                    required:true,
                },
                
                resume:{
                    required:true,
                },
                document_upload:{
                    required:true,
                },
               
                  
            }
    
        });
 $("#resume").on('change', function(){
//Get count of selected files
        var fup = document.getElementById('resume');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
       
        if(ext =="docx" || ext=="pdf" || ext=="doc")
    {
        $('#resumeerror').html('');
    }
    else
    {
       $('#resumeerror').html('Upload docx and pdf files only');
        
    }
});
 $("#document_upload").on('change', function(){
//Get count of selected files
        var fup = document.getElementById('document_upload');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
        a
        if(ext =="docx" || ext=="pdf" || ext=="doc")
    {
        $('#documenterror').html('');
    }
    else
    {
       $('#documenterror').html('Upload docx and pdf files only');
        
    }
});
 $('#website').on('keyup',function(){
   var url=$(this).val();
   var re =  /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
   if (!re.test(url)) { 
    $('#websiteerror').html('Enter valid website url');
    
    }else{
        $('#websiteerror').html('');
    }

 });
  $('#linkedinurl').on('keyup',function(){
   var url=$(this).val();
   var re =  /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
   if (!re.test(url)) { 
    $('#linkedinerror').html('Enter valid linked in profile  url');
    
    }else{
        $('#linkedinerror').html('');
    }

 });
  $('#portfolio_link').on('keyup',function(){
   var url=$(this).val();
   var re =  /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
   if (!re.test(url)) { 
    $('#portfolioerror').html('Enter valid portfolio link');
    
    }else{
        $('#portfolioerror').html('');
    }

 });


</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
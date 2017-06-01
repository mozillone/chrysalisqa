<?php $__env->startSection('styles'); ?>
   <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/costumes_list.css')); ?>">
 <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 	<section class="content create_section_page">
 	<div id="ohsnap"></div>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chrysalis</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- css links Start -->
<link href="css/styles.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Karla|Lato:300,400,700,900|Open+Sans:300,400,600,700" rel="stylesheet">
	
<!-- Script links Start -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
</head>
<body>


<div class="container">
<div class="row">
<div class="col-md-12">
<!--- progressbar section starts -->
<div class="progressbar_main">
<h2>UPLOAD A COSTUME</h2>
<ul id="progressbar" class="progressbar_rm">  
	 <li class="active"><span class="s-head">Step 1</span> <span>Upload <br/>Photos</span></li> 
	 <li class="active"><span class="s-head">Step 2</span> <span>Fill in Costume <br/>Description</span></li>
     <li class="active"><span class="s-head">Step 3</span> <span>Pricing & <br/>Shipping</span></li>
     <li class="active"><span class="s-head">Step 4</span> <span>Review <br/>Preferences</span></li>	 
     </ul>
</div>	

	 
<!--- progressbar section End -->

<p class="prog-txt">Lorem Ipsum is simply dummy text of <span>the printing and typesetting</span> industry.</p>
<h2 class="prog-head">Review Your Preferences</h2>
</div>	

<div class="prog-form-rm">
<div class="col-md-6">

<div class="form-rms">
<p class="form-rms-que">01. Item Location</p>
<p class="form-rms-input"><input type="text"></p>
</div>

<div class="form-rms">
<p class="form-rms-que">02. Handling Time <i class="fa fa-info-circle fa-info-rm" aria-hidden="true"></i></p>
<p class="form-rms-input">
<select name="handlingtime" id="handlingtime">
<option value="">Select Handling Time</option>
<?php $__currentLoopData = $handlingtime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$handlingtime): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($handlingtime->optionid); ?>"><?php echo e($handlingtime->value); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</select>
</p>
</div>


<div class="form-rms">
<p class="form-rms-que">03. Return Policy</p>
<p class="form-rms-input">
<select name="returnpolicy" id="returnpolicy" >
<option value="">Select Return Policy</option>
<?php $__currentLoopData = $returnpolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$returnpolicy): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($returnpolicy->optionid); ?>"><?php echo e($returnpolicy->value); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</select>
</p>
</div>

</div>

<div class="col-md-6">
<div class="form-rms">
<p class="form-rms-que form-rms-que1">04. Donate a Portion to Charity</p>
<p class="ct3-rms-text">Chrysalis Charges a 3% transaction fee on sale of every costume.However,if you donate 5% or more of your sale to a charity we will waive our transcation fee to match your contribution</p>
<p class="ct3-rms-text">By Choosing to donate,I agree and accept Chrysalis Terms & Conditions.</p>
<p class="ct3-rms-head">Donation Amount</p>
<div class="form-rms-input">
<p class="form-rms-rel1"><select class="cst2-select80"><option>10%</option><option>20%</option><option>30%</option></select></p>
<p class="cst3-textl2"><i class="fa fa-usd" aria-hidden="true"></i>5.90</p></div>
<p class="ct3-rms-head">Donate to</p>
<ul class="ct3-list">
<?php $__currentLoopData = $charities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$charity): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<li><img src="images/cst3.png" alt="<?php echo e($charity->name); ?>" /><input type="radio" name="<?php echo e($charity->name); ?>" /></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</ul>
<p class="cst2-rms-chck"><input type="checkbox"> I would like to suggest another charity organization</p>
</div>

<div class="form-rms">
<p class="ct3-rms-head">Please Specify:</p>
<p class="form-rms-input"><input type="text"  name="organzation_name" id="organzation_name" autocomplete="off" placeholder="Organization Name"></p>
</div>





<div class="form-rms-btn">
<button type="button" class="btn-rm-nxt">I'm Finished!</button>
<button type="button" class="btn-rm-back"><span>Back</span></button>
</div>
</div>
</div>

</div>	
</div>	
	
	</body>
</html>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!--<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<script src="<?php echo e(asset('/js/ohsnap.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/js/jPages.js')); ?>"></script>

<script type="text/javascript">
	
	$('#createcostumetwo').on('submit',function(a){
		a.preventDefault();
		str=true;
		alert();
		$('#costume_name,#categoryname,#gender,#size,#description,#funfcats,#faq,#height-ft,#height-in,#weight-lbs,#chest-in,#waist-lbs').css('border','');
		$('#costumename_error,#categoryerror,#gendererror,#sizeerror,#uniquefashionerror,#cosplayerror,#costumeconditionerror,#descriptionerror,#facterror,#faqerror,#activityerror,#bodydimensionerror,#qualityerror,#usercostumeerror').html('');
		var costumename=$('#costume_name').val();
		var category=$('#categoryname').val();
		var gender=$('#gender').val();
		var size=$('#size').val();
		var description=$('#description').val();
		var funfact=$('#funfacts').val();
		var faq=$('#faq').val();
		var heightft=$('#height-ft').val();
		var heightin=$('#height-in').val();
		var weightlbs=$('#weight-lbs').val();
		var chestin=$('#chest-in').val();
		var waistlbs=$('#waist-lbs').val();
		var costumecondition="";
		var qualitycostume="";
		var usercostume="";
		var activity="";
		var cosplay="";
		var uniquefashion="";
		if(document.getElementById('7').checked){
			cosplay = document.getElementById('7').value;
		}
		if(document.getElementById('8').checked){
			cosplay = document.getElementById('8').value;
		}
		if(document.getElementById('9').checked){
			uniquefashion = document.getElementById('9').value;
		}
		if(document.getElementById('10').checked){
			uniquefashion = document.getElementById('10').value;
		}
		
		if(document.getElementById('11').checked){
			qualitycostume = document.getElementById('11').value;
		}
		if(document.getElementById('12').checked){
			qualitycostume = document.getElementById('12').value;
		}
		if(document.getElementById('32').checked){
			qualitycostume = document.getElementById('32').value;
		}
		if(document.getElementById('33').checked){
			qualitycostume = document.getElementById('33').value;
		}
		if(document.getElementById('30').checked){
			usercostume = document.getElementById('30').value;
		}
		if(document.getElementById('31').checked){
			usercostume = document.getElementById('31').value;
		}
		
		if(document.getElementById('excellent').checked){
			costumecondition = document.getElementById('excellent').value;
		}
		if(document.getElementById('brandnew').checked){
			costumecondition = document.getElementById('brandnew').value;
		}
		if (document.getElementById('good').checked) {
			costumecondition = document.getElementById('good').value;
        }
	   if(document.getElementById('likenew').checked) {
			costumecondition = document.getElementById('likenew').value;
		}
		if(costumename==''){
			$('#costume_name').css('border','1px solid red');
			$('#costumename_error').html('Enter Costume Name');
			str=false;
		}
		if(heightft==''){
			$('#height-ft').css('border','1px solid red');
			$('#bodydimensionerror').html('Enter Body & Dimensions');
			str=false;
		}
		if(heightin==''){
			$('#height-in').css('border','1px solid red');
			$('#bodydimensionerror').html('Enter Body & Dimensions');
			str=false;
		}
		if(weightlbs==''){
			$('#weight-lbs').css('border','1px solid red');
			$('#bodydimensionerror').html('Enter Body & Dimensions');
			str=false;
		}
		if(chestin==''){
			$('#chest-in').css('border','1px solid red');
			$('#bodydimensionerror').html('Enter Body & Dimensions');
			str=false;
		}
		if(waistlbs==''){
			$('#waist-lbs').css('border','1px solid red');
			$('#bodydimensionerror').html('Enter Body & Dimensions');
			str=false;
		}
		if(category==''){
			$('#categoryname').css('border','1px solid red');
			$('#categoryerror').html('Select Category');
			str=false;
		}
		if(gender==''){
			$('#gender').css('border','1px solid red');
			$('#gendererror').html('Select Gender');
			str=false;
		}
		if(size==''){
			$('#size').css('border','1px solid red');
			$('#sizeerror').html('Select Size');
			str=false;
		}
		if(description==""){
			$('#description').css('border','1px solid red');
			$('#descriptionerror').html('Enter Costume Description');
			str=false;
		}
		if(funfact=='')
		{
			$('#funfacts').css('border','1px solid red');
			$('#facterror').html('Enter FunFact');
			str=false;
		}
		if(faq==""){
			$('#faq').css('border','1px solid red');
			$('#faqerror').html('Enter Faq');
			str=false;
		}
		if(costumecondition == "" | costumecondition == null ){
			$('#costumeconditionerror').html('Select Costume Condition');
			str=false;
			
		}
		if(qualitycostume == "" | qualitycostume == null ){
			$('#qualityerror').html('Select Costume Fit For Film Quality OR Not');
			str=false;
			
		}
		if(usercostume == "" | usercostume == null ){
			$('#usercostumeerror').html('Select User Make The Costume Or Not');
			str=false;
			
		}
		if(activity == "" | activity == null )
		{
			$('#activityerror').html('Select Is The Costume Used For An Activity Or Not');
			str=false;
			
		}
		if(cosplay == "" | cosplay == null ){
			$('#cosplayerror').html('Select Is The Costume Used For Cosplay Or Not');
			str=false;
			
		}	
		if(uniquefashion == "" | activity == null ){
			$('#uniquefashionerror').html('Select Is The Costume Used For Uniquefashion Or Not');
			str=false;
		}
		return str;
	});
	</script>
	<!--Getting subcategory list by oonchange-->
	 <script type="text/javascript">
$('#categoryname').on('change',function(){
	
    var id=$(this).val();//catgeory id
	alert(id);
	 $.get("<?php echo e(url('/costume/ajaxSubcategory')); ?>", //This is the url defined in routes 
         { categoryid: id  },  
		 function(data) {
			console.log(data);
			var model = $('#subcategory').html('Select Subcategory');    //keeping subcategory field empty before
					model.empty();
					$.each(data, function(index, element) {
			            model.append("<option value='"+ element.subcategoryid +"'>" + element.subcategoryname + "</option>");
			        });
        });
    
});
</script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
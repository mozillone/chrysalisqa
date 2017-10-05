<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/drop_uploader.css')); ?>">
<link  href="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.css" rel="stylesheet">

<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>

<style>
	#customer_edit1 .form-group.has-feedback {
	clear: left;
	}
	.control-label.kyword {
    text-align: left;
	}
	.media.tnks_media .media-left img {
    border: 1px solid #e2e2e2;
}
	.up-blog span.text a:after {
	content: "\f030";
	font-family: 'FontAwesome';
	color: #fff;
	font-size: 24px;
	display: block;
	margin-top: 0%;
	left: 0px;
	right: 0px;
	line-height: 280px;
	}
	span.text a{height:auto !important; position:inherit;}
	.upload-photo-blogs .up-blog input {
	width: 100%;
	cursor: pointer;
	left: 0;
	margin: 0 auto;
	position: absolute;
	height: 100%;
	color: transparent;
	opacity: 0; top:0px;
	}
	.cropper-bg {
	background-image: none !important;
	}
	.save,.saveMultiple {
	background: #60c5ac;
	border: 1px solid #60c5ac;
	font-size: 16px;
	font-family: Proxima-Nova-Extrabold;
	padding: 8px 25px;
	}
	section.content.create_section_page .modal-body p {
	font-family: Proxima-Nova-Extrabold;
	}
	section.content.create_section_page .modal-header {
	text-align: center;font-family: Proxima-Nova-Extrabold;
	}
	.imageModel {
	margin-top: 30px;
	}
	.modal-header .close {
	opacity: 0.9;
	font-size: 28px;
	}
	.imageModel .modal-content{border-radius:0px;}
	.img_clse {
	background: transparent;
	border: 2px solid #60c5ac;
	font-size: 14px;
	font-family: Proxima-Nova-Extrabold;
	padding: 8px 25px;
	text-align: right;
	float: right;
	margin-right: 10px;
	color: #60c5ac;
	}
	.cropper-view-box {
    display: block;
    height: 100%;
    outline-color: #60c5ac  !important;
    outline: 2px solid #60c5ac  !important;
    overflow: hidden;
    width: 100%;
}
	section.content.create_section_page .modal-body #zoom-level {
	}
	section.content.create_section_page .btn-success:active:focus, .btn-success:active:hover{background-color: #60c5ac;
	border-color: #60c5ac;}
	section.content.create_section_page  .btn-success:active{border-color: #60c5ac !important;}
	section.content.create_section_page .btn-success:hover{background-color: #60c5ac !important;}
	section.content.create_section_page .btn-success:active {
	background-color: #60c5ac !important;
	}
	.btn-success:focus{    background-color: #60c5ac !important;}
	.img-pp input {
	width: 80%;
	margin: 0 auto;
	display: inline-block;
	}
	.img-pp-iner {
	width: 350px;
	margin: 0 auto;    margin-top: 20px !important;    margin-bottom: 10px;
	}
	.img-pp {
	display: inline;
	margin: 0 auto;
	}
	.img-pp-iner i.fa.fa-picture-o {
	font-size: 15px;
	}
	.img-pp-iner i.fa.fa-picture-o.fa-3 {
	font-size: 22px;
	}
	.imageModel .modal-footer {
	border-top: 1px solid #ccc !important;
	}
	input[type=range] {
	/*removes default webkit styles*/
	-webkit-appearance: none;
	/*fix for FF unable to apply focus style bug */
	border: 1px solid white;
	/*required for proper track sizing in FF*/
	}
	input[type=range]::-webkit-slider-runnable-track {
	height: 5px;
	background: #ddd;
	border: none;
	border-radius: 3px;
	}
	input[type=range]::-webkit-slider-thumb {
	-webkit-appearance: none;
	border: none;
	height: 16px;
	width: 16px;
	border-radius: 50%;
	webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	box-shadow: 2px 2px 3px 0px rgba(0, 0, 0, 0.4);
	background: #fff;
	margin-top: -4px;
	}
	input[type=range]:focus {
	outline: none;
	}
	input[type=range]:focus::-webkit-slider-runnable-track {
	background: #ccc;
	}
	input[type=range]::-moz-range-track {
	height: 5px;
	background: #ddd;
	border: none;
	border-radius: 3px;
	}
	input[type=range]::-moz-range-thumb {
	border: none;
	height: 16px;
	width: 16px;
	border-radius: 50%;
	webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	box-shadow: 2px 2px 3px 0px rgba(0, 0, 0, 0.4);
	background: #fff;
	}
	/*hide the outline behind the border*/
	input[type=range]:-moz-focusring{
	outline: 1px solid white;
	outline-offset: -1px;
	}
	input[type=range]::-ms-track {
	height: 5px;
	/*remove bg colour from the track, we'll use ms-fill-lower and ms-fill-upper instead */
	background: transparent;
	/*leave room for the larger thumb to overflow with a transparent border */
	border-color: transparent;
	border-width: 6px 0;
	/*remove default tick marks*/
	color: transparent;
	}
	input[type=range]::-ms-fill-lower {
	background: #777;
	border-radius: 10px;
	}
	input[type=range]::-ms-fill-upper {
	background: #ddd;
	border-radius: 10px;
	}
	input[type=range]::-ms-thumb {
	border: none;
	height: 16px;
	width: 16px;
	border-radius: 50%;
	webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	box-shadow: 2px 2px 3px 0px rgba(0, 0, 0, 0.4);
	background: #fff;
	}
	input[type=range]:focus::-ms-fill-lower {
	background: #888;
	}
	input[type=range]:focus::-ms-fill-upper {
	background: #ccc;
	}
	.img-pp-iner img.img-responsive.crp1 {
	float: left;margin-top: 3px;
	margin-right: 6px;
	}
	.img-pp-iner img.img-responsive.crp2 {
	float: right;
	margin-right: 23px;
	}
	.cropper-modal
	{
	background: none !important; ;
	}
	.modal-footer
	{
	border-top:none !important;
	}
	.cropper-bg
	{
	background-image: none !important;
	}
	.carousel
	{
	position: fixed !important;
	}
	input.slider {
	position: inherit;
	}
	.modal-header h4{
	font-weight: bold;
	font-size: 18px;
	}
	.modal-body p
	{
	font-weight: bold;
	}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
	<h1>Add Costume</h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
		</li>
		<li>
			<a href="<?php echo e(url('customes-list')); ?>">Costumes</a>
		</li>
		<li class="active">Add Costume</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<!--<h3 class="box-title col-md-12 heading-agent">Add Costume</h3>-->
				</div>
				<div class="box-body">
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
					<!-- <form class="form-horizontal" ng-submit="save(userForm.$valid, data)" name="userForm" > -->
					<form id="customer_edit1" class="form-horizontal defult-form costume_creates_pages" name="userForm" action="<?php echo e(route('costumes-insert')); ?>" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
						<div class="col-md-6">
							<h2 class="heading-agent">*Costume Information</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Customer<span class="req-field" >*</span></label>
									<select class="form-control sony" data-live-search="true" id="customer_name" name="customer_name" >
										<option value="">Select Customer Name</option>
										<option value="1" selected>Chrysalis Costume</option>
										<?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<option value="<?php echo e($customer->id); ?>"><?php echo e($customer->username); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									</select>
									<span id="customername_error" style="color:red"></span>
								</div>
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Costume Name<span class="req-field" >*</span></label>
									<input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
									<span id="costumename_error" style="color:red"></span>
								</div>
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Costume Cost<span class="req-field" >*</span></label>
									<input type="text" class="form-control" placeholder="Enter Costume cost"  name="costume_cost" id="costume_cost">
									<span id="costumecost_error" style="color:red"></span>
								</div>
								<div class="form-group has-feedback cosutme-fr" >
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">Costume For<span class="req-field" >*</span></label>
										<br>
										<label class="radio-inline">
										<input type="radio"   name="gender" id="male"  value="male" checked >Male</label>
										<label class="radio-inline">
										<input type="radio"   name="gender" id="female"  value="female"  >Female</label>
										<label class="radio-inline">
										<input type="radio"   name="gender" id="boy"  value="boy" >Boys</label>
										<label class="radio-inline">
										<input type="radio"   name="gender" id="girl"  value="girl"  >Girls</label>
										<label class="radio-inline">
										<input type="radio"   name="gender" id="baby"  value="baby"  >Babies</label>
									</div>
									<span id="gendererror" style="color:red"></span>
								</div>
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Catgeory<span class="req-field" >*</span></label>
									<select class="form-control sony" name="category" id="category">
										<option value="">Select Category</option>
										<?php
											$features_req = $categories['modules_result'];
											foreach ($features_req as $features_res) {
												//print_r($features_res);
											?>
											<optgroup label="<?php echo ucfirst($features_res['name']);?>">
												<?php foreach ($features_res['submodule_result'] as $feature_val_res) {
												?>
												<option value="<?php echo $feature_val_res['subcategoryid'];?>"><?php echo ucfirst($feature_val_res['subcategoryname']);
												?></option>
												<?php }?>
											</optgroup>
										<?php }?>
									</select>
									<span id="categoryerror" style="color:red"></span>
								</div>
								<div class="form-group has-feedback create-admin_pagess" >
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">Condition <span class="req-field" >*</span></label>
										<br>
												<label class="radio-inline"><input type="radio"  name="costumecondition" id="good"  value="good">&nbsp;
											Good&nbsp;
										</label>
											<label class="radio-inline"><input type="radio"  name="costumecondition" id="likenew"  value="like_new">&nbsp;
											Like New&nbsp;
										</label>
										<label class="radio-inline"><input type="radio"  name="costumecondition" id="brandnew"  value="brand_new"  checked> &nbsp;
											Brand New&nbsp;
										</label>
									
									
									</div>
									<span id="costumeconditionerror" style="color:red"></span>
								</div>
								<h4>Body & Dimensions (Optional)</h4></hr>
								<div class="row" >
									<div class="col-md-6" >
										<div class="form-group has-feedback " >
											<?php
												$height           = $bd_height->label;
												$heightattributes = explode('-', $height);
												$attribute        = ucfirst($heightattributes[0]);
												$attributevalue   = $heightattributes[1];
											?>
											<label for="inputEmail3" class="control-label"><?php echo $attribute;?><span class="req-field"></span></label>
										<div class="input-group">
										<input type="<?php echo e($bd_height->type); ?>" class="form-control"   name="<?php echo e($bd_height->code); ?>" id="<?php echo e($bd_height->code); ?>">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue;?></span>
										</div>
										<span id="heightfterror" style="color:red"></span>
										</div>
										</div>
										<div class="col-md-6 dimsn-bknd" >
										<div class="form-group has-feedback" >
										<?php
										$height1           = $bd_height_in->label;
										$heightattributes1 = explode('-', $height1);
										$attribute1        = ucfirst($heightattributes1[0]);
										$attributevalue1   = $heightattributes1[1];
										?>
										<label for="inputEmail3" class="control-label"></label>
										<div class="input-group">
										<input type="<?php echo e($bd_height_in->type); ?>"  class="form-control"  name="<?php echo e($bd_height_in->code); ?>" id="<?php echo e($bd_height_in->code); ?>">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue1;?></span>
										</div>
										<span id="heightinerror" style="color:red"></span>
										</div></div></div>
										<div class="row">
										<div class="col-md-6" >
										<div class="form-group has-feedback" >
										<?php
										$height2           = $bd_weight->label;
										$heightattributes2 = explode('-', $height2);
										$attribute2        = ucfirst($heightattributes2[0]);
										$attributevalue2   = $heightattributes2[1];
										?>
										<label for="inputEmail3" class="control-label"><?php echo $attribute2;?><span class="req-field" ></span></label>
										<div class="input-group">
										<input type="<?php echo e($bd_weight->type); ?>" class="form-control" name="<?php echo e($bd_weight->code); ?>" id="<?php echo e($bd_weight->code); ?>">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue2;?></span>
										</div>
										<span id="weightlbserror" style="color:red"></span>
										</div>
										</div>
										<div class="col-md-6" >
										<div class="form-group has-feedback" >
										<?php
										$height3           = $bd_chest->label;
										$heightattributes3 = explode('-', $height3);
										$attribute3        = ucfirst($heightattributes3[0]);
										$attributevalue3   = $heightattributes3[1];
										?>
										<label for="inputEmail3" class="control-label"><?php echo $attribute3;?><span class="req-field" ></span></label>
										<div class="input-group">
										<input type="<?php echo e($bd_chest->type); ?>" class="form-control"  name="<?php echo e($bd_chest->code); ?>" id="<?php echo e($bd_chest->code); ?>">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue3;?></span>
										</div>
										<span id="chestinerror" style="color:red"></span>
										</div>
										</div>
										<div class="row1" >
										<div class="col-md-6" >
										<div class="form-group has-feedback" >
										<?php
										$height           = $bd_waist->label;
										$heightattributes = explode('-', $height);
										$attribute        = ucfirst($heightattributes[0]);
										$attributevalue   = $heightattributes[1];
										?>
										<label for="inputEmail3" class="control-label"><?php echo $attribute;?><span class="req-field" ></span></label>
										<div class="input-group">
										<input type="<?php echo e($bd_waist->type); ?>" class="form-control" name="<?php echo e($bd_waist->code); ?>" id="<?php echo e($bd_waist->code); ?>">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue;?></span>
										</div>
										<span id="waistlbserror" style="color:red"></span>
										</div>
										</div>
										<div class="col-md-6" >
										<div class="form-group has-feedback" >
										<label for="inputEmail3" class="control-label">Size<span class="req-field" >*</span></label>
										<select name="size" id="size" class="form-control">
										<option value="">Select Size</option>
										<option value="1sz">1SZ</option>
										<option value="xxs">XXS</option>
										<option value="xs">XS</option>
										<option value="s">S</option>
										<option value="m">M</option>
										<option value="l">L</option>
										<option value="xl">XL</option>
										<option value="xxl">XXL</option>
										<option value="std">STD</option>
										</select>
										<span id="size_error" style="color:red"></span>
										</div>
										</div>
										</div>
										</div>
										</div>
										</div>
										<div class="col-md-6 crt_right_alng">
										<h2 class="heading-agent">Costume FAQ</h2>
										<div class="col-md-12">
										<div class="form-group has-feedback" >
										<div class="form-group" >
										<label for="inputEmail3" class="control-label">
										<?php echo $cosplay_one->label;?>
										<span class="req-field" ></span></label>
										<br>
										<?php $__currentLoopData = $cosplay_one_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$cosplayonevalues): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<?php if ($cosplayonevalues->option_value == "yes") {?>
										<input type="<?php echo e($cosplay_one->type); ?>"  checked name="<?php echo e($cosplay_one->code); ?>" id="<?php echo e($cosplay_one->code); ?>"  value="<?php echo e($cosplayonevalues->option_id); ?>" required>&nbsp;	<?php echo e($cosplayonevalues->option_value); ?>&nbsp;
										<?php } else {?>																			<input type="<?php echo e($cosplay_one->type); ?>"   name="<?php echo e($cosplay_one->code); ?>" id="<?php echo e($cosplay_one->code); ?>"  value="<?php echo e($cosplayonevalues->option_id); ?>" onclick="cosplay_yes(<?php echo $cosplayonevalues->option_id?>)"  checked="checked">&nbsp;														<?php echo e($cosplayonevalues->option_value); ?>&nbsp;
										<?php }?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										<div class="row" id="cosplayplay_yes_div" style="display: none;">
										<!--
										<div class="col-md-12" >
										<div class="radio-inline">
										<label><input type="radio" name="cosplayplay_yes_opt" value="Anime/Manga">Anime/Manga</label>
										</div>
										<div class="radio-inline">
										<label><input type="radio" name="cosplayplay_yes_opt" value="Sci-Fi">Sci-Fi</label>
										</div>
										</div>
										-->
										<div class="col-md-12">
										<?php $__currentLoopData = $cosplaySubCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<div class="radio-inline">
										<label for="<?php echo e($subCat->name); ?>"><input type="radio" name="cosplayplay_yes_opt" value="<?php echo e($subCat->name); ?>" id="<?php echo e($subCat->name); ?>"><?php echo e($subCat->name); ?></label>
										</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</div>			
										<span id="cosplay_yeserror" style="color:red"></span>
										</div>
										</div>
										</div>
										<div class="form-group has-feedback" >
										<div class="form-group" >
										<label for="inputEmail3" class="control-label">
										<?php echo $cosplay_two->label;?>
										<span class="req-field" ></span></label>
										<br>
										<?php $__currentLoopData = $cosplay_two_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$cosplaytwovalues): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<input type="<?php echo e($cosplay_two->type); ?>"  <?php if ($cosplaytwovalues->option_value == "No") {?> checked="checked" <?php }?>name="<?php echo e($cosplay_two->code); ?>" id="<?php echo e($cosplay_two->code); ?>"  value="<?php echo e($cosplaytwovalues->option_id); ?>" onclick="uniquefashion_yes(<?php echo e($cosplaytwovalues->option_id); ?>)">&nbsp;
										<?php echo e($cosplaytwovalues->option_value); ?>&nbsp;
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										<div class="row" id="uniquefashion_yes_div" style="display: none;">
										<!--
										<div class="col-md-12" >
										<div class="radio-inline">
										<label><input type="radio" name="uniquefashion_yes_opt" value="Cyberpunk">Cyberpunk</label>
										</div>
										</div>
										-->
										<div class="col-md-12">
										<?php $__currentLoopData = $uniqueFashionSubCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<div class="radio-inline">
										<label for="<?php echo e($subCat->name); ?>"><input type="radio" name="uniquefashion_yes_opt" value="<?php echo e($subCat->name); ?>" id="<?php echo e($subCat->name); ?>"><?php echo e($subCat->name); ?></label>
										</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</div>	
										<span id="uniquefashion_yeserror" style="color:red"></span>
										</div>
										</div>
										</div>
										<div class="form-group has-feedback" >
										<div class="form-group" >
										<label for="inputEmail3" class="control-label">
										<?php echo $cosplay_three->label;?>
										<span class="req-field" ></span></label>
										<br>
										<?php $__currentLoopData = $cosplay_three_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$cosplaythreevalues): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<input type="<?php echo e($cosplay_three->type); ?>" <?php if ($cosplaythreevalues->option_value == "No") {?> checked="checked" <?php }?>name="<?php echo e($cosplay_three->code); ?>" id="<?php echo e($cosplay_three->code); ?>" onclick="activity_yes(<?php echo e($cosplaythreevalues->option_id); ?>)"  value="<?php echo e($cosplaythreevalues->option_id); ?>"  required>&nbsp;
										<?php echo e($cosplaythreevalues->option_value); ?>&nbsp;
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										<div class="row" id="activity_yes_div" style="display: none;">
										<!--
										<div class="col-md-12" >
										<div class="radio-inline">
										<label><input type="radio" name="activity_yes_opt" value="Circus">Circus</label>
										</div>
										<div class="radio-inline">
										<label><input type="radio" name="activity_yes_opt" value="Theatre">Theatre</label>
										</div>
										</div>
										-->
										<div class="col-md-12">
										<?php $__currentLoopData = $filmTheatreSubCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<div class="radio-inline">
										<label for="<?php echo e($subCat->name); ?>"><input type="radio" name="activity_yes_opt" value="<?php echo e($subCat->name); ?>" id="<?php echo e($subCat->name); ?>"><?php echo e($subCat->name); ?></label>
										</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</div>
										<span id="activity_yeserror" style="color:red"></span>
										</div>
										</div>
										</div>
										<div class="form-group has-feedback" >
										<div class="form-group" >
										<label for="inputEmail3" class="control-label">
										<?php echo $cosplay_four->label;?>
										<span class="req-field" ></span></label>
										<br>
										<?php $__currentLoopData = $cosplay_four_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$cosplayfourvalues): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<input type="<?php echo e($cosplay_four->type); ?>"  <?php if ($cosplayfourvalues->option_value == "No") {?> checked="checked" <?php }?>name="<?php echo e($cosplay_four->code); ?>" id="<?php echo e($cosplay_four->code); ?>"  value="<?php echo e($cosplayfourvalues->option_id); ?>" onclick="make_costume_yes(<?php echo e($cosplayfourvalues->option_id); ?>)"  required>&nbsp;
										<?php echo e($cosplayfourvalues->option_value); ?>&nbsp;
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										<p class="form-rms-small" id="mention_hours" style="display:none" >If yes, how long did it take?</p>
										<p class="ct1-rms-rel" id="mention_hours_input" style="display:none"><input type="text" name="make_costume_time" class="input-rm100"> <span>hours<span>
										</p>
										</div>
										</div>
										<div class="form-group has-feedback" >
										<div class="form-group" >
										<label for="inputEmail3" class="control-label">
										<?php echo $cosplay_five->label;?>
										<span class="req-field" ></span></label>
										<br>
										<?php $__currentLoopData = $cosplay_five_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$cosplayfivevalues): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<input type="<?php echo e($cosplay_five->type); ?>"  <?php if ($cosplayfivevalues->option_value == "No") {?> checked="checked	" <?php }?>name="<?php echo e($cosplay_five->code); ?>" id="<?php echo e($cosplay_five->code); ?>"  value="<?php echo e($cosplayfivevalues->option_id); ?>" onclick="film_name_yes(<?php echo e($cosplayfivevalues->option_id); ?>)"  required>&nbsp;
										<?php echo e($cosplayfivevalues->option_value); ?>&nbsp;
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										<p class="form-rms-small" id="film_text" style="display:none" >Which production was your costume featured in? </p>
										<p class="ct1-rms-rel form-rms-input" id="film_text_input" style="display:none">
										<input type="text" name="film_name" id="film_name" >
										</p>
										</div>
										</div>
										</div>
										<div class="form-group has-feedback" >
										<label for="inputEmail3" class="control-label kyword">How would you describe your costume?</p>
										<p>Have a unique costume? Please enter a maximum of <strong>10</strong> keywords to describe it.</p>
										<p>Tip:Have a speciailty costume? To increase your changes of making a sale, input the approprite keywords with our existing <span>list of categories.</span> </p><span class="req-field" ></span></label>
										<div class="input-group">
										<input type="text" id="keywords_tag" class="form-control" name="keywords_tag">
										<a href="javascript:void(0);" id="keywords_add" >ADD</a>
										<div id="div" class="keywords_div">
										</div>
										<div id="count">10 left</div>
										</div>
										<span id="costume-desc-error" style="color:red"></span>
										</div>
										<div class="form-group has-feedback" >
										<label for="inputEmail3" class="control-label"><?php echo e($description->label); ?><span class="req-field" ></span></label>
										<div class="input-group">
										<textarea type="<?php echo e($description->type); ?>" rows="6" cols="63" class="form-control"   name="<?php echo e($description->code); ?>" id="<?php echo e($description->code); ?>"></textarea>
										</div>
										<span id="costume-desc-error" style="color:red"></span>
										</div>
										<div class="form-group has-feedback" >
										<label for="inputEmail3" class="control-label"><?php echo e($funfacts->label); ?><span class="req-field" ></span></label>
										<div class="input-group">
										<textarea type="<?php echo e($funfacts->type); ?>" rows="6" cols="63" class="form-control"   name="<?php echo e($funfacts->code); ?>" id="<?php echo e($funfacts->code); ?>"></textarea>
										</div>
										<span id="funfact-error" style="color:red"></span>
										</div>
										<div class="form-group has-feedback" >
										<label for="inputEmail3" class="control-label"><?php echo e($faq->label); ?><span class="req-field" ></span></label>
										<div class="input-group">
										<textarea type="<?php echo e($faq->type); ?>" rows="6" cols="63" class="form-control"   name="<?php echo e($faq->code); ?>" id="<?php echo e($faq->code); ?>"></textarea>
										</div>
										<span id="faq-error" style="color:red"></span>
										</div>
										</div>
										<div class="col-md-6">
										<h2 class="heading-agent">Pricing</h2>
										<div class="col-md-12">
										<div class="row">
										<div class="col-md-5">
										<div class="form-group has-feedback" >
										<label for="inputEmail3" class="control-label">Price*<span class="req-field" ></span></label>
										<div class="input-group">
										<span class="input-group-addon">$</span>
										<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="price" id="price" >
										<span id="priceerror" style="color:red"></span>
										</div>
										</div>
										</div>
										<div class="col-md-5">
										<div class="form-group has-feedback" >
										<label for="inputEmail3" class="control-label">Quantity*<span class="req-field" ></span></label>
										<select class="form-control" name="quantity" id="quantity">
										<option value="">Select Quantity</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										</select>
										<span id="quantityerror" style="color:red"></span>
										</div>
										</div>
										</div>
										</div>
										</div>
										<div class="col-md-6 pckg_right">
									<!--	<h2 class="heading-agent">Package Information</h2>-->
										<div class="col-md-12">
										<label for="inputEmail3" class="control-label">
										<?php echo e($packageditems->label); ?>

										<span class="req-field" ></span></label>
										<div class="form-group has-feedback dmns_rigts" >
										<div class="row pnds ">
										<div class="col-md-6">
										<div class="input-group ">
										<input type="text" class="form-control" placeholder="Pounds" name="pounds" id="pounds">
										<span class="input-group-addon" id="basic-addon2">lbs</span>
										</div>
										</div>
										<div class="col-md-6">
										<div class="input-group">
										<input type="text" class="form-control" placeholder="Ounces" name="ounces" id="ounces">
										<span class="input-group-addon" id="basic-addon2">oz</span>
										</div>
										</div>
										</div>
										<p class="error"><?php echo e($errors->first('name')); ?></p>
										</div>
										<label for="inputEmail3" class="control-label">
										<?php echo e($dimensions->label); ?>

										<span class="req-field" ></span></label>
										<div class="form-group has-feedback dmns_rigts" >
										<?php $__currentLoopData = $dimensions_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$dimensionval): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<?php
										$dimension_height = $dimensionval->option_value;
										$heightattributes   = explode('-', $dimension_height);
										$dimensionattribute = ucfirst($heightattributes[0]);
										$dimensionvalue     = $heightattributes[1];
										?>
										<div class="col-md-4">
										<div class="input-group">
										<input type="<?php echo e($dimensions->type); ?>" class="form-control" placeholder="<?php echo $dimensionattribute;?>" name="<?php echo e($dimensions->code); ?><?php echo e($dimensions->code); ?><?php echo $dimensionattribute;?>" id="<?php echo e($dimensions->code); ?>">
										<span class="input-group-addon" id="basic-addon2"><?php echo $dimensionvalue;?></span>
										</div>
										</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</div>
										</div>
										</div>
										<div class="col-md-6">
										<h2 class="heading-agent">Preferences</h2>
										<div class="row">
										<div class="col-md-6">
										<div class="form-group has-feedback" >
										<label for="inputEmail3" class="control-label"><?php echo e($handling->label); ?><span class="req-field" ></span></label>
										<select class="form-control"    name="<?php echo e($handling->code); ?>" id="<?php echo e($handling->code); ?>">
										<option value="">Select Handling Time</option>
										<?php $__currentLoopData = $handling_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$handlingval): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<option value="<?php echo e($handlingval->option_id); ?>" <?php if($handlingval->option_value == "10 Business Days"): ?> selected <?php endif; ?>><?php echo e($handlingval->option_value); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</select>
										<p class="error"><?php echo e($errors->first('name')); ?></p>
										</div>
										</div>
										<div class="col-md-6">
										<div class="form-group has-feedback"  style="disply:none">
										<label for="inputEmail3" class="control-label"><?php echo e($returnpolicy->label); ?><span class="req-field" ></span></label>
										<select class="form-control"  name="<?php echo e($returnpolicy->code); ?>" id="<?php echo e($returnpolicy->code); ?>">
										<option value="">Select Return Policy</option>
										<?php $__currentLoopData = $returnpolicy_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$returnpolicyval): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<option value="<?php echo e($returnpolicyval->option_id); ?>"><?php echo e($returnpolicyval->option_value); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</select>
										<p class="error"><?php echo e($errors->first('name')); ?></p>
										</div>
										</div>
										</div>
										</div>
										<div class="col-md-6">
										<h2 class="heading-agent">Donation Info</h2>
										<div class="col-md-12">
										<div class="form-group has-feedback" >
										<label for="inputEmail3" class="control-label">Donation to Charity<span class="req-field" ></span></label>
										<div class="input-group">
										<!-- <span class="input-group-addon">$</span> -->
										<!-- <input type="text" class="form-control"  autocomplete="off"  name="charity_amount" id="charity_amount"> -->
										<select class="form-control" name="charity_amount" id="charity_amount"><option value="">Donate Amount</option><option value="1" selected>1%</option><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option></select>
										<p class="cst3-textl2 d-amount"  id="dynamic_percent_amount"><i class="fa fa-usd" aria-hidden="true"></i>0.00</p>
										<input type="hidden" name="hidden_donation_amount" id="hidden_donation_amount" value="">
										<p class="error"><?php echo e($errors->first('charity_amount')); ?></p>
										<span id="priceerror" style="color:red">
										</div>
										</div>
										<div class="form-group has-feedback" >
										<label for="inputEmail3" class="control-label">Charity Name<span class="req-field" ></span></label>
										<select class="form-control"  autocomplete="off" name="charity_name" id="charity_name">
										<option value="">Select Charity Name</option>
										<?php $__currentLoopData = $charities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$charity): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<option value="<?php echo e($charity->id); ?>"><?php echo e($charity->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</select>
										<p class="error"><?php echo e($errors->first('charity_name')); ?></p>
										</div>
										</div>
										</div>
										<div class="col-md-12 frnt_back_view">
										<h2 class="heading-agent">Upload Images</h2>
										<div class="row">
										<div class="threeblogs upload-photo-blogs">
										<div class="col-md-3 col-sm-4 col-xs-12" id="front_view">
										<h2 class="box-title col-md-12 heading-agent pro-imgs text-center">Front View</h2>
										<div class="main_upload_blogs clearfix">
										<span class="remove_pic" id="drag_n_drop_1" style="display: none;">
										<i class="fa fa-times-circle" aria-hidden="true"></i>				
										</span>
										<div class=" up-blog">
										<input type="file" accept="image/*" name="img_chan" id="file1" >
										<input type="hidden" class="modalOpen1" name="Imagecrop1">
										<img src="" class="result" >
										<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
										</div>
										</div>
										</div>
										<div class="col-md-3 col-sm-4 col-xs-12" id="back_view">
										<h2 class="box-title col-md-12 heading-agent pro-imgs text-center">Back View</h2>
										<div class="main_upload_blogs clearfix">
										<span class="remove_pic" id="drag_n_drop_2" style="display: none;">
										<i class="fa fa-times-circle" aria-hidden="true"></i>				
										</span>
										<div class=" up-blog">
										<input type="file" accept="image/*" name="img_chan1" id="file2" >
										<input type="hidden" class="modalOpen2" name="Imagecrop2">
										<img src="" class="result2" >
										<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
										</div>
										</div>
										</div>
										<div class="col-md-3 col-sm-4 col-xs-12 " id="details_view">
										<h2 class="box-title col-md-12 heading-agent pro-imgs text-center">Additional</h2>
										<div class="main_upload_blogs clearfix">
										<span class="remove_pic" id="drag_n_drop_3" style="display: none;">
										<i class="fa fa-times-circle" aria-hidden="true"></i>					
										</span>
										<div class=" up-blog">
										<input type="file" name="img_chan2" id="file3">
										<input type="hidden" class="modalOpen3" name="Imagecrop3" >
										<img src="" class="result3" >
										<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
										</div>
										</div>
										</div>
										</div>
										</div>
										</div>
										<div class="threeblogs upload-photo-blogs">
										<div class="col-md-12 col-sm-12 col-xs-12">
										<h2 class="heading-agent">Upload More</h2>
										<div id="other_thumbnails">
										<!--<div class="col-md-3 col-sm-3 col-xs-12"></div>-->
										</div>
										<div class="multiHidden">
										</div>
										<input class="input-btn" id="upload-file-selector" accept="image/*" name="files[]" multiple="" type="file">
										</div>
										</div>
										<!-- modal code here multiple images -->
										<div id="myModal" class="modal fade imageModel and carousel slide" role="dialog" data-backdrop="static">
										<div class="modal-dialog modal-md">
										<!-- Modal content-->
										<div class="modal-content">
										<div class="modal-header">
										
										<h4 class="modal-title text-center">Front View</h4>
										</div>
										<div class="modal-body">
										<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
										<div class="carousel-inner" id="dvPreview">
										</div>
										<div class="img-pp">
										<div class="img-pp-iner">
										<img class="img-responsive crp1" src="<?php echo e(URL::asset('assets/frontend/img/crp_1.png')); ?>">
										<input type="range" id="zoom-level"  min="1" max="5" value="0" step="any" >
										<img class="img-responsive crp2" src="<?php echo e(URL::asset('assets/frontend/img/crp_2.png')); ?>">
										</div>
										</div>
										<div class="width"></div>
										<div class="height"></div>
										</div>
										<div class="modal-footer">
										<button type="button" class="btn btn-success pull-right save" id="crop">Save</button>
										<button type="button" class="btn btn-default img_clse" data-dismiss="modal" id="cancel1">Cancel</button>
										</div>
										</div>
										</div>
										</div>
										<!-- model code ends here -->
										<!-- second modal code here -->
										<div id="myModal2" class="modal fade imageModel and carousel slide" role="dialog"  data-backdrop="static">
										<div class="modal-dialog modal-md">
										<!-- Modal content-->
										<div class="modal-content">
										<div class="modal-header">
										
										<h4 class="modal-title text-center">Back View</h4>
										</div>
										<div class="modal-body">
										<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
										<div class="carousel-inner" id="dvPreview2">
										</div>
										<div class="img-pp">
										<div class="img-pp-iner">
										<img class="img-responsive crp1" src="<?php echo e(URL::asset('assets/frontend/img/crp_1.png')); ?>">
										<input type="range" id="zoom-level2"  min="1" max="5" value="0" step="any" >
										<img class="img-responsive crp2" src="<?php echo e(URL::asset('assets/frontend/img/crp_1.png')); ?>">
										</div>
										</div>
										<div class="width"></div>
										<div class="height"></div>
										</div>
										<div class="modal-footer">
										<button type="button" class="btn btn-success pull-right save" id="crop2">Save</button>
										<button type="button" class="btn btn-default img_clse" data-dismiss="modal" id="cancel2">Cancel</button>
										</div>
										</div>
										</div>
										</div>
										<!-- model code ends here -->
										<!-- third modal code here -->
										<div id="myModal3" class="modal fade imageModel and carousel slide" role="dialog"  data-backdrop="static">
										<div class="modal-dialog modal-md">
										<!-- Modal content-->
										<div class="modal-content">
										<div class="modal-header">
										
										<h4 class="modal-title text-center">Additional</h4>
										</div>
										<div class="modal-body">
										<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
										<div class="carousel-inner" id="dvPreview3">
										</div>
										<div class="img-pp">
										<div class="img-pp-iner">
										<img class="img-responsive crp1" src="<?php echo e(URL::asset('assets/frontend/img/crp_1.png')); ?>">
										<input type="range" id="zoom-level3" min="1" max="5" value="0" step="any" >
										<img class="img-responsive crp2" src="<?php echo e(URL::asset('assets/frontend/img/crp_1.png')); ?>">
										</div>
										</div>
										<div class="width"></div>
										<div class="height"></div>
										</div>
										<div class="modal-footer">
										<button type="button" class="btn btn-success pull-right save" id="crop3">Save</button>
										<button type="button" class="btn btn-default img_clse" data-dismiss="modal" id="cancel3">Cancel</button>
										</div>
										</div>
										</div>
										</div>
										<!-- multiple file modal -->
										<div class="modal fade and carousel slide" id="lightbox" data-interval="false"  data-backdrop="static">
										<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
										
										<h4 class="modal-title text-center">Crop Multiple Images</h4>
										</div>
										<div class="modal-body">
										<div class="carousel-inner" id="dvPreviewMultiple">
										</div>
										<div class="arrows">
										<a class="left carousel-control" href="#lightbox" role="button" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
										</a>
										<a class="right carousel-control" href="#lightbox" role="button" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
										</a>
										</div>
										</div><!-- /.modal-body -->
										<div class="img-pp">
										<div class="img-pp-iner">
										<img class="img-responsive crp1" src="<?php echo e(URL::asset('assets/frontend/img/crp_1.png')); ?>">
										<input type="range" id="zoom-level" class="slider"  min="1" max="5" value="0" step="any" />
										<img class="img-responsive crp2" src="<?php echo e(URL::asset('assets/frontend/img/crp_2.png')); ?>">
										</div>
										</div>
										<div class="modal-footer" style="display:none;">
										<button type="button" class="btn btn-success pull-right saveMultiple" >Save</button>
										<button type="button" class="btn btn-default img_clse" id="multiCancel" data-dismiss="modal">Cancel</button>
										</div>
										</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
										</div><!-- /.modal -->
										<!-- ends here -->
										<div class="box-footer">
										<div class="pull-right">
										<a href="/customes-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
										<button type="submit" id="submit" name="submit"  class="btn btn-info pull-right">Submit</button>
										</div>
										</div>
										</form>
										</div>
										</div>
										</div>
										</div>
										</section>
										<?php $__env->stopSection(); ?>
										
										<?php $__env->startSection('footer_scripts'); ?>
										<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
										<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
										<script src="<?php echo e(asset('/assets/admin/js/pages/customers.js')); ?>"></script>
										<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.js"></script>
										<script src="<?php echo e(asset('/assets/admin/js/pages/costumecustom.js')); ?>"></script>
										<script type="text/javascript" src="<?php echo e(asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')); ?>"></script>
										<script type="text/javascript">
										$(document).ready(function () {
										//donate amount percentage calculation
										$('#charity_amount').change(function(){
										var donate_percent = $(this).val();
										var price = $('#price').val();
										var total = (price*donate_percent)/100;
										if (donate_percent=="none") {
										var total = 0.00;
										}
										$('#hidden_donation_amount').val(parseFloat(total).toFixed(2));
										$('#dynamic_percent_amount').html("<i class='fa fa-usd' aria-hidden='true'></i> " +parseFloat(total).toFixed(2));
										});
                                        $('#price').keyup(function() {
										var donate_percent = $("#charity_amount").val();
										var price = $('#price').val();
										var total = (price*donate_percent)/100;
										if (donate_percent=="none") {
										var total = 0.00;
										}
										$('#hidden_donation_amount').val(parseFloat(total).toFixed(2));
										$('#dynamic_percent_amount').html("<i class='fa fa-usd' aria-hidden='true'></i> " +parseFloat(total).toFixed(2));
										});
										});
										function cosplay_yes(id){
										if (id == 7) {
										$('#cosplayplay_yes_div').css('display','block');
										}else{
										$('#cosplayplay_yes_div').css('display','none');
										}
										}
										function uniquefashion_yes(id){
										if (id == 9) {
										$('#uniquefashion_yes_div').css('display','block');
										}else{
										$('#uniquefashion_yes_div').css('display','none');
										}
										}
										function activity_yes(id){
										if (id == 11) {
										$('#activity_yes_div').css('display','block');
										}else{
										$('#activity_yes_div').css('display','none');
										}
										}
										function make_costume_yes(id){
										if (id == 30) {
										$('#mention_hours').css('display','block');
										$('#mention_hours_input').css('display','block');
										}else{
										$('#mention_hours').css('display','none');
										$('#mention_hours_input').css('display','none');
										$('#mention_hours_input').val('');
										}
										}
										function film_name_yes(id){
										if (id == 32) {
										$('#film_text').css('display','block');
										$('#film_text_input').css('display','block');
										}else{
										$('#film_text').css('display','none');
										$('#film_text_input').css('display','none');
										$('#film_text_input').val('');
										}
										}
										</script>
										<script>
										var placeSearch, autocomplete;
										var componentForm = {
										street_number: 'short_name',
										route: 'long_name',
										locality: 'long_name',
										administrative_area_level_1: 'short_name',
										country: 'long_name',
										postal_code: 'short_name',
										};
										function initAutocomplete() {
										// Create the autocomplete object, restricting the search to geographical
										// location types.
										autocomplete = new google.maps.places.Autocomplete(
										/** @type  {!HTMLInputElement} */(document.getElementById('autocomplete')),
										{types: ['geocode']});
										// When the user selects an address from the dropdown, populate the address
										// fields in the form.
										autocomplete.addListener('place_changed', fillInAddress);
										}
										function fillInAddress() {
										// Get the place details from the autocomplete object.
										var place = autocomplete.getPlace();
										for (var component in componentForm) {
										document.getElementById(component).value = '';
										document.getElementById(component).disabled = false;
										}
										// Get each component of the address from the place details
										// and fill the corresponding field on the form.
										for (var i = 0; i < place.address_components.length; i++) {
										var addressType = place.address_components[i].types[0];
										if (componentForm[addressType]) {
										var val = place.address_components[i][componentForm[addressType]];
										document.getElementById(addressType).value = val;
										}
										}
										}
										// Bias the autocomplete object to the user's geographical location,
										// as supplied by the browser's 'navigator.geolocation' object.
										function geolocate() {
										if (navigator.geolocation) {
										navigator.geolocation.getCurrentPosition(function(position) {
										var geolocation = {
										lat: position.coords.latitude,
										lng: position.coords.longitude
										};
										var circle = new google.maps.Circle({
										center: geolocation,
										radius: position.coords.accuracy
										});
										autocomplete.setBounds(circle.getBounds());
										});
										}
										}
										</script>
										<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD7L6zG6Z8ws4mRa1l2eAhVPDViUX6id0&libraries=places&callback=initAutocomplete"
										async defer></script>
										<script type="text/javascript">
										$("#heightft,#heightin,#weightlbs,#chestin,#waistlbs,#dimensions").on("keyup", function(){
										var valid = /^\d{0,4}(\.\d{0,4})?$/.test(this.value),
										val = this.value;
										if(!valid){
										console.log("Invalid input!");
										this.value = val.substring(0, val.length - 1);
										}
										});
										$("#price,#charity_amount").on("keyup", function(){
										var valid = /^\d{0,20}(\.\d{0,20})?$/.test(this.value),
										val = this.value;
										if(!valid){
										console.log("Invalid input!");
										this.value = val.substring(0, val.length - 1);
										}
										});
										</script>
										<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
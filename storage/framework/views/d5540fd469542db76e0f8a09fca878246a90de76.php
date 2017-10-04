<?php $__env->startSection('title'); ?> @parent

<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/drop_uploader.css')); ?>">
<script src="<?php echo e(asset('/assets/admin/js/fileinput.js')); ?>"></script>
<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>


<style>
#customer_edit1 .form-group.has-feedback {
clear: left;
}
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<section class="content-header">
<h1>Costume</h1>
<ol class="breadcrumb">
<li>
<a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
</li>
<li>
<a href="<?php echo e(url('customers-list')); ?>">Costumes</a>
</li>

<li class="active">Add Costume</li>
</ol>
</section>
<section class="content">
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="box box-primary">
<div class="box-header">
<h3 class="box-title col-md-12 heading-agent">Add Costume</h3>
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

<div class="alert alert-danger alert-dismissable" style="display:none" >
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
</div>

<div class="alert alert-success alert-dismissable" id="sonay"  style="display:none" >
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<span id="successmessage"></span>

</div>
<?php if(Session::has('success')): ?>
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
<option value="0">None</option>
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
<div class="form-group has-feedback cosutme-fr" >
<div class="form-group" >
<label for="inputEmail3" class="control-label">Costume For<span class="req-field" >*</span></label>
<br>
<label class="radio-inline">
<input type="radio"   name="gender" id="male"  value="male" checked >Male</label>

<label class="radio-inline">
<input type="radio"   name="gender" id="female"  value="female"  >Female</label>

<label class="radio-inline">
<input type="radio"   name="gender" id="unisex"  value="unisex" >Unisex</label>

<label class="radio-inline">
<input type="radio"   name="gender" id="pet"  value="pet"  >Pet</label>

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
<label class="radio-inline"><input type="radio"  name="costumecondition" id="excellent"   value="excellent"  checked> &nbsp;
Excellent&nbsp;
</label>
<label class="radio-inline"><input type="radio"  name="costumecondition" id="brandnew"  value="brand_new"> &nbsp;
Brand New&nbsp;
</label>
<label class="radio-inline"><input type="radio"  name="costumecondition" id="good"  value="good">&nbsp;
Good&nbsp;
</label>
<label class="radio-inline"><input type="radio"  name="costumecondition" id="likenew"  value="like_new">&nbsp;
Like New&nbsp;
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
<label for="inputEmail3" class="control-label"><?php echo $attribute;?><span class="req-field">*</span></label>

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
<div class="col-md-12" >
<div class="form-group has-feedback" >
<?php
$height2           = $bd_weight->label;
$heightattributes2 = explode('-', $height2);
$attribute2        = ucfirst($heightattributes2[0]);
$attributevalue2   = $heightattributes2[1];
?>
<label for="inputEmail3" class="control-label"><?php echo $attribute2;?><span class="req-field" >*</span></label>
<div class="input-group">
<input type="<?php echo e($bd_weight->type); ?>" class="form-control" name="<?php echo e($bd_weight->code); ?>" id="<?php echo e($bd_weight->code); ?>">
<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue2;?></span>
</div>
<span id="weightlbserror" style="color:red"></span>

</div>
</div>
<div class="col-md-12" >
<div class="form-group has-feedback" >
<?php
$height3           = $bd_chest->label;
$heightattributes3 = explode('-', $height3);
$attribute3        = ucfirst($heightattributes3[0]);
$attributevalue3   = $heightattributes3[1];
?>
<label for="inputEmail3" class="control-label"><?php echo $attribute3;?><span class="req-field" >*</span></label>
<div class="input-group">
<input type="<?php echo e($bd_chest->type); ?>" class="form-control"  name="<?php echo e($bd_chest->code); ?>" id="<?php echo e($bd_chest->code); ?>">
<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue3;?></span>
</div>
<span id="chestinerror" style="color:red"></span>
</div>
</div>
<div class="col-md-12" >
<div class="form-group has-feedback" >
<?php
$height           = $bd_waist->label;
$heightattributes = explode('-', $height);
$attribute        = ucfirst($heightattributes[0]);
$attributevalue   = $heightattributes[1];
?>
<label for="inputEmail3" class="control-label"><?php echo $attribute;?><span class="req-field" >*</span></label>
<div class="input-group">
<input type="<?php echo e($bd_waist->type); ?>" class="form-control" name="<?php echo e($bd_waist->code); ?>" id="<?php echo e($bd_waist->code); ?>">
<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue;?></span>
</div>
<span id="waistlbserror" style="color:red"></span>
</div>
</div>
<div class="col-md-12" >
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
</select>
<span id="size_error" style="color:red"></span>
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
<?php } else {?>																			<input type="<?php echo e($cosplay_one->type); ?>"   name="<?php echo e($cosplay_one->code); ?>" id="<?php echo e($cosplay_one->code); ?>"  value="<?php echo e($cosplayonevalues->option_id); ?>" onclick="cosplay_yes(<?php echo $cosplayonevalues->option_id?>)"  required>&nbsp;														<?php echo e($cosplayonevalues->option_value); ?>&nbsp;
<?php }?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<div class="row" id="cosplayplay_yes_div" style="display: none;">
<div class="col-md-12" >
<div class="radio-inline">
<label><input type="radio" name="cosplayplay_yes_opt" value="Anime/Manga">Anime/Manga</label>
</div>
<div class="radio-inline">
<label><input type="radio" name="cosplayplay_yes_opt" value="Sci-Fi">Sci-Fi</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="cosplayplay_yes_opt" value="Cosmic/Superhero">Cosmic/Superhero</label>
</div>
<div class="radio-inline">
<label><input type="radio" name="cosplayplay_yes_opt" value="Video Games">Video Games</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="cosplayplay_yes_opt" value="Furries">Furries</label>
</div>
<div class="radio-inline">
<label><input type="radio" name="cosplayplay_yes_opt" value="Other">Other</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="cosplayplay_yes_opt" value="Film & Tv">Film & Tv</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="cosplayplay_yes_opt" value="Mecha">Mecha</label>
</div>
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
<input type="<?php echo e($cosplay_two->type); ?>"  <?php if ($cosplaytwovalues->option_value == "yes") {?> checked <?php }?>name="<?php echo e($cosplay_two->code); ?>" id="<?php echo e($cosplay_two->code); ?>"  value="<?php echo e($cosplaytwovalues->option_id); ?>" onclick="uniquefashion_yes(<?php echo e($cosplaytwovalues->option_id); ?>)"  required>&nbsp;
<?php echo e($cosplaytwovalues->option_value); ?>&nbsp;

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

<div class="row" id="uniquefashion_yes_div" style="display: none;">
<div class="col-md-12" >
<div class="radio-inline">
<label><input type="radio" name="uniquefashion_yes_opt" value="Cyberpunk">Cyberpunk</label>
</div>
<div class="radio-inline">
<label><input type="radio" name="uniquefashion_yes_opt" value="Lolita">Lolita</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="uniquefashion_yes_opt" value="Dystopain">Dystopain</label>
</div>
<div class="radio-inline">
<label><input type="radio" name="uniquefashion_yes_opt" value="Mori kei">Mori kei</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="uniquefashion_yes_opt" value="Goth">Goth</label>
</div>
<div class="radio-inline">
<label><input type="radio" name="uniquefashion_yes_opt" value="Fari kei">Fari kei</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="uniquefashion_yes_opt" value="Steampunk">Steampunk</label>
</div>
<div class="radio-inline">
<label><input type="radio" name="uniquefashion_yes_opt" value="Visual kei">Visual kei</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="uniquefashion_yes_opt" value="Streetwear">Streetwear</label>
</div>
<div class="radio-inline">
<label><input type="radio" name="uniquefashion_yes_opt" value="Other">Other</label>
</div>
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
<input type="<?php echo e($cosplay_three->type); ?>" <?php if ($cosplaythreevalues->option_value == "yes") {?> checked <?php }?>name="<?php echo e($cosplay_three->code); ?>" id="<?php echo e($cosplay_three->code); ?>" onclick="activity_yes(<?php echo e($cosplaythreevalues->option_id); ?>)"  value="<?php echo e($cosplaythreevalues->option_id); ?>"  required>&nbsp;
<?php echo e($cosplaythreevalues->option_value); ?>&nbsp;

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

<div class="row" id="activity_yes_div" style="display: none;">
<div class="col-md-12" >
<div class="radio-inline">
<label><input type="radio" name="activity_yes_opt" value="Circus">Circus</label>
</div>
<div class="radio-inline">
<label><input type="radio" name="activity_yes_opt" value="Theatre">Theatre</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="activity_yes_opt" value="Historical Reenactments">Historical Reenactments</label>
</div>
<div class="radio-inline">
<label><input type="radio" name="activity_yes_opt" value="Music Videos">Music Videos</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="activity_yes_opt" value="LARP">LARP</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="activity_yes_opt" value="Masquerade">Masquerade</label>
</div>
</div>
<div class="col-md-12">
<div class="radio-inline">
<label><input type="radio" name="activity_yes_opt" value="Medieval/Renaissance Fairs">Medieval/Renaissance Fairs</label>
</div>
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
<input type="<?php echo e($cosplay_four->type); ?>"  <?php if ($cosplayfourvalues->option_value == "yes") {?> checked <?php }?>name="<?php echo e($cosplay_four->code); ?>" id="<?php echo e($cosplay_four->code); ?>"  value="<?php echo e($cosplayfourvalues->option_id); ?>" onclick="make_costume_yes(<?php echo e($cosplayfourvalues->option_id); ?>)"  required>&nbsp;
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
<input type="<?php echo e($cosplay_five->type); ?>"  <?php if ($cosplayfivevalues->option_value == "yes") {?> checked <?php }?>name="<?php echo e($cosplay_five->code); ?>" id="<?php echo e($cosplay_five->code); ?>"  value="<?php echo e($cosplayfivevalues->option_id); ?>"  required>&nbsp;
<?php echo e($cosplayfivevalues->option_value); ?>&nbsp;

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</div>
</div>



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
<label for="inputEmail3" class="control-label">Price<span class="req-field" ></span></label>
<div class="input-group">
<span class="input-group-addon">$</span>
<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="price" id="price" >

<span id="priceerror" style="color:red">
</div>
</div>
</div>
</div>
<div class="row">
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
<div class="row">
<div class="col-md-5">
<div class="form-group has-feedback" >
<label for="inputEmail3" class="control-label"><?php echo e($shippingoptions->label); ?> <span class="req-field" ></span></label>
<select class="form-control" name="<?php echo e($shippingoptions->code); ?>" id="<?php echo e($shippingoptions->code); ?>">
<option value="">Select Shipping Options</option>
<option value="<?php echo e($shippingoptions->option_id); ?>"><?php echo e($shippingoptions->option_value); ?></option>
</select>
<p class="error"><?php echo e($errors->first('name')); ?></p>
</div>
</div>
</div>

</div>
</div>
<div class="col-md-6 pckg_right">
<h2 class="heading-agent">Package Information</h2>
<div class="col-md-12">
<div class="form-group has-feedback" >
<label for="inputEmail3" class="control-label">

<?php echo e($packageditems->label); ?>

<span class="req-field" ></span></label>
<select name="<?php echo e($packageditems->code); ?>" id="<?php echo e($packageditems->code); ?>" class="form-control">
<option value="">Select Weight of Packaged Item </option>
<?php $__currentLoopData = $packageditems_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packagevalues): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($packagevalues->option_id); ?>"><?php echo e($packagevalues->option_value); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</select>
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
<div class="form-group has-feedback" >
<label for="inputEmail3" class="control-label"><?php echo e($type->label); ?><span class="req-field" ></span></label>
<select class="form-control"  name="<?php echo e($type->code); ?>" id="<?php echo e($type->code); ?>">
<option value="">Select Type</option>
<?php $__currentLoopData = $type_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$typeval): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($typeval->option_id); ?>"><?php echo e($typeval->option_value); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</select>
<p class="error"><?php echo e($errors->first('name')); ?></p>
</div>
<div class="form-group has-feedback" >
<label for="inputEmail3" class="control-label"><?php echo e($service->label); ?><span class="req-field" ></span></label>
<select class="form-control"  name="<?php echo e($service->code); ?>" id="<?php echo e($service->code); ?>">
<option value="">Select Service</option>
<?php $__currentLoopData = $service_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$serviceval): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($serviceval->option_id); ?>"><?php echo e($serviceval->option_value); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</select>
<p class="error"><?php echo e($errors->first('name')); ?></p>
</div>
</div>
</div>
<div class="col-md-6">
<h2 class="heading-agent">Preferences</h2>
<div class="col-md-12">
<label for="inputEmail3" class="control-label">Item Location<span class="req-field" >*</span></label>
<div class="form-group has-feedback" >

<div id="locationField">
<input type="text" class="form-control" placeholder="Enter Location"  name="location" id="autocomplete" onFocus="geolocate()" >
</div>
<span id="autocomplete_error" style="color:red"></span>
</div>
<div class="form-group has-feedback" >


<!--<input id="autocomplete" onFocus="geolocate()" type="text" class="form-control" name="location" required></input>-->
<input type="hidden" class="field form-control" id="street_number" name="address1" disable="true"required></input>
<input type="hidden" class="field form-control" name="address2" id="route" required></input></td>
<input type="hidden" class="field form-control" id="locality" name="city" required>
<input type="hidden" class="field form-control" id="administrative_area_level_1" name="state"></input>
<input type="hidden" class="field form-control" id="postal_code" name="zipcode">
<input type="hidden" class="field form-control" id="country" name="country" required></input>

</div>
<div class="form-group has-feedback" >
<label for="inputEmail3" class="control-label"><?php echo e($handling->label); ?><span class="req-field" ></span></label>
<select class="form-control"    name="<?php echo e($handling->code); ?>" id="<?php echo e($handling->code); ?>">
<option value="">Select Handling Time</option>
<?php $__currentLoopData = $handling_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$handlingval): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($handlingval->option_id); ?>"><?php echo e($handlingval->option_value); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</select>
<p class="error"><?php echo e($errors->first('name')); ?></p>
</div>
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
<div class="col-md-6">
<h2 class="heading-agent">Donation Info</h2>
<div class="col-md-12">
<div class="form-group has-feedback" >
<label for="inputEmail3" class="control-label">Donation to Charity<span class="req-field" ></span></label>
<div class="input-group">
<!-- <span class="input-group-addon">$</span> -->
<!-- <input type="text" class="form-control"  autocomplete="off"  name="charity_amount" id="charity_amount"> -->
<select class="form-control" name="charity_amount" id="charity_amount"><option value="">Donate Amount</option><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option></select>
<p class="cst3-textl2 d-amount"  id="dynamic_percent_amount"><i class="fa fa-usd" aria-hidden="true"></i>0.00</p>
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
<div class="col-md-3  col-md-offset-1">
<h2 class="box-title col-md-12 heading-agent pro-imgs text-center">Front View</h2>
<div class="col-md-12">
<div class=" up-blog">
<input type="file" name="img_chan" id="img_chan">
</div>
</div>
</div>
<div class="col-md-3 ">


<h2 class="box-title col-md-12 heading-agent pro-imgs text-center">Back View</h2>
<div class="col-md-12">
<div class=" up-blog">
<input type="file" name="img_chan1" id="img_chan1">
</div>
</div>

</div>
<div class="col-md-3 ">
<h2 class="box-title col-md-12 heading-agent pro-imgs text-center">Details/Accessories</h2>
<div class="col-md-12">
<div class=" up-blog">
<input type="file" name="img_chan2" id="img_chan2">
</div>
</div>
</div>
</div>
</div>
<div class="col-md-12">
<h2 class="heading-agent">Multi Image Uploading</h2>
<div class="col-md-12">

<input class="input-btn" id="upload-file-selector" name="files[]" multiple="" type="file">


</div>

</div>









</div>
<div class="box-footer">
<div class="pull-right">
<a href="/customers-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
<button type="submit" id="submit" name="submit"  class="btn btn-info pull-right">Submit</button>
</div>
</div>

</div>
</div>
</form>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/admin/js/pages/customers.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')); ?>"></script>

<script type="text/javascript">
$(document).ready(function () {

//donate amount percentage calculation
$('#charity_amount').change(function(){
var donate_percent = $(this).val();
var price = $('#price').val();
var total = (price*donate_percent)/100;
$('#dynamic_percent_amount').html("<i class='fa fa-usd' aria-hidden='true'></i> " +parseFloat(total));
});
//$(".sony").select2();

$('#img_chan,#img_chan2,#img_chan1').drop_uploader({
uploader_text: 'Drop files to upload, or Browse',
browse_text: 'Browse',
browse_css_class: 'button button-primary',
browse_css_selector: 'file_browse',
uploader_icon: '<i class="pe-7s-cloud-upload"></i>',
file_icon: '<i class="pe-7s-file"></i>',
time_show_errors: 5,
layout: 'thumbnails',
method: 'normal',
url: 'ajax_upload.php',
delete_url: 'ajax_delete.php',
});
/*$( "#submit" ).click(function(a) {

a.preventDefault();
str=true;
$('#cosplay_yeserror').html('');
var cosplay=$('#cosplay').val();
var file2=$('input[name=file2]').val();
var file3=$('input[name=file3]').val();

if(cosplay ==7){
$('#cosplay_yeserror').html('Select Cosplay Options');
str=false;
}
return str;
});*/
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
@extends('admin.app')
{{-- Web site Title --}}
@section('title') @parent
@endsection
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/drop_uploader.css')}}">
<link  href="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.css" rel="stylesheet">
<script src="{{ asset('/assets/admin/js/fileinput.js') }}"></script>
<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
<style>
.plus_minus_div{
	width: 28%;
}
#donate_charity{
	padding-right: 0px !important;
}
.d-amount{
	top: 17px;
}
	.media.tnks_media .media-left img {
    border: 1px solid #e2e2e2;
}
.cropper-view-box {
    display: block;
    height: 100%;
    outline-color: #60c5ac !important;
    outline: 2px solid #60c5ac !important;
    overflow: hidden;
    width: 100%;
}
	</style>
@stop
{{-- Page content --}}
@section('content')
<?php
    if (isset($costumes_data) && !empty($costumes_data)) {
        $cos_data = $costumes_data;
		//echo "<pre>";print_r($sub_cat);die;
		}else{
        $cos_data = "";
	}
?>
<section class="content-header">
	<h1>Costume</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
		</li>
		<li>
			<a href="{{url('customes-list')}}">Costumes</a>
		</li>
		<li class="active">{{$cos_data->costume_name}}</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title col-md-12 heading-agent">Edit Costume</h3>
				</div>
				<div class="box-body">
					@if (Session::has('error'))
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						{{ Session::get('error') }}
					</div>
					@elseif(Session::has('success'))
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						{{ Session::get('success') }}
					</div>
                    @endif
                    <!-- <form class="form-horizontal" ng-submit="save(userForm.$valid, data)" name="userForm" > -->


					<form id="customer_edit2" class="form-horizontal defult-form costume_creates_pages" name="userForm" action="{{route('update-costume')}}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="costume_id" value="{{ $cos_data->costume_id }}">
						<div class="col-md-6">
							<h2 class="heading-agent">Costume Information</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Customer<span class="req-field" >*</span></label>
									<select class="form-control sony" data-live-search="true" id="customer_name" name="customer_name" >
										<option value="">Select Customer Name</option>
										<option <?php if ($cos_data->u_customer_id == '1') { ?> selected="selected"<?php } ?> value="1">Chrysalis Costume</option>
										@foreach($customers as $index=>$customer)
										<option <?php if ($cos_data->customer_name == $customer->username) { ?> selected="selected" <?php	} ?> value="{{$customer->id}}">{{$customer->username}}</option>
										@endforeach
									</select>
									<span id="customername_error" style="color:red"></span>
								</div>
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Costume Name<span class="req-field" >*</span></label>
									<input type="text" class="form-control" value="{{$cos_data->costume_name}}" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
									<span id="costumename_error" style="color:red"></span>
								</div>
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Costume Cost<span class="req-field" >*</span></label>
									<input type="text" class="form-control" value="{{$cos_data->costume_cost}}" placeholder="Enter Costume cost"  name="costume_cost" id="costume_cost">
									<span id="costumecost_error" style="color:red"></span>
								</div>
								<div class="form-group has-feedback cosutme-fr" >
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">Gender<span class="req-field" >*</span></label>
										<br>
										<label class="radio-inline">
										<input type="radio" <?php if ($cos_data->cos_gender == 'male') { ?> checked='checked'	 <?php } ?>  name="gender" id="male"  value="male" >Mens</label>
										<label class="radio-inline">
										<input type="radio" <?php if ($cos_data->cos_gender == 'female') { ?> checked='checked'	 <?php } ?>  name="gender" id="female"  value="female"  >Womens</label>
										<label class="radio-inline">
										<input type="radio" <?php if ($cos_data->cos_gender == 'boy') { ?> checked='checked'  <?php } ?>    name="gender" id="boy"  value="boy" >Boys</label>
										<label class="radio-inline">
										<input type="radio" <?php if ($cos_data->cos_gender == 'girl') { ?> checked='checked'  <?php } ?>    name="gender" id="girl"  value="girl"  >Girls</label>
										<label class="radio-inline">
										<input type="radio" <?php if ($cos_data->cos_gender == 'baby') { ?> checked='checked'  <?php } ?>    name="gender" id="baby"  value="baby"  >Babies</label>
									</div>
									<span id="gendererror" style="color:red"></span>
								</div>
								<?php //echo "<pre>";print_r($sub_cat);die; ?>
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Catgeory<span class="req-field" >*</span></label>
									@if(!empty($sub_cat))
										<select class="form-control sony" name="category" id="category">
										<option value="">Select Category</option>
										<?php
                                            $cos_data->modules_result = $categories['modules_result'];
                                            foreach ($cos_data->modules_result as $features_res) {
												//print_r($features_res['submodule_result']);die;
											?>
                                            <optgroup label="<?php echo ucfirst($features_res['name']);?>">
                                                <?php foreach ($features_res['submodule_result'] as $feature_val_res) {
													?><option @if($sub_cat->category_id == $feature_val_res['subcategoryid']) selected="selected" @endif value="<?php echo $feature_val_res['subcategoryid'];?>"><?php echo ucfirst($feature_val_res['subcategoryname']);
													?></option>
												<?php }?>
											</optgroup>
										<?php }?>
									</select>
									@else
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
									@endif
									<span id="categoryerror" style="color:red"></span>
								</div>

								<div class="form-group has-feedback create-admin_pagess" >
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">Condition <span class="req-field" >*</span></label>
										<br>
										<label class="radio-inline"><input type="radio" <?php if ($cos_data->cos_condition == 'good') { ?> checked='checked'	 <?php } ?> name="costumecondition" class="conditon_check" id="good"  value="good">
											Good
										</label>
										<label class="radio-inline"><input type="radio" <?php if ($cos_data->cos_condition == 'like_new') { ?> checked='checked'	 <?php } ?> name="costumecondition" class="conditon_check" id="likenew"  value="like_new">
											Like New
										</label>
										<label class="radio-inline"><input type="radio" <?php if ($cos_data->cos_condition == 'brand_new') { ?> checked='checked'	 <?php } ?> name="costumecondition" class="conditon_check" id="brandnew"  value="brand_new">
											Brand New
										</label>
									</div>
									<span id="costumeconditionerror" style="color:red"></span>
								</div>


                                
								<div class="row">
								<div class="col-md-6">                                  
                                    <div class="form-group has-feedback hide" id="cleaned_select">
                                     <label for="inputEmail3" class="control-label">How was it cleaned? <span class="req-field" ></span> <i class="fa fa-info-circle fa-info-rm" aria-hidden="true" data-toggle="tooltip" title="Costumes must be clean and ready for the next user. If you are not able to clean your costume you can always send it to Chrysalis with one of our cleanout bags. There are few materials our state of the art facility cannot clean."></i></label>
                                        <p class="form-rms-input">
                                            <select name="cleaned" id="cleaned" class="form-control">
									<option value="">Select</option>


									<option <?php if ($cos_data->option_id == '129') { ?> selected='selected' <?php } ?> value="129" >Hand Washed</option>

									<option <?php if ($cos_data->option_id == '130') { ?> selected='selected' <?php } ?> value="130">Machine Washed</option>

									<option <?php if ($cos_data->option_id == '131') { ?> selected='selected' <?php } ?> value="131">Professionally Cleaned</option>

 	
									</select>
                                        </p>
                                       <span id="cleanederror" style="color:red"></span>
                                    </div>
                                </div>
                                </div>




								<div class="row">
									<div class="col-md-6" >
										<div class="form-group has-feedback" >
										<label for="inputEmail3" class="control-label">Size<span class="req-field" >*</span></label>
										<select name="size" id="size" class="form-control">
										<option value="">Select Size</option>
										<option <?php if ($costumes_data->cos_size == "1sz") { ?> selected="selected" <?php } ?> value="1sz">1SZ</option>
										<option <?php if ($costumes_data->cos_size == "xxs") { ?> selected="selected" <?php } ?> value="xxs">XXS</option>
										<option <?php if ($costumes_data->cos_size == "xs") { ?> selected="selected" <?php } ?> value="xs">XS</option>
										<option <?php if ($costumes_data->cos_size == "s") { ?> selected="selected" <?php } ?> value="s">S</option>
										<option <?php if ($costumes_data->cos_size == "m") { ?> selected="selected" <?php } ?> value="m">M</option>
										<option <?php if ($costumes_data->cos_size == "l") { ?> selected="selected" <?php } ?> value="l">L</option>
										<option <?php if ($costumes_data->cos_size == "xl") { ?> selected="selected" <?php } ?> value="xl">XL</option>
										<option <?php if ($costumes_data->cos_size == "xxl") { ?> selected="selected" <?php } ?> value="xxl">XXL</option>
										<option <?php if ($costumes_data->cos_size == "std") { ?> selected="selected" <?php } ?> value="std">STD</option>
										<option <?php if ($costumes_data->cos_size == "custom") { ?> selected="selected" <?php } ?> value="custom">CUSTOM</option>
										</select>
										<span id="size_error" style="color:red"></span>
										</div>
										</div>
								</div>
								
@if($costumes_data->cos_size == 'custom')								
<div class="dimessions hide">
	<h4>Body & Dimensions <span class="req-field">*</span></h4></hr>
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
					<input type="{{$bd_height->type}}" class="form-control"  value="@if(!empty($bd_height_value->attribute_option_value)){{$bd_height_value->attribute_option_value}} @else{{$bd_height_value->attribute_option_value}}@endif" name="{{$bd_height->code}}" id="{{$bd_height->code}}">
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
					<input type="{{$bd_height_in->type}}"  class="form-control" value="@if(!empty($bd_height_in_value->attribute_option_value)){{$bd_height_in_value->attribute_option_value}} @else {{$bd_height_in_value->attribute_option_value}} @endif"  name="{{$bd_height_in->code}}" id="{{$bd_height_in->code}}">
					<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue1;?></span>
				</div>
				<span id="heightinerror" style="color:red"></span>
			</div>
		</div>
	</div>
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
					<input type="{{$bd_weight->type}}" value="@if(!empty($bd_weight_value->attribute_option_value)){{$bd_weight_value->attribute_option_value}} @else {{$bd_weight_value->attribute_option_value}} @endif" class="form-control" name="{{$bd_weight->code}}" id="{{$bd_weight->code}}">
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
					<input type="{{$bd_chest->type}}" class="form-control" value="@if(!empty($bd_chest_value->attribute_option_value)){{$bd_chest_value->attribute_option_value}} @else {{$bd_chest_value->attribute_option_value}} @endif"  name="{{$bd_chest->code}}" id="{{$bd_chest->code}}">
					<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue3;?></span>
				</div>
				<span id="chestinerror" style="color:red"></span>
			</div>
		</div>
		</div>
		<div class="row" >
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
						<input type="{{$bd_waist->type}}" class="form-control" value="@if(!empty($bd_waist_value->attribute_option_value)){{$bd_waist_value->attribute_option_value}} @else {{$bd_waist_value->attribute_option_value}} @endif" name="{{$bd_waist->code}}" id="{{$bd_waist->code}}">
						<span class="input-group-addon" id="basic-addon2">in</span>
					</div>
					<span id="waistlbserror" style="color:red"></span>
				</div>
			</div>
		</div>
		
	</div>
	
	@elseif($costumes_data->cos_size !='custom')
	   <div class="dimessions hide">
	<h4>Body & Dimensions<span class="req-field">*</span> </h4></hr>
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
					<input type="{{$bd_height->type}}" class="form-control"   name="{{$bd_height->code}}" id="{{$bd_height->code}}">
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
					<input type="{{$bd_height_in->type}}"  class="form-control"  name="{{$bd_height_in->code}}" id="{{$bd_height_in->code}}">
					<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue1;?></span>
				</div>
				<span id="heightinerror" style="color:red"></span>
			</div>
		</div>
	</div>
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
					<input type="{{$bd_weight->type}}" class="form-control" name="{{$bd_weight->code}}" id="{{$bd_weight->code}}">
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
					<input type="{{$bd_chest->type}}" class="form-control"  name="{{$bd_chest->code}}" id="{{$bd_chest->code}}">
					<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue3;?></span>
				</div>
				<span id="chestinerror" style="color:red"></span>
			</div>
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
					<input type="{{$bd_waist->type}}" class="form-control" name="{{$bd_waist->code}}" id="{{$bd_waist->code}}">
					<span class="input-group-addon" id="basic-addon2">in</span>
				</div>
				<span id="waistlbserror" style="color:red"></span>
			</div>
		</div>
	</div>
</div>	
	@endif
	

							</div>
						</div>

	
						<div class="col-md-6 crt_right_alng">
							<h2 class="heading-agent">Costume FAQ</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">
											<?php echo $cosplay_five->label;?>
											<span class="req-field" ></span>
										</label>
										<br>
										<?php //echo "<pre>";print_r($cosplay_five_value_value);die; ?>
										@if(!empty($cosplay_five_value_value->attribute_option_value_id))
											@foreach($cosplay_five_value as $index=>$cosplayfivevalues)
												<input type="{{$cosplay_five->type}}" @if($cosplay_five_value_value->attribute_option_value_id == $cosplayfivevalues->option_id) checked="checked" @endif name="{{$cosplay_five->code}}" id="{{$cosplay_five->code}}"  value="{{$cosplayfivevalues->option_id}}"  onclick="film_name_yes({{$cosplayfivevalues->option_id}})" class="faq-checkbox">&nbsp;
												{{$cosplayfivevalues->option_value}}&nbsp;
											@endforeach
										@else
											@foreach($cosplay_five_value as $index=>$cosplayfivevalues)
												<input type="{{$cosplay_five->type}}"  <?php if ($cosplayfivevalues->option_value == "No") {?> checked="checked	" <?php }?>name="{{$cosplay_five->code}}" id="{{$cosplay_five->code}}"  value="{{$cosplayfivevalues->option_id}}" onclick="film_name_yes({{$cosplayfivevalues->option_id}})" class="faq-checkbox" required>&nbsp;
												{{$cosplayfivevalues->option_value}}&nbsp;
											@endforeach
										@endif
										@if(count($film_name)== 1)
											<p class="form-rms-small" id="film_text" @if(count($film_name)!= 1) style="display: none;" @endif >Which production was your costume featured in? </p>
											<p class="ct1-rms-rel form-rms-input" id="film_text_input" @if(count($film_name)!= 1) style="display: none;" @endif>
												<input type="text" name="film_name" id="film_name" value="{{$film_name->attribute_option_value}}" > <span><span>
											</p>
										@else
											<p class="form-rms-small" id="film_text" style="display:none" >Which production was your featured? </p>
											<p class="ct1-rms-rel form-rms-input" id="film_text_input" style="display:none">
												<input type="text" name="film_name" id="film_name" value="" > <span><span>
											</p>
										@endif
									</div>
								</div>
								
								
								<div class="form-group has-feedback" >
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">
											<?php echo $cosplay_four->label;?>
										<span class="req-field" ></span></label>
										<br>
										@if(!empty($cosplay_four_value_value->attribute_option_value_id))
											@foreach($cosplay_four_value as $index=>$cosplayfourvalues)
											<input type="{{$cosplay_four->type}}" @if($cosplay_four_value_value->attribute_option_value_id == $cosplayfourvalues->option_id) checked="checked" @endif name="{{$cosplay_four->code}}" id="{{$cosplay_four->code}}"  value="{{$cosplayfourvalues->option_id}}" onclick="make_costume_yes({{$cosplayfourvalues->option_id}})" class="faq-checkbox">&nbsp;
											{{$cosplayfourvalues->option_value}}&nbsp;
											@endforeach
										@else
											@foreach($cosplay_four_value as $index=>$cosplayfourvalues)
												<input type="{{$cosplay_four->type}}"  <?php if ($cosplayfourvalues->option_value == "No") {?> checked="checked" <?php }?>name="{{$cosplay_four->code}}" id="{{$cosplay_four->code}}"  value="{{$cosplayfourvalues->option_id}}" onclick="make_costume_yes({{$cosplayfourvalues->option_id}})" class="faq-checkbox" >&nbsp;
												{{$cosplayfourvalues->option_value}}&nbsp;
											@endforeach
										@endif
										@if($cosplay_four_value_value->attribute_option_value_id == 30)
        										@if(count($make_costume_time)== 1)
        										<p class="form-rms-small" id="mention_hours" @if(count($make_costume_time)!= 1) style="display: none;" @endif >If yes, how long did it take?</p>
        										<p class="ct1-rms-rel" id="mention_hours_input" @if(count($make_costume_time)!= 1) style="display: none;" @endif><input type="text" name="make_costume_time" id="make_costume_time" value="{{$make_costume_time->attribute_option_value}}" class="input-rm100"> <span>hours<span>
        										</p>
        										@else
        										<p class="form-rms-small" id="mention_hours" style="display: none;" >If yes, how long did it take?</p>
        										<p class="ct1-rms-rel" id="mention_hours_input" style="display: none;"><input type="text" name="make_costume_time" id="make_costume_time" value="" class="input-rm100"> <span>hours<span>
        										</p>
        										@endif
										@endif
                                        </div>
										</div>
										
										
										</div>
										<div class="form-group has-feedback" >
											<label for="inputEmail3" class="control-label kyword">Keywords</p><p> Please enter a maximum of 10 keywords to describe the categories in which your costume could belong to.</p>

<p><span class="ctume_tip-spn">Tip:</span>What makes your costume unique? Describe it with keywords to help buyers find it. </p><span class="req-field" ></span></label>
										<div class="input-group">
											<input type="text" id="keywords_tag" class="form-control" name="keywords_tag">
											<a href="javascript:void(0);" id="keywords_add" >ADD</a>
											<div id="div" class="keywords_div">
						 
											@if(empty($cos_data->cos_keywords))	
									 
									<input id="input_10" name="keyword_10" value="" type="hidden">
									<input id="input_9" name="keyword_9" value="" type="hidden">
									<input id="input_8" name="keyword_8" value="" type="hidden">
									<input id="input_7" name="keyword_7" value="" type="hidden">
									<input id="input_6" name="keyword_6" value="" type="hidden">
									<input id="input_5" name="keyword_5" value="" type="hidden">
									<input id="input_4" name="keyword_4" value="" type="hidden">
									<input id="input_3" name="keyword_3" value="" type="hidden">
									<input id="input_2" name="keyword_2" value="" type="hidden">
									<input id="input_1" name="keyword_1" value="" type="hidden">
								 	@endif	



								 	@if(!empty($cos_data->cos_keywords))
											<?php $explode = explode(',', $cos_data->cos_keywords);
												$keyword_count = count($explode);
												foreach ($explode as $key => $keywords) {
												?>
												@if(!empty($keywords))
												<p class="keywords_p p_{{10-$key}}">{{$keywords}}<span id="remove_{{10-$key}}">X</span> </p>
												<input id="input_{{10-$key}}" name="keyword_{{10-$key}}" value="{{$keywords}}" type="hidden">
												 
												@endif
												<?php
												}
											 ?>
											@endif
											</div>
											<div id="count">@if(!empty($cos_data->cos_keywords)){{10 - count($explode)}} left @else 10 left @endif </div>
													</div>
													<span id="costume-desc-error" style="color:red"></span>
												</div>
												<div class="form-group has-feedback" >
													<label for="inputEmail3" class="control-label">Describe your Costume<span class="req-field" > *</span></label>
													<div class="input-group">
														<textarea type="{{$description->type}}"  rows="6" cols="63" class="form-control"   name="{{$description->code}}" id="{{$description->code}}">{{$cos_data->cos_description}}</textarea>
													</div>
													<span id="costume-desc-error" style="color:red"></span>
												</div>
												<!-- <div class="form-group has-feedback" >
													<label for="inputEmail3" class="control-label">{{$funfacts->label}}<span class="req-field" ></span></label>
													<div class="input-group">
														<textarea type="{{$funfacts->type}}" rows="6" cols="63" class="form-control"   name="{{$funfacts->code}}" id="{{$funfacts->code}}">@if(!empty($funfacts_value_value->attribute_option_value)){{$funfacts_value_value->attribute_option_value}}@endif</textarea>
													</div>
													<span id="funfact-error" style="color:red"></span>
												</div> -->
												@if(!empty($faq_value_value->attribute_option_value))
													<input type="hidden" id="faq_value_exists" name="faq_value_exists" value="1">
												@endif
												<div class="form-group has-feedback hide"  id="freqent">
													<label for="inputEmail3" class="control-label">{{$faq->label}}<span class="req-field" ></span></label>
													<div class="input-group">
														<textarea type="{{$faq->type}}" rows="6" cols="63" class="form-control"   name="{{$faq->code}}" id="{{$faq->code}}">@if(!empty($faq_value_value->attribute_option_value)){{$faq_value_value->attribute_option_value}}@endif</textarea>
													</div>
													<span id="faq-error" style="color:red"></span>
												</div>
											</div>
											<!-- <div class="col-md-6 pckg_right">
												<h2 class="heading-agent">Pricing & Shipping</h2>
												<div class="row">
														<div class="col-md-5">
															<div class="form-group has-feedback" >
																<label for="inputEmail3" class="control-label">Price<span class="req-field" ></span></label>
																<div class="input-group">
																	<span class="input-group-addon">$</span>
																	<input type="text" class="form-control" value="{{$cos_data->cos_price}}" aria-label="Amount (to the nearest dollar)" name="price" id="price" >
																	<span id="priceerror" style="color:red">
																	</div>
																</div>
															</div>
															<div class="col-md-5">
																<div class="form-group has-feedback" >
																	<label for="inputEmail3" class="control-label">Quantity*<span class="req-field" ></span></label>
																	<select class="form-control" name="quantity" id="quantity">
																		<option value="">Select Quantity</option>
																		<option <?php if ($cos_data->cos_quantity == '1') { ?> selected='selected' <?php } ?> value="1">1</option>
																		<option <?php if ($cos_data->cos_quantity == '2') { ?> selected='selected' <?php } ?> value="2">2</option>
																		<option <?php if ($cos_data->cos_quantity == '3') { ?> selected='selected' <?php } ?> value="3">3</option>
																		<option <?php if ($cos_data->cos_quantity == '4') { ?> selected='selected' <?php } ?> value="4">4</option>
																		<option <?php if ($cos_data->cos_quantity == '5') { ?> selected='selected' <?php } ?> value="5">5</option>
																		<option <?php if ($cos_data->cos_quantity == '6') { ?> selected='selected' <?php } ?> value="6">6</option>
																		<option <?php if ($cos_data->cos_quantity == '7') { ?> selected='selected' <?php } ?> value="7">7</option>
																		<option <?php if ($cos_data->cos_quantity == '8') { ?> selected='selected' <?php } ?> value="8">8</option>
																		<option <?php if ($cos_data->cos_quantity == '9') { ?> selected='selected' <?php } ?> value="9">9</option>
																		<option <?php if ($cos_data->cos_quantity == '10') { ?> selected='selected' <?php } ?> value="10">10</option>
																	</select>
																	<span id="quantityerror" style="color:red"></span>
																</div>
															</div>
													</div>
												</div> -->
												
											
												<div class="col-md-6 pckg_right">
													<h2 class="heading-agent">Pricing & Shipping</h2>
													<div class="col-md-12">
														<div class="form-group has-feedback dmns_rigts" >
															<div class="row ">
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group has-feedback" >
																		<label for="inputEmail3" class="control-label">Price<span class="req-field" ></span></label>
																		<div class="input-group">
																			<span class="input-group-addon">$</span>
																			<input type="text" class="form-control" value="{{$cos_data->cos_price}}" aria-label="Amount (to the nearest dollar)" name="price" id="price" >
																			<span id="priceerror" style="color:red">
																			</div>
																		</div>
																</div>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group has-feedback" >
																	<label for="inputEmail3" class="control-label">Quantity*<span class="req-field" ></span></label>
																	<select class="form-control" name="quantity" id="quantity">
																		<option value="">Select Quantity</option>
																		<option <?php if ($cos_data->cos_quantity == '1') { ?> selected='selected' <?php } ?> value="1">1</option>
																		<option <?php if ($cos_data->cos_quantity == '2') { ?> selected='selected' <?php } ?> value="2">2</option>
																		<option <?php if ($cos_data->cos_quantity == '3') { ?> selected='selected' <?php } ?> value="3">3</option>
																		<option <?php if ($cos_data->cos_quantity == '4') { ?> selected='selected' <?php } ?> value="4">4</option>
																		<option <?php if ($cos_data->cos_quantity == '5') { ?> selected='selected' <?php } ?> value="5">5</option>
																		<option <?php if ($cos_data->cos_quantity == '6') { ?> selected='selected' <?php } ?> value="6">6</option>
																		<option <?php if ($cos_data->cos_quantity == '7') { ?> selected='selected' <?php } ?> value="7">7</option>
																		<option <?php if ($cos_data->cos_quantity == '8') { ?> selected='selected' <?php } ?> value="8">8</option>
																		<option <?php if ($cos_data->cos_quantity == '9') { ?> selected='selected' <?php } ?> value="9">9</option>
																		<option <?php if ($cos_data->cos_quantity == '10') { ?> selected='selected' <?php } ?> value="10">10</option>
																	</select>
																	<span id="quantityerror" style="color:red"></span>
																</div>
																</div>
															</div>
														</div>



														<label for="inputEmail3" class="control-label">
															{{$packageditems->label}}
														<span class="req-field" ></span></label>
														<div class="form-group has-feedback dmns_rigts" >
															<div class="row  pnds ">
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<div class="input-group">
																		<input type="text" class="form-control" placeholder="Pounds" value="{{$cos_data->weight_pounds}}" name="pounds" id="pounds">
																		<span class="input-group-addon" id="basic-addon2">lbs</span>
																	</div>
																</div>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<div class="input-group">
																		<input type="text" class="form-control" placeholder="Ounces" value="{{$cos_data->weight_ounces}}" name="ounces" id="ounces">
																		<span class="input-group-addon" id="basic-addon2">oz</span>
																	</div>
																</div>
															</div>
															<p class="error">{{ $errors->first('name') }}</p>
														</div>
														<label for="inputEmail3" class="control-label">
															{{$dimensions->label}}
														<span class="req-field" ></span></label>
														<div class="form-group has-feedback dmns_rigts" >
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control valid" placeholder="Length" value="@if(!empty($dimensions_length->attribute_option_value)) {{$dimensions_length->attribute_option_value}} @endif" name="dimensionsdimensionsLength" id="dimensionsdimensionsLength" type="text">
																	<span class="input-group-addon" id="basic-addon2">in</span>
																</div>
															</div>
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control" placeholder="Width" value="@if(!empty($dimensions_width->attribute_option_value)){{$dimensions_width->attribute_option_value}} @endif" name="dimensionsdimensionsWidth" id="dimensionsdimensionsWidth" type="text">
																	<span class="input-group-addon" id="basic-addon2">in</span>
																</div>
															</div>
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control" placeholder="Height" value="@if(!empty($dimensions_height->attribute_option_value)){{$dimensions_height->attribute_option_value}}@endif" name="dimensionsdimensionsHeight" id="dimensionsdimensionsHeight" type="text">
																	<span class="input-group-addon" id="basic-addon2">in</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												
												<div class="col-md-6">
													<h2 class="heading-agent">Preferences</h2>
													<div class="col-md-12">
														<div class="form-group has-feedback" >
															<label for="inputEmail3" class="control-label">{{$handling->label}}<span class="req-field" > *</span></label>
															<select class="form-control"    name="{{$handling->code}}" id="{{$handling->code}}">
																<option value="">Select Handling Time</option>
																@if(!empty($handling_value_value->attribute_option_value))
																	@foreach($handling_value as $index=>$handlingval)
																		<option <?php if($handling_value_value->attribute_option_value == $handlingval->option_value) {?> selected="selected" <?php } ?> value="{{$handlingval->option_id}}">{{$handlingval->option_value}}</option>
																	@endforeach
																@else
																	@foreach($handling_value as $index=>$handlingval)
																		<option value="{{$handlingval->option_id}}">{{$handlingval->option_value}}</option>
																	@endforeach
																@endif
															</select>
															<p class="error">{{ $errors->first('name') }}</p>
														</div>
														<div class="form-group has-feedback"  style="disply:none">
															<label for="inputEmail3" class="control-label">{{$returnpolicy->label}}<span class="req-field" > *</span></label>
															<select class="form-control"  name="{{$returnpolicy->code}}" id="{{$returnpolicy->code}}">
																<option value="">Select Return Policy</option>
																@if(!empty($returnpolicy_value_value->attribute_option_value))
																	@foreach($returnpolicy_value as $index=>$returnpolicyval)
																	<option <?php if($returnpolicy_value_value->attribute_option_value == $returnpolicyval->option_value) {?> selected="selected" <?php } ?> value="{{$returnpolicyval->option_id}}">{{$returnpolicyval->option_value}}</option>
																	@endforeach
																@else
																	@foreach($returnpolicy_value as $index=>$returnpolicyval)
																		<option value="{{$returnpolicyval->option_id}}">{{$returnpolicyval->option_value}}</option>
																	@endforeach
																@endif
															</select>
															<p class="error">{{ $errors->first('name') }}</p>
														</div>
													</div>
												</div>
												
												
												<div class="col-md-6">
													<h2 class="heading-agent">Donation Info</h2>
													<div class="col-md-12">
	<div class="form-group has-feedback" >
		<label for="inputEmail3" class="control-label">Donation to Charity<span class="req-field" ></span></label>
		<div class="input-group plus_minus_div">
			<!-- <span class="input-group-addon">$</span> -->
			<!-- <input type="text" class="form-control"  autocomplete="off"  name="charity_amount" id="charity_amount"> -->
			<!-- <select class="form-control" name="charity_amount" id="charity_amount"><option value="">Donate Amount</option>
				<option <?php if($cos_data->donation_percent == '10'){ ?> selected="selected" <?php } ?> value="10">10%</option>
				<option <?php if($cos_data->donation_percent == '20'){ ?> selected="selected" <?php } ?> value="20">20%</option>
				<option <?php if($cos_data->donation_percent == '30'){ ?> selected="selected" <?php } ?> value="30">30%</option>
				<option <?php if($cos_data->donation_percent == '1'){ ?> selected="selected" <?php } ?> value="1">1%</option>
			</select> -->
			<p class="form-rms-rel111">
				<div class="input-group ">
			         <span class="input-group-btn">
			              <button type="button" class="btn btn-default btn-number donate_charity"  data-type="minus" data-field="donate_charity">
			                  <span class="glyphicon glyphicon-minus"></span>
			              </button>
			          </span>
			          <input type="text" name="donate_charity" id="donate_charity" class="form-control input-number chr_bt1" value="{{$cos_data->donation_percent}}" >
			          <span class="input-group-btn">
			              <button type="button" class="btn btn-default btn-number donate_charity chr_bt2" data-type="plus" data-field="donate_charity">
			                  <span class="glyphicon glyphicon-plus"></span>
			              </button>
			          </span>
  				</div>
				
				<div class="clearfix"></div>
			</p>
			<p class="cst3-textl2 d-amount"  id="dynamic_percent_amounts"><i class="fa fa-usd" aria-hidden="true"></i>{{$cos_data->donation_amount}}</p>
			<input type="hidden" name="hidden_donation_amount" id="hidden_donation_amounts" value="{{$cos_data->donation_amount}}">
			<p class="error">{{ $errors->first('donate_charity') }}</p>
			<span id="don_err"  style="color:red">
			</div>
		</div>
															<div class="form-group has-feedback" >
																<label for="inputEmail3" class="control-label">Charity Name<span class="req-field" ></span></label>
																<select class="form-control"  autocomplete="off" name="charity_name" id="charity_name">
																	<option value="">Select Charity Name</option>
																	@foreach($charities as $index=>$charity)
																	<option <?php if ($cos_data->cos_charity_id == $charity->id) { ?> selected="selected"
																		<?php
																		} ?> value="{{$charity->id}}">{{$charity->name}}</option>
																		@endforeach
																</select>
																<p class="error">{{ $errors->first('charity_name') }}</p>
															</div>
														</div>
													</div>
													<?php //echo "<pre>";print_r($costume_image1);die; ?>
													<div class="col-md-12 frnt_back_view">
														<h2 class="heading-agent">Upload Images</h2>
														<div class="row">
															<div class="threeblogs c_edit_csmts">
																<div class="col-md-3 col-sm-4 col-xs-12" id="front_view">
																	<h2 class="box-title col-md-12 heading-agent pro-imgs text-center" >Front View</h2>
																	<div class="main_upload_blogs clearfix">
																		<span class="remove_pic" id="drag_n_drop_1" >
																			<i class="fa fa-times-circle" aria-hidden="true"></i>				
																		</span>
																		<div class=" up-blog">
																			<input type="file" name="file1"  id="file1" value="1"  >
																			<?php if(isset($costume_image1->image) && !empty($costume_image1->image)){
																			?>
																			<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
																			<div class="drop_uploader drop_zone drop_zone1"><ul class="files thumb">
																				<li id="selected_file_0">
																				<div class="thumbnail" style="background-image: url({{ asset('costumers_images/Medium')}}<?php echo '/'.$costume_image1->image; ?>)"></div></li></ul></div>
																				<input type="hidden" name="Imagecrop1" id="hidden_file1" data-id="{{$costume_image1->image}}" class="Forntview" value="">
																				<?php
																				}else { ?>
																				{{--<input type="file" name="file1"  value="1" id="file1">--}}
																				<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
																				<input type="hidden" name="Imagecrop1" class="Forntview" data-id="" value="">
																				<div class="drop_uploader drop_zone1">
																					<img src="" class="result" >
																				</div>
																				<?php
																				} ?>
																		</div>
																		<span id="file1_error" style="color:red"></span>
																	</div>
																</div>
																<div class="col-md-3 col-sm-4 col-xs-12 " id="back_view">
																	<h2 class="box-title col-md-12 heading-agent pro-imgs text-center">Back View</h2>
																	<div class="main_upload_blogs clearfix">
																		<span class="remove_pic" id="drag_n_drop_2" >
																			<i class="fa fa-times-circle" aria-hidden="true"></i>				
																		</span>
																		<input type="hidden"  id="hidden_file5" value="<?php if(isset($costume_image2->image) && !empty($costume_image2->image)){
																		?>{{$costume_image2->image}} <?php } ?>">
																		<div class=" up-blog">
																			<input type="file" name="file2"  id="file2" value="1">
																			<?php if(isset($costume_image2->image) && !empty($costume_image2->image)){
																			?>
																			<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
																			<div class="drop_uploader drop_zone drop_zone2"><ul class="files thumb"><li id="selected_file_1"><div class="thumbnail" style="background-image: url({{ asset('costumers_images/Medium')}}<?php echo '/'.$costume_image2->image; ?>)"></div></li></ul></div>
																			<input type="hidden" name="Imagecrop2" id="hidden_file2"  data-id ={{$costume_image2->image}} class="Backview" value="">
																			<?php
																			}else { ?>
																			{{--<input type="file" name="file2"   id="file2" value="1">--}}
																			<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
																			<input type="hidden" name="Imagecrop2" class="Backview" value="" data-id="">
																			<div class="drop_uploader drop_zone2">
																				<img src="" class="result2" >
																			</div>
																			<?php
																			} ?>
																		</div>
																	</div>
																</div>
																<div class="col-md-3 col-sm-4 col-xs-12 " id="details_view">
																	<h2 class="box-title col-md-12 heading-agent pro-imgs text-center">Additional</h2>
																	<div class="main_upload_blogs clearfix">
																		<span class="remove_pic" id="drag_n_drop_3">
																			<i class="fa fa-times-circle" aria-hidden="true"></i>					
																		</span>
																		<input type="hidden"  id="hidden_file4" value="<?php if(isset($costume_image3->image) && !empty($costume_image3->image)){
																		?>{{$costume_image3->image}} <?php } ?>">
																		<div class=" up-blog">
																			<input type="file" name="file3" id="file3" value="1">
																			<?php if(isset($costume_image3->image) && !empty($costume_image3->image)){
																			?>
																			<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
																			<div class="drop_uploader drop_zone drop_zone3"><ul class="files thumb"><li id="selected_file_2"><div class="thumbnail" style="background-image: url({{ asset('costumers_images/Medium')}}<?php echo '/'.$costume_image3->image; ?>)"></div></li></ul></div>
																			<input type="hidden" name="Imagecrop3" data-id ="{{$costume_image3->image}}" data-value="3" class="Additional" value="">
																			<?php
																			}else { ?>
																			{{--<input type="file" name="file3"  id="file3" value="1">--}}
																			<input type="hidden" name="Imagecrop3" class="Additional" value="" data-id="">
																			<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
																			<div class="drop_uploader drop_zone3">
																				<img src="" class="result3" >
																			</div>
																			<?php
																			} ?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<h2 class="heading-agent">Upload More</h2>
														<div class="threeblogs edit_admin_cstume">
															<?php
																$i=0;
															?>
															<?php foreach ($costume_images as  $images) { ?>
																<div class="col-md-4 col-sm-4 col-xs-12 multi_div" id="remv_{{$i}}">
																	<input type="hidden" name="hidden_file4[]"  id="remv_{{$i}}" class="hiddenValue" data-id = "{{$images->image}}" value="{{$images->image}}">
																	<div class="multi_thumbs pip" style="background-image: url({{ asset('costumers_images/Medium/'.$images->image) }})">
																		<span class="remove_pic remove " data-id = "remv_{{$i}}">
																			<i class="fa fa-times-circle" aria-hidden="true"></i>				
																		</span>
																	</div>
																</div>
															<?php  $i++; } ?>
															<div id="other_thumbnails" class=" edit_thumbs">
																<!--<div class="col-md-3 col-sm-3 col-xs-12"></div>-->
															</div>
															<div class="multiHidden">
															</div>
															<div class="deletedImages">
															</div>
															<div class="FrontDelete">
															</div>
															<div class="BackDelete">
															</div>
															<div class="AddiDelete">
															</div>
															<input class="input-btn" id="upload-file-selector" name="files[]" accept="image/*" multiple="" type="file">
														</div>
													</div>
													<div class="box-footer">
														<div class="pull-right">
															<a href="/customes-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
															<button type="submit" id="submit" name="submit"  class="btn btn-info pull-right">Submit</button>
														</div>
													</div>
												</div>
											</div>
											<!-- modal code here multiple images -->
											<div id="myModal" class="modal fade imageModel and carousel slide" role="dialog" data-backdrop="static">
												<div class="modal-dialog modal-md">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															{{--<button type="button" class="close"  id="closeModal1" data-dismiss="modal">&times;</button>--}}
															<h4 class="modal-title text-center">Front View</h4>
														</div>
														<div class="modal-body">
															<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
															<div class="carousel-inner" id="dvPreview">
															</div>
															<div class="img-pp">
																<div class="img-pp-iner">
																	<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
																	<input type="range" id="zoom-level" min="0" max="4" value="2" step="any" >
																	<img class="img-responsive crp2" src="{{URL::asset('assets/frontend/img/crp_2.png')}}">
																</div>
															</div>
															<div class="width"></div>
															<div class="height"></div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-success pull-right save" id="crop">Save</button>
															<button type="button" class="btn btn-default img_clse" data-dismiss="modal">Cancel</button>
														</div>
													</div>
												</div>
											</div>
											<!-- second modal code here -->
											<div id="myModal2" class="modal fade imageModel and carousel slide" role="dialog"  data-backdrop="static">
												<div class="modal-dialog modal-md">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															{{--<button type="button" class="close"  id="closeModal2"  data-dismiss="modal">&times;</button>--}}
															<h4 class="modal-title text-center">Back View</h4>
														</div>
														<div class="modal-body">
															<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
															<div class="carousel-inner" id="dvPreview2">
															</div>
															<div class="img-pp">
																<div class="img-pp-iner">
																	<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
																	<input type="range" id="zoom-level2" min="0" max="4"  value="2" step="any" >
																	<img class="img-responsive crp2" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
																</div>
															</div>
															<div class="width"></div>
															<div class="height"></div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-success pull-right save" id="crop2">Save</button>
															<button type="button" class="btn btn-default img_clse" data-dismiss="modal">Cancel</button>
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
															{{--<button type="button" class="close"  id="closeModal3"  data-dismiss="modal">&times;</button>--}}
															<h4 class="modal-title text-center">Additional</h4>
														</div>
														<div class="modal-body">
															<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
															<div class="carousel-inner" id="dvPreview3">
															</div>
															<div class="img-pp">
																<div class="img-pp-iner">
																	<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
																	<input type="range" id="zoom-level3" min="0" max="4"  value="2" step="any" >
																	<img class="img-responsive crp2" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
																</div>
															</div>
															<div class="width"></div>
															<div class="height"></div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-success pull-right save" id="crop3">Save</button>
															<button type="button" class="btn btn-default img_clse" data-dismiss="modal">Cancel</button>
														</div>
													</div>
												</div>
											</div>
											<!-- multiple file modal -->
											<div class="modal fade and carousel slide" id="lightbox" data-interval="false"  data-backdrop="static">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															{{--<button type="button" class="close" id="closemulti" data-dismiss="modal">&times;</button>--}}
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
																<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
																<input type="range" id="zoom-level" class="slider" min="0" max="4"  value="2" step="any" />
																<img class="img-responsive crp2" src="{{URL::asset('assets/frontend/img/crp_2.png')}}">
															</div>
														</div>
														<div class="modal-footer" style="display:none;">
															<button type="button" class="btn btn-success pull-right saveMultiple" >Save</button>
															<button type="button" class="btn btn-default img_clse" id="multiCancel" data-dismiss="modal">Cancel</button>
														</div>
													</div><!-- /.modal-content -->
												</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</form>
										</div>
										</section>
										@stop
										{{-- page level scripts --}}
										@section('footer_scripts')
										<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
										<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
										<script src="{{ asset('/assets/admin/js/pages/customers.js') }}"></script>
										<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.js"></script>
										<script src="{{ asset('/assets/admin/js/costumeedit.js') }}"></script>
										<script type="text/javascript" src="{{asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')}}"></script>
<script type="text/javascript">

$(document).ready(function () {


$(".conditon_check").change(function(){
							
	if($("#good").prop("checked") || $("#likenew").prop("checked")){
		$("#cleaned_select").removeClass("hide");
	} else{
		$("#cleaned_select").addClass("hide");
		$("#cleaned").val('');
	}
	});

							
$(".conditon_check").trigger("change");


if($("#faq_value_exists").val() == 1){
$("#freqent").removeClass("hide");
}

if($("#size").val() == "custom"){
	$(".dimessions").removeClass('hide');
}
	if(parseInt($("#donate_charity").val())==10){
		$("#donate_charity").css({"color":"#5fc5ac","font-weight":"bold"});
	}

	if(parseInt($("#donate_charity").val())<10){
		$("#donate_charity").css({"color":"#000","font-weight":""});
	}

	if(parseInt($("#donate_charity").val()) ==15){
		$("#donate_charity").val($("#donate_charity").val()).css({"color":"#5fc5ac","font-weight":"bold"});
	}

	if(parseInt($("#donate_charity").val()) ==25){
		$("#donate_charity").val($("#donate_charity").val()).css({"color":"#5fc5ac","font-weight":"bold"});
	}

	if(parseInt($("#donate_charity").val()) ==50){
		$("#donate_charity").val($("#donate_charity").val()).css({"color":"#5fc5ac","font-weight":"bold"});
	}

	if(parseInt($("#donate_charity").val()) ==100){
		$("#donate_charity").val($("#donate_charity").val()).css({"color":"#5fc5ac","font-weight":"bold"});
	}

 	var total_val = "0.00";
  
	$('.btn-number').click(function(e){
	    e.preventDefault();    
	    fieldName = $(this).attr('data-field');
	    type      = $(this).attr('data-type');
	    var input = $("input[name='"+fieldName+"']");

	    var currentVal = parseInt(input.val());
	    var min = 0; var max = 100;
		if(type == 'minus') {
			if(currentVal <= 10){
				var present = currentVal-1;
			}else if(currentVal == 15){
				var present = currentVal-5;
			}else if(currentVal == 25){
				var present = currentVal-10;
			}else if(currentVal == 50){
				var present = currentVal-25;
			}else if(currentVal == 100){
				var present = currentVal-50;
			}
		}
        else if(type == 'plus') {
            if(currentVal < 10){
       			var present = currentVal+1;
       		}else if(currentVal == 10 ){
       			var present = currentVal+5;
       		}else if(currentVal == 15 ){
       			var present = currentVal+10;
       		}else if(currentVal == 25 ){
       			var present = currentVal+25;
       		}else if(currentVal>=50){
       			var present = currentVal+50;
       		}         
        }                       
	    var price = $('#price').val();                       
	    var total = (price * present) / 100;  
	    var amount = parseFloat(total).toFixed(2);
	  
       	$('#hidden_donation_amounts').val(amount);
       	$('#dynamic_percent_amounts').html("$"+amount);

	    if (!isNaN(currentVal)) {
	        if(type == 'minus') {            
	            if(currentVal <= 10){
                   	if(currentVal > min) {
                   		input.val((currentVal - 1)+" %").css({"color":"#000","font-weight":""}).change();
                   	}
                   	if(parseInt(input.val()) == min) {
                   		$(this).attr('disabled', true);
                   	}
               	}else if(currentVal == 15 ){
               		if(currentVal > min) {
                   		input.val((currentVal - 5)+" %").css({"color":"#000","font-weight":""}).change();
                   	}
                   	if(parseInt(input.val()) == min) {
                   		$(this).attr('disabled', true);
                   	}
               	}else if(currentVal == 25 ){
               		if(currentVal > min) {
                   		input.val((currentVal - 10)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                   	}
                   	if(parseInt(input.val()) == min) {
                   		$(this).attr('disabled', true);
                   	}
               	}else if(currentVal == 50 ){
               		if(currentVal > min) {
                   		input.val((currentVal - 25)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                   	}
                   	if(parseInt(input.val()) == min) {
                   		$(this).attr('disabled', true);
                   	}
               	}else if(currentVal<=100){
           			if(currentVal <= max) {
                   		input.val((currentVal - 50)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                   	}
                   	if(parseInt(input.val()) == max) {
                   		$(this).attr('disabled', true);
                   	}
           		}
	        } else if(type == 'plus') {

	            if(currentVal < 10){
           			if(currentVal < max) {
                   		if(currentVal == 9){
           					input.val((currentVal + 1)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
           				}else{
           					input.val((currentVal + 1)+" %").css({"color":"#000","font-weight":""}).change();
           				}
                   		//input.val((currentVal + 1)+" %").css({"color":"#000","font-weight":""}).change();
                   	}
                   	if(parseInt(input.val()) == max) {
                   		$(this).attr('disabled', true);
                   	}
           		}else if(currentVal == 10 ){
           			if(currentVal < max) {
                   		input.val((currentVal + 5)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                   	}
                   	if(parseInt(input.val()) == max) {
                   		$(this).attr('disabled', true);
                   	}
           		}else if(currentVal == 15 ){
           			if(currentVal < max) {
                   		input.val((currentVal + 10)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                   	}
                   	if(parseInt(input.val()) == max) {
                   		$(this).attr('disabled', true);
                   	}
           		}else if(currentVal == 25 ){
           			if(currentVal < max) {
                   		input.val((currentVal + 25)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                   	}
                   	if(parseInt(input.val()) == max) {
                   		$(this).attr('disabled', true);
                   	}
           		}else if(currentVal>=50){
           			if(currentVal < max) {
                   		input.val((currentVal + 50)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                   	}
                   	if(parseInt(input.val()) == max) {
                   		$(this).attr('disabled', true);
                   	}
           		}

	        }
	    } else {
	        input.val(0);
	    }
	});	 

		$('.input-number').focusin(function(){
	   		$(this).data('oldValue', $(this).val());
		});
		$('.input-number').change(function() {
		    
		    minValue =  0;//parseInt($(this).attr('min'));
		    maxValue =  100;//parseInt($(this).attr('max'));
		    valueCurrent = parseInt($(this).val());
		    
		    name = $(this).attr('name');
		    if(valueCurrent >= minValue) {
		        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
		    } else {
		        alert('Sorry, the minimum value was reached');
		        $(this).val($(this).data('oldValue'));
		    }
		    if(valueCurrent <= maxValue) {
		        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
		    } else {
		        alert('Sorry, the maximum value was reached');
		        $(this).val($(this).data('oldValue'));
		    } 
		});
		$(".input-number").keydown(function (e) {
	        // Allow: backspace, delete, tab, escape, enter and .
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
	             // Allow: Ctrl+A
	            (e.keyCode == 65 && e.ctrlKey === true) || 
	             // Allow: home, end, left, right
	            (e.keyCode >= 35 && e.keyCode <= 39)) {
	                 // let it happen, don't do anything
	                 return;
	        }
	        // Ensure that it is a number and stop the keypress
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });


		$("#size").change(function()
		{
			var val = $(this).val();
			if(val == 'custom')
			{
				$(".dimessions").removeClass('hide');
			}
			else
			{
				$(".dimessions").addClass('hide');
				
			}
		});
	$(".faq-checkbox").change(function(){
			
		if($("#make_costume").prop("checked") || $("#fimquality").prop("checked")){
			
			$("#freqent").removeClass("hide");
		} 
		else{
			
			$("#freqent").addClass("hide");
		}
	});
	$(".faq-checkbox").trigger("change");
	var Fimage = $("input[name=Imagecrop1]").attr('data-id');
	var Bimage = $("input[name=Imagecrop2]").attr('data-id');
	var Aimage = $("input[name=Imagecrop3]").attr('data-id');

	if(Fimage == '')
	{
	$("#drag_n_drop_1").hide();
	}

	if(Bimage == '')
	{
	$("#drag_n_drop_2").hide();
	}
	if(Aimage == '')
	{
	$("#drag_n_drop_3").hide();
	}

	$("#submit").click(function(a) {                                                     
	if($("input[name=Imagecrop1]").attr('data-id') == "")
	{

	$('input[name=file1]').css('border', '1px solid red');
	$('#file1_error').html('Upload Front View');
	return false;                                          

	}                                                    

	});
																							
												$(document).on("click",".img_clse",function()
												{ 												
												   $("#drag_n_drop_1").hide();
												   $("#drag_n_drop_2").hide();
												   $("#drag_n_drop_3").hide();
												});
												 
												//donate amount percentage calculation
												/*$('#charity_amount').change(function(){
													var donate_percent = $(this).val();
													var price = $('#price').val();
													var total = (price*donate_percent)/100;
													if (donate_percent=="none") {
														var total = 0.00;
													}
													$('#hidden_donation_amount').val(parseFloat(total).toFixed(2));
													$('#dynamic_percent_amount').html("<i class='fa fa-usd' aria-hidden='true'></i> " +parseFloat(total).toFixed(2));
												});*/
												 
												var hidden_file4 = $('#hidden_file4').val();
												if (hidden_file4 == "") {
													$('#drag_n_drop_3').css('display','none');
												}
												var hidden_file5 = $('#hidden_file5').val();
												if (hidden_file5 == "") {
													$('#drag_n_drop_2').css('display','none');
												}
												$('#drag_n_drop_1').click(function(){
													var imageName = '<?php if(isset($costume_image1->image) && !empty($costume_image1->image)){echo $costume_image1->image; }; ?>';
													var imageType = 1;
													if(imageName.length>0){
														deleteCostumeImage(imageName,imageType);
													}
													$('#front_view').find('li').remove();
													$('#drag_n_drop_1').css('display','none');													 
													$("input[name=file1]").attr('style',''); 
													$('input[name=file1]').val('');
													$('input[name=file1]').attr('value','');
												});
												$('#drag_n_drop_2').click(function(){
													var imageName = '<?php if(isset($costume_image2->image) && !empty($costume_image2->image)){echo $costume_image2->image; }; ?>';
													var imageType = 2;
													if(imageName.length>0){
														deleteCostumeImage(imageName,imageType);
													}
													$('#back_view').find('li').remove();
													$('#drag_n_drop_2').css('display','none');
													$("input[name=file2]").attr('style',''); 
													$('input[name=file2]').val('');
													$('input[name=file2]').attr('value','');
												});
												$('#drag_n_drop_3').click(function(){
													var imageName = '<?php if(isset($costume_image3->image) && !empty($costume_image3->image)){echo $costume_image3->image; }; ?>';
													var imageType = 3;
													if(imageName.length>0){
													deleteCostumeImage(imageName,imageType);                }
													$('#details_view').find('li').remove();
													$('#drag_n_drop_3').css('display','none');
													$("input[name=file3]").attr('style',''); 
													$('input[name=file3]').val('');
													$('input[name=file3]').attr('value','');
												});
												$(".remove").click(function(){
													$(this).parent(".pip").remove();
												});
											});
											function cosplay_yes(id){
												if (id == 7) {
													$('#cosplayplay_yes_div').css('display','block');
													}else{
													$('#cosplayplay_yes_div').css('display','none');
													$('input[name=cosplayplay_yes_opt]').attr('checked',false);
												}
											}
											function uniquefashion_yes(id){
												if (id == 9) {
													$('#uniquefashion_yes_div').css('display','block');
													}else{
													$('#uniquefashion_yes_div').css('display','none');
													$('input[name=uniquefashion_yes_opt]').attr('checked',false);
												}
											}
											function activity_yes(id){
												if (id == 11) {
													$('#activity_yes_div').css('display','block');
													}else{
													$('#activity_yes_div').css('display','none');
													$('input[name=activity_yes_opt]').attr('checked',false);
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
													$('#make_costume_time').attr('value','');
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
											function deleteCostumeImage(imageName,imageType){
												$.ajax({
													type: "POST",
													url: '{!! url('delete-costume-image') !!}',
													data: {'image_name':imageName,image_type:imageType},
													dataType: 'JSON',
													success: function(response) {
													}
												});
											}
											//delete multiple selected images code
											var allRemove = [];
											$(document).on("click",".remove_pic",function()
											{
												
											    var cur_val = $(this).attr('data-id');
												var cur_rem_val = $(this).parents().attr('style');
												var last_one = cur_rem_val.substr(cur_rem_val.length - 15);
												var remove_org_val = last_one.slice(0,-1);
												var MakeInput = '';
												  removeValue =  $("#"+cur_val).val();
												
												$("#"+cur_val).remove();
												 //$(this).parents().find("#"+cur_val).remove();
												//$("#"+cur_val).parents().find("div.multi_div").remove();
												allRemove.push(remove_org_val);
												
												$.each( allRemove, function( key, value ) {
													MakeInput =  '<input type="hidden" name="multiple[]" value="'+value+'">';
												});
												$(".deletedImages").append(MakeInput);
											});
										</script>
										<script type="text/javascript">
											$("#heightft,#heightin,#weightlbs,#chestin,#waistlbs,#dimensionsdimensionsWidth,#dimensionsdimensionsLength,#dimensionsdimensionsLength,#make_costume_time").on("keyup", function(){
												var valid = /^\d{0,4}(\.\d{0,4})?$/.test(this.value),
												val = this.value;
												if(!valid){
													//console.log("Invalid input!");
													this.value = val.substring(0, val.length - 1);
												}
											});
											$("#price,#donate_charity").on("keyup", function(){
												var valid = /^\d{0,20}(\.\d{0,20})?$/.test(this.value),
												val = this.value;
												if(!valid){
													//console.log("Invalid input!");
													this.value = val.substring(0, val.length - 1);
												}
											});
										</script>
									@stop									
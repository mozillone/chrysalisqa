<<<<<<< HEAD
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
							<h2 class="heading-agent">*Costume Information</h2>
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
										<label for="inputEmail3" class="control-label">Costume For<span class="req-field" >*</span></label>
										<br>
										<label class="radio-inline">
										<input type="radio" <?php if ($cos_data->cos_gender == 'male') { ?> checked='checked'	 <?php } ?>  name="gender" id="male"  value="male" >Male</label>
										<label class="radio-inline">
										<input type="radio" <?php if ($cos_data->cos_gender == 'female') { ?> checked='checked'	 <?php } ?>  name="gender" id="female"  value="female"  >Female</label>
										<label class="radio-inline">
										<input type="radio" <?php if ($cos_data->cos_gender == 'boy') { ?> checked='checked'  <?php } ?>    name="gender" id="boy"  value="boy" >Boys</label>
										<label class="radio-inline">
										<input type="radio" <?php if ($cos_data->cos_gender == 'girl') { ?> checked='checked'  <?php } ?>    name="gender" id="girl"  value="girl"  >Girls</label>
										<label class="radio-inline">
										<input type="radio" <?php if ($cos_data->cos_gender == 'baby') { ?> checked='checked'  <?php } ?>    name="gender" id="baby"  value="baby"  >Babies</label>
									</div>
									<span id="gendererror" style="color:red"></span>
								</div>
								<?php //echo "<pre>";print_r($sub_cat->category_id);die; ?>
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Catgeory<span class="req-field" >*</span></label>
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
									<span id="categoryerror" style="color:red"></span>
								</div>
								<div class="form-group has-feedback create-admin_pagess" >
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">Condition <span class="req-field" >*</span></label>
										<br>
										<label class="radio-inline"><input type="radio" <?php if ($cos_data->cos_condition == 'brand_new') { ?> checked='checked'	 <?php } ?> name="costumecondition" id="brandnew"  value="brand_new"> &nbsp;
											Brand New&nbsp;
										</label>
										<label class="radio-inline"><input type="radio" <?php if ($cos_data->cos_condition == 'like_new') { ?> checked='checked'	 <?php } ?> name="costumecondition" id="likenew"  value="like_new">&nbsp;
											Like New&nbsp;
										</label>
										<label class="radio-inline"><input type="radio" <?php if ($cos_data->cos_condition == 'excellent') { ?> checked='checked'	 <?php } ?> name="costumecondition" id="excellent"   value="excellent"  > &nbsp;
											Excellent&nbsp;
										</label>
										<label class="radio-inline"><input type="radio" <?php if ($cos_data->cos_condition == 'good') { ?> checked='checked'	 <?php } ?> name="costumecondition" id="good"  value="good">&nbsp;
											Good&nbsp;
										</label>
									</div>
									<span id="costumeconditionerror" style="color:red"></span>
								</div>
								<?php //echo "<pre>"; print_r($get_costume_attribute_options); ?>
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
												<input type="{{$bd_height->type}}" class="form-control"  value="@if(!empty($bd_height_value->attribute_option_value)){{$bd_height_value->attribute_option_value}}@endif" name="{{$bd_height->code}}" id="{{$bd_height->code}}">
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
												<input type="{{$bd_height_in->type}}"  class="form-control" value="@if(!empty($bd_height_in_value->attribute_option_value)){{$bd_height_in_value->attribute_option_value}}@endif"  name="{{$bd_height_in->code}}" id="{{$bd_height_in->code}}">
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
													<label for="inputEmail3" class="control-label"><?php echo $attribute2;?><span class="req-field" ></span></label>
													<div class="input-group">
														<input type="{{$bd_weight->type}}" value="@if(!empty($bd_weight_value->attribute_option_value)){{$bd_weight_value->attribute_option_value}}@endif" class="form-control" name="{{$bd_weight->code}}" id="{{$bd_weight->code}}">
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
													<label for="inputEmail3" class="control-label"><?php echo $attribute3;?><span class="req-field" ></span></label>
													<div class="input-group">
														<input type="{{$bd_chest->type}}" class="form-control" value="@if(!empty($bd_chest_value->attribute_option_value)){{$bd_chest_value->attribute_option_value}}@endif"  name="{{$bd_chest->code}}" id="{{$bd_chest->code}}">
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
													<label for="inputEmail3" class="control-label"><?php echo $attribute;?><span class="req-field" ></span></label>
													<div class="input-group">
														<input type="{{$bd_waist->type}}" class="form-control" value="@if(!empty($bd_waist_value->attribute_option_value)){{$bd_waist_value->attribute_option_value}}@endif" name="{{$bd_waist->code}}" id="{{$bd_waist->code}}">
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
														<option <?php if ($cos_data->cos_size == '1sz') { ?> selected='selected' <?php } ?> value="1sz">1SZ</option>
														<option <?php if ($cos_data->cos_size == 'xxs') { ?> selected='selected' <?php } ?> value="xxs">XXS</option>
														<option <?php if ($cos_data->cos_size == 'xs') { ?> selected='selected' <?php } ?> value="xs">XS</option>
														<option <?php if ($cos_data->cos_size == 's') { ?> selected='selected' <?php } ?> value="s">S</option>
														<option <?php if ($cos_data->cos_size == 'm') { ?> selected='selected' <?php } ?> value="m">M</option>
														<option <?php if ($cos_data->cos_size == 'l') { ?> selected='selected' <?php } ?> value="l">L</option>
														<option <?php if ($cos_data->cos_size == 'xl') { ?> selected='selected' <?php } ?> value="xl">XL</option>
														<option <?php if ($cos_data->cos_size == 'xxl') { ?> selected='selected' <?php } ?> value="xxl">XXL</option>
														<option <?php if ($cos_data->cos_size == 'std') { ?> selected='selected' <?php } ?> value="std">STD</option>
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
										<?php //$cosplay_one_value_value->attribute_option_value_id = "8";
										//echo "<pre>";print_r($cosplay_one_value_value);die; ?>
										@foreach($cosplay_one_value as $index=>$cosplayonevalues)
										<?php if ($cosplayonevalues->option_value == "yes") {?>
                                            <input type="{{$cosplay_one->type}}" @if($cosplay_one_value_value->attribute_option_value_id == $cosplayonevalues->option_id) checked="checked" @endif name="{{$cosplay_one->code}}" id="{{$cosplay_one->code}}"  value="{{$cosplayonevalues->option_id}}" required>&nbsp;
                                            {{$cosplayonevalues->option_value}}&nbsp;
                                            <?php } else {?>
                                            <input type="{{$cosplay_one->type}}"  @if($cosplay_one_value_value->attribute_option_value_id == $cosplayonevalues->option_id) checked="checked" @endif name="{{$cosplay_one->code}}" id="{{$cosplay_one->code}}"  value="{{$cosplayonevalues->option_id}}" onclick="cosplay_yes(<?php echo $cosplayonevalues->option_id?>)"  required>&nbsp;
                                            {{$cosplayonevalues->option_value}}&nbsp;
										<?php }?>
										@endforeach
										@if(count($cosplayplay_yes_opt) == 1)
										<div class="row" id="cosplayplay_yes_div" @if(count($cosplayplay_yes_opt) != 1) style="display: none;" @endif>
											<div class="col-md-12" >
												@foreach($cosplaySubCategories as $subCat)
												<div class="radio-inline">
													<label><input type="radio" name="cosplayplay_yes_opt" @if($cosplayplay_yes_opt->attribute_option_value == $subCat->name) checked="checked" @endif value="{{ $subCat->name }}">{{ $subCat->name }}</label>
												</div>
												@endforeach
											</div>
											<span id="cosplay_yeserror" style="color:red"></span>
										</div>
										@else
										<div class="row" id="cosplayplay_yes_div" style="display: none;">
											<div class="col-md-12">
												@foreach($cosplaySubCategories as $subCat)
												<div class="radio-inline">
													<label for="{{ $subCat->name }}"><input type="radio" name="cosplayplay_yes_opt" value="{{ $subCat->name }}" >{{ $subCat->name }}</label>
												</div>
												@endforeach
											</div> 
											<span id="cosplay_yeserror" style="color:red"></span>
										</div>
										@endif
									</div>
								</div>
								<div class="form-group has-feedback" >
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">
											<?php echo $cosplay_two->label;?>
										<span class="req-field" ></span></label>
										<br>
										@foreach($cosplay_two_value as $index=>$cosplaytwovalues)
										<input type="{{$cosplay_two->type}}" @if($cosplay_two_value_value->attribute_option_value_id == $cosplaytwovalues->option_id) checked="checked" @endif  name="{{$cosplay_two->code}}" id="{{$cosplay_two->code}}"  value="{{$cosplaytwovalues->option_id}}" onclick="uniquefashion_yes({{$cosplaytwovalues->option_id}})"  required>&nbsp;
										{{$cosplaytwovalues->option_value}}&nbsp;
										@endforeach
										@if(count($uniquefashion_yes_opt) == 1)
										<div class="row" id="uniquefashion_yes_div" @if(count($uniquefashion_yes_opt)!= 1) style="display: none;" @endif>
											<div class="col-md-12" >
												@foreach($uniqueFashionSubCategories as $subCat)
												<div class="radio-inline">
													<label><input type="radio" name="uniquefashion_yes_opt" @if($uniquefashion_yes_opt->attribute_option_value == $subCat->name) checked="checked" @endif value="{{ $subCat->name }}">{{ $subCat->name }}</label>
												</div>
												@endforeach
											</div>
											<span id="uniquefashion_yeserror" style="color:red"></span>
										</div>
										@else
										<div class="row" id="uniquefashion_yes_div"  style="display: none;">
											<div class="col-md-12">
												@foreach($uniqueFashionSubCategories as $subCat)
												<div class="radio-inline">
													<label for="{{ $subCat->name }}"><input type="radio" name="uniquefashion_yes_opt" value="{{ $subCat->name }}" >{{ $subCat->name }}</label>
												</div>
												@endforeach
											</div> 
											<span id="uniquefashion_yeserror" style="color:red"></span>
										</div>
										@endif
									</div>
								</div>
								<div class="form-group has-feedback" >
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">
											<?php echo $cosplay_three->label;?>
										<span class="req-field" ></span></label>
										<br>
										@foreach($cosplay_three_value as $index=>$cosplaythreevalues)
										<input type="{{$cosplay_three->type}}" @if($cosplay_three_value_value->attribute_option_value_id == $cosplaythreevalues->option_id) checked="checked" @endif name="{{$cosplay_three->code}}" id="{{$cosplay_three->code}}" onclick="activity_yes({{$cosplaythreevalues->option_id}})"  value="{{$cosplaythreevalues->option_id}}"  required>&nbsp;
										{{$cosplaythreevalues->option_value}}&nbsp;
										@endforeach
										@if(count($activity_yes_opt) == 1)
										<div class="row" id="activity_yes_div" @if(count($activity_yes_opt) != 1) style="display: none;" @endif>
											<div class="col-md-12" >
												@foreach($filmTheatreSubCategories as $subCat)
												<div class="radio-inline">
													<label><input type="radio" name="activity_yes_opt" @if($activity_yes_opt->attribute_option_value == $subCat->name) checked="checked" @endif value="{{ $subCat->name }}">{{ $subCat->name }}</label>
												</div>
												@endforeach
											</div>
											<span id="activity_yeserror" style="color:red"></span>
										</div>
										@else
										<div class="row" id="activity_yes_div" style="display: none;">
											<div class="col-md-12">
												@foreach($filmTheatreSubCategories as $subCat)
												<div class="radio-inline">
													<label for="{{ $subCat->name }}"><input type="radio" name="activity_yes_opt" value="{{ $subCat->name }}" >{{ $subCat->name }}</label>
												</div>
												@endforeach
											</div> 
											<span id="activity_yeserror" style="color:red"></span>
										</div>
										@endif
									</div>
								</div>
								<div class="form-group has-feedback" >
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">
											<?php echo $cosplay_four->label;?>
										<span class="req-field" ></span></label>
										<br>
										@foreach($cosplay_four_value as $index=>$cosplayfourvalues)
										<input type="{{$cosplay_four->type}}" @if($cosplay_four_value_value->attribute_option_value_id == $cosplayfourvalues->option_id) checked="checked" @endif name="{{$cosplay_four->code}}" id="{{$cosplay_four->code}}"  value="{{$cosplayfourvalues->option_id}}" onclick="make_costume_yes({{$cosplayfourvalues->option_id}})"  required>&nbsp;
										{{$cosplayfourvalues->option_value}}&nbsp;
										@endforeach
										@if(count($make_costume_time)== 1)
										<p class="form-rms-small" id="mention_hours" @if(count($make_costume_time)!= 1) style="display: none;" @endif >If yes, how long did it take?</p>
										<p class="ct1-rms-rel" id="mention_hours_input" @if(count($make_costume_time)!= 1) style="display: none;" @endif><input type="text" name="make_costume_time" id="make_costume_time" value="{{$make_costume_time->attribute_option_value}}" class="input-rm100"> <span>hours<span>
										</p>
										@else
										<p class="form-rms-small" id="mention_hours" style="display: none;" >If yes, how long did it take?</p>
										<p class="ct1-rms-rel" id="mention_hours_input" style="display: none;"><input type="text" name="make_costume_time" id="make_costume_time" value="" class="input-rm100"> <span>hours<span>
										</p>
										@endif
                                        </div>
										</div>
										<div class="form-group has-feedback" >
											<div class="form-group" >
												<label for="inputEmail3" class="control-label">
													<?php echo $cosplay_five->label;?>
												<span class="req-field" ></span></label>
												<br>
												<?php //echo "<pre>";print_r($cosplay_five_value_value);die; ?>
												@foreach($cosplay_five_value as $index=>$cosplayfivevalues)
												<input type="{{$cosplay_five->type}}" @if($cosplay_five_value_value->attribute_option_value_id == $cosplayfivevalues->option_id) checked="checked" @endif name="{{$cosplay_five->code}}" id="{{$cosplay_five->code}}"  value="{{$cosplayfivevalues->option_id}}"  onclick="film_name_yes({{$cosplayfivevalues->option_id}})"  required >&nbsp;
												{{$cosplayfivevalues->option_value}}&nbsp;
												@endforeach
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
													</div>
													<div class="form-group has-feedback" >
														<label for="inputEmail3" class="control-label kyword">How would you describe your costume?</p>
														<p>Have a unique costume? Please enter a maximum of <strong>10</strong> keywords to describe it.</p>
													<p>Tip:Have a speciailty costume? To increase your changes of making a sale, input the approprite keywords with our existing <span>list of categories.</span> </p><span class="req-field" ></span></label>
													<div class="input-group">
														<input type="text" id="keywords_tag" class="form-control" name="keywords_tag">
														<a href="javascript:void(0);" id="keywords_add" >ADD</a>
														<div id="div">
															@if(!empty($cos_data->cos_keywords))
															<?php $explode = explode(',', $cos_data->cos_keywords);
																foreach ($explode as $key => $keywords) {
																?>
																@if(!empty($keywords))
																<p class="keywords_p p_{{$key+1}}">{{$keywords}}<span id="remove_{{$key+1}}">X</span> </p>
																<input id="input_{{$key+1}}" name="keyword[]" value="{{$keywords}}" type="hidden">
																@endif
																<?php
																}
															?>
															@endif
														</div>
														<div id="count">@if(!empty($cos_data->cos_keywords)){{10 -  count($explode)}} @endif left</div>
													</div>
													<span id="costume-desc-error" style="color:red"></span>
												</div>
												<div class="form-group has-feedback" >
													<label for="inputEmail3" class="control-label">{{$description->label}}<span class="req-field" ></span></label>
													<div class="input-group">
														<textarea type="{{$description->type}}"  rows="6" cols="63" class="form-control"   name="{{$description->code}}" id="{{$description->code}}">{{$cos_data->cos_description}}</textarea>
													</div>
													<span id="costume-desc-error" style="color:red"></span>
												</div>
												<div class="form-group has-feedback" >
													<label for="inputEmail3" class="control-label">{{$funfacts->label}}<span class="req-field" ></span></label>
													<div class="input-group">
														<textarea type="{{$funfacts->type}}" rows="6" cols="63" class="form-control"   name="{{$funfacts->code}}" id="{{$funfacts->code}}">@if(!empty($funfacts_value_value->attribute_option_value)){{$funfacts_value_value->attribute_option_value}}@endif</textarea>
													</div>
													<span id="funfact-error" style="color:red"></span>
												</div>
												<div class="form-group has-feedback" >
													<label for="inputEmail3" class="control-label">{{$faq->label}}<span class="req-field" ></span></label>
													<div class="input-group">
														<textarea type="{{$faq->type}}" rows="6" cols="63" class="form-control"   name="{{$faq->code}}" id="{{$faq->code}}">@if(!empty($faq_value_value->attribute_option_value)){{$faq_value_value->attribute_option_value}}@endif</textarea>
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
																	<input type="text" class="form-control" value="{{$cos_data->cos_price}}" aria-label="Amount (to the nearest dollar)" name="price" id="price" >
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
												</div>
												<div class="col-md-6 pckg_right">
													<h2 class="heading-agent">Package Information</h2>
													<div class="col-md-12">
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
															<label for="inputEmail3" class="control-label">{{$handling->label}}<span class="req-field" ></span></label>
															<select class="form-control"    name="{{$handling->code}}" id="{{$handling->code}}">
																<option value="">Select Handling Time</option>
																@foreach($handling_value as $index=>$handlingval)
																<option <?php if($handling_value_value->attribute_option_value == $handlingval->option_value) {?> selected="selected" <?php } ?> value="{{$handlingval->option_id}}">{{$handlingval->option_value}}</option>
																@endforeach
															</select>
															<p class="error">{{ $errors->first('name') }}</p>
														</div>
														<div class="form-group has-feedback"  style="disply:none">
															<label for="inputEmail3" class="control-label">{{$returnpolicy->label}}<span class="req-field" ></span></label>
															<select class="form-control"  name="{{$returnpolicy->code}}" id="{{$returnpolicy->code}}">
																<option value="">Select Return Policy</option>
																@foreach($returnpolicy_value as $index=>$returnpolicyval)
																<option <?php if($returnpolicy_value_value->attribute_option_value == $returnpolicyval->option_value) {?> selected="selected" <?php } ?> value="{{$returnpolicyval->option_id}}">{{$returnpolicyval->option_value}}</option>
																@endforeach
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
															<div class="input-group">
																<!-- <span class="input-group-addon">$</span> -->
																<!-- <input type="text" class="form-control"  autocomplete="off"  name="charity_amount" id="charity_amount"> -->
																<select class="form-control" name="charity_amount" id="charity_amount"><option value="">Donate Amount</option>
																	<option <?php if($cos_data->donation_percent == '10'){ ?> selected="selected" <?php } ?> value="10">10%</option>
																	<option <?php if($cos_data->donation_percent == '20'){ ?> selected="selected" <?php } ?> value="20">20%</option>
																	<option <?php if($cos_data->donation_percent == '30'){ ?> selected="selected" <?php } ?> value="30">30%</option>
																	<option <?php if($cos_data->donation_percent == '1'){ ?> selected="selected" <?php } ?> value="1">1%</option>
																</select>
																<p class="cst3-textl2 d-amount"  id="dynamic_percent_amount"><i class="fa fa-usd" aria-hidden="true"></i>{{$cos_data->donation_amount}}</p>
																<input type="hidden" name="hidden_donation_amount" id="hidden_donation_amount" value="{{$cos_data->donation_amount}}">
																<p class="error">{{ $errors->first('charity_amount') }}</p>
																<span id="priceerror" style="color:red">
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
																	<input type="range" id="zoom-level" min="0" value="0" step="any" >
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
																	<input type="range" id="zoom-level2" min="0" value="0" step="any" >
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
																	<input type="range" id="zoom-level3" min="0" value="0" step="any" >
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
																<input type="range" id="zoom-level" class="slider" min="0" value="0" step="any" />
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
												  //console.log(removeValue);
												 $(this).parents("div#"+cur_val).remove();
												//$("#"+cur_val).parents().find("div.multi_div").remove();
												allRemove.push(remove_org_val);
												
												$.each( allRemove, function( key, value ) {
													MakeInput =  '<input type="hidden" name="multiple[]" value="'+value+'">';
												});
												$(".deletedImages").append(MakeInput);
											});
										</script>
										<script type="text/javascript">
											$("#heightft,#heightin,#weightlbs,#chestin,#waistlbs,#dimensionsdimensionsWidth,#dimensionsdimensionsLength,#dimensionsdimensionsLength").on("keyup", function(){
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
									@stop									
=======
	@extends('admin.app')

	{{-- Web site Title --}}
	@section('title') @parent

	@endsection

	{{-- page level styles --}}
	@section('header_styles')
	<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
	<link rel="stylesheet" href="{{ asset('/assets/admin/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/drop_uploader.css')}}">
	<script src="{{ asset('/assets/admin/js/fileinput.js') }}"></script>
	<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>


	<style>
	#customer_edit1 .form-group.has-feedback {
	clear: left;
	}
	</style>
	@stop

	{{-- Page content --}}
	@section('content')

	<?php
		if (isset($costumes_data) && !empty($costumes_data)) {
			$cos_data = $costumes_data;
			//echo "<pre>";print_r($descriptions);
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
	<a href="{{url('customers-list')}}">Costumes</a>
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

	<div class="alert alert-danger alert-dismissable" style="display:none" >
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	</div>

	<div class="alert alert-success alert-dismissable" id="sonay"  style="display:none" >
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<span id="successmessage"></span>

	</div>
	@if(Session::has('success'))
	<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	{{ Session::get('success') }}
	</div>
	@endif

	<!-- <form class="form-horizontal" ng-submit="save(userForm.$valid, data)" name="userForm" > -->
	<form id="customer_edit1" class="form-horizontal defult-form costume_creates_pages" name="userForm" action="{{route('costumes-insert')}}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="col-md-6">
	<h2 class="heading-agent">*Costume Information</h2>
	<div class="col-md-12">
	<div class="form-group has-feedback" >
	<label for="inputEmail3" class="control-label">Customer<span class="req-field" >*</span></label>
	<select class="form-control sony" data-live-search="true" id="customer_name" name="customer_name" >
	<option value="">Select Customer Name</option>
	<option <?php if ($cos_data->customer_name == 'admin m') { ?> selected="selected"<?php } ?> value="0">None</option>
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
	<div class="form-group has-feedback cosutme-fr" >
	<div class="form-group" >
	<label for="inputEmail3" class="control-label">Costume For<span class="req-field" >*</span></label>
	<br>
	<label class="radio-inline">
	<input type="radio" <?php if ($cos_data->cos_gender == 'male') { ?> checked='checked'	 <?php } ?>  name="gender" id="male"  value="male" >Male</label>

	<label class="radio-inline">
	<input type="radio" <?php if ($cos_data->cos_gender == 'female') { ?> checked='checked'	 <?php } ?>  name="gender" id="female"  value="female"  >Female</label>

	<label class="radio-inline">
	<input type="radio" <?php if ($cos_data->cos_gender == 'unisex') { ?> checked='checked'	 <?php } ?>  name="gender" id="unisex"  value="unisex" >Unisex</label>

	<label class="radio-inline">
	<input type="radio" <?php if ($cos_data->cos_gender == 'pet') { ?> checked='checked'	 <?php } ?>  name="gender" id="pet"  value="pet"  >Pet</label>

	</div>
	<span id="gendererror" style="color:red"></span>
	</div>
	<div class="form-group has-feedback" >
	<label for="inputEmail3" class="control-label">Catgeory<span class="req-field" >*</span></label>
	<select class="form-control sony" name="category" id="category">
	<option value="">Select Category</option>
	<?php
	$cos_data->modules_result = $categories['modules_result'];
	foreach ($cos_data->modules_result as $features_res) {
	//print_r($features_res);
	?>																						<optgroup label="<?php echo ucfirst($features_res['name']);?>">
	<?php foreach ($features_res['submodule_result'] as $feature_val_res) {
	?><option value="<?php echo $feature_val_res['subcategoryid'];?>"><?php echo ucfirst($feature_val_res['subcategoryname']);
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
	<label class="radio-inline"><input type="radio" <?php if ($cos_data->cos_condition == 'excellent') { ?> checked='checked'	 <?php } ?> name="costumecondition" id="excellent"   value="excellent"  > &nbsp;
	Excellent&nbsp;
	</label>
	<label class="radio-inline"><input type="radio" <?php if ($cos_data->cos_condition == 'brand_new') { ?> checked='checked'	 <?php } ?> name="costumecondition" id="brandnew"  value="brand_new"> &nbsp;
	Brand New&nbsp;
	</label>
	<label class="radio-inline"><input type="radio" <?php if ($cos_data->cos_condition == 'good') { ?> checked='checked'	 <?php } ?> name="costumecondition" id="good"  value="good">&nbsp;
	Good&nbsp;
	</label>
	<label class="radio-inline"><input type="radio" <?php if ($cos_data->cos_condition == 'like_new') { ?> checked='checked'	 <?php } ?> name="costumecondition" id="likenew"  value="like_new">&nbsp;
	Like New&nbsp;
	</label>
	</div>
	<span id="costumeconditionerror" style="color:red"></span>
	</div>
	<?php //echo "<pre>"; print_r($get_costume_attribute_options); ?>
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
	<input type="{{$bd_height->type}}" class="form-control"  value="{{$bd_height_value->attribute_option_value}}" name="{{$bd_height->code}}" id="{{$bd_height->code}}">
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
	<input type="{{$bd_height_in->type}}"  class="form-control" value="{{$bd_height_in_value->attribute_option_value}}"  name="{{$bd_height_in->code}}" id="{{$bd_height_in->code}}">
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
	<input type="{{$bd_weight->type}}" value="{{$bd_weight_value->attribute_option_value}}" class="form-control" name="{{$bd_weight->code}}" id="{{$bd_weight->code}}">
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
	<input type="{{$bd_chest->type}}" class="form-control" value="{{$bd_chest_value->attribute_option_value}}"  name="{{$bd_chest->code}}" id="{{$bd_chest->code}}">
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
	<input type="{{$bd_waist->type}}" class="form-control" value="{{$bd_waist_value->attribute_option_value}}" name="{{$bd_waist->code}}" id="{{$bd_waist->code}}">
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
	<option <?php if ($cos_data->cos_size == '1sz') { ?> selected='selected' <?php } ?> value="1sz">1SZ</option>
	<option <?php if ($cos_data->cos_size == 'xxs') { ?> selected='selected' <?php } ?> value="xxs">XXS</option>
	<option <?php if ($cos_data->cos_size == 'xs') { ?> selected='selected' <?php } ?> value="xs">XS</option>
	<option <?php if ($cos_data->cos_size == 's') { ?> selected='selected' <?php } ?> value="s">S</option>
	<option <?php if ($cos_data->cos_size == 'm') { ?> selected='selected' <?php } ?> value="m">M</option>
	<option <?php if ($cos_data->cos_size == 'l') { ?> selected='selected' <?php } ?> value="l">L</option>
	<option <?php if ($cos_data->cos_size == 'xl') { ?> selected='selected' <?php } ?> value="xl">XL</option>
	<option <?php if ($cos_data->cos_size == 'xxl') { ?> selected='selected' <?php } ?> value="xxl">XXL</option>
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
	@foreach($cosplay_one_value as $index=>$cosplayonevalues)
	<?php if ($cosplayonevalues->option_value == "yes") {?>
	<input type="{{$cosplay_one->type}}"  <?php if ($cosplay_one_value_value->attribute_option_value_id == $cosplayonevalues->option_id) { ?> checked="checked" <?php } ?> name="{{$cosplay_one->code}}" id="{{$cosplay_one->code}}"  value="{{$cosplayonevalues->option_id}}" required>&nbsp;
	{{$cosplayonevalues->option_value}}&nbsp;
	<?php } else {?>
	<input type="{{$cosplay_one->type}}" <?php if ($cosplay_one_value_value->attribute_option_value_id == $cosplayonevalues->option_id) { ?> checked="checked" <?php } ?>  name="{{$cosplay_one->code}}" id="{{$cosplay_one->code}}"  value="{{$cosplayonevalues->option_id}}" onclick="cosplay_yes(<?php echo $cosplayonevalues->option_id?>)"  required>&nbsp;
	{{$cosplayonevalues->option_value}}&nbsp;
	<?php }?>
	@endforeach
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
	@foreach($cosplay_two_value as $index=>$cosplaytwovalues)
	<input type="{{$cosplay_two->type}}"  <?php if ($cosplay_two_value_value->attribute_option_value_id == $cosplaytwovalues->option_id) { ?> checked="checked" <?php } ?> name="{{$cosplay_two->code}}" id="{{$cosplay_two->code}}"  value="{{$cosplaytwovalues->option_id}}" onclick="uniquefashion_yes({{$cosplaytwovalues->option_id}})"  required>&nbsp;
	{{$cosplaytwovalues->option_value}}&nbsp;

	@endforeach

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
	@foreach($cosplay_three_value as $index=>$cosplaythreevalues)
	<input type="{{$cosplay_three->type}}" <?php if ($cosplay_three_value_value->attribute_option_value_id == $cosplaythreevalues->option_id) {?> checked <?php }?>name="{{$cosplay_three->code}}" id="{{$cosplay_three->code}}" onclick="activity_yes({{$cosplaythreevalues->option_id}})"  value="{{$cosplaythreevalues->option_id}}"  required>&nbsp;
	{{$cosplaythreevalues->option_value}}&nbsp;

	@endforeach

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
	@foreach($cosplay_four_value as $index=>$cosplayfourvalues)
	<input type="{{$cosplay_four->type}}"  <?php if ($cosplay_four_value_value->attribute_option_value_id == $cosplayfourvalues->option_id) {?> checked <?php }?>name="{{$cosplay_four->code}}" id="{{$cosplay_four->code}}"  value="{{$cosplayfourvalues->option_id}}" onclick="make_costume_yes({{$cosplayfourvalues->option_id}})"  required>&nbsp;
	{{$cosplayfourvalues->option_value}}&nbsp;

	@endforeach
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
	@foreach($cosplay_five_value as $index=>$cosplayfivevalues)
	<input type="{{$cosplay_five->type}}"  <?php if ($cosplay_five_value_value->attribute_option_value_id == $cosplayfivevalues->option_id) {?> checked <?php }?>name="{{$cosplay_five->code}}" id="{{$cosplay_five->code}}"  value="{{$cosplayfivevalues->option_id}}"  required>&nbsp;
	{{$cosplayfivevalues->option_value}}&nbsp;

	@endforeach
	</div>
	</div>



	</div>
	<div class="form-group has-feedback" >


	<label for="inputEmail3" class="control-label">{{$description->label}}<span class="req-field" ></span></label>
	<div class="input-group">
	<textarea type="{{$description->type}}"  rows="6" cols="63" class="form-control"   name="{{$description->code}}" id="{{$description->code}}">{{$cos_data->cos_description}}</textarea>

	</div>

	<span id="costume-desc-error" style="color:red"></span>

	</div>
	<div class="form-group has-feedback" >


	<label for="inputEmail3" class="control-label">{{$funfacts->label}}<span class="req-field" ></span></label>
	<div class="input-group">
	<textarea type="{{$funfacts->type}}" rows="6" cols="63" class="form-control"   name="{{$funfacts->code}}" id="{{$funfacts->code}}">{{$funfacts_value_value->attribute_option_value}}</textarea>

	</div>

	<span id="funfact-error" style="color:red"></span>

	</div>
	<div class="form-group has-feedback" >


	<label for="inputEmail3" class="control-label">{{$faq->label}}<span class="req-field" ></span></label>
	<div class="input-group">
	<textarea type="{{$faq->type}}" rows="6" cols="63" class="form-control"   name="{{$faq->code}}" id="{{$faq->code}}">{{$faq_value_value->attribute_option_value}}</textarea>

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
	<input type="text" class="form-control" value="{{$cos_data->cos_price}}" aria-label="Amount (to the nearest dollar)" name="price" id="price" >

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
	<div class="row">
	<div class="col-md-5">
	<div class="form-group has-feedback" >
	<label for="inputEmail3" class="control-label">{{$shippingoptions->label}} <span class="req-field" ></span></label>
	<select class="form-control" name="{{$shippingoptions->code}}" id="{{$shippingoptions->code}}">
	<option value="">Select Shipping Options</option>
	<option <?php if($shippingoptions_value->attribute_option_value_id == $shippingoptions->option_id){ ?> selected="selected"<?php } ?> value="{{$shippingoptions->option_id}}">{{$shippingoptions->option_value}}</option>
	</select>
	<p class="error">{{ $errors->first('name') }}</p>
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

	{{$packageditems->label}}
	<span class="req-field" ></span></label>
	<select name="{{$packageditems->code}}" id="{{$packageditems->code}}" class="form-control">
	<option value="">Select Weight of Packaged Item </option>
	@foreach($packageditems_value as $packagevalues)
	<option <?php if($packageditems_value_value->attribute_option_value == $packagevalues->option_value){ ?> selected="selected" <?php } ?> value="{{$packagevalues->option_id}}">{{$packagevalues->option_value}}</option>
	@endforeach
	</select>
	<p class="error">{{ $errors->first('name') }}</p>
	</div>
	<label for="inputEmail3" class="control-label">

	{{$dimensions->label}}
	<span class="req-field" ></span></label>
	<div class="form-group has-feedback dmns_rigts" >

	@foreach($dimensions_values as $index=>$dimensionval)
	<?php
	$dimension_height = $dimensionval->option_value;

	$heightattributes   = explode('-', $dimension_height);
	$dimensionattribute = ucfirst($heightattributes[0]);
	$dimensionvalue     = $heightattributes[1];

	?>

	<div class="col-md-4">
	<div class="input-group">

	<input type="{{$dimensions->type}}" value="@if(isset($dimensionval->attribute_option_value)){{$dimensionval->attribute_option_value}}@endif" class="form-control" placeholder="<?php echo $dimensionattribute;?>" name="{{$dimensions->code}}<?php echo $dimensionattribute;?>" id="{{$dimensions->code}}">
	<span class="input-group-addon" id="basic-addon2"><?php echo $dimensionvalue;?></span>
	</div>
	</div>

	@endforeach

	</div>
	<div class="form-group has-feedback" >
	<label for="inputEmail3" class="control-label">{{$type->label}}<span class="req-field" ></span></label>
	<select class="form-control"  name="{{$type->code}}" id="{{$type->code}}">
	<option value="">Select Type</option>
	@foreach($type_value as $index=>$typeval)
	<option <?php if($type_value_value->attribute_option_value == $typeval->option_value) {?> selected="selected" <?php } ?> value="{{$typeval->option_id}}">{{$typeval->option_value}}</option>
	@endforeach
	</select>
	<p class="error">{{ $errors->first('name') }}</p>
	</div>
	<div class="form-group has-feedback" >
	<label for="inputEmail3" class="control-label">{{$service->label}}<span class="req-field" ></span></label>
	<select class="form-control"  name="{{$service->code}}" id="{{$service->code}}">
	<option value="">Select Service</option>
	@foreach($service_value as $index=>$serviceval)
	<option <?php if($service_value_value->attribute_option_value == $serviceval->option_value) {?> selected="selected" <?php } ?> value="{{$serviceval->option_id}}">{{$serviceval->option_value}}</option>
	@endforeach
	</select>
	<p class="error">{{ $errors->first('name') }}</p>
	</div>
	</div>
	</div>
	<div class="col-md-6">
	<h2 class="heading-agent">Preferences</h2>
	<div class="col-md-12">
	<label for="inputEmail3" class="control-label">Item Location<span class="req-field" >*</span></label>
	<div class="form-group has-feedback" >

	<div id="locationField">
	<input type="text" class="form-control" value="{{$cos_data->item_location}}" placeholder="Enter Location"  name="location" id="autocomplete" onFocus="geolocate()" >
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
	<label for="inputEmail3" class="control-label">{{$handling->label}}<span class="req-field" ></span></label>
	<select class="form-control"    name="{{$handling->code}}" id="{{$handling->code}}">
	<option value="">Select Handling Time</option>
	@foreach($handling_value as $index=>$handlingval)
	<option <?php if($handling_value_value->attribute_option_value == $handlingval->option_value) {?> selected="selected" <?php } ?> value="{{$handlingval->option_id}}">{{$handlingval->option_value}}</option>
	@endforeach
	</select>
	<p class="error">{{ $errors->first('name') }}</p>
	</div>
	<div class="form-group has-feedback"  style="disply:none">
	<label for="inputEmail3" class="control-label">{{$returnpolicy->label}}<span class="req-field" ></span></label>
	<select class="form-control"  name="{{$returnpolicy->code}}" id="{{$returnpolicy->code}}">
	<option value="">Select Return Policy</option>
	@foreach($returnpolicy_value as $index=>$returnpolicyval)
	<option <?php if($returnpolicy_value_value->attribute_option_value == $returnpolicyval->option_value) {?> selected="selected" <?php } ?> value="{{$returnpolicyval->option_id}}">{{$returnpolicyval->option_value}}</option>
	@endforeach
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
	<div class="input-group">
	<!-- <span class="input-group-addon">$</span> -->
	<!-- <input type="text" class="form-control"  autocomplete="off"  name="charity_amount" id="charity_amount"> -->
	<select class="form-control" name="charity_amount" id="charity_amount"><option value="">Donate Amount</option>
		<option <?php if($cos_data->donation_amount == '10'){ ?> selected="selected" <?php } ?> value="10">10%</option>
		<option <?php if($cos_data->donation_amount == '20'){ ?> selected="selected" <?php } ?> value="20">20%</option>
		<option <?php if($cos_data->donation_amount == '30'){ ?> selected="selected" <?php } ?> value="30">30%</option></select>
	<p class="cst3-textl2 d-amount"  id="dynamic_percent_amount"><i class="fa fa-usd" aria-hidden="true"></i>0.00</p>
	<p class="error">{{ $errors->first('charity_amount') }}</p>

	<span id="priceerror" style="color:red">
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


	<?php foreach ($costume_images as  $images) { ?>
		<img width="180px;" height="298px;" src="{{ asset('costumers_images/Original/'.$images->image) }}">
	<?php } ?>
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
	@stop
	{{-- page level scripts --}}
	@section('footer_scripts')
	<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
	<script src="{{ asset('/assets/admin/js/pages/customers.js') }}"></script>
	<script type="text/javascript" src="{{asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')}}"></script>

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
	/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
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



	@stop
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

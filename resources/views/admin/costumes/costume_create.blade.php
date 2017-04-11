@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/select2.min.css')}}">
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
	<h1>Custome</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
		</li>
		<li>
			<a href="{{url('customers-list')}}">Costumes Lists</a>
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
					<!-- <form class="form-horizontal" ng-submit="save(userForm.$valid, data)" name="userForm" > --> 
					<form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="create_costume" id="create_costume" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
						<div class="col-md-6">
							<h2 class="heading-agent">Custome Information</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Customer<span class="req-field" >*</span></label>
                                        <select class="form-control sony" data-live-search="true" id="customer_name" name="customer_name" >
										<option value="">None</option>
										@foreach($customers as $index=>$customer)
                                         <option data-tokens="{{$customer->username}}">{{$customer->username}}</option>
                                        @endforeach
                                       </select>
                                    <p class="error">{{ $errors->first('type') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Costume Name<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">Costume For<span class="req-field" >*</span></label>
											<br><br>
											<input type="radio"  name="vacationstatus" id="vacationstatus"  value="male" id="email" required>&nbsp;Male&nbsp;
											<input type="radio"   name="vacationstatus" id="vacationstatus"  value="female" id="email" required>&nbsp;Female&nbsp;
											<input type="radio"   name="vacationstatus" id="vacationstatus"  value="unisex" id="email" required>&nbsp;Unisex&nbsp;
											<input type="radio"   name="vacationstatus" id="vacationstatus"  value="pet" id="email" required>&nbsp;Pet&nbsp;
										</div>
						       </div>
							   <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Catgeory<span class="req-field" >*</span></label>
                                        <select class="form-control sony">
										<option value="">Select Category</option>
										<?php
		$features_req=$categories['modules_result'];
		foreach($features_req as $features_res)
		{
			//print_r($features_res);
		?>
			    <optgroup label="<?php echo ucfirst($features_res['name']);?>">
				<?php  foreach($features_res['submodule_result'] as $feature_val_res){ ?>
                        <option value="<?php echo $feature_val_res['subcategoryid'];?>"><?php echo ucfirst($feature_val_res['subcategoryname']);?></option>
					</optgroup>
		<?php } } ?>
 </select>
                                    <p class="error">{{ $errors->first('type') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">Condition <span class="req-field" >*</span></label>
											<br><br>
											<input type="radio"  name="costumecondition" id="costumecondition"  value="excellent" > &nbsp;Excellent&nbsp;
											<input type="radio"  name="costumecondition" id="costumecondition"  value="brand_new"> &nbsp;Brand New&nbsp;
											<input type="radio"  name="costumecondition" id="costumecondition"  value="good">&nbsp;Good&nbsp;
											<input type="radio"  name="costumecondition" id="costumecondition"  value="like_new">&nbsp;Like New&nbsp;
										</div>
						       </div>
							   <h4>Body Dimensions</h4></hr>

								<div class="form-group has-feedback" >
								<?php
									$height=$bd_height->label;
									$heightattributes=explode('-',$height);
									$attribute=ucfirst($heightattributes[0]);
									$attributevalue=$heightattributes[1];
									?>
									<label for="inputEmail3" class="control-label"><?php echo $attribute;?><span class="req-field" >*</span></label>
									
									<div class="input-group">
										<input type="{{$bd_height->type}}" class="form-control"   name="{{$bd_height->code}}" id="$bd_height->code">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue; ?></span>
									</div>
									<p class="error">{{ $errors->first('email') }}</p> 
									
								</div>
								<div class="form-group has-feedback" >
								<?php
									$height=$bd_height_in->label;
									$heightattributes=explode('-',$height);
									$attribute=ucfirst($heightattributes[0]);
									$attributevalue=$heightattributes[1];
									?>
							     <label for="inputEmail3" class="control-label">Height<span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="{{$bd_height_in->type}}"  class="form-control"  name="{{$bd_height_in->code}}" id="{{$bd_height_in->code}}">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue; ?></span>
									</div>
									<p class="error">{{ $errors->first('email') }}</p>
									
								</div>
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">weight<span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Email"  name="email" id="email">
										<span class="input-group-addon" id="basic-addon2">ibs</span>
									</div>
									<p class="error">{{ $errors->first('email') }}</p> 
									
								</div>
								
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Chest<span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Email"  name="email" id="email">
										<span class="input-group-addon" id="basic-addon2">in</span>
									</div>
									<p class="error">{{ $errors->first('email') }}</p> 
								</div>
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Waist<span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="text"  class="form-control" placeholder="Email" aria-describedby="basic-addon2" name="email" id="email">
										 <span class="input-group-addon" id="basic-addon2">ibs</span>
									</div>
									<p class="error">{{ $errors->first('email') }}</p> 
								</div>
								
							   
								
							</div> 
						</div>
						
						
						<div class="col-md-6">
							<h2 class="heading-agent">Costume FAQ</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">

Is the costume used for cosplay?
<span class="req-field" >*</span></label>
											<br><br>
											<input type="radio"  name="vacationstatus" id="vacationstatus"  value="male" id="email" required>&nbsp;Yes&nbsp;
											<input type="radio"   name="vacationstatus" id="vacationstatus"  value="female" id="email" required>&nbsp;No&nbsp;
											
										</div>
						       </div>
							    <div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">



Is the costume unique fashion?

<span class="req-field" >*</span></label>
											<br><br>
											<input type="radio"  name="vacationstatus" id="vacationstatus"  value="male" id="email" required>&nbsp;Yes&nbsp;
											<input type="radio"   name="vacationstatus" id="vacationstatus"  value="female" id="email" required>&nbsp;No&nbsp;
											
										</div>
						       </div>
								<div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">



Is the costume used for an activity?

<span class="req-field" >*</span></label>
											<br><br>
											<input type="radio"  name="vacationstatus" id="vacationstatus"  value="male" id="email" required>&nbsp;Yes&nbsp;
											<input type="radio"   name="vacationstatus" id="vacationstatus"  value="female" id="email" required>&nbsp;No&nbsp;
											
										</div>
						       </div>
							   <div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">





Did the user  make the costume?


<span class="req-field" >*</span></label>
											<br><br>
											<input type="radio"  name="vacationstatus" id="vacationstatus"  value="male" id="email" required>&nbsp;Yes&nbsp;
											<input type="radio"   name="vacationstatus" id="vacationstatus"  value="female" id="email" required>&nbsp;No&nbsp;
											
										</div>
						       </div>
							   <div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">





Is the costume fit for Film Quality?


<span class="req-field" >*</span></label>
											<br><br>
											<input type="radio"  name="vacationstatus" id="vacationstatus"  value="male" id="email" required>&nbsp;Yes&nbsp;
											<input type="radio"   name="vacationstatus" id="vacationstatus"  value="female" id="email" required>&nbsp;No&nbsp;
											
										</div>
						       </div>
							   
							   
							  
							</div> 
							<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Costume Description<span class="req-field" >*</span></label>
									<div class="input-group">
										<textarea type="text" rows="6" cols="63" class="form-control" placeholder="Email"  name="email" id="email"></textarea>
										
									</div>
									<p class="error">{{ $errors->first('email') }}</p> 
								</div>
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">FUn Facts<span class="req-field" >*</span></label>
									<div class="input-group">
										<textarea type="text" rows="6" cols="63" class="form-control" placeholder="Email"  name="email" id="email"></textarea>
										
									</div>
									<p class="error">{{ $errors->first('email') }}</p> 
								</div>
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">FAQ<span class="req-field" >*</span></label>
									<div class="input-group">
										<textarea type="text" rows="6" cols="63" class="form-control" placeholder="Email"  name="email" id="email"></textarea>
										
									</div>
									<p class="error">{{ $errors->first('email') }}</p> 
								</div>
						</div>
					
						<div class="col-md-6">
							<h2 class="heading-agent">Pricing</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Costume Name<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Qunaity<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Shipping Options<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
							</div> 
						</div>
						<div class="col-md-6">
							<h2 class="heading-agent">Package Information</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">

Weight of the packaged item
<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">

Dimensions
<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Type<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Service<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
							</div> 
						</div>
						<div class="col-md-6">
							<h2 class="heading-agent">Preferences</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">

Weight of the packaged item
<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">

Dimensions
<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Type<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Service<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
							</div> 
						</div>
						<div class="col-md-6">
							<h2 class="heading-agent">Donation Info</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">

Weight of the packaged item
<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">

Dimensions
<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Type<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Service<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
							</div> 
						</div>
						
						 
					</div> 
					<div class="box-footer">
						<div class="pull-right">
							<a href="/customers-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
							<button type="submit" id="submit" name="submit"  class="btn btn-info pull-right">Submit</button>
						</div>
					</div>
				</form>
			</div>
			</div>
		</div>
	</section>
	@stop
	{{-- page level scripts --}}
	@section('footer_scripts')
	<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('/assets/admin/js/select2.full.min.js') }}"></script>
	<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
	<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
	$(".sony").select2();
	}); 
	</script>
	<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<script type="text/javascript">
	
	$('#create_costume').on('submit',function(a){
		a.preventDefault();
		str=true;
		$('#costume_name').css('border','');
		$('#costumename_error').html('');
		var costume_name=$('#costume_name').val();
	});
	</script>
	
	@stop

@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/select2.min.css')}}">

<script src="{{ asset('/assets/admin/js/fileinput.js') }}"></script>
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>

    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

     <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

<style>
#create_costume .has-feedback {

   position: relative;

   clear: left;

}
body
{
 width:100%;
 margin:0 auto;
 padding:0px;
 font-family:helvetica;
 background-color:#084B8A;
}
#wrapper
{
 text-align:center;
 margin:0 auto;
 padding:0px;
 width:995px;
}
#drop-area
{
 margin-top:20px;
 margin-left:220px;
 width:550px;
 height:200px;
 background-color:white;
 border:3px dashed grey;
}
.drop-text
{
 margin-top:70px;
 color:grey;
 font-size:25px;
 font-weight:bold;
}
#drop-area img
{
 max-width:200px;
}
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
  
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <style>
      #locationField, #controls {
        position: relative;
        width: 100%;
      }
      #autocomplete {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
      }
      .label {
        text-align: right;
        font-weight: bold;
        width: 100px;
        color: #303030;
      }
      #address {
        border: 1px solid #000090;
        background-color: #f0f0ff;
        width: 480px;
        padding-right: 2px;
      }
      #address td {
        font-size: 10pt;
      }
      .field {
        width: 99%;
      }
      .slimField {
        width: 80px;
      }
      .wideField {
        width: 200px;
      }
      #locationField {
        height: 20px;
        margin-bottom: 2px;
      }
   

#formdiv {
  text-align: center;
}
#file {
  color: green;
  padding: 5px;
  border: 1px dashed #123456;
  background-color: #f9ffe5;
}
#img {
  width: 17px;
  border: none;
  height: 17px;
  margin-left: -20px;
  margin-bottom: 191px;
}
.upload {
  width: 100%;
  height: 30px;
}
.abcd {
height: 120px;
  width:120px;
}
.abcd img {
  height:120px;
  width:120px;
  padding: 5px;
  border: 1px solid rgb(232, 222, 189);
}
.delete {position: absolute;
    font-size: 12px;
    background:#655f5d;
    color: #fff;
    padding: 3px;
    right: -9px;
    bottom: 6px;cursor:pointer;
} .delete:hover{background:#f30;color:#fff;}
.fileupload-new .btn-file {
   margin: 10px 0 0 20px;
}

#customer_edit1 .form-group.has-feedback {
    clear: both;
}
      </style>
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
					
		            <div class="alert alert-danger alert-dismissable" style="display:none" >
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					</div>
		           
					<div class="alert alert-success alert-dismissable" id="sonay"  style="display:none" >
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<span id="successmessage"></span>
						
					</div>
					
					<!-- <form class="form-horizontal" ng-submit="save(userForm.$valid, data)" name="userForm" > --> 
					<form id="customer_edit1" class="form-horizontal defult-form" name="userForm" action="{{route('costumes-insert')}}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
					
						<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
						<div class="col-md-6">
							<h2 class="heading-agent">Custome Information</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Customer<span class="req-field" >*</span></label>
                                        <select class="form-control sony" data-live-search="true" id="customer_name" name="customer_name" >
										<option value="0">None</option>
										@foreach($customers as $index=>$customer)
                                         <option value="{{$customer->id}}">{{$customer->username}}</option>
                                        @endforeach
                                       </select>
                                  <span id="customername_error" style="color:red"></span>
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Costume Name<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Costume name"  name="costume_name" id="costume_name">
                                   <span id="costumename_error" style="color:red"></span>
                                </div>
								<div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">Costume For<span class="req-field" >*</span></label>
											<br><br>
											<input type="radio"   name="gender" id="male"  value="male" checked >&nbsp;Male&nbsp;
											<input type="radio"   name="gender" id="female"  value="female"  >&nbsp;Female&nbsp;
											<input type="radio"   name="gender" id="unisex"  value="unisex" >&nbsp;Unisex&nbsp;
											<input type="radio"   name="gender" id="pet"  value="pet"  >&nbsp;Pet&nbsp;
										</div>
										<span id="gendererror" style="color:red"></span>
						       </div>
							   <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Catgeory<span class="req-field" >*</span></label>
                                        <select class="form-control sony" name="category" id="category">
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
                                   <span id="categoryerror" style="color:red"></span>
                                </div>
								<div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">Condition <span class="req-field" >*</span></label>
											<br><br>
											<input type="radio"  name="costumecondition" id="excellent"   value="excellent"  checked> &nbsp;Excellent&nbsp;
											<input type="radio"  name="costumecondition" id="brandnew"  value="brand_new"> &nbsp;Brand New&nbsp;
											<input type="radio"  name="costumecondition" id="good"  value="good">&nbsp;Good&nbsp;
											<input type="radio"  name="costumecondition" id="likenew"  value="like_new">&nbsp;Like New&nbsp;
										</div>
										<span id="costumeconditionerror" style="color:red"></span>
						       </div>
							   <h4>Body Dimensions</h4></hr>

								<div class="form-group has-feedback" >
								<?php
									$height=$bd_height->label;
									$heightattributes=explode('-',$height);
									$attribute=ucfirst($heightattributes[0]);
									$attributevalue=$heightattributes[1];
									?>
									<label for="inputEmail3" class="control-label"><?php echo $attribute;?><span class="req-field">*</span></label>
									
									<div class="input-group">
										<input type="{{$bd_height->type}}" class="form-control"   name="{{$bd_height->code}}" id="{{$bd_height->code}}">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue; ?></span>
									</div>
									<span id="heightfterror" style="color:red"></span>
									
								</div>
								<div class="form-group has-feedback" >
								<?php
									$height1=$bd_height_in->label;
									$heightattributes1=explode('-',$height1);
									$attribute1=ucfirst($heightattributes1[0]);
									$attributevalue1=$heightattributes1[1];
									?>
							     <label for="inputEmail3" class="control-label">Height<span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="{{$bd_height_in->type}}"  class="form-control"  name="{{$bd_height_in->code}}" id="{{$bd_height_in->code}}">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue1; ?></span>
									</div>
									<span id="heightinerror" style="color:red"></span>
									
								</div>
								<div class="form-group has-feedback" >
								<?php
									$height2=$bd_weight->label;
									$heightattributes2=explode('-',$height2);
									$attribute2=ucfirst($heightattributes2[0]);
									$attributevalue2=$heightattributes2[1];
									?>
									<label for="inputEmail3" class="control-label"><?php echo $attribute2;?><span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="{{$bd_weight->type}}" class="form-control" name="{{$bd_weight->code}}" id="{{$bd_weight->code}}">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue2; ?></span>
									</div>
									<span id="weightlbserror" style="color:red"></span>
									
								</div>
								
								<div class="form-group has-feedback" >
								<?php
									$height3=$bd_chest->label;
									$heightattributes3=explode('-',$height3);
									$attribute3=ucfirst($heightattributes3[0]);
									$attributevalue3=$heightattributes3[1];
									?>
									<label for="inputEmail3" class="control-label"><?php echo $attribute3;?><span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="{{$bd_chest->type}}" class="form-control"  name="{{$bd_chest->code}}" id="{{$bd_chest->code}}">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue3; ?></span>
									</div>
									<span id="chestinerror" style="color:red"></span>
								</div>
								<div class="form-group has-feedback" >
								<?php
									$height=$bd_waist->label;
									$heightattributes=explode('-',$height);
									$attribute=ucfirst($heightattributes[0]);
									$attributevalue=$heightattributes[1];
									?>
									<label for="inputEmail3" class="control-label"><?php echo $attribute;?><span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="{{$bd_waist->type}}" class="form-control" name="{{$bd_waist->code}}" id="{{$bd_waist->code}}">
										<span class="input-group-addon" id="basic-addon2"><?php echo $attributevalue; ?></span>
									</div>
									<span id="waistlbserror" style="color:red"></span>
								</div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Size<span class="req-field" >*</span></label>
                                        <select name="size" id="size" class="form-control">
										<option value="">Select Size</option>
										<option value="1sz">1sz</option>
										<option value="xxs">xxs</option>
										<option value="xs">xs</option>
										<option value="xs">s</option>
										<option value="m">m</option>
										<option value="l">l</option>
										<option value="xl">xl</option>
										<option value="xxl">xxl</option>
										</select>
                                  <span id="size_error" style="color:red"></span>
                                </div>
								
								
							   
								
							</div> 
						</div>
						
						
						<div class="col-md-6">
							<h2 class="heading-agent">Costume FAQ</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">
										
											
											
											

											<?php echo $cosplay_one->label;?>
<span class="req-field" ></span></label>
											<br><br>
											@foreach($cosplay_one_value as $index=>$cosplayonevalues)
											<?php if($cosplayonevalues->option_value=="yes") { ?>
											<input type="{{$cosplay_one->type}}"  checked name="{{$cosplay_one->code}}" id="{{$cosplay_one->code}}"  value="{{$cosplayonevalues->option_id}}"  required>&nbsp;{{$cosplayonevalues->option_value}}&nbsp;
											<?php } else { ?>
											<input type="{{$cosplay_one->type}}"   name="{{$cosplay_one->code}}" id="{{$cosplay_one->code}}"  value="{{$cosplayonevalues->option_id}}"  required>&nbsp;{{$cosplayonevalues->option_value}}&nbsp;
											<?php } ?>
											@endforeach
										</div>
						       </div>
							    <div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">
										
											
											
											

											<?php echo $cosplay_two->label;?>
<span class="req-field" ></span></label>
											<br><br>
											@foreach($cosplay_two_value as $index=>$cosplaytwovalues)
											<input type="{{$cosplay_two->type}}"  <?php if($cosplaytwovalues->option_value=="yes") { ?> checked <?php } ?>  name="{{$cosplay_two->code}}" id="{{$cosplay_two->code}}"  value="{{$cosplaytwovalues->option_id}}"  required>&nbsp;{{$cosplaytwovalues->option_value}}&nbsp;
											
											@endforeach
										</div>
						       </div>
								 <div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">
										
											
											
											

											<?php echo $cosplay_three->label;?>
<span class="req-field" ></span></label>
											<br><br>
											@foreach($cosplay_three_value as $index=>$cosplaythreevalues)
											<input type="{{$cosplay_three->type}}" <?php if($cosplaythreevalues->option_value=="yes") { ?> checked <?php } ?> name="{{$cosplay_three->code}}" id="{{$cosplay_three->code}}"  value="{{$cosplaythreevalues->option_id}}"  required>&nbsp;{{$cosplaythreevalues->option_value}}&nbsp;
											
											@endforeach
										</div>
						       </div>
							   <div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">
										
											
											
											

											<?php echo $cosplay_four->label;?>
<span class="req-field" ></span></label>
											<br><br>
											@foreach($cosplay_four_value as $index=>$cosplayfourvalues)
											<input type="{{$cosplay_four->type}}"  <?php if($cosplayfourvalues->option_value=="yes") { ?> checked <?php } ?> name="{{$cosplay_four->code}}" id="{{$cosplay_four->code}}"  value="{{$cosplayfourvalues->option_id}}"  required>&nbsp;{{$cosplayfourvalues->option_value}}&nbsp;
											
											@endforeach
										</div>
						       </div>
							   <div class="form-group has-feedback" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">
										
											
											
											

											<?php echo $cosplay_five->label;?>
<span class="req-field" ></span></label>
											<br><br>
											@foreach($cosplay_five_value as $index=>$cosplayfivevalues)
											<input type="{{$cosplay_five->type}}"  <?php if($cosplayfivevalues->option_value=="yes") { ?> checked <?php } ?>  name="{{$cosplay_five->code}}" id="{{$cosplay_five->code}}"  value="{{$cosplayfivevalues->option_id}}"  required>&nbsp;{{$cosplayfivevalues->option_value}}&nbsp;
											
											@endforeach
										</div>
						       </div>
							   
							   
							  
							</div> 
							<div class="form-group has-feedback" >
							
							
									<label for="inputEmail3" class="control-label">{{$description->label}}<span class="req-field" ></span></label>
									<div class="input-group">
										<textarea type="{{$description->type}}" rows="6" cols="63" class="form-control"   name="{{$description->code}}" id="{{$description->code}}"></textarea>
										
									</div>
									
									<span id="costume-desc-error" style="color:red"></span>
									
								</div>
								<div class="form-group has-feedback" >
							
							
									<label for="inputEmail3" class="control-label">{{$funfacts->label}}<span class="req-field" ></span></label>
									<div class="input-group">
										<textarea type="{{$funfacts->type}}" rows="6" cols="63" class="form-control"   name="{{$funfacts->code}}" id="{{$funfacts->code}}"></textarea>
										
									</div>
									
									<span id="funfact-error" style="color:red"></span>
									
								</div>
								<div class="form-group has-feedback" >
							
							
									<label for="inputEmail3" class="control-label">{{$faq->label}}<span class="req-field" ></span></label>
									<div class="input-group">
										<textarea type="{{$faq->type}}" rows="6" cols="63" class="form-control"   name="{{$faq->code}}" id="{{$faq->code}}"></textarea>
										
									</div>
									
									<span id="faq-error" style="color:red"></span>
									
								</div>
							
						</div>
					
						<div class="col-md-6">
							<h2 class="heading-agent">Pricing</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Price<span class="req-field" ></span></label>
                                       <div class="input-group">
									   <span class="input-group-addon">$</span>
  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="price" id="price" >
  
                                    <span id="priceerror" style="color:red">
									</div>
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Qunaity<span class="req-field" ></span></label>
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
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">{{$shippingoptions->label}} <span class="req-field" ></span></label>
                                        <select class="form-control" name="{{$shippingoptions->code}}" id="{{$shippingoptions->code}}">
										<option value="">Select Shipping Options</option>
										<option value="{{$shippingoptions->option_id}}">{{$shippingoptions->option_value}}</option>
										</select>
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
							</div> 
						</div>
						<div class="col-md-6">
							<h2 class="heading-agent">Package Information</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">

									{{$packageditems->label}}
<span class="req-field" ></span></label>
                                        <select name="{{$packageditems->code}}" id="{{$packageditems->code}}" class="form-control">
										<option value="">Select Weight of Packaged Item </option>
										@foreach($packageditems_value as $packagevalues)
										<option value="{{$packagevalues->option_id}}">{{$packagevalues->option_value}}</option>
										@endforeach
										</select>
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								 <label for="inputEmail3" class="control-label">

									{{$dimensions->label}}
<span class="req-field" ></span></label>
								<div class="form-group has-feedback" >
                                   
		@foreach($dimensions_values as $index=>$dimensionval)
		<?php
									$dimension_height=$dimensionval->option_value;

									$heightattributes=explode('-',$dimension_height);
									$dimensionattribute=ucfirst($heightattributes[0]);
									$dimensionvalue=$heightattributes[1];
		
		?>
                                        
										<div class="col-md-4">
								       	<div class="input-group">
										
										<input type="{{$dimensions->type}}" class="form-control" placeholder="<?php echo $dimensionattribute; ?>" name="{{$dimensions->code}}" id="{{$dimensions->code}}">
										<span class="input-group-addon" id="basic-addon2"><?php echo $dimensionvalue; ?></span>
										</div>
									</div>
							
                          @endforeach
						
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">{{$type->label}}<span class="req-field" ></span></label>
                                        <select class="form-control"  name="{{$type->code}}" id="{{$type->code}}">
										<option value="">Select Type</option>
										@foreach($type_value as $index=>$typeval)
										<option value="{{$typeval->option_id}}">{{$typeval->option_value}}</option>
										@endforeach
										</select>
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">{{$service->label}}<span class="req-field" ></span></label>
                                        <select class="form-control"  name="{{$service->code}}" id="{{$service->code}}">
										<option value="">Select Service</option>
										@foreach($service_value as $index=>$serviceval)
										<option value="{{$serviceval->option_id}}">{{$serviceval->option_value}}</option>
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
                                        <input type="text" class="form-control" placeholder="Enter Location"  name="location" id="autocomplete" onFocus="geolocate()" >
                                   </div>
								   <span id="costumename_error" style="color:red"></span>
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
										<option value="{{$handlingval->option_id}}">{{$handlingval->option_value}}</option>
										@endforeach
										</select>
                                    <p class="error">{{ $errors->first('name') }}</p> 
                                </div>
								<div class="form-group has-feedback"  style="disply:none">
                                    <label for="inputEmail3" class="control-label">{{$returnpolicy->label}}<span class="req-field" ></span></label>
                                        <select class="form-control"  name="{{$returnpolicy->code}}" id="{{$returnpolicy->code}}">
										<option value="">Select Return Policy</option>
										@foreach($returnpolicy_value as $index=>$returnpolicyval)
										<option value="{{$returnpolicyval->option_id}}">{{$returnpolicyval->option_value}}</option>
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
                                    <label for="inputEmail3" class="control-label">Donation To Charity<span class="req-field" ></span></label>
                                       <div class="input-group">
									   <span class="input-group-addon">$</span>
  <input type="text" class="form-control"  autocomplete="off"  name="charity_amount" id="charity_amount">
                                    <p class="error">{{ $errors->first('charity_amount') }}</p> 
  
                                    <span id="priceerror" style="color:red">
									</div>
                                </div>
								
								<div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">{{$returnpolicy->label}}<span class="req-field" ></span></label>
                                        <select class="form-control"  autocomplete="off" name="charity_name" id="charity_name">
										<option value="">Select Charity Name</option>
										@foreach($charities as $index=>$charity)
										<option value="{{$charity->id}}">{{$charity->name}}</option>
										@endforeach
										</select>
                                    <p class="error">{{ $errors->first('charity_name') }}</p> 
                               </div>
							   <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">{{$returnpolicy->label}}<span class="req-field" ></span></label>
                                        <select class="form-control"  autocomplete="off" name="charity_name" id="charity_name">
										<option value="">Select Charity Name</option>
										@foreach($charities as $index=>$charity)
										<option value="{{$charity->id}}">{{$charity->name}}</option>
										@endforeach
										</select>
                                    <p class="error">{{ $errors->first('charity_name') }}</p> 
                               </div>
								
							</div> 
						</div>
						<div class="col-md-12">
						<h2 class="heading-agent">Upload Images</h2>
						<div class="col-md-6">
							<h2 class="box-title col-md-12 heading-agent pro-imgs">Front View</h2>
							<div class="col-md-12">
							
								<div class="form-group"> 
									<label for="inputEmail3" class="control-label image-label">Upload</label>
									<div class="fileupload fileupload-new" data-provides="fileupload"> 
										<img src="/img/default.png" class="img-pview img-responsive" id="img-chan" name="img-chan" >
										<span class="remove_pic">
											<i class="fa fa-times-circle" aria-hidden="true"></i>
										</span>
										<span class="btn btn-default btn-file">
											<span class="fileupload-new" style="float:right">Upload Photo</span>
											<span class="fileupload-exists"></span>     
											<input id="profile_logo" name="avatar" type="file" placeholder="Profile Image" class="form-control">
										</span>
										<p class="noteices-text">Note: The file should not exceed above 3MB and allowed .JPG, .JPEG, .PNG formats only.</p>
										<span class="fileupload-preview"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
									</div> 
									<p class="error">{{ $errors->first('avatar') }}</p> 
								</div> 					
							</div>   
					</div> 
						<div class="col-md-6">
							
							<div class="col-md-6">
							<h2 class="box-title col-md-12 heading-agent pro-imgs">Back View</h2>
							<div class="col-md-12">
							
								<div class="form-group"> 
									<label for="inputEmail3" class="control-label image-label">Upload</label>
									<div class="fileupload fileupload-new" data-provides="fileupload"> 
										<img src="/img/default.png" class="img-pview img-responsive" id="img-chan1" name="img-chan1" >
										<span class="remove_pic1">
											<i class="fa fa-times-circle" aria-hidden="true"></i>
										</span>
										<span class="btn btn-default btn-file">
											<span class="fileupload-new" style="float:right">Upload Photo</span>
											<span class="fileupload-exists"></span>     
											<input id="profile_logo1" name="avatar1" type="file" placeholder="Profile Image" class="form-control">
										</span>
										<p class="noteices-text">Note: The file should not exceed above 3MB and allowed .JPG, .JPEG, .PNG formats only.</p>
										<span class="fileupload-preview"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
									</div> 
									<p class="error">{{ $errors->first('avatar') }}</p> 
								</div> 					
							</div> 
						</div>
						</div>
						</div>
						<div class="col-md-12">
						<h2 class="heading-agent">Multi Image Uploading</h2>
						<div class="col-md-6">
							<h2 class="box-title col-md-12 heading-agent pro-imgs">Details/Accessories</h2>
							<div class="col-md-12">
							
										
								
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

	
	<script type="text/javascript">
	$(document).ready(function () {
	$(".sony").select2();
	}); 
	
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
	          Dropzone.options.imageUpload = {

            maxFilesize         :       1,

            acceptedFiles: ".jpeg,.jpg,.png,.gif"

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
	<!--<script type="text/javascript">
	$('#create_costume').on('submit',function(ps){
		 ps.preventDefault();
		 str=true;
		 alert();
		$('#customer_name,#costume_name,#gender,#category,#costume-desc,#size,#price,#quantity,#heightft,#heightin,#weightlbs,#chestin,#waistlbs').css('border','');
		$('#costumename_error,#gendererror,#categoryerror,#sizeerror,#costume-desc-error,#priceerror,#quantityerror,#heightfterror,#heightinerror,#weightlbserror,#chestinerror,#waistlbserror').html('');
		var customer_name=$('#customer_name').val();
		var costume_name=$('#costume_name').val();
		var category=$('#category').val();
		var costume_desc=$('#costume-desc').val();
		var price=$('#price').val();
		var quantity=$('#quantity').val();
		var heightft=$('#heightft').val();
		var heightin=$('#heightin').val();
		var weightlbs=$('#weightlbs').val();
		var chestin=$('#chestin').val();
		var waistlbs=$('#waistlbs').val();
		var size=$('#size').val();
		var costumecondition="";
		var gender="";
		if(document.getElementById('unisex').checked){
			gender = document.getElementById('unisex').value;
		}
		if(document.getElementById('pet').checked){
			gender = document.getElementById('pet').value;
		}
		if (document.getElementById('male').checked) {
			gender = document.getElementById('male').value;
        }
	   if(document.getElementById('female').checked) {
			gender = document.getElementById('female').value;
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
		if(gender == "" | gender == null ){
			$('#gendererror').html('Select Gender');
		}
		if(costumecondition == "" | costumecondition == null ){
			$('#costumeconditionerror').html('Select Costume Condition');
		}
		if(customer_name==''){
			$('#customer_name').css('border','1px solid red');
			$('#customername_error').html('Select Customer Name');
			str=false;
		}
		if(costume_name==''){
			$('#costume_name').css('border','1px solid red');
			$('#costumename_error').html('Enter Costume Name');
			str=false;
		}
		if(category==''){
			$('#category').css('border','1px solid red');
			$('#categoryerror').html('Select Category');
			str=false;
		}
		if(costume_desc==''){
			$('#costume-desc').css('border','1px solid red');
			$('#costume-desc-error').html('Enter Costume Description');
			str=false;
		}
		if(price==''){
			$('#price').css('border','1px solid red');

			$('#priceerror').html('Enter Price');
			str=false;
		}
		if(quantity==''){
			$('#quantity').css('border','1px solid red');
			$('#quantityerror').html('Select Quantity');
			str=false;
		}
		if(heightft==''){
			$('#heightft').css('border','1px solid red');
			$('#heightfterror').html('Enter Height In Ft');
			str=false;
		}
		if(heightin==''){
			$('#heightin').css('border','1px solid red');
			$('#heightinerror').html('Enter Height In in');
			str=false;
		}
		if(weightlbs==''){
			$('#weightlbs').css('border','1px solid red');
			$('#weightlbserror').html('Enter weight In lbs');
			str=false;
		}
		if(chestin==''){
			$('#chestin').css('border','1px solid red');
			$('#chestinerror').html('Enter Chest In in');
			str=false;
		}
		if(waistlbs==''){
			$('#waistlbs').css('border','1px solid red');
			$('#waistlbserror').html('Enter Waist In lbs');
			str=false;
		}
		if(size==''){
			$('#size').css('border','1px solid red');
			$('#sizeerror').html('Select Size');
			str=false;
		
		}
		if(str==true)
    {
         $.ajax({
            dataType:"JSON",
            type:"POST",
            data :new FormData(this),
            url:"/costumes-insert",
            contentType:false,
            cache:false,
            processData:false,
            success:function(u){
                console.log(u);
				
                if(u.code=='200'){
				$('#sonay').show();
				$('#successmessage').html(u.description);
				//setTimeout(function() {window.location="/costumes/create";},2500);
				}
				
                if(u.code=='204'){
				$('#sonay').show();
				$('#successmessage').html(u.description);
			//	setTimeout(function() {window.location="/costumes/create";},2500);
			}
				
            },
            error:function(er){
                console.log(er);
            }
        });
    }
	
		return str;
	});
	</script>-->
	<script type="text/javascript">
	$("#heightft,#heightin,#weightlbs,#chestin,#waistlbs,#price,#charity_amount").on("keyup", function(){
	    var valid = /^\d{0,3}(\.\d{0,3})?$/.test(this.value),
	        val = this.value;
	    
	    if(!valid){
	        console.log("Invalid input!");
	        this.value = val.substring(0, val.length - 1);
	    }
	});
	</script>
	

	
	@stop

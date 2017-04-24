@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/sweetalert/dist/sweetalert.css')}}">
<link href="{{ asset('/assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/assets/admin/css/jquery.datetimepicker.css')}}">

       
@stop

{{-- Page content --}}
@section('content')
<style>
.fileupload-new .btn-file {
   margin: 10px 0 0 20px;
}
</style>

<section class="content-header">
	<h1>Users</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
		</li>
		<li>
			<a href="{{url('customers-list')}}">Users</a>
		</li>
		<li class="active"> Edit User</li>
	</ol>
	
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title heading-agent col-md-12">View User - {{$user->first_name}}  {{$user->last_name}}</h3>
				</div>
				<div class="box-body">
				<!--Tabs code starts here-->
				 <ul class="nav nav-tabs">
  <li class="active"><a  href="/customer-edit/{{$user->id}}">Profile</a></li>
  <li><a href="/user-costumes-list/{{$user->id}}">Costumes</a></li>
  <li><a href="/user-costumessold-list/{{$user->id}}">Costumes Sold</a></li>
  <li><a  href="/user-recentorders-list/{{$user->id}}">Recent Orders</a></li>
  <li><a  href="/user-credithistory-list/{{$user->id}}">Credit History</a></li>
  <li><a  href="/user-payementprofiles-list/{{$user->id}}">Payment Profiles</a></li>
</ul>
<!--Tab code ends here-->
				
				
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
					<form id="customer_edit" class="form-horizontal defult-form" name="userForm" action="/customer-update" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
					
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="user_id" value="{{$user->id}}">
						<div class="col-md-6">
							<h2 class="heading-agent">Personal Info</h2>
							<div class="col-md-12">
								<div class="row"> 
									<div class="col-md-6" ng-init="data.id='{{$user->id}}'">
										<input type="hidden" ng-model="data.id">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">First Name<span class="req-field" >*</span></label>
											<input autofocus="autofocus" type="text" class="form-control" value="{{$user->first_name}}"  name="first_name" placeholder="First Name" id="first_name">
											<p class="error">{{ $errors->first('first_name') }}</p>
										</div>
									</div>
									<div class="col-sm-12 col-md-6">
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">Last Name<span class="req-field" >*</span></label>
											<input type="text" class="form-control" value="{{$user->last_name}}" name="last_name" placeholder="Last Name" id="last_name">
											<p class="error">{{ $errors->first('last_name') }}</p>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">Phone #<span class="req-field" >*</span></label>
											<input type="text" class="form-control" name="phone_number" value="{{$user->phone_number}}" placeholder="123-456-7890"  id="phone_number" required>
											<p class="error">{{ $errors->first('phone_num') }}</p>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">Email Address<span class="req-field" >*</span></label>
											<input type="text" class="form-control" name="email" placeholder="my@email.com" value="{{$user->email}}" id="email" required>
											<p class="error">{{ $errors->first('last_name') }}</p>
										</div>
									</div>
									<?php
											$status=$user->vacation_status;
											if($status==1){?>
											<div class="col-md-12">
										<div class="form-group" >
											
											
											<input type="checkbox" checked onclick="show()" name="vacationstatus" id="vacationstatus"  value="1" id="email" required> &nbsp; &nbsp;&nbsp;In Vacation
											
										</div>
									</div>
									<div class="col-md-6" id="fromdatevactaion" >
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">From  Date<span class="req-field" >*</span></label>
                    <input type="text" class="form-control iconcal" id="date_timepicker_end_ticket" value="{{$user->vacation_from}}" placeholder="Select From Date" name="date_timepicker_end_ticket"   autocomplete="off" maxlength="50">
											
										</div>
									</div>
									<div class="col-sm-12 col-md-6" id="todatevaction" >
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">To Date<span class="req-field" >*</span></label>
											<input type="text" class="form-control iconcal" value="{{$user->vacation_to}}" placeholder="Select To Date" name="date_timepicker_end1_ticket" id="date_timepicker_end1_ticket"   autocomplete="off" maxlength="50">
											
										</div>
									</div>
												
										<?php	} else {
											?>
									<div class="col-md-12">
										<div class="form-group" >
											
											
											<input type="checkbox"  onclick="show()" name="vacationstatus" id="vacationstatus"  value="1" id="email" required> &nbsp; &nbsp;&nbsp;In Vacation
											
										</div>
									</div>
									<div class="col-md-6" id="fromdatevactaion" style="display:none">
									<div class="form-group" >
										<label for="inputEmail3" class="control-label">From  Date<span class="req-field" ></span></label>
                    <input type="text" class="form-control iconcal" id="date_timepicker_end_ticket"  name="date_timepicker_end_ticket"   placeholder="Select From Date" autocomplete="off" maxlength="50">
											
										</div>
									</div>
									<div class="col-sm-12 col-md-6" id="todatevaction" style="display:none">
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">To Date<span class="req-field" ></span></label>
											<input type="text" class="form-control iconcal"  name="date_timepicker_end1_ticket" id="date_timepicker_end1_ticket"  placeholder="Select To Date" autocomplete="off" maxlength="50">
											
										</div>
									</div>
										<?php } ?>
								</div>
								</div> 
							</div>
						
						<div class="col-md-6">
							<h2 class="heading-agent" style="display:none">sADsd</h2>
							<br><br><br>
							<div class="col-md-12">
									<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Username<span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Username"  name="user_name" id="user_name" value="{{$user->display_name}}">
										<span class="input-group-addon glyphicon glyphicon-lock" id="basic-addon2" style="position:static;"></span>
									</div>
									<p class="error">{{ $errors->first('email') }}</p> 
								</div>
								
								<div class="form-group has-feedback">
									<label for="inputEmail3" class="control-label">Password</label>
									<div class="input-group">
										<input type="password" class="form-control" placeholder="Password" name="password" id="password">
										<span class="input-group-btn">
											<button id="pwd_shw" class="btn btn-default" type="button" style="background-color: #fff;">
												<span class="glyphicon glyphicon-eye-open"></span>
											</button>
										</span>
									</div> 
									<p class="error">{{ $errors->first('password') }}</p> 
								</div> 
							</div>
						</div>
						<div class="col-md-6">
							<h2 class="heading-agent">Profile Image</h2>
							<div class="col-md-12">
								<div class="form-group">
									<label for="inputEmail3" class="control-label image-label">Upload</label>
									
									<div class="fileupload fileupload-new" data-provides="fileupload"> 
										<img  @if(empty($user->user_img)) src="{{asset('/img/default.png')}}" @else src="/profile_img/{{$user->user_img}}" @endif class="img-pview img-responsive" id="img-chan" name="img-chan">
										<span class="remove_pic">
											<i class="fa fa-times-circle" aria-hidden="true"></i>
										</span>
										<span class="btn btn-default btn-file">
											<span class="fileupload-new">Upload Photo</span>
											<span class="fileupload-exists"></span>     
											<input id="profile_logo" name="avatar" type="file" placeholder="Profile Image" class="form-control">
											<input type="hidden" name="is_removed"/>
										</span> 
										<p class="noteices-text">Note: The file should not exceed above 3MB and allowed .JPG, .JPEG, .PNG formats only.</p>
										<span class="fileupload-preview"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
									</div>
									<p class="error">{{ $errors->first('avatar') }}</p> 
								</div>
							</div>
						</div>
						<div class="col-md-12">
						<h2 class="heading-agent">{{$user->first_name}}  {{$user->last_name}} Reviews </h2>
						<span> No Reviews Found </span>
						<!--sony adding rating stars--->
						
                         <!--sony adding rating stars ended--->
						
						</div>
					</div>
					<div class="box-footer">
						<div class="pull-right">
							<a href="/customers-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
							<button type="submit" class="btn btn-primary pull-right">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
function show(){
	$('#fromdatevactaion').show();
	$('#todatevaction').show();
}
</script>


	@stop
	{{-- page level scripts --}}
	@section('footer_scripts')
	<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('/assets/admin/js/pages/customers.js') }}"></script>
	<script src="{{ asset('/assets/admin/js/jquery.datetimepicker.js') }}"></script>
	<script src="{{ asset('/assets/admin/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
	<script src="{{asset('/assets/vendors/moment/js/moment.min.js')}}"></script>
    <script src="{{asset('/assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
$(function() {

/*$('input[name="created_on"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
});*/

$('input[name="created_on"]').daterangepicker();
$('input[name="expiry_on"]').daterangepicker();
$('input[name="created_on"]').val('');
$('input[name="expiry_on"]').val('');
});
 jQuery('#date_timepicker_end_ticket').datetimepicker({
        format: 'Y-m-d',
        onShow: function (ct) {
            this.setOptions({
                closeOnDateSelect:true,
                 minDate: new Date($('#date_timepicker_start').val()),
                 maxDate: new Date($('#date_timepicker_end').val()),
               // minDate: jQuery('#date_timepicker_start_ticket').val() ? jQuery('#date_timepicker_start_ticket').val() : false
            })
        },
        timepicker: false
    });
	jQuery('#date_timepicker_end1_ticket').datetimepicker({
        format: 'Y-m-d',
        onShow: function (ct) {
            this.setOptions({
                closeOnDateSelect:true,
                 minDate: new Date($('#date_timepicker_start').val()),
                 maxDate: new Date($('#date_timepicker_end1').val()),
               // minDate: jQuery('#date_timepicker_start_ticket').val() ? jQuery('#date_timepicker_start_ticket').val() : false
            })
        },
        timepicker: false
    });

</script>
	@stop

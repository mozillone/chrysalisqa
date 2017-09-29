@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
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
			<a href="{{url('customers-list')}}">Users Lists</a>
		</li>
		
		<li class="active">Add User</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title col-md-12 heading-agent">Add User</h3>
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
					<form id="customer_create" class="form-horizontal defult-form" name="userForm" action="{{route('customer-create')}}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
						<div class="col-md-6">
							<h2 class="heading-agent">User Info</h2>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">First Name<span class="req-field" >*</span></label>
											<input type="text" class="form-control" name="first_name" placeholder="First Name" id="first_name" required>
											<p class="error">{{ $errors->first('first_name') }}</p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">Last Name<span class="req-field" >*</span></label>
											<input type="text" class="form-control" name="last_name" placeholder="Last Name" id="last_name" required>
											<p class="error">{{ $errors->first('last_name') }}</p>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">Phone #<span class="req-field" >*</span></label>
											<input type="text" class="form-control" name="phone_number" placeholder="123-456-7890"  id="phone_number" required>
											<p class="error">{{ $errors->first('phone_num') }}</p>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group" >
											<label for="inputEmail3" class="control-label">Email Address<span class="req-field" >*</span></label>
											<input type="text" class="form-control" name="email" placeholder="my@email.com" id="email" required>
											<p class="error">{{ $errors->first('last_name') }}</p>
										</div>
									</div>
									
								</div>
								
							</div>
						</div>
						
						<div class="col-md-6">
							<h2 class="heading-agent" style="display:none">Login Info</h2> 
							<br><br><br>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Username<span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Username"  name="user_name" id="user_name">
										<span class="input-group-addon glyphicon glyphicon-lock" id="basic-addon2" style="position:static;"></span>
									</div>
									<p class="error">{{ $errors->first('email') }}</p> 
								</div>
								<div class="form-group has-feedback" ng-class="{ 'has-error': userForm.password.$invalid && ( data.formSubmitted || userForm.password.$touched) }">
									<label autofocus="off" autocomplete="flase" for="inputEmail3" class="control-label">Password<span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="password" class="form-control" placeholder="Password" name="password" id="password">
										<span class="input-group-btn">
											<button id="pwd_shw" class="btn btn-default" type="button" style="background-color: #fff;">
												<span class="glyphicon glyphicon-eye-open"></span>
											</button>
										</span>
										<p class="error">{{ $errors->first('password') }}</p> 
									</div>
									
								</div>
							</div> 
						</div>
						<div class="col-md-6">
							<h2 class="box-title col-md-12 heading-agent pro-imgs">Profile Image</h2>
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
					</div> 
					<div class="box-footer">
						<div class="pull-right">
							<a href="/customers-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
							<button type="submit" class="btn btn-primary pull-right">Submit</button>
						</div>
					</div>
				</form>
			</div>
			
		</div>
	</section>
	@stop
	{{-- page level scripts --}}
	@section('footer_scripts')
	<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('/assets/admin/js/pages/customers.js') }}"></script>
	<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
	@stop

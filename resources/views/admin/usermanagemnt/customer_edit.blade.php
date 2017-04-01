@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/sweetalert/dist/sweetalert.css')}}">
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
	<h1>Customers</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
		</li>
		<li>
			<a href="{{url('customers-list')}}">Customets Lists</a>
		</li>
		<li class="active">{{$user->display_name}} Edit</li>
	</ol>
	
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title heading-agent col-md-12">View Customer - {{$user->display_name}}</h3>
				</div>
				<!--Tabs code starts here-->
				 <ul class="nav nav-tabs">
  <li class="active"><a  href="/customer-edit/{{$user->id}}">Profile</a></li>
  <li><a href="/user-costumes-list/{{$user->id}}">Costumes</a></li>
  <li><a href="/user-costumessold-list/{{$user->id}}">Costumes Sold</a></li>
  <li><a  href="/user-recentorders-list/{{$user->id}}">Recent Orders</a></li>
  <li><a  href="/user-credithistory-list/{{$user->id}}">Credit History</a></li>
  <li><a  href="/user-payementprofiles-list/{{$user->id}}">Payement Profiles</a></li>
</ul>
<!--Tab code ends here-->
				
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
					<form  id="edit_customer" class="form-horizontal defult-form" action="/customer-update" method="POST" novalidate enctype="multipart/form-data" >
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
								</div>
								</div> 
							</div>
						
						<div class="col-md-6">
							<h2 class="heading-agent">Login Info</h2>
							<div class="col-md-12">
								<div class="form-group has-feedback" >
									<label for="inputEmail3" class="control-label">Email<span class="req-field" >*</span></label>
									<div class="input-group">
										<input type="text" value="{{$user->email}}" class="form-control" placeholder="Email" name="email" id="email">
										<span class="input-group-addon glyphicon glyphicon-envelope" id="basic-addon2" style="position:static;"></span>
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
										<p class="noteices-text">Note: The file could not be exceed above 3MB and allowed .JPG, .JPEG, .PNG formats only.</p>
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
							<button type="submit" class="btn btn-primary pull-right">Update</button>
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
	<script src="{{ asset('/assets/admin/js/pages/customers.js') }}"></script>
	<script src="{{ asset('/assets/admin/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
	@stop

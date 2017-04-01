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
		<li class="active"> Edit</li>
	</ol>
	
</section>
<section class="content" ng-controller="UsersController">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title heading-agent col-md-12">View Customer - </h3>
				</div>
				<!--Tabs code starts here-->
				 <ul class="nav nav-tabs">
  <li><a href="/customer-edit/{{Request::segment(3)}}">Profile</a></li>
  <li class="active"><a  href="/user-costumes-list">Costumes</a></li>
  <li><a data-toggle="tab" href="#menu2">Costumes Sold</a></li>
  <li><a data-toggle="tab" href="#menu2">Recent Orders</a></li>
  <li><a data-toggle="tab" href="#menu2">Credit History</a></li>
  <li><a data-toggle="tab" href="#menu2">Payement Profiles</a></li>
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
					<fiv class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Customers List</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                    <a href="customer-add" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add Customer</a>
                    </div>
                </div>
                <div class="box-body">
        <div class="table-responsive">
                <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>Customer Name</th>
					<th>Email</th>
					<th>Phone No.</th>
                    <th>Is Seller?</th>
                    <th>Status</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <tr>
                      <input type="hidden" class="form-control token"  name="csrf-token" value="{{ csrf_token() }}">
                      <!--<td><input type="text" class="form-control" ng-model="search.id" name="id" placeholder=""></td>-->
                      <td><input type="text" class="form-control" ng-model="search.name" name="name" placeholder=""></td>
					  <td><input type="text" class="form-control" ng-model="search.email" name="email" placeholder=""></td>
					  <td><input type="text" class="form-control" ng-model="search.phone" name="phone" placeholder=""></td>
                      <td>
                        <select name="count" class="form-control" id="count" ng-model="search.count" >
                          <option value=""> All </option>  
                          <option value="1">Yes</option>
						  <option value="2">No</option>
                        </select>
                      </td>
					   <td>
                        <select name="mySelect" class="form-control" id="mySelect" ng-model="search.status">
                          <option value=""> All </option>  
                          <option ng-repeat="option in status" value="@{{option.value}}">@{{option.name}}</option>
                        </select>
                      </td>
                      <td><button class="btn btn-primary user-list-search" ng-click="seachUsers(search)">Search</button></td>
                    </tr>
                  </tbody>
              </table>
        </div>
          <div class="table-responsive">
          <table datatable dt-options="dtOptions" dt-columns="dtColumns"
                        class="table table-bordered table-hover table-striped" id="dtTable">
          </table>
          </div>
                </div>
            </div>
			</div>
    </div>
</section>
@stop


{{-- page level scripts --}}
@section('footer_scripts') 
<script src="{{ asset('angular/Admin/UserManagement/Controllers/users-lists.js') }}"></script>
<script src="{{ asset('angular/Admin/UserManagement/Services/user_management.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>

@stop
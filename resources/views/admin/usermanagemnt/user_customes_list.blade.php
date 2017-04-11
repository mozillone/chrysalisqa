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
	<h1>Users</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
		</li>
		<li>
			<a href="{{url('Users-list')}}">Users List</a>
		</li>
		<li class="active">
			Costumes List
		</li>
		
	</ol>
	
</section>
<?php
	$usersdid=Request::segment(2);
?>
<section class="content" >
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title heading-agent col-md-12">Users</h3>
				</div>
				<div class="box-body">
				<!--Tabs code starts here-->
				  <ul class="nav nav-tabs">
  <li ><a  href="/customer-edit/{{$userid}}">Profile</a></li>
  <li class="active" ><a href="/user-costumes-list/{{$userid}}">Costumes</a></li>
  <li><a href="/user-costumessold-list/{{$userid}}">Costumes Sold</a></li>
  <li><a  href="/user-recentorders-list/{{$userid}}">Recent Orders</a></li>
  <li><a  href="/user-credithistory-list/{{$userid}}">Credit History</a></li>
  <li><a  href="/user-payementprofiles-list/{{$userid}}">Payement Profiles</a></li>
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
					<fiv class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Users List</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                   
                    </div>
                </div>
                <div class="box-body">
        
          <div class="table-responsive">
          <table datatable dt-options="dtOptions" dt-columns="dtColumns"
                        class="table table-bordered table-hover table-striped" id="dtTable">
						<tr>
						<th>Costume Name</th>
						<th>Catgeory</th>
						<th>Condition</th>
						<th>Qty. Available</th>
						<th>Created Date</th>
						<th>Status</th>
						<th>Actions</th>
						</tr>
						<tr>
						<td colspan="7"><center>No Data Avialable..!!</center></td>
						</tr>
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
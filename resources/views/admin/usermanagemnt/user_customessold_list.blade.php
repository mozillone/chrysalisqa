@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Users</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Costumes Sold</li>
  </ol>
</section>
<section class="content" ng-controller="SoldOrdersController">

    <div class="row">
        <div class="col-md-12">

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

            <div class="box box-info">
             <div class="box-header">
					<h3 class="box-title heading-agent col-md-12">Costumes Sold</h3>
				</div>
  				  <ul class="nav nav-tabs">
					  <li ><a  href="/customer-edit/{{$userid}}">Profile</a></li>
					  <li><a href="/user-costumes-list/{{$userid}}">Costumes</a></li>
					  <li class="active"><a href="/user-costumessold-list/{{$userid}}">Costumes Sold</a></li>
					  <li><a  href="/user-recentorders-list/{{$userid}}">Recent Orders</a></li>
					  <li><a  href="/user-credithistory-list/{{$userid}}">Credit History</a></li>
					  <li><a  href="/user-payementprofiles-list/{{$userid}}">Payement Profiles</a></li>
				</ul>
	              <div class="box-body">
        			<div class="table-responsive">
		                <table class="table table-striped table-bordered user-list-table">
		                  <thead>
		                    <th>Order ID</th>
					        <th>From</th>
		                    <th>To</th>
		                    <th>Status</th>
		                  </thead>
		                  <tbody>
		                    <tr>
		                      <input type="hidden" class="form-control token"  name="csrf-token" value="{{ csrf_token() }}">
		                      <input type="hidden" class="form-control"  name="user_id" value="{{$userid}}">
		                      <td><input type="text" class="form-control" ng-model="search.order_id"  placeholder=""></td>
		                 	  <td><input type="text" class="form-control" datepicker ng-model="search.from_date" placeholder="Order From"></td>
		                  	  <td><input type="text" class="form-control" datepicker ng-model="search.date_end" placeholder="Order To"></td>
		                   
		                     <td>
		                        <select name="count" class="form-control" id="count" ng-model="search.status" >
		                          <option value=""> All </option>  
		                          <option value="Processing">Processing</option>
		                          <option value="Shipping">Shipping</option>
		                          <option value="Shipped">Shipped</option>
		                          <option value="Dispatched">Dispatched</option>
		                          <option value="Delivered">Delivered</option>
		                          <option value="Returned">Returned</option>
								            </select>
		                      </td>
							   
		                      <td><button class="btn btn-primary user-list-search" ng-click="seachSoldOrders(search)">Search</button></td>
		                    </tr>
		                  </tbody>
		              </table>
        		</div>
        		<div class="row">
                    <div class="col-md-12">
                      <div class="pull-right user-list">
                        <a href="javascript:void(0);" class="btn btn-xs btn-success" id="export" ng-click="ordersExportCSV()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="fa fa-download"></i></a>
                       </div>
                    </div>
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
<script src="{{ asset('angular/Admin/UserManagement/Controllers/soldorders-lists.js') }}"></script>
<script src="{{ asset('angular/Admin/UserManagement/Services/orders.js') }}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>

@stop
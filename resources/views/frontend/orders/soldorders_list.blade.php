@extends('frontend.app')
{{-- Web site Title --}}
@section('title') My Costumes Sold List @parent
@endsection
{{-- page level styles --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
@stop
{{-- Page content --}}
@section('content')
<section class="container content-header view-order_tl_div">
  	<div class="row">
		<div class="col-md-12">
			<nav class="breadcrumb ">
				<a class="breadcrumb-item" href="/dashboard">Dashboard &nbsp; > </a>
				<span class="breadcrumb-item active"> Costumes Sold</span>
			</nav>
		</div>
	</div>
</section>
<section class="container content" ng-controller="SoldOrdersController">
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
            <div class="box box-info costume-sold-sec">
				<div class="rencemt_order_table">
					<div class="box-header with-border">
						<h2 class="box-title">Costumes Sold</h2>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-striped  user-list-table">
								<thead>
									<th>Order No.</th>
									<th>From</th>
									<th>To</th>
									<th>Status</th>
									<th></th>
								</thead>
								<tbody>
									<tr>
										<input type="hidden" class="form-control token"  name="csrf-token" value="{{ csrf_token() }}">
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
										<td><button class="btn btn-primary user-list-search order-filter-btn" ng-click="seachSoldOrders(search)">Search</button></td>
									</tr>
									</tbody>
								</table>
							</div>
							<div class="row">
								<!-- <div class="col-md-12">
									<div class="pull-right user-list">
									<a href="javascript:void(0);" class="btn btn-xs btn-success" id="export" ng-click="ordersExportCSV()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="fa fa-download"></i></a>
									</div>
								</div> -->
							</div>
							<div class="table-responsive auto-scroll-none">
								<table datatable dt-options="dtOptions" dt-columns="dtColumns"
								class="table table-striped" id="dtTable">
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@stop
	{{-- page level scripts --}}
	@section('footer_scripts') 
	<script src="{{ asset('/vendors/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
	<script src="{{ asset('angular/Frontend/Orders/Controllers/soldOrders-lists.js') }}"></script>
	<script src="{{ asset('angular/Frontend/Orders/Services/orders.js') }}"></script>
	<script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
	<script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
	@stop
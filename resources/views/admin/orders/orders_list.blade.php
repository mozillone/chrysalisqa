@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">

@stop

{{-- Page content --}}
@section('content')
 <section class="content-header">
    <h1>Users</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Orders</li>
  </ol>
</section>
<section class="content" ng-controller="OrdersController">
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
                <div class="box-header with-border">
                    <h3 class="box-title">Orders List</h3>
                   </div>
                <div class="box-body">
        <div class="table-responsive">
                <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>Order ID</th>
					          <th>Customer Name</th>
					          <th>Costume Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                  </thead>
                  <tbody>
                    <tr>
                      <input type="hidden" class="form-control token"  name="csrf-token" value="{{ csrf_token() }}">
                      <td><input type="text" class="form-control" ng-model="search.order_id"  placeholder=""></td>
                      <td><input type="text" class="form-control" ng-model="search.user_name"  placeholder=""></td>
					            <td><input type="text" class="form-control" ng-model="search.costume_name"  placeholder=""></td>
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
					   
                      <td><button class="btn btn-primary user-list-search" ng-click="seachOrders(search)">Search</button></td>
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

<script src="{{ asset('angular/Admin/Orders/Controllers/orders-lists.js') }}"></script>
<script src="{{ asset('angular/Admin/Orders/Services/orders.js') }}"></script>
<script src="{{ asset('angular/Admin/ExportCsv/Services/ExportCsv.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>

@stop































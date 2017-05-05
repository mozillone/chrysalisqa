@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<style type="text/css">
#dtTable tr>th:first-child{
display: none;
}
#dtTable tr>td:first-child{
display: none;
}
</style>
@stop

{{-- Page content --}}
@section('content')
 <section class="content-header">
    <h1>Users</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Users</li>
  </ol>
</section>
<section class="content" ng-controller="UsersController">
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
                    <h3 class="box-title">Users List</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                    <a href="customer-add" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add User</a>
                    </div>
                </div>
                <div class="box-body">
        <div class="table-responsive">
                <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>User Name</th>
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
<<<<<<< HEAD
					  <td><input type="text" class="form-control" ng-model="search.phone" id="phone_number" name="phone" placeholder=""></td>
=======
					  <td><input type="text" class="form-control" ng-model="search.phone" name="phone" placeholder="" id="phone_number"></td>
>>>>>>> 2ebbe99a0b114e340179d12b946b4245e53c8bff
                      <td>
                        <select name="count" class="form-control" id="count" ng-model="search.count" >
                          <option value=""> All </option>  
                          <option value="1">Yes</option>
						  <option value="0">No</option>
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
        <div class="row">
                    <div class="col-md-12">
                      <div class="pull-right user-list">
                        <a href="javascript:void(0);" class="btn btn-xs btn-success" id="export" ng-click="usersExportCSV()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="fa fa-download"></i></a>
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

<script src="{{ asset('angular/Admin/UserManagement/Controllers/users-lists.js') }}"></script>
<script src="{{ asset('angular/Admin/UserManagement/Services/user_management.js') }}"></script>
<script src="{{ asset('angular/Admin/ExportCsv/Services/ExportCsv.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>

@stop































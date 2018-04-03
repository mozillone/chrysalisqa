@extends('admin.app')

{{-- Web site Title --}}
@section('title')
Promotions List@parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
@stop

{{-- Page content --}}
@section('content')
 <section class="content-header">
    <h1>Promotions</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Promotions List</li>
  </ol>
</section>
<section class="content" ng-controller="PromotionsController">
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
                    <h3 class="box-title">Promotions List</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                    <a href="{{route('promotion-create')}}" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add promotion</a>
                    </div>
                </div>
                <div class="box-body">
			           <div class="table-responsive">
                 <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>Coupon Name</th>
                    <th>Applied From</th>
                    <th>Applied To</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <tr>
                      <input type="hidden" class="form-control token"  name="csrf-token" value="{{ csrf_token() }}">
                      <td><input type="text" class="form-control" ng-model="search.name" name="name" placeholder="Coupon Name"></td>
                      <td><input type="text" class="form-control" datepicker ng-model="search.from_date" name="from_date" placeholder="Applied From"></td>
                      <td><input type="text" class="form-control" datepicker ng-model="search.date_end" name="date_end" placeholder="Applied To"></td>
                      <td>
                        <select name="count" class="form-control" id="count" ng-model="search.cats" >
                            <option value=""> All </option>  
                            @foreach($cats_list as $cats)
                            <option value="{{$cats->category_id}}">{{$cats->name}}</option>
                            @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="mySelect" class="form-control" id="mySelect" ng-model="search.costumes">
                          <option value=""> All </option>  
                          @foreach($costumes_list as $costumes)
                          <option value="{{$costumes->costume_id}}">{{$costumes->name}}</option>
                          @endforeach
                        </select>
                      </td>
                      <td><button class="btn btn-primary user-list-search" ng-click="seachPromotions(search)">Search</button></td>
                    </tr>
                  </tbody>
              </table>
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
<script src="{{ asset('/angular/Admin/Promotions/Controllers/promotions-lists.js') }}"></script>
<script src="{{ asset('/angular/Admin/Promotions/Services/promotions.js') }}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('/angular/Admin/directives/datepicker.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
@stop

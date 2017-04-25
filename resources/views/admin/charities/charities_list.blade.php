@extends('admin.app')

{{-- Web site Title --}}
@section('title')
Charities@parent
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
    <h1>Charities</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Charities List</li>
  </ol>
</section>
<section class="content" ng-controller="CharitiesController">
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
                    <h3 class="box-title">Charities List</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                    <a data-toggle="modal" data-target="#charity_create_popup" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add charity</a>
                    </div>
                </div>
                <div class="box-body">
			           <div class="table-responsive">
                 <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>Charity Name</th>
                    <th>Created From</th>
                    <th>Created To</th>
                    <th>Display Status</th>
                  </thead>
                  <tbody>
                    <tr>
                      <input type="hidden" class="form-control token"  name="csrf-token" value="{{ csrf_token() }}">
                      <td><input type="text" class="form-control" ng-model="search.name" name="name" placeholder="Charity Name"></td>
                      <td><input type="text" class="form-control" datepicker ng-model="search.from_date" name="from_date" placeholder="Created From"></td>
                      <td><input type="text" class="form-control" datepicker ng-model="search.date_end" name="date_end" placeholder="Created To"></td>
                      <td>
                        <select name="count" class="form-control" id="count" ng-model="search.status" >
                            <option value=""> All </option>  
                            <option value="1">Active</option>  
                            <option value="0">InActive</option>  
                        </select>
                      </td>
                      <td><button class="btn btn-primary user-list-search" ng-click="seachCharities(search)">Search</button></td>
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
    <div class="modal fade" id="charity_create_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   Add Charity
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form class="form-horizontal" role="form" method="POST" id="charity-create" action="{{route('charity-create')}}" enctype='multipart/form-data'>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Charity Name"/>
                    </div>
                  </div>
                  <div class="col-md-12">
                        <div class="form-group">
                          <div class="row upload_bx col-md-4 col-sm-6 col-xs-12">
                              <div class="col-md-12 ">
                                <div class=" upload_btns">
                                          <span class=" btn-file">
                                            <span class="fileupload-exists"></span>     
                                            <input id="profile_logo" name="image" type="file" placeholder="Profile Image" class="form-control">
                                            <input type="hidden" name="is_removed"/>
                                  </span> 
                                  </div>
                                </div>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12 fileupload fileupload-new" data-provides="fileupload"> 
                            <img src="{{asset('/charities_images/default-placeholder.jpg')}}" class="img-pview img-responsive" id="img-chan" name="img-chan">
                             <span class="fileupload-preview"></span>
                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
                          </div>
                        </div>  
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Submit"/>
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
            </div>
             </form>
        </div>
    </div>
</div>
<div class="modal fade" id="charity_edit_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="charity_heading">
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form class="form-horizontal" role="form" method="POST" id="charity-edit" action="{{route('charity-edit')}}" enctype='multipart/form-data'>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="charity_id" value="">
                  <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" name="charity_name" class="form-control" id="charity_name" placeholder="Charity Name" />
                    </div>
                  </div>
                  <div class="col-md-12">
                        <div class="form-group">
                          <div class="row upload_bx col-md-4 col-sm-6 col-xs-12">
                              <div class="">
                                <div class=" upload_btns">
                                          <span class=" btn-file">
                                            <span class="fileupload-exists"></span>     
                                            <input id="edit_img_pic" name="image" type="file" placeholder="Profile Image" class="img-responsivel">
                                            <input type="hidden" name="is_removed"/>
                                  </span> 
                                  </div>
                                </div>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12 fileupload fileupload-new" data-provides="fileupload"> 
                            <img src="{{asset('/charities_images/default-placeholder.jpg')}}" class="img-pview img-responsive"  id="img-chan1">
                           
             
                            <span class="fileupload-preview"></span>
                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
                          </div>
                        </div>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Submit"/>
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
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
<script src="{{ asset('/angular/Admin/Charities/Controllers/charities-lists.js') }}"></script>
<script src="{{ asset('/angular/Admin/Charities/Services/charities.js') }}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('/angular/Admin/directives/datepicker.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
@stop

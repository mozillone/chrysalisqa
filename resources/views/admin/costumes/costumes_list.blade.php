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
    <h1>Customes</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Customes List</li>
  </ol>
</section>
<section class="content" ng-controller="CostumesController">
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
                    <h3 class="box-title">Customes List</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                    <a href="customer-add" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add Customer</a>
                    </div>
                </div>
                <div class="box-body">
        <div class="table-responsive">
                <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Active</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <tr>
                      <input type="hidden" class="form-control token"  name="csrf-token" value="{{ csrf_token() }}">
                      <td><input type="text" class="form-control" ng-model="search.id" name="id" placeholder="Customer ID"></td>
                      <td><input type="text" class="form-control" ng-model="search.name" name="name" placeholder="User Name"></td>
                      <td><input type="text" class="form-control" ng-model="search.email" name="email" placeholder="Email"></td>
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
          <!-- <table datatable dt-options="dtOptions" dt-columns="dtColumns"
                        class="table table-bordered table-hover table-striped" id="dtTable">
          </table> -->
          <table class="table table-bordered table-hover" id="customes-list-table">
              <thead>
                  <tr>
                      <th>SKU #</th>
                      <th>Costume Name</th>
                      <th>Customer Name</th>
                      <th>Category</th>
                      <th>Condition</th>
                      <th>Created Date</th>
                      <th>Status</th>
                      <th>Actions</th>
                 </tr>
          </thead>
              <tbody>
          </tbody>
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


<script type="text/javascript">
   function changeCostumeStatus(id, status) {
        $.ajax({
            type: "GET",
            url: '{!! url('changecostumestatus') !!}',
            data: {'id':id,'status':status},
            dataType: 'json',
            success: function(response) {
                if(response){
                    table.ajax.reload();
                }
            }
        });
        }
        var table = '';
  $(function() {
            table = $('#customes-list-table').DataTable({
      "ajax": {
            "url" : "getallcostumes",
           "type": "GET",
         },
      "searching": false,
      "pageLength": 25,
      "bLengthChange": false,
      
      "columns": [
        { data: 'sku_no', name: 'sku_no'},
        { data: 'custome_name', name: 'custome_name'},
        { data: 'customer_name', name: 'customer_name'},
        { data: 'cat_name', name: 'cat_name'},
        { data: 'custome_condition', name: 'custome_condition'},
        { data: 'custome_created_at', name: 'custome_created_at'},
        { data: 'status', name: 'status'},
        { data: 'actions', name: 'actions'}
      ]
    });


  }); 


        function deletecostume($id){
        var id=$id;

    swal({
       title: "Are you sure want to delete this Costume?",
                  showCancelButton: true,
                 confirmButtonColor: "#DD6B55 ",
                 confirmButtonText: "Yes, delete",
                 closeOnConfirm: false,
                 closeOnCancel: true
               },

               function(){
               url = "/deletecostume/"+id+"";
                window.location = url;
               });


   }

</script>

@stop































@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<<<<<<< HEAD

<link rel="stylesheet" href="{{ asset('/assets/frontend/css/buttons.dataTables.min.css')}}">
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
@stop

{{-- Page content --}}
@section('content')
 <section class="content-header">
    <h1>Customes</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Costumes List</li>
  </ol>
</section>
<<<<<<< HEAD
<section class="content" >
=======
<section class="content" ng-controller="CostumesController">
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
                    <h3 class="box-title">Costumes List</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                    <a href="{{URL::to('costumes/create')}}" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add Custome</a>
                    </div>
                </div>
                <div class="box-body">
        <div class="table-responsive">
<<<<<<< HEAD
          <form  method="post" name="coslist_search" id="coslist_search" action="javascript:void(0);">

                      <input type="hidden" class="form-control token"  name="csrf-token" value="{{ csrf_token() }}">
                <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>Sku</th>
                    <th>Costume Name</th>
                    <th>Customer Name</th>
                    <th>Condition</th>
                    <th>Status</th>
=======
                <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Active</th>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                    <th></th>
                  </thead>
                  <tbody>
                    <tr>
<<<<<<< HEAD
                      <td><input type="text" class="form-control"  name="sku" id="sku" placeholder="Sku"></td>
                      <td><input type="text" class="form-control"  name="costume_name" id="costume_name" placeholder="Costume Name"></td>
                      <td><input type="text" class="form-control"  name="customer_name" id="customer_name" placeholder="Customer Name"></td>
                      <td>
                        <select name="conditin" class="form-control" id="condition">
                          <option value=""> All </option>  
                          <option value="brand_new"> Brand New </option>
                          <option value="like_new">Like New</option>
                          <option value="excellent">Excellent</option>
                          <option value="good">Good</option>
                        </select>
                      </td>
                      <td>
                        <select name="status" class="form-control" id="status">
                          <option value=""> All </option>  
                          <option value="active">Active</option>
                          <option value="inactive">Inactive</option>
                        </select>
                      </td>
                      <td>
                        <button type="submit" class="btn btn-primary submit" name="search" id="search">Search</button></td>
                    </tr>
                  </tbody>
              </table>
              </form>
=======
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
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
                      <th>Price</th>
                      <th>Created Date</th>
                      <th>Status</th>
                      <th>Status</th>
                      <th>Featured</th>
=======
                      <th>Created Date</th>
                      <th>Status</th>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>

<script src="{{ asset('/assets/frontend/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('/assets/frontend/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('/assets/frontend/js/buttons.print.min.js')}}"></script>

=======
<script src="{{ asset('angular/Admin/UserManagement/Controllers/users-lists.js') }}"></script>
<script src="{{ asset('angular/Admin/UserManagement/Services/user_management.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>

>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

<script type="text/javascript">
   function changeCostumeStatus(id, status) {
        $.ajax({
<<<<<<< HEAD
            type: "POST",
            url: "{!! URL::to('changecostumestatus') !!}",
            data: {'id':id,'status':status},
            dataType: 'json',
            success: function(response) {
                if(response){
                    table.ajax.reload();
                }
            }
        });
        }
        function changeFeaturedStatus(id, status) {
        $.ajax({
            type: "POST",
            url: "{!! URL::to('changefeaturestatus') !!}",
=======
            type: "GET",
            url: '{!! url('changecostumestatus') !!}',
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
<<<<<<< HEAD
      "order": [ 6, 'DESC'],
      "columnDefs": [{
      "targets": [ 7 ],
      "visible": false,
      "searchable": false
      },{
        'bSortable' : false,
        'aTargets' : [ -3, -2, -1 ]
      }],
       dom: 'Bfrtip',
       buttons: [
                  {
                    extend: 'csv',
                    title: 'Costumes List',
                    exportOptions: {
                       columns: ':not(:nth-child(8)):not(:nth-child(9)):not(:nth-child(10)):not(:nth-child(11))'
                    }
                }
            ],
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
      
      "columns": [
        { data: 'sku_no', name: 'sku_no'},
        { data: 'custome_name', name: 'custome_name'},
        { data: 'customer_name', name: 'customer_name'},
        { data: 'cat_name', name: 'cat_name'},
        { data: 'custome_condition', name: 'custome_condition'},
<<<<<<< HEAD
        { data: 'price', name: 'price'},
        { data: 'custome_created_at', name: 'custome_created_at'},
        { data: 'custome_status', name: 'custome_status'},
        { data: 'status', name: 'status'},
        { data: 'is_featured', name: 'is_featured'},
=======
        { data: 'custome_created_at', name: 'custome_created_at'},
        { data: 'status', name: 'status'},
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        { data: 'actions', name: 'actions'}
      ]
    });


  }); 

<<<<<<< HEAD
  $("#search").click(function(){
    table.destroy();
       var sku=$("#sku").val();
       var costume_name=$("#costume_name").val();
       var customer_name=$("#customer_name").val();
       var condition=$('#condition').val();
       var status=$('#status').val();
       table = $('#customes-list-table').DataTable({
      "ajax": {
            "url" : "getallsearchcostumes",
           "type": "POST",
             "data": {sku:sku,costume_name:costume_name,customer_name:customer_name,condition:condition,status:status}
         },
      "searching": false,
      "pageLength": 25,
      "bLengthChange": false,
      "order": [ 6, 'DESC'],
      "columnDefs": [{
      "targets": [ 7 ],
      "visible": false,
      "searchable": false
      },{
        'bSortable' : false,
        'aTargets' : [ -3, -2, -1 ]
      }],
      dom: 'Bfrtip',
       buttons: [
                  {
                    extend: 'csv',
                    title: 'Costumes List',
                    exportOptions: {
                       columns: ':not(:nth-child(8)):not(:nth-child(9)):not(:nth-child(10))'
                    }
                }
            ],
      "columns": [
        { data: 'sku_no', name: 'sku_no'},
        { data: 'custome_name', name: 'custome_name'},
        { data: 'customer_name', name: 'customer_name'},
        { data: 'cat_name', name: 'cat_name'},
        { data: 'custome_condition', name: 'custome_condition'},
        { data: 'price', name: 'price'},
        { data: 'custome_created_at', name: 'custome_created_at'},
        { data: 'custome_status', name: 'custome_status'},
        { data: 'status', name: 'status'},
        { data: 'is_featured', name: 'is_featured'},
        { data: 'actions', name: 'actions'}
      ]
    });

    });

=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

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































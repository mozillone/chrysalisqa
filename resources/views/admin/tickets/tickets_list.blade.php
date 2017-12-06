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
    <h1>Support</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Tickets List</li>
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
                    <h3 class="box-title">Tickets List</h3>
                </div>
                <form  method="post" name="user_search" id="user_search" action="javascript:void(0);">
                 
                <div class="box-body">
        <div class="table-responsive">
                <table class="table table-striped table-bordered user-list-table">
                  <thead>
                    <th>Keyword</th>
                    <th>Customer Name</th>
                    <th>Ticket Type</th>
                    <th>Status</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <tr>
                      <input type="hidden" name="token" id="token" value='{{ csrf_field()}}'>
                       <td><input type="text" class="form-control"  name="keyword" id="keyword" placeholder="keywords"></td>
                      <td><input type="text" class="form-control"  name="customername"  id="customername" placeholder="Customer Name"></td>
                     
                      <td>
                        <select  class="form-control" name="ticket_type" id="ticket_type" >
                        <option value="">Select Type</option>
                        <option value="Order">Order</option>
                        <option value="Dispute">Dispute</option>
                        <option value="Unique">Unique</option>
                        <option value="shipping">Shipping</option>
                    </select>
                      </td>
                       <td>
                        <select  class="form-control" name="status" id="status" >
                        <option value="">Select Status</option>
                        <option value="">All</option>
                        <option value="1">Open</option>
                        <option value="0">Pending</option>
                        <option value="2">Closed</option>
                    </select>
                      </td>
                      <td><button class="btn btn-primary user-list-search" id="search" name="search">Search</button></td></td>
                    </tr>
                  </tbody>
              </table>
               </form>
        </div>
     
          <div class="table-responsive">
          <!-- <table datatable dt-options="dtOptions" dt-columns="dtColumns"
                        class="table table-bordered table-hover table-striped" id="dtTable">
          </table> -->
          <table class="table table-bordered table-hover" id="tickets-table">
              <thead>
                  <tr>
                      <th>Ticket ID</th>
                      <th>Customer Name</th>
                      <th>Type</th>
                      <th>Order #</th>
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
  /*****Datatables For Listing Code Starts Here****/ 
  var table = '';
  $(function() {
            table = $('#tickets-table').DataTable({
      "ajax": {
            "url" : "getalltickets",
           "type": "GET",
         },
      "searching": false,
      "pageLength": 25,
      "bLengthChange": false,
      "order": [[ 4, "desc" ]],
      "columns": [
        { data: 'ticketid', name: 'ticketid'},
        { data: 'customer_name', name: 'customer_name'},
        { data: 'type', name: 'type'},
        { data: 'orderid', name: 'orderid'},
        { data: 'createdate', name: 'createdate'},
        { data: 'status', name: 'status'},
        { data: 'actions', name: 'actions'}
      ]
    });


  }); 
  /********Change Status Code Starts Here***/
  function ticketStatus(id, status) {
        $.ajax({
            type: "GET",
            url: '{!! url('changeticketstatus') !!}',
            data: {'id':id,'status':status},
            dataType: 'json',
            success: function(response) {
                if(response){
                    table.ajax.reload();
                }
            }
        });
  }
  /*********Delete Ticket Code starts here****/
  function deletTicket($id){
        var id=$id;

    swal({
       title: "Are you sure want to delete this Ticket?",
                  showCancelButton: true,
                 confirmButtonColor: "#DD6B55 ",
                 confirmButtonText: "Yes, delete",
                 closeOnConfirm: false,
                 closeOnCancel: true
               },

               function(){
               url = "/deleteticket/"+id+"";
                window.location = url;
               });
   }
  /********Search Functionality Code starts here****/
   $("#search").click(function(){
   
      table.destroy();
      console.log($("#user_search").serialize());
      var keyword=$("input[name=keyword]").val();
      var name=$("input[name=customername]").val();
      var type=$("#ticket_type").val();
      var status=$("#status").val();
      var token=$('#token').val();
      table = $('#tickets-table').DataTable({
        "ajax": {
          "url" : "support/search",
          "type": "POST",
          "data": {keyword:keyword,name:name,type:type,status:status,_token:token}
        },
        "searching": false,
        "pageLength": 50,
        "bLengthChange": false,
        "order": [ [3, 'desc'] ],
        "columns": [
        { data: 'ticketid', name: 'ticketid'},
        { data: 'customer_name', name: 'customer_name'},
        { data: 'type', name: 'type'},
        { data: 'orderid', name: 'orderid'},
        { data: 'createdate', name: 'createdate'},
        { data: 'status', name: 'status'},
        { data: 'actions', name: 'actions'}
        ]
      });
      
    });

</script>

@stop
































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
    <h1>Manage Requests</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Manage Request Bags</li>
  </ol>
</section>
<!-- Main content -->

<section class="content">
  <div class="box box-default">
    
    <!-- /.box-header -->
    <div class="box-body ">
      <!-- <div>&nbsp;</div> -->


 
<div id="exTab3" class="tabs-userlist"> 



      <div class="tab-content clearfix">
        <div class="tab-pane active" id="students">
              <div class="list-blde">
          <table class="table table-bordered table-hover" id="users-table">
              <thead>
                  <tr>
                <th>Ref #</th>
                      <th>Costumer Name</th>
                      <th>Request Date</th>
                      <th>PayOut</th>
                      <th>Return Assurance</th>
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
  </div>
</section>
@endsection
@section('footer_scripts')
<script type="text/javascript">
  var table = '';
  $(function() {
            table = $('#users-table').DataTable({
      "ajax": {
            "url" : "getallmanagebags",
           "type": "GET",
         },
      "searching": false,
      "pageLength": 50,
      "bLengthChange": false,
      
      "columns": [
        { data: 'ref_no', name: 'ref_no' },
        { data: 'cus_name', name: 'cus_name' },
        { data: 'created_at', name: 'created_at' },
        { data: 'is_payout', name: 'is_payout' },
        { data: 'is_return', name: 'is_return' },
        { data: 'status', name: 'status' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false}
      ],
      columnDefs : [
        { targets : [3],
          render : function (data, type, row) {
            switch(data) {
               case '1' : return 'Y'; break;
               case '0' : return 'N'; break;
               default  : return 'N/A';
            }
          }
        },
        { targets : [4],
          render : function (data, type, row) {
            switch(data) {
               case '1' : return 'Y'; break;
               case '0' : return 'N'; break;
               default  : return 'N/A';
            }
          }
        }
      ]
    });

  }); 
   

</script>
@endsection

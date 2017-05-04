@extends('admin.app')
@section('content')
<h1>Manage Request A Bag</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">@section('breadcrumb') @show</li>
</ol>
</section>
<!-- Main content -->

<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">@section('heading')@show</h3>
      <div class="box-tools pull-right">
              <a href="/admin/countries/create" type="button" class="btn btn-xs btn-block btn-success">@section('create')
           
       @show</a>
      </div>
    </div>
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
      <!--  <div class="tab-pane" id="professionals">
          <h3>professionals</h3>
        </div>
        <div class="tab-pane" id="business">
          <h3>business</h3>
        </div>
          <div class="tab-pane" id="schools">
          <h3>schools</h3>
        </div> -->
      </div>
  </div>      
    </div>
  </div>
</section>
@endsection
@section('footer_scripts')

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
$(function() {

/*$('input[name="created_on"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
});*/

$('input[name="created_on"]').daterangepicker();
$('input[name="expiry_on"]').daterangepicker();
$('input[name="created_on"]').val('');
$('input[name="expiry_on"]').val('');
});
</script>

<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script> -->
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
      ]
    });

    //implementing code for search functionality in ajax

    
    
    $("#search").click(function(){

             table.destroy();
             console.log($("#user_search").serialize());

             var name=$("input[name=name]").val();
             var id=$("input[name=id]").val();
             var email=$("input[name=email]").val();
             var created_on=$("input[name=created_on]").val();
             var role_id=$("input[name=role_id]").val();
             var _token=$("input[name=_token]").val();
             var status=$('#mySelect :selected').val();
             var country=$('#country').val();


        table = $('#users-table').DataTable({
        "ajax": {
              "url" : "/admin/user/search",
             "type": "POST",
             "data": {id:id, name:name, email:email, status:status, created_on:created_on, role_id:role_id, _token:_token,country:country}
           },
        "searching": false,
        "pageLength": 50,
        "bLengthChange": false,
        "order": [ [3, 'desc'] ],
        "columns": [
          { data: 'id', name: 'id' },
          { data: 'fname', name: 'fname' },
          { data: 'email', name: 'email' },
          /*{ data: 'role', name: 'role' },*/
          { data: 'country', name: 'country' },
          { data: 'date_format', name: 'date_format'},
          { data: 'date_format_to', name: 'date_format_to'},
          { data: 'status', name: 'status' },
          { data: 'actions', name: 'actions', orderable: false, searchable: false}
        ]
      });

    });
     //end of code search functionality
  });
 

  /*$(document).on('click','.delete_user',function(){
    var id=$(this).attr('attr_id');
    swal({   
            title: "Are you sure want to delete?",   
            text: "You will not be able to recover this Listing!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
      closeOnConfirm: false 
    }, 
    function(result){   
      if(result){ 
        window.location.href="delete/"+id;
      }
    });
  });
   
    $(document).ready(function () {
      $('#datetimepicker1').datepicker({
                    format: "mm/dd/yyyy",
                    "setDate": new Date(),
                    "autoclose": true,
                    endDate:'today'
                }); 
      $('#datetimepicker2').datepicker({
                    format: "mm/dd/yyyy",
                    "setDate": new Date(),
                    "autoclose": true
                }); 
                });*/
  function changeStatus(id, status) {
  
    $.ajax({
      type: "GET",
      url: '{!! url('admin/changemenustatus') !!}',
      data: {'id':id,'status':status},
      dataType: 'json',
      success: function(response) {
        if(response){
          table.ajax.reload();
          console.log( table.row( this ).data().status );
          $('.box-body').before('<div class="callout callout-success">Status Updated.</div>');
          setTimeout(function() {
          //console.log();
    $('.callout-success').fadeOut('fast');
}, 2000);
          
        }
      }
    });
      }
    
    function deleteCountry($id){ 
    var id=$id;
  
     swal({  
                title: "Are you sure want to delete this Country?",  
                  text: "Are you sure want to delete this Country?",  
                  showCancelButton: true,  
                  confirmButtonColor: "#DD6B55 ",  
                  confirmButtonText: "Yes, delete",  
                  closeOnConfirm: false,
                  closeOnCancel: true
                },
                
                function(){
                url = "/admin/countries/delete/"+id+"";
          window.location = url;
                });


    }

</script>
@endsection

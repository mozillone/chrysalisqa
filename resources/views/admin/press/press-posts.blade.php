@extends('admin.app')

@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/css/clockpicker.css') }}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
<style>
.fileupload-new .btn-file {
   margin: 10px 0 0 20px;
}
</style>
@stop

@section('content')


<section class="content-header">
    <h1>Press</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="active">Press Posts</li>
    </ol>
    
</section>

<!-- Main content -->

<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
<h3 class="box-title press_tle">@section('heading'){{$heading}}@show</h3>
      <div class="box-tools pull-right">
              <a href="/add-press-post" type="button" class="btn btn-xs btn-block btn-success">@section('create')
           {{$create}}
       @show</a>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body ">
      <!-- <div>&nbsp;</div> -->
       @include('admin.partials.notifications')

<form  method="POST" name="user_search" id="user_search" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="table-responsive">
  <table class="table table-striped table-bordered user-list-table">
     <thead>
        <tr>
           <th>Title</th>
           <th>Created From Date</th>
           <th>Created To Date</th>
        </tr>
     </thead>
     <tbody>

        <tr>
           <td><input autocomplete="off" class="form-control ng-pristine ng-valid ng-empty ng-touched" name="pressTitle" placeholder="" type="text"></td>

              


              <td>
              <input autocomplete="off" class="form-control ng-pristine ng-valid ng-empty ng-touched" name="searchFromDate" id="searchFromDate" placeholder="" type="text">
              </td>

              <td>
                <input type="text" autocomplete="off" id="searchToDate" name="searchToDate" class="form-control ng-pristine ng-valid ng-empty ng-touched" value="" />
              </td>

                                                
                                                    
                                                </div></td>

           
           <td><input type="hidden" value="{{Request::segment(4)}}" id="role_id" name="role_id">
               <button class="btn btn-primary user-list-search" id="search" name="search">Search</button></td>
        </tr>
     </tbody>
  </table>
</div>
</form>

<div id="exTab3" class="tabs-userlist">



      <div class="tab-content clearfix">
        <div class="tab-pane active" id="students">
              <div class="list-blde">
          <table class="table table-bordered table-hover" id="users-table">
              <thead>
                  <tr>
                <th>Post Title</th>
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
  </div>
</section>
@endsection
@section('footer_scripts')

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script>
  $(document).ready(function(){
      $('#searchFromDate').datetimepicker({
          format: 'MM/DD/YYYY'
      });
      $('#searchToDate').datetimepicker({
          format: 'MM/DD/YYYY'
      });
      $("#searchFromDate").on("dp.change", function (e) {
          $('#searchToDate').data("DateTimePicker").minDate(e.date);
      });
      $("#searchToDate").on("dp.change", function (e) {
          $('#searchFromDate').data("DateTimePicker").maxDate(e.date);
      });
  });




  var table = '';
  $(function() {
            table = $('#users-table').DataTable({
      "ajax": {
            "url" : "/press-post-list",
          "type": "GET",
         },
      "searching": false,
      "pageLength": 10,
      "order": [[ 1, "desc" ]],
      "bLengthChange": false,

      "columns": [
          { data: 'press_title', name: 'press_title' },
          { data: 'date_format', name: 'date_format' },
          { data: 'status', name: 'status' },
          { data: 'actions', name: 'actions', orderable: false, searchable: false}
      ]
    });



    //implementing code for search functionality in ajax
   


    $("#search").click(function(){

             table.destroy();
             console.log($("#user_search").serialize());


             var pressTitle=$("input[name=pressTitle]").val();


             var searchFromDate = $("input[name=searchFromDate]").val();
             var searchToDate = $("input[name=searchToDate]").val();

        table = $('#users-table').DataTable({
        "ajax": {
              "url" : "/admin/press/search",
             "type": "POST",
             "data": {pressTitle:pressTitle, searchFromDate:searchFromDate, searchToDate:searchToDate}
           },
        "searching": false,
        "pageLength": 10,
        "order": [[ 1, "desc" ]],
        "bLengthChange": false,
        "columns": [
         { data: 'press_title', name: 'press_title' },
          { data: 'date_format', name: 'date_format' },
          { data: 'status', name: 'status', orderable: false, searchable: false},
          { data: 'actions', name: 'actions', orderable: false, searchable: false}
        ]
      });

    });


     //end of code search functionality
  });


  function changePublishStatus(id, status) {
        $.ajax({
            type: "GET",
            url: '{!! url('/admin/press/status') !!}',
            data: {'id':id,'status':status},
            dataType: 'json',
            success: function(response) {
                if(response){
                    table.ajax.reload();
                    console.log( table.row( this ).data().status );
                    $('.box-body').before('<div class="callout callout-success">Status is Updated.</div>');
                    setTimeout(function() {
                        //console.log();
                        $('.callout-success').fadeOut('fast');
                    }, 2000);

                }
            }
        });
    }

   function deletePress($id){
   
       var id=$id;

   swal({
      title: "Are you sure want to delete this Press-Post?",
                 showCancelButton: true,
                confirmButtonColor: "#DD6B55 ",
                confirmButtonText: "Yes, delete",
                closeOnConfirm: false,
                closeOnCancel: true
              },

              function(){
              url = "/admin/deletepress/"+id+"";
               window.location = url;
              });
  }

</script>
@endsection

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
    <h1>Jobs</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="active">Jobs</li>
    </ol>
    
</section>

<!-- Main content -->

<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
<h3 class="box-title press_tle"><!--@section('heading'){{$heading}}@show--></h3>
      <div class="box-tools pull-right">
              <a href="/create-job" type="button" class="btn btn-xs btn-block btn-success">@section('create')
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
           <th>Job Code</th>
           <th>Job Title</th>
           <th>Created Date From</th>
           <th>Created To Date</th>
           <th>Status</th>
        </tr>
     </thead>
     <tbody>

        <tr>
           <td><input autocomplete="off" class="form-control ng-pristine ng-valid ng-empty ng-touched" name="job_code" id="job_code" type="text"></td>

            <td><input autocomplete="off" class="form-control ng-pristine ng-valid ng-empty ng-touched" name="job_title" id="job_title" type="text"></td>


              <td>

              <input autocomplete="off" class="form-control ng-pristine ng-valid ng-empty ng-touched" name="searchFromDate"  id="searchFromDate" type="text">

              </td>

              <td>
                <input type="text" autocomplete="off"  name="searchToDate" id="searchToDate" class="form-control ng-pristine ng-valid ng-empty ng-touched" value="" />
              </td>
                <td>
                  <select name="status" id="status" class="form-control">
                    <option value="">All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>


                </td>


                                                
                                                    
                                                </div>

           
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
                <th>Job Code</th>
                <th>JOb Title</th>
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
<script src="{{ asset('/assets/admin/js/clockpicker.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript">
var table = '';
  $(function() {
            table = $('#users-table').DataTable({
      "ajax": {
            "url" : "/getalljobs",
           "type": "GET",
         },
      "searching": false,
      "pageLength": 50,
      "bLengthChange": false,
      "order": [ 2, 'DESC'],

      "columns": [
         
          { data: 'code', name: 'code' },
          { data: 'title', name: 'title' },
        { data: 'createdate', name: 'createdate' },
        { data: 'status', name: 'status' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false}
      ]
    });


          });
  $("#search").click(function(){
   
             table.destroy();
             console.log($("#user_search").serialize());


             var jobcode=$("input[name=job_code]").val();
             var jobtitle=$("input[name=job_title]").val();

            var fromdate = $("input[name=searchFromDate]").val();
             var todate = $("input[name=searchToDate]").val();
             var status=$("#status").val();
            
           table = $('#users-table').DataTable({
        "ajax": {
              "url" : "/admin/jobs/search",
             "type": "POST",
             "data": {jobcode:jobcode,jobtitle:jobtitle,fromdate:fromdate,todate:todate,status:status}
           },
        "searching": false,
        "pageLength": 50,
        "bLengthChange": false,
        "order": [ 2, 'DESC'],
        "columns": [
          { data: 'code', name: 'code' },
          { data: 'title', name: 'title' },
        { data: 'createdate', name: 'createdate' },
        { data: 'status', name: 'status' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false}
        ]
      });

    });
  function changeStatus(id, status) {

        $.ajax({
            type: "GET",
            url: '{!! url('/admin/job/status') !!}',
            data: {'id':id,'status':status},
            dataType: 'json',
            success: function(response) {
                if(response){
                    table.ajax.reload(null,false);
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
  function deleteJob($id){
   
       var id=$id;

   swal({
      title: "Are you sure want to delete this Job?", 
                 showCancelButton: true,
                confirmButtonColor: "#DD6B55 ",
                confirmButtonText: "Yes, delete",
                closeOnConfirm: false,
                closeOnCancel: true
              },

              function(){
              url = "/admin/deletejob/"+id+"";
               window.location = url;
              });
  }

  $(document).ready(function () {
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
  </script>
  

@endsection

@extends('admin.app')

@section('header_styles')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/assets/admin/css/clockpicker.css') }}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
@stop

@section('content')
<style>
.fileupload-new .btn-file {
   margin: 10px 0 0 20px;
}
</style>

<section class="content-header">
    <h1>Press Posts</h1>
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
      <!-- <h3 class="box-title">@section('heading'){{$heading}}@show</h3> -->
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
           <th>Category</th>
           <th>Created From Date</th>
           <th>Created To Date</th>
        </tr>
     </thead>
     <tbody>

        <tr>
           <td><input autocomplete="off" class="form-control ng-pristine ng-valid ng-empty ng-touched" name="pressTitle" placeholder="" type="text"></td>

              <td>
              <div class="input-group cldr">
              <select name="searchCategory" id="searchCategory" class="form-control ng-pristine ng-valid ng-empty ng-touched">
          <option value=""> All </option>
          @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->cat_name}}</option>
          @endforeach
            </select>
              </div>
              </td>


              <td>
              <div class="input-group cldr2 event-dates">
              <input autocomplete="off" class="form-control ng-pristine ng-valid ng-empty ng-touched datepicker" name="searchFromDate" placeholder="" type="text">
              </div>
              </td>

              <td><div class="input-group cldr2 event-dates">
                <input type="text" autocomplete="off"  name="searchToDate" class="form-control ng-pristine ng-valid ng-empty ng-touched datepicker" value="" />
                   
                </div></td>

                                                
                                                    
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
                <th>Categories</th>
                <th>Created Date</th>
                <th>Status</th>
                <th>Actionsd</th>
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
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src="{{ asset('/assets/admin/js/clockpicker.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>

<script>
  $( function() {
    $( ".datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "{{ asset('img/calendar.png') }}",
      buttonImageOnly: true,
      buttonText: "Select date"
    });
  } );
  </script>

<script type="text/javascript">
$(function() {



$('input[name="searchFromDate"]').datepicker();
$('input[name="searchToDate"]').datepicker();
$('input[name="searchFromDate"]').val('');
$('input[name="searchToDate"]').val('');
});
</script>

  <script>
$('.clockpicker').clockpicker();
</script>




<script type="text/javascript">
  var table = '';
  $(function() {
            table = $('#users-table').DataTable({
      "ajax": {
            "url" : "/press-post-list",
          "type": "GET",
         },
      "searching": false,
      "pageLength": 50,
      "order": [[ 2, "desc" ]],
      "bLengthChange": false,

      "columns": [
          { data: 'press_title', name: 'press_title' },
          { data: 'cat_name', name: 'cat_name' },
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

             var searchCategory=$("select[name=searchCategory]").val();


             var searchFromDate = $("input[name=searchFromDate]").val();
             var searchToDate = $("input[name=searchToDate]").val();


        table = $('#users-table').DataTable({
        "ajax": {
              "url" : "/admin/press/search",
             "type": "POST",
             "data": {pressTitle:pressTitle, searchCategory:searchCategory, searchFromDate:searchFromDate, searchToDate:searchToDate}
           },
        "searching": false,
        "pageLength": 50,
        "bLengthChange": false,
        "columns": [
         { data: 'press_title', name: 'press_title' },
          { data: 'cat_name', name: 'cat_name' },
          { data: 'date_format', name: 'date_format' },
          { data: 'status', name: 'status', orderable: false, searchable: false},
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
                    $('.box-body').before('<div class="callout callout-success">Status Updated.</div>');
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

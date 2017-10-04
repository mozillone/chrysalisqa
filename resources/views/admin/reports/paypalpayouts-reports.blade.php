@extends('admin.app')

@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/css/clockpicker.css') }}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
<style>
.fileupload-new .btn-file {
   margin: 10px 0 0 20px;
}
.btn.btn-primary.user-list-search {
    float: right;
    text-align: right;
    width: auto;
}
</style>
@stop

@section('content')


<section class="content-header">
    <h1>Seller Payouts</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="active">Seller Payouts</li>
    </ol>
    
</section>

<!-- Main content -->

<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
<h3 class="box-title press_tle"><!--@section('heading'){{$heading}}@show--></h3>

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
           <th>Customer Name</th>
           <th>Paypal Email</th>
           
           
        </tr>
     </thead>
     <tbody>

        <tr>
         


              <td>
              <input class="form-control ng-pristine ng-valid ng-empty ng-touched" name="searchCustomername"  id="searchCustomername" type="text">
              </td>

              <td><input type="text" name="searchPaypalemail" id="searchPaypalemail" class="form-control ng-pristine ng-valid ng-empty ng-touched" value="" />
                </td>
              <button class="btn btn-primary user-list-search" id="search" name="search">Search</button></td>
        </tr>
     </tbody>
  </table>
</div>
</form>

<div id="exTab3" class="tabs-userlist">
<form method="POST" action="{{route('batchpayout')}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
<button id="checkbox_submit" class="btn btn-primary user-list-search">Submit</button>

      <div class="tab-content clearfix">
        <div class="tab-pane active" id="students">
              <div class="list-blde">
          <table class="table table-bordered table-hover" id="users-table">
              <thead>
                  <tr>
                    <th></th>
                    <th>Customer Name</th>
                    <th>Paypal Email</th>
                    <th>Amount</th>
                    <th>Created at</th>
                    <th>Status</th>
                 </tr>
          </thead>
              <tbody>
          </tbody>
        </table>


      </div>
        </div>
      
      </div>
  </div>
</form>
    </div>
  </div>
</section>
@endsection
@section('footer_scripts')

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script src="{{ asset('/assets/admin/js/clockpicker.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
  <script type="text/javascript">
var table = '';
  $(function() {
            table = $('#users-table').DataTable({
      "ajax": {
            "url" : "/getpaypal",
           "type": "GET",
         },
      "searching": false,
      "pageLength": 50,
      "bLengthChange": false,
      "order": [[ 2, "desc" ]],

      "columns": [
          { data: 'checkbox', name: 'checkbox' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'amount', name: 'amount' },
          { data: 'date', name: 'date' },
          { data: 'status', name: 'status' },
          
     ]
    });


          });
  $("#search").click(function(){
   
             table.destroy();
             var searchCustomername=$("input[name=searchCustomername]").val();
             var searchPaypalemail=$("input[name=searchPaypalemail]").val();
            
           table = $('#users-table').DataTable({
        "ajax": {
              "url" : "/admin/paypal/search",
             "type": "POST",
             "data": {searchCustomername:searchCustomername,searchPaypalemail:searchPaypalemail}
           },
        "searching": false,
        "pageLength": 50,
        "bLengthChange": false,
        "columns": [
          { data: 'checkbox', name: 'checkbox' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'amount', name: 'amount' },
          { data: 'date', name: 'date' },
          { data: 'status', name: 'status' ,orderable: false, searchable: false}
        ]
      });

    });




  </script>
  

@endsection

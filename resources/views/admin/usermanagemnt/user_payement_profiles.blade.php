@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/sweetalert/dist/sweetalert.css')}}">
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
	<h1>Users</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
		</li>
		<li>
			<a href="{{url('Users-list')}}">Users List</a>
		</li>
		<li class="active"> Payment Profiles</li>
	</ol>
	
</section>
<?php
	$usersdid=Request::segment(2);
?>
<section class="content" >
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title heading-agent col-md-12">Users</h3>
				</div>
				<div class="box-body">
				<!--Tabs code starts here-->
				 <ul class="nav nav-tabs">
  <li><a  href="/customer-edit/{{$userid}}">Profile</a></li>
  <li><a href="/user-costumes-list/{{$userid}}">Costumes</a></li>
  <li><a href="/user-costumessold-list/{{$userid}}">Costumes Sold</a></li>
  <li><a  href="/user-recentorders-list/{{$userid}}">Recent Orders</a></li>
  <li><a  href="/user-credithistory-list/{{$userid}}">Credit History</a></li>
  <li class="active"><a  href="/user-payementprofiles-list/{{$userid}}">Payment Profiles</a></li>
</ul>
<!--Tab code ends here-->
				
				
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
					<fiv class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Payment Profiles</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                   
                    </div>
                </div>
                <div class="box-body">
        
          <div class="table-responsive">
          	<table class="table table-bordered table-hover" id="dtTable1">
              	<thead>
                  	<tr>
                		<th>Card Holder Name</th>
                      	<th>Card No</th>
                      	<th>Card Type</th>
                      	<th>Exp. Date</th>
                      	<th>Created Date</th>
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
    </div>
</section>
@stop


{{-- page level scripts --}}
@section('footer_scripts') 
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<script type="text/javascript">
  var table = '';
  var id = <?php echo $usersdid; ?>;
  $(function() {
            table = $('#dtTable1').DataTable({
      "ajax": {
            "url" : "{{URL::to('user/getallpaymentprofile')}}",
           "type": "GET",
           "data":{'id':id}
         },
      "searching": false,
      "pageLength": 50,
      "bLengthChange": false,
      
      "columns": [
        { data: 'cardholder_name', name: 'cardholder_name' },
        { data: 'credit_card_mask', name: 'credit_card_mask' },
        { data: 'card_type', name: 'card_type' },
        { data: 'exp_year', name: 'exp_year' },
<<<<<<< HEAD
        { data: 'date_format', name: 'date_format' },
=======
        { data: 'created_at', name: 'created_at' },
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
        { data: 'actions', name: 'actions', orderable: false, searchable: false}
      ]
    });

  }); 
   
function deleteccard($id){
        var id=$id;

    swal({
       title: "Are you sure want to delete this Card?",
                  showCancelButton: true,
                 confirmButtonColor: "#DD6B55 ",
                 confirmButtonText: "Yes, delete",
                 closeOnConfirm: false,
                 closeOnCancel: true
               },

               function(){
               url = "{{URL::to('user/deleteccard/')}}"+'/'+id;
                window.location = url;
               });


   }
</script>

@stop
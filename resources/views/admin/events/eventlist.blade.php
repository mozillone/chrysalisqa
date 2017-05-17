@extends('admin.app')
@section('content')
<h1>Events</h1>
<ol class="breadcrumb">
	<li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active">@section('breadcrumb'){{$breadcrumb}} @show</li>
</ol>
</section>
<!-- Main content -->

<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">@section('heading'){{$heading}}@show</h3>
			<div class="box-tools pull-right">
	            <a href="/admin/cms/create" type="button" class="btn btn-xs btn-block btn-success">@section('create')
           {{$create}}
       @show</a>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body ">
			<!-- <div>&nbsp;</div> -->
			 @include('admin.partials.notifications')



<div id="exTab3" class="tabs-userlist">



			<div class="tab-content clearfix">
			  <div class="tab-pane active" id="students">
          		<div class="list-blde">
			  	<table class="table table-bordered table-hover" id="users-table">
			        <thead>
			            <tr>
					     	<th>ID</th>
							<th>Cms Type</th>
			                <th>Cms Title</th>
			                <th>Country</th>
							<th>Actions</th>
			           </tr>
					</thead>
			        <tbody>
					</tbody>
				</table>


			</div>
				</div>
			<!-- 	<div class="tab-pane" id="professionals">
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
            "url" : "/admin/cms/getcms/",
	         "type": "GET",
	       },
			"searching": false,
			"pageLength": 50,
			"bLengthChange": false,

			"columns": [
			    { data: 'id', name: 'id' },
			    { data: 'slotname', name: 'slotname' },
				{ data: 'title', name: 'title' },
				{ data: 'country', name: 'country' },
				/*{ data: 'role', name: 'role' },*/



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

		function deleteCms($id){
		var id=$id;

     swal({
        title: "Are you sure want to delete this Cms?",
                  text: "You will not be able to recover this Cms",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55 ",
                  confirmButtonText: "Yes, delete",
                  closeOnConfirm: false,
                  closeOnCancel: true
                },

                function(){
                url = "/admin/cms/delete/"+id+"";
			    window.location = url;
                });


    }

</script>
@endsection

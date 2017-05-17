@extends('admin.app')

@section('header_styles')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
@stop

@section('content')
<h1>Events</h1>
<ol class="breadcrumb">
	<li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active">@section('breadcrumb'){{$breadcrumb}} @show</li>
</ol>

<!-- Main content -->

<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">@section('heading'){{$heading}}@show</h3>
			<div class="box-tools pull-right">
	            <a href="/add-event" type="button" class="btn btn-xs btn-block btn-success">@section('create')
           {{$create}}
       @show</a>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body ">
			<!-- <div>&nbsp;</div> -->
			 @include('admin.partials.notifications')

<form  method="POST" name="user_search" id="user_search" >
    {{ csrf_field() }}
    <div class="table-responsive">
  <table class="table table-striped table-bordered user-list-table">
     <thead>
        <tr>
           <th>Event Name</th>
           <th>Event From</th>
           <th>Event To</th>
           <th>City</th>
        </tr>
     </thead>
     <tbody>

        <tr>
           <td><input autocomplete="off" class="form-control ng-pristine ng-valid ng-empty ng-touched" name="searchEventName" placeholder="" type="text"></td>

           		<td>
           		<div class="input-group cldr2 event-dates">
           		<input autocomplete="off" class="form-control ng-pristine ng-valid ng-empty ng-touched datepicker" name="searchFromDate" placeholder="" type="text">
           		</div>
           		</td>


           		<td><div class="input-group cldr2 event-dates">
              	<input type="text" autocomplete="off"  name="searchToDate" class="form-control ng-pristine ng-valid ng-empty ng-touched datepicker" value="" />
                   
              	</div></td>

                                                
                                                    
                                                </div></td>

           <td>
              <select name="searchState" id="searchState" class="form-control ng-pristine ng-valid ng-empty ng-touched">
                 <option value=""> Select State </option>
          @foreach($users as $user)
          <option value="{{$user->name}}">{{ $user->name }}</option>
          @endforeach
              </select>
           </td>
          
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
					     	<th>Event Name</th>
							<th>Suggested By</th>
			                <th>Event Start Time</th>
			                <th>Event End Time</th>
							<th>Created Date</th>
							<th>Approved?</th>
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
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
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


<script type="text/javascript">
	var table = '';
	$(function() {
            table = $('#users-table').DataTable({
			"ajax": {
            "url" : "/events-fetch",
	        "type": "GET",
	       },
			"searching": false,
			"pageLength": 50,
			"bLengthChange": false,

			"columns": [
			    { data: 'event_name', name: 'event_name' },
			    { data: 'display_name', name: 'display_name' },
				{ data: 'from_time', name: 'from_time' },
				{ data: 'to_time', name: 'to_time' },
				{ data: 'created_at', name: 'created_at' },
				{ data: 'approved', name: 'approved' },


				{ data: 'actions', name: 'actions', orderable: false, searchable: false}
			]
		});

		//implementing code for search functionality in ajax
   


		$("#search").click(function(){

             table.destroy();
             console.log($("#user_search").serialize());


             var searchEventName=$("input[name=searchEventName]").val();
             var searchFromDate=$("input[name=searchFromDate]").val();
             var searchToDate=$("input[name=searchToDate]").val();
             var searchState=$("#searchState option:selected").val();
             

				table = $('#users-table').DataTable({
				"ajax": {
	            "url" : "/admin/event/search",
		         "type": "POST",
		         "data": {searchEventName:searchEventName, searchFromDate:searchFromDate, searchToDate:searchToDate, searchState:searchState}
		       },
				"searching": false,
				"pageLength": 50,
				"bLengthChange": false,
				"order": [ [3, 'desc'] ],
				"columns": [
					{ data: 'event_name', name: 'event_name' },
			    	{ data: 'display_name', name: 'display_name' },
					{ data: 'from_time', name: 'from_time' },
					{ data: 'to_time', name: 'to_time' },
					{ data: 'created_at', name: 'created_at' },
					{ data: 'approved', name: 'approved' },
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

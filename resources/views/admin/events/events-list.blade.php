@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

{{-- page level styles --}}
@section('header_styles')
	<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
	<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
	<link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
@stop

{{-- Page content --}}
@section('content')
	<section class="content-header">
		<h1>Events</h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a>
			</li>
			<li class="active">Events List</li>
		</ol>
	</section>
	<section class="content">
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
						<h3 class="box-title">Events List</h3>
						<div class="box-tools pull-right" style="display:inline-flex">
							<a href="{{URL::to('/add-event')}}" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i>Add Event</a>
						</div>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<thead>
									<th>Event Name</th>
									<th>From</th>
									<th>To</th>
									<th>City</th>
									<th></th>
								</thead>
								<tbody>
								<tr>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<td><input type="text" class="form-control" id="event-name"></td>
									<td><input type="text" class="form-control" id="from-date"></td>
									<td><input type="text" class="form-control" id="to-date"></td>
									<td><input type="text" class="form-control" id="city"></td>
									<td><button class="btn btn-primary" id="search-events">Search</button></td>
								</tr>
								</tbody>
							</table>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-hover" id="event-list-table">
								<thead>
								<tr>
									<th>Event Name</th>
									<th>Suggested By</th>
									<th>Start Time</th>
									<th>End Time</th>
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
	<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
	<script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
	<script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>

	<script type="text/javascript">

		$(document).ready(function () {
            $('#from-date').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('#to-date').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $("#from-date").on("dp.change", function (e) {
                $('#to-date').data("DateTimePicker").minDate(e.date);
            });
            $("#to-date").on("dp.change", function (e) {
                $('#from-date').data("DateTimePicker").maxDate(e.date);
            });
        });

        var table = '';

        $(function () {

            table = $('#event-list-table').DataTable({
                "ajax": {
                    "url" : "/events-fetch",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 4, "desc" ]],

                "columns": [
                    { data: 'event_name', name: 'event_name' },
                    { data: 'display_name', name: 'display_name' },
                    { data: 'from', name: 'from' },
                    { data: 'to', name: 'to' },
                    { data: 'date_format', name: 'date_format' },
                    { data: 'status', name: 'status' },


                    { data: 'actions', name: 'actions', orderable: false, searchable: false}
                ]
            });

            $("#search-events").click(function(){

                table.destroy();

                var eventName = $("#event-name").val();
                var fromDate = $("#from-date").val();
                var toDate = $("#to-date").val();
                var city = $("#city").val();

                table = $('#event-list-table').DataTable({
                    "ajax": {
                        "url" : "/admin/event/search",
                        "type": "POST",
                        "data": {eventName:eventName,fromDate:fromDate,toDate:toDate,city:city}
                    },
                    "searching": false,
                    "pageLength": 10,
                    "bLengthChange": false,
                    "order": [ [3, 'desc'] ],
                    "columns": [
                        { data: 'event_name', name: 'event_name' },
                        { data: 'display_name', name: 'display_name' },
                        { data: 'from_time', name: 'from_time' },
                        { data: 'to_time', name: 'to_time' },
                        { data: 'date_format', name: 'date_format' },
                        { data: 'status', name: 'status' },
                        { data: 'actions', name: 'actions', orderable: false, searchable: false}
                    ]
                });

            });

        });

        function changeStatus(id, status) {

            $.ajax({
                type: "GET",
                url: '{!! url('/admin/events/status') !!}',
                data: {'id':id,'status':status},
                dataType: 'json',
                success: function(response) {
                    if(response){
                        table.ajax.reload(null,false);
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

        function deleteEvent($id){

            var id=$id;

            swal({
                    title: "Are you sure want to delete this Event-Post?",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55 ",
                    confirmButtonText: "Yes, delete",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },

                function(){
                    url = "/admin/deleteevent/"+id+"";
                    window.location = url;
                });
        }

	</script>

@stop
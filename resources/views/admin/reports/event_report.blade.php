@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/buttons.dataTables.min.css')}}">
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Reports</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">Event Report</li>
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
                        <h3 class="box-title">Event Report</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>Event Name</th>
                                <th>User Name</th>
                                <th>Created From</th>
                                <th>Created To</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="eventName" id="event-name"></td>
                                    <td><input type="text" class="form-control" name="username" id="username"></td>
                                    <td><input type="text" class="form-control" id="fromDate" name="fromDate"></td>
                                    <td><input type="text" class="form-control" id="toDate" name="toDate"></td>
                                    <td><button class="btn btn-primary" id="search-events">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="events-list-table">
                                <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Suggested By User</th>
                                    <th>Link</th>
                                    <th>Created Date</th>
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
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript">

        $(function () {
            $('#fromDate').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('#toDate').datetimepicker({
                format: 'MM/DD/YYYY'
            });
        });

        var table = '';
        $(function() {
            table = $('#events-list-table').DataTable({
                "ajax": {
                    "url" : "get-all-events",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 0, "desc" ]],
                "columns": [
                    { data: 'event_name', name: 'event_name'},
                    { data: 'display_name', name: 'display_name'},
                    { data: 'event_url',name:'event_url'},
                    { data: 'created_at',name:'created_at'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Event Report',
                        text: 'Export Excel'
                    }
                ],
            });


        });

        $("#search-events").click(function(){
            table.destroy();

            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var eventName = $('#event-name').val();
            var userName = $('#username').val();

            table = $('#events-list-table').DataTable({
                "ajax": {
                    "url" : "search-events",
                    "type": "GET",
                    "data": {from_date:fromDate, to_date:toDate, event_name:eventName, user_name:userName}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [0, 'desc'] ],
                "columns": [
                    { data: 'event_name', name: 'event_name'},
                    { data: 'display_name', name: 'display_name'},
                    { data: 'event_url',name:'event_url'},
                    { data: 'created_at',name:'created_at'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Event Report',
                        text: 'Export Excel'
                    }
                ],
            });

        });

    </script>

@stop
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
        <h1>Content Management System</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">Blocks</li>
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
                        <h3 class="box-title">Blocks</h3>
                        <div class="box-tools pull-right" style="display:inline-flex">
                            <a href="{{URL::to('/add-cms-block')}}" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add Block</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>Block Title</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <td><input type="text" class="form-control" id="title"></td>
                                    <td><input type="text" class="form-control" id="fromDate"></td>
                                    <td><input type="text" class="form-control" id="toDate"></td>
                                    <td>
                                        <select class="form-control" id="block-status">
                                            <option defualt value=""> All </option>
                                            <option value="enabled">Enabled</option>
                                            <option value="disabled">Disabled</option>
                                        </select>
                                    </td>
                                    <td><button class="btn btn-primary" id="search-blocks">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="blocks-list-table">
                                <thead>
                                <tr>
                                    <th>Block Title</th>
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

        $(function () {
            $('#fromDate').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('#toDate').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $("#fromDate").on("dp.change", function (e) {
                $('#toDate').data("DateTimePicker").minDate(e.date);
            });
            $("#toDate").on("dp.change", function (e) {
                $('#fromDate').data("DateTimePicker").maxDate(e.date);
            });
        });

        function changeBlockStatus(id, status) {
            $.ajax({
                type: "POST",
                url: '{!! url('change-block-status') !!}',
                data: {'id':id,'status':status},
                dataType: 'JSON',
                success: function(response) {
                    if(response){
                        table.ajax.reload(null,false);
                    }
                }
            });
        }
        var table = '';
        $(function() {
            table = $('#blocks-list-table').DataTable({
                "ajax": {
                    "url" : "get-all-blocks",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 1, "desc" ]],
                "columns": [
                    { data: 'title', name: 'title'},
                    { data: 'created',name:'created'},
                    { data: 'status', name: 'status'},
                    { data:'actions', name:'actions'}
                ]
            });


        });

        $("#search-blocks").click(function(){

            table.destroy();

            var blockTitle = $('#title').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var blockStatus = $('#block-status').val();

            table = $('#blocks-list-table').DataTable({
                "ajax": {
                    "url" : "block-search",
                    "type": "GET",
                    "data": {title:blockTitle, from_date:fromDate, to_date:toDate,status:blockStatus}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [1, 'desc'] ],
                "columns": [
                    { data: 'title', name: 'title'},
                    { data: 'created',name:'created'},
                    { data: 'status', name: 'status'},
                    { data:'actions', name:'actions'}
                ]
            });

        });

    </script>

@stop
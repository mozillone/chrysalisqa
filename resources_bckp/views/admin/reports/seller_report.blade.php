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
            <li class="active">Top Seller Report</li>
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
                        <h3 class="box-title">Top Seller Report</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>Purchased From</th>
                                <th>Purchased To</th>
                                <th>Sales Type</th>
                                <th>Category Name</th>
                                <th>User Name</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" id="fromDate" name="fromDate"></td>
                                    <td><input type="text" class="form-control" id="toDate" name="toDate"></td>
                                    <td>
                                        <select class="form-control" id="sales-type" name="salesType">
                                            <option defualt value="">All</option>
                                            <option value="t-10">Top 10 Sales</option>
                                            <option value="t-100">Top 100 Sales</option>
                                            <option value="w-10">Worst 10 Sales</option>
                                            <option value="w-100">Worst 100 Sales</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" id="category" name="category">
                                            <option defualt value="">All</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="username" id="username"></td>
                                    <td><button class="btn btn-primary" id="search-sellers">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="sellers-list-table">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th># Of Sales</th>
                                    <th>Transaction Amount</th>
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
            $("#fromDate").on("dp.change", function (e) {
                $('#toDate').data("DateTimePicker").minDate(e.date);
            });
            $("#toDate").on("dp.change", function (e) {
                $('#fromDate').data("DateTimePicker").maxDate(e.date);
            });
        });

        var table = '';
        $(function() {
            table = $('#sellers-list-table').DataTable({
                "ajax": {
                    "url" : "get-all-sales",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 0, "desc" ]],
                "columns": [
                    { data: 'username', name: 'username'},
                    { data: 'total_sales', name: 'total_sales'},
                    { data: 'transaction_amt',name:'transaction_amt'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Top Seller Report',
                        text: 'Export Excel'
                    }
                ],
            });


        });

        $("#search-sellers").click(function(){
            table.destroy();

            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var salesType = $('#sales-type').val();
            var category = $('#category').val();
            var username = $('#username').val();

            table = $('#sellers-list-table').DataTable({
                "ajax": {
                    "url" : "search-sellers",
                    "type": "GET",
                    "data": {from_date:fromDate, to_date:toDate, sales_type:salesType, category:category,username:username}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [0, 'desc'] ],
                "columns": [
                    { data: 'username', name: 'username'},
                    { data: 'total_sales', name: 'total_sales'},
                    { data: 'transaction_amt',name:'transaction_amt'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Top Seller Report',
                        text: 'Export Excel'
                    }
                ],
            });

        });

    </script>

@stop
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
            <li class="active">Charity Report</li>
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
                        <h3 class="box-title">Charity Report</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>Charity Name</th>
                                <th>Transaction From</th>
                                <th>Transaction To</th>
                                <th>Transaction Amount From</th>
                                <th>Transaction Amount To</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" id="charity-name" name="charityName"></td>
                                    <td><input type="text" class="form-control" id="fromDate" name="fromDate"></td>
                                    <td><input type="text" class="form-control" id="toDate" name="toDate"></td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="text" class="form-control" name="tranAmtFrom" id="tran-amt-from">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="text" class="form-control" name="tranAmtTo" id="tran-amt-to">
                                        </div>
                                    </td>
                                    <td><button class="btn btn-primary" id="search-charities">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="charities-list-table">
                                <thead>
                                <tr>
                                    <th>Charity Name</th>
                                    <th>User Name</th>
                                    <th>Order #</th>
                                    <th>Amount</th>
                                    <th>Transaction Date</th>
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
            table = $('#charities-list-table').DataTable({
                "ajax": {
                    "url" : "get-all-charities",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 1, "desc" ]],
                "columns": [
                    { data: 'charity_name', name: 'charity_name'},
                    { data: 'user_name', name: 'user_name'},
                    { data: 'order_id',name:'order_id'},
                    { data: 'charity_amount',name:'charity_amount'},
                    { data: 'transaction_date',name:'transaction_date'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Charity Report',
                        text: 'Export Excel'
                    }
                ],
            });


        });

        $("#search-charities").click(function(){
            table.destroy();

            var charityName = $('#charity-name').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var tranAmtFrm = $('#tran-amt-from').val();
            var tranAmtTo = $('#tran-amt-to').val();

            table = $('#charities-list-table').DataTable({
                "ajax": {
                    "url" : "search-charities",
                    "type": "GET",
                    "data": {charity_name:charityName,from_date:fromDate, to_date:toDate,tran_amt_frm:tranAmtFrm,tran_amt_to:tranAmtTo}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [0, 'desc'] ],
                "columns": [
                    { data: 'charity_name', name: 'charity_name'},
                    { data: 'user_name', name: 'user_name'},
                    { data: 'order_id',name:'order_id'},
                    { data: 'charity_amount',name:'charity_amount'},
                    { data: 'transaction_date',name:'transaction_date'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Charity Report',
                        text: 'Export Excel'
                    }
                ],
            });

        });

    </script>

@stop
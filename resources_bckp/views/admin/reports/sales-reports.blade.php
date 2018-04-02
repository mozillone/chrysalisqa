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
            <li class="active">Revenue Report</li>
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
                        <h3 class="box-title">Revenue Report</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>Revenue Range</th>
                                <th>Transaction From</th>
                                <th>Transaction To</th>
                                <th>User Name</th>
                                <th>Costume Name</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control" id="revenue-range" name="revenueRange">
                                            <option value="">Select Range</option>
                                            <option value="0-100">$0 to $100</option>
                                            <option value="101-200">$101 to $200</option>
                                            <option value="201-300">$201 to $300</option>
                                            <option value="301-400">$301 to $400</option>
                                            <option value="401-500">$401 to $500</option>
                                            <option value="500">Above $500</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" id="fromDate" name="fromDate"></td>
                                    <td><input type="text" class="form-control" id="toDate" name="toDate"></td>
                                    <td><input type="text" class="form-control" id="username" name="username"></td>
                                    <td><input type="text" class="form-control" id="product-name" name="productName"></td>
                                    <td><button class="btn btn-primary" id="search-transaction">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="transaction-list-table">
                                <thead>
                                <tr>
                                    <th>Transaction #</th>
                                    <th>Transaction Date</th>
                                    <th>User Name</th>
                                    <th>Transaction Amount</th>
                                    <th>Shipping Amount</th>
                                    <th>Payment Type</th>
                                    <th>Costume Name</th>
                                    <th>Category Name</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th colspan="3" style="text-align:right">Total:</th>
                                    <th></th>
                                </tr>
                                </tfoot>
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
            table = $('#transaction-list-table').DataTable({
                "ajax": {
                    "url" : "/getrevenues",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 1, "desc" ]],
                "columns": [
                    { data: 'transcactionid', name: 'transcactionid' },
                    { data: 'transaction_date', name: 'transaction_date' },
                    { data: 'username', name: 'username' },
                    { data: 'amount', name: 'amount' },
                    { data: 'shippingamount', name: 'shippingamount' },
                    { data: 'type', name: 'type' },
                    { data: 'costumes', name: 'costumes' },
                    { data: 'category', name: 'category' },
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Revenue Report',
                        text: 'Export Excel'
                    }
                ],
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            parseInt(i.replace(/[\$.]/g, '')*1)/100 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 3, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( 3 ).footer() ).html(
                        '$'+pageTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") +' (All Records: $'+ total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") +')'
                    );
                }
            });


        });

        $("#search-transaction").click(function(){
            table.destroy();
            var revenueRange = $('#revenue-range').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var username = $('#username').val();
            var productName = $('#product-name').val();

            table = $('#transaction-list-table').DataTable({
                "ajax": {
                    "url" : "/search-revenue",
                    "type": "GET",
                    "data": {revenue_range:revenueRange,from_date:fromDate, to_date:toDate,username:username,product_name:productName}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [1, 'desc'] ],
                "columns": [
                    { data: 'transcactionid', name: 'transcactionid' },
                    { data: 'transaction_date', name: 'transaction_date' },
                    { data: 'username', name: 'username' },
                    { data: 'amount', name: 'amount' },
                    { data: 'shippingamount', name: 'shippingamount' },
                    { data: 'type', name: 'type' },
                    { data: 'costumes', name: 'costumes' },
                    { data: 'category', name: 'category' },
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Revenue Report',
                        text: 'Export Excel'
                    }
                ],
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            parseInt(i.replace(/[\$.]/g, '')*1)/100 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 3, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( 3 ).footer() ).html(
                        '$'+pageTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") +' (All Records: $'+ total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") +')'
                    );
                }
            });

        });

    </script>

@stop
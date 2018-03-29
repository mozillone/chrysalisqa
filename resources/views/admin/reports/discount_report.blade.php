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
            <li class="active">Discounts Report</li>
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
                        <h3 class="box-title">Discounts Report</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>Discount Amount From</th>
                                <th>Discount Amount To</th>
                                <th>Transaction Amount From</th>
                                <th>Transaction Amount To</th>
                                <th>Transaction From</th>
                                <th>Transaction To</th>
                                <th>Promo Code</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="text" class="form-control" name="disAmtFrom" id="dis-amt-from">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="text" class="form-control" name="disAmtTo" id="dis-amt-to">
                                        </div>
                                    </td>
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
                                    <td><input type="text" class="form-control" id="fromDate" name="fromDate"></td>
                                    <td><input type="text" class="form-control" id="toDate" name="toDate"></td>
                                    <td><input type="text" class="form-control" id="promo-code" name="promoCode"></td>
                                    <td><button class="btn btn-primary" id="search-discounts">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="discounts-list-table">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Order #</th>
                                    <th>Order Amount</th>
                                    <th>Discount</th>
                                    <th>Promo Code</th>
                                    <th>Promo Type</th>
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
            table = $('#discounts-list-table').DataTable({
                "ajax": {
                    "url" : "get-all-discounts",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 1, "desc" ]],
                "columns": [
                    { data: 'display_name', name: 'display_name'},
                    { data: 'order_id', name: 'order_id'},
                    { data: 'total',name:'total'},
                    { data: 'discount',name:'discount'},
                    { data: 'promo_code',name:'promo_code'},
                    { data: 'type',name:'type'},
                    { data: 'created_at',name:'created_at'},
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Discounts Report',
                        text: 'Export Excel'
                    }
                ],
            });


        });

        $("#search-discounts").click(function(){
            table.destroy();

            var disAmtFrm = $('#dis-amt-from').val();
            var disAmtTo = $('#dis-amt-to').val();
            var transAmtFrm = $('#tran-amt-from').val();
            var transAmtTo = $('#tran-amt-to').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var promoCode = $('#promo-code').val();

            table = $('#discounts-list-table').DataTable({
                "ajax": {
                    "url" : "search-discounts",
                    "type": "GET",
                    "data": {dis_amt_frm:disAmtFrm, dis_amt_to:disAmtTo, tran_amt_frm:transAmtFrm, tran_amt_to:transAmtTo,from_date:fromDate, to_date:toDate, promo_code:promoCode}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [0, 'desc'] ],
                "columns": [
                    { data: 'display_name', name: 'display_name'},
                    { data: 'order_id', name: 'order_id'},
                    { data: 'total',name:'total'},
                    { data: 'discount',name:'discount'},
                    { data: 'promo_code',name:'promo_code'},
                    { data: 'type',name:'type'},
                    { data: 'created_at',name:'created_at'},
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Discounts Report',
                        text: 'Export Excel'
                    }
                ],
            });

        });

    </script>

@stop
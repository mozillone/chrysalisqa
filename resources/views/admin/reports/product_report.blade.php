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
            <li class="active">Product Report</li>
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
                        <h3 class="box-title">Product Report</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Created From</th>
                                    <th>Created To</th>
                                    <th>User Name</th>
                                    <th>Weight From</th>
                                    <th>Weight To</th>
                                    <th>Cosplay</th>
                                    <th>Condition</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" id="fromDate" name="fromDate"></td>
                                    <td><input type="text" class="form-control" id="toDate" name="toDate"></td>
                                    <td><input type="text" class="form-control" name="userName" id="user-name"></td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="weightFrom" id="weight-from">
                                            <span class="input-group-addon" id="basic-addon1">lbs</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="weightTo" id="weight-to">
                                            <span class="input-group-addon" id="basic-addon1">lbs</span>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-control" id="cosplay" name="cosplay">
                                            <option value="">All</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" id="condition" name="condition">
                                            <option value="">All</option>
                                            <option value="excellent">Excellent</option>
                                            <option value="brand_new">Brand New</option>
                                            <option value="good">Good</option>
                                            <option value="like_new">Like New</option>
                                        </select>
                                    </td>
                                    <td><button class="btn btn-primary" id="search-products">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="product-list-table">
                                <thead>
                                <tr>
                                    <th>Costume Name</th>
                                    <th>Weight</th>
                                    <th>Dimensions</th>
                                    <th>Cosplay</th>
                                    <th>Condition</th>
                                    <th>Price</th>
                                    <th>Customer Name</th>
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
            table = $('#product-list-table').DataTable({
                "ajax": {
                    "url" : "get-all-products",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 1, "desc" ]],
                "columns": [
                    { data: 'name', name: 'name'},
                    { data: 'weight', name: 'weight'},
                    { data: 'dimensions',name:'dimensions'},
                    { data: 'cosplay',name:'cosplay'},
                    { data: 'condition',name:'condition'},
                    { data: 'price',name:'price'},
                    { data: 'display_name',name:'display_name'},
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Product Report',
                        text: 'Export Excel'
                    }
                ],
            });


        });

        $("#search-products").click(function(){
            table.destroy();

            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var userName = $('#user-name').val();
            var weightFrom = $('#weight-from').val();
            var weightTo = $('#weight-to').val();
            var cosplay = $('#cosplay').val();
            var condition = $('#condition').val();

            table = $('#product-list-table').DataTable({
                "ajax": {
                    "url" : "search-products",
                    "type": "GET",
                    "data": {from_date:fromDate, to_date:toDate, user_name:userName, weight_from:weightFrom,weight_to:weightTo,cosplay:cosplay, condition:condition}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [0, 'desc'] ],
                "columns": [
                    { data: 'name', name: 'name'},
                    { data: 'weight', name: 'weight'},
                    { data: 'dimensions',name:'dimensions'},
                    { data: 'cosplay',name:'cosplay'},
                    { data: 'condition',name:'condition'},
                    { data: 'price',name:'price'},
                    { data: 'display_name',name:'display_name'},
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Product Report',
                        text: 'Export Excel'
                    }
                ],
            });

        });

    </script>

@stop
@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
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
            <li class="active">Users Report</li>
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
                        <h3 class="box-title">Users Report</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>Revenue Range</th>
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
                                    <td><button class="btn btn-primary btn-block" id="search-users">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="users-list-table">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Total Revenue</th>
                                    <th>Total Shipping</th>
                                    <th>Total Print Labels</th>
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
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript">

        var table = '';
        $(function() {
            table = $('#users-list-table').DataTable({
                "ajax": {
                    "url" : "get-all-users",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 1, "desc" ]],
                "columns": [
                    { data: 'display_name', name: 'display_name'},
                    { data: 'revenue', name: 'revenue'},
                    { data: 'shipping_amnt',name:'shipping_amnt'},
                    { data: 'total_prints',name:'total_prints'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Users Report',
                        text: 'Export Excel'
                    }
                ],
            });


        });

        $("#search-users").click(function(){
            table.destroy();

            var revenueRange = $('#revenue-range').val();

            table = $('#users-list-table').DataTable({
                "ajax": {
                    "url" : "search-users",
                    "type": "GET",
                    "data": {revenue_range:revenueRange}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [0, 'desc'] ],
                "columns": [
                    { data: 'display_name', name: 'display_name'},
                    { data: 'revenue', name: 'revenue'},
                    { data: 'shipping_amnt',name:'shipping_amnt'},
                    { data: 'total_prints',name:'total_prints'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Users Report',
                        text: 'Export Excel'
                    }
                ],
            });

        });

    </script>

@stop
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
            <li class="active">Cost Report</li>
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
                        <h3 class="box-title">Cost Report</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>User Name</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="userName" id="user-name"></td>
                                    <td><button class="btn btn-primary btn-block" id="search-costs">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="costs-list-table">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Transaction Fees</th>
                                    <th>Donations</th>
                                    <th># Of Costumes</th>
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
            table = $('#costs-list-table').DataTable({
                "ajax": {
                    "url" : "get-all-costs",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 1, "desc" ]],
                "columns": [
                    { data: 'display_name', name: 'display_name'},
                    { data: 'trans_amount', name: 'trans_amount'},
                    { data: 'charity_amnt',name:'charity_amnt'},
                    { data: 'costumes',name:'costumes'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Cost Report',
                        text: 'Export Excel'
                    }
                ],
            });


        });

        $("#search-costs").click(function(){
            table.destroy();

            var userName = $('#user-name').val();

            table = $('#costs-list-table').DataTable({
                "ajax": {
                    "url" : "search-costs",
                    "type": "GET",
                    "data": {user_name:userName}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [0, 'desc'] ],
                "columns": [
                    { data: 'display_name', name: 'display_name'},
                    { data: 'trans_amount', name: 'trans_amount'},
                    { data: 'charity_amnt',name:'charity_amnt'},
                    { data: 'costumes',name:'costumes'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Cost Report',
                        text: 'Export Excel'
                    }
                ],
            });

        });

    </script>

@stop
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
        <h1>FAQs</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">FAQs</li>
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
                        <h3 class="box-title">FAQs</h3>
                        <div class="box-tools pull-right" style="display:inline-flex">
                            <a href="{{URL::to('add-faqs')}}" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add FAQs</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>FAQ Title</th>
                                <th>Block</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" id="title"></td>
                                    <td>
                                        <select class="form-control" id="faq-block" name="block">
                                            <option defualt value=""> All </option>
                                            <option value="how-it-works">How It Works</option>
                                            <option value="support-and-contact">Support And Contact</option>
                                            <option value="sell-a-costume">Sell A Costume</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" id="fromDate"></td>
                                    <td><input type="text" class="form-control" id="toDate"></td>
                                    <td>
                                        <select class="form-control" id="faq-status">
                                            <option defualt value=""> All </option>
                                            <option value="enabled">Enabled</option>
                                            <option value="disabled">Disabled</option>
                                        </select>
                                    </td>
                                    <td><button class="btn btn-primary" id="search-faqs">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="faqs-list-table">
                                <thead>
                                <tr>
                                    <th>FAQ Title</th>
                                    <th>FAQ Block</th>
                                    <th>Sort No.</th>
                                    <th>Created At</th>
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

        function changeFaqStatus(id, status) {
            $.ajax({
                type: "POST",
                url: '{!! url('change-faq-status') !!}',
                data: {'id':id,'status':status},
                dataType: 'JSON',
                success: function(response) {
                    if(response){
                        table.ajax.reload();
                    }
                }
            });
        }
        var table = '';
        $(function() {
            table = $('#faqs-list-table').DataTable({
                "ajax": {
                    "url" : "get-all-faqs",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 3, "desc" ]],
                "columns": [
                    { data: 'title', name: 'title'},
                    { data: 'block', name: 'block'},
                    { data: 'sort_no', name: 'sort_no'},
                    { data: 'created',name:'created'},
                    { data: 'status', name: 'status'},
                    { data:'actions', name:'actions'}
                ]
            });


        });

        function deleteFaq(faqId){

            swal({
                    title: "Are you sure want to delete this Page?",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55 ",
                    confirmButtonText: "Yes, delete",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },

                function(){
                    url = "/delete-faq/"+faqId+"";
                    window.location = url;
                });


        }

        $("#search-faqs").click(function(){
            table.destroy();

            var faqTitle = $('#title').val();
            var block = $('#faq-block').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var faqStatus = $('#faq-status').val();

            table = $('#faqs-list-table').DataTable({
                "ajax": {
                    "url" : "/faq-search",
                    "type": "GET",
                    "data": {title:faqTitle, block:block, from_date:fromDate, to_date:toDate,status:faqStatus}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [3, 'desc'] ],
                "columns": [
                    { data: 'title', name: 'title'},
                    { data: 'block', name: 'block'},
                    { data: 'sort_no', name: 'sort_no'},
                    { data: 'created',name:'created'},
                    { data: 'status', name: 'status'},
                    { data:'actions', name:'actions'}
                ]
            });

        });

    </script>

@stop
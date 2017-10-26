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
            <li class="active">Blog Report</li>
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
                        <h3 class="box-title">Blog Report</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>Post Name</th>
                                <th>Description Contains</th>
                                <th>Category Name</th>
                                <th>Tags</th>
                                <th>Posted From</th>
                                <th>Posted To</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="postName" id="post-name"></td>
                                    <td><input type="text" class="form-control" name="descContent" id="desc-content"></td>
                                    <td>
                                        <select class="form-control" id="category-id" name="categoryId">
                                            <option value="">All</option>
                                            @foreach($blogCategories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="tags" id="tags"></td>
                                    <td><input type="text" class="form-control" id="fromDate" name="fromDate"></td>
                                    <td><input type="text" class="form-control" id="toDate" name="toDate"></td>
                                    <td><button class="btn btn-primary" id="search-blog">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="blog-list-table">
                                <thead>
                                <tr>
                                    <th>Post Name</th>
                                    <th>Created Date</th>
                                    <th>Categories</th>
                                    <th>Tags</th>
                                    <th>Posted By</th>
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
            table = $('#blog-list-table').DataTable({
                "ajax": {
                    "url" : "get-all-blog",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 1, "desc" ]],
                "columns": [
                    { data: 'title', name: 'title'},
                    { data: 'created_at', name: 'created_at'},
                    { data: 'category',name:'category'},
                    { data: 'tags',name:'tags'},
                    { data: 'posted_by',name:'posted_by'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Blog Report',
                        text: 'Export Excel'
                    }
                ],
            });


        });

        $("#search-blog").click(function(){
            table.destroy();

            var postName = $('#post-name').val();
            var descContent = $('#desc-content').val();
            var categoryId = $('#category-id').val();
            var tags = $('#tags').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();

            table = $('#blog-list-table').DataTable({
                "ajax": {
                    "url" : "search-blog",
                    "type": "GET",
                    "data": {post_name:postName,desc_content:descContent,category_id:categoryId, tags:tags,from_date:fromDate, to_date:toDate}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [0, 'desc'] ],
                "columns": [
                    { data: 'title', name: 'title'},
                    { data: 'created_at', name: 'created_at'},
                    { data: 'category',name:'category'},
                    { data: 'tags',name:'tags'},
                    { data: 'posted_by',name:'posted_by'}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Blog Report',
                        text: 'Export Excel'
                    }
                ],
            });

        });

    </script>

@stop
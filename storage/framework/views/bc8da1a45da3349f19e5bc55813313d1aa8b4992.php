<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>Content Management System</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">Pages</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo e(Session::get('error')); ?>

                    </div>
                <?php elseif(Session::has('success')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo e(Session::get('success')); ?>

                    </div>
                <?php endif; ?>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pages</h3>
                        <div class="box-tools pull-right" style="display:inline-flex">
                            <a href="<?php echo e(URL::to('add-cms-page')); ?>" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add Page</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>Page Title</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <td><input type="text" class="form-control" id="title"></td>
                                    <td><input type="text" class="form-control" id="fromDate"></td>
                                    <td><input type="text" class="form-control" id="toDate"></td>
                                    <td>
                                        <select class="form-control" id="page-status">
                                            <option defualt value=""> All </option>
                                            <option value="1">Enabled</option>
                                            <option value="0">Disabled</option>
                                        </select>
                                    </td>
                                    <td><button class="btn btn-primary" id="search-page">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="pages-list-table">
                                <thead>
                                <tr>
                                    <th>Page Title</th>
                                    <th>Page URL</th>
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


<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('#fromDate').on('keydown', function (e) {
                e.preventDefault();
            });
            $('#toDate').on('keydown', function (e) {
                e.preventDefault();
            });
        });

        $(function () {
            $('#fromDate').datetimepicker({
                format: 'MM-DD-YYYY',
                defaultDate: new Date()
            });
            $('#toDate').datetimepicker({
                format: 'MM-DD-YYYY',
                defaultDate: new Date()
            });
        });

        function changePageStatus(id, status) {
            $.ajax({
                type: "POST",
                url: '<?php echo url('change-page-status'); ?>',
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
            table = $('#pages-list-table').DataTable({
                "ajax": {
                    "url" : "get-all-pages",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 25,
                "bLengthChange": false,

                "columns": [
                    { data: 'title', name: 'title'},
                    { data: 'url', name: 'url'},
                    { data: 'created',name:'created'},
                    { data: 'status', name: 'status'},
                    { data:'actions', name:'actions'}
                ]
            });


        });

        function deletePage(pageId){

            swal({
                    title: "Are you sure want to delete this Page?",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55 ",
                    confirmButtonText: "Yes, delete",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },

                function(){
                    url = "/delete-page/"+pageId+"";
                    window.location = url;
                });


        }

        $("#search-page").click(function(){

            table.destroy();

            var pageTitle = $('#title').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var pageStatus = $('#page-status').val();

            table = $('#pages-list-table').DataTable({
                "ajax": {
                    "url" : "page-search",
                    "type": "GET",
                    "data": {title:pageTitle, from_date:fromDate, to_date:toDate,status:pageStatus}
                },
                "searching": false,
                "pageLength": 50,
                "bLengthChange": false,
                "order": [ [3, 'desc'] ],
                "columns": [
                    { data: 'title', name: 'title'},
                    { data: 'url', name: 'url'},
                    { data: 'created',name:'created'},
                    { data: 'status', name: 'status'},
                    { data:'actions', name:'actions'}
                ]
            });

        });

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
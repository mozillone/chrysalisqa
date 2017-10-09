<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>Blog Posts</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">Posts</li>
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
                        <h3 class="box-title">Posts</h3>
                        <div class="box-tools pull-right" style="display:inline-flex">
                            <a href="<?php echo e(URL::to('add-blog-post')); ?>" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add Blog Post</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>Title</th>
                                <th>Category</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Posted By</th>
                                <th>Status</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <td><input type="text" class="form-control" id="title"></td>
                                    <td>
                                        <select class="form-control" id="post-category">
                                            <option value="">Select Category</option>
                                            <?php $__currentLoopData = $blogCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" id="fromDate"></td>
                                    <td><input type="text" class="form-control" id="toDate"></td>
                                    <td>
                                        <select class="form-control" id="posted-by">
                                            <option defualt value=""> All </option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" id="post-status">
                                            <option defualt value=""> All </option>
                                            <option value="enabled">Enabled</option>
                                            <option value="disabled">Disabled</option>
                                        </select>
                                    </td>
                                    <td><button class="btn btn-primary" id="search-posts">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="blog-post-table">
                                <thead>
                                <tr>
                                    <th>Blog Title</th>
                                    <th>Posted By</th>
                                    <th>Category</th>
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

        function changeBlogStatus(id, status) {
            $.ajax({
                type: "POST",
                url: '<?php echo url('change-blog-status'); ?>',
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
            table = $('#blog-post-table').DataTable({
                "ajax": {
                    "url" : "get-all-blog-posts",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 3, "desc" ]],
                "columns": [
                    { data: 'title', name: 'title'},
                    { data: 'display_name', name: 'display_name'},
                    { data: 'category', name: 'category'},
                    { data: 'created_at',name:'created_at'},
                    { data: 'status', name: 'status'},
                    { data:'actions', name:'actions'}
                ]
            });


        });

        function deleteBlogPost(pageId){

            swal({
                    title: "Are you sure want to delete this blog post?",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55 ",
                    confirmButtonText: "Yes, delete",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },

                function(){
                    url = "/delete-blog-post/"+pageId+"";
                    window.location = url;
                });


        }

        $("#search-posts").click(function(){

            table.destroy();

            var postTitle = $('#title').val();
            var category = $('#post-category').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var postedBy = $('#posted-by').val();
            var postStatus = $('#post-status').val();

            table = $('#blog-post-table').DataTable({
                "ajax": {
                    "url" : "blog-post-search",
                    "type": "GET",
                    "data": {title:postTitle, category:category,from_date:fromDate, to_date:toDate, posted_by:postedBy, status:postStatus}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [3, 'desc'] ],
                "columns": [
                    { data: 'title', name: 'title'},
                    { data: 'display_name', name: 'display_name'},
                    { data: 'category', name: 'category'},
                    { data: 'created_at',name:'created_at'},
                    { data: 'status', name: 'status'},
                    { data:'actions', name:'actions'}
                ]
            });

        });

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
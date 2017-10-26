<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/css/buttons.dataTables.min.css')); ?>">
    <style type="text/css">
        #dtTable tr>th:first-child{
            display: none;
        }
        #dtTable tr>td:first-child{
            display: none;
        }
    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>Users</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">Users</li>
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
                        <h3 class="box-title">Users List</h3>
                        <div class="box-tools pull-right" style="display:inline-flex">
                            <a href="customer-add" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add User</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Is Seller?</th>
                                <th>Status</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <td><input type="text" class="form-control" name="user_name" id="user-name"></td>
                                    <td><input type="text" class="form-control" name="email" id="email"></td>
                                    <td>
                                        <select name="is_seller" class="form-control" id="is-seller">
                                            <option value=""> All </option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="status" class="form-control" id="status">
                                            <option value=""> All </option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </td>
                                    <td><button class="btn btn-primary" id="search-user">Search</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="users-list-table">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Is Seller?</th>
                                        <th>Last Login Time</th>
                                        <th>Credit</th>
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
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script>

        function changeUserStatus(id, status) {
            $.ajax({
                type: "POST",
                url: '<?php echo url('/status/change'); ?>',
                data: {'id':id,'status':status},
                dataType: 'JSON',
                success: function(response) {
                    if(response){
                        table.ajax.reload();
                    }
                }
            });
        }

        function deleteUser(userId){

            swal({
                    title: "Are you sure want to delete this user?",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55 ",
                    confirmButtonText: "Yes, delete",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },

                function(){
                    url = "/customer-delete/"+userId+"";
                    window.location = url;
                });


        }

        var table = '';
        $(function() {
            table = $('#users-list-table').DataTable({
                "ajax": {
                    "url" : "customers/list",
                    "type": "GET",
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [[ 5, "desc" ]],
                "columns": [
                    { data: 'user_name', name: 'user_name'},
                    { data: 'email', name: 'email'},
                    { data: 'is_seller',name:'is_seller'},
                    { data: 'last_login', name: 'last_login'},
                    { data:'credits', name:'credits'},
                    { data:'created_at', name:'created_at'},
                    { data:'active', name:'active'},
                    { data:'actions', name:'actions'},
                ],
                dom: 'Bfrtip',
                buttons: [{
                    extend:'csv',
                    exportOptions:{
                        columns: [0,1,2,3,4,5]
                    },
                    title: 'Users List'
                }
                ]
            });


        });

        $("#search-user").click(function(){

            table.destroy();

            var userName = $('#user-name').val();
            var email = $('#email').val();
            var isSeller = $('#is-seller').val();
            var status = $('#status').val();

            table = $('#users-list-table').DataTable({
                "ajax": {
                    "url" : "customers-search",
                    "type": "GET",
                    "data": {user_name:userName, email:email, is_seller:isSeller, status:status}
                },
                "searching": false,
                "pageLength": 10,
                "bLengthChange": false,
                "order": [ [5, 'desc'] ],
                "columns": [
                    { data: 'user_name', name: 'user_name'},
                    { data: 'email', name: 'email'},
                    { data: 'is_seller',name:'is_seller'},
                    { data: 'last_login', name: 'last_login'},
                    { data:'credits', name:'credits'},
                    { data:'created_at', name:'created_at'},
                    { data:'active', name:'active'},
                    { data:'actions', name:'actions'},
                ],
                dom: 'Bfrtip',
                buttons: [{
                    extend:'csv',
                    exportOptions:{
                        columns: [0,1,2,3,4,5]
                    },
                    title: 'Users List'
                }
                ]
            });

        });

        $(document).ready(function () {

        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
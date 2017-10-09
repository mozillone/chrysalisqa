<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
 <section class="content-header">
    <h1>Support</h1>
    <ol class="breadcrumb">
    <li>
        <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Support Users</li>
  </ol>
</section>
<section class="content" ng-controller="CostumesController">
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
                </div>
                <form  method="post" name="user_search" id="user_search" action="javascript:void(0);">
                 
                <div class="box-body">
        <div class="table-responsive">
               
               </form>
        </div>
     
          <div class="table-responsive">
          <!-- <table datatable dt-options="dtOptions" dt-columns="dtColumns"
                        class="table table-bordered table-hover table-striped" id="dtTable">
          </table> -->
          <table class="table table-bordered table-hover" id="tickets-table">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone # </th>
                      <th>Is Seller?  </th>
                      <th> Last Login Time</th>
                      <th>Credit</th>
                      <th>Created Date</th>
                     
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
<script src="<?php echo e(asset('angular/Admin/UserManagement/Controllers/users-lists.js')); ?>"></script>
<script src="<?php echo e(asset('angular/Admin/UserManagement/Services/user_management.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>


<script type="text/javascript">
  /*****Datatables For Listing Code Starts Here****/ 
  var table = '';
  $(function() {
            table = $('#tickets-table').DataTable({
      "ajax": {
            "url" : "getallsupportusers",
           "type": "GET",
         },
      "searching": true,
      "pageLength": 25,
      "bLengthChange": false,
      
      "columns": [
        { data: 'display_name', name: 'display_name'},
        { data: 'email', name: 'email'},
        { data: 'phone_number', name: 'phone_number'},
        { data: 'isseller', name: 'isseller'},
        { data: 'date_format', name: 'date_format'},
        { data: 'credit', name: 'credit'},
        {data:'date_format',name:'date_format'}
        
      ]
    });


  }); 
  /********Change Status Code Starts Here***/
  function ticketStatus(id, status) {
    alert();
        $.ajax({
            type: "GET",
            url: '<?php echo url('changeticketstatus'); ?>',
            data: {'id':id,'status':status},
            dataType: 'json',
            success: function(response) {
                if(response){
                    table.ajax.reload();
                }
            }
        });
  }
  /*********Delete Ticket Code starts here****/
  function deletTicket($id){
        var id=$id;

    swal({
       title: "Are you sure want to delete this Ticket?",
                  showCancelButton: true,
                 confirmButtonColor: "#DD6B55 ",
                 confirmButtonText: "Yes, delete",
                 closeOnConfirm: false,
                 closeOnCancel: true
               },

               function(){
               url = "/deleteticket/"+id+"";
                window.location = url;
               });
   }
  /********Search Functionality Code starts here****/
   $("#search").click(function(){
   
      table.destroy();
      console.log($("#user_search").serialize());
      var keyword=$("input[name=keyword]").val();
      alert(keyword); 
      var name=$("input[name=customername]").val();
      var type=$("input[name=ticket_type]").val();
      var status=$("input[name=status]").val();
      var token=$('#token').val();
     table = $('#tickets-table').DataTable({
        "ajax": {
          "url" : "admin/support/search",
          "type": "POST",
          "data": {keyword:keyword,name:name,type:type,status:status}
        },
        "searching": false,
        "pageLength": 50,
        "bLengthChange": false,
        "order": [ [3, 'desc'] ],
        "columns": [
        { data: 'ticketid', name: 'ticketid'},
        { data: 'customer_name', name: 'customer_name'},
        { data: 'type', name: 'type'},
        { data: 'orderid', name: 'orderid'},
        { data: 'createdate', name: 'createdate'},
        { data: 'status', name: 'status'},
        { data: 'actions', name: 'actions'}
        ]
      });
      
    });

</script>

<?php $__env->stopSection(); ?>































<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
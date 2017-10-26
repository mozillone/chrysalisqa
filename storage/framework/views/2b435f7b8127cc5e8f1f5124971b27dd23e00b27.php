<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
 <section class="content-header">
    <h1>Manage Requests</h1>
    <ol class="breadcrumb">
    <li>
        <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Manage Request Bags</li>
  </ol>
</section>
<!-- Main content -->

<section class="content">
  <div class="box box-default">
    
    <!-- /.box-header -->
    <div class="box-body ">
      <!-- <div>&nbsp;</div> -->


 
<div id="exTab3" class="tabs-userlist"> 



      <div class="tab-content clearfix">
        <div class="tab-pane active" id="students">
              <div class="list-blde">
          <table class="table table-bordered table-hover" id="users-table">
              <thead>
                  <tr>
                <th>Ref #</th>
                      <th>Customer Name</th>
                      <th>Request Date</th>
                      <th>PayOut</th>
                      <th>Return Assurance</th>
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
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
<script type="text/javascript">
  var table = '';
  $(function() {
            table = $('#users-table').DataTable({
      "ajax": {
            "url" : "getallmanagebags",
           "type": "GET",
         },
      "searching": false,
      "pageLength": 50,
      "bLengthChange": false,
      "order": [ 2, 'DESC'],
      
      "columns": [
        { data: 'ref_no', name: 'ref_no' },
        { data: 'cus_name', name: 'cus_name' },
        { data: 'date', name: 'date' },
        { data: 'is_payout', name: 'is_payout' },
        { data: 'is_return', name: 'is_return' },
        { data: 'status', name: 'status' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false}
      ],
      columnDefs : [
        { targets : [3],
          render : function (data, type, row) {
            switch(data) {
               case '1' : return 'Y'; break;
               case '0' : return 'N'; break;
               default  : return 'N/A';
            }
          }
        },
        { targets : [4],
          render : function (data, type, row) {
            switch(data) {
               case '1' : return 'Y'; break;
               case '0' : return 'N'; break;
               default  : return 'N/A';
            }
          }
        }
      ]
    });

  }); 
   

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
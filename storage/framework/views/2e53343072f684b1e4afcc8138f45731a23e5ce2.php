<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/sweetalert/dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<section class="content-header">
	<h1>Users</h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
		</li>
		<li>
			<a href="<?php echo e(url('Users-list')); ?>">Users List</a>
		</li>
		<li class="active">
			Costumes List
		</li>
		
	</ol>
	
</section>
<?php
	$usersdid=Request::segment(2);
?>
<section class="content" >
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title heading-agent col-md-12">Users</h3>
				</div>
				<div class="box-body">
				<!--Tabs code starts here-->
				  <ul class="nav nav-tabs">
  <li ><a  href="/customer-edit/<?php echo e($userid); ?>">Profile</a></li>
  <li class="active" ><a href="/user-costumes-list/<?php echo e($userid); ?>">Costumes</a></li>
  <li><a href="/user-costumessold-list/<?php echo e($userid); ?>">Costumes Sold</a></li>
  <li><a  href="/user-recentorders-list/<?php echo e($userid); ?>">Recent Orders</a></li>
  <li><a  href="/user-credithistory-list/<?php echo e($userid); ?>">Credit History</a></li>
  <li><a  href="/user-payementprofiles-list/<?php echo e($userid); ?>">Payment Profiles</a></li>
</ul>
<!--Tab code ends here-->
				
				
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
					<fiv class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Users List</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                   
                    </div>
                </div>
                <div class="box-body">
        
          <div class="table-responsive">
          <table class="table table-bordered table-hover" id="dtTable1">
              	<thead>
                  	<tr>
                		<th>Costume Name</th>
						<th>Catgeory</th>
						<th>Condition</th>
						<th>Qty. Available</th>
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
<script type="text/javascript">
  var table = '';
  var id = <?php echo $usersdid; ?>;
  $(function() {
            table = $('#dtTable1').DataTable({
      "ajax": {
            "url" : "<?php echo e(URL::to('user/getallusercostumes')); ?>",
           "type": "GET",
           "data":{'id':id}
         },
      "searching": false,
      "pageLength": 50,
      "bLengthChange": false,
      
      "columns": [
        { data: 'cos_name', name: 'cos_name' },
        { data: 'cat_name', name: 'cat_name' },
        { data: 'cos_condition', name: 'cos_condition' },
        { data: 'cos_qan', name: 'cos_qan' },
        { data: 'date_format', name: 'date_format' },
        { data: 'cos_status', name: 'cos_status' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false}
      ]
    });

  }); 

  function deletecostume($id){
        var id=$id;

    swal({
       title: "Are you sure want to delete this Costume?",
                  showCancelButton: true,
                 confirmButtonColor: "#DD6B55 ",
                 confirmButtonText: "Yes, delete",
                 closeOnConfirm: false,
                 closeOnCancel: true
               },

               function(){
               url = "/deletecostume/"+id+"";
                window.location = url;
               });


   }
   
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
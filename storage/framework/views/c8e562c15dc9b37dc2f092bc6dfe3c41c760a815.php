<?php $__env->startSection('title'); ?> @parent
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
 <section class="content-header">
    <h1>Specialty Theme Categories</h1>
    <ol class="breadcrumb">
    <li>
        <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Speciality Theme Categories</li>
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
                    <h3 class="box-title">Specialty Themes Settings</h3>
                </div>
                
                 
                <div class="box-body">
        <div class="table-responsive">
               
               
        </div>
     
          <div class="table-responsive">
          <!-- <table datatable dt-options="dtOptions" dt-columns="dtColumns"
                        class="table table-bordered table-hover table-striped" id="dtTable">
          </table> -->
           <form name="update_priority_new" id="update_priority_new" method="post" action="/update_priority" >
              <?php echo e(csrf_field()); ?>

          <table class="table table-bordered table-hover" id="tickets-table">
              <thead>
                  <tr>
                      <th>Category Name</th>
                      <th>Priority </th>
                    
                      
                     
                 </tr>
          </thead>
              <tbody>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                 <tr>
                      <td><?php echo e($category->name); ?></td>
                     <input type="hidden" name="categoryid[]"   id="categoryid" class="form-control" style="width:30%" value="<?php echo e($category->id); ?>">
                      <td><input type="text" name="priority[]" id="priority" class="form-control priorities" style="width:30%" value="<?php echo e($category->priority); ?>"></td>
                     
                    
                     
                 </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                 <tr>
                  <td></td>
                  <td  colspan="3"><input type="submit" name="submit" id="submit" value="Update Priority" class="btn btn-primary "></td>
                  </tr>
          </tbody>
        </table>
      </form>
          </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/admin/js/pages/speciality_theme.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
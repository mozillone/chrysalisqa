<?php $__env->startSection('title'); ?>
Attributes edit@parent
<?php $__env->stopSection(); ?>



<?php $__env->startSection('header_styles'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>Attributes</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="<?php echo e(route('attributes-list')); ?>">Attributes List</a>
        </li>
        
        <li class="active">edit <?php echo e($attributes_data[0]->label); ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title col-md-12 heading-agent">Edit <?php echo e($attributes_data[0]->label); ?></h3>
                </div>
                <div class="box-body">
                    <form id="attribute-edit" class="form-horizontal defult-form" name="userForm" action="<?php echo e(route('attribute-edit')); ?>" method="POST" novalidate autocomplete="off">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
                        <input type="hidden" name="id" value="<?php echo e($attributes_data[0]->attribute_id); ?>"> 
                        <div class="col-md-6">
                           <div class="col-md-12">
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Name<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter attribute name"  name="name" id="name" value="<?php echo e($attributes_data[0]->label); ?>">
                                    <p class="error"><?php echo e($errors->first('name')); ?></p> 
                                </div>
                                 <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Code<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter attribute code"  name="code" id="name" value="<?php echo e($attributes_data[0]->code); ?>">
                                    <p class="error"><?php echo e($errors->first('code')); ?></p> 
                                </div>
                                 <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Type<span class="req-field" >*</span></label>
                                        <select class="form-control" id="sel1" name="type">
                                            <option value="">--Select--</option>
                                            <option value="text" <?php if($attributes_data[0]->type=="text"): ?> selected <?php endif; ?>>Text</option>
                                            <option value="checkbox" <?php if($attributes_data[0]->type=="checkbox"): ?> selected <?php endif; ?>>Checkbox</option>
                                            <option value="radio" <?php if($attributes_data[0]->type=="radio"): ?> selected <?php endif; ?>>Radio</option>
                                            <option value="select" <?php if($attributes_data[0]->type=="select"): ?> selected <?php endif; ?>>Select</option>
                                            <option value="textarea" <?php if($attributes_data[0]->type=="textarea"): ?> selected <?php endif; ?>>Text Area</option>
                                       </select>
                                    <p class="error"><?php echo e($errors->first('type')); ?></p> 
                                </div>
                            </div> 
                        </div>
                        </div>
                    </div> 
                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="<?php echo e(route('attributes-list')); ?>" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary pull-right">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript">
 $("#attribute-edit").validate({
            rules: {
                name:{
                        required: true,
                        maxlength: 50
                    },
                code:{
                        required: true,
                        maxlength: 50
                    },
                type:{
                        required: true
                    },
                }
    
        });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
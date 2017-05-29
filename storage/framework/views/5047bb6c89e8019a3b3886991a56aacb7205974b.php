<?php $__env->startSection('title'); ?>
Edit <?php echo e($data['basic'][0]->name); ?> Promotion @parent
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/vendors/jquery-ui/themes/base/jquery-ui.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/jquery-ui/themes/base/sortable.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')); ?>">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>Edit <?php echo e($data['basic'][0]->name); ?> Promotion</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="<?php echo e(route('promotions-list')); ?>">Promotions List</a>
        </li>
        
        <li class="active">Edit <?php echo e($data['basic'][0]->name); ?> Promotion</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title col-md-12 heading-agent">Edit <?php echo e($data['basic'][0]->name); ?> Promotion</h3>
                </div>
                <div class="box-body">
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
                    <!-- <form class="form-horizontal" ng-submit="save(userForm.$valid, data)" name="userForm" > --> 
                    <form id="promotions-create" class="form-horizontal defult-form" name="userForm" action="<?php echo e(route('promotion-edit')); ?>" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
                        <input type="hidden" name="coupon_id" value="<?php echo e($data['basic'][0]->coupon_id); ?>"> 
                        <div class="col-md-12">
                            <h4>Basic Information</h4>
                            <hr>
                            <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Promotion Name <span class="req-field" >*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter promotion name"  name="name" id="name" value="<?php echo e($data['basic'][0]->name); ?>">
                                        <p class="error"><?php echo e($errors->first('name')); ?></p> 
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Promotion Code</label>
                                            <input type="text" class="form-control" placeholder="Enter promotion code"  name="code" id="code" value="<?php echo e($data['basic'][0]->code); ?>">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Discount Type <span class="req-field" >*</span></label>
										<div class="row_pregt radio-btn-align">
                                            <div class="radio col-md-4">
                                                <input type="radio" value="percentage" name="type" <?php if($data['basic'][0]->type=="percentage"): ?> checked <?php endif; ?>>Percentage</label>
                               
                                            </div>
											  <div class="radio col-md-4">
                                              
                                                <input type="radio" value="flat"  name="type" <?php if($data['basic'][0]->type=="flat"): ?> checked <?php endif; ?>>Flat Amount</label>
                                            </div>
											  </div>
											
									
                                          <p class="error"><?php echo e($errors->first('type')); ?></p> 
                                    </div>
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Discount <span class="req-field" >*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter discount"  name="discount" id="discount" value="<?php echo e((int)$data['basic'][0]->discount); ?>">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Applied From <span class="req-field" >*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="date_start" id="date_start" value="<?php echo e($data['basic'][0]->datestart); ?>"> 
                                            <span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
                                        </div>
                                    </div>
                                   <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Applied Till <span class="req-field" >*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="date_end" id="date_end" value="<?php echo e($data['basic'][0]->dateend); ?>">
                                            <span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Maximum Uses</label>
                                            <input type="text" class="form-control" placeholder="Enter maximum uses"  name="uses_total" id="uses_total" value="<?php echo e($data['basic'][0]->uses_total); ?>">
                                    </div>
                                </div> 
                            <div class="col-md-6">
                             <div class="col-md-12 cupn_catries">
                                <h4>Coupon Categories</h4>
						
                                    <hr>
                                     <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Category List</label>
                                              <select class="form-control" id="cats">
                                                <option value="">--Select--</option>
                                                <?php $__currentLoopData = $cats_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cats): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <option value="<?php echo e($cats->category_id); ?>"><?php echo e($cats->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            </select>
                                           <a href="javascript::void(0);" class="add_cat btn btn-primary">+Add</a>
                                    </div>
                                     <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Selected Categories</label>
                                         <select multiple class="form-control"  name="cats[]" id="cats_list">
                                        <?php $__currentLoopData = $data['promo_cats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cats): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($cats->category_id); ?>" selected><?php echo e($cats->parent_cat); ?>-<?php echo e($cats->sub_cat); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                        </select>
										            
                                        <span>Note: Select the category and click on Remove button to remove the category from the list</span><br>
                                        <a href="javascript::void(0);" class="remove_cat btn btn-danger">-Remove</a>
                            
                                    </div>
								
                                </div>
                                  <div class="col-md-12">
                                <h4>Coupon Products</h4>
                                    <hr>
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Product</label>
                                        <input type="text" class="form-control" placeholder="Enter category name"  name="products_list" id="products_list">
                                        <input type="hidden"  id="cst_name">
                                        <input type="hidden"  id="products_id">
                                        <input type="hidden"  id="sku_no">
										<span>Note: Type the product name to autopopulate</span>
										     <br>
                                        <a href="javascript::void(0);" class="add-prod btn btn-primary">+Add</a>
                                   
                                        
                                    </div>

                                     <div class="form-group has-feedback">
                                        <label for="inputEmail3" class="control-label">Selected Products</label>
                                        <select multiple class="form-control" name="costumes[]" id="costumes">
                                        <?php $__currentLoopData = $data['promo_costumes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $csts): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($csts->costume_id); ?>" selected><?php echo e($csts->sku_no); ?>-<?php echo e($csts->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                        <a href="javascript::void(0);" class="remove_product btn btn-danger">-Remove</a>
                                    
                                        <span>Note: Select the product and click on Remove button to remove the product from the list</span>
                                    </div>
                                </div>
                                </div> 
                            </div>
                    </div> 
                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="/promotions" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                            <a  href="javascript::void(0);" class="btn btn-primary pull-right submit">Update</a>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
<script src ="<?php echo e(asset('/vendors/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/moment.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/admin/js/pages/promotions.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
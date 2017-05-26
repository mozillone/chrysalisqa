<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<section class="create_section_page edit_profile_page_pop">
    <div class="container create-list-tldiv">
      <div class="row creat_listings">
      
    <div class="row list-frm">
        <div class="col-md-12 col-sm-12 col-xs-12 edit_profile_filds">
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
        <form  id="edit_customer" class="form-horizontal defult-form" action="<?php echo e(route('edit-profile')); ?>" method="POST" novalidate enctype="multipart/form-data" >
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="col-md-6">
              <h2 class="heading-agent">Personal Info</h2>
              <div class="col-md-12">
                <div class="row"> 
                  <div class="col-md-12">
                    <input type="hidden" ng-model="data.id">
                    <div class="form-group">
                      <label for="inputEmail3" class="control-label">First Name<span class="req-field" >*</span></label>
                      <input autofocus="autofocus" type="text" class="form-control" value="<?php echo e(Auth::user()->first_name); ?>"  name="first_name" placeholder="First Name" id="first_name">
                      <p class="error"><?php echo e($errors->first('first_name')); ?></p>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="form-group" >
                      <label for="inputEmail3" class="control-label">Last Name<span class="req-field" >*</span></label>
                      <input type="text" class="form-control" value="<?php echo e(Auth::user()->last_name); ?>" name="last_name" placeholder="Last Name" id="last_name">
                      <p class="error"><?php echo e($errors->first('last_name')); ?></p>
                    </div>
                  </div>
                </div>
                </div> 
              </div>
            
            <div class="col-md-6">
              <h2 class="heading-agent">Login Info</h2>
              <div class="col-md-12">
                <div class="form-group has-feedback" >
                  <label for="inputEmail3" class="control-label">Email<span class="req-field" >*</span></label>
                  <div class="input-group">
                    <input type="text" value="<?php echo e(Auth::user()->email); ?>" class="form-control" placeholder="Email" name="email" id="email">
                    <span class="input-group-addon glyphicon glyphicon-envelope" id="basic-addon2" style="position:static;"></span>
                  </div>
                  <p class="error"><?php echo e($errors->first('email')); ?></p> 
                </div>
                
                <div class="form-group has-feedback edit_pswrd">
                  <label for="inputEmail3" class="control-label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    <span class="input-group-btn">
                      <button id="pwd_shw" class="btn btn-default" type="button" style="background-color: #fff;">
                        <span class="glyphicon glyphicon-eye-open"></span>
                      </button>
                    </span>
                  </div> 
                  <p class="error"><?php echo e($errors->first('password')); ?></p> 
                </div> 
              </div>
            </div>
            <div class="col-md-12">
              <h2 class="heading-agent">Profile Image</h2>
              <div class="col-md-12">
                <div class="form-group">
                  
                  <div class="fileupload fileupload-new" data-provides="fileupload"> 
                    <img  <?php if(empty(Auth::user()->user_img)): ?> src="<?php echo e(asset('/img/default.png')); ?>" <?php else: ?> src="/profile_img/<?php echo e(Auth::user()->user_img); ?>" <?php endif; ?> class="img-pview img-responsive" id="img-chan" name="img-chan">
                    <span class="remove_pic">
                      <i class="fa fa-times-circle" aria-hidden="true"></i>
                    </span>
				<div class="row upload_bx">
				<div class="col-md-8 col-sm-10 col-xs-12">
					<div class=" upload_btns">
                    <span class=" btn-file">
                      <span class="fileupload-exists"></span>     
                      <input id="profile_logo" name="avatar" type="file" placeholder="Profile Image" class="form-control">
                      <input type="hidden" name="is_removed"/>
						</span> 
						</div>
                    <p class="noteices-text">Note: The file could not be exceed above 3MB and allowed .JPG, .JPEG, .PNG formats only.</p>
					</div>
					</div>
                    <span class="fileupload-preview"></span>
                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
                  </div>
                  <p class="error"><?php echo e($errors->first('avatar')); ?></p> 
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <div class="pull-right">
              <button type="submit" class="btn btn-primary pull-right update_btn">Update</button>
            </div>
          </div>
        </form>
        </div>
      </div>
      </div>
      </div>
</section>
       
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('/assets/admin/js/pages/customers.js')); ?>"></script>
<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
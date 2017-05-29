<?php $__env->startSection('title'); ?>
<?php echo e($title); ?>@parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<section class="content-header">
	<h1>Profile</h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
		</li>
		<li class="active"><?php echo e(Auth::user()->display_name); ?> Edit</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title heading-agent col-md-12">Edit Profile</h3>
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
					<form  id="edit_customer" class="form-horizontal defult-form" action="<?php echo e(route('admin-profile-update')); ?>" method="POST" novalidate enctype="multipart/form-data" >
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
						<input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
						<div class="col-md-6">
							<h2 class="heading-agent">Personal Info</h2>
							<div class="col-md-12">
								<div class="row"> 
									<div class="col-md-6" >
										<input type="hidden" ng-model="data.id">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">First Name<span class="req-field" >*</span></label>
											<input autofocus="autofocus" type="text" class="form-control" value="<?php echo e(Auth::user()->first_name); ?>"  name="first_name" placeholder="First Name" id="first_name">
											<p class="error"><?php echo e($errors->first('first_name')); ?></p>
										</div>
									</div>
									<div class="col-sm-12 col-md-6">
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
								
								<div class="form-group has-feedback">
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
						<div class="col-md-6">
							<h2 class="heading-agent">Profile Image</h2>
							<div class="col-md-12">
								<div class="form-group">
									<label for="inputEmail3" class="control-label image-label">Upload</label>
									
									<div class="fileupload fileupload-new" data-provides="fileupload"> 
										<img  <?php if(empty($user->user_img)): ?> src="<?php echo e(asset('/img/default.png')); ?>" <?php else: ?> src="/profile_img/<?php echo e($user->user_img); ?>" <?php endif; ?> class="img-pview img-responsive" id="img-chan" name="img-chan">
										<span class="remove_pic">
											<i class="fa fa-times-circle" aria-hidden="true"></i>
										</span>
										<span class="btn btn-default btn-file">
											<span class="fileupload-new">Upload Photo</span>
											<span class="fileupload-exists"></span>     
											<input id="profile_logo" name="avatar" type="file" placeholder="Profile Image" class="form-control">
											<input type="hidden" name="is_removed"/>
										</span> 
										<p class="noteices-text">Note: The file could not be exceed above 3MB and allowed .JPG, .JPEG, .PNG formats only.</p>
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
							<a href="/customers-list" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
							<button type="submit" class="btn btn-primary pull-right">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('footer_scripts'); ?>
	<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
	<script src="<?php echo e(asset('/assets/admin/js/pages/customers.js')); ?>"></script>
	<script src="<?php echo e(asset('/vendors/sweetalert/dist/sweetalert.min.js')); ?>"></script>
	<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
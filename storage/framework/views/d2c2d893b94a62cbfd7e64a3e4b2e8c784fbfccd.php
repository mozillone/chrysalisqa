	
	<?php $__env->startSection('title'); ?>
		Login
	    @parent
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('styles'); ?>
	<?php $__env->stopSection(); ?>
	<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="row">
	        <div class="col-md-12">
				<div class="login-register-main" id="loginModal">
					<ul class="nav nav-tabs">
	                    <li class="active"><a href="#login_tab" data-toggle="tab">Sign In</a></li>
	                    <li><a href="#signup_tab" data-toggle="tab" id="signup1_tab">Register</a></li>
	                    <li class="hide"><a href="#forget_password" data-toggle="tab">Reset Password</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="login-social">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<a class="btn btn-primary social-login-btn social-facebook" href="<?php echo e(route('social.login', ['facebook'])); ?>"><i class="fa fa-facebook" aria-hidden="true"></i> Log In With Facebook</a>
								</div>


		<div class="clearfix">
		</div>
							<div class="form-group or text-center">
									<p>Or</p>
								</div>

								<div class="col-md-12 col-sm-12 col-xs-12 text-center cnt_with">
									<p>Connect With Email</p>
								</div>
								</div>
						</div>
	                    <div class="tab-pane active in" id="login_tab">
							<?php if(Session::has('error')): ?>
				            <div class="alert alert-danger alert-dismissable">
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
								<?php echo e(Session::get('error')); ?>

							</div>
				            <?php elseif(Session::has('success')): ?>
							<div class="alert alert-success alert-dismissable">
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
								<?php echo e(Session::get('success')); ?>

							</div>
							<?php endif; ?>
							<form  action="<?php echo e(route('login.post')); ?>" method="POST" id="login">
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<div class="form-group">
								<label>Email</label>
									<input type="text" id="login_email" name="email"  class="form-control">
									<p class="error"><?php echo e($errors->first('email')); ?></p>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" id="login_password" name="password"  class="form-control">
									<p class="error"><?php echo e($errors->first('password')); ?></p>
								</div>
								<div class="form-group">
									<div class=" text-right rect_pswrd">
										<a href="#forget_password" data-toggle="tab" >Reset Password</a>
									</div>
								</div>
								<div class="form-group">
									<div class="text-center">
										<button class="btn btn-primary">Log In</button>
									</div>
								</div>
							</form>
						</div>
	                    <div class="tab-pane fade" id="signup_tab">
							<form role="form" action="<?php echo e(route('register')); ?>" method="POST" id="signup">
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
	        	    			<div class="row">
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				    					<label>First Name </label>
				                			<input type="text" name="first_name" id="first_name" class="form-control input-sm"   <?php if(!empty(Session::get('social_data'))): ?> value="<?=explode(" ", Session::get('social_data')['name'])[0];?>" <?php endif; ?>>
				                			<p class="error"><?php echo e($errors->first('first_name')); ?></p>
										</div>
									</div>
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				    					<label>Last Name </label>
				    						<input type="text" name="last_name" id="last_name" class="form-control input-sm"  <?php if(!empty(Session::get('social_data'))): ?> value="<?=explode(" ", Session::get('social_data')['name'])[1];?>" <?php endif; ?>>
				    						<p class="error"><?php echo e($errors->first('last_name')); ?></p>
										</div>
									</div>
								</div>
				    			<div class="form-group">
				    			<label>Email </label>
				    				<input type="text" name="email" id="signup_email" class="form-control input-sm" <?php if(!empty(Session::get('social_data'))): ?> value="<?php echo e(Session::get('social_data')['email']); ?>" <?php endif; ?>>
		    						<p class="error"><?php echo e($errors->first('email')); ?></p>
								</div>
				    			<div class="row">
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				    					<label>Create Password </label>
											<input type="password" name="password" id="signup_password" class="form-control input-sm" placeholder=" *">
											<p class="error"><?php echo e($errors->first('password')); ?></p>
										</div>
									</div>
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				    						<label>Confirm Password </label>
				    						<input type="password"  id="cpassword" name="cpassword" class="form-control input-sm">
										</div>
									</div>
								</div>
								<div class="form-group">
		                            <div class="text-center">
										<button class="btn btn-primary">Create Account!</button>
									</div>
								</div>
							</form>
						</div>
	                    <div class="tab-pane fade" id="forget_password">
							<?php if(Session::has('error')): ?>
				            <div class="alert alert-danger alert-dismissable">
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
								<?php echo e(Session::get('error')); ?>

							</div>
				            <?php elseif(Session::has('success')): ?>
							<div class="alert alert-success alert-dismissable">
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
								<?php echo e(Session::get('success')); ?>

							</div>
							<?php endif; ?>
							<form class="" action="<?php echo e(route('forgotpassword.post')); ?>" method="POST" id="forgotpassword">
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<div class="form-group">
									<input type="text" id="forgot_email" name="email" placeholder="Email" class="form-control">
									<p class="error"><?php echo e($errors->first('email')); ?></p>
								</div>
								<div class="form-group">
									<div class="text-center reset_psrd">
										<button class="btn btn-primary">Reset Password</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('footer_scripts'); ?>
	<script src="<?php echo e(asset('/assets/frontend/js/pages/login.js')); ?>"></script>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
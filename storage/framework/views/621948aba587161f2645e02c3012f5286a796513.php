<?php $promo = helper::getPromo();?>
<section class="top_nav_div">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
                <?php echo ((isset($promo->description) && !empty($promo->description)) ? $promo->description : ''); ?>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="top_nav">
					<ul>
						
				  		<li><a href="<?php echo e(URL::to('contact-support')); ?>">Support & Contact </a></li>
				  		
				  		 <?php if(!count(Auth::user())): ?>

					     <li class="dropdown"><a href="javascript:void(0);" class="signup_popup">| <i class="fa fa-user" aria-hidden="true"></i> Sign In</a></li>
					     <?php else: ?>
								<li class="dropdown">
								 <?php if(!count(Auth::user())): ?>
							     	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">| <i class="fa fa-user" aria-hidden="true"></i> Sign In</a>
							     <?php else: ?>
							     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							        | <i class="fa fa-user" aria-hidden="true"></i> My Account<i class="fa fa-sort-desc" aria-hidden="true"></i>
                              </a>
							     <?php endif; ?>
									   <ul class="dropdown-menu">
										<li><a href="<?php echo e(URL::to('dashboard')); ?>">Dashboard</a></li>
									<li><a href="<?php echo e(URL::to('logout')); ?>">Logout</a></li>
									</ul>
								</li>
					
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<<<<<<< HEAD
<?php $promo = helper::getPromo();?>
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
<section class="top_nav_div">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
<<<<<<< HEAD
                <?php echo ((isset($promo->description) && !empty($promo->description)) ? $promo->description : ''); ?>
=======
				<p>FREE SHIPPING! Use Code <span>FREESHIP</span> at Checkout</p>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="top_nav">
					<ul>
<<<<<<< HEAD
						
				  		<li><a href="{{URL::to('contact-support')}}">Support & Contact </a></li>
				  		
				  		 @if(!count(Auth::user()))

					     <li class="dropdown"><a href="javascript:void(0);" class="signup_popup">| <i class="fa fa-user" aria-hidden="true"></i> Sign In</a></li>
=======
				  		<li><a href="#">Support & Contact </a></li>
				  		 @if(!count(Auth::user()))
					     <li class="dropdown"><a href="javascript::void(0);" class="signup_popup">| <i class="fa fa-user" aria-hidden="true"></i> Sign In</a></li>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
					     @else
								<li class="dropdown">
								 @if(!count(Auth::user()))
							     	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">| <i class="fa fa-user" aria-hidden="true"></i> Sign In</a>
							     @else
							     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							        | <i class="fa fa-user" aria-hidden="true"></i> My Account<i class="fa fa-sort-desc" aria-hidden="true"></i>
                              </a>
							     @endif
									   <ul class="dropdown-menu">
										<li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
									<li><a href="{{ URL::to('logout') }}">Logout</a></li>
									</ul>
								</li>
					
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
 


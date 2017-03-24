<section class="top_nav_div">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<p>FREE SHIPPING! Use Code <span>FREESHIP</span> at Checkout</p>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="top_nav">
					<ul>
				  		<li><a href="#">Support & Contact </a></li>
				  		 @if(!count(Auth::user()))
					     <li class="dropdown"><a href="javascript::void(0);" data-toggle="modal" data-target="#signup_popup">| <i class="fa fa-user" aria-hidden="true"></i> Sign In</a></li>
					     @else
						   <li id="dropdown-user" class="normal-user dropdown">
					         <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
							        <div class="username">| <i class="fa fa-user" aria-hidden="true"></i> My Account<i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                              </a>
                               <div class="dropdown-menu dropdown-menu-right with-arrow drp">
                                <ul class="head-list">
                                     <li><a href="{{ URL::to('logout') }}"> <i class="fa fa-sign-out fa-fw"></i> Logout </a></li>
                                </ul>
                            </div>
                            </li>
					
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>


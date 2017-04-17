<?php $menus=helper::getMenus();?>

<!-- desktop header start here  -->
		<section class="main_header hidden-sm hidden-xs">
			<nav class="navbar navbar-default navbar-static-top">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="icon_lins text-right">
								<ul>
									<li><button type="button" class="btn btn-default btn-lg text-center"><i class="fa fa-envelope-open" aria-hidden="true"></i><br>Messages</button></li>
									<li><button type="button" class="btn btn-default btn-lg text-center"><i class="fa fa-heart" aria-hidden="true"></i><span>@if(Auth::check()){{helper::getMyWishlistCount()}} @endif</span><br>@if(Auth::check())<a href="{{route('wishlist')}}">Favorites</a> @else <a data-toggle="modal" data-target="#login_popup"> Favorites </a> @endif </button></li>
									<li><button type="button" class="btn btn-default btn-lg text-center"><i class="fa fa-shopping-cart" aria-hidden="true"></i><br>Cart</button></li>
								</ul>
							</div>
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="/"><img class="img-responsive" src="{{asset('/img/brand.png')}}"></a>
							</div>
							<div id="navbar" class="navbar-collapse collapse main_menu_in">
								<ul class="nav navbar-nav mid_nav">
									<li class="active"><a href="#">About</a></li>
									<li><a href="#about">How it Works</a></li>
									<li><a href="#contact">Events</a></li>
									<li><a href="#contact">Blog</a></li>
									<li><a href="costume/sell-a-costume" class="sell-btn"><i class="fa fa-tag" aria-hidden="true"></i> Sell a Costume</a></li>
									<li>
										<form class="navbar-form navbar-left" role="search">
											<div class="form-group">
												<i class="fa fa-search" aria-hidden="true"></i> <input type="text" class="form-control" placeholder="Search">
											</div>
										</form>
									</li>


								</ul>
							</div><!--/.nav-collapse -->
						</div>
					</div>
				</div>
			</nav>
			@if(!Request::is('login'))
			<div class="main_navigation">
				<div class="container main_menu">
					<nav class="navbar navbar-default">
						<div class="navbar-header">
							<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<!-- <a class="navbar-brand" href="#">MegaMenu</a> -->
						</div>
						<div class="collapse navbar-collapse js-navbar-collapse">
							<ul class="nav navbar-nav">
							@foreach($menus as $key=>$value)
								<li class="dropdown mega-dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$key}} @if(count($value)>1)<i class="fa fa-chevron-down" aria-hidden="true"></i>@endif</a>
								@if(count($value)>1)
								<ul class="dropdown-menu mega-dropdown-menu row">
								@if(count($value)<=6)
								<li class="col-sm-6">
									<ul>
										@for($i=1;$i<count($value);$i++)
											<?php $res=explode("_", $value[$i]);?>
											<li><a href="/shop/{{$res[0]}}/{{$key}}/{{$res[1]}}">{{$res[1]}}</a></li>
										@endfor
									</ul>
								</li>
								@else
								<?php $menu1=6?>
								<?php $menu2=count($value);?>
								<li class="col-sm-6">
									<ul>
										@for($i=1;$i<$menu1;$i++)
											<?php $res=explode("_", $value[$i]);?>
											<li><a href="/shop/{{$res[0]}}/{{$key}}/{{$res[1]}}">{{$res[1]}}</a></li>
										@endfor
									</ul>
								</li>
								<li class="col-sm-6">
									<ul>
										@for($j=$menu1;$j<$menu2;$j++)
											<?php $res=explode("_", $value[$j]);?>
											<li><a href="/shop/{{$res[0]}}/{{$key}}/{{$res[1]}}">{{$res[1]}}</a></li>
										@endfor
									</ul>
								</li>
								@endif
								</ul>
								@endif
								</li>
							@endforeach
							
						</div><!-- /.nav-collapse -->
					</nav>
				</div>
			</div>
		</section>

		<!-- desktop header close here  -->

		<!-- responsive header start here -->

		<section class="responsive-menu hidden-lg  hidden-md sticky-head">
			<div class="container">
				<div class="row">
					<div class="col-xs-5">
						<div class="icon-rm"><span class="toggle-btn">
							<span class="btn-line"></span>
							<span class="btn-line"></span>
							<span class="btn-line"></span>
						</span></div>
						<div class="mobile_menu_logo">
							<a href="/"><img class="img-responsive" src="{{asset('img/brand.png')}}"></a>
						</div>
					</div>
					<div class="col-xs-7">

						<button type="button" class="navbar-toggle respnsive-ser-rm" data-toggle="collapse" data-target=".nav-search" data-collapse-group="myDivs">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>
						<button type="button" class="navbar-toggle respnsive-ser-rm" data-toggle="collapse" data-target=".nav-search" data-collapse-group="myDivs">
							<i class="fa fa-user" aria-hidden="true"></i>
						</button>
						<button type="button" class="navbar-toggle respnsive-ser-rm" data-toggle="collapse" data-target=".nav-search" data-collapse-group="myDivs">
							<i class="fa fa-search"></i>
						</button>
						<button type="button" class="navbar-toggle respnsive-ser-rm sell" data-toggle="collapse" data-target=".nav-search" data-collapse-group="myDivs">
							<i class="fa fa-tag" aria-hidden="true">Sell</i>
						</button>
					</div>
					<div class="mobile-rm">	
						<ul class="nav nav-tabs mobile-tabs">
							<li class="active">
								<a  href="#category1" data-toggle="tab">Menu</a>
							</li>
							<li><a href="#category2" data-toggle="tab">Account</a>
							</li>
							<li><a href="#category3" data-toggle="tab">Support</a>
							</li>
						</ul>
						<div class="mobile-tabsec">
							<div class="tab-content mobile-content">
								<div class="tab-pane active" id="category1">
									<!--  tab content starts  -->
									<ul class="responsive-rm">
										<li>CATEGORIES <span class="mobile-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
											<!--inner menu start-->
											<ul class="responsive-inner none-rm">
												@foreach($menus as $key=>$value)
													<li>{{$key}}<i class="fa fa-chevron-down" aria-hidden="true"></i></li>
												@endforeach
											</ul>			
											<!--inner menu end-->			
										</li>
										<li>ABOUT</li>		
										<li>HOW IT WORKS</li>		
										<li>EVENTS</li>		
										<li>BLOG</li>		
										<li>FOOTER</li>		
									</ul>			
									<!-- tab content End -->			
								</div>
								<div class="tab-pane" id="category2">
									<!-- tab content starts -->			  
									<div class="head-acc-form">
										<p class="acc-form-rm"><input type="text" placeholder="LAUREN'S ACCOUNT"> <span class="acc-form-icn"><i class="fa fa-user" aria-hidden="true"></i></span></p>
										<p class="acc-form-rm"><input type="text" placeholder="FAVORITES"> <span class="acc-form-icn"><i class="fa fa-heart" aria-hidden="true"></i> 2</span></p>			
										<p class="acc-form-rm"><input type="text" placeholder="MESSAGES"> <span class="acc-form-icn"><i class="fa fa-envelope" aria-hidden="true"></i> 4</span></p>						
										<p class="acc-form-rm"><input type="text" placeholder="SIGN OUT"> <span class="acc-form-icn"><i class="fa fa-sign-out" aria-hidden="true"></i></span></p>			
									</div>
									<!-- tab content End -->			
								</div>
								<div class="tab-pane" id="category3">
									<!-- tab content starts -->
									<div class="head-support">
										<p class="support-rm support-rm1">SUPPORT & CONTACT</p>
										<p class="support-rm support-rm1">CHRYSALIS</p>			
										<p class="support-rm support-rm2">100 Main St</p>			
										<p class="support-rm support-rm2">Suite 200</p>			
										<p class="support-rm support-rm2">New York, NY 10001</p>						
										<p class="support-rm support-rm3">732.618.8533</p>			
									</div>
									<!-- tab content End -->			
								</div>
							</div>
						</div>  
					</div>    
					<!--- Tabs section End -->
				</div>
			</div>
		</section>

		<!-- responsive header End here -->
		@endif
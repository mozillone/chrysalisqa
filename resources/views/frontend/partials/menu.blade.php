<?php $menus=helper::getMenus();?>
<!-- desktop header start here  -->
<section class="main_header hidden-sm hidden-xs">
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="icon_lins text-right">
						<ul> 
							<li>
								<a href="{{URL::to('conversations')}}" type="button" class="btn btn-default btn-lg text-center">
									<i class="fa fa-envelope" aria-hidden="true"></i>
									@if(Auth::check())
										<span class="msg_count">{{helper::getMyMessageCount()}}</span>
									@endif
									<br>Messages
								</a>
							</li>
							<li><a type="button" class="btn btn-default btn-lg text-center fav-icon-sec" href="{{route('wishlist')}}"><i class="fa fa-heart" aria-hidden="true"></i>@if(Auth::check())<span class="fav_count">{{helper::getMyWishlistCount()}}</span>@endif<br>@if(Auth::check())<a class="fav-style" href="{{route('wishlist')}}">Favorites</a> @else <a class="fav-style" data-toggle="modal" data-target="#login_popup"> Favorites </a> @endif </a></li>
							<li><button type="button" class="dropdown-toggle btn btn-default btn-lg text-center mini-cart" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart" aria-hidden="true"></i><br>Cart <span class="mini_cart">@if(is_numeric(helper::getCartCount())){{helper::getCartCount()}} @else 0 @endif</span></button>
								<ul class="dropdown-menu cart-products">
								</ul>
							</li>
						</ul>
					</div>
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand nav-res" href="/"><img class="img-responsive" src="{{asset('/img/brand.png')}}"></a>
					</div>
					<div id="navbar" class="navbar-collapse collapse main_menu_in">
						<ul class="nav navbar-nav mid_nav">
							<li class="active"><a href="/pages/about-us">About</a></li>
							<li><a href="/pages/how-it-works">How it Works</a></li>
							<li><a href="{{ route('events') }}">Events</a></li>
							<li><a href="{{ route('blog') }}">Blog</a></li>
							<?php 
								/*if (isset(Auth::user()->id) && !empty(Auth::user()->id)) { ?>
									<li><a href="{{URL::to('costume/sell-a-costume')}}" class="sell-btn"><i class="fa fa-tag" aria-hidden="true"></i> Sell a Costume</a></li>
									<?php }  else{ ?>
									<li><a href="{{URL::to('login')}}" class="sell-btn"><i class="fa fa-tag" aria-hidden="true"></i> Sell a Costume</a></li>
								<?php }*/?>
								<li><a href="{{URL::to('costume/sell-a-costume')}}" class="sell-btn"><i class="fa fa-tag" aria-hidden="true"></i> Sell a Costume</a></li>
								<li>
									<form class="navbar-form navbar-left mble_srch-div" role="search" action="/search/q" method="GET">
										<div class="form-group">
											<i class="fa fa-search" aria-hidden="true"></i> <input type="text" name="key" class="form-control" placeholder="Search">
										</div>
									</form>
								</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
	</nav>

	<div class="main_navigation {{ (Request::is('/') ? 'is_home' : '') }}">
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
						<?php 
							//$men_arr=explode("/", $value[1]); //echo $men_arr[1];exit; 
							$main_cat_url=str_replace(" ","-",str_replace(" & ","-", strtolower(str_replace("'","", $key))));
						?>
						<li class="dropdown mega-dropdown main_cat_url_class">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-cat-url="/category/<?php echo $main_cat_url; ?>">{{$key}} @if(count($value)>1)<i class="fa fa-chevron-down" aria-hidden="true"></i>@endif</a>
							@if(count($value)>1)
							<ul class="dropdown-menu mega-dropdown-menu row @if(count($value)<=6) min-menu @endif">
								@if(count($value)<=6)
								<li class="col-sm-6">
									<ul>
										@for($i=1;$i<count($value);$i++)
										<?php $res=explode("_", $value[$i]);?>
										<li><a href="/category{{$res[0]}}">{{$res[1]}}</a></li>
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
										<li><a href="/category{{$res[0]}}">{{$res[1]}}</a></li>
										@endfor
									</ul>
								</li>
								<li class="col-sm-6">
									<ul>
										@for($j=$menu1;$j<$menu2;$j++)
										<?php $res=explode("_", $value[$j]);?>
										<li><a href="/category{{$res[0]}}">{{$res[1]}}</a></li>
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
				<div class="col-xs-4">
					<div class="icon-rm"><span class="toggle-btn">
						<span class="btn-line"></span>
						<span class="btn-line"></span>
						<span class="btn-line"></span>
					</span></div>
					<div class="mobile_menu_logo">
						<a href="/"><img class="img-responsive" src="{{asset('img/brand.png')}}"></a>
					</div>
				</div>
				<div class="col-xs-8">
					<a href="/cart" type="button" class="navbar-toggle respnsive-ser-rm sell mbl_crt_icon" data-toggle="collapse" data-target=".nav-search" data-collapse-group="myDivs">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</a>
					<button type="button" class="navbar-toggle respnsive-ser-rm" data-toggle="collapse" data-target=".nav-search" data-collapse-group="myDivs">
						<a href="{{URL::to('conversations')}}" type="button" class=""><i class="fa fa-envelope" aria-hidden="true"></i></a>
					</button>
					<button type="button" class="navbar-toggle respnsive-ser-rm" data-toggle="collapse" data-target=".nav-search" data-collapse-group="myDivs">
						<a data-toggle="modal" @if(!Auth::check()) data-target="#login_popup" @else href="/dashboard" @endif><i class="fa fa-user" aria-hidden="true"></i></a>
					</button>
					<button type="button" class="navbar-toggle respnsive-ser-rm mb-searchs" data-toggle="collapse" data-target=".nav-search" data-collapse-group="myDivs">
						<i class="fa fa-search"></i>
					</button>
					<a href="{{URL::to('costume/sell-a-costume')}}" type="button" class="navbar-toggle respnsive-ser-rm sell" data-toggle="collapse" data-target=".nav-search" data-collapse-group="myDivs">
						<i class="fa fa-tag" aria-hidden="true"><span>Sell</span></i>
					</a>
				</div>
				<form class="navbar-form navbar-left mble_srch-div" id="search_show" role="search" action="/search/q" method="GET" style="display:none;">
					<div class="col-xs-12">
						<div class="form-group">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<input type="text" name="key" class="form-control" placeholder="Search for Costumes">
							<button class="btn btn-primary">Search</button>
						</div>
					</form>
				</div>
				<div class="mobile-rm">	
					<ul class="nav nav-tabs mobile-tabs @if(!Auth::check()) is_login @endif">
						<li class="active">
							<a  href="#category1" data-toggle="tab">Menu</a>
						</li>
						@if(Auth::check())<li><a href="#category2" data-toggle="tab">Account</a>@endif
						</li>
						<li><a href="#category3" data-toggle="tab">Support</a>
						</li>
					</ul>
					<div class="mobile-tabsec">
						<div class="tab-content mobile-content">
							<div class="tab-pane active" id="category1">
								<!--  tab content starts  -->
								<ul class="responsive-rm">
									<li> <span class="mobile-plus"><span class="main_cate">CATEGORIES</span> <i class="fa fa-plus" aria-hidden="true"></i></span>
										<!--inner menu start-->
										<ul class="responsive-inner none-rm">
											@foreach($menus as $key=>$value)
											<li><a href="/category/{{helper::specialCharectorsRemove($key)}}">{{$key}}</a><i class="fa fa-chevron-down" aria-hidden="true"></i>
											</li>
											@endforeach

										</ul>			
										<!--inner menu end-->			
									</li>
									<li><a href="/pages/about-us">ABOUT</a></li>
									<li><a href="/pages/how-it-works">HOW IT WORKS</a></li>
									<li><a href="{{ route('events') }}">EVENTS</a></li>
									<li><a href="{{ route('blog') }}">BLOG</a></li>
								</li>
                                                                <li class="dropdown ft-mbl-links" style="display:none;">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">FOOTER<span class="mobile-plus"><i class="fa fa-plus" aria-hidden="true"></i></span></a>
									<ul class="dropdown-menu mobile_sub_menu responsive-inner">
										<li><a href="/pages/about-us">About <i class="fa fa-chevron-down" aria-hidden="true"></i></a></li>
										<li><a href="/pages/how-it-works">How It Works <i class="fa fa-chevron-down" aria-hidden="true"></i></a></li>
										<li><a href="/contact-support">Support & Contact <i class="fa fa-chevron-down" aria-hidden="true"></i></a></li>
										<li><a href="{{ route('events') }}">Events <i class="fa fa-chevron-down" aria-hidden="true"></i></a></li>
										<li><a href="{{ route('blog') }}">Blog <i class="fa fa-chevron-down" aria-hidden="true"></i></a></li>
										<li><a href="{{ route('press') }}">Press <i class="fa fa-chevron-down" aria-hidden="true"></i></a></li>
										<li><a href="/jobs">Jobs <i class="fa fa-chevron-down" aria-hidden="true"></i></a></li>
										<li><a href="/giving-back">Giving Back <i class="fa fa-chevron-down" aria-hidden="true"></i></a></li>
									</ul>
								</li>
							</ul>			
							<!-- tab content End -->			
						</div>
						@if(Auth::check())
						<div class="tab-pane" id="category2">
							<!-- tab content starts -->			  
							<div class="head-acc-form">
								<p class="acc-form-rm"><a href="javascript::void(0);"><input type="text" placeholder="{{Auth::user()->display_name}}"></a><span class="acc-form-icn"><i class="fa fa-user" aria-hidden="true"></i></span></p>
								<p class="acc-form-rm"><a href="{{route('wishlist')}}"><input type="text" placeholder="FAVORITES"></a><span class="acc-form-icn"><i class="fa fa-heart" aria-hidden="true"></i>{{helper::getMyWishlistCount()}}</span></p>			
								<p class="acc-form-rm"><a href="{{URL::to('conversations')}}"><input type="text" placeholder="MESSAGES"></a><span class="acc-form-icn"><i class="fa fa-envelope" aria-hidden="true"></i> {{helper::getMessagesCount()}}</span></p>						
								<p class="acc-form-rm"><a href="{{route('logout')}}"><input type="text" placeholder="SIGN OUT"> </a><span class="acc-form-icn"><i class="fa fa-sign-out" aria-hidden="true"></i></span></p>			
							</div>
							<!-- tab content End -->			
						</div>
						@endif
						<div class="tab-pane" id="category3">
							<!-- tab content starts -->
							<div class="head-support">
								<p class="support-rm support-rm1">SUPPORT & CONTACT</p>
								<!--<p class="support-rm support-rm1">CHRYSALIS</p>
								<p class="support-rm support-rm2 mobile_adrss">100 Main St <br>	Suite 200<br> New York, NY 10001</p>	-->
								<p class="support-rm support-rm3">732.618.8533</p>			
								<p class="support-rm support-rm3 email-mbl">support@chrysaliscostumes.com</p>
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

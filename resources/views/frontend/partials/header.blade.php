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
 <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
	  <div class="row">
	  	  <div class="col-md-12">
	  <div class="icon_lins text-right">
		<ul>
			<li><button type="button" class="btn btn-default btn-lg text-center"><i class="fa fa-envelope-open" aria-hidden="true"></i><br>Messages</button></li>
			<li><button type="button" class="btn btn-default btn-lg text-center"><i class="fa fa-heart" aria-hidden="true"></i><br>Favorites</button></li>
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
          <a class="navbar-brand" href="#"><img class="img-responsive" src="../assets/frontend/img/brand.png"></a>

        </div>
        <div id="navbar" class="navbar-collapse collapse main_menu_in">
          <ul class="nav navbar-nav mid_nav">
            <li class="active"><a href="#">About</a></li>
            <li><a href="#about">How it Works</a></li>
            <li><a href="#contact">Events</a></li>
			  <li><a href="#contact">Blog</a></li>
			    <li><a href="#contact" class="sell-btn"><i class="fa fa-tag" aria-hidden="true"></i> Sell a Costume</a></li>
				 <li>
				<form class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <i class="fa fa-search" aria-hidden="true"></i> <input type="text" class="form-control" placeholder="Search"/>
	</div></form>
  </li>
      <!--       <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
	   </div>
	   </div>
    </nav>


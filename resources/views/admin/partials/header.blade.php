<!-- Main Header --> 
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/admin/dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
     <span class="logo-mini"><img class="responsive" src="{{asset('/img/favicon.png')}}" class="img-responsive"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg "><img  src="{{asset('/img/brand.png')}}" class="img-responsive"></span>
	  <span class="logo-sm"><img  src="{{asset('/img/brand.png')}}" class="img-responsive"></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ isset(Auth::user()->profile_img) && (Auth::user()->profile_img!='default.jpg') ? URL::asset('uploads/'.Auth::user()->profile_img) : URL::asset('/img/default.png') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->username }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ isset(Auth::user()->profile_img) && (Auth::user()->profile_img!='default.jpg') ? URL::asset('uploads/'.Auth::user()->profile_img) : URL::asset('/img/default.png') }}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->display_name }}
                  <small>Member since <?php echo date('M',strtotime(Auth::user()->created_at)); ?>. <?php echo date('Y',strtotime(Auth::user()->created_at)); ?></small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('admin/profile/') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            
          </li>
        </ul>
      </div>

    </nav>
  </header>
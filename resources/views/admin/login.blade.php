<!doctype html>
<html ng-app="app">
<head>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="{{asset('/img/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/bootstrap/css/bootstrap.min.css')}}">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/custom.css')}}">
  
    <title>Chrysalis Administration</title> 
    </head>
<body class="login-page" ng-app="login">
 <div class="wrapper">
 <div ui-view="layout" class="ng-scope">
  <div class="login-box ng-scope">
  <div class="login-logo">
    <a ui-sref="login" href="#"><img class="img-responsive" src="{{asset('/img/brand.png')}}" style="margin: 0px 0"></a>
  </div>
  <div class="login-box-body">
    <div class="row">
      <div class="col-xs-12">
        <div class="text-center">
          <h3>Sign In</h3>
          @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                    {{ Session::get('error') }}
            </div>
               
                       
            @elseif(Session::has('success'))
             <div class="alert alert-success alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   {{ Session::get('success') }}
            </div>
          @endif
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
         <form  action="{{url('/admin/login')}}" method="post" class="validation" id="login" name="login">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group has-feedback" ng-init="{{ old('email')}}">
            <input class="form-control" placeholder="Email" name="email" id="email" value="{{old('email')}}">
            <p class="error">{{ $errors->first('email') }}</p>            
		      <i class="fa fa-envelope form-control-feedback" aria-hidden="true"></i>
          </div>
          <div class="form-group has-feedback">
            <input class="form-control" placeholder="Password"  id="password" name="password" type="password" value="{{old('password')}}">
             <p class="error">{{ $errors->first('password') }}</p>
            <i class="fa fa-lock form-control-feedback" aria-hidden="true"></i>
          </div>
          <div class="checkbox text-left">
            <label align="center"><input id="remember" name="remember" type="checkbox" value="remember">Remember me</label>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">
                Login
              </button>
               <a href="/admin/forgotpassword">Forgot Password?</a>
            </div>

          </div>    
       </form>
      </div>
    </div>
  </div>
</div>
</div>
<div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>
</div>
<script src="{{ asset('/js/jquery-2.2.4.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('/assets/admin/js/pages/login.js') }}"></script>
</body>
</html>

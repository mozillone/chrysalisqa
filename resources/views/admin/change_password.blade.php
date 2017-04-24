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
          <h3>Change Admin Password</h3>
      
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
         <form  action="{{route('admin.forgotpassword.change')}}" method="post" class="validation" id="change_password" name="login">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="user_id" value="{{ $id }}">
          <div class="form-group has-feedback">
            <input class="form-control" placeholder="Password" name="password" id="password" type="password">
            <p class="error">{{ $errors->first('password') }}</p>
           </div>
            <div class="form-group has-feedback" ng-init="{{ old('email')}}"> 
            <input class="form-control" placeholder="Confirm Password" name="cpassword" id="cpassword" type="password">
            <p class="error">{{ $errors->first('cpassword') }}</p>
           </div>
         
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">
                Submit
              </button>
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
<script src="{{ asset('/assets/admin/js/pages/change_password.js') }}"></script>
</body>
</html>

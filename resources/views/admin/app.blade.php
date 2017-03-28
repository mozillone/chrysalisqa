<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
    <title>@section('title')
           {{!empty($title) ? $title.' |' : ''}} Chrysalis
       @show</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" href="{{asset('/img/favicon.png')}}">
  <link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/dist/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/assets/admin/css/custom.css')}}">
  @yield('header_styles')

 </head>
<body class="hold-transition skin-blue sidebar-mini" ng-app="app">
<div class="wrapper">
    @include('admin.partials.header')
    @include('admin.partials.sidebar')
    <div class="content-wrapper">
        @yield('content')
    </div>
   @include('admin.partials.footer')
<script src="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{ asset('/assets/admin/vendors/AdminLTE-master/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('/assets/admin/vendors/AdminLTE-master/dist/js/app.min.js')}}"></script>
<script src="{{ asset('/angular/lib/angular.js')}}"></script>
<script src="{{ asset('/angular/Admin/app.js')}}"></script>
<script src="{{ asset('/angular/Admin/directives/datepicker.js')}}"></script>
<script src="{{ asset('/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('angular/lib/angular-datatables.min.js') }}"></script>
	   

 @yield('footer_scripts')
 
</body>
</html>

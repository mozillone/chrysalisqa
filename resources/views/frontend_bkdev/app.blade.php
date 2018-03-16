<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		

        {!! Meta::tag('title') !!}
        {!! Meta::tag('description') !!}
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
		<link rel="stylesheet" href="{{ asset('/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{ asset('/assets/frontend/css/chrysalis.css')}}">
		<link href="{{ asset('/assets/frontend/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('/assets/frontend/vendors/lobibox-master/css/lobibox.css') }}">
		
		@yield('styles')
	</head>
	<body ng-app="app">
		<div class="main-container">
			<section class="main_header">
			@include('frontend.partials.header')
			@include('frontend.partials.menu')
			</section>
			@yield('content')
			@include('frontend.partials.footer')
		</div>
		<div class="img-loading hide"><img src="/img/chackout.gif"/></div>
      		
		<script src="{{ asset('/js/jquery-2.2.4.js')}}"></script>
		<script src="{{ asset('/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
		<script src="{{ asset('/angular/lib/angular.js')}}"></script>
		<script src="{{ asset('/angular/lib/angular-datatables.min.js') }}"></script>
		<script src="{{ asset('/vendors/datatables/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('angular/lib/angular-datatables.min.js') }}"></script>
		<script src="{{ asset('/angular/app.js')}}"></script>
		<script src="{{ asset('/js/jquery.validate.min.js')}}"></script>
		<script src="{{ asset('/assets/frontend/js/custom.js')}}"></script>
		<script src="{{ asset('/angular/directives/datepicker.js') }}"></script>
		<script src="{{ asset('/assets/frontend/vendors/lobibox-master/js/notifications.js') }}"></script>
		
		
		
		@yield('footer_scripts')
	</body>
</html>
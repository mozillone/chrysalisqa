@extends('/frontend/app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css" rel="stylesheet">
@endsection
@section('content')
    
	    <div class="container how-it-works-page">
		<?php echo $pageData->description ?>
		</div>
@stop
@section('footer_scripts')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/js/pages/event.js') }}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="http://chrysalisqa.local.dotcomweavers.net/assets/frontend/js/owl.carousel.min.js"></script>
@stop
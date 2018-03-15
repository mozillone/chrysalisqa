@extends('/frontend/app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css" rel="stylesheet">
@endsection
@section('content')
<?=$pageData[0]->description?>
@stop
@section('footer_scripts')
	
	<script>
		$(document).ready(function() {
	
   $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
navigation:true,
		navigationText: [
		"<i class='fa fa-chevron-left'></i>",
		"<i class='fa fa-chevron-right'></i>"
		],
		items : 5,
		itemsDesktop : [1199,5],
		itemsDesktopSmall : [979,3],
		itemsTablet: [768,3],
		itemsMobile: [480,2]
})
		})
	</script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/js/pages/event.js') }}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
	<script src="http://chrysalisqa.local.dotcomweavers.net/assets/frontend/js/owl.carousel.min.js"></script>
@stop
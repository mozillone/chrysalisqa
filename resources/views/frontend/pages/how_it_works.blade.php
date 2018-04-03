@extends('/frontend/app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.carousel.min.css')}}">
	    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.theme.default.min.css')}}">
    <meta name="{{ $pageData->meta_title }}" content="{{ $pageData->meta_desc }}" />
@endsection
@section('content')
<?= $pageData->description; ?>
<div class="container how-it-works-page steps_slider1"> 
	<div class="additional-infos">
		<h3>Additional information</h3>
		@if(count($faqs))
		@foreach($faqs as $faq)
		<div class="accordion">
			<h3 class="pluss">
		<p class="accordion_head ">{{ $faq->title }}</p>
		</h3>
		<div class="infoss">
		<div class="panel-body accordion_body">
			{!! $faq->description !!}
		</div>
		</div>
		</div>
		@endforeach
		@else
		<div>No Results Found</div>
		@endif
	</div>
</div>
@stop
@section('footer_scripts')
<script>
				$(document).ready(function() {
				$('.steps_slider1.owl-carousel').owlCarousel({
					loop:true,
					margin:10,
					responsiveClass:true,
					navigation:true,
					navigationText: [
					"<i class='fa fa-chevron-left'></i>",
					"<i class='fa fa-chevron-right'></i>"
					],
					items : 4,
					itemsDesktop : [1199,4],
					itemsDesktopSmall : [979,4],
					itemsTablet: [768,4],
					itemsMobile: [767,1]
				});
				});
				</script>
				
				
				<script type="text/javascript">
	if (jQuery(window).width() < 767) 
	{
		var $accordionIO = $('.accordion .pluss');
		$accordionIO.prev('.infos').hide();
		
		$accordionIO.click(function() {
			$(this).prev('.infoss').slideToggle();
		});
		
		$(".accordion h3").click(function() {
			//Inner 
			var jqInner = $(this).next();
			if (jqInner.is(":visible")) {
				jqInner.slideUp()
				
			} else
			
			{
				jqInner.slideDown()
				
			}
			$(this).toggleClass('pluss minuss');
		})
	}
</script>

<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
<script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('assets/frontend/js/owl.carousel.min.js')}}"></script>

@stop
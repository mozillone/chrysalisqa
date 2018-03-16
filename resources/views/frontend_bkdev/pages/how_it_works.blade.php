@extends('/frontend/app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css" rel="stylesheet">
    <meta name="{{ $pageData->meta_title }}" content="{{ $pageData->meta_desc }}" />
@endsection
@section('content')
    <?= $pageData->description; ?>
    <div class="container how-it-works-page"> 
        <div class="additional-info">
            <h3>Additional Information</h3>
            @if(count($faqs))
                @foreach($faqs as $faq)
            <p>{{ $faq->title }}</p>
            <div class="panel-body">
                {!! $faq->description !!}
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
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/js/pages/event.js') }}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="http://chrysalisqa.local.dotcomweavers.net/assets/frontend/js/owl.carousel.min.js"></script>
@stop
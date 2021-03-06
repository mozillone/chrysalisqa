@extends('/frontend/app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.carousel.min.css')}}">
    <style>
        .about_div_scrl.owl-carousel.owl-theme .item .col-md-4.col-sm-6.col-xs-12 {
            width: 100%;
        }
        .blog_img_div {
            width: 100%;
            height: 250px;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection
@section('content')
    <?php echo ((isset($pageData->description) && !empty($pageData->description)) ? $pageData->description : '')?>

    <div class="aboutblogslider_div givings_back ">
        <div class="container">
            <div class="row about_blog_slider-btm">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2 class="sub-heading">Events</h2>
                </div>

                <div class="about_div_scrl owl-carousel">
                    @if(count($events))
                        @foreach($events as $event)
                            <?php
                                if(isset($event->user_img) && !empty($event->user_img)){
                                    $path = '/event_images/master_listing/'.$event->user_img;
                                    if(file_exists(public_path($path))){
                                        $listingImage = URL::asset('/event_images/master_listing/'.$event->user_img);
                                    }else{
                                        $listingImage = URL::asset('/event_images/listing_placeholder.png');
                                    }
                                }else{
                                    $listingImage = URL::asset('/event_images/listing_placeholder.png');
                                }
                            ?>
                            <div class="item">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="blog-card">
                                        <div class="blog_img_div" style="background-image: url(<?php echo $listingImage; ?>)">
                                        </div>
                                        <span class="text-muted">{{ date('d F Y', strtotime($event->from_date)) }}</span>
                                        <h3 class="event-title">{{ $event->event_name }}</h3>
                                        <p class="event-description">{!! $event->event_desc !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div>No Records Found</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_scripts')
    <script>


        function trimEventTitle() {
            var showTitle = 60;
            var ellipsestext = "...";

            $('.event-title').each(function() {
                var eventTitle = $(this).html();

                if(eventTitle.length > showTitle) {

                    var c = eventTitle.substr(0, showTitle);

                    var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span>';

                    $(this).html(html);
                }

            });
        }

        function trimEventDescription() {
            var showDescription = 200;
            var ellipsestext = "...";

            $('.event-description').each(function() {
                var eventDescription = $(this).html();

                if(eventDescription.length > showDescription) {

                    var c = eventDescription.substr(0, showDescription);

                    var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span>';

                    $(this).html(html);
                }

            });
        }

        $(document).ready(function() {

            $('.our_partner_slider.owl-carousel').owlCarousel({
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
                itemsMobile: [480,3]
            });


            $('.about_div_scrl').owlCarousel({
                loop:true,
                margin:10,
                responsiveClass:true,
                navigation:true,
                navigationText: [
                    "<i class='fa fa-arrow-left'></i>",
                    "<i class='fa fa-arrow-right'></i>"
                ],
                items : 3,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3],
                itemsTablet: [768,3],
                itemsMobile: [767,1]
            });

            trimEventTitle();
            trimEventDescription();

        });
    </script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('/assets/frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('/assets/frontend/js/pages/home.js')}}"></script>
@stop
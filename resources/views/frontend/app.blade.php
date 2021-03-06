<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta property="fb:app_id" content="1458951657516313"/> 
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="summary">
        {!! Meta::tag('title') !!}
        {!! Meta::tag('description') !!}
        <!-- Added by Gayatri -->
        {!! Meta::tag('url') !!}
        {!! Meta::tag('image') !!}

		<meta property="og:image:width" content="200">
		<meta property="og:image:height" content="200">
		<!-- Google Analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-108166847-1', 'auto');
			ga('send', 'pageview');
		</script>
		<!-- End Google Analytics -->
		

		<!-- End  -->
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
		<link rel="stylesheet" href="{{ asset('/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{ asset('/assets/frontend/css/chrysalis.css')}}">
		<link href="{{ asset('/assets/frontend/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('/assets/frontend/vendors/lobibox-master/css/lobibox.css') }}">
		<!-- Added by Gayatri -->
		<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=59c35d4902a91700118cb868&product=unknown' async='async'></script>
		<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=59c35d4902a91700118cb868&product=custom-share-buttons"></script>
		<!-- End  -->
		<link rel="stylesheet" href="{{ asset('/assets/frontend/fancybox/cloudzoom.css') }}">
		<link rel="stylesheet" href="{{ asset('/assets/frontend/fancybox/fancy.css') }}?v=<?php echo date('dmYHims')?>">
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
		<script src="{{ asset('/assets/frontend/fancybox/jquery.elevatezoom.min.js') }}?v=<?php echo date('dmYHims')?>"></script>
		<!-- <script src="{{ asset('/assets/frontend/autozoom/cloudzoom.js') }}"></script> 
		<script src="{{ asset('/assets/frontend/autozoom/jquery.fancybox.js?v=2') }}"></script>-->
		<script src="{{ asset('/assets/frontend/fancybox/jquery.fancybox.js') }}?v=<?php echo date('dmYHims')?>"></script>
		<script type="text/javascript">

            $(function(){
            	(function ($, F) {
				    F.transitions.resizeIn = function() {
				        var previous = F.previous,
				            current  = F.current,
				            startPos = previous.wrap.stop(true).position(),
				            endPos   = $.extend({opacity : 1}, current.pos);

				        startPos.width  = previous.wrap.width();
				        startPos.height = previous.wrap.height();

				        previous.wrap.stop(true).trigger('onReset').remove();

				        delete endPos.position;

				        current.inner.hide();

				        current.wrap.css(startPos).animate(endPos, {
				            duration : current.nextSpeed,
				            easing   : current.nextEasing,
				            step     : F.transitions.step,
				            complete : function() {
				                F._afterZoomIn();

				                current.inner.fadeIn("fast");
				            }
				        });
				    };

				}(jQuery, jQuery.fancybox));
                $(".costume_images").fancybox({
                	padding:0,
                    closeBtn  : true,
				    arrows    : true,
				    nextClick : true,
				    nextMethod : 'resizeIn',
			        nextSpeed  : 250,
			        prevMethod : false,
                    afterShow: function(){
                        var $image = $('.fancybox-image');
                        //$image.CloudZoom({zoomPosition:'inside', zoomOffsetX:0});
                        //$image.elevateZoom({zoomType: "inner", cursor: "crosshair"});
                        $('.zoomContainer').remove();
                        /*$(".fancybox-image").attr("data-zoom-image",this.element[0].attributes[1].value);*/
           				$image.elevateZoom({ 
					        zoomType: "inner",
							zoomWindowOffetx:0,
							easing:true,
							responsive:true,
							zoomWindowFadeIn: 100,
							zoomWindowFadeOut: 100
					    });
                    },
                    beforeLoad: function(){
                        var $image = $('.fancybox-image');
                        //if ($image.data('CloudZoom')) $image.data('CloudZoom').destroy();
                        $('.zoomContainer').remove();
                       /* if ($image.data('elevateZoom')){
                        	$.removeData($image, 'elevateZoom');
                        	$('.zoomContainer').remove();
                        }*/
                    },
                    beforeShow : function(){
				   		this.title =  $(this.element).data("caption");
				   		$(".fancybox-image").attr("data-zoom-image",$(this.element).data("zoom-image"));
				  	},
                    beforeClose: function(){
                        var $image = $('.fancybox-image');
                        //if ($image.data('CloudZoom')) $image.data('CloudZoom').destroy();
                        $('.zoomContainer').remove();
                        /*if ($image.data('elevateZoom')){
                        	$.removeData($image, 'elevateZoom');
                        	$('.zoomContainer').remove();
                        } */
        				
                    }
                });
            })
        </script>
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
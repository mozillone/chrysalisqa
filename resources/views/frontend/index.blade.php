@extends('/frontend/app')
@section('title')
Home@parent
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('/assets/frontend/css/pages/home.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.theme.default.min.css')}}">
@endsection
@section('content')
<!-- responsive banner start here sample-->
<?php echo (isset($pageData->description) && !empty($pageData->description) ? $pageData->description : ''); ?>
<div class="container">
</div>

<div class="home_product_slider">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h2>Featured Costumes</h2>
				<?php //echo "<pre>";print_r($featured_costumes); ?>
				<div class="owl-carousel owl-theme">
					<?php  foreach ($featured_costumes as $cos) { ?>
						<div class="item">
							<div class="prod_box">
								<div class="img_layer">
									<a href="/product{{$cos->url}}" style="background-image: url({{asset('costumers_images/Medium')}}<?php echo "/".$cos->cos_image; ?>)">
									</a>
									<div class="hover_box"><p class="like_fav"><a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-thumbs-up"></i>1</span></a> <a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-heart-o"></i></span></a> </p><p class="hover_crt add-cart" data-costume-id="145"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart</p></div>
								</div>
								@if($cos->film_qlty == '32')
								<p class="ystrip-rm"><span><img class="img-responsive" src="http://chrysaliscostumes.com/assets/frontend/img/film.png"> Film Quality</span></p>
								@endif
								<div class="slider_cnt @if($cos->created_user_group != "admin" )no_brand @endif @if(strlen($cos->cos_name)<20) sml_name @endif">
									@if($cos->created_user_group == "admin")
									<?php $is_admin=20;?>
									<span class="cc_brand"><img src="{{asset('img/chrysalis_brand.png')}}"></span>
									
									@else
									<?php $is_admin=40;?>
									@endif
									<?php if(strlen($cos->cos_name) < 20) { ?>
										
										<h4><a href="/product{{$cos->url}}">{{$cos->cos_name}}</a></h4>
										<?php } else { ?>
										<h4><a href="/product{{$cos->url}}">{{substr($cos->cos_name, 0,$is_admin)."..."}}</a></h4>
									<?php } ?>
									
									
									<p>${{number_format($cos->cos_price, 2, '.', ',')}}</p>
								</div>
								</div>
							</div>
						<?php } ?>
						
					</div>
					<input type="hidden" name="costumes_cnt" id="costumes_cnt" value="{{count($featured_costumes)}}">
				</div>
			</div>
		</div>
	</div>
	
	<div class="instagram_div">
		<div class=" container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h2>Instagram Feed</h2>
					<p >Siphon cup dark trifecta, foam crema americano robust latte. Half and half galão grinder cream brewed single shot. Grinder aroma crema amerated.</p>
					<?php 
					//echo"<pre>"; print_r($insta); exit;?>
				</div>
				<div class="col-md-5 col-sm-4 col-xs-12 insta_main">
					<img class="img-responsive " src="{{asset('/assets/frontend/img/insta_main.png')}}">
				</div>
				<div class="col-md-7 col-sm-4 col-xs-12 insta_thumbs">
					<div class="row">
						@for($i=0; $i<count($insta); $i++)
							<div class="col-md-4">
								<a href="{{$insta[$i]['link']}}" target="_blank">
									<img class="img-responsive " src="{{$insta[$i]['image']}}">
								</a>
							</div>
						@endfor
						@for($i=1;$i<=$insta_cnt; $i++)
						<div class="col-md-4">
							<img class="img-responsive " src="http://via.placeholder.com/160x160">
						</div>
						@endfor
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="home-adds">
		<div class="container">
			<div class="row">
				<div class="col-md-8  add1">
					<a href="/pages/how-it-works">
						<img class="img-responsive hidden-sm hidden-xs" src="{{asset('/assets/frontend/img/add11.png')}}">
						<img class="img-responsive hidden-md hidden-lg" src="{{asset('/assets/frontend/img/home-mini1.png')}}">
					</a>
				</div>
				<div class="col-md-4 add2">
					<a href="/giving-back">
						<img class="img-responsive hidden-sm hidden-xs" src="{{asset('/assets/frontend/img/add22.png')}}">
						<img class="img-responsive hidden-md hidden-lg" src="{{asset('/assets/frontend/img/home-mini2.png')}}">
					</a>
				</div>
			</div>
		</div>
	</div> 
	<!-- git -->
	@endsection
	@section('footer_scripts')
	
	<script src="{{ asset('/assets/frontend/js/jquery.touchSwipe.min.js') }}"></script>
	<script src="{{ asset('/assets/frontend/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('/assets/frontend/js/pages/home.js') }}"></script>
	<script>
		$(document).ready(function() {
			if($("#costumes_cnt").val() > "4"){
				$(".owl-controls.clickable").show();	
			}
			if (jQuery(window).width() < 767) 
			{
				$(".carousel").swipe({
					
					swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
						
					    if (direction == 'left') $(this).carousel('next');
					    if (direction == 'right') $(this).carousel('prev');
						
					},
					allowPageScroll:"vertical"
					
				});
			}
		});
	</script>
@stop
@extends('/frontend/app')
@section('title')
	Home@parent
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/frontend/css/pages/home.css')}}">
@endsection

@section('content')
	<!-- responsive banner start here -->
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
							<div class="img_layer">
								<a href="/product{{$cos->url}}" style="background-image: url({{asset('costumers_images/Medium')}}<?php echo "/".$cos->cos_image; ?>)">
								</a>
							</div>
							<div class="slider_cnt">
								<h4><a href="/product{{$cos->url}}">{{$cos->cos_name}}</a></h4>
								<p>${{$cos->cos_price}}</p>
							</div>
						</div>
						<?php } ?>
					
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
@endsection
@section('footer_scripts')
<script src="{{ asset('/assets/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/home.js') }}"></script>
@stop
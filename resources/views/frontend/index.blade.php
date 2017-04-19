@extends('/frontend/app')
@section('title')
	Home@parent
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css" rel="stylesheet">
<style>
	.owl-controls.clickable {
		display: none;
	}

</style>
@endsection

@section('content')
	<!-- responsive banner start here -->
		<div class="container  hidden-sm  hidden-md hidden-lg">
			<div id="main-banner" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img class="img-responsive" src="{{asset('/assets/frontend/img/bnr-11.png')}}">
					</div>
					<div class="item">
						<img class="img-responsive" src="{{asset('/assets/frontend/img/bnr-22.png')}}">
					</div>
					<div class="item">
						<img class="img-responsive" src="{{asset('/assets/frontend/img/bnr-33.png')}}">
					</div>
				</div>
				<!-- Left and right controls -->
				<a class="left carousel-control" href="#main-banner" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#main-banner" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<!-- responsive banner End here -->
		<section class="main_banner ">
			<div class="container">
				<div class="row  hidden-xs">
					<div class="col-md-8 col-sm-12 col-xs-12 jumb-bnr">
						<a href="#"><img class="img-responsive" src="{{asset('/assets/frontend/img/bnr-11.png')}}"></a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 jumb-smll  hidden-xs hidden-sm">
						<a href="#"><img class="img-responsive" src="{{asset('/assets/frontend/img/bnr-22.png')}}"></a>
						<a href="#"><img class="img-responsive" src="{{asset('/assets/frontend/img/bnr-33.png')}}"></a>
					</div>
				</div>
				<!-- steps content div start here-->
				<div class="row home_steps hidden-xs">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="media"> 
							<div class="media-left"> <a href="#"> <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="{{asset('/assets/frontend/img/step_1_icon.png')}}" data-holder-rendered="true" > </a> 
							</div> 
							<div class="media-body"> <h4 class="media-heading">STEP 1</h4>
								<p>Sell those old costumes with Chrysalis</p> 
							</div> 
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="media"> 
							<div class="media-left"> <a href="#"> <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="{{asset('/assets/frontend/img/step_2_icon.png')}}" data-holder-rendered="true" > </a> 
							</div> 
							<div class="media-body"> <h4 class="media-heading">STEP 2</h4>
								<p>Get Cash or Store Credit</p> 
							</div> 
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="media"> 
							<div class="media-left"> <a href="#"> <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="{{asset('/assets/frontend/img/step_3_icon.png')}}" data-holder-rendered="true" > </a> 
							</div> 
							<div class="media-body"> <h4 class="media-heading">STEP 3</h4>
								<p>Buy another costume!</p> 
							</div> 
						</div>
					</div>
				</div>
				<!-- steps content div End here-->

				<!-- steps content sldier div start here-->
				<div class="steps-slider-div hidden-sm hidden-md hidden-lg">
					<div id="steps-sldier" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->


						<!-- text Wrapper for slides -->
						<div class="carousel-inner" role="listbox">

							<div class="item active">
								<div class="media"> 
									<div class="media-left"> <a href="#"> <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="{{asset('/assets/frontend/img/step_1_icon.png')}}" data-holder-rendered="true" > </a> 
									</div> 
									<div class="media-body"> <h4 class="media-heading">STEP 1</h4>
										<p>Sell those old costumes with Chrysalis</p> 
									</div> 
								</div>
							</div>

							<div class="item">
								<div class="media"> 
									<div class="media-left"> <a href="#"> <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="{{asset('/assets/frontend/img/step_1_icon.png')}}" data-holder-rendered="true" > </a> 
									</div> 
									<div class="media-body"> <h4 class="media-heading">STEP 1</h4>
										<p>Sell those old costumes with Chrysalis</p> 
									</div> 
								</div>
							</div>

							<div class="item">
								<div class="media"> 
									<div class="media-left"> <a href="#"> <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="{{asset('/assets/frontend/img/step_1_icon.png')}}" data-holder-rendered="true" > </a> 
									</div> 
									<div class="media-body"> <h4 class="media-heading">STEP 1</h4>
										<p>Sell those old costumes with Chrysalis</p> 
									</div> 
								</div>
							</div> 



						</div>

						<!-- Left and right controls -->
						<a class="left carousel-control" href="#steps-sldier" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#steps-sldier" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>

				<!-- steps content sldier div End here-->


			</div>
		</section> 
		<div class="container">
		</div>
		<div class="home_product_slider">
			<div class="container">
				<div class="row">
						<div class="col-xs-12">
					<h2>Featured Costumes</h2>
					<div class="owl-carousel owl-theme">
						<div class="item">
							<div class="img_layer">
								<img class="img-responsive" src="{{asset('/assets/frontend/img/captain-1.png')}}">
							</div>
							<div class="slider_cnt">
								<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
								<p>$50.00</p>
							</div>
						</div>
						<div class="item">
							<div class="img_layer">
								<img class="img-responsive" src="{{asset('/assets/frontend/img/rey-1.png')}}">
							</div>
							<div class="slider_cnt">
								<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
								<p>$50.00</p>
							</div>
						</div>
						<div class="item">
							<div class="img_layer">
								<img class="img-responsive" src="{{asset('/assets/frontend/img/wendy-1.png')}}">
							</div>
							<div class="slider_cnt">
								<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
								<p>$50.00</p>
							</div>
						</div>
						<div class="item">
							<div class="img_layer">
								<img class="img-responsive" src="{{asset('/assets/frontend/img/jasmine-1.png')}}">
							</div>
							<div class="slider_cnt">
								<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
								<p>$50.00</p>
							</div>
						</div>
						<div class="item">
							<div class="img_layer">
								<img class="img-responsive" src="{{asset('/assets/frontend/img/wendy-1.png')}}">
							</div>
							<div class="slider_cnt">
								<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
								<p>$50.00</p>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="home-adds">
			<div class="container">
				<div class="row">
					<div class="col-md-8  add1">
						<a href="#">
							<img class="img-responsive hidden-sm hidden-xs" src="{{asset('/assets/frontend/img/add11.png')}}">
							<img class="img-responsive hidden-md hidden-lg" src="{{asset('/assets/frontend/img/home-mini1.png')}}">
						</a>
					</div>
					<div class="col-md-4 add2">
						<a href="#">
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
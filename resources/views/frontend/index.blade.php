@extends('/frontend/app')
@section('title')
	Home@parent
@endsection
@section('styles')
@endsection

@section('content')
	<section class="main_banner">
    <div class="container">
	<div class="row">
	<div class="col-md-8 col-sm-8 col-xs-12 jumb-bnr">
	<a href="#"><img class="img-responsive" src="../assets/frontend/img/bnr-11.png"></a>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12 jumb-smll">
	<a href="#"><img class="img-responsive" src="../assets/frontend/img/bnr-22.png"></a>
		<a href="#"><img class="img-responsive" src="../assets/frontend/img/bnr-33.png"></a>
	</div>
	</div>
	<div class="container">
	<div class="row home_steps">
		<div class="col-md-4">
		<div class="media"> 
			<div class="media-left"> <a href="#"> <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="../assets/frontend/img/step_1_icon.png" data-holder-rendered="true" > </a> 
			</div> 
			<div class="media-body"> <h4 class="media-heading">STEP 1</h4>
			<p>Sell those old costumes with Chrysalis</p> 
			</div> 
		</div>
			</div>
				<div class="col-md-4">
		<div class="media"> 
			<div class="media-left"> <a href="#"> <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="../assets/frontend/img/step_2_icon.png" data-holder-rendered="true" > </a> 
			</div> 
			<div class="media-body"> <h4 class="media-heading">STEP 2</h4>
			<p>Get Cash or Store Credit</p> 
			</div> 
		</div>
			</div>
				<div class="col-md-4">
		<div class="media"> 
			<div class="media-left"> <a href="#"> <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="../assets/frontend/img/step_3_icon.png" data-holder-rendered="true" > </a> 
			</div> 
			<div class="media-body"> <h4 class="media-heading">STEP 3</h4>
			<p>Buy another costume!</p> 
			</div> 
		</div>
			</div>
		</div>
	</div> </div>
	 </section> 
	 <div class="home_product_slider">
	 <div class="container">
		<div class="row">
			<h2>Featured Costumes</h2>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="img_layer">
				<img class="img-responsive" src="../assets/frontend/img/captain-1.png">
				</div>
				<div class="slider_cnt">
				<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
				<p>$50.00</p>
				</div>
			</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="img_layer">
				<img class="img-responsive" src="../assets/frontend/img/rey-1.png">
				</div>
				<div class="slider_cnt">
				<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
				<p>$50.00</p>
				</div>
			</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="img_layer">
				<img class="img-responsive" src="../assets/frontend/img/wendy-1.png">
				</div>
				<div class="slider_cnt">
				<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
				<p>$50.00</p>
				</div>
			</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="img_layer">
				<img class="img-responsive" src="../assets/frontend/img/jasmine-1.png">
				</div>
				<div class="slider_cnt">
				<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
				<p>$50.00</p>
				</div>
			</div>
		</div>
	 </div>
	 </div>
	 <div class="home-adds">
		 <div class="container">
			<div class="row">
				<div class="col-md-8 add1">
				<a href="#">
				<img class="img-responsive" src="../assets/frontend/img/add11.png">
				</a>
				</div>
				<div class="col-md-4 add2">
					<a href="#">
				<img class="img-responsive" src="../assets/frontend/img/add22.png">
					</a>
				</div>
			</div>
		 </div>
	 </div>
@endsection
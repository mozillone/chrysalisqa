@extends('/frontend/app')
@section('styles')
@endsection
@section('content')
 	<section class="content create_section_page" ng-controller="ListingsController">
<!--  	list-banner container html start here -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="list-banner">
			@if(empty($data['sub_cat_info'][0]->banner_image))
			<img class="img-responsive" src="/category_images/df_img.jpg">
			@else
			<img class="img-responsive" src="/category_images/{{$data['sub_cat_info'][0]->banner_image}}">
			@endif
			</div>
		</div>
	</div>
</div>
<!--  	list-banner container html End here -->




<!--  	list- container html start here -->

<div class="prodcut_list_page">
<div class="container">
<div class="row">
<div class="col-md-3 col-sm-4">

<div class="list-box-rm list-box-rma">
<h2 class="list-box-head">KIDS COSTUMES</h2>
<ul class="box-list1">
<li>Boys</li>
<li>Girls</li>
<li class="active">Both</li>
</ul>
</div>




<div class="list-box-rm">
<h2 class="list-box-head">THEMES</h2>
<ul class="box-list1">
@foreach($data['sub_cats_list'] as $sub_cats_list)
<li @if($sub_cats_list->category_id==$data['sub_cat_info'][0]->category_id) class="active" @endif><a href="/shop/{{$sub_cats_list->category_id}}/{{$parent_cat_name}}/{{$sub_cats_list->name}}">{{$sub_cats_list->name}}</a></li>
@endforeach
</ul>
<h2 class="list-box-head narrow-head">NARROW BY</h2>
<div class="box-list1 narrow">
<div class="checkbox">
  <label><input type="checkbox" value="">Homemade Costumes</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="">Chrysalis Costumes</label>
</div>
</div>
<h2 class="list-box-head filter">FILTER</h2>
<h3 class="list-box-subhead">Zipcode</h3>
<p class="list-box-texti">Search for costumes close to you!</p>
<p class="list-box-search"><input type="text" placeholder="Enter postal code"><span class="box-search-arrw"><i class="fa fa-arrow-right" aria-hidden="true"></i></span></p>
<h3 class="list-box-subhead">Condition</h3>
<ul class="box-list2">
<li><input type="checkbox" name="condition"> Brand New</li>
<li><input type="checkbox" name="condition"> Good</li>
<li><input type="checkbox" name="condition"> Like New</li>
<li><input type="checkbox" name="condition"> Excellent</li>
</ul>

<h3 class="list-box-subhead">Size</h3>
<ul class="box-list3">
<li>1SZ</li>
<li class="middle">XXS</li>
<li>XS</li>
<li>S</li>
<li class="middle">M</li>
<li>L</li>
<li>XL</li>
<li class="middle">XXL</li>
</ul>
<h3 class="list-box-subhead">Price</h3>

</div>
</div>

<div class="col-md-9 col-sm-8">

<div class="list-sec-rm">
<p class="list-sec-rm1">{{$data['sub_cat_info'][0]->name}}</p>
<p class="list-sec-rm2"><span>Sort By</span> <select><option>Newest<option><option>Oldest<option></select></p>

</div>

<div class="list_products">
	<div class="row">
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">

					<div class="hover_box">
					<p class="like_fav"><span><i class="fa fa-thumbs-up" aria-hidden="true"></i> 43</span> <span><i class="fa fa-heart-o" aria-hidden="true"></i></span></p>
					<p class="hover_crt"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</p>
					</div>
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p> 
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">

					<div class="hover_box">
					<p class="like_fav"><span><i class="fa fa-thumbs-up" aria-hidden="true"></i> 43</span> <span><i class="fa fa-heart-o" aria-hidden="true"></i></span></p>
					<p class="hover_crt"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</p>
					</div>
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p> 
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">

					<div class="hover_box">
					<p class="like_fav"><span><i class="fa fa-thumbs-up" aria-hidden="true"></i> 43</span> <span><i class="fa fa-heart-o" aria-hidden="true"></i></span></p>
					<p class="hover_crt"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</p>
					</div>
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p> 
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">

					<div class="hover_box">
					<p class="like_fav"><span><i class="fa fa-thumbs-up" aria-hidden="true"></i> 43</span> <span><i class="fa fa-heart-o" aria-hidden="true"></i></span></p>
					<p class="hover_crt"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</p>
					</div>
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p> 
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<div class="prod_box">
				<div class="img_layer">
					<img class="img-responsive" src="http://chrysalis.com/assets/frontend/img/captain-1.png">
				</div>
				<div class="slider_cnt">
					<h4>Captain Jack Sparrow,Pirates of The Carribean </h4>
					<p>$50.00</p>
				</div>
			</div>
		</div>
		<div class="hidden-lg hidden-md hidden-sm col-xs-12 l_more text-center">
			<a href="#">Load More</a>
		</div>
	</div>
</div>

</div>

</div>
</div>
</div>
<!--  	list- container html End here -->


   </section>    
       
@stop
{{-- page level scripts --}}
@section('footer_scripts')
@stop

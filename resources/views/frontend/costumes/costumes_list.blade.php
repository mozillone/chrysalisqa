@extends('/frontend/app')
@section('styles')
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
 @endsection
@section('content')
 	<section class="content create_section_page">
 	<div id="ohsnap"></div>
<!--  	list-banner container html start here -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="list-banner">
			@if(empty($data['sub_cat_info'][0]->banner_image) || !file_exists('/category_images/Banner/{{$data["sub_cat_info"][0]->banner_image}}'))
			<img class="img-responsive" src="/category_images/df_img.jpg">
			@else
			<img class="img-responsive" src="/category_images/Banner/{{$data['sub_cat_info'][0]->banner_image}}">
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
	<input type="hidden" name="parent_cat_name" value="{{$parent_cat_name}}"/>
	<input type="hidden" name="sub_cat_name" value="{{$data['sub_cat_info'][0]->name}}"/>
	<input type="hidden" name="sub_cat_name" value="{{$data['sub_cat_info'][0]->name}}"/>
	<input type="hidden" name="is_login" value="{{Auth::check()}}"/>
	<form id="search_list">
	<input type="hidden" name="cat_id" value="{{$data['sub_cat_info'][0]->category_id}}"/>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="col-md-3 col-sm-4">

	<div class="list-box-rm list-box-rma">
	<h2 class="list-box-head">KIDS COSTUMES</h2>
	<ul class="box-list1 gender">
	<li data-gender="male">Boys</li>
	<li data-gender="female">Girls</li>
	<li data-gender="unisex">Both</li>
	</ul>
	<input type="hidden" name="search[gender]" class="search"/>
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
	  <label><input type="checkbox" name="search[created_user_group][]" value="user" class="search">Homemade Costumes</label>
	</div>
	<div class="checkbox">
	  <label><input type="checkbox" name="search[created_user_group][]" value="admin" class="search">Chrysalis Costumes</label>
	</div>
	</div>
	<h2 class="list-box-head filter">FILTER</h2>
	<h3 class="list-box-subhead">Zipcode</h3>
	<p class="list-box-texti">Search for costumes close to you!</p>
	<p class="list-box-search"><input type="text" placeholder="Enter postal code" name="search[zip_code]"><span class="box-search-arrw search"><i class="fa fa-arrow-right" aria-hidden="true"></i></span></p>
	<h3 class="list-box-subhead">Condition</h3>
	<ul class="box-list2">
	<li><input type="checkbox" name="search[condition][]" value="brand_new" class="search"> Brand New</li>
	<li><input type="checkbox" name="search[condition][]" value="good" class="search"> Good</li>
	<li><input type="checkbox" name="search[condition][]" value="like_new" class="search"> Like New</li>
	<li><input type="checkbox" name="search[condition][]" value="excellent" class="search"> Excellent</li>
	</ul>

	<h3 class="list-box-subhead">Size</h3>
	<ul class="box-list3 sizes">
	<li data-size="1sz">1SZ</li>
	<li data-size="xxs" class="middle">XXS</li>
	<li data-size="xs">XS</li>
	<li data-size="s">S</li>
	<li data-size="m" class="middle">M</li>
	<li data-size="l">L</li>
	<li data-size="xl">XL</li>
	<li data-size="xxl" class="middle">XXL</li>
	<input type="hidden" name="search[sizes]"/>
	</ul>
	<h3 class="list-box-subhead">Price</h3>
<div class="list-stl row">
						<div class="col-sm-12 rng">	
								
								<input type="hidden" id="amount2"   name="search[price]" readonly style="border:0; color:#f6931f; font-weight:bold;" value="" class="form-control">
								
								 <div id="price-range"></div>
							      <div class="row price_amt">
									 <div class="col-md-6">
									 <p class="text-left price_min">$0</p>
									 </div>
									 <div class="col-md-6">
									 <p class="text-right price_max">$10000</p>
									 </div> 
                                 </div>

							</div>
					</div>
	</div>
	</div>

	<div class="col-md-9 col-sm-8">

	<div class="list-sec-rm">
	<p class="list-sec-rm1">{{$data['sub_cat_info'][0]->name}}</p>
	<p class="list-sec-rm2"><span>Sort By</span>
	 <select name="search[sort_by]" class="sort_by">
		<option value="Recently Listed">Recently Listed</option>
		<option value="price_high">Price - High to Low</option>
		<option value="price_low">Price - Low to High</option>
		<option value="a-z">A-Z</option>
		<option value="z-a">Z-A</option>
	 </select>
	 </p>

	</div>

<div class="list_products">
	<div class="row" id="itemContainer">
	</div>
</div>
<ul class="holder list_pagination"></ul>


	</div>
</form>
</div>
</div>
</div>
<!--  	list- container html End here -->


   </section>    
       
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="{{ asset('/js/ohsnap.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/jPages.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costumes_listing.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-fav.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-like.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/mini_cart.js') }}"></script>

@stop

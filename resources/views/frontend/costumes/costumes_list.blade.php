@extends('/frontend/app')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/vendors/lobibox-master/css/lobibox.css') }}">
	<style>
	

	</style>
 @endsection
@section('content')
 	<section class="content create_section_page">
 	<div id="ohsnap"></div>
<!--  	list-banner container html start here -->

<div class="container">
	<div class="row">
		<div class="col-md-12 col-xs-12 col-sm-12"" ">
			<div class="list-banner" @if(empty($data['sub_cat_info'][0]->banner_image) || !file_exists(public_path('category_images/Banner/'.$data["sub_cat_info"][0]->banner_image.''))) style=" background-image: url('/category_images/df_img.jpg')" @else style=" background-image: url('/category_images/Banner/{{$data['sub_cat_info'][0]->banner_image}}')" @endif>
			
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
	@if(!empty($parent_cat))<input type="hidden" name="is_main" value="{{ $parent_cat }}"> @endif
	<div class="col-md-3 col-sm-4 list_view_left_view clearfix hidden-xs">
        @if($parent_cat_name == "kids")    
	<div class="list-box-rm list-box-rma">
	<h2 class="list-box-head">KIDS COSTUMES</h2>
	<ul class="box-list1 gender">
		<li data-gender="male">Men's</li>
		<li data-gender="female">Women's</li>
		<!-- <li data-gender="unisex">Both</li> -->
		<li data-gender="boy">Boys</li>
		<li data-gender="girl">Girls</li>
		<li data-gender="baby">Babies</li>
	</ul>
	<input type="hidden" name="search[gender]" class="search"/>
	</div>
        @endif
        @if($parent_cat_name != "mens" && $parent_cat_name != "womens" && $parent_cat_name != "pets" && $parent_cat_name != "kids")
        <div class="list-box-rm list-box-rma">
        <h2 class="list-box-head">GENDER COSTUMES</h2>
	<ul class="box-list1 gender">
	<li data-gender="male">Men's</li>
	<li data-gender="female">Women's</li>
	<!-- <li data-gender="unisex">Both</li> -->
	<li data-gender="boy">Boys</li>
	<li data-gender="girl">Girls</li>
	<li data-gender="baby">Babies</li>
	</ul>
	<input type="hidden" name="search[gender]" class="search"/>
	</div>
        @endif


	<div class="list-box-rm">
	<h2 class="list-box-head">THEMES</h2>
	<ul class="box-list1">
	<li @if(Request::url()==URL::to("category/".$parent_cat_name)) class="active" @endif><a href="/category/{{$parent_cat_name}}">See All</a></li>
	@foreach($categories_list as $key=>$sub_cats_list)
	<li @if(Request::url()==URL::to("category".$sub_cats_list)) class="active" @endif ><a href="/category{{$sub_cats_list}}">{{$key}}</a></li>
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
        <li><input type="checkbox" name="search[condition][]" value="like_new" class="search"> Like New</li>
        <li><input type="checkbox" name="search[condition][]" value="excellent" class="search"> Excellent</li>
	<li><input type="checkbox" name="search[condition][]" value="good" class="search"> Good</li>
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
<div class="list-stl row price-range-slider">
						<div class="col-sm-12 rng">	
								
								<input type="hidden" id="amount2"   name="search[price]" readonly style="border:0; color:#f6931f; font-weight:bold;" value="" class="form-control">
								
								 <div id="price-range"></div>
							      <div class="row price_amt">
									 <div class="col-md-6 col-xs-6">
									 <p class="text-left price_min">$0</p>
									 </div>
									 <div class="col-md-6 col-xs-6">
									 <p class="text-right price_max">$10000</p>
									 </div> 
                                 </div>

							</div>
					</div>
	</div>
	</div>
	<div class="hidden-sm hidden-md hidden-lg col-xs-12 mbl_slct-drp">
	<p class="list-sec-rm1 mobile_heading_list">{{strtoupper($data['sub_cat_info'][0]->name)}}</p>
		<select class="form-control" id="theams">
			<!-- <li @if(Request::url()==URL::to("category/".$parent_cat_name)) class="active" @endif><a href="/category/{{$parent_cat_name}}">See All</a></li> -->
			<option value="/category/{{$parent_cat_name}}" @if(Request::url()==URL::to("category".$parent_cat_name)) selected="" @endif >See All</option>
		@foreach($categories_list as $key=>$sub_cats_list)
    		<option value="/category{{$sub_cats_list}}" @if(Request::url()==URL::to("category".$sub_cats_list)) selected="" @endif >{{$key}}</option>
    	@endforeach
		</select>
	</div>
	<div class="col-md-9 col-sm-8 col-xs-12">

	<div class="list-sec-rm hidden-xs ">
	<p class="list-sec-rm1">{{strtoupper($data['sub_cat_info'][0]->name)}}</p>
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
	<div class="clearfix"></div>
	
	<div class="hidden-sm hidden-md hidden-lg row filer-divs">
							<div  class="col-xs-12">
								<div class="hidden-sm hidden-md hidden-lg col-xs-6 filer_left">
									<div id="main">
										<span style="cursor:pointer" onclick="openNav()"><i class="fa fa-filter" aria-hidden="true"></i> Filer By <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
									</div>
								</div>
								<div class="hidden-sm hidden-md hidden-lg col-xs-6 filer_right mbl_sort">
									<i class="fa fa-sort-amount-asc" aria-hidden="true"></i> Sort  By</div>
								<div id="myfilter-sidenav" class="filter-sidenav">
									<div class="col-xs-6 hidden-md hidden-sm hidden-lg">
										<h3 class="fl_head" >FILTER BY</h3>
										<input type="hidden" name="search[mbl_sort]" class="search"/>
									</div>
									<div class="col-xs-6 hidden-md hidden-sm hidden-lg">
										<a href="javascript:void(0)" class="closebtn filetr-close" onclick="closeNav()">Done</a>
									</div>
									<div class="mobile_list_filers_sider clearfix">
										<div class="panel-group1" id="accordion-fl">
											<div class="panel panel-default">
												@if($parent_cat_name == "kids")
												<div class="list-box-rm list-box-rma">
													<div class="panel-heading1">
														<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-fl" href="#collapseOne1">
																<h2 class="list-box-head">KIDS COSTUMES <span class="glyphicon glyphicon-plus"></span></h2>    
															</a>
														</h4>
													</div>
													<!--<h2 class="list-box-head">KIDS COSTUMES</h2>-->
													<div id="collapseOne1" class="panel-collapse collapse">
														<div class="panel-body">
															<ul class="box-list1 gender">
															<li data-gender="male">Men's</li>
															<li data-gender="female">Women's</li>
															<!-- <li data-gender="unisex">Both</li> -->
															<li data-gender="boy">Boys</li>
															<li data-gender="girl">Girls</li>
															<li data-gender="baby">Babies</li>
																<!-- <li data-gender="male">Boys</li>
																<li data-gender="female">Girls</li>
																<li data-gender="unisex">Both</li> -->
															</ul>
														</div>
													</div>
													<input type="hidden" name="search[gender]" class="search"/>
												</div>
												@endif
												@if($parent_cat_name != "mens" && $parent_cat_name != "womens" && $parent_cat_name != "pets" && $parent_cat_name != "kids")
														<div class="list-box-rm list-box-rma">
															<div class="panel-heading1">
																<h4 class="panel-title">
																	<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-fl" href="#collapseOne1">
																		<h2 class="list-box-head">GENDER COSTUMES <span class="glyphicon glyphicon-plus"></span></h2>
																	</a>
																</h4>
															</div>
															<!--<h2 class="list-box-head">KIDS COSTUMES</h2>-->
															<div id="collapseOne1" class="panel-collapse collapse">
																<div class="panel-body">
																	<ul class="box-list1 gender">
																		<!-- <li data-gender="male">Men's</li>
																		<li data-gender="female">Women's</li>
																		<li data-gender="unisex">Both</li> -->
																		<li data-gender="male">Men's</li>
																		<li data-gender="female">Women's</li>
																		<!-- <li data-gender="unisex">Both</li> -->
																		<li data-gender="boy">Boys</li>
																		<li data-gender="girl">Girls</li>
																		<li data-gender="baby">Babies</li>
																	</ul>
																</div>
															</div>
															<input type="hidden" name="search[gender]" class="search"/>
														</div>
												@endif
												
												<div class="list-box-rm ">
													<div class="panel-heading1">
														<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne2">
																<h2 class="list-box-head">NARROW BY <span class="glyphicon glyphicon-plus"></span></h2>    
															</a>
														</h4>
													</div>
													<!--<h2 class="list-box-head narrow-head">NARROW BY</h2>-->
													<div id="collapseOne2" class="panel-collapse collapse ">
														<div class="panel-body">
															<div class="box-list1 narrow">
																<div class="checkbox">
																	<label><input type="checkbox" name="search[created_user_group][]" value="user" class="search">Homemade Costumes</label>
																</div>
																<div class="checkbox">
																	<label><input type="checkbox" name="search[created_user_group][]" value="admin" class="search">Chrysalis Costumes</label>
																</div>
															</div>
														</div>
													</div>
													</div>
													
													<div class="list-box-rm ">
													<div class="panel-heading1">
														<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne3">
																<h2 class="list-box-head">Zipcode <span class="glyphicon glyphicon-plus"></span></h2>    
															</a>
														</h4>
													</div>
													<!--<h2 class="list-box-head filter">FILTER</h2>-->
													<div id="collapseOne3" class="panel-collapse collapse">
														<div class="panel-body">
															<!--<h3 class="list-box-subhead">Zipcode</h3>-->
															<p class="list-box-texti">Search for costumes close to you!</p>
															<p class="list-box-search"><input type="text" placeholder="Enter postal code" name="search[zip_code_mbl]"><span class="box-search-arrw search"><i class="fa fa-arrow-right" aria-hidden="true"></i></span></p>
														</div>
													</div>
													</div>
													<div class="list-box-rm ">
													<div class="panel-heading1">
														<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne4">
																<h2 class="list-box-head">Condition <span class="glyphicon glyphicon-plus"></span></h2>    
															</a>
														</h4>
													</div>
													<div id="collapseOne4" class="panel-collapse collapse">
														<div class="panel-body">
															<!--<h3 class="list-box-subhead">Condition</h3>-->
															<ul class="box-list2">
																<li><input type="checkbox" name="search[condition][]" value="brand_new" class="search"> Brand New</li>
																<li><input type="checkbox" name="search[condition][]" value="good" class="search"> Good</li>
																<li><input type="checkbox" name="search[condition][]" value="like_new" class="search"> Like New</li>
																<li><input type="checkbox" name="search[condition][]" value="excellent" class="search"> Excellent</li>
															</ul>
														</div>
													</div>
													</div>
													
													<div class="list-box-rm ">
													<div class="panel-heading1">
														<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne5">
																<h2 class="list-box-head">Size <span class="glyphicon glyphicon-plus"></span></h2>    
															</a>
														</h4>
													</div>
													<!--<h3 class="list-box-subhead">Size</h3>-->
													<div id="collapseOne5" class="panel-collapse collapse">
														<div class="panel-body">
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
														</div>
													</div>
														</div>
																<div class="list-box-rm ">
													<div class="panel-heading1">
														<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsesix">
																<h2 class="list-box-head">Price <span class="glyphicon glyphicon-plus"></span></h2>    
															</a>
														</h4>
													</div>
													<!--<h3 class="list-box-subhead">Price</h3>-->
													<div id="collapsesix" class="panel-collapse collapse">
														<div class="panel-body">
															<div class="list-stl row price-range-slider">
																<div class="col-sm-12 rng">	
																	<input type="hidden" id="amount2"   name="search[price_mbl]" readonly style="border:0; color:#f6931f; font-weight:bold;" value="" class="form-control">
																	<div id="price-range"></div>
																	<div class="row price_amt">
																		<div class="col-md-6 col-xs-6">
																			<p class="text-left price_min">$0</p>
																		</div>
																		<div class="col-md-6 col-xs-6">
																			<p class="text-right price_max">$10000</p>
																		</div> 
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	

<div class="list_products list-img-bg">
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
<script src="{{ asset('/assets/frontend/js/jquery-ui.js') }}"></script>
<script src="{{ asset('/js/ohsnap.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/jPages.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costumes_listing.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-fav.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-like.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/mini_cart.js') }}"></script>
<script src="{{ asset('/assets/frontend/vendors/lobibox-master/js/notifications.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function()
	{
		$(document).on("click", ".holder a.jp-current ,.jp-next,.jp-previous",function () {
		$('html,body').animate({
		scrollTop: 300
		}, 700);
	});
	});
</script>


@stop

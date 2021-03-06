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
	@if(isset($pageData) && !empty($pageData))
	<?php echo $pageData->description ?>
	@else
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if(!empty($search_banner_settings->file_name))
					{
						$url = '/category_images/Banner/'.$search_banner_settings->file_name;
						}else{
						$url = '/category_images/df_img.jpg';
					}
				?>
				<div class="list-banner search-banner" style=" background-image: url(<?php echo $url;  ?>)">
				</div>
			</div>
		</div>
	</div>
</div>
@endif
<!--  	list-banner container html End here -->
<!--  	list- container html start here -->
<div class="prodcut_list_page">
	<div class="container">
		<div class="row">
			<input type="hidden" name="is_login" value="{{Auth::check()}}"/>
			<form id="search_list" action="{{url('getSearchCostumesData')}}"  method="get">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="key" value="{{ $_GET['key'] }}">
				<div class="col-md-3 col-sm-4 list_view_left_view clearfix hidden-xs">
					<div class="list-box-rm list-box-rma">
						<h2 class="list-box-head">GENDER COSTUMES</h2>
						<ul class="box-list1 gender">
							<li data-gender="" class="active">See All</li>
							<li data-gender="male">Mens</li>
							<li data-gender="female">Womens</li>
							<li data-gender="boy">Boys</li>
							<li data-gender="girl">Girls</li>
							<li data-gender="baby">Babies</li>
						</ul>
						<input type="hidden" name="search[gender]" class="search"/>
					</div>
					<div class="list-box-rm">
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
							<li><input type="checkbox" name="search[condition][]" value="good" class="search"> Good</li>
							<li><input type="checkbox" name="search[condition][]" value="like_new" class="search"> Like New</li>
							<li><input type="checkbox" name="search[condition][]" value="brand_new" class="search"> Brand New</li>
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
							<li data-size="std">STD</li>
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
				<div class="col-md-9 col-sm-8">
					<div class="list-sec-rm">
						<p class="list-sec-rm1">Search Results for "{{ ucfirst($_GET['key']) }}"</p>
						<p class="list-sec-rm2"><span>Sort By</span>
							<select name="search[sort_by]" class="sort_by">
								<option value="recently_listed">Recently Listed</option>
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
								<i class="fa fa-sort-amount-asc" aria-hidden="true"></i> Sort  By
							</div>
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
															<li data-gender="" class="active">See All</li>
															<li data-gender="male">Mens</li>
															<li data-gender="female">Womens</li>
															<li data-gender="boy">Boys</li>
															<li data-gender="girl">Girls</li>
															<li data-gender="baby">Babies</li>
														</ul>
													</div>
												</div>
												<input type="hidden" name="search[gender]" class="search"/>
											</div>
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
															<li><input type="checkbox" name="search[condition][]" value="good" class="search"> Good</li>
															<li><input type="checkbox" name="search[condition][]" value="like_new" class="search"> Like New</li>
															<li><input type="checkbox" name="search[condition][]" value="brand_new" class="search"> Brand New</li>
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
															<li data-size="std">STD</li>
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
						@if (Session::has('error'))
							<div class="alert alert-danger alert-dismissable exception_case">
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
								{{ Session::get('error') }}
							</div>
						@elseif(Session::has('success'))
							<div class="alert alert-success alert-dismissable exception_case">
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
								{{ Session::get('success') }}
							</div>
						@endif
                      
						@if(count($costumes)>0)
							<div id="search-container">
							<div class="list_products list-img-bg">
								<div class="row" id="">						 
								@foreach($costumes as $costume)
								<div class="col-md-3 col-sm-4 col-xs-6">
									<div class="prod_box">
										<div class="img_layer">
											<a href="{{url('product')}}{{$costume->url_key}}" style="background-image:url(/costumers_images/Medium/{{$costume->image}});background-repeat:no-repeat;">&nbsp;
											</a>
											@if(Auth::check())
											<div class="hover_box">
											<p class="like_fav">
												<a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-thumbs-up"></i>0</span>
												</a> 
												<a href="#" onclick="return false;" class="fav_costume" data-costume-id="{{$costume->costume_id}}" ><span class="@if($costume->is_fav) active @endif"><i aria-hidden="true" class="fa fa-heart-o"></i></span></a>
											</p>
													<p class="hover_crt add-cart" data-costume-id="{{$costume->costume_id}}">
														<i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart
													</p>
											</div>
											@endif
										</div>
											@if($costume->film_qlty ==32)
												<p class="ystrip-rm">
													<span>
														<img class="img-responsive" src="{{url('assets/frontend/img/film.png')}}"> Film Quality
													</span>
												</p>
											@endif
												<div class="slider_cnt no_brand sml_name">
													<span class="cc_brand"></span>
														<h4>
															<a href="{{url('product')}}{{$costume->url_key}}">{{substr($costume->name, 0, 40)}}</a>
														</h4>
														<p>
															<a href="{{url('product')}}{{$costume->url_key}}">
															<span class="new-price">${{$costume->price}}</span>
															</a>
														</p>
												</div>
										</div>
								</div>
								@endforeach
								</div>
							</div>
						@else
						 <div class="col-md-8 no_lists">
						  <p>Sorry, we could not find any costumes</p>
						 </div>
						@endif
						
						<ul class="holder list_pagination">	
 							{{$costumes->links('/frontend/pagination')}}
 							@if($count>12)
							<div class="pagination_btm">
							 	<label>Show </label>
							 	<select class="per_page">
							 		<option value="12">12</option>
							 		<option value="24">24</option>
							 		<option value="48">48</option>
							 	</select>
							 	<label> per page </label>	
							</div>
							@endif
						</ul>
						</div>
				</div>
					<input type="hidden" id="page" name="page" class="ses_val" value="">
					<input type="hidden" name="perpage" id="perpage" class="perpage_val" value="">
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
<script src="{{ asset('/assets/frontend/js/pages/search_costumes_listing.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-fav.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-like.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/mini_cart.js') }}"></script>
<script src="{{ asset('/assets/frontend/vendors/lobibox-master/js/notifications.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
	    
	    if( $("ul.pagination").length == 0)
	    {
	        $(".holder.list_pagination").css({"border":"none"});
	    }
		$(document).on("click", ".pagination li a",function () {
			$('html,body').animate({
				scrollTop: 300
			}, 700);
		});
		var queryString = window.location.href.slice(window.location.href.indexOf('?'));
		var res = queryString.substring(9,11);
		var filter_url = location.href.split("?")[0];
		
		  $("#per_page > option").each(function() {
		    if (this.value == res) {
		      this.selected = 'selected';
		    }
		  });
		  
		 $(".per_page").val("{{session('perpage')===null ? 12 : session('perpage')}}");
	});
</script>

@stop
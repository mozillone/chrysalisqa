@extends('/frontend/app')
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
<section class="product_Details_page">
	<div class="container">
<div class="row">
<div class="col-md-5">

</div>

<div class="col-md-7">
<div class="product_view_rm">
<h1>Captain Jack Sparrow, Pirates of the Carribean</h1>

<!---Price section start -->
	<div class="row">
	<div class="priceview_rm">
	<div class="col-xs-6 col-sm-8 viewpr_rm">
	<h2>$59.00</h2>

	<p class="ystrip-rm"><span><img class="img-responsive" src="{{asset('assets/frontend/img/film.png')}}"> Film Quality</span></p>
	<p class="iCondition-rm"><span class="iBold-rm">Item Condition:</span> Like New</p>
	<p class="iCondition-rm"><span class="iBold-rm">Size:</span> Boys small</p>
	</div>

	<div class="col-xs-6 col-sm-4 viewBtn_rm">
	<button type="button" class="addtocart-rm"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</button>
	<button type="button" class="buynow-rm">Buy it Now!</button>
	</div>

	</div>
	</div>
<!---Price section End -->
	<div class="shipping_rm">
	<p class="shipp-rm"><label>Shipping:</label> $11.00 Expedited Shipping | <a href="javascript:void(0);">See Details</a></p>
	<p class="shipp-rm1">Item location: Brooklyn, NY USA <br/>Ships to: United States</p>
	<p class="shipp-rm shipp-rm-20"><label>Delivery:</label> Estimated between Wed. Oct. 5 and Sat. Oct. 8 <i class="fa fa-info-circle" aria-hidden="true"></i></p>
	</div>
	<p class="returns-rm">Returns: <span>Seller does not offer returns</span></p>


	<div class="viewTabs_rm">
	<ul class="nav nav-tabs viewTabs">
				<li class="active">
	        <a  href="#viewTabs1" data-toggle="tab">Costume Description</a>
				</li>
				<li><a href="#viewTabs2" data-toggle="tab">FAQ</a>
				</li>
				<li><a href="#viewTabs3" data-toggle="tab">Seller Information</a>
				</li>
	</ul>

			<div class="tab-content viewTabs-content">
			
		<div class="tab-pane active" id="viewTabs1">

<!-- tab content starts -->
				
		<p class="viewTabs-text">Meet Captain Jack Sparrow, Pirate from the Pirates of the Caribbean.</p>

		<p class="viewTabs-text">Why should girls have all the fun? Boys love to dress up to and this is a great costume for them. Whether it's a trip to Disney, Halloween, or just because he wants to be Captain Jack for the day this is a fun costume.</p>

		<p class="viewTabs-text">Included in this set is a cream colored pirate shirt with the puffy, over-sized sleeves and lace up front. The lined vest is made from a weathered looking blue cotton that shows he's been having fun adventuring out to sea. A sash and head bandanna finish the look perfectly. All parts of this costume are made in cotton and are machine washable. Line dry to avoid shrinking.</p>

<!-- tab content End -->			
			
		</div>
		
		<div class="tab-pane" id="viewTabs2">

<!-- tab content starts -->
				
		<p class="viewTabs-text">Why should girls have all the fun? Boys love to dress up to and this is a great costume for them. Whether it's a trip to Disney, Halloween, or just because he wants to be Captain Jack for the day this is a fun costume.</p>

		<p class="viewTabs-text">Included in this set is a cream colored pirate shirt with the puffy, over-sized sleeves and lace up front. The lined vest is made from a weathered looking blue cotton that shows he's been having fun adventuring out to sea. A sash and head bandanna finish the look perfectly. All parts of this costume are made in cotton and are machine washable. Line dry to avoid shrinking.</p>			

<!-- tab content End -->			
			
		</div>

		
		<div class="tab-pane" id="viewTabs3">
<!-- tab content starts -->

		<p class="viewTabs-text">Included in this set is a cream colored pirate shirt with the puffy, over-sized sleeves and lace up front. The lined vest is made from a weathered looking blue cotton that shows he's been having fun adventuring out to sea. A sash and head bandanna finish the look perfectly. All parts of this costume are made in cotton and are machine washable. Line dry to avoid shrinking.</p>				

<!-- tab content End -->			
			
		</div>
		
		  </div>

		  
	</div>			
			
	<div class="likeview-rm">
	<p class="likeview-rm1"><span>Like this costume?</span> <span class="like-span">Vote Up! <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span> <span class="like-span1"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 43</span></p>
	<p class="likeview-rm2"><a href="javascript:void(0);"><i class="fa fa-flag" aria-hidden="true"></i> Report Item</a></p>
	</div>

</div>
</div>

<div class="col-md-12 detailes_view_slider">
<h2 class="viewHead-rm">People Also Viewing</h2>
<div class="home_product_slider">
			<div class="container">
				<div class="row">
						<div class="col-xs-12">
					<div class="owl-carousel owl-theme">
						<div class="item">
							<div class="img_layer">
								<img class="img-responsive" src="{{asset('/assets/frontend/img/captain-1.png')}}">
							</div>
							<div class="slider_cnt">
								<h4>Boy’s Handmade Pirate Costume</h4>
								<p>$50.00</p>
							</div>
						</div>
						<div class="item">
							<div class="img_layer">
								<img class="img-responsive" src="{{asset('/assets/frontend/img/rey-1.png')}}">
							</div>
							<div class="slider_cnt">
								<h4>Boy’s Handmade Pirate Costume</h4>
								<p>$50.00</p>
							</div>
						</div>
						<div class="item">
							<div class="img_layer">
								<img class="img-responsive" src="{{asset('/assets/frontend/img/wendy-1.png')}}">
							</div>
							<div class="slider_cnt">
								<h4>Boy’s Handmade Pirate Costume</h4>
								<p>$50.00</p>
							</div>
						</div>
						<div class="item">
							<div class="img_layer">
								<img class="img-responsive" src="{{asset('/assets/frontend/img/jasmine-1.png')}}">
							</div>
							<div class="slider_cnt">
								<h4>Boy’s Handmade Pirate Costume</h4>
								<p>$50.00</p>
							</div>
						</div>
						<div class="item">
							<div class="img_layer">
								<img class="img-responsive" src="{{asset('/assets/frontend/img/wendy-1.png')}}">
							</div>
							<div class="slider_cnt">
								<h4>Boy’s Handmade Pirate Costume</h4>
								<p>$50.00</p>
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
</section>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('/assets/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/home.js') }}"></script>
@stop

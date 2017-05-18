@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/frontend/vendors/jquery.bxslider/jquery.bxslider.css') }}">
 <link rel="stylesheet" href="{{ asset('/assets/frontend/vendors/lobibox-master/css/lobibox.css') }}">
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
	<nav class="breadcrumb">
  <a class="breadcrumb-item" href="/">Home &nbsp;&nbsp;></a>
  <a class="breadcrumb-item" href="/category/{{$parent_cat_name}}/{{$sub_cat_name}}">{{$data[0]->cat_name}} > &nbsp;</a>
  <span class="breadcrumb-item active">{{$data[0]->name}}</span>
</nav>
<div class="col-md-5 carousel-bg-style bxslider-strt">

<ul class="bxslider">
@foreach($data['images'] as $images)
  <li><img class="img-responsive" src="{{asset('/costumers_images/Medium')}}/<?= $images->image?>"></li>
@endforeach
 </ul>

<div id="bx-pager" class="bxslider-rm">
  <?php $count=0;?>
  @foreach($data['images'] as $images)
  <a data-slide-index="{{$count}}" href=""><img class="img-responsive" src="{{asset('/costumers_images/Medium')}}/<?= $images->image?>"></a>
  <?php $count++;?>
  @endforeach
</div>

</div>

<div class="col-md-7">
<div class="product_view_rm">
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissable">
	<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
	{{ Session::get('error') }}
</div>
@elseif(Session::has('success'))
<div class="alert alert-success alert-dismissable">
	<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
	{{ Session::get('success') }}
</div>
@endif
<h1 class="social-media-sec">


{{$data[0]->name}}
@if(Auth::check())
	<a href="#" onclick="return false;" class="fav_costume" data-costume-id='{{$data[0]->costume_id}}'>

@else
	<a data-toggle="modal" data-target="#login_popup_fav">
@endif

<span @if($data[0]->is_fav)  class="active" @endif>@if($data[0]->is_fav)<i aria-hidden=true class="fa fa-heart"></i> @else <i aria-hidden=true class="fa fa-heart-o"></i>@endif</span></a>
<div>
	<a href="javascript:void(0)" onclick="genericSocialShare('http://www.facebook.com/sharer.php?title={{$data[0]->name}}&&u={{Request::url()}}')"><i class="fa fa-facebook" aria-hidden="true"></i></a>  
	<a href="javascript:void(0)" onclick="genericSocialShare('http://twitter.com/share?&amp;url={{Request::url()}}')"><i class="fa fa-twitter" aria-hidden="true"></i></a>
	<a  href="javascript:void(0)" onclick="genericSocialShare('https://plus.google.com/share?url={{Request::url()}}')"><i class="fa fa-envelope" aria-hidden="true"></i></a>
</div>
	</h1> 

<!---Price section start -->
	<div class="row">
	<div class="priceview_rm">
	<div class="col-xs-6 col-sm-8 viewpr_rm">
	<h2>@if($data[0]->created_user_group=="admin" && $data[0]->discount!=null && $data[0]->uses_customer<$data[0]->uses_total && date('Y-m-d',strtotime("now"))>=date('Y-m-d',strtotime($data[0]->date_start)) && date('Y-m-d',strtotime("now"))<=date('Y-m-d',strtotime($data[0]->date_end)))
		<?php $discount=($data[0]->price/100)*($data[0]->discount);
			  $new_price=$data[0]->price-$discount;
		?>
		<p><span class="old-price"><strike>${{number_format($data[0]->price,2, '.', ',')}}</strike></span> <span class="new-price">${{number_format($new_price,2, '.', ',')}}</span></p>
		@else
		<p><span class="new-price">${{number_format($data[0]->price,2, '.', ',')}}</span></p>
		@endif
		</h2>
	<p class="ystrip-rm"><span><img class="img-responsive" src="{{asset('assets/frontend/img/film.png')}}"> Film Quality</span></p>
	<p class="iCondition-rm"><span class="iBold-rm">Item Condition:</span>  @if($data[0]->condition=="brand_new") Brand New @elseif($data[0]->condition=="like_new") Like New @else {{ucfirst($data[0]->condition)}} @endif </p>
	<p class="iCondition-rm"><span class="iBold-rm">Size:</span> {{ucfirst($data[0]->gender)}} @if($data[0]->size=="s") small @elseif($data[0]->size=="m") medium @elseif($data[0]->size=="l") large @else {{strtoupper($data[0]->size)}} @endif</p>
	</div>

	<div class="col-xs-6 col-sm-4 viewBtn_rm">
	@if(helper::verifyCostumeQuantity($data[0]->costume_id,$data[0]->quantity+1) && $data[0]->quantity>0)
		<button type="button" class="addtocart-rm add-cart" data-costume-id="{{$data[0]->costume_id}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</button>
		@if(!Auth::check())
		<button type="button" class="buynow-rm"><a data-toggle="modal" data-target="#login_popup" class="buynow-rm">Buy it Now!</a> </button>
		 @else
			 <form action="{{route('buy-it-now')}}" method="POST"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="costume_id" value="{{ $data[0]->costume_id }}">
									 <input type="submit" class="addtocart-rm" value="Buy it Now!">
			</form>
		@endif
	 @else
		 <button type="button" class="addtocart-rm" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Out of stock</button>
	@endif
	</div>

	</div>
	</div>
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
		<p class="viewTabs-text">{{$data[0]->description}}</p>
		</div>
		<div class="tab-pane" id="viewTabs2">
		<p class="viewTabs-text">@if(count($data['faq'])) {{$data['faq'][0]->attribute_option_value}} @else <span>No FAQ found</span> @endif</p>			
		</div>

		
		<div class="tab-pane" id="viewTabs3">
		<p class="viewTabs-text">@if(!empty($data['seller_info'])) <p>Name: <span>{{$data['seller_info'][0]->display_name}}</span></p><p>Email: <span>{{$data['seller_info'][0]->email}}</span><p>Phone: <span>{{$data['seller_info'][0]->phone_number}}<span></p></p> @else <h3>No data found</h3> @endif</p>				
		</div>
		
		  </div>

		  
	</div>			
			
	<div class="likeview-rm">
	<p class="likeview-rm1">
		<span>Like this costume?</span>
		 @if(Auth::check())
		 <a href="#" onclick="return false;" class="like_costume_view" data-costume-id='{{$data[0]->costume_id}}'>
		 @else 
		 <a data-toggle="modal" data-target="#login_popup">
		 @endif <span class="like-span">
		 	Vote Up!</span></a>
		 </span>
		  <span class="like-span1 @if($data[0]->is_like)active @endif"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$data[0]->like_count}}</span>
	</p>
	<p class="likeview-rm2"><a href="javascript:void(0);"  data-toggle="modal" data-target="#report_item"><i class="fa fa-flag" aria-hidden="true"></i> Report Item</a></p>
	</div>

</div>
</div>

<div class="col-md-12 detailes_view_slider">
<h2 class="viewHead-rm">People Also Viewing</h2>
<div class="home_product_slider recently-viewed">
			<div class="container">
				<div class="row">
						<div class="col-xs-12">
					<div class="owl-carousel owl-theme">
					@foreach($data['random_costumes'] as $rand)
						<div class="item">
						<a href="/product{{$rand->url_key}}">
							<div class="img_layer">
								<img class="img-responsive" @if($rand->image!=null) src="/costumers_images/Medium/{{$rand->image}}" @else src="{{asset('/costumers_images/default-placeholder.jpg')}}" @endif >
							</div>
							<div class="slider_cnt">
								<h4>{{$rand->name}}</h4>
								<p>${{$rand->price}}</p>
							</div>
						</a>
						</div>
					@endforeach
					</div>
					</div>
				</div>
			</div>
		</div>
</div>


</div>
</div>
<div class="modal fade window-popup" id="report_item">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class=" modal-header indi_close_icons">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="report_item_pupup" id="loginModal">
			
				<div id="myTabContent" class="tab-content">
				<h2>Report Item</h2>
			
					<div class="tab-pane active in" id="login_tab1">
						<form class="" action="{{route('report.post')}}" method="POST" id="report">   
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="costume_id" value="{{$data[0]->costume_id}}">
							<div class="form-group">
							<label>Name</label>
								<input type="text"  name="name" placeholder="Enter your name" class="form-control" @if(Auth::check()) value="{{Auth::user()->display_name}}" @endif>
								<p class="error">{{ $errors->first('name') }}</p>
							</div>
							<div class="form-group">
							<label>Email</label>
								<input type="text"  name="email" placeholder="Enter your email" class="form-control" @if(Auth::check()) value="{{Auth::user()->email}}" @endif>
								<p class="error">{{ $errors->first('email') }}</p>
							</div>
							<div class="form-group">
							<label>Phone</label>
								<input type="text" name="phone" placeholder="Enter phone number" class="form-control" @if(Auth::check()) value="{{Auth::user()->phone_number}}" @endif>
								<p class="error">{{ $errors->first('phone') }}</p>
							</div>
							<div class="form-group">
							<label>Reason</label>
								<select class="form-control" name="reason">
								    <option value="">--Select--</option>
								    <option value="Technical issue">Technical issue</option>
								    <option value="Site issue">Site issue</option>
								</select>
								<p class="error">{{ $errors->first('password') }}</p>
							</div>
							<div class="form-group">
								<div class="login-btn">
									<button class="btn btn-primary">Submit</button>
								</div>
							</div>
							
							
					</form>                  
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
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costumes_view.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/home.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-fav.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-like.js') }}"></script>
<script src="{{ asset('/assets/frontend/vendors/jquery.bxslider/jquery.bxslider.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/mini_cart.js') }}"></script>
<script src="{{ asset('/assets/frontend/vendors/lobibox-master/js/notifications.js') }}"></script>
<script type="text/javascript" async >
 function genericSocialShare(url){
	      window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
        return true;
    }
</script>
@stop

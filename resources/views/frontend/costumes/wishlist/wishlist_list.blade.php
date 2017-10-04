@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
 <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
  <link rel="stylesheet" href="{{ asset('/assets/frontend/vendors/lobibox-master/css/lobibox.css') }}">
<<<<<<< HEAD

=======
<style>
.list_products.wish_lists .col-md-3.col-sm-4.col-xs-6 {
    width: 20%;
}
p.list-sec-rm1.fav_costume {
    text-transform: uppercase;
}
p.list-sec-rm1.fav_costume i {
    color: #ee4266;
}
p.list-sec-rm1.fav_costume sapn.active {
    margin-right: 5px;
}
.fav_social a i {
    color: #60c5ac;
    margin-right: 10px;    font-size: 16px;
}
.wish_lists .prod_box .slider_cnt p {
    color: #000;
    font-size: 14px;
    font-family: Proxima-Nova-Regular;
    font-weight: 600;
    margin-bottom: 0px;
}
.wish_lists .prod_box .slider_cnt p.fav-drs-size {
    font-size: 13px;
    color: #b2b2b2;
    font-family: Proxima-Nova-Semibold;
    margin: 3px 0px 10px 0px;
}
.fav_social {
    margin-top: 15px;
}
</style>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
 @endsection
@section('content')
 	<section class="content create_section_page">
 	 	<div id="ohsnap"></div>
<<<<<<< HEAD
		<div class="prodcut_list_page wish_lists_main_div">
=======
		<div class="prodcut_list_page">
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
			<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="list-sec-rm">
<<<<<<< HEAD
						<div class="col-md-6 col-sm-6 col-xs-12">
							<p class="list-sec-rm1 fav_costume"><span class="active"><i aria-hidden=true class="fa fa-heart"></i></span> My Favorites <span class="fav_pg_cnt">({{helper::getMyWishlistCount()}})</span></p>
						</div> 
=======
						<div class="col-md-6">
							<p class="list-sec-rm1 fav_costume"><sapn class="active"><i aria-hidden=true class="fa fa-heart-o"></i></sapn> My Favorties ({{helper::getMyWishlistCount()}})</p>
						</div>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
						<div class="col-md-6 text-right pull-right back-link">
							<a href="/dashboard">Back to My Account</a>
						</div>

					</div>
					</div>
				</div>
			<div class="list_products wish_lists">
				<div class="row">
				@if(count($data))
				@foreach($data as $wish)

				<div class="col-md-3 col-sm-4 col-xs-6" >
					    <div class="prod_box">
					        <div class="img_layer">
<<<<<<< HEAD
					        	

					            <a href="/product{{$wish->url_key}}" style="background-image: url(@if($wish->image!=null && file_exists(public_path
					            ('costumers_images/Medium/'.$wish->image.''))) /costumers_images/Medium/{{$wish->image}} @else /costumers_images/default-placeholder.jpg @endif)">&nbsp;</a>
					            <div class="hover_box">
					                <p class="like_fav">
					                	<a href="#" onclick="return false;" class="like_costume" data-costume-id="{{$wish->costume_id}}">
					                		<span  @if($wish->is_like=='1') class="active" @endif><i aria-hidden="true" class="fa fa-thumbs-o-up"></i>{{$wish->like_count}}</span>
=======
					            <a href="/product{{$wish->url_key}}"><img class="img-responsive" @if($wish->image!=null && file_exists(public_path
					            ('costumers_images/Medium/'.$wish->image.''))) src="/costumers_images/Medium/{{$wish->image}}" @else src="/costumers_images/default-placeholder.jpg" @endif/></a>
					            <div class="hover_box">
					                <p class="like_fav">
					                	<a href="#" onclick="return false;" class="like_costume" data-costume-id="{{$wish->costume_id}}">
					                		<span  @if($wish->is_like=='1') class="active" @endif><i aria-hidden="true" class="fa fa-thumbs-up"></i>{{$wish->like_count}}</span>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
					                	</a>
					                  	<a href="#" onclick="return false;" class="delete" data-costume-id="{{$wish->costume_id}}">
					                		<span class="active"><i aria-hidden="true" class="fa fa-heart"></i></span>
					                	</a>
					                </p>
					                <p class="hover_crt add-cart" data-costume-id="{{$wish->costume_id}}"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart</p>
					            </div>
					        </div>
					        <div class="slider_cnt">
					            <h4><a href="/product{{$wish->url_key}}"></a></h4>
<<<<<<< HEAD
					            <span class="cc_brand"><img src="/img/chrysalis_brand.png"></span>
								<p>{{$wish->name}}</p>
								<p class="fav-drs-size">{{ucfirst($wish->gender)}} @if($wish->size=="s") Small @elseif($wish->size=="m") Medium @elseif($wish->size=="l") Large @else {{strtoupper($data[0]->size)}} @endif</p>
					            <p>{{$wish->price}}</p>
								<div class="fav_social">
								 <!-- <a href="https://www.facebook.com/bootsnipp"><i id="social-fb" class="fa fa-facebook fa-1x social"></i></a>
								<a href="https://twitter.com/bootsnipp"><i id="social-tw" class="fa fa-twitter fa-1x social"></i></a>
								<a href="https://plus.google.com/+Bootsnipp-page"><i id="social-gp" class="fa fa-envelope fa-1x social"></i></a> -->
								<div class="sharethis-inline-share-buttons" data-url="{{URL::to('/product'.$wish->url_key.'')}}" data-title="{{$wish->name}}"></div>

=======
								<p>{{$wish->name}}</p>
								<p class="fav-drs-size">{{ucfirst($wish->gender)}} @if($wish->condition=="brand_new") Brand New @elseif($wish->condition=="like_new") Like New @else {{ucfirst($data[0]->condition)}} @endif</p>
					            <p>{{$wish->price}}</p>
								<div class="fav_social">
								 <a href="https://www.facebook.com/bootsnipp"><i id="social-fb" class="fa fa-facebook fa-1x social"></i></a>
								<a href="https://twitter.com/bootsnipp"><i id="social-tw" class="fa fa-twitter fa-1x social"></i></a>
								<a href="https://plus.google.com/+Bootsnipp-page"><i id="social-gp" class="fa fa-envelope fa-1x social"></i></a>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
								
					        </div>
							</div>
					    </div>
					</div>
				@endforeach
				@else
					<div  class="col-md-3 col-sm-4 col-xs-6">There are no items in your list.</div>
				@endif

				</div>
			</div>
	</div>


   </section>    
       
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<<<<<<< HEAD
<script src="{{ asset('/assets/frontend/js/jquery-ui.js') }}"></script>
=======
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
<script src="{{ asset('/js/ohsnap.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-fav.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-like.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{ asset('/assets/frontend/js/pages/mini_cart.js') }}"></script>
<script src="{{ asset('/assets/frontend/vendors/lobibox-master/js/notifications.js') }}"></script>
<<<<<<< HEAD
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=595c7a060f8114001101959f&product=inline-share-buttons"></script>

=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

@stop

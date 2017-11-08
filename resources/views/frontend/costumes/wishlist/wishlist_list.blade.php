@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
 <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
  <link rel="stylesheet" href="{{ asset('/assets/frontend/vendors/lobibox-master/css/lobibox.css') }}">

 @endsection
@section('content')
 	<section class="content create_section_page">
 	 	<div id="ohsnap"></div>
		<div class="prodcut_list_page wish_lists_main_div">
			<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="list-sec-rm">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<p class="list-sec-rm1 fav_costume"><span class="active"><i aria-hidden=true class="fa fa-heart"></i></span> My Favorites <span class="fav_pg_cnt">({{helper::getMyWishlistCount()}})</span></p>
						</div> 
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
					            <a href="/product{{$wish->url_key}}" style="background-image: url(@if($wish->image!=null && file_exists(public_path
					            ('costumers_images/Medium/'.$wish->image.''))) /costumers_images/Medium/{{$wish->image}} @else /costumers_images/default-placeholder.jpg @endif)">&nbsp;</a>
					            <div class="hover_box">
					                <p class="like_fav">
					                	<a href="#" onclick="return false;" class="like_costume" data-costume-id="{{$wish->costume_id}}">
					                		<span  @if($wish->is_like=='1') class="active" @endif><i aria-hidden="true" class="fa fa-thumbs-o-up"></i>{{$wish->like_count}}</span>
					                	</a>
					                  	<a href="#" onclick="return false;" class="delete" data-costume-id="{{$wish->costume_id}}">
					                		<span class="active"><i aria-hidden="true" class="fa fa-heart"></i></span>
					                	</a>
					                </p>
					                @if($wish->quantity>=1)
					                	<p class="hover_crt add-cart" data-costume-id="{{$wish->costume_id}}"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart</p>
					                @else
					                	<p class="hover_crt"><i aria-hidden=true class="fa fa-shopping-cart"></i> Out of stock</p>
					                @endif
					            </div>
					        </div>
					        <p class="ystrip-rm"><span><img class="img-responsive" src="http://dev.chrysaliscostumes.com/assets/frontend/img/film.png"> Film Quality</span></p>
					        <div class="slider_cnt">
					            <h4><a href="/product{{$wish->url_key}}"></a></h4>
					            <span class="cc_brand"><img src="/img/chrysalis_brand.png"></span>
								<p>{{$wish->name}}</p>
								<p class="fav-drs-size">{{ucfirst($wish->gender)}} @if($wish->size=="s") Small @elseif($wish->size=="m") Medium @elseif($wish->size=="l") Large @else {{strtoupper($data[0]->size)}} @endif</p>
					            <p>{{$wish->price}}</p>

								<div class="fav_social">
									<a href="javascript:void(0);" class="facebook" class="icoRss" title="Facebook">
										<i id="social-fb" class="fa fa-facebook fa-1x social"></i>
										<input type="hidden" name="url_fb" class="url_fb" value="{{url('/').'/product'.$wish->url_key}}">
									</a>
									<a href="javascript:void(0);">
										<div id="twiter_url" data-network="twitter" class="st-custom-button" data-title="" data-url="">
											<i id="social-tw" class="fa fa-twitter fa-1x social"></i>
										</div>
									</a>
									<a href="https://plus.google.com/+Bootsnipp-page">
										<i id="social-gp" class="fa fa-envelope fa-1x social"></i>
									</a>

									<div class="sharethis-inline-share-buttons" data-url="{{URL::to('/product'.$wish->url_key.'')}}" data-title="{{$wish->name}}"></div>
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
<script src="{{ asset('/assets/frontend/js/jquery-ui.js') }}"></script>
<script src="{{ asset('/js/ohsnap.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-fav.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-like.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{ asset('/assets/frontend/js/pages/mini_cart.js') }}"></script>
<script src="{{ asset('/assets/frontend/vendors/lobibox-master/js/notifications.js') }}"></script>
<script type="text/javascript" src="//connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript" src="{{ asset('/assets/frontend/js/social_sharing.js') }}"></script>
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=595c7a060f8114001101959f&product=inline-share-buttons"></script>

@stop

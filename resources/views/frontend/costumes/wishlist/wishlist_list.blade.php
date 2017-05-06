@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
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
 @endsection
@section('content')
 	<section class="content create_section_page">
		<div class="prodcut_list_page">
			<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="list-sec-rm">
						<div class="col-md-6">
							<p class="list-sec-rm1 fav_costume"><sapn class="active"><i aria-hidden=true class="fa fa-heart-o"></i></sapn> My Favorties ({{helper::getMyWishlistCount()}})</p>
						</div>
						<div class="col-md-6 text-right pull-right">
							<a href="/dashboard">Back to My Account</a>
						</div>

					</div>
					</div>
				</div>
			<div class="list_products wish_lists">
				<div class="row">
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
				@if(count($data))
				@foreach($data as $wish)

				<div class="col-md-3 col-sm-4 col-xs-6" >
					    <div class="prod_box">
					        <div class="img_layer">
					            <a href="/product{{$wish->url_key}}"><img class="img-responsive" @if($wish->image!=null && file_exists('costumers_images/{{$wish->image}}')) src="/costumers_images/{{$wish->image}}" @else src="/costumers_images/default-placeholder.jpg" @endif/></a>
					            <div class="hover_box">
					                <p class="like_fav">
					                	<a href="#" onclick="return false;" class="like_costume" data-costume-id="{{$wish->costume_id}}">
					                		<span  @if($wish->is_like=='1') class="active" @endif><i aria-hidden="true" class="fa fa-thumbs-up"></i>{{$wish->like_count}}</span>
					                	</a>
					                  	<a href="#" onclick="return false;" class="delete" data-costume-id="{{$wish->costume_id}}">
					                		<span class="active"><i aria-hidden="true" class="fa fa-heart"></i></span>
					                	</a>
					                </p>
					                <p class="hover_crt"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart</p>
					            </div>
					        </div>
					        <div class="slider_cnt">
					            <h4><a href="/product{{$wish->url_key}}"></a></h4>
								<p>{{$wish->name}}</p>
								<p class="fav-drs-size">{{ucfirst($wish->gender)}} @if($wish->condition=="brand_new") Brand New @elseif($wish->condition=="like_new") Like New @else {{ucfirst($data[0]->condition)}} @endif</p>
					            <p>{{$wish->price}}</p>
								<div class="fav_social">
								 <a href="https://www.facebook.com/bootsnipp"><i id="social-fb" class="fa fa-facebook fa-1x social"></i></a>
								<a href="https://twitter.com/bootsnipp"><i id="social-tw" class="fa fa-twitter fa-1x social"></i></a>
								<a href="https://plus.google.com/+Bootsnipp-page"><i id="social-gp" class="fa fa-envelope fa-1x social"></i></a>
								
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
<script src="{{ asset('/assets/frontend/js/pages/costume-fav.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/pages/costume-like.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>

@stop

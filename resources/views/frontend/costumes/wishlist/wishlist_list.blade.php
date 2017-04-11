@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
 @endsection
@section('content')
 	<section class="content create_section_page">
		<div class="prodcut_list_page">
			<div class="container">
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
			<div class="list_products">
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
					            <a href="/shop/{{$wish->costume_id}}/{{$wish->parent_cat_name}}/{{$wish->cat_name}}/{{$wish->name}}"><img class="img-responsive" @if($wish->image!=null && file_exists('costumers_images/{{$wish->image}}')) src="/costumers_images/{{$wish->image}}" @else src="/costumers_images/default-placeholder.jpg" @endif/></a>
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
					            <h4><a href="/shop/{{$wish->costume_id}}/{{$wish->parent_cat_name}}/{{$wish->cat_name}}/{{$wish->name}}">{{$wish->name}}</a></h4>
					            <p>{{$wish->price}}</p>
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

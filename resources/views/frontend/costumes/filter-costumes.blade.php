                      
						@if(count($costumes->getCollection())>0)	
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
										<a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-heart-o"></i></span></a>
												</p>
												<p class="hover_crt add-cart" data-costume-id="{{$costume->costume_id}}">
													<i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart
												</p>
										</div>
										@else
										<div class="hover_box">
										<p class="like_fav">
													<a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-thumbs-up"></i>0</span>
													</a> 
										<a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-heart-o"></i></span></a>
												</p>
												<p class="hover_crt add-cart" data-costume-id="{{$costume->costume_id}}">
													<i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart
												</p>
										</div>
										@endif
									</div>
										@if($costume->film_qlty == 32)
											<p class="ystrip-rm">
												<span>
													<img class="img-responsive" src="{{url('assets/frontend/img/film.png')}}"> Film Quality
												</span>
											</p>
										@endif
											<div class="slider_cnt no_brand sml_name">
												<span class="cc_brand"></span>
													<h4>
														<a href="{{url('product')}}{{$costume->url_key}}">{{$costume->name}}</a>
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
							 <script>
							   if($("ul.pagination").length == 0)
                        	    {
                        	        $(".holder.list_pagination").css({"border":"none"});
                        	    }
							     $(".per_page").val("{{session('perpage')===null ? 12 : session('perpage')}}");
							     
							 </script>
						</ul>
						
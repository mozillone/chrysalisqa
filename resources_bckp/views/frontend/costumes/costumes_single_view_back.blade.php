@extends('/frontend/app')
@section('styles')
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/assets/frontend/vendors/jquery.bxslider/jquery.bxslider.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/frontend/vendors/lobibox-master/css/lobibox.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/frontend/css/pages/costume_single.css') }}">
	<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5980685de0404c0012139258&product=inline-share-buttons' async='async'></script>
	<style>
	.size_chart_div {
  font-weight: bold;    clear: both;    text-align: center;
	}
	.size_chart_div .table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #f0e9f2 !important;
	}
	#size-chart .modal-header button.close {
    font-size: 28px;
    color: #000;
    opacity: 0.9;
}
div#size-chart {
    margin-top: 60px;
}
	.size_chart_div h4 {
    text-align: center;
    font-weight: bold;
	}
	.size_chart_div .table>tbody>tr>td {
    border-top: none;font-size: 12px;
    padding: 15px 20px;    text-align: left;
	}
	.size_chart_div .table>tbody>tr>td:nth-child(1) {
    border-right: 1px solid #ccc;font-size: 14px;
    color: #000;
	}
	.size_chart_div ul.in-tab li a {
    color: #000;
}
.size_chart_div ul.in-tab li.active a {
    background: #60c4ab !important;
}
.size_chart_div ul.in-tab li {
    background: transparent;    border-radius: 5px;
    color: #000 !important;
    border: 2px solid #60c4ab;
}
	.size_chart_div .table>thead>tr>th:nth-child(1) {
    border-right: 1px solid #ccc;
	}
	.size_chart_div li {
    background: #60c4ab;
	margin-right: 5px;border-radius: 3px;
	}
	.size_chart_div ul {
    border-bottom: 0px;
    margin-bottom: 20px;    display: inline-block;
	}
	.size_chart_div li.active a:focus {    background-color: #ee4266 !important;}
	.size_chart_div li.active a {
    border-radius: 0px;
    color: #fff !important;
    border: 0px solid #ddd !important;
    border-bottom-color: transparent !important;
    background-color: #ee4266 !important;
	}
	.size_chart_div h2 {
    border-bottom: 1px solid #ccc;
    text-align: center;
    font-size: 18px;
    font-weight: bold;    color: #000;
    padding-bottom: 10px;
	}
	.size_chart_div .table>thead>tr>th {
	    color: #000;
    padding: 15px 20px;
	}
	.size_chart_div li.active a {
    border-radius: 0px;
    color: #fff !important;
    border: 0px solid #ddd !important;
    border-bottom-color: transparent !important;
	}
	
	.size_chart_div li a {
    color: #fff;    padding: 5px 20px;
    border-radius: 0px !important; border:none !important;
	}
	.size_chart_div li a {color:#fff;}
	.size_chart_div li.active {
    background: #fff;
    border-radius: 0px;
	}
	#size-chart .modal-header h4 {
    text-align: center;
    font-weight: bold;
    color: #000;
}
#size-chart .modal-header {
    text-align: center;    padding-bottom: 5px;
    font-weight: bold;
}
.size_chart_div p {
    font-size: 12px;
}
a.size_chrtcls {
    color: #60c4ab;
    font-size: 14px;
    text-decoration: underline;
}
</style>
@endsection
@section('content')
	<section class="product_Details_page">
		<div class="container">
			<div class="row">
				<nav class="breadcrumb">
					<a class="breadcrumb-item" href="/">Home &nbsp;&nbsp;>&nbsp;&nbsp;</a>
					<a class="breadcrumb-item" href="/category/{{$parent_cat_name}}/{{$sub_cat_name}}">{{$data[0]->cat_name}} &nbsp;&nbsp;> &nbsp;</a>
					<span class="breadcrumb-item active">{{$data[0]->name}}</span>
				</nav>
				<div class="col-md-5 col-sm-5 col-xs-12 carousel-bg-style bxslider-strt">

					<ul class="bxslider">
						@foreach($data['images'] as $images)
							<li><img class="img-responsive" src="{{asset('/costumers_images/Large')}}/<?= $images->image?>"></li>
						@endforeach
					</ul>

					<div id="bx-pager" class="bxslider-rm">
                        <?php $count=0;?>
						@foreach($data['images'] as $images)
							<a data-slide-index="{{$count}}" href=""><img class="img-responsive" src="{{asset('/costumers_images/Small')}}/<?= $images->image?>"></a>
                            <?php $count++;?>
						@endforeach
					</div>

				</div>

				<div class="col-md-7 col-sm-7 col-xs-12">
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

							<div class="col-md-6 col-sm-12 col-xs-12">
								<h2>{{$data[0]->name}}</h2>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12 single-view_social">
								@if(Auth::check())
									<a href="#" onclick="return false;" class="fav_costume" data-costume-id='{{$data[0]->costume_id}}'>

										@else
											<a data-toggle="modal" data-target="#login_popup_fav">
												@endif

												<span @if($data[0]->is_fav)  class="active" @endif>@if($data[0]->is_fav)<i aria-hidden=true class="fa fa-heart"></i> @else <i aria-hidden=true class="fa fa-heart-o"></i>@endif</span></a>
                                            <a href="#" data-toggle="modal" data-target="#messageModal"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
											<div class="sharethis-inline-share-buttons"></div>
							</div>
						</h1>

						<!---Price section start -->
						<div class="row">
							<div class="priceview_rm">
								<div class="col-xs-12 col-md-6 col-sm-8 viewpr_rm">
									<div class="mobile_list_view">
										<h2>@if($data[0]->created_user_group=="admin" && $data[0]->discount!=null && $data[0]->uses_customer<$data[0]->uses_total && date('Y-m-d',strtotime("now"))>=date('Y-m-d',strtotime($data[0]->date_start)) && date('Y-m-d',strtotime("now"))<=date('Y-m-d',strtotime($data[0]->date_end)))
                                                <?php $discount=($data[0]->price/100)*($data[0]->discount);
                                                $new_price=$data[0]->price-$discount;
                                                ?>
												<p><span class="old-price"><strike>${{number_format($data[0]->price,2, '.', ',')}}</strike></span> <span class="new-price">${{number_format($new_price,2, '.', ',')}}</span></p>
											@else
												<p><span class="new-price">${{number_format($data[0]->price,2, '.', ',')}}</span></p>
											@endif
										</h2>
										@if($data['is_film_quality_cos'] == 'yes')
											<p class="ystrip-rm"><span><img class="img-responsive" src="{{asset('assets/frontend/img/film.png')}}"> Film Quality</span></p>
										@endif
									</div>
									<div class="single_view_details col-xs-12">
										<p class="iCondition-rm"><span class="iBold-rm">Item Condition:</span><small>  @if($data[0]->condition=="brand_new") Brand New @elseif($data[0]->condition=="like_new") Like New @else {{ucfirst($data[0]->condition)}} @endif </small></p>
										<p class="iCondition-rm"><span class="iBold-rm">Size:</span><small> {{ucfirst($data[0]->gender)}} @if($data[0]->size=="s") small @elseif($data[0]->size=="m") medium @elseif($data[0]->size=="l") large @else {{strtoupper($data[0]->size)}} @endif</small>
													<a href="#" class="size_chrtcls" data-toggle="modal" data-target="#size-chart" >Size Chart</a>	
													</p>
									</div>
								</div>

								<div class="col-md-6 col-xs-12 col-sm-4 viewBtn_rm">
									@if(helper::verifyCostumeQuantity($data[0]->costume_id,$data[0]->quantity+1) && $data[0]->quantity>0)
										<button type="button" class="addtocart-rm add-cart" data-costume-id="{{$data[0]->costume_id}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</button>
										@if(!Auth::check())
											<a data-toggle="modal" data-target="#login_popup" class="buynow-rm">Buy it Now!</a>
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
						@if(Auth::check() && !empty($data['seller_info']['shipping_location'])  && helper::getSellerShippingAddress($data[0]->created_by) && helper::getUserShippingAddress())
                            <?php $priority_info=helper::domesticRateSingleCostume($data['seller_info']['shipping_location'][0]->zip_code,helper::getUserShippingAddress()['zip_code'],$data[0]->weight_pounds,$data[0]->weight_ounces);
                            ?>
							<div class="shipping_rm">
								<p class="shipp-rm"><label>Shipping:</label>@if($priority_info['result']=="1") ${{$priority_info['msg']['rate']}} Expedited Shipping @else {{$priority_info['msg']}} @endif</p>

								<p class="shipp-rm1">Item location: {{$data['seller_info']['shipping_location'][0]->city}}, {{$data['seller_info']['shipping_location'][0]->state}} USA <br/>Ships to: {{helper::getUserShippingAddress()['city']}}, {{helper::getUserShippingAddress()['state']}} USA</p>
								<p class="shipp-rm shipp-rm-20"><label>Delivery: &nbsp; </label> @if($priority_info['result']=="1") Est. between {{date('D . M . d')}}  and {{date('D . M .d',strtotime('+'.$priority_info["msg"]["MailService"].' days'))}} @else {{$priority_info['msg']}} @endif  <i class="fa fa-info-circle" aria-hidden="true"></i></p>
							</div>
						@endif

						<p class="returns-rm">Returns: <span>Seller <?php if(isset($data['returns'][0])){ echo $data['returns'][0]->attribute_option_value; }else{ echo " Return Not Accepted"; } ?></span></p>


						<div class="viewTabs_rm" style="display:none;">
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
									<p class="viewTabs-text">
									@if(!empty($data['seller_info'][0]))
										@if($data['seller_info'][0]->id != 1)
											<p>Name: <span>{{$data['seller_info'][0]->display_name}}</span></p>
											<p>Email: <span>{{$data['seller_info'][0]->email}}</span></p>
											<p>Phone: <span>{{$data['seller_info'][0]->phone_number}}<span></p>
										@else
											<p>Name: <span>Chrysalis Support</span></p>
											<p>Email: <span>support@chrysaliscostumes.com</span></p>
										@endif
									@else
										<p class="no-data-tab">No data found</p>
										@endif
										</p>
								</div>

							</div>


						</div>
						<!-- .tab_container_list_view -->
						<div class="single_view_multi_view_tabs">
							<ul class="mobile_list_tabs nav nav-tabs viewTabs">
								<li class="active" rel="tab1">Costume Description</li>
								<li rel="tab2">FAQ</li>
								<li rel="tab3">Seller Information</li>
							</ul>
							<div class="tab_container_list_view">
								<h3 class="d_active tab_drawer_heading" rel="tab1">Costume Description</h3>
								<div id="tab1" class="tab_content">
									<p class="viewTabs-text">{{$data[0]->description}}</p>
								</div>
								<!-- #tab1 -->
								<h3 class="tab_drawer_heading" rel="tab2">FAQ</h3>
								<div id="tab2" class="tab_content">
									<p class="viewTabs-text">@if(count($data['faq'])) {{$data['faq'][0]->attribute_option_value}} @else <span>No FAQ found</span> @endif</p>
								</div>
								<!-- #tab2 -->
								<h3 class="tab_drawer_heading" rel="tab3">Seller Information</h3>
								<div id="tab3" class="tab_content">
									<p class="viewTabs-text">
									@if(!empty($data['seller_info'][0]))
										@if($data['seller_info'][0]->id != 1)
											<p>Name: <span>{{$data['seller_info'][0]->display_name}}</span>
											</p>
											<p>Email: <span>{{$data['seller_info'][0]->email}}</span>
											<!--<p>Phone: <span>{{$data['seller_info'][0]->phone_number}}<span></p>-->
											</p>
										@else
											<p>Name: <span>Chrysalis Support</span>
											</p>
											<p>Email: <span>support@chrysaliscostumes.com</span>
											<!--<p>Phone: <span>{{$data['seller_info'][0]->phone_number}}<span></p>-->
											</p>
										@endif
									@else
										<p class="no-data-tab">No data found</p>
										@endif
										</p>
								</div>
								<!-- #tab3 -->

							</div>
							<!-- .tab_container_list_view -->
						</div>
						<!-- .tab_container_list_view -->
						<div class="likeview-rm">
							<p class="likeview-rm1">
								<span>Like this costume? </span>
								@if(Auth::check())
									<a href="#" onclick="return false;" class="like_costume_view" data-costume-id="{{$data[0]->costume_id}}"><span class="like-span">Vote Up!<i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span></a>
								@else
									<a data-toggle="modal" data-target="#login_popup"><span class="like-span">Vote Up!<i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span></a>
								@endif
								<span class="like-span1 @if($data[0]->is_like) active @endif"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{$data[0]->like_count}}</span>

							</p>


							<p class="likeview-rm2"><a href="javascript:void(0);"  data-toggle="modal" data-target="#report_item"><i class="fa fa-flag" aria-hidden="true"></i> Report Item</a></p>
						</div>

					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12 detailes_view_slider">
					<h2 class="viewHead-rm">People Also Viewing</h2>
					<div class="home_product_slider recently-viewed">
						<div class="container">
							<div class="row">
								<div class="col-xs-12">
									<div class="owl-carousel owl-theme">
										@foreach($data['random_costumes'] as $rand)
											<div class="item">
												<div class="prod_box">
													<div class="img_layer" >
														<a href="/product{{$rand->url_key}}" style="background-image: url(@if($rand->image!=null) /costumers_images/Medium/{{$rand->image}} @else {{asset('/costumers_images/default-placeholder.jpg')}} @endif )">
														</a>
														<div class="hover_box">
															<p class="like_fav"><a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-thumbs-o-up"></i>1</span></a> <a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden="true" class="fa fa-heart-o"></i></span></a> </p>
															<p class="hover_crt add-cart" data-costume-id="145"><i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Cart</p>
														</div>
													</div>
													<div class="slider_cnt">
														<h4><a href="/product{{$rand->url_key}}">{{$rand->name}}</a></h4>
														<p>${{number_format($rand->price, 2, '.', ',')}}</p>
													</div>
												</div>
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
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('inquire-costume')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="user_name" value="{{ Auth::user()->display_name }}">
                    <input type="hidden" name="seller_id" value="{{ $data['seller_info'][0]->id }}">
                    <input type="hidden" name="costume_name" value="{{ $data[0]->name }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Contact {{ $data['seller_info'][0]->display_name }} About {{ $data[0]->name }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea rows="5" name="message" class="form-control"></textarea>
                                    <p class="error">{{ $errors->first('message') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
		
							
							<!-- size chart modal start here -->
						
							<div id="size-chart" class="modal fade" role="dialog">
								<div class="modal-dialog">
									
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Size Chart</h4>
										</div>
										<div class="modal-body">
											<div class="size_chart_div">
											
											<p>Please not that this is a guide only and that measurements may vary according to manufacturer and style. </p>
											
											<ul class="nav nav-tabs">
												<li class="active"><a data-toggle="tab" href="#men">Men</a></li>
												<li><a data-toggle="tab" href="#women">Women</a></li>
												<li><a data-toggle="tab" href="#boys">Boys</a></li>
												<li><a data-toggle="tab" href="#gilrs">Girls</a></li>
												<li><a data-toggle="tab" href="#pets">Pets</a></li>
												<li><a data-toggle="tab" href="#infants">Infants</a></li>
											</ul>
											
											<div class="tab-content ">
												<div id="men" class="tab-pane fade in active">
													
													
													<ul class="nav nav-pills in-tab">
														<li class="active"><a data-toggle="pill" href="#home">  Inches</a></li>
														<li><a data-toggle="pill" href="#menu1">  Centimeters</a></li>
														
													</ul>
													
													<div class="tab-content table-responsive">
														<div id="home" class="tab-pane fade in active">
															
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th></th>
																		<th>S</th>
																		<th>M</th>
																		<th>L</th>
																		<th>XL</th>
																		<th>Plus</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Chest</td>
																		<td>36-40</td>
																		<td>42-46</td>
																		<td>46-50</td>
																		<td>46-50</td>
																		<td>50-56</td>
																	</tr>
																	<tr>
																		<td>Waist</td>
																		<td>26-28</td>
																		<td>30-34</td>
																		<td>36-40</td>
																		<td>34-38</td>
																		<td>42-46</td>
																	</tr>
																	
																	
																</tbody>
															</table>
														</div>
														<div id="menu1" class="tab-pane fade">
															
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th></th>
																		<th>S</th>
																		<th>M</th>
																		<th>L</th>
																		<th>XL</th>
																		<th>Plus</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Chest</td>
																		<td>36-40</td>
																		<td>42-46</td>
																		<td>46-50</td>
																		<td>46-50</td>
																		<td>50-56</td>
																	</tr>
																	<tr>
																		<td>Waist</td>
																		<td>26-28</td>
																		<td>30-34</td>
																		<td>36-40</td>
																		<td>34-38</td>
																		<td>42-46</td>
																	</tr>
																	
																	
																</tbody>
															</table>
														</div>
														
													</div>											
													
													
													
													
													
												</div>
												
												
												
												<div id="women" class="tab-pane fade">
													
													<div id="men" class="tab-pane fade in active">
														
														
														<ul class="nav nav-pills in-tab">
															<li class="active"><a data-toggle="pill" href="#home">  Inches</a></li>
															<li><a data-toggle="pill" href="#menu1">  Centimeters</a></li>
															
														</ul>
														
														<div class="tab-content  table-responsive">
															<div id="home" class="tab-pane fade in active">
																
																<table class="table table-striped">
																	<thead>
																		<tr>
																			<th></th>
																			<th>XS</th>
																			<th>S</th>
																			<th>M</th>
																			<th>L</th>
																			<th>Plus</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td>Chest</td>
																			<td>30-31</td>
																			<td>32-35</td>
																			<td>36-38</td>
																			<td>39-42</td>
																			<td>42-44</td>
																		</tr>
																		<tr>
																			<td>Waist</td>
																			<td>22-24</td>
																			<td>25-27</td>
																			<td>28-30</td>
																			<td>31-34</td>
																			<td>35-38</td>
																		</tr>
																		
																		
																	</tbody>
																</table>
															</div>
															<div id="menu1" class="tab-pane fade">
																<table class="table table-striped">
																	<thead>
																		<tr>
																			<th></th>
																			<th>XS</th>
																			<th>S</th>
																			<th>M</th>
																			<th>L</th>
																			<th>Plus</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td>Chest</td>
																			<td>30-31</td>
																			<td>32-35</td>
																			<td>36-38</td>
																			<td>39-42</td>
																			<td>42-44</td>
																		</tr>
																		<tr>
																			<td>Waist</td>
																			<td>22-24</td>
																			<td>25-27</td>
																			<td>28-30</td>
																			<td>31-34</td>
																			<td>35-38</td>
																		</tr>
																		
																		
																	</tbody>
																</table>
															</div>
															
														</div>											
														
														
														
														
														
													</div>
													
												</div>
												<div id="boys" class="tab-pane fade">
													
													<ul class="nav nav-pills in-tab">
														<li class="active"><a data-toggle="pill" href="#home">  Inches</a></li>
														<li><a data-toggle="pill" href="#menu1">  Centimeters</a></li>
														
													</ul>
													
													<div class="tab-content  table-responsive">
														<div id="home" class="tab-pane fade in active">
															
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th></th>
																		<th>Toddler</th>
																		<th>Small</th>
																		<th>Medium</th>
																		<th>Large</th>
																		
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Chest</td>
																		<td>23-24</td>
																		<td>25-28</td>
																		<td>29-32</td>
																		<td>35-39</td>
																		
																	</tr>
																	<tr>
																		<td>Waist</td>
																		<td>22-24</td>
																		<td>25-26</td>
																		<td>27-30</td>
																		<td>31-34</td>
																		
																	</tr>
																	
																	
																</tbody>
															</table>
														</div>
														<div id="menu1" class="tab-pane fade">
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th></th>
																		<th>Toddler</th>
																		<th>Small</th>
																		<th>Medium</th>
																		<th>Large</th>
																		
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Chest</td>
																		<td>23-24</td>
																		<td>25-28</td>
																		<td>29-32</td>
																		<td>35-39</td>
																		
																	</tr>
																	<tr>
																		<td>Waist</td>
																		<td>22-24</td>
																		<td>25-26</td>
																		<td>27-30</td>
																		<td>31-34</td>
																		
																	</tr>
																	
																	
																</tbody>
															</table>
														</div>
														
													</div>	
													
												</div>
												<div id="gilrs" class="tab-pane fade">
													<ul class="nav nav-pills in-tab">
														<li class="active"><a data-toggle="pill" href="#home">  Inches</a></li>
														<li><a data-toggle="pill" href="#menu1">  Centimeters</a></li>
														
													</ul>
													
													<div class="tab-content  table-responsive">
														<div id="home" class="tab-pane fade in active">
															
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th></th>
																		<th>Toddler</th>
																		<th>Small</th>
																		<th>Medium</th>
																		<th>Large</th>
																		
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Chest</td>
																		<td>23-24</td>
																		<td>25-28</td>
																		<td>29-32</td>
																		<td>35-39</td>
																		
																	</tr>
																	<tr>
																		<td>Waist</td>
																		<td>22-24</td>
																		<td>25-26</td>
																		<td>27-30</td>
																		<td>31-34</td>
																		
																	</tr>
																	
																	
																</tbody>
															</table>
														</div>
														<div id="menu1" class="tab-pane fade">
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th></th>
																		<th>Toddler</th>
																		<th>Small</th>
																		<th>Medium</th>
																		<th>Large</th>
																		
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Chest</td>
																		<td>23-24</td>
																		<td>25-28</td>
																		<td>29-32</td>
																		<td>35-39</td>
																		
																	</tr>
																	<tr>
																		<td>Waist</td>
																		<td>22-24</td>
																		<td>25-26</td>
																		<td>27-30</td>
																		<td>31-34</td>
																		
																	</tr>
																	
																	
																</tbody>
															</table>
														</div>
														
													</div>	
												</div>
												<div id="pets" class="tab-pane fade">
													<ul class="nav nav-pills in-tab">
														<li class="active"><a data-toggle="pill" href="#home">  Inches</a></li>
														<li><a data-toggle="pill" href="#menu1">  Centimeters</a></li>
														
													</ul>
													
													<div class="tab-content  table-responsive">
														<div id="home" class="tab-pane fade in active">
															
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th></th>
																		<th>Small</th>
																		<th>Medium</th>
																		<th>Large</th>
																		<th>Extra Large</th>
																		
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Neck to Tail</td>
																		<td>10-14</td>
																		<td>14-20</td>
																		<td>22-28</td>
																		<td>28+</td>
																		
																	</tr>
																	<tr>
																		<td>Chest</td>
																		<td>10-14</td>
																		<td>14-18</td>
																		<td>18-24</td>
																		<td>24+</td>
																		
																	</tr>
																	
																	
																</tbody>
															</table>
														</div>
														<div id="menu1" class="tab-pane fade">
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th></th>
																		<th>Small</th>
																		<th>Medium</th>
																		<th>Large</th>
																		<th>Extra Large</th>
																		
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Neck to Tail</td>
																		<td>10-14</td>
																		<td>14-20</td>
																		<td>22-28</td>
																		<td>28+</td>
																		
																	</tr>
																	<tr>
																		<td>Chest</td>
																		<td>10-14</td>
																		<td>14-18</td>
																		<td>18-24</td>
																		<td>24+</td>
																		
																	</tr>
																	
																	
																</tbody>
															</table>
														</div>
														
													</div>	
												</div>
												<div id="infants" class="tab-pane fade">
													
													<ul class="nav nav-pills in-tab">
														<li class="active"><a data-toggle="pill" href="#home">  Inches</a></li>
														
													</ul>
													
													<div class="tab-content  table-responsive">
														<div id="home" class="tab-pane fade in active">
															
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th></th>
																		<th>Newborn</th>
																		<th>Infant</th>
																		
																		
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Age</td>
																		<td>0-6 Months</td>
																		<td>6-12 Months</td>
																		
																	</tr>
																	
																	
																	
																</tbody>
															</table>
														</div>
														
														
													</div>	
													
												</div>
											</div>
										</div>
										</div>
									</div>
									
								</div>
							</div>
							
							<!-- size chart modal End  here -->
							
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
    <script>
        function message(){
            alert('hello world');
        }
    </script>
@stop
@extends('/frontend/app')
@section('styles')
<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/drop_uploader.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">

<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/media-query.css')}}">
<link  href="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.css" rel="stylesheet">
<style>
.charity_rigt .ct3-list li p {
    display: block;
}
.ct3-list li{min-height: 190px;}
.ct3-list li img{width:85px;}
h2.prog-head span {
    font-size: 14px;
    margin-left: 5px;
    font-family: Proxima-Nova-regular;
}
.up-blog span.text a:after {
	content: "\f030";
	font-family: 'FontAwesome';
	color: #fff;
	font-size: 24px;
	display: block;
	margin-top: 0%;
	left: 0px;
	right: 0px;
	line-height: 280px;
	}
	span.text a{height:auto !important; position:inherit;}
	.upload-photo-blogs .up-blog input {
	width: 100%;
	cursor: pointer;
	left: 0;
	margin: 0 auto;
	position: absolute;
	height: 100%;
	color: transparent;
	opacity: 0; top:0px;
	}
	.cropper-bg {
	background-image: none !important;
	}
	.save,.saveMultiple {
	background: #60c5ac;
	border: 1px solid #60c5ac;
	font-size: 16px;
	font-family: Proxima-Nova-Extrabold;
	padding: 8px 25px;
	}
	section.content.create_section_page .modal-body p {
	font-family: Proxima-Nova-Extrabold;
	}
	section.content.create_section_page .modal-header {
	text-align: center;font-family: Proxima-Nova-Extrabold;
	}
	.imageModel {
	margin-top: 30px;
	}
	.modal-header .close {
	opacity: 0.9;
	font-size: 28px;
	}
	.imageModel .modal-content{border-radius:0px;}
	.img_clse {
	background: transparent;
	border: 2px solid #60c5ac;
	font-size: 14px;
	font-family: Proxima-Nova-Extrabold;
	padding: 8px 25px;
	text-align: right;
	float: right;
	margin-right: 10px;
	color: #60c5ac;
	}
	section.content.create_section_page .modal-body #zoom-level {
	
	}
	section.content.create_section_page .btn-success:active:focus, .btn-success:active:hover{background-color: #60c5ac;
	border-color: #60c5ac;}
	section.content.create_section_page  .btn-success:active{border-color: #60c5ac !important;}
	section.content.create_section_page .btn-success:hover{background-color: #60c5ac !important;}
	section.content.create_section_page .btn-success:active {
	background-color: #60c5ac !important;
	}
	.btn-success:focus{    background-color: #60c5ac !important;}
	.img-pp input {
	width: 80%;
	margin: 0 auto;
	display: inline-block;
	}
	.img-pp-iner {
	width: 350px;
	margin: 0 auto;    margin-top: 20px !important;    margin-bottom: 10px;
	}
	.img-pp {
	display: inline;
	margin: 0 auto;
	}
	.img-pp-iner i.fa.fa-picture-o {
	font-size: 15px;
	}
	.img-pp-iner i.fa.fa-picture-o.fa-3 {
	font-size: 22px;
	}
	.imageModel .modal-footer {
	border-top: 1px solid #ccc !important;
	}
	input[type=range] {
	/*removes default webkit styles*/
	-webkit-appearance: none;
	/*fix for FF unable to apply focus style bug */
	border: 1px solid white;
	/*required for proper track sizing in FF*/
	}
	input[type=range]::-webkit-slider-runnable-track {
	height: 5px;
	background: #ddd;
	border: none;
	border-radius: 3px;
	}
	input[type=range]::-webkit-slider-thumb {
	-webkit-appearance: none;
	border: none;
	height: 16px;
	width: 16px;
	border-radius: 50%;
	webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	box-shadow: 2px 2px 3px 0px rgba(0, 0, 0, 0.4);
	background: #fff;
	margin-top: -4px;
	}
	
	
	input[type=range]:focus {
	outline: none;
	}
	input[type=range]:focus::-webkit-slider-runnable-track {
	background: #ccc;
	}
	input[type=range]::-moz-range-track {
	height: 5px;
	background: #ddd;
	border: none;
	border-radius: 3px;
	}
	input[type=range]::-moz-range-thumb {
	border: none;
	height: 16px;
	width: 16px;
	border-radius: 50%;
	webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	box-shadow: 2px 2px 3px 0px rgba(0, 0, 0, 0.4);
	background: #fff;
	}
	/*hide the outline behind the border*/
	input[type=range]:-moz-focusring{
	outline: 1px solid white;
	outline-offset: -1px;
	}
	input[type=range]::-ms-track {
	height: 5px;
	/*remove bg colour from the track, we'll use ms-fill-lower and ms-fill-upper instead */
	background: transparent;
	/*leave room for the larger thumb to overflow with a transparent border */
	border-color: transparent;
	border-width: 6px 0;
	/*remove default tick marks*/
	color: transparent;
	}
	input[type=range]::-ms-fill-lower {
	background: #777;
	border-radius: 10px;
	}
	input[type=range]::-ms-fill-upper {
	background: #ddd;
	border-radius: 10px;
	}
	input[type=range]::-ms-thumb {
	border: none;
	height: 16px;
	width: 16px;
	border-radius: 50%;
	webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	box-shadow: 2px 2px 3px 0px rgba(0, 0, 0, 0.4);
	background: #fff;
	}
	input[type=range]:focus::-ms-fill-lower {
	background: #888;
	}
	input[type=range]:focus::-ms-fill-upper {
	background: #ccc;
	}
	.img-pp-iner img.img-responsive.crp1 {
	float: left;margin-top: 3px;
	
	margin-right: 6px;
	}
	.img-pp-iner img.img-responsive.crp2 {
	float: right;
	
	margin-right: 23px;
	}
	.cropper-modal
	{
	background: none !important; ;
	}
	.modal-footer
	{
	border-top:none !important;
	}
	.cropper-bg
	{
	background-image: none !important;
	}
	.carousel
	{
	position: fixed !important;
	}	
	.upload-photo-blogs .up-blog img {
	   background: #fff;
	}
	#other_thumbnails img{background-color: transparent;}

</style>
@endsection
@section('content')
<section class="content create_section_page">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 costume_create_st1">
				<!--- progressbar section starts -->
				<div class="progressbar_main " >
					<h2>UPLOAD A COSTUME</h2>
					<ul id="progressbar" class="progressbar_rm hidden-xs">  
						<li class="active" id="step1"><span class="s-head">Step 1</span> <span>Upload <br/>Photos</span></li> 
						<li id="step2"><span class="s-head">Step 2</span> <span>Fill in Costume <br/>Description</span></li>
						<li id="step3"><span class="s-head">Step 3</span> <span>Pricing & <br/>Shipping</span></li>
						<li id="step4"><span class="s-head">Step 4</span> <span>Review <br/>Preferences</span></li>	 
					</ul>
				</div>	
				<!---mobile progressbar section starts -->
				<div class="progressbar_main hidden-sm hidden-md hidden-lg" style="display:none;">
					<h2>UPLOAD A COSTUME</h2>
					<ul id="progressbar" class="progressbar_rm" style="display:none;">  
						<li class="active" id="step1"><span class="s-head">Step 1</span> <span>Upload <br/>Photos</span></li> 
						<li id="step2"><span class="s-head">Step 2</span> <span>Fill in Costume <br/>Description</span></li>
						<li id="step3"><span class="s-head">Step 3</span> <span>Pricing & <br/>Shipping</span></li>
						<li id="step4"><span class="s-head">Step 4</span> <span>Review <br/>Preferences</span></li>	 
					</ul>
				</div>	
				<!--- mobile progressbar section end here -->
				<div id="total_forms_div">
					<form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="costume_total_form" id="costume_total_form" method="post">
						<!--Create costume image code starts here-->
						<div class="upload-photo-blogs" id="upload_div">
							<p class="prog-txt desk-pro-text">Please upload a <span>minimum of 3 photos</span> of your costume: a front, back and side view. Remember that listings with more photos sell faster, and don't forget to include any accessories!</p>
							<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">STEP 1</h2>
                                                        <h2 class="prog-head ">Upload Photos<span>(The optimal dimensions for the image is 260 x 356 pixels.)</span></h2>
							<!--- mobile heaindgs section end here -->
							<p class="prog-txt mobile-pro-text">Please upload <span>the minimum required photos</span> of your costume in front, back and side view. Listings with more photos sell faster! Don't forget to include any accessories!</p>
							<!--- mobile heaindgs section end here -->
							<div class="threeblogs">
								<div class="col-md-3 col-sm-3 col-xs-12 upload_hint r">
									<p><span class="up_tip">Tip</span> Respect your costume’s  integrity with crisp, clear photos. Placing them in settings that correspond with their theme can encourage a sale.</p>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12  c_pic " id="front_view">
									<h4>01. Front View</h4>
									<span class="remove_pic" id="drag_n_drop_1" style="display: none;" >
										<i class="fa fa-times-circle" aria-hidden="true"></i>				
									</span>
									<div class=" up-blog">
										<input type="file" name="file1" accept="image/*" id="file1" >
										<input type="hidden" class="modalOpen1" name="Imagecrop1">
										<img src="" class="result" >
										<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
									</div>
									<span id="file1_error" style="color:red"></span>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12 rc_pic" id="back_view">
									<h4>02. Back View</h4>
									<span class="remove_pic" id="drag_n_drop_2" style="display: none;" >
										<i class="fa fa-times-circle" aria-hidden="true"></i>				
									</span>
									<div class=" up-blog">
										<input type="file" name="file2" accept="image/*" id="file2" >
										<input type="hidden" class="modalOpen2" name="Imagecrop2">
										<img src="" class="result2" >
										<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
									</div>
									<span id="file2_error" style="color:red"></span>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12 rc_pic " id="details_view">
									<h4>03. Additional</h4>
									<span class="remove_pic" id="drag_n_drop_3" style="display: none;">
										<i class="fa fa-times-circle" aria-hidden="true"></i>					
									</span>
									<div class=" up-blog">
										<input type="file" name="file3" accept="image/*" id="file3" >
										<input type="hidden" class="modalOpen3" name="Imagecrop3" >
										<img src="" class="result3" >
										<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
									</div>
									<span id="file3_error" style="color:red"></span>
								</div>
							</div>
							<div class=" up_btns_tl col-md-12 col-sm-12 col-xs-12">
								<div id="other_thumbnails">
								</div>
								
								<div class="multiHidden">
								</div>
							
								<span id="fileselector">
									<label class="btn btn-default upload_more_btn" for="upload-file-selector">
										<input id="upload-file-selector" accept="image/*" type="file" name="file4[]" multiple >
										<i class="fa_icon icon-upload-alt margin-correction"></i> <i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Upload More
									</label>
								</span>
								<div class=" up_btns_tl col-md-12 col-sm-12 col-xs-12">
									<a type="button" id="upload_next" class=" upload_sub_btn btn btn-default nxt">Next Step</a>
								</div>
							
							</div>
						</div>
					</div>
					
					<!-- modal code here multiple images -->
					<div id="myModal" class="modal fade imageModel and carousel slide" role="dialog" data-backdrop="static">
						<div class="modal-dialog modal-md">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									{{--<button type="button" class="close"  id="closeModal1" data-dismiss="modal">&times;</button>--}}
									<h4 class="modal-title">Front Photo</h4>
								</div>
								<div class="modal-body">
									<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
									<div class="carousel-inner" id="dvPreview">
									</div>
									<div class="img-pp">
										<div class="img-pp-iner">
											<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
											<input type="range" id="zoom-level" min="0" max="5" value="0" step="any" >
											<img class="img-responsive crp2" src="{{URL::asset('assets/frontend/img/crp_2.png')}}">
										</div>
									</div>
									<div class="width"></div>
									<div class="height"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-success pull-right save" id="crop">Save</button>
									<button type="button" class="btn btn-default img_clse" data-dismiss="modal" id="cancel1">Cancel</button>
								</div>
							</div>
						</div>
					</div>
					<!-- model code ends here -->
					<!-- second modal code here -->
					<div id="myModal2" class="modal fade imageModel and carousel slide" role="dialog"  data-backdrop="static">
						<div class="modal-dialog modal-md">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									{{--<button type="button" class="close"  id="closeModal2"  data-dismiss="modal">&times;</button>--}}
									<h4 class="modal-title">Back Photo</h4>
								</div>
								<div class="modal-body">
									<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
									<div class="carousel-inner" id="dvPreview2">
									</div>
									<div class="img-pp">
										<div class="img-pp-iner">
											<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
											<input type="range" id="zoom-level2" min="0" max="5" value="0" step="any" >
											<img class="img-responsive crp2" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
										</div>
									</div>
									<div class="width"></div>
									<div class="height"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-success pull-right save" id="crop2">Save</button>
									<button type="button" class="btn btn-default img_clse" data-dismiss="modal" id="cancel2">Cancel</button>
								</div>
							</div>
						</div>
					</div>
					<!-- model code ends here -->
					<!-- third modal code here -->
					<div id="myModal3" class="modal fade imageModel and carousel slide" role="dialog"  data-backdrop="static">
						<div class="modal-dialog modal-md">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									{{--<button type="button" class="close"  id="closeModal3"  data-dismiss="modal">&times;</button>--}}
									<h4 class="modal-title">Additional Photo</h4>
								</div>
								<div class="modal-body">
									<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
									<div class="carousel-inner" id="dvPreview3">
									</div>
									<div class="img-pp">
										<div class="img-pp-iner">
											<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
											<input type="range" id="zoom-level3"  min="0" max="5" value="0" step="any" >
											<img class="img-responsive crp2" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
										</div>
									</div>
									<div class="width"></div>
									<div class="height"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-success pull-right save" id="crop3">Save</button>
									<button type="button" class="btn btn-default img_clse" data-dismiss="modal" id="cancel3">Cancel</button>
								</div>
							</div>
						</div>
					</div>
					
					<!-- multiple file modal -->
					
					<div class="modal fade and carousel slide" id="lightbox" data-interval="false" >
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									{{--<button type="button" class="close" id="closemulti" data-dismiss="modal">&times;</button>--}}
									<h4 class="modal-title">Crop Multiple Images</h4>
								</div>
								<div class="modal-body">
									<div class="carousel-inner" id="dvPreviewMultiple">
									</div>
									<div class="arrows">
										<a class="left carousel-control" href="#lightbox" role="button" data-slide="prev">
											<span class="glyphicon glyphicon-chevron-left"></span>
										</a>
										<a class="right carousel-control" href="#lightbox" role="button" data-slide="next">
											<span class="glyphicon glyphicon-chevron-right"></span>
										</a>
									</div>
								</div><!-- /.modal-body -->
								<div class="img-pp">
									<div class="img-pp-iner">
										<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
										<input type="range"  min="0" max="5" value="0" step="any" class="slider">
										<img class="img-responsive crp2" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
									</div>
								</div>
								<div class="modal-footer" style="display:none;">
									<button type="button" class="btn btn-success pull-right saveMultiple" >Save</button>
									<button type="button" class="btn btn-default img_clse" id="multiCancel" data-dismiss="modal">Cancel</button>
								</div>
								
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					<!-- ends here -->
					
					
					
					
					<!--- progressbar section End -->
					<!--Second div code starts here-->
					<!-- </div> -->
					<div id="costume_description">
						<p class="prog-txt desk-pro-text">Please fill in the following fields  <span>as accurately as possible</span> to prevent disputes.</p>
						<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">step 2</h2>
						<h2 class="prog-head">Costume Description</h2>
						<p class="prog-txt mobile-pro-text">Please fill in the following fields  <span>as accurately as possible</span> to prevent disputes.</p>
						<!-- <form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="costume_description_form" id="costume_description_form" method="post"> -->	
						<div class="prog-form-rm">
							<div class="col-md-6 cret_ctme_1">
								<!--costume name code starts here-->
								<div class="form-rms costume-error">
									<p class="form-rms-que">01. Name Your Costume!*</p>
									<p class="form-rms-input"><input type="text" name="costume_name" id="costume_name" autocomplete="off" tab-index="1" placeholder=""></p>
									<span id="costumename_error" style="color:red"></span>
									<p class="form-rms-small"><span>Give Your listing a descriptive title.</span> <br/>Example: "Men's Medium Spiderman<br/>Costume in Red"</p>
								</div>
								<!--costume name ends starts here-->
								<!--Catgeory code starts here-->
								<div class="form-rms costume-error">
									<p class="form-rms-que">02. Category*</p>
									<p class="form-rms-input">
										<select name="categoryname" id="categoryname" >
											<option value="">Select Category</option>
											@foreach($categories as $index=>$category)
											<option value="{{$category->categoryid}}">{{$category->categoryname}}</option>
											@endforeach
										</select>
									</p>
									<span id="categoryerror" style="color:red"></span>
								</div>
								<!--category code ends here-->
								<!--Gender Code starts here-->
								<div class="form-rms costume-error">
									<p class="form-rms-que">03. Sex*</p>
									<p class="form-rms-input">
										<select name="gender" id="gender">
											<option value="">Select Gender</option>
											<option value="male">Male</option>
											<option value="female">Female</option>
											<option value="unisex">Unisex</option>
											<option value="pet">Pet</option>
										</select>
									</p>
									<span id="gendererror" style="color:red"></span>
								</div>
								<!--Gender code ends here-->
								<!--size code starts here-->
								<div class="form-rms costume-error">
									<p class="form-rms-que">04. Size*</p>
									<p class="form-rms-input">
										<select name="size" id="size">
											<option value="">Select Size</option>
											<option value="1sz">1SZ</option>
											<option value="xxs">XXS</option>
											<option value="xs">XS</option>
											<option value="xs">S</option>
											<option value="m">M</option>
											<option value="l">L</option>
											<option value="xl">XL</option>
											<option value="xxl">XXL</option>
											<option value="std">STD</option>
										</select>
									</p>
									<span id="sizeerror" style="color:red"></span>
								</div>
								<!--size code ends here-->
								<!--Get subcategory ajax code starts here-->
								<div class="form-rms costume-error">
									<p class="form-rms-que">05. Subcategory*</p>
									<p class="form-rms-input">
										<select name="subcategory" id="subcategory">
											<option value="">Select Sub Category</option>
										</select>
									</p>
									<span id="subcategoryerror" style="color:red"></span>
								</div>
								<!--Get subcategory regarding categories code ends here-->
								<div class="form-rms costume-error">
									<p class="form-rms-que">06. Condition*</p>
									<p class="form-rms-input">
										
										<span class="full-rms"><input type="radio" name="condition" value="brand_new" id="brand_new"> <label for="brand_new">Brand New</label></span>
                                                                                <span class="full-rms"><input type="radio" name="condition" value="like_new" id="like_new"> <label for="like_new">Like New</label></span>
                                                                                <span class="full-rms"><input type="radio" name="condition" value="excellent" id="excellent"> <label for="excellent">Excellent</label></span>
										<span class="full-rms"><input type="radio" name="condition" value="good" id="good"> <label for="good">Good</label></span>
										
									</p>
									<span id="costumeconditionerror" style="color:red"></span>
								</div>
								<div class="form-rms costume-error">
									<p class="form-rms-que">07. {{$bodyanddimensions->label}} (Optional)</p>
									<div class="form-rms-input">
										<?php
											$value_height=$body_height_ft->value;
											$explode_value_height=explode('-',$value_height);
											$heading=$explode_value_height[0];
											$heading_value=$explode_value_height[1];
											$value_height_in=$body_height_in->value;
											$explode_value_height_in=explode('-',$value_height_in);
											$heading_value_in=$explode_value_height_in[1];
											$value_weight=$body_weight_lbs->value;
											$explode_value_weight=explode('-',$value_weight);
											$heading_weight_value=$explode_value_weight[0];
											$heading_weight_value_lbs=$explode_value_weight[1];
											$value_chest=$body_chest_in->value;
											$explode_value_chest=explode('-',$value_chest);
											$heading_chest_value=$explode_value_chest[0];
											$heading_chest_value_in=$explode_value_chest[1];
											$value_waist=$body_waist_lbs->value;
											$explode_value_waist=explode('-',$value_waist);
											$heading_waist_value=$explode_value_waist[0];
											$heading_waist_value_lbs=$explode_value_waist[1];
										?>
										<p class="form-rms-dim form-rms-he"><?php echo ucfirst($heading); ?> <br/> <span class="form-rms-he1">
											<input type="{{$bodyanddimensions->code}}" name="{{$body_height_ft->value}}" id="{{$body_height_ft->value}}"> <span><?php echo $heading_value;?></span>
										<input type="{{$bodyanddimensions->code}}" class="form-rms-dt" name="{{$body_height_in->value}}" id="{{$body_height_in->value}}" > <span><?php echo $heading_value_in; ?></span></span></p>
										<p class="form-rms-dim weight-chest"><?php echo ucfirst($heading_weight_value); ?> <br/> <span class="form-rms-he1"><input type="text" name="{{$body_weight_lbs->value}}" id="{{$body_weight_lbs->value}}"> <span><?php echo $heading_weight_value_lbs;?></span></span></p>
										<p class="form-rms-dim weight-chest"><?php echo ucfirst($heading_chest_value); ?> <br/> <span class="form-rms-he1"><input type="text" name="{{$body_chest_in->value}}" id="{{$body_chest_in->value}}" > <span><?php echo $heading_chest_value_in; ?> </span></span></p>
										<p class="form-rms-dim weight-chest"><?php echo ucfirst($heading_waist_value); ?> <br/> <span class="form-rms-he1"><input type="text" name="{{$body_waist_lbs->value}}" id="{{$body_waist_lbs->value}}"> <span><?php echo $heading_waist_value_lbs; ?></span></span></p>
										<span id="bodydimensionerror"  style="color:red"></span>
									</div>
								</div>
								<div class="form-rms costume-error">
									<p class="form-rms-que">08. {{$cosplayone->label}}</p>
									<p class="form-rms-input">
										@foreach($cosplayone_values as $index=>$cosplayone_val)
										<span class="full-rms"><input type="{{$cosplayone->type}}" name="{{$cosplayone->code}}" id="{{$cosplayone_val->optionid}}" value="{{$cosplayone_val->optionid}}"> <label for="{{$cosplayone_val->optionid}}">{{$cosplayone_val->value}}</label></span>
										@endforeach
									</p>
									<span id="cosplayerror" style="color:red"></span>
									<div class="row" id="cosplayplay_yes_div" style="display: none;">
										<div class="col-md-12" >
											<p class="slt_act_all">Select all that apply:</p>
											<!--
											<div class="fity_hlf">
												<div class="radio-inline ">
													<label for="Anime/Manga"><input type="radio" id="Anime/Manga" name="cosplayplay_yes_opt" value="Anime/Manga">Anime/Manga</label>
												</div>
												<div class="radio-inline ">
													<label for="Sci-Fi"><input type="radio" id="Sci-Fi" name="cosplayplay_yes_opt" value="Sci-Fi">Sci-Fi</label>
												</div>
											</div>
											-->

											<div class="fity_hlf">
													@foreach($cosplaySubCategories as $subCat)
														<div class="radio-inline">
															<label for="{{ $subCat->name }}"><input type="radio" name="cosplayplay_yes_opt" value="{{ $subCat->name }}" id="{{ $subCat->name }}">{{ $subCat->name }}</label>
														</div>
													@endforeach
													<!--
													<div class="fity_hlf">
														<div class="radio-inline">
															<label for="Other"><input type="radio" name="uniquefashion_yes_opt" value="Other" id="Other">Other</label>
														</div>
													</div>
													-->
												</div>

										</div>
										
										<span id="cosplay_yeserror" style="color:red"></span>
									</div>
								</div>
								<div class="form-rms costume-error">
									<p class="form-rms-que">09. {{$cosplaytwo->label}}</p>
									<p class="form-rms-input">
										@foreach($cosplaytwo_values as $index=>$cosplaytwo_val)
										<span class="full-rms"><input type="{{$cosplaytwo->type}}" name="{{$cosplaytwo->code}}" id="{{$cosplaytwo_val->optionid}}" value="{{$cosplaytwo_val->optionid}}"> <label for="{{$cosplaytwo_val->optionid}}">{{$cosplaytwo_val->value}}</label></span>
										@endforeach
									</p>
									<span id="uniquefashionerror" style="color:red"></span>
									<div class="row" id="uniquefashion_yes_div" style="display: none;">
										<div class="col-md-12" >
											<p class="slt_act_all">Select all that apply:</p>
											<!--
											<div class="fity_hlf">
												<div class="radio-inline">
													<label for="Cyberpunk"><input type="radio" name="uniquefashion_yes_opt" value="Cyberpunk" id="Cyberpunk">Cyberpunk</label>
												</div>
												<div class="radio-inline">
													<label for="Lolita"><input type="radio" name="uniquefashion_yes_opt" value="Lolita" id="Lolita">Lolita</label>
												</div>
											</div>
											-->

											<div class="fity_hlf">
													@foreach($uniqueFashionSubCategories as $subCat)
														<div class="radio-inline">
															<label for="{{ $subCat->name }}"><input type="radio" name="uniquefashion_yes_opt" value="{{ $subCat->name }}" id="{{ $subCat->name }}">{{ $subCat->name }}</label>
														</div>
													@endforeach
													<!--
													<div class="fity_hlf">
														<div class="radio-inline">
															<label for="Other"><input type="radio" name="uniquefashion_yes_opt" value="Other" id="Other">Other</label>
														</div>
													</div>
													-->
												</div>


										</div>
										<span id="uniquefashion_yeserror" style="color:red"></span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-rms costume-error">
									<p class="form-rms-que">10. {{$cosplaythree->label}}</p>
									<p class="form-rms-input">
										@foreach($cosplaythree_values as $index=>$cosplaythree_val)
										<span class="full-rms"><input type="{{$cosplaythree->type}}" name="{{$cosplaythree->code}}" id="{{$cosplaythree_val->optionid}}" value="{{$cosplaythree_val->optionid}}"> <label for="{{$cosplaythree_val->optionid}}">{{$cosplaythree_val->value}}</label></span>
										@endforeach
									</p>
									<span id="activityerror" style="color:red"></span>
									<div class="row" id="activity_yes_div" style="display: none;">
										<div class="col-md-12" >
											<p class="slt_act_all">Select all that apply:</p>
											<!--
											<div class="fity_hlf">
												<div class="radio-inline">
													<label for="Circus"><input type="radio" name="activity_yes_opt" value="Circus" id="Circus">Circus</label>
												</div> 
											</div>
											-->
											<div class="fity_hlf">
													@foreach($filmTheatreSubCategories as $subCat)
														<div class="radio-inline">
															<label for="{{ $subCat->name }}"><input type="radio" name="activity_yes_opt" value="{{ $subCat->name }}" id="{{ $subCat->name }}">{{ $subCat->name }}</label>
														</div>
													@endforeach
													<!--
													<div class="fity_hlf">
														<div class="radio-inline">
															<label for="Other"><input type="radio" name="uniquefashion_yes_opt" value="Other" id="Other">Other</label>
														</div>
													</div>
													-->
												</div>
										</div>
										
										<span id="activity_yeserror" style="color:red"></span>
									</div>
								</div>
								<div class="form-rms costume-error">
									<p class="form-rms-que">11. {{$cosplayfour->label}}</p>
									<p class="form-rms-input">
										@foreach($cosplayfour_values as $index=>$cosplayfour_val)
										<span class="full-rms"><input type="{{$cosplayfour->type}}" name="{{$cosplayfour->code}}" id="{{$cosplayfour_val->optionid}}" value="{{$cosplayfour_val->optionid}}"> <label for="{{$cosplayfour_val->optionid}}">{{$cosplayfour_val->value}}</label></span>
										@endforeach
										<p class="form-rms-small" id="mention_hours" style="display:none" >If yes, how long did it take?</p>
										<p class="ct1-rms-rel form-rms-input" id="mention_hours_input" style="display:none"><input type="text" name="make_costume_time1" id="make_costume_time1" class="input-rm100"> <span>hours<span>
										</p>
										<span id="usercostumeerror" style="color:red"></span>
										</div>
										<div class="form-rms costume-error">
											<p class="form-rms-que">12. {{$cosplayfive->label}}*</p>
											<p class="form-rms-input">
												@foreach($cosplayfive_values as $index=>$cosplayfive_val)
												<span class="full-rms"><input type="{{$cosplayfive->type}}" name="{{$cosplayfive->code}}" id="{{$cosplayfive_val->optionid}}" value="{{$cosplayfive_val->optionid}}"> <label for="{{$cosplayfive_val->optionid}}">{{$cosplayfive_val->value}}</label></span>
												@endforeach
											</p>
											<p class="form-rms-small" id="film_text" style="display:none" >Which production was your costume featured in? </p>
											<p class="ct1-rms-rel form-rms-input" id="film_text_input" style="display:none">
												<input type="text" name="film_name" id="film_name" > <span><span>
												</p>
												<span id="qualityerror" style="color:red"></span>
												</div>
												<div class="form-rms descibr_smte_text costume-error">
													<p class="form-rms-que form-rms-que1"><span>13. </span>How would you describe your costume?</p>
													<p>Have a unique costume? Please enter a maximum of <strong>10</strong> keywords to describe it.</p>
													<p><span class="ctume_tip-spn">Tip:</span>Have a speciailty costume? To increase your changes of making a sale, input the approprite keywords with our existing <span>list of categories.</span> </p>
													<p class="form-rms-input"><input type="text" id="keywords_tag">
														<a href="javascript:void(0)" id="keywords_add">Add</a>
													</p>
													<div id="div" class="keywords_div">
													</div>
													<div id="count">10 left</div>
													<input id="input_10" name="keyword_10" value="" type="hidden">
													<input id="input_9" name="keyword_9" value="" type="hidden">
													<input id="input_8" name="keyword_8" value="" type="hidden">
													<input id="input_7" name="keyword_7" value="" type="hidden">
													<input id="input_6" name="keyword_6" value="" type="hidden">
													<input id="input_5" name="keyword_5" value="" type="hidden">
													<input id="input_4" name="keyword_4" value="" type="hidden">
													<input id="input_3" name="keyword_3" value="" type="hidden">
													<input id="input_2" name="keyword_2" value="" type="hidden">
													<input id="input_1" name="keyword_1" value="" type="hidden">
												</div>
												<div class="form-rms costume-error">
													<p class="form-rms-que form-rms-que1"><span>14. Describe your Costume:</span> Including accessories*</p>
													<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="description" id="description" maxlength="600" ></textarea></p>
													<span id="descriptionerror" style="color:red"></span>
													<p class="form-rms-sm1">( <span id="max_length_char1"></span> 600 characters)</p>
												</div>
												<div class="form-rms costume-error">
													<p class="form-rms-que form-rms-que1"><span>15. Fun Fact:</span> A little backstory to your costume and the adventures it has experienced</p>
													<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="funfcats" id="funfacts" maxlength="600" ></textarea></p>
													<span id="facterror" style="color:red"></span>
													<p class="form-rms-sm1">( <span id="max_length_char2"></span> 600 characters)</p>
												</div>
												<div class="form-rms costume-error">
													<p class="form-rms-que form-rms-que1"><span>16. FAQ </span>Create your own costume Frequently Asked Questions to avoid an overload of questions in your inbox!</p>
													<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="faq" id="faq" maxlength="600" ></textarea></p>
													<span id="faqerror" style="color:red"></span>
													<p class="form-rms-sm1">( <span id="max_length_char3"></span> 600 characters)</p>
													<div class="form-rms-btn">
														<a type="button" id="costume_description_back" class="btn-rm-back"><span>Back</span></a>
														<!-- </form> -->
														<a type="button" id="costume_description_next" class="btn-rm-nxt nxt">Next Step</a>
													</div>
												</div>
												<!--costume three code starts here-->
												<!--costume three code ends here-->
											</div>
										</div>
										</div>
										<div class="prog-form-rm" id="pricing_div">
											<!-- <form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="costume_pricing_form" id="costume_pricing_form" method="post"> -->
											<p class="prog-txt hidden-xs  ">Please fill in the following field <span>as accurately</span> as you can.</p>
											<div class="row">
												<div class="col-md-6">
													<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">STEP 3</h2>
													<h2 class="prog-head">Pricing</h2>
													<p class="prog-txt hidden-md hidden-lg hidden-sm ">Please fill in the following field <span>as accurately</span> as you can.</p>
													<div class="form-rms pricess pric_tag_three">
														<p class="form-rms-que">01. Price</p>
														<div class="form-rms-input">
															<p class="form-rms-rel "><input type="text" class="input-rm100" name="price" id="price" ><span class="form-rms-abs"><i class="fa fa-usd" aria-hidden="true"></i></span></p>
														<p class="cst2-textl2">Not Sure? <i class="fa fa-info-circle" aria-hidden="true"></i></p></div>
														<span id="priceerror" style="color:red"></span>
													</div>
													<div class="form-rms">
														<p class="form-rms-que">02. Quantity</p>
														<p class="form-rms-input"><select  name="quantity" id="quantity" class="cst2-select50">
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
															<option>5</option>
															<option>6</option>
															<option>7</option>
															<option>8</option>
															<option>9</option>
															<option>10</option>
														</select></p>
													</div>
													<span id="quantityerror" style="color:red"></span>
												</div>
												<div class="col-md-6">
													<h2 class="prog-head snd-hdng">Package Information</h2>
													<div class="form-rms">
														<p class="form-rms-que">01. Weight of Packaged Item</p>
														<div class="form-rms-input dimensions-two dimensions-two-pk_info">
															<p class="form-rms-dim"><span class="form-rms-he1"><input id="pounds" name="pounds" type="text"> <span>lbs</span></span></p>
															<span id="poundserror" style="color:red"></span>
															<p class="form-rms-dim"><span class="form-rms-he1"><input id="ounces" name="ounces" type="text"> <span>oz </span></span></p>
															<span id="ounceserror" style="color:red"></span>
														</div>
														<p class="ct3-rms-text">Note: Weight is applicable for one costume ONLY.</p>
													</div>
													<div class="form-rms">
														<p class="form-rms-que">02. Dimensions</p>
														<div class="form-rms-input dimensions-two dimensions-two-pk_info">
															<?php $i =1; ?>
															@foreach($dimensions as $index=>$dimensions)
															<?php
																$value=$dimensions->value;
																$headingexplode=explode('-',$value);
																$heading=$headingexplode[0];
																$heading_value=$headingexplode[1];
															?>
															<p class="form-rms-dim"><?php echo ucfirst($heading); ?> <br/> <span class="form-rms-he1"><input type="text" id="<?php echo ucfirst($heading); ?>" name="<?php echo ucfirst($heading); ?>"> <span><?php echo $heading_value; ?> @if ($i <= 2) x @endif</span></span></p>
																<?php $i++; ?>
																@endforeach
															</div>
															<span id="dimensionserror" style="color:red"></span>
															</div>
														</div>
													</div>
													<div class="form-rms-btn">
														<a type="button" id="pricing_back" class="btn-rm-back"><span>Back</span></a>
														<a type="button" id="pricing_next" class="btn-rm-nxt nxt">Next Step</a>
													</div>
													<!-- </form> -->
												</div>
												<div class="prog-form-rm" id="preferences_div">
													<!-- <form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="costume_preferences_form" id="costume_preferences_form" method="post"> -->
													<p class="prog-txt  hidden-xs">You're almost done! Just a few more questions.</p>
													<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">step 3</h2>
													<h2 class="prog-head">Review Your Preferences</h2>
													<div class="col-md-6">
														<p class="prog-txt hidden-md hidden-lg hidden-sm ">You're almost done! Just a few more questions.</p>
														<div class="form-rms">
															<p class="form-rms-que">01. Handling Time <i class="fa fa-info-circle fa-info-rm" aria-hidden="true"></i></p>
															<p class="form-rms-input">
																<select name="handlingtime" id="handlingtime">
																	<option value="">Select Handling Time</option>
																	@foreach($handlingtime as $index=>$handlingtime)
																	<option value="{{$handlingtime->optionid}}">{{$handlingtime->value}}</option>
																	@endforeach
																</select>
															</p>
															<span id="handlingtimeerror" style="color:red"></span>
														</div>
														<div class="form-rms">
															<p class="form-rms-que">02. Return Policy</p>
															<p class="form-rms-input">
																<select name="returnpolicy" id="returnpolicy" >
																	<option value="">Select Return Policy</option>
																	@foreach($returnpolicy as $index=>$returnpolicy)
																	<option value="{{$returnpolicy->optionid}}">{{$returnpolicy->value}}</option>
																	@endforeach
																</select>
															</p>
															<span id="returnpolicyerror" style="color:red"></span>
														</div>
													</div>
													<div class="col-md-6 charity_rigt">
														<div class="form-rms lst-stp">
															<p class="form-rms-que form-rms-que1 dnt_br">03. Donate a Portion to Charity</p>
															<p class="ct3-rms-text">Chrysalis Charges a 3% transaction fee on sale of every costume.However, if you donate 5% or more of your sale to a charity we will waive our transcation fee to match your contribution</p>
															<p class="ct3-rms-text">By Choosing to donate, I agree and accept Chrysalis' <a style="border-bottom: 1px solid #ccc" href="{{ route('terms-of-use') }}" target="_blank">Terms & Conditions</a>.</p>
															<p class="ct3-rms-head">Donation Amount</p>
															<div class="form-rms-input">
                                                                                                                            <p class="form-rms-rel1"><select class="cst2-select80" id="donate_charity" name="donate_charity"><option value="">Donate Amount</option><option value="none">None</option><option value="1" selected="selected">1%</option><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option></select></p>
																<p class="cst3-textl2" id="dynamic_percent_amount" >
																<i class="fa fa-usd" aria-hidden="true"></i>0.00</p>
																<span id="donate_charityerror" style="color:red"></span>
																<input type="hidden" name="hidden_donation_amount" id="hidden_donation_amount" value="">
															</div>
															<p class="ct3-rms-head">Donate to</p>
															<ul class="ct3-list">
																@foreach($charities as $index=>$charity)
																<!-- image logic -->
                                                                    <?php
                                                                    if(isset($charity->image) && !empty($charity->image)){
                                                                        $path = '/charities_images/'.$charity->image;
                                                                        if(file_exists(public_path($path))){
                                                                            $listingImage = URL::asset('/charities_images/'.$charity->image);
                                                                        }else{
                                                                            $listingImage = URL::asset('/charities_images/charity_placeholder.png');
                                                                        }
                                                                    }else{
                                                                        $listingImage = URL::asset('/charities_images/charity_placeholder.png');
                                                                    }
                                                                    ?>
																	<!-- end image logic -->
																<li><img src="{{URL::asset($listingImage)}}" alt="{{$charity->name}}" />
																	<p>{{$charity->name}}</p>
																<input type="radio" id="{{$charity->name}}" value="{{$charity->id}}" name="charity_name" /></li>
																@endforeach
															</ul>
															<span id="charity_nameerror" style="color:red"></span>
															<p class="cst2-rms-chck"><input type="checkbox" id="another_charity" name="another_charity"> I would like to suggest another charity organization</p>
														</div>
														<div class="form-rms" id="other_organzation_check" style="display: none;">
															<p class="ct3-rms-head chartiy_spcy">Please Specify:</p>
															<p class="form-rms-input org_nme"><input type="text"  name="organzation_name" id="organzation_name" autocomplete="off" placeholder="Organization Name"  class="form-control"></p>
															<span id="organzation_nameerror" style="color:red"></span>
														</div>
														<div class="form-rms-btn loader-align">
															<img id='ajax_loader' src="{{asset('img/ajax-loader.gif')}}" style="display :none;" >	
															<a type="button" id="preferences_finished" class="btn-rm-nxt">I'm Finished!</a>
															<a type="button" id="preferences_back" class="btn-rm-back"><span>Back</span></a>
														</div>
													</div>
													<!-- </form> -->
												</div>
											</form>
										</div><!-- id='total_forms_div' -->
										<div id="success_page" style="display: none;">
											<div class="col-md-12">
												<div class="row">
													<div class="success_page_final">
														<img class="img-responsive" src="{{URL::asset('assets/frontend/img/chrysalis-meme.png')}}">
														<h2>Success!</h2>
														<p>Thank You for listing your costume with Chrysalis!<br>
														Your costume has successfully been uploaded.</p>
														<a type="button" id="" href="{{URL::to('/')}}" class="btn-rm-ret">Return Home</a><br>
														<a type="button" id="costume_view_my_listing" href="{{URL::to('my/costumes')}}" class="btn-rm-view-finl"> <span>View My Listing!<span></a>
														</div>
														</div>
													</div>
												</div>
												<!-- </div> -->
												<!-- </div> -->	
											</div>	</div>		</div>	
											<!-- </form> -->
											<!---Second div code ends here-->
											@stop
											{{-- page level scripts --}}
											@section('footer_scripts')
											<!--<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
											<script type="text/javascript" src="{{asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')}}"></script>
											<!--Getting subcategory list by oonchange-->
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.js"></script>
			<script type="text/javascript" src="{{asset('/assets/frontend/js/pages/costumecustom.js')}}"></script>
											@stop
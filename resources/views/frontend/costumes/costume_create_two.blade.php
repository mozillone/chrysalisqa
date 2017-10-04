@extends('/frontend/app')
@section('styles')
<<<<<<< HEAD
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
	/*#dvPreview
	{
	height: 100% !important;
	position: relative !important;
	bottom: 475px !important;
	}*/
	/* sucess page code starts here*/

	.media-bg {
   width: 350px;
   margin: 0 auto;    margin-top: 15px;
   margin-bottom: 30px;
   display: inline-block;
    }
    .media-bg img {
   float: left;    margin-right: 15px;
    }
    .media-bg p {
   vertical-align: middle;
   margin-top: 55px;    font-size: 20px;
   text-align: left;
   color: #60c4ac
;
   font-family: Proxima-Nova-Extrabold;
    }
    
    .media.tnks_media {
   width: 500px;
   margin: 0 auto;
   text-align: left;
   border: 3px solid #60c3ab
;
   padding: 25px;
   border-radius: 15px;
    }
    .media.tnks_media .media-body a {
   color: #ee4266
;
    }
    .media.tnks_media .media-body p {
   font-size: 16px;
    }
    .social-circle li a {
    display:inline-block;
    position:relative;
    margin:0 auto 0 auto;
    -moz-border-radius:50%;
    -webkit-border-radius:50%;
    border-radius:50%;
    text-align:center;
    width: 50px;
    height: 50px;
    font-size:20px;
    }
    ul.social-network li {
   display: inline;
   margin: 0 2px;
    }
    .tnks_socila {
   margin-top: 30px;
   margin-bottom: 10px;
    }
    .tnks_socila ul.social-network.social-circle {
   padding-left: 0px;
    }
    .media.tnks_media .media-body p {
   margin-bottom: 30px;
    }
    .success_page_final h2{font-family: Proxima-Nova-Extrabold;}
    
    @media screen and (max-width:767px){
    .media.tnks_media {
   width: auto;}
        .media.tnks_media .media-body p {
   margin-bottom: 10px;
}
    }
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
											<input type="range" id="zoom-level" min="1" value="0" step="any" max="5">
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
											<input type="range" id="zoom-level2" min="0" value="0" step="any" >
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
											<input type="range" id="zoom-level3" min="0" value="0" step="any" >
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
										<input type="range" min="0" value="0" step="any" class="slider">
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
					
					<div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 cos_desc_div" >
						<div id="costume_description">
							<p class="prog-txt desk-pro-text">Please fill in the following fields  <span>as accurately as possible</span> to prevent disputes.</p>
							<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">step 2</h2>
							<h2 class="prog-head">Costume Description</h2>
							<p class="prog-txt mobile-pro-text">Please fill in the following fields  <span>as accurately as possible</span> to prevent disputes.</p>
							
							<div class="prog-form-rm">
								<div class="col-md-12 col-sm-12 cret_ctme_1">
									<!--costume name code starts here-->
									<div class="form-rms costume-error">
										<div class="col-md-4 col-sm-4 pdlft0">
											<p class="form-rms-que">Costume Name *</p>									
											<p class="form-rms-small">
												Example:<br/>
												"Dark Knight Joker Cosplay"
											</p>
										</div>	
										<div class="col-md-8 col-sm-8">
											<p class="form-rms-input">
												<input type="text" name="costume_name" class="form-control" id="costume_name" autocomplete="off" tab-index="1" placeholder=" Enter your costume name">
												<span id="costumename_error" style="color:red"></span>
											</p>										
										</div>
									</div>
									<!--costume name ends starts here-->
									<!--Catgeory code starts here-->
									<div class="form-rms costume-error">
										<div class="col-md-4 col-sm-4 pdlft0">
											<p class="form-rms-que">Category*</p>
										</div>
										<div class="col-md-8 col-sm-8">
											<p class="form-rms-input">
												<select name="categoryname" id="categoryname" class="form-control">
													<option value="">Select Category</option>
													@foreach($categories as $index=>$category)
													<option value="{{$category->categoryid}}">{{$category->categoryname}}</option>
													@endforeach
												</select>
											</p>
											<span id="categoryerror" style="color:red"></span>
										</div>
									</div>
									<!--category code ends here-->
									<!--Gender Code starts here-->
									<div class="form-rms costume-error">
										<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
											<p class="form-rms-que">Sex*</p>
										</div>								
										<div class="col-md-8 col-sm-8" id="genderRadio">	
											<div class="form-rms-input">									 
												<div class="col-md-2 col-sm-4 ">
													<input  id="radio-1" class="radio-custom" name="gender" type="radio" value="male">
													<label for="radio-1" class="radio-custom-label">Male</label>
												</div>
												<div class="col-md-2 col-sm-4">
													<input id="radio-2"  class="radio-custom" name="gender" type="radio" value="female">
													<label for="radio-2" class="radio-custom-label">Female</label>
												</div>
												<div class="col-md-2 col-sm-4">
													<input id="radio-3"  class="radio-custom" name="gender" type="radio" value="boy">
													<label for="radio-3" class="radio-custom-label">Boys</label>
												</div>
												<div class="col-md-2 col-sm-4">
													<input id="radio-4"  class="radio-custom" name="gender" type="radio" value="girl">
													<label for="radio-4" class="radio-custom-label">Girls</label>
												</div>
												<div class="col-md-2 col-sm-4">
													<input id="radio-5"  class="radio-custom" name="gender" type="radio" value="baby">
													<label for="radio-5" class="radio-custom-label">Babies</label>
												</div>
											</div>
											<span id="gendererror" style="color:red"></span>
										</div>									
									</div>
									<!--Gender code ends here-->
									<!--size code starts here-->
									<div class="form-rms costume-error">
										<div class="col-md-4 col-sm-4 pdlft0">
											<p class="form-rms-que">Size*</p>
										</div>
										<div class="col-md-8 col-sm-8">
											<p class="form-rms-input">
												<select name="size" id="size" class="form-control">
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
										
									</div>
									<!--size code ends here-->
									<!--Get subcategory ajax code starts here-->
									<div class="form-rms costume-error">
										<div class="col-md-4 col-sm-4 pdlft0">
											<p class="form-rms-que">Sub Category*</p>
										</div>									
										<div class="col-md-8 col-sm-8">
											<p class="form-rms-input">
												<select name="subcategory" id="subcategory" class="form-control">
													<option value="">Select Sub Category</option>
												</select>
											</p>
											<span id="subcategoryerror" style="color:red"></span>
										</div>
									</div>
									<!--Get subcategory regarding categories code ends here-->
									<div class="form-rms costume-error condition_div">
										<div class="col-md-4 col-sm-4 pdlft0">
											<p class="form-rms-que">Condition*</p>
										</div>
										<div class="col-md-8 col-sm-8">
											<div class="col-md-12 col-sm-12 col-xs-12 pdlft0" >
												<div class="col-md-3 col-sm-4 pdlft0">
													<input id="radio-6" class="radio-custom" name="condition" type="radio" value="good">
													<label for="radio-6" class="radio-custom-label">Good</label>
												</div>
												<div class="col-md-3  col-sm-4">
													<input id="radio-7" class="radio-custom" name="condition" type="radio" value="likenew">
													<label for="radio-7" class="radio-custom-label">Like New</label>
												</div>
												<div class="col-md-3  col-sm-4">
													<input id="radio-8" class="radio-custom" name="condition" type="radio" value="brand_new">
													<label for="radio-8" class="radio-custom-label">Brand New</label>
												</div>
											</div>
											<span id="costumeconditionerror" style="color:red"></span>
										</div>									
									</div>
									<!--<div class="form-rms costume-error body-dimnets">
										<div class="col-md-4 col-sm-4">
										<p class="form-rms-que">Body &amp; Dimensions (Optional)</p>
										</div>
										<div class="col-md-8 col-sm-8">
										<div class="form-rms-input">
										<p class="form-rms-dim form-rms-he">Height <br> <span class="form-rms-he1">
										<input type="body-dimensions" name="height-ft" id="height-ft"> <span>ft</span>
										<input type="body-dimensions" class="form-rms-dt" name="height-in" id="height-in"> <span>in</span></span></p>
										<p class="form-rms-dim weight-chest">Weight <br> <span class="form-rms-he1"><input type="text" name="weight-lbs" id="weight-lbs"> <span>lbs</span></span></p>
										<p class="form-rms-dim weight-chest">Chest <br> <span class="form-rms-he1"><input type="text" name="chest-in" id="chest-in"> <span>in </span></span></p>
										<p class="form-rms-dim weight-chest">Waist <br> <span class="form-rms-he1"><input type="text" name="waist-lbs" id="waist-lbs"> <span>lbs</span></span></p>
										<span id="bodydimensionerror" style="color:red"></span>
										</div>
										</div>
									</div>-->
									<!--<div class="form-rms costume-error">
										<div class="col-md-4 col-sm-4">
										<p class="form-rms-que">{{$cosplayone->label}}</p>
										</div>
										<div class="col-md-8 col-sm-8 pdlft0">
										<p class="form-rms-input">
										@foreach($cosplayone_values as $index=>$cosplayone_val)
										<span class="full-rms">
										<div class="col-md-2 col-sm-4">
										<input id="{{$cosplayone_val->optionid}}" class="radio-custom" name="{{$cosplayone->code}}" type="{{$cosplayone->type}}" value="{{$cosplayone_val->optionid}}">
										<label for="{{$cosplayone_val->optionid}}" class="radio-custom-label">{{$cosplayone_val->value}}</label>
										</div>													 
										</span>
										@endforeach
										</p>
										<span id="cosplayerror" style="color:red"></span>
										<div class="row" id="cosplayplay_yes_div" style="display: none;">
										<div class="col-md- col-sm-12" >
										<p class="slt_act_all">Select all that apply:</p>
										<div class="fity_hlf">
										@foreach($cosplaySubCategories as $subCat)
										<div class="col-md-6 col-sm-6">
										<input id="{{ $subCat->name }}" class="radio-custom" name="cosplayplay_yes_opt" type="radio" value="{{$subCat->name }}">
										<label for="{{ $subCat->name }}" class="radio-custom-label">{{ $subCat->name }}</label>
										</div> 
										@endforeach													 
										</div>
										</div>
										<span id="cosplay_yeserror" style="color:red"></span>
										</div>
										</div>									
										</div>
										
										<div class="form-rms costume-error">
										<div class="col-md-4 col-sm-4">
										<p class="form-rms-que">{{$cosplaytwo->label}}</p>
										</div>
										<div class="col-md-8 col-sm-8 pdlft0">
										<p class="form-rms-input">
										@foreach($cosplaytwo_values as $index=>$cosplaytwo_val)
										<span class="full-rms">
										<div class="col-md-2  col-sm-4">
										<input id="{{$cosplaytwo_val->optionid}}" class="radio-custom" name="{{$cosplaytwo->code}}" type="{{$cosplaytwo->type}}" value="{{$cosplaytwo_val->optionid}}">
										<label for="{{$cosplaytwo_val->optionid}}" class="radio-custom-label">{{$cosplaytwo_val->value}}</label>
										</div>
										</span>
										@endforeach
										</p>
										<span id="uniquefashionerror" style="color:red"></span>
										<div class="row" id="uniquefashion_yes_div" style="display: none;">
										<div class="col-md-12" >
										<p class="slt_act_all">Select all that apply:</p>
										<div class="fity_hlf">
										@foreach($uniqueFashionSubCategories as $subCat)
										<div class="radio-inline">
										<input id="{{ $subCat->name }}" class="radio-custom" name="uniquefashion_yes_opt" type="radio" value="{{ $subCat->name }}">
										<label for="{{ $subCat->name }}" class="radio-custom-label">{{ $subCat->name }}</label> 
										</div>
										@endforeach
										</div>
										</div>
										<span id="uniquefashion_yeserror" style="color:red"></span>
										</div>
										</div>
										</div>						 
										
										<div class="form-rms costume-error">
										<div class="col-md-4 col-sm-4">
										<p class="form-rms-que">{{$cosplaythree->label}}</p>
										</div>
										<div class="col-md-8 col-sm-8 pdlft0">
										<p class="form-rms-input">
										@foreach($cosplaythree_values as $index=>$cosplaythree_val)
										<span class="full-rms">
										<div class="col-md-2  col-sm-4">
										<input id="{{$cosplaythree_val->optionid}}" class="radio-custom" name="{{$cosplaythree->code}}" type="{{$cosplaythree->type}}" value="{{$cosplaythree_val->optionid}}">
										<label for="{{$cosplaythree_val->optionid}}" class="radio-custom-label">{{$cosplaythree_val->value}}</label>
										</div> 
										</span>
										@endforeach
										</p>
										<span id="activityerror" style="color:red"></span>
										<div class="row" id="activity_yes_div" style="display: none;">
										<div class="col-md-12" >
										<p class="slt_act_all">Select all that apply:</p>
										
										<div class="fity_hlf">
										
										@foreach($filmTheatreSubCategories as $subCat)
										<div class="radio-inline">
										<input id="{{ $subCat->name }}" class="radio-custom" name="activity_yes_opt" type="radio" value="{{ $subCat->name }}">
										<label for="{{ $subCat->name }}" class="radio-custom-label">{{ $subCat->name }}</label>
										</div>
										@endforeach
										
										</div>
										</div>
										<span id="activity_yeserror" style="color:red"></span>
										</div>
										</div>
									</div>-->
									
									
									
									
									
									<div class="form-rms costume-error">
										<div class="col-md-4 col-sm-4 pdlft0">
											<p class="form-rms-que">{{$cosplayfive->label}}*</p>
										</div>
										<div class="col-md-8 col-sm-8 pdlft0">
											<p class="form-rms-input">
												@foreach($cosplayfive_values as $index=>$cosplayfive_val)
												<span class="full-rms">
													<div class="col-md-2  col-sm-4">
														<input id="{{$cosplayfive_val->optionid}}" class="radio-custom" name="{{$cosplayfive->code}}" type="{{$cosplaythree->type}}" value="{{$cosplayfive_val->optionid}}">
														<label for="{{$cosplayfive_val->optionid}}" class="radio-custom-label">{{$cosplayfive_val->value}}</label>
													</div>
												</span>
												@endforeach
											</p>
											<div class="pdlft10">
											<p class="form-rms-small" id="film_text" style="display:none" >Which production was your costume featured in? </p>
											<p class="ct1-rms-rel form-rms-input" id="film_text_input" style="display:none">
												<input type="text" name="film_name" id="film_name" > <span><span>
												</p>
												</div>
												<span id="qualityerror" style="color:red"></span>
												</div>
											</div>
											
											<div class="form-rms descibr_smte_text costume-error">
												<div class="col-md-4 col-sm-4 pdlft0">
													<p class="form-rms-que form-rms-que1">How would you describe your costume?</p>
													<p> Please enter a maximum of <strong>10</strong> keywords to describe the categories in which your costume could belong to.</p>
													<p><span class="ctume_tip-spn">Tip:</span>Have a specialty costume? To increase your chances of making a sale, input the appropriate keywords with our existing 
													<a href="#" style="color: red;
text-decoration: underline;">list of categories.</a> </p>
												</div>
												<div class="col-md-8 col-sm-8">
													<p class="form-rms-input keywrds-input">
														<input type="text" id="keywords_tag">
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
											</div>
											
											<div class="form-rms costume-error make_costume">
												<div class="col-md-4 col-sm-4 pdlft0">
													<p class="form-rms-que">{{$cosplayfour->label}}</p>
												</div>
												<div class="col-md-8 col-sm-8 pdlft0 how_lng_tme">
													<p class="form-rms-input">
														<div class="col-md-12  col-sm-12">
															@foreach($cosplayfour_values as $index=>$cosplayfour_val)
															
															<div class="col-md-2  col-sm-4 pdlft10">
																<input id="{{$cosplayfour_val->optionid}}" class="radio-custom" name="{{$cosplayfour->code}}" type="{{$cosplayfour->type}}" id="{{$cosplayfour_val->optionid}}" value="{{$cosplayfour_val->optionid}}">
																<label for="{{$cosplayfour_val->optionid}}" class="radio-custom-label">{{$cosplayfour_val->value}}</label>
															</div>
															
															@endforeach
														</div>
														<div class="col-md-12  col-sm-12 how_div" id="mention_hours" style="display: none">
															<p class="  col-md-4  col-sm-6 mtop10"  >How long did it take?</p>
															<p class=" col-md-8 col-sm-8 " id="mention_hours_input" style=""><input type="text" name="make_costume_time1" id="make_costume_time1" class="input-rm100"> <span><i>hours</i><span>
															</p>
															<span id="usercostumeerror" style="color:red"></span>		 
															</div>
															        
												</div>
											</div>
														
														<div class="form-rms costume-error describe_cnt">
															<div class="col-md-4 col-sm-4 pdlft0">
																<p class="form-rms-que form-rms-que1">Describe your Costume * </p>
																<p class="form-rms-detailed">  
																	<span>Be as detailed as possible. Here are some helping questions: </span><br>
																	<span>- What is your costume made out of?
															          Describe the <br>comfort and/or durability.</span>
																	<span>- What are your costume's finest features?</span>
																	<span>- Does your costume belong to a specific time period or sequel? Which one?</span>
																	
																</p>
															</div>
															
															<div class="col-md-8 col-sm-8">
																<p class="form-rms-input">
																<textarea placeholder="This Costume is an exact replica of the..." name="description" id="description" maxlength="600" class="form-control"></textarea></p>
																<span id="descriptionerror" style="color:red"></span>
																<p class="form-rms-sm1 max_lnths">( <span id="max_length_char1"></span> 600 characters)</p>
																<span id="descriptionerror" style="color:red"></span>
															</div>									
														</div>
														<!--<div class="form-rms costume-error">
															
															<div class="col-md-4 col-sm-4">
															<p class="form-rms-que form-rms-que1">Fun Fact: A little backstory to your costume and the adventures it has experienced</p>
															</div>
															<div class="col-md-8 col-sm-8">
															<p class="form-rms-input">
															<textarea placeholder="Please be as detailed as possible!" name="funfcats" id="funfacts" maxlength="600" ></textarea>
															</p>
															<span id="facterror" style="color:red"></span>
															<p class="form-rms-sm1">( <span id="max_length_char2"></span> 600 characters)</p>
															</div>
														</div>-->
														
														<div class="form-rms costume-error freqently">
															
															<div class="col-md-4 col-sm-4 pdlft0">
																<p class="form-rms-que form-rms-que1">Frequently Asked Questions</p>
																<span>Create your own costume FAQ to avoid unnecessary inquiries from potential buyers.</span>
																<br>
																<span class="cret-tip"><i>Tip: Use easy-to read bullet points!</i></sapn>
															</div>
															
															<div class="col-md-8 col-sm-8">
																<p class="form-rms-input"><textarea placeholder="- All accessories are included..." name="faq" id="faq" maxlength="600" ></textarea></p>
																<span id="faqerror" style="color:red"></span>
																<p class="form-rms-sm1">( <span id="max_length_char3"></span> 600 characters)</p>
															</div>
															
															<div class="form-rms-btn step3-last-2">
																<a type="button" id="costume_description_back" class="btn-rm-back"><span>Back</span></a>
        
																<a type="button" id="costume_description_next" class="btn-rm-nxt nxt">Next Step</a>
															</div>
														</div>
														<!-- <div class="form-rms costume-error">
															<div class="col-md-4">
															<p class="form-rms-que">Shipping Option*</p>
															</div>
															<div class="col-md-8" id="genderRadio">										 
															<div class="col-md-4">
															<input  id="radio-11" class="radio-custom" name="shipping" type="radio" value="chagefixed">
															<label for="radio-11" class="radio-custom-label">Charge Fixed Cost</label>
															</div>
															<div class="col-md-4">
															<input id="radio-12"  class="radio-custom" name="shipping" type="radio" value="chargeactual">
															<label for="radio-12" class="radio-custom-label">Charge actual Cost</label>
															</div>
															<span id="gendererror" style="color:red"></span>
															</div>									
														</div>	 -->						
													</div>
												</div>
											</div>
											<div class="prog-form-rm" id="pricing_div">
												
												<p class="prog-txt hidden-xs  ">Please fill in the following field <span>as accurately</span> as you can.</p>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">STEP 3</h2>
														<h2 class="prog-head">Pricing & Shipping</h2>
														<p class="prog-txt hidden-md hidden-lg hidden-sm ">Please fill in the following field <span>as accurately</span> as you can.</p>
														
														
														
														<div class="form-rms pricess pric_tag_three">
															<div class="col-md-4 col-sm-4">
																<p class="form-rms-que">Price*</p>
																<span>We recommend selling your second hand costumes 50-60% of their purchased price.</span>
															</div>
															<div class="col-md-8 col-sm-8">
																<div class="form-rms-input price-divs">
																	<p class="form-rms-rel ">
																		<input type="text" class="input-rm100" name="price" id="price" ><span class="form-rms-abs"><i class="fa fa-usd" aria-hidden="true"></i></span>
																	</p>
																	<p class="cst2-textl2">Not Sure? 
																		<i class="fa fa-info-circle" aria-hidden="true"></i>
																	</p>
																</div>
																<span id="priceerror" style="color:red"></span>
															</div>
															
														</div>
														
														<div class="form-rms quantity_div">
															<div class="col-md-4 col-sm-4">
																<p class="form-rms-que">Quantity</p>
															</div>
															<div class="col-md-8 col-sm-8">
																<p class="form-rms-input qnty_div">
																	<select  name="quantity" id="quantity" class="cst2-select50 form-control">
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
																	</select>
																</p>
															</div>
														</div>
														<span id="quantityerror" style="color:red"></span>
													</div>			 
													<!--<h2 class="prog-head snd-hdng">Package Information</h2>-->
													<div class="pckge_info">
														<div class="form-rms costume-error">		
															<div class="form-rms-input">
																<div class="col-md-4 col-sm-4">
																	<p class="form-rms-que">Weight of Packaged Item *</p>
																</div>
																<div class="col-md-8 col-sm-8">										 
																	<div class="form-rms-input dimensions-two dimensions-two-pk_info">
																		<p class="form-rms-dim"><span class="form-rms-he1"><input id="pounds" name="pounds" type="text"> <span>lbs</span></span></p>
																		<span id="poundserror" style="color:red"></span>
																		<p class="form-rms-dim"><span class="form-rms-he1"><input id="ounces" name="ounces" type="text"> <span>oz </span></span></p>
																		<span id="ounceserror" style="color:red"></span>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-rms costume-error">								 
															<div class="col-md-4 col-sm-4">
																<p class="form-rms-que">Dimensions</p>
															</div>
															<div class="col-md-8 col-sm-8">
																<div class="form-rms-input dimensions-two dimensions-two-pk_info">
																	<?php $i =1; ?>
																	@foreach($dimensions as $index=>$dimensions)
																	<?php
																		$value=$dimensions->value;
																		$headingexplode=explode('-',$value);
																		$heading=$headingexplode[0];
																		$heading_value=$headingexplode[1];
																	?>
																	<p class="form-rms-dim">  <span class="form-rms-he1"><input type="text" id="<?php echo ucfirst($heading); ?>" name="<?php echo ucfirst($heading); ?>"> <span><b><?php echo $heading_value; ?> </b>@if ($i <= 2) x @endif</span></span><span class="lnth-names"> <?php echo ucfirst($heading); ?></span></p>
																		<?php $i++; ?>
																		@endforeach 
																	</div>
																	<span id="dimensionserror" style="color:red"></span>
																	</div>
																</div> 
															</div> 
														</div>
														<div class="form-rms-btn step3-last-2">
															<a type="button" id="pricing_back" class="btn-rm-back"><span>Back</span></a>
															<a type="button" id="pricing_next" class="btn-rm-nxt nxt">Next Step</a>
														</div>
        
        
													</div>
													<div class="prog-form-rm" id="preferences_div">
														<!-- <form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="costume_preferences_form" id="costume_preferences_form" method="post"> -->
														<p class="prog-txt  hidden-xs">You're almost done! Just a few more questions.</p>
														<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">step 3</h2>
														<h2 class="prog-head">Review Preferences</h2>
														
														<p class="prog-txt hidden-md hidden-lg hidden-sm ">You're almost done! Just a few more questions.</p>
														
														
														<div class="form-rms costume-error lst-stp_3">								 
															<div class="col-md-4 col-sm-4 pdlft0">
																<p class="form-rms-que">Handling Time <i class="fa fa-info-circle fa-info-rm" aria-hidden="true"></i></p>
															</div>
															<div class="col-md-8 col-sm-8">
																<p class="form-rms-input">
																	<select name="handlingtime" id="handlingtime" class="form-control">
																		<option value="">Select Handling Time</option>
																		@foreach($handlingtime as $index=>$handlingtime)
																		<option value="{{$handlingtime->optionid}}">{{$handlingtime->value}}</option>
																		@endforeach
																	</select>
																</p>
																<span id="handlingtimeerror" style="color:red"></span>
															</div>							 
														</div>							
														<div class="form-rms costume-error lst-stp_3">
															<div class="col-md-4 col-sm-4 pdlft0">
																<p class="form-rms-que">Return Policy *</p>
															</div>
															
															<div class="col-md-8 col-sm-8 retrun_plicy">
																<p class="form-rms-input ">
																	
																	@foreach($returnpolicy as $index=>$returnpolicy)
																	<div class="col-md-4  col-sm-6 pdlft10">
																		<input id="{{$returnpolicy->optionid}}" class="radio-custom" name="returnpolicy" type="radio" value="{{$returnpolicy->optionid}}">
																		<label for="{{$returnpolicy->optionid}}" class="radio-custom-label">{{$returnpolicy->value}}</label>
																	</div>
																	@endforeach
																	
																	
																</p>
																<span id="returnpolicyerror" style="color:red"></span>
															</div>
														</div>
														
														
														<div class="form-rms lst-stp donate_div">
															<div class="col-md-4 col-sm-4">
																
																<p class="form-rms-que form-rms-que1 dnt_br">Donate a Portion to Charity</p>
																<p class="ct3-rms-text">Chrysalis Charges a 3% transaction fee on sale of every costume. However, if you donate 5% or more of your sale to a charity we will waitve our transaction fee to match your contribution.</p>
																<p class="ct3-rms-text">By Choosing to donate, you agree and accept Chrysalis' <a style="border-bottom: 1px solid #ccc" href="{{ route('terms-of-use') }}" target="_blank">Terms & Conditions</a>.</p>
															</div>
															<div class="col-md-8 col-sm-8 col-xs-12 dnt-amcnts">
																<div class="form-rms-input plus_minus_div">
																	<p class="form-rms-rel111">

                                                                    <div class="col-md-3 col-xs-12">
                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-default btn-number donate_charity" disabled="disabled" data-type="minus" data-field="donate_charity">
                                                                            <span class="glyphicon glyphicon-minus"></span>
                                                                        </button>
                                                                    </span>
                                                                        <input type="text" name="donate_charity" class="form-control input-number chr_bt1" id="dnt_amt" value="0" min="1" max="100">
                                                                        <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-default btn-number donate_charity chr_bt2 " data-type="plus" data-field="donate_charity">
                                                                        <span class="glyphicon glyphicon-plus"></span>
                                                                        </button>
                                                                    </span>
                                                                    </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    
                                                                        <!--<select class="cst2-select80 form-control" id="donate_charity" name="donate_charity">
																			<option value="">Donate Amount</option>
																			<option value="none">None</option>
																			<option value="1" selected="selected">1%</option>
																			<option value="10">10%</option>
																			<option value="20">20%</option>
																			<option value="30">30%</option>
																		</select>-->
																	</p>
                                                                    <div class="col-md-5 donation_amt">
                                                                    <p class="ct3-rms-head">Donation Amount</p>
                                                                    <div id="dynamic_amount">
                                                                    <input type="hidden" name="hidden_donation_amount" id="hidden_donation_amount" value="0.00">
                                                                    </div>
                                                                        <div class="cst3-textl2" id="dynamic_percent_amount">
                                                                        <i class="fa fa-usd" aria-hidden="true">0.00</i>
                                                                    
                                                                        <span id="donate_charityerror" style="color:red"></span>
                                                                    
                                                                    </div>
                                                                    </div>
																	
																</div>								
															</div>
															<div class="lst_spt">
																<p class="ct3-rms-head dont_chts">Organization of choice</p>
																<ul class="ct3-list ">
																	@foreach($charities as $index=>$charity)
																	<li><img src="@if(isset($charity->image) && !empty($charity->image)){{URL::asset('/charities_images/')}}/{{$charity->image}} @else {{ URL::asset('/img/default.png')}} @endif" alt="{{$charity->name}}" />
																		<p>{{$charity->name}}</p>
																	<input type="radio" id="{{$charity->name}}" value="{{$charity->id}}" name="charity_name" /></li>
																	@endforeach
																</ul></div>
																<span id="charity_nameerror" style="color:red"></span>
																<!--<p class="cst2-rms-chck anter_charty pdlft15"><input type="checkbox" id="another_charity" name="another_charity"> I would like to suggest another charity organization Want to suggest a favorite charity
																organization ? <br><span class="want-orgo">we will do our best to include it in the future!</span></p>	-->						
														</div>
														
														
														<div class="col-md-12 col-xs-12 col-sm-12 charity_rigt pdlft0">
															
															<div class="form-rms" id="other_organzation_check" style="display: block;">
																<p class="ct3-rms-head chartiy_spcy col-md-3 col-sm-3 col-xs-12">Want to suggest a favorite charity
																organization? <br> <span class="want-orgo">we will do our best to include it in the future!</span></p>
																<p class=" org_nme col-md-9 col-sm-9 col-xs-12 orginze_input"><input type="text"  name="organzation_name" id="organzation_name" autocomplete="off" placeholder="Organization Name"  class="form-control"></p>
																<span id="organzation_nameerror" style="color:red"></span>
															</div>
															<div class="form-rms-btn loader-align step3-last-2">
																<img id='ajax_loader' src="{{asset('img/ajax-loader.gif')}}" style="display :none;" >
																<a type="button" id="preferences_finished" class="btn-rm-nxt">I'm Finished!</a>
																<a type="button" id="preferences_back" class="btn-rm-back"><span>Back</span></a>
															</div>
														</div>
														
													</div>
													
												</form>
											</div><!-- id='total_forms_div' -->
											<!-- <div id="success_page" style="display: none;"*/>
											<div class="col-md-12 col-sm-12">
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
												</div> -->

												<div id="success_page" style="display: none">
                        <div class="col-md-12">
                            <div class="row1">
                                <div class="success_page_final">
                                <h2>Congrats!</h2>
                                    <p>Your costume has been successfully listed!</p>
                                    <!-- Left-aligned media object -->
                                    <div class="media-bg">
                                        <img class="img-responsive" src="{{URL::asset('assets/frontend/img/tks_crt-img.png')}}">
                                        <p>Howl to your Friends what you're up to!</p>
                                    </div>
                                    
                                    <!-- Left-aligned media object -->
                                    <div class="media tnks_media">
                                        <div class="media-left">
                                            <img src="" class="media-object" style="width:150px">
                                        </div>
                                        <div class="media-body">
                                            <p>I'm selling my <a href="" id="costumename"></a> on Chrysalis.</p>
                                            <p><a href="javascript:void(0);" id="amount"></a> of the sale goes to <a href="javascript:void(0);" id="charity_center"></a> </p>
                                            <p>Check it out! </p>
                                        </div>
                                    </div>
                                    <div class="tnks_socila">
                                        <ul class="social-network social-circle">
                                            <li>
                                            	<a href="javascript:void(0);" id="facebook" class="icoRss" title="Facebook">
                                            		<img class="img-responsive" src="{{URL::asset('assets/frontend/img/fb-ic.png')}}">
                                            		<input type="hidden" name="url_fb" id="url_fb">
                                            		<input type="hidden" name="quote_fb" id="quote_fb">
                                            	</a>
                                            </li>
                                            <li>
                                            	<a href="javascript:void(0);" class="icoFacebook" title="Twitter">
                                            		<div id="twiter_url" data-network="twitter" class="st-custom-button" data-title="" data-url="">
                                            			<img class="img-responsive" src="{{URL::asset('assets/frontend/img/twi-ic.png')}}">
                                            		</div>
                                            	</a>
                                            </li>
                                            <!-- <li>
                                            	<a href="javascript:void(0);" class="icoTwitter" title="Instagram">
                                            		<img class="img-responsive" src="{{URL::asset('assets/frontend/img/insta_ic.png')}}">
                                            	</a>
                                            </li> -->
                                            <li>
                                            	<a href="javascript:void(0);" class="icoGoogle" title="Pinterest">
                                            		<div id="pin_url" data-network="pinterest" class="st-custom-button" data-url="" data-image="" data-title="">
                                            			<img class="img-responsive" src="{{URL::asset('assets/frontend/img/pint_ic.png')}}">
                                            		</div>
                                            	</a>
                                            </li>
                                            <li>
                                            	<a href="javascript:void(0);" class="icoLinkedin" title="Tumblr" id="tumblr_btn">
                                            		<img class="img-responsive" src="{{URL::asset('assets/frontend/img/tele_ic.png')}}">
                                            	</a>
                                            	<input type="hidden" name="tumblr_url" id="tumblr_url" value="">
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- <a type="button" id="" href="{{URL::to('/')}}" class="btn-rm-ret">Share!</a><br> -->
                                    <a type="button" id="" href="{{URL::to('/')}}" class="btn-rm-view-finl"> <span>Return Home<span></a>
                                        
                                    </div>
                                    </div>
                                </div>
                         </div>
												<!-- </div> -->
												<!-- </div> -->
											</div>	</div>
									</div>
								</div>
								<!-- </form> -->
								<!---Second div code ends here-->
								@stop
								{{-- page level scripts --}}
								@section('footer_scripts')
								<!--<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
								<script type="text/javascript" src="{{asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')}}"></script>
							 
								<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.js"></script>
							    <script type="text/javascript" src="{{asset('/assets/frontend/js/pages/costumecustom.js')}}"></script>

							<script type="text/javascript" src="//connect.facebook.net/en_US/all.js"></script>

								 <script>
								 $("#tumblr_btn").click(function(){
								 	window.open($("#tumblr_url").val(), 'Post to Tumblr', 'window settings');
								 });

									  function statusChangeCallback(response) {
									    //console.log('statusChangeCallback');
									    //console.log(response);
									    if (response.status === 'connected') {
									      testAPI();

									    } else if (response.status === 'not_authorized') {
									      FB.login(function(response) {
									        statusChangeCallback2(response);
									      }, {scope: 'public_profile,email'});

									    } else {
									      //alert("not connected, not logged into facebook, we don't know");
									    }
									  }

									  function statusChangeCallback2(response) {
									    //console.log('statusChangeCallback2');
									    //console.log(response);
									    if (response.status === 'connected') {
									      testAPI();

									    } else if (response.status === 'not_authorized') {
									      //console.log('still not authorized!');

									    } else {
									      //alert("not connected, not logged into facebook, we don't know");
									    }
									  }

									  function checkLoginState() {
									    FB.getLoginStatus(function(response) {
									      statusChangeCallback(response);
									    });
									  }

									  function testAPI() {
									    //console.log('Welcome!  Fetching your information.... ');
									    FB.api('/me', function(response) {
									      //console.log('Successful login for: ' + response.name);
									      
									    });
									  }

									document.getElementById('facebook').onclick = function() {
											FB.init({
										      	appId      : '1984025911869654',
										      	xfbml      : true,
										      	version    : 'v2.2'
										    });
										    checkLoginState();
										  FB.ui({
										    method: 'share',
										    display: 'popup',
										    href: $("#url_fb").val(),
										    quote: $("#quote_fb").val()
										  }, function(response){});
												  
												}
									</script>
								
								<style>
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
								</style>
								<script type="text/javascript">
									$(document).ready(function()
									{
										var selector = '.ct3-list  li';
										$(selector).on("click",function()
										{
											$(selector).removeClass('active');
    										$(this).addClass('active');
										});
									});
								</script>
<script>
 
 $(document).ready(function()
 {
 	var total_val = "0.00";
 	 
 	if($("#dnt_amt").val() === 0)
 	{ 	 
 		$('#dynamic_percent_amount').hide();
 	}
 
 
	$('.btn-number').click(function(e){
    e.preventDefault();    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
          if(type == 'minus') {
            var present = currentVal-1;
          }
        else if(type == 'plus') {
            var present = currentVal+1;
                       
        }                       
    var price = $('#price').val();                       
    var total = (price * present) / 100;  
    $('#hidden_donation_amount').val(parseFloat(total).toFixed(2));
    $('#dynamic_percent_amount').html("<i class='fa fa-usd' aria-hidden='true'></i> " + parseFloat(total).toFixed(2)); 
    if (!isNaN(currentVal)) {
        if(type == 'minus') {            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }
        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    } 
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

	//when click cancel in image crop popup

	$(document).on("click","#cancel2",function()
	{
		$(".remove_pic").css({"display":"block !important"});
	});
 });
 
</script>
		
 <style>       
    #dynamic_percent_amount
    {
        float:none !important;
        position:relative !important;
    left:10px;
        line-height:63px !important;
        
    }
  </style>
							@stop																						
=======
   <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
   <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/drop_uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
 @endsection
@section('content')
 	<section class="content create_section_page">
 	


<div class="container">
<div class="row">
<div class="col-md-12">
	
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
	<p class="prog-txt desk-pro-text">Please upload <span>the minimum required photos</span> of your costume in front, back and side view. Listings with more photos sell faster! Don't forget to include any accessories!</p>
			<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">STEP 1</h2>
		<h2 class="prog-head ">Upload Photos</h2>
		
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
				<input type="file" name="file1" accept="image/*" id="file1">
			</div>
		<span id="file1_error" style="color:red"></span>

			</div>
			<div class="col-md-3 col-sm-3 col-xs-12 rc_pic" id="back_view">
			<h4>02. Back View</h4>
			<span class="remove_pic" id="drag_n_drop_2" style="display: none;" >
				<i class="fa fa-times-circle" aria-hidden="true"></i>				
			</span>
			<div class=" up-blog">
			
			<input type="file" name="file2" accept="image/*" id="file2">
			
		</div>
		<span id="file2_error" style="color:red"></span>

			</div>
			<div class="col-md-3 col-sm-3 col-xs-12 rc_pic " id="details_view">
			<h4>03. Detail/Accessories</h4>
			<span class="remove_pic" id="drag_n_drop_3" style="display: none;">
				<i class="fa fa-times-circle" aria-hidden="true"></i>					
			</span>
			<div class=" up-blog">
			<input type="file" name="file3" accept="image/*" id="file3">
		</div>
		<span id="file3_error" style="color:red"></span>

			</div>
		
			</div>
				<div class=" up_btns_tl col-md-12 col-sm-12 col-xs-12">
				
		
			<div class="col-md-12 col-sm-12 col-xs-12 ">
			<p id="other_thumbnails">
			<div class="col-md-3 col-sm-3 col-xs-12"></div>
			</p>
			</div>
					<!-- <form> -->
				<span id="fileselector">
					<label class="btn btn-default upload_more_btn" for="upload-file-selector">
						<input id="upload-file-selector" accept="image/*" type="file" name="file4[]" multiple>
						<i class="fa_icon icon-upload-alt margin-correction"></i> <i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Upload More
					</label>
				</span>
										<div class=" up_btns_tl col-md-12 col-sm-12 col-xs-12">
				<a type="button" id="upload_next" class=" upload_sub_btn btn btn-default nxt">Next Step</a>
</div>
			<!-- </form> -->
			</div>
					</div>
				
			</div>
	 
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
<div class="col-md-6">
<!--costume name code starts here-->
<div class="form-rms">
<p class="form-rms-que">01. Name Your Costume!*</p>
<p class="form-rms-input"><input type="text" name="costume_name" id="costume_name" autocomplete="off" tab-index="1" placeholder=""></p>
<span id="costumename_error" style="color:red"></span>
<p class="form-rms-small"><span>Give Your listing a descriptive title.</span> <br/>Example: "Men's Medium Spiderman<br/>Costume in Red"</p>
</div>
<!--costume name ends starts here-->
<!--Catgeory code starts here-->
<div class="form-rms">
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
<div class="form-rms">
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
<div class="form-rms">
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
</select>
</p>
<span id="sizeerror" style="color:red"></span>
</div>
<!--size code ends here-->
<!--Get subcategory ajax code starts here-->
<div class="form-rms">
<p class="form-rms-que">05. Subcategory*</p>
<p class="form-rms-input">
<select name="subcategory" id="subcategory">
<option value="">Select Sub Category</option>
</select>
</p>
<span id="subcategoryerror" style="color:red"></span>
</div>
<!--Get subcategory regarding categories code ends here-->


<div class="form-rms">
<p class="form-rms-que">06. Condition*</p>
<p class="form-rms-input">
<span class="full-rms"><input type="radio" name="condition" value="excellent" id="excellent"> Excellent</span>
 <span class="full-rms"><input type="radio" name="condition" value="brandnew" id="brandnew"> Brand New</span> 
 <span class="full-rms"><input type="radio" name="condition" value="good" id="good"> Good</span>
  <span class="full-rms"><input type="radio" name="condition" value="likenew" id="likenew"> Like New</span>
 </p>
 <span id="costumeconditionerror" style="color:red"></span>
</div>


<div class="form-rms">
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


<div class="form-rms">
<p class="form-rms-que">08. {{$cosplayone->label}}</p>
<p class="form-rms-input">
@foreach($cosplayone_values as $index=>$cosplayone_val)
<span class="full-rms"><input type="{{$cosplayone->type}}" name="{{$cosplayone->code}}" id="{{$cosplayone_val->optionid}}" value="{{$cosplayone_val->optionid}}"> {{$cosplayone_val->value}}</span>
@endforeach
</p>
<span id="cosplayerror" style="color:red"></span>
<div class="row" id="cosplayplay_yes_div" style="display: none;">
 <div class="col-md-12" >
  <p class="slt_act_all">Select all that apply:</p>
		<div class="fity_hlf">
      <div class="radio-inline ">
     <label><input type="radio" name="cosplayplay_yes_opt" value="Anime/Manga">Anime/Manga</label>
   </div>
  <div class="radio-inline ">
     <label><input type="radio" name="cosplayplay_yes_opt" value="Sci-Fi">Sci-Fi</label>
   </div>
   </div>
      </div>
   <div class="col-md-12">
   	<div class="fity_hlf">
  <div class="radio-inline">
     <label><input type="radio" name="cosplayplay_yes_opt" value="Cosmic/Superhero">Cosmic/Superhero</label>
   </div>
  <div class="radio-inline">
     <label><input type="radio" name="cosplayplay_yes_opt" value="Video Games">Video Games</label>
   </div>
      </div>
   </div>
   <div class="col-md-12">
      	<div class="fity_hlf">
  <div class="radio-inline">
     <label><input type="radio" name="cosplayplay_yes_opt" value="Furries">Furries</label>
   </div>
  <div class="radio-inline">
     <label><input type="radio" name="cosplayplay_yes_opt" value="Other">Other</label>
   </div>
    </div>
   </div>
   <div class="col-md-12">
  <div class="radio-inline">
     <label><input type="radio" name="cosplayplay_yes_opt" value="Film & Tv">Film & Tv</label>
   </div>
   </div>
   <div class="col-md-12">
  <div class="radio-inline">
     <label><input type="radio" name="cosplayplay_yes_opt" value="Mecha">Mecha</label>
   </div>
   </div>
   <span id="cosplay_yeserror" style="color:red"></span>
</div>
</div>

<div class="form-rms">
<p class="form-rms-que">09. {{$cosplaytwo->label}}</p>
<p class="form-rms-input">
@foreach($cosplaytwo_values as $index=>$cosplaytwo_val)
<span class="full-rms"><input type="{{$cosplaytwo->type}}" name="{{$cosplaytwo->code}}" id="{{$cosplaytwo_val->optionid}}" value="{{$cosplaytwo_val->optionid}}"> {{$cosplaytwo_val->value}}</span>
@endforeach
</p>
<span id="uniquefashionerror" style="color:red"></span>
<div class="row" id="uniquefashion_yes_div" style="display: none;">
 <div class="col-md-12" >
 <p class="slt_act_all">Select all that apply:</p>
 <div class="fity_hlf">
      <div class="radio-inline">
     <label><input type="radio" name="uniquefashion_yes_opt" value="Cyberpunk">Cyberpunk</label>
   </div>
  <div class="radio-inline">
     <label><input type="radio" name="uniquefashion_yes_opt" value="Lolita">Lolita</label>
   </div>
    </div>
   <div class="fity_hlf">
  <div class="radio-inline">
     <label><input type="radio" name="uniquefashion_yes_opt" value="Dystopain">Dystopain</label>
   </div>
  <div class="radio-inline">
     <label><input type="radio" name="uniquefashion_yes_opt" value="Mori kei">Mori kei</label>
   </div>
   </div>
   <div class="fity_hlf">
  <div class="radio-inline">
     <label><input type="radio" name="uniquefashion_yes_opt" value="Goth">Goth</label>
   </div>
  <div class="radio-inline">
     <label><input type="radio" name="uniquefashion_yes_opt" value="Fari kei">Fari kei</label>
   </div>
   </div>
   <div class="fity_hlf">
  <div class="radio-inline">
     <label><input type="radio" name="uniquefashion_yes_opt" value="Steampunk">Steampunk</label>
   </div>
   <div class="radio-inline">
     <label><input type="radio" name="uniquefashion_yes_opt" value="Visual kei">Visual kei</label>
   </div>
   </div>
   <div class="fity_hlf">
  <div class="radio-inline">
     <label><input type="radio" name="uniquefashion_yes_opt" value="Streetwear">Streetwear</label>
   </div>
   <div class="radio-inline">
     <label><input type="radio" name="uniquefashion_yes_opt" value="Other">Other</label>
   </div>
   </div>
    </div>
   <span id="uniquefashion_yeserror" style="color:red"></span>
</div>
</div>

</div>

<div class="col-md-6">

<div class="form-rms">
<p class="form-rms-que">10. {{$cosplaythree->label}}</p>
<p class="form-rms-input">
@foreach($cosplaythree_values as $index=>$cosplaythree_val)
<span class="full-rms"><input type="{{$cosplaythree->type}}" name="{{$cosplaythree->code}}" id="{{$cosplaythree_val->optionid}}" value="{{$cosplaythree_val->optionid}}"> {{$cosplaythree_val->value}}</span>
@endforeach
</p>
<span id="activityerror" style="color:red"></span>
<div class="row" id="activity_yes_div" style="display: none;">
 <div class="col-md-12" >
 <p class="slt_act_all">Select all that apply:</p>
   <div class="fity_hlf">
      <div class="radio-inline">
     <label><input type="radio" name="activity_yes_opt" value="Circus">Circus</label>
   </div> 
  <div class="radio-inline">
     <label><input type="radio" name="activity_yes_opt" value="Theatre">Theatre</label>
   </div>
      </div>
   </div>
   <div class="col-md-12">
      <div class="fity_hlf">
  <div class="radio-inline">
     <label><input type="radio" name="activity_yes_opt" value="Historical Reenactments">Historical Reenactments</label>
   </div>
  <div class="radio-inline">
     <label><input type="radio" name="activity_yes_opt" value="Music Videos">Music Videos</label>
   </div>
   </div>
   </div>
   <div class="col-md-12">
  <div class="radio-inline">
     <label><input type="radio" name="activity_yes_opt" value="LARP">LARP</label>
   </div>
   </div>
   <div class="col-md-12">
  <div class="radio-inline">
     <label><input type="radio" name="activity_yes_opt" value="Masquerade">Masquerade</label>
   </div>
   </div>
   <div class="col-md-12">
  <div class="radio-inline">
     <label><input type="radio" name="activity_yes_opt" value="Medieval/Renaissance Fairs">Medieval/Renaissance Fairs</label>
   </div>
   </div>
   <span id="activity_yeserror" style="color:red"></span>
</div>
</div>

<div class="form-rms">
<p class="form-rms-que">11. {{$cosplayfour->label}}</p>
<p class="form-rms-input">
@foreach($cosplayfour_values as $index=>$cosplayfour_val)
<span class="full-rms"><input type="{{$cosplayfour->type}}" name="{{$cosplayfour->code}}" id="{{$cosplayfour_val->optionid}}" value="{{$cosplayfour_val->optionid}}"> {{$cosplayfour_val->value}}</span>
@endforeach


<p class="form-rms-small" id="mention_hours" style="display:none" >If yes, how long did it take?</p>
<p class="ct1-rms-rel" id="mention_hours_input" style="display:none"><input type="text" name="make_costume_time" class="input-rm100"> <span>hours<span>
</p>
<span id="usercostumeerror" style="color:red"></span>

</div>
<div class="form-rms">
<p class="form-rms-que">12. {{$cosplayfive->label}}*</p>
<p class="form-rms-input">
@foreach($cosplayfive_values as $index=>$cosplayfive_val)
<span class="full-rms"><input type="{{$cosplayfive->type}}" name="{{$cosplayfive->code}}" id="{{$cosplayfive_val->optionid}}" value="{{$cosplayfive_val->optionid}}"> {{$cosplayfive_val->value}}</span>
@endforeach
</p>
<span id="qualityerror" style="color:red"></span>
</div>


<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>13. Describe your Costume:</span> Including accessories*</p>
<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="description" id="description" maxlength="600" ></textarea></p>

<span id="descriptionerror" style="color:red"></span>
<p class="form-rms-sm1">( <span id="max_length_char1"></span> 600 characters)</p>
</div>

<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>14. Fun Fact:</span> A little backstory to your costume and the adventures it has experienced*</p>
<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="funfcats" id="funfacts" maxlength="600" ></textarea></p>
<span id="facterror" style="color:red"></span>
<p class="form-rms-sm1">( <span id="max_length_char2"></span> 600 characters)</p>
</div>

<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>15. FAQ </span>Create your own costume Frequently Asked Questions to avoid an overload of questions in your inbox!*</p>
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

<div class="form-rms">
<p class="form-rms-que">03. Shipping Option <i class="fa fa-info-circle" aria-hidden="true"></i></p>
<p class="form-rms-input"><select name="shipping" id="shipping">
<option value="">Select Shipping Options</option>
@foreach($shippingoptions as $index=>$shipping)
<option value="{{$shipping->optionid}}">{{ucfirst($shipping->value)}}</option>
@endforeach

</select></p>
<span id="shippingerror" style="color:red"></span>

</div>




</div>

<div class="col-md-6">
<h2 class="prog-head snd-hdng">Package Information</h2>
<div class="form-rms">
<p class="form-rms-que">01. Weight of Packaged Item</p>
<p class="form-rms-input">
<select name="packageditems" id="packageditems" >
<option value="">Select Weight Of Packaged Item</option>
@foreach($packageditems as $index=>$packageitems)
<option value="{{$packageitems->optionid}}">{{$packageitems->value}}</option>
@endforeach
</select>
</p>
<span id="packageditemserror" style="color:red"></span>

</div>

<div class="form-rms">
<p class="form-rms-que">02. Dimensions</p>
<div class="form-rms-input dimensions-two dimensions-two-pk_info">
@foreach($dimensions as $index=>$dimensions)
<?php
$value=$dimensions->value;
$headingexplode=explode('-',$value);
$heading=$headingexplode[0];
$heading_value=$headingexplode[1];
?>
<p class="form-rms-dim"><?php echo ucfirst($heading); ?> <br/> <span class="form-rms-he1"><input type="text" id="<?php echo ucfirst($heading); ?>" name="<?php echo ucfirst($heading); ?>"> <span><?php echo $heading_value; ?> x</span></span></p>
@endforeach
</div>
<span id="dimensionserror" style="color:red"></span>

</div>

<div class="form-rms">
<p class="form-rms-que">03. Type</p>
<p class="form-rms-input">
<select id="type" name="type">
<option value="">Select Type</option>
@foreach($type as $index=>$type)
<option value="{{$type->optionid}}" name="type">{{$type->value}}</option>
@endforeach
</select>
</p>
<span id="typeserror" style="color:red"></span>

</div>
<div class="form-rms" id="service_div">
<p class="form-rms-que">04. Service</p>
<p class="form-rms-input">
<select id="service" name="service">
<option value="">Select Service</option>
@foreach($service as $index=>$service)
<?php
$str = strtolower($service->value);
?>
<option value="{{$service->optionid}}" name="service">{{ucfirst($str)}}</option>


@endforeach
</select>
</p>
<span id="serviceerror" style="color:red"></span>

<p class="form-rms-small1">Estimated Shipping cost: $6.80 - $12.40 (varies by buyer's location)</p>
<p class="cst2-rms-chck"><input id="free_shipping" type="checkbox"> Offer free shipping</p>
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
<p class="form-rms-que">01. Item Location</p>
<p class="form-rms-input"><input type="text" id="item_location" onFocus="geolocate()" name="item_location">
<input type="hidden" class="field form-control" id="street_number" name="address1" disable="true"required></input>
								<input type="hidden" class="field form-control" name="address2" id="route" required></input></td>
									<input type="hidden" class="field form-control" id="locality" name="city" required>
									<input type="hidden" class="field form-control" id="administrative_area_level_1" name="state"></input>
									<input type="hidden" class="field form-control" id="postal_code" name="zipcode">
									<input type="hidden" class="field form-control" id="country" name="country" required></input></p>
<span id="item_locationerror" style="color:red"></span>
</div>

<div class="form-rms">
<p class="form-rms-que">02. Handling Time <i class="fa fa-info-circle fa-info-rm" aria-hidden="true"></i></p>
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
<p class="form-rms-que">03. Return Policy</p>
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

<p class="form-rms-que form-rms-que1 dnt_br">04. Donate a Portion to Charity</p>
<p class="ct3-rms-text">Chrysalis Charges a 3% transaction fee on sale of every costume.However, if you donate 5% or more of your sale to a charity we will waive our transcation fee to match your contribution</p>
<p class="ct3-rms-text">By Choosing to donate, I agree and accept Chrysalis' <a style="border-bottom: 1px solid #ccc">Terms & Conditions</a>.</p>
<p class="ct3-rms-head">Donation Amount</p>
<div class="form-rms-input">
<p class="form-rms-rel1"><select class="cst2-select80" id="donate_charity" name="donate_charity"><option value="">Donate Amount</option><option value="none">None</option><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option></select></p>
<p class="cst3-textl2" id="dynamic_percent_amount"><i class="fa fa-usd" aria-hidden="true"></i>0.00</p>
<span id="donate_charityerror" style="color:red"></span>
</div>
<p class="ct3-rms-head">Donate to</p>
<ul class="ct3-list">
@foreach($charities as $index=>$charity)
<li><img src="@if(isset($charity->image) && !empty($charity->image)){{URL::asset('/charities_images/')}}/{{$charity->image}} @else {{ URL::asset('/img/default.png')}} @endif" alt="{{$charity->name}}" />
<p>{{$charity->name}}</p><input type="radio" id="{{$charity->name}}" value="{{$charity->id}}" name="charity_name" /></li>
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
<a type="button" id="" class="btn-rm-ret">Return Home</a><br>
<a type="button" id="" class="btn-rm-view-finl"> <span>View My Listing!<span></a>
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

	 <script type="text/javascript">
$('#categoryname').on('change',function(){
	
    var id=$(this).val();//catgeory id
	 $.get("{{ url('/costume/ajaxsubcategory')}}", //This is the url defined in routes 
         { categoryid: id  },  
		 function(data) {
			console.log(data);
			var model = $('#subcategory').html('Select Subcategory');    //keeping subcategory field empty before
					model.empty();
					model.append("<option value=''>Select Subcategory</option>");
					$.each(data, function(index, element) {
						model.append("<option value='"+ element.subcategoryid +"'>" + element.subcategoryname + "</option>");
			        });
        });
    
});
$(document).ready(function()
{


/*var inputLocalFont = document.getElementById("upload-file-selector");
inputLocalFont.addEventListener("change",previewImages,false);

function previewImages(){
    var fileList = this.files;

    var anyWindow = window.URL || window.webkitURL;

        for(var i = 0; i < fileList.length; i++){
          $('#remove_more').append('<span class="remove_pic" id="upload_remove_'+i+'"><i class="fa fa-times-circle" aria-hidden="true"></i></span>');
          var objectUrl = anyWindow.createObjectURL(fileList[i]);
          $('#other_thumbnails').append('<img id="img_more_'+i+'" src="' + objectUrl + '" width="60px" height="60px" />');
          window.URL.revokeObjectURL(fileList[i]);
        }       
}
	$("#upload_remove_0").click(function(){
		alert($(this));
	});*/


	if (window.File && window.FileList && window.FileReader) {
    $("#upload-file-selector").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $('#other_thumbnails').append("<span class=\"pip col-md-3\">" +
            "<img  class=\"imageThumb img-responsive\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\"></span>" +
            "</span>");
          /*$("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#upload-file-selector");*/
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }


  	$('#donate_charity').change(function(){
		if ($(this).val() == "none") {
			$('input[name=charity_name]').prop('checked', false);
		}
	});

  	$('#another_charity').change(function(){
  		if ($(this).prop("checked") == true) {
  			$('input[name=charity_name]').prop('checked', false);
  		}
  	});

	$('input[name=file1]').change(function(){
		$('#drag_n_drop_1').css('display','block');
	});
  $('input[name=file1]').change(function(){
    $('#drag_n_drop_1').css('display','block');
  });
	$('#drag_n_drop_1').click(function(){
		$('#front_view').find('li').remove();
		$('#drag_n_drop_1').css('display','none');
		$('input[name=file1]').val('');
	});

	$('#shipping').change(function(){
		if($(this).val() == 16){
      $('#service_div').css('display','none');
    }else{
      $('#service_div').css('display','block');
    }
	});
  $('#free_shipping').click(function(){
    $('#service_div').css('display','none');
    $('#shipping').val('16');
  });
	$('#drag_n_drop_2').click(function(){
		$('#back_view').find('li').remove();
		$('#drag_n_drop_2').css('display','none');
		$('input[name=file2]').val('');
	});

	$('input[name=file3]').change(function(){
		$('#drag_n_drop_3').css('display','block');
	});
	$('#drag_n_drop_3').click(function(){
		$('#details_view').find('li').remove();
		$('#drag_n_drop_3').css('display','none');
		$('input[name=file3]').val('');
	});
//donate amount percentage calculation
$('#donate_charity').change(function(){
	var donate_percent = $(this).val();
	var price = $('#price').val();
	var total = (price*donate_percent)/100;
	if (donate_percent=="none") {
		var total = 0.00;
	}
	$('#dynamic_percent_amount').html("<i class='fa fa-usd' aria-hidden='true'></i> " +parseFloat(total).toFixed(2));
});
	//numeric condition
	$("#height-ft,#height-in,#weight-lbs,#chest-in,#waist-lbs,#Length,#Width,#Height").on("keyup", function(){
        var valid = /^\d{0,4}(\.\d{0,4})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });

	$("#price,#charity_amount").on("keyup", function(){
        var valid = /^\d{0,20}(\.\d{0,20})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
	$('#description').on('keyup',function(){
	      var input = $(this);
	      $('#max_length_char1').text(input.val().length + " of");
	});
	$('#funfacts').on('keyup',function(){
	      var input = $(this);
	      $('#max_length_char2').text(input.val().length + " of");
	});
	$('#faq').on('keyup',function(){
	      var input = $(this);
	      $('#max_length_char3').text(input.val().length + " of");
	});
	$('#upload_div').css('display','block');
	$('#costume_description').css('display','none');
	$('#pricing_div').css('display','none');
	$('#preferences_div').css('display','none');
	$( "#7" ).click(function() {
		$('#cosplayplay_yes_div').css('display','block');
	});
	$( "#8" ).click(function() {
		$('#cosplayplay_yes_div').css('display','none');
	});
	$('#9').click(function(){
		$('#uniquefashion_yes_div').css('display','block');
	});
	$('#10').click(function(){
		$('#uniquefashion_yes_div').css('display','none');
	});
	$('#11').click(function(){
		$('#activity_yes_div').css('display','block');
	});
	$('#12').click(function(){
		$('#activity_yes_div').css('display','none');
	});
	$('#30').click(function(){
		$('#mention_hours').css('display','block');
		$('#mention_hours_input').css('display','block');
	});
	$('#31').click(function(){
		$('#mention_hours').css('display','none');
		$('#mention_hours_input').css('display','none');
		$('#mention_hours_input').val('');
	});

	$('#another_charity').click(function(){
	    if($(this).prop("checked") == true){
	        $('#other_organzation_check').css('display','block');
	    }
	    else if($(this).prop("checked") == false){
	        $('#other_organzation_check').css('display','none');
	    }
	});

	
	$( "#upload_next" ).click(function(a) {

		a.preventDefault();
		str=true;
		$('input[name=file1],input[name=file2],input[name=file3]').css('border','');
		$('#file1_error,#file2_error,#file3_error').html('');
		var file1=$('input[name=file1]').val();
		var file2=$('input[name=file2]').val();
		var file3=$('input[name=file3]').val();

		if(file1==''){
			$('input[name=file1]').css('border','1px solid red');
			$('#file1_error').html('Upload Front View');
			str=false;
		}
		if(file2==''){
			$('input[name=file2]').css('border','1px solid red');
			$('#file2_error').html('Upload Back View');
			str=false;
		}
		if(file3==''){
			$('input[name=file3]').css('border','1px solid red');
			$('#file3_error').html('Upload Detail/Accessories');
			str=false;
		}
		if (str == true) {
			$('#step2').addClass('active');
	  		$('#upload_div').css('display','none');
			$('#costume_description').css('display','block');
			$('#pricing_div').css('display','none');
			$('#preferences_div').css('display','none');
			 	
		}
		return str;
		
	});

	$('#costume_description_next').click(function(a){
		a.preventDefault();
		str=true;
		$('#costume_name,#categoryname,#gender,#size,#description,#funfcats,#faq,#height-ft,#height-in,#weight-lbs,#chest-in,#waist-lbs,#funfacts').css('border','');
		$('#costumename_error,#categoryerror,#gendererror,#sizeerror,#uniquefashionerror,#cosplayerror,#costumeconditionerror,#descriptionerror,#facterror,#faqerror,#activityerror,#bodydimensionerror,#qualityerror,#usercostumeerror').html('');
		var costumename=$('#costume_name').val();
		var category=$('#categoryname').val();
		var gender=$('#gender').val();
		var size=$('#size').val();
		var subcategory = $('#subcategory').val();
		var description=$('#description').val();
		var funfact=$('#funfacts').val();
		var faq=$('#faq').val();
		var heightft=$('#height-ft').val();
		var heightin=$('#height-in').val();
		var weightlbs=$('#weight-lbs').val();
		var chestin=$('#chest-in').val();
		var waistlbs=$('#waist-lbs').val();
		var costumecondition="";
		var qualitycostume="";
		var usercostume="";
		var activity="";
		var cosplay="";
		var uniquefashion="";
		
		if(costumename==''){
			$('#costume_name').css('border','1px solid red');
			$('#costumename_error').html('This field is required.');
			str=false;
		}
		/*if(heightft==''){
			$('#height-ft').css('border','1px solid red');
			$('#bodydimensionerror').html('Enter Body & Dimensions');
			str=false;
		}
		if(heightin==''){
			$('#height-in').css('border','1px solid red');
			$('#bodydimensionerror').html('Enter Body & Dimensions');
			str=false;
		}
		if(weightlbs==''){
			$('#weight-lbs').css('border','1px solid red');
			$('#bodydimensionerror').html('Enter Body & Dimensions');
			str=false;
		}
		if(chestin==''){
			$('#chest-in').css('border','1px solid red');
			$('#bodydimensionerror').html('Enter Body & Dimensions');
			str=false;
		}
		if(waistlbs==''){
			$('#waist-lbs').css('border','1px solid red');
			$('#bodydimensionerror').html('Enter Body & Dimensions');
			str=false;
		}*/
		if(category==''){
			$('#categoryname').css('border','1px solid red');
			$('#categoryerror').html('This field is required.');
			str=false;
		}
		if(gender==''){
			$('#gender').css('border','1px solid red');
			$('#gendererror').html('This field is required.');
			str=false;
		}
		if(size==''){
			$('#size').css('border','1px solid red');
			$('#sizeerror').html('This field is required.');
			str=false;
		}
		if(subcategory==''){
			$('#subcategory').css('border','1px solid red');
			$('#subcategoryerror').html('This field is required.');
			str=false;
		}
		if(description==""){
			$('#description').css('border','1px solid red');
			$('#descriptionerror').html('This field is required.');
			str=false;
		}
		if(funfact=='')
		{
			$('#funfacts').css('border','1px solid red');
			$('#facterror').html('This field is required.');
			str=false;
		}
		if(faq==""){
			$('#faq').css('border','1px solid red');
			$('#faqerror').html('This field is required.');
			str=false;
		}
		if($('input[name=condition]:checked').length<=0){
			$('#costumeconditionerror').html('This field is required.');
			str=false;
			
		}
		if($('input[name=fimquality]:checked').length<=0){
			$('#qualityerror').html('This field is required.');
			str=false;
			
		}
		if($('input[name=make_costume]:checked').length<=0){
			$('#usercostumeerror').html('This field is required.');
			str=false;
			
		}
		if($('input[name=activity]:checked').length<=0)
		{
			$('#activityerror').html('This field is required.');
			str=false;
			
		}
		if($('input[name=cosplay]:checked').length<=0){
			$('#cosplayerror').html('This field is required.');
			str=false;
			
		}
		if ($('input[name=cosplay]:checked').val() == 7) {
			if ($('input[name=cosplayplay_yes_opt]:checked').length<=0) {

			$('#cosplay_yeserror').html('This field is required.');
			str=false;
			}
		}
		if ($('input[name=fashion]:checked').val() == 9) {
			if ($('input[name=uniquefashion_yes_opt]:checked').length<=0) {

			$('#uniquefashion_yeserror').html('This field is required.');
			str=false;
			}
		}
		if ($('input[name=activity]:checked').val() == 11) {
			if ($('input[name=activity_yes_opt]:checked').length<=0) {

			$('#activity_yeserror').html('This field is required.');
			str=false;
			}
		}
		if ($('input[name=make_costume1]:checked').val() == 30) {

			$('#usercostumeerror').html('This field is required.');
			str=false;
			
		}
		if($('input[name=fashion]:checked').length<=0){
			$('#uniquefashionerror').html('This field is required.');
			str=false;
		}
		if (str == true) {
			/*$.ajax({
			 url: "{{URL::to('costume/costumedescription')}}",
			 type: "POST",
			 data: new FormData($('#costume_description_form')[0]),
			 contentType:false,
			 cache: false,
			 processData: false,
			 success: function(data){
			 	if (data == "success") {*/
			 		$('#step3').addClass('active');
					$('#upload_div').css('display','none');
					$('#costume_description').css('display','none');
					$('#pricing_div').css('display','block');
					$('#preferences_div').css('display','none');
			 	/*}
			 }});*/
		}
		return str;
	});
	$('#costume_description_back').click(function(){
		$('#step2').removeClass('active');
		$('#upload_div').css('display','block');
		$('#costume_description').css('display','none');
		$('#pricing_div').css('display','none');
		$('#preferences_div').css('display','none');
	});

	$('#pricing_next').click(function(a){
		/*$('#step4').addClass('active');
		$('#upload_div').css('display','none');
		$('#costume_description').css('display','none');
		$('#pricing_div').css('display','none');
		$('#preferences_div').css('display','block');*/

		a.preventDefault();
		str=true;
		$('#price,#quantity,#shipping,#packageditems,#Length,#Width,#Height,#type,#service').css('border','');
		$('#priceerror,#quantityerror,#shippingerror,#packageditemserror,#dimensionserror,#typeserror,#serviceerror').html('');
		var price = $('#price').val();
		var quantity = $('#quantity').val();
		var shipping = $('#shipping').val();
		var packageditems = $('#packageditems').val();
		var Length = $('#Length').val();
		var Width = $('#Width').val();
		var Height = $('#Height').val();
		var type = $('#type').val();
		var service = $('#service').val();
		if (price == "") {
			$('#price').css('border','1px solid red');
			$('#priceerror').html('This field is required.');
			str=false;
		}
		/*if (quantity == "") {
			$('#quantity').css('border','1px solid red');
			$('#quantityerror').html('Select Quantity');
			str=false;
		}*/
		if (shipping == "") {
			$('#shipping').css('border','1px solid red');
			$('#shippingerror').html('This field is required.');
			str=false;
		}
		if (packageditems == "") {
			$('#packageditems').css('border','1px solid red');
			$('#packageditemserror').html('This field is required.');
			str=false;
		}
		if (Length == "" && Height == "" && Width == "") {
			$('#Length').css('border','1px solid red');
			$('#Height').css('border','1px solid red');
			$('#Width').css('border','1px solid red');
			$('#dimensionserror').html('This field is required.');
			str=false;
		}
		if (type == "") {
			$('#type').css('border','1px solid red');
			$('#typeserror').html('This field is required.');
			str=false;
		}
    if ($('#shipping').val() == 78) {

    if (service == "") {
      $('#service').css('border','1px solid red');
      $('#serviceerror').html('This field is required.');
      str=false;
    }
    }
		if (str == true) {
			/*$.ajax({
			 url: "{{URL::to('costume/costumepricing')}}",
			 type: "POST",
			 data: new FormData($('#costume_pricing_form')[0]),
			 contentType:false,
			 cache: false,
			 processData: false,
			 success: function(data){
			 	if (data == "success") {*/
			 		$('#step4').addClass('active');
					$('#upload_div').css('display','none');
					$('#costume_description').css('display','none');
					$('#pricing_div').css('display','none');
					$('#preferences_div').css('display','block');
			 	/*}
			 }});*/
		}
		return str;
	});

	$('#pricing_back').click(function(){
		$('#step3').removeClass('active');
  		$('#upload_div').css('display','none');
		$('#costume_description').css('display','block');
		$('#pricing_div').css('display','none');
		$('#preferences_div').css('display','none');
	});

	$('#preferences_back').click(function(){
		$('#step4').removeClass('active');
		$('#upload_div').css('display','none');
		$('#costume_description').css('display','none');
		$('#pricing_div').css('display','none');
		$('#preferences_div').css('display','none');
	});
	
	$('#preferences_finished').click(function(a){
		a.preventDefault();
		str=true;

		$('#item_location,#handlingtime,#returnpolicy,#donate_charity,#charity_name,#organzation_name').css('border','');
		$('#item_locationerror,#handlingtimeerror,#returnpolicyerror,#donate_charityerror,#charity_nameerror,#organzation_nameerror').html('');
		var item_location = $('#item_location').val();
		var handlingtime  = $('#handlingtime').val();
		var returnpolicy  = $('#returnpolicy').val();
		var donate_charity = $('#donate_charity').val();
		var atLeastOneIsChecked = $('input[name="another_charity"]:checked').length > 0;
		var organzation_name = $('#organzation_name').val();
		if (item_location == "") {
			$('#item_location').css('border','1px solid red');
			$('#item_locationerror').html('This field is required.');
			str=false;
		}
		if (handlingtime == "") {
			$('#handlingtime').css('border','1px solid red');
			$('#handlingtimeerror').html('This field is required.');
			str=false;
		}
		if (returnpolicy == "") {
			$('#returnpolicy').css('border','1px solid red');
			$('#returnpolicyerror').html('This field is required.');
			str=false;
		}
		if (donate_charity == "") {
			$('#donate_charity').css('border','1px solid red');
			$('#donate_charityerror').html('Select Donate Amount');
			str=false;
		}
		/*if($('input[name=charity_name]:checked').length<=0){
			$('#charity_name').css('border','1px solid red');
			$('#charity_nameerror').html('Select Donate to');
			str=false;
			
		}*/
		if (atLeastOneIsChecked == true) {
			$('#organzation_name').css('border','1px solid red');
			$('#organzation_nameerror').html('This field is required.');
			str=false;
			if (organzation_name != '') {
				$('#organzation_name').css('border','');
			$('#organzation_nameerror').html('');
				str = true;
			}
		}
		if (str == true) {
			$('#preferences_finished').html("Submitting");
			$('.loader-align').append('<img id="ajax_loader" src="{{asset("img/ajax-loader.gif")}}" >');
			$.ajax({
			 url: "{{URL::to('costume/costumecreate')}}",
			 type: "POST",
			 data: new FormData($('#costume_total_form')[0]),
			 contentType:false,
			 cache: false,
			 processData: false,
			 success: function(data){
			 	if (data == "success") {
			 		$('#ajax_loader').remove();
			 		$('#success_page').css('display','block');
			 		$('#upload_div').css('display','none');
					$('#costume_description').css('display','none');
					$('#pricing_div').css('display','none');
					$('#preferences_div').css('display','none');
			 	}
			 }});
		}
		return str;
	});
	   $('#file1,#file2,#file3').drop_uploader({
                uploader_text: 'Drop files to upload, or',
                browse_text: 'Browse',
                browse_css_class: 'button button-primary',
                browse_css_selector: 'file_browse',
                uploader_icon: '<i class="pe-7s-cloud-upload"></i>',
                file_icon: '<i class="pe-7s-file"></i>',
                time_show_errors: 5,
                layout: 'thumbnails',
                method: 'normal',
                url: 'ajax_upload.php',
                delete_url: 'ajax_delete.php',
            });
        });
</script> 
<script> 
var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name', 
      };
      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('item_location')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
	
$(document).on('click','.nxt',function() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});
    </script> 
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD7L6zG6Z8ws4mRa1l2eAhVPDViUX6id0&libraries=places&callback=initAutocomplete"
        async defer></script>
@stop
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

@extends('/frontend/app')
@section('styles')

<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/drop_uploader.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/media-query.css')}}">
<link  href="{{asset('assets/frontend/css/cropper.css')}}" rel="stylesheet">
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
	.media.tnks_media .media-left {
    max-height: 215px;
    overflow: hidden;
    float: left;
}
i.fa.fa-percent {
    position: absolute;
    z-index: 99;
    right: 68px;
    top: 14px;
    font-size: 13px;
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
	 #charity_nameerror
    {
    	display: block;	
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
   margin-bottom: 38px;
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
	.media.tnks_media .media-left img {
   border: 1px solid #e2e2e2 ;
}
    
    .media.tnks_media {
   width: 550px;
   margin: 0 auto;
   text-align: left;
   border: 4px solid #60c3ab;
    padding: 18px 40px;
   border-radius: 18px;
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
    position:relative;    margin-right: 7px;
    margin:0 auto 0 auto;
    -moz-border-radius:50%;
    -webkit-border-radius:50%;
    border-radius:50%;
    text-align:center;
    width: 58px;
    height: 58px;
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
   padding-left: 0px;    margin-bottom: 50px;
    }
    .media.tnks_media .media-body p {
   margin-bottom: 30px;
    }
    .success_page_final h2{font-family: Proxima-Nova-Extrabold;margin-top: 80px;}
    
    @media screen and (max-width:767px){
    .media.tnks_media {
   width: auto;}
        .media.tnks_media .media-body p {
   margin-bottom: 10px;
}
    }
    .pdlftlikenew {
	    padding: 0px;
	}

</style>
@endsection
@section('content')
<section class="content create_section_page">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 costume_create_st1">
				<!--- progressbar section starts -->
				<div class="progressbar_main " id="progressbar_maintitle"  >
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
							<p class="prog-txt desk-pro-text">Please upload a minimum of 3 photos of your costume and any accessories. Listings with more photos sell faster!	</p>
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
									<h4>01. Front</h4>
									<span class="remove_pic" id="drag_n_drop_1" style="display: none;" >
										<i class="fa fa-times-circle" aria-hidden="true"></i>				
									</span>
									<div class="up-blog">
										<input type="file" name="file1" accept="image/*" id="file1" >
										<input type="hidden" class="modalOpen1" name="Imagecrop1">
										<!-- <img src="" class="result" > -->
										<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
									</div>
									<span id="file1_error" style="color:red"></span>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12 rc_pic" id="back_view">
									<h4>02. Back</h4>
									<span class="remove_pic" id="drag_n_drop_2" style="display: none;" >
										<i class="fa fa-times-circle" aria-hidden="true"></i>				
									</span>
									<div class="up-blog">
										<input type="file" name="file2" accept="image/*" id="file2" >
										<input type="hidden" class="modalOpen2" name="Imagecrop2">
										<!-- <img src="" class="result2" > -->
										<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
									</div>
									<span id="file2_error" style="color:red"></span>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12 rc_pic " id="details_view">
									<h4>03. Detail</h4>
									<span class="remove_pic" id="drag_n_drop_3" style="display: none;">
										<i class="fa fa-times-circle" aria-hidden="true"></i>					
									</span>
									<div class="up-blog">
										<input type="file" name="file3" accept="image/*" id="file3" >
										<input type="hidden" class="modalOpen3" name="Imagecrop3" >
										<!-- <img src="" class="result3" > -->
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
									<h4 class="modal-title">Front</h4>
								</div>
								<div class="modal-body">
									<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
									<div class="carousel-inner" id="dvPreview">
									</div>
									<div class="img-pp">
										<div class="img-pp-iner">
											<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
											<input type="range" id="zoom-level" min="0" value="2" step="any" max="4">
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
									<h4 class="modal-title">Back</h4>
								</div>
								<div class="modal-body">
									<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
									<div class="carousel-inner" id="dvPreview2">
									</div>
									<div class="img-pp">
										<div class="img-pp-iner">
											<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
											<input type="range" id="zoom-level2" min="0" max="4" value="2" step="any" >
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
									<h4 class="modal-title">Detail</h4>
								</div>
								<div class="modal-body">
									<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
									<div class="carousel-inner" id="dvPreview3">
									</div>
									<div class="img-pp">
										<div class="img-pp-iner">
											<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
											<input type="range" id="zoom-level3" min="0" max="4" value="2" step="any" >
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
										<input type="range" min="0"  max="4" value="2" step="any" class="slider">
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
							<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">Step 2</h2>
							<h2 class="prog-head">Costume Description</h2>
							<p class="prog-txt mobile-pro-text">Please fill in the following fields  <span>as accurately as possible</span> to prevent disputes.</p>
							
							<div class="prog-form-rm">
								<div class="col-md-12 col-sm-12 cret_ctme_1">
									<!--costume name code starts here-->
									<div class="form-rms">
										<div class="col-md-4 col-sm-4 pdlft0">
											<p class="form-rms-que">Name your Costume, Be Specific!*</p>									
											</div>	
										<div class="col-md-8 col-sm-8">
											<p class="form-rms-input">
												<input type="text" name="costume_name" class="form-control" id="costume_name" autocomplete="off" tab-index="1" placeholder="Example : Dark Knight Joker Cosplay">
												<span id="costumename_error" style="color:red"></span>
											</p>										
										</div>
									</div>
									<!--costume name ends starts here-->
									<!--Catgeory code starts here-->
									<div class="form-rms">
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

									<!--Get subcategory ajax code starts here-->
									<div class="form-rms ">
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

									<!--Gender Code starts here-->
									<div class="form-rms ">
										<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
											<p class="form-rms-que">Gender*</p>
										</div>								
										<div class="col-md-8 col-sm-8" id="genderRadio">	
											<div class="form-rms-input">									 
												<div class="col-md-2 col-sm-4 ">
													<input  id="radio-1" class="radio-custom" name="gender" type="radio" value="male">
													<label for="radio-1" class="radio-custom-label">Mens</label>
												</div>
												<div class="col-md-2 col-sm-4">
													<input id="radio-2"  class="radio-custom" name="gender" type="radio" value="female">
													<label for="radio-2" class="radio-custom-label">Womens</label>
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
									<div class="form-rms ">
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
													<option value="custom">Custom</option>
												</select>
											</p>
											<span id="sizeerror" style="color:red"></span>
										</div>								
										
									</div>
									<!--size code ends here-->


									<!-- body dimension code stars here-->
									
									<div class="form-rms costume-error body-dimnets hide ">
									<div class="col-md-4 col-sm-4 pdlft0">
										<p class="form-rms-que">Body &amp; Dimensions *</p>
										</div>
											<div class="col-md-8 col-sm-8">
										<div class="form-rms-input">
											<p class="form-rms-dim form-rms-he">Height <br> 
												<span class="form-rms-he1">
													<input required type="body-dimensions" name="height-ft" id="height-ft"> 
													<span>ft</span>
													<input type="body-dimensions" class="form-rms-dt" required name="height-in" id="height-in"> 
													<span>in</span>
													<span id="heighterror" style="color:red"></span>
												</span>

											</p>
											
											<p class="form-rms-dim weight-chest">Weight <br> 
												<span class="form-rms-he1">
													<input required type="text" name="weight-lbs" id="weight-lbs"> 
													<span>lbs</span>
													<span id="weighterror" style="color:red"></span>
												</span>
												
											</p>
											
											<p class="form-rms-dim weight-chest">Chest <br> 
												<span class="form-rms-he1">
													<input required type="text" name="chest-in" id="chest-in"> 
													<span>in </span>
													<span id="chesterror" style="color:red"></span>
												</span>
												
											</p>
											
											<p class="form-rms-dim weight-chest">Waist <br> 
												<span class="form-rms-he1">
													<input required type="text" name="waist-lbs" id="waist-lbs"> 
													<span>in</span>
													<span id="waisterror" style="color:red"></span>
												</span>
												
											</p>

											<span id="bodydimensionerror" style="color:red"></span>
										</div>
									</div>
									</div>
									<!-- ends here -->		


									
									<!--Get subcategory regarding categories code ends here-->
									<div class="form-rms costume-error condition_div scrool_top">
										<div class="col-md-4 col-sm-4 pdlft0">
											<p class="form-rms-que">Condition*</p>
										</div>
										<div class="col-md-8 col-sm-8">
											<div class="col-md-12 col-sm-12 col-xs-12 pdlft0" >
												<div class="col-md-2 col-sm-4 pdlft0">
													<input id="radio-6" class="radio-custom conditon_check" name="condition" type="radio" value="good">
													<label for="radio-6" class="radio-custom-label">Good</label>
												</div>
												<div class="col-md-3 col-sm-4 pdlft5">
													<input id="radio-7" class="radio-custom conditon_check" name="condition" type="radio" value="like_new">
													<label for="radio-7" class="radio-custom-label">Like New</label>
												</div>
												<div class="col-md-3  col-sm-4 marginm15">
													<input id="radio-8" class="radio-custom conditon_check" name="condition" type="radio" value="brand_new">
													<label for="radio-8" class="radio-custom-label">Brand New</label>
												</div>
											</div>
											<span id="costumeconditionerror" style="color:red"></span>
										</div>									
									</div>
									
									
									<div class="form-rms hide" id="cleaned_select">
										<div class="col-md-4 col-sm-4 pdlft0">
											<p class="form-rms-que">How was it cleaned? <i class="fa fa-info-circle fa-info-rm" aria-hidden="true" data-toggle="tooltip" title="Costumes must be clean and ready for the next user. If you are not able to clean your costume you can always send it to Chrysalis with one of our cleanout bags. There are few materials our state of the art facility cannot clean."></i>
											</p>
										</div>
										<div class="col-md-8 col-sm-8">
											<p class="form-rms-input">
												<select name="cleaned" id="cleaned" class="form-control">
													<option value="">Select</option>
													@foreach($handwashed as $index=>$handwashed)
													<option value="{{$handwashed->optionid}}">{{$handwashed->value}}</option>
													@endforeach
												</select>
											</p>
											<span id="cleanederror" style="color:red"></span>
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
									
									
									
									
									
									<div class="form-rms ">
										<div class="col-md-4 col-sm-4 pdlft0">
											<p class="form-rms-que">{{$cosplayfive->label}}*</p>
										</div>
										<div class="col-md-8 col-sm-8 pdlft0 theatre_quality">
											<p class="form-rms-input">
												@foreach($cosplayfive_values as $index=>$cosplayfive_val)
												<span class="full-rms">
													<div class="col-md-2  col-sm-4">
														<input id="{{$cosplayfive_val->optionid}}" class="radio-custom faq-checkbox" name="{{$cosplayfive->code}}" type="{{$cosplaythree->type}}" value="{{$cosplayfive_val->optionid}}">
														<label for="{{$cosplayfive_val->optionid}}" class="radio-custom-label">{{$cosplayfive_val->value}}</label>
													</div>
												</span>
												@endforeach
											</p>
											<div class="pdlft101">
											<p class="form-rms-small" id="film_text" style="display:none" >Is  your costume film quality? Was it used in a production?</p>
											<p class="ct1-rms-rel form-rms-input" id="film_text_input" style="display:none">
												<input type="text" name="film_name" id="film_name" placeholder="Optional"> <span><span>
												</p>
												</div>
												<span id="qualityerror" style="color:red"></span>
												</div>
											</div>


									<div class="form-rms costume-error scrool_top makeke_costume">
												<div class="col-md-4 col-sm-4 pdlft0">
													<p class="form-rms-que">{{$cosplayfour->label}} </p>
												</div>
												<div class="col-md-8 col-sm-8 pdlft0 how_lng_tme">
													<p class="form-rms-input">
														<div class="col-md-12  col-sm-12">
															@foreach($cosplayfour_values as $index=>$cosplayfour_val)
															
															<div class="col-md-2  col-sm-4 pdlft10">
																<input id="{{$cosplayfour_val->optionid}}" class="radio-custom faq-checkbox" name="{{$cosplayfour->code}}" type="{{$cosplayfour->type}}" id="{{$cosplayfour_val->optionid}}" value="{{$cosplayfour_val->optionid}}">
																<label for="{{$cosplayfour_val->optionid}}" class="radio-custom-label">{{$cosplayfour_val->value}}</label>
															</div>
															
															@endforeach
														</div>
														<div class="col-md-12  col-sm-12 how_div" id="mention_hours" style="display: none">
															<p class="  col-md-4  col-sm-6 mtop10"  >How long did it take? *</p>
															<p class=" col-md-8 col-sm-8 " id="mention_hours_input" style=""><input type="text" name="make_costume_time1" id="make_costume_time1" class="input-rm100"> <span><i>hours</i><span>				
															</p>	 
															</div>
															<span id="usercostumeerror" style="color:red"></span>        
												</div>
											</div>
											
											<div class="form-rms descibr_smte_text " >
												<div class="col-md-4 col-sm-4 pdlft0">
													<p class="form-rms-que form-rms-que1">Keywords</p>
													<p> Please enter a maximum of <strong>10</strong> keywords to describe the categories in which your costume could belong to.</p>
													<p><span class="ctume_tip-spn">Tip:</span>What makes your costume unique? Describe it with keywords to help buyers find it. </p>
												</div>
												<div class="col-md-8 col-sm-8">
													<p class="form-rms-input keywrds-input">
														<input type="text" id="keywords_tag" onKeydown="memSort(event);">
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
											
											
														
														<div class="form-rms costume-error describe_cnt scrool_top">
															<div class="col-md-4 col-sm-4 pdlft0">
																<p class="form-rms-que form-rms-que1">Describe your Costume * </p>
															  
																<p>Tell us your costume’s story! How was it made? Is there anything in the photo that is not included? A prop for example? Anything a buyer should know? </p>
															</div>
															
															<div class="col-md-8 col-sm-8">
																<p class="form-rms-input">
																<textarea placeholder="My costume was commissioned for the production…" name="description" id="description" maxlength="600" class="form-control"></textarea></p>
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
														
														<div class="form-rms freqently hide" id="freqently">
															
															<div class="col-md-4 col-sm-4 pdlft0">
																<p class="form-rms-que form-rms-que1">Frequently Asked Questions</p>
																<span>Create your own costume FAQ to avoid unnecessary inquiries from potential buyers.</span>
																 
															</div>
															
															<div class="col-md-8 col-sm-8">
																<p class="form-rms-input"><textarea placeholder="- All accessories are included..." name="faq" id="faq" maxlength="600" ></textarea></p>
																<span id="faqerror" style="color:red"></span>
																<p class="form-rms-sm1">( <span id="max_length_char3"></span> 600 characters)</p>
															</div>
															
															
														</div>

														<div class="form-rms-btn step3-last-2">
																<a type="button" id="costume_description_back" class="btn-rm-back"><span>Back</span></a>
        
																<a type="button" id="costume_description_next" class="btn-rm-nxt nxt">Next Step</a>
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
												
												<p class="prog-txt hidden-xs  ">Please fill in the following fields <span>as accurately</span> as you can.</p>
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">STEP 3</h2>
														<h2 class="prog-head">Pricing & Shipping</h2>
														<p class="prog-txt hidden-md hidden-lg hidden-sm ">Please fill in the following fields <span>as accurately</span> as you can.</p>
														
														
														
														<div class="form-rms pricess pric_tag_three">
															<div class="col-md-4 col-sm-4">
																<p class="form-rms-que">Price*</p>
																<!--<span>We recommend selling your second hand costumes for 50-60% of their purchase price.</span>-->
															</div>
															<div class="col-md-8 col-sm-8">
																<div class="form-rms-input price-divs">
																	<p class="form-rms-rel ">
																		<input type="text" class="input-rm100" name="price" id="price" ><span class="form-rms-abs"><i class="fa fa-usd" aria-hidden="true"></i></span>
																	</p>
																	<p class="cst2-textl2">Not Sure? 
																		<i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="If your costume has been worn before, we recommend selling it for 50-60% of its purchase price. If you made the costume yourself, we suggest considering the time you'd spent and cost of materials."></i>
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
														<div class="form-rms">		
															<div class="form-rms-input">
																<div class="col-md-4 col-sm-4">
																	<p class="form-rms-que">Weight of Packaged Item *</p>
																</div>
																<div class="col-md-8 col-sm-8">										 
																	<div class="form-rms-input dimensions-two dimensions-two-pk_info">
																		<p class="form-rms-dim"><span class="form-rms-he1"><input id="pounds"  name="pounds" type="text" placeholder="0"> <span>lbs</span></span></p>
																		<span id="poundserror" style="color:red"></span>
																		<!-- <p class="form-rms-dim"><span class="form-rms-he1"><input id="ounces"  name="ounces" type="text" placeholder="0"> <span>oz </span></span></p>
																		<span id="ounceserror" style="color:red"></span> -->
																	</div>
																</div>
															</div>
														</div>
														<div class="form-rms">								 
															<div class="col-md-4 col-sm-4">
																<p class="form-rms-que">Dimensions: (Optional)</p>
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
														<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">step 4</h2>
														<h2 class="prog-head">Review Preferences</h2>
														
														<p class="prog-txt hidden-md hidden-lg hidden-sm ">You're almost done! Just a few more questions.</p>
														
														
														<div class="form-rms lst-stp_3">								 
															<div class="col-md-4 col-sm-4 ">
																<p class="form-rms-que">Handling Time <i class="fa fa-info-circle fa-info-rm"  aria-hidden="true" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Once you receive a notification that your costume has sold, how long do you need to bring your package to a shipping facility? "></i></p>
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
														<div class="form-rms lst-stp_3">
															<div class="col-md-4 col-sm-4 ">
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
																<p class="ct3-rms-text">Chrysalis charges a 3.5% + 20 cent transaction fee on every sale. However, if you donate 10% or more of your sale to one of our charities, we will waive our transaction fee to match your contribution.</p>
																<p class="ct3-rms-text">By choosing to donate, you agree and accept Chrysalis' <a style="border-bottom: 1px solid #ccc" href="{{ route('terms-of-use') }}" target="_blank">Terms & Conditions</a>.</p>
															</div>
															<div class="col-md-8 col-sm-8 col-xs-12 dnt-amcnts">
																<div class="form-rms-input plus_minus_div">
																	<p class="form-rms-rel111">

                                                                    <div class="col-md-3 col-xs-12 pdlft0">
                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-default btn-number donate_charity"  data-type="minus" data-field="donate_charity">
                                                                            <span class="glyphicon glyphicon-minus"></span>
                                                                        </button>
                                                                    </span>
                                                                        <input type="text" name="donate_charity" class="form-control input-number chr_bt1" id="donate_charity" value="0" min="0" max="100">
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
                                                                    <div class="col-md-5 donation_amt pdlft0">
                                                                    <p class="ct3-rms-head">Donation Amount</p>
                                                                    <div id="dynamic_amount">
                                                                    <input type="hidden" name="hidden_donation_amount" id="hidden_donation_amounts" value="0.00">
                                                                    </div>
                                                                        <div class="cst3-textl2" id="dynamic_percent_amounts">
                                                                        <i class="fa fa-usd" aria-hidden="true">0.00</i>
                                                                    
                                                                        <span id="donate_charityerror" style="color:red"></span>
                                                                    
                                                                    </div>
                                                                    </div>
																	
																</div>								
															</div>
															<div class="lst_spt">
																<p class="ct3-rms-head dont_chts">Our Partners</p>
																<ul class="ct3-list ">
																	@foreach($charities as $index=>$charity)
																	<li><img class="img-responsive" src="@if(isset($charity->image) && !empty($charity->image)){{URL::asset('/charities_images/')}}/{{$charity->image}} @else {{ URL::asset('/img/default.png')}} @endif" alt="{{$charity->name}}"  data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$charity->name}}"/>
																		<p>{{$charity->name}}</p>
																	<input type="radio" id="{{$charity->name}}" value="{{$charity->id}}" name="charity_name" /></li>
																	@endforeach
																	<span id="charity_nameerror" style="color:red"></span>
																</ul>
															

																</div>
																					
														</div>
														
														
														<div class="col-md-12 col-xs-12 col-sm-12 charity_rigt pdlft0">
															
															<div class="form-rms" id="other_organzation_check" style="display: block;">
																<p class="ct3-rms-head chartiy_spcy col-md-3 col-sm-3 col-xs-12">Want to suggest a favorite charity
																organization? <br> <span class="want-orgo">We will do our best to include it in the future!</span></p>
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
                                            <p id="amount_charity"><a href="javascript:void(0);" id="amount"></a> of the sale goes to <a href="javascript:void(0);" id="charity_center"></a> </p>
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
							 
								<script type="text/javascript" src="{{asset('/assets/frontend/js/cropper.js')}}"></script>
							     <script type="text/javascript" src="{{asset('/assets/frontend/js/pages/costumecustom.js')}}"></script>

							<script type="text/javascript" src="//connect.facebook.net/en_US/all.js"></script>




							

<script type="text/javascript">
            $(document).ready(function()
            {
                $(".conditon_check").change(function(){

                    if($("#radio-6").prop("checked") || $("#radio-7").prop("checked")){
                        $("#cleaned_select").removeClass("hide");
                    } else{
                        $("#cleaned_select").addClass("hide");
                        $("#cleaned").val('');
                    }
                });

                if(parseInt($("#donate_charity").val()) == 10){
                    $("#donate_charity").css({"color":"#5fc5ac","font-weight":"bold"});
                }


                if(parseInt($("#donate_charity").val())<10){
                    $("#donate_charity").css({"color":"#000","font-weight":"bold"});
                }

                if(parseInt($("#donate_charity").val()) ==15){
                    $("#donate_charity").css({"color":"#5fc5ac","font-weight":"bold"});
                }

                if(parseInt($("#donate_charity").val()) ==25){
                    $("#donate_charity").css({"color":"#5fc5ac","font-weight":"bold"});
                }

                if(parseInt($("#donate_charity").val()) == 50){
                    $("#donate_charity").css({"color":"#5fc5ac","font-weight":"bold"});
                }

                if(parseInt($("#donate_charity").val()) ==100){
                    $("#donate_charity").css({"color":"#5fc5ac","font-weight":"bold"});
                }


                $('#costume_name').data('holder',$('#costume_name').attr('placeholder'));

                $('#costume_name').focusin(function(){
                    $(this).attr('placeholder','');
                });
                $('#costume_name').focusout(function(){
                    $(this).attr('placeholder',$(this).data('holder'));
                });

                $('#organzation_name').data('holder',$('#organzation_name').attr('placeholder'));

                $('#organzation_name').focusin(function(){
                    $(this).attr('placeholder','');
                });
                $('#organzation_name').focusout(function(){
                    $(this).attr('placeholder',$(this).data('holder'));
                });

                $('#pounds').data('holder',$('#pounds').attr('placeholder'));

                $('#pounds').focusin(function(){
                    $(this).attr('placeholder','');
                });
                $('#pounds').focusout(function(){
                    $(this).attr('placeholder',$(this).data('holder'));
                });

                /*$('#ounces').data('holder',$('#ounces').attr('placeholder'));

                $('#ounces').focusin(function(){
                    $(this).attr('placeholder','');
                });
                $('#ounces').focusout(function(){
                    $(this).attr('placeholder',$(this).data('holder'));
                });*/

                $('textarea').data('holder',$('textarea').attr('placeholder'));

                $('textarea').focusin(function(){
                    $(this).attr('placeholder','');
                });
                $('textarea').focusout(function(){
                    $(this).attr('placeholder',$(this).data('holder'));
                });

                //size select custom
                $("#size").change(function()
                {
                    var val = $(this).val();
                    if(val == 'custom')
                    {
                        $(".body-dimnets").removeClass('hide');
                    }
                    else
                    {
                        $(".body-dimnets").addClass('hide');
                        $(".body-dimnets input").val('');
                    }
                });

                $(".faq-checkbox").change(function(){

                    if($("#30").prop("checked") || $("#32").prop("checked")){
                        $("#freqently").removeClass("hide");
                    } else{
                        $("#freqently").addClass("hide");
                    }
                });

                $('#costume_description_next').click(function () {
                    $('html, body').animate({scrollTop:0}, 'fast');
                });

                $('#pricing_next').click(function () {
                    $('html, body').animate({scrollTop:0}, 'fast');
                });
                $("#tumblr_btn").click(function(){
                    window.open($("#tumblr_url").val(), 'Post to Tumblr', 'window settings');
                });
                function statusChangeCallback(response) {

                    if (response.status === 'connected') {
                        testAPI();
                    } else if (response.status === 'not_authorized') {
                        FB.login(function(response) {
                            statusChangeCallback2(response);
                        }, {scope: 'public_profile,email'});

                    } else {

                    }
                }

                function statusChangeCallback2(response) {

                    if (response.status === 'connected') {
                        testAPI();

                    } else if (response.status === 'not_authorized') {
                    } else {

                    }
                }

                function checkLoginState() {
                    FB.getLoginStatus(function(response) {
                        statusChangeCallback(response);
                    });
                }

                function testAPI() {
                    FB.api('/me', function(response) {
                    });
                }
                document.getElementById('facebook').onclick = function() {

                	FB.api('https://graph.facebook.com/','post',  {
				        id: $("#url_fb").val(),
				        scrape: true,
				        access_token:'EAAcMdgezwNYBAB96ZBPVzNfQGk5lSlV9mVzIQ0COFpNWcSZC1QqxUsM6Jm5hKXfBRwMJ3dy9xkos9AJlBlLHyCetnX7fZAJvyVEdian6K6TmmyWBzqwHvGe5ItK9nrNuJPWjMFUH7zVZBNUI6h9btuWVUJYJ1zMZD'
				    }, function(response) {
				        console.log('rescrape!',response);

				    });

                    FB.init({
                        appId      : '1458951657516313',
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
                var selector = '.ct3-list  li';
                $(selector).on("click",function()
                {
                    $(selector).removeClass('active');
                    $(this).addClass('active');
                    var r = $(this).find('input[type=radio]');
                    $(r).prop('checked',true);
                });
                //code to should not allow characters for price field only allow numbers
                $('#price,#pounds,#Height,#Length,#Width').on('keydown', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
                //jquery for price number increment field
                var total_val = "0.00";
                $('.btn-number').click(function(e){
                    e.preventDefault();
                    fieldName = $(this).attr('data-field');
                    type      = $(this).attr('data-type');
                    var input = $("input[name='"+fieldName+"']");
                    var currentVal = parseInt(input.val());

                    if(type == 'minus') {
                        if(currentVal <= 10){
                            var present = currentVal-1;
                        }else if(currentVal == 15){
                            var present = currentVal-5;
                        }else if(currentVal == 25){
                            var present = currentVal-10;
                        }else if(currentVal == 50){
                            var present = currentVal-25;
                        }else if(currentVal == 100){
                            var present = currentVal-50;
                        }
                    }
                    else if(type == 'plus') {
                        if(currentVal < 10){
                            var present = currentVal+1;
                        }else if(currentVal == 10 ){
                            var present = currentVal+5;
                        }else if(currentVal == 15 ){
                            var present = currentVal+10;
                        }else if(currentVal == 25 ){
                            var present = currentVal+25;
                        }else if(currentVal>=50){
                            var present = currentVal+50;
                        }
                    }
                    var price = $('#price').val();
                    var total = (price * present) / 100;
                    var amount = parseFloat(total).toFixed(2);
                    $('#hidden_donation_amounts').val(amount);
                    $('#dynamic_percent_amounts').html("$"+amount);
                    if (!isNaN(currentVal)) {
                        if(type == 'minus') {
                            if(currentVal <= 10){
                                if(currentVal > input.attr('min')) {
                                    input.val((currentVal - 1)+" %").css({"color":"#000","font-weight":""}).change();
                                }
                                if(parseInt(input.val()) == input.attr('min')) {
                                    $(this).attr('disabled', true);
                                }
                            }else if(currentVal == 15 ){
                                if(currentVal > input.attr('min')) {
                                    input.val((currentVal - 5)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                                }
                                if(parseInt(input.val()) == input.attr('min')) {
                                    $(this).attr('disabled', true);
                                }
                            }else if(currentVal == 25 ){
                                if(currentVal > input.attr('min')) {
                                    input.val((currentVal - 10)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                                }
                                if(parseInt(input.val()) == input.attr('min')) {
                                    $(this).attr('disabled', true);
                                }
                            }else if(currentVal == 50 ){
                                if(currentVal > input.attr('min')) {
                                    input.val((currentVal - 25)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                                }
                                if(parseInt(input.val()) == input.attr('min')) {
                                    $(this).attr('disabled', true);
                                }
                            }else if(currentVal<=100){
                                if(currentVal <= input.attr('max')) {
                                    input.val((currentVal - 50)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                                }
                                if(parseInt(input.val()) == input.attr('max')) {
                                    $(this).attr('disabled', true);
                                }
                            }
                        } else if(type == 'plus') {

                            if(currentVal < 10){
                                if(currentVal < input.attr('max')) {
                                	if(currentVal == 9){
                       					input.val((currentVal + 1)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                       				}else{
                       					input.val((currentVal + 1)+" %").css({"color":"#000","font-weight":""}).change();
                       				}
                                    //input.val((currentVal + 1)+" %").css({"color":"#000","font-weight":""}).change();
                                }
                                if(parseInt(input.val()) == input.attr('max')) {
                                    $(this).attr('disabled', true);
                                }
                            }else if(currentVal == 10 ){
                                if(currentVal < input.attr('max')) {
                                    input.val((currentVal + 5)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                                }
                                if(parseInt(input.val()) == input.attr('max')) {
                                    $(this).attr('disabled', true);
                                }
                            }else if(currentVal == 15 ){
                                if(currentVal < input.attr('max')) {
                                    input.val((currentVal + 10)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                                }
                                if(parseInt(input.val()) == input.attr('max')) {
                                    $(this).attr('disabled', true);
                                }
                            }else if(currentVal == 25 ){
                                if(currentVal < input.attr('max')) {
                                    input.val((currentVal + 25)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                                }
                                if(parseInt(input.val()) == input.attr('max')) {
                                    $(this).attr('disabled', true);
                                }
                            }else if(currentVal>=50){
                                if(currentVal < input.attr('max')) {
                                    input.val((currentVal + 50)+" %").css({"color":"#5fc5ac","font-weight":"bold"}).change();
                                }
                                if(parseInt(input.val()) == input.attr('max')) {
                                    $(this).attr('disabled', true);
                                }
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
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                            (e.keyCode == 65 && e.ctrlKey === true) ||
                            (e.keyCode >= 35 && e.keyCode <= 39)) {
                        return;
                    }
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
                $(document).on("click","#cancel2",function()
                {
                    $(".remove_pic").css({"display":"block !important"});
                });
            });
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
 
 
  
 <style>       

	
	#dynamic_percent_amounts {
    margin-top: 17px;
    margin-left: 16px !important;
    background-color: white;
    display: inline-block;
}
  </style>
							@stop																						

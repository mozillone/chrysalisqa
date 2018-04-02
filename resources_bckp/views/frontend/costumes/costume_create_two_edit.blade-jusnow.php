@extends('/frontend/app')
@section('styles')
<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/drop_uploader.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
<link  href="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.css" rel="stylesheet">
<style>
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
    /* end */
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
	.up_btns_tl a
	{
	border:none !important;
	}
	.drop_uploader.drop_zone {
	position: absolute;
	top: 0;
	}
</style>
@endsection
@section('content')
<section class="content create_section_page">
	<div class="container create_edit">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
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
				<?php //echo $costume_details->donation_amount;die; ?>
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
						<input type="hidden" name="costume_id" value="{{$costume_id}}">
						<div class="upload-photo-blogs" id="upload_div">
							<p class="prog-txt desk-pro-text">Please upload <span>the minimum required photos</span> of your costume in front, back and side view. Listings with more photos sell faster! Don't forget to include any accessories!</p>
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
									<span class="remove_pic" id="drag_n_drop_1" >
										<i class="fa fa-times-circle" aria-hidden="true"></i>				
									</span>
									<div class="up-blog">
										<!-- <img id="front_image_id" name="file1" src="{{ asset('costumers_images/Medium')}}<?php echo '/'.$front_image->image; ?>"> -->
										<input type="file" name="file1" accept="image/*" value="1" id="file1">
										<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
										<?php if(isset($front_image->image) && !empty($front_image->image)){
										?>
										<div class="drop_uploader drop_zone drop_zone1">
											<img src="" class="result" >
											<ul class="files thumb">
												<li id="selected_file_0">
													<div class="thumbnail" style="background-image: url('{{ asset('costumers_images/Medium')}}<?php echo '/'.$front_image->image; ?>');position: absolute;top:-10px !important;">
													</div>
												</li>
											</ul>
										</div>
										<input type="hidden" name="Imagecrop1" data-id ="{{$front_image->image}}" data-value="1" class="Forntview" value="">
										<?php 
										}else { ?>
										<input type="file" name="file1" accept="image/*" value="1" id="file1">
										<input type="hidden" name="Imagecrop1" class="Forntview" value="">
										<div class="drop_uploader drop_zone1">
											<img src="" class="result" >
										</div>
										<?php 
										} ?>
									</div>
									<span id="file1_error" style="color:red"></span>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-12 rc_pic" id="back_view">
									<h4>02. Back View</h4>
									<span class="remove_pic" id="drag_n_drop_2" >
										<i class="fa fa-times-circle" aria-hidden="true"></i>				
									</span>
									<div class="up-blog">
										<input type="file" name="file2" accept="image/*" id="file2" value="1">
										<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
										<?php if(isset($back_image->image) && !empty($back_image->image)){
										?>
										<div class="drop_uploader drop_zone drop_zone2">
											<img src="" class="result2" >
											<ul class="files thumb">
												<li id="selected_file_1">
													<div class="thumbnail" style="background-image: url('{{ asset('costumers_images/Medium')}}<?php echo '/'.$back_image->image; ?>');position: absolute;top:-10px !important;"></div>
												</li>
											</ul>
										</div>
										<input type="hidden" name="Imagecrop2" data-id ="{{$back_image->image}}" data-value="2" class="Backview" value="">
										<?php 
										}else { ?>
										<input type="file" name="file2" accept="image/*" id="file2" value="1">
										<input type="hidden" name="Imagecrop2" class="Backview" value="">
										<div class="drop_uploader drop_zone2">
											<img src="" class="result2" >
										</div>
										<?php 
										} ?>
									</div>
									<span id="file2_error" style="color:red"></span>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12 rc_pic " id="details_view">
									<h4>03. Additional</h4>
									<span class="remove_pic" id="drag_n_drop_3" @if(empty($details_image->image)) style="display: none;" @endif>
										<i class="fa fa-times-circle" aria-hidden="true"></i>					
									</span>
									<div class="up-blog">
										<input type="file" name="file3" accept="image/*" id="file3" value="1">
										<span class="text"> <a href="#" class="button button-primary file_browse"></a></span>
										<?php if(isset($details_image->image) && !empty($details_image->image)){
										?>
										<div class="drop_uploader drop_zone drop_zone3">
											<img src="" class="result3" >
											<ul class="files thumb">
												<li id="selected_file_2">
													<div class="thumbnail" style="background-image: url('{{ asset('costumers_images/Medium')}}<?php echo '/'.$details_image->image; ?>');position: absolute;top:-10px !important;">
													</div>
												</li>
											</ul>
										</div>
										<input type="hidden" name="Imagecrop3" data-id ="{{$details_image->image}}" data-value="3" class="Additional" value="">
										<?php 
										}else { ?>
										<input type="file" name="file3" accept="image/*" id="file3" value="1">
										<input type="hidden" name="Imagecrop3" class="Additional" value="">
										<div class="drop_uploader drop_zone3">
											<img src="" class="result3" >
										</div>
										<?php
										} ?>
									</div>
									<span id="file3_error" style="color:red"></span>
								</div>
							</div>

								
							<div class=" up_btns_tl col-md-12 col-sm-12 col-xs-12">
								<!--  modal pop up code here for all type of images  -->
								<div id="myModal" class="modal fade imageModel and carousel slide" role="dialog"  data-backdrop="static">
									<div class="modal-dialog modal-md">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												{{--<button type="button" class="close"  id="closeModal1" data-dismiss="modal">&times;</button>--}}
												<h4 class="modal-title">Front View</h4>
											</div>
											<div class="modal-body">
												<p>Crop your photo to control how your full-size photo appears on the public listing page.</p>
												<div class="carousel-inner" id="dvPreview">
												</div>
												<div class="img-pp">
													<div class="img-pp-iner">
														<img class="img-responsive crp1" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
														<input type="range" id="zoom-level" min="0" value="0" step="any" >
														<img class="img-responsive crp2" src="{{URL::asset('assets/frontend/img/crp_2.png')}}">
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-success pull-right save" id="crop">Save</button>
												<button type="button" class="btn btn-default img_clse" data-dismiss="modal" id="cancel1">Cancel</button>
											</div>
										</div>
									</div>
								</div>
								<!-- Ends here  -->
								<!-- second modal code here -->
								<div id="myModal2" class="modal fade imageModel and carousel slide" role="dialog"  data-backdrop="static">
									<div class="modal-dialog modal-md">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												{{--<button type="button" class="close"  id="closeModal2"  data-dismiss="modal">&times;</button>--}}
												<h4 class="modal-title">Back View</h4>
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



								<div class="col-md-12 col-sm-12 col-xs-12 ">
									<div class="clearfix"></div>
									<!-- <form> -->
									<?php 
										$i=0;
									?>
									@if(isset($more_image) && !empty($more_image))
									<div class="row multi_main_div">
										@foreach($more_image as $image)
										<?php //echo "<pre>"; print_r($image->image);die; ?>
										<div class="col-md-4 col-sm-4 col-xs-12 multi_div" id="remv_{{$i}}">
											<input type="hidden" name="hidden_file4[]" id="remv_{{$i}}" class="hiddenValue" data-id = "{{$image->image}}" value="{{$image->image}}">
											<div class="multi_thumbs pip" style="background-image: url({{ asset('costumers_images/Medium')}}<?php echo '/'.$image->image; ?>)">
												<!-- <img class="imageThumb img-responsive" src="{{ asset('costumers_images/Medium')}}<?php echo '/'.$image->image; ?>" title="undefined"><br><span class="remove"></span>-->
												<span class="remove_pic remove " data-id="remv_{{$i}}">
													<i class="fa fa-times-circle" aria-hidden="true"></i>				
												</span>
											</div>
										</div> 
										<?php $i++;?>
										@endforeach
										<div id="other_thumbnails">
											<!--<div class="col-md-3 col-sm-3 col-xs-12"></div>-->
										</div>
										<div class="multiHidden">
										</div>
										<div class="deletedImages">
										</div>
										<div class="FrontDelete">
										</div>
										<div class="BackDelete">
										</div>
										<div class="AddiDelete">
										</div>
									</div>
									@endif
								</div>


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
						<?php //echo "<pre>";print_r($costume_description);die; ?>
						<p class="prog-txt desk-pro-text">Please fill in the following fields  <span>as accurately as possible</span> to prevent disputes.</p>
						<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">step 2</h2>
						<h2 class="prog-head">Costume Description</h2>
						<p class="prog-txt mobile-pro-text">Please fill in the following fields  <span>as accurately as possible</span> to prevent disputes.</p>
						<!-- <form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="costume_description_form" id="costume_description_form" method="post"> -->	
						<div class="prog-form-rm">
							<div class="col-md-12 col-xs-12 col-sm-12 ">
								<!--costume name code starts here-->
								<div class="form-rms">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que">Costume Name *</p>
										<p class="form-rms-small">Example:<br>"Dark Knight Joker Cosplay"</p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<p class="form-rms-input"><input type="text" name="costume_name" value="{{$costume_description->name}}" id="costume_name" autocomplete="off" tab-index="1" placeholder=""></p>
										<span id="costumename_error" style="color:red"></span>
									</div>
								</div>
								<!--costume name ends starts here-->
								<!--Catgeory code starts here-->
								<div class="form-rms">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que">Category*</p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<p class="form-rms-input">
											<select name="categoryname" id="categoryname" class="form-control" >
												<option value="">Select Category</option>
												@foreach($categories as $index=>$category)
												<option <?php if($costume_details->cat_id == $category->categoryid) { ?> selected="selected" <?php } ?> value="{{$category->categoryid}}">{{$category->categoryname}}</option>
												@endforeach
											</select>
										</p>
										<span id="categoryerror" style="color:red"></span>
									</div>
								</div>


								<!--category code ends here-->
								<!--Gender Code starts here-->
								<div class="form-rms">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que">Sex*</p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12" id="genderRadio">
										<p class="form-rms-input">
											
											
											<div class="form-rms-input">
												<div class="col-md-2 col-sm-4 ">
													<input  id="radio-1" class="radio-custom" name="gender" <?php if ($costume_details->gender == "male") { ?> checked='checked' <?php } ?>  type="radio" value="male">
													<label for="radio-1" class="radio-custom-label">Male</label>
												</div>
												<div class="col-md-2 col-sm-4">
													<input id="radio-2"  class="radio-custom" name="gender"  <?php if ($costume_details->gender == "female") { ?> checked='checked' <?php } ?> type="radio" value="female">
													<label for="radio-2" class="radio-custom-label">Female</label>
												</div>
												<div class="col-md-2 col-sm-4">
													<input id="radio-3"  class="radio-custom" name="gender" <?php if ($costume_details->gender == "boy") { ?> checked='checked' <?php } ?>  type="radio" value="boy">
													<label for="radio-3" class="radio-custom-label">Boys</label>
												</div>
												<div class="col-md-2 col-sm-4">
													<input id="radio-4"  class="radio-custom" name="gender" <?php if ($costume_details->gender == "girl") { ?> checked='checked' <?php } ?>  type="radio" value="girl">
													<label for="radio-4" class="radio-custom-label">Girls</label>
												</div>
												<div class="col-md-2 col-sm-4">
													<input id="radio-5"  class="radio-custom" name="gender" <?php if ($costume_details->gender == "baby") { ?> checked='checked' <?php } ?> type="radio" value="baby">
													<label for="radio-5" class="radio-custom-label">Babies</label>
												</div>
											</div>
											
										</p>
										<span id="gendererror" style="color:red"></span>
									</div>
								</div>


								<!--Gender code ends here-->
								<!--size code starts here-->
								<div class="form-rms">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que">Size*</p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<p class="form-rms-input">
											<select name="size" id="size" class="form-control">
												<option value="">Select Size</option>
												<option <?php if ($costume_details->size == "1sz") { ?> selected="selected" <?php } ?> value="1sz">1SZ</option>
												<option <?php if ($costume_details->size == "xxs") { ?> selected="selected" <?php } ?> value="xxs">XXS</option>
												<option <?php if ($costume_details->size == "xs") { ?> selected="selected" <?php } ?> value="xs">XS</option>
												<option <?php if ($costume_details->size == "s") { ?> selected="selected" <?php } ?> value="s">S</option>
												<option <?php if ($costume_details->size == "m") { ?> selected="selected" <?php } ?> value="m">M</option>
												<option <?php if ($costume_details->size == "l") { ?> selected="selected" <?php } ?> value="l">L</option>
												<option <?php if ($costume_details->size == "xl") { ?> selected="selected" <?php } ?> value="xl">XL</option>
												<option <?php if ($costume_details->size == "xxl") { ?> selected="selected" <?php } ?> value="xxl">XXL</option>
												<option <?php if ($costume_details->size == "std") { ?> selected="selected" <?php } ?> value="std">STD</option>
											</select>
										</p>
										<span id="sizeerror" style="color:red"></span>
									</div>
								</div>


								<!--size code ends here-->
								<!--Get subcategory ajax code starts here-->
								<div class="form-rms">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que">Sub Category*</p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<p class="form-rms-input">
										 
											@if(count($db_subcategoryname)>0 &&!empty($db_subcategoryname))
											<select name="subcategory" id="subcategory" class="form-control">
												<option value="">Select Sub Category</option>
												@foreach($db_subcategoryname as $index=>$category)
												@if(!empty($costume_category_2->category_id))
													<option <?php if($costume_category_2->category_id == $category->subcategoryid) { ?> selected="selected" <?php } ?> value="{{$category->subcategoryid}}">{{$category->subcategoryname}}</option>
												@else	
													 
												@endif
												@endforeach
											</select>
											@else
											<select name="subcategory" id="subcategory">
												<option value="">Select Sub Category</option>
											</select>
											@endif
										</p>
										<span id="subcategoryerror" style="color:red"></span>
									</div>
								</div>

								<!--Get subcategory regarding categories code ends here-->
								<div class="form-rms costume-error condition_div">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que">Condition*</p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12 pdlft0">
											<p class="form-rms-input">
												<div class="col-md-3 col-sm-4 pdlft0">	
													<span class="full-rms">
														<input type="radio" class="radio-custom" name="condition" <?php if ($costume_details->condition == "brand_new") { ?> checked='checked' <?php } ?> value="brand_new" id="brandnew"> <label for="brandnew" class="radio-custom-label">Brand New</label>
													</span>												
												</div>
												<div class="col-md-3 col-sm-4 ">												
													<span class="full-rms"><input type="radio" class="radio-custom" name="condition" <?php if ($costume_details->condition == "like_new") { ?> checked='checked' <?php } ?> value="like_new" id="likenew"><label for="likenew" class="radio-custom-label"> Like New</label></span>												 
												</div>
												<div class="col-md-3 col-sm-4 ">													
													<span class="full-rms"><input type="radio" class="radio-custom" name="condition" <?php if ($costume_details->condition == "good") { ?> checked='checked' <?php } ?> value="good" id="good"> <label for="good"  class="radio-custom-label">Good</label></span>														
												</div>
											</p>
											<span id="costumeconditionerror" style="color:red"></span>
										</div>
									</div>
								</div>


								<div class="form-rms film_quality_div">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que">{{$cosplayfive->label}}*</p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12 pdlft0">
										<p class="form-rms-input">

											@foreach($cosplayfive_values as $cosplayfive_val)
										 
											<div class="col-md-2  col-sm-4">
												<input id="{{$cosplayfive_val->optionid}}" <?php if($db_cosplayfive->attribute_option_value_id == $cosplayfive_val->optionid) { ?> checked="checked" <?php } ?> value="{{$cosplayfive_val->optionid}}" class="radio-custom" name="{{$cosplayfive->code}}" type="radio" value="{{$cosplayfive_val->optionid}}">
												<label for="{{$cosplayfive_val->optionid}}" class="radio-custom-label">{{$cosplayfive_val->value}}</label>
											</div>
											
											@endforeach										
											
										</p>


										@if(count($db_film_name)== 1)
										<p class="form-rms-small" id="film_text" @if(count($db_film_name)!= 1) style="display: none;" @endif >Which production was your costume featured in?</p>
										<p class="ct1-rms-rel form-rms-input" id="film_text_input" @if(count($db_film_name)!= 1) style="display: none;" @endif>
											<input type="text" name="film_name" value="{{$db_film_name->attribute_option_value}}" id="film_name" > <span><span>
											</p>
											@else
											<p class="form-rms-small" id="film_text" style="display: none;">Which production was your costume featured in?</p>
											<p class="ct1-rms-rel form-rms-input" id="film_text_input" style="display: none;">
												<input type="text" name="film_name" id="film_name" > <span><span>
												</p>
												@endif
												<span id="qualityerror" style="color:red"></span>
												</div>	
								</div>
 
								<div class="form-rms descibr_smte_text">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que form-rms-que1"><span></span>How would you describe your costume?</p>
										
										<p>Have a unique costume? Please enter a maximum of <strong>10</strong> keywords to describe it.</p>
										<p><span class="ctume_tip-spn">Tip:</span>Have a speciailty costume? To increase your changes of making a sale, input the appropriate keywords with our existing <span>list of categories.</span> </p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<p class="form-rms-input keywrds-input"><input type="text" id="keywords_tag">
											<a href="javascript:void(0)" id="keywords_add">Add</a>
										</p>
										<div id="div" class="keywords_div">
											@if(!empty($costume_description->keywords))
											<?php $explode = explode(',', $costume_description->keywords);
												$keyword_count = count($explode);
												foreach ($explode as $key => $keywords) {
												?>
												@if(!empty($keywords))
												<p class="keywords_p p_{{10-$key}}">{{$keywords}}<span id="remove_{{10-$key}}">X</span> </p>
												<input id="input_{{10-$key}}" name="keyword_{{10-$key}}" value="{{$keywords}}" type="hidden">
												@endif
												<?php
												}
												for ($x = 10-$keyword_count+1; $x <= 10; $x++) {?>
												<input id="input_{{$x}}" name="keyword_{{$x}}" value="" type="hidden">
											<?php } ?>
											@endif
										</div>
										<div id="count">@if(!empty($costume_description->keywords)){{10 - count($explode)}}
        
                                        @else 10
                                        @endif left</div>
									</div>
								</div>
				<div class="form-rms costume-error make_costume">
				<div class="col-md-4 col-sm-4 pdlft0">
				<p class="form-rms-que"> {{$cosplayfour->label}}</p>
				</div>
				<div class="col-md-8 col-sm-8 pdlft0 how_lng_tme">
					<p class="form-rms-input">

					@foreach($cosplayfour_values as $index=>$cosplayfour_val)
					<span class="full-rms">

						<div class="col-md-2  col-sm-4 col-xs-12  pdlft30">
						<input id="{{$cosplayfour_val->optionid}}" class="radio-custom" name="{{$cosplayfour->code}}" <?php if($db_cosplayfour->attribute_option_value_id == $cosplayfour_val->optionid) { ?> checked="checked" <?php } ?> type="{{$cosplayfour->type}}" value="{{$cosplayfour_val->optionid}}">
						<label for="{{$cosplayfour_val->optionid}}" class="radio-custom-label">{{$cosplayfour_val->value}}</label>
					</div>
 
					</span>
					@endforeach

					@if(count($db_make_costume_time)== 1)
                        <div class="col-md-12  col-sm-12 how_div" id="mention_hours" style="display: block;">
						<p class="col-md-4  col-sm-6" id="mention_hours" @if(count($db_make_costume_time)!= 1) style="display: none;" @endif >How long did it take?</p>
						<p class="col-md-8" id="mention_hours_input" @if(count($db_make_costume_time)!= 1) style="display: none;" @endif><input type="text" name="make_costume_time" id="make_costume_time1" value="{{$db_make_costume_time->attribute_option_value}}" class="input-rm100"> <span><i>hours</i><span>
                        </div>
					</p>
					@else
							<div class="col-md-12  col-sm-12 how_div" id="mention_hours" style="display: none">
						<p class="col-md-4  col-sm-6 mtop10" >How long did it take?</p>
						<p class="col-md-8 col-sm-8 " id="mention_hours_input"style="display: none;">
							<input type="text" name="make_costume_time" id="make_costume_time1" class="input-rm100"> <span><i>hours</i><span>
						</p>
						</div>
					@endif
					<span id="usercostumeerror" style="color:red"></span>
				</div>
				</div>
											
				<div class="form-rms costume-error describe_cnt">
					<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
						<p class="form-rms-que form-rms-que1">Describe your Costume:*</p>
						<p class="form-rms-detailed">  
							<span>Be as Detailed as possible,here are some helping questions:</span><br>
							<span>- What is your costume made out of?<br>
							Describe the comfort and/or durability</span>
							<span>- What are your costume's finest features?</span>
							<span>- Does your costume belong to a specific time period or sequel which one?</span>
							
						</p>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="description" id="description" maxlength="600" >{{$db_des_costume->attribute_option_value}}</textarea></p>
						<span id="descriptionerror" style="color:red"></span>
						<p class="form-rms-sm1 max_lnths1 max-edit2">( <span id="max_length_char1"></span> 600 characters)</p>
					</div>
				</div>
				

				<div class="form-rms">
					<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
					<p class="form-rms-que form-rms-que1">Frequently Asked Questions</p>
					<span>Create your own costume FAQ to avoid unnecessary inquiries from potential buyers.</span>
					<br>
					<span class="cret-tip"><i>Tip: Use easy-to read bullet points!</i></span>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="faq" id="faq" maxlength="600" >{{$db_faq->attribute_option_value}}</textarea></p>
					<span id="faqerror" style="color:red"></span>
					<p class="form-rms-sm1">( <span id="max_length_char3"></span> 600 characters)</p>
				</div>
				<div class="form-rms-btn step3-last-2 edit_btns-grp">
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
							<div class="col-md-12 col-sm-12 col-xs-12">
								<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">STEP 3</h2>
								
								<h2 class="prog-head">Pricing & Shipping</h2>
								<p class="prog-txt hidden-md hidden-lg hidden-sm ">Please fill in the following field <span>as accurately</span> as you can.</p>
								<div class="form-rms pricess pric_tag_three">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que">Price</p>
										<span>We Recommend Selling your second hand costumes 50-60% of their purchased price.</span>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12 ">
										<div class="form-rms-input price-divs">
											<p class="form-rms-rel "><input type="text" class="input-rm100" value="{{number_format($costume_details->price, 2)}}" name="price" id="price" ><span class="form-rms-abs"><i class="fa fa-usd" aria-hidden="true"></i></span></p>
										<!--<p class="cst2-textl2">Not Sure? <i class="fa fa-info-circle" aria-hidden="true"></i></p>--></div>
										<span id="priceerror" style="color:red"></span>
									</div>
								</div>
								<div class="form-rms">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que">Quantity</p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<p class="form-rms-input"><select  name="quantity" id="quantity" class="cst2-select50 form-control">
											<option <?php if ($costume_details->quantity == '1') { ?> selected='selected' <?php } ?> >1</option>
											<option <?php if ($costume_details->quantity == '2') { ?> selected='selected' <?php } ?> >2</option>
											<option <?php if ($costume_details->quantity == '3') { ?> selected='selected' <?php } ?> >3</option>
											<option <?php if ($costume_details->quantity == '4') { ?> selected='selected' <?php } ?> >4</option>
											<option <?php if ($costume_details->quantity == '5') { ?> selected='selected' <?php } ?> >5</option>
											<option <?php if ($costume_details->quantity == '6') { ?> selected='selected' <?php } ?> >6</option>
											<option <?php if ($costume_details->quantity == '7') { ?> selected='selected' <?php } ?> >7</option>
											<option <?php if ($costume_details->quantity == '8') { ?> selected='selected' <?php } ?> >8</option>
											<option <?php if ($costume_details->quantity == '9') { ?> selected='selected' <?php } ?> >9</option>
											<option <?php if ($costume_details->quantity == '10') { ?> selected='selected' <?php } ?> >10</option>
										</select></p>
									</div>
								</div>
								<span id="quantityerror" style="color:red"></span>
								
								
								<!--<h2 class="prog-head snd-hdng">Package Information</h2>-->
								<div class="form-rms">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que">Weight of Packaged Item*</p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<div class="form-rms-input dimensions-two dimensions-two-pk_info">
											<p class="form-rms-dim"><span class="form-rms-he1"><input id="pounds" name="pounds" value="{{$costume_details->weight_pounds}}" type="text"> <span>lbs</span></span></p>
											<span id="poundserror" style="color:red"></span>
											<p class="form-rms-dim"><span class="form-rms-he1"><input id="ounces" name="ounces" value="{{$costume_details->weight_ounces}}" type="text"> <span>oz </span></span></p>
											<span id="ounceserror" style="color:red"></span>
										</div>
										<p class="ct3-rms-text">Note: Weight is applicable for one costume ONLY.</p>
									</div>
								</div>
								<div class="form-rms">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que">Dimensions</p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<div class="form-rms-input dimensions-two dimensions-two-pk_info">
											<p class="form-rms-dim">Length <br> <span class="form-rms-he1"><input id="Length" name="Length" value="@if(!empty($db_dimensions_length->attribute_option_value)) {{$db_dimensions_length->attribute_option_value}} @endif" type="text"> <span>in x</span></span></p>
											<p class="form-rms-dim">Width <br> <span class="form-rms-he1"><input id="Width" name="Width" value="@if(!empty($db_dimensions_width->attribute_option_value)){{$db_dimensions_width->attribute_option_value}} @endif" type="text"> <span>in x</span></span></p>
											<p class="form-rms-dim">Height <br> <span class="form-rms-he1"><input id="Height" name="Height" value="@if(!empty($db_dimensions_height->attribute_option_value)){{$db_dimensions_height->attribute_option_value}}@endif" type="text"> <span>in </span></span></p>
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
						<!-- </form> -->
					</div>
					<div class="prog-form-rm" id="preferences_div">
						<!-- <form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="costume_preferences_form" id="costume_preferences_form" method="post"> -->
						<p class="prog-txt  hidden-xs">You're almost done! Just a few more questions.</p>
						<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">step 3</h2>
						<h2 class="prog-head">Review Your Preferences</h2>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<p class="prog-txt hidden-md hidden-lg hidden-sm ">You're almost done! Just a few more questions.</p>
							<div class="form-rms">
								<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
									<p class="form-rms-que">Handling Time <i class="fa fa-info-circle fa-info-rm" aria-hidden="true"></i></p>
								</div>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<p class="form-rms-input">
										<select name="handlingtime" id="handlingtime" class="form-control">
											<option value="">Select Handling Time</option>
											@foreach($handlingtime as $index=>$handlingtime)
											<option <?php if($db_handlingtime->attribute_option_value_id == $handlingtime->optionid) { ?> selected="selected" <?php } ?> value="{{$handlingtime->optionid}}">{{$handlingtime->value}}</option>
											@endforeach
										</select>
									</p>
									<span id="handlingtimeerror" style="color:red"></span>
								</div>
							</div>
							<div class="form-rms">
								<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
									<p class="form-rms-que">Return Policy</p>
								</div>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<p class="form-rms-input">
                                    @foreach($returnpolicy as $index=>$returnpolicy)
                                        <div class="col-md-4  col-sm-6 pdlft0">
                                        <input id="{{$returnpolicy->optionid}}" class="radio-custom" name="returnpolicy" <?php if($db_return->attribute_option_value_id == $returnpolicy->optionid) { ?> checked="checked" <?php } ?>  type="radio" value="{{$returnpolicy->optionid}}">
                                        <label for="{{$returnpolicy->optionid}}" class="radio-custom-label">{{$returnpolicy->value}}</label>
                                        </div>
                                    @endforeach
        
        
									</p>
									<span id="returnpolicyerror" style="color:red"></span>
								</div>
							</div>
							<?php //echo $costume_details->dynamic_percent; die;?>
							<div class=" charity_rigt">
								<div class="form-rms lst-stp">
									<div class="col-md-4 col-sm-4 col-xs-12 pdlft0">
										<p class="form-rms-que form-rms-que1 dnt_br">Donate a Portion to Charity</p>
										
										<p class="ct3-rms-text">Chrysalis Charges a 3% transaction fee on sale of every costume.However, if you donate 5% or more of your sale to a charity we will waive our transaction fee to match your contribution</p>
										<p class="ct3-rms-text">By Choosing to donate, I agree and accept Chrysalis' <a style="border-bottom: 1px solid #ccc">Terms & Conditions</a>.</p>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12 dnt-amcnts">
										
										<div class="form-rms-input plus_minus_div">
											<p class="form-rms-rel111">
                                            
                                            <div class="col-md-3">
                                            <div class="input-group">
                                            <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number donate_charity chr_bt1" disabled="disabled" data-type="minus" data-field="donate_charity">
                                            <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                            </span>
                                            <input type="text" name="donate_charity" class="form-control input-number" id="dnt_amt" value="{{$costume_details->dynamic_percent}}" min="1" max="100">
                                            <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number donate_charity chr_bt2" data-type="plus" data-field="donate_charity">
                                            <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                            </span>
                                            </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            
                                          
                                                        </p>
                                                        <div class="col-md-5 donation_amt">
                                                        <p class="ct3-rms-head">Donation Amount</p>
												<p class="cst3-textl2" name="dynamic_percent_amount" id="dynamic_percent_amount"><i class="fa fa-usd" aria-hidden="true"></i>{{number_format($costume_details->donation_amount, 2)}}</p>
												<input type="hidden" name="hidden_donation_amount" id="hidden_donation_amount" value="{{$costume_details->donation_amount}}">
												<span id="donate_charityerror" style="color:red"></span>
                                                </div>
										</div>
									</div>
        
									<div class="col-md-12 col-sm-12 col-xs-12 pdlft0">
										<p class="ct3-rms-head">Organization of choice</p>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12 pdlft0">
										<ul class="ct3-list">
											<?php //echo $costume_details->charity_id;die; ?>
											@foreach($charities as $index=>$charity)
											<li><img src="@if(isset($charity->image) && !empty($charity->image)){{URL::asset('/charities_images/')}}/{{$charity->image}} @else {{ URL::asset('/img/default.png')}} @endif" alt="{{$charity->name}}" />
												<p>{{$charity->name}}</p>
											<input type="radio" id="{{$charity->name}}" @if($costume_details->charity_id == $charity->id) checked="checked" @endif value="{{$charity->id}}" name="charity_name" /></li>
											@endforeach
										</ul>
										<span id="charity_nameerror" style="color:red"></span>
										<!--<p class="cst2-rms-chck"><input type="checkbox" id="another_charity" name="another_charity" @if($costume_details->charity_id == 0 && $costume_details->dynamic_percent != "none") checked="checked" @endif >Want to suggest a favorite charity organization </p>-->
									</div>
								</div>
								<div class="form-rms" id="other_organzation_check" @if($costume_details->charity_id != 0 || $costume_details->dynamic_percent == "none" )style="display: block;" @endif>
								<p class="ct3-rms-head chartiy_spcy col-md-3 col-sm-3 col-xs-12">Want to suggest a favorite charity
																organization? <br> <span class="want-orgo">we will do our best to include it in the future!</span></p>
									<p class="org_nme col-md-9 col-sm-9 col-xs-12 orginze_input"><input type="text" value="@if(isset($charities_details) && !empty($charities_details)){{$charities_details->name}}@endif" name="organzation_name" id="organzation_name" autocomplete="off" placeholder="Organization Name"  class="form-control"></p>
									<span id="organzation_nameerror" style="color:red"></span>
								</div>
								<div class="form-rms-btn loader-align step3-last-2">
									<img id='ajax_loader' src="{{asset('img/ajax-loader.gif')}}" style="display :none;" >	
									<a type="button" id="preferences_finished" class="btn-rm-nxt">I'm Finished!</a>
									<a type="button" id="preferences_back" class="btn-rm-back"><span>Back</span></a>
								</div>
							</div>
							<!-- </form> -->
						</div>
					</form>
				</div><!-- id='total_forms_div' -->
				<!-- <div id="success_page" style="display: none;">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<div class="success_page_final">
								<img class="img-responsive" src="{{URL::asset('assets/frontend/img/chrysalis-meme.png')}}">
								<h2>Success!</h2>
								<p>Thank You for listing your costume with Chrysalis!<br>
								Your costume has successfully been uploaded.</p>
								<a type="button" id="" href="{{URL::to('/')}}" class="btn-rm-ret">Return Home</a><br>
								<a type="button" id="" href="{{URL::to('my/costumes')}}" class="btn-rm-view-finl"> <span>View My Listing!<span></a>
								</div>
								</div>
							</div>
						</div> -->
						<!-- Added by Gayatri -->

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
                                            <img src="" id="image_selected" class="media-object" style="width:150px">
                                        </div>
                                        <div class="media-body">
                                            <p>I'm selling my <a href="" id="costumename"></a> on Chrysalis.</p>
                                            <p><a href="javascript:void(0);" id="amount"></a> of the sale goes to <a href="javascript:void(0);" id="charity_center"></a>. </p>
                                            <p>Check it out! </p>
                                        </div>
                                    </div>
                                    <div class="tnks_socila">
                                        <ul class="social-network social-circle">
                                            <li>
                                            	<a href="javascript:void(0);" id="facebook" class="icoRss" title="Facebook">
                                            		<img class="img-responsive" src="{{URL::asset('assets/frontend/img/fb-ic.png')}}">
                                            		<input type="hidden" name="url_fb" id="url_fb" value="">
                                            		<input type="hidden" name="quote_fb" id="quote_fb" value="">
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
                                            	<input type="hidden" name="tumblr_url" id="tumblr_quote" value="">
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- <a type="button" id="" href="{{URL::to('/')}}" class="btn-rm-ret">Share!</a><br> -->
                                    <a type="button" id="" href="{{URL::to('/')}}" class="btn-rm-view-finl"> <span>Return Home<span></a>
                                        
                                    </div>
                                    </div>
                                </div>
                         </div>
						
						<!-- End -->
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
					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.js"></script>
					<script type="text/javascript" src="{{asset('/assets/frontend/js/costumesedit.js')}}"></script>
					<script type="text/javascript">
						$(document).ready(function(){
                              
                          
                            var selector = '.ct3-list  li';
                            $(selector).on("click",function()
                            {
                                $(selector).removeClass('active');
                                $(this).addClass('active');
                            });
							
							//delete multiple selected images code
							var allRemove = [];
							$(document).on("click",".remove_pic",function()
							{
								var cur_val = $(this).attr('data-id');		 
								var cur_rem_val = $(this).parents().attr('style');
								var last_one = cur_rem_val.substr(cur_rem_val.length - 15);
								var remove_org_val = last_one.slice(0,-1);
								var MakeInput = '';
								removeValue =  $("#"+cur_val).val();
								//console.log(removeValue);
								$("div#"+cur_val).remove();
								//$("#"+cur_val).parents().find("div.multi_div").remove();
								allRemove.push(remove_org_val);
								$.each( allRemove, function( key, value ) {
									MakeInput =  '<input type="hidden" name="multiple[]" value="'+value+'">';
								});
								$(".deletedImages").append(MakeInput);
							});
						});
					</script>
        <script>
        
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
                               
                               //console.log(present);
                               
                               var price = $('#price').val();
                               
                               var total = (price * present) / 100;
                               
                               $('#hidden_donation_amount').val(parseFloat(total).toFixed(2));
                               $('#dynamic_percent_amount').html("<i class='fa fa-usd' aria-hidden='true'></i> " + parseFloat(total).toFixed(2));
                               
                               
                               //$('#dynamic_amount').html("<input type='hidden' name='donation_amount_val' id='hidden_donation_amount' value='"+parseFloat(total).toFixed(2)+"'>");
                               
                               
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
        </script>
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
		    title: 'Spider man costume - Chrysalis',
		    href: $("#url_fb").val(),
		    quote: $("#quote_fb").val()
	  	}, function(response){

	  	});
			  
	}
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

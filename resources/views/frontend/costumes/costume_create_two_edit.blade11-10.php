@extends('/frontend/app')
@section('styles')
<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/drop_uploader.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
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
.up_btns_tl a
{
	border:none !important;
}
.drop_uploader.drop_zone {
	position: absolute;
	top: 0;
}
.upload-photo-blogs .up-blog img {
   background: #fff;
}
.img-pp-iner {
   padding-bottom: 30px;
}

.carousel-control.left{width:15%;}
 
.carousel-control.right{width:15%;}

#lightbox .modal-footer {
   border-top: 1px solid #ccc !important;
}
#other_thumbnails img{background-color: transparent;}
</style>
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
														<input type="range" id="zoom-level" min="0" max="5" value="0" step="any" >
														<img class="img-responsive crp2" src="{{URL::asset('assets/frontend/img/crp_2.png')}}">
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-success pull-right save" id="crop">Save</button>
												<button type="button" class="btn btn-default img_clse" data-dismiss="modal">Cancel</button>
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
														<input type="range" id="zoom-level2"  min="0" max="5" value="0" step="any" >
														<img class="img-responsive crp2" src="{{URL::asset('assets/frontend/img/crp_1.png')}}">
													</div>
												</div>
												<div class="width"></div>
												<div class="height"></div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-success pull-right save" id="crop2">Save</button>
												<button type="button" class="btn btn-default img_clse" data-dismiss="modal">Cancel</button>
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
												<button type="button" class="btn btn-default img_clse" data-dismiss="modal">Cancel</button>
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

 
<div id="costume_description">
<?php //echo "<pre>";print_r($costume_description);die; ?>
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
<p class="form-rms-input"><input type="text" name="costume_name" value="{{$costume_description->name}}" id="costume_name" autocomplete="off" tab-index="1" placeholder=""></p>
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
<option <?php if($costume_details->cat_id == $category->categoryid) { ?> selected="selected" <?php } ?> value="{{$category->categoryid}}">{{$category->categoryname}}</option>
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
<option <?php if ($costume_details->gender == "male") { ?> selected="selected" <?php } ?> value="male">Male</option>
<option <?php if ($costume_details->gender == "female") { ?> selected="selected" <?php } ?> value="female">Female</option>
<option <?php if ($costume_details->gender == "unisex") { ?> selected="selected" <?php } ?> value="unisex">Unisex</option>
<option <?php if ($costume_details->gender == "pet") { ?> selected="selected" <?php } ?> value="pet">Pet</option>
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
<!--size code ends here-->
<!--Get subcategory ajax code starts here-->
<div class="form-rms">
<p class="form-rms-que">05. Subcategory*</p>
<p class="form-rms-input">
	<?php //echo $db_subcategoryname;die; ?>
@if(count($db_subcategoryname)>0)
<select name="subcategory" id="subcategory" >
<option value="">Select Sub Category</option>
@foreach($db_subcategoryname as $index=>$category)
<option <?php if($costume_category_2->category_id == $category->subcategoryid) { ?> selected="selected" <?php } ?> value="{{$category->subcategoryid}}">{{$category->subcategoryname}}</option>
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
<!--Get subcategory regarding categories code ends here-->


<div class="form-rms">
<p class="form-rms-que">06. Condition*</p>
<p class="form-rms-input">
<span class="full-rms"><input type="radio" name="condition" <?php if ($costume_details->condition == "brand_new") { ?> checked='checked' <?php } ?> value="brand_new" id="brandnew"> <label for="brandnew">Brand New</label></span>
<span class="full-rms"><input type="radio" name="condition" <?php if ($costume_details->condition == "like_new") { ?> checked='checked' <?php } ?> value="like_new" id="likenew"><label for="likenew"> Like New</label></span>
<span class="full-rms"><input type="radio" name="condition" <?php if ($costume_details->condition == "excellent") { ?> checked='checked' <?php } ?> value="excellent" id="excellent"> <label for="excellent">Excellent</label></span>
<span class="full-rms"><input type="radio" name="condition" <?php if ($costume_details->condition == "good") { ?> checked='checked' <?php } ?> value="good" id="good"> <label for="good">Good</label></span>
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
<input type="{{$bodyanddimensions->code}}" value="{{$db_body_height_ft->attribute_option_value}}" name="{{$body_height_ft->value}}" id="{{$body_height_ft->value}}"> <span><?php echo $heading_value;?></span>
<input type="{{$bodyanddimensions->code}}" value="{{$db_body_height_in->attribute_option_value}}" class="form-rms-dt" name="{{$body_height_in->value}}" id="{{$body_height_in->value}}" > <span><?php echo $heading_value_in; ?></span></span></p>
<p class="form-rms-dim weight-chest"><?php echo ucfirst($heading_weight_value); ?> <br/> <span class="form-rms-he1"><input type="text" name="{{$body_weight_lbs->value}}" value="{{$db_body_weight_lbs->attribute_option_value}}" id="{{$body_weight_lbs->value}}"> <span><?php echo $heading_weight_value_lbs;?></span></span></p>
<p class="form-rms-dim weight-chest"><?php echo ucfirst($heading_chest_value); ?> <br/> <span class="form-rms-he1"><input type="text" name="{{$body_chest_in->value}}" value="{{$db_body_chest_in->attribute_option_value}}" id="{{$body_chest_in->value}}" > <span><?php echo $heading_chest_value_in; ?> </span></span></p>
<p class="form-rms-dim weight-chest"><?php echo ucfirst($heading_waist_value); ?> <br/> <span class="form-rms-he1"><input type="text" name="{{$body_waist_lbs->value}}" value="{{$db_body_waist_lbs->attribute_option_value}}" id="{{$body_waist_lbs->value}}"> <span><?php echo $heading_waist_value_lbs; ?></span></span></p>
<span id="bodydimensionerror"  style="color:red"></span>
</div>
</div>

<?php //echo count($db_cosplayplay_yes_opt);die; ?>
<div class="form-rms">
<p class="form-rms-que">08. {{$cosplayone->label}}</p>
<p class="form-rms-input">
@foreach($cosplayone_values as $index=>$cosplayone_val)
<span class="full-rms"><input type="{{$cosplayone->type}}" <?php if($db_cosplayone->attribute_option_value_id == $cosplayone_val->optionid) { ?> checked="checked" <?php } ?> name="{{$cosplayone->code}}" id="{{$cosplayone_val->optionid}}" value="{{$cosplayone_val->optionid}}"> <label for="{{$cosplayone_val->optionid}}">{{$cosplayone_val->value}}</label></span>
@endforeach
</p>
<span id="cosplayerror" style="color:red"></span>

<div class="row" id="cosplayplay_yes_div" @if(count($db_cosplayplay_yes_opt)!= 1) style="display: none;" @endif>
<div class="col-md-12" >
<p class="slt_act_all">Select all that apply:</p>

<div class="fity_hlf">

@foreach($cosplaySubCategories as $subCat)
	<div class="radio-inline">
		<label for="{{ $subCat->name }}"><input type="radio" name="cosplayplay_yes_opt" value="{{ $subCat->name }}" id="{{ $subCat->name }}" @if(!empty($db_cosplayplay_yes_opt) && $db_cosplayplay_yes_opt->attribute_option_value == $subCat->name) checked="checked" @endif>{{ $subCat->name }}</label>
	</div>
@endforeach

</div>



</div>

<span id="cosplay_yeserror" style="color:red"></span>
</div>

</div>

<div class="form-rms">
<p class="form-rms-que">09. {{$cosplaytwo->label}}</p>
<p class="form-rms-input">
@foreach($cosplaytwo_values as $index=>$cosplaytwo_val)
<span class="full-rms"><input type="{{$cosplaytwo->type}}" name="{{$cosplaytwo->code}}" <?php if($db_cosplaytwo->attribute_option_value_id == $cosplaytwo_val->optionid) { ?> checked="checked" <?php } ?> id="{{$cosplaytwo_val->optionid}}" value="{{$cosplaytwo_val->optionid}}"> <label for="{{$cosplaytwo_val->optionid}}">{{$cosplaytwo_val->value}}</label></span>
@endforeach
</p>
<span id="uniquefashionerror" style="color:red"></span>

<div class="row" id="uniquefashion_yes_div" @if(count($db_uniquefashion_yes_opt)!= 1) style="display: none;" @endif>

<div class="col-md-12" >
<p class="slt_act_all">Select all that apply:</p>
<div class="fity_hlf">

@foreach($uniqueFashionSubCategories as $subCat)
	<div class="radio-inline">
		<label for="{{ $subCat->name }}"><input type="radio" name="uniquefashion_yes_opt" value="{{ $subCat->name }}" id="{{ $subCat->name }}" @if(!empty($db_uniquefashion_yes_opt) && $db_uniquefashion_yes_opt->attribute_option_value == $subCat->name) checked="checked" @endif>{{ $subCat->name }}</label>
	</div>
@endforeach

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
<span class="full-rms"><input type="{{$cosplaythree->type}}" name="{{$cosplaythree->code}}" <?php if($db_cosplaythree->attribute_option_value_id == $cosplaythree_val->optionid) { ?> checked="checked" <?php } ?> id="{{$cosplaythree_val->optionid}}" value="{{$cosplaythree_val->optionid}}"> <label for="{{$cosplaythree_val->optionid}}">{{$cosplaythree_val->value}}</label></span>
@endforeach
</p>
<span id="activityerror" style="color:red"></span>

<div class="row" id="activity_yes_div" @if(count($db_activity_yes_opt) != 1) style="display: none;" @endif>

<div class="col-md-12">
<p class="slt_act_all">Select all that apply:</p>

<div class="fity_hlf">

@foreach($filmTheatreSubCategories as $subCat)
	<div class="radio-inline">
		<label for="{{ $subCat->name }}"><input type="radio" name="activity_yes_opt" value="{{ $subCat->name }}" id="{{ $subCat->name }}" @if(!empty($db_activity_yes_opt) && $db_activity_yes_opt->attribute_option_value == $subCat->name) checked="checked" @endif>{{ $subCat->name }}</label>
	</div>
@endforeach

</div>

</div>


<span id="activity_yeserror" style="color:red"></span>
</div>

</div>

<div class="form-rms">
<p class="form-rms-que">11. {{$cosplayfour->label}}</p>
<p class="form-rms-input">
@foreach($cosplayfour_values as $index=>$cosplayfour_val)
<span class="full-rms"><input type="{{$cosplayfour->type}}" name="{{$cosplayfour->code}}" <?php if($db_cosplayfour->attribute_option_value_id == $cosplayfour_val->optionid) { ?> checked="checked" <?php } ?> id="{{$cosplayfour_val->optionid}}" value="{{$cosplayfour_val->optionid}}"> <label for="{{$cosplayfour_val->optionid}}"> {{$cosplayfour_val->value}}</label></span>
@endforeach
@if(count($db_make_costume_time)== 1)
<p class="form-rms-small" id="mention_hours" @if(count($db_make_costume_time)!= 1) style="display: none;" @endif >If yes, how long did it take?</p>
<p class="ct1-rms-rel" id="mention_hours_input" @if(count($db_make_costume_time)!= 1) style="display: none;" @endif><input type="text" name="make_costume_time" id="make_costume_time1" value="{{$db_make_costume_time->attribute_option_value}}" class="input-rm100"> <span>hours<span>
</p>
@else
<p class="form-rms-small" id="mention_hours" style="display: none;" >If yes, how long did it take?</p>
<p class="ct1-rms-rel  form-rms-input" id="mention_hours_input"style="display: none;">
	<input type="text" name="make_costume_time" id="make_costume_time1" class="input-rm100"> <span>hours<span>
</p>
@endif
<span id="usercostumeerror" style="color:red"></span>

</div>
<div class="form-rms">
<p class="form-rms-que">12. {{$cosplayfive->label}}*</p>
<p class="form-rms-input">
@foreach($cosplayfive_values as $index=>$cosplayfive_val)
<span class="full-rms"><input type="{{$cosplayfive->type}}" name="{{$cosplayfive->code}}" id="{{$cosplayfive_val->optionid}}" <?php if($db_cosplayfive->attribute_option_value_id == $cosplayfive_val->optionid) { ?> checked="checked" <?php } ?> value="{{$cosplayfive_val->optionid}}"> <label for="{{$cosplayfive_val->optionid}}">{{$cosplayfive_val->value}}</label></span>
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

<div class="form-rms descibr_smte_text">
<p class="form-rms-que form-rms-que1"><span>13. </span>How would you describe your costume?</p>
<p>Have a unique costume? Please enter a maximum of <strong>10</strong> keywords to describe it.</p>
<p><span class="ctume_tip-spn">Tip:</span>Have a speciailty costume? To increase your changes of making a sale, input the approprite keywords with our existing <span>list of categories.</span> </p>
<p class="form-rms-input"><input type="text" id="keywords_tag">
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
<div id="count">@if(!empty($costume_description->keywords)){{10 - count($explode)}} @endif left</div>

</div>

<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>14. Describe your Costume:</span> Including accessories*</p>
<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="description" id="description" maxlength="600" >{{$db_des_costume->attribute_option_value}}</textarea></p>

<span id="descriptionerror" style="color:red"></span>
<p class="form-rms-sm1">( <span id="max_length_char1"></span> 600 characters)</p>
</div>

<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>15. Fun Fact:</span> A little backstory to your costume and the adventures it has experienced</p>
<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="funfcats" id="funfacts" maxlength="600" >{{$db_funfact->attribute_option_value}}</textarea></p>
<span id="facterror" style="color:red"></span>
<p class="form-rms-sm1">( <span id="max_length_char2"></span> 600 characters)</p>
</div>

<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>16. FAQ </span>Create your own costume Frequently Asked Questions to avoid an overload of questions in your inbox!</p>
<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="faq" id="faq" maxlength="600" >{{$db_faq->attribute_option_value}}</textarea></p>
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
<p class="form-rms-rel "><input type="text" class="input-rm100" value="{{number_format($costume_details->price, 2)}}" name="price" id="price" ><span class="form-rms-abs"><i class="fa fa-usd" aria-hidden="true"></i></span></p>
<p class="cst2-textl2">Not Sure? <i class="fa fa-info-circle" aria-hidden="true"></i></p></div>
<span id="priceerror" style="color:red"></span>
</div>

<div class="form-rms">
<p class="form-rms-que">02. Quantity</p>
<p class="form-rms-input"><select  name="quantity" id="quantity" class="cst2-select50">
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
<span id="quantityerror" style="color:red"></span>
</div>

<div class="col-md-6">
<h2 class="prog-head snd-hdng">Package Information</h2>
<div class="form-rms">
<p class="form-rms-que">01. Weight of Packaged Item</p>
<div class="form-rms-input dimensions-two dimensions-two-pk_info">
<p class="form-rms-dim"><span class="form-rms-he1"><input id="pounds" name="pounds" value="{{$costume_details->weight_pounds}}" type="text"> <span>lbs</span></span></p>
<span id="poundserror" style="color:red"></span>
<p class="form-rms-dim"><span class="form-rms-he1"><input id="ounces" name="ounces" value="{{$costume_details->weight_ounces}}" type="text"> <span>oz </span></span></p>
<span id="ounceserror" style="color:red"></span>
</div>
<p class="ct3-rms-text">Note: Weight is applicable for one costume ONLY.</p>

</div>

<div class="form-rms">
<p class="form-rms-que">02. Dimensions</p>
<div class="form-rms-input dimensions-two dimensions-two-pk_info">
	<p class="form-rms-dim">Length <br> <span class="form-rms-he1"><input id="Length" name="Length" value="@if(!empty($db_dimensions_length->attribute_option_value)) {{$db_dimensions_length->attribute_option_value}} @endif" type="text"> <span>in x</span></span></p>
<p class="form-rms-dim">Width <br> <span class="form-rms-he1"><input id="Width" name="Width" value="@if(!empty($db_dimensions_width->attribute_option_value)){{$db_dimensions_width->attribute_option_value}} @endif" type="text"> <span>in x</span></span></p>
<p class="form-rms-dim">Height <br> <span class="form-rms-he1"><input id="Height" name="Height" value="@if(!empty($db_dimensions_height->attribute_option_value)){{$db_dimensions_height->attribute_option_value}}@endif" type="text"> <span>in </span></span></p>
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
<option <?php if($db_handlingtime->attribute_option_value_id == $handlingtime->optionid) { ?> selected="selected" <?php } ?> value="{{$handlingtime->optionid}}">{{$handlingtime->value}}</option>
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
<option <?php if($db_return->attribute_option_value_id == $returnpolicy->optionid) { ?> selected="selected" <?php } ?> value="{{$returnpolicy->optionid}}">{{$returnpolicy->value}}</option>
@endforeach
</select>
</p>
<span id="returnpolicyerror" style="color:red"></span>

</div>

</div>
<?php //echo $costume_details->dynamic_percent; die;?>
<div class="col-md-6 charity_rigt">
<div class="form-rms lst-stp">
<p class="form-rms-que form-rms-que1 dnt_br">03. Donate a Portion to Charity</p>
<p class="ct3-rms-text">Chrysalis Charges a 3% transaction fee on sale of every costume.However, if you donate 5% or more of your sale to a charity we will waive our transcation fee to match your contribution</p>
<p class="ct3-rms-text">By Choosing to donate, I agree and accept Chrysalis' <a style="border-bottom: 1px solid #ccc">Terms & Conditions</a>.</p>
<p class="ct3-rms-head">Donation Amount</p>
<div class="form-rms-input">
<p class="form-rms-rel1">
<select class="cst2-select80" id="donate_charity" name="donate_charity">
	<option value="">Donate Amount</option>
	<option @if($costume_details->dynamic_percent == "none") selected="selected" @endif value="none">None</option>
	<option @if($costume_details->dynamic_percent == "10") selected="selected" @endif value="10">10%</option>
	<option @if($costume_details->dynamic_percent == "20") selected="selected" @endif value="20">20%</option>
	<option @if($costume_details->dynamic_percent == "30") selected="selected" @endif value="30">30%</option>
        <option @if($costume_details->dynamic_percent == "1") selected="selected" @endif value="1">1%</option>
</select></p>
<p class="cst3-textl2" name="dynamic_percent_amount" id="dynamic_percent_amount"><i class="fa fa-usd" aria-hidden="true"></i>{{number_format($costume_details->donation_amount, 2)}}</p>
<input type="hidden" name="hidden_donation_amount" id="hidden_donation_amount" value="{{$costume_details->donation_amount}}">
<span id="donate_charityerror" style="color:red"></span>
</div>
<p class="ct3-rms-head">Donate to</p>
<ul class="ct3-list">
	<?php //echo $costume_details->charity_id;die; ?>
@foreach($charities as $index=>$charity)
<li><img src="@if(isset($charity->image) && !empty($charity->image)){{URL::asset('/charities_images/')}}/{{$charity->image}} @else {{ URL::asset('/img/default.png')}} @endif" alt="{{$charity->name}}" />
<p>{{$charity->name}}</p>
<input type="radio" id="{{$charity->name}}" @if($costume_details->charity_id == $charity->id) checked="checked" @endif value="{{$charity->id}}" name="charity_name" /></li>
@endforeach
</ul>
<span id="charity_nameerror" style="color:red"></span>

<p class="cst2-rms-chck"><input type="checkbox" id="another_charity" name="another_charity" @if($costume_details->charity_id == 0 && $costume_details->dynamic_percent != "none") checked="checked" @endif > I would like to suggest another charity organization</p>
</div>

<div class="form-rms" id="other_organzation_check" @if($costume_details->charity_id != 0 || $costume_details->dynamic_percent == "none" )style="display: none;" @endif>
<p class="ct3-rms-head chartiy_spcy">Please Specify:</p>
<p class="form-rms-input org_nme"><input type="text" value="@if(isset($charities_details) && !empty($charities_details)){{$charities_details->name}}@endif" name="organzation_name" id="organzation_name" autocomplete="off" placeholder="Organization Name"  class="form-control"></p>
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
<a type="button" id="" href="{{URL::to('my/costumes')}}" class="btn-rm-view-finl"> <span>View My Listing!<span></a>
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
 
<script type="text/javascript" src="{{asset('/assets/frontend/vendors/drop_uploader/drop_uploader.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.js"></script>
<script type="text/javascript" src="{{asset('/assets/frontend/js/costumesedit.js')}}"></script>
<!--Getting subcategory list by oonchange-->
<script type="text/javascript">
$(document).ready(function(){
    // Code added by gayatri
        var url = window.location;
        var parts = url.toString().split("/");
    	var id = parts[parts.length-2];
        if(window.location.pathname.match('costume/edit/'+id+'/charity')){
        	$('#step1').addClass('active');
        	$('#step2').addClass('active');
        	$('#step3').addClass('active');
        	$('#step4').addClass('active');
        	$('#upload_div').css('display','none');
			$('#costume_description').css('display','none');
			$('#pricing_div').css('display','none');
			$('#preferences_div').css('display','block');
        }

    //End
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

@stop

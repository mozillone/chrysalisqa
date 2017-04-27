@extends('/frontend/app')
@section('styles')
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
	<p class="prog-txt desk-pro-text">Please upload <span>the minimum required photos</span> of your costume in front, back and side view. Listings with more photos sell faster! Don't forget to include any acessories!</p>
			<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">STEP 1</h2>
		<h2 class="prog-head ">Upload Photos</h2>
		
		<!--- mobile heaindgs section end here -->

		<p class="prog-txt mobile-pro-text">Please upload <span>the minimum required photos</span> of your costume in front, back and side view. Listings with more photos sell faster! Don't forget to include any acessories!</p>
		
		<!--- mobile heaindgs section end here -->
		<div class="threeblogs">
		<div class="col-md-3 col-sm-3 col-xs-12 upload_hint ">
			<p><span class="up_tip">Tip</span> Respect your costume’s  integrity with crisp, clear photos. Placing them in settings that correspond with their theme can encourage a sale.</p>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12 ">
		<h4>01.Front View</h4>
		<div class=" up-blog">
			<input type="file" name="file1" id="file1">
		</div>
<span id="file1_error" style="color:red"></span>

			</div>
			<div class="col-md-3 col-sm-3 col-xs-12 ">
			<h4>02.Back View</h4>
			<div class=" up-blog">
			<input type="file" name="file2" id="file2">
			
		</div>
<span id="file2_error" style="color:red"></span>

			</div>
			<div class="col-md-3 col-sm-3 col-xs-12 ">
			<h4>03.Detail/Accessories</h4>
			<div class=" up-blog">
			<input type="file" name="file3" id="file3">
		</div>
<span id="file3_error" style="color:red"></span>

			</div>
		
			</div>
				<div class=" up_btns_tl col-md-12 col-sm-12 col-xs-12">
				
				<!-- <form> -->
				<span id="fileselector">
					<label class="btn btn-default upload_more_btn" for="upload-file-selector">
						<input id="upload-file-selector" type="file" name="file4[]" multiple>
						<i class="fa_icon icon-upload-alt margin-correction"></i> <i class="fa fa-plus" aria-hidden="true"></i> Upload More
					</label>
				</span>
			<!-- </form> -->
					</div>
					<div class=" up_btns_tl col-md-12 col-sm-12 col-xs-12">
				<a type="button" id="upload_next" class=" upload_sub_btn btn btn-default">Next Step</a>
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
  <p class="slt_act_all">Select all that apply</p>
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
 <p class="slt_act_all">Select all that apply</p>
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
 <p class="slt_act_all">Select all that apply</p>
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
</div>

<!--costume three code starts here-->



<!--costume three code ends here-->
</div>
</div>
<div class="form-rms-btn">
<a type="button" id="costume_description_back" class="btn-rm-back"><span>Back</span></a>

<!-- </form> -->
<a type="button" id="costume_description_next" class="btn-rm-nxt">Next Step</a>
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
<option value="{{$shipping->optionid}}">{{$shipping->value}}</option>
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
<div class="form-rms">
<p class="form-rms-que">04. Service</p>
<p class="form-rms-input">
<select id="service" name="service">
<option value="">Select Service</option>
@foreach($service as $index=>$service)
<option value="{{$service->optionid}}" name="service">{{$service->value}}</option>
@endforeach
</select>
</p>
<span id="serviceerror" style="color:red"></span>

<p class="form-rms-small1">Estimated Shipping Cost: $6.80 - $12.40 (varies by buyer's location)</p>
<p class="cst2-rms-chck"><input id="free_shipping" type="checkbox"> Offer free shipping</p>
</div>

</div>
</div>
<div class="form-rms-btn">
<a type="button" id="pricing_back" class="btn-rm-back"><span>Back</span></a>

<a type="button" id="pricing_next" class="btn-rm-nxt">Next Step</a>
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
<p class="ct3-rms-text">By Choosing to donate, I agree and accept Chrysalis Terms & Conditions.</p>
<p class="ct3-rms-head">Donation Amount</p>
<div class="form-rms-input">
<p class="form-rms-rel1"><select class="cst2-select80" id="donate_charity" name="donate_charity"><option value="">Donate Amount</option><option>10%</option><option>20%</option><option>30%</option></select></p>
<p class="cst3-textl2"><i class="fa fa-usd" aria-hidden="true"></i>5.90</p>
<span id="donate_charityerror" style="color:red"></span>
</div>
<p class="ct3-rms-head">Donate to</p>
<ul class="ct3-list">
@foreach($charities as $index=>$charity)
<li><img src="@if(isset($charity->image) && !empty($charity->image)){{URL::asset('/charities_images/')}}/{{$charity->image}} @else {{ URL::asset('/img/default.png')}} @endif" alt="{{$charity->name}}" /><input type="radio" id="{{$charity->name}}" value="{{$charity->id}}" name="charity_name" /></li>
@endforeach
</ul>
<span id="charity_nameerror" style="color:red"></span>

<p class="cst2-rms-chck"><input type="checkbox" id="another_charity" name="another_charity"> I would like to suggest another charity organization</p>
</div>

<div class="form-rms">
<p class="ct3-rms-head chartiy_spcy">Please Specify:</p>
<p class="form-rms-input org_nme"><input type="text"  name="organzation_name" id="organzation_name" autocomplete="off" placeholder="Organization Name"  class="form-control"></p>
<span id="organzation_nameerror" style="color:red"></span>

</div>





<div class="form-rms-btn">
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
					$.each(data, function(index, element) {
						model.append("<option value='"+ element.subcategoryid +"'>" + element.subcategoryname + "</option>");
			        });
        });
    
});
$(document).ready(function()
{
	//numeric condition
	$("#height-ft,#height-in,#weight-lbs,#chest-in,#waist-lbs,#Length,#Width,#Height").on("keyup", function(){
        var valid = /^\d{0,3}(\.\d{0,3})?$/.test(this.value),
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
			$('#costumename_error').html('Enter Costume Name');
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
			$('#categoryerror').html('Select Category');
			str=false;
		}
		if(gender==''){
			$('#gender').css('border','1px solid red');
			$('#gendererror').html('Select Gender');
			str=false;
		}
		if(size==''){
			$('#size').css('border','1px solid red');
			$('#sizeerror').html('Select Size');
			str=false;
		}
		if(subcategory==''){
			$('#subcategory').css('border','1px solid red');
			$('#subcategoryerror').html('Select Subcategory');
			str=false;
		}
		if(description==""){
			$('#description').css('border','1px solid red');
			$('#descriptionerror').html('Enter Costume Description');
			str=false;
		}
		if(funfact=='')
		{
			$('#funfacts').css('border','1px solid red');
			$('#facterror').html('Enter FunFact');
			str=false;
		}
		if(faq==""){
			$('#faq').css('border','1px solid red');
			$('#faqerror').html('Enter Faq');
			str=false;
		}
		if($('input[name=condition]:checked').length<=0){
			$('#costumeconditionerror').html('Select Costume Condition');
			str=false;
			
		}
		if($('input[name=fimquality]:checked').length<=0){
			$('#qualityerror').html('Select Costume Fit For Film Quality OR Not');
			str=false;
			
		}
		if($('input[name=make_costume]:checked').length<=0){
			$('#usercostumeerror').html('Select User Make The Costume Or Not');
			str=false;
			
		}
		if($('input[name=activity]:checked').length<=0)
		{
			$('#activityerror').html('Select Is The Costume Used For An Activity Or Not');
			str=false;
			
		}
		if($('input[name=cosplay]:checked').length<=0){
			$('#cosplayerror').html('Select Is The Costume Used For Cosplay Or Not');
			str=false;
			
		}
		if ($('input[name=cosplay]:checked').val() == 7) {
			if ($('input[name=cosplayplay_yes_opt]:checked').length<=0) {

			$('#cosplay_yeserror').html('Select Is The Cosplay Option');
			str=false;
			}
		}
		if ($('input[name=fashion]:checked').val() == 9) {
			if ($('input[name=uniquefashion_yes_opt]:checked').length<=0) {

			$('#uniquefashion_yeserror').html('Select Is The Fashion Option');
			str=false;
			}
		}
		if ($('input[name=activity]:checked').val() == 11) {
			if ($('input[name=activity_yes_opt]:checked').length<=0) {

			$('#activity_yeserror').html('Select Is The Activity Option');
			str=false;
			}
		}
		if ($('input[name=make_costume1]:checked').val() == 30) {

			$('#usercostumeerror').html('Enter time');
			str=false;
			
		}
		if($('input[name=fashion]:checked').length<=0){
			$('#uniquefashionerror').html('Select Is The Costume Used For Uniquefashion Or Not');
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
			$('#priceerror').html('Enter Price');
			str=false;
		}
		/*if (quantity == "") {
			$('#quantity').css('border','1px solid red');
			$('#quantityerror').html('Select Quantity');
			str=false;
		}*/
		if (shipping == "") {
			$('#shipping').css('border','1px solid red');
			$('#shippingerror').html('Select Shipping');
			str=false;
		}
		if (packageditems == "") {
			$('#packageditems').css('border','1px solid red');
			$('#packageditemserror').html('Select Weight Of Packaged Item');
			str=false;
		}
		if (Length == "" && Height == "" && Width == "") {
			$('#Length').css('border','1px solid red');
			$('#Height').css('border','1px solid red');
			$('#Width').css('border','1px solid red');
			$('#dimensionserror').html('Enter Length,Width,Height.');
			str=false;
		}
		if (type == "") {
			$('#type').css('border','1px solid red');
			$('#typeserror').html('Select Type');
			str=false;
		}
		if (service == "") {
			$('#service').css('border','1px solid red');
			$('#serviceerror').html('Select Service');
			str=false;
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
		$('#pricing_div').css('display','block');
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
			$('#item_locationerror').html('Enter Item Location');
			str=false;
		}
		if (handlingtime == "") {
			$('#handlingtime').css('border','1px solid red');
			$('#handlingtimeerror').html('Select Handling Time');
			str=false;
		}
		if (returnpolicy == "") {
			$('#returnpolicy').css('border','1px solid red');
			$('#returnpolicyerror').html('Select Return Policy');
			str=false;
		}
		if (donate_charity == "") {
			$('#donate_charity').css('border','1px solid red');
			$('#donate_charityerror').html('Select Donate Amount');
			str=false;
		}
		if($('input[name=charity_name]:checked').length<=0){
			$('#charity_name').css('border','1px solid red');
			$('#charity_nameerror').html('Select Donate to');
			str=false;
			
		}
		if (atLeastOneIsChecked == true) {
			$('#organzation_name').css('border','1px solid red');
			$('#organzation_nameerror').html('Enter Organization Name');
			str=false;
			if (organzation_name != '') {
				$('#organzation_name').css('border','');
			$('#organzation_nameerror').html('');
				str = true;
			}
		}
		if (str == true) {
			$.ajax({
			 url: "{{URL::to('costume/costumecreate')}}",
			 type: "POST",
			 data: new FormData($('#costume_total_form')[0]),
			 contentType:false,
			 cache: false,
			 processData: false,
			 success: function(data){
			 	if (data == "success") {
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
	

    </script> 
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD7L6zG6Z8ws4mRa1l2eAhVPDViUX6id0&libraries=places&callback=initAutocomplete"
        async defer></script>
@stop

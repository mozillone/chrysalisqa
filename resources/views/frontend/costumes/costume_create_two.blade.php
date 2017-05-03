@extends('/frontend/app')
@section('styles')
   <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
 @endsection
@section('content')
 	<section class="content create_section_page">
 	<div id="ohsnap"></div>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chrysalis</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- css links Start -->
<link href="css/styles.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet"> 
<!--<link href="https://fonts.googleapis.com/css?family=Karla|Lato:300,400,700,900|Open+Sans:300,400,600,700" rel="stylesheet">-->
	
<!-- Script links Start -->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
</head>
<body>


<div class="container">
<div class="row">
<div class="col-md-12">
	
<!--- progressbar section starts -->
<div class="progressbar_main">
<h2>UPLOAD A COSTUME</h2>
<ul id="progressbar" class="progressbar_rm">  
	 <li class="active"><span class="s-head">Step 1</span> <span>Upload <br/>Photos</span></li> 
	 <li class="active"><span class="s-head">Step 2</span> <span>Fill in Costume <br/>Description</span></li>
     <li><span class="s-head">Step 3</span> <span>Pricing & <br/>Shipping</span></li>
     <li><span class="s-head">Step 4</span> <span>Review <br/>Preferences</span></li>	 
     </ul>
</div>	
<!--Create costume image code starts here-->
<p class="prog-txt">Please upload the  <span>the minimum required photos</span> of your costume in front,back and side view. Listings with more photos sell faster! Don't forget to include any acessories!</p>
	<div class="upload-photo-blogs">
		<h2 class="prog-head">Upload Photos</h2>
		<div class="threeblogs">
		<div class="col-md-3 col-sm-3 col-xs-12 upload_hint ">
			<p>Tip Respect your costume’s  integrity with crisp, clear photos.Placing them in settings that correspond with their theme can encourage a sale.</p>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12 ">
		<h4>01.Front View</h4>
		<div class=" up-blog">
			
		</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12 ">
			<h4>02.Back View</h4>
			<div class=" up-blog">
			
		</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12 ">
			<h4>03.Detail/Accessories</h4>
			<div class=" up-blog">
			
		</div>
			</div>
		
			</div>
				<div class=" up_btns_tl col-md-12 col-sm-12 col-xs-12">
				
				<form>
				<span id="fileselector">
					<label class="btn btn-default upload_more_btn" for="upload-file-selector">
						<input id="upload-file-selector" type="file">
						<i class="fa_icon icon-upload-alt margin-correction"></i> <i class="fa fa-plus" aria-hidden="true"></i> Up load More
					</label>
				</span>
			</form>
					</div>
						
			</div>
	 
<!--- progressbar section End -->
<!--Second div code starts here-->

<p class="prog-txt">please fill in the following fields  <span>as accurate as possible</span> to prevent disputes.</p>
<h2 class="prog-head">Costume Description</h2>
</div>
<div>
<form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="createcostumetwo" id="createcostumetwo" method="post">	

<div class="prog-form-rm">
<div class="col-md-6">
<!--costume name code starts here-->
<div class="form-rms">
<p class="form-rms-que">01. Name Your Costume!*</p>
<p class="form-rms-input"><input type="text" name="costume_name" id="costume_name" autocomplete="off" tab-index="1" placeholder=""></p>
<span id="costumename_error" style="color:red"></span>
<p class="form-rms-small"><span>Give Your listing a descriptive title</span> <br/>Example: "Men's Medium Spiderman<br/>Costume in Red</p>
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
<option value="1sz">1sz</option>
<option value="xxs">xxs</option>
<option value="xs">xs</option>
<option value="xs">s</option>
<option value="m">m</option>
<option value="l">l</option>
<option value="xl">xl</option>
<option value="xxl">xxl</option>
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
<p class="form-rms-que">06. Condition</p>
<p class="form-rms-input">
<span class="full-rms"><input type="radio" name="condition" id="excellent"> Excellent</span>
 <span class="full-rms"><input type="radio" name="condition" id="brandnew"> Brand New</span> 
 <span class="full-rms"><input type="radio" name="condition" id="good"> Good</span>
  <span class="full-rms"><input type="radio" name="condition" id="likenew"> Like New</span>
 </p>
 <span id="costumeconditionerror" style="color:red"></span>
</div>


<div class="form-rms">
<p class="form-rms-que">07. {{$bodyanddimensions->label}}*</p>
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
<p class="form-rms-dim"><?php echo $heading_weight_value; ?> <br/> <span class="form-rms-he1"><input type="text" name="{{$body_weight_lbs->value}}" id="{{$body_weight_lbs->value}}"> <span><?php echo $heading_weight_value_lbs;?></span></span></p>
<p class="form-rms-dim"><?php echo $heading_chest_value; ?> <br/> <span class="form-rms-he1"><input type="text" name="{{$body_chest_in->value}}" id="{{$body_chest_in->value}}" > <span><?php echo $heading_chest_value_in; ?> </span></span></p>
<p class="form-rms-dim"><?php echo $heading_waist_value; ?> <br/> <span class="form-rms-he1"><input type="text" name="{{$body_waist_lbs->value}}" id="{{$body_waist_lbs->value}}"> <span><?php echo $heading_waist_value_lbs; ?></span></span></p>
<span id="bodydimensionerror"  style="color:red"></span>
</div>
</div>


<div class="form-rms">
<p class="form-rms-que">08. {{$cosplayone->label}}*</p>
<p class="form-rms-input">
@foreach($cosplayone_values as $index=>$cosplayone_val)
<span class="full-rms"><input type="{{$cosplayone->type}}" name="{{$cosplayone->code}}" id="{{$cosplayone_val->optionid}}" value="{{$cosplayone_val->optionid}}"> {{$cosplayone_val->value}}</span>
@endforeach
</p>
<span id="cosplayerror" style="color:red"></span>
</div>

<div class="form-rms">
<p class="form-rms-que">09. {{$cosplaytwo->label}}*</p>
<p class="form-rms-input">
@foreach($cosplaytwo_values as $index=>$cosplaytwo_val)
<span class="full-rms"><input type="{{$cosplaytwo->type}}" name="{{$cosplaytwo->code}}" id="{{$cosplaytwo_val->optionid}}" value="{{$cosplaytwo_val->optionid}}"> {{$cosplaytwo_val->value}}</span>
@endforeach
</p>
<span id="uniquefashionerror" style="color:red"></span>
</div>

</div>

<div class="col-md-6">

<div class="form-rms">
<p class="form-rms-que">10. {{$cosplaythree->label}}*</p>
<p class="form-rms-input">
@foreach($cosplaythree_values as $index=>$cosplaythree_val)
<span class="full-rms"><input type="{{$cosplaythree->type}}" name="{{$cosplaythree->code}}" id="{{$cosplaythree_val->optionid}}" value="{{$cosplaythree_val->optionid}}"> {{$cosplaythree_val->value}}</span>
@endforeach
</p>
<span id="activityerror" style="color:red">
</div>

<div class="form-rms">
<p class="form-rms-que">11. {{$cosplayfour->label}}*</p>
<p class="form-rms-input">
@foreach($cosplayfour_values as $index=>$cosplayfour_val)
<span class="full-rms"><input type="{{$cosplayfour->type}}" name="{{$cosplayfour->code}}" id="{{$cosplayfour_val->optionid}}" value="{{$cosplayfour_val->optionid}}"> {{$cosplayfour_val->value}}</span>
@endforeach


<p class="form-rms-small" id="mention_hours" >If Yes,how long did it take?</p>
<p class="ct1-rms-rel" id="mention_hours_input" style="display:none"><input type="text" name="make-costume-time" class="input-rm100"> <span>hours<span>
</p>
<span id="usercostumeerror" style="color:red">

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
<p class="form-rms-que form-rms-que1"><span>13. Describe Your Costume:</span> Including Accessories*</p>
<p class="form-rms-input"><textarea placeholder="please be as detailed as possible!" name="description" id="description"></textarea></p>
<span id="descriptionerror" style="color:red"></span>
<p class="form-rms-sm1">(xxx max characters)</p>
</div>

<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>14. Fun Fact:</span> A little backstory to your costume and the adventures it has experienced*</p>
<p class="form-rms-input"><textarea placeholder="please be as detailed as possible!" name="funfcats" id="funfacts"></textarea></p>
<span id="facterror" style="color:red"></span>
<p class="form-rms-sm1">(xxx max characters)</p>
</div>

<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>15. FAQ</span>Create your own costume Frequently Asked Questions to avoid an overload of questions in your inbox!*</p>
<p class="form-rms-input"><textarea placeholder="please be as detailed as possible!" name="faq" id="faq"></textarea></p>
<span id="faqerror" style="color:red"></span>
<p class="form-rms-sm1">(xxx max characters)</p>
</div>

<!--costume three code starts here-->



<!--costume three code ends here-->
<p class="prog-txt">Please fill in the following field <span>as accurately</span> as you can.</p>
</div>
</div>
<div class="prog-form-rm">
<div class="col-md-6">
<h2 class="prog-head">Pricing</h2>
<div class="form-rms">
<p class="form-rms-que">01. Price</p>
<div class="form-rms-input">
<p class="form-rms-rel"><input type="text" class="input-rm100" name="price" id="price" value="$"><span class="form-rms-abs"><i class="fa fa-usd" aria-hidden="true"></i></span></p>
<p class="cst2-textl2">Not Sure? <i class="fa fa-info-circle" aria-hidden="true"></i></p></div>

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


<div class="form-rms">
<p class="form-rms-que">03. Shipping Option <i class="fa fa-info-circle" aria-hidden="true"></i></p>
<p class="form-rms-input"><select name="shipping" id="shipping">
<option value="">Select Shipping Options</option>
@foreach($shippingoptions as $index=>$shipping)
<option value="{{$shipping->optionid}}">{{$shipping->value}}</option>
@endforeach

</select></p>
</div>




</div>

<div class="col-md-6">
<h2 class="prog-head">Package Information</h2>
<div class="form-rms">
<p class="form-rms-que">01. Weight Of Packaged Item</p>
<p class="form-rms-input">
<select name="packageditems" id="packageditems" >
<option value="">Select Weight Of Packaged Item</option>
@foreach($packageditems as $index=>$packageitems)
<option value="{{$packageitems->optionid}}">{{$packageitems->value}}</option>
@endforeach
</select>
</p>
</div>

<div class="form-rms">
<p class="form-rms-que">02. Lorem Ipsum is simply dummy</p>
<div class="form-rms-input">
@foreach($dimensions as $index=>$dimensions)
<?php
$value=$dimensions->value;
$headingexplode=explode('-',$value);
$heading=$headingexplode[0];
$heading_value=$headingexplode[1];
?>
<p class="form-rms-dim"><?php echo ucfirst($heading); ?> <br/> <span class="form-rms-he1"><input type="text"> <span><?php echo $heading_value; ?> x</span></span></p>
@endforeach
</div>
</div>

<div class="form-rms">
<p class="form-rms-que">03. Type</p>
<p class="form-rms-input">
<select>
<option value="">Select Type</option>
@foreach($type as $index=>$type)
<option value="{{$type->optionid}}">{{$type->value}}</option>
@endforeach
</select>
</p>

</div>
<div class="form-rms">
<p class="form-rms-que">04. Service</p>
<p class="form-rms-input">
<select>
<option value="">Select Service</option>
@foreach($service as $index=>$service)
<option value="{{$service->optionid}}">{{$service->value}}</option>
@endforeach
</select>
</p>
<p class="form-rms-small1">Estimated Shipping Cost:$6.80 -$12.40(varies by buyer's location)</p>
<p class="cst2-rms-chck"><input type="checkbox"> Offer free shipping</p>
</div>



</div>
<p class="prog-txt">Lorem Ipsum is simply dummy text of <span>the printing and typesetting</span> industry.</p>
<h2 class="prog-head">Review Your Preferences</h2>
<div class="prog-form-rm">
<div class="col-md-6">

<div class="form-rms">
<p class="form-rms-que">01. Item Location</p>
<p class="form-rms-input"><input type="text"></p>
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
</div>

</div>

<div class="col-md-6">
<div class="form-rms">
<p class="form-rms-que form-rms-que1">04. Donate a Portion to Charity</p>
<p class="ct3-rms-text">Chrysalis Charges a 3% transaction fee on sale of every costume.However,if you donate 5% or more of your sale to a charity we will waive our transcation fee to match your contribution</p>
<p class="ct3-rms-text">By Choosing to donate,I agree and accept Chrysalis Terms & Conditions.</p>
<p class="ct3-rms-head">Donation Amount</p>
<div class="form-rms-input">
<p class="form-rms-rel1"><select class="cst2-select80"><option>10%</option><option>20%</option><option>30%</option></select></p>
<p class="cst3-textl2"><i class="fa fa-usd" aria-hidden="true"></i>5.90</p></div>
<p class="ct3-rms-head">Donate to</p>
<ul class="ct3-list">
@foreach($charities as $index=>$charity)
<li><img src="images/cst3.png" alt="{{$charity->name}}" /><input type="radio" name="{{$charity->name}}" /></li>
@endforeach
</ul>
<p class="cst2-rms-chck"><input type="checkbox"> I would like to suggest another charity organization</p>
</div>

<div class="form-rms">
<p class="ct3-rms-head">Please Specify:</p>
<p class="form-rms-input"><input type="text"  name="organzation_name" id="organzation_name" autocomplete="off" placeholder="Organization Name"></p>
</div>





<div class="form-rms-btn">
<button type="button" class="btn-rm-nxt">I'm Finished!</button>
<button type="button" class="btn-rm-back"><span>Back</span></button>
</div>
</div>
</div>
</div>
</div>	
</div>	
	</form>
<!---Second div code ends here-->
	
	</body>
</html>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<!--<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<script src="{{ asset('/js/ohsnap.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/jPages.js') }}"></script>

<script type="text/javascript">
	
	$('#createcostumetwo').on('submit',function(a){
		a.preventDefault();
		str=true;
		alert();
		$('#costume_name,#categoryname,#gender,#size,#description,#funfcats,#faq,#height-ft,#height-in,#weight-lbs,#chest-in,#waist-lbs').css('border','');
		$('#costumename_error,#categoryerror,#gendererror,#sizeerror,#uniquefashionerror,#cosplayerror,#costumeconditionerror,#descriptionerror,#facterror,#faqerror,#activityerror,#bodydimensionerror,#qualityerror,#usercostumeerror').html('');
		var costumename=$('#costume_name').val();
		var category=$('#categoryname').val();
		var gender=$('#gender').val();
		var size=$('#size').val();
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
		if(document.getElementById('7').checked){
			cosplay = document.getElementById('7').value;
		}
		if(document.getElementById('8').checked){
			cosplay = document.getElementById('8').value;
		}
		if(document.getElementById('9').checked){
			uniquefashion = document.getElementById('9').value;
		}
		if(document.getElementById('10').checked){
			uniquefashion = document.getElementById('10').value;
		}
		
		if(document.getElementById('11').checked){
			qualitycostume = document.getElementById('11').value;
		}
		if(document.getElementById('12').checked){
			qualitycostume = document.getElementById('12').value;
		}
		if(document.getElementById('32').checked){
			qualitycostume = document.getElementById('32').value;
		}
		if(document.getElementById('33').checked){
			qualitycostume = document.getElementById('33').value;
		}
		if(document.getElementById('30').checked){
			usercostume = document.getElementById('30').value;
		}
		if(document.getElementById('31').checked){
			usercostume = document.getElementById('31').value;
		}
		
		if(document.getElementById('excellent').checked){
			costumecondition = document.getElementById('excellent').value;
		}
		if(document.getElementById('brandnew').checked){
			costumecondition = document.getElementById('brandnew').value;
		}
		if (document.getElementById('good').checked) {
			costumecondition = document.getElementById('good').value;
        }
	   if(document.getElementById('likenew').checked) {
			costumecondition = document.getElementById('likenew').value;
		}
		if(costumename==''){
			$('#costume_name').css('border','1px solid red');
			$('#costumename_error').html('Enter Costume Name');
			str=false;
		}
		if(heightft==''){
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
		}
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
		if(costumecondition == "" | costumecondition == null ){
			$('#costumeconditionerror').html('Select Costume Condition');
			str=false;
			
		}
		if(qualitycostume == "" | qualitycostume == null ){
			$('#qualityerror').html('Select Costume Fit For Film Quality OR Not');
			str=false;
			
		}
		if(usercostume == "" | usercostume == null ){
			$('#usercostumeerror').html('Select User Make The Costume Or Not');
			str=false;
			
		}
		if(activity == "" | activity == null )
		{
			$('#activityerror').html('Select Is The Costume Used For An Activity Or Not');
			str=false;
			
		}
		if(cosplay == "" | cosplay == null ){
			$('#cosplayerror').html('Select Is The Costume Used For Cosplay Or Not');
			str=false;
			
		}	
		if(uniquefashion == "" | activity == null ){
			$('#uniquefashionerror').html('Select Is The Costume Used For Uniquefashion Or Not');
			str=false;
		}
		return str;
	});
	</script>
	<!--Getting subcategory list by oonchange-->
	 <script type="text/javascript">
$('#categoryname').on('change',function(){
	
    var id=$(this).val();//catgeory id
	alert(id);
	 $.get("{{ url('/costume/ajaxSubcategory')}}", //This is the url defined in routes 
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
</script> 
@stop

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
<link href="https://fonts.googleapis.com/css?family=Karla|Lato:300,400,700,900|Open+Sans:300,400,600,700" rel="stylesheet">
	
<!-- Script links Start -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
     <li class="active"><span class="s-head">Step 3</span> <span>Pricing & <br/>Shipping</span></li>
     <li><span class="s-head">Step 4</span> <span>Review <br/>Preferences</span></li>	 
     </ul>
</div>	

	 
<!--- progressbar section End -->

<p class="prog-txt">Please fill in the following field <span>as accurately</span> as you can.</p>
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


<div class="form-rms-btn">
<button type="button" class="btn-rm-nxt">Next Step</button>
<button type="button" class="btn-rm-back"><span>Back</span></button>
</div>
</div>
</div>

</div>	
</div>	
	
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

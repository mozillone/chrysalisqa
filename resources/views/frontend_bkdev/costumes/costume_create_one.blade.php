@extends('/frontend/app')
@section('styles')
   <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/pages/costumes_list.css')}}">
 @endsection
@section('content')
 	<section class="content create_section_page">
 	<div id="ohsnap"></div>


<div class="container">
<div class="row">
<div class="col-md-12">
<!--- progressbar section starts -->
<div class="progressbar_main">
<h2>UPLOAD A COSTUME</h2>
<ul id="progressbar" class="progressbar_rm">  
	 <li class="active"><span class="s-head">Step 1</span> <span>Upload <br/>Photos</span></li> 
	 <li class=""><span class="s-head">Step 2</span> <span>Fill in Costume <br/>Description</span></li>
     <li class=""><span class="s-head">Step 3</span> <span>Pricing & <br/>Shipping</span></li>
     <li class=""><span class="s-head">Step 4</span> <span>Review <br/>Preferences</span></li>	 
     </ul>
</div>	

	 
<!--- progressbar section End -->

<p class="prog-txt">Please upload the  <span>the minimum required photos</span> of your costume in front,back and side view. Listings with more photos sell faster! Don't forget to include any acessories!</p>
	<div class="upload-photo-blogs step-one-sec">
		<h2 class="prog-head">Upload Photos</h2>
		<div class="threeblogs">
		<div class="col-md-3 col-sm-3 col-xs-12 upload_hint hidden-xs ">
			<p><span class="up_tip">Tip</span> Respect your costume’s  integrity with crisp, clear photos.Placing them in settings that correspond with their theme can encourage a sale.</p>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12 ">
		<h4>01.Front View</h4>
		<div class=" up-blog">
			
		</div>
			</div>
	<div class="hidden-lg hidden-md col-sm-4 col-xs-12 upload_hint ">
			<p>Tip Respect your costume’s  integrity with crisp, clear photos.Placing them in settings that correspond with their theme can encourage a sale.</p>
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
						<i class="fa_icon icon-upload-alt margin-correction"></i> <i class="fa fa-plus" aria-hidden="true"></i> Upload More
					</label>
				</span>
			</form>
					</div>
						<div class=" up_btns_tl col-md-12 col-sm-12 col-xs-12">
				<a href="#" class=" upload_sub_btn btn btn-default">Next Step</a>
			</div>
			</div>
	</div>	
</div>	



</div>	
</div>	
	

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
</script> 
@stop
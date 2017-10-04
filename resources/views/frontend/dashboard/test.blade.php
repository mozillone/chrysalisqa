<form method="POST" id="costume_total_form" action="{{route('test')}}">
<div id="costume_description">

<p class="prog-txt desk-pro-text">Please fill in the following fields  <span>as accurately as possible</span> to prevent disputes.</p>
<h2 class="prog-stepss  hidden-md hidden-lg hidden-sm">step 2</h2>
<h2 class="prog-head">Costume Description</h2>
<p class="prog-txt mobile-pro-text">Please fill in the following fields  <span>as accurately as possible</span> to prevent disputes.</p>
<!-- <form enctype="multipart/form-data" role="form" class="validation" novalidate="novalidate"  name="costume_description_form" id="costume_description_form" method="post"> -->	

<div class="prog-form-rm">
<div class="col-md-6 cret_ctme_1">
<!--costume name code starts here-->
<div class="form-rms">
<p class="form-rms-que">01. Name Your Costume!*</p>
<p class="form-rms-input"><input type="text" name="costume_name" id="costume_name" autocomplete="off" tab-index="1" placeholder=""></p>
<span id="costumename_error" style="color:red"></span>
<p class="form-rms-small"><span>Give Your listing a descriptive title.</span> <br/>Example: "Men's Medium Spiderman<br/>Costume in Red"</p>
</div>
<!--costume name ends starts here-->
<!--Catgeory code starts here-->

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
<span class="full-rms"><input type="radio" name="condition" value="excellent" id="excellent"> <label for="excellent">Excellent</label></span>
 <span class="full-rms"><input type="radio" name="condition" value="brand_new" id="brand_new"> <label for="brand_new">Brand New</label></span> 
 <span class="full-rms"><input type="radio" name="condition" value="good" id="good"> <label for="good">Good</label></span>
  <span class="full-rms"><input type="radio" name="condition" value="like_new" id="like_new"> <label for="like_new">Like New</label></span>
 </p>
 <span id="costumeconditionerror" style="color:red"></span>
</div>









</div>

<div class="col-md-6">






<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>13. </span>How would you describe your costume?</p>
<p>Please enter a maximum of <strong>10</strong> keywords to describe the catgories in which your costume could belong tp.</p>
<p>Tip:Have a speciailty costume? To increase your changes of making a sale, input the approprite keywords with our existing <span>list of categories.</span> </p>
<p class="form-rms-input"><input type="text" id="keywords_tag">
<a href="javascript:void(0);" id="keywords_add">ADD</a>
<div id="div">
</div>
<div id="count">10 left</div>
<span id="faqerror" style="color:red"></span>

</div>
<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>14. Describe your Costume:</span> Including accessories*</p>
<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="description" id="description" maxlength="600" ></textarea></p>

<span id="descriptionerror" style="color:red"></span>
<p class="form-rms-sm1">( <span id="max_length_char1"></span> 600 characters)</p>
</div>

<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>15. Fun Fact:</span> A little backstory to your costume and the adventures it has experienced*</p>
<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="funfcats" id="funfacts" maxlength="600" ></textarea></p>
<span id="facterror" style="color:red"></span>
<p class="form-rms-sm1">( <span id="max_length_char2"></span> 600 characters)</p>
</div>

<div class="form-rms">
<p class="form-rms-que form-rms-que1"><span>16. FAQ </span>Create your own costume Frequently Asked Questions to avoid an overload of questions in your inbox!*</p>
<p class="form-rms-input"><textarea placeholder="Please be as detailed as possible!" name="faq" id="faq" maxlength="600" ></textarea></p>
<span id="faqerror" style="color:red"></span>
<p class="form-rms-sm1">( <span id="max_length_char3"></span> 600 characters)</p>
<div class="form-rms-btn">

</div>
</div>


<!--costume three code starts here-->



<!--costume three code ends here-->
</div>
</div>

</div>

<a type="button" id="preferences_finished" class="btn-rm-nxt">I'm Finished!</a>
</form>
<script src="http://chrysalis.local.com/js/jquery-2.2.4.js"></script>

<script type="text/javascript">
$("#keywords_add").click(function(){
	var val = $('#keywords_tag').val();
	var div_cont= $('#count').html().split(' ');
	var total =div_cont[0];
	if (total > 0) {
		if (val.indexOf(',') !== -1) { 
			var segments = val.split(',');
			var count=segments.length;
			$('#count').html(total-count+ " left");
			if (total == 1) {
				var hashtag = '#'+segments[0];
				$('#div').append('<p class="p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
				$('<input>').attr({
					id:'input_'+total+'',
				    type: 'hidden',
				    name: 'bar[]',
				    value:''+hashtag+''
				}).appendTo('#div');
				$('#keywords_tag').prop('value','');
				$('#count').html(total-1+ " left");
			}else{
				$.each(segments,function(i){
				var hashtag = '#'+segments[i];
				$('#div').append('<p class="p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
				$('<input>').attr({
					id:'input_'+total+'',
				    type: 'hidden',
				    name: 'bar[]',
				    value:''+hashtag+''
				}).appendTo('#div');
				$('#keywords_tag').prop('value','');
				total--;
				});
			}
		}else{
			var hashtag = '#'+val;
			$('#div').append('<p class="p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
			$('<input>').attr({
				id:'input_'+total+'',
			    type: 'hidden',
			    name: 'bar[]',
			    value:''+hashtag+''
			}).appendTo('#div');
			$('#keywords_tag').prop('value','');
			$('#count').html(total-1+ " left");
		}
	}else{
		$('#keywords_add').hide();
	}
	});



	$(document).on('click', '[id^="remove_"]', function(e){
		e.preventDefault();
		var this_id = $(this).attr('id');
		var split   = this_id.split('_');
		var target = $(e.target).closest( ".p_"+split[1]+"" ).remove();

		var target = $("#input_"+split[1]+"").remove();
		var div_cont= $('#count').html().split(' ');
		var total = div_cont[0];
		$('#count').html(+total+1 + " left");
		if (total == 0) {
			$('#keywords_add').show();
		}
	});

	$('#preferences_finished').click(function(){
		$.ajax({
       url: "{{route('test')}}",
       type: "POST",
       data: new FormData($('#costume_total_form')[0]),
       contentType:false,
       cache: false,
       processData: false,
       success: function(data){
        if (data == "success") {
          
        }
       }});
	});

</script>
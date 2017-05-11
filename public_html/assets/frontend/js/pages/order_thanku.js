$(document).ready(function() {

  	$("#order-charity").validate({
  			ignore: ":hidden",
            rules: {
                suggest_charity:{
                        required: true,
                        maxlength:100
                    },

           }
 	
        });
	//$("input[name='charity']").rules("add", {required:true});
	//$("#suggest_charity").rules("add", {required:true});
	
	$('#suggest_charity').change(function(){
		if($(this).is(":checked")){
			$("#charity").remove("remove");
			$('.thankyou-rms').removeClass('hide');
		}else{
			$("#charity").rules("add", {required:true});
			$('.thankyou-rms').addClass('hide');
		}
	})
	$(document).on('change','#charity',function(){
		$('#suggest_charity').prop('checked',false);
		$('.thankyou-rms').addClass('hide');
	})

})
$(document).ready(function() {
  		var order_harity=$("#order-charity").validate();
	$("#charity").rules("add", {required:true});
	$('#suggest_charity').change(function(){
		$('label.error').remove();
		$("#charity").rules("remove");
		$("#suggest_charity").rules("add", {required:true});
		if($(this).is(":checked")){
			$('.thankyou-rms').removeClass('hide');
		}else{
			$("#charity").rules("add", {required:true});
			$('.thankyou-rms').addClass('hide');
		}
	})
})
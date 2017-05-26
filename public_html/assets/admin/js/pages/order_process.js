$(function(){
        $("#order_status").validate({
			rules: {
				status_id:{
					 	required: true,
					},
	   			comment:{
	   				 	required: true,
						maxlength: 255,
	   			},
				
			},
			errorElement : 'div',
			errorLabelContainer: '.errorTxt',
	});
        $("#order_transaction").validate({
			rules: {
				transaction_amount:{
					 	required: true,
					 	number:true,
					 	maxlength:10,
					},
	   			comment:{
	   				 	required: true,
						maxlength: 255,
	   			},
				
			},
			errorElement : 'div',
			errorLabelContainer: '.errorTxt',
	})
     $("#shipping_process").validate({
			rules: {
				weight:{
					 	required: true,
					 	number:true,
					 	maxlength:10,
					},
				method:{
					 	required: true,
					}
				
			},
			errorElement : 'div',
			errorLabelContainer: '.errorTxt',
	})
     $("#shipping_address").validate({
			rules: {
				status_id:{
					 	required: true,
					},
	   			comment:{
	   				 	required: true,
						maxlength: 255,
	   			},
				
			},
			errorElement : 'div',
			errorLabelContainer: '.errorTxt',
	});

  	var shipping_address=$("#shipping_address").validate({ignore: ":hidden" });
	var billing_address=$("#billing_address").validate({ignore: ":hidden" });
	
    $("#shipping_firstname").rules("add", {required:true,maxlength: 100});
	$("#shipping_lastname").rules("add", {maxlength: 100});
	$("#shipping_address_1").rules("add", {required:true,maxlength: 100});
	$("#shipping_address_2").rules("add", {required:true,maxlength: 100});
	$("#shipping_city").rules("add", {required:true});
	$("#shipping_postcode").rules("add", {required:true,number:true});
	$("#shipping_state_dropdown").rules("add", {required:true,maxlength:100});
	$("#shipping_state").rules("add", {required:true,maxlength:100});
	$("#shipping_country").rules("add", {required:true});

	$("#billing_firstname").rules("add", {required:true,maxlength: 100});
	$("#billing_lastname").rules("add", {maxlength: 100});
	$("#billing_address_1").rules("add", {required:true,maxlength: 100});
	$("#billing_address_2").rules("add", {required:true,maxlength: 100});
	$("#billing_city").rules("add", {required:true});
	$("#billing_postcode").rules("add", {required:true,number:true});
	$("#billing_state_dropdown").rules("add", {required:true,maxlength:100});
	$("#billing_state").rules("add", {required:true,maxlength:100});
	$("#billing_country").rules("add", {required:true});
})


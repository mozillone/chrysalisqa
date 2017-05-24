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
})


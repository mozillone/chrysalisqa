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
})


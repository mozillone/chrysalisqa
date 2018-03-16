$(function(){
        $("#edit_plan").validate({
			rules: {
				plan_name:{
					 	required: true,
						maxlength: 50,
						remote: {url: "/planValidation",data: {"plan_id":$('input[name="plan_id"]').val()},type: "post"},
	   				},
	   			plan_desc:{
	   				 	required: true,
						maxlength: 255,
	   			},
				price:{
					 	required: true,
						maxlength: 50,
						number:true
					},
				listing_size: {
					required: true,
				},
				'spaces[]': {
					required: true,
				},
			},
			errorElement : 'div',
			errorLabelContainer: '.errorTxt',
			messages: {
				plan_name:
                 {
                    remote: "This plan is already taken."
                 },
			}
		});
})


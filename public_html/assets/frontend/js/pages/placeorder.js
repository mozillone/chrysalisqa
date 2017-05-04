$(document).ready(function() {
	
    $("#placeorder").validate({
        	rules: {
				shipping_firstname:{
					 	required: true,
						maxlength: 50,
				},
				shipping_lastname:{
					 	required: true,
						maxlength: 50,
				},
				shipping_address_1:{
					 	required: true,
						maxlength: 150,
				}, 
				shipping_city:{
					 	required: true,
						maxlength: 50,
				}, 
				shipping_postcode:{
					required: true,
					number:true,
					maxlength: 8,
				},
				shipping_country:{
					required: true,
				},
				pay_firstname:{
					 	required: true,
						maxlength: 50,
				},
				pay_lastname:{
					 	required: true,
						maxlength: 50,
				},
				pay_address_1:{
					 	required: true,
						maxlength: 150,
				}, 
				pay_city:{
					 	required: true,
						maxlength: 50,
				}, 
				pay_zipcode:{
					required: true,
					number:true,
					maxlength: 8,
				},
				pay_country:{
					required: true,
				},
			},
			errorClass: 'error',
		});
})
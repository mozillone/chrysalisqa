$(document).ready(function() {
	
    $("#shipping_address").validate({
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
		}
	});
	    $("#billing_address").validate({
        	rules: {
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
		}
	});
    $("#billing_address").validate({
    	rules: {
				cardholder_name:{
					required: true,
	               	maxlength: 50,
				},
				cc_number:{
	                required: true,
	                number:true,
	                cc_chk:true,
	            },  
                exp_month:{
                    required: true,
                },
                exp_year:{
                    required: true,
                },
                cc_cvn:{
                    required: true,  
                    number:true,
                    minlength:3,
                    maxlength: 4,
                }                    
            
			},
			messages: 
            {
             cc_cvn: 
                {    
                     number:'Please enter valid CVV',   
                     minlength:'Please enter valid CVV',
                     maxlength:'Please enter valid CVV',
              },
             cc_number: 
                {
                     maxlength:'Please enter valid CC',
                     minlength:'Please enter valid CC',
                     number:'Please enter valid CC',
                     required:'Please enter valid CC',
                 },
          },
          errorClass: 'error',
		});
    jQuery.validator.addMethod("cc_chk", function(value, element) 
		{

		 	result = $('#cc_number').validateCreditCard();

			 if(result.valid  == true)
			 {
					
					var name 		= result.card_type.name

					if(name == 'amex')
					{
						name = 'American Express';	
					}
					else if(name == 'visa')
					{
						name = 'Visa';	
					}
					else if(name == 'mastercard')
					{
						name = 'MasterCard';	
					}		
					
				 
			   return true;
			 }
			 else
			{
				 $.validator.messages.cc_chk =  "Please enter valid credit card.";

				return false;
			 }

			 
			 


		}, 	 $.validator.messages.cc_chk);
    $(document).on('click','.shipping_popup',function(){
    	$('#shipping_popup').modal('show');
    		$.ajax({
			type: 'GET',
			url: '/get/shipping-adress',
			uccess: function(response){
					console.log(response);
				}
			});	
    });
    $(document).on('submit','#shipping_address',function(){
		var data=$(this).serializeArray();
		$.ajax({
			type: 'POST',
			url: '/add/shipping-adress',
			data: data,
			success: function(response){
					alert("test");
				}
			});	

	 });

})
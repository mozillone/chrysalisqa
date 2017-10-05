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
        	ignore: ":hidden",
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
	$("#shipping_address_1").rules("add", {maxlength: 100});
	$("#shipping_address_2").rules("add", {required:true,maxlength: 100});
	$("#shipping_city").rules("add", {required:true});
	$("#shipping_postcode").rules("add", {required:true,number:true});
	$("#shipping_state").rules("add", {required:true,maxlength:100});
	

	$("#billing_firstname").rules("add", {required:true,maxlength: 100});
	$("#billing_lastname").rules("add", {maxlength: 100});
	$("#billing_address_1").rules("add", {maxlength: 100});
	$("#billing_address_2").rules("add", {required:true,maxlength: 100});
	$("#billing_city").rules("add", {required:true});
	$("#billing_postcode").rules("add", {required:true,number:true});
	$("#billing_state").rules("add", {required:true});
	

	$(document).on('change','#shipping_country,#billing_country',function(){
    		if($(this).val()!="United States"){
    			$('.state_dropdown').addClass('hide');
    			$('.normal-states').removeClass('hide');
    		}else{
    			$('.state_dropdown').removeClass('hide');
    			$('.normal-states').addClass('hide');
    		}
    });
    $(document).on('change','#carrier_type',function(){
    	var carrier_type=$(this).val();
    	if(carrier_type=="USPS"){
    		$('#method').html('<option value="">None</option><option value="Priority">Priority</option><option value="First">Express</option>');
    	}
    	if(carrier_type=="FedEx"){
    		$('#method').html('<option value="">None</option><option value="FEDEX_1_DAY_FREIGHT">FedEx 1Day® Freight</option><option value="FEDEX_2_DAY">FedEx 2Day</option><option value="FEDEX_2_DAY_AM">FedEx 2Day® A.M</option><option value="FEDEX_2_DAY_FREIGHT">FedEx 2Day® Freight</option><option value="FEDEX_3_DAY_FREIGHT">FedEx 3Day® Freight</option><option value="FEDEX_GROUND">FedEx Ground</option><option value="FIRST_OVERNIGHT">Fedex Overnight</option>');
    	}

    })
    $(document).on('change','#type',function(){
    	if($(this).val()=="return"){
    		$('.amt').hide();
    	}else{
    		$('.amt').show();
    	}
    });
})


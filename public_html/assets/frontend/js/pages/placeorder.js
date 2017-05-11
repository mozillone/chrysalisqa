$(document).ready(function() {
  
	
	var shipping_address=$("#shipping_address").validate({ignore: ":hidden" });
	var billing_address=$("#billing_address").validate({ignore: ":hidden" });
	var cc_details=$("#cc_form").validate();
	$("#shipping_firstname").rules("add", {required:true,maxlength: 100});
	$("#shipping_lastname").rules("add", {maxlength: 100});
	$("#shipping_address_1").rules("add", {required:true,maxlength: 100});
	$("#shipping_city").rules("add", {required:true});
	$("#shipping_postcode").rules("add", {required:true,number:true});
	$("#shipping_state_dropdown").rules("add", {required:true,maxlength:100});
	$("#shipping_state").rules("add", {required:true,maxlength:100});
	$("#shipping_country").rules("add", {required:true});

	$("#billing_firstname").rules("add", {required:true,maxlength: 100});
	$("#billing_lastname").rules("add", {maxlength: 100});
	$("#billing_address_1").rules("add", {required:true,maxlength: 100});
	$("#billing_city").rules("add", {required:true});
	$("#billing_postcode").rules("add", {required:true,number:true});
	$("#billing_state_dropdown").rules("add", {required:true,maxlength:100});
	$("#billing_state").rules("add", {required:true,maxlength:100});
	$("#billing_country").rules("add", {required:true});

	$("#cardholder_name").rules("add", {required:true,maxlength: 50});
	$("#cc_number").rules("add", {required:true,number:true,cc_chk:true});
	$("#card_type").rules("add", {required:true});
	$("#exp_month").rules("add", {required:true});
	$("#exp_year").rules("add", {required:true});
	$("#cvn_pin").rules("add", {required: true,number:true,minlength:3,maxlength: 4});

	    
    		
	   
  //   jQuery.validator.addMethod("cc_chk", function(value, element) 
		// {

		//  	result = $('#cc_number').validateCreditCard();

		// 	 if(result.valid  == true)
		// 	 {
					
		// 			var name 		= result.card_type.name

		// 			if(name == 'amex')
		// 			{
		// 				name = 'American Express';	
		// 			}
		// 			else if(name == 'visa')
		// 			{
		// 				name = 'Visa';	
		// 			}
		// 			else if(name == 'mastercard')
		// 			{
		// 				name = 'MasterCard';	
		// 			}		
					
				 
		// 	   return true;
		// 	 }
		// 	 else
		// 	{
		// 		 $.validator.messages.cc_chk =  "Please enter valid credit card.";

		// 		return false;
		// 	 }

			 
			 


		// }, 	 $.validator.messages.cc_chk);
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
					
					var card_type		= $('#card_type').val();

					if(card_type != '')
					{	
						if(card_type == name)
						{
							return true;
						}
						else 
						{
							

							 $.validator.messages.cc_chk =  "Please check card type / credit card number ,entered "+name+' card selected card type '+card_type;
						
							return false;
						}		


					}
				 
			   return true;
			 }
			 else
			{
				 $.validator.messages.cc_chk =  "Please enter valid credit card.";

				return false;
			 }

			 
			 


		}, 	 $.validator.messages.cc_chk);
    /***************Shipping Address start here *******************/
    $(document).on('click','.shipping_popup',function(){
    	clearForm();
    			$.ajax({
			url: '/get-adress/shipping',
			success: function(response){
					var opt='<option value="new">New</option>';
					if(response.length=="0"){
						$('.shipping-dropdown').remove();
						$('.shipping-or').remove();
					}
					$.each(response,function(i,value){
						opt+='<option value="'+value.address_id+'">'+value.address1+','+value.city+','+value.zip_code+','+value.country+'</option>';
					});
					$('#shipping').html(opt);
					$('.new_address').removeClass('hide');
    				$("#shipping option:eq(0)").attr("selected", "selected");
    				$('#shipping_popup').modal('show');
				}
			});	
    });
    $(document).on('change','#shipping',function(){
    	var type=$(this).val();
    	if(type=="new"){
    		 	
	    	$('.new_address').removeClass('hide');
    	}else{
    		$("#shipping_firstname").rules("remove");
			$("#shipping_lastname").rules("remove");
			$("#shipping_address_1").rules("remove");
			$("#shipping_city").rules("remove");
			$("#shipping_postcode").rules("remove");
			$("#shipping_country").rules("remove");

    		$('.new_address').addClass('hide');
    		getShippingSelectedAdress('shipping',$(this).val());
    	}
     })
    $(document).on('submit','#shipping_address',function(){
		var data=$(this).serializeArray();
		$.ajax({
			type: 'POST',
			url: '/add/shipping-adress',
			data: data,
			success: function(response){
					if($('#is_billing').is(":checked")){
						getShippingSelectedAdress('shipping',response,true)
					}else{
						getShippingSelectedAdress('shipping',response);
			
					}
					$('.shipping_popup').html('Edit');
					$('#shipping_popup').modal('hide');
				}
			});	

	 });
    /**************************************************************/
    /***************Billing Address start here *******************/
    $(document).on('click','.billing_popup',function(){
    	clearForm();
    		$.ajax({
			url: '/get-adress/billing',
			success: function(response){
					if(response.length=="0"){
						$('.billing-dropdown').remove();
						$('.billing-or').remove();
					}
					var opt='<option value="new">New</option>';
					$.each(response,function(i,value){
						opt+='<option value="'+value.address_id+'">'+value.address1+','+value.city+','+value.zip_code+','+value.country+'</option>';
					});
					$('#billing').html(opt);
					$('.new_address').removeClass('hide');
    				$("#billing option:eq(0)").attr("selected", "selected");
    				$('#billing_popup').modal('show');
				}
			});	
    });
    $(document).on('change','#billing',function(){
    	var type=$(this).val();
    	if(type=="new"){
    		$('.new_address').removeClass('hide');
    	}else{
    		$("#billing_firstname").rules("remove");
			$("#billing_lastname").rules("remove");
			$("#billing_address_1").rules("remove");
			$("#billing_city").rules("remove");
			$("#billing_postcode").rules("remove");
			$("#billing_country").rules("remove");

    		$('.new_address').addClass('hide');
    		getBillingSelectedAdress('billing',$(this).val());
    		}
     })
    $(document).on('submit','#billing_address',function(){
		var data=$(this).serializeArray();
		$.ajax({
			type: 'POST',
			url: '/add/billing-adress',
			data: data,
			success: function(response){
					if($('#is_shipping').is(":checked")){
						getBillingSelectedAdress('billing',response,true)
					}else{
						getBillingSelectedAdress('billing',response);
			
					}
					$('#billing_popup').modal('hide');
				}
			});	

	 });
    /**************************************************************/
     /***************Credit card  start here *******************/
    $(document).on('click','.cc_popup',function(){
    	clearForm();
    		$.ajax({
			url: '/get/credit-card',
			success: function(response){
					if(response.length=="0"){
						$('.payment-dropdown').remove();
						$('.payment-or').remove();
					}
					var opt='<option value="new">New</option>';
					$.each(response,function(i,value){
						opt+='<option value="'+value.id+'">'+value.credit_card_mask+'</option>';
					});
					$('#cc_list').html(opt);
					$('.new_cc').removeClass('hide');
    				$("#billing cc_list:eq(0)").attr("selected", "selected");
    				$('#cc_popup').modal('show');
				}
			});	
    });
    $(document).on('change','#cc_list',function(){
    	var type=$(this).val();
    	if(type=="new"){
    		$('.new_cc').removeClass('hide');
    	}else{
    		$("#cardholder_name").rules("remove");
			$("#cc_number").rules("remove");
			$("#exp_month").rules("remove");
			$("#cvn_pin").rules("remove");
		
    		$('.new_cc').addClass('hide');
    		getSelectedCreditCard($(this).val());
    		}
     })
    $(document).on('submit','#cc_form',function(){
		var data=$(this).serializeArray();
		$.ajax({
			type: 'POST',
			url: '/add/credit-card',
			data: data,
			success: function(response){
					getSelectedCreditCard(response);
					$('.cc_popup').html('Edit');
					$('#cc_popup').modal('hide');
				}
			});	

	 });
    /**************************************************************/
     function getShippingSelectedAdress(type,address_id,is_billing=false){
    	$('.shipping_add').html('');
    	$.ajax({
			url: '/get-adress/'+type+'/'+address_id+'',
			success: function(response){
				$('input[name="shipping_address_1"]').val(response);
				if($('#is_billing').is(':checked')){
					$('input[name="billing_address_1"]').val(response);
					$('.billing-empty,.error').remove();
					$('.billing_popup').html('Edit');
				}
				$('.shipping-empty,.error').remove();
				$('.shipping_popup').html('Edit');
				if(!is_billing){
					$('.shipping_add').html('<p>'+response[0].address1+',<br>'+response[0].address2+'<br>'+response[0].city+','+response[0].state+','+response[0].zip_code+','+response[0].country+'<br></p>');
				}
				else{
					$('.shipping_add').html('<p>'+response[0].address1+',<br>'+response[0].address2+'<br>'+response[0].city+','+response[0].state+','+response[0].zip_code+','+response[0].country+'<br></p>');
					$('.billing_add').html('<p>'+response[0].address1+',<br>'+response[0].address2+'<br>'+response[0].city+','+response[0].state+','+response[0].zip_code+','+response[0].country+'<br></p>');
				
				}
			}
			});
    }
    function getBillingSelectedAdress(type,address_id,is_shipping=false){
    	$('.billing_add').html('');
    	$.ajax({
			url: '/get-adress/'+type+'/'+address_id+'',
			success: function(response){
				$('input[name="billing_address_1"]').val(response);
				if($('#is_shipping').is(':checked')){
					$('input[name="shipping_address_1"]').val(response);
					$('.shipping-empty,.error').remove();
					$('.shipping_popup').html('Edit');

				}
				$('.billing-empty,.error').remove();
				$('.billing_popup').html('Edit');
					if(!is_shipping){
					$('.billing_add').html('<p>'+response[0].address1+',<br>'+response[0].address2+'<br>'+response[0].city+','+response[0].state+','+response[0].zip_code+','+response[0].country+'<br></p>');
				}
				else{
					$('.shipping_add').html('<p>'+response[0].address1+',<br>'+response[0].address2+'<br>'+response[0].city+','+response[0].state+','+response[0].zip_code+','+response[0].country+'<br></p>');
					$('.billing_add').html('<p>'+response[0].address1+',<br>'+response[0].address2+'<br>'+response[0].city+','+response[0].state+','+response[0].zip_code+','+response[0].country+'<br></p>');
				
				}
			}
			});
    }
     function getSelectedCreditCard(card_id){
    	$.ajax({
			url: '/get/credit-card/'+card_id,
			success: function(response){
					$('input[name="card_id"]').val(response);
					$('.payment-empty,.error').remove();
					if(response[0].card_type=="Visa"){
						var img='<img src="/img/visa.png">';
					}else if(response[0].card_type=="American Express"){
					 var img='<img src="/img/americanexpress.png">';
					}else if(response[0].card_type=="MasterCard"){
						var img='<img src="/img/mastercard.png">';
					} 
					$('.card_exp').html(img+' Ending in '+response[0].exp_year);
			}
			});
    }
    function clearForm(){
    	$('label.error').remove();
    	$('input[name="address_1"]').val('');
    	$('input[name="address_2"]').val('');
    	$('input[name="city"]').val('');
    	$('input[name="postcode"]').val('');
    	$('#is_shipping').attr('checked',false);
    	$('#is_billing').attr('checked',false);
    }
     $(document).on('click', '.delete', function(){ 
      var item_id=$(this).attr('data-item-id');
      var cart_id=$(this).attr('data-cart_id');
      swal({   
              title: "Are you sure want to remove this costume from your order?",   
                        text: "You will not be able to recover this costume",   
                        showCancelButton: true,   
                        confirmButtonColor: "#DD6B55",   
                        confirmButtonText: "Yes, delete",   
                        closeOnConfirm: false
                      }, 
                      function(){   
                        document.location = "/cart/delete/"+item_id+"/"+cart_id;
                      }); 
         
    });
    $(document).on('change','#shipping_country,#billing_country',function(){
    		if($(this).val()!="United States"){
    			$('.state_dropdown').addClass('hide');
    			$('.normal-states').removeClass('hide');
    		}else{
    			$('.state_dropdown').removeClass('hide');
    			$('.normal-states').addClass('hide');
    		}
    });


})
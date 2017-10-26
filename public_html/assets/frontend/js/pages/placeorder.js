$(document).ready(function() {
  
	var shipping_address=$("#shipping_address").validate({ignore: ":hidden" });
	var billing_address=$("#billing_address").validate({ignore: ":hidden" });
	var cc_details=$("#cc_form").validate();
	//alert(date.getDate() + 1);


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
	$("#billing_state").rules("add", {required:true,maxlength:100});
	
	$("#cardholder_name").rules("add", {required:true,maxlength: 50});
	$("#cc_number").rules("add", {required:true,cc_chk:true});
	$("#card_type").rules("add", {required:true});
	$("#exp_month").rules("add", {required:true});
	$("#exp_year").rules("add", {required:true});
	$("#cvn_pin").rules("add", {required: true,number:true,minlength:3,maxlength: 4});
	var seller_shippings=[];
	$('.shipping_amount').each(function(i,value){
		var seller_id=parseInt($(this).attr('data-seller-id'));
		if(jQuery.inArray(seller_id,seller_shippings)==-1 || seller_shippings.length==0){
			seller_shippings.push(seller_id);
		}
	});
	var shipping_amount="0";
	var order_shippings=[];
	var seller_ammount=[];
	$(document).on('change','.shipping_amount',function(){
		$('.shipping_total').html();
		var amount=$(this).val();
		var seller_id=parseInt($(this).attr('data-seller-id'));
		if(jQuery.inArray(seller_id,order_shippings)==-1 || order_shippings.length==0){
			order_shippings.push(seller_id);
			seller_ammount.push({'seller_id':seller_id,'amount':amount});
			for (var i = 0; i < seller_ammount.length; i++){
  					if (seller_ammount[i].seller_id == seller_id){
  							shipping_amount=parseFloat(shipping_amount)+parseFloat(amount);
  							
  					
					}
				  }
				}
		else{
				for (var i = 0; i < seller_ammount.length; i++){
					if (seller_ammount[i].seller_id == seller_id){
  						// console.log(seller_ammount[i].amount);
  						// console.log(seller_ammount[i].amount);
  					//		alert(parseFloat(shipping_amount)+"-"+seller_ammount[i].amount.split("_")[0]+"+"+parseFloat(amount));
  				
  						shipping_amount=(parseFloat(shipping_amount)-seller_ammount[i].amount.split("_")[0])+parseFloat(amount);
  					 seller_ammount[i].amount=amount;
  						

    			  }
				}
			//$('.shipping_total').html('$ '+parseFloat(shipping_amount).toFixed(2));
		}
			$('.shipping_total').html(parseFloat(shipping_amount).toFixed(2));
			
	})
	    
    		
	   
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
    	var shipping_addr=$('input[name="shipping_address_2"]').attr('data-address');
    	var is_new=false;
    	if(shipping_addr!=undefined){
    		var address=JSON.parse(shipping_addr);
    		var address_type=$('input[name="shipping_address_2"]').attr('data-cart');
    	}else{
    		is_new=true;
    	}
    			$.ajax({
			url: '/get-adress/shipping',
			success: function(response){
					var opt='<option value="new">New</option>';
					if(response.length=="0"){
						$('.shipping-dropdown').remove();
						$('.shipping-or').remove();
					}
					$.each(response,function(i,value){
						if(value.address1.length){
							var addr=value.address1+" "+value.address2;
						}else{
							var addr=value.address2;
						}
						if(value.address_id==address.address_id){
							address=value;
						}
						opt+='<option value="'+value.address_id+'">'+addr+', '+value.city+', '+value.state+', '+value.zip_code+'</option>';
					});
					if(address_type=="true"){
						$('#shipping_firstname').val(address.shipping_firstname);
						$('#shipping_lastname').val(address.shipping_lastname);
						$('#shipping_address_1').val(address.shipping_address_1);
						$('#shipping_address_2').val(address.shipping_address_2);
						$('#shipping_city').val(address.shipping_city);
						$('#shipping_state').val(address.shipping_state);
						$('#shipping_postcode').val(address.shipping_postcode);

					}if(!is_new && address_type=="false"){
						$('#shipping_firstname').val(address.fname);
						$('#shipping_lastname').val(address.lname);
						$('#shipping_address_1').val(address.address1);
						$('#shipping_address_2').val(address.address2);
						$('#shipping_city').val(address.city);
						$('#shipping_state').val(address.state);
						$('#shipping_postcode').val(address.zip_code);
					}

					$('#shipping').html(opt);
					$('.new_address').removeClass('hide');
					$('.udt').remove();
    				$("#shipping option:eq(0)").attr("selected", "selected");
    				$('#shipping_popup').modal('show');
				}
			});	
    });
    $(document).on('change','#shipping',function(){
    	var type=$(this).val();
    	$('.udt').remove();
    	if(type=="new"){
    		 	
	    	$('.new_address').removeClass('hide');
    	}else{
    		$("#shipping_firstname").rules("remove");
			$("#shipping_lastname").rules("remove");
			$("#shipping_address_1").rules("remove");
			$("#shipping_city").rules("remove");
			$("#shipping_postcode").rules("remove");
		
    		$('.new_address').addClass('hide');
    		$('.new_address').after('<div class="col-md-12 col-xs-12 udt"><button class="btn btn-primary submit-btn">Update</button></div>');
    		//getShippingSelectedAdress('shipping',$(this).val(),"false");
    	}
     })
    $(document).on('submit','#shipping_address',function(){
    	$('.img-loading').removeClass('hide');
    	$('.main-container').addClass('loading-page');
		var data=$(this).serializeArray();
		$.ajax({
			type: 'POST',
			url: '/add/shipping-adress',
			data: data,
			success: function(response){
					location.reload();
					// if($('#is_billing').is(":checked")){
					// 	getShippingSelectedAdress('shipping',response,true)
					// }else{
					// 	getShippingSelectedAdress('shipping',response);
			
					// }
					// $('.shipping_popup').html('Edit');
					// $('#shipping_popup').modal('hide');
				}
			});	

	 });
    /**************************************************************/
    /***************Billing Address start here *******************/
    $(document).on('click','.billing_popup',function(){
    	clearForm();
    	var is_new=false;
    	var billing_addr=$('input[name="pay_address_2"]').attr('data-address');
    	if(billing_addr!=undefined){
    		var address=JSON.parse(billing_addr);
    		var address_type=$('input[name="pay_address_2"]').attr('data-cart');
    	}else{
    		is_new=true;
    	}
    	
    		$.ajax({
			url: '/get-adress/billing',
			success: function(response){
					if(response.length=="0"){
						$('.billing-dropdown').remove();
						$('.billing-or').remove();
					}
					var opt='<option value="new">New</option>';
					$.each(response,function(i,value){
						if(value.address1.length){
							var addr=value.address1+", "+value.address2;
						}else{
							var addr=value.address2;
						}
						if(value.address_id==address.address_id){
							address=value;
						}
						opt+='<option value="'+value.address_id+'">'+addr+', '+value.city+', '+value.state+', '+value.zip_code+'</option>';
					});
					if(address_type=="true"){
						$('#billing_firstname').val(address.pay_firstname);
						$('#billing_lastname').val(address.pay_lastname);
						$('#billing_address_1').val(address.pay_address_1);
						$('#billing_address_2').val(address.pay_address_2);
						$('#billing_city').val(address.pay_city);
						$('#billing_state').val(address.pay_state);
						$('#billing_postcode').val(address.pay_zipcode);

					}if(!is_new && address_type=="false"){
						$('#billing_firstname').val(address.fname);
						$('#billing_lastname').val(address.lname);
						$('#billing_address_1').val(address.address1);
						$('#billing_address_2').val(address.address2);
						$('#billing_city').val(address.city);
						$('#billing_state').val(address.state);
						$('#billing_postcode').val(address.zip_code);
					}
					$('#billing').html(opt);
					$('.new_address').removeClass('hide');
					$('.udt').remove();
    				$("#billing option:eq(0)").attr("selected", "selected");
    				$('#billing_popup').modal('show');
				}
			});	
    });
    $(document).on('change','#billing',function(){
    	var type=$(this).val();
    	$('.udt').remove();
    	if(type=="new"){
    		$('.new_address').removeClass('hide');
    	}else{
    		$("#billing_firstname").rules("remove");
			$("#billing_lastname").rules("remove");
			$("#billing_address_1").rules("remove");
			$("#billing_city").rules("remove");
			$("#billing_postcode").rules("remove");
			
    		$('.new_address').addClass('hide');
    		$('.new_address').after('<div class="col-md-12 col-xs-12 udt"><button class="btn btn-primary submit-btn">Update</button></div>');
    		//getBillingSelectedAdress('billing',$(this).val(),"false");
    		}
     })
    $(document).on('submit','#billing_address',function(){
    	$('.img-loading').removeClass('hide');
    	$('.main-container').addClass('loading-page');
		var data=$(this).serializeArray();
		$.ajax({
			type: 'POST',
			url: '/add/billing-adress',
			data: data,
			success: function(response){
				location.reload();
					// if($('#is_shipping').is(":checked")){
					// 	getBillingSelectedAdress('billing',response,true)
					// }else{
					// 	getBillingSelectedAdress('billing',response);
			
					// }
					// $('#billing_popup').modal('hide');
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
    	$('.img-loading').removeClass('hide');
    	$('.main-container').addClass('loading-page');
    	$('.payment-fail').html("");
		var data=$(this).serializeArray();
		$.ajax({
			type: 'POST',
			url: '/add/credit-card',
			data: data,
			success: function(response){
					location.reload();
					// if(response.result=="1"){
					// 	getSelectedCreditCard(response.message);
					// 	$('.cc_popup').html('Edit');
					// 	$('#cc_popup').modal('hide');
					// }else{
					// 	$('.payment-fail').html(response.message);
					// }
				}
			});	

	 });
    /**************************************************************/
     function getShippingSelectedAdress(type,address_id,is_billing){
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
				if(response[0].address2.length){
						var address2=response[0].address2+'<br>';
					}else{
						var address2="";
					}
				if(!is_billing){
					$('.shipping_add').html('<p>'+response[0].address1+',<br>'+address2+response[0].city+','+response[0].state+','+response[0].zip_code+'<br></p>');
				}
				else{
					$('.shipping_add').html('<p>'+response[0].address1+',<br>'+address2+response[0].city+','+response[0].state+','+response[0].zip_code+'<br></p>');
					$('.billing_add').html('<p>'+response[0].address1+',<br>'+address2+response[0].city+','+response[0].state+','+response[0].zip_code+'<br></p>');
				
				}
			}
			});
    }
    function getBillingSelectedAdress(type,address_id,is_shipping){
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
					if(response[0].address2.length){
						var address2=response[0].address2+'<br>';
					}else{
						var address2="";
					}
					if(!is_shipping){
					$('.billing_add').html('<p>'+response[0].address1+',<br>'+address2+response[0].city+','+response[0].state+','+response[0].zip_code+'<br></p>');
				}
				else{
					$('.shipping_add').html('<p>'+response[0].address1+',<br>'+address2+response[0].city+','+response[0].state+','+response[0].zip_code+'<br></p>');
					$('.billing_add').html('<p>'+response[0].address1+',<br>'+address2+response[0].city+','+response[0].state+','+response[0].zip_code+'<br></p>');
				
				}
			}
			});
    }
     function getSelectedCreditCard(card_id){
    	$.ajax({
			url: '/get/credit-card/'+card_id,
			success: function(response){
					$('input[name="card_id"]').val(card_id);
					$('.payment-empty,.error').remove();
					if(response[0].card_type=="Visa"){
						var img='<img src="/img/visa.png">';
					}else if(response[0].card_type=="American Express"){
					 var img='<img src="/img/americanexpress.png">';
					}else if(response[0].card_type=="MasterCard"){
						var img='<img src="/img/mastercard.png">';
					} 
					$('.card_exp').html(img+' Ending in '+response[0].last_digits);
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
input_credit_card = function(input)
{
    var format_and_pos = function(char, backspace)
    {
        var start = 0;
        var end = 0;
        var pos = 0;
        var separator = " ";
        var value = input.value;

        if (char !== false)
        {
            start = input.selectionStart;
            end = input.selectionEnd;

            if (backspace && start > 0) // handle backspace onkeydown
            {
                start--;

                if (value[start] == separator)
                { start--; }
            }
            // To be able to replace the selection if there is one
            value = value.substring(0, start) + char + value.substring(end);

            pos = start + char.length; // caret position
        }

        var d = 0; // digit count
        var dd = 0; // total
        var gi = 0; // group index
        var newV = "";
        var groups = /^\D*3[47]/.test(value) ? // check for American Express
        [4, 6, 5] : [4, 4, 4, 4];

        for (var i = 0; i < value.length; i++)
        {
            if (/\D/.test(value[i]))
            {
                if (start > i)
                { pos--; }
            }
            else
            {
                if (d === groups[gi])
                {
                    newV += separator;
                    d = 0;
                    gi++;

                    if (start >= i)
                    { pos++; }
                }
                newV += value[i];
                d++;
                dd++;
            }
            if (d === groups[gi] && groups.length === gi + 1) // max length
            { break; }
        }
        input.value = newV;

        if (char !== false)
        { input.setSelectionRange(pos, pos); }
    };

    input.addEventListener('keypress', function(e)
    {
        var code = e.charCode || e.keyCode || e.which;

        // Check for tab and arrow keys (needed in Firefox)
        if (code !== 9 && (code < 37 || code > 40) &&
        // and CTRL+C / CTRL+V
        !(e.ctrlKey && (code === 99 || code === 118)))
        {
            e.preventDefault();

            var char = String.fromCharCode(code);

            // if the character is non-digit
            // OR
            // if the value already contains 15/16 digits and there is no selection
            // -> return false (the character is not inserted)

            if (/\D/.test(char) || (this.selectionStart === this.selectionEnd &&
            this.value.replace(/\D/g, '').length >=
            (/^\D*3[47]/.test(this.value) ? 15 : 16))) // 15 digits if Amex
            {
                return false;
            }
            format_and_pos(char);
        }
    });
    
    // backspace doesn't fire the keypress event
    input.addEventListener('keydown', function(e)
    {
        if (e.keyCode === 8 || e.keyCode === 46) // backspace or delete
        {
            e.preventDefault();
            format_and_pos('', this.selectionStart === this.selectionEnd);
        }
    });
    
    input.addEventListener('paste', function()
    {
        // A timeout is needed to get the new value pasted
        setTimeout(function(){ format_and_pos(''); }, 50);
    });
    
    input.addEventListener('blur', function()
    {
    	// reformat onblur just in case (optional)
        format_and_pos(this, false);
    });
};

input_credit_card(document.getElementById('cc_number'));

$('#placeorder').submit(function(e){
	var is_shipping=$('input[name="shipping_address_2"]').val();
	var is_billing=$('input[name="pay_address_2"]').val();
	var is_payement=$('input[name="card_id"]').val();
	var error=0;
	var shipping_options=0;
	if(!is_shipping.length){
		$('.shipping-error').html('Shipping address is required');
		error++;
	}
	if(!is_billing.length){
		$('.billing-error').html('Billing address is required');
		error++;
	}
	if(!is_payement.length){
		$('.payment-error').html('Payment method is required');
		error++;
	}
	for(i=0;i<seller_shippings.length;i++){
		if (!$('input[name="shipping_type['+seller_shippings[i]+']"').is(":checked")){
			shipping_options++;
			$('#sipping_'+seller_shippings[i]).html('Please select any one of shipping method');
			window.location ='#sipping_'+seller_shippings[i];
		}
	}
	$('.seller_location').each(function(i,v){
		$('.seller_location').html('Seller location is not present.please remove this seller costumes from your list');
		    shipping_options++;
		    var seller_id=$(this).attr('data-seller-id');
		    window.location ='#seller_location_'+seller_id;
		
	});
	$('.shipping_api_errors').each(function(i,v){
		 var msg=$('#api_error_'+seller_id).attr('data-error');
		$('.shipping_api_errors').html(msg);
		    shipping_options++;
		    var seller_id=$(this).attr('data-seller-id');
		    window.location ='#api_error_'+seller_id;
		
	});
	if(error>0){
		return false;
	}
	if(shipping_options>0){
		return false;
	}
	if(error=="0" && shipping_options=="0"){
		$('.img-loading').removeClass('hide');
		$('.main-container').addClass('loading-page');
		$('.submit-order').click(function(e){
				e.preventDefault();
		});
	}
});
var sub_total=$('.sub-p').attr('data-subtotal');
var coupan_price=$('.coupan-p').attr('data-coupan');
var str_price=$('.str-credts').attr('data-credits');
if(coupan_price){var cpn=coupan_price;}else{var cpn="0";}
if(str_price){var str=str_price;}else{var str="0";}
$(document).on('change','.shipping_amount',function(){
			 var seller_no=$(this).attr('data-seller-id');
			 var type=$(this).attr('data-type');
			 var shipping_days=$(this).attr('data-shipping-days');
			 var date = new Date();
			 var today=$.datepicker.formatDate('D M d', date);	
			 $('.shi_date_right_'+seller_no).html("");
			 if(type=="free"){
			 	 var delivery_date = new Date(date);
			 	 delivery_date.setDate(date.getDate()+3);
			     delivery_date.toLocaleDateString();	
			 	 var delvdate=$.datepicker.formatDate('D M d', delivery_date);
			 	$('.shi_date_right_'+seller_no).html(' Est delivery between '+today+' and '+delvdate+'');
			 	$('.shipping_amount').each(function(){
			 		if($(this).attr('data-seller-id')==seller_no){
			 			if($(this).is(":checked")){
			 				var shipping=$(this).val()+"_"+'Est delivery between '+today+' and '+delvdate;
			 				var shipping=$(this).val(shipping);
			 			}
			 		}
			 	});
			 }
			 if(type=="priority"){
			 	 var delivery_date = new Date(date);
			 	 delivery_date.setDate(date.getDate()+parseInt(shipping_days));
			     delivery_date.toLocaleDateString();	
			 	 var delvdate=$.datepicker.formatDate('D M d', delivery_date);
			 	$('.shi_date_right_'+seller_no).html(' Est delivery between '+today+' and '+delvdate+'');
			 	$('.shipping_amount').each(function(){
			 		if($(this).attr('data-seller-id')==seller_no){
			 			if($(this).is(":checked")){
			 				var shipping=$(this).val()+"_"+'Est delivery between '+today+' and '+delvdate;
			 				var shipping=$(this).val(shipping);
			 			}
			 		}
			 	});
			 	//html(' Est delivery between '+today+' and '+delvdate+'');
			 }
			 if(type=="express"){
			 	 var delivery_date = new Date(date);
			 	 delivery_date.setDate(date.getDate()+parseInt(shipping_days));
			     delivery_date.toLocaleDateString();	
			 	 var delvdate=$.datepicker.formatDate('D M d', delivery_date);
			 	$('.shi_date_right_'+seller_no).html(' Est delivery between '+today+' and '+delvdate+'');
			 	$('.shipping_amount').each(function(){
			 		if($(this).attr('data-seller-id')==seller_no){
			 			if($(this).is(":checked")){
			 				var shipping=$(this).val()+"_"+'Est delivery between '+today+' and '+delvdate;
			 				var shipping=$(this).val(shipping);
			 			}
			 		}
			 	});
			 }
			var total=parseFloat(sub_total)+parseFloat($('.shipping_total').text()-parseFloat(cpn)-parseFloat(str));
			$('.total-amount').text(total.toFixed(2))
			$('#sipping_'+seller_no).remove();
});

});

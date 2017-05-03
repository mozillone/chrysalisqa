$(function(){
	
	
        $("#customer_create").validate({
        	onfocusout: function(element) { $(element).valid(); },
			rules: {
				first_name:{
					 	required: true,
						maxlength: 50,
				},
				last_name:{
					 	required: true,
						maxlength: 50,
				}, 
				phone_number:{
					required: true,
					//number:true,
					//maxlength: 10,
					//remote: {url: "/customer/emailValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"},
				},
				user_name:{
					required: true,
					maxlength: 50,
				},
				email: {
      				required: true,
      				email: true,
      				remote: {url: "/customer/emailValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"},
	   				},
				password: {
					required: true,
					minlength: 5,
					maxlength: 15,
				},
			},
			highlight: function(element) {
          	 $(element).closest('.form-control').addClass('error');
	      	},
	       	errorPlacement: function(error, element) {
	           if(element.parent('.input-group').length) {
	               error.insertAfter($(element).parents('div.input-group'));
	           }else{
	               error.insertAfter(element);
	           }
	       	},
			messages: {
			   first_name:
			   {
			    required: "Enter First Name",
			   },
			   last_name:
			   {
			    required: "Enter Last Name",
			   },
			   user_name:
			   {
			    required: "Enter Username",
			   },
			   password:{
			   required: "Enter Password",
			   },
				email:
                 {
                    required: "Enter Email Address",
                    email: "Please enter a valid email address.",
                    remote: "This email is already taken."
                 },
				 phone_number:
				 {
					required: "Enter Phone Number"
                   
				 },
			},
			errorElement: 'span',
       		errorClass: 'error',
		});
	 $("#customer_edit").validate({
        	onfocusout: function(element) { $(element).valid(); },
			rules: {
				first_name:{
					 	required: true,
						maxlength: 50,
				},
				last_name:{
					 	required: true,
						maxlength: 50,
				}, 
				phone_number:{
					required: true,
					//number:true,
					//maxlength: 10,
					//remote: {url: "/customer/emailValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"},
				},
				user_name:{
					required: true,
					maxlength: 50,
				},
				email: {
      				required: true,
      				email: true,
      				remote: {url: "/customer/emailValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"},
	   				},
				
			},
			highlight: function(element) {
          	 $(element).closest('.form-control').addClass('error');
	      	},
	       	errorPlacement: function(error, element) {
	           if(element.parent('.input-group').length) {
	               error.insertAfter($(element).parents('div.input-group'));
	           }else{
	               error.insertAfter(element);
	           }
	       	},
			messages: {
			   first_name:
			   {
			    required: "Enter First Name",
			   },
			   last_name:
			   {
			    required: "Enter Last Name",
			   },
			   user_name:
			   {
			    required: "Enter Username",
			   },
			   
				email:
                 {
                    required: "Enter Email Address",
                    email: "Please enter a valid email address.",
                    remote: "This email is already taken."
                 },
				 phone_number:
				 {
					required: "Enter Phone Number"
                   
				 },
			},
			errorElement: 'span',
       		errorClass: 'error',
		});
		$("#customer_edit1").validate({
        	onfocusout: function(element) { $(element).valid(); },
			rules: {
				costume_name:{
					 	required: true,
						maxlength: 50,
				},
				category:{
					 	required: true,
						maxlength: 50,
				}, 
				heightft:{
					required: true,
				},
				
				heightin:{
					required: true,
					
				},
				
				weightlbs:{
					required: true,
					
				},
				chestin:{
					required: true,
					
				},
				waistlbs:{
					required: true,
					
				},
				size:{
					required: true,
					
				},
				price:{
					required: true,
					
				},
				quantity:{
					required: true,
					
				},
				shipping_option:{
					required: true,
					
				},
				costume_desc:{
					required: true,
					
				},
				fun_fact:{
					required: true,
					
				},
				faq:{
					required: true,
					
				},
				weight_package_items:{
				 required: true,
				},
				dimensions:{
				  required: true,
				},
				type:{
				  required: true,
				},
				service:{
				  required: true,
				},
				autocomplete:{
				  required: true,
				},
				handling_time:{
				  required: true,
				},
				return_policy:{
				  required: true,
				},
				charity_amount:{
				  required: true,
				},
				charity_name:{
				  required: true,
				},
				avatar:{
				  required: true,
				},
				avatar1:{
				  required: true,
				},
			},
			highlight: function(element) {
          	 $(element).closest('.form-control').addClass('error');
	      	},
	       	errorPlacement: function(error, element) {
	           if(element.parent('.input-group').length) {
	               error.insertAfter($(element).parents('div.input-group'));
	           }else{
	               error.insertAfter(element);
	           }
	       	},
			messages: {
			   costume_name:
			   {
			    required: "Enter Costume Name",
			   },
			   category:
			   {
			    required: "Select Category",
			   },
			   user_name:
			   {
			    required: "Enter Username",
			   },
			   
				email:
                 {
                    required: "Enter Email Address",
                    email: "Please enter a valid email address.",
                    remote: "This email is already taken."
                 },
				 phone_number:
				 {
					required: "Enter Phone Number"
                   
				 },
			},
			errorElement: 'span',
       		errorClass: 'error',
		});
		$("#phone,#contact_phone,#phone_number,#aaa,#search.phone").on("keyup paste", function() {

  // Remove invalid chars from the input

  var input = this.value.replace(/[^0-9\(\)\s\-]/g, "");

  var inputlen = input.length;

  // Get just the numbers in the input

  var numbers = this.value.replace(/\D/g,'');

  var numberslen = numbers.length;

  // Value to store the masked input

  var newval = "";    // Loop through the existing numbers and apply the mask

  for(var i=0;i<numberslen;i++){

      if(i==0) newval="("+numbers[i];

      else if(i==3) newval+=") "+numbers[i];

      else if(i==6) newval+="-"+numbers[i];

      else newval+=numbers[i];

  }    // Re-add the non-digit characters to the end of the input that the user entered and that match the mask.

  if(inputlen>=1&&numberslen==0&&input[0]=="(") newval="(";

  else if(inputlen>=6&&numberslen==3&&input[4]==")"&&input[5]==" ") newval+=") ";

  else if(inputlen>=5&&numberslen==3&&input[4]==")") newval+=")";

  else if(inputlen>=6&&numberslen==3&&input[5]==" ") newval+=" ";

  else if(inputlen>=10&&numberslen==6&&input[9]=="-") newval+="-";    $(this).val(newval.substring(0,14));

});

	   $("#profile_logo").on('change', function(){
		//Get count of selected files
		var countFiles = $(this)[0].files.length;
		var imgPath = $(this)[0].value;
		var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		var image_holder = $("#img-chan");
		image_holder.empty();
		var size = parseFloat($("#profile_logo")[0].files[0].size / 1024).toFixed(2);
		if (extn == "jpg" || extn == "jpeg" || extn == "png") {
			if(size<10000)
            {
			if (typeof(FileReader) != "undefined") {
			
				for (var i = 0; i < countFiles; i++) 
				{
					var reader = new FileReader();
					reader.onload = function(e) {
						
						$('#img-chan').attr('src',e.target.result);
					}
					image_holder.show();
					reader.readAsDataURL($(this)[0].files[i]);
				}
				} else {
				swal("This browser does not support FileReader.");
			}
			
            } else {

                  
                    $("#profile_logo").val("");
                    swal({   
                        title: "File doesn't Support",   
                        text: "Upload Below 10MB Size Only",   
                        type: "warning",   
                        showCancelButton: false,
                        fieldset:false,
                        confirmButtonColor: "#DD6B55 ",   
                        confirmButtonText: "Ok",   
                    closeOnConfirm: true });
                }
			} else {
			//swal("");
			swal({   
				title: "File doesn't Support",   
				text: "Upload .JPG, .JPEG, .PNG Images only.!",   
				type: "warning",   
				showCancelButton: false,
				fieldset:false,
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Ok",   
			closeOnConfirm: true });
			$('input[type="file"]').val('');
		   	$('input[name="avatar"]').val("1");
			}
		 }); 
		 $("#profile_logo1").on('change', function(){
		//Get count of selected files
		var countFiles = $(this)[0].files.length;
		var imgPath = $(this)[0].value;
		var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		var image_holder = $("#img-chan1");
		image_holder.empty();
		var size = parseFloat($("#profile_logo1")[0].files[0].size / 1024).toFixed(2);
		if (extn == "jpg" || extn == "jpeg" || extn == "png") {
			if(size<10000)
            {
			if (typeof(FileReader) != "undefined") {
			
				for (var i = 0; i < countFiles; i++) 
				{
					var reader = new FileReader();
					reader.onload = function(e) {
						
						$('#img-chan1').attr('src',e.target.result);
					}
					image_holder.show();
					reader.readAsDataURL($(this)[0].files[i]);
				}
				} else {
				swal("This browser does not support FileReader.");
			}
			
            } else {

                  
                    $("#profile_logo1").val("");
                    swal({   
                        title: "File doesn't Support",   
                        text: "Upload Below 10MB Size Only",   
                        type: "warning",   
                        showCancelButton: false,
                        fieldset:false,
                        confirmButtonColor: "#DD6B55 ",   
                        confirmButtonText: "Ok",   
                    closeOnConfirm: true });
                }
			} else {
			//swal("");
			swal({   
				title: "File doesn't Support",   
				text: "Upload .JPG, .JPEG, .PNG Images only.!",   
				type: "warning",   
				showCancelButton: false,
				fieldset:false,
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Ok",   
			closeOnConfirm: true });
			$('input[type="file"]').val('');
		   	$('input[name="avatar1"]').val("1");
			}
		 }); 
	$(".remove_pic").on("click",function(){
		$('#img-chan').attr('src',"/img/default.png");
		$('input[type="file"]').val('');
		$('input[name="is_removed"]').val("1");
	  });
	  $(".remove_pic1").on("click",function(){
		$('#img-chan1').attr('src',"/img/default.png");
		$('input[type="file"]').val('');
		$('input[name="is_removed"]').val("1");
	  });

});

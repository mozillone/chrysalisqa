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
					number:true,
					maxlength: 10,
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
	 $("#edit_customer").validate({
			rules: {
				first_name:{
					 	required: true,
						maxlength: 50,
						alpha:true
					},
				last_name:{
					 	required: true,
						maxlength: 50,
						alpha:true
					},
				
				 email: {
      				required: true,
      				email: true,
      				remote: {url: "/customer/emailValidation",data: {"user_id":$('input[name="user_id"]').val()},type: "post"},
	   				},
			},
			messages: {
				email:
                 {
                    required: "Enter a valid  user email",
                    email: "Please enter a valid email address.",
                    remote: "This email is already taken."
                 },
			}
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
	$(".remove_pic").on("click",function(){
		$('#img-chan').attr('src',"/profile_img/default.jpg");
		$('input[type="file"]').val('');
		$('input[name="is_removed"]').val("1");
	  });

});

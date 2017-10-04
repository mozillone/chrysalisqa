$(function(){
        $("#customer_create").validate({
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
				password: {
					required: true,
					minlength: 5,
					maxlength: 15,
				},
			},
			messages: {
				email:
                 {
                    required: "Enter a valid  user email",
                    email: "Please enter a valid email address.",
<<<<<<< HEAD
                    remote: "This email is already registered."
=======
                    remote: "This email is already taken."
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                 },
			}
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
<<<<<<< HEAD
                    remote: "This email is already registered."
=======
                    remote: "This email is already taken."
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                 },
			}
		});

	  $("#profile_logo").on('change', function() {
		 	var countFiles = $(this)[0].files.length;
			var imgPath = $(this)[0].value;
			var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
			var image_holder = $("#img-chan");
			//image_holder.empty();
			if (extn == "jpg" || extn == "jpeg" || extn == "png") {
				if (typeof(FileReader) != "undefined") {
					//loop for each file selected for uploaded.
					for (var i = 0; i < countFiles; i++) 
					{
						if($(this)[0].files[i].size>=2997447){
								swal({   
								title: "Size limit exceeded",   
								text: "Upload image size less than 3Mb",   
								type: "warning",   
								showCancelButton: false,
								fieldset:false,
								confirmButtonColor: "#DD6B55",   
								confirmButtonText: "Ok",   
							closeOnConfirm: true 
							});
						}else{
							var reader = new FileReader();
							reader.readAsDataURL($(this)[0].files[i]);
							reader.onload = function(e) {
								$('#img-chan').attr('src',e.target.result);
							}
							image_holder.show();
						}
					}
					} else {
					swal("This browser does not support FileReader.");
				}
				} else {
				swal({   
					title: "File doesn't Support",   
					text: "Upload .JPG, .JPEG, .PNG Images only.!",   
					type: "warning",   
					showCancelButton: false,
					fieldset:false,
					confirmButtonColor: "#DD6B55",   
					confirmButtonText: "Ok",   
				closeOnConfirm: true 
				});
			}
		});
$(".remove_pic").on("click",function(){
	$('#img-chan').attr('src',"/profile_img/default.jpg");
	$('input[type="file"]').val('');
	$('input[name="is_removed"]').val("1");
  });
$("#pwd_shw").click(function(){
            var passwordField = $('#password');
            showHidePassword(passwordField, $(this));
   });
function showHidePassword(passwordField, obj){

            var passwordFieldType = passwordField.attr('type');

            if(passwordFieldType == 'password')
            {
                passwordField.attr('type', 'text');
                obj.find('span').attr('class', 'glyphicon glyphicon-eye-close');

            } else {
                passwordField.attr('type', 'password');
                obj.find('span').attr('class', 'glyphicon glyphicon-eye-open');
            }
    }
   
})


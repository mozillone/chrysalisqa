$("#change_password").validate();
$("#password").rules("add", {required:true,minlength:8,maxlength:15});
	$("#cpassword").rules("add", {required:true,equalTo:"#password",messages: {
		equalTo: "Password doesn't matches."
	  }});
	






$("#change_password").validate();
$("#password").rules("add", {required:true,minlength:5,maxlength:15});
	$("#cpassword").rules("add", {required:true,equalTo:"#password",messages: {
		equalTo: "Enter same as password"
	  }});
	






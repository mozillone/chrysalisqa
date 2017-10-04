$("#change_password").validate();
<<<<<<< HEAD
$("#password").rules("add", {required:true,minlength:8,maxlength:15});
	$("#cpassword").rules("add", {required:true,equalTo:"#password",messages: {
		equalTo: "Password doesn't matches."
=======
$("#password").rules("add", {required:true,minlength:5,maxlength:15});
	$("#cpassword").rules("add", {required:true,equalTo:"#password",messages: {
		equalTo: "Enter same as password"
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
	  }});
	






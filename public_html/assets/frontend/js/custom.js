$(function(){
	$("#loginpopup").validate();
	$("#loginpopup_email").rules("add", {required:true,email: true,messages: {
		email: "Enter a valid  user email"
	  }});
	$("#loginopup_password").rules("add", {required:true,minlength:5,maxlength:15});
	
	
	$("#signup_pop").validate();
	$("#pop_first_name").rules("add", {required:true});
	$("#pop_last_name").rules("add", {required:true});
	$("#popup_email").rules("add", {required:true,email: true,remote: {url: "/emailValidation",type: "post"},messages: {
		email: "Enter a valid  user email",
		remote: "This email is already taken."
	  }});

	$("#popup_password").rules("add", {required:true,minlength:5,maxlength:15});
	$("#pop_cpassword").rules("add", {required:true,equalTo:"#popup_password",messages: {
		equalTo: "Enter same as password"
	  }});
	
	$("#forgetpopup_password").validate();
	$("#forgotpop_email").rules("add", {required:true,email: true,remote: {url: "/forgot/emailVerification",type: "post"},messages: {
		email: "Enter a valid  user email",
	remote: "This email is already taken."
	  }});
	


})
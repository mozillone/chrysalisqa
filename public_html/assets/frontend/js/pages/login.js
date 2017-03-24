
var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    
} 
// $('.nav-tabs a').on('shown.bs.tab', function (e) {
//     window.location.hash = e.target.hash;
// })
	$("#login").validate();
	$("#login_email").rules("add", {required:true,email: true,messages: {
		email: "Enter a valid  user email"
	  }});
	$("#login_password").rules("add", {required:true,minlength:5,maxlength:15});
	
	$("#signup").validate();
	$("#first_name").rules("add", {required:true});
	$("#last_name").rules("add", {required:true});
	$("#signup_email").rules("add", {required:true,email: true,remote: {url: "/emailValidation",type: "post"},messages: {
		email: "Enter a valid  user email",
		remote: "This email is already taken."
	  }});
	$("#signup_password").rules("add", {required:true,minlength:5,maxlength:15});
	$("#cpassword").rules("add", {required:true,equalTo:"#signup_password",messages: {
		equalTo: "Enter same as password"
	  }});
	
	$("#forgotpassword").validate();
	$("#forgot_email").rules("add", {required:true,email: true,remote: {url: "/forgot/emailVerification",type: "post"},messages: {
		email: "Enter a valid  user email",
		remote: "This email is already taken."
	  }});







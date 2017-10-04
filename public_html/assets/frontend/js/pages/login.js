
var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    
} 
// $('.nav-tabs a').on('shown.bs.tab', function (e) {
//     window.location.hash = e.target.hash;
// })
<<<<<<< HEAD
	$('#login_email').click(function(){
		$('.error').html('');
	});
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
	$("#login").validate();
	$("#login_email").rules("add", {required:true,email: true,messages: {
		email: "Enter a valid  user email"
	  }});
	$("#login_password").rules("add", {required:true,minlength:5,maxlength:15});
	
	$("#signup").validate();
<<<<<<< HEAD
	$("#username").rules("add", {required:true,remote: {url: "/usernameValidation",type: "post"},messages: {
		email: "Enter a valid  Username",
		remote: "This Username is already registered."
	  }});
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
	$("#first_name").rules("add", {required:true});
	$("#last_name").rules("add", {required:true});
	$("#signup_email").rules("add", {required:true,email: true,remote: {url: "/emailValidation",type: "post"},messages: {
		email: "Enter a valid  user email",
<<<<<<< HEAD
		remote: "This email is already registered."
	  }});
	$("#signup_password").rules("add", {required:true,minlength:8,maxlength:15});
	$("#cpassword").rules("add", {required:true,equalTo:"#signup_password",messages: {
		equalTo: "Password doesn't matches."
=======
		remote: "This email is already taken."
	  }});
	$("#signup_password").rules("add", {required:true,minlength:5,maxlength:15});
	$("#cpassword").rules("add", {required:true,equalTo:"#signup_password",messages: {
		equalTo: "Enter same as password"
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
	  }});
	
	$("#forgotpassword").validate();
	$("#forgot_email").rules("add", {required:true,email: true});







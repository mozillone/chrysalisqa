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
	
    $(".mobile-plus").click(function(){
	$(this).toggleClass("mobile-minus");	
    $(this).parent("li").find(".responsive-inner").toggleClass("none-rm");
    });
	
    $(".icon-rm .toggle-btn").click(function(){
	$(this).parent(".icon-rm").toggleClass("btn-cross");	
	$(".mobile-rm").toggleClass("toggle");	
    });	



   if ($(window).width() < 1024) {
	   $(".footer_head ul").slideUp('fast');   

	   $('#footer-middle .footer_head').find('h5').click(function(){ 
		   $(this).parent().parent(".col-md-4").toggleClass('active').siblings().removeClass('active'); 
		   $(this).next().slideToggle('fast'); //Hide the other panels 
		   $(".footer_head ul").not($(this).next()).slideUp('fast');
	   });
   }
})
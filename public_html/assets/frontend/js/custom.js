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
	$("#signup_pop1").validate({
            rules: {
                first_name:{
                        required: true,
                        maxlength: 50
                    },
                last_name:{
                        required: true,
                          maxlength: 50,
                    },
                email:{
                       required:true,
                       email: true,
                       remote: {url: "/emailValidation",type: "post"},messages: {
						email: "Enter a valid  user email",
						remote: "This email is already taken."
					  }
                    },
                    }
       
        });

	
	$("#forgetpopup_password").validate();
	$("#forgotpop_email").rules("add", {required:true,email: true});
	
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
    $(document).on('click','.signup_popup', function(){
   		  $('#loginpopup')[0].reset();
   		  $('#signup_pop')[0].reset();
   		  $('label.error').remove();
   		  $('.tab-pane').removeClass('active');
   		  $('#login_tab1').addClass('active');
   		  $('.first_active').trigger('click');
   		  $('#signup_popup').modal('show');
        });
})
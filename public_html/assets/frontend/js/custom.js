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
     $(document).on('click','.mini-cart', function(){
   		 	$.ajax({
			type: 'GET',
			url: '/getMiniCartProducts',
			success: function(response){
				if(response.length){
					var cart='<div class="cart_page_vew"><div class="well"><div class="shipping_date"><span>'+response.length+' Item Added</span><a href="/cart">View & Edit Cart</a><span class="shi_date_right text-right right"><span classs="subtl">Subtotal</span><span class="ctr-tl-price"> $'+response[0].total+'</span></span></div><div class="row scels">';
				$.each(response,function(i,value){
					var path='/costumers_images/Medium/'+value.image+'';
					if(fileExists(src)){
						var src=path;
					}else{
						var src='/costumers_images/default-placeholder.jpg';
					}
					cart+='<div class="col-md-12 col-sm-12 col-xs-12"><div class=""><div class="media-left"><img src='+src+' class="media-object" height="65px" width="50px"></div><div class="media-body"><h4 class="media-heading">'+value.costume_name+'</h4><p><b>Item Condition:</b>'+value.condition+'</p><p><b>Size:</b>'+value.size+'</p></div></div></div>'
				});
				cart+='</div></div><div class="chk-out"><a href="#">Proceed to Checkout</a></div></div>';
				}else{
					var cart="<div class='empty-cart'>You have no items in your shopping cart.</div>";
				}
				$('.cart-products').html(cart);
			}
			});	
        });
     function fileExists(url) {
	    if(url){
	        var req = new XMLHttpRequest();
	        req.open('GET', url, false);
	        req.send();
	        return req.status==200;
	    } else {
	        return false;
	    }
	}
	  $(document).on('show','.accordion', function (e) {
         //$('.accordion-heading i').toggleClass(' ');
         $(e.target).prev('.accordion-heading').addClass('accordion-opened');
    });
    
    $(document).on('hide','.accordion', function (e) {
        $(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
        //$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
    });
    
})
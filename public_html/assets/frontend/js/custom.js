
$(function(){$("body").on("click",".main_cat_url_class > a",function(event){main_cat_url=$(this).attr('data-cat-url');window.location.href=main_cat_url;});$("#loginpopup").validate();$("#loginpopup_email").rules("add",{required:true,email:true,messages:{email:"Enter a valid  user email"}});$("#loginopup_password").rules("add",{required:true,minlength:5,maxlength:15});$("#loginpopup1").validate();$("#loginpopup_email1").rules("add",{required:true,email:true,messages:{email:"Enter a valid  user email"}});$("#loginopup_password1").rules("add",{required:true,minlength:5,maxlength:15});$("#signup_pop").validate();$("#pop_first_name").rules("add",{required:true});$("#pop_username").rules("add",{required:true,remote:{url:"/usernameValidation",type:"post"},messages:{email:"Enter a valid  Username",remote:"This Username is already registered."}});$("#pop_last_name").rules("add",{required:true});$("#popup_email").rules("add",{required:true,email:true,remote:{url:"/emailValidation",type:"post"},messages:{email:"Enter a valid  user email",remote:"This email is already registered."}});$("#popup_password").rules("add",{required:true,minlength:8,maxlength:15});$("#pop_cpassword").rules("add",{required:true,equalTo:"#popup_password",messages:{equalTo:"Passwords don't match."}});$("#signup_pop1").validate({rules:{first_name:{required:true,maxlength:50},username:{required:true,remote:{url:"/usernameValidation",type:"post"}},last_name:{required:true,maxlength:50,},email:{required:true,email:true,remote:{url:"/emailValidation",type:"post"}},password:{required:true,minlength:8},cpassword:{required:true,equalTo:"#popup_password"}},messages:{email:{remote:"This email is already registered."},cpassword:{equalTo:"Passwords don't match."}}});$("#forgetpopup_password").validate();$("#forgotpop_email").rules("add",{required:true,email:true});$("#single_forgetpopup_password").validate();$("#sing_forgotpop_email").rules("add",{required:true,email:true});$(".mobile-plus").click(function(){$(this).toggleClass("mobile-minus");$(this).parent("li").find(".responsive-inner").toggleClass("none-rm");});$(".icon-rm .toggle-btn").click(function(){$(this).parent(".icon-rm").toggleClass("btn-cross");$(".mobile-rm").toggleClass("toggle");});if($(window).width()<1024){$(".footer_head ul").slideUp('fast');$('#footer-middle .footer_head').find('h5').click(function(){$(this).parent().parent(".col-md-4").toggleClass('active').siblings().removeClass('active');$(this).next().slideToggle('fast');$(".footer_head ul").not($(this).next()).slideUp('fast');});}$(document).on('click','.signup_popup',function(){$('#loginpopup')[0].reset();$('#signup_pop')[0].reset();$('label.error').remove();$('#login_tab1').addClass('active');$('.lgn').addClass('active in');$('.sign').removeClass('active in');$('.fpswd').removeClass('active in');$('#signup_popup').modal('show');});$(document).on('click','.first_active',function(){$('.lgn').addClass('active in');$('.sign').removeClass('active in');$('.fpswd').removeClass('active in');});$(document).on('click mouseover','.mini-cart',function(){var qty=0;$.ajax({type:'GET',url:'/getMiniCartProducts',success:function(response){if(response['basic'].length){var cart='<div class="cart_page_vew"><div class="well"><div class="shipping_date cart-price"><span><b class="qty">0</b> Items Added<br><a href="/cart">View & Edit Cart</a></span><span class="shi_date_right text-right right"><span classs="subtl">Subtotal</span><span class="ctr-tl-price"> $'+response['basic'][0].total+'</span></span></div><div class="row scels">';$.each(response['basic'],function(i,value){qty=parseInt(qty)+parseInt(value.qty);var path='/costumers_images/Small/'+value.image+'';if(fileExists(path)){var src=path;}else{var src='/costumers_images/default-placeholder.jpg';}cart+='<div class="col-md-12 col-sm-12 col-xs-12"><div class=""><div class="media-left"><img src='+src+' class="media-object" ></div><div class="media-body"><h4 class="media-heading"><a href="/product'+value.url_key+'">'+value.costume_name+'</a></h4><p>Condition :'+capitalizationCondition(value.condition)+'</p><p class="sizess">Size :'+capitalization(value.size)+'</p></div></div></div>'});cart+='</div></div><div class="chk-out"><a href="/checkout">Proceed to Checkout</a></div></div>';}else{var cart="<div class='empty-cart'>You have no items in your shopping cart.</div>";}$('.cart-products').html(cart);$('.qty').text(qty);}});});function fileExists(url){if(url){var req=new XMLHttpRequest();req.open('GET',url,false);req.send();return req.status==200;}else{return false;}}$(document).on('show','.accordion',function(e){$(e.target).prev('.accordion-heading').addClass('accordion-opened');});$(document).on('hide','.accordion',function(e){$(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');});function capitalizationCondition(name){return name.replace(/_/g, ' ').replace(/\b./g, function(m){ return m.toUpperCase(); });};function capitalization(name){firstChar=name.substring(0,1);firstChar.toUpperCase();tail=name.substring(1);name=firstChar.toUpperCase()+tail;return name;}if(jQuery(window).width()<767){jQuery(".bxslider-strt").insertBefore(".priceview_rm");jQuery(".bxslider-strt").insertAfter(".mobile_list_view");jQuery(".single_view_details").insertAfter(".viewBtn_rm");jQuery(".col-md-6.col-sm-6.col-xs-12.video_dv").insertAfter(".col-md-6.col-sm-6.col-xs-12.video_cnt");jQuery(".col-md-6.col-sm-6.col-xs-12.video_cnt_top").insertBefore(".col-md-6.col-sm-6.col-xs-12.video_btm");jQuery(".col-md-6.col-sm-6.col-xs-12.submission-form.contact-page").insertBefore(".col-md-6.col-sm-6.col-xs-12.cnt_sprt_map");}function toggleIcon(e){$(e.target).prev('.panel-group-mobile-cms').find(".more-less").toggleClass('glyphicon-plus glyphicon-minus');}$('.panel-group-mobile-cms').on('hidden.bs.collapse',toggleIcon);$('.panel-group-mobile-cms').on('shown.bs.collapse',toggleIcon);$(".mb-searchs").click(function(){$(".mble_srch-div").toggle();$(".close").click(function(){$(".mble_srch-div").hide();});});$('.main_menu ul.nav li.dropdown').hover(function(){$(this).find('.dropdown-menu').stop(true,true).delay(100).fadeIn(300);},function(){$(this).find('.dropdown-menu').stop(true,true).delay(100).fadeOut(300);});$(document).on('mouseover','.btn',function(){$("[data-toggle=tooltip]").tooltip();})
$('#submit').on('click',function(a){a.preventDefault();str=true;var subscribe_email=$('#subscribe_email').val();var emailpattern=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;if(subscribe_email==""){$('#subscribe_email').css('border','1px solid red');$('#subscribeerror').html('Enter Email');str=false;}if(subscribe_email!=''&&!emailpattern.test(subscribe_email)){$('#subscribe_email').css('border','1px solid red');$('#subscribeerror').html('Enter Valid Email');str=false;}if(str==true){$.ajax({type:"POST",url:"/subscribenews",dataType:"json",data:{subscribe_email:subscribe_email},success:function(data){console.log(data);if(data.code=="200"){$('#subscribe_email').val('');Lobibox.notify.closeAll();Lobibox.notify('success',{size:'mini',title:'Newsletter',msg:"Thanks for signing up for our newsletter! Please check your inbox to confirm your email address.",});}if(data.code=="204"){Lobibox.notify.closeAll();Lobibox.notify('error',{size:'mini',title:'Newsletter',msg:"Exists",});}if(data.code=="422"){Lobibox.notify.closeAll();Lobibox.notify.closeAll();Lobibox.notify('error',{size:'mini',title:'Newsletter',msg:"We already have you on the mailing list.",});}}});}return str;});})
$('.respnsive-ser-rm').click(function(){if($(this).hasClass('red')){$(this).addClass('blue').removeClass('red');}else{$(this).addClass('red').removeClass('blue');}});

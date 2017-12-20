$(document).ready(function(){
	 $("#report").validate({
			rules: {
				name: {
					required: true,
				},
				email: {
					required: true,
					email: true,
				},
				phone: {
					required: true,
				},
				reason: {
					required: true
				}
			}
		});

		$('.bxslider').bxSlider({
		  pagerCustom: '#bx-pager',
		  controls: false
		});

		$('.bxslider-rm').bxSlider({
		minSlides: 3,
		  maxSlides: 5,
		  slideWidth: 170,
		  slideMargin: 10,

		});
		$(".bxslider-rm").parent().parent(".bx-wrapper").addClass("bx-wrapper-rm");
			
		    $(".mobile-plus").click(function(){
			$(this).toggleClass("mobile-minus");	
		    $(this).parent("li").find(".responsive-inner").toggleClass("none-rm");
		    });
			
		    $(".icon-rm .toggle-btn").click(function(){
			$(this).parent(".icon-rm").toggleClass("btn-cross");	
			$(".mobile-rm").toggleClass("toggle");	
		    });
// tabbed content
    // http://www.entheosweb.com/tutorials/css/mobile_list_tabs.asp
    $(".tab_content").hide();
    $(".tab_content:first").show();

  /* if in tab mode */
    $("ul.mobile_list_tabs li").click(function() {
		
      $(".tab_content").hide();
      var activeTab = $(this).attr("rel"); 
      $("#"+activeTab).fadeIn();		
		
      $("ul.mobile_list_tabs li").removeClass("active");
      $(this).addClass("active");

	  $(".tab_drawer_heading").removeClass("d_active");
	  $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
	  
    });
	/* if in drawer mode */
	$(".tab_drawer_heading").click(function() {
      
      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel"); 
      $("#"+d_activeTab).fadeIn();
	  
	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");
	  
	  $("ul.mobile_list_tabs li").removeClass("active");
	  $("ul.mobile_list_tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });
	
	
	/* Extra class "tab_last" 
	   to add border to right side
	   of last tab */
	$('ul.mobile_list_tabs li').last().addClass("tab_last");
			
});
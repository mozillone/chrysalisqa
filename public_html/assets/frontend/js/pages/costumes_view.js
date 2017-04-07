$(document).ready(function(){

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
	
});
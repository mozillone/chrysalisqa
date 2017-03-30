$(document).ready(function() {
	
   $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
navigation:true,
		navigationText: [
		"<i class='fa fa-chevron-left'></i>",
		"<i class='fa fa-chevron-right'></i>"
		],
		items : 4,
		itemsDesktop : [1199,4],
		itemsDesktopSmall : [979,3],
		itemsTablet: [768,3],
		itemsMobile: [480,2]
})
		})
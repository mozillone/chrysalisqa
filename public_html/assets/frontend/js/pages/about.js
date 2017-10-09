function trimBlogTitle() {
    var showTitle = 50;
    var ellipsestext = "...";

    $('.blog-title').each(function() {
        var blogTitle = $(this).html();

        if(blogTitle.length > showTitle) {

            var c = blogTitle.substr(0, showTitle);

            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span>';

            $(this).html(html);
        }

    });
}

function trimBlogDescription() {
    var showDescription = 200;
    var ellipsestext = "...";

    $('.blog-description').each(function() {
        var blogDescription = $(this).html();

        if(blogDescription.length > showDescription) {

            var c = blogDescription.substr(0, showDescription);

            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span>';

            $(this).html(html);
        }

    });
}

$(document).ready(function() {

    $('.our_partner_slider.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        navigation:true,
        navigationText: [
            "<i class='fa fa-chevron-left'></i>",
            "<i class='fa fa-chevron-right'></i>"
        ],
        items : 5,
        itemsDesktop : [1199,5],
        itemsDesktopSmall : [979,3],
        itemsTablet: [768,3],
        itemsMobile: [480,3]
    });


    $('.about_div_scrl').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        navigation:true,
        navigationText: [
            "<i class='fa fa-arrow-left'></i>",
            "<i class='fa fa-arrow-right'></i>"
        ],
        items : 3,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        itemsTablet: [768,3],
        itemsMobile: [480,1]
    })

    $('.leadership_slider').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        navigation:true,
        navigationText: [
            "<i class='fa fa-arrow-left'></i>",
            "<i class='fa fa-arrow-right'></i>"
        ],
        items : 4,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        itemsTablet: [768,2],
        itemsMobile: [480,2]
    })

    trimBlogTitle();
    trimBlogDescription();

});
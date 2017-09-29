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

$(document).ready(function () {
    trimBlogTitle();
    trimBlogDescription();
});
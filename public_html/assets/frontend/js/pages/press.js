function trimBlogTitle() {
    var showTitle = 60;
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

$(document).ready(function () {
    $('.press-link').on('click', function (e){
        e.preventDefault();
        var url = $(this).attr('href');
        window.open(url, '_blank');
    });

    trimBlogTitle();
});
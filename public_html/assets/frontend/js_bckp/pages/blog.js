$(function () {
    $("#save-blog-post").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            name:{
                required: true,
                minlength:3,
                maxlength: 255
            },

            email:{
                required: true,
                email:true
            },
            category:{
                required: true
            },
            title: {
                required: true,
                minlength:5,
                maxlength: 350
            },
            description:{
                minlength:5,
                required: true
            },
        },
        highlight: function(element) {
            $(element).closest('.form-control').addClass('error');
        },
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter($(element).parents('div.input-group'));
            }else{
                error.insertAfter(element);
            }
        },
        messages: {

        },
        errorElement: 'span',
        errorClass: 'error',
    });
});
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
$(function(){


    $("#add_cms_page").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            title:{
                required: true,
                maxlength: 255,
            },
            url:{
                required: true,
                maxlength: 255,
            },
            description:{
                required: true,
            },
            meta_title:{
                required: true,
                maxlength: 127,
            },
            meta_desc: {
                required: true,
                maxlength: 512,
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
            title:{
                required: "Enter Page Title",
            },
            url:{
                required: "Enter Page URL",
            },
            page_desc:{
                required: "Enter Page Description",
            },
            meta_title:{
                required: "Enter Meta Title",
            },
            meta_desc:{
                required: "Enter Meta Description",
            },
        },
        errorElement: 'span',
        errorClass: 'error',
    });

    $("#edit_cms_page").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            title:{
                required: true,
                maxlength: 255,
            },
            url:{
                required: true,
                maxlength: 255,
            },
            description:{
                required: true,
            },
            meta_title:{
                required: true,
                maxlength: 127,
            },
            meta_desc: {
                required: true,
                maxlength: 512,
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
            title:{
                required: "Enter Page Title",
            },
            url:{
                required: "Enter Page URL",
            },
            page_desc:{
                required: "Enter Page Description",
            },
            meta_title:{
                required: "Enter Meta Title",
            },
            meta_desc:{
                required: "Enter Meta Description",
            },
        },
        errorElement: 'span',
        errorClass: 'error',
    });
});

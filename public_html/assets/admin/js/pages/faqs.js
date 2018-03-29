$(function(){

    $("#add_faq").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            title:{
                required: true,
                maxlength: 1024,
            },
            block:{
                required: true,
                maxlength: 160,
            },
            faq_description:{
                required: function()
                {
                    CKEDITOR.instances.faq_description.updateElement();
                },

            },
            sort_no: {
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
            title:{
                required: "Enter FAQ Title",
            },
            block:{
                required: "Please Select The Page Block",
            },
            faq_description:{
                required: "Please Enter FAQ Description",
            },
            sort_no:{
                required: "Please Enter FAQ Order No",
            }
        },
        errorElement: 'span',
        errorClass: 'error',
        focusInvalid: false,
        invalidHandler: function(form, validator) {

            if (!validator.numberOfInvalids())
                return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 1000);

        }
    });

    $("#edit_faq").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            title:{
                required: true,
                maxlength: 1024,
            },
            block:{
                required: true,
                maxlength: 160,
            },
            faq_description:{
                required: function()
                {
                    CKEDITOR.instances.faq_description.updateElement();
                },

            },
            sort_no: {
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
            title:{
                required: "Enter FAQ Title",
            },
            block:{
                required: "Please Select The Page Block",
            },
            faq_description:{
                required: "Please Enter FAQ Description",
            },
            sort_no:{
                required: "Please Enter FAQ Order No",
            }
        },
        errorElement: 'span',
        errorClass: 'error',
        focusInvalid: false,
        invalidHandler: function(form, validator) {

            if (!validator.numberOfInvalids())
                return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 1000);

        }
    });

});

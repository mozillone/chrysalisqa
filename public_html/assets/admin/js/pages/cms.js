$(function(){



    $("#add_cms_page").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            title:{
                required: true,
                
            },
            url:{
                required: true,
                
            },
            meta_title:{
                 required: true,
            },
            meta_desc:{
                  required: true,
            },
            page_desc:{
                         required: function() 
                        {
                         CKEDITOR.instances.page_desc.updateElement();
                        },

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
        focusInvalid: false,
        invalidHandler: function(form, validator) {

            if (!validator.numberOfInvalids())
                return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 1000);

        }
    });

    $("#edit_cms_page").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            title:{
                required: true,
                maxlength: 255,
            },
           meta_title:{
                 required: true,
            },
            meta_desc:{
                  required: true,
            },
            page_desc:{
                         required: function() 
                        {
                         CKEDITOR.instances.page_desc.updateElement();
                        },

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
        focusInvalid: false,
        invalidHandler: function(form, validator) {

            if (!validator.numberOfInvalids())
                return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 1000);

        }
    });


    $("#add_cms_block").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            title:{
                required: true,
                maxlength: 160,
            },
            slug:{
                required: true,
            },
            description:{
                required: function()
                {
                    CKEDITOR.instances.description.updateElement();
                },
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
                required: "Enter The Block Title",
            },
            slug:{
                required: "Please Select The Page",
            },
            description:{
                required: "Enter The Block Description",
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

    $("#edit_cms_block").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            title:{
                required: true,
                maxlength: 160,
            },
            slug:{
                required: true,
            },
            description:{
                required: function()
                {
                    CKEDITOR.instances.description.updateElement();
                },
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
                required: "Enter The Block Title",
            },
            slug:{
                required: "Please Select The Page",
            },
            description:{
                required: "Enter The Block Description",
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

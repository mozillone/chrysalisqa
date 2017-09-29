$(function(){

    $("#inquire_costume").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            user_name:{
                required: true,
                minlength:3,
                maxlength: 60
            },
            user_email:{
                required: true,
                email:true
            },
            user_message:{
                required: true,
                minlength:5,
                maxlength: 255
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
            user_name:{
                required: "Please Enter Your Name",
                minlength: "The Minimum Length Of The Message Is 3 Characters",
                maxlength: "The Maximum Length Of The Message Is 60 Characters",
            },
            user_email:{
                required: "Please Enter The Email ID",
                email: "Please Enter Valid Email ID"
            },
            user_message:{
                required: "Please Enter The Message",
                minlength: "The Minimum Length Of The Message Is 5 Characters",
                maxlength: "The Maximum Length Of The Message Is 255 Characters",
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

});

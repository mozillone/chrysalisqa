$(function(){


    $("#add_blog_post").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            title:{
                required: true,
                maxlength: 255,
            },

            blogImage:{
                required: true,
            },
            status:{
                required: true
            },
            category: {
                required: true
            },
            blogTags:{
                required: true
            },
            post_desc:{
                         required: function() 
                        {
                         CKEDITOR.instances.post_desc.updateElement();
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
                required: "Enter Blog Post Title",
            },
            description:{
                required: "Enter Blog Post Description",
            },
            status:{
                required: "Please Select The Blog Post Status",
            },
            category:{
                required: "Please Select The Blog Post Category",
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

    $("#edit_blog_post").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
             title:{
                required: true,
                maxlength: 255,
            },
            status:{
                required: true
            },
            category: {
                required: true
            },
            blogTags:{
                required: true
            },
            post_desc:{
                         required: function() 
                        {
                         CKEDITOR.instances.post_desc.updateElement();
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
                required: "Enter Blog Post Title",
            },
            description:{
                required: "Enter Blog Post Description",
            },
            status:{
                required: "Please Select The Blog Post Status",
            },
            category:{
                required: "Please Select The Blog Post Category",
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


    $("#addBlogCategory").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            name: {
                required: true,
                maxlength: 255,
            }
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
            name:{
                required: "Enter Blog Category",
            }
        },
        errorElement: 'span',
        errorClass: 'error',
    });

    $("#blog_image").on('change', function(){
//Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#img-chan");
        image_holder.empty();
        var size = parseFloat($("#blog_image")[0].files[0].size / 1024).toFixed(2);
        if (extn == "jpg" || extn == "jpeg" || extn == "png") {
            if(size<10000)
            {
                if (typeof(FileReader) != "undefined") {

                    for (var i = 0; i < countFiles; i++)
                    {
                        var reader = new FileReader();
                        reader.onload = function(e) {

                            $('#img-chan').attr('src',e.target.result);
                        }
                        image_holder.show();
                        reader.readAsDataURL($(this)[0].files[i]);
                    }
                } else {
                    swal("This browser does not support FileReader.");
                }

            } else {


                $("#blog_image").val("");
                swal({
                    title: "File doesn't Support",
                    text: "Upload Below 10MB Size Only",
                    type: "warning",
                    showCancelButton: false,
                    fieldset:false,
                    confirmButtonColor: "#DD6B55 ",
                    confirmButtonText: "Ok",
                    closeOnConfirm: true });
            }
        } else {
//swal("");
            swal({
                title: "File doesn't Support",
                text: "Upload .JPG, .JPEG, .PNG Images only.!",
                type: "warning",
                showCancelButton: false,
                fieldset:false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            $('input[type="file"]').val('');
            $('input[name="avatar"]').val("1");
        }
    });

    $(".remove_pic").on("click",function(){
        $('#img-chan').attr('src',"/blog_images/preview_placeholder.png");
        $('input[type="file"]').val('');
        $('input[name="imageExists"]').val("removed");
    });

});

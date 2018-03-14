$(function(){


    $("#add_blog_post").validate({
        onfocusout: function(element) { $(element).valid(); },
        rules: {
            title:{
                required: true,
                maxlength: 255,
            },

            imageExists:{
                required: true,
            },
            status:{
                required: true
            },
            category: {
                required: true
            },
            dummyBlogTags:{
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
            if(element.attr("name") == 'blogTags'){
                error.insertAfter(".selectize-control");
            }else if(element.attr("name") == 'category'){
                error.insertAfter(".blog-categories");
            }else if(element.attr("name") == 'post_desc'){
                error.insertAfter("#cke_post_desc");
            }else if(element.attr('name') == 'blogImage'){
                error.insertAfter(".fileupload");
            }else if(element.parent('.input-group').length){
                error.insertAfter($(element).parents('div.input-group'));
            }else{
                error.insertAfter(element);
            }
            /*if(element.parent('.input-group').length) {
                error.insertAfter($(element).parents('div.input-group'));
            }else{
                error.insertAfter(element);
            }*/
        },
        messages: {
            title:{
                required: "Enter Blog Post Title",
            },
            post_desc:{
                required: "Enter Blog Post Description",
            },
            status:{
                required: "Select Blog Post Status",
            },
            category:{
                required: "Select Blog Post Category",
            },
            dummyBlogTags:{
                required: "Enter Blog Tags"
            },
            imageExists:{
                required: "Select Blog Image"
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
            if(element.attr("name") == 'blogTags'){
                error.insertAfter(".selectize-control");
            }else if(element.attr("name") == 'category'){
                error.insertAfter(".blog-categories");
            }else if(element.attr("name") == 'post_desc'){
                error.insertAfter("#cke_post_desc");
            }else if(element.attr('name') == 'blogImage'){
                error.insertAfter(".fileupload");
            }else if(element.parent('.input-group').length){
                error.insertAfter($(element).parents('div.input-group'));
            }else{
                error.insertAfter(element);
            }
           /* if(element.parent('.input-group').length) {
                error.insertAfter($(element).parents('div.input-group'));
            }else{
                error.insertAfter(element);
            }*/
        },
        messages: {
            title:{
                required: "Enter Blog Post Title",
            },
            post_desc:{
                required: "Enter Blog Post Description",
            },
            status:{
                required: "Select Blog Post Status",
            },
            category:{
                required: "Select Blog Post Category",
            },
            blogTags:{
                required: "Enter Blog Tags"
            },
            blogImage:{
                required: "Select Blog Image"
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
        //image_holder.empty();
        $(".rmvimg").append('<span class="remove_pic" id="removeImg"><i class="fa fa-times-circle" aria-hidden="true"></i></span>');
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
                            $('input[name="imageExists"]').val("1");

                        }
                        image_holder.show();
                        reader.readAsDataURL($(this)[0].files[i]);
                        $(".fileupload").next().remove();
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
        $('input[name="imageExists"]').val("");
        $("#removeImg").remove();
    });
    $(document).on('click','#removeImg',function(){
        $('#img-chan').attr('src',"/blog_images/preview_placeholder.png");
        $('input[type="file"]').val('');
        $('input[name="imageExists"]').val("");
        $("#removeImg").remove();
    });
    $('#blog-tags').on('itemRemoved', function(event) {
        $('#dummyBlogTags').val($('#blog-tags').val());
        
    });
    $('input').on('itemAdded', function(event) {
        $('#dummyBlogTags').val($('#blog-tags').val());
    });

});

$("#press-create").validate({
    rules: {
        postTitle:{
            required: true,
            minlength:5,
            maxlength:255
        },
        postSource:{
            required: true,
            url: true
        },
        press_image:{
            required: true
        },
        postDesc:{
            required: function()
            {
            CKEDITOR.instances.postDesc.updateElement();
            },
            minlength: 5
        },
        status:{
            required: true
        },
    },
    focusInvalid: false,
    invalidHandler: function(form, validator) {

        if (!validator.numberOfInvalids())
            return;

        $('html, body').animate({
            scrollTop: $(validator.errorList[0].element).offset().top
        }, 1000);

    }

});
$("#press-update").validate({
    rules: {
        postTitle:{
            required: true
        },
        postSource:{
            required: true
        },
        postDesc:{
             required: function()
            {
             CKEDITOR.instances.postDesc.updateElement();
            },
            minlength: 5
        },
        
    },
    focusInvalid: false,
    invalidHandler: function(form, validator) {

        if (!validator.numberOfInvalids())
            return;

        $('html, body').animate({
            scrollTop: $(validator.errorList[0].element).offset().top
        }, 1000);

    }

});


$("#press_image").on('change', function(){
    //Get count of selected files
    var countFiles = $(this)[0].files.length;
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    var image_holder = $("#img-chan");
    image_holder.empty();
    var size = parseFloat($("#press_image")[0].files[0].size / 1024).toFixed(2);
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


            $("#press_image").val("");
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
        $('input[name="press_image"]').val("1");
    }

   $(".remove_pic").on("click",function(){
        $('#img-chan').attr('src',"/default_pic.png");
        $('input[type="file"]').val('');
       $('input[name="imageExists"]').val("removed");
    });


});
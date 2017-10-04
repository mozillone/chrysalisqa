<<<<<<< HEAD
$(function(){

// custom method for url validation with or without http://
$.validator.addMethod("event_url", function(value, element) { 
    if(value.substr(0,7) != 'http://'){
        value = 'http://' + value;
    }
    if(value.substr(value.length-1, 1) != '/'){
        value = value + '/';
    }
    return this.optional(element) || /^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(value); 
}, "Not valid url.");    

$("#events-create").validate({

    rules: {
        eventname:{
            required: true,
            minlength: 5,
            maxlength: 255,
        },
        eventurl:{
            required: true,
            event_url: true,
        },
        fromdate:{
            required: true,
        },
        fromtime:{
            required: true,
        },
        todate:{
            required: true,
        },
        totime:{
            required: true,
        },

        location:{
            required: true,
        },
        event_image:{
              required: true,
          },
        eventDesc:{
            required: function()
            {
                CKEDITOR.instances.eventDesc.updateElement();
            },

            minlength:10,
            maxlength: 350,
        }

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
$("#events-update").validate({
    rules: {
        eventName:{
            required: true,
            minlength: 5,
            maxlength: 255
        },
        eventUrl:{
            required: true,
            event_url: true
        },
        fromDate:{
            required: true
        },
        fromTime:{
            required: true
        },
        toDate:{
            required: true
        },
        toTime:{
            required: true
        },
        eventDesc:{
            required: function()
            {
                CKEDITOR.instances.eventDesc.updateElement();
            },
            minlength: 5,
            maxlength: 350
        },
        location:{
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


$("#event_image").on('change', function(){

//Get count of selected files
    var countFiles = $(this)[0].files.length;
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    var image_holder = $("#img-chan");
    image_holder.empty();
    var size = parseFloat($("#event_image")[0].files[0].size / 1024).toFixed(2);
    if (extn == "jpg" || extn == "jpeg" || extn == "png") {
        if(size < 10000)
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


            $("#event_image").val("");
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
    $('#img-chan').attr('src',"/press_images/default_pic.png");
    $('input[type="file"]').val('');
    $('input[name="is_removed"]').val("1");
});
});
=======
$("#events-create").validate({
            rules: {
                eventName:{
                        required: true 
                    },
                eventUrl:{
                        required: true
                    },
                fromDate:{
                        required: true
                    },
                fromTime:{
                        required: true
                    },
                toDate:{
                        required: true
                    },
                toTime:{
                        required: true
                    },
                eventDesc:{
                        required: true
                    },
                eventTags:{
                        required: true
                    },
                location:{
                        required: true
                    },
                }
 	
        }); 
$("#events-update").validate({
            rules: {
                eventName:{
                        required: true 
                    },
                eventUrl:{
                        required: true
                    },
                fromDate:{
                        required: true
                    },
                fromTime:{
                        required: true
                    },
                toDate:{
                        required: true
                    },
                toTime:{
                        required: true
                    },
                eventDesc:{
                        required: true
                    },
                eventTags:{
                        required: true
                    },
                location:{
                        required: true
                    },
                }
    
        }); 
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

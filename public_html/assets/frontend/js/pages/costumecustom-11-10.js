$(function(){
    var imgdata;
    $("#upload_next").click(function(a) {

        a.preventDefault();
        str = true;
        $('input[name=file1],input[name=file2],input[name=file3]').css('border', '');
        $('#file1_error,#file2_error,#file3_error').html('');
        var file1 = $('input[name=file1]').val();
        var file2 = $('input[name=file2]').val();
        var file3 = $('input[name=file3]').val();

        if (file1 == '') {
            $('input[name=file1]').css('border', '1px solid red');
            $('#file1_error').html('Upload Front View');
            str = false;
        }
        if (file2 == '') {
            $('input[name=file2]').css('border', '1px solid red');
            $('#file2_error').html('Upload Back View');
            str = false;
        }
        /*if(file3==''){
         $('input[name=file3]').css('border','1px solid red');
         $('#file3_error').html('Upload Detail/Accessories');
         str=false;
         }*/
        if (str == true) {
            $('#step2').addClass('active');
            $('#upload_div').css('display', 'none');
            $('#costume_description').css('display', 'block');
            $('#pricing_div').css('display', 'none');
            $('#preferences_div').css('display', 'none');

        }
        return str;

    });

    $('#donate_charity').change(function() {
        if ($(this).val() == "none") {
            $('input[name=charity_name]').prop('checked', false);
        }
    });

    $('#another_charity').change(function() {
        if ($(this).prop("checked") == true) {
            $('input[name=charity_name]').prop('checked', false);
        }
    });

    $('input[name=file1]').change(function() {
        $('#drag_n_drop_1').css('display', 'block');
    });
    $('input[name=file2]').change(function() {
        $('#drag_n_drop_2').css('display', 'block');
    });
    $('#drag_n_drop_1').click(function() {
        $('#front_view').find('li').remove();
        $('#drag_n_drop_1').css('display', 'none');
        $('input[name=file1]').val('');
    });

    $('#shipping').change(function() {
        if ($(this).val() == 16) {
            $('#service_div').css('display', 'none');
        } else {
            $('#service_div').css('display', 'block');
        }
    });
    $('#free_shipping').click(function() {
        $('#service_div').css('display', 'none');
        $('#shipping').val('16');
    });
    $('#drag_n_drop_2').click(function() {
        $('#back_view').find('li').remove();
        $('#drag_n_drop_2').css('display', 'none');
        $('input[name=file2]').val('');
    });

    $('input[name=file3]').change(function() {
        $('#drag_n_drop_3').css('display', 'block');
    });
    $('#drag_n_drop_3').click(function() {
        $('#details_view').find('li').remove();
        $('#drag_n_drop_3').css('display', 'none');
        $('input[name=file3]').val('');
    });
    

    $('#price').keyup(function() {
        var donate_percent = $('#donate_charity').val();
        var price = $('#price').val();
        var total = (price * donate_percent) / 100;
        if (donate_percent == "none") {
            var total = 0.00;
        }
        $('#hidden_donation_amount').val(parseFloat(total).toFixed(2));
        $('#dynamic_percent_amount').html("<i class='fa fa-usd' aria-hidden='true'></i> " + parseFloat(total).toFixed(2));
    });
    //numeric condition
    $("#height-ft,#height-in,#weight-lbs,#chest-in,#waist-lbs,#Length,#Width,#Height,#make_costume_time1").on("keyup", function() {
        var valid = /^\d{0,4}(\.\d{0,4})?$/.test(this.value),
            val = this.value;

        if (!valid) {
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });

    $("#price,#charity_amount").on("keyup", function() {
        var valid = /^\d{0,20}(\.\d{0,20})?$/.test(this.value),
            val = this.value;

        if (!valid) {
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    $('#description').on('keyup', function() {
        var input = $(this);
        $('#max_length_char1').text(input.val().length + " of");
    });
    $('#funfacts').on('keyup', function() {
        var input = $(this);
        $('#max_length_char2').text(input.val().length + " of");
    });
    $('#faq').on('keyup', function() {
        var input = $(this);
        $('#max_length_char3').text(input.val().length + " of");
    });
    ////onload div none block
    $('#upload_div').css('display', 'block');
    $('#costume_description').css('display', 'none');
    $('#pricing_div').css('display', 'none');
    $('#preferences_div').css('display', 'none');
    $("#7").click(function() {
        $('#cosplayplay_yes_div').css('display', 'block');
    });
    $("#8").click(function() {
        $('#cosplayplay_yes_div').css('display', 'none');
    });
    $('#9').click(function() {
        $('#uniquefashion_yes_div').css('display', 'block');
    });
    $('#10').click(function() {
        $('#uniquefashion_yes_div').css('display', 'none');
    });
    $('#11').click(function() {
        $('#activity_yes_div').css('display', 'block');
    });
    $('#12').click(function() {
        $('#activity_yes_div').css('display', 'none');
    });
    $('#30').click(function() {
        $('#mention_hours').css('display', 'block');
        $('#mention_hours_input').css('display', 'block');
    });
    $('#33').click(function() {
        $('#film_text').css('display', 'none');
        $('#film_text_input').css('display', 'none');
        $('#film_text_input').val('');
    });
    $('#32').click(function() {
        $('#film_text').css('display', 'block');
        $('#film_text_input').css('display', 'block');
    });
    $('#31').click(function() {
        $('#mention_hours').css('display', 'none');
        $('#mention_hours_input').css('display', 'none');
        $('#mention_hours_input').val('');
    });

    $('#another_charity').click(function() {
        if ($(this).prop("checked") == true) {
            $('#other_organzation_check').css('display', 'block');
        } else if ($(this).prop("checked") == false) {
            $('#other_organzation_check').css('display', 'none');
        }
    });


    $(document).on("click",'input[name=make_costume]',function()
    {
       var cost_val = $(this).val();
       if(cost_val == 31)
       {
           $("#make_costume_time1").val('');
       }
    });

    $(document).on("click",'input[name=fimquality]',function()
    {
        var cost_val = $(this).val();
        if(cost_val == 33)
        {
            $("#film_name").val('');
        }
    });



    /*$('#costume_description_next').click(function(a) {

        a.preventDefault();
        str = true;
        $('#costume_name,#categoryname,#subcategory,#gender,#size,#description,#funfcats,#faq,#height-ft,#height-in,#weight-lbs,#chest-in,#waist-lbs,#funfacts').css('border', '');
        $('#costumename_error,#subcategoryerror,#categoryerror,#gendererror,#sizeerror,#uniquefashionerror,#cosplayerror,#costumeconditionerror,#descriptionerror,#facterror,#faqerror,#activityerror,#bodydimensionerror,#qualityerror,#usercostumeerror').html('');
        var costumename = $('#costume_name').val();
        var category = $('#categoryname').val();
    
        var gender = '';
        var size = $('#size').val();
        var subcategory = $('#subcategory').val();
          
        var description = $('#description').val();
       
        var faq = $('#faq').val();
        var heightft = $('#height-ft').val();
        var heightin = $('#height-in').val();
        var weightlbs = $('#weight-lbs').val();
        var chestin = $('#chest-in').val();
        var waistlbs = $('#waist-lbs').val();
        var costumecondition = "";
        var qualitycostume = "";
        var usercostume = "";
    
        var uniquefashion = "";

      
        if(category == 68){
            if($('input[name="fimquality"]:checked').next().html() == 'No'){
                $('#qualityerror').html('The Film Production category is limited to costumes that have been used on Film and Television sets.');
                str = false;
            }
        }

        if (subcategory == "") {
            $('#subcategory').css('border', '1px solid red');
            $('#subcategoryerror').html('This field is required.');
            str = false;
        }

        if (costumename == '') {
            $('#costume_name').css('border', '1px solid red');
            $('#costumename_error').html('This field is required.');
            str = false;
        }
        if (category == '') {
            $('#categoryname').css('border', '1px solid red');
            $('#categoryerror').html('This field is required.');
            str = false;
        }

        var red  = $('input[name=gender]:checked').val();
        if(red == null)
        {
             $('#gendererror').html('This field is required.');
             str = false;
        }else
        {
             $('#gendererror').html('');
             str = true;
        }

        if ($('input[name=gender]:checked').val() == null || $('input[name=gender]:checked').val() == '') {
            $('#gendererror').html('This field is required.');
            str = false;

        }        
        if (size == '') {
            $('#size').css('border', '1px solid red');
            $('#sizeerror').html('This field is required.');
            str = false;
        } 
        
        if (description == "") {
            $('#description').css('border', '1px solid red');
            $('#descriptionerror').html('This field is required.');
            str = false;
        }
        
        if ($('input[name=condition]:checked').length <= 0) {
            $('#costumeconditionerror').html('This field is required.');
            str = false;

        }
        if ($('input[name=fimquality]:checked').length <= 0) {
            $('#qualityerror').html('This field is required.');
            str = false;

        }
        if ($('input[name=make_costume]:checked').length <= 0) {
            $('#usercostumeerror').html('This field is required.');
            str = false;

        }

        if ($('input[name=fimquality]:checked').val() == 32) {
            if ($('input[name=film_name]').val() == "") {
                $('#qualityerror').html('This field is required.');
                str = false;
            }
        }

        if ($('input[name=make_costume]:checked').val() == 30) {
            if ($('input[name=make_costume_time1]').val() == "") {
                $('#usercostumeerror').html('This field is required.');
                str = false;
            }
        }

       
        if (str == true) {
            $('#step3').addClass('active');
            $('#upload_div').css('display', 'none');
            $('#costume_description').css('display', 'none');
            $('#pricing_div').css('display', 'block');
            $('#preferences_div').css('display', 'none');
        }
        var errorDiv = $('.costume-error').first();
        //console.log(errorDiv);
        var scrollPos = errorDiv.offset().top;
        $(window).scrollTop(scrollPos);
        return str;
    });*/
    
    
    $('#costume_description_next').click(function(a){
    a.preventDefault();
    str=true;
    $('#costume_name,#categoryname,#gender,#size,#description,#funfcats,#faq,#height-ft,#height-in,#weight-lbs,#chest-in,#waist-lbs,#funfacts').css('border','');
    $('#costumename_error,#categoryerror,#gendererror,#sizeerror,#uniquefashionerror,#cosplayerror,#costumeconditionerror,#descriptionerror,#facterror,#faqerror,#activityerror,#bodydimensionerror,#qualityerror,#usercostumeerror').html('');
    var costumename=$('#costume_name').val();
    var category=$('#categoryname').val();
    var gender=$('#gender').val();
    var size=$('#size').val();
    var subcategory = $('#subcategory').val();
    var description=$('#description').val();
    var funfact=$('#funfacts').val();
    var faq=$('#faq').val();
    var heightft=$('#height-ft').val();
    var heightin=$('#height-in').val();
    var weightlbs=$('#weight-lbs').val();
    var chestin=$('#chest-in').val();
    var waistlbs=$('#waist-lbs').val();
    var costumecondition="";
    var qualitycostume="";
    var usercostume="";
    var activity="";
    var cosplay="";
    var uniquefashion="";
    
    if(costumename==''){
      $('#costume_name').css('border','1px solid red');
      $('#costumename_error').html('This field is required.');
      str=false;
    }
    if(category==''){
      $('#categoryname').css('border','1px solid red');
      $('#categoryerror').html('This field is required.');
      str=false;
    }
    if(gender==''){
      $('#gender').css('border','1px solid red');
      $('#gendererror').html('This field is required.');
      str=false;
    }
    if(size==''){
      $('#size').css('border','1px solid red');
      $('#sizeerror').html('This field is required.');
      str=false;
    }
    if(subcategory==''){
      $('#subcategory').css('border','1px solid red');
      $('#subcategoryerror').html('This field is required.');
      str=false;
    }
    if(description==""){
      $('#description').css('border','1px solid red');
      $('#descriptionerror').html('This field is required.');
      str=false;
    }
    /*
    if(funfact=='')
    {
      $('#funfacts').css('border','1px solid red');
      $('#facterror').html('This field is required.');
      str=false;
    }
    if(faq==""){
      $('#faq').css('border','1px solid red');
      $('#faqerror').html('This field is required.');
      str=false;
    }
    */  
    if($('input[name=condition]:checked').length<=0){
      $('#costumeconditionerror').html('This field is required.');
      str=false;
      
    }
    if($('input[name=fimquality]:checked').length<=0){
      $('#qualityerror').html('This field is required.');
      str=false;
      
    }
    if($('input[name=make_costume]:checked').length<=0){
      $('#usercostumeerror').html('This field is required.');
      str=false;
      
    }
    if($('input[name=activity]:checked').length<=0)
    {
      $('#activityerror').html('This field is required.');
      str=false;
      
    }
    if($('input[name=cosplay]:checked').length<=0){
      $('#cosplayerror').html('This field is required.');
      str=false;
      
    }
    if ($('input[name=cosplay]:checked').val() == 7) {
      if ($('input[name=cosplayplay_yes_opt]:checked').length<=0) {

      $('#cosplay_yeserror').html('This field is required.');
      str=false;
      }
    }
    if ($('input[name=fashion]:checked').val() == 9) {
      if ($('input[name=uniquefashion_yes_opt]:checked').length<=0) {

      $('#uniquefashion_yeserror').html('This field is required.');
      str=false;
      }
    }
    if ($('input[name=activity]:checked').val() == 11) {
      if ($('input[name=activity_yes_opt]:checked').length<=0) {

      $('#activity_yeserror').html('This field is required.');
      str=false;
      }
    }
    if ($('input[name=fimquality]:checked').val() == 32) {
      if ($('input[name=film_name]').val() == "") {

      $('#qualityerror').html('This field is required.');
      str=false;
      }
    }
    if ($('input[name=make_costume1]:checked').val() == 30) {

      $('#usercostumeerror').html('This field is required.');
      str=false;
      
    }
    if($('input[name=fashion]:checked').length<=0){
      $('#uniquefashionerror').html('This field is required.');
      str=false;
    }
    if (str == true) {
       
      $('#step3').addClass('active');
      $('#upload_div').css('display','none');
      $('#costume_description').css('display','none');
      $('#pricing_div').css('display','block');
      $('#preferences_div').css('display','none');
         
    }
      var errorDiv = $('.costume-error').first();
      var scrollPos = errorDiv.offset().top;
      $(window).scrollTop(scrollPos);
    return str;
  });

    
    $('#costume_description_back').click(function() {
        $('#step2').removeClass('active');
        $('#upload_div').css('display', 'block');
        $('#costume_description').css('display', 'none');
        $('#pricing_div').css('display', 'none');
        $('#preferences_div').css('display', 'none');
    });

    //front view image adding code here
    $(document).on("change", "#file1", function() {
        $(".modal-footer").show();
        var imgdata = '';
        var imgVal = $(this).val();
        if (imgVal != "") {
            $('#myModal').modal('show');
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreview");
                dvPreview.html("");
                $($(this)[0].files).each(function (index, element ) {
                    var file = $(this);
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var carouselItems = $("<div class='item'></div>");
                        var img = $("<img />");
                        //multiple images code start here
                        var image = img.attr("src", e.target.result);
                        carouselItems.append(image);
                        dvPreview.append(carouselItems);
                        var $image = $('#dvPreview div.item img');
                        var total = $image.length;
                        $('#dvPreview div.item:first-child').addClass('active');
                        setTimeout(function(){
                            $image.cropper({
                                movable: true,
                                zoomable: true,
                                rotatable: false,
                                scalable: false,
                                zoomOnWheel:false,
                                dragMode:'move',
                                minCropBoxWidth:198,
                                minCropBoxHeight:298,
                                cropBoxMovable:true,
                                cropBoxResizable:false,
                                zoomOnTouch:false,
                                viewMode:1,
                                setDragMode:'move',
                                aspectRatio: 3 / 5,
                                center:false,
                                data: {
                                    width: 198,
                                    height:298
                                },
                            });
                            $image.cropper('getCroppedCanvas', {
                                width: 220,
                                height: 298,
                                fillColor: '#fff',
                                imageSmoothingEnabled: false,
                                imageSmoothingQuality: 'high',
                            });
                        }, 1000);

                        $(document).on("input", "#zoom-level", function() {
                            $image.cropper('zoomTo', 0.1);
                            var current_zoom = $(this).val();
                            $image.cropper('zoom', current_zoom);
                        });
                        $(document).on("click", "#crop", function() {
                            $("#myModal").modal('hide');
                            imgdata = $image.cropper('getCroppedCanvas').toDataURL();
                            $(".modalOpen1").attr('value',imgdata);
                            $(".result").attr("src", imgdata);
                            $("#og_image").attr('content',imgdata);
                            $("#success_page").children().find(".media-object").attr('src',imgdata);

                            $(".result").css({ "width": "198px", "height": "298px" });
                            $("#file1").hide();
                            $(this).parents().find("#front_view").children("#drag_n_drop_1").removeClass('hide');

                        });

                    }
                    reader.readAsDataURL(file[0]);
                });
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        } else {
            alert('select proper image');
        }
    });

    //second file image code starts here
    $(document).on("change", "#file2", function() {
        $(".modal-footer").show();
        var imgVal = $(this).val();
        if (imgVal != "") {
            $('#myModal2').modal('show');
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreview2");
                dvPreview.html("");
                $($(this)[0].files).each(function (index, element ) {
                    var file = $(this);
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var carouselItems = $("<div class='item'></div>");
                        var img = $("<img />");
                        //multiple images code start here
                        var image = img.attr("src", e.target.result);
                        carouselItems.append(image);
                        dvPreview.append(carouselItems);
                        var $image = $('#dvPreview2 div.item img');
                        var total = $image.length;
                        $('#dvPreview2 div.item:first-child').addClass('active');
                        setTimeout(function(){
                            $image.cropper({
                                movable: true,
                                zoomable: true,
                                rotatable: false,
                                scalable: false,
                                 zoomOnWheel:false,
                                dragMode:'move',
                                minCropBoxWidth:198,
                                minCropBoxHeight:298,
                                cropBoxMovable:true,
                                cropBoxResizable:false,
                                zoomOnTouch:false,
                                viewMode:1,
                                setDragMode:'move',
                                aspectRatio: 3 / 5,
                                center:false,
                                data: {
                                    width: 198,
                                    height:298
                                },
                            });
                            $image.cropper('getCroppedCanvas', {
                                width: 220,
                                height: 298,
                                fillColor: '#fff',
                                imageSmoothingEnabled: false,
                                imageSmoothingQuality: 'high',
                            });
                        }, 1000);

                        $(document).on("input", "#zoom-level2", function() {
                            $image.cropper('zoomTo', 0.1);
                            var current_zoom = $(this).val();
                            $image.cropper('zoom', current_zoom);
                        });

                        $(document).on("click", "#crop2", function() {
                            $("#myModal2").modal('hide');
                            var imgdata = $image.cropper('getCroppedCanvas').toDataURL();
                            $(".modalOpen2").attr('value',imgdata);
                            $(".result2").attr("src", imgdata);
                            $(".result2").css({ "width": "198px", "height": "298px" });
                            $("#file2").hide();
                            $(this).parents().find("#back_view").children("#drag_n_drop_2").removeClass('hide');

                        });

                    }
                    reader.readAsDataURL(file[0]);
                });
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        } else {
            alert('select proper image');
        }
    });

    //additional file uoploading functionality

    $(document).on("change", "#file3", function() {
        $(".modal-footer").show();
        var imgVal = $(this).val();
        if (imgVal != "") {
            $('#myModal3').modal('show');
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreview3");
                dvPreview.html("");
                $($(this)[0].files).each(function (index, element ) {
                    var file = $(this);
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var carouselItems = $("<div class='item'></div>");
                        var img = $("<img />");
                        //multiple images code start here
                        var image = img.attr("src", e.target.result);
                        carouselItems.append(image);
                        dvPreview.append(carouselItems);
                        var $image = $('#dvPreview3 div.item img');
                        var total = $image.length;
                        $('#dvPreview3 div.item:first-child').addClass('active');
                        setTimeout(function(){
                            $image.cropper({
                                movable: true,
                                zoomable: true,
                                rotatable: false,
                                scalable: false,
                                zoomOnWheel:false,
                                dragMode:'move',
                                minCropBoxWidth:198,
                                minCropBoxHeight:298,
                                cropBoxMovable:true,
                                cropBoxResizable:false,
                                zoomOnTouch:false,
                                viewMode:1,
                                setDragMode:'move',
                                aspectRatio: 3 / 5,
                                center:false,
                                data: {
                                    width: 198,
                                    height:298
                                },
                            });
                            $image.cropper('getCroppedCanvas', {
                                width: 220,
                                height: 298,
                                fillColor: '#fff',
                                imageSmoothingEnabled: false,
                                imageSmoothingQuality: 'high',
                            });
                        }, 1000);

                        $(document).on("input", "#zoom-level3", function() {
                            $image.cropper('zoomTo', 0.1);
                            var current_zoom = $(this).val();
                            $image.cropper('zoom', current_zoom);
                        });
                        $(document).on("click", "#crop3", function() {
                            $("#myModal3").modal('hide');
                            var imgdata = $image.cropper('getCroppedCanvas').toDataURL();
                            $(".modalOpen3").attr('value',imgdata);
                            $(".result3").attr("src", imgdata);
                            $(".result3").css({ "width": "198px", "height": "298px" });
                            $("#file3").hide();
                            $(this).parents().find("#details_view").children("#drag_n_drop_3").removeClass('hide');
                        });
                    };
                    reader.readAsDataURL(file[0]);
                });
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        } else {
            alert('select proper image');
        }
    });
    //ends here

    //remove hidden seleted pic and file input base 64 data
    $(document).on("click", ".remove_pic", function() {
        $(this).siblings().find('img').attr('src', '').removeAttr('style');
        $(this).siblings().find("input[type='hidden']").val('');
        $(this).siblings().find("input[type='file']").show();
    });

    $(document).on("click", "#closeModal1,.img_clse", function() {
        $(this).parents().find("#front_view").children("#drag_n_drop_1").addClass('hide');
    });

    $(document).on("click", "#closeModal2,.img_clse", function() {
        $(this).parents().find("#back_view").children("#drag_n_drop_2").addClass('hide');
    });

    $(document).on("click", "#closeModal3,.img_clse", function() {
        $(this).parents().find("#details_view").children("#drag_n_drop_3").addClass('hide');
    });


    $('#categoryname').on('change', function() {

        var id = $(this).val(); //catgeory id
        if (id == 74) {
            $("#gender option[value='pet']").attr('disabled', 'true');
        } else {
            $("#gender option[value='pet']").attr('disabled', false);
        }
        $.get("/costume/ajaxsubcategory", //This is the url defined in routes
            { categoryid: id },
            function(data) {
                console.log(data);
                var model = $('#subcategory').html('Select Subcategory'); //keeping subcategory field empty before
                model.empty();
                model.append("<option value=''>Select Subcategory</option>");
                $.each(data, function(index, element) {
                    model.append("<option value='" + element.subcategoryid + "'>" + element.subcategoryname + "</option>");
                });
            });

    });


    $('#pricing_next').click(function(a) {

        a.preventDefault();
        str = true;
        $('#price,#quantity,#Length,#Width,#Height,#pounds#ounces').css('border', '');
        $('#priceerror,#quantityerror,#dimensionserror,#poundserror,#ounceserror').html('');
        var price = $('#price').val();
        var quantity = $('#quantity').val();
        var Length = $('#Length').val();
        var Width = $('#Width').val();
        var Height = $('#Height').val();;
        var pounds = $('#pounds').val();
        var ounces = $('#ounces').val();
        if (price == "") {
            $('#price').css('border', '1px solid red');
            $('#priceerror').html('This field is required.');
            str = false;
        }
        if (pounds == "") {
            $('#pounds').css('border', '1px solid red');
            $('#poundserror').html('This field is required.');
            str = false;
        }
        if (ounces == "") {
            $('#ounces').css('border', '1px solid red');
            $('#ounceserror').html('This field is required.');
            str = false;
        }

        if (str == true) {

            $('#step4').addClass('active');
            $('#upload_div').css('display', 'none');
            $('#costume_description').css('display', 'none');
            $('#pricing_div').css('display', 'none');
            $('#preferences_div').css('display', 'block');

        }
        return str;
    });


    $('#pricing_back').click(function() {
        $('#step3').removeClass('active');
        $('#upload_div').css('display', 'none');
        $('#costume_description').css('display', 'block');
        $('#pricing_div').css('display', 'none');
        $('#preferences_div').css('display', 'none');
    });

    $('#preferences_back').click(function() {
        $('#step4').removeClass('active');
        $('#upload_div').css('display', 'none');
        $('#costume_description').css('display', 'none');
        $('#pricing_div').css('display', 'block');
        $('#preferences_div').css('display', 'none');
    });

    var loading = false;
    $('#preferences_finished').click(function(a) {
        a.preventDefault();
        str = true;

        $('#handlingtime,#returnpolicy,#donate_charity,#charity_name,#organzation_name').css('border', '');
        $('#handlingtimeerror,#returnpolicyerror,#donate_charityerror,#charity_nameerror,#organzation_nameerror').html('');
        var handlingtime = $('#handlingtime').val();
        var returnpolicy = $('#returnpolicy').val();
        var donate_charity = $('#donate_charity').val();
        var atLeastOneIsChecked = $('input[name="another_charity"]:checked').length > 0;
        var charity_name = $('input[name="charity_name"]:checked').length > 0;
        var organzation_name = $('#organzation_name').val();

        if (handlingtime == "") {
            $('#handlingtime').css('border', '1px solid red');
            $('#handlingtimeerror').html('This field is required.');
            str = false;
        }
        if (returnpolicy == "") {
            $('#returnpolicy').css('border', '1px solid red');
            $('#returnpolicyerror').html('This field is required.');
            str = false;
        }
        if (donate_charity == "") {
            $('#donate_charity').css('border', '1px solid red');
            $('#donate_charityerror').html('Select Donate Amount');
            str = false;
        }
        if (donate_charity != "" && donate_charity != "none") {
            $('#charity_nameerror').html('Please select any Charity.');
            str = false;
            if (charity_name == true) {
                $('#charity_nameerror').html('');
                str = true;
            };
        }

        if (charity_name == true) {
            if (donate_charity == "" || donate_charity == "none") {
                $('#donate_charity').css('border', '1px solid red');
                $('#donate_charityerror').html('Select Donate Amount');
                $('#charity_nameerror').html('');
                str = false;
            }
        }
        /*if($('input[name=charity_name]:checked').length<=0){
         $('#charity_name').css('border','1px solid red');
         $('#charity_nameerror').html('Select Donate to');
         str=false;

         }*/
        if (atLeastOneIsChecked == true) {
            $('#organzation_name').css('border', '1px solid red');
            $('#organzation_nameerror').html('This field is required.');
            str = false;
            if (organzation_name != '') {
                $('#organzation_name').css('border', '');
                $('#organzation_nameerror').html('');
                str = true;
            }
        }

        if (loading) {
            return;
        }

        if (str == true) {
            loading = true;
            $('#preferences_finished').html("Submitting");
            $('#ajax_loader').css('display', 'block');
            $.ajax({
                url: "/costume/costumecreate",
                type: "POST",
                data: new FormData($('#costume_total_form')[0]),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    //console.log(response.cat_url);
                    if (response.msg == "success") {
                        $('#ajax_loader').remove();
                        $("#costume_view_my_listing").attr("href", response.cat_url);
                        $('#success_page').css('display', 'block');
                        $('#upload_div').css('display', 'none');
                        $('#costume_description').css('display', 'none');
                        $('#pricing_div').css('display', 'none');
                        $('#preferences_div').css('display', 'none');
                        $("html, body").animate({ scrollTop: 0 });
                        
                        /* Added by Gayatri*/
                        $("#costumename").attr('href',response.share_url);
                        $("#costumename").text(response.costume_name);

                        $("#amount").text(response.amount+"%");
                        $("#charity_center").text(response.charity_center);

                        $('#twiter_url').attr('data-url', response.share_url);
                        $('#twiter_url').attr('data-title', response.quote);

                        $('#pin_url').attr('data-url', response.share_url);
                        $('#pin_url').attr('data-title', response.quote);
                        $('#pin_url').attr('data-image', response.first_pic);

                        var tumb_url = "https://www.tumblr.com/widgets/share/tool?content="+encodeURIComponent(response.share_url)+"&caption="+encodeURIComponent(response.quote)+"&canonicalUrl="+encodeURIComponent('http://dev.chrysaliscostumes.com/costume/create')+"&shareSource=tumblr_share_button";
                        
                        $('#tumblr_url').val(tumb_url);
                        
                        $('#url_fb').val(response.share_url);
                        $('#quote_fb').val(response.quote);
                        /* End */
                    }
                },
                error: function(request, status, error) {
                    //alert(data);
                    loading = false;
                    $('#preferences_finished').html(request.responseText);
                }

            });
        }

        return str;
    });



    //key words hash tag
    $("#keywords_add").click(function(){
        var val = $('#keywords_tag').val();
        if(val != ""){
            var div_cont= $('#count').html().split(' ');
            var total =div_cont[0];
            if (total > 0) {
                if (val.indexOf(',') !== -1) {
                    var segments = val.split(',');
                    var count=segments.length;
                    $('#count').html(total-count+ " left");
                    if (total == 1) {
                        var hashtag = '#'+segments[0];
                        $('#div').append('<p class="keywords_p p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
                        $('#keywords_tag').prop('value','');
                        $('#input_'+total+'').val(hashtag);
                        $('#count').html(total-1+ " left");
                    }else{
                        $.each(segments,function(i){
                            var hashtag = '#'+segments[i];
                            $('#div').append('<p class="keywords_p p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
                            $('#input_'+total+'').val(hashtag);
                            $('#keywords_tag').prop('value','');
                            total--;
                        });
                    }
                }else{
                    var hashtag = '#'+val;
                    $('#div').append('<p class="keywords_p p_'+total+'">'+hashtag+' <span id="remove_'+total+'">X</span> </p>');
                    $('#keywords_tag').prop('value','');
                    $('#input_'+total+'').val(hashtag);
                    $('#count').html(total-1+ " left");
                }
            }else{
                $('#keywords_add').hide();
            }
        }
    });

    $(document).on('click', '[id^="remove_"]', function(e){
        e.preventDefault();
        var this_id = $(this).attr('id');
        var split   = this_id.split('_');
        var target = $(e.target).closest( ".p_"+split[1]+"" ).remove();
        $('#input_'+split[1]+'').val('');
        var div_cont= $('#count').html().split(' ');
        var total = div_cont[0];
        $('#count').html(+total+1 + " left");
        if (total == 0) {
            $('#keywords_add').show();
        }
    });

    function getActiveItemIndex(items){
        var active_item_index = 0;
        items.each(function(i, item){
            if($(item).hasClass("active")){
                active_item_index = i;
                return;
            }
        });
        return active_item_index;
    }

    $(document).on('slid.bs.carousel', '.carousel', function () {
        var items = $(this).find("#dvPreviewMultiple > .item");
        var active_item_index = getActiveItemIndex(items);
        activeCropperObjIndex = active_item_index;
        slider.val(zooms[active_item_index]);
        if(zooms[activeCropperObjIndex] !== -100){
            slider.trigger("input");
        }
        if(active_item_index+1 === items.length){
            $(".modal-footer").show();
        }
        else {
            $(".modal-footer").hide();
        }
    });


    //multiple images slider images

    var $cropper_objs = [];
    var zooms = [];
    var activeCropperObjIndex = 0;
    var slider = $(".slider");

    $(document).on("click", '#multiCancel', function(){
        resetCropperValues();
    });
    //multiple file uploading code

    $("#upload-file-selector").on("change",function () {

        var imgVal = $(this).val();
        if (imgVal != "") {
            $('#lightbox').modal('show');
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreviewMultiple");
                dvPreview.html("");
                var imgdata = '';
                var Count = '';
                var CanvasImages = [];
                if($(this)[0].files.length===1){
                    $(".modal-footer").show();
                }
                $($(this)[0].files).each(function (index, element) {
                    var file = $(this);
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var carouselItems = $("<div class='item'></div>");
                        var img = $("<img />");
                        //multiple images code start here
                        var image = img.attr("src", e.target.result);
                        carouselItems.append(image);
                        dvPreview.append(carouselItems);
                        var $image = $('#dvPreviewMultiple div.item img');
                        Count = $image.length;
                        if(Count > 1)
                        {
                            $(".arrows").show();
                        }
                        else
                        {
                            $(".arrows").hide();
                        }

                        $('#dvPreviewMultiple div.item:first-child').addClass('active');

                        if(Count == 1)
                        {
                            $(".modal-footer").show();
                        }
                        else
                        {
                            if($('#dvPreviewMultiple div.item:first-child').hasClass('active'))
                            {
                                 $(".modal-footer").hide();
                            }
                        } 
                        setTimeout(function () {
                            $image.cropper({
                                movable: true,
                                zoomable: true,
                                rotatable: false,
                                scalable: false,
                                zoomOnWheel:false,
                                dragMode: 'move',
                                minCropBoxWidth: 198,
                                minCropBoxHeight: 298,
                                cropBoxMovable: true,
                                cropBoxResizable: false,
                                zoomOnTouch: false,
                                viewMode:1,
                                setDragMode: 'move',
                                aspectRatio: 3 / 5,
                                center: false,
                                data: {
                                    width: 198,
                                    height: 298
                                },
                            });
                            $image.cropper('getCroppedCanvas', {
                                width: 220,
                                height: 298,
                                fillColor: '#fff',
                                imageSmoothingEnabled: false,
                                imageSmoothingQuality: 'high',
                            });
                            $cropper_objs.push($image);
                            zooms.push(-100);
                        }, 1000);
                    };
                    reader.readAsDataURL(file[0]);
                });
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        }else
        {
            alert('select Proper Image');
        }
    });

    $(document).on("input", ".slider", function () {
        $cropper_objs[activeCropperObjIndex].cropper('zoomTo', 0.1);
        var current_zoom = $(this).val();
        zooms[activeCropperObjIndex] = current_zoom;
        $cropper_objs[activeCropperObjIndex].cropper('zoom', current_zoom);
    });

    $(document).on("click", ".saveMultiple", function () {
        $cropper_objs.forEach(function($image, index){
            var imgdata = $image.cropper('getCroppedCanvas').toDataURL();
            $('#other_thumbnails').append("<div index='"+index+"' class=\"col-md-4 col-sm-4 col-xs-12 multi_div\"><img src= " + imgdata + " class=\"multi_thumbs pip\">" +
                "<br/><span class=\"remove\">" +
                "<i class=\"fa fa-times-circle\"></i>" +
                "</span></div></div>");
            var multilehidden = "<input id='remove"+index+"' type='hidden' name='multi[]' value='"+imgdata+"'>";
            $(".multiHidden").append(multilehidden);
            $("#lightbox").modal('hide');
            resetCropperValues();
        });
    });

    $(document).on("click",".remove",function()
    {
        var index = $(this).parent().attr("index");
        $cropper_objs.splice(index, 1);
        $(this).parent().remove();
        $("#remove"+index).remove();
        $(this).hide();
    });

    function resetCropperValues(){
        $cropper_objs = [];
        zooms = [];
        activeCropperObjIndex = 0;
        $(".modal-footer").hide();
    }


});




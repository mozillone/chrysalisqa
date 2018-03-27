$(function(){
    /*var imgdata;
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

     if (str == true) {
     $('#step2').addClass('active');
     $('#upload_div').css('display', 'none');
     $('#costume_description').css('display', 'block');
     $('#pricing_div').css('display', 'none');
     $('#preferences_div').css('display', 'none');

     }
     return str;

     });*/

    $('input[name=img_chan]').change(function() {
        $('#drag_n_drop_1').css('display', 'block');
    });
    $('input[name=img_chan1]').change(function() {
        $('#drag_n_drop_2').css('display', 'block');
    });
    $('#drag_n_drop_1').click(function() {
        $("#front_view > div.main_upload_blogs > div.up-blog").find("img").remove();
        $('#front_view').find('li').remove();
        $('#drag_n_drop_1').css('display', 'none');
        $('input[name=img_chan]').val('');
    });
    $('#drag_n_drop_2').click(function() {
        $("#back_view > div.main_upload_blogs > div.up-blog").find("img").remove();
        $('#back_view').find('li').remove();
        $('#drag_n_drop_2').css('display', 'none');
        $('input[name=img_chan1]').val('');
    });

    $('input[name=img_chan2]').change(function() {
        $('#drag_n_drop_3').css('display', 'block');
    });
    $('#drag_n_drop_3').click(function() {
        $("#details_view > div.main_upload_blogs > div.up-blog").find("img").remove();
        $('#details_view').find('li').remove();
        $('#drag_n_drop_3').css('display', 'none');
        $('input[name=img_chan2]').val('');
    });
    //front view image adding code here
    $(document).on("change", "#file1", function() {

        $("#drag_n_drop_1").hide();
        $(".modal-footer").show();
        var imgdata = '';
        var imgVal = $(this).val();
        if (imgVal != "") {
            $('#myModal').modal('show');
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreview");
                dvPreview.html("");
                //$($(this)[0].files).each(function (index, element ) {
                    var file = this.files[0];
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
                                minCropBoxWidth:240,
                                minCropBoxHeight:298,
                                cropBoxMovable:true,
                                cropBoxResizable:false,
                                viewMode:1,
                                zoomOnTouch:false,
                                setDragMode:'move',
                                aspectRatio: 3 / 5,
                                center:false,
                                data: {
                                    width: 240,
                                    height:298
                                },
                            });
                            $image.cropper('getCroppedCanvas', {
                                width: 263,
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
                        $(document).on("change", "#zoom-level", function() {
                            $image.cropper('zoomTo', 0.1);
                            var current_zoom = $(this).val();
                            $image.cropper('zoom', current_zoom);
                        });
                        $(document).on("click", "#crop", function() {
                            $("#front_view > div.main_upload_blogs > div.up-blog").find("img").remove();
                            if($image.cropper('getCroppedCanvas')==null){
                                imgdata = reader.readAsDataURL(file);
                            }else{
                                imgdata = $image.cropper('getCroppedCanvas').toDataURL('image/jpeg', 0.9);        
                            }
                            $('<img id="file1_name" class="result" >').insertBefore('#front_view > div.main_upload_blogs > div.up-blog > span.cam_icon'); 
                            //$("#dvPreview div.item").remove();
                            $("#myModal").modal('hide');
                            //imgdata = $image.cropper('getCroppedCanvas').toDataURL('image/jpeg', 0.9);
                            $(".modalOpen1").attr('value',imgdata);
                            $(".result").attr("src", imgdata);
                            $(".result").css({ "width": "263px", "height": "298px" });
                            $("#file1").hide();
                            $(this).parents().find("#front_view").children("#drag_n_drop_1").removeClass('hide');
                            $("#drag_n_drop_1").show();

                        });

                    }
                    reader.readAsDataURL(file);
                //});
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        } else {
            alert('select proper image');
        }
    });

    //second file image code starts here
    $(document).on("change", "#file2", function() {
        $("#drag_n_drop_2").hide();
        $(".modal-footer").show();
        var imgVal = $(this).val();
        if (imgVal != "") {
            $('#myModal2').modal('show');
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreview2");
                dvPreview.html("");
                //$($(this)[0].files).each(function (index, element ) {
                    var file = this.files[0];
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
                                minCropBoxWidth:240,
                                minCropBoxHeight:298,
                                cropBoxMovable:true,
                                cropBoxResizable:false,
                                viewMode:1,
                                zoomOnTouch:false,
                                setDragMode:'move',
                                aspectRatio: 3 / 5,
                                center:false,
                                data: {
                                    width: 240,
                                    height:298
                                },
                            });
                            $image.cropper('getCroppedCanvas', {
                                width: 263,
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
                        $(document).on("change", "#zoom-level2", function() {
                            $image.cropper('zoomTo', 0.1);
                            var current_zoom = $(this).val();
                            $image.cropper('zoom', current_zoom);
                        });

                        $(document).on("click", "#crop2", function() {
                            $("#back_view > div.main_upload_blogs > div.up-blog").find("img").remove();
                            if($image.cropper('getCroppedCanvas')==null){
                                imgdata = reader.readAsDataURL(file);
                            }else{
                                imgdata = $image.cropper('getCroppedCanvas').toDataURL('image/jpeg', 0.9);        
                            }
                            $('<img id="file2_name" class="result2" >').insertBefore('#back_view > div.main_upload_blogs > div.up-blog > span.cam_icon'); 
                            //$("#dvPreview div.item").remove();
                            $("#myModal2").modal('hide');
                            //var imgdata = $image.cropper('getCroppedCanvas').toDataURL('image/jpeg', 0.9);
                            $(".modalOpen2").attr('value',imgdata);
                            $(".result2").attr("src", imgdata);
                            $(".result2").css({ "width": "263px", "height": "298px" });
                            $("#file2").hide();
                            $(this).parents().find("#back_view").children("#drag_n_drop_2").removeClass('hide');
                            $("#drag_n_drop_2").show();

                        });

                    }
                    reader.readAsDataURL(file);
                //});
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        } else {
            alert('select proper image');
        }
    });

    //additional file uoploading functionality

    $(document).on("change", "#file3", function() {
        $("#drag_n_drop_3").hide();
        $(".modal-footer").show();
        var imgVal = $(this).val();
        if (imgVal != "") {
            $('#myModal3').modal('show');
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreview3");
                dvPreview.html("");
               // $($(this)[0].files).each(function (index, element ) {
                    var file = this.files[0];
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
                                minCropBoxWidth:240,
                                minCropBoxHeight:298,
                                cropBoxMovable:true,
                                cropBoxResizable:false,
                                viewMode:1,
                                zoomOnTouch:false,
                                setDragMode:'move',
                                aspectRatio: 3 / 5,
                                center:false,
                                data: {
                                    width: 240,
                                    height:298
                                },
                            });
                            $image.cropper('getCroppedCanvas', {
                                width: 263,
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
                        $(document).on("change", "#zoom-level3", function() {
                            $image.cropper('zoomTo', 0.1);
                            var current_zoom = $(this).val();
                            $image.cropper('zoom', current_zoom);
                        });
                        $(document).on("click", "#crop3", function() {
                            $("#details_view > div.main_upload_blogs > div.up-blog").find("img").remove();
                            if($image.cropper('getCroppedCanvas')==null){
                                imgdata = reader.readAsDataURL(file);
                            }else{
                                imgdata = $image.cropper('getCroppedCanvas').toDataURL('image/jpeg', 0.9);        
                            }
                            $('<img id="file3_name" class="result3" >').insertBefore('#details_view > div.main_upload_blogs > div.up-blog > span.cam_icon'); 
                            //$("#dvPreview div.item").remove();
                            $("#myModal3").modal('hide');
                            //var imgdata = $image.cropper('getCroppedCanvas').toDataURL('image/jpeg', 0.9);
                            $(".modalOpen3").attr('value',imgdata);
                            $(".result3").attr("src", imgdata);
                            $(".result3").css({ "width": "263px", "height": "298px" });
                            $("#file3").hide();
                            $(this).parents().find("#details_view").children("#drag_n_drop_3").removeClass('hide');
                            $("#drag_n_drop_3").show();
                        });
                    };
                    reader.readAsDataURL(file);
                //});
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

    $(document).on("click","#cancel1",function()
    {
        $("#file1").val('');
        $("#dvPreview").html('');
         $("#drag_n_drop_1").hide();
    });
    $(document).on("click","#cancel2",function()
    {
        $("#file2").val('');
        $("#dvPreview2").html('');
        $("#drag_n_drop_2").hide();
    });
    $(document).on("click","#cancel3",function()
    {
        $("#file3").val('');
        $("#dvPreview3").html('');
        $("#drag_n_drop_3").hide();
    });
    $(document).on("click","#multiCancel",function()
    {
        $("#upload-file-selector").val('');
        $("#dvPreviewMultiple").html('');
    });
      

   /* $(document).on("click", "#closeModal1,.img_clse", function() {
        $(this).parents().find("#front_view").children("#drag_n_drop_1").addClass('hide');
        $("#drag_n_drop_1").hide();
    });

    $(document).on("click", "#closeModal2,.img_clse", function() {
        $(this).parents().find("#back_view").children("#drag_n_drop_2").addClass('hide');
        $("#drag_n_drop_2").hide();
    });

    $(document).on("click", "#closeModal3,.img_clse", function() {
        $(this).parents().find("#details_view").children("#drag_n_drop_3").addClass('hide');
        $("#drag_n_drop_3").hide();
    });
*/

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
               
                var model = $('#subcategory').html('Select Subcategory'); //keeping subcategory field empty before
                model.empty();
                model.append("<option value=''>Select Subcategory</option>");
                $.each(data, function(index, element) {
                    model.append("<option value='" + element.subcategoryid + "'>" + element.subcategoryname + "</option>");
                });
            });
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
        if(activeCropperObjIndex >0)
        {
            slider.val(2);
        }
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
                          //console.log($('#dvPreviewMultiple div.item:first-child').parents().siblings().find(".modal-footer").length);
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
                                viewMode:1,
                                zoomOnTouch: false,
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
    $(document).on("change", ".slider", function () {
        $cropper_objs[activeCropperObjIndex].cropper('zoomTo', 0.1);
        var current_zoom = $(this).val();
        zooms[activeCropperObjIndex] = current_zoom;
        $cropper_objs[activeCropperObjIndex].cropper('zoom', current_zoom);
    });


    $(document).on("click", ".saveMultiple", function () {
        $cropper_objs.forEach(function($image, index){
            var length = $("#other_thumbnails").find("div").length;
            if(length == 0){
                index = 1;
            }
            else{
                index = length + 1;
            }
            var imgdata = $image.cropper('getCroppedCanvas').toDataURL('image/jpeg', 0.9);
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
        $("#upload-file-selector").val('');
        $("#dvPreviewMultiple").html('');
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





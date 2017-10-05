

$(".remove").click(function(){
    $(this).parent(".pip").remove();
});
$('#donate_charity').change(function(){
    if ($(this).val() == "none") {
        $('input[name=charity_name]').prop('checked', false);
    }
});

$('#another_charity').change(function(){
    if ($(this).prop("checked") == true) {
        $('input[name=charity_name]').prop('checked', false);
    }
});

$('input[name=file1]').change(function(){
    $('#drag_n_drop_1').css('display','block');
});
$('input[name=file2]').change(function(){
    $('#drag_n_drop_2').css('display','block');
});
$('#drag_n_drop_1').click(function(){
    $('#front_image_id').remove();
    $('#front_view').find('ul').remove();
    $('#drag_n_drop_1').css('display','none');
    $('input[name=file1]').val('');
    $('input[name=hidden]').attr('value','');
    $(".Backview").attr('value','');
    $(".drop_uploader").addClass('Front1');
});

$('#shipping').change(function(){
    if($(this).val() == 16){
        $('#service_div').css('display','none');
    }else{
        $('#service_div').css('display','block');
    }
});
$('#free_shipping').click(function(){
    $('#service_div').css('display','none');
    $('#shipping').val('16');
});
$('#drag_n_drop_2').click(function(){


    $('#back_image_id').remove();
    $('#back_view').find('ul').remove();
    $('#drag_n_drop_2').css('display','none');
    $('input[name=file2]').val('');
    $('input[name=hidden]').attr('value','');
    $(".drop_uploader").addClass('Back1');

});




$('input[name=file3]').change(function(){
    $('#drag_n_drop_3').css('display','block');
});
$('#drag_n_drop_3').click(function(){
    $('#details_image_id').remove();
    $('#details_view').find('ul').remove();
    $('#drag_n_drop_3').css('display','none');
    $('input[name=file3]').val('');
    $('input[name=file3]').attr('value','');
    $(".drop_uploader").addClass('additional');
});


//front view image jquery code

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
                        $(".drop_zone1").find("img.result").remove();
                        var FrontView = '<img src="'+imgdata+'" class="result">';
                        $(".drop_zone1").append(FrontView);
                        $(".Forntview").attr('value',imgdata);
                        $(".Forntview").attr('data-id',1);
                        $(".result").attr("src", imgdata);
                        $("#selected_file_0").remove();
                        if (!$(".drop_zone1").hasClass("Front1")) {
                        //$(".result").css({ "width": "198px", "height": "298px" });
                        $(".result").css({ "width": "198px", "height": "298px","position":"relative"});
                        }                        
                        $("#file1").hide();
                        $(this).parents().find("#front_view").children("#drag_n_drop_1").removeClass('hide');
                        if($(".drop_zone1").hasClass('Front1'))
                        {
                          $(".result").css({ "width": "198px", "height": "298px","position":"relative"});
                        }

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
                        $(".drop_zone2").find("img.result2").remove();
                        var Backview = '<img src="'+imgdata+'" class="result2">';
                        $(".drop_zone2").append(Backview);
                        $(".Backview").attr('value',imgdata);
                        $(".result2").attr("src", imgdata);
                        $("#selected_file_1").remove();
                        if (!$(".drop_zone1").hasClass("Back1")) {
                          $(".result2").css({ "width": "198px", "height": "298px","position":"relative" });
                        }
                        $("#file2").hide();
                        $(this).parents().find("#back_view").children("#drag_n_drop_2").removeClass('hide');
                        if($(".drop_zone2").hasClass('Back1'))
                        {
                          $(".result2").css({ "width": "198px", "height": "298px","position":"relative"});
                        }

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
                        $(".drop_zone3").find("img.result3").remove();
                        $(".Additional").attr('value',imgdata);
                        var Additional = '<img src="'+imgdata+'" class="result3">';
                        $(".drop_zone3").append(Additional);
                        $(".result3").attr("src", imgdata);
                        $("#selected_file_2").remove();
                        $(".result3").css({ "width": "198px", "height": "298px","position":"relative"});
                        $("#file3").hide();
                        $(this).parents().find("#details_view").children("#drag_n_drop_3").removeClass('hide');
                        if($(".drop_zone3").hasClass('additional'))
                        {
                          $(".result3").css({ "width": "198px", "height": "298px","position":"relative" });
                        }
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

//remove selected pic form the view

$(document).on("click","#drag_n_drop_1",function()
{
    $(this).siblings().find('img').remove();
    $(this).siblings().find("input[type='hidden']").attr('value','');

});

//multiple images slider images script

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
/*var allRemove = [];
var removeValue = '';
$(document).on("click",".remove_pic",function()
{
    var MakeInput = '';
    var removeattr=$(this).attr('data-id');
    removeValue =  $("#"+removeattr).val();

    $(this).parent().find("#"+removeValue).remove();

    allRemove.push(removeValue);

    $.each( allRemove, function( key, value ) {

        MakeInput =  '<input type="hidden"   name="multiple[]" value="'+value+'">';
    });
    $(".deletedImages").append(MakeInput);
    $(this).parent().find("input[type='file']").show();
});
*/
$(document).on("click","#drag_n_drop_1,#drag_n_drop_2,#drag_n_drop_3",function()
{

    $(this).siblings().find('img').remove();
    $(this).siblings().find("input[type='hidden']").val('');
    $(this).siblings().find("input[type='hidden']").attr('data-id','');



});
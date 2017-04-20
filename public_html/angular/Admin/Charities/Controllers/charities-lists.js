app.controller('CharitiesController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,Charities) 
{
	var vm = this;
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/charities-list',
        type: 'GET'
      })
      .withDataProp('data.charities')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', false)
      .withOption('lengthChange', false);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn('image').withTitle('').renderWith(imageHtml).notSortable(),
                      DTColumnBuilder.newColumn('name').withTitle('Charity Name'),
                      DTColumnBuilder.newColumn('user_name').withTitle('Suggested By'),
                      DTColumnBuilder.newColumn('date').withTitle('Created Date'),
                      DTColumnBuilder.newColumn('status').withTitle('Status').renderWith(activeHtml),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
    $scope.displayTable = true;
    function imageHtml(data, type, full, meta) {
        if(data!=null){
            return '<img  class="img-responsive"  src="/charities_images/'+data+'" width="50px">'
        }else{
          return '<img  class="img-responsive"  src="/charities_images/default-placeholder.jpg" width="50px">'
        }
    }
    function actionsHtml(data, type, full, meta) {
         var records='<a class="btn btn-xs btn-warning edit-charity" data-toggle="tooltip" data-placement="left" title="" href="javascript::void(0);" data-id="'+full.id+'" data-name="'+full.name+'" data-image="'+full.image+'" data-original-title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="btn btn-xs btn-warning delete" data-toggle="tooltip" data-placement="top" title="" href="javascript:void(0);" data-original-title="Delete" data-id="'+data.id+'"><i class="fa fa-trash"></i></a>';
         return records;
    }
   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
      function activeHtml(data, type, full, meta) {
      if(data!="1"){
        return '<label class="switch"><input type="checkbox" ng-click="changeStatus('+full.id+', '+data+')" ><div class="slider round"></div></div></label>';
      }else{
        return '<label class="switch"><input type="checkbox" checked="checked"  ng-click="changeStatus('+full.id+', '+data+')" ><div class="slider round"></div></div></label>';
        
      }
    }
    $scope.changeStatus=function(id, status) {
      var charity_status = status==1?0:1;
     var params = {"id":id, "status":charity_status};
      Charities.changeStatus(params).then(function(){
       });
      }

      $scope.seachCharities= function(search){
          Charities.getCharitiesSearchlist(search).then(function(response){
          $scope.dtOptions = DTOptionsBuilder.newOptions()
          .withOption('data',response.data.data.charities)
          .withOption('createdRow', createdRow)
            .withOption('order', [ ])
            .withOption('responsive', true)
            .withOption('bFilter', false)
            .withOption('lengthChange', false);
             $scope.dtColumns = [
                       DTColumnBuilder.newColumn('image').withTitle('').renderWith(imageHtml).notSortable(),
                      DTColumnBuilder.newColumn('name').withTitle('Charity Name'),
                      DTColumnBuilder.newColumn('user_name').withTitle('Suggested By'),
                      DTColumnBuilder.newColumn('date').withTitle('Created Date'),
                      DTColumnBuilder.newColumn('status').withTitle('Status').renderWith(activeHtml),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                          ],
          $scope.displayTable = true;
    
          });
        } 
}); 
 
 $(document).on('click', '.edit-charity', function(){ 
      var id=$(this).attr('data-id');
      var name=$(this).attr('data-name');
      var image=$(this).attr('data-image');
      $('input[name="charity_id"]').val(id);
      $('#charity_heading').html('Edit '+name);
      if(image.length){
        $('#img-chan1').attr('src','/charities_images/'+image);
      }
      $('#charity_name').val(name);
      $('#charity_edit_popup').modal('show');
     
     
 });
 $(document).on('click', '.delete', function(){ 
      var id=$(this).attr('data-id');
      swal({   
              title: "Are you sure want to delete this Charity?",   
                        text: "You will not be able to recover this Charity",   
                        showCancelButton: true,   
                        confirmButtonColor: "#DD6B55",   
                        confirmButtonText: "Yes, delete",   
                        closeOnConfirm: false
                      }, 
                      function(){   
                        document.location = "/charity-delete/"+id;
                      }); 
         
    });


    $("#profile_logo").on('change', function() {
      var countFiles = $(this)[0].files.length;
      var imgPath = $(this)[0].value;
      var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
      var image_holder = $("#img-chan");
      //image_holder.empty();
      if (extn == "jpg" || extn == "jpeg" || extn == "png") {
        if (typeof(FileReader) != "undefined") {
          //loop for each file selected for uploaded.
          for (var i = 0; i < countFiles; i++) 
          {
            if($(this)[0].files[i].size>=2997447){
                swal({   
                title: "Size limit exceeded",   
                text: "Upload image size less than 3Mb",   
                type: "warning",   
                showCancelButton: false,
                fieldset:false,
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Ok",   
              closeOnConfirm: true 
              });
            }else{
              var reader = new FileReader();
              reader.readAsDataURL($(this)[0].files[i]);
              reader.onload = function(e) {
                $('#img-chan').attr('src',e.target.result);
                $('.img-pview').after('<span class="remove_pic"><i class="fa fa-times-circle" aria-hidden="true"></i></span>');
           
              }
              image_holder.show();
            }
          }
          } else {
          swal("This browser does not support FileReader.");
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
        closeOnConfirm: true 
        });
      }
    });
$("#edit_img_pic").on('change', function() {
      var countFiles = $(this)[0].files.length;
      var imgPath = $(this)[0].value;
      var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
      var image_holder = $("#img-chan1");
      //image_holder.empty();
      if (extn == "jpg" || extn == "jpeg" || extn == "png") {
        if (typeof(FileReader) != "undefined") {
          //loop for each file selected for uploaded.
          for (var i = 0; i < countFiles; i++) 
          {
            if($(this)[0].files[i].size>=2997447){
                swal({   
                title: "Size limit exceeded",   
                text: "Upload image size less than 3Mb",   
                type: "warning",   
                showCancelButton: false,
                fieldset:false,
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Ok",   
              closeOnConfirm: true 
              });
            }else{
              var reader = new FileReader();
              reader.readAsDataURL($(this)[0].files[i]);
              reader.onload = function(e) {
                $('#img-chan1').attr('src',e.target.result);
           
              }
              image_holder.show();
            }
          }
          } else {
          swal("This browser does not support FileReader.");
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
        closeOnConfirm: true 
        });
      }
    });
$(document).on("click",".remove_pic",function(){
  $('#img-chan').attr('src',"/charities_images/default-placeholder.jpg");
  $('input[type="file"]').val('');
  $('input[name="is_removed"]').val("1");
  });
$("#charity-create").validate({
            rules: {
                name:{
                        required: true,
                        maxlength: 50
                    },
                image:{
                        required: true,
                        extension: "png,jpg"
                    },
                }
  
        });
$("#charity-edit").validate({
            rules: {
                charity_name:{
                        required: true,
                        maxlength: 50
                    },
                image:{
                        extension: "png,jpg"
                    },
                }
  
        });
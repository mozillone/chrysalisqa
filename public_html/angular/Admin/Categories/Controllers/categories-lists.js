app.controller('CategoriesController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile) 
{
	var vm = this;
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/categories-list',
        type: 'GET'
      })
      .withDataProp('data.categories')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', true)
      .withOption('lengthChange', false);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn('category_id').withTitle('#'),
                      DTColumnBuilder.newColumn(null).withTitle('Main Category').renderWith(mainCat),
                      DTColumnBuilder.newColumn(null).withTitle('Sub Category').renderWith(subCat),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
    $scope.displayTable = true;
    function actionsHtml(data, type, full, meta) {
         var records='<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="left" title="" href="/category/edit/'+data.category_id+'" data-original-title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="btn btn-xs btn-warning delete" data-toggle="tooltip" data-placement="top" title="" href="javascript:void(0);" data-original-title="Delete" data-id="'+data.category_id+'"><i class="fa fa-trash"></i></a>';
         return records;
    }
    function mainCat(data, type, full, meta) {
        return full.main_cat;
     }
    function subCat(data, type, full, meta) {
         if(full.parent_id=="0"){
            return 'N/A';
         }else{
            return full.name;
         }
    }
   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
   
}); 
 $(document).on('click', '.delete', function(){ 
      var id=$(this).attr('data-id');
      swal({   
              title: "Are you sure want to delete this Attribute?",   
                        text: "You will not be able to recover this Attribute",   
                        showCancelButton: true,   
                        confirmButtonColor: "#DD6B55",   
                        confirmButtonText: "Yes, delete",   
                        closeOnConfirm: false
                      }, 
                      function(){   
                        document.location = "/attribute-delete/"+id;
                      }); 
         
    });

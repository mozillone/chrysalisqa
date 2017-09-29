app.controller('AttributesController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,Amenities) 
{
	var vm = this;
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/attributes-list',
        type: 'GET'
      })
      .withDataProp('data.attributes')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', false)
      .withOption('lengthChange', false);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn('attribute_id').withTitle('#'),
                      DTColumnBuilder.newColumn('label').withTitle('Name'),
                      DTColumnBuilder.newColumn('type').withTitle('Type'),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
    $scope.displayTable = true;
    function actionsHtml(data, type, full, meta) {
         var records='<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="left" title="" href="/attribute/edit/'+data.attribute_id+'" data-original-title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="btn btn-xs btn-warning delete" data-toggle="tooltip" data-placement="top" title="" href="javascript:void(0);" data-original-title="Delete" data-id="'+data.attribute_id+'"><i class="fa fa-trash"></i></a>';
         return records;
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

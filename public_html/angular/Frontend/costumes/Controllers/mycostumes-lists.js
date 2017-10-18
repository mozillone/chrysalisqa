app.controller('MycostumesController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,Costumes) 
{
	var vm = this;
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/my-costumes-list',
        type: 'GET'
      })
      .withDataProp('data.my_costumes')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', false)
      .withOption('lengthChange', false);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn('name').withTitle('Costume Name').notSortable(),
                      DTColumnBuilder.newColumn('date').withTitle('Created Date'),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
    $scope.displayTable = true;
    function actionsHtml(data, type, full, meta) {
         var records='<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" href="/costume/edit/'+full.costume_id+'" data-original-title="View"><i class="fa fa-eye"></i></a> <a class="btn btn-xs btn-danger delete_user" data-toggle="tooltip" data-placement="top" title="" href="javascript:void(0);" data-original-title="Delete" ng-click="deletecostume('+full.costume_id+')"><i class="fa fa-trash-o"></i></a>';
         return records;
    }
   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
       $scope.seachCostumes= function(search){
          Costumes.seachCostumes(search).then(function(response){
          $scope.dtOptions = DTOptionsBuilder.newOptions()
          .withOption('data',response.data.data.my_costumes)
          .withOption('createdRow', createdRow)
            .withOption('order', [ ])
            .withOption('responsive', true)
            .withOption('bFilter', false)
            .withOption('lengthChange', false);
             $scope.dtColumns = [
                      DTColumnBuilder.newColumn('name').withTitle('Costume Name').notSortable(),
                      DTColumnBuilder.newColumn('date').withTitle('Created Date'),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
          $scope.displayTable = true;
    
          });
        } 
        /**
         * Added by Gayatri
         * [Asking Conformation for deleting Costume]
         * @param  {[Integer]} $id [Costume Id]
         * @return {[type]}     [description]
         */
        $scope.deletecostume= function($id){
          var id = $id;
          swal({
            title: "Are you sure want to delete this Costume?",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55 ",
            confirmButtonText: "Yes, delete",
            closeOnConfirm: false,
            closeOnCancel: true
          },

          function(){
            url = "/costumedelete/"+id+"";
            window.location = url;
          });
        }
}); 

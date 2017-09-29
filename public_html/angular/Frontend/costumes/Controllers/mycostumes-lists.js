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
         var records='<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" href="/costume/edit/'+full.costume_id+'" data-original-title="View"><i class="fa fa-eye"></i></a>';
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
}); 

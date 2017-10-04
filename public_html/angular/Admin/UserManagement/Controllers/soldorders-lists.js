app.controller('SoldOrdersController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,Orders) 
{
	var vm = this;
   var user_id=$('input[name="user_id"]').val();
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/user-costumes-slod/'+user_id,
        type: 'GET'
      })
      .withDataProp('data.orders')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', false)
<<<<<<< HEAD
      .withOption('lengthChange', false)
      .withDOM('Bfrtip')
      .withButtons([
                 {
                    extend: 'csv',
                    title: 'Sold Orders List',
                    exportOptions: {
                       columns: ':not(:last-child)'
                    }
                }
            ]);
=======
      .withOption('lengthChange', false);
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn('order_id').withTitle('Order#').notSortable(),
                      DTColumnBuilder.newColumn('buyer_name').withTitle('Buyer').notSortable(),
                      DTColumnBuilder.newColumn('price').withTitle('Price'),
                      DTColumnBuilder.newColumn('status').withTitle('Status'),
                      DTColumnBuilder.newColumn('date').withTitle('Ordered Date'),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
    $scope.displayTable = true;
    function actionsHtml(data, type, full, meta) {
         var records='<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" href="/order/summary/'+data.order_id+'" data-original-title="View"><i class="fa fa-eye"></i></a>';
         return records;
    }
   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
       $scope.seachSoldOrders= function(search){
          Orders.getSoldOrdersSearchlist(search).then(function(response){
          $scope.dtOptions = DTOptionsBuilder.newOptions()
          .withOption('data',response.data.data.orders)
          .withOption('createdRow', createdRow)
            .withOption('order', [ ])
            .withOption('responsive', true)
            .withOption('bFilter', false)
            .withOption('lengthChange', false);
             $scope.dtColumns = [
                      DTColumnBuilder.newColumn('order_id').withTitle('Order#').notSortable(),
                      DTColumnBuilder.newColumn('buyer_name').withTitle('Buyer').notSortable(),
                      DTColumnBuilder.newColumn('price').withTitle('Price'),
                      DTColumnBuilder.newColumn('status').withTitle('Status'),
                      DTColumnBuilder.newColumn('date').withTitle('Ordered Date'),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
          $scope.displayTable = true;
    
          });
        } 
}); 

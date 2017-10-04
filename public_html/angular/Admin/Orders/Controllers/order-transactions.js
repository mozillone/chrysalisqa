app.controller('OrderTransactionsController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile) 
{
	var vm = this;
  var order_id=$('input[name="order_id"]').val();
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/order-transactions/'+order_id,
        type: 'GET'
      })
      .withDataProp('data.transactions')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', true)
      .withOption('lengthChange', false);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn('id').withTitle('Transaction #').notSortable(),
                      DTColumnBuilder.newColumn('transaction_type').withTitle('Type'),
                      DTColumnBuilder.newColumn('transaction_status').withTitle('Status'),
                      DTColumnBuilder.newColumn('date').withTitle('Payment Date'),
                      DTColumnBuilder.newColumn('price').withTitle('Amount'),
                                  ], 
    $scope.displayTable = true;
   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
      
}); 

app.controller('OrderShippingsController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile) 
{
	var vm = this;
  var order_id=$('input[name="order_id"]').val();
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/order-shippings/'+order_id,
        type: 'GET'
      })
      .withDataProp('data.shippings')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', true)
      .withOption('lengthChange', false);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn('id').withTitle('Shipping #').notSortable(),
                      DTColumnBuilder.newColumn('track_no').withTitle('Track_#'),
                      DTColumnBuilder.newColumn(null).withTitle('Shipping Method').renderWith(shippingMethod),
                      DTColumnBuilder.newColumn('is_notified').withTitle('Is Customer Notified?'),
                      DTColumnBuilder.newColumn('date').withTitle('Shipped On'),
                      DTColumnBuilder.newColumn('price').withTitle('Amount'),
                                  ], 
    $scope.displayTable = true;
    function shippingMethod(data, type, full, meta) {
         var records='<b>'+full.type+'-'+full.carrier_code+'</b>';
         return records;
    }
   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
      
}); 

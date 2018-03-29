app.controller('SoldOrdersController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,Orders) 
{
	var vm = this;
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/my-costumes-slod',
        type: 'GET'
      })
      .withDataProp('data.orders')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', false)
      .withOption('class','print_bg')
      .withOption('lengthChange', false);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn('date').withTitle('Date').notSortable(),
                      DTColumnBuilder.newColumn('order_id').withTitle('Order No.').notSortable(),
                      DTColumnBuilder.newColumn('buyer_name').withTitle('Buyer'),
                      DTColumnBuilder.newColumn(null).withTitle('Status').renderWith(status),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
    $scope.displayTable = true;
    function status(data, type, full, meta) {
      if(data.status == 'Shipping'){
        if(data.order_cnt == 1){
          var records = '<a href="/sold/order/track-info/download/'+data.label+'/'+data.carrier_type+'">Print Label</a>';
        }else{
          var records = '<a href="/sold/order/'+data.order_id+'/#ordersShipping">Print Label</a>'
        }
      }else{
        var records = data.status;
      }
      return records;
    }
    function actionsHtml(data, type, full, meta) {
         var records='<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="" href="/sold/order/'+data.order_id+'" data-original-title="View"><i class="fa fa-eye"></i></a>';
         return records;
    }
   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
        if(data.status == 'Shipping'){
          $( row ).addClass('highlight');
        }
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
                      DTColumnBuilder.newColumn('date').withTitle('Date').notSortable(),
                      DTColumnBuilder.newColumn('order_id').withTitle('Order No.').notSortable(),
                      DTColumnBuilder.newColumn('buyer_name').withTitle('Buyer'),
                      DTColumnBuilder.newColumn(null).withTitle('Status').renderWith(status),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
          $scope.displayTable = true;
    
          });
        } 
}); 

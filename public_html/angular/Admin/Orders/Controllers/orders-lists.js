app.controller('OrdersController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,Orders,Exports) 
{
	var vm = this;
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/orders-list',
        type: 'GET'
      })
      .withDataProp('data.orders')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', false)
      .withOption('lengthChange', false)
      .withDOM('Bfrtip')
      .withButtons([
                 {
                    extend: 'print',
                    title: 'Orders List',
                    exportOptions: {
                       columns: ':not(:last-child):not(:first-child)'
                    }
                },
                {
                    extend: 'csv',
                    title: 'Orders List',
                    exportOptions: {
                       columns: ':not(:last-child):not(:first-child)'
                    }
                }
            ]);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn(null).withTitle('<input type="checkbox" id="check_all_users" value="0">').renderWith(getCheckboxes).notSortable(),
                      DTColumnBuilder.newColumn('order_id').withTitle('Order #').notSortable(),
                      DTColumnBuilder.newColumn('user_name').withTitle('Customer Name'),
                      DTColumnBuilder.newColumn('seller_name').withTitle('Seller Name'),
                      DTColumnBuilder.newColumn('amount').withTitle('Amount'),
                      DTColumnBuilder.newColumn('date').withTitle('Ordered Date'),
                      DTColumnBuilder.newColumn('status').withTitle('Status'),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
    $scope.displayTable = true;
    function actionsHtml(data, type, full, meta) {
         var records='<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="right" title="" href="/order/summary/'+data.order_id+'" data-original-title="View"><i class="fa fa-eye"></i></a>';
         return records;
    }
   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
       $scope.seachOrders= function(search){
          Orders.getOrdersSearchlist(search).then(function(response){
          $scope.dtOptions = DTOptionsBuilder.newOptions()
          .withOption('data',response.data.data.orders)
          .withOption('createdRow', createdRow)
            .withOption('order', [ ])
            .withOption('responsive', true)
            .withOption('bFilter', false)
            .withOption('lengthChange', false)
             .withDOM('Bfrtip')
              .withButtons([
                 {
                    extend: 'print',
                    title: 'Orders List',
                    exportOptions: {
                       columns: ':not(:last-child):not(:first-child)'
                    }
                },
                {
                    extend: 'csv',
                    title: 'Orders List',
                    exportOptions: {
                       columns: ':not(:last-child):not(:first-child)'
                    }
                }
            ]);ope.dtColumns = [
                      DTColumnBuilder.newColumn(null).withTitle('<input type="checkbox" id="check_all_users" value="0">').renderWith(getCheckboxes).notSortable(),
                      DTColumnBuilder.newColumn('order_id').withTitle('Order #').notSortable(),
                      DTColumnBuilder.newColumn('user_name').withTitle('Customer Name'),
                      DTColumnBuilder.newColumn('amount').withTitle('Amount'),
                      DTColumnBuilder.newColumn('date').withTitle('Ordered Date'),
                      DTColumnBuilder.newColumn('status').withTitle('Status'),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
          $scope.displayTable = true;
    
          });
        } 
    function getCheckboxes(data) {
       return '<input type="checkbox" class="rowsChecked" name="user_checkboxes" value='+data.order_id+' checked>' 
    }

        $scope.ordersExportCSV = function(){
          var checkboxes = document.getElementsByName("user_checkboxes");
          var checkboxesChecked = []; 
          for (var i=0; i<checkboxes.length; i++) { 
            if (checkboxes[i].checked) {
              checkboxes[i].value
              checkboxesChecked.push(checkboxes[i].value); 
              
            } 
          } 
       
          Exports.ordersExportCSV(checkboxesChecked).then(function(response){
            
            var fileName = "Orders_list.csv";
              var a = document.createElement("a");
              document.body.appendChild(a);
              a.style = "display: none";
            var file = new Blob([response.data], {type: 'application/csv'});
            console.log(file);
              var fileURL = window.URL.createObjectURL(file);
              
              a.href = fileURL;
              a.download = fileName;
              a.click(); 
             
           }); 
    }
}); 

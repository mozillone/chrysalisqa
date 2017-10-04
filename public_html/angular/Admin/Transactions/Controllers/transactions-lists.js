<<<<<<< HEAD
app.controller('TransactionsController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,Transactions,Exports) 
=======
app.controller('TransactionsController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,Transactions) 
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
{
	var vm = this;
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/transactions-list',
        type: 'GET'
      })
      .withDataProp('data.transactions')
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
                    title: 'Transactions List',
                    exportOptions: {
                       columns: ':not(:last-child):not(:first-child)'
                    }
                }
            ]);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn(null).withTitle('<input type="checkbox" id="check_all_users" value="0">').renderWith(getCheckboxes).notSortable(),
=======
      .withOption('lengthChange', false);
       $scope.dtColumns = [
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                      DTColumnBuilder.newColumn('order_id').withTitle('Order #').notSortable(),
                      DTColumnBuilder.newColumn('user_name').withTitle('Customer Name'),
                      DTColumnBuilder.newColumn('price').withTitle('Amount'),
                      DTColumnBuilder.newColumn('date').withTitle('Ordered Date'),
                      DTColumnBuilder.newColumn('status').withTitle('Status'),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
    $scope.displayTable = true;
    function actionsHtml(data, type, full, meta) {
         var records='<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="right" title="" href="/transaction/summary/'+data.transaction_id+'" data-original-title="View"><i class="fa fa-eye"></i></a>';
         return records;
    }
<<<<<<< HEAD
   function getCheckboxes(data) {
       return '<input type="checkbox" class="rowsChecked" name="user_checkboxes" value='+data.transaction_id+' checked>' 
    }

=======
   
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
       $scope.seachTransactions= function(search){
          Transactions.getTransactionsSearchlist(search).then(function(response){
          $scope.dtOptions = DTOptionsBuilder.newOptions()
          .withOption('data',response.data.data.transactions)
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
                    title: 'Transactions List',
                    exportOptions: {
                       columns: ':not(:last-child):not(:first-child)'
                    }
                }
            ]);
             $scope.dtColumns = [
                      DTColumnBuilder.newColumn(null).withTitle('<input type="checkbox" id="check_all_users" value="0">').renderWith(getCheckboxes).notSortable(),
=======
            .withOption('lengthChange', false);
             $scope.dtColumns = [
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                      DTColumnBuilder.newColumn('order_id').withTitle('Order #').notSortable(),
                      DTColumnBuilder.newColumn('user_name').withTitle('Customer Name'),
                      DTColumnBuilder.newColumn('price').withTitle('Amount'),
                      DTColumnBuilder.newColumn('date').withTitle('Ordered Date'),
                      DTColumnBuilder.newColumn('status').withTitle('Status'),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
          $scope.displayTable = true;
    
          });
<<<<<<< HEAD

        } 
          $scope.transactionsExportCSV = function(){
          var checkboxes = document.getElementsByName("user_checkboxes");
          var checkboxesChecked = []; 
          for (var i=0; i<checkboxes.length; i++) { 
            if (checkboxes[i].checked) {
              checkboxes[i].value
              checkboxesChecked.push(checkboxes[i].value); 
              
            } 
          } 
       
          Exports.transactionsExportCSV(checkboxesChecked).then(function(response){
            
            var fileName = "Transactions_list.csv";
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
=======
        } 
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
}); 

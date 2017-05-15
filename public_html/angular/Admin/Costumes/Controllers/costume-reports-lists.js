app.controller('CostumeReportsController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,Reports) 
{
	var vm = this;
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/costume-reports-list',
        type: 'GET'
      })
      .withDataProp('data.costume_reports')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', false)
      .withOption('lengthChange', false);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn('sku_no').withTitle('SKU#'),
                      DTColumnBuilder.newColumn('cst_name').withTitle('Costume Name'),
                      DTColumnBuilder.newColumn('user_name').withTitle('Reporter Name'),
                      DTColumnBuilder.newColumn('phn_no').withTitle('Phone No.'),
                      DTColumnBuilder.newColumn('email').withTitle('Email'),
                      DTColumnBuilder.newColumn('reason').withTitle('Reason'),
                      DTColumnBuilder.newColumn('date').withTitle('Reported Date')
                    ], 
    $scope.displayTable = true;
   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
      $scope.seachUsers= function(search){
          Reports.getReportedCostumesSearchlist(search).then(function(response){
          $scope.dtOptions = DTOptionsBuilder.newOptions()
          .withOption('data',response.data.data.costume_reports)
          .withOption('createdRow', createdRow)
            .withOption('order', [ ])
            .withOption('responsive', true)
            .withOption('bFilter', false)
            .withOption('lengthChange', false);
             $scope.dtColumns = [
                      DTColumnBuilder.newColumn('sku_no').withTitle('SKU#'),
                      DTColumnBuilder.newColumn('cst_name').withTitle('Costume Name'),
                      DTColumnBuilder.newColumn('user_name').withTitle('Reporter Name'),
                      DTColumnBuilder.newColumn('phn_no').withTitle('Phone No.'),
                      DTColumnBuilder.newColumn('email').withTitle('Email'),
                      DTColumnBuilder.newColumn('reason').withTitle('Reason'),
                      DTColumnBuilder.newColumn('date').withTitle('Reported Date')
                    ], 
          $scope.displayTable = true;
    
          });
        } 
    $scope.ordersCsvExport = function(){
        var checkboxes = document.getElementsByName("user_checkboxes"); 
        var checkboxesChecked = [];  
        for (var i=0; i<checkboxes.length; i++) { 
          if (checkboxes[i].checked) {
            checkboxes[i].value
            checkboxesChecked.push(checkboxes[i].value);  
          } 
        } 
     
        Exports.ordersCsvExport(checkboxesChecked).then(function(response){ 
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


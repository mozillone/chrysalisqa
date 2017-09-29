app.controller('PromotionsController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,Promotions) 
{
	var vm = this;
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/promotions-list',
        type: 'GET'
      })
      .withDataProp('data.promotions')
      .withOption('createdRow', createdRow)
      .withOption('order', [0, 'desc'])
      .withOption('responsive', true)
      .withOption('bFilter', false)
      .withOption('lengthChange', false);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn('coupon_id').withTitle('#').notVisible(),
                      DTColumnBuilder.newColumn('name').withTitle('Coupon Name'),
                      DTColumnBuilder.newColumn('code').withTitle('Coupon Code'),
                      DTColumnBuilder.newColumn('discount').withTitle('Discount').renderWith(discount),
                      DTColumnBuilder.newColumn('datestart').withTitle('Applied From'),
                      DTColumnBuilder.newColumn('dateend').withTitle('Applied To'),
                      DTColumnBuilder.newColumn('uses_total').withTitle('No.of uses'),
                      DTColumnBuilder.newColumn('status').withTitle('Status').renderWith(activeHtml),
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
    $scope.displayTable = true;
    function actionsHtml(data, type, full, meta) {
         var records='<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="left" title="" href="/promotion/edit/'+data.coupon_id+'" data-original-title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="btn btn-xs btn-warning delete" data-toggle="tooltip" data-placement="top" title="" href="javascript:void(0);" data-original-title="Delete" data-id="'+data.coupon_id+'"><i class="fa fa-trash"></i></a>';
         return records;
    }
   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
    function discount(data, type, full, meta){
        if(full.type=="percentage"){
            return "$ "+parseInt(full.discount).toFixed(2);
        }else{
             return parseInt(full.discount)+"%";
        }

    }
      function activeHtml(data, type, full, meta) {
      if(full.status!="1"){
        return '<label class="switch"><input type="checkbox" ng-click="changeStatus('+full.coupon_id+', '+full.status+')" ><div class="slider round"></div></div></label>';
      }else{
        return '<label class="switch"><input type="checkbox" checked="checked"  ng-click="changeStatus('+full.coupon_id+', '+full.status+')" ><div class="slider round"></div></div></label>';
        
      }
    }
    $scope.changeStatus=function(coupon_id, status) {
      var promo_status = status==1?0:1;
     var params = {"id":coupon_id, "status":promo_status};
      Promotions.changeStatus(params).then(function(){
       });
      }

      $scope.seachPromotions= function(search){
          Promotions.getPromotionsSearchlist(search).then(function(response){
          $scope.dtOptions = DTOptionsBuilder.newOptions()
          .withOption('data',response.data.data.promotions)
          .withOption('createdRow', createdRow)
           .withOption('order', [0, 'desc'])
            .withOption('responsive', true)
            .withOption('bFilter', false)
            .withOption('lengthChange', false);
             $scope.dtColumns = [
                            DTColumnBuilder.newColumn('coupon_id').withTitle('#').notVisible(),
                            DTColumnBuilder.newColumn('name').withTitle('Coupon Name'),
                            DTColumnBuilder.newColumn('code').withTitle('Coupon Code'),
                            DTColumnBuilder.newColumn('discount').withTitle('Discount').renderWith(discount),
                            DTColumnBuilder.newColumn('datestart').withTitle('Applied From'),
                            DTColumnBuilder.newColumn('dateend').withTitle('Applied To'),
                            DTColumnBuilder.newColumn('uses_total').withTitle('No.of uses'),
                            DTColumnBuilder.newColumn('status').withTitle('Status').renderWith(activeHtml),
                            DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                            .renderWith(actionsHtml)
                          ],
          $scope.displayTable = true;
          });
        } 
}); 
 $(document).on('click', '.delete', function(){ 
      var id=$(this).attr('data-id');
      swal({   
              title: "Are you sure want to delete this Promotion?",   
                        text: "You will not be able to recover this Promotion",   
                        showCancelButton: true,   
                        confirmButtonColor: "#DD6B55",   
                        confirmButtonText: "Yes, delete",   
                        closeOnConfirm: false
                      }, 
                      function(){   
                        document.location = "/promotion-delete/"+id;
                      }); 
         
    });
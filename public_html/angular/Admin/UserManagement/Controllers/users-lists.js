app.controller('UsersController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,UserManagement,Exports) 
{
	var vm = this;
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/customers/list',
        type: 'GET'
      })
      .withDataProp('data.users')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', false)
      .withOption('lengthChange', false);
       $scope.dtColumns = [
               DTColumnBuilder.newColumn(null).withTitle('<input type="checkbox" id="check_all_users" value="0">').renderWith(getCheckboxes).notSortable(),
                             DTColumnBuilder.newColumn('display_name').withTitle('Name'),
                      DTColumnBuilder.newColumn('email').withTitle('Email').notSortable(),
					  DTColumnBuilder.newColumn('phone_number').withTitle('Phone #').notSortable(),
					 // DTColumnBuilder.newColumn('phone_number').withTitle('Is Seller?').notSortable(),
					//  DTColumnBuilder.newColumn(null).withTitle('testing').notSortable().renderWith(phone),,
					  DTColumnBuilder.newColumn(null).withTitle('Is Seller?').notSortable().renderWith(isseller),,
					   DTColumnBuilder.newColumn('lastlogin').withTitle('Last Login Time'),
					  DTColumnBuilder.newColumn(null).withTitle('Credit').notSortable().renderWith(credit),,
					  DTColumnBuilder.newColumn('date_format').withTitle('Created Date'),
                      DTColumnBuilder.newColumn(null).withTitle('Status').notSortable().renderWith(activeHtml),,
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
    $scope.displayTable = true;
     function getCheckboxes(data) {
       return '<input type="checkbox" class="rowsChecked" name="user_checkboxes" value='+data.id+' checked>' 
    }

    function actionsHtml(data, type, full, meta) {
         var records='<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="left" title="" href="/customer-edit/'+data.id+'" data-original-title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="btn btn-xs btn-warning delete" data-toggle="tooltip" data-placement="top" title="" href="javascript:void(0);" data-original-title="Delete" data-id="'+data.id+'"><i class="fa fa-trash"></i></a>';
         return records;
    }
   function activeHtml(data, type, full, meta) {
      if(data.active!="1"){
    	  return '<label class="switch"><input type="checkbox" ng-click="changeStatus('+data.id+', '+data.active+')" ><div class="slider round"></div></div></label>';
      }else{
    	  return '<label class="switch"><input type="checkbox" checked="checked"  ng-click="changeStatus('+data.id+', '+data.active+')" ><div class="slider round"></div></div></label>';
    	  
      }
    }
	function credit(){
	 return '$0.00';
	}
	function isseller(data){
	
		 return "No";
	 
	}
	
	
   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
    $scope.changeStatus=function(userId, status) {
    if(status=="1"){
    	 var user_status = "0";
    }else{
    	var user_status = "1";
    }
    var params = {"id":userId, "status":user_status};
    UserManagement.changeStatus(params).then(function(response){
    	
    });
  }
    $scope.status = [{'name':"Active",'value':"1"},{'name':"Inactive",'value':"0"}];
       $scope.usersExportCSV = function(){
          
          var checkboxes = document.getElementsByName("user_checkboxes");
          
          var checkboxesChecked = []; 
          for (var i=0; i<checkboxes.length; i++) { 
            if (checkboxes[i].checked) {
              checkboxes[i].value
              checkboxesChecked.push(checkboxes[i].value); 
              
            } 
          } 
       
          Exports.userExportCSV(checkboxesChecked).then(function(response){
            
            var fileName = "Users_list.csv";
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
    	$scope.seachUsers= function(search){
        	UserManagement.getCustomersSearchlist(search).then(function(response){
        	$scope.dtOptions = DTOptionsBuilder.newOptions()
        	.withOption('data',response.data.data.users)
        	.withOption('createdRow', createdRow)
            .withOption('order', [ ])
            .withOption('responsive', true)
            .withOption('bFilter', false)
            .withOption('lengthChange', false);
             $scope.dtColumns = [
                 DTColumnBuilder.newColumn(null).withTitle('<input type="checkbox" id="check_all_users" value="0">').renderWith(getCheckboxes).notSortable(),
                         DTColumnBuilder.newColumn('display_name').withTitle('User Name'),
                      DTColumnBuilder.newColumn('email').withTitle('Email').notSortable(),
					  DTColumnBuilder.newColumn('phone_number').withTitle('Phone #').notSortable(),
					 // DTColumnBuilder.newColumn('phone_number').withTitle('Is Seller?').notSortable(),
					  DTColumnBuilder.newColumn(null).withTitle('Is Seller?').notSortable().renderWith(isseller),,
					  DTColumnBuilder.newColumn('lastlogin').withTitle('Last Login'),
					  DTColumnBuilder.newColumn(null).withTitle('Credit').notSortable().renderWith(credit),,
					  DTColumnBuilder.newColumn('date_format').withTitle('Created Date'),
                      DTColumnBuilder.newColumn(null).withTitle('Status').notSortable().renderWith(activeHtml),,
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                          ],
          $scope.displayTable = true;
    
          });
        } 

}); 
app.controller('CostumesController', function($scope,DTOptionsBuilder, DTColumnBuilder, $compile,UserManagement) 
{
	var vm = this;
    $scope.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: '/user-costumes-list',
        type: 'GET'
      })
      .withDataProp('data.costumes')
      .withOption('createdRow', createdRow)
      .withOption('order', [ ])
      .withOption('responsive', true)
      .withOption('bFilter', false)
      .withOption('lengthChange', false);
       $scope.dtColumns = [
                      DTColumnBuilder.newColumn('username').withTitle('Customer Name'),
                      DTColumnBuilder.newColumn('username').withTitle('Email').notSortable(),
					  DTColumnBuilder.newColumn('username').withTitle('Phone #').notSortable(),
					 // DTColumnBuilder.newColumn('phone_number').withTitle('Is Seller?').notSortable(),
					//  DTColumnBuilder.newColumn(null).withTitle('Is Seller?').notSortable().renderWith(isseller),,
					 // DTColumnBuilder.newColumn(null).withTitle('Credit').notSortable().renderWith(credit),,
					  DTColumnBuilder.newColumn('date_format').withTitle('Created Date'),
                      DTColumnBuilder.newColumn(null).withTitle('Status').notSortable().renderWith(activeHtml),,
                      DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                      .renderWith(actionsHtml)
                    ], 
    $scope.displayTable = true;
    function actionsHtml(data, type, full, meta) {
         var records='<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="left" title="" href="/customer-edit/'+data.id+'" data-original-title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="btn btn-xs btn-warning delete" data-toggle="tooltip" data-placement="top" title="" href="javascript:void(0);" data-original-title="Delete" data-id="'+data.id+'"><i class="fa fa-trash"></i></a>';
         return records;
    }
   function activeHtml(data, type, full, meta) {
      if(data.active!="1"){
    	  return '<label class="switch"><input type="checkbox" ng-click="changeStatus('+data.id+', '+data.active+')" ><div class="slider round"></div></div></label>';
      }else{
    	  return '<label class="switch"><input type="checkbox" checked="checked"  ng-click="changeStatus('+data.id+', '+data.active+')" ><div class="slider round"></div></div></label>';
    	  
      }
    }
	function credit(){
	 return '$0.00';
	}
	function isseller(data){
	 if(data.deleted=="0"){
		 return "No";
	 }else{
		 return "yes";
	 }
	}

   
    function createdRow(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
    $scope.changeStatus=function(userId, status) {
    if(status=="1"){
    	 var user_status = "0";
    }else{
    	var user_status = "1";
    }
    var params = {"id":userId, "status":user_status};
    UserManagement.changeStatus(params).then(function(response){
    	
    });
  }
    $scope.status = [{'name':"Active",'value':"1"},{'name':"Inactive",'value':"0"}];
    	$scope.seachUsers= function(search){
        	UserManagement.getCustomersSearchlist(search).then(function(response){
        	$scope.dtOptions = DTOptionsBuilder.newOptions()
        	.withOption('data',response.data.data.users)
        	.withOption('createdRow', createdRow)
            .withOption('order', [ ])
            .withOption('responsive', true)
            .withOption('bFilter', false)
            .withOption('lengthChange', false);
             $scope.dtColumns = [
                            DTColumnBuilder.newColumn('display_name').withTitle('Customer Name'),
							DTColumnBuilder.newColumn('phone_number').withTitle('Phone No.').notSortable(),
                           DTColumnBuilder.newColumn('email').withTitle('Email').notSortable(),
						 // DTColumnBuilder.newColumn('phone_number').withTitle('Is Seller?').notSortable(),
					  DTColumnBuilder.newColumn(null).withTitle('Is Seller?').notSortable().renderWith(isseller),,
					  DTColumnBuilder.newColumn('lastlogin').withTitle('Last Login'),
					  DTColumnBuilder.newColumn(null).withTitle('Credit').notSortable().renderWith(credit),,
					  DTColumnBuilder.newColumn('date_format').withTitle('Created Date'),
                      DTColumnBuilder.newColumn(null).withTitle('Status').notSortable().renderWith(activeHtml),,
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
              title: "Are you sure want to delete this User?",   
                        text: "You will not be able to recover this User",   
                        showCancelButton: true,   
                        confirmButtonColor: "#DD6B55",   
                        confirmButtonText: "Yes, delete",   
                        closeOnConfirm: false
                      }, 
                      function(){   
                        document.location = "/customer-delete/"+id;
                      }); 
         
    });
$("#phone_number").on("keyup paste", function() {
    // Remove invalid chars from the input
    var input = this.value.replace(/[^0-9\(\)\s\-]/g, "");
    var inputlen = input.length;
    // Get just the numbers in the input
    var numbers = this.value.replace(/\D/g,'');
    var numberslen = numbers.length;
    // Value to store the masked input
    var newval = "";

    // Loop through the existing numbers and apply the mask
    for(var i=0;i<numberslen;i++){
        if(i==0) newval="("+numbers[i];
        else if(i==3) newval+=") "+numbers[i];
        else if(i==6) newval+="-"+numbers[i];
        else newval+=numbers[i];
    }

    // Re-add the non-digit characters to the end of the input that the user entered and that match the mask.
    if(inputlen>=1&&numberslen==0&&input[0]=="(") newval="(";
    else if(inputlen>=6&&numberslen==3&&input[4]==")"&&input[5]==" ") newval+=") ";
    else if(inputlen>=5&&numberslen==3&&input[4]==")") newval+=")";
    else if(inputlen>=6&&numberslen==3&&input[5]==" ") newval+=" ";
    else if(inputlen>=10&&numberslen==6&&input[9]=="-") newval+="-";

    $(this).val(newval.substring(0,14));
});
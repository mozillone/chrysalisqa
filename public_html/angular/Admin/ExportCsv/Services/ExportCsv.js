//Exports
app.factory('Exports', function($http){
  var fac={}; 
  fac.userExportCSV=function(data){ 
	     return  $http({
	          method: 'POST',
	          url: '/user/csvExport',
	          data:{data:data}   
	       })
	     }  
   fac.charitiesExportCSV=function(data){ 
	     return  $http({
	          method: 'POST',
	          url: '/charities/csvExport',
	          data:{data:data}   
	       })
	     } 
	     
   fac.transactionsExportCSV=function(data){ 
	     return  $http({
	          method: 'POST',
	          url: '/export-transaction',
	          data:{data:data}   
	       })
	     } 

   fac.ordersExportCSV=function(data){ 
	     return  $http({
	          method: 'POST',
	          url: '/export-orders',
	          data:{data:data}   
	       })
	     } 	     
	

  return fac;
});
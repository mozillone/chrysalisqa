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
<<<<<<< HEAD
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
=======
	     }  
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
	

  return fac;
});
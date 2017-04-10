//Exports
app.factory('Exports', function($http){
  var fac={}; 
  fac.userExportCSV=function(data){ 
	     return  $http({
	          method: 'POST',
	          url: '/customer/csvExport',
	          data:{data:data}   
	       })
	     }  
	fac.salesRepsExportCSV=function(data){ 
		return  $http({
		  method: 'POST',
		  url: '/salesReps/csvExport',
		  data:{data:data}   
		})
	}  
	fac.deliveryUserExportCSV=function(data){ 
		return  $http({
		  method: 'POST',
		  url: '/deliveryUser/csvExport',
		  data:{data:data}   
		})
	}  
	fac.adminUserExportCSV=function(data){ 
		return  $http({
		  method: 'POST',
		  url: '/adminUser/csvExport',
		  data:{data:data}   
		})
	}
	fac.restaurantsCsvExport=function(data){ 
		return  $http({
		  method: 'POST',
		  url: '/restaurants/csvExport',
		  data:{data:data}   
		})
	}
	fac.ordersCsvExport=function(data){ 
		return  $http({
		  method: 'POST',
		  url: '/orders/csvExport',
		  data:{data:data}   
		})
	}

  return fac;
});
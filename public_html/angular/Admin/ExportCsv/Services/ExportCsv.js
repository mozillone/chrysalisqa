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
	

  return fac;
});
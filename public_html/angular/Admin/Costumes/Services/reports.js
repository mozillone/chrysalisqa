//display roles list
app.factory('Reports', function($http){
	 var fac={};
	 fac.getReportedCostumesSearchlist=function(search){
	 	  var _token=$('.token').val();
	 	 return  $http({
	       method: 'POST',
	     	url: '/costume-reports-list',
	       data:{search:search,_token:_token}
	    });
	  
	  }
  return fac;
});
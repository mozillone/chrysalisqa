//display roles list
app.factory('Charities', function($http){
	 var fac={};
	 fac.getCharitiesSearchlist=function(search){
	 	  var _token=$('.token').val();
	 	 return  $http({
	       method: 'POST',
	     	url: '/charities-list',
	       data:{search:search,_token:_token}
	    });
	  }
	  fac.changeStatus=function(params){
	  return  $http({
	       method: 'POST',
	       url: '/charity/status/change',
	       data:{data:params}
	    });
	  }
  return fac;
});
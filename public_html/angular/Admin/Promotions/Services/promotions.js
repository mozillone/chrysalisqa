//display roles list
app.factory('Promotions', function($http){
	 var fac={};
	 fac.getPromotionsSearchlist=function(search){
	 	  var _token=$('.token').val();
	 	 return  $http({
	       method: 'POST',
	     	url: '/promotions-list',
	       data:{search:search,_token:_token}
	    });
	  }
	  fac.changeStatus=function(params){
	  return  $http({
	       method: 'POST',
	       url: '/promotion/status/change',
	       data:{data:params}
	    });
	  }
  return fac;
});
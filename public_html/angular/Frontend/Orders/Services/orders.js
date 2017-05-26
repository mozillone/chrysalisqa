//display roles list
app.factory('Orders', function($http){
	 var fac={};
	 fac.getOrdersSearchlist=function(search){
	 	  var _token=$('.token').val();
	 	 return  $http({
	       method: 'POST',
	     	url: '/my-orders-list',
	       data:{search:search,_token:_token}
	    });
	  
	  }
	   fac.getSoldOrdersSearchlist=function(search){
	 	  var _token=$('.token').val();
	 	 return  $http({
	       method: 'POST',
	     	url: '/my-costumes-slod',
	       data:{search:search,_token:_token}
	    });
	  
	  }
  return fac;
});
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
  return fac;
});
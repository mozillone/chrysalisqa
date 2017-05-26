//display roles list
app.factory('Orders', function($http){
	 var fac={};
	 fac.getOrdersSearchlist=function(search){
	 	 var _token=$('.token').val();
	 	 var user_id=$('input[name="user_id"]').val();
	 	 return  $http({
	       method: 'POST',
	     	url: '/user-orders-list/'+user_id,
	       data:{search:search,_token:_token}
	    });
	  
	  }
	   fac.getSoldOrdersSearchlist=function(search){
	 	 var _token=$('.token').val();
	 	 var user_id=$('input[name="user_id"]').val();
	 	 return  $http({
	       method: 'POST',
	     	url: '/user-costumes-slod/'+user_id,
	       data:{search:search,_token:_token}
	    });
	  
	  }
  return fac;
});
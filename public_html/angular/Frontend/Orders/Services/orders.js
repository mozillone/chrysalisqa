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
<<<<<<< HEAD
	  fac.getMycostumeSearchlist=function(search){
	 	  var _token=$('.token').val();
	 	 return  $http({
	       method: 'POST',
	     	url: '/my-costumes-list',
	       data:{search:search,_token:_token}
	    });
	  
	  }
=======
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
  return fac;
});
//display roles list
app.factory('Costumes', function($http){
	 var fac={};
	 fac.seachCostumes=function(search){
	 	  var _token=$('.token').val();
	 	 return  $http({
	       method: 'POST',
	     	url: '/my-costumes-list',
	       data:{search:search,_token:_token}
	    });
	  
	  }
	
  return fac;
});
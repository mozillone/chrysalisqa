//display roles list
app.factory('UserManagement', function($http){
	 var fac={};
	 fac.getCustomerslist=function(){
	     return  $http({
	           url: '/customers/list',
	        })
	  }
	 fac.getCustomersSearchlist=function(search){
		  var _token=$('.token').val();
	  return  $http({
	       method: 'POST',
	       url: '/customers/list',
	       data:{search:search,_token:_token}
	    });
	  }
	  fac.changeStatus=function(params){
	  return  $http({
	       method: 'POST',
	       url: '/status/change',
	       data:{data:params}
	    });
	  }
	
	 
  return fac;
});
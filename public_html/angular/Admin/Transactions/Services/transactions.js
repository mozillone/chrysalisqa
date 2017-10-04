//display roles list
app.factory('Transactions', function($http){
	 var fac={};
	 fac.getTransactionsSearchlist=function(search){
	 	  var _token=$('.token').val();
	 	 return  $http({
	       method: 'POST',
	     	url: '/transactions-list',
	       data:{search:search,_token:_token}
	    });
	  
	  }
  return fac;
});
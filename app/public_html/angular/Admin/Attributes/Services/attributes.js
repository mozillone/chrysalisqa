//display roles list
app.factory('Amenities', function($http){
	 var fac={};
	 fac.getAmenitieslist=function(){
	     return  $http({
	           url: '/attributes/list',
	        })
	  }
  return fac;
});
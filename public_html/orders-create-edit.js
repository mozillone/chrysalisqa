app.controller('OrderCreateEditCntl', function($scope,UserManagement,Orders) {
	$scope.new_agent=true;
	$scope.formSubmitted = false;
	$scope.choices = [];
	UserManagement.getAgentslist().then(function(response){
		$scope.agents=response.data.data.agents;
	});
	$scope.states=[{"name":"Alabama"},{"name":"Alaska"},{"name":"Arizona"},{"name":"Arkansas"},{"name":"California"},
		            {"name":"Colorado"},{"name":"Connecticut"},{"name":"Delaware"},{"name":"Florida"},{"name":"Georgia"},
		            {"name":"Hawaii"},{"name":"Idaho"},{"name":"Illinois"},{"name":"Indiana"},{"name":"Iowa"},
		            {"name":"Kansas"},{"name":"Kentucky"},{"name":"Louisiana"},{"name":"Maine"},{"name":"Maryland"},
		            {"name":"Massachusetts"},{"name":"Michigan"},{"name":"Minnesota"},{"name":"Mississippi"},{"name":"Missouri"},
		            {"name":"Montana"},{"name":"Nebraska"},{"name":"Nevada"},{"name":"New Hampshire"},{"name":"New Jersey"},
		            {"name":"New Mexico"},{"name":"New York"},{"name":"North Carolina"},{"name":"North Dakota"},{"name":"Ohio"},
		            {"name":"Oklahoma"},{"name":"Oregon"},{"name":"Pennsylvania"},{"name":"Rhode Island"},{"name":"South Carolina"},
		            {"name":"South Dakota"},{"name":"Tennessee"},{"name":"Texas"},{"name":"Utah"},{"name":"Vermont"},
		            {"name":"Virginia"},{"name":"Washington"},{"name":"West Virginia"},{"name":"Wisconsin"},{"name":"Wyoming"}
		    	  ];
	$scope.getAgentInfo=function(agent_id){
		if(agent_id!=""){
			$scope.new_agent=false;
			UserManagement.getAgentInfo(agent_id).then(function(response){
				$scope.agent_info=response.data.data.agent_info[0];
			});
		}
		else{
			$scope.agent_info={};
			$scope.new_agent=true;
		}
	}
	$scope.getPackeges=function(service_id){
		if(service_id!="" || service_id!=""){
			$scope.new_agent=false;
			Orders.getPackagesList(service_id).then(function(response){
				$scope.packages_list=response.data.data.packages_list;
			});
		}
		else{
		}
	}
	$scope.AddService= function() {
	    var services_count=angular.element('.services_count li').length;
	    var newItemNo = $scope.choices.length+1;
	    $scope.choices.push({'id':'choice'+newItemNo});
	}
	$scope.CreateOrder=function(valid,event,e){
		e.preventDefault();
		if(!valid){
			$scope.formSubmitted = true;
		}
	}
});
(function () {
	'use strict';
	var myApp = angular.module("list"); //Music corresponds to the module//
	myApp.controller("dataControl", function($scope, $http,$window) { //Scope defines variables that can be accessed through HTML//
		
		//data on songs
		$http.get("getlists.php")
		.then(function(response){
			$scope.data = response.data.value;
			
		});
		
		//Acount Related Functions
		
		//Save new account
		$scope.newAccount = function(accountDetails) {
            var account = angular.copy(accountDetails);
            
            $http.post("newaccount.php", account)
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        $window.location.href ="index.html";
                    }
                } else {
                    alert('unexpected error');
                }
            });
        };
		
		// save list
		$scope.saveList = function(listDetails) {
            var list = angular.copy(listDetails);
            
            $http.post("savelist.php", list)
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        $window.location.href ="addItemName.html";
                    }
                } else {
                    alert('unexpected error');
                }
            });
        };
		
		// add to list
		$scope.addToItem = function(listDetails) {
            var list = angular.copy(listDetails);
            
            $http.post("addToItem.php", list)
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        $window.location.href ="addList2.html";
                    }
                } else {
                    alert('unexpected error');
                }
            });
        };
		
		// add to attribute
		$scope.addToAttribute = function(listDetails) {
            var list = angular.copy(listDetails);
            
            $http.post("addToAttribute.php", list)
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        $window.location.href ="addList2.html";
                    }
                } else {
                    alert('unexpected error');
                }
            });
        };
        
		// vote up on list
		$scope.voteList = function(listDetails) {
            var vote = angular.copy(listDetails);
            
            $http.post("vote.php", vote)
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        $window.location.href ="index.html";
                    }
                } else {
                    alert('unexpected error');
                }
            });
        };
		
		// vote down on list
		$scope.voteDownList = function(listDetails) {
            var vote = angular.copy(listDetails);
            
            $http.post("votedown.php", vote)
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        $window.location.href ="index.html";
                    }
                } else {
                    alert('unexpected error');
                }
            });
        };
        // logs in
        $scope.login = function(credentialDetails) {
            var credentials = angular.copy(credentialDetails);
            
            $http.post("log-in.php", credentials)
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        $window.location.href ="index.html";
                    }
                } else {
                    alert('unexpected error');
                }
            });
        };        
        

        // logs out
        $scope.logout = function() {
            $http.post("log-out.php")
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response);
                    } else {
                        //successful
                        $window.location.href ="index.html";
                    }
                } else {
                    alert('unexpected error');
                }
            });
        };
        
        // is logged in
        $scope.isloggedin = function() {
           $http.post("is-log-in.php")
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        // return whether logged in or not
                        $scope.isloggedin = response.data.loggedin;
						
                    }
                } else {
                    alert('unexpected error');
                }
            });            
        };
        
        // get session variable
        $scope.getSessionVariable = function(attribute) {
           $http.post("getsessionvariable.php", attribute)
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        // return value of attribute
                        return response.data.value;
                    }
                } else {
                    alert('unexpected error');
                }
            });            
        };
        
        // set session variable
        $scope.setSessionVariable = function(attribute, value) {
           $http.post("setsessionvariable.php", {"attribute": attribute, "value":value})
                .then(function (response) {
                if (response.status == 200) {
                    if (response.data.status == 'error') {
                        alert ('error: ' + response.data.message);
                    } else {
                        //successful
                        return true;
                    }
                } else {
                    alert('unexpected error');
                }
            });            
        };
		
	
		
		
		//These are variables used for the search bar//
		$scope.query ={};
		$scope.queryBy = "$";
		
		//variable that tells us which menu item should be highlighted
		$scope.menuHighlight = 0;
		
		
	});
} )();
(function () {
	'use strict';
	var myApp = angular.module("list"); //Music corresponds to the module//
	myApp.controller("dataControl", function() { //Scope defines variables that can be accessed through HTML//
		
		
			
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
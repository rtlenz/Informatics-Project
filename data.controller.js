(function(){
    'use strict';
    
    var myApp = angular.module("list");
    myApp.controller("dataControl", function($scope, $http, $window) {
        



        //log in
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
        
        
        //log out
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
        
    
    
         // ! logged in
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

        
  });

} )();
        
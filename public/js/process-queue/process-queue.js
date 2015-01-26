/**
 * Created by USER on 1/26/15.
 */
//global variables
var service_id = angular.element(document.querySelector('#service-id')).val();
var all_numbers_url = angular.element(document.querySelector('#all-numbers-url')).val() + '/';
var issue_numbers_url = angular.element(document.querySelector('#issue-numbers-url')).val() + '/';
var issue_multiple_url = angular.element(document.querySelector('#issue-multiple-url')).val() + '/';
var call_number_url = angular.element(document.querySelector('#call-number-url')).val() + '/';
var serve_number_url = angular.element(document.querySelector('#serve-number-url')).val() + '/';
var drop_number_url = angular.element(document.querySelector('#drop-number-url')).val() + '/';


var app = angular.module('processqueue', []);

app.controller('processqueueController', function($scope, $http){
    $scope.called_numbers = [];
    $scope.uncalled_numbers = [];
    $scope.processed_numbers = [];

    $scope.getAllNumbers = function(){
        $http.get(all_numbers_url + service_id)
            .success(function(response){
                $scope.called_numbers = response.numbers.called_numbers;
                $scope.uncalled_numbers = response.numbers.uncalled_numbers;
                $scope.processed_numbers = response.numbers.processed_numbers;
            });
    };

    $scope.callNumber = function(transaction_number){
        $http.get(call_number_url + transaction_number)
            .success(function(response){
                //@todo call number success function
            });
    };

    $scope.serveNumber = function(transaction_number){
        $http.get(serve_number_url + transaction_number)
            .success(function(response){
                //@todo serve number success function
            });
    };

    $scope.dropNumber = function(transaction_number){
        $http.get(drop_number_url + transaction_number)
            .success(function(response){
                //@todo drop number success function
            });
    };


    setInterval(function(){
        $scope.getAllNumbers();
    }, 2000);
});

app.controller('issuenumbersController', function($scope, $http){
    $scope.issueNumber = function(){
        $http.get(issue_numbers_url + service_id)
            .success(function(response){
                //@todo issue number success function
            });
    };

    $scope.issueMultiple = function(range, date){
        $http.get(issue_multiple_url + service_id + range + date)
            .success(function(response){
                //@todo issue multiple number success function
            });
    };
});
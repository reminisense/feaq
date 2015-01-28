/**
 * Created by USER on 1/26/15.
 */
    //global variables
    var service_id = angular.element(document.querySelector('#service-id')).val();
    var terminal_id = angular.element(document.querySelector('#terminal-id')).val();
    var all_numbers_url = angular.element(document.querySelector('#all-numbers-url')).val() + '/';
    var call_number_url = angular.element(document.querySelector('#call-number-url')).val() + '/';
    var serve_number_url = angular.element(document.querySelector('#serve-number-url')).val() + '/';
    var drop_number_url = angular.element(document.querySelector('#drop-number-url')).val() + '/';

    var issue_numbers_url = angular.element(document.querySelector('#issue-numbers-url')).val() + '/';
    var issue_multiple_url = angular.element(document.querySelector('#issue-multiple-url')).val() + '/';

    var app = angular.module('processqueue', []);
    app.controller('processqueueController', function($scope, $http){
        $scope.called_numbers = [];
        $scope.uncalled_numbers = [];
        $scope.processed_numbers = [];

        $scope.getAllNumbers = function(){
            getResponseResetValues(all_numbers_url + service_id);
        };

        $scope.callNumber = function(transaction_number){
            getResponseResetValues(call_number_url + transaction_number + '/' + terminal_id);
        };

        $scope.serveNumber = function(transaction_number){
            getResponseResetValues(serve_number_url + transaction_number);
        };

        $scope.dropNumber = function(transaction_number){
            getResponseResetValues(drop_number_url + transaction_number);
        };

        //non scope functions
        getResponseResetValues = function(url, callback){
            $http.get(url).success(function(response){
                resetValues(response);
                if(typeof callback === 'function'){
                    callback();
                }
            });
        };

        resetValues = function(response){
            $scope.called_numbers = response.numbers.called_numbers;
            $scope.uncalled_numbers = response.numbers.uncalled_numbers;
            $scope.processed_numbers = response.numbers.processed_numbers;

//        if($scope.called_number == null && $scope.uncalled_numbers){
//            $scope.called_number = $scope.uncalled_numbers[Object.keys($scope.uncalled_numbers)[0]].transaction_number;
//        }
        };

        //****************************** refreshing
        $scope.getAllNumbers();
        setInterval(function(){
            $scope.getAllNumbers();
        }, 2000);
    });


    //Issue numbers
    app.controller('issuenumbersController', function($scope, $http){
        $scope.issueNumber = function(){
            $http.get(issue_numbers_url + service_id)
                .success(function(response){
                    //@todo issue number success function
                });
        };

        $scope.issueMultiple = function(range, date){
            url = issue_multiple_url + service_id + '/' + range;
            url = date == undefined ? url : url + '/' + date;
            $http.get( url )
                .success(function(response){
                    //@todo issue multiple number success function
                });
        };
    });

    app.controller('queuesettingsController', function($scope, $http){

    });
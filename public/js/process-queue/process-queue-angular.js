/**
 * Created by USER on 2/2/15.
 */
//angularjs implementation
(function(){
    //var app = angular.module('FeatherQ', []);
    app.controller('processqueueController', function($scope, $http){
        $scope.terminal_id = pq.ids.terminal_id;
        $scope.called_numbers = [];
        $scope.uncalled_numbers = [];
        $scope.processed_numbers = [];
        $scope.timebound_numbers = [];

        $scope.called_number = 0;
        $scope.next_number = 0;

        $scope.getAllNumbers = function(){
            getResponseResetValues(pq.urls.process_queue.all_numbers_url + pq.ids.service_id + '/' + pq.ids.terminal_id, null, null, function(){
                setTimeout(function(){
                    $scope.getAllNumbers();
                }, 1000);
            });
        };

        $scope.callNumber = function(transaction_number){
            $scope.isCalling = true;
            transaction_number = transaction_number != undefined ? transaction_number : angular.element(document.querySelector('#selected-tnumber')).val();
            getResponseResetValues(pq.urls.process_queue.call_number_url + transaction_number + '/' + pq.ids.terminal_id, function(){
                pq.jquery_functions.remove_and_update_dropdown(transaction_number);
                $scope.issue_call_number = null;
                $scope.isCalling = false;
            });
        };

        $scope.serveNumber = function(transaction_number, callback){
            $scope.isProcessing = true;
            getResponseResetValues(pq.urls.process_queue.serve_number_url + transaction_number, function(){
                pq.jquery_functions.remove_from_called(transaction_number);
                if(typeof callback === 'function') callback();
            }, null, function(){
                $scope.isProcessing = false;
            });
        };

        $scope.dropNumber = function(transaction_number){
            $scope.isProcessing = true;
            getResponseResetValues(pq.urls.process_queue.drop_number_url + transaction_number, function(){
                pq.jquery_functions.remove_from_called(transaction_number);
            }, null, function(){
                $scope.isProcessing = false;
            });
        };

        $scope.serveAndCallNext = function(transaction_number){
            $scope.serveNumber(transaction_number, function(){
                $scope.callNumber();
            });
        };

        $scope.issueAndCall = function(priority_number){
            if(!isNaN(priority_number)){
                $http.post(pq.urls.issue_numbers.issue_specific_url + pq.ids.service_id + '/' + pq.ids.terminal_id, {priority_number : priority_number})
                    .success(function(response){
                        $scope.callNumber(response.number.transaction_number);
                    });
            }else{
                $scope.isCalling = false;
            }
        }

        $scope.issueOrCall = function(){
            $scope.isCalling = true;
            if($scope.timebound_numbers.length == 0 && $scope.uncalled_numbers.length == 0){
                priority_number = $scope.issue_call_number == undefined ? null : $scope.issue_call_number;
                $scope.issueAndCall(priority_number);
            }else{
                $scope.callNumber();
            }
        }



        //non scope functions
        getResponseResetValues = function(url, successFunc, errorFunc, finallyFunc){
            $http.get(url)
                .success(function(response){
                    if(response.numbers) resetValues(response.numbers);
                    if(typeof successFunc === 'function') successFunc();
                })
                .error(function(){
                    if(typeof errorFunc === 'function') errorFunc();
                }).finally(function(){
                    if(typeof finallyFunc === 'function') finallyFunc();
                    select_next_number();
                });
        };

        resetValues = function(numbers){
            $scope.called_numbers = numbers.called_numbers;
            $scope.uncalled_numbers = numbers.uncalled_numbers;
            $scope.processed_numbers = numbers.processed_numbers;
            $scope.timebound_numbers = numbers.timebound_numbers;
            $scope.next_number = numbers.next_number

            pq.jquery_functions.set_next_number_placeholder($scope.next_number);
        };

        select_next_number = function(){
            next_number = angular.element(document.querySelector('#selected-tnumber')).val();
            is_uncalled = pq.jquery_functions.find_in_numbers_array(next_number, $scope.uncalled_numbers);
            is_timebound = pq.jquery_functions.find_in_numbers_array(next_number, $scope.timebound_numbers);


            if($scope.timebound_numbers.length == 0 && $scope.uncalled_numbers.length == 0){
                pq.jquery_functions.remove_and_update_dropdown();
            }else if(next_number == 0){
                if($scope.timebound_numbers.length > 0){
                    pq.jquery_functions.select_number($scope.timebound_numbers[0].transaction_number, $scope.timebound_numbers[0].priority_number);
                }else if($scope.uncalled_numbers.length > 0){
                    pq.jquery_functions.select_number($scope.uncalled_numbers[0].transaction_number, $scope.uncalled_numbers[0].priority_number);
                }
            }else if(is_uncalled.length == 0 && is_timebound.length == 0){
                pq.jquery_functions.remove_and_update_dropdown();
            }else if($scope.timebound_numbers.length > 0 && is_timebound.length == 0){
                pq.jquery_functions.select_number($scope.timebound_numbers[0].transaction_number, $scope.timebound_numbers[0].priority_number);
            }
        }

        //****************************** refreshing
            $scope.getAllNumbers();

    });

})();


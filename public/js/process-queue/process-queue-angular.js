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

        $scope.callNumber = function(){
            $scope.isCalling = true;
            transaction_number = angular.element(document.querySelector('#selected-tnumber')).val();
            getResponseResetValues(pq.urls.process_queue.call_number_url + transaction_number + '/' + pq.ids.terminal_id, function(){
                pq.jquery_functions.remove_and_update_dropdown(transaction_number);
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


    //Issue numbers
    app.controller('issuenumberController', function($scope, $http){
        $scope.priority_number = null;
        $scope.time_assigned = null;
        $scope.name = null;
        $scope.phone = null;
        $scope.email = null;

        $scope.range = null;

        $scope.issueMultiple = function(range, date){
            $scope.isIssuing = true;
            url = pq.urls.issue_numbers.issue_multiple_url + pq.ids.service_id + '/' + range + '/' + $pq.ids.terminal_id;
            url = date == undefined ? url : url + '/' + date;

            $http.get( url )
                .success(function(response){
                    message = 'Issue number successful! <br> First number : ' + response.first_number + ' <br> Last number : ' + response.last_number;
                    pq.jquery_functions.issue_number_success(message);

                    $scope.range = '';
                }).finally(function(){
                    $scope.isIssuing = false;
                });
        };

        $scope.issueSpecific = function(priority_number, name, phone, email, time_assigned){
            $scope.isIssuing = true;
            data = {
                priority_number : priority_number,
                name : name,
                phone : phone,
                email : email,
                time_assigned : time_assigned
            };
            $http.post(pq.urls.issue_numbers.issue_specific_url + pq.ids.service_id + '/' + pq.ids.terminal_id, data)
                .success(function(response){
                    message = 'Issue number successful! <br> Number : ' + response.number.priority_number;
                    pq.jquery_functions.issue_number_success(message);

                    $scope.priority_number = '';
                    $scope.name = '';
                    $scope.phone = '';
                    $scope.email = '';
                    $scope.time_assigned = '';
                }).finally(function(){
                    $scope.isIssuing = false;
                });
        }

        $scope.checkIssueSpecificErrors = function(){
            time_format = /^([0-9]{2})\:([0-9]{2})([ ][aApP][mM])$/g;
            error = false
            error_message = '';

            //check phone number
            if(isNaN($scope.priority_number)){
                error = true;
                error_message += 'Priority number is invalid. ';
            }

            //check phone number
            if(isNaN($scope.phone)){
                error = true;
                error_message += 'Phone number is invalid. ';
            }

            //check email
            if($scope.issue_specific_form.email.$error.email ){
                error = true;
                error_message += 'Invalid email format. ';
            }

            //check time assigned
            if(time_format.test($scope.time_assigned) != true && $scope.time_assigned){
                error = true;
                error_message += 'Invalid time format. ';
            }

            $scope.issue_specific_error = error_message;
            return error;
        }

        $scope.checkIssueMultipleErrors = function(){
            error = false;
            error_message = '';
            if($scope.issue_multiple_form.range.$error.required){
                error = true;
                error_message += 'Quantity is required. ';
            }else if($scope.issue_multiple_form.range.$error.number){
                error = true;
                error_message += 'Quantity should be a number. ';
            }else if($scope.issue_multiple_form.range.$viewValue <= 0){
                error = true;
                error_message += 'Quantity should be greater than zero. ';
            }

            $scope.issue_multiple_error = error_message;
            return error;
        }

    });

})();


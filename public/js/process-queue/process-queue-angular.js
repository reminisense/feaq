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

        $scope.create_temporary_array = 0;
        $scope.temp_called_numbers = [];
        $scope.rating_stars = {
            value:0,
            tran_number: 0,
            email: "",
            email_checker : false,
            terminal_id : 0
        };

        $scope.called_number = 0;
        $scope.next_number = 0;
        $scope.number_limit = null;
        $scope.issue_call_number = null;

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
                checkEmailAndAdd($scope.called_numbers[0].email, transaction_number);
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
            angular.forEach($scope.temp_called_numbers, function(temp,i){
                if(temp.tran_number == transaction_number){
                    if( temp.email_checker == true){
                        $http.get(pq.urls.rating.ratings_url + temp.rating + "/" + temp.email + "/" + temp.terminal_id + '/' + 2)
                            .success(function(response){
                            });
                    }
                    addOrRemoveRating(i,1);
                }
            });
        };

        $scope.dropNumber = function(transaction_number){
            $scope.isProcessing = true;
            getResponseResetValues(pq.urls.process_queue.drop_number_url + transaction_number, function(){
                pq.jquery_functions.remove_from_called(transaction_number);
            }, null, function(){
                $scope.isProcessing = false;
            });
            angular.forEach($scope.temp_called_numbers, function(temp,i){
                if(temp.tran_number == transaction_number){
                    if( temp.email_checker == true){
                        $http.get(pq.urls.rating.ratings_url + temp.rating + "/" + temp.email + "/" + temp.terminal_id + '/' + 3)
                            .success(function(response){
                            });
                    }
                    addOrRemoveRating(i,1);
                }
            });
        };

        $scope.serveAndCallNext = function(transaction_number){
            $scope.serveNumber(transaction_number, function(){
                $scope.issue_call_number = null;
                $scope.callNumber();
            });
        };

        $scope.stopProcessQueue = function(){
            if($scope.called_numbers.length > 0){
                $scope.serveNumber($scope.called_numbers[0].transaction_number, function(){
                    $scope.stopProcessQueue();
                });
            }
        }

        $scope.issueAndCall = function(priority_number){
            $http.post(pq.urls.issue_numbers.issue_specific_url + pq.ids.service_id + '/' + pq.ids.terminal_id, {priority_number : priority_number})
                .success(function(response){
                    $scope.callNumber(response.number.transaction_number);
                });
            $scope.isCalling = false;
        }

        $scope.issueOrCall = function(){
            $scope.isCalling = true;
            if($scope.timebound_numbers.length == 0 && $scope.uncalled_numbers.length == 0){
                if(!checkTextfieldErrors($scope.issue_call_number) && $scope.issue_call_number !== undefined){
                    $scope.issueAndCall($scope.issue_call_number);
                }else{
                    $scope.isCalling = false;
                }
            }else{
                $scope.callNumber();
            }
        }

        checkTextfieldErrors = function(priority_number){
            return angular.element(document.querySelector('#moreq')).scope().checkIssueSpecificErrors(priority_number, $scope.number_limit, false);
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
            $scope.next_number = numbers.next_number;
            $scope.number_limit = numbers.number_limit;

            pq.jquery_functions.set_next_number_placeholder($scope.next_number);

            if($scope.create_temporary_array == 0){
                createTemporaryRatingsArray();
                $scope.create_temporary_array = 1;

            }
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

        checkEmailAndAdd = function(email, transaction_number){
            if(email){
                $http.get(pq.urls.rating.verify_email_url + email)
                    .success(function(response){
                        addOrRemoveRating(0,0,{
                            rating : 0,
                            tran_number : transaction_number,
                            email : $scope.called_numbers[0].email,
                            email_checker : response.result,
                            terminal_id : $scope.called_numbers[0].terminal_id
                        });
                    });
            }else{
                addOrRemoveRating(0,0,{
                    rating : 0, tran_number : transaction_number,
                    email : $scope.called_numbers[0].email,
                    email_checker : false,
                    terminal_id : $scope.called_numbers[0].terminal_id});
            }
        }

        createTemporaryRatingsArray = function(){
            angular.forEach($scope.called_numbers, function(called_number, i) {
                if(called_number.email){
                    $http.get(pq.urls.rating.verify_email_url + called_number.email)
                        .success(function(response){
                            $scope.temp_called_numbers[i] = ({
                                rating : 0,
                                tran_number : called_number.transaction_number,
                                email : called_number.email,
                                email_checker : response.result,
                                terminal_id : called_number.terminal_id
                            });
                        });
                }else{
                    $scope.temp_called_numbers[i] = ({
                        rating : 0,
                        tran_number :called_number.transaction_number,
                        email : called_number.email,
                        email_checker : false,
                        terminal_id : called_number.terminal_id
                    });
                }
            });
        }

        addOrRemoveRating = function(index, item, object){
            if(object){
                $scope.temp_called_numbers.splice(index, item, object);
            }else{
                $scope.temp_called_numbers.splice(index, item);
            }
        }

        //****************************** refreshing
            $scope.getAllNumbers();

    });

})();


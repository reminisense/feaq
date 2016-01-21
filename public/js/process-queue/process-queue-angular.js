/**
 * Created by USER on 2/2/15.
 */
//angularjs implementation
(function(){
    app.requires.push('ngSanitize');
    app.requires.push('angular-loading-bar'); //add angular loading bar
    app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
        cfpLoadingBarProvider.includeSpinner = false;
    }]);

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

        //open a web socket connection
        websocket = new ReconnectingWebSocket(websocket_url);
        websocket.onopen = function(response) { // connection is open
            $('#WebsocketLoaderModal').modal('hide');
            $scope.updateBroadcast();
        }
        websocket.onmessage = function(response){
            $scope.getAllNumbers();
        }

        $scope.getAllNumbers = function(){
            getResponseResetValues(pq.urls.process_queue.all_numbers_url + pq.ids.service_id + '/' + pq.ids.terminal_id, null, null, function(){
                //setTimeout(function(){
                //    $scope.getAllNumbers();
                //}, 1000);
            });
        };

        $scope.callNumber = function(transaction_number){
            $scope.isCalling = true;
            transaction_number = transaction_number != undefined ? transaction_number : angular.element(document.querySelector('#selected-tnumber')).val();

            getResponseResetValues(pq.urls.process_queue.call_number_url + transaction_number + '/' + pq.ids.terminal_id, function(){
                pq.jquery_functions.remove_and_update_dropdown(transaction_number);
                $scope.issue_call_number = null;
                $scope.isCalling = false;
                $scope.updateBroadcast();
            },null, function(){
                checkEmailAndAdd($scope.called_numbers[0].email, transaction_number);
            });
        };

        $scope.serveNumber = function(transaction_number, callback){
            $scope.isProcessing = true;
            getResponseResetValues(pq.urls.process_queue.serve_number_url + transaction_number, function(){
                pq.jquery_functions.remove_from_called(transaction_number);
                if(typeof callback === 'function') callback();
                $scope.updateBroadcast();
            }, null, function(){
                $scope.isProcessing = false;
            });
            angular.forEach($scope.temp_called_numbers, function(temp,i){
                if(temp.tran_number == transaction_number){
                    if( temp.email_checker == true){
                        temp.rating = (temp.rating ? temp.rating : 3) ;
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
                $scope.updateBroadcast();
            }, null, function(){
                $scope.isProcessing = false;
            });
            angular.forEach($scope.temp_called_numbers, function(temp,i){
                if(temp.tran_number == transaction_number){
                    if( temp.email_checker == true){
                        $http.get(pq.urls.rating.ratings_url + 0 + "/" + temp.email + "/" + temp.terminal_id + '/' + 3)
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
                $scope.issueOrCall();
            });
        };

        $scope.stopProcessQueue = function(){
            if($scope.called_numbers.length > 0){
                $scope.serveNumber($scope.called_numbers[0].transaction_number, function(){
                    $scope.stopProcessQueue();
                });
            }
            else {
                $scope.clearBroadcastNumbers();
            }
        };

        $scope.clearBroadcastNumbers = function() {
            $http.post('/broadcast/clear-numbers', {
                business_id : pq.ids.business_id
            }).success(function(response) {
                if (response.status) {
                    $scope.sendWebsocket();
                }
            });
        };

        $scope.issueAndCall = function(priority_number){
            $http.post(pq.urls.issue_numbers.issue_specific_url + pq.ids.service_id + '/' + pq.ids.terminal_id, {priority_number : priority_number})
                .success(function(response){
                    $scope.callNumber(response.number.transaction_number);
                }).finally(function(){
                    $scope.isCalling = false;
                });
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

        $scope.sendWebsocket = function(){
            websocket.send(JSON.stringify({
                business_id : pq.ids.business_id,
                broadcast_update : true,
              broadcast_reload: false
            }));
        }

        $scope.updateBroadcast = function(){
            getResponseResetValues('/processqueue/update-broadcast/' + pq.ids.business_id, function(){
                $scope.sendWebsocket();
            });
        }

        checkTextfieldErrors = function(priority_number){
            return angular.element(document.querySelector('#moreq')).scope().checkIssueSpecificErrors(priority_number, $scope.number_limit, false);
        }

        //non scope functions
        getResponseResetValues = function(url, successFunc, errorFunc, finallyFunc){
            $http.get(url, {ignoreLoadingBar: true})
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
                    pq.jquery_functions.select_number(
                        $scope.timebound_numbers[0].transaction_number,
                        $scope.timebound_numbers[0].priority_number,
                        $scope.timebound_numbers[0].name,
                        $scope.timebound_numbers[0].email,
                        $scope.timebound_numbers[0].phone
                    );
                }else if($scope.uncalled_numbers.length > 0){
                    pq.jquery_functions.select_number(
                        $scope.uncalled_numbers[0].transaction_number,
                        $scope.uncalled_numbers[0].priority_number,
                        $scope.uncalled_numbers[0].name,
                        $scope.uncalled_numbers[0].email,
                        $scope.uncalled_numbers[0].phone
                    );
                }
            }else if(is_uncalled.length == 0 && is_timebound.length == 0){
                pq.jquery_functions.remove_and_update_dropdown();
            }else if($scope.timebound_numbers.length > 0 && is_timebound.length == 0){
                pq.jquery_functions.select_number(
                    $scope.timebound_numbers[0].transaction_number,
                    $scope.timebound_numbers[0].priority_number,
                    $scope.timebound_numbers[0].name,
                    $scope.timebound_numbers[0].email,
                    $scope.timebound_numbers[0].phone
                );
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

        $scope.getAllowedBusinesses = function(){
            $http.get('/business/allowed-businesses/' + pq.ids.business_id).success(function(response){
                if(response.allowed_businesses && response.allowed_businesses.length != 0 ){
                    var businesses = response.allowed_businesses;
                    for(var index in businesses){
                        $('#allowed-businesses').append('<option value="' + businesses[index].service_id +'">' + businesses[index].name + ' - ' + businesses[index].service_name + '</option>');
                    }
                }else{
                    $('#allowed-businesses-area').remove();
                }
            });
        }


        $scope.issueToOther = function(service_id, transaction_number){
            var forwarder_id = pq.ids.business_id;
            data = {
                service_id : service_id, //the service to forward to
                forwarder_id : forwarder_id, //your business
                transaction_number: transaction_number
            };

            $scope.serveNumber(transaction_number, function(){
                $http.post('/issuenumber/issue-other/', data).success(function(){
                    $('#priority-number-modal').modal('hide');
                    websocket.send(JSON.stringify({
                        business_id : business_id,
                        broadcast_update : true,
                      broadcast_reload: false
                    }));
                });
            });
        }

        //****************************** refreshing
            $scope.getAllNumbers();
            $scope.getAllowedBusinesses();

        websocket.onerror	= function(response){
          $('#WebsocketLoaderModal').modal('show');
        };
        websocket.onclose = function(response){
          $('#WebsocketLoaderModal').modal('show');
        };

        setInterval(function () {
            $scope.sendWebsocket();
        }, 600000);
    });

})();


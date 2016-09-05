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
        var current_date = new Date();
        var day = current_date.getDate() < 10 ? '0' + current_date.getDate() : current_date.getDate();
        var month = (current_date.getMonth() + 1) < 10 ? '0' + (current_date.getMonth() + 1) : (current_date.getMonth() + 1);
        var year = current_date.getFullYear();

        $scope.today = month + '-' + day + '-' + year;
        $scope.date = $scope.today;
        $scope.dateString = pq.jquery_functions.converDateToString($scope.date);
        $scope.terminal_id = pq.ids.terminal_id;
        $scope.called_numbers = [];
        $scope.uncalled_numbers = [];
        $scope.processed_numbers = [];
        $scope.timebound_numbers = [];

        $scope.called_number = 0;
        $scope.next_number = 0;
        $scope.number_limit = null;
        $scope.issue_call_number = null;

        $scope.called_numbers_rating = [];

        $scope.progress_current = 0;
        $scope.progress_max = 0;
        $scope.stop_progress = 0;
        //open a web socket connection
        websocket = new ReconnectingWebSocket(websocket_url);
        websocket.onopen = function(response) { // connection is open
            $('#WebsocketLoaderModal').modal('hide');
            $scope.updateBroadcast();
        };
        websocket.onmessage = function(response){
            $scope.getAllNumbers();
        };

        $scope.getAllNumbers = function(){
            url = pq.urls.process_queue.all_numbers_url + pq.ids.service_id + '/' + pq.ids.terminal_id + '/' + $scope.date;
            setTimeout(function(){
                $scope.isCalling = true;
            });
            getResponseResetValues(url, null, null, function(){
                pq.jquery_functions.select_next_number();
                $scope.isCalling = ($scope.date != $scope.today && ($scope.timebound_numbers.length + $scope.uncalled_numbers.length == 0));
            });
        };

        $scope.checkIn = function(transaction_number){
            if(confirm('Are you sure you want to check in this number?')){
                transaction_number = transaction_number != undefined ? transaction_number : angular.element(document.querySelector('#selected-tnumber')).val();
                getResponseResetValues('/processqueue/checkin-transaction/' + transaction_number, function(){
                    $scope.issue_call_number = null;
                    $scope.isCalling = false;
                    $scope.updateBroadcast();
                });
            }
        };

        $scope.callNumber = function(transaction_number, callback){
            $scope.called_numbers_rating = [];
            $scope.isCalling = true;
            transaction_number = transaction_number != undefined ? transaction_number : angular.element(document.querySelector('#selected-tnumber')).val();

            getResponseResetValues(pq.urls.process_queue.call_number_url + transaction_number + '/' + pq.ids.terminal_id, function(){
                pq.jquery_functions.remove_and_update_dropdown(transaction_number);
                $scope.issue_call_number = null;
                $scope.isCalling = false;
                $scope.updateBroadcast();
                if(typeof callback === 'function') callback();
            });
        };

        $scope.serveNumber = function(transaction_number, callback){
            var i = getIndex(transaction_number);
            if($scope.called_numbers[i].verified_email != undefined && $scope.called_numbers[i].verified_email){
                if($scope.called_numbers_rating[i] == undefined){
                    var rating = 3;
                }else{
                    var rating = $scope.called_numbers_rating[i];
                }
                $http.get('/rating/userratings/'+rating+'/'+$scope.called_numbers[i].email+'/'+$scope.terminal_id +'/'+2+'/'+transaction_number);
            }

            $scope.isProcessing = true;
            getResponseResetValues(pq.urls.process_queue.serve_number_url + transaction_number, function(){
                pq.jquery_functions.remove_from_called(transaction_number);
                if(typeof callback === 'function') callback();
                $scope.updateBroadcast();
            }, null, function(){
                $scope.isProcessing = false;
            });
        };

        $scope.dropNumber = function(transaction_number){
            var i = getIndex(transaction_number);
            if($scope.called_numbers[i].verified_email){
                if($scope.called_numbers_rating[i] == undefined){
                    var rating = 0;
                }else{
                    var rating = $scope.called_numbers_rating[i];
                }
                $http.get('/rating/userratings/'+rating+'/'+$scope.called_numbers[i].email+'/'+$scope.terminal_id +'/'+3+'/'+transaction_number);
            }

            $scope.isProcessing = true;
            getResponseResetValues(pq.urls.process_queue.drop_number_url + transaction_number, function(){
                pq.jquery_functions.remove_from_called(transaction_number);
                $scope.updateBroadcast();
            }, null, function(){
                $scope.isProcessing = false;
            });
        };

        $scope.serveAndCallNext = function(transaction_number){
            $scope.serveNumber(transaction_number, function(){
                $scope.issue_call_number = null;
                $scope.issueOrCall();
            });
        };

        $scope.stopProcessQueue = function(){
            $scope.isStopping = true;
            $scope.isCalling = true;
            $scope.progress_max = $scope.progress_max > 0 ? $scope.progress_max : $scope.called_numbers.length;
            $scope.progress_current = $scope.progress_max - $scope.called_numbers.length;
            $scope.stop_progress = ($scope.progress_current / $scope.progress_max) * 100;
            if($scope.called_numbers.length > 0){
                $scope.serveNumber($scope.called_numbers[0].transaction_number, function(){
                    $scope.stopProcessQueue();
                });
            }
            else {
                setTimeout(function(){
                    $scope.isStopping = false;
                    $scope.isCalling = false;
                    $scope.progress_current = 0;
                    $scope.progress_max = 0;
                    $scope.stop_progress = 0;
                    $scope.clearBroadcastNumbers();
                }, 1000);

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
        };

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
        };

        $scope.moveToday = function(transaction_number){
            if($scope.timebound_numbers.length > 0 || $scope.uncalled_numbers.length > 0) {
                var transaction_number = transaction_number != undefined ? transaction_number : angular.element(document.querySelector('#selected-tnumber')).val();
                var data = {
                    priority_number: null,
                    name: null,
                    phone: null,
                    email: null
                };

                for(i=0; i < $scope.timebound_numbers.length; i++){
                    if($scope.timebound_numbers[i].transaction_number == transaction_number){
                        data.name = $scope.timebound_numbers[i].name;
                        data.phone = $scope.timebound_numbers[i].phone;
                        data.email = $scope.timebound_numbers[i].email;
                        break;
                    }
                }

                for(i=0; i < $scope.uncalled_numbers.length; i++){
                    if($scope.uncalled_numbers[i].transaction_number == transaction_number){
                        data.name = $scope.uncalled_numbers[i].name;
                        data.phone = $scope.uncalled_numbers[i].phone;
                        data.email = $scope.uncalled_numbers[i].email;
                        break;
                    }
                }

                $http.post(pq.urls.issue_numbers.issue_specific_url + pq.ids.service_id + '/' + pq.ids.terminal_id, data)
                    .success(function(response) {
                        $scope.updateBroadcast();
                        $scope.date = $scope.today;
                        $scope.getAllNumbers();
                    });
            }
        };

        $scope.sendWebsocket = function(){
            websocket.send(JSON.stringify({
                business_id : pq.ids.business_id,
                broadcast_update : true,
                broadcast_reload: false
            }));
        };

        $scope.updateBroadcast = function(){
            getResponseResetValues('/processqueue/update-broadcast/' + pq.ids.business_id, function(){
                $scope.sendWebsocket();
            });
        };

        checkTextfieldErrors = function(priority_number){
            return angular.element(document.querySelector('#moreq')).scope().checkIssueSpecificErrors(priority_number, $scope.number_limit, false);
        };

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

            $scope.dateString = pq.jquery_functions.converDateToString($scope.date);
            pq.jquery_functions.set_next_number_placeholder($scope.next_number);
        };

        select_next_number = function(){
            next_number = angular.element(document.querySelector('#selected-tnumber')).val();
            is_uncalled = pq.jquery_functions.find_in_numbers_array(next_number, $scope.uncalled_numbers);
            is_timebound = pq.jquery_functions.find_in_numbers_array(next_number, $scope.timebound_numbers);

            if($scope.timebound_numbers.length == 0 && $scope.uncalled_numbers.length == 0){
                pq.jquery_functions.remove_and_update_dropdown(next_number);
            }else if(next_number == 0){
                if($scope.timebound_numbers.length > 0){
                    pq.jquery_functions.select_number(
                        $scope.timebound_numbers[0].transaction_number,
                        $scope.timebound_numbers[0].priority_number,
                        $scope.timebound_numbers[0].name,
                        $scope.timebound_numbers[0].email,
                        $scope.timebound_numbers[0].phone,
                        $scope.timebound_numbers[0].form_records,
                        $scope.timebound_numbers[0].queue_platform,
                        $scope.timebound_numbers[0].checked_in
                    );
                }else if($scope.uncalled_numbers.length > 0){
                    pq.jquery_functions.select_number(
                        $scope.uncalled_numbers[0].transaction_number,
                        $scope.uncalled_numbers[0].priority_number,
                        $scope.uncalled_numbers[0].name,
                        $scope.uncalled_numbers[0].email,
                        $scope.uncalled_numbers[0].phone,
                        $scope.uncalled_numbers[0].form_records,
                        $scope.uncalled_numbers[0].queue_platform,
                        $scope.uncalled_numbers[0].checked_in
                    );
                }
            }else if(is_uncalled.length == 0 && is_timebound.length == 0){
                pq.jquery_functions.remove_and_update_dropdown(next_number);
            }else if($scope.timebound_numbers.length > 0 && is_timebound.length == 0){
                pq.jquery_functions.select_number(
                    $scope.timebound_numbers[0].transaction_number,
                    $scope.timebound_numbers[0].priority_number,
                    $scope.timebound_numbers[0].name,
                    $scope.timebound_numbers[0].email,
                    $scope.timebound_numbers[0].phone,
                    $scope.timebound_numbers[0].form_records,
                    $scope.timebound_numbers[0].queue_platform,
                    $scope.timebound_numbers[0].checked_in
                );
            }
        };

        getIndex = function(transaction_number){
            for(var i = 0;  i < $scope.called_numbers.length; i++) {
                if ($scope.called_numbers[i].transaction_number == transaction_number) {
                    return i;
                    break;
                }
            }

        };

        $scope.getAllowedBusinesses = function(){
            $('#allowed-businesses option').remove();
            $('#allowed-businesses-area').hide();
            $http.get('/business/allowed-businesses/' + pq.ids.business_id).success(function(response){
                if(response.allowed_businesses && response.allowed_businesses.length != 0 ){
                    $scope.allowed_businesses = response.allowed_businesses;
                    for(var index in $scope.allowed_businesses){
                        if($scope.allowed_businesses[index].service_id != pq.ids.service_id){
                            $('#allowed-businesses').append('<option value="' + $scope.allowed_businesses[index].service_id +'">' + $scope.allowed_businesses[index].name + ' - ' + $scope.allowed_businesses[index].service_name + '</option>');
                            $('#allowed-businesses-area').show();
                        }
                    }
                }else{
                    $('#allowed-businesses option').remove();
                    $('#allowed-businesses-area').hide();
                }
            });
        };


        $scope.issueToOther = function(service_id, transaction_number){
            var forwarder_id = pq.ids.business_id;
            data = {
                service_id : service_id, //the service to forward to
                forwarder_id : forwarder_id, //your business
                transaction_number: transaction_number
            };

            $('#forward-btn')
                .append(' <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>')
                .attr('disabled', 'disabled');
            $scope.serveNumber(transaction_number, function(){
                $http.post('/issuenumber/issue-other/', data).success(function(response){
                    $('#priority-number-modal-close').show();
                    $('#allowed-businesses').attr('disabled', 'disabled');
                    $('#forward-btn span').remove();
                    $('#forward-btn')
                        .removeAttr('disabled')
                        .hide();
                    $('#forward-success')
                        .html('<p class="forward-num">Forward successful. The priority number given is </p><h2>' + response.number.priority_number + '</h2>')
                        .show();
                    var business_id = response.business_id;
                    websocket.send(JSON.stringify({
                        business_id : business_id,
                        broadcast_update : true,
                        broadcast_reload: false
                    }));
                });
            });
        };

        //****************************** refreshing
        $scope.getAllNumbers();
        $scope.getAllowedBusinesses();

        websocket.onerror	= function(response){
            $('#WebsocketLoaderModal').modal('show');
        };
        websocket.onclose = function(response){
            $('#WebsocketLoaderModal').modal('show');
        };
        window.onbeforeunload = function(e) {
            websocket.close();
        };

        setInterval(function () {
            $scope.sendWebsocket();
        }, 600000);
    });

})();


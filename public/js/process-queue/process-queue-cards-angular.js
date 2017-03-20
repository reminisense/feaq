/**
 * Created by USER on 4/4/2016.
 */

//angularjs implementation
(function() {
    app.requires.push('ngSanitize');
    app.requires.push('angular-loading-bar'); //add angular loading bar
    app.config(['cfpLoadingBarProvider', function (cfpLoadingBarProvider) {
        cfpLoadingBarProvider.includeSpinner = false;
    }]);

    app.controller('processqueueController', function($scope, $http) {
        var current_date = new Date();
        var day = current_date.getDate() < 10 ? '0' + current_date.getDate() : current_date.getDate();
        var month = (current_date.getMonth() + 1) < 10 ? '0' + (current_date.getMonth() + 1) : (current_date.getMonth() + 1);
        var year = current_date.getFullYear();

        $scope.today = month + '-' + day + '-' + year;
        $scope.date = $scope.today;
        $scope.dateString = pq.jquery_functions.converDateToString($scope.date);
        $scope.terminal_id = pq.ids.terminal_id;
        $scope.unprocessed_numbers = [];
        $scope.uncalled_numbers = [];
        $scope.called_numbers = [];
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
        }
        websocket.onmessage = function(response){
            $scope.getAllNumbers();
        }

        $scope.getAllNumbers = function(){
            url = pq.urls.process_queue.all_numbers_url + pq.ids.service_id + '/' + pq.ids.terminal_id + '/' + $scope.date;
            setTimeout(function(){
                $scope.isCalling = true;
            });
            getResponseResetValues(url, null, null, function(){
                if($scope.date != $scope.today && ($scope.timebound_numbers.length + $scope.uncalled_numbers.length == 0)){
                    $scope.isCalling = true;
                }else{
                    $scope.isCalling = false;
                }
            });
        };

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
                });
        };

        resetValues = function(numbers){
            $scope.unprocessed_numbers = numbers.unprocessed_numbers;
            $scope.uncalled_numbers = numbers.uncalled_numbers;
            $scope.called_numbers = numbers.called_numbers;
            $scope.processed_numbers = numbers.processed_numbers;
            $scope.timebound_numbers = numbers.timebound_numbers;
            $scope.next_number = numbers.next_number;
            $scope.number_limit = numbers.number_limit;

            $scope.dateString = pq.jquery_functions.converDateToString($scope.date);
        };

        $scope.updateBroadcast = function(){
            getResponseResetValues('/processqueue/update-broadcast/' + pq.ids.business_id, function(){
                $scope.sendWebsocket();
            });
        }

        $scope.sendWebsocket = function(){
            websocket.send(JSON.stringify({
                business_id : pq.ids.business_id,
                broadcast_update : true,
                broadcast_reload: false
            }));
        }

        $scope.callNumber = function(transaction_number, callback){
            $scope.called_numbers_rating = [];
            $scope.isCalling = true;
            transaction_number = transaction_number != undefined ? transaction_number : angular.element(document.querySelector('#selected-tnumber')).val();

            getResponseResetValues(pq.urls.process_queue.call_number_url + transaction_number + '/' + pq.ids.terminal_id, function(){
                $scope.issue_call_number = null;
                $scope.isCalling = false;
                $scope.updateBroadcast();
                if(typeof callback === 'function') callback();
            });
        };

        $scope.serveNumber = function(transaction_number, callback){
            var i = getIndex(transaction_number);
            if($scope.unprocessed_numbers[i].verified_email != undefined && $scope.unprocessed_numbers[i].verified_email){
                if($scope.called_numbers_rating[i] == undefined){
                    var rating = 3;
                }else{
                    var rating = $scope.called_numbers_rating[i];
                }
                $http.get('/rating/userratings/'+rating+'/'+$scope.unprocessed_numbers[i].email+'/'+$scope.terminal_id +'/'+2+'/'+transaction_number);
            }

            $scope.isProcessing = true;
            getResponseResetValues(pq.urls.process_queue.serve_number_url + transaction_number, function(){
                if(typeof callback === 'function') callback();
                $scope.updateBroadcast();
            }, null, function(){
                $scope.isProcessing = false;
            });
        };

        $scope.dropNumber = function(transaction_number){
            var i = getIndex(transaction_number);
            if($scope.unprocessed_numbers[i].verified_email){
                if($scope.called_numbers_rating[i] == undefined){
                    var rating = 0;
                }else{
                    var rating = $scope.called_numbers_rating[i];
                }
                $http.get('/rating/userratings/'+rating+'/'+$scope.unprocessed_numbers[i].email+'/'+$scope.terminal_id +'/'+3+'/'+transaction_number);
            }

            $scope.isProcessing = true;
            getResponseResetValues(pq.urls.process_queue.drop_number_url + transaction_number + '/' + $scope.terminal_id, function(){
                $scope.updateBroadcast();
            }, null, function(){
                $scope.isProcessing = false;
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

        getIndex = function(transaction_number){
            for(var i = 0;  i < $scope.unprocessed_numbers.length; i++) {
                if ($scope.unprocessed_numbers[i].transaction_number == transaction_number) {
                    return i;
                    break;
                }
            }

        }

        $scope.clearBroadcastNumbers = function() {
            $http.post('/broadcast/clear-numbers', {
                business_id : pq.ids.business_id
            }).success(function(response) {
                if (response.status) {
                    $scope.sendWebsocket();
                }
            });
        };

        $scope.getAllowedBusinesses = function(){
            $http.get('/business/allowed-businesses/' + pq.ids.business_id).success(function(response){
                if(response.allowed_businesses && response.allowed_businesses.length != 0 ){
                    $scope.allowed_businesses = response.allowed_businesses;
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

            $('#forward-btn').append(' <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>');
            $('#forward-btn').attr('disabled', 'disabled');
            $scope.serveNumber(transaction_number, function(){
                $http.post('/issuenumber/issue-other', data).success(function(response){
                    $('#priority-number-modal-close').show();
                    $('#allowed-businesses').attr('disabled', 'disabled');
                    $('#forward-btn span').remove();
                    $('#forward-btn').removeAttr('disabled');
                    $('#forward-btn').hide();
                    $('#forward-success').show();
                    $('#forward-success').html('<p class="forward-num">Forward successful. The priority number given is </p><h2>' + response.number.priority_number + '</h2>');
                    var business_id = response.business_id;
                    websocket.send(JSON.stringify({
                        business_id : business_id,
                        broadcast_update : true,
                        broadcast_reload: false
                    }));
                });
            });
        };

        $scope.getAllNumbers();
        $scope.getAllowedBusinesses();
    });
})();
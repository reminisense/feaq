/**
 * Created by USER on 2/2/15.
 */
//angularjs implementation
(function(){
    var app = angular.module('FeatherQ', []);
    app.controller('processqueueController', function($scope, $http){
        $scope.terminal_id = pq.ids.terminal_id;
        $scope.called_numbers = [];
        $scope.uncalled_numbers = [];
        $scope.processed_numbers = [];

        $scope.getAllNumbers = function(){
            getResponseResetValues(pq.urls.process_queue.all_numbers_url + pq.ids.service_id);
        };

        $scope.callNumber = function(){
            transaction_number = angular.element(document.querySelector('#selected-tnumber')).val();
            getResponseResetValues(pq.urls.process_queue.call_number_url + transaction_number + '/' + pq.ids.terminal_id, function(){
                pq.jquery_functions.remove_and_update_dropdown(transaction_number);
            });
        };

        $scope.serveNumber = function(transaction_number, callback){
            getResponseResetValues(pq.urls.process_queue.serve_number_url + transaction_number, callback);
        };

        $scope.dropNumber = function(transaction_number){
            getResponseResetValues(pq.urls.process_queue.drop_number_url + transaction_number);
        };

        $scope.serveAndCallNext = function(transaction_number){
            $scope.serveNumber(transaction_number, function(){
                $scope.callNumber();
            });
        };

        //non scope functions
        getResponseResetValues = function(url, successFunc, errorFunc){
            $http.get(url)
                .success(function(response){
                    if(response.numbers) resetValues(response.numbers);
                    if(typeof successFunc === 'function') successFunc();
                })
                .error(function(){
                    if(typeof errorFunc === 'function') errorFunc();
                });
        };

        resetValues = function(numbers){
            $scope.called_numbers = numbers.called_numbers;
            $scope.uncalled_numbers = numbers.uncalled_numbers;
            $scope.processed_numbers = numbers.processed_numbers;

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
    app.controller('issuenumberController', function($scope, $http){
        $scope.issueMultiple = function(range, date){
            url = pq.urls.issue_numbers.issue_multiple_url + pq.ids.service_id + '/' + range;
            url = date == undefined ? url : url + '/' + date;
            $http.get( url )
                .success(function(response){
                    message = 'Issue number successful! <br> First number : ' + response.first_number + ' <br> Last number : ' + response.last_number;
                    pq.jquery_functions.issue_number_success(message);
                });
        };

        $scope.issueSpecific = function(priority_number, name, phone, email){
            data = {
                priority_number : priority_number,
                name : name,
                phone : phone,
                email : email
            };
            $http.post(pq.urls.issue_numbers.issue_specific_url + pq.ids.service_id, data)
                .success(function(response){
                    message = 'Issue number successful! <br> Number : ' + response.number.priority_number;
                    pq.jquery_functions.issue_number_success(message);
                });
        }
    });


    //@todo transfer later
    app.controller('queuesettingsController', function($scope, $http){
        $scope.number_start = 1;
        $scope.number_limit = 99;
        $scope.auto_issue = 0;
        $scope.allow_sms = 0;
        $scope.allow_remote = 0;
        //$scope.remote_limit = 0;
        //$scope.repeat_issue = 0;

        $scope.getQueueSettings = function(){
            $http.get(pq.urls.queue_settings.queue_settings_get_url + pq.ids.service_id)
                .success(function(response){
                    $scope.number_start = response.queue_settings.number_start;
                    $scope.number_limit = response.queue_settings.number_limit;

                    $scope.auto_issue = response.queue_settings.auto_issue ? true : false;
                    $scope.allow_sms = response.queue_settings.allow_sms ? true : false;
                    $scope.allow_remote = response.queue_settings.allow_remote ? true : false;
                });
        };

        $scope.updateNumberStart = function(number_start){
            updateQueueSetting('number_start', number_start);
        };

        $scope.updateNumberLimit = function(number_limit){
            updateQueueSetting('number_limit', number_limit);
        };

        $scope.updateAutoIssue = function(auto_issue){
            auto_issue = auto_issue ? 1 : 0;
            updateQueueSetting('auto_issue', auto_issue);
        };

        $scope.updateAllowSms = function(allow_sms){
            allow_sms = allow_sms ? 1 : 0;
            updateQueueSetting('allow_sms', allow_sms);
        };

        $scope.updateAllowRemote = function(allow_remote){
            allow_remote = allow_remote ? 1 : 0;
            updateQueueSetting('allow_remote', allow_remote);
        };


        updateQueueSetting = function(field, value){
            data = {
                field : field,
                value : value
            }
            $http.post(pq.urls.queue_settings.queue_settings_update_url + pq.ids.service_id, data)
                .success(function(response){
                    //@todo update queue settings success function
                });
        };

        /*================================*/
        $scope.getQueueSettings();
    });
})();


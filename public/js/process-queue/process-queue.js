/**
 * Created by USER on 1/26/15.
 */
    //global variables
    var ids = {
        service_id : angular.element(document.querySelector('#service-id')).val(),
        terminal_id : angular.element(document.querySelector('#terminal-id')).val()
    };


    var urls = {
        process_queue : {
            all_numbers_url : angular.element(document.querySelector('#all-numbers-url')).val() + '/',
            call_number_url : angular.element(document.querySelector('#call-number-url')).val() + '/',
            serve_number_url : angular.element(document.querySelector('#serve-number-url')).val() + '/',
            drop_number_url : angular.element(document.querySelector('#drop-number-url')).val() + '/'
        },

        issue_numbers : {
            issue_numbers_url : angular.element(document.querySelector('#issue-numbers-url')).val() + '/',
            issue_multiple_url : angular.element(document.querySelector('#issue-multiple-url')).val() + '/',
            issue_specific_url : angular.element(document.querySelector('#issue-specific-url')).val() + '/'
        },

        queue_settings : {
            queue_settings_get_url : angular.element(document.querySelector('#queue-settings-get-url')).val() + '/',
            queue_settings_update_url : angular.element(document.querySelector('#queue-settings-update-url')).val() + '/'
        }
    };

    var app = angular.module('processqueue', []);
    app.controller('processqueueController', function($scope, $http){
        $scope.called_numbers = [];
        $scope.uncalled_numbers = [];
        $scope.processed_numbers = [];

        $scope.getAllNumbers = function(){
            getResponseResetValues(urls.process_queue.all_numbers_url + ids.service_id);
        };

        $scope.callNumber = function(transaction_number){
            getResponseResetValues(urls.process_queue.call_number_url + transaction_number + '/' + ids.terminal_id);
        };

        $scope.serveNumber = function(transaction_number){
            getResponseResetValues(urls.process_queue.serve_number_url + transaction_number);
        };

        $scope.dropNumber = function(transaction_number){
            getResponseResetValues(urls.process_queue.drop_number_url + transaction_number);
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
            $http.get(urls.issue_numbers.issue_numbers_url + ids.service_id)
                .success(function(response){
                    //@todo issue number success function
                });
        };

        $scope.issueMultiple = function(range, date){
            url = urls.issue_numbers.issue_multiple_url + ids.service_id + '/' + range;
            url = date == undefined ? url : url + '/' + date;
            $http.get( url )
                .success(function(response){
                    //@todo issue multiple number success function
                });
        };

        $scope.issueSpecific = function(priority_number, name, phone, email){
            data = {
                priority_number : priority_number,
                name : name,
                phone : phone,
                email : email
            };
            $http.post(urls.issue_numbers.issue_specific_url + ids.service_id, data)
                .success(function(response){
                    //@todo issue specific number success function
                });
        }
    });

    app.controller('queuesettingsController', function($scope, $http){
        $scope.number_start = 1;
        $scope.number_limit = 99;
        $scope.auto_issue = 0;
        $scope.allow_sms = 0;
        $scope.allow_remote = 0;
        //$scope.remote_limit = 0;
        //$scope.repeat_issue = 0;

        $scope.getQueueSettings = function(){
            $http.get(urls.queue_settings.queue_settings_get_url + ids.service_id)
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
            $http.post(urls.queue_settings.queue_settings_update_url + ids.service_id, data)
                .success(function(response){
                    //@todo update queue settings success function
                });
        };

        /*================================*/
        $scope.getQueueSettings();
    });
/**
 * Created by USER on 3/17/15.
 */
(function(){
    //Issue numbers
    app.controller('issuenumberController', function($scope, $http){
        $scope.priority_number = null;
        $scope.number_limit = null;
        $scope.queue_platform = 'web';
        $scope.time_assigned = null;
        $scope.name = null;
        $scope.phone = null;
        $scope.email = null;

        $scope.number_start = null;
        $scope.number_end = null;
        $scope.range = null;

        var user_id = $('#user-id').attr('user_id');
        var process_queue = angular.element($("#process-queue-wrapper")).scope();

        $scope.issueMultiple = function(range, number_start, date){
            $scope.isIssuing = true;
            process_queue.isCalling = true;
            url = pq.urls.issue_numbers.issue_multiple_url + pq.ids.service_id + '/' + range + '/' + pq.ids.terminal_id + '/' + number_start;
            url = date == undefined ? url : url + '/' + date;
            $http.get( url )
                .success(function(response){
                    message = 'Issue number successful! <br> First number : ' + response.first_number + ' <br> Last number : ' + response.last_number;
                    pq.jquery_functions.issue_number_success(message);
                    $scope.sendWebsocket();

                    $scope.number_start = '';
                    $scope.number_end = '';
                    $scope.range = null;
                }).finally(function(){
                    $scope.isIssuing = false;
                    process_queue.isCalling = false;
                });
        };

        $scope.issueSpecific = function(priority_number, name, phone, email, time_assigned){
            $scope.isIssuing = true;
            process_queue.isCalling = true;
            url = pq.urls.issue_numbers.issue_specific_url;
            service_id = pq.ids.service_id;
            terminal_id = pq.ids.terminal_id ? pq.ids.terminal_id : 0;
            data = {
                priority_number : priority_number,
                name : name,
                phone : phone,
                email : email,
                time_assigned : time_assigned
            };
            $http.post(url + service_id + '/' + terminal_id + '/' + $scope.queue_platform, data)
                .success(function(response){
                    if(response.number){
                        message = 'Issue number successful! <br> Number : ' + response.number.priority_number;
                        pq.jquery_functions.issue_number_success(message);
                        $scope.sendWebsocket();

                        $scope.priority_number = '';
                        $scope.name = '';
                        $scope.phone = '';
                        $scope.email = '';
                        $scope.time_assigned = '';
                    }else if(response.error){
                        pq.jquery_functions.issue_number_error(response.error);
                    }
                }).finally(function(){
                    $scope.isIssuing = false;
                    process_queue.isCalling = false;
                });
        }

        $scope.checkIssueSpecificErrors = function(priority_number, number_limit, issue){
            time_format = /^([0-9]{2})\:([0-9]{2})([ ][aApP][mM])$/g;
            issue = issue != undefined ? issue : true;
            error = false
            error_message = '';

            //variables
            priority_number = priority_number != null ? priority_number : $scope.priority_number;

            //check priority number
            //if(isNaN(priority_number) || priority_number % 1 != 0){
            //    error = true;
            //    error_message += 'Priority number is invalid. ';
            //}

            if(number_limit != null && (priority_number > number_limit)){
                error = true;
                error_message += 'Priority number is greater than the limit. ';
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

            try{
               if(angular.module('PublicBroadcast')){
                   if($scope.issue_specific_form.name.$error.required){
                       error = true;
                       error_message += 'Your name is required. ';
                   }

                   if($scope.issue_specific_form.phone.$error.required){
                       error = true;
                       error_message += 'Phone number is required. ';
                   }

                   if($scope.issue_specific_form.email.$error.required){
                       error = true;
                       error_message += 'Email address is required. ';
                   }
               }
            }catch(err){}

            if(!error && issue){
                $scope.issue_specific_error = '';
                $scope.issueSpecific($scope.priority_number, $scope.name, $scope.phone, $scope.email, $scope.time_assigned)
            }else{
                $scope.issue_specific_error = error_message;
                setTimeout(function(){ $scope.issue_specific_error = '';}, 3000);
            }
            return error;
        }

        $scope.checkIssueMultipleErrors = function(){
            error = false;
            error_message = '';
            $scope.range = ($scope.number_end - $scope.number_start) + 1;

            //check first number
            if($scope.issue_multiple_form.number_start.$error.required){
                error = true;
                error_message += 'First number is required. ';
            }else if($scope.issue_multiple_form.number_start.$error.number){
                error = true;
                error_message += 'First number must not contain letters or symbols. ';
            }else if($scope.issue_multiple_form.number_start.$viewValue <= 0){
                error = true;
                error_message += 'First number must be greater than zero. ';
            }

            //check last number
            if($scope.issue_multiple_form.number_end.$error.required){
                error = true;
                error_message += 'Last number is required. ';
            }else if($scope.issue_multiple_form.number_end.$error.number){
                error = true;
                error_message += 'Last number must not contain letters or symbols. ';
            }else if($scope.issue_multiple_form.number_end.$viewValue <= 0){
                error = true;
                error_message += 'Last number must be greater than zero. ';
            }else if($scope.issue_multiple_form.number_end.$viewValue > $scope.number_limit){
                error = true;
                error_message += 'Cannot issue numbers greater than ' + $scope.number_limit + '. ';
            }

            //check the range
            if($scope.range <= 0){
                error = true;
                error_message += 'First number must not be greater than the last number. ';
            }else if($scope.range > 100){
                error = true;
                error_message += 'Cannot issue more than 100 numbers at the same time. ';
            }

            if(!error){
                $scope.issue_multiple_error = '';
                $scope.issueMultiple($scope.range, $scope.number_start);
            }else{
                $scope.issue_multiple_error = error_message;
                setTimeout(function(){ $scope.issue_multiple_error = '';}, 3000);
            }
            return error;
        }

        $scope.initializePriorityNumber = function(){
            var broadcast = false;
            try{ if(angular.module('PublicBroadcast'))
                broadcast = true;
                $scope.queue_platform = 'remote';
            }
            catch(err){ broadcast = false; }

            if(broadcast){
                setInterval(function(){
                    scope = angular.element('#nowServingCtrl').scope();
                    $scope.$apply(function(){
                        $scope.get_num = scope.get_num;
                    });
                }, 1000);
            }
        }

        $scope.populateRemoteQueueModal = (function(response){
            if (response.status == '1') {
                $scope.name = response.first_name + ' ' + response.last_name;
                $scope.phone = response.phone;
                $scope.email = response.email;
            }
        });

        $(".datepicker").datepicker();

        $scope.getNumberSubmitForm = function(){

            var date =  $("#date").datepicker({ dateFormat: 'dd,MM,yyyy' }).val();

            var data = {
                number: $scope.get_num,
                name: $scope.name,
                phone: $scope.phone,
                age: $scope.age,
                birthdate: date,
                email: $scope.email,
                gender: $scope.gender,
                height: $scope.height,
                weight: $scope.weight,
                bloodtype: $scope.bloodtype,
                medication: $scope.medication,
                allergies: $scope.allergies
            };

            $http.post('broadcast/convert-form', data).success(function(response){

            })
        };

        $scope.sendWebsocket = function(){
            process_queue.updateBroadcast();
        }

        $http.get('/user/remoteuser/'+user_id).success($scope.populateRemoteQueueModal);
        $scope.initializePriorityNumber();
    });
})();
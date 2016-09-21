/**
 * Created by USER on 3/17/15.
 */
(function(){
    //Issue numbers
    app.controller('issuenumberController', function($scope, $http){
        $scope.number_prefix = '';
        $scope.number_suffix = '';
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

        $scope.def_service_id = pq.ids.service_id;

        $scope.forms = null;
        $scope.filtered_forms = [];

        var biz_id = $('#business-id').attr('business_id');

        var user_id = $('#user-id').attr('user_id');
        var process_queue = angular.element($("#process-queue-wrapper")).scope();

        $scope.issueMultiple = function(range, number_start, date){
            $scope.isIssuing = true;
            if(process_queue){process_queue.isCalling = true;}
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
                    if(process_queue){process_queue.isCalling = false;}
                });
        };

        $scope.issueSpecific = function(priority_number, name, phone, email, time_assigned){
            $scope.isIssuing = true;
            custom_fields = new Array()
            if(process_queue){process_queue.isCalling = true;}
            url = pq.urls.issue_numbers.issue_specific_url;
            service_id = $('#services').val() ? $('#services').val() : pq.ids.service_id;
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

                        if($scope.filtered_forms.length != 0){
                          $scope.saveForms(response.number.transaction_number);
                        }

                        $scope.priority_number = '';
                        $scope.name = '';
                        $scope.phone = '';
                        $scope.email = '';
                        $scope.time_assigned = '';

                        if(!process_queue){
                            $('.btn-getnum').addClass('disabled');
                        }
                        setTimeout(function(){
                            $('#remote-queue-modal').modal('toggle');
                        }, 3000);
                    }else if(response.error){
                        pq.jquery_functions.issue_number_error(response.error);
                    }
                }).finally(function(){
                    $scope.isIssuing = false;
                    if(process_queue){process_queue.isCalling = false;}
                });
        };

        $scope.saveForms = function(transaction_number){


            var service_id = $('#services').val() ? $('#services').val() : pq.ids.service_id;
            var form_submissions = [];

            for(var i=0; i< $scope.filtered_forms.length; i++){
                var form_id = $scope.filtered_forms[i].form_id;
                var form_submit =[];
                var submit_data  = [];
                for(var x=0; x<$scope.filtered_forms[i].fields.length; x++ ){
                    var input = $('#'+form_id+'_'+x).val();
                    if($scope.filtered_forms[i].fields[x].field_type == "checkbox"){
                        input = $('#'+form_id+'_'+x).prop('checked') ? 1 : 0;
                    }else if($scope.filtered_forms[i].fields[x].field_type == "radio"){
                        input = $('input[name="'+form_id+'_'+x+'"]:checked').val();
                    }

                    submit_data.push({
                        xml_tag: $scope.filtered_forms[i].fields[x].field_data.label,
                        xml_val: input
                    })
                }

               form_submit[form_id] = submit_data;
               form_submissions.push(form_submit);
            }

            var data = {
                user_id: user_id,
                transaction_number: transaction_number,
                service_id: service_id,
                form_submissions: form_submissions
            }
            $http.post('/records/save-records', data).success(function(response){

            });
        };

        $scope.checkIssueSpecificErrors = function(priority_number, number_limit, issue){
            time_format = /^([0-9]{2})\:([0-9]{2})([ ][aApP][mM])$/g;
            issue = issue != undefined ? issue : true;
            error = false;
            error_message = '';

            //variables
            priority_number = priority_number != null ? priority_number : $scope.priority_number;

            //check priority number
            //if(isNaN(priority_number) || priority_number % 1 != 0){
            //    error = true;
            //    error_message += 'Priority number is invalid. ';
            //}

            var new_number = $scope.number_prefix + priority_number + $scope.number_suffix;
            for(index in process_queue.unprocessed_numbers){
                if(new_number == process_queue.unprocessed_numbers[index].priority_number){
                    error = true;
                    error_message += 'Priority number is still active. ';
                    break;
                }
            }

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

            if(!error && issue && confirm('Are you sure you want to get this number?')){
                $scope.issue_specific_error = '';
                $scope.issueSpecific($scope.priority_number, $scope.name, $scope.phone, $scope.email, $scope.time_assigned);
            }else{
                $scope.issue_specific_error = error_message;
                setTimeout(function(){ $scope.issue_specific_error = '';}, 3000);
            }
            return error;

        };

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
        };

        $scope.initializePriorityNumber = function(){
            var broadcast = false;
            try{ if(angular.module('PublicBroadcast'))
                broadcast = true;
                $scope.queue_platform = 'remote';
            }
            catch(err){ broadcast = false; }

            if(broadcast){
                setInterval(function(){
                    if($scope.queue_status == 1){
                        scope = angular.element('#nowServingCtrl').scope();
                        $scope.$apply(function(){
                            $scope.get_num = $scope.number_prefix +  scope.get_num + $scope.number_suffix;
                        });
                        $scope.getServiceEstimates($scope.def_service_id);
                    }
                }, 5000);
            }
        };

        $scope.populateRemoteQueueModal = function(response){
            if (response.status == '1') {
                $scope.name = response.first_name + ' ' + response.last_name;
                $scope.phone = response.phone;
                $scope.email = response.email;
                $scope.user_queue = response.user_queue;

                $scope.queue_status = response.queue_status;
                if($scope.user_queue){
                    $scope.get_num = response.user_queue.priority_number;
                }
            }
        };

        $scope.sendWebsocket = function(){
            if(process_queue){
                process_queue.updateBroadcast();
            }else{
                //for remote queue in public broadcast page
                websocket = new WebSocket(websocket_url);
                websocket.onopen = function(response) { // connection is open
                    websocket.send(JSON.stringify({
                        business_id : business_id, //from lib.js
                        broadcast_update : true,
                        broadcast_reload: false
                    }));
                }
            }
        };

        //for new remote queue
        $scope.getBusinessServices = function(){
            if(typeof business_id != 'undefined'){
                $http.get('/services/business/' + business_id).success(function(response){
                    $('#services').empty();
                    business_services = response.business_services;
                    for(branch in business_services){
                        for(service in business_services[branch]){
                            $('#services').append('<option value="' + business_services[branch][service].service_id +'">' + business_services[branch][service].name + '</option>');
                        }
                    }
                });
            }
        };

        $scope.selectService = function(){
            service_id = $('#services').val();
            displayFormFields(service_id);
            $http.get('/processqueue/next-number/' + service_id).success(function(response){
                $('.nomg').html(response.next_number);
                $('#insertq input[name=number]').val(response.next_number);
                setTimeout(function(){
                    $scope.selectService();
                }, 5000);
                if(service_id != $scope.def_service_id){
                    $scope.def_service_id = service_id;
                }
            });
        };

        $scope.checkIn = function(){
            transaction_number = $scope.user_queue.transaction_number;
            $http.get('/processqueue/checkin-transaction/' + transaction_number).success(function(response){
                $scope.sendWebsocket();
                $('.btn-getnum').html('You are checked in');
                $('.btn-getnum').addClass('disabled');
            });
        };

        $scope.getFormFields = function() {
            $http.get('/forms/display-forms/' + biz_id).success(function(response) {
                var forms = response.forms;
                if(forms){
                    $scope.getSuggestedFields(forms);
                }
            });
        };

        $scope.getSuggestedFields = function(forms){
            var data = {
                user_id: user_id,
                forms: forms
            }
            $http.post('/records/suggested-fields', data).success(function(response) {
                $scope.forms = response.forms;

                displayFormFields($scope.def_service_id);
                setTimeout(function(){
                    $('#remote-btn').removeClass('disabled');
                    $('#remote-btn > span').removeClass('glyphicon-refresh glyphicon-refresh-animate');
                    $('#remote-btn > span').addClass('glyphicon-save');
                }, 2000);
            });

        }

        displayFormFields = function(service_id){
            $scope.filtered_forms.length = 0;
            if($scope.forms){
                for (var i = 0; i <  $scope.forms.length; i++){
                    if(service_id == $scope.forms[i].service_id && $scope.forms[i].status == true ){
                        $scope.filtered_forms.push($scope.forms[i]);
                    }
                }
            }
        }

        $scope.getRemoteuser = function(){
            if(!process_queue){
                $http.get('/user/remoteuser/'+user_id).success(function(response){
                    $scope.populateRemoteQueueModal(response);
                    setTimeout(function(){
                        $scope.getRemoteuser();
                    }, 5000);
                });
            }
        };

        $scope.getServiceEstimates = function(service_id){
            $http.get('/mobile/service-estimates/' + service_id).success(function(response){
                $scope.estimates = response;
            });
        };

        $scope.getFormFields();
        $scope.getBusinessServices();
        $scope.initializePriorityNumber();
        $scope.getRemoteuser();
    });
})();
/**
 * Created by USER on 3/17/15.
 */
(function(){
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
            url = pq.urls.issue_numbers.issue_multiple_url + pq.ids.service_id + '/' + range + '/' + pq.ids.terminal_id;
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

            try{
               if(angular.module('Broadcast')){
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

        $scope.initializePriorityNumber = function(){
            var broadcast = false;
            try{ if(angular.module('Broadcast')) broadcast = true; }
            catch(err){ broadcast = false; }

            if(broadcast){
                setInterval(function(){
                    $scope.get_num = angular.element('#get_num').html();
                }, 1000)
            }
        }

        $scope.initializePriorityNumber();

    });
})();
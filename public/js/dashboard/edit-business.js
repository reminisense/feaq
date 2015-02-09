/**
 * Created by USER on 2/3/15.
 */
$(document).ready(function(){
    $('.edit-business-cog').on('click', function(){
        eb.jquery_functions.setBusinessId($(this).attr('data-business-id'));
    });

    $('#editBusiness').on('show.bs.modal', function(){
        eb.jquery_functions.getBusinessDetails();
    });

    $('body').on('click', '#btn-addterminal',function () {
        $('#inputterminal').show();
        $('#btn-addterminal').hide();
    });

    $('body').on('click', '.btn-adduser', function(e){
        e.preventDefault();
        $(this).next('.inputuser').show();
        $(this).next('.inputuser').next('ul').show();
        $(this).hide();
    });

    eb.jquery_functions.load_users();
});

var eb = {
    urls : {
        business: {
            business_details_url : $('#business-details-url').val() + '/'
        },

        queue_settings : {
            queue_settings_get_url : $('#queue-settings-get-url').val() + '/',
            queue_settings_update_url : $('#queue-settings-update-url').val() + '/'
        }
    },

    jquery_functions : {
        getBusinessDetails : function(){
            var scope = angular.element($("#editBusiness")).scope();
            scope.$apply(function(){
                scope.getBusinessDetails();
            });
        },

        setBusinessId : function(business_id){
            var scope = angular.element($("#editBusiness")).scope();
            scope.$apply(function(){
                scope.business_id = business_id;
            });
        },

        load_users : function(){
            var scope = angular.element($("#editBusiness")).scope();
            scope.$apply(function(){
                scope.getUsers();
            });
        },

        hide_add_terminal_form : function(){
            $('#inputterminal').hide();
            $('#btn-addterminal').show();
        }

    }
};


(function(){
    app.controller('editBusinessController', function($scope, $http){
        $scope.business_id = null;
        $scope.business_name = null;
        $scope.business_address = null;
        $scope.facebook_url = null;
        $scope.industry = null;
        $scope.time_open = null;
        $scope.time_closed = null;
        $scope.queue_limit = null; /* RDH Added queue_limit to Edit Business Page */

        $scope.terminals = [];
        $scope.users = [];

        $scope.number_start = 1;
        $scope.number_limit = 99;
        $scope.auto_issue = 0;
        $scope.allow_sms = 0;
        $scope.allow_remote = 0;
        //$scope.remote_limit = 0;
        //$scope.repeat_issue = 0;

        $scope.getUsers = function(){
            $http.get('/user/userlist')
                .success(function(response){
                    $scope.users = response.users;
                });
        }

        $scope.getBusinessDetails = function(){
            $http.get(eb.urls.business.business_details_url + $scope.business_id)
                .success(function(response){
                    setBusinessFields(response.business);
                });
        }

        setBusinessFields = function(business){
            $scope.business_id = business.business_id;
            $scope.business_name = business.business_name;
            $scope.business_address = business.business_address;
            $scope.facebook_url = business.facebook_url;
            $scope.industry = business.industry;
            $scope.time_open = business.time_open;
            $scope.time_closed = business.time_closed;
            $scope.queue_limit = business.queue_limit; /* RDH Added queue_limit to Edit Business Page */

            $scope.terminals = business.terminals;

        }

        $scope.unassignFromTerminal = function(user_id, terminal_id){
            $http.get('terminal/unassign/' + user_id + '/' + terminal_id)
                .success(function(response){
                    setBusinessFields(response.business);
                });
        }

        $scope.assignToTerminal = function(user_id, terminal_id){
            $http.get('terminal/assign/' + user_id + '/' + terminal_id)
                .success(function(response){
                    setBusinessFields(response.business);
                });
        }

        $scope.deleteTerminal = function(terminal_id){
            $http.get('terminal/delete/' + terminal_id)
                .success(function(response){
                    setBusinessFields(response.business);
                });
        }

        $scope.createTerminal = function(terminal_name){
            data = { name : terminal_name };
            $http.post('terminal/create/' + $scope.business_id, data)
                .success(function(response){
                    setBusinessFields(response.business);
                    $scope.terminal_name = '';
                    eb.jquery_functions.hide_add_terminal_form();
                });
        }

        /*
         * @author: CSD
         * @description: post edit business form
         */
        $scope.saveBusinessDetails = function(business){
            var data = {
                business_id : $scope.business_id,
                business_name: $scope.business_name,
                business_address: $scope.business_address,
                facebook_url: $scope.facebook_url,
                industry: $scope.industry,
                time_open: $scope.time_open,
                time_close: $scope.time_closed,
                queue_limit: $scope.queue_limit /* RDH Added queue_limit to Edit Business Page */
            }
            console.log(data);
            $http.post('/business/edit-business', data)
                .success(function(response){
                    setBusinessFields(response.business);
                });
        }




        /*****************unya na ni********************/

        $scope.getQueueSettings = function(){
//            $http.get(eb.urls.queue_settings.queue_settings_get_url + eb.ids.service_id)
//                .success(function(response){
//                    $scope.number_start = response.queue_settings.number_start;
//                    $scope.number_limit = response.queue_settings.number_limit;
//
//                    $scope.auto_issue = response.queue_settings.auto_issue ? true : false;
//                    $scope.allow_sms = response.queue_settings.allow_sms ? true : false;
//                    $scope.allow_remote = response.queue_settings.allow_remote ? true : false;
//                });
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
            console.log('update');
//            data = {
//                field : field,
//                value : value
//            }
//            $http.post()
//                .success(function(response){
//                    //@todo update queue settings success function
//                });
        };


        /*================================*/
        $scope.getQueueSettings();
    });
})();
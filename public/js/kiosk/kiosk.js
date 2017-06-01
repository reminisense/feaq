/**
 * Created by Polljii143 on 3/17/17.
 */

(function ()
{

    //app.requires.push('ngSanitize');
    //app.requires.push('angular-loading-bar'); //add angular loading bar
    //app.config(['cfpLoadingBarProvider', function (cfpLoadingBarProvider) {
    //  cfpLoadingBarProvider.includeSpinner = false;
    //}]);

    app.controller('kioskController', function ($scope, $http)
    {

        $scope.services = [];
        $scope.uncalled_numbers = null;
        $scope.next_number = null;
        $scope.business_id = $('#business_id').val();
        $scope.confirmation_code = null;
        $scope.issued_number = null;
        $scope.active_service_id = null;
        $scope.selected_pacing_id = 0;
        $scope.groups = [];
        $scope.group_services = [];
        $scope.active_group_id = null;

        //websocket = new ReconnectingWebSocket(websocket_url);
        //websocket.onopen = function(response) { // connection is open
        //  $('#WebsocketLoaderModal').modal('hide');
        //
        //};
        //websocket.onerror	= function(response){
        //  $('#WebsocketLoaderModal').modal('show');
        //};
        //
        //websocket.onclose = function(response){
        //  $('#WebsocketLoaderModal').modal('show');
        //};
        //
        //window.onbeforeunload = function(e) {
        //  websocket.close();
        //};
        //
        //websocket.send(JSON.stringify({
        //  business_id : $scope.business_id,
        //  broadcast_update : false,
        //  broadcast_reload: false
        //}));

        $scope.getBusinessServices = function ()
        {

            var business_id = $scope.business_id;
            var res_array = [];

            if (typeof business_id != 'undefined') {
                $http.get('/services/business/' + business_id).success(function (response)
                {
                    $('#services_list').empty();
                    res_array = response.business_services;
                    $scope.services = res_array[0];
                    $scope.active_service_id = $scope.services[0].group_id;
                    $scope.getNextNumber();
                });
            }
        };

        $scope.getGroups = function()
        {
            var business_id = $scope.business_id;
            var res_array = [];

            if (typeof business_id != 'undefined') {
                $http.get('/grouping/groups/' + business_id).success(function (response)
                {
                    //$('#services_list').empty();
                    res_array = response;
                    $scope.groups = res_array;
                    $scope.active_group_id = $scope.groups[0].group_id;
                });
            }
        }

        $scope.getGroupServices = function (group_id){
            var res_array = [];

            if (typeof business_id != 'undefined') {
                $http.get('/services/service-by-group/' + group_id).success(function (response)
                {
                    //$('#services_list').empty();
                    res_array = response;
                    $scope.group_services = res_array;
                    $scope.active_service_id = $scope.group_services[0].service_id;
                    $scope.getNextNumber();
                });
            }
        }

        $scope.getNextNumber = function ()
        {
            $http.get('/processqueue/next-number/' + $scope.active_service_id).success(function (response)
            {
                if($scope.group_services.length == 0)
                    $scope.next_number = "--";
                else
                    $scope.next_number = response.next_number;
            });
        };


        $scope.getIssueNumber = function ()
        {
            var data = {
                priority_number: $scope.next_number.replace(/\D/g, ''),
                name: "",
                phone: "",
                email: ""
            };
            $http.post('/issuenumber/insertspecific/' + $scope.active_service_id + '/' + null + '/' + 'kiosk', data)
              .success(function (response)
              {
                  $scope.issued_number = $scope.next_number;
                  $scope.getNextNumber();
                  $scope.confirmation_code = response.number.confirmation_code;
                  $('#kioskModal').modal('hide');
              });
        }

//        $('#kioskModal').on('hidden.bs.modal', function (e) {
//            $('#issue-confirmation-code').modal('show');
//        });

        $scope.switchActiveService = function (service_id)
        {
            $scope.next_number = '--';
            $scope.active_service_id = service_id;
            $scope.getNextNumber();
        };

        $scope.switchPacingSchedule = function (pacing_id)
        {
            $scope.selected_pacing_id = pacing_id;
        };

        $scope.switchActiveGroup = function (group_id)
        {
            $scope.getGroupServices(group_id);
            $scope.next_number = '--';
            $scope.active_group_id = group_id;
            $scope.getNextNumber();
        };

        //$scope.getBusinessServices();
        $scope.getGroups();
       // $scope.getGroupServices();

    });

    app.controller('groupKioskController', function($scope, $http){

        $scope.group_id = $('#group_id').val();
        $scope.services_in_group = [];
        $scope.active_service_id = null;
        $scope.uncalled_numbers = null;
        $scope.next_number = null;
        $scope.confirmation_code = null;
        $scope.group_name = null;

        $scope.getGroupName = function(){
            if (typeof group_id != 'undefined') {
                $http.get('/grouping/name/' + $scope.group_id).success(function (response)
                {
                    if(response.length > 0) {
                        $scope.group_name = response[0]['group_name'];
                    }
                });
            }

        }

        $scope.getServicesInGroup = function ()
        {

            var group_id = $scope.group_id;
            var res_array = [];

            if (typeof group_id != 'undefined') {
                $http.get('/services/service-by-group/' + group_id).success(function (response)
                {
                    res_array = response;
                    if(res_array.length > 0){
                        $scope.services_in_group = res_array;
                        $scope.active_service_id = $scope.services_in_group[0].service_id;
                        $scope.getNextNumber();
                    }
                });

                if($scope.services_in_group.length == 0){
                    $scope.next_number = "--";
                }
            }
        };


        $scope.switchActiveService = function (service_id)
        {
            $scope.next_number = '--';
            $scope.active_service_id = service_id;
            $scope.getNextNumber()
        };

        $scope.getNextNumber = function ()
        {
            $http.get('/processqueue/next-number/' + $scope.active_service_id).success(function (response)
            {
                $scope.next_number = response.next_number;

            });
        };

        $scope.getIssueNumber = function ()
        {
            var data = {
                priority_number: $scope.next_number.replace(/\D/g, ''),
                name: "",
                phone: "",
                email: ""
            };
            $http.post('/issuenumber/insertspecific/' + $scope.active_service_id + '/' + null + '/' + 'kiosk', data)
                .success(function (response)
                {
                    $scope.issued_number = $scope.next_number;
                    $scope.getNextNumber();
                    $scope.confirmation_code = response.number.confirmation_code;
                    $('#kioskModal').modal('hide');
                });
        }

        $scope.getGroupName();
        $scope.getServicesInGroup();
    });
})();

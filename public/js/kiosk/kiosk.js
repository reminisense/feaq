/**
 * Created by Polljii143 on 3/17/17.
 */

(function() {

  //app.requires.push('ngSanitize');
  //app.requires.push('angular-loading-bar'); //add angular loading bar
  //app.config(['cfpLoadingBarProvider', function (cfpLoadingBarProvider) {
  //  cfpLoadingBarProvider.includeSpinner = false;
  //}]);

  app.controller('kioskController', function ($scope, $http) {
    
    $scope.services = [];
    $scope.uncalled_numbers = null;
    $scope.next_number = null;
    $scope.business_id = $('#business_id').val();
    $scope.confirmation_code = null;
    $scope.issued_number = null;
    $scope.active_service_id = null;


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

      $scope.getBusinessServices = function(){
      
          var business_id = $scope.business_id;
          var res_array = [];

          if(typeof business_id != 'undefined'){
              $http.get('/services/business/' + business_id).success(function(response){
                  $('#services_list').empty();
                  res_array = response.business_services;
                  $scope.services = res_array[0];
                $scope.active_service_id = $scope.services[0].service_id
                  $scope.getNextNumber();
              });
          }
      };

      $scope.getNextNumber = function(){
          $http.get('/processqueue/next-number/' + $scope.active_service_id).success(function(response) {
              $scope.next_number = response.next_number;
          });
      };


      $scope.getIssueNumber = function(){

          var data = {
              priority_number : $scope.next_number,
              name : "",
              phone : "",
              email : ""
          };
          $http.post('/issuenumber/insertspecific/' + $scope.active_service_id + '/' + null + '/' + 'kiosk', data).success(function(response) {
              $scope.issued_number = $scope.next_number;
              $scope.getNextNumber();
              $scope.confirmation_code = response.number.confirmation_code;
              $('#issue-confirmation-code').modal('show');
          });
      }

    $scope.switchActiveService = function(service_id) {
      $scope.active_service_id = service_id;
      $scope.getNextNumber();
    };

      $scope.getBusinessServices();

  });
})();

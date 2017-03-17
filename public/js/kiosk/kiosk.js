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

      $scope.business_id = $('#business-id').val();

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
          if(typeof business_id != 'undefined'){

              $http.get('/services/business/' + business_id).success(function(response){
                  $('#services').empty();
                  business_services = response.business_services;
                  for(branch in business_services){
                      for(service in business_services[branch]){
                          $('#services').append('<option value="' + business_services[branch][service].service_id +'">' + business_services[branch][service].name + '</option>');
                      }
                  }
                  $scope.selectService();
              });
          }
      };



      $scope.getBusinessServices();
  });
})();

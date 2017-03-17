/**
 * Created by Polljii143 on 3/17/17.
 */

(function() {
  app.requires.push('ngSanitize');
  app.requires.push('angular-loading-bar'); //add angular loading bar
  app.config(['cfpLoadingBarProvider', function (cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
  }]);

  app.controller('kioskController', function ($scope, $http) {
    websocket = new ReconnectingWebSocket(websocket_url);
    websocket.onopen = function(response) { // connection is open
      $('#WebsocketLoaderModal').modal('hide');

    };
    websocket.onerror	= function(response){
      $('#WebsocketLoaderModal').modal('show');
    };

    websocket.onclose = function(response){
      $('#WebsocketLoaderModal').modal('show');
    };

    window.onbeforeunload = function(e) {
      websocket.close();
    };

    websocket.send(JSON.stringify({
      business_id : "0",
      broadcast_update : false,
      broadcast_reload: false
    }));
  });

})();

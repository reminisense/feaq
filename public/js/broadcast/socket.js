//open a web socket connection
var establishSocketConnection = function($scope, $http, business_id) {

  websocket = new ReconnectingWebSocket(websocket_url);

  websocket.onopen = function (response) { // connection is open
    $http.get('/json/' + business_id + '.json?nocache=' + Math.floor((Math.random() * 10000) + 1)).success($scope.updateBroadcastPage);
    websocket.send(JSON.stringify({
      business_id: business_id,
      broadcast_update: false,
      broadcast_reload: false
    }));
    $('#WebsocketLoaderModal').modal('hide');
  }

  websocket.onmessage = function (response) { // what happens when data is received
    var result = JSON.parse(response.data);
    if (result.broadcast_update) {
      $http.get('/json/' + business_id + '.json?nocache=' + Math.floor((Math.random() * 10000) + 1)).success($scope.updateBroadcastPage);
    }
    if (result.broadcast_reload) {
      window.location.reload(true);
    }
  };

  websocket.onerror = function (response) {
    $('#WebsocketLoaderModal').modal('show');
  };

  websocket.onclose = function (response) {
    websocket.close();
    $('#WebsocketLoaderModal').modal('show');
  };

  window.onbeforeunload = function(e) {
    websocket.close();
  }

  setInterval(function () {
    websocket.send(JSON.stringify({
      business_id: business_id,
      broadcast_update: false,
      broadcast_reload: false
    }));
  }, 600000);

};


var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http) {

  establishSocketConnection($scope, $http, business_id);

  $scope.updateBroadcastPage = (function(response) {
    if (typeof sessionStorage.service_id != "undefined" && sessionStorage.service_id != "0") {
      response = response["services"][sessionStorage.service_id];
      $('#callednums-title').text(sessionStorage.service_name);
      $('.wrap-nums .service').hide();
      $('#business-queue-now').hide();
      $('#service-queue-now').show();
      $('#broadcast-spec').attr('class', sessionStorage.broadcast_spec);
    }
    else if (typeof sessionStorage.terminal_id != "undefined" && sessionStorage.terminal_id != "0") {
      response = response["terminals"][sessionStorage.terminal_id];
      $('#callednums-title').text(sessionStorage.service_name + " - " + sessionStorage.terminal_name);
      $('.wrap-nums .service').hide();
      $('.wrap-nums .terminal').hide();
      $('#business-queue-now').hide();
      $('#service-queue-now').show();
      $('#broadcast-spec').attr('class', sessionStorage.broadcast_spec);
    }
    console.log(response);

    announceNumber($scope, response, 'rank1', 'box1', 'name1', 'service1', 'color1', 'user1');

    announceNumberFromBlank($scope, response, 'box1', 'rank1');

    writeNumber($scope, response, 'box1', 'service1', 'user1', 'color1');

    writeQueueNow($scope, response);
  });
});
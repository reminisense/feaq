var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http) {

  establishSocketConnection($scope, $http, business_id);

  $scope.updateBroadcastPage = (function(response) {
    if (typeof sessionStorage.service_id != "undefined" && sessionStorage.service_id != "0") {
      response = response["services"][sessionStorage.service_id];
      $('#now-serving-title').text(sessionStorage.service_name);
      $('.blink-num').hide();
      $('.numbers .service').hide();
      $('.numbers .terminal').removeClass('terminal').addClass('service');
    }
    else if (typeof sessionStorage.terminal_id != "undefined" && sessionStorage.terminal_id != "0") {
      response = response["terminals"][sessionStorage.terminal_id];
      $('#now-serving-title').text(sessionStorage.service_name + " - " + sessionStorage.terminal_name);
      $('.blink-num').hide();
      $('.numbers .service').hide();
      $('.numbers .terminal').hide();
    }
    console.log(response);

    announceNumber($scope, response, 'rank1', 'box1', 'name1', 'service1', 'color1', 'user1');
    announceNumber($scope, response, 'rank2', 'box2', 'name2', 'service2', 'color2', 'user2');

    announceNumberFromBlank($scope, response, 'box1', 'rank1');
    announceNumberFromBlank($scope, response, 'box2', 'rank2');

    writeNumber($scope, response, 'box1', 'service1', 'user1', 'color1');
    writeNumber($scope, response, 'box2', 'service2', 'user2', 'color2');
  });
});
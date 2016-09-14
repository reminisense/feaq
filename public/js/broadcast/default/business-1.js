var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http) {

  establishSocketConnection($scope, $http, business_id);

  $scope.updateBroadcastPage = (function(response) {
    if (typeof sessionStorage.service_id != "undefined" && sessionStorage.service_id != "0") {
      response = response[sessionStorage.service_id]; // response["services"][sessionStorage.service_id];
    }
    else if (typeof sessionStorage.terminal_id != "undefined" && sessionStorage.terminal_id != "0") {
      response = response[sessionStorage.terminal_id]; // response["terminals"][sessionStorage.terminal_id];
    }
    console.log(response);

    announceNumber($scope, response, 'rank1', 'box1', 'name1', 'service1', 'color1', 'user1');

    announceNumberFromBlank($scope, response, 'box1', 'rank1');

    writeNumber($scope, response, 'box1', 'service1', 'user1', 'color1');
  });
});
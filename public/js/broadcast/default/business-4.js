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
    announceNumber($scope, response, 'rank2', 'box2', 'name2', 'service2', 'color2', 'user2');
    announceNumber($scope, response, 'rank3', 'box3', 'name3', 'service3', 'color3', 'user3');
    announceNumber($scope, response, 'rank4', 'box4', 'name4', 'service4', 'color4', 'user4');

    announceNumberFromBlank($scope, response, 'box1', 'rank1');
    announceNumberFromBlank($scope, response, 'box2', 'rank2');
    announceNumberFromBlank($scope, response, 'box3', 'rank3');
    announceNumberFromBlank($scope, response, 'box4', 'rank4');

    writeNumber($scope, response, 'box1', 'service1', 'user1', 'color1');
    writeNumber($scope, response, 'box2', 'service2', 'user2', 'color2');
    writeNumber($scope, response, 'box3', 'service3', 'user3', 'color3');
    writeNumber($scope, response, 'box4', 'service4', 'user4', 'color4');
  });
});
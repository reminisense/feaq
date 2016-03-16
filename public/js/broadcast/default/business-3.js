var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http) {

  establishSocketConnection($scope, $http, business_id);

  $scope.updateBroadcastPage = (function(response) {
    announceNumber($scope, response, 'rank1', 'box1', 'name1', 'service1', 'color1', 'user1');
    announceNumber($scope, response, 'rank2', 'box2', 'name2', 'service2', 'color2', 'user2');
    announceNumber($scope, response, 'rank3', 'box3', 'name3', 'service3', 'color3', 'user3');

    announceNumberFromBlank($scope, response, 'box1', 'rank1');
    announceNumberFromBlank($scope, response, 'box2', 'rank2');
    announceNumberFromBlank($scope, response, 'box3', 'rank3');

    writeNumber($scope, response, 'box1', 'service1');
    writeNumber($scope, response, 'box2', 'service2');
    writeNumber($scope, response, 'box3', 'service3');
  });
});
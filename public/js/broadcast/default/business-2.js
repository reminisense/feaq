var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http) {

  establishSocketConnection($scope, $http, business_id);

  $scope.updateBroadcastPage = (function(response) {
    announceNumber($scope, response, 'rank1', 'box1', 'name1', 'service1');
    announceNumber($scope, response, 'rank2', 'box2', 'name2', 'service2');

    announceNumberFromBlank($scope, response, 'box1', 'rank1');
    announceNumberFromBlank($scope, response, 'box2', 'rank2');

    writeNumber($scope, response, 'box1');
    writeNumber($scope, response, 'box2');
  });
});
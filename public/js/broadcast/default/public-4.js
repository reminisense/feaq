var app = angular.module('PublicBroadcast', ['Facebook']);

app.controller('nowServingCtrl', function($scope, $http) {

  establishSocketConnection($scope, $http, business_id);

  $scope.updateBroadcastPage = (function(response) {
    announceNumber($scope, response, 'rank1', 'box1', 'name1', 'service1');
    announceNumber($scope, response, 'rank2', 'box2', 'name2', 'service2');
    announceNumber($scope, response, 'rank3', 'box3', 'name3', 'service3');
    announceNumber($scope, response, 'rank4', 'box4', 'name4', 'service4');

    announceNumberFromBlank($scope, response, 'box1', 'rank1');
    announceNumberFromBlank($scope, response, 'box2', 'rank2');
    announceNumberFromBlank($scope, response, 'box3', 'rank3');
    announceNumberFromBlank($scope, response, 'box4', 'rank4');

    writeNumber($scope, response, 'box1');
    writeNumber($scope, response, 'box2');
    writeNumber($scope, response, 'box3');
    writeNumber($scope, response, 'box4');

    /* RDH Checks if empty, show '-' if yes*/
    getNum($scope, response);
  });

});

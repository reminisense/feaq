var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http) {

  establishSocketConnection($scope, $http, business_id);

  $scope.updateBroadcastPage = (function(response) {
    announceNumber($scope, response, 'rank1', 'box1', 'name1', 'service1', 'color1', 'user1');
    announceNumber($scope, response, 'rank2', 'box2', 'name2', 'service2', 'color2', 'user2');
    announceNumber($scope, response, 'rank3', 'box3', 'name3', 'service3', 'color3', 'user3');
    announceNumber($scope, response, 'rank4', 'box4', 'name4', 'service4', 'color4', 'user4');
    announceNumber($scope, response, 'rank5', 'box5', 'name5', 'service5', 'color5', 'user5');
    announceNumber($scope, response, 'rank6', 'box6', 'name6', 'service6', 'color6', 'user6');

    announceNumberFromBlank($scope, response, 'box1', 'rank1');
    announceNumberFromBlank($scope, response, 'box2', 'rank2');
    announceNumberFromBlank($scope, response, 'box3', 'rank3');
    announceNumberFromBlank($scope, response, 'box4', 'rank4');
    announceNumberFromBlank($scope, response, 'box5', 'rank5');
    announceNumberFromBlank($scope, response, 'box6', 'rank6');

    writeNumber($scope, response, 'box1', 'service1', 'user1', 'color1');
    writeNumber($scope, response, 'box2', 'service2', 'user2', 'color2');
    writeNumber($scope, response, 'box3', 'service3', 'user3', 'color3');
    writeNumber($scope, response, 'box4', 'service4', 'user4', 'color4');
    writeNumber($scope, response, 'box5', 'service5', 'user5', 'color5');
    writeNumber($scope, response, 'box6', 'service6', 'user6', 'color6');
  });
});
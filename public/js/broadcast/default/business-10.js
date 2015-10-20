var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http) {

  establishSocketConnection($scope, $http, business_id);

  $scope.updateBroadcastPage = (function(response) {
    refreshOnSettingsChange(broadcast_type, ad_type, carousel_delay, live_ticker, response);

    announceNumber($scope, response, 'rank1', 'box1', 'name1');
    announceNumber($scope, response, 'rank2', 'box2', 'name2');
    announceNumber($scope, response, 'rank3', 'box3', 'name3');
    announceNumber($scope, response, 'rank4', 'box4', 'name4');
    announceNumber($scope, response, 'rank5', 'box5', 'name5');
    announceNumber($scope, response, 'rank6', 'box6', 'name6');
    announceNumber($scope, response, 'rank7', 'box7', 'name7');
    announceNumber($scope, response, 'rank8', 'box8', 'name8');
    announceNumber($scope, response, 'rank9', 'box9', 'name9');
    announceNumber($scope, response, 'rank10', 'box10', 'name10');

    announceNumberFromBlank($scope, response, 'box1', 'rank1');
    announceNumberFromBlank($scope, response, 'box2', 'rank2');
    announceNumberFromBlank($scope, response, 'box3', 'rank3');
    announceNumberFromBlank($scope, response, 'box4', 'rank4');
    announceNumberFromBlank($scope, response, 'box5', 'rank5');
    announceNumberFromBlank($scope, response, 'box6', 'rank6');
    announceNumberFromBlank($scope, response, 'box7', 'rank7');
    announceNumberFromBlank($scope, response, 'box8', 'rank8');
    announceNumberFromBlank($scope, response, 'box9', 'rank9');
    announceNumberFromBlank($scope, response, 'box10', 'rank10');

    writeNumber($scope, response, 'box1');
    writeNumber($scope, response, 'box2');
    writeNumber($scope, response, 'box3');
    writeNumber($scope, response, 'box4');
    writeNumber($scope, response, 'box5');
    writeNumber($scope, response, 'box6');
    writeNumber($scope, response, 'box7');
    writeNumber($scope, response, 'box8');
    writeNumber($scope, response, 'box9');
    writeNumber($scope, response, 'box10');
  });
});
var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function ($scope, $http) {

  establishSocketConnection($scope, $http, business_id);

  $scope.updateBroadcastPage = (function (response) {
    writeNumberToBoxes($scope, response, 'box1', 'service1', 'current1', 'terminal1', 'color1', 'called1');
    writeNumberToBoxes($scope, response, 'box2', 'service2', 'current2', 'terminal2', 'color2', 'called2');
    writeNumberToBoxes($scope, response, 'box3', 'service3', 'current3', 'terminal3', 'color3', 'called3');
    writeNumberToBoxes($scope, response, 'box4', 'service4', 'current4', 'terminal4', 'color4', 'called4');
    writeNumberToBoxes($scope, response, 'box5', 'service5', 'current5', 'terminal5', 'color5', 'called5');
    writeNumberToBoxes($scope, response, 'box6', 'service6', 'current6', 'terminal6', 'color6', 'called6');
    writeNumberToBoxes($scope, response, 'box7', 'service7', 'current7', 'terminal7', 'color7', 'called7');
    writeNumberToBoxes($scope, response, 'box8', 'service8', 'current8', 'terminal8', 'color8', 'called8');
    writeNumberToBoxes($scope, response, 'box9', 'service9', 'current9', 'terminal9', 'color9', 'called9');
    writeNumberToBoxes($scope, response, 'box10', 'service10', 'current10', 'terminal10', 'color10', 'called10');
    writeNumberToBoxes($scope, response, 'box11', 'service11', 'current11', 'terminal11', 'color11', 'called11');
    writeNumberToBoxes($scope, response, 'box12', 'service12', 'current12', 'terminal12', 'color12', 'called12');
    $scope.now_number = response.now_num;
    $scope.now_service = response.now_service;
    $scope.now_terminal = response.now_terminal;
    $scope.now_color = response.now_color;
    $('#currently-called-number').modal('show');
    setTimeout(function() {$('#currently-called-number').modal('hide');}, 5000);
    callNumberSound('call-number-sound');
      responsiveVoice.speak($scope.now_number, "UK English Male", {rate: .6, pitch: .9});
  });

});
var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function ($scope, $http)
{

    establishSocketConnection($scope, $http, business_id);

    $scope.updateBroadcastPage = (function (response)
    {
        writeNumberToBoxes($scope, response, 'box1', 'service1', 'current1', 'terminal1', 'color1', 'called1');
        writeNumberToBoxes($scope, response, 'box2', 'service2', 'current2', 'terminal2', 'color2', 'called2');
        writeNumberToBoxes($scope, response, 'box3', 'service3', 'current3', 'terminal3', 'color3', 'called3');
        writeNumberToBoxes($scope, response, 'box4', 'service4', 'current4', 'terminal4', 'color4', 'called4');
        writeNumberToBoxes($scope, response, 'box5', 'service5', 'current5', 'terminal5', 'color5', 'called5');
        $scope.now_number = response.now_num;
        $scope.now_group = response.now_group;
        $scope.now_service = response.now_service;
        $scope.now_terminal = response.now_terminal;
        $scope.now_color = response.now_color;
        $('#currently-called-number').modal('show');
        setTimeout(function ()
        {
            $('#currently-called-number').modal('hide');
        }, 5000);
        callNumberSound('call-number-sound');
        responsiveVoice.speak($scope.now_number, "UK English Male", {rate: .6, pitch: .9});
    });

});
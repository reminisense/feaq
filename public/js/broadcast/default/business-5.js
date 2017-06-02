var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function ($scope, $http)
{

    establishSocketConnection($scope, $http, business_id);

    $scope.updateBroadcastPage = (function (response)
    {
        writeNumberToBoxes($scope, response, "id_" + $('#box1').val(), 'service1', 'current1', 'terminal1', 'color1', 'called1');
        writeNumberToBoxes($scope, response, "id_" + $('#box2').val(), 'service2', 'current2', 'terminal2', 'color2', 'called2');
        writeNumberToBoxes($scope, response, "id_" + $('#box3').val(), 'service3', 'current3', 'terminal3', 'color3', 'called3');
        writeNumberToBoxes($scope, response, "id_" + $('#box4').val(), 'service4', 'current4', 'terminal4', 'color4', 'called4');
        writeNumberToBoxes($scope, response, "id_" + $('#box5').val(), 'service5', 'current5', 'terminal5', 'color5', 'called5');
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
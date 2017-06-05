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
        writeNumberToBoxes($scope, response, "id_" + $('#box6').val(), 'service6', 'current6', 'terminal6', 'color6', 'called6');
        writeNumberToBoxes($scope, response, "id_" + $('#box7').val(), 'service7', 'current7', 'terminal7', 'color7', 'called7');
        writeNumberToBoxes($scope, response, "id_" + $('#box8').val(), 'service8', 'current8', 'terminal8', 'color8', 'called8');
        writeNumberToBoxes($scope, response, "id_" + $('#box9').val(), 'service9', 'current9', 'terminal9', 'color9', 'called9');

        var groupList = [
            $('#box1').val(),
            $('#box2').val(),
            $('#box3').val(),
            $('#box4').val(),
            $('#box5').val(),
            $('#box6').val(),
            $('#box7').val(),
            $('#box8').val(),
            $('#box9').val()
        ];
        alertCalledNumber($scope, response, groupList);
    });

});
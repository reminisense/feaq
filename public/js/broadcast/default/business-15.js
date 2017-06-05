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
        writeNumberToBoxes($scope, response, "id_" + $('#box10').val(), 'service10', 'current10', 'terminal10', 'color10', 'called10');
        writeNumberToBoxes($scope, response, "id_" + $('#box11').val(), 'service11', 'current11', 'terminal11', 'color11', 'called11');
        writeNumberToBoxes($scope, response, "id_" + $('#box12').val(), 'service12', 'current12', 'terminal12', 'color12', 'called12');
        writeNumberToBoxes($scope, response, "id_" + $('#box13').val(), 'service13', 'current13', 'terminal13', 'color13', 'called13');
        writeNumberToBoxes($scope, response, "id_" + $('#box14').val(), 'service14', 'current14', 'terminal14', 'color14', 'called14');
        writeNumberToBoxes($scope, response, "id_" + $('#box15').val(), 'service15', 'current15', 'terminal15', 'color15', 'called15');

        var groupList = [
            $('#box1').val(),
            $('#box2').val(),
            $('#box3').val(),
            $('#box4').val(),
            $('#box5').val(),
            $('#box6').val(),
            $('#box7').val(),
            $('#box8').val(),
            $('#box9').val(),
            $('#box10').val(),
            $('#box11').val(),
            $('#box12').val(),
            $('#box13').val(),
            $('#box14').val(),
            $('#box15').val()
        ];
        alertCalledNumber($scope, response, groupList);
    });

});
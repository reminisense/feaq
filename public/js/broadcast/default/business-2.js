var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function ($scope, $http)
{

    establishSocketConnection($scope, $http, business_id);

    $scope.updateBroadcastPage = (function (response)
    {
        writeNumberToBoxes($scope, response, "id_" + $('#box1').val(), 'service1', 'current1', 'terminal1', 'color1', 'called1');
        writeNumberToBoxes($scope, response, "id_" + $('#box2').val(), 'service2', 'current2', 'terminal2', 'color2', 'called2');

        var groupList = [
            $('#box1').val(),
            $('#box2').val()
        ];
        alertCalledNumber($scope, response, groupList);
    });

});
var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function ($scope, $http)
{

    establishSocketConnection($scope, $http, business_id);

    $scope.updateBroadcastPage = (function (response)
    {
        writeNumberToBoxes($scope, response, "id_" + $('#box1').val(), 'service1', 'current1', 'terminal1', 'color1', 'called1');

        var groupList = [
            $('#box1').val()
        ];
        alertCalledNumber($scope, response, groupList);
    });

});
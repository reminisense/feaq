var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http) {

    var business_id = document.getElementById('business-id').getAttribute('business_id');
    var broadcast_type = document.getElementById('broadcast-type').getAttribute('broadcast_type');
    var ad_type = document.getElementById('ad-type').getAttribute('ad_type');

    $scope.callNumberSound = (function (soundobj) {
        var thissound = document.getElementById(soundobj);
        thissound.play();
    });

    $scope.announceNumber = (function(response, rank_num, box_num, name_num) {
        if (typeof response[box_num] != 'undefined') {
            if ($scope[rank_num] != response[box_num].rank) {
                $scope[rank_num] = response[box_num].rank;
                $scope[name_num] = response[box_num].terminal;
                if ($scope[rank_num] != "") {
                    $scope.callNumberSound('call-number-sound');
                }
            }
        }
    });

    $scope.announceNumberFromBlank = (function(response, box_num, rank_num) {
        if (typeof response[box_num] != 'undefined') {
            if ($scope[box_num] != response[box_num].number && $scope[rank_num] != "") {
                $scope.callNumberSound('call-number-sound');
            }
        }
    });

    $scope.writeNumber = (function(response, box_num) {
        if (typeof response[box_num] != 'undefined') {
            $scope[box_num] = response[box_num].number;
        }
    });

    $scope.refreshOnSettingsChange = (function(response) {
        if (broadcast_type != response.display || ad_type != response.ad_type) {
            window.location.reload(true);
        }
    });

    $scope.updateBroadcastPage = (function(response) {
        $scope.refreshOnSettingsChange(response);

        $scope.announceNumber(response, 'rank1', 'box1', 'name1');

        $scope.announceNumberFromBlank(response, 'box1', 'rank1');

        $scope.writeNumber(response, 'box1');
    });

    $scope.resetNumbers = (function(response) {
        if (response.status == '1') {
            window.location.reload(true);
        }
    });

    setInterval(function() {
        $http.get('/broadcast/reset-numbers/'+business_id).success($scope.resetNumbers);
        $http.get('/json/'+business_id+'.json?nocache='+Math.floor((Math.random() * 10000) + 1)).success($scope.updateBroadcastPage);
    }, 1000);

});
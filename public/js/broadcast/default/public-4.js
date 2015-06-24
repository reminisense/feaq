var app = angular.module('PublicBroadcast', ['Facebook']);

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

    $scope.getNum = (function(response) {
        $scope.get_num = (response.get_num === "") ? "-": response.get_num;
    });

    $scope.refreshOnSettingsChange = (function(response) {
        if (broadcast_type != response.display || ad_type != response.ad_type) {
            window.location.reload(true);
        }
    });

    $scope.updateBroadcastPage = (function(response) {
        $scope.refreshOnSettingsChange(response);

        $scope.announceNumber(response, 'rank1', 'box1', 'name1');
        $scope.announceNumber(response, 'rank2', 'box2', 'name2');
        $scope.announceNumber(response, 'rank3', 'box3', 'name3');
        $scope.announceNumber(response, 'rank4', 'box4', 'name4');

        $scope.announceNumberFromBlank(response, 'box1', 'rank1');
        $scope.announceNumberFromBlank(response, 'box2', 'rank2');
        $scope.announceNumberFromBlank(response, 'box3', 'rank3');
        $scope.announceNumberFromBlank(response, 'box4', 'rank4');

        $scope.writeNumber(response, 'box1');
        $scope.writeNumber(response, 'box2');
        $scope.writeNumber(response, 'box3');
        $scope.writeNumber(response, 'box4');

        $scope.ticker_message = response.ticker_message;

        /* RDH Checks if empty, show '-' if yes*/
        $scope.getNum(response);
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

var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http, $compile) {

    var business_id = document.getElementById('business-id').getAttribute('business_id');
    var broadcast_type = document.getElementById('broadcast-type').getAttribute('broadcast_type');
    var ad_type = document.getElementById('ad-type').getAttribute('ad_type');
    var carousel_delay = document.getElementById('fqCarousel').getAttribute('data-interval');

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
        if (broadcast_type != response.display || ad_type != response.ad_type || carousel_delay != response.carousel_delay) {
            window.location.reload(true);
        }
    });

    $scope.updateBroadcastPage = (function(response) {
        $scope.refreshOnSettingsChange(response);

        $scope.announceNumber(response, 'rank1', 'box1', 'name1');
        $scope.announceNumber(response, 'rank2', 'box2', 'name2');
        $scope.announceNumber(response, 'rank3', 'box3', 'name3');
        $scope.announceNumber(response, 'rank4', 'box4', 'name4');
        $scope.announceNumber(response, 'rank5', 'box5', 'name5');
        //$scope.announceNumber(response, 'rank6', 'box6', 'name6');

        $scope.announceNumberFromBlank(response, 'box1', 'rank1');
        $scope.announceNumberFromBlank(response, 'box2', 'rank2');
        $scope.announceNumberFromBlank(response, 'box3', 'rank3');
        $scope.announceNumberFromBlank(response, 'box4', 'rank4');
        $scope.announceNumberFromBlank(response, 'box5', 'rank5');
        //$scope.announceNumberFromBlank(response, 'box6', 'rank6');

        $scope.writeNumber(response, 'box1');
        $scope.writeNumber(response, 'box2');
        $scope.writeNumber(response, 'box3');
        $scope.writeNumber(response, 'box4');
        $scope.writeNumber(response, 'box5');
        //$scope.writeNumber(response, 'box6');

/*        $('.marquee-text').remove();
        if(response.ticker_message != ''){ $('.ticker').append("<div class='marquee-text hidden'>" + response.ticker_message + "</div"); }
        if(response.ticker_message2 != ''){ $('.ticker').append("<div class='marquee-text hidden'>" + response.ticker_message2 + "</div"); }
        if(response.ticker_message3 != ''){ $('.ticker').append("<div class='marquee-text hidden'>" + response.ticker_message3 + "</div"); }
        if(response.ticker_message4 != ''){ $('.ticker').append("<div class='marquee-text hidden'>" + response.ticker_message4 + "</div"); }
        if(response.ticker_message5 != ''){ $('.ticker').append("<div class='marquee-text hidden'>" + response.ticker_message5 + "</div"); }*/
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
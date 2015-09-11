/**
 * Created by polljii on 8/28/15.
 */

var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http, $compile) {

    //open a web socket connection
    websocket = new WebSocket("ws://localhost:55346/socket/server.php");
    websocket.onopen = function(response) { // connection is open

    }
    websocket.onmessage = function(response) { // what happens when data is received
        var result = JSON.parse(response.data);
        $scope.writeNumber(result);
    };
    websocket.onerror	= function(response){};
    websocket.onclose 	= function(response){};

    var business_id = $('#business-id').attr('business_id');
    var broadcast_type = $('#broadcast-type').attr('broadcast_type');
    var ad_type = $('#ad-type').attr('ad_type');
    var carousel_delay = $('#fqCarousel').attr('data-interval');
    var live_ticker = $('.marquee-text').text();

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

    $scope.writeNumber = (function(response) {
        $scope.$apply(function() {
            if (response.box == 1) {
                $scope.box1 = response.number;
                $scope.name1 = response.terminal;
                $scope.rank1 = response.rank;
            }
            else if (response.box == 2) {
                $scope.box2 = response.number;
                $scope.name2 = response.terminal;
                $scope.rank2 = response.rank;
            }
            else if (response.box == 3) {
                $scope.box3 = response.number;
                $scope.name3 = response.terminal;
                $scope.rank3 = response.rank;
            }
            else if (response.box == 4) {
                $scope.box4 = response.number;
                $scope.name4 = response.terminal;
                $scope.rank4 = response.rank;
            }
            else if (response.box == 5) {
                $scope.box5 = response.number;
                $scope.name5 = response.terminal;
                $scope.rank5 = response.rank;
            }
            else if (response.box == 6) {
                $scope.box6 = response.number;
                $scope.name6 = response.terminal;
                $scope.rank6 = response.rank;
            }
        });
        $scope.callNumberSound('call-number-sound');
    });

    $scope.refreshOnSettingsChange = (function(response) {
        // check if carousel delay is existing but check if it's for image advertisements first
        if (broadcast_type.search('1-') != '-1') {
            if (typeof response.carousel_delay == "undefined") {
                response.carousel_delay = "5000";
            }
        }
        else {
            carousel_delay = '';
            response.carousel_delay = '';
        }

        // check if ticker messages are existing
        if (typeof response.ticker_message == "undefined" || response.ticker_message == null) response.ticker_message = '';
        if (typeof response.ticker_message2 == "undefined" || response.ticker_message2 == null) response.ticker_message2 = '';
        if (typeof response.ticker_message3 == "undefined" || response.ticker_message3 == null) response.ticker_message3 = '';
        if (typeof response.ticker_message4 == "undefined" || response.ticker_message4 == null) response.ticker_message4 = '';
        if (typeof response.ticker_message5 == "undefined" || response.ticker_message5 == null) response.ticker_message5 = '';

        var total_ticker = response.ticker_message + response.ticker_message2 +
            response.ticker_message3 + response.ticker_message4 + response.ticker_message5;

        if (broadcast_type != response.display || ad_type != response.ad_type
            || carousel_delay != response.carousel_delay || live_ticker != total_ticker) {
            window.location.reload(true);
        }
    });

});
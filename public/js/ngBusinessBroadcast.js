var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http) {

    var business_id = document.getElementById('business-id').getAttribute('business_id');

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

    $scope.showHideNumbers = (function(response) {
        var boxes = response.display.split("-");
        $scope.boxdisplay1 = '';
        $scope.boxdisplay2 = (boxes[1] >= '4') ? '' : 'display: none;';
        $scope.boxdisplay3 = (boxes[1] >= '4') ? '' : 'display: none;';
        $scope.boxdisplay4 = (boxes[1] >= '4') ? '' : 'display: none;';
        $scope.boxdisplay5 = (boxes[1] >= '6') ? '' : 'display: none;';
        $scope.boxdisplay6 = (boxes[1] >= '6') ? '' : 'display: none;';
        if (boxes[1] == '6') {
            $scope.boxsize = 4;
            $scope.spaceht = '';
        }
        else if (boxes[1] == '4') {
            $scope.boxsize = 6;
            $scope.spaceht = '';
        }
        else if (boxes[1] == '1') {
            $scope.boxsize = 12;
            $scope.spaceht = 'spaceht';
        }
    });

    $scope.showInternetTV = (function(response) {
        if (response.turn_on_tv) {
            $('#internet-tv').show();
            $('#image-ad').hide();
        }
        else {
            $('#internet-tv').hide();
            $('#image-ad').show();
        }
    });

    $scope.setInternetTV = (function(response) {
        $('#internet-tv').html(response.ad_video);
    });

    $scope.showHideAds = (function(response) {
        var boxes = response.display.split("-");
        if (boxes[0] == '0') {
            $scope.ad_display = 'display: none !important;';
            $scope.qry = '';
            $scope.qrx = 'display: none;';
            $scope.colsize = '9';
        }
        else {
            $scope.ad_display = '';
            $scope.qrx = '';
            $scope.qry = 'display: none;';
            $scope.colsize = '6';
            $scope.ad_image = (typeof response.ad_image != 'undefined') ? response.ad_image : '/images/ads.jpg';
        }
    });

    $scope.updateBroadcastPage = (function(response) {
        $scope.announceNumber(response, 'rank1', 'box1', 'name1');
        $scope.announceNumber(response, 'rank2', 'box2', 'name2');
        $scope.announceNumber(response, 'rank3', 'box3', 'name3');
        $scope.announceNumber(response, 'rank4', 'box4', 'name4');
        $scope.announceNumber(response, 'rank5', 'box5', 'name5');
        $scope.announceNumber(response, 'rank6', 'box6', 'name6');

        $scope.announceNumberFromBlank(response, 'box1', 'rank1');
        $scope.announceNumberFromBlank(response, 'box2', 'rank2');
        $scope.announceNumberFromBlank(response, 'box3', 'rank3');
        $scope.announceNumberFromBlank(response, 'box4', 'rank4');
        $scope.announceNumberFromBlank(response, 'box5', 'rank5');
        $scope.announceNumberFromBlank(response, 'box6', 'rank6');

        $scope.writeNumber(response, 'box1');
        $scope.writeNumber(response, 'box2');
        $scope.writeNumber(response, 'box3');
        $scope.writeNumber(response, 'box4');
        $scope.writeNumber(response, 'box5');
        $scope.writeNumber(response, 'box6');

        /* RDH Checks if empty, show '-' if yes*/
        $scope.getNum(response);
        $scope.showHideNumbers(response);
        $scope.showInternetTV(response);
        $scope.showHideAds(response);
    });

    $scope.resetNumbers = (function(response) {
        if (response.status == '1') {
            window.location.reload(true);
        }
    });

    $http.get('/json/'+business_id+'.json?nocache='+Math.floor((Math.random() * 10000) + 1)).success($scope.setInternetTV);
    setInterval(function() {
        $http.get('/broadcast/reset-numbers/'+business_id).success($scope.resetNumbers);
        $http.get('/json/'+business_id+'.json?nocache='+Math.floor((Math.random() * 10000) + 1)).success($scope.updateBroadcastPage);
    }, 1000);

});
var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http) {

    var business_id = $('#business-id').attr('business_id');
    var broadcast_type = $('#broadcast-type').attr('broadcast_type');
    var ad_type = $('#ad-type').attr('ad_type');
    var carousel_delay = $('#fqCarousel').attr('data-interval');
    var live_ticker = $('.marquee-text').text();

  //open a web socket connection
  websocket = new WebSocket(websocket_url);
  websocket.onopen = function(response) { // connection is open
    $http.get('/json/' + business_id + '.json?nocache=' + Math.floor((Math.random() * 10000) + 1)).success($scope.updateBroadcastPage);
    websocket.send(JSON.stringify({
      business_id : business_id,
      broadcast_update : false
    }));
    $('#WebsocketLoaderModal').modal('hide');
  }
  websocket.onmessage = function(response) { // what happens when data is received
    var result = JSON.parse(response.data);
    if (result.broadcast_update) {
      $http.get('/json/' + business_id + '.json?nocache=' + Math.floor((Math.random() * 10000) + 1)).success($scope.updateBroadcastPage);
    }
  };
  websocket.onerror	= function(response){
    $('#WebsocketLoaderModal img').attr('src', '/img/stop.png');
    $('.socket-info').text('Your connection has timed out. Please refresh the page to re-connect.');
    $('#WebsocketLoaderModal').modal('show');
  };
  websocket.onclose 	= function(response){
    $('#WebsocketLoaderModal img').attr('src', '/img/stop.png');
    $('.socket-info').text('Your connection has timed out. Please refresh the page to re-connect.');
    $('#WebsocketLoaderModal').modal('show');
  };

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

            // update the json so that the hidden called numbers will show if the number of boxes changed
            if (broadcast_type != response.display) {
              $http.get('/processqueue/update-broadcast').success(function(response) {
                window.location.reload(true);
              });
            }
            else {
              window.location.reload(true);
            }

        }
    });

    $scope.updateBroadcastPage = (function(response) {
        $scope.refreshOnSettingsChange(response);

      $scope.announceNumber(response, 'rank1', 'box1', 'name1');
      $scope.announceNumber(response, 'rank2', 'box2', 'name2');
      $scope.announceNumber(response, 'rank3', 'box3', 'name3');
      $scope.announceNumber(response, 'rank4', 'box4', 'name4');
      $scope.announceNumber(response, 'rank5', 'box5', 'name5');
      $scope.announceNumber(response, 'rank6', 'box6', 'name6');
      $scope.announceNumber(response, 'rank7', 'box7', 'name7');
      $scope.announceNumber(response, 'rank8', 'box8', 'name8');
      $scope.announceNumber(response, 'rank9', 'box9', 'name9');
      $scope.announceNumber(response, 'rank10', 'box10', 'name10');

      $scope.announceNumberFromBlank(response, 'box1', 'rank1');
      $scope.announceNumberFromBlank(response, 'box2', 'rank2');
      $scope.announceNumberFromBlank(response, 'box3', 'rank3');
      $scope.announceNumberFromBlank(response, 'box4', 'rank4');
      $scope.announceNumberFromBlank(response, 'box5', 'rank5');
      $scope.announceNumberFromBlank(response, 'box6', 'rank6');
      $scope.announceNumberFromBlank(response, 'box7', 'rank7');
      $scope.announceNumberFromBlank(response, 'box8', 'rank8');
      $scope.announceNumberFromBlank(response, 'box9', 'rank9');
      $scope.announceNumberFromBlank(response, 'box10', 'rank10');

      $scope.writeNumber(response, 'box1');
      $scope.writeNumber(response, 'box2');
      $scope.writeNumber(response, 'box3');
      $scope.writeNumber(response, 'box4');
      $scope.writeNumber(response, 'box5');
      $scope.writeNumber(response, 'box6');
      $scope.writeNumber(response, 'box7');
      $scope.writeNumber(response, 'box8');
      $scope.writeNumber(response, 'box9');
      $scope.writeNumber(response, 'box10');
    });

    $scope.resetNumbers = (function(response) {
        if (response.status == '1') {
            window.location.reload(true);
        }
    });
});
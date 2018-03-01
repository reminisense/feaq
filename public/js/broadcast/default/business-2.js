var app = angular.module('BusinessBroadcast', []);

app.controller('nowServingCtrl', function($scope, $http) {

  establishSocketConnection($scope, $http, business_id);

  $scope.updateBroadcastPage = (function(response) {
    var percentage_val = $('#percentage').attr('percentage');
    if (typeof sessionStorage.service_id != "undefined" && sessionStorage.service_id != "0") {
      response = response["services"][sessionStorage.service_id];
      $('#callednums-title').text(sessionStorage.service_name);
      $('.wrap-nums .service').hide();
      $('#business-queue-now').hide();
      $('#service-queue-now').show();
      $('#broadcast-spec').attr('class', sessionStorage.broadcast_spec);
      if (percentage_val == '20' || percentage_val == '50') {
        $('#parent-num-spec').attr('class', 'parent-num two-nums');
      }
    }
    else if (typeof sessionStorage.terminal_id != "undefined" && sessionStorage.terminal_id != "0") {
      response = response["terminals"][sessionStorage.terminal_id];
      $('#callednums-title').text(sessionStorage.service_name + " - " + sessionStorage.terminal_name);
      $('.wrap-nums .service').hide();
      $('.wrap-nums .terminal').hide();
      $('#business-queue-now').hide();
      $('#service-queue-now').show();
      $('#broadcast-spec').attr('class', sessionStorage.broadcast_spec);
      if (percentage_val == '20') {
        $('#parent-num-spec').attr('class', 'parent-num two-nums');
      }
    }
    else {
      if (percentage_val == '20' || percentage_val == '40' || percentage_val == '50') {
        $('#parent-num-spec').attr('class', 'parent-num two-nums');
      }
    }
    console.log(response);

    announceNumber($scope, response, 'rank1', 'box1', 'name1', 'service1', 'color1', 'user1');
    announceNumber($scope, response, 'rank2', 'box2', 'name2', 'service2', 'color2', 'user2');

    announceNumberFromBlank($scope, response, 'box1', 'rank1');
    announceNumberFromBlank($scope, response, 'box2', 'rank2');

    writeNumber($scope, response, 'box1', 'service1', 'user1', 'color1');
    writeNumber($scope, response, 'box2', 'service2', 'user2', 'color2');

    writeQueueNow($scope, response);
  });
});
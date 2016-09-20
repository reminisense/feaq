var business_id = $('#business-id').attr('business_id');

var callNumberSound = function (soundobj) {
  var thissound = document.getElementById(soundobj);
  thissound.play();
};

var announceNumber = function ($scope, response, rank_num, box_num, name_num, service_num, color_num, user_num) {
  if (typeof response[box_num] != 'undefined') {
    if ($scope[rank_num] != response[box_num].rank) {
      $scope[rank_num] = response[box_num].rank;
      $scope[name_num] = response[box_num].terminal;
      $scope[service_num] = response[box_num].service;
      $scope[color_num] = response[box_num].color;
      $scope[user_num] = response[box_num].user;
      if ($scope[rank_num] != "") {
        callNumberSound('call-number-sound');
      }
    }
  }
};

var announceNumberFromBlank = function ($scope, response, box_num, rank_num) {
  if (typeof response[box_num] != 'undefined') {
    if ($scope[box_num] != response[box_num].number && $scope[rank_num] != "") {
      callNumberSound('call-number-sound');
    }
  }
};

var writeNumber = function ($scope, response, box_num, service_num, user_num, color_num) {
  if (typeof response[box_num] != 'undefined') {
    $scope[box_num] = response[box_num].number;
    $scope[service_num] = response[box_num].service;
    $scope[user_num] = response[box_num].user;
    $scope[color_num] = response[box_num].color;
  }
};

var writeQueueNow = function ($scope, response, service_id, queue_now_num, on_standby_num) {
  if (typeof response["services"][service_id]["queue_now"][queue_now_num] != 'undefined') {
    $scope["queue_now"][queue_now_num] = response["services"][service_id]["queue_now"][queue_now_num].number;
    $scope["queue_now"][on_standby_num] = response["services"][service_id]["queue_now"][queue_now_num].on_standby;
  }
};

var getNum = function($scope, response) {
  $scope.get_num = (response.get_num === "") ? "-": response.get_num;
}
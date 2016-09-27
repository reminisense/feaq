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

var writeQueueNow = function ($scope, response) {
  $scope.queue_now_services = [];
  if ((typeof sessionStorage.service_id != "undefined" && sessionStorage.service_id != "0")
    || (typeof sessionStorage.terminal_id != "undefined" && sessionStorage.terminal_id != "0")) {
    $scope.queue_now_nums = [];
    for (var queue_now_num in response["queue_now"]) {
      $scope.queue_now_nums.push(response["queue_now"][queue_now_num].number);
    }
    $scope.queue_now_services.push($scope.queue_now_nums);
  }
  else {
    for (var service_id in response["services"]) {
      $scope.queue_now_nums = [];
      for (var queue_now_num in response["services"][service_id]["queue_now"]) {
        $scope.queue_now_nums.push(response["services"][service_id]["queue_now"][queue_now_num].number);
      }
      $scope.queue_now_services.push($scope.queue_now_nums);
    }
  }
};

var getNum = function($scope, response) {
  $scope.get_num = (response.get_num === "") ? "-": response.get_num;
}
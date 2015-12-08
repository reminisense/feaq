var business_id = $('#business-id').attr('business_id');

var callNumberSound = function (soundobj) {
  var thissound = document.getElementById(soundobj);
  thissound.play();
};

var announceNumber = function ($scope, response, rank_num, box_num, name_num, service_num) {
  if (typeof response[box_num] != 'undefined') {
    if ($scope[rank_num] != response[box_num].rank) {
      $scope[rank_num] = response[box_num].rank;
      $scope[name_num] = response[box_num].terminal;
      $scope[service_num] = response[box_num].service;
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

var writeNumber = function ($scope, response, box_num) {
  if (typeof response[box_num] != 'undefined') {
    $scope[box_num] = response[box_num].number;
  }
};

var getNum = function($scope, response) {
  $scope.get_num = (response.get_num === "") ? "-": response.get_num;
}
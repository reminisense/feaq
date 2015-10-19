var business_id = $('#business-id').attr('business_id');
var adspace_size = $('#adspace-size').attr('adspace_size');
var broadcast_type = $('#broadcast-type').attr('broadcast_type');
var ad_type = $('#ad-type').attr('ad_type');
var carousel_delay = $('#fqCarousel').attr('data-interval');
var live_ticker = $('.marquee-text').text();

// check if carousel delay is existing but check if it's for image advertisements first
var carouselDelayChecker = function(broadcast_type, current_delay, response_delay) {
  if (broadcast_type.search('1-') != '-1') {
    if (typeof response_delay == "undefined") {
      response_delay = "5000";
    }
  }
  else {
    current_delay = '';
    response_delay = '';
  }
  return [current_delay, response_delay];
};

// check if ticker messages are existing
var checkTickerMessages = function(response_ticker) {
  if (typeof response_ticker == "undefined" || response_ticker == null) {
    return "";
  }
  else {
    return response_ticker;
  }
};

// concatinate all ticker messages for update comparison
var totalTickerMessages = function(response) {
  var ticker_message = checkTickerMessages(response.ticker_message);
  var ticker_message2 = checkTickerMessages(response.ticker_message2);
  var ticker_message3 = checkTickerMessages(response.ticker_message3);
  var ticker_message4 = checkTickerMessages(response.ticker_message4);
  var ticker_message5 = checkTickerMessages(response.ticker_message5);
  return ticker_message + ticker_message2 + ticker_message3 + ticker_message4 + ticker_message5;
};

// check if the current attributes in the template are the same with the response. reload if not.
var reloadPage = function(broadcast_type, ad_type, carousel_delay, live_ticker, response) {
  var total_ticker = totalTickerMessages(response);
  if (broadcast_type != response.display || ad_type != response.ad_type  || carousel_delay != response.carousel_delay
    || adspace_size != response.adspace_size || live_ticker != total_ticker) {
    window.location.reload(true);
  }
};

var refreshOnSettingsChange = function(broadcast_type, ad_type, carousel_delay, live_ticker, response) {
  var delay_values = carouselDelayChecker(broadcast_type, carousel_delay, response.carousel_delay);
  carousel_delay = delay_values[0];
  response.carousel_delay = delay_values[1];
  reloadPage(broadcast_type, ad_type, carousel_delay, live_ticker, response);
};

var callNumberSound = function (soundobj) {
  var thissound = document.getElementById(soundobj);
  thissound.play();
};

var announceNumber = function ($scope, response, rank_num, box_num, name_num) {
  if (typeof response[box_num] != 'undefined') {
    if ($scope[rank_num] != response[box_num].rank) {
      $scope[rank_num] = response[box_num].rank;
      $scope[name_num] = response[box_num].terminal;
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
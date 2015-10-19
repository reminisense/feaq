var app = angular.module('PublicBroadcast', ['Facebook']);

app.controller('nowServingCtrl', function($scope, $http) {

  establishSocketConnection($scope, $http, business_id);

  $scope.updateBroadcastPage = (function(response) {
    refreshOnSettingsChange(broadcast_type, ad_type, carousel_delay, live_ticker, response);

    announceNumber($scope, response, 'rank1', 'box1', 'name1');

    announceNumberFromBlank($scope, response, 'box1', 'rank1');

    writeNumber($scope, response, 'box1');

    /* RDH Checks if empty, show '-' if yes*/
    getNum($scope, response);
  });

});

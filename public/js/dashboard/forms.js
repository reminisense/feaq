/**
 * Created by Polljii143 on 6/28/16.
 */

/**
 * Created by polljii on 7/28/15.
 */

(function() {

  app.controller('formsController', function($scope, $http) {

    $scope.viewForm = function (form_id) {
      $http.get('/forms/view-form/' + form_id).success(function (response) {
        $scope.fields = response.fields;
        $scope.service_name = response.service_name;
        $scope.form_name = response.form_name;
        $scope.records = response.records;
      });
    };

    $scope.searchUserRecords = function (form_id, keyword) {
      $http.get('/records/search-records/' + form_id + '/' + keyword).success(function (response) {
        $scope.fields = response.fields;
        $scope.service_name = response.service_name;
        $scope.form_name = response.form_name;
        $scope.records = response.records;
      });
    };

  });

})();
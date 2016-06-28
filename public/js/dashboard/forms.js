/**
 * Created by Polljii143 on 6/28/16.
 */

/**
 * Created by polljii on 7/28/15.
 */

(function() {

  app.controller('formsController', function($scope, $http) {

    $scope.viewForm = function () {
      $http.post('/forms/view-form').success(function (response) {
        $scope.fields = response.fields;
        $scope.service_name = response.service_name;
        $scope.form_name = response.form_name;
        $scope.records = response.records;
      });
    };

    $scope.searchUserRecords = function () {
      $http.post('/records/search-records').success(function (response) {
        $scope.fields = response.fields;
        $scope.service_name = response.service_name;
        $scope.form_name = response.form_name;
        $scope.records = response.records;
      });
    };

    $scope.viewRecord = function (record_id) {
      $http.get('/records/view-user/' + record_id).success(function (response) {
        $scope.fields = response.fields;
        $scope.service_name = response.service_name;
        $scope.form_name = response.form_name;
        $scope.form_data = response.form_data;
        $scope.transaction_number = $scope.transaction_number;
      });
    };

  });

})();
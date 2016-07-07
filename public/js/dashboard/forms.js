/**
 * Created by Polljii143 on 6/28/16.
 */

/**
 * Created by polljii on 7/28/15.
 */

(function() {

  app.controller('formsController', function($scope, $http) {

      $scope.services = [];
      $scope.forms = [];

    $scope.viewForm = function (form_id) {
      $http.get('/forms/view-form/' + form_id).success(function (response) {
        $scope.fields = response.fields;
        $scope.service_name = response.service_name;
        $scope.form_name = response.form_name;
        $scope.records = response.records;
        console.log($scope.form_name);
        console.log($scope.service_name);
        console.log($scope.fields);
        console.log($scope.records);
      });
    };

    $scope.searchUserRecords = function (form_id, keyword) {
      $http.get('/records/search-records/' + form_id + '/' + keyword).success(function (response) {
        console.log(keyword);
        $scope.records = response;
        console.log($scope.records);
      });
    };

    $scope.viewRecord = function (record_id) {
      $http.get('/records/view-user/' + record_id).success(function (response) {
        $scope.fields = response.fields;
        $scope.service_name = response.service_name;
        $scope.form_name = response.form_name;
        $scope.form_data = response.form_data;
        $scope.transaction_number = response.transaction_number;
        console.log($scope.service_name);
        console.log($scope.form_name);
        console.log($scope.transaction_number);
        console.log($scope.fields);
        console.log($scope.form_data);
      });
    };

      $scope.getServices = function (business_id){
          $http.get('/services/business/' + business_id).success(function (response) {
              $scope.services = response.business_services[0];
          });
      };

      $scope.getForms = function(business_id) {
          $http.get('/forms/display-forms/' + business_id).success(function(response) {
              $scope.forms = response.forms;
          });
      };

      $scope.displayForms = function(input){
          var business_id = $('#business_id').val();

          if(input == 0){
              $scope.displayBusinessForms(business_id);
          }else if(typeof input == 'number' ){
              $scope.displayServiceForms(input);
          }else if (isNaN(input)){
              var val = $('#filter-forms').val();
              $scope.displayFilteredForms(input, val, business_id);
          }
      }

      $scope.getForms($('#business_id').val());
      $scope.getServices($('#business_id').val());

  });

})();
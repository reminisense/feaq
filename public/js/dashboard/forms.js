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
      $scope.fields = [];
      $scope.dropdowns = [];

    $scope.viewForm = function (form_id) {
      $scope.formFields = '';
      $http.get('/forms/view-form/' + form_id).success(function (response) {
        var formFields = response.fields;
        $scope.service_name = response.service_name;
        $scope.formName = response.form_name;
        $scope.records = response.records;
        for (var i = 0; i < formFields.length; i++) {
          var formLabel = formFields[i].field_data.label;
          var fieldType = formFields[i].field_type;
          var ngModelVar = formLabel.toLowerCase().replace(/\s+/g, '');
          if (fieldType == 'radio') {
            $scope.formFields += '<div class="entry clearfix"><div class="col-md-6 col-sm-6 col-xs-12">' +
              formLabel +
              '</div><div class="col-md-6 col-sm-6 col-xs-10"><span><input type="radio" name="' +
              ngModelVar +
              '" value="' + formFields[i].field_data.value_a +
              '"> ' +
              formFields[i].field_data.value_a +
              '</span> <span><input type="radio" name="' +
              ngModelVar +
              '" value="' + formFields[i].field_data.value_b +
              '"> ' +
              formFields[i].field_data.value_b +
              '</span></div></div>';
          }
          else if (fieldType == 'textfield') {
            $scope.formFields += '<div class="entry clearfix"><div class="col-md-6 col-sm-6 col-xs-12">' +
              formLabel +
              '</div><div class="col-md-6 col-sm-6 col-xs-10"><input class="form-control" type="text" id="' +
              ngModelVar +
              '"></div></div>';
          }
          else if (fieldType == 'checkbox') {
            $scope.formFields += '<div class="entry clearfix"><div class="col-md-6 col-sm-6 col-xs-12">' +
              formLabel +
              '</div><div class="col-md-6 col-sm-6 col-xs-10"><input type="checkbox" id="' +
              ngModelVar +
              '"></div></div>';
          }
          else if (fieldType == 'dropdown') {
            var selectOptions = '';
            for (var optionVal in formFields[i].field_data.options) {
              selectOptions += '<option value="' + optionVal + '">' + optionVal + '</option>';
            }
            $scope.formFields += '<div class="entry clearfix"><div class="col-md-6 col-sm-6 col-xs-12">' +
              formLabel +
              '</div><div class="col-md-6 col-sm-6 col-xs-10"><select class="form-control" id="' +
              ngModelVar +
              '">' +
              selectOptions +
              '</select></div></div>';
          }
        }
        $('#form-fields-html').html($scope.formFields);
        console.log($scope.formName);
        console.log($scope.service_name);
        console.log(formFields);
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
        // $scope.fields = response.fields;
        // $scope.service_name = response.service_name;
        // $scope.form_name = response.form_name;
        var formData = response.form_data.form_data;
        $.each(formData, function(key, val) {
          $('#' + key).val(val); // textfield and select default
          $('input:radio[name=' + key + ']').filter('[value=' + val + ']').prop('checked', true); // radio default
          if (val == 1) { // checkbox default
            $('#' + key).prop('checked', true);
          }
          else {
            $('#' + key).prop('checked', false);
          }
        });
        $scope.fullName = response.full_name;
        $scope.transactionNumber = response.transaction_number;
        $scope.priorityNumber = response.transaction_history.priority_number;
        $scope.transactionDate = response.transaction_history.date;
        $scope.userEmail = response.transaction_history.email;
        $scope.timeCalled = response.transaction_history.time_called;
        $scope.timeCompleted = response.transaction_history.time_completed;
        $scope.timeQueued = response.transaction_history.time_queued;
        // console.log($scope.service_name);
        // console.log($scope.form_name);
        console.log($scope.transactionNumber);
        // console.log($scope.fields);
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

      $scope.createForm = function(){

          var service_id =  $('#select-service').val();
          var form_name = $('#form-name').val();

          if( form_name==""){
              $scope.error_message = "Please enter a valid name."
              $('#form-error').fadeIn();
              $('#form-error').fadeOut(4000);
          }else if(service_id==null){
              $scope.error_message = "Please select a service."
              $('#form-error').fadeIn();
              $('#form-error').fadeOut(4000);
          }else{
              $http.post('/forms/save-form',{
                  service_id: service_id,
                  name: form_name,
                  fields: $scope.fields
              }).success(function(){
                  $('#form-success').fadeIn();
                  $('#form-success').fadeOut(4000);
                  $scope.fields = [];
                  $('#select-service').val(0);
                  $('#form-name').val();

              });
          }
      }

      $scope.addField = function(){
          var field = $("#option-field").val();
          var field_name = $("#for-label").val();

          if (field != 0 && field_name != ""    ){
              if(field == 'checkbox' || field=='textfield'){
                  $scope.fields.push({
                      field_type: field,
                      field_data: {
                          label: field_name
                      }
                  });
              }else if(field == "radio"){

                  var value_a = $("#value_a").val();
                  var value_b = $("#value_b").val();

                  $scope.fields.push({
                      field_type: field,
                      field_data: {
                          label: field_name,
                          value_a: value_a,
                          value_b: value_b
                      }
                  });

              }else if(field == 'dropdown'){

                  var options = {};

                  for(var i=0; i<=$scope.dropdowns.length; i++){
                      var name = $('#dropdown-'+i).val();
                      options[name] = name;
                  }

                  $scope.fields.push({
                      field_type: field,
                      field_data: {
                          label: field_name,
                          options: options
                      }
                  });
              }

              $scope.dropdowns =[];
              $('#for-label').val('');
              $('#option-field').val(0);
              $("#value_a").val();
              $("#value_b").val();
              $("#dropdown-0").val();
              $('#radio-options').hide();
              $('#dropdown-options').hide();
          }
      }

      $scope.deleteField = function(label){
          $( "#"+label ).remove();
          for(var i=0; i<$scope.fields.length; i++){
              if(label == $scope.fields[i].field_data.label){
                  $scope.fields.splice(i, 1)
                  break;
              }
          }
      }

      $scope.addDropdown = function(){
          $scope.dropdowns.push({
             number_of_options : $scope.dropdowns.length + 1
          });

      }

      $scope.getForms($('#business_id').val());
      $scope.getServices($('#business_id').val());

  });

})();
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
      $scope.records=[];
      $scope.filtered_records=[]; //added for filtering

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
          var id = form_id+'_'+i;
          if (fieldType == 'radio') {
            $scope.formFields += '<div class="entry clearfix"><div class="col-md-6 col-sm-6 col-xs-12">' +
              formLabel +
              '</div><div class="col-md-6 col-sm-6 col-xs-10"><span><input disabled type="radio" name="' +
            id +
              '" value="' + formFields[i].field_data.value_a +
              '"> ' +
              formFields[i].field_data.value_a +
              '</span> <span><input disabled type="radio" name="' +
            id +
              '" value="' + formFields[i].field_data.value_b +
              '"> ' +
              formFields[i].field_data.value_b +
              '</span></div></div>';
          }
          else if (fieldType == 'textfield') {
            $scope.formFields += '<div class="entry clearfix"><div class="col-md-6 col-sm-6 col-xs-12">' +
              formLabel +
              '</div><div class="col-md-6 col-sm-6 col-xs-10"><input disabled class="form-control" type="text" id="' +
            id +
              '"></div></div>';
          }
          else if (fieldType == 'checkbox') {
            $scope.formFields += '<div class="entry clearfix"><div class="col-md-6 col-sm-6 col-xs-12">' +
              formLabel +
              '</div><div class="col-md-6 col-sm-6 col-xs-10"><input disabled type="checkbox" id="' +
            id +
              '"></div></div>';
          }
          else if (fieldType == 'dropdown') {
            var selectOptions = '<option value="0">Select an option.</option>';
            for (var optionVal in formFields[i].field_data.options) {
              selectOptions += '<option value="' + optionVal + '">' + optionVal + '</option>';
            }
            $scope.formFields += '<div class="entry clearfix"><div class="col-md-6 col-sm-6 col-xs-12">' +
              formLabel +
              '</div><div class="col-md-6 col-sm-6 col-xs-10"><select disabled class="form-control" id="' +
            id +
              '">' +
              selectOptions +
              '</select></div></div>';
          }
        }

        $('#form-fields-html').html($scope.formFields);
          $('#business-form-tabs-table').hide();
          $('#business-forms-tabs').hide();
          $('.create-form-wrap').hide();
          $('.view-form-wrap').fadeIn();
          $('.table-view-signups').fadeIn();
      });
    };

    $scope.searchUserRecords = function () {
        $scope.filtered_records = [];
        $scope.err_search =  '';
        var option = $('#record-option').val();

        if(option == 'all'){
            $scope.filtered_records =[];
            $scope.err_search =  '';
        }else if(option == 'name'){
            var name = $('#record-name').val();
            for(i = 0; i< $scope.records.length; i++){
                if($scope.records[i].full_name.toLowerCase().indexOf(name.toLowerCase()) > -1){
                    $scope.filtered_records.push($scope.records[i]);
                }
            }
            $scope.err_search = $scope.filtered_records.length ? '':'No matches found.';
        }else if(option == 'date'){
            var date = $('#record-datepicker').val();

            for(i = 0; i< $scope.records.length; i++) {
                var cur_date = new Date($scope.records[i].date);
                var formatted_ = ('0' + (cur_date.getMonth()+1)).slice(-2)+'/'+('0' + cur_date.getDate()).slice(-2)+'/'+cur_date.getFullYear()
               if(formatted_ == date){
                   $scope.filtered_records.push($scope.records[i]);
               }
            }
            $scope.err_search = $scope.filtered_records.length ? '':'No matches found.';
        }


    };

    $scope.viewRecord = function (record_id) {
      $http.get('/records/view-user/' + record_id).success(function (response) {
        var formData = response.form_data.form_data;
          var i = 0;;
        $.each(formData, function(key, val) {
          var id = response.form_id + '_' +i;
          val.length == undefined ?   $('#' + id + ':input').val('N/A') :   $('#' + id + ':input').val(val);
          $('input:radio[name=' + id + ']').filter('[value="' + val + '"]').prop('checked', true); // radio default
          if (val == "Yes") { // checkbox default
            $('#' + id).prop('checked', true);
          }
          else {
            $('#' + id).prop('checked', false);
          }
            i++;
        });

        $scope.fullName = response.full_name;
        $scope.transactionNumber = response.transaction_number;
        $scope.priorityNumber = response.transaction_history.priority_number;
        $scope.transactionDate =  getDate(response.transaction_history.date);
        $scope.userEmail = response.transaction_history.email;
        $scope.timeCalled = response.transaction_history.time_called ? getTime(response.transaction_history.time_called) : "Not Called";
        $scope.timeCompleted = response.transaction_history.time_completed ? getTime(response.transaction_history.time_completed) : "Not Completed";
        $scope.timeQueued = getTime(response.transaction_history.time_queued);

        $('html, body').animate({
          scrollTop: $("#forms").offset().top
        }, 100);

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
          }else if($scope.fields.length == 0) {
              $scope.error_message = "Forms cannot be empty."
              $('#form-error').fadeIn();
              $('#form-error').fadeOut(4000);
          }else{
              $http.post('/forms/save-form',{
                  service_id: service_id,
                  name: form_name,
                  fields: $scope.fields
              }).success(function(response){
                  $('#form-success').fadeIn();
                  $('#form-success').fadeOut(4000);
                  $scope.fields = [];
                  $('#select-service').val(0);
                  $('#form-name').val('');
                  $scope.getForms($('#business_id').val());
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
              $("#value_a").val('');
              $("#value_b").val('');
              $("#dropdown-0").val('');
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

      $scope.saveFormStatus = function(form_id){
          var status=0;
          if ($('#status'+form_id).is(':checked')) {
              status=1;
          }
          $http.post('/forms/save-status',{
              status: status,
              form_id: form_id
          });
      }

      $scope.clearForms = function(){
          $('#form-fields-html').empty();
          $scope.fullName = "";
          $scope.transactionNumber = "";
          $scope.priorityNumber = "";
          $scope.transactionDate = "";
          $scope.userEmail = "";
          $scope.timeCalled = "";
          $scope.timeCompleted = "";
          $scope.timeQueued = "";
      }

      getDate = function(timestamp){

          var value = new Date(timestamp * 1000);
          var month = ['January', 'February',
          'March', 'April', 'May', 'June',
          'July', 'August', 'September',
          'October', 'November', 'December']

          var date =  month[value.getMonth()]+' '+value.getDay()+', '+value.getFullYear();

          return date;

      }

      getTime = function(timestamp){

          var value = new Date(timestamp * 1000);

          if(value.getHours() >= 12){
              var ampm = 'PM';
          }else{
              var ampm = 'AM';
          }

          if(value.getHours() < 10){
              var hours = '0'+value.getHours();
          }else if (value.getHours() > 12) {
              var hours = value.getHours() - 12;
          }else{
              var hours = value.getHours();
          }

          if(value.getMinutes() < 10){
              var minutes = '0'+value.getMinutes();
          }else{
              var minutes = value.getMinutes();
          }

          var time = hours+':'+minutes+' '+ampm;

          return time;
      }

      $scope.getForms($('#business_id').val());
      $scope.getServices($('#business_id').val());

  });

})();
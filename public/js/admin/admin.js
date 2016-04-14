/**
 * Created by USER on 6/2/15.
 */
app.requires.push('angular-loading-bar'); //add angular loading bar
app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
}]);
app.controller('adminController', function($scope, $http){

    $(".datepicker").datepicker();
    $(".datepicker").datepicker('setDate', new Date());

    $scope.user_id = $('#user_id').val();
    $scope.admins = [];
    $scope.keyword = 'page_url';
    $scope.keywords = [
        {keyword: 'page_url',           name: 'Page Views'},
        {keyword: 'broadcast',          name: 'Business Broadcast Pages'},
        {keyword: 'industry',           name: 'Business Industry'},
        {keyword: 'local_address',      name: 'Business Location'},
        {keyword: 'geolocation',        name: 'Geolocation'},
        {keyword: 'issued',             name: 'Queued in Business'},
        {keyword: 'called',             name: 'Called in Business'},
        {keyword: 'served',             name: 'Served in Business'},
        {keyword: 'dropped',            name: 'Dropped in Business'},
        {keyword: 'browser',            name: 'Browser'},
        {keyword: 'operating_system',   name: 'Operating System'},
        {keyword: 'ip_address',         name: 'IP Address'},
        {keyword: 'screen_size',        name: 'Screen Size'}
    ]


    $scope.temp_start_date = "";
    $scope.temp_end_date = "";
    $scope.start_date = 0;
    $scope.end_date = 0;

    $scope.new_business = 0;
    $scope.new_users = 0;
    $scope.business_information = [];
    $scope.users_information = [];
    $scope.issued_numbers = 0;
    $scope.called_numbers = 0;
    $scope.served_numbers = 0;
    $scope.dropped_numbers = 0;

    $scope.checked = false;

    $scope.issued_data = [];
    $scope.issued = [];
    $scope.called = [];
    $scope.served = [];
    $scope.dropped = [];

    $scope.all_businesses = [];
    $scope.business_features = {};

    $scope.loadBusinessNumbers = function() {
        $scope.getDate();
        $http.get('/admin/businessnumbers/' +  $scope.start_date + '/' +  $scope.end_date).success(function(response){
            $scope.new_business = response.businesses_count;
            $scope.issued_numbers = response.business_numbers['issued_numbers'];
            $scope.called_numbers = response.business_numbers['called_numbers'];
            $scope.served_numbers = response.business_numbers['served_numbers'];
            $scope.dropped_numbers = response.business_numbers['dropped_numbers'];
            $scope.new_users = response.users_count;
            $scope.users_information = response.users_information;
            $scope.business_information = response.businesses_information;
        });
    }

    $scope.loadBusinesses = function() {
        $http.get('/admin/allbusinesses').success(function(response){
            $scope.all_businesses = response.businesses; //ARA add all businesses to scope
            for (var i = 0; i < response.businesses.length; i++) {
                $("#business-dropdown").append("<option value="+i+">"+response.businesses[i].name+"</option>")
            }
        });
    }

    $scope.loadGraph = function(mode){

        $scope.issued_data = [];
        $scope.issued = [];
        $scope.called = [];
        $scope.served = [];
        $scope.dropped = [];

        $scope.getDate();
        var value = $scope.getValue(mode);
        $http.get('/admin/processnumbers/' + $scope.start_date + '/' + $scope.end_date + '/' + mode + '/' + value)
            .success(function(response){
                console.log(response);
                var temp_time_i = new Date($scope.start_date *1000);

                for(a in response.issued_numbers){

                    var month = ('0' + (temp_time_i.getMonth()+ 1)).slice(-2);
                    var day = ('0' + temp_time_i.getDate()).slice(-2);
                    var year = temp_time_i.getFullYear();

                    $scope.issued.push({ Date: year+"-"+month+"-"+day, Value: response.issued_numbers[a]});
                    $scope.issued_data.push({ Date: year+"-"+month+"-"+day, Value: response.issued_numbers[a], Value2: response.issued_numbers_data[a]});
                    $scope.called.push({ Date: year+"-"+month+"-"+day, Value: response.called_numbers[a]});
                    $scope.served.push({ Date: year+"-"+month+"-"+day, Value: response.served_numbers[a]});
                    $scope.dropped.push({ Date: year+"-"+month+"-"+day, Value: response.dropped_numbers[a]});
                    temp_time_i.setDate( temp_time_i.getDate() + 1);
                }

                if($('#issued-container').hasClass("active")){
                    $scope.generateChart(1);
                }else if($('#called-container').hasClass("active")){
                    $scope.generateChart(2);
                }else if($('#served-container').hasClass("active")){
                    $scope.generateChart(3);
                }else if($('#dropped-container').hasClass("active")){
                    $scope.generateChart(4);
                }
            });
    }

    $scope.issuedData = function(){

        if($scope.issued.length != 0){
            if($scope.checked){
                $scope.generateChart(5)
            }else{
                $scope.generateChart(1)
            }
        }
    }

    $scope.generateChart = function(option){

        angular.element('#lineIssuedChart').empty();
        angular.element('#lineCalledChart').empty();
        angular.element('#lineServedChart').empty();
        angular.element('#lineDroppedChart').empty();

        if(option == 1 && $scope.issued.length != 0){
            $scope.issuedChart($scope.issued);
        }else if(option == 2 && $scope.called.length != 0){
            $scope.calledChart($scope.called);
        }else if(option == 3 && $scope.served.length != 0){
            $scope.servedChart($scope.served);
        }else if(option == 4 && $scope.dropped.length != 0){
            $scope.droppedChart($scope.dropped);
        }else if(option == 5){
            $scope.issuedChartData($scope.issued_data);
        }
    }

    $scope.issuedChart = function(issued){
        new Morris.Line({
            element: 'lineIssuedChart',
            data: issued,
            xkey: 'Date',
            ykeys: ['Value'],
            labels: ['Issued Numbers']
        });
    }

    $scope.issuedChartData = function(issueddata){
        new Morris.Line({
            element: 'lineIssuedChart',
            data: issueddata,
            xkey: 'Date',
            ykeys: ['Value', 'Value2'],
            labels: ['Issued Numbers', 'Issued Numbers w/ Data']
        });
    }

    $scope.calledChart = function(called){
        new Morris.Line({
            element: 'lineCalledChart',
            data: called,
            xkey: 'Date',
            ykeys: ['Value'],
            labels: ['Called Numbers']
        });

    };

    $scope.servedChart = function(served){
        new Morris.Line({
            element: 'lineServedChart',
            data: served,
            xkey: 'Date',
            ykeys: ['Value'],
            labels: ['Served Numbers']
        });

    };

    $scope.droppedChart = function(dropped){
        new Morris.Line({
            element: 'lineDroppedChart',
            data: dropped,
            xkey: 'Date',
            ykeys: ['Value'],
            labels: ['Dropped Numbers']
        });
    };

    $scope.loadChart = function(){
        angular.element('#statChart').empty();
        $http.get('/watchdog/userdata/' + $scope.keyword + '/' + $scope.user_id)
            .success(function(response){
                var data = [];
                for(x in response.data){
                    data.push({ parameter: x,  value: response.data[x] });
                }
                $scope.createChart(data);
            });
    };

    $scope.createChart = function(data){
        new Morris.Bar({
            // ID of the element in which to draw the chart.
            element: 'statChart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: data,
            // The name of the data record attribute that contains x-values.
            xkey: 'parameter',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Count'],
            axes: false

        });
    };

    $scope.getAdmins = function($event){
        if(typeof $event != 'undefined'){
            $event.preventDefault();
            $($event.target).addClass('glyphicon-refresh-animate');
        }
        $http.get('/admin/admins').success(function(response){
            $scope.admins = response.admins;
            if(typeof $event != 'undefined'){
                $($event.target).removeClass('glyphicon-refresh-animate');
            }
        });
    }

    $scope.addAdmin = function(email){
        $http.get('/admin/add-admin/' + email).success(function(){
            $scope.admin_email = '';
            $scope.getAdmins();
        });
    }

    $scope.removeAdmin = function(email, $event){
        $event.preventDefault();
        if(confirm("Are you sure you want to remove this email?")){
            $http.get('/admin/delete-admin/' + email).success(function(){
                $scope.getAdmins();
            });
        }
    }

    $scope.getDate = function(){
        $scope.temp_start_date = $("#start-date").datepicker({dateFormat: 'dd-mm-yy'}).val();
        $scope.temp_end_date = $("#end-date").datepicker({dateFormat: 'dd-mm-yy'}).val();
        $scope.start_date = new Date($scope.temp_start_date).getTime() / 1000;
        $scope.end_date = new Date($scope.temp_end_date).getTime() / 1000;
    }

    $scope.getValue = function(mode){

        if(mode == "business"){
            return  $("#business-dropdown option:selected").text();
        }else if(mode == "industry"){
            return  $("#industry-dropdown option:selected").text();
        }else if(mode == "country"){
            return  $("#country-dropdown option:selected").text();
        }
    }

    $scope.messages = {
        success_message: '',
        error_message: ''
    };

    $scope.saveBusinessFeatures = function(business_id){
        if(business_id){
            $http.post('/admin/save-features/' + business_id, $scope.business_features).success(function(respose){
                $scope.getBusinessFeatures(business_id);
                $scope.messages.success_message = 'Business features have been saved.';
            }).error(function(response){
                $scope.messages.error_message = 'Something went wrong while submitting your request.';
            }).finally(function(){
                setTimeout(function(){
                    $scope.$apply(function(){
                        $scope.messages.success_message = '';
                        $scope.messages.error_message = '';
                    });
                }, 2000);
            });
        }else{
            $scope.messages.error_message = 'Please select a valid business.';
            setTimeout(function(){
                $scope.$apply(function(){
                    $scope.messages.error_message = '';
                });
            }, 2000);
        }
    }

    $scope.getBusinessFeatures = function(business_id){
        $http.get('/admin/business-features/' + business_id).success(function(response){
            if(response.features){
                $scope.business_features = response.features;
            }
            else{
                $scope.business_features = {
                    terminal_users : 3,
                    allow_sms : "false",
                    queue_forwarding: "false"
                };
            }

        });
    }

    /*
    General Settings
     */
    $scope.searchBusiness = function() {
        $scope.businesses = new Array();
        $http.post('/admin/business-search', {
            "keyword": $scope.business_name
        }).success(function(response) {
            if(response.length){
                for (var i = 0; i < response.length; i++) {
                    $scope.businesses.push({
                        "business_id": response[i].business_id,
                        "business_name": response[i].name
                    });
                }
            }else{
                $('#business-search-error').fadeIn();
                $('#business-search-error').fadeOut(4000);
            }
        });
        $('.biz-results').show();
        $('.biz-specific').hide();
        $('.biz-create').hide();
    };

    $scope.manageBusiness = function(business_id) {
        $http.get('/admin/business-details/' + business_id).success(function(response) {
            $scope.businessObj = response;
            $scope.edit_business_id = response.business_id;
            $scope.edit_name = response.business_name;
            $scope.edit_address = response.business_address;
            $scope.edit_industry = response.industry;
            $scope.edit_timezone = response.timezone;
            $scope.edit_time_open = response.time_open;
            $scope.edit_time_close = response.time_closed;
            $scope.services = response.services;
            $scope.terminals = response.terminals;
            $scope.vanity_url = response.vanity_url;
            $scope.package_type = response.business_features.package_type;
            $scope.max_services = response.business_features.max_services;
            $scope.max_terminals = response.business_features.max_terminals;
            $scope.enable_video_ads = response.business_features.enable_video_ads;
            $scope.upload_size_limit = response.business_features.upload_size_limit;
            $scope.business_owner = response.business_owner;
            $scope.allow_sms = response.business_features.allow_sms;
            $scope.queue_forwarding = response.business_features.queue_forwarding;
            $scope.business_email_address = response.email_address;
        });

        $('.biz-results').hide();
        $('.biz-specific').show();
        $('.biz-create').hide();
    }

    $scope.updateBusiness = function() {
        var data = $scope.businessObj;
        data.business_id = $scope.edit_business_id;
        data.business_name = $scope.edit_name;
        data.business_address = $scope.edit_address;
        data.industry = $scope.edit_industry;
        data.time_open = $scope.edit_time_open;
        data.time_close = $scope.edit_time_close;
        data.timezone = $scope.edit_timezone;
        data.vanity_url = $scope.vanity_url;
        data.business_features.package_type = $scope.package_type;
        data.business_features.max_services = $scope.max_services;
        data.business_features.max_terminals = $scope.max_terminals;
        data.business_features.enable_video_ads = $scope.enable_video_ads;
        data.business_features.upload_size_limit = $scope.upload_size_limit;
        data.business_features.allow_sms = $scope.allow_sms;
        data.business_features.queue_forwarding =  $scope.queue_forwarding;
        $http.post('/admin/update-business', data).success(function(response) {
        });

    }

    $scope.createService = function(name, business_id){;
        if(name != '' && name != undefined) {
            $http.post('/services', {name: name, business_id: business_id}).success(function (response) {
                //$scope.getBusinessDetails();
                //$scope.service_create = false;
                //$scope.new_service_name = '';
                if(response.error == undefined){
                    $scope.manageBusiness(business_id);
                    $("#create-service-inpt").val('');
                }else{
                    $("#add-service-err p").html(response.error);
                    $("#add-service-err").fadeIn();
                    $("#add-service-err").fadeOut(4000);
                }
            });
        }else{
            $("#add-service-err p").html('Service name is not valid.');
        }
    }
    $scope.updateService = function(index, service_id, business_id){
        var name = $('#service-input'+index).val();
        if(name != '' && name != undefined){
            $http.put('/services/' + service_id, {name: name}).success(function(response){
                //$scope.getBusinessDetails();
                //$scope.edit_service_name = '';
                if(response.error == undefined){
                    $("#edt-service-suc"+index).fadeIn();
                    setTimeout(function(){
                        $scope.manageBusiness(business_id);
                        ("#edt-service-suc"+index).fadeOut();
                    },2000);
                }else{
                    $("#edt-service-err"+index +" p").html(response.error);
                    $("#edt-service-err"+index).fadeIn();
                }
            });
        }else{
            //$scope.service_error = 'Service name is not valid.';
            $("#edt-service-err"+ index +" p").html('Service name is not valid.');
        }
    }
    $scope.removeService = function(service_id, business_id){
        var confirmDel = confirm("Are you sure you want to remove this service?");
        if(confirmDel){
            $http.delete('/services/' + service_id).success(function(response){
                $scope.manageBusiness(business_id);
            });
        }
    }

    $scope.createTerminal = function(terminal_name, service_id, business_id){
        if (terminal_name !== "" & terminal_name != undefined){
            $http.post('/terminal/create', {
                business_id : business_id,
                service_id: service_id,
                name : terminal_name
            }).success(function(response){
                if(response.success == undefined){
                    $("#add-terminal-err"+service_id +" p").html("Duplicate terminal name.");
                    $("#add-terminal-err"+service_id).fadeIn();
                    $("#add-terminal-err"+service_id).fadeOut(4000)
                }else{
                    $scope.manageBusiness(business_id);
                }
            });
        } else {
            $("#edt-terminal-err"+service_id +" p").html('Terminal name is not valid.');
        }
    }

    $scope.updateTerminal = function(terminal_id, business_id){
        var terminal_name = $('.edit-terminal[terminal_id=' + terminal_id + ']').val();
        if (terminal_name !== "" & terminal_name != undefined){
            $http.post('/terminal/edit', {
                terminal_id : terminal_id,
                name : terminal_name
            }).success(function(response) {
                if(response.error == undefined){
                    $("#edt-terminal-suc"+terminal_id).fadeIn();
                    setTimeout(function(){
                        $scope.manageBusiness(business_id);
                        $("#edt-terminal-suc"+terminal_id).fadeOut();
                    },2000);
                }else{
                    $("#edt-terminal-err"+terminal_id +" p").html("Duplicate terminal name.");
                    $("#edt-terminal-err"+terminal_id).fadeIn();
                }
            });
        }else{
            $("#edt-terminal-err"+terminal_id +" p").html('Terminal name is not valid.');
        }
    }

    $scope.deleteTerminal = function(terminal_id,business_id) {
        var confirmDel = confirm("Are you sure you want to delete this terminal?");
        if (confirmDel){
            $http.post('/terminal/delete', {
                terminal_id : terminal_id
            }).success(function(response) {
                $scope.manageBusiness(business_id);
            });
        }
    }

    //$scope.getBusinessDetails = function(){
    //    if ( $scope.business_id > 0 ) {
    //        $http.get(eb.urls.business.business_details_url + $scope.business_id)
    //            .success(function(response){
    //                setBusinessFields(response.business);
    //                setBusinessFeatures(response.business.features);
    //            });
    //    }
    //}

    $scope.searchUser = function() {
        var email = $("#user-email").val();
        if(email != '' && email != undefined) {
            $http.get('/user/user-by-email/' + email).success(function (response) {
                console.log(response);
                if(response.status != null){
                    $scope.user_id = response.user_id;
                    $scope.edit_email = response.email;
                    $scope.edit_first_name = response.first_name;
                    $scope.edit_last_name = response.last_name;
                    $scope.edit_mobile = response.phone;
                    $scope.edit_status = response.status;
                    $scope.edit_user_location = response.address;

                    $(".cus-main-form").show();
                    $(".cus-create-form").hide();
                }else{
                    $("#user-search-error").fadeIn();
                    $("#user-search-error").fadeOut(4000);
                }

            });
        }else{
            $("#user-email-error").fadeIn();
            $("#user-email-error").fadeOut(4000);
        }
    };


    $scope.updateUser = function(user_id) {
        $http.post('/admin/update-user', {
            user_id: user_id,
            edit_first_name: $scope.edit_first_name,
            edit_last_name: $scope.edit_last_name,
            edit_mobile: $scope.edit_mobile,
            edit_user_location: $scope.edit_user_location,
            edit_status: $scope.edit_status,
            edit_email: $scope.edit_email
        }).success(function(response) {
            $("#user-update-success").fadeIn();
            $("#user-update-success").fadeOut(4000);
        });
    };

    $scope.createUser = function() {
        if ($scope.new_password == $scope.password_confirm) {
            $http.post('/admin/create-user', {
                email: $scope.create_email,
                password: $scope.new_password,
                password_confirm: $scope.password_confirm
            }).success(function (response) {
                if(response.error != undefined){
                    $scope.create_err = response.error;
                    $("#user-create-error").fadeIn();
                    $("#user-create-error").fadeOut(4000);
                }else{
                    $("#user-create-success").fadeIn();
                    $("#user-create-success").fadeOut(4000);
                }
            });
        }
        else {
            $("#user-password-error").fadeIn();
            $("#user-password-error").fadeOut(4000);
        }
    };
    $scope.resetPass = function(user_id) {
        $http.post('/admin/reset-password', {
            user_id: user_id
        }).success(function(response) {
            alert(response.password);
        });
    }

    $scope.suggested = false;

    $scope.createBusiness = function() {
        $http.post('/admin/create-business', {
            business_name: $scope.new_business_name,
            business_address: $scope.address,
            industry: $scope.industry,
            time_open: $scope.time_open,
            time_close: $scope.time_close,
            email: $scope.email,
            timezone: $scope.timezone,
            suggested: $scope.suggested
        }).success(function(response) {
            if (response.success == 1) {
                $("#biz-create-success").fadeIn();
                $("#biz-create-success").fadeOut(4000);

                $('.create-fields').val('');
            }
            else{
                $("#biz-create-error p").html(response.error);
                $("#biz-create-error").fadeIn();
                $("#biz-create-error").fadeOut(4000);
            }
        });
    }

    $scope.dropdown_businesses = [];

    $scope.fillBusinessFields = function(business_id){
            $('#search-suggest').hide();
            $http.get('/admin/business-details/' + business_id).success(function(response) {
                $scope.new_business_name = response.business_name;
                $scope.address = response.business_address;
                $scope.time_open = response.time_open;
                $scope.time_close = response.time_closed;
                $scope.suggested = true;
                $scope.industry = "";
                $scope.email = "";
                $scope.timezone ="";
            })

    };
    $scope.showDropdown = function(){
        $scope.dropdown_businesses = [];
        $('#search-suggest').show();

    }

    $scope.$watch('new_business_name', function(new_business_name){
        if(!new_business_name || new_business_name == undefined){
            $scope.dropdown_businesses = [];
        }else{
            $http.get('/list/name-search/' + new_business_name).success(function(response){
                $scope.dropdown_businesses = response.keywords;
            });
        }
    });

    $scope.searchBusinessList = function() {
        $scope.businesses_list = new Array();
        $http.post('/admin/business-list-search', {
            "keyword": $scope.business_list_name
        }).success(function(response) {
            if(response.length){
                for (var i = 0; i < response.length; i++) {
                    $scope.businesses_list.push({
                        "business_list_id": response[i].business_list_id,
                        "business_name": response[i].name
                    });
                }
            }else{
                $('#business-list-search-error').fadeIn();
                $('#business-list-search-error').fadeOut(4000);
            }
        });

        $('.biz-list-results').show();
        $('.biz-list-specific').hide();
        $('.biz-list-create').hide();
    };

    $scope.manageBusinessList = function(business_list_id) {
        $http.get('/admin/business-list-details/' + business_list_id).success(function(response) {
            $scope.businesslistObj = response;
            $scope.edit_business_list_id = response.business_list_id;
            $scope.edit_business_list_name = response.name;
            $scope.edit_business_list_address = response.local_address;
            $scope.edit_business_list_email = response.email;
            $scope.edit_business_list_phone = response.phone;
            $scope.edit_business_list_open = response.time_open;
            $scope.edit_business_list_close = response.time_close;

            if(response.deleted_at != '0000-00-00 00:00:00'){
                $('#biz-list-restore-btn').show()
                $('#biz-list-delete-btn').hide()
                $('#biz-list-update-btn').hide()

                $("#edit_business_list_name,#edit_business_list_address" +
                ",#edit_business_list_email, #edit_business_list_phone" +
                ",#edit_business_list_open, #edit_business_list_close").prop("readonly", true);

            }else{
                $('#biz-list-delete-btn').show()
                $('#biz-list-update-btn').show()
                $('#biz-list-restore-btn').hide()

                $("#edit_business_list_name,#edit_business_list_address" +
                ",#edit_business_list_email, #edit_business_list_phone" +
                ",#edit_business_list_open, #edit_business_list_close").prop("readonly", false);
            }

        });

        $('.biz-list-results').hide();
        $('.biz-list-specific').show();
        $('.biz-list-create').hide();
    }

    $scope.updateBusinessList = function() {
        var data = $scope.businesslistObj;
        data.business_list_id = $scope.edit_business_list_id;
        data.name = $scope.edit_business_list_name;
        data.local_address = $scope.edit_business_list_address;
        data.email = $scope.edit_business_list_email;
        data.phone = $scope.edit_business_list_phone;
        data.time_open = $scope.edit_business_list_open ;
        data.time_close = $scope.edit_business_list_close;
        $http.post('/admin/update-business-list', data).success(function(response) {
        });

    }

    $scope.deleteBusinessList = function() {
        var confirmDel = confirm("Are you sure you want to remove this business?");

        if(confirmDel){
            $http.post('/admin/remove-business-list',{
                "business_list_id": $scope.edit_business_list_id
            }).success(function(response){
                $scope.manageBusinessList($scope.edit_business_list_id);

            });
        }

    }

    $scope.restoreBusinessList = function() {
        $http.post('/admin/restore-business-list', {
            "business_list_id": $scope.edit_business_list_id
        }).success(function (response) {
            $scope.manageBusinessList($scope.edit_business_list_id);
        });
    }

    $scope.createBusinessList = function() {
        $http.post('/admin/create-business-list', {
            name: $scope.new_business_list_name,
            local_address: $scope.new_business_list_address,
            email: $scope.new_business_list_email,
            time_open: $scope.new_business_list_open,
            time_close: $scope.new_business_list_close,
            phone: $scope.new_business_list_phone
        }).success(function(response) {
            if (response.success == 1) {
                $("#biz-create-list-success").fadeIn();
                $("#biz-create-list-success").fadeOut(4000);

                $(".biz-list-create").val(' ');
            }
        });
    }


    $("#biz-list-upload-btn").click(function(){
        $("#biz-list-upload-success").fadeIn();
        $("#biz-list-upload-success").fadeOut(4000);
    });


    $("#biz-list-update-btn").click(function(){
        $("#biz-list-details-success").fadeIn();
        $("#biz-list-details-success").fadeOut(4000);
    });

    $("#biz-list-restore-btn").click(function(){
        $("#biz-list-restore-success").fadeIn();
        $("#biz-list-restore-success").fadeOut(4000);
    });

    $("#bbiz-list-delete-btn").click(function(){
        $("#biz-list-delete-success").fadeIn();
        $("#biz-list-delete-success").fadeOut(4000);
    });

    $("#biz-details-btn").click(function(){
        $("#biz-details-success").fadeIn();
        $("#biz-details-success").fadeOut(4000);
    });

    $("#biz-status-btn").click(function(){
        $("#biz-status-success").fadeIn();
        $("#biz-status-success").fadeOut(4000);
    });

    $("#biz-settings-btn").click(function(){
        $("#biz-settings-success").fadeIn();
        $("#biz-settings-success").fadeOut(4000);
    });

    $("#create-business-list").click(function(){
        $(".biz-list-create").show();
        $(".biz-list-results").hide();
        $(".biz-list-specific").hide();
    });

    $(".create-business-button").click(function() {
        $(".biz-create").show();
        $(".biz-results").hide();
        $(".biz-specific").hide();
    });

    $(".create-user-button").click(function() {
        $(".cus-create-form").show();
        $(".cus-main-form").hide();
    });


    $(".biz-main a").click(function() {
        if ($('.biz-main-form').not(':visible')){
            $(".biz-main-form").slideDown("slow");
            $(".biz-service-form").slideUp("slow");
            $(".biz-status-form").slideUp("slow");
            $(".biz-settings-form").slideUp("slow");
        }
    });

    $(".biz-service a").click(function() {
        if ($('.biz-service-form').not(':visible')){
            $(".biz-main-form").slideUp("slow");
            $(".biz-service-form").slideDown("slow");
            $(".biz-status-form").slideUp("slow");
            $(".biz-settings-form").slideUp("slow");
        }
    });

    $(".biz-status a").click(function() {
        if ($('.biz-status-form').not(':visible')) {
            $(".biz-main-form").slideUp("slow");
            $(".biz-service-form").slideUp("slow");
            $(".biz-status-form").slideDown("slow");
            $(".biz-settings-form").slideUp("slow");
        }
    });

    $(".biz-settings a").click(function() {
        if ($('.biz-settings-form').not(':visible')){
            $(".biz-main-form").slideUp("slow");
            $(".biz-service-form").slideUp("slow");
            $(".biz-status-form").slideUp("slow");
            $(".biz-settings-form").slideDown("slow");
        }
    });

    $("#user-settings").click(function(){
        $('.business-container').hide();
        $('.user-container').show();
        $('.business-list-container').hide();
    });

    $('#business-settings').click(function(){
        $('.user-container').hide();
        $('.business-container').show();
        $('.business-list-container').hide();
    });

    $('#business-list-settings').click(function(){
        $('.user-container').hide();
        $('.business-container').hide();
        $('.business-list-container').show();
    });


    $("#graph-nav a").click(function(){
        $(this).tab("show");
    });
    $('#graph-nav a').on('shown.bs.tab', function(event){
        if($('#issued-container').hasClass("active")){
            if($scope.checked){
                $scope.generateChart(5)
            }else{
                $scope.generateChart(1)
            }
        }else if($('#called-container').hasClass("active")){
            $scope.generateChart(2);
        }else if($('#served-container').hasClass("active")){
            $scope.generateChart(3);
        }else if($('#dropped-container').hasClass("active")){
            $scope.generateChart(4);
        }
    });

    $scope.getAdmins();
    $scope.loadBusinessNumbers();
    $scope.loadBusinesses();
});

$('#admin-manage a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
})
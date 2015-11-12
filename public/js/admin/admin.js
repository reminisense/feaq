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
                    queue_forwarding: "false",
                    custom_url: "false"
                };
            }
        });
    }

    //
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
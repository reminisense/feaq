/**
 * Created by USER on 6/2/15.
 */
/**
 * Created by USER on 5/6/15.
 */
app.controller('adminController', function($scope, $http){
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

    $scope.addFeatherQash = function(user_id, amount, description){
        $http.post('/featherqash/add', {
            user_id: user_id,
            amount: amount,
            description: description
        }).success(function(response){
            $scope.getFeatherQashAccount(user_id);
        });
    }

    $scope.userSearch = function(keyword){
        $http.get('/user/search-user/' + keyword).success(function(response){
            $scope.users = response.users;
        });
    }

    $scope.setUserId = function(user_id, first_name, last_name){
        $scope.featherqash_user = first_name + ' ' + last_name;
        $scope.featherqash_user_id = user_id;
        $scope.users = [];
        $scope.getFeatherQashAccount(user_id);
    }

    $scope.getFeatherQashAccount = function(user_id){
        $http.get('/featherqash/account/' + user_id).success(function(response){
            $scope.account = response.account;
        });
    }

    //functions triggered on load
    $scope.getAdmins();
});
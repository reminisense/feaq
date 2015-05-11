/**
 * Created by USER on 5/6/15.
 */
app.controller('statsController', function($scope, $http){
    $scope.user_id = $('#user_id').val();
    $scope.keyword = 'page_url';
    $scope.keywords = [
        {keyword: 'page_url',           name: 'Page Views'},
        {keyword: 'issued',             name: 'Queued in Business'},
        {keyword: 'called',             name: 'Called in Business'},
        {keyword: 'served',             name: 'Served in Business'},
        {keyword: 'dropped',            name: 'Dropped in Business'},
        {keyword: 'geolocation',        name: 'Geolocation'},
        {keyword: 'browser',            name: 'Browser'},
        {keyword: 'operating_system',   name: 'OS'},
        {keyword: 'ip_address',         name: 'IP Address'},
        {keyword: 'screen_size',        name: 'Screen Size'},
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
            labels: ['Count']
        });
    };

    $scope.loadChart();
});
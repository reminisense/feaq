/**
 * Created by USER on 5/6/15.
 */
app.controller('statsController', function($scope, $http){
    $scope.user_id = $('#user_id').val();
    $scope.keyword = 'page_url';

    $scope.loadChart = function(){
        $('#statChart').empty();
        $.get('/watchdog/userdata/' + $scope.keyword + '/' + $scope.user_id, function(response){
            var response = JSON.parse(response);
            var data = [];
            for(x in response.data){
                data.push({ parameter: x,  value: response.data[x] });
            }
            $scope.createChart(data);
        })
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
            labels: ['Counts']
        });
    };

    $scope.loadChart();
});
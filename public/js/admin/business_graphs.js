/**
 * Created by JONAS on 6/5/2015.
 */
app.controller('graphsController', function($scope, $http){

    $scope.start_date = $('#start_date').val();
    $scope.end_date = $('#end_date').val();
    $scope.mode = $('#mode').val();
    $scope.value = $('#value').val();


    $scope.loadIssuedNumbersChart = function (){
        console.log("test");
        $http.get('/admin/numbersissued/' + $scope.start_date + '/' + $scope.end_date + '/' + $scope.mode + '/' + $scope.value)
            .success(function(response){

                var issued = [];
                var called = [];
                var served = [];
                var dropped = [];

                var temp_time_i = new Date($scope.start_date *1000);

                for(a in response.issued_numbers){

                    var month = ('0' + (temp_time_i.getMonth()+ 1)).slice(-2);
                    var day = ('0' + temp_time_i.getDate()).slice(-2);
                    var year = temp_time_i.getFullYear();

                    issued.push({ Date: year+"-"+month+"-"+day, Value: response.issued_numbers[a]});
                    temp_time_i.setDate( temp_time_i.getDate() + 1);
                }

                var temp_time_c = new Date($scope.start_date *1000);

                for(b in response.called_numbers){

                    var month = ('0' + (temp_time_c.getMonth()+ 1)).slice(-2);
                    var day = ('0' + temp_time_c.getDate()).slice(-2);
                    var year = temp_time_c.getFullYear();

                    called.push({ Date: year+"-"+month+"-"+day, Value: response.called_numbers[b]});
                    temp_time_c.setDate( temp_time_c.getDate() + 1);
                }

                var temp_time_s = new Date($scope.start_date *1000);

                for(c in response.served_numbers){

                    var month = ('0' + (temp_time_s.getMonth()+ 1)).slice(-2);
                    var day = ('0' + temp_time_s.getDate()).slice(-2);
                    var year = temp_time_s.getFullYear();

                    served.push({ Date: year+"-"+month+"-"+day, Value: response.served_numbers[c]});

                    temp_time_s.setDate( temp_time_s.getDate() + 1);
                }

                var temp_time_d = new Date($scope.start_date *1000);

                for(d in response.dropped_numbers){

                    var month = ('0' + (temp_time_d.getMonth()+ 1)).slice(-2);
                    var day = ('0' + temp_time_d.getDate()).slice(-2);
                    var year = temp_time_d.getFullYear();

                    dropped.push({ Date: year+"-"+month+"-"+day, Value: response.dropped_numbers[d]});

                    temp_time_d.setDate( temp_time_d.getDate() + 1);
                }
                $scope.createIssuedChart(issued);
                $scope.createCalledChart(called);
                $scope.createServedChart(served);
                $scope.createDroppedChart(dropped);
            });

    }


    $scope.createIssuedChart = function(issued){
        console.log(issued);
        new Morris.Line({
            element: 'lineIssuedChart',
            data: issued,
            xkey: 'Date',
            ykeys: ['Value'],
            labels: ['Issued Numbers']
        });

    };

    $scope.createCalledChart = function(called){
        console.log(called);
        new Morris.Line({
            element: 'lineCalledChart',
            data: called,
            xkey: 'Date',
            ykeys: ['Value'],
            labels: ['Called Numbers']
        });

    };

    $scope.createServedChart = function(served){
        console.log(served);
        new Morris.Line({
            element: 'lineServedChart',
            data: served,
            xkey: 'Date',
            ykeys: ['Value'],
            labels: ['Served Numbers']
        });

    };

    $scope.createDroppedChart = function(dropped){
        console.log(dropped);
        new Morris.Line({
            element: 'lineDroppedChart',
            data: dropped,
            xkey: 'Date',
            ykeys: ['Value'],
            labels: ['Dropped Numbers']
        });

    };

    $scope.loadIssuedNumbersChart();



    $('a[href="#issued-container"]').on('click',function(){
        $("#issued-container").show();
        $("#called-container").hide();
        $("#served-container").hide();
        $("#dropped-container").hide();
    });
    $('a[href="#called-container"]').on('click',function(){
        $("#issued-container").hide();
        $("#called-container").css('visibility', 'visible')
        $("#called-container").show();
        $("#served-container").hide();
        $("#dropped-container").hide();
    });
    $('a[href="#served-container"]').on('click',function(){
        $("#issued-container").hide();
        $("#called-container").hide();
        $("#served-container").css('visibility', 'visible')
        $("#served-container").show();
        $("#dropped-container").hide();
    });
    $('a[href="#dropped-container"]').on('click',function(){
        $("#issued-container").hide();
        $("#called-container").hide();
        $("#served-container").hide();
        $("#dropped-container").css('visibility', 'visible')
        $("#dropped-container").show();
    });

});
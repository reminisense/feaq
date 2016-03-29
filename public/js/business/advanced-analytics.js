/**
 * Created by USER on 3/17/2016.
 */
(function(){
    $(".datepicker").datepicker();
})();

(function(){
    app.requires.push('angular-loading-bar'); //add angular loading bar
    app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
        cfpLoadingBarProvider.includeSpinner = false;
    }]);
    app.controller('businessAnalyticsController', function($scope, $http, $filter){
        $scope.startdate = $filter('date')(new Date(),'MM/dd/yyyy');
        $scope.enddate = $filter('date')(new Date(),'MM/dd/yyyy');
        $scope.analytics = [];
        $scope.business_id = $('#business_id').val();
        $scope.getBusinessAnalytics = function(startdate, enddate){
            $http.post('/business/business-analytics', { business_id: $scope.business_id, startdate: startdate, enddate: enddate }).success(function(response){
                $scope.analytics = response.analytics;
                $scope.generateQueueGraph();
                console.log($scope.analytics);
            });
        };

        $scope.generateQueueGraph = function(){
            $scope.emptyGraph();
            if($scope.analytics.queue_activity.length > 0){
                new Morris.Line({
                    element: 'queue-activity-graph',
                    data: $scope.analytics.queue_activity,
                    xkey: 'time',
                    ykeys: ['value'],
                    labels: ['Issued Numbers'],
                    axes: true
                });
            }
        };

        $scope.emptyGraph = function(){
            angular.element('#queue-activity-graph').empty();
        };

        $scope.getBusinessAnalytics();
        $scope.emptyGraph();
    });
})();
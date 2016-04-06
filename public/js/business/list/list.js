var app = angular.module('BusinessList', []);

app.controller('nowServingCtrl', function($scope, $http) {

    $scope.lazyLoadBusinesses = function(letter, offset) {
        $http.get('/list/business-by-letter/'+letter+'/'+offset).success(function(response) {
            console.log(response.status);
            console.log(response.msg);
            console.log(response.body);
        });
    };

    $scope.upvoteBusiness = function(business_id) {
        $http.post('/list/upvote-business', {
            business_id: business_id
        }).success(function(response) {
            console.log(response.status);
            console.log(response.msg);
        });
    }

});
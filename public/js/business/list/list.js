var app = angular.module('BusinessList', []);

app.controller('listController', function($scope, $http) {

    $scope.offset = 0;
    $scope.letter = ''
    var listBusiness = function(url_build) {
        $http.get(url_build).success(function (response) {
            var result = response.body;
            for (var i = 0; i < result.length; i++) {
                $scope.business_list.push({
                    business_list_id: result[i].business_list_id,
                    email: result[i].email,
                    local_address: result[i].local_address,
                    name: result[i].name,
                    phone: result[i].phone,
                    time_open: result[i].time_open,
                    time_close: result[i].time_close,
                    up_vote: result[i].up_vote
                });
            };
        });
    };

    $scope.lazyLoadBusinesses = function(letter, offset) {
        $scope.offset = offset;
        $scope.letter = letter;
        if (letter == '') {
            $scope.business_list = new Array();
            listBusiness('/list/all-businesses/' + offset);
        }
        else {
            $scope.business_list = new Array();
            listBusiness('/list/business-letter-offset/' + letter + '/' + offset);
        }

        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() == $(document).height()) {
                $scope.offset = $scope.offset + 20;
                if (letter == '') {
                    listBusiness('/list/all-businesses/' + $scope.offset);
                }
                else {
                    listBusiness('/list/business-letter-offset/' + $scope.letter + '/' + $scope.offset);
                }
            }
        });
    };

    $scope.upvoteBusiness = function(business_id) {
        $http.post('/list/upvote-business', {
            business_id: business_id
        }).success(function(response) {
            console.log(response.status);
            console.log(response.msg);
        });
    };

});
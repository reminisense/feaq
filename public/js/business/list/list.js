var app = angular.module('BusinessList', []);

app.controller('listController', function($scope, $http) {

    $scope.offset = 0;
    $scope.letter = ''
    $scope.business_list = new Array();
    $scope.voted_list = new Array();
    var votedList = self.window.name;
    var listBusiness = function(url_build) {
        $http.get(url_build).success(function (response) {
            var result = response.body;
            for (var i = 0; i < result.length; i++) {
                var hideVote = false;
                if (votedList.indexOf(result[i].business_list_id) > -1) {
                    hideVote = true;
                }
                $scope.business_list.push({
                    business_list_id: result[i].business_list_id,
                    email: result[i].email,
                    local_address: result[i].local_address,
                    name: result[i].name,
                    phone: result[i].phone,
                    time_open: result[i].time_open,
                    time_close: result[i].time_close,
                    up_vote: result[i].up_vote,
                    hide_vote: hideVote
                });

            };
            $('#lazy-loader').hide();
        });
    };
    $('#lazy-loader').show();
    listBusiness('/list/all-businesses/' + $scope.offset);

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
            $('#lazy-loader').show();
            $scope.offset = $scope.offset + 20;
            if ($scope.letter == '') {
                listBusiness('/list/all-businesses/' + $scope.offset);
            }
            else {
                listBusiness('/list/business-letter-offset/' + $scope.letter + '/' + $scope.offset);
            }
        }
    });

    $scope.lazyLoadBusinesses = function(letter, offset) {
        $scope.offset = offset;
        $scope.letter = letter;
        $('#lazy-loader').show();
        if (letter == '') {
            $scope.business_list = new Array();
            listBusiness('/list/all-businesses/' + offset);
        }
        else {
            $scope.business_list = new Array();
            listBusiness('/list/business-letter-offset/' + letter + '/' + offset);
        }
    };

    $scope.upvoteBusiness = function(business_list_id) {
        self.window.name = self.window.name + business_list_id + ",";
        $http.post('/list/upvote-business', {
            business_list_id: business_list_id
        }).success(function (response) {
            $('#upvote-'+business_list_id).hide();
            var upvotes = parseInt($('#score-'+business_list_id).text()) + 1;
            $('#score-'+business_list_id).text(upvotes);
            console.log(response.status);
            console.log(response.msg);
        });
    };


});
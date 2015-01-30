(function() {

    var app = angular.module('Broadcast', ['Facebook']);

    app.controller('nowServingCtrl', function($scope, $http) {

        var branch_id = document.getElementById('branch-id').getAttribute('branch_id');
        setInterval(function() {
            $http.get('/json/'+branch_id+'.json').success(function(response) {
                if ($scope.tbox1 != response.box1.terminal) {
                    $scope.tbox1 = response.box1.terminal;
                    if ($scope.tbox1 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }
                if ($scope.tbox2 != response.box2.terminal) {
                    $scope.tbox2 = response.box2.terminal;
                    if ($scope.tbox2 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }
                if ($scope.tbox3 != response.box3.terminal) {
                    $scope.tbox3 = response.box3.terminal;
                    if ($scope.tbox3 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }
                if ($scope.tbox4 != response.box4.terminal) {
                    $scope.tbox4 = response.box4.terminal;
                    if ($scope.tbox4 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }
                if ($scope.tbox5 != response.box5.terminal) {
                    $scope.tbox5 = response.box5.terminal;
                    if ($scope.tbox5 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }
                if ($scope.tbox6 != response.box6.terminal) {
                    $scope.tbox6 = response.box6.terminal;
                    if ($scope.tbox6 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }
                $scope.box1 = response.box1.number;
                $scope.box2 = response.box2.number;
                $scope.box3 = response.box3.number;
                $scope.box4 = response.box4.number;
                $scope.box5 = response.box5.number;
                $scope.box6 = response.box6.number;
                $scope.get_num = response.get_num;
            });
        }, 300);

        $scope.callNumberSound = function (soundobj) {
            var thissound = document.getElementById(soundobj);
            thissound.play();
        }

    });

})();

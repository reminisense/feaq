(function() {

    var app = angular.module('Broadcast', []);

    app.controller('nowServingCtrl', function($scope, $http) {

        var business_id = document.getElementById('business-id').getAttribute('business_id');
        setInterval(function() {
            $http.get('/broadcast/reset-numbers/'+business_id).success(function(response) {});
            $http.get('/json/'+business_id+'.json').success(function(response) {
                if ($scope.rank1 != response.box1.rank) {
                    $scope.rank1 = response.box1.rank;
                    $scope.name1 = response.box1.terminal;
                    if ($scope.rank1 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }
                if ($scope.rank2 != response.box2.rank) {
                    $scope.rank2 = response.box2.rank;
                    $scope.name2 = response.box2.terminal;
                    if ($scope.rank2 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }
                if ($scope.rank3 != response.box3.rank) {
                    $scope.rank3 = response.box3.rank;
                    $scope.name3 = response.box3.terminal;
                    if ($scope.rank3 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }
                if ($scope.rank4 != response.box4.rank) {
                    $scope.rank4 = response.box4.rank;
                    $scope.name4 = response.box4.terminal;
                    if ($scope.rank4 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }
                if ($scope.rank5 != response.box5.rank) {
                    $scope.rank5 = response.box5.rank;
                    $scope.name5 = response.box5.terminal;
                    if ($scope.rank5 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }
                if ($scope.rank6 != response.box6.rank) {
                    $scope.rank6 = response.box6.rank;
                    $scope.name6 = response.box6.terminal;
                    if ($scope.rank6 != "") {
                        $scope.callNumberSound('call-number-sound');
                    }
                }

                if ($scope.box1 != response.box1.number && $scope.rank1 != "") {
                    $scope.callNumberSound('call-number-sound');
                }
                if ($scope.box2 != response.box2.number && $scope.rank2 != "") {
                    $scope.callNumberSound('call-number-sound');
                }
                if ($scope.box3 != response.box3.number && $scope.rank3 != "") {
                    $scope.callNumberSound('call-number-sound');
                }
                if ($scope.box4 != response.box4.number && $scope.rank4 != "") {
                    $scope.callNumberSound('call-number-sound');
                }
                if ($scope.box5 != response.box5.number && $scope.rank5 != "") {
                    $scope.callNumberSound('call-number-sound');
                }
                if ($scope.box6 != response.box6.number && $scope.rank6 != "") {
                    $scope.callNumberSound('call-number-sound');
                }

                $scope.box1 = response.box1.number;
                $scope.box2 = response.box2.number;
                $scope.box3 = response.box3.number;
                $scope.box4 = response.box4.number;
                $scope.box5 = response.box5.number;
                $scope.box6 = response.box6.number;

                /* RDH Checks if empty, show '-' if yes*/
                $scope.get_num = (response.get_num === "") ? "-": response.get_num;

                if (response.display == 1) {
                    $scope.boxdisplay1 = '';
                    $scope.boxdisplay2 = 'display: none;';
                    $scope.boxdisplay3 = 'display: none;';
                    $scope.boxdisplay4 = 'display: none;';
                    $scope.boxdisplay5 = 'display: none;';
                    $scope.boxdisplay6 = 'display: none;';
                }
                else if (response.display == 2) {
                    $scope.boxdisplay1 = '';
                    $scope.boxdisplay2 = '';
                    $scope.boxdisplay3 = 'display: none;';
                    $scope.boxdisplay4 = 'display: none;';
                    $scope.boxdisplay5 = 'display: none;';
                    $scope.boxdisplay6 = 'display: none;';
                }
                else if (response.display == 3) {
                    $scope.boxdisplay1 = '';
                    $scope.boxdisplay2 = '';
                    $scope.boxdisplay3 = '';
                    $scope.boxdisplay4 = 'display: none;';
                    $scope.boxdisplay5 = 'display: none;';
                    $scope.boxdisplay6 = 'display: none;';
                }
                else if (response.display == 4) {
                    $scope.boxdisplay1 = '';
                    $scope.boxdisplay2 = '';
                    $scope.boxdisplay3 = '';
                    $scope.boxdisplay4 = '';
                    $scope.boxdisplay5 = 'display: none;';
                    $scope.boxdisplay6 = 'display: none;';
                }
                else if (response.display == 5) {
                    $scope.boxdisplay1 = '';
                    $scope.boxdisplay2 = '';
                    $scope.boxdisplay3 = '';
                    $scope.boxdisplay4 = '';
                    $scope.boxdisplay5 = '';
                    $scope.boxdisplay6 = 'display: none;';
                }
                else if (response.display == 6) {
                    $scope.boxdisplay1 = '';
                    $scope.boxdisplay2 = '';
                    $scope.boxdisplay3 = '';
                    $scope.boxdisplay4 = '';
                    $scope.boxdisplay5 = '';
                    $scope.boxdisplay6 = '';
                }
            });
        }, 1000);

        $scope.callNumberSound = function (soundobj) {
            var thissound = document.getElementById(soundobj);
            thissound.play();
        }

    });

})();

(function() {

    var app = angular.module('Broadcast', ['Facebook']);

    app.controller('nowServingCtrl', function($scope, $http) {

        var business_id = document.getElementById('business-id').getAttribute('business_id');
        setInterval(function() {
            $http.get('/json/'+business_id+'.json').success(function(response) {
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

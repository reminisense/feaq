(function() {

    var app = angular.module('Facebook', []);

    app.run(function($http) {

        window.fbAsyncInit = (function () {
            FB.init({
                appId      : '1577295149183234',
                cookie     : true,  // enable cookies to allow the server to access
                                    // the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.2' // use version 2.2
            });

            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    // Logged into your app and Facebook.
                    $('#fb-login').hide();
                    $('#fb-login-2').hide();
                    $http.post('/fb/laravel-login', { 'fb_id': response.authResponse.userID }).success(function(response) {
                        if (response.success == 1) window.location.replace('/');
                    });
                    //FeatherQ.facebook.testAPI();
                } else if (response.status === 'not_authorized') {
                    // The person is logged into Facebook, but not your app.
                    $http.post('/fb/laravel-logout');
                    //document.getElementById('status').innerHTML = 'Please log ' +
                    //'into this app.';
                } else {
                    // The person is not logged into Facebook, so we're not sure if
                    // they are logged into this app or not.
                    $http.post('/fb/laravel-logout');
                    //document.getElementById('status').innerHTML = 'Please log ' +
                    //'into Facebook.';
                }
            });
        });

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    });

    app.controller('fbController', function($scope, $http) {

        $scope.login = (function(e) {
            FB.login(function(response) {
                if (response.authResponse) {
                    $scope.saveFbDetails();
                }
            }, {'scope': 'public_profile,email,user_friends'});
            e.stopPropagation();
        });

        $scope.saveFbDetails = (function() {
            FB.api('/me', function(response) {
                fbData = {
                    "fb_id": response.id,
                    "fb_url": response.link,
                    "first_name": response.first_name,
                    "last_name": response.last_name,
                    "email": response.email,
                    "gender": response.gender
                };
                $http.post('/fb/save-details', fbData).success(function(response) {
                    window.location.replace('/');
                }).error(function(response) {
                    alert('Something went wrong..');
                });
            });
        });

    });

})();


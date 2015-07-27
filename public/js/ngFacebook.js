var fbapp = angular.module('Facebook', []);

fbapp.run(function($http) {

    window.fbAsyncInit = (function () {
        FB.init({
            appId      : '1577295149183234',
            cookie     : true,
            xfbml      : true,
            version    : 'v2.2'
        });

        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                $http.post('/fb/laravel-login', { 'fb_id': response.authResponse.userID }).success(function(response) {
                    if (response.success == 1) window.location.replace('/');
                });
            } else if (response.status === 'not_authorized') {
                $http.post('/fb/laravel-logout');
            } else {
                $http.post('/fb/laravel-logout');
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

fbapp.controller('fbController', function($scope, $http) {

    $scope.login = (function(e) {
        FB.login(function(response) {
            if (response.authResponse) {
                $scope.saveFbDetails();
            }
        }, {'scope': 'public_profile,email,user_friends'});
    });

    $scope.saveFbDetails = (function() {
        FB.api('/me', function(response) {

            // this code adds an email placeholder if ever the variable is empty or undefined
            if (!$.trim(response.email) || typeof(response.email) == "undefined") {
                response.email = 'you@example.com';
            }

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
            });
        });
    });

});

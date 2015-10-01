var FeatherQ = FeatherQ || {
    'ajax': {},

    'test': {},
    'facebook': {},
    'business': {},
    'branch': {},
    'service': {
        'broadcast': {},
        'process_queue': {}
    },
    'terminal': {},
    'user': {}
};

FeatherQ.test = {
    'hello_world': (function() {
        alert('Hello World');
    })
};

FeatherQ.ajax = {
    'request': (function(method, url, passedData, fn_success, fn_error, $http) {
        if (method == 'GET') {
            var request = {
                url: url,
                method: method,
                params: passedData
            }
        }
        else {
            var request = {
                url: url,
                method: method,
                data: passedData
            }
        }
        $http(request).success(fn_success).error(fn_error);
    })
};

FeatherQ.facebook = {

    // This is called with the results from from FB.getLoginStatus().
    'statusChangeCallback' : (function(response) {
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            $('#fb-login').hide();
            $('#fb-login-2').hide();
            //FeatherQ.facebook.testAPI();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            $.post('/fb/laravel-logout');
            //document.getElementById('status').innerHTML = 'Please log ' +
            //'into this app.';
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            $.post('/fb/laravel-logout');
            //document.getElementById('status').innerHTML = 'Please log ' +
            //'into Facebook.';
        }
    }),

    // This function is called when someone finishes with the Login
    // Button.  See the onlogin handler attached to it in the sample
    // code below.
    'checkLoginState' : (function() {
        FB.getLoginStatus(function(response) {
            FeatherQ.facebook.statusChangeCallback(response);
        });
    }),

    'fbAsyncInit': window.fbAsyncInit = (function() {
        FB.init({
            appId      : '1622215494691199', /* Test: 1577295149183234, Prod: 1574952899417459, Demo: 1622215494691199 */
            cookie     : true,  // enable cookies to allow the server to access
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.2' // use version 2.2
        });

        // Now that we've initialized the JavaScript SDK, we call
        // FB.getLoginStatus().  This function gets the state of the
        // person visiting this page and can return one of three states to
        // the callback you provide.  They can be:
        //
        // 1. Logged into your app ('connected')
        // 2. Logged into Facebook, but not your app ('not_authorized')
        // 3. Not logged into Facebook and can't tell if they are logged into
        //    your app or not.
        //
        // These three cases are handled in the callback function.

        FB.getLoginStatus(function(response) {
            FeatherQ.facebook.statusChangeCallback(response);
        });
    }),

    // Load the SDK asynchronously
    'loadSDK': (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk')),

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    'testAPI': (function() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function(response) {
            console.log('Successful login for: ' + response.name);
            document.getElementById('status').innerHTML =
                'Thanks for logging in, ' + response.name + '!';
            document.getElementById('scary-data').innerHTML = response.email + '<br/>' + response.link + '<br/>' + response.gender
            + '<br/>' + response.locale + '<br/>' + response.timezone + '<br/>' + response.age_range;
        });
    }),

    // save fb details to featherq
    'saveFbDetails': (function() {
        FB.api('/me', function(response) {
            fbData = {
                "fb_id": response.id,
                "fb_url": response.link,
                "first_name": response.first_name,
                "last_name": response.last_name,
                "email": response.email,
                "gender": response.gender
            };
            FeatherQ.ajax.request('POST', '/fb/save-details', fbData, function(response) {
                window.location.reload(true);
            }, function(response) {}, $http);
        });
    }),

    'login': (function() {
        FB.login(function(response) {
            if (response.authResponse) {
               FeatherQ.facebook.saveFbDetails();
            }
        }, {'scope': 'public_profile,email,user_friends'});
    })

}

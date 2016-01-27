<!doctype html>
<html>
    <head>
        <title>FeatherQ</title>
        <meta name="title" content="FeatherQ"/>
        <meta name="description" content="FeatherQ is a DIY cloud-based queuing platform. We make it easy for businesses to manage their lines better and allow customers to wait on their own terms."/>
        <meta name="author" content="Reminisense, Corp."/>
        <meta name="keywords" content="queueing, queuing, queue, line, lining, wait, waiting, priority, online, software"/>
        <meta name="og:url" content="http://www.featherq.com"/>
        <meta name="og:type" content="website"/>
        <meta name="og:description" content="FeatherQ is a DIY cloud-based queuing platform. We make it easy for businesses to manage their lines better and allow customers to wait on their own terms."/>
        <meta name="og:site_name" content="FeatherQ"/>
        <meta name="fb:app_id" content="1574952899417459"/>

        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>


        <script type="text/javascript" src="/js/angular.min.js"></script>
        <script type="text/javascript" src="/js/ngFeatherQ.js"></script>
        <script type="text/javascript" src="/js/ngFacebook.js"></script>
        <script type="text/javascript" src="/js/ngAutocomplete.js"></script>
        <script type="text/javascript" src="/js/ngDirectives.js"></script>

        <script>window.jQuery || document.write('<script src="/js/jquery-1.11.2.min.js"><\/script>')</script>
        <script type="text/javascript" src="/js/jquery.plugin.js"></script>
        <script type="text/javascript" src="/js/jquery.timeentry.js"></script>
        <script type="text/javascript" src="/js/user/ngEmailAuth.js"></script>

    </head>
    <body ng-app="FeatherQ" ng-cloak>
    <div class="col-md-12" ng-controller="emailAuthController">
        <form ng-submit="login()">
            <label>Email</label>
            <input type="email" name="email" ng-model="email"/>
            <label>Password</label>
            <input type="password" name="password" ng-model="password"/>
            <button type="submit">LOGIN</button>
        </form>
        <a href="/user/register">Sign up using email</a>
        <a href="/user/forgot-password">Forgot password?</a>
        <div class="alert alert-danger" ng-show="error_message != ''">@{{ error_message  }}</div>
    </div>
    <hr/>
    <div class="col-md-12" ng-controller="fbController">
        <a href="#" ng-click="login()" class="btn btn-blue"><img src="/images/homepage/landing/fb.png">LOGIN WITH FACEBOOK</a>
    </div>

    @include('modals.homepage.fb-loader')

    <script src="/js/bootstrap.min.js"></script>
    </body>
</html>



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
<div ng-controller="emailAuthController">
    <form ng-submit="send_password_reset()">
        <label>Email</label>
        <input type="text" name="email" ng-model="email">
        <button type="submit">Reset Password</button>
        <div>
            <p>@{{ message }}</p>
        </div>
    </form>
</div>
</body>
</html>
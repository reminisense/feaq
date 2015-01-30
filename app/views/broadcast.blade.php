<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>{{ $business_name }} | FeatherQ</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/animate.css') }}
    {{ HTML::style('css/style.css') }}

    {{ HTML::script('js/jquery1.11.0.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/wow.min.js') }}
    {{ HTML::script('js/custom.js') }}
    {{ HTML::script('js/angular.js') }}
    {{ HTML::script('js/FeatherQ.js') }}
    {{ HTML::script('js/broadcast.js') }}
</head>
<body ng-app="">
<script>
    FeatherQ.facebook.statusChangeCallback();
    FeatherQ.facebook.checkLoginState();
    FeatherQ.facebook.fbAsyncInit();
    FeatherQ.facebook.loadSDK();
</script>
    <div>{{ $business_name }}</div>
    <div></div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>FeatherQ</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/animate.css') }}
    {{ HTML::style('css/style.css') }}
    @yield('styles')

    {{ HTML::script('js/jquery1.11.0.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/wow.min.js') }}
    {{ HTML::script('js/custom.js') }}
    {{ HTML::script('js/angular.js') }}
    {{ HTML::script('js/ngFeatherQ.js') }}
    {{ HTML::script('js/ngFacebook.js') }}
    @yield('scripts')
</head>
<body ng-app="FeatherQ">
<h2>WELCOME TO YOUR DASHBOARD</h2>
<script>
    new WOW().init();
</script>
</body>
</html>
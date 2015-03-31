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

    {{--{{ HTML::style('css/bootstrap.min.css') }}--}}
    <link media="all" type="text/css" rel="stylesheet" href="/css/bootstrap.min.css">

    {{--{{ HTML::style('css/animate.css') }}--}}
    <link media="all" type="text/css" rel="stylesheet" href="/css/animate.css">

    {{--{{ HTML::style('css/style.css') }}--}}
    <link media="all" type="text/css" rel="stylesheet" href="/css/style.css">

    {{--{{ HTML::style('css/responsive.page-front.css') }}--}}
    <link media="all" type="text/css" rel="stylesheet" href="/css/responsive.page-front.css">

    @yield('styles')

    {{--{{ HTML::script('js/jquery1.11.0.js') }}--}}
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

    {{--{{ HTML::script('js/bootstrap.min.js') }}--}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    {{--{{ HTML::script('js/wow.min.js') }}--}}
    <script src="/js/wow.min.js"></script>

    {{--{{ HTML::script('js/custom.js') }}--}}
    <script src="/js/custom.js"></script>

    {{--{{ HTML::script('js/angular.js') }}--}}
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>

    {{--{{ HTML::script('js/ngFeatherQ.js') }}--}}
    <script src="/js/ngFeatherQ.js"></script>

    {{--{{ HTML::script('js/ngFacebook.js') }}--}}
    <script src="/js/ngFacebook.js"></script>

    {{--{{ HTML::script('js/ngAutocomplete.js') }}--}}
    <script src="/js/ngAutocomplete.js"></script>

    {{--{{ HTML::script('js/ngBroadcast.js') }}--}}
    <script src="/js/ngBroadcast.js"></script>

    @yield('scripts')
</head>
<body cz-shortcut-listen="true" ng-app="FeatherQ">
    <div class="navbar-wrapper">
        <!-- Static navbar -->
        <nav class="navbar navbar-default navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src="images/featherq-home-logo.png"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse" ng-controller="fbController">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#how">How it works</a></li>
                <li><a href="#feats">Features</a></li>
                <li><a href="#" class="btn btn-blue btn-fb" ng-click="login()" role="button"><img src="images/icon-fb.png"> Login with Facebook</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>
    </div>
    @yield('body')
    <script>
        new WOW().init();
    </script>
</body>
</html>
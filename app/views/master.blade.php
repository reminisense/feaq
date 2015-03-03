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
    {{ HTML::style('css/responsive.page-front.css') }}
    @yield('styles')

    {{ HTML::script('js/jquery1.11.0.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/wow.min.js') }}
    {{ HTML::script('js/custom.js') }}
    {{ HTML::script('js/angular.js') }}
    {{ HTML::script('js/ngFeatherQ.js') }}
    {{ HTML::script('js/ngFacebook.js') }}
    {{ HTML::script('js/ngAutocomplete.js') }}
    {{ HTML::script('js/ngBroadcast.js') }} <!-- RDH Added ngBroadcast.js since initial homepage was not loading -->
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
                <li><a href="">How it works</a></li>
                <li><a href="">Features</a></li>
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
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
    {{--{{ HTML::style('css/style.css') }}--}}
    {{ HTML::style('css/dashboard.css') }}
    {{ HTML::style('css/responsive.css') }}
    @yield('styles')

    {{ HTML::script('js/jquery1.11.0.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/wow.min.js') }}
    {{ HTML::script('js/custom.js') }}
    {{ HTML::script('js/angular.js') }}
    {{ HTML::script('js/ngFeatherQ.js') }}
    {{ HTML::script('js/ngFacebook.js') }}
    @yield('scripts')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- NAVBAR
  ================================================== -->
  <body cz-shortcut-listen="true" ng-app="FeatherQ">
    @yield('nav-bar')

    @yield('content')

    <div class="footer">
        <div class="container">
          <div class="col-md-12">
            © 2014 : Reminisense Corp.
          </div>
        </div>
    </div>
<script>
new WOW().init();
</script>

    @yield('modals')
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ url('images/favicon.png')}}">

    <title>FeatherQ</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/animate.css') }}
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
    {{ HTML::script('js/ngBroadcast.js') }} <!-- RDH Added ngBroadcast.js since initial homepage was not loading -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- NAVBAR
  ================================================== -->
<body cz-shortcut-listen="true" ng-app="FeatherQ">
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
            <a class="navbar-brand" href="#"><img src="{{ url('images/featherq-home-logo.png') }}"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello Rodeldo! <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="subnav">
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="search active"><a href="#"><span class="glyphicon glyphicon-search"></span> Search</a></li>
            <li class="biz"><a href="#"><span class="glyphicon glyphicon-home"></span> My Business</a></li>
        </ul>
    </div>
</div>
<div class="container main-wrap">
    <div class="row filters">
        <div class="col-md-5 col-md-offset-1">
            <div class="filterwrap">
                <span>FILTER:</span>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Location
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                            <li><a href="#">Dropdown link</a></li>
                            <li><a href="#">Dropdown link</a></li>
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Industry Type
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 2</a></li>
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Time Open
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="searchblock">
                <form>
                    <input type="text" placeholder="Search a Business">
                    <button type="button" class="btn btn-orange btn-md">SEARCH</button>
                </form>
            </div>
        </div>
    </div>
    @yield('content')
</div>
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
@yield('scripts') <!--ARA Best practice to add scripts at the bottom so that scripts could be loaded after the page has benn rendered -->
</body>
</html>
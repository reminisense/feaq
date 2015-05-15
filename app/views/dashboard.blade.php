<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>FeatherQ - Online Queuing Software</title>
    <meta name="title" content="FeatherQ Online Queueing software" />
    <meta name="description" content="FeatherQ online Queueing software" />
    <meta name="author" content="">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <link rel='stylesheet' type='text/css' href='/css/ngCloak.css'>
    <link rel="shortcut icon" id="favicon" href="{{URL::to('/images/favicon.png')}}">
    <link rel="stylesheet" type='text/css' href="/css/bootstrap.min.css">
    <link rel='stylesheet' type='text/css' href='/css/global.css'>
    <link rel='stylesheet' type='text/css' href='/css/dashboard/responsive.css'>
    <link media="all" type="text/css" rel="stylesheet" href="/css/intlTelInput.css">
    <link rel='stylesheet' type='text/css' href='/css/modal.css'>
    <link rel='stylesheet' type='text/css' href='/css/refresh-animate.css'>
    <link rel='stylesheet' type='text/css' href='/css/dashboard/points-of-interest.css'> {{--ARA points of interest--}}

    @yield('styles')

    <script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="/js/jquery.geocomplete.js"></script>
    <script src="/js/jquery.timepicker.min.js"></script>
    <script src="/js/intlTelInput.js"></script>
    <script src="/js/jquery.plugin.js"></script>
    <script src="/js/jquery.timeentry.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/ngFeatherQ.js"></script>
    <script src="/js/ngFacebook.js"></script>
    <script src="/js/ngAutocomplete.js"></script>
    <script src="/js/user/Usertracker.js"></script> {{-- ARA For user tracking --}}
    <script src="/js/dashboard/points-of-interest.js"></script> {{--ARA points of interest--}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]-->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body ng-app="FeatherQ" ng-cloak @if(isset($body)) {{ 'id="' . $body . '"'  }}@endif >
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="" class="navbar-brand"><img src="/img/featherq-logo.svg"></a>
        </div>
        <nav class="pull-right collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li id="search-business" class="active"><a href="{{ url('/') }}"><span class="glyphicon glyphicon-search"></span> Business Search</a></li>
                <li id="my-business">
                    <a href="{{ url('/business/my-business') }}" ><span class="glyphicon glyphicon-home"></span> My Business</a>
                    <point-of-interest class="my-business" position='bottom' title="My Business" description="Click here to create your own business or to edit the details of your existing business."></point-of-interest>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> My Account <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a id="edit_profile" href="#">Edit My Profile</a></li>
                        {{--<li><a href="{{ url('/watchdog/stats') }}">My Stats</a></li>--}} {{--ARA User stats for reminisense only--}}
                        {{--<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>--}} <!-- RDH Removed since this does nothing -->
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>
@yield('container')
<footer>
    <div class="row-fluid">
        <p class="text-center">&copy; 2015 : Reminisense Corp.</p>
    </div>
</footer>
@include('modals.user.edit-user-modal')
@include('modals.business.verify-user-modal')
@yield('scripts'){{-- ARA scripts at the bottom so html can load before js --}}
</body>
</html>
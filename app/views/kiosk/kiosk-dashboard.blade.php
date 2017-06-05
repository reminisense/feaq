<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>FeatherQ - Online Queuing Software</title>
    <meta name="title" content="FeatherQ Online Queueing software" />
    <meta name="description" content="FeatherQ online Queueing software" />
    <meta name="author" content="Reminisense, Corp.">
    <meta name="keywords" content="queueing, queuing, queue, line, lining, wait, waiting, priority, online, software"/>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <link rel='stylesheet' type='text/css' href='/css/ngCloak.css'>
    <link rel="stylesheet" href="/css/jquery-ui.css">
    <link rel='stylesheet' type='text/css' href='/css/jquery-ui.structure.min.css'>
    <link rel='stylesheet' type='text/css' href='/css/jquery-ui.theme.min.css'>
    <link rel="shortcut icon" id="favicon" href="{{URL::to('/images/favicon.png')}}">
    <link rel="stylesheet" type='text/css' href="/css/bootstrap.min.css">
    <link rel='stylesheet' type='text/css' href='/css/global.css'>
    <link media="all" type="text/css" rel="stylesheet" href="/css/intlTelInput.css">
    <link rel='stylesheet' type='text/css' href='/css/modal.css'>
    <link rel='stylesheet' type='text/css' href='/css/refresh-animate.css'>
    <link rel='stylesheet' type='text/css' href='/css/dashboard/points-of-interest.css'> {{--ARA points of interest--}}
    <link media="all" type="text/css" rel="stylesheet" href="/css/jquery.timepicker.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/css/loading-bar.css">

    @yield('styles')

    <script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key=AIzaSyB55xpm64WJKkHPNoHoTt8XR2xVXDJnVbs"></script>
    <script src="/js/jquery.geocomplete.js"></script>
    <script src="/js/jquery.timepicker.min.js"></script>
    <script src="/js/intlTelInput.js"></script>
    <script src="/js/jquery.plugin.js"></script>
    <script src="/js/jquery.timeentry.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/ngFeatherQ.js"></script>
    <script src="/js/ngFacebook.js"></script>
    <script src="/js/ngAutocomplete.js"></script>
    {{--<script src="/js/user/Usertracker.js"></script> --}}{{-- ARA For user tracking --}}
    <script src="/js/ngDirectives.js"></script>     {{-- ARA add angularjs directives --}}
    <script src="/js/dashboard/points-of-interest.js"></script> {{-- ARA points of interest --}}
    <script src="/js/loading-bar.min.js"></script>

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
            <a class="navbar-brand"><img src="/img/featherq-logo.svg"></a>
        </div>
    </div>
</header>
@yield('container')
<footer>
    <div class="row-fluid">
        <p class="text-center"><a href="http://reminisense.com/" target="_blank">&copy; 2015: Reminisense Corp.</a></p>
    </div>
</footer>
@include('modals.user.edit-user-modal')
@include('modals.business.verify-user-modal')
@include('modals.websockets.websocket-loader')
@yield('scripts'){{-- ARA scripts at the bottom so html can load before js --}}
</body>
</html>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/images/favicon.png">

    <title>{{ $business_name }} | FeatherQ</title>

    <link href="/css/broadcast/default/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/broadcast/default/dashboard.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/broadcast/default/responsive.css" rel="stylesheet" type="text/css" media="all">

    {{--{{ HTML::script('js/jquery1.11.0.js') }}--}}
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

    {{--{{ HTML::script('js/angular.js') }}--}}
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>

    {{--{{ HTML::script('js/ngPublicBroadcast.js') }}--}}
    <script src="/js/broadcast/default/public-{{ $box_num }}.js"></script>

    {{--{{ HTML::script('js/google-analytics/googleAnalytics.js') }}--}}
    <script src="/js/google-analytics/googleAnalytics.js"></script>

    {{--{{ HTML::script('js/google-analytics/ga-broadcast.js') }}--}}
    <script src="/js/google-analytics/ga-broadcast.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- NAVBAR
  ================================================== -->
<body cz-shortcut-listen="true" id="biz-broadcast" ng-app="PublicBroadcast">
<div id="business-id" business_id="{{ $business_id }}"></div>
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
            <a class="navbar-brand" href="{{URL::to('/')}}"> {{--RDH Added link to homepage--}}
                <img src="/images/featherq-home-logo.png">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        @if (Auth::check())
                        Hello {{Auth::user()->first_name}}!
                        @else
                        Sign up now!
                        @endif
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{URL::to('/')}}">Dashboard</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Connect with us!</li>
                        <li><a href="{{URL::to('https://www.facebook.com/theFeatherQ')}}">Facebook</a></li>
                        <li><a href="{{URL::to('https://www.twitter.com/thefeatherq')}}">Twitter</a></li>
                        <li><a href="{{URL::to('https://plus.google.com/101914769293976664743')}}">Google+</a></li>
                    </ul>
                </li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<div class="container main-wrap">
    <div class="row mt20" id="nowServingCtrl" ng-controller="nowServingCtrl">
        <div id="broadcast-type" broadcast_type="{{ $broadcast_type }}"></div>
        <div id="ad-type" ad_type="{{ $ad_type }}"></div>
        <audio id="call-number-sound" src="/audio/doorbell_x.wav" controls preload="auto" autobuffer style="display: none;"></audio>

        @include('broadcast.default.public-' . $template_type)

        <div class="col-md-6">
            <div class="boxed boxed-single">
                <div class="wrap">
                    <div class="row">
                        <div class="col-md-5 getnum-info">
                            <h2 class="">Remote Queue Available Number:</h2>
                            <p>Remote queuing feature is still on the works!</p>
                        </div>
                        <div class="col-md-7 getnum-info">
                            <div class="ng-binding">
                                <h1 class="nomg">@{{ get_num }}</h1>
                                <a href="" class="btn-getnum" data-toggle="modal" data-target="#remote-queue-modal">
                                    Get this number <span class="glyphicon glyphicon-save"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="footer">
    <div class="container">
        <div class="col-md-12">
            Copyright 2014 : Reminisense Corp.
        </div>
    </div>
</div>
@include('modals.broadcast.remote-queue-modal')

{{--{{ HTML::script('js/bootstrap.min.js') }}--}}
<script src="/js/broadcast/bootstrap.min.js"></script>

{{--{{ HTML::script('js/custom.js') }}--}}
<script src="/js/broadcast/custom.js"></script>

{{--{{ HTML::script('js/process-queue/process-queue.js') }}--}}
<script src="/js/process-queue/process-queue.js"></script>

{{--{{ HTML::script('js/process-queue/issue-number-angular.js') }}--}}
<script src="/js/process-queue/issue-number-angular.js"></script>

</body>
</html>
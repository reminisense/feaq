<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="FeatherQ"/>
    <meta name="description" content="FeatherQ is a DIY cloud-based queuing platform. We make it easy for businesses to manage their lines better and allow customers to wait on their own terms."/>
    <meta name="author" content="Reminisense, Corp."/>
    <meta name="keywords" content="@foreach($keywords as $keyword){{ $keyword . ', ' }}@endforeach queuing"/>
    <link rel="shortcut icon" href="/images/favicon.png">

    <title>{{ $business_name }} | FeatherQ</title>

    <link rel="stylesheet" type="text/css" href="/css/ngCloak.css">
    <link href="/css/broadcast/default/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/broadcast/default/dashboard.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/app-global.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/refresh-animate.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/broadcast/default/public-broadcast.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/broadcast/default/responsive.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
    <link href="/css/jquery-ui.min.css" rel="stylesheet" type="text/css" media="all">

    <script src="/js/jquery-1.11.2.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
    <script type="text/javascript" src="/js/jquery.marquee.min.js"></script>
    <script src="/js/ngFacebook.js"></script>
    <script src="/js/google-analytics/googleAnalytics.js"></script>
    <script src="/js/google-analytics/ga-broadcast.js"></script>

    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>-->
    <![endif]-->
</head>
<!-- NAVBAR
  ================================================== -->
<body cz-shortcut-listen="true" id="public-broadcast" ng-app="PublicBroadcast" ng-cloak>
<div id="business-id" business_id="{{ $business_id }}"></div>
<div id="user-id" user_id="@if($user) {{$user['user_id']}} @else {{'0'}} @endif"></div>
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
        <div class="cta pull-right hidden-sm hidden-xs">
            <span><a href="{{URL::to('/')}}">Start using FeatherQ</a></span>
            @if (!Auth::check())
            <a ng-controller="fbController" href="" class="btn btn-fb" role="button" ng-click="login()"><span class="fa fa-facebook"></span> Login with Facebook</a>
            @endif
            <a href='https://play.google.com/store/apps/details?id=com.reminisense.feaqfree&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png' height="39px"/></a>
            <a href="https://itunes.apple.com/ph/app/featherq/id1203716312?mt=8" target="_blank"><img alt="iOS App on App Store" src="/images/homepage/appstore.svg" height="27px"></a>
        </div>
        <div id="navbar" class="hidden-xs hidden hidden-sm hidden-md navbar-collapse collapse">
            <ul class="nav hidden navbar-nav navbar-right">
                @if (Auth::check())
                    <li class="broadcast-logged">Hello {{Auth::user()->first_name}}!</li>
                @else
                    <li ng-controller="fbController"><a href="" class="btn btn-fb" role="button" ng-click="login()"><span class="fa fa-facebook"></span> Login with Facebook</a></li>
                @endif
                <li class="hidden-md hidden-sm hidden-xs btn-gplay">
                    <a href='https://play.google.com/store/apps/details?id=com.reminisense.feaqfree&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png' height="91px"/></a>
                    <a href="https://itunes.apple.com/ph/app/featherq/id1203716312?mt=8" target="_blank"><img alt="iOS App on App Store" src="/images/homepage/appstore.svg" height="61px"></a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container main-wrap">
    <div class="row mt20" id="nowServingCtrl" ng-controller="nowServingCtrl">
        <div id="broadcast-type" broadcast_type="{{ $broadcast_type }}"></div>
        <div id="ad-type" ad_type="{{ $ad_type }}"></div>
        <div id="adspace-size" adspace_size="{{ $adspace_size }}"></div>
        <audio id="call-number-sound" src="/audio/doorbell_x.wav" controls preload="auto" autobuffer style="display: none;"></audio>

        @include('broadcast.default.public-' . $broadcast_type)
        <div class="publiclogin ng-scope hidden-lg hidden-md visible-sm visible-xs text-center" ng-controller="fbController">
            <a href='https://play.google.com/store/apps/details?id=com.reminisense.feaqfree&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png' height="91px"/></a>
            <a href="https://itunes.apple.com/ph/app/featherq/id1203716312?mt=8" target="_blank"><img alt="iOS App on App Store" src="/images/homepage/appstore.svg" height="61px"></a>
            @if (!Auth::check())
                <a href="" class="btn btn-fb" role="button" ng-click="login()"><span class="fa fa-facebook"></span> Login with Facebook</a>
            @endif
        </div>
        <div class="col-md-6 pull-right" ng-if="get_num">
            <div class="boxed boxed-single">
                <div class="wrap">
                    <div class="row" ng-controller="issuenumberController">
                        <div class="col-md-5 getnum-info">
                            @if($allow_remote && Auth::check())
                            <h2 class="">Remote Queue Number:</h2>
                            <p>
                                Remote queuing allows you to get this number before being at the location.
                                <select class="form-control" id="services" ng-model="service_id" ng-change="selectService()"></select>
                            </p>
                            @else
                            <h2 class="">Next Available Number:</h2>
                            <p>Please go to the location to get this number.</p>
                            @endif
                        </div>
                        <div class="col-md-7 getnum-info">
                            <div class="">
                                <h1 class="nomg">@{{ get_num }}</h1>
                                @if($allow_remote)
                                @if(Auth::check())
                                <a href="" id="remote-btn" ng-if="queue_status == 1" class="btn-getnum" ng-click="getFormFields()">
                                    Get this number <span class="glyphicon glyphicon-save"></span>
                                </a>
                                <a ng-if="queue_status == 0" href="" class="btn-getnum @{{ user_queue.time_checked_in > 0 ? 'disabled' : '' }}" ng-click="checkIn()">
                                    @{{ user_queue.time_checked_in > 0 ? 'You are checked in' : 'Check in' }}
                                </a>
                                @else
                                <a href="" class="btn-getnum disabled" data-toggle="modal" data-target="#remote-queue-modal">
                                    Login to get this number
                                </a>
                                @endif
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12" ng-show="estimates.lower_limit && estimates.upper_limit">
                            <div class="col-md-5">
                                <h5 class="text-center">Estimated Time: </h5>
                            </div>
                            <div class="col-md-7">
                                <h6 class="text-center">
                                    <span class="glyphicon glyphicon-bell"></span> <span>@{{ estimates.lower_limit }}</span> - <span>@{{ estimates.upper_limit }}</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('modals.broadcast.remote-queue-modal')
        </div>

        <div class="col-md-12 ticker-message mt20">
            @foreach($ticker_message as $message)
                @if($message)
                    <div class="marquee-text hidden">{{ $message }}</div>
                @endif
            @endforeach
            <div class="real-marquee-text"></div>
        </div>
    </div>

</div>
<div class="footer">
    <div class="container">
        <div class="col-md-12 text-center">
            &copy; 2015 : Reminisense Corp.
        </div>
    </div>
</div>
@include('modals.websockets.websocket-loader')

{{--{{ HTML::script('js/bootstrap.min.js') }}--}}
<script src="/js/broadcast/bootstrap.min.js"></script>

{{--{{ HTML::script('js/custom.js') }}--}}
<script src="/js/broadcast/custom.js"></script>

<script src="/js/intlTelInput.js"></script>


<script type="text/javascript" src="/js/reconnecting-websocket.min.js"></script>
<script type="text/javascript" src="/js/websocket-variables.js"></script>
<script type="text/javascript" src="/js/broadcast/lib.js"></script>
<script type="text/javascript" src="/js/broadcast/public-socket.js"></script>
<script src="/js/broadcast/default/public-{{ $box_num }}.js"></script>

{{--<script src="/js/user/Usertracker.js"></script>--}}
<script src="/js/process-queue/process-queue.js"></script>
<script src="/js/process-queue/issue-number-angular.js"></script>

</body>
</html>

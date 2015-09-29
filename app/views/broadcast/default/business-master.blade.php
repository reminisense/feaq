<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/images/favicon.png">
    <title>{{ $business_name }} | FeatherQ</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="/css/ngCloak.css">
    <link href="/css/broadcast/default/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/broadcast/default/broadcast.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/broadcast/default/responsive.css" rel="stylesheet" type="text/css" media="all">

    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script> {{-- RDH Using CDN for Angular JS File --}}

    <script type="text/javascript" src="/js/jquery.marquee.min.js"></script>
    <script type="text/javascript" src="/js/broadcast/default/business-{{ $box_num }}.js"></script>
    <!-- <script type="text/javascript" src="/js/broadcast/update.js"></script> -->

    <script type="text/javascript" src="/js/google-analytics/googleAnalytics.js"></script>
    <script type="text/javascript" src="/js/google-analytics/ga-broadcast.js"></script>
    <script type="text/javascript" src="/js/user/Usertracker.js"></script> {{-- ARA For user tracking --}}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- NAVBAR
  ================================================== -->
<body cz-shortcut-listen="true" id="broadcast" ng-app="BusinessBroadcast" ng-cloak>
<div id="business-id" business_id="{{ $business_id }}"></div>

<div class="top">
    <a class="" href="/"><img src="/images/featherq-home-logo.png"></a>
</div>

<div ng-controller="nowServingCtrl">
    <div class="row-fluid" id="nowServingCtrl">
        <div id="broadcast-type" broadcast_type="{{ $broadcast_type }}"></div>
        <div id="ad-type" ad_type="{{ $ad_type }}"></div>
        <audio id="call-number-sound" src="/audio/doorbell_x.wav" controls preload="auto" autobuffer style="display: none;"></audio>

        <div class="container-fluid">
            @include('broadcast.default.business-' . $template_type)
        </div>
    </div>

    <div class="ticker">
        @foreach($ticker_message as $message)
            <div class="marquee-text hidden">{{ $message }}</div>
        @endforeach
        <div class="real-marquee-text"></div>
    </div>
</div>

{{--<div class="footer">
    &copy; 2015 : Reminisense Corp.
</div>--}}

<script src="/js/broadcast/bootstrap.min.js"></script>
<script src="/js/broadcast/custom.js"></script>

</body>
</html>

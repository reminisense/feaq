<!DOCTYPE html>
<html lang="en">
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
    <!-- Bootstrap core CSS -->
    <link href="/css/broadcast/default/bootstrap.min.css" rel="stylesheet">
    <link href="/css/broadcast/default/biz-broadcast.css" rel="stylesheet">
    <link href="/css/broadcast/default/responsive-bizbroadcast.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

    <script src="/js/jquery-1.11.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script> {{-- RDH Using CDN for Angular JS File --}}

    <script type="text/javascript" src="/js/jquery.marquee.min.js"></script>
    <script type="text/javascript" src="/js/google-analytics/googleAnalytics.js"></script>
    <script type="text/javascript" src="/js/google-analytics/ga-broadcast.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- NAVBAR
  ================================================== -->
<body cz-shortcut-listen="true" id="@if (strpos($broadcast_type, '0-') === false){{'biz-broadcast'}}@else{{'biz-broadcast-no-ads'}}@endif" ng-app="BusinessBroadcast" ng-cloak>
<div id="business-id" business_id="{{ $business_id }}"></div>
<div id="broadcast-type" broadcast_type="{{ $broadcast_type }}"></div>
<div id="ad-type" ad_type="{{ $ad_type }}"></div>
<div id="adspace-size" adspace_size="{{ $adspace_size }}"></div>
@if (strpos($broadcast_type, '0-') === false)
<div class="qrcode qrwrap">
    <p class="nomg"><h4 class="orange">Monitor via your PHONE.</h4> Just scan this QR Code</p>
    <div class="text-center">
        <img class="qrcode" src="https://api.qrserver.com/v1/create-qr-code/?data={{ URL::to('/broadcast/business/' . $business_id) }}&size=120x120">
        <div id="cust-url">
            {{ $_SERVER['HTTP_HOST'] }}/<span>{{ $custom_url }}</span>
        </div>
    </div>
</div>
@endif
<div class="ticker-message">
    @foreach($ticker_message as $message)
        @if($message != "")
            <div class="marquee-text hidden">{{ $message }}</div>
        @endif
    @endforeach
    <p class="nomg real-marquee-text"></p>
</div>
<div class="wrap-broadcast rel" ng-controller="nowServingCtrl">
    <audio id="call-number-sound" src="/audio/doorbell_x.wav" controls preload="auto" autobuffer style="display: none;"></audio>
    @include('broadcast.default.business-' . $broadcast_type)
</div>

@include('modals.websockets.websocket-loader')

<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/reconnecting-websocket.min.js"></script>
<script type="text/javascript" src="/js/websocket-variables.js"></script>
<script type="text/javascript" src="/js/broadcast/lib.js"></script>
<script type="text/javascript" src="/js/broadcast/socket.js"></script>
<script type="text/javascript" src="/js/broadcast/custom.js"></script>
<script type="text/javascript" src="/js/broadcast/default/business-{{ $box_num }}.js"></script>
<script type="text/javascript" src="/js/user/Usertracker.js"></script> {{-- ARA For user tracking --}}
</body>

</html>

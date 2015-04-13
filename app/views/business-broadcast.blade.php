<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>{{ $business_name }} | FeatherQ</title>
    <!-- Bootstrap core CSS -->
    <link href="/css/broadcast/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/broadcast/broadcast.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/broadcast/responsive.css" rel="stylesheet" type="text/css" media="all">

    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script> {{-- RDH Using CDN for Angular JS File --}}
    @if ($tv_mode)
        <script src="/js/ngBusinessBroadcast.tv.js"></script>
    @else
        <script src="/js/ngBusinessBroadcast.js"></script>
    @endif

    <script src="/js/google-analytics/googleAnalytics.js"></script>
    <script src="/js/google-analytics/ga-broadcast.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- NAVBAR
  ================================================== -->
<body cz-shortcut-listen="true" id="broadcast" ng-app="BusinessBroadcast">
<div id="business-id" business_id="{{ $business_id }}"></div>

<div class="top">
    <a class="" href="#"><img src="/images/featherq-home-logo.png"></a>
</div>

<div class="row-fluid" id="nowServingCtrl" ng-controller="nowServingCtrl">
    <div id="broadcast-type" broadcast_type="{{ $broadcast_type }}"></div>
    <audio id="call-number-sound" src="/audio/doorbell_x.wav" controls preload="auto" autobuffer style="display: none;"></audio>
    <div class="container-fluid">
        <div class="col-md-6">
            <img class="img-responsive" src="/images/ads1.jpg" />
        </div>
        <div class="col-md-6">
            <div class="boxed mb20 bcast-big">
                <div class="head">
                    <h4 class="text-center">Now Serving</h4>
                </div>
                <div class="body broadcast">
                    <div class="row-fluid six-nums">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="text-center qrwrap">
                                <p class="orange nomg">On the go?</p>
                                <p class="nomg">Scan this QR Code on your mobile phone</p>
                                <div class="text-center">
                                    <img class="qrcode" src="/images/broadcast/qrcode.jpg" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="numbers t3">
                                <p class="terminal">Terminal 3</p>
                                90
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="numbers t1">
                                <p class="terminal">Terminal 1</p>
                                91
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="numbers t3">
                                <p class="terminal">Terminal 3</p>
                                90
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="numbers t1">
                                <p class="terminal">Terminal 1</p>
                                91
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="numbers t2">
                                <p class="terminal">Terminal 2</p>
                                92
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    &copy; 2015 : Reminisense Corp.
</div>





<script src="/js/broadcast/bootstrap.min.js"></script>
<script src="/js/broadcast/custom.js"></script>





</body>
</html>

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
  {{ HTML::style('css/broadcast/bootstrap.min.css') }}
  {{ HTML::style('css/broadcast/dashboard.css') }}
  {{ HTML::style('css/broadcast/responsive.css') }}

  {{ HTML::script('js/jquery1.11.2.js') }}
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script> {{-- RDH Using CDN for Angular JS File --}}
  {{ HTML::script('js/ngBusinessBroadcast.js') }}

  {{ HTML::script('js/google-analytics/googleAnalytics.js') }}
  {{ HTML::script('js/google-analytics/ga-broadcast.js') }}

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- NAVBAR
  ================================================== -->
<body cz-shortcut-listen="true" id="biz-broadcast" ng-app="BusinessBroadcast">
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
      <a class="navbar-brand" href="{{URL::to('/')}}"><img src="/images/featherq-home-logo.png"></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">

    </div><!--/.nav-collapse -->
  </div>
</nav>


<div class="container main-wrap" id="nowServingCtrl" ng-controller="nowServingCtrl">
    <audio id="call-number-sound" src="/audio/doorbell_x.wav" controls preload="auto" autobuffer style="display: none;"></audio>
  <div class="row mt20">
    <div class="col-md-3 mobileme" style="@{{ qry }}">
      <div class="boxed mb20">
        <div class="head clearfix">
          <h4 class="mt20 orange">On the go?</h4>
          <p class="cyan mt20"><strong>Scan ths QR Code on your mobile phone</strong></p>
          <p class="mt30 mb30">You can monitor numbers what number is currently served  natis in. Maecenas id dui diam. Sed lacinia tincidunt sem id rutrum. </p>
          <div class="sep"></div>
          <div class="text-center">
            <img class="qrcode mt20" style="width:100%;" src="/images/qrcode.jpg" />
          </div>
        </div>
      </div>
    </div>
      <div class="col-md-6 ads" style="@{{ ad_display }}">
        <div id="ad-image-container">
          <img class="img-responsive mb30" src="@{{ ad_image }}" id="image-ad" style="@{{ ad_display_upload }}"/>
            <div id="fqCarousel" class="carousel slide" data-ride="carousel" style="@{{ ad_display_default }}">
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img src="/images/ads.jpg" alt="Ad1">
                </div>
                <div class="item">
                  <img src="/images/broadcast1.jpg" alt="Ad2">
                </div>
                <div class="item">
                  <img src="/images/broadcast2.jpg" alt="Ad3">
                </div>
                <div class="item">
                  <img src="/images/broadcast3.jpg" alt="Ad4">
                </div>
                <div class="item">
                  <img src="/images/broadcast4.jpg" alt="Ad5">
                </div>
              </div>
            </div>
          </div>
        <div id="internet-tv"></div>
      </div>
    <div class="col-md-@{{ colsize }}">
      <div class="boxed mb20 bcast-big">
        <div class="head head-wbtn">
          <h4 class="text-center">Now Serving</h4>
        </div>
        <div class="body broadcast body-gradient">

          <div class="row">
            <div class="col-md-@{{ boxsize }} col-sm-12 col-xs-12" style="@{{ boxdisplay1 }}">
              <div class="numbers t@{{ rank1 }} @{{ spaceht }}">
                <p class="terminal">@{{ name1 }}</p>
                  @{{ box1 }}
              </div>
            </div>
            <div class="col-md-@{{ boxsize }} col-sm-6 col-xs-12" style="@{{ boxdisplay2 }}">
                <div class="numbers t@{{ rank2 }}">
                    <p class="terminal">@{{ name2 }}</p>
                    @{{ box2 }}
                </div>
            </div>
            <div class="col-md-@{{ boxsize }} col-sm-6 col-xs-12" style="@{{ boxdisplay3 }}">
                <div class="numbers t@{{ rank3 }}">
                    <p class="terminal">@{{ name3 }}</p>
                    @{{ box3 }}
                </div>
            </div>
            <div class="col-md-@{{ boxsize }} col-sm-6 col-xs-12" style="@{{ boxdisplay4 }}">
                <div class="numbers t@{{ rank4 }}">
                    <p class="terminal">@{{ name4 }}</p>
                    @{{ box4 }}
                </div>
            </div>
            <div class="col-md-@{{ boxsize }} col-sm-6 col-xs-12" style="@{{ boxdisplay5 }}">
                <div class="numbers t@{{ rank5 }}">
                    <p class="terminal">@{{ name5 }}</p>
                    @{{ box5 }}
                </div>
            </div>
            <div class="col-md-@{{ boxsize }} col-sm-6 col-xs-12" style="@{{ boxdisplay6 }}">
              <div class="numbers t@{{ rank6 }}">
                <p class="terminal none">@{{ name6 }}</p>
                  @{{ box6 }}
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="boxed mb20" style="@{{ qrx }}">
            <div class="head clearfix">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h4 class="orange">On the go?</h4>
                        <p class="cyan"><strong>Scan ths QR Code on your mobile phone</strong></p>
                        <p>You can monitor numbers what number is currently served  natis in. Maecenas id dui diam. Sed lacinia tincidunt sem id rutrum. </p>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <img class="pull-right qrcode img-responsive" src="/images/qrcode.jpg" />
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
      © 2014 : Reminisense Corp.
    </div>
  </div>
</div>


{{ HTML::script('js/broadcast/bootstrap.min.js') }}
{{ HTML::script('js/broadcast/custom.js') }}
{{ HTML::script('js/process-queue/process-queue.js') }}
{{ HTML::script('js/process-queue/issue-number-angular.js') }}





</body>
</html>

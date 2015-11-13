<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>FeatherQ</title>

    <meta name="title" content="FeatherQ"/>
    <meta name="description" content="FeatherQ is a DIY cloud-based queuing platform. We make it easy for businesses to manage their lines better and allow customers to wait on their own terms."/>
    <meta name="author" content="Reminisense, Corp."/>
    <meta name="og:url" content="http://www.featherq.com"/>
    <meta name="og:type" content="website"/>
    <meta name="og:description" content="FeatherQ is a DIY cloud-based queuing platform. We make it easy for businesses to manage their lines better and allow customers to wait on their own terms."/>
    <meta name="og:site_name" content="FeatherQ"/>
    <meta name="og:image" content="http://www.featherq.com/images/banner3.jpg"/>
    <meta name="fb:app_id" content="1574952899417459"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/homepage/main.css">
    <link rel="stylesheet" href="/css/homepage/animate.css">
    <link rel="stylesheet" href="/css/homepage/responsive.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

    <link rel="apple-touch-icon" sizes="57x57" href="/images/homepage/landing/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/homepage/landing/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/homepage/landing/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/homepage/landing/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/homepage/landing/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/homepage/landing/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/homepage/landing/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/homepage/landing/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/homepage/landing/apple-icon-180x180.png">

    <link rel="icon" type="image/png" sizes="192x192"  href="/images/homepage/landing/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/homepage/landing/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/homepage/landing/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/homepage/landing/favicon-16x16.png">

    <link rel="manifest" href="img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <script type="text/javascript" src="/js/angular.min.js"></script>
    <script type="text/javascript" src="/js/ngFeatherQ.js"></script>
    <script type="text/javascript" src="/js/ngFacebook.js"></script>
    <script type="text/javascript" src="/js/ngAutocomplete.js"></script>
    <script type="text/javascript" src="/js/ngDirectives.js"></script>

    <script>window.jQuery || document.write('<script src="/js/jquery-1.11.2.min.js"><\/script>')</script>
    <script type="text/javascript" src="/js/jquery.plugin.js"></script>
    <script type="text/javascript" src="/js/jquery.timeentry.js"></script>
    <script type="text/javascript" src="/js/search-business.js"></script>
    <script type="text/javascript" src="/js/user/Usertracker.js"></script>

</head>
<body id="user-landing" ng-app="FeatherQ" ng-cloak>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" ng-controller="fbController">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="/images/homepage/landing/FeatherQ-logo.png" alt="FeatherQ" /></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" ng-click="login()">Login with Facebook <span class="sr-only">(current)</span></a></li>
                <li><a href="https://play.google.com/store/apps/details?id=com.reminisense.featherq" target="_blank">Download the App</a></li>
                <li><a href="/business">FeatherQ for Business</a></li>
            </ul>
        </div>
    </div>
</nav>

<section id="banner" ng-controller="fbController">
    <div class="container">
        <div class="col-md-6">
            <h1>Don't Waste Your Life &mdash; Waiting</h1>
            <h2 class="sub-heading">Use FeatherQ's mobile application to join lines from anywhere, using your mobile device.</h2>
            <div class="cta">
                <a href="https://play.google.com/store/apps/details?id=com.reminisense.featherq" target="_blank"><img alt="Android app on Google Play" src="https://developer.android.com/images/brand/en_app_rgb_wo_60.png"></a>
                <a href="#" ng-click="login()" class="btn btn-blue"><img src="/images/homepage/landing/fb.png">LOGIN WITH FACEBOOK</a>
            </div>

        </div>
    </div>
</section>

<section id="find-a-business" ng-controller="searchBusinessCtrl">
    <div class="container">
        <div class="col-md-12 wow fadeInUp">
            <h2 class="text-center">Find a Business</h2>
        </div>
        <div class="col-md-12">
            <div class="filterwrap col-md-offset-2 col-md-8">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-4 btn-group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle ng-binding" data-toggle="dropdown">
                            @{{ location_filter }}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1" id="location-filter">
                            <li ng-repeat="location in locations" ng-click="locationFilter(location.code);"><a href="">@{{ location.code }}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 btn-group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle ng-binding" data-toggle="dropdown">
                            @{{ industry_filter }}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                            <li ng-repeat="industry in industries" ng-click="industryFilter(industry.code);"><a href="">@{{ industry.code }}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 btn-group">
                        <input type="text" id="time_open-filter" name="time_open" ng-model="time_open" placeholder="Time Open" class="timepicker form-control">
                    </div>
                    <form class="ng-pristine ng-valid col-md-4 col-sm-4 col-xs-6">
                        <div class="clearfix" style="position: relative;background-color: #fff; border-bottom-left-radius: 4px;">
                            <input class="" type="text" placeholder="ie: Ng Khai Devt Corp" id="search-keyword" ng-model="search_keyword" ng-model-options="{debounce: 1000}" autocomplete="off" >
                            <ul class="dropdown-menu" role="menu" id="search-suggest" ng-hide="dropdown_businesses.length == 0"  outside-click="dropdown_businesses = []">
                                <li ng-repeat="business in dropdown_businesses">
                                    <a href="#" ng-click="searchBusiness(location_filter, industry_filter, business.name, $event)">
                                        <strong class="business-name">@{{ business.name }}</strong><br>
                                        <small class="address">@{{ business.local_address }}</small>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <button type="button" class=" btn btn-black btn-md" ng-click="searchBusiness(location_filter, industry_filter, search_keyword);">SEARCH</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix col-md-12" id="search-loader" style="display: none; text-align: center;">
            <img style="width: 41px;" src="/images/loader-spinner-white.gif" />
        </div>
        <div class="clearfix" id="search-grid" style="display: none;">
            <div class="col-md-12">
                <h5 class="mb30 searchresults" style="color: #fff;">@{{ searchLabel }}</h5>
            </div>
            <div class="col-md-3 ng-scope" ng-repeat="business in businesses">
                <a class="business_link" href="/broadcast/business/@{{ business.business_id }}" target="_blank">
                    <div class="box-wrap">
                        <p class="title ng-binding">@{{ business.business_name }}</p>
                        <small class="ng-binding">@{{ business.local_address }}</small>
                    </div>
                </a>
            </div>
            <div class="col-md-3 ng-scope" ng-controller="fbController">
                <a class="business_link" href="#" ng-click="login()">
                    <div class="box-wrap">
                        <p class="title ng-binding"> More Businesses</p>
                        <small class="ng-binding">Sign up now to view More Businesses</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section id="wait">
    <div class="container">
        <div class="col-md-12">
            <h2 class="wow fadeInUp text-center">Wait on your own terms</h2>
        </div>
        <div class="col-md-4 col-sm-4 text-center wow fadeInUp">
            <img class="img-responsive" src="/images/homepage/landing/wait1.png" alt="Join the line from anywhere" />
            <h4 class="orange">Join the line. From Anywhere.</h4>
            <p>Use FeatherQ to join lines using your smartphone or mobile device. Get into the queue even before you arrive at the store.</p>
        </div>
        <div class="col-md-4 col-sm-4 text-center wow fadeInUp">
            <img class="img-responsive" src="/images/homepage/landing/wait2.png" alt="Freedom away from the line." />
            <h4 class="orange">Freedom away from the line.</h4>
            <p>Hate getting stuck while you wait? Shop, dine and explore-- instead of waiting in one spot.
                Receive real-time updates about your queue status and notifications when you should get back.</p>
        </div>
        <div class="col-md-4 col-sm-4 text-center wow fadeInUp">
            <img class="img-responsive" src="/images/homepage/landing/wait3.png" alt="Share your experience." />
            <h4 class="orange">Share your experience.</h4>
            <p>Share your experiences in line with friends and help them discover a better way to wait.</p>
        </div>
    </div>
</section>

<section id="featherq-features">
    <div class="container">
        <div class="col-md-12">
            <h2 class="wow fadeInUp text-center">FeatherQ Features</h2>
        </div>
        <div class="col-md-6 col-sm-6 text-center wow fadeInUp">
            <img class="img-responsive" src="/images/homepage/landing/feature3.png" alt="Join the line from anywhere" />
            <p>Our geo-locator will help you find the nearest businesses. <br>FeatherQ lets you see the status of their lines.</p>
        </div>
        <div class="col-md-6 col-sm-6 text-center wow fadeInUp">
            <img class="img-responsive" src="/images/homepage/landing/feature2.png" alt="Join the line from anywhere" />
            <p>Join the line virtually using the FeatherQ app. <br>With FeatherQ, you can join lines using your smartphone before you even reach the store.</p>
        </div>
        <div class="col-md-6 col-sm-6 text-center wow fadeInUp">
            <img class="img-responsive" src="/images/homepage/landing/feature1.png" alt="Join the line from anywhere" />
            <p>Receive push notifications on our mobile app<br> whenever your turn is up.</p>
        </div>
        <div class="col-md-6 col-sm-6 text-center wow fadeInUp">
            <img class="img-responsive" src="/images/homepage/landing/feature4.png" alt="Join the line from anywhere" />
            <p>Rate your lining experience with different <br>establishments and share them with your friends!</p>
        </div>
    </div>
</section>

<section id="beat" ng-controller="fbController">
    <div class="container text-center">
        <div class="col-md-12">
            <h2 class="wow fadeInUp text-center">Beat the waiting game</h2>
        </div>
        <div class="col-md-offset-2 col-md-8 text-center wow fadeInUp">
            <p>FeatherQ is free to use. Forever. All you need to start queuing is a Facebook account, and an internet connection.</p>
            <p>Get started now. Download the app  and login using your Facebook account and discover a better way to wait.</p>
            <div class="cta">
                <a href="https://play.google.com/store/apps/details?id=com.reminisense.featherq" target="_blank"><img alt="Android app on Google Play" src="https://developer.android.com/images/brand/en_app_rgb_wo_60.png"></a>
                <a href="#" ng-click="login()" class="btn btn-blue"><img src="/images/homepage/landing/fb.png">LOGIN WITH FACEBOOK</a>
            </div>
            <p class="black">Looking to manage your own line?<p>
                <a href="/business">Try FeatherQ for Business</a>
        </div>
    </div>
</section>

<section class="pre-footer">
    <div class="container">
        <div class="clearfix text-center">
            <div class="col-md-12">
                <p>&copy; 2015 : Reminisense Corporation</p>
            </div>
        </div>
    </div>
</section>

@include('modals.homepage.fb-loader')

<script src="/js/business/landing/wow.min.js"></script>
<script>
    new WOW().init();
</script>

<script src="/js/bootstrap.min.js"></script>
<script src="/js/homepage/main.js"></script>
</body>
</html>

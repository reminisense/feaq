<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href=".././images/favicon.png">

    <title>FeatherQ - @yield('post-title')</title>
    <link rel="stylesheet" type="text/css" href="/css/ngCloak.css">
    <link rel="stylesheet" type='text/css' href="/css/bootstrap.min.css">
    <link rel='stylesheet' type='text/css' href='/css/content/style.css'>
    <link rel='stylesheet' type='text/css' href='/css/content/responsive.css'>
    <link rel='stylesheet' type='text/css' href="/css/content/animate.css" >
    <link rel="stylesheet" type="text/css" href="/css/jquery.timeentry.css">
    <link rel='stylesheet' type='text/css' href='/css/refresh-animate.css'>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css"/>

    <script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/custom.js"></script>
    <script src="/js/ngFeatherQ.js"></script>
    <script src="/js/ngFacebook.js"></script>
    <script src="/js/ngAutocomplete.js"></script>
    <script src="/js/google-analytics/googleAnalytics.js"></script>
    <script src="/js/jquery.plugin.js"></script>
    <script src="/js/jquery.timeentry.js"></script>
    <script src="/js/search-business.js"></script>
    <script src="/js/user/Usertracker.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>

    <script src="/js/google-analytics/googleAnalytics.js"></script>
    <script src="/js/google-analytics/ga-page_front.js"></script>
</head>

<body ng-app="FeatherQ" ng-cloak>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/"><img class="logo" src="{{URL::to('img/featherq-logo.svg')}}"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" ng-controller="fbController">
            <ul class="nav navbar-nav navbar-right">
                <li><a class="feats" href="{{ URL::to('/about') }}">About</a></li>
                <li><a class="feats" href="{{ URL::to('/guides') }}">Set-up Guides</a></li>
                <li style="margin-left:10px;"><a href="" class="btn btn-blue btn-fb" ng-click="login()" role="button"><img src="{{URL::to('img/icon-fb.png')}}">Log In</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<section class="page1">
    <div class="intro">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="wow fadeInUp">#ChangeTheWait</h1>
                </div>
                <div class="wow fadeInUp col-md-6 text-center">
                    <p><span>FeatherQ </span>creates an atmosphere that allows the customer's mobile device to wait in line for them; keeping customers happy and engaged while helping businesses maximize revenue and increase business opportunity.</p>
                </div>
                <div class="hmobile wow fadeInUp col-md-6 text-center">
                    <p><span>FeatherQ</span> is a cloud-based, line-management application that helps businesses successfully control their long lines and turns the wait of customers into a better experience. </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="page2">
    <div class="container">
        <!-- Start of post -->
        @yield('post-content')
    </div>
</section>
<section class="page4">
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <div class="wrap">
                <h3 class="wow fadeInUp text-center">Turn the wait of your customers into a better experience<br>
                    and <span>increase your business opportunity</span>
                </h3>
            </div>
        </div>
        <div class="col-md-7 col-xs-12" style="margin-top:140px;">
            <h4 class="nomg wow fadeInUp">Start using FeatherQ for your business today</h4>
            <h4 class="nomg wow fadeInUp">It's Fast, Easy and Free</h4>
            <br>
            <h4 class="nomg wow fadeInUp">Call us at: <span class="cyan">(032) 345-4658</span></h4>
        </div>
        <div class="col-md-5 col-xs-12" style="margin-top:140px;">
            <div class="text-center" ng-controller="fbController">
                <a class="h1 btn btn-lg btn-blue" ng-click="login()">Continue with Facebook</a>
                <small style="display: block;"><a id="yfb" href="" data-toggle="modal" data-target="#modal-yfacebook" >Why we use Facebook?</a></small>
                <div class="modal fade" id="modal-yfacebook" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" style="z-index: 9999;">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h2 class="cyan">Why Facebook?</h2>
                                <div id="icons">
                                    <span class="glyphicon glyphicon-user"></span>
                                    <span class="glyphicon glyphicon-thumbs-up"></span>
                                    <span class="glyphicon glyphicon-lock"></span>
                                </div>
                                <p>It makes signing into FeatherQ super fast and secure. Instantly share your experiences with your friends.</p>
                                <small>YOUR PRIVACY IS HIGHLY RESPECTED. NOTHING WILL BE POSTED WITHOUT YOUR PERMISSION</small>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="button" class="mb20 btn btn-lg btn-primary" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="">
            <p class="text-center">&copy; 2015: Reminisense Corp.</p>
        </div>
    </div>
</footer>

<script src="js/wow.min.js"></script>
<script>
    $('.slick-slider').slick({
        centerMode: true,
        centerPadding: '60px',
        dots: true,
        infinite: true,
        pauseOnHover: false,
        slidesToShow: 3,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 7000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });

    $('#time_open-filter').timeEntry({ampmPrefix: ' ', spinnerImage: ''});
    new WOW().init();
</script>
</body>
</html>
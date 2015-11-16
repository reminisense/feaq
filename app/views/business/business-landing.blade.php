<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>FeatherQ | Business</title>

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
    <link rel="stylesheet" href="/css/business/landing/main.css">
    <link rel="stylesheet" href="/css/business/landing/animate.css">
    <link rel="stylesheet" href="/css/business/landing/responsive.css">
    <script src="/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

    <link rel="apple-touch-icon" sizes="57x57" href="/images/business/landing/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/business/landing/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/business/landing/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/business/landing/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/business/landing/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/business/landing/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/business/landing/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/business/landing/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/business/landing/apple-icon-180x180.png">

    <link rel="icon" type="image/png" sizes="192x192"  href="/images/business/landing/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/business/landing/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/business/landing/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/business/landing/favicon-16x16.png">

    <link rel="manifest" href="/images/business/landing/manifest.json">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <script type="text/javascript" src="/js/angular.min.js"></script>
    <script type="text/javascript" src="/js/ngFeatherQ.js"></script>
    <script type="text/javascript" src="/js/ngFacebook.js"></script>
    <script type="text/javascript" src="/js/ngAutocomplete.js"></script>


</head>
<body ng-app="FeatherQ" ng-cloak>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="/images/business/landing/FeatherQ-logo.png" alt="FeatherQ"/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#featherq-works">HOW <span class="sr-only">(current)</span></a></li>
                <li><a href="#benefits">BENEFITS</a></li>
                <li><a href="#featherq-features">FEATURES</a></li>
                <li><a href="#who-uses">USES</a></li>
                <li><a href="http://guides.featherq.com" target="_blank">SETUP GUIDE</a></li>
                <li><a href="#contact-us">CONTACT US</a></li>
                <li><a href="/"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
            </ul>
        </div>
    </div>
</nav>

<section id="banner" ng-controller="fbController">
    <div class="container">
        <div class="col-md-12">
            <div id="phone">
                <div class="row wow fadeIn">
                    <div class="col-md-8 col-sm-12">
                        <div data-wow-delay="0.2s"
                             style="visibility: visible; -webkit-animation-delay: 0.2s;
           -moz-animation-delay: 0.2s; animation-delay: 0.2s;">
                            <p>Don't Waste Your Life &mdash; Waiting</p>
                            <h1>FeatherQ is a DIY cloud-based queuing platform. We make it easy for businesses to <span>manage their lines better</span> and allow customers to wait on their own terms.</h1>
                        </div>
                        <div class="clearfix">
                            <p id="start">Start using FeatherQ</p>
                            <a href="#" ng-click="login()" class="btn btn-blue"><img src="/images/business/landing/fb.png">LOGIN WITH FACEBOOK</a>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 visible-sm visible-xs">
                        <img class="img-responsive" style="margin: auto;" src="/images/business/landing/featherq-on-mobile-sm.png" alt="FeatherQ on mobile" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="partners">
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-center">Featured Partners</h3>
        </div>
        <div class="col-md-12 text-center wow fadeIn">
            <img src="/images/business/landing/partner-grab.jpg" alt="Grab Taxi" />
            <img src="/images/business/landing/partner-up.jpg" alt="University of the Philippines - Cebu" />
            <img src="/images/business/landing/partner-primary.jpg" alt="Primary Care Plus" />
            <img src="/images/business/landing/partner-honda.jpg" alt="Honda" />
            <img src="/images/business/landing/partner-isuzu.jpg" alt="Isuzu" />
        </div>
    </div>
</section>

<section id="featherq-works">
    <div class="container">
        <div class="tri text-center">
            <img style="width: inherit" src="/images/business/landing/tri-contact.png">
        </div>
        <div class="col-md-12">
            <h2 class="text-center">How FeatherQ Works</h2>
        </div>
        <div class="col-md-4 col-sm-4 text-center">
            <img class="wow fadeInUp"
                 data-wow-delay="0.1s"
                 style="visibility: visible; -webkit-animation-delay: 0.1s;
           -moz-animation-delay: 0.1s; animation-delay: 0.1s;"
                 src="/images/business/landing/how-featherq-works1.png" alt="1. Sign up" />
            <h4 class="orange wow fadeInUp">1. Sign-up</h4>
            <p class="wow fadeInUp">Sign up is easy! Use your Facebook account to create a free account today.</p>
        </div>
        <div class="col-md-4 col-sm-4 text-center">
            <img class="wow fadeInUp"
                 data-wow-delay="0.3s"
                 style="visibility: visible; -webkit-animation-delay: 0.3s;
           -moz-animation-delay: 0.3s; animation-delay: 0.3s;"
                 src="/images/business/landing/how-featherq-works2.png" alt="2. Set up" />
            <h4 class="orange wow fadeInUp">2. Set-up</h4>
            <p class="wow fadeInUp">Set up your business account and begin serving customers in 5 minutes.</p>
        </div>
        <div class="col-md-4 col-sm-4 text-center">
            <img class="wow fadeInUp"
                 data-wow-delay="0.5s"
                 style="visibility: visible; -webkit-animation-delay: 0.5s;
           -moz-animation-delay: 0.5s; animation-delay: 0.5s;"
                 src="/images/business/landing/how-featherq-works3.png" alt="3. Serve" />
            <h4 class="orange wow fadeInUp">3. Serve</h4>
            <p class="wow fadeInUp">Use FeatherQ to give your customers a better waiting experience.</p>
        </div>
    </div>
</section>

<section id="benefits">
    <div class="container">
        <div class="tri text-center">
            <img style="width: inherit" src="/images/business/landing/tri-benefits.png">
        </div>
        <div class="col-md-12">
            <h2 class="text-center">Benefits of using FeatherQ</h2>
        </div>
        <div class="col-md-4 col-sm-4 text-center">
            <img class="wow fadeInUp" src="/images/business/landing/featherq-benefits-1.png" alt="1. Sign up" />
            <h4 class="wow fadeInUp orange">Reduce Opportunity Loss</h4>
            <p class="wow fadeInUp">Your customers can line up for your business using their cellphone, reducing line that turn customers away.</p>
        </div>
        <div class="col-md-4 col-sm-4 text-center">
            <img class="wow fadeInUp" src="/images/business/landing/featherq-benefits-2.png" alt="1. Set-up" />
            <h4 class="wow fadeInUp orange">Retain Clientele</h4>
            <p class="wow fadeInUp">Build goodwill and transparency by communicating quickly and effectively with waiting guests.</p>
        </div>
        <div class="col-md-4 col-sm-4 text-center">
            <img class="wow fadeInUp" src="/images/business/landing/featherq-benefits-3.png" alt="3. Serve" />
            <h4 class="wow fadeInUp orange">Manage from Anywhere</h4>
            <p class="wow fadeInUp">With FeatherQ, all you need to manage your lines is an internet connection and a web browser. You can access FeatherQ's features on a computer, smartphone or tablet.</p>
        </div>
    </div>
</section>

<section id="featherq-features">
    <div class="container">
        <div class="tri text-center">
            <img style="width: inherit" src="/images/business/landing/tri-contact.png">
        </div>
        <div class="col-md-12">
            <h2 class="text-center">FeatherQ Features</h2>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 text-center wow fadeInUp">
            <div class="rel detail-wrap">
                <img class="img-responsive" src="/images/business/landing/features-30sec.png" alt="30 second setup" />
                <h4>30 second <br>business set-up</h4>
                <div class="abs details">
                    <div class="wrap">
                        <p>In as short as 30-seconds, connect to FB and create your business account to begin managing your lines today. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 text-center wow fadeInUp">
            <div class="rel detail-wrap">
                <img class="img-responsive" src="/images/business/landing/features-flexible.png" alt="Flexible line management" />
                <h4>Flexible <br>line management </h4>
                <div class="abs details">
                    <div class="wrap">
                        <p>Whether you have three terminals serving one line, or only one terminal, FeatherQ can be set for these.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 text-center wow fadeInUp">
            <div class="rel detail-wrap">
                <img class="img-responsive" src="/images/business/landing/features-customizable.png" alt="Customizable Features" />
                <h4>Customizable <br>features</h4>
                <div class="abs details">
                    <div class="wrap">
                        <p>Choose a display layout that fits your business. FeatherQ lets you customize how your customers get informed about their status.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 text-center wow fadeInUp">
            <div class="rel detail-wrap">
                <img class="img-responsive" src="/images/business/landing/features-analytics.png" alt="Business analytics" />
                <h4>Business <br>Analytics</h4>
                <div class="abs details">
                    <div class="wrap">
                        <p>FeatherQ offers insights such as: average waiting time per customer or how many customers dropped their priority number.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 text-center wow fadeInUp">
            <div class="rel detail-wrap">
                <img class="img-responsive" src="/images/business/landing/features-minimal.png" alt="Minimal setup" />
                <h4>Minimal<br>set-up</h4>
                <div class="abs details">
                    <div class="wrap">
                        <p>FeatherQ's browser-based solution works on any smartphone, tablet or computer.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 text-center wow fadeInUp">
            <div class="rel detail-wrap">
                <img class="img-responsive" src="/images/business/landing/features-notification.png" alt="Easy customer notification" />
                <h4>Easy customer <br>notification </h4>
                <div class="abs details">
                    <div class="wrap">
                        <p>Easily reach and inform your customers through SMS or Email.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 text-center wow fadeInUp">
            <div class="rel detail-wrap text-center">
                <img class="img-responsive" src="/images/business/landing/features-simple.png" alt="Simple interface" />
                <h4>Simple <br>interface</h4>
                <div class="abs details">
                    <div class="wrap">
                        <p>FeatherQ comes without bulky training manuals, or complicated instructions.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 text-center wow fadeInUp">
            <div class="rel detail-wrap">
                <img class="img-responsive" src="/images/business/landing/features-free.png" alt="FeatherQ is Free" />
                <h4>It's <br>FREE!</h4>
                <div class="abs details">
                    <div class="wrap">
                        <p>FeatherQ is a complete line management system that is free to use.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="who-uses">
    <div class="container text-center">
        <div class="tri text-center">
            <img class="wow fadeInUp" src="/images/business/landing/bg-who.png">
        </div>
        <div class="col-md-12">
            <h2 class="text-center">Who Uses FeatherQ</h2>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 wow fadeInUp">
            <img src="/images/business/landing/banks.png" alt="Banks" />
            <h5>Banks</h5>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 wow fadeInUp">
            <img src="/images/business/landing/hospitals.png" alt="Hospitals" />
            <h5>Hospitals</h5>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 wow fadeInUp">
            <img src="/images/business/landing/restaurants.png" alt="Restaurants" />
            <h5>Restaurants</h5>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 wow fadeInUp">
            <img src="/images/business/landing/schools.png" alt="Schools" />
            <h5>Schools</h5>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 wow fadeInUp">
            <img src="/images/business/landing/services.png" alt="Services" />
            <h5>Services</h5>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 wow fadeInUp">
            <img src="/images/business/landing/your-business.png" alt="Your Business" />
            <h5>Your Business</h5>
        </div>
    </div>
</section>

<section class="pre-footer" id="contact-us">
    <div class="container ">
        <div class="tri text-center">
            <img src="/images/business/landing/tri-contact.png">
        </div>
        <div class="clearfix">
            <div class="col-md-12">
                <h2 class="text-center">Contact Us!</h2>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <div class="clearfix">
                    <p class="pull-left wow slideInLeft"><img src="/images/business/landing/icon-phone.png" alt="Call Us" />Give us a call</p>
                    <p class="pull-right wow slideInRight"><a style="text-decoration: none" href="tel:0323454658"><span class="orange">(+6332) 345-4658</span></a></p>
                </div>
                <div class="clearfix">
                    <p class="pull-left wow slideInLeft"><img src="/images/business/landing/icon-email.png" alt="Email Us" />Email Us</p>
                    <p class="pull-right wow slideInRight"><a style="text-decoration: none" href="mailto:contact@featherq.com"><span class="orange">contact@featherq.com</span></a></p>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <p class="socials">Check us out on social media
                    <a target="_blank" href="https://plus.google.com/u/0/b/101914769293976664743/101914769293976664743/about" class="ml40"><img src="/images/business/landing/icon-google.png" alt="" /></a>
                    <a target="_blank" href="https://twitter.com/thefeatherq"><img src="/images/business/landing/icon-twitter.png" alt="" /></a>
                    <a target="_blank" href="https://www.facebook.com/theFeatherQ"><img src="/images/business/landing/icon-fb.png" alt="" /></a>
                </p>
            </div>
        </div>
    </div>
</section>


<div class="clearfix">
    <footer class="text-center">
        <div class="container">
            <p>&copy; 2015 : Reminisense Corporation</p>
        </div>
    </footer>
</div>

@include('modals.homepage.fb-loader')

<script src="/js/business/landing/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<script>window.jQuery || document.write('<script src="/js/jquery-1.11.2.min.js"><\/script>')</script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/business/landing/main.js"></script>
</body>
</html>

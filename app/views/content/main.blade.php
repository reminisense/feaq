<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>FeatherQ - About</title>
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
            <a href="/"><img class="logo" src="img/featherq-logo.svg"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" ng-controller="fbController">
            <ul class="nav navbar-nav navbar-right">
                <li><a class="feats" href="{{ URL::to('/about') }}">About</a></li>
                <li><a class="feats" href="{{ URL::to('/guides') }}">Set-up Guide</a></li>
                @if(Auth::check())
                    <li style="margin-left:10px;"><a href="/">Back to Homepage</a></li>
                @else
                    <li style="margin-left:10px;"><a href="" class="btn btn-blue btn-fb" ng-click="login()" role="button"><img src="/img/icon-fb.png">Log In</a></li>
                @endif
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
        <h1 class="orange wow fadeInUp">What We Know About Lining Up</h1>
        <!-- Start of excerpt -01-->
        <div class="col-md-10 col-xs-10">
            <div class="wrap">
                <h2 class="wow fadeInUp text-left">What is Queuing and Other Terms</h2>
            </div>
        </div>
        <div class="col-md-2 col-xs-2">
            <div class="wrap">
                <h6 class="wow fadeInUp text-left"></h6>
            </div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap"><hr /></div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap">
                If you're reading this article, it can only mean one thing: you are a business owner looking for a solution.
                <br /><br />
                It could be that your retail outlet is frequently understaffed in relation to the amount of people coming in, costing you thousands of dollars in efficiency losses. Maybe you're a successful restaurant owner who has noticed that your otherwise loyal customers have begun patronizing other establishment rather than deal with the lunch time crowd at your place.
            </div>
        </div>
        <div class="col-md-8 col-xs-8" style="text-align: right; padding-bottom: 30px;">
            <div class="wrap"><a href="/articles/what-is-queuing">Read more &raquo;</a></div>
        </div>
        <!-- End of excerpt -01-->

        <!-- Start of excerpt 00-->
        <div class="col-md-10 col-xs-10">
            <div class="wrap">
                <h2 class="wow fadeInUp text-left">Managing Lines: Gaining Competitive Advantage by Efficient Queue Management</h2>
            </div>
        </div>
        <div class="col-md-2 col-xs-2">
            <div class="wrap">
                <h6 class="wow fadeInUp text-left"></h6>
            </div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap"><hr /></div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap">
                Waiting in line can be an enjoyable experience, but most of the time, it can be extremely frustrating and agonizing for both customer and store manager.
                <br /><br />
                In today's market, the competition is very intense. One business may potentially lose a customer just by making them wait.  Since queues are basic to both internal and external business processes, understanding the nature of it would lead to an increase in competitive advantage.
            </div>
        </div>
        <div class="col-md-8 col-xs-8" style="text-align: right; padding-bottom: 30px;">
            <div class="wrap"><a href="/articles/managing-lines">Read more &raquo;</a></div>
        </div>
        <!-- End of excerpt 00-->

        <!-- Start of excerpt 01-->
        <div class="col-md-10 col-xs-10">
            <div class="wrap">
                <h2 class="wow fadeInUp text-left">Customer's Time Perception</h2>
            </div>
        </div>
        <div class="col-md-2 col-xs-2">
            <div class="wrap">
                <h6 class="wow fadeInUp text-left"></h6>
            </div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap"><hr /></div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap">
                Studies have repeatedly shown that our perception of time isn't constant. As we grow older, our perception of time is that it is moving faster; this is called the reminiscence effect. As we grow older, we tend to reminisce about the more memorable first events; your first kiss, going to college, getting married and having children.
                <br /><br />
                As time moves forward however, life becomes more routine and more mundane because we've already experienced them. Hence, we create fewer memorable moments and as a result -- time has the illusion of moving faster.
            </div>
        </div>
        <div class="col-md-8 col-xs-8" style="text-align: right; padding-bottom: 30px;">
            <div class="wrap"><a href="/articles/customer-time-perception">Read more &raquo;</a></div>
        </div>
        <!-- End of excerpt 01-->

        <!-- Start of excerpt 02-->
        <div class="col-md-10 col-xs-10">
            <div class="wrap">
                <h2 class="wow fadeInUp text-left">Just In Time</h2>
            </div>
        </div>
        <div class="col-md-2 col-xs-2">
            <div class="wrap">
                <h6 class="wow fadeInUp text-left"></h6>
            </div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap"><hr /></div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap">
                Waiting has always been a part of our daily lives. Everyone has experienced waiting in line at a retail store, a bank, a supermarket, a government office and any number of places. We always experience waiting times for almost every service offered by these establishments.
                <br /><br />
                This is considered as queuing problem. This usually happens when a number of physical entities are attempting to receive service from limited servers, resulting to a line build-up.
            </div>
        </div>
        <div class="col-md-8 col-xs-8" style="text-align: right; padding-bottom: 30px;">
            <div class="wrap"><a href="/articles/just-in-time">Read more &raquo;</a></div>
        </div>
        <!-- End of excerpt 02-->

        <!-- Start of excerpt 03-->
        <div class="col-md-10 col-xs-10">
            <div class="wrap">
                <h2 class="wow fadeInUp text-left">Serpentine Queue</h2>
            </div>
        </div>
        <div class="col-md-2 col-xs-2">
            <div class="wrap">
                <h6 class="wow fadeInUp text-left"></h6>
            </div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap"><hr /></div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap">
                People find it really agonizing to be forced to wait in line. It causes boredom, annoyance and sometimes even rage. On an average, a person waits for the equivalent of three years of their entire life. That's three years of wasted time that should have been invested in something more productive.
                <br /><br />
                This is precisely why some experts in the field of queuing are carefully studying this subject.
            </div>
        </div>
        <div class="col-md-8 col-xs-8" style="text-align: right; padding-bottom: 30px;">
            <div class="wrap"><a href="/articles/serpentine-queue">Read more &raquo;</a></div>
        </div>
        <!-- End of excerpt 03-->

        <!-- Start of excerpt 04-->
        <div class="col-md-10 col-xs-10">
            <div class="wrap">
                <h2 class="wow fadeInUp text-left">What Makes You Anxious</h2>
            </div>
        </div>
        <div class="col-md-2 col-xs-2">
            <div class="wrap">
                <h6 class="wow fadeInUp text-left"></h6>
            </div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap"><hr /></div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap">
                We spend valuable time away from the important things in life, like family and our loved ones, in order to withdraw money, to get passports and visas, to enroll in school, to eat in restaurants, to buy tickets, to take rides in the amusement parks, to see doctors and dentists, to buy medicine, and many more.
                <br /><br />
                Different forms of waiting make us anxious and different places evoke different situations where waiting occurs.
            </div>
        </div>
        <div class="col-md-8 col-xs-8" style="text-align: right; padding-bottom: 30px;">
            <div class="wrap"><a href="/articles/what-makes-you-anxious">Read more &raquo;</a></div>
        </div>
        <!-- End of excerpt 04-->

        <!-- Start of excerpt 05-->
        <div class="col-md-10 col-xs-10">
            <div class="wrap">
                <h2 class="wow fadeInUp text-left">Why Queue Management Is Important</h2>
            </div>
        </div>
        <div class="col-md-2 col-xs-2">
            <div class="wrap">
                <h6 class="wow fadeInUp text-left"></h6>
            </div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap"><hr /></div>
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="wrap">
                In an average lifetime, a person loses a total of almost three years while waiting in line. Despite the fast-paced and instant-service world that modern living has afforded us, one cannot escape lining up to pay the bills, to buy groceries, to gas up, to ride an elevator or to ride a plane.
                <br /><br />
                Waiting in one area compounds the time you spend idling in other areas. Take an extra five to 10 minutes waiting in line at the grocers and suddenly, you're stuck in the middle of rush hour traffic.
            </div>
        </div>
        <div class="col-md-8 col-xs-8" style="text-align: right; padding-bottom: 30px;">
            <div class="wrap"><a href="/articles/why-queue-management-important">Read more &raquo;</a></div>
        </div>
        <!-- End of excerpt 05-->

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
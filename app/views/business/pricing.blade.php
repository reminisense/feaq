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
    <meta name="keywords" content="queueing, queuing, queue, line, lining, wait, waiting, priority, online, software"/>
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
    <link rel="stylesheet" href="/css/process-queue/demo.css">
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
    <script type="text/javascript" src="/js/process-queue/demo-angular.js"></script>


</head>
<body ng-app="FeatherQ" class="pricing" ng-cloak>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img id="biz-fq-logo" src="/images/business/landing/FeatherQ-logo.png" alt="FeatherQ"/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/"><span class="glyphicon glyphicon-home"></span> </a></li>
                <li><a href="/business#partners">BENEFITS</a></li>
                <li><a href="/business#featherq-works">HOW IT WORKS<span class="sr-only">(current)</span></a></li>
                <li><a href="/business#featherq-features">FEATURES</a></li>
                <li class="active"><a href="/business/pricing">PRICING</a></li>
                <li><a href="/business#contact-us">CONTACT US</a></li>
            </ul>
        </div>
    </div>
</nav>

<section id="bannerx" ng-controller="fbController">
    <div class="container">
        <div class=" text-center">
            <div class="wow fadeIn">
                <h3>FeatherQ Pricing</h3>
                <div class="">
                    <table id="pricing" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="">
                                    <div class="head">
                                        <span class="pack head1">PACKAGE</span>
                                        <span class="price head2"></span>
                                    </div>
                                </th>
                                <th>
                                    <div class="head">
                                        <span class="pack heada">Basic</span>
                                        <span class="price headb">$99<span>/mo</span></span>
                                    </div>
                                </th>
                                <th>
                                    <div class="head">
                                        <span class="pack headc">Plus</span>
                                        <span class="price headd">$299<span>/mo</span></span>
                                    </div>
                                </th>
                                <th>
                                    <div class="head">
                                        <span class="pack heade">Pro</span>
                                        <span class="price headf">$699<span>/mo</span><br></span>
                                        <small>Initial Software Rights
                                                                                    does not include hardware. Hardware
                                                                                    and installation costs are separate.
                                                                                    Available upon request of quotation.</small>

                                    </div>
                                </th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Services</td>
                                <td>3</td>
                                <td class="apple">3</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>Terminal</td>
                                <td>3</td>
                                <td class="banana">3</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>2-Way Messsaging</td>
                                <td><span class="glyphicon glyphicon-ok"></span></td>
                                <td class="apple"><span class="glyphicon glyphicon-ok"></span></td>
                                <td><span class="glyphicon glyphicon-ok"></span></td>
                            </tr>
                            <tr>
                                <td>Email Notification</td>
                                <td><span class="glyphicon glyphicon-ok"></span></td>
                                <td class="banana"><span class="glyphicon glyphicon-ok"></span></td>
                                <td><span class="glyphicon glyphicon-ok"></span></td>
                            </tr>
                            <tr>
                                <td>SMS Notification <small>(Optional)</small></td>
                                <td>$0.01/SMS Notification</td>
                                <td class="apple">$0.01/SMS Notification</td>
                                <td>$0.01/SMS Notification</td>
                            </tr>
                            <tr>
                                <td>Support</td>
                                <td>Software Support</td>
                                <td class="banana">24/7 Support</td>
                                <td>24/7 Support</td>
                            </tr>
                            <tr>
                                <td>Analytics</td>
                                <td><strong>Basic Analytics </strong><br><small>(Total numbers
                                    issued, total numbers called, total
                                    numbers served, total numbers
                                    dropped, average waiting time,
                                    average serving time)</small></td>
                                <td class="apple"><strong>Advanced Analytics </strong><br><small>(Log and Staff
                                    Reports: Terminal user numbers
                                    called/dropped/served, average
                                    serving time per terminal user,
                                    graph of peak activity in queuing or
                                    the volume of people who enters the
                                    queue at a certain time)</small></td>
                                <td><strong>Advanced Analytics </strong><br><small>(Log and Staff
                                    Reports and Branch Summary —
                                    Log and staff reports of different branches under a Pro level account;
                                    Comparative look at individual
                                    branch performance)</small></td>
                            </tr>
                            <tr>
                                <td>Broadcast Customization</td>
                                <td>Unlimited Number of Images</td>
                                <td class="banana">Unilimited Number of Images,
                                    5 Videos/Infomercials</td>
                                <td>Unilimited Number of Images,
                                    10 Videos/Infomercials</td>
                            </tr>
                            <tr>
                                <td>Public Broadcast</td>
                                <td><span class="glyphicon glyphicon-ok"></span></td>
                                <td class="apple"><span class="glyphicon glyphicon-ok"></span></td>
                                <td><span class="glyphicon glyphicon-ok"></span></td>
                            </tr>
                            <tr>
                                <td>Remote Queuing Feature</td>
                                <td><span class="glyphicon glyphicon-ok"></span></td>
                                <td class="banana"><span class="glyphicon glyphicon-ok"></span></td>
                                <td><span class="glyphicon glyphicon-ok"></span></td>
                            </tr>
                            <tr>
                                <td>Data Ownership</td>
                                <td class="nodata"></td>
                                <td class="apple">Shared Hosting</td>
                                <td>With own Virtual Server</td>
                            </tr>
                            <tr>
                                <td>Custom URL</td>
                                <td class="nodata"></td>
                                <td class="banana"><span class="glyphicon glyphicon-ok"></span></td>
                                <td><span class="glyphicon glyphicon-ok"></span></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">Take Action Now! <span class="orange glyphicon glyphicon-arrow-right"></span> </td>
                                <td><a href="/business/#contact-us" class="btn heada btn-md">Request for Quotation</a></td>
                                <td class="apple"><a href="/business/#contact-us" class="btn headc btn-md">Request for Quotation</a></td>
                                <td><a href="/business/#contact-us" class="btn heade btn-md">Request for Quotation</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="clearfix">
    <footer class="text-center">
        <div class="container">
            <p>2015  : <a href="http://reminisense.com/" target="_blank">Reminisense Corporation</a></p>
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
    <style type="text/css">


        	/*
        	Max width before this PARTICULAR table gets nasty
        	This query will take effect for any screen smaller than 760px
        	and also iPads specifically.
        	*/
        	button.heada, button.headc, button.heade {
                color: #fff!important;
            }
        	@media
        	only screen and (max-width: 992px),
        	(min-device-width: 768px) and (max-device-width: 1024px)  {

        		/* Force table to not be like tables anymore */
        		table, thead, tbody, th, td, tr {
        			display: block;
        		}

        		/* Hide table headers (but not display: none;, for accessibility) */
        		thead tr {
        			position: absolute;
        			top: -9999px;
        			left: -9999px;
        		}

        		tr { border: 1px solid #ccc; }

        		td {
        			/* Behave  like a "row" */
        			border: none;
        			border-bottom: 1px solid #eee;
        			position: relative;
        			padding-left: 50%;
        		}

        		td:before {
        			/* Now like a table header */
        			position: absolute;
        			/* Top/left values mimic padding */
        			left: 0px;
        			width: 45%;
        			padding-right: 10px;
        			white-space: nowrap;
        			vertical-align: middle;
                        text-align: left;

                        padding-left: 15px;
                        font-weight: 700;
        		}

        		/*
        		Label the data
        		*/
        		td:nth-of-type(1):before { content: ""; text-align: left!important;}
        		td:nth-of-type(2):before { content: "BASIC"; }
        		td:nth-of-type(3):before { content: "PLUS"; }
        		td:nth-of-type(4):before { content: "PRO"; }
        		.apple {
        		    background-color: #bfe2e2!important;
        		}
        		table#pricing tr td:first-child {
                    font-weight: 700;
                    color: #fff;
                    background-color: #00BA8B;
                    width: 100%;
        		}
        		.nodata {
        		    height: 47px;;
        		}
        		#banner table .btn {
        		    padding: 12px 20px;
        		}


        	}

        	/* Smartphones (portrait and landscape) ----------- */
        	@media only screen
        	and (min-device-width : 320px)
        	and (max-device-width : 480px) {
        		body {
        			padding: 0;
        			margin: 0;
        			width: 320px; }
        		}


        	/* iPads (portrait and landscape) ----------- */
        	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        		body {
        			width: 495px;
        		}
        	}


    </style>
</body>
</html>

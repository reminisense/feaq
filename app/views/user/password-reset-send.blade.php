<!doctype html>
<html>
<head>
    <title>FeatherQ</title>
    <meta name="title" content="FeatherQ"/>
    <meta name="description" content="FeatherQ is a DIY cloud-based queuing platform. We make it easy for businesses to manage their lines better and allow customers to wait on their own terms."/>
    <meta name="author" content="Reminisense, Corp."/>
    <meta name="keywords" content="queueing, queuing, queue, line, lining, wait, waiting, priority, online, software"/>
    <meta name="og:url" content="http://www.featherq.com"/>
    <meta name="og:type" content="website"/>
    <meta name="og:description" content="FeatherQ is a DIY cloud-based queuing platform. We make it easy for businesses to manage their lines better and allow customers to wait on their own terms."/>
    <meta name="og:site_name" content="FeatherQ"/>
    <meta name="fb:app_id" content="1574952899417459"/>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/signup/signup.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>


    <script type="text/javascript" src="/js/angular.min.js"></script>
    <script type="text/javascript" src="/js/ngFeatherQ.js"></script>
    <script type="text/javascript" src="/js/ngFacebook.js"></script>
    <script type="text/javascript" src="/js/ngAutocomplete.js"></script>
    <script type="text/javascript" src="/js/ngDirectives.js"></script>

    <script>window.jQuery || document.write('<script src="/js/jquery-1.11.2.min.js"><\/script>')</script>
    <script type="text/javascript" src="/js/jquery.plugin.js"></script>
    <script type="text/javascript" src="/js/jquery.timeentry.js"></script>
    <script type="text/javascript" src="/js/user/ngEmailAuth.js"></script>
</head>
<body ng-app="FeatherQ" ng-cloak>

<section id="signup-header">
        <div class="">
            <div class="container">
                <div class="text-center col-md-12">
                    <a class="logo" href="/"><img src="/images/homepage/landing/FeatherQ-logo.png" alt="FeatherQ" /></a>
                    {{--<p class="subhead">Sign up in 30 seconds. No credit card required.<br>
                    Already have a FeatherQ account? <a href="/user/login">Log in here</a></p>--}}
                    <div class="col-md-12">
                        <h3 class="mt40">Password Reset</h3>
                        <p class="">We'll email you instructions on how to reset your password</p>
                    </div>
                </div>
            </div>
            <div class="tri text-center"><img src="/images/homepage/tri.png"></div>
        </div>
    </section>

    <section id="signup-body">

            {{--<div ng-controller="emailAuthController">
                <form ng-submit="send_password_reset()">
                    <label>Email</label>
                    <input type="text" name="email" ng-model="email">
                    <button type="submit">Reset Password</button>
                    <div>
                        <p>@{{ message }}</p>
                    </div>
                </form>
            </div>--}}

            <div class="">
                <div class="container">
                    <div class="col-md-offset-3 col-md-6 text-center" ng-controller="emailAuthController">

                        <div class="col-md-12">
                            <p>@{{ message }}</p>
                        </div>

                        <form id="login" class=" col-md-12" ng-submit="send_password_reset()">
                            <div class="clearfix">
                                <label>Email</label>
                                <div class="rel">
                                    <i class="abs glyphicon glyphicon-user"></i>
                                    <input class="abs form-control" type="email" name="email" ng-model="email"/>
                                </div>
                            </div>


                            <div class="row mt30">
                                <div class="col-md-6 col-xs-12 text-left ">
                                    <a class="forgot-pass no-line" href=""><i class="glyphicon glyphicon-circle-arrow-left"></i> Return to Login</a>
                                </div>
                                <div class="col-md-6 col-xs-12 text-right ">
                                    <button class="btn btn-teal" type="submit">Reset Password</button>
                                </div>
                            </div>
                        </form>

                    </div>


                </div>
            </div>
    </section>



</body>
</html>
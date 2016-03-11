<!doctype html>
<html>
<head>
    <title>FeatherQ</title>
    <meta name=viewport content="width=device-width,initial-scale=1">
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
                </div>
            </div>
            <div class="tri text-center"><img src="/images/homepage/tri.png"></div>
        </div>
    </section>

    <section id="signup-body">
            <div class="">
                <div class="container">
                    <div class="col-md-offset-3 col-md-6 text-center" ng-controller="emailAuthController">
                        <div class="clearfix col-md-12">
                            <div class="alert alert-warning" ng-show="error_message != ''">@{{ error_message  }}</div>
                        </div>
                        <form id="login" class="" ng-submit="login()">
                            <div class="clearfix">
                                <label>Email</label>
                                <div class="rel">
                                    <i class="abs glyphicon glyphicon-user"></i>
                                    <input class="abs form-control" type="email" name="email" ng-model="email"/>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label>Password</label>
                                <div class="rel">
                                    <i class="abs glyphicon glyphicon-lock"></i>
                                    <input class="abs form-control" type="password" name="password" ng-model="password"/>
                                </div>
                            </div>

                            <div class="row mt30">
                                <div class="col-md-6 col-xs-6 text-left">
                                    <a class="forgot-pass no-line" href="/user/forgot-password"><i class="glyphicon glyphicon-question-sign"></i>Forgot password?</a>
                                </div>
                                <div class="col-md-6 col-xs-6 text-right ">
                                    <button class="btn btn-teal" type="submit">LOGIN</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class=" text-center col-md-12" ng-controller="fbController">
                        <p class="or">Or</p>
                        <a href="#" ng-click="login()" class="no-line btn btn-fb"><img src="/images/homepage/fb2.png">LOGIN WITH FACEBOOK</a>
                        <br><br><br>
                        <p>Doesn't have an account? <a href="/user/register"> Create an account for Free!</a></p>
                    </div>
                </div>
            </div>
    </section>




        @include('modals.homepage.fq-loader')
        @include('modals.homepage.fb-loader')

        <script src="/js/bootstrap.min.js"></script>
    </body>
    </html>



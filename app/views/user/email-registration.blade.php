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
                        <h2 class="mt40">Get started with a free account</h2>
                        <p class="subhead">Sign up in 30 seconds. No credit card required.<br>
                        Already have a FeatherQ account? <a href="/user/login">Log in here</a></p>
                    </div>
                    <div class="tri text-center"><img src="/images/homepage/tri.png"></div>
                </div>
            </div>
        </section>

<section id="signup-body">
            <div class="">
                <div class="container">
                    <div class="col-md-offset-3 col-md-6 text-center" ng-controller="emailAuthController">
                        <form id="login" class=" col-md-12" ng-submit="register()">
                            <div class="clearfix">
                                <label>Email</label>
                                <div class="rel">
                                    <i class="abs glyphicon glyphicon-envelope"></i>
                                    <input class="abs form-control" type="email" name="email" ng-model="email" required />
                                </div>
                            </div>
                            <div class="clearfix">
                                <label>Password</label>
                                <div class="rel">
                                    <i class="abs glyphicon glyphicon-lock"></i>
                                    <input class="abs form-control" type="password" name="password" ng-model="password" required/>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label>Confirm Password</label>
                                <div class="rel">
                                    <i class="abs glyphicon glyphicon-lock"></i>
                                    <input class="abs form-control" type="password" name="password_confirm" ng-model="password_confirm" required compare-to="password"/>
                                </div>
                             </div>

                            <div class="row mt30">
                                <div class="col-md-5 col-xs-12">
                                    {{--<a class="forgot-pass no-line" href="/user/forgot-password">Forgot password?</a>--}}
                                    <i class="abs glyphicon glyphicon-book"></i><a href="" class="forgot-pass no-line">Visit our Privacy Policy</a>
                                </div>
                                <div class="col-md-7 col-xs-12 text-right ">
                                    <button class="btn btn-teal" type="submit">CREATE MY ACCOUNT</button>
                                </div>
                            </div>
                        </form>
                        <div class="alert alert-danger" ng-show="error_message != ''">@{{ error_message  }}</div>
                        <div class="alert alert-success" ng-show="success_message != ''">@{{ success_message  }}</div>
                    </div>

                    <div class=" text-center col-md-12" ng-controller="fbController">
                        <p class="or">Or</p>
                        <a href="#" ng-click="login()" class="no-line btn btn-fb"><img src="/images/homepage/fb2.png">LOGIN WITH FACEBOOK</a>
                        <br><br><br>

                    </div>
                </div>
            </div>
    </section>

{{--<div class="col-md-12" ng-controller="emailAuthController">
    <form ng-submit="register()">
        <label>Email</label>

        <input type="email" name="email" ng-model="email" required />
        <label>Password</label>

        <input type="password" name="password" ng-model="password" required/>
        <label>Confirm Password</label>

        <input type="password" name="password_confirm" ng-model="password_confirm" required compare-to="password"/>
        <button type="submit">SIGN UP</button>
    </form>
    <div class="alert alert-danger" ng-show="error_message != ''">@{{ error_message  }}</div>
</div>
<hr/>
<div class="col-md-12" ng-controller="fbController">
    <a href="#" ng-click="login()" class="btn btn-blue"><img src="/images/homepage/landing/fb.png">LOGIN WITH FACEBOOK</a>
</div>--}}

@include('modals.homepage.fq-loader')

<script src="/js/bootstrap.min.js"></script>
</body>
</html>



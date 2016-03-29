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
                                <div class="col-md-5 col-sm-5 col-xs-12 text-left" id="privacy-policy">
                                    {{--<a class="forgot-pass no-line" href="/user/forgot-password">Forgot password?</a>--}}
                                    <a href="" data-toggle="modal" data-target="#privacyModal" class="nomg forgot-pass privacy no-line">
                                    <i class="glyphicon glyphicon-book"></i>Visit our Privacy Policy</a>
                                </div>
                                <div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="privacyModal">
                                  <div class="modal-dialog modal-lg text-left" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">PRIVACY POLICY</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>The Privacy Policy governs your use of FeatherQ Mobile Application, a DIY cloud-based line-management application, created by Reminisense Corporation.</p>
                                        <p>Reminisense is committed to protecting your privacy and customer information security. Thus, we do not collect any information from you, except where it is explicitly and knowingly provided.</p>

                                        <h5>Customer Information</h5>
                                        <p>In order to use FeatherQ, one is required to register or login through Facebook. Upon registration, you generally provide (a) your name, (b) email address, (c) gender, (d) address, and (e) contact number. Other means of obtaining information provided by users is through a manual business sign-up/creation or information you enter/update in your profile when using FeatherQ. This information is used primarily for basic processing of queues and appointments, online tracking and billing purposes, and analytical and/or comparative reports.</p>

                                        <h5>Data Security</h5>
                                        <p>Generally, Reminisense prohibits the transfer of data from users to third parties. However, we may disclose information when:</p>
                                            <ul>
                                                <li>required by law, such as to comply with a subpoena or similar legal process; and,
                                                <li>in good faith, the disclosure is necessary to protect our rights and protect our clients and/or user’s safety.</li>
                                            </ul>
                                        <p>Reminisense is concerned about safeguarding the privacy and confidentiality of the client information. However, we disclaim any liability for possible breach of data security from external factors, such as force of entry to the security system.</p>


                                        <h5>Policy Changes</h5>
                                        <p>Reminisense reserves the right to change, amend, and update these policies from time to time.</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-7 col-sm-7 col-xs-12 text-right " id="create-account">
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
@include('modals.homepage.fb-loader')
<script src="/js/bootstrap.min.js"></script>
</body>
</html>



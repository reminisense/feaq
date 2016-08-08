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

    <link rel="stylesheet" href="/css/jquery-ui.css">
    <link rel='stylesheet' type='text/css' href='/css/jquery-ui.structure.min.css'>
    <link rel='stylesheet' type='text/css' href='/css/jquery-ui.theme.min.css'>
    <link media="all" type="text/css" rel="stylesheet" href="/css/intlTelInput.css">


    <script type="text/javascript" src="/js/angular.min.js"></script>
    <script type="text/javascript" src="/js/ngFeatherQ.js"></script>
    <script type="text/javascript" src="/js/ngFacebook.js"></script>
    <script type="text/javascript" src="/js/ngAutocomplete.js"></script>
    <script type="text/javascript" src="/js/ngDirectives.js"></script>

    <script>window.jQuery || document.write('<script src="/js/jquery-1.11.2.min.js"><\/script>')</script>
    <script type="text/javascript" src="/js/jquery.plugin.js"></script>
    <script type="text/javascript" src="/js/jquery.timeentry.js"></script>

    <script src="/js/jquery-ui.min.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="/js/jquery.geocomplete.js"></script>
    <script src="/js/intlTelInput.js"></script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>


</head>
<body ng-app="FeatherQ" ng-cloak>

<section id="signup-header">
        <div class="">
            <div class="container">
                <div class="text-center col-md-12">
                    <a class="logo" href="/"><img src="/images/homepage/landing/FeatherQ-logo.png" alt="FeatherQ" /></a>
                    <h3 class="mt30" style="margin-bottom: 0;">Please confirm your data</h3>
                </div>
            </div>
            <div class="tri text-center"><img src="/images/homepage/tri.png"></div>
        </div>
</section>
    <section id="signup-body">
            <div class="">
                <div class="container">
                    <div class="col-md-offset-2 col-md-8" ng-controller="emailAuthController">

                        <div class="clearfix text-center">
                            <div class=" col-md-12">
                                <div class="alert alert-warning modal-message" id="verifyError" style="display: none;"></div>
                            </div>
                        </div>
                        <form id="verification_form" class="clearfix" ng-submit="verify()">
                            <div class="clearfix">

                                    <input type="hidden" class="user_id" name="user_id" value="" />
                                    <div class="form-group">
                                        <div class="col-md-6  col-xs-12">
                                            <label>First Name</label>
                                            <input type="text" class=" form-control" id="first_name" name="first_name" ng-model="first_name" required />
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label>Last Name</label>
                                            <input type="text" class=" form-control" id="last_name" name="last_name" ng-model="last_name" required />
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label>Email</label>
                                            <input type="email" class=" form-control" id="email" name="email" readonly style="color: #bbb;" value="{{ $email }}" />
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label>Mobile</label>
                                            <input type="text" min="9" maxlength="15" class="mobile form-control" id="mobile" name="mobile" ng-model="mobile" required/>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <label>Location</label>
                                            <input type="text" class="form-control" id="location" name="location" autocomplete="off" ng-model="location" required/>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-xs-12 text-right">
                                    <br>
                                        <button id="start_queuing" type="submit" class="btn btn-teal" ng-click="verify()">START QUEUING</button>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>




{{--<div>
    <div>
        <h3>Please confirm your data</h3>
    </div>
    <div ng-controller="emailAuthController">
        <form id="verification_form" class="clearfix" ng-submit="verify()">
            <input type="hidden" class="user_id" name="user_id" value="" />
            <div class="form-group">
                <div class="col-md-6 has-warning">
                    <label>First Name</label>
                    <input type="text" class=" form-control" id="first_name" name="first_name" ng-model="first_name" required />
                </div>
                <div class="col-md-6">
                    <label>Last Name</label>
                    <input type="text" class=" form-control" id="last_name" name="last_name" ng-model="last_name" required />
                </div>
                <div class="col-md-12">
                    <label>Email <small>(We will only make use of your Facebook email)</small></label>
                    <input type="email" class=" form-control" id="email" name="email" readonly style="color: #bbb;" value="{{ $email }}" />
                </div>
                <div class="col-md-12">
                    <label>Mobile</label>
                    <input type="" min="9" maxlength="15" class=" form-control" id="mobile" name="mobile" ng-model="mobile" required/>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <label>Location</label>
                    <input type="text" class=" form-control" id="location" name="location" autocomplete="off" ng-model="location" required/>
                </div>
            </div>
            <button id="start_queuing" type="submit" class="btn btn-orange btn-lg" ng-click="verify()">START QUEUING</button>
        </form>
        <div class="alert alert-danger modal-message" id="verifyError" style="display: none;"></div>
    </div>
</div>--}}
<script type="text/javascript" src="/js/user/ngEmailAuth.js"></script>
</body>
</html>
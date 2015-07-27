
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>FeatherQ</title>
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/homepage/overrides.css">
  <link rel="stylesheet" type="text/css" href="/css/homepage/responsive.css">
  <link rel="stylesheet" type="text/css" href="/css/homepage/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/css/homepage/slick-theme.css"/>
  <link rel="stylesheet" type="text/css" href="/css/refresh-animate.css"/>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

  <script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="/js/angular.min.js"></script>
  <script type="text/javascript" src="/js/ngFeatherQ.js"></script>
  <script type="text/javascript" src="/js/ngFacebook.js"></script>
  <script type="text/javascript" src="/js/ngAutocomplete.js"></script>
  <script type="text/javascript" src="/js/google-analytics/googleAnalytics.js"></script>
  <script type="text/javascript" src="/js/jquery.plugin.js"></script>
  <script type="text/javascript" src="/js/jquery.timeentry.js"></script>
  <script type="text/javascript" src="/js/search-business.js"></script>
  <script type="text/javascript" src="/js/user/Usertracker.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>

  <script src="/js/google-analytics/googleAnalytics.js"></script>
  <script src="/js/google-analytics/ga-page_front.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
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
            <a class="navbar-brand" href="#">
              <img src="/images/homepage/featherq-logo.png" alt="FeatherQ">
            </a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a class="scroll" href="/about" target="_blank">About</a></li>
              <li><a class="scroll" href="/guides" target="_blank">Set-up Guide</a></li>
              <li class="hidden-xs hidden-sm">
                  <span style="border-right: 1px solid #4e4d4b;
                               margin-top: 14px;
                               position: relative;
                               top: 16px;">
                  </span>
              </li>
              <li><a class="scroll" href="#business">Business</a></li>
              <li><a class="scroll" href="#process">Setup</a></li>
              <li><a class="scroll" href="#benefits">Benefits</a></li>
              <li><a class="scroll" href="#features">Features</a></li>
              <li><a class="scroll" href="#uses">Uses</a></li>
              <li><a class="scroll" href="#contact">Contact us</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <section class="banner">
        <div class="things">
        <div class="container">
        <div class="clearfix">
            <div class="col-md-5">
              <h1>FeatherQ is the world's first DIY cloud-based queuing system. We make it easy for businesses to <span>MANAGE THEIR LINES BETTER</span> and allow customers to wait on their own terms.</h1>
              <div class="mt40 mb40" ng-controller="fbController">
                <a href="" class="btn btn-fb" ng-click="login()" role="button"><img src="/images/homepage/fb.png" /> Signup | Login with Facebook</a>
                <a href="https://play.google.com/store/apps/details?id=com.reminisense.featherq">
                  <img alt="Android app on Google Play"
                       src="https://developer.android.com/images/brand/en_app_rgb_wo_60.png" />
                </a>
              </div>
              <div class="partners">
                <h4>Featured Partners:</h4>
                <img src="/images/homepage/isuzu.png">
                <img src="/images/homepage/grabtaxi.png">
                <img src="/images/homepage/honda.png">
              </div>
            </div>
            <div class="col-md-offset-1 col-md-6">
              <div class="holdphone">
                <img src="/images/homepage/featherq-app.png">
              </div>
            </div>
          </div>
        </div>
        <div></div>
      </section>

      <header>
        <a name="business"></a>
        <section class="lead">
          <div class="container" ng-controller="searchBusinessCtrl">
            <div class="col-md-12">
              <h2 class="text-center"><span>Search</span> for Business</h2>
              <div class="filterwrap col-md-offset-2 col-md-8">
                <div class="row">
                <form ng-submit="searchBusiness(location_filter, industry_filter, search_keyword)">
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
                    <input type="text" id="time_open-filter" name="time_open" ng-model="time_open" placeholder="Time Open" class="form-control">
                  </div>
                  <span class="searchblock">
                    <input class="col-md-4 col-sm-4 col-xs-6" type="text" placeholder="ie: Ng Khai Devt Corp" id="search-keyword" ng-model="search_keyword" ng-model-options="{debounce: 1000}" autocomplete="off">
                    <ul class="dropdown-menu" role="menu" id="search-suggest" ng-hide="dropdown_businesses.length == 0"  outside-click="dropdown_businesses = []">
                        <li ng-repeat="business in dropdown_businesses">
                            <a href="#" ng-click="searchBusiness(location_filter, industry_filter, business.name, $event)">
                                <strong class="business-name">@{{ business.name }}</strong><br>
                                <small class="address">@{{ business.local_address }}</small>
                            </a>
                        </li>
                    </ul>
                  </span>
                  <div class="col-md-2 col-sm-2 col-xs-6">
                    <button type="button" class=" btn btn-orange btn-md" ng-click="searchBusiness(location_filter, industry_filter, search_keyword);">SEARCH</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
            <div class="row" id="search-loader" style="display: none; text-align: center;">
                <img src="/images/reload_home.gif" />
            </div>
            <div id="search-grid" style="display: none;" class="clearfix businesses">
              <div class="col-md-12 col-xs-12 col-sm-12">
                  <h5 class="mb30 searchresults">@{{ searchLabel }}</h5>
              </div>
              <div class="col-md-3" ng-repeat="business in businesses">
                <a class="business_link" href="/broadcast/business/@{{ business.business_id }}" target="_blank">
                <div class="box">
                  <p class="title">@{{ business.business_name }}</p>
                  <small>@{{ business.local_address }}</small>
                  <!--
                  <div class="more">
                    <div class="row">
                      <div class="col-md-4">
                        <small>Calling</small>
                        <p>28</p>
                      </div>
                      <div class="col-md-4">
                        <small>Calling</small>
                        <p>28</p>
                      </div>
                      <div class="col-md-4 status">
                        <small>Status</small>
                        <p>Heavy</p>
                      </div>
                    </div>
                  </div>
                  -->
                </div>
                </a>
              </div>
            </div>
          </div>
        </section>
      </header>

      <a name="process"></a>
      <section class="process">
        <div class="container">
          <div class="row rel">
            <div class="col-md-5 col-md-offset-1">
              <h2>The FeatherQ <span>Process</span></h2>
              <div class="pull-right">
                <ul id="myTabs" class="clearfix nav nav-tabs">
                  <li class="clearfix active">
                    <a href="#signup" id="signup-tab" data-toggle="tab" aria-expanded="true">1. Signup</a>
                  </li>
                  <li class="clearfix">
                    <a href="#setup" id="setup-tab" data-toggle="tab">2. Setup</a>
                  </li>
                  <li class="clearfix">
                    <a href="#serve" id="serve-tab" data-toggle="tab">3. Serve</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-6 ">
              <div class="phone ">
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="signup">
                    <img src="/images/homepage/screen1.jpg">
                  </div>
                  <div role="tabpanel" class="tab-pane fade " id="setup">
                    <img src="/images/homepage/screen2.jpg">
                  </div>
                  <div role="tabpanel" class="tab-pane fade " id="serve">
                    <img src="/images/homepage/screen3.jpg">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <a name="benefits"></a>
      <section class="benefits">
        <div class="container">
          <div class="row" style="margin-bottom:0;">
            <div class="col-md-10 col-md-offset-1">
              <h2><span>Benefits</span> of using FeatherQ</h2>
            </div>
          </div>
          <div class="row" style="margin-top: 0;">
            <div class="col-md-6 col-md-offset-1">
              <h3>Reduce Opportunity Loss</h3>
              <p>Your Customers can line up for your business using their cellphones, reducing ugly lines that turn customers away.</p>
            </div>
            <div class="col-md-4">
              <img class="img-responsive" src="/images/homepage/step1.png" alt="Reduce Opportunity Loss" >
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-md-offset-1">
              <img class="img-responsive" src="/images/homepage/step2.png" alt="Retain Clientele" >
            </div>
            <div class="col-md-6">
              <h3>Retain Clientele</h3>
              <p>Build goodwill and transparency by communicating quickly and effectively with waiting clients.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-md-offset-1">
              <h3>Manage from Anywhere</h3>
              <p>Your Customers can line up for your business using their cellphones, reducing ugly lines that turn customers away.</p>
            </div>
            <div class="col-md-4">
              <img class="img-responsive" src="/images/homepage/step3.png" alt="Manage from Anywhere" >
            </div>
          </div>
        </div>
      </section>

      <a name="features"></a>
      <section class="features">
        <div class="container text-center">
          <div class="clearfix">
            <div class="col-md-12">
              <h2>FeatherQ <span>Features</span></h2>
            </div>
          </div>
          <div class="clearfix">
            <div class="col-md-3">
              <img src="/images/homepage/feat-30.png" alt="" />
              <p>30-second <br>Business Setup</p>
            </div>
            <div class="col-md-3">
              <img src="/images/homepage/feat-flexible.png" alt="" />
              <p>Flexible <br>line management</p>
            </div>
            <div class="col-md-3">
              <img src="/images/homepage/feat-customize.png" alt="" />
              <p>Customizable <br>Features</p>
            </div>
            <div class="col-md-3">
              <img src="/images/homepage/feat-business.png" alt="" />
              <p>Business <br>Analytics</p>
            </div>
            <div class="col-md-3">
              <img src="/images/homepage/feat-minimal.png" alt="" />
              <p>Minimal <br>Setup</p>
            </div>
            <div class="col-md-3">
              <img src="/images/homepage/feat-easy.png" alt="" />
              <p>Easy Customer <br>Notifications</p>
            </div>
            <div class="col-md-3">
              <img src="/images/homepage/feat-simple.png" alt="" />
              <p>Simple <br>Interface</p>
            </div>
            <div class="col-md-3">
              <img src="/images/homepage/feat-free.png" alt="" />
              <p>It's Free</p>
            </div>
          </div>
        </div>
      </section>

      <a name="uses"></a>
      <section class="whocan">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2><span>Who can use</span> FeatherQ</h2>
            </div>
          </div>
          <div class="row imgs">
            <div class="col-md-3">
              <div class="block text-center hos">
                <img src="/images/homepage/hospitals.png" alt="Hospitals" />
                <p>Hospitals</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="block text-center ban">
                <img src="/images/homepage/banks.png" alt="Banks" />
                <p>Banks</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="block text-center sch">
                <img src="/images/homepage/schools.png" alt="Schools" />
                <p>Schools</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="block text-center res">
                <img src="/images/homepage/restaurants.png" alt="Restaurants" />
                <p>Restaurants</p>
              </div>
            </div>
          </div>
          <div class="clearfix mt50">
              <div class="col-md-5">
                <div class="block plus">
                  <h2 class="ml20"><img class="pull-left mr20" src="/images/homepage/plus.png" alt="plus" />Or any service oriented <br>business process!</h2>
                </div>
              </div>
              <div class="col-md-7">
                <div class="block text-left mt20">
                  <p>FeatherQ's DIY line-management platform lets you customize features to fit your business needs. If you have a line that needs managing, we can help.</p>
                </div>
              </div>
          </div>

        </div>
      </section>

      <a name="contact"></a>
      <section class="contactus">
        <div class="container">
          <div class="row">
          <div class="col-md-6">
            <img src="/images/homepage/featherq-footer.png" alt="FeatherQ" />
            <h1>A Powerful, <br>
              Free, <br>
              Online Queue Management System
            </h1>
            <p class="mt50 leave">
              Leave your email below to receive our monthly newsletter on new features, new innovations and news that help you beat the waiting game.
            </p>
            <form id="leaveemail">
              <div id="subscribe-error" class="alert alert-danger text-center" style="display:none;">Please enter a valid email address.</div>
              <div id="subscribe-duplicate" class="alert alert-danger text-center" style="display:none;">User has already subscribed. Please register with a different email.</div>
              <div id="subscribe-success" class="alert alert-success text-center" style="display:none;">Thank you for subscribing.</div>
              <input type="email" id="subscriber-field" placeholder="Your email address">
              <button type="submit" id="subscribe-button" class="btn btn-orange"> Subscribe</button>
              </for>
          </div>
          <div class="col-md-6 signthemup" ng-controller="fbController">
            <p>Allow your customers to wait on their own terms by making their mobile phone hold their spot in line. Gain competitive advantage by changing the way your customers perceive their wait.</p>

            <p>Signup for a <span>FREE FeatherQ account</span> today. <br>
            Managing your lines is as simple as 1,2,3.</p>
            <button class="btn btn-fb" ng-click="login()">Sign up with facebook</button>

            <br>
             <small class="block mt50">
              Business Users receive a *FREE 2-Month SMS Notification Package *Applies to Philippine territories.
            </small>
          </div>
          </div>
        </div>
      </section>

      <footer>
        <section class="footer">
          <div class="container">
            <div class="col-md-12 text-center">
              <p>2015  :  Reminisense Corporation</p>
            </div>
          </div>
        </section>
      </footer>

      <script type="text/javascript" src="/js/homepage/migrate.min.js"></script>
      <script type="text/javascript" src="/js/homepage/slick.min.js"></script>
      <script type="text/javascript" src="/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="/js/homepage/ie10-viewport-bug-workaround.js"></script>
      <script type="text/javascript" src="/js/homepage/scripts.js"></script>
    </body>
    </html>

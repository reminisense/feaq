
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

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
          <div class="navbar-header clearfix">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
              <img class="img-responsive" src="/images/homepage/featherq-logo.png" alt="FeatherQ">
            </a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              {{--<li><a class="scroll" href="/about" target="_blank">About</a></li>--}}
              <li><a href="#business">Businesses</a></li>
              <li><a href="#benefits">Benefits</a></li>
              <li><a href="#features">Features</a></li>
              <li><a href="#uses">Uses</a></li>
              <li><a href="#contact">Contact us</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#process" aria-haspopup="true">Setup <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="http://guides.featherq.com/" target="_blank">Set-up Guide</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <header>
        <section class="banner">
                <div class="things">
                  <div class="container">
                    <div class="clearfix">
                      <div class="col-lg-6 col-md-6 col-sm-8">
                        <h1>FeatherQ is a DIY cloud-based queuing platform. We make it easy for businesses to <span>manage their lines better</span> and allow customers to wait on their own terms.</h1>
                        <div class="mt40 mb40" ng-controller="fbController">
                            <a style="margin-right:5px;" href="https://play.google.com/store/apps/details?id=com.reminisense.featherq">
                                                                                                                                            <img alt="Android app on Google Play"
                                                                                                                                            src="https://developer.android.com/images/brand/en_app_rgb_wo_60.png" />
                                                                                    </a>
                          <a href="" class="btn btn-fb" ng-click="login()" role="button"><span class="fa fa-facebook"></span> Login with Facebook</a>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 hidden-sm hidden-xs">
                        <div class="holdphone">
                          <img src="/images/homepage/featherq-app.png">
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>

        </section>
      </header>

        <section class="featured-partners">
          <div class="container">
            <div class="col-md-12 col-xs-12">
                <h2 class="text-center"><span>Featured Partners</span></h2>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="featured-partners-slides">
                    <div class="col-md-4"><img class="img-responsive" src="/images/homepage/isuzu.png"></div>
                    <div class="col-md-4"><img class="img-responsive" src="/images/homepage/honda.png"></div>
                    <div class="col-md-4"><img class="img-responsive" src="/images/homepage/grabtaxi.png"></div>
                    <div class="col-md-4"><img class="img-responsive" src="/images/homepage/primarycare.png"></div>
                    <div class="col-md-4"><img class="img-responsive" src="/images/homepage/upcebu.png"></div>
                </div>
            </div>
          </div>
        </section>


        <a name="business"></a>
        <section class="lead">
          <div class="container" ng-controller="searchBusinessCtrl">
            <div class="col-md-12">
              <h2 class="text-center"><span>Search Business</span></h2>
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
                    <div class="col-md-4 col-sm-4 col-xs-6">
                      <input type="text" placeholder="ie: Ng Khai Devt Corp" id="search-keyword" ng-model="search_keyword" ng-model-options="{debounce: 1000}" autocomplete="off">
                      <ul class="dropdown-menu" role="menu" id="search-suggest" ng-hide="dropdown_businesses.length == 0"  outside-click="dropdown_businesses = []">
                        <li ng-repeat="business in dropdown_businesses">
                          <a href="#" ng-click="searchBusiness(location_filter, industry_filter, business.name, $event)">
                            <strong class="business-name">@{{ business.name }}</strong><br>
                            <small class="address">@{{ business.local_address }}</small>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-6">
                      <button type="button" class=" btn btn-orange btn-md" ng-click="searchBusiness(location_filter, industry_filter, search_keyword);">SEARCH</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="row" id="search-loader" style="display: none; text-align: center;">
              <img style="width: 41px;" src="/images/reload_home.gif" />
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
                  </div>
                </a>
              </div>
              <div class="col-md-3" ng-if="businesses.length > 0" ng-controller="fbController">
                <a class="business_link" href="#" ng-click="login()">
                  <div class="box">
                    <p class="title"><span class="gray glyphicon glyphicon-plus"></span> More Businesses</p>
                    <small>Sign up now to view More Businesses</small>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </section>


        <a name="process"></a>
        <section class="process">
          <div class="container">
            <div class="row rel">

              <div class="col-lg-5 col-lg-offset-1 col-md-12">
                <h2><span>The FeatherQ Process</span></h2>
                <div class="pull-right  hidden-md hidden-xs">
                  <ul id="myTabs" class="clearfix nav nav-tabs">
                    <li class="clearfix active">
                      <a href="#signup" id="signup-tab" class="tab-flag" data-toggle="tab" aria-expanded="true">1. Signup</a>
                    </li>
                    <li class="clearfix">
                      <a href="#setup" id="setup-tab" class="tab-flag" data-toggle="tab">2. Setup</a>
                    </li>
                    <li class="clearfix">
                      <a href="#serve" id="serve-tab" class="tab-flag" data-toggle="tab">3. Serve</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6 hidden-md hidden-xs">
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

              <div class="hidden-lg visible-md visible-xs visible-sm">
                <div class="clearfix">
                  <div class="col-md-6">
                    <ul id="myTabs" class="clearfix nav nav-tabs">
                      <li class="clearfix active">
                        <a href="#signup" id="signup-tab" class="tab-flag" data-toggle="tab" aria-expanded="true">1. Signup</a>
                      </li>
                      <li class="clearfix">
                        <a href="#setup" id="setup-tab" class="tab-flag" data-toggle="tab">2. Setup</a>
                      </li>
                      <li class="clearfix">
                        <a href="#serve" id="serve-tab" class="tab-flag" data-toggle="tab">3. Serve</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
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
         </div>
       </section>

       <a name="benefits"></a>
       <section class="benefits">
        <div class="container">
          <div class="row" style="margin-bottom:0;">
            <div class="col-md-10 col-md-offset-1">
              <h2><span>Benefits of using FeatherQ</span></h2>
            </div>
          </div>
          <div class="row" style="margin-top: 20px;">
            <div class="col-md-7 col-md-offset-1 col-sm-8 col-xs-12">
              <img class="img-responsive hidden-lg hidden-sm visible-xs" src="/images/homepage/step1.png" alt="Reduce Opportunity Loss" >
              <h3>Reduce Opportunity Loss</h3>
              <p>Your Customers can line up for your business using their cellphones, reducing ugly lines that turn customers away.</p>
            </div>
            <div class="col-md-3 col-sm-4 hidden-xs">
              <img class="img-responsive" src="/images/homepage/step1.png" alt="Reduce Opportunity Loss" >
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 col-md-offset-1  col-sm-4 hidden-xs">
              <img class="img-responsive" src="/images/homepage/step2.png" alt="Retain Clientele" >
            </div>
            <div class="col-md-7">
              <img class="img-responsive hidden-lg hidden-sm visible-xs" src="/images/homepage/step2.png" alt="Retain Clientele" >
              <h3>Retain Clientele</h3>
              <p>Build goodwill and transparency by communicating quickly and effectively with waiting clients.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7 col-md-offset-1 col-sm-8 col-xs-12">
              <img class="img-responsive hidden-lg hidden-sm visible-xs" src="/images/homepage/step3.png" alt="Manage from Anywhere" >
              <h3>Manage from Anywhere</h3>
              <p>With FeatherQ, all you need to manage your lines is an internet connection and a web browser. You can access FeatherQ's features on a computer, smartphone or tablet.</p>
            </div>
            <div class="col-md-3 col-sm-4 hidden-xs">
              <img class="img-responsive hidden-xs" src="/images/homepage/step3.png" alt="Manage from Anywhere" >
            </div>
          </div>
        </div>
      </section>

      <a name="features"></a>
      <section class="features">
        <div class="container text-center">
          <div class="clearfix">
            <div class="col-md-12">
              <h2><span>FeatherQ Features</span></h2>
            </div>
          </div>
          <div class="clearfix">
            <div class="row">
              <div class="col-md-3 col-xs-6 featureblock">
                <img  class="img-responsive" src="/images/homepage/feat-30.png" alt="" />
                <p>30-second <br>Business Setup</p>
                <div class="featurewrapper hidden">
                  <p>In as short as 30-seconds, connect to FB and create your business account to begin managing your lines today. Have full control over staff assignments to terminals and business details in a simple registration process.</p>
                </div>
              </div>
              <div class="col-md-3 col-xs-6 featureblock">
                <img class="img-responsive" src="/images/homepage/feat-flexible.png" alt="" />
                <p>Flexible <br>line management</p>
                <div class="featurewrapper hidden">
                  <p>FeatherQ offers functionality no matter your business. Enjoy a flexible line management solution that's able to suit your needs.Whether you have three terminals serving one line, or only one terminal, FeatherQ can be set for these.</p>
                </div>
              </div>
              <div class="col-md-3 col-xs-6 featureblock">
                <img class="img-responsive" src="/images/homepage/feat-customize.png" alt="" />
                <p>Customizable <br>Features</p>
                <div class="featurewrapper hidden">
                  <p>Choose a display layout that fits your business. FeatherQ lets you customize how your customers get informed about their status.</p>
                </div>
              </div>
              <div class="col-md-3 col-xs-6 featureblock">
                <img class="img-responsive" src="/images/homepage/feat-business.png" alt="" />
                <p>Business <br>Analytics</p>
                <div class="featurewrapper hidden">
                  <p>Know what's important to your business directly from customer behavior. FeatherQ offers insights such as: average waiting time per customer or how many customers dropped their priority number.</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 col-xs-6 featureblock">
                <img class="img-responsive" src="/images/homepage/feat-minimal.png" alt="" />
                <p>Minimal <br>Setup</p>
                <div class="featurewrapper hidden">
                  <p>Do away with expensive overhead costs and installation fees. FeatherQ's browser-based solution works on any smartphone, tablet or computer.</p>
                </div>
              </div>
              <div class="col-md-3 col-xs-6 featureblock">
                <img class="img-responsive" src="/images/homepage/feat-easy.png" alt="" />
                <p>Easy Customer <br>Notifications</p>
                <div class="featurewrapper hidden">
                  <p>Easily reach your customers through SMS or Email. They can also scan a QR code unique to your business to receive live updates of the priority status. Let your customers wait worry-free that their place in line is secured.</p>
                </div>
              </div>
              <div class="col-md-3 col-xs-6 featureblock">
                <img class="img-responsive" src="/images/homepage/feat-simple.png" alt="" />
                <p>Simple <br>Interface</p>
                <div class="featurewrapper hidden">
                  <p>Manage your lines without disrupting your business flow. FeatherQ comes without bulky training manuals, or complicated instructions.</p>
                </div>
              </div>
              <div class="col-md-3 col-xs-6 featureblock">
                <img class="img-responsive" src="/images/homepage/feat-free.png" alt="" />
                <p>It's Free</p>
                <div class="featurewrapper hidden">
                  <p>FeatherQ is a complete line management system that is free to use. It is supported by ads.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <a name="uses"></a>
      <section class="whocan">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2><span>Who can use FeatherQ</span></h2>
            </div>
          </div>
          <div class="row imgs">
            <div class="featherq-uses-slides">
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="block text-center hos">
                <img src="/images/homepage/hospitals.png" alt="Hospitals" />
                <p>Hospitals</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="block text-center ban">
                <img src="/images/homepage/banks.png" alt="Banks" />
                <p>Banks</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="block text-center sch">
                <img src="/images/homepage/schools.png" alt="Schools" />
                <p>Schools</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="block text-center res">
                <img src="/images/homepage/restaurants.png" alt="Restaurants" />
                <p>Restaurants</p>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="width:400px;">
                <div class="block text-center your-biz">
                                <img src="/images/homepage/yourbusiness.png" alt="Restaurants" />
                                <p>Your Business</p>
                                <span>Or any service oriented <br>business process!</span>
                </div>


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
                Online Queue Management Platform
              </h1>
              <h2>Call us at: <a class="noline" href="tel:0323454658"><span class="orange">(+6332) 345-4658</span></a><br>
                Email us at: <a class="noline" href="mailto:contact@featherq.com"><span class="orange">contact@featherq.com</span></a></h2>
                <p class="mt50 leave">
                  Leave your email below to receive our monthly newsletter on new features, new innovations and news that help you beat the waiting game.
                </p>
                <form id="leaveemail">
                  <input id="subscriber-field" placeholder="Your email address">
                  <button type="submit" id="subscribe-button" class="btn btn-orange"> Subscribe</button>
                  <div id="subscribe-error" class="subscribe-error alert alert-danger text-center" style="display:none;">Please enter a valid email address.</div>
                  <div id="subscribe-duplicate" class="subscribe-error alert alert-danger text-center" style="display:none;">User has already subscribed. Please register with a different email.</div>
                  <div id="subscribe-success" class="subscribe-error alert alert-success text-center" style="display:none;">Thank you for subscribing.</div>
                </form>
              </div>
              <div class="col-md-6 signthemup" ng-controller="fbController">
                <p>Allow your customers to wait on their own terms by making their mobile phone hold their spot in line. Gain competitive advantage by changing the way your customers perceive their wait.</p>

                <p>Signup for a <a class="noline" href="" ng-click="login()"><span>FREE FeatherQ account</span></a> today. <br>
                  Managing your lines is as simple as 1,2,3.</p>
                  <button class="btn btn-fb" ng-click="login()"><span class="fa fa-facebook"></span> Login with facebook</button>

                  <br>
                  {{-- ARA Removed because of new agreement on sms.
                  <small class="block mt50">
                    Business Users receive a *FREE 2-Month SMS Notification Package *Applies to Philippine territories.
                  </small>
                  --}}

                </div>
              </div>
            </div>
          </section>

          <footer>
            <section class="footer">
              <div class="container">
                <div class="col-md-12 text-center">
                  <p>2015  : <a href="http://reminisense.com/" target="_blank">Reminisense Corporation</a></p>
                </div>
              </div>
            </section>
          </footer>

          @include('modals.homepage.fb-loader')

          <script type="text/javascript" src="/js/homepage/migrate.min.js"></script>
          <script type="text/javascript" src="/js/homepage/slick.min.js"></script>
          <script type="text/javascript" src="/js/bootstrap.min.js"></script>
          <script type="text/javascript" src="/js/homepage/ie10-viewport-bug-workaround.js"></script>
          <script type="text/javascript" src="/js/homepage/scripts.js"></script>
        </body>
        </html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/images/favicon.png">

    <title>{{ $business_name }} | FeatherQ</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/dashboard.css') }}
    {{ HTML::style('css/responsive.css') }}

    {{ HTML::script('js/jquery1.11.2.js') }}
    {{ HTML::script('js/angular.js') }}
    {{ HTML::script('js/ngBroadcast.js') }}

    {{ HTML::script('js/google-analytics/googleAnalytics.js') }}
    {{ HTML::script('js/google-analytics/ga-broadcast.js') }}

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- NAVBAR
  ================================================== -->
<body cz-shortcut-listen="true" ng-app="Broadcast">
<div id="business-id" business_id="{{ $business_id }}"></div>
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('/')}}"> {{--RDH Added link to homepage--}}
                <img src="/images/featherq-home-logo.png">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        @if (Auth::check())
                            Hello {{Auth::user()->first_name}}!
                        @else
                            Sign up now!
                        @endif
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{URL::to('/')}}">Dashboard</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Connect with us!</li>
                        <li><a href="{{URL::to('https://www.facebook.com/theFeatherQ')}}">Facebook</a></li>
                        <li><a href="{{URL::to('https://www.twitter.com/thefeatherq')}}">Twitter</a></li>
                        <li><a href="{{URL::to('https://plus.google.com/101914769293976664743')}}">Google+</a></li>
                    </ul>
                </li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<div class="container main-wrap">
    <div class="row filters hidden">
        <div class="col-md-5 col-md-offset-1">
            <div class="filterwrap">
                <span>FILTER:</span>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Location
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                            <li><a href="#">Dropdown link</a></li>
                            <li><a href="#">Dropdown link</a></li>
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Industry Type
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 2</a></li>
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Time Open
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="searchblock">
                <form>
                    <input type="text" placeholder="Search a Business">
                    <button type="button" class="btn btn-orange btn-md">SEARCH</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row top-space-20" ng-controller="nowServingCtrl">

        <div class="col-md-6 ads" style="@{{ ad_display }}">
            <img class="img-responsive mb30" src="/images/ads.jpg" />
        </div>
        <div class="col-md-6">
            <audio id="call-number-sound" src="/audio/doorbell_x.wav" controls preload="auto" autobuffer style="display: none;"></audio>
            <div class="boxed mb20">
                <div class="head head-wbtn">
                    <h3>{{ $business_name }}</h3>
                    <small>{{ $local_address }}</small>
                    <a class="btn btn-half btn-blue" id="btn-bcast-details"> <span class="glyphicon glyphicon-plus"></span></a>
                </div>
                <div class="body broadcast body-gradient">
                    @{{ numbers() }}
                    <h4 class="text-center">Now Serving</h4>
                    <div class="row">
                        <div class="col-md-4 col-xs-6" style="@{{ boxdisplay1 }}">
                            <div class="numbers t@{{ rank1 }}">
                                <p class="terminal">@{{ name1 }}</p>
                                @{{ box1 }}
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6" style="@{{ boxdisplay2 }}">
                            <div class="numbers t@{{ rank2 }}">
                                <p class="terminal">@{{ name2 }}</p>
                                @{{ box2 }}
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6" style="@{{ boxdisplay3 }}">
                            <div class="numbers t@{{ rank3 }}">
                                <p class="terminal">@{{ name3 }}</p>
                                @{{ box3 }}
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6" style="@{{ boxdisplay4 }}">
                            <div class="numbers t@{{ rank4 }}">
                                <p class="terminal">@{{ name4 }}</p>
                                @{{ box4 }}
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6" style="@{{ boxdisplay5 }}">
                            <div class="numbers t@{{ rank5 }}">
                                <p class="terminal">@{{ name5 }}</p>
                                @{{ box5 }}
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-6" style="@{{ boxdisplay6 }}">
                            <div class="numbers t@{{ rank6 }}">
                                <p class="terminal none">@{{ name6 }}</p>
                                @{{ box6 }}
                            </div>
                        </div>
                    </div>
                    <div class="bcast-details">
                        <div class="wrap">
                            <table class="table">
                                <tr>
                                    <td>Open Time</td>
                                    <td>{{ $open_time }}</td>
                                </tr>
                                <tr>
                                    <td>Closing Time</td>
                                    <td>{{ $close_time }}</td>
                                </tr>
                                <tr>
                                    <td>Total Numbers in Queue</td>
                                    <td>{{ $lines_in_queue }}</td>
                                </tr>
                                <tr>
                                    <td>Estimate time serving per #</td>
                                    <td>{{ $estimate_serving_time }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="boxed boxed-single">
                <div class="wrap">
                    <div class="row">
                        <div class="col-md-7 getnum-info">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <strong>Next Available Number:</strong>
                                    Remote queuing feature is still on the works!
                                    {{--Approximately, your number
                                    will be served <br><span>2hrs from now</span>--}}
                                </div>
                                <div class="pull-right">
                                    @{{ get_num }}
                                    <span class="tri-right"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <button class="btn btn-orange btn-getnum">
                                GET THIS NUMBER <span class="glyphicon glyphicon-save"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ads-mobile" style="@{{ ad_display }}">
            <img class="img-responsive mb30" src="/images/ads.jpg" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="sep"></div>
        </div>
    </div>

</div>
<div class="footer">
    <div class="container">
        <div class="col-md-12">
            © 2014 : Reminisense Corp.
        </div>
    </div>
</div>

{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/custom.js') }}

</body>
</html>

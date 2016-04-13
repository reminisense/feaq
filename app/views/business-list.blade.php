<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>FeatherQ Business Directory</title>
    <meta name="title" content="FeatherQ online Queueing software" />
    <meta name="description" content="FeatherQ online Queueing software" />
    <meta name="author" content="">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <link rel="shortcut icon" id="favicon" href="favicon.png">
    <link rel='stylesheet' type='text/css' href='/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='/css/business_list/business-directory.css'>
    <link rel='stylesheet' type='text/css' href='/css/business_list/responsive.css'>
    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Open+Sans:400,700'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/manifest.json">

    <link media="all" type="text/css" rel="stylesheet" href="/css/loading-bar.css">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <script type="text/javascript" src="/js/jquery1.11.2.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/unveil.js"></script>
    <script type="text/javascript" src="/js/custom.js"></script>

    <script type="text/javascript" src="/js/angular.min.js"></script>
    <script type="text/javascript" src="/js/ngFeatherQ.js"></script>
    <script src="/js/ngFacebook.js"></script>
    <script src="/js/ngAutocomplete.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular-sanitize.min.js"></script>
    <script type="text/javascript" src="/js/loading-bar.min.js"></script>
    <script type="text/javascript" src="/js/business-list/business-list-angular.js"></script>

</head>

<body ng-app="FeatherQ" ng-cloak ng-controller="businessListController">
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="" class="navbar-brand"><img src="img/featherq-logo.svg"></a>
        </div>
        <nav class="pull-right collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li><a href="#">Businesses</a></li>
                <li><a href="#" >FeatherQ for Business</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="feat feat-dashboard">
    <div class="container">
        <div class="text-center">
            <h1>Search for Businesses</h1>
        </div>
        <div class="container">
            <div class="clearfix">
                <div class="filterwrap col-md-offset-2 col-md-8">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-4 btn-group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle ng-binding" data-toggle="dropdown">
                                @{{ location }}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1" id="location-filter">
                                <li ng-repeat="country in locations"><a href="#" ng-click="locationFilter(country.code)">@{{ country.code }}</a></li>
                            </ul>
                        </div>

                        <form class="ng-pristine ng-valid" ng-submit="getBusinessList()">
                            <input class="col-md-8 col-sm-8 col-xs-8" type="text" placeholder="e.g. Bills Payment SM Megamall " id="search-keyword" ng-model="keyword">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <button type="submit" class=" btn btn-orange btn-md">SEARCH</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="arrow">
        <img src="img/arrow.png">
    </div>
</div>
<div class="clearfix">
    <div class="col-md-12 page-header">
        <h2 class="text-center">Or browse from these businesses</h2>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="btn-toolbar col-md-12 mb20">
                <div class="btn-group btn-group-sm">
                    <button ng-repeat="letter in alphabet" class="btn btn-default" ng-click="getBusinessList(location, letter)">@{{ letter }}</button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xs-12 col-md-12">
            <div class="clearfix" id="biz-list-wrap">
                <div class="col-md-6 col-xs-12" ng-repeat="business in business_list">
                    <div class="entry clearfix @{{ business.business_id ? 'on-featherq' : '' }}" >
                        <div class="pull-left">
                            <img class="hidden-sm hidden-xs pull-left" src="http://placehold.it/80x80">
                            <div class="pull-left">
                                <h2>@{{ business.name }}</h2>
                                <p class="truncate"><i class="fa fa-map-pin"></i> @{{ business.local_address }}</p>
                                <p class="inlineb" ng-if="business.time_open && business.time_close"><i class="fa fa-clock-o"></i> @{{ business.time_open }} to @{{ business.time_close }}</p>
                                <p class="inlineb" ng-if="business.phone"><i class="fa fa-phone"></i>@{{  business.phone }}</p>
                            </div>
                        </div>
                        <div class="pull-right" ng-if="business.business_id">
                            <div class="clearfix">
                                <p class="pull-right">
                                    <a target="_blank" href="{{ url('/broadcast/business')}}/@{{  business.business_id }}" title="View broadcast screen" class="view-screen btn btn-cyan">
                                        <span class="glyphicon glyphicon-eye-open"></span> View Broadcast Screen
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="pull-right rating" ng-if="business.business_id == 0">
                            <div class="clearfix">
                                <p class="pull-right upvote">
                                    <a href="" title="Upvote"><i class="fa fa-thumbs-o-up"></i></a>
                                    <small>@{{ business.upvote }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<footer>
    <div class="row-fluid">
        <p class="text-center">&copy; 2016 : Reminisense Corp.</p>
    </div>
</footer>
</body>
</html>
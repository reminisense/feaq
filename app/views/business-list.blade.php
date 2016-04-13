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

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <script type="text/javascript" src="/js/jquery1.11.2.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/unveil.js"></script>
    <script type="text/javascript" src="/js/custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
    <script type="text/javascript" src="/js/business/list/list.js"></script>
</head>

<body ng-app="BusinessList">
<div ng-controller="listController">
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
                                Location
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1" id="location-filter">
                                <li ng-click="locationFilter('Afghanistan');"><a href="#">Afghanistan</a></li>
                                <li ng-click="locationFilter('Albania');"><a href="#">Albania</a></li>
                                <li ng-click="locationFilter('Algeria');"><a href="#">Algeria</a></li>
                                <li ng-click="locationFilter('Andorra');"><a href="#">Andorra</a></li>
                                <li ng-click="locationFilter('Angola');"><a href="#">Angola</a></li>
                                <li ng-click="locationFilter('Antigua and Barbuda');"><a href="#">Antigua and Barbuda</a></li>
                            </ul>
                        </div>

                        <form class="ng-pristine ng-valid">
                            <input class="col-md-8 col-sm-8 col-xs-8" type="text" placeholder="ie: ABC " id="search-keyword">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <button type="button" class=" btn btn-orange btn-md" ng-click="searchBusiness(location_filter, industry_filter);">SEARCH</button>
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
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('', 0)">Show All</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('A', 0)">A</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('B', 0)">B</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('C', 0)">C</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('D', 0)">D</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('E', 0)">E</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('F', 0)">F</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('G', 0)">G</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('H', 0)">H</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('I', 0)">I</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('J', 0)">J</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('K', 0)">K</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('L', 0)">L</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('M', 0)">M</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('N', 0)">N</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('O', 0)">O</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('P', 0)">P</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('Q', 0)">Q</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('R', 0)">R</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('S', 0)">S</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('T', 0)">T</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('U', 0)">U</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('V', 0)">V</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('W', 0)">W</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('X', 0)">X</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('Y', 0)">Y</button>
                    <button class="btn btn-default" ng-click="lazyLoadBusinesses('Z', 0)">Z</button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xs-12 col-md-12">
            <div class="clearfix" id="biz-list-wrap">
                <div class="col-md-6 col-xs-12" ng-repeat="business in business_list">
                    <div class="entry clearfix">
                        <div class="pull-left">
                            <img class="hidden-sm hidden-xs pull-left" src="http://placehold.it/80x80">
                            <div class="pull-left">
                                <h2>@{{ business.name }}</h2>
                                <p><i class="fa fa-map-pin"></i> @{{ business.local_address }}</p>
                                <p class="inlineb"><i class="fa fa-clock-o"></i> @{{ business.time_open }} to @{{ business.time_close }}</p>
                                <p class="inlineb"><i class="fa fa-phone"></i> @{{ business.phone }}</p>
                            </div>
                        </div>
                        <div class="pull-right rating">
                            <div class="clearfix">
                                <p class="pull-right upvote">
                                    <a href="" title="Upvote"><i class="fa fa-thumbs-o-up"></i></a>
                                    <small>@{{ business.up_vote }}</small>
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
</div>
</body>
</html>
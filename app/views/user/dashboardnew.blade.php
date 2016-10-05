@extends('dashboard')

@section('subtitle')
Dashboard
@stop

@section('styles')
<link rel='stylesheet' type='text/css' href='/css/dashboard/dashboard.css'>
<link rel='stylesheet' type='text/css' href='/css/dashboard/biz-statuses.css'>
<link rel='stylesheet' type='text/css' href='/css/dashboard/responsive.css'>
@stop

@section('scripts')
<script src="/js/dashboard/dashboard.js"></script>
<script src="/js/search-business.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
@stop

@section('container')
<div id="main_dashboard_container" ng-controller="searchBusinessCtrl">
    <div class="feat feat-dashboard">
        <div class="container">
            <div class="text-center">
                <h1><b>Find</b> a Business</h1>
            </div>
            <div class="container">
                <div class="clearfix">
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
                                    <input type="text" id="time_open-filter" name="time_open" placeholder="Time Open" class="form-control" ng-model="time_open">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input class="" type="text" placeholder="e.g. Bills Payment SM Megamall" id="search-keyword" ng-model="search_keyword" ng-model-options="{debounce: 1000}" autocomplete="off">
                                    <ul class="dropdown-menu" role="menu" id="search-suggest" ng-hide="dropdown_businesses.length == 0"  outside-click="dropdown_businesses = []">
                                        <li ng-repeat="business in dropdown_businesses">
                                            <a href="#" ng-click="searchBusiness(location_filter, industry_filter, business.name, $event)">
                                                <strong class="business-name">@{{ business.name }}</strong><br>
                                                <small class="address">@{{ business.local_address }}</small>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <!-- <input type="submit" class=" btn btn-orange btn-md" value="SEARCH"> -->
                                    <button id="search-filter" type="submit" class=" btn btn-orange btn-md">SEARCH</button>
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
    <div class="col-md-12 page-header">
        <h2 id="browse-label" class="text-center">Or browse from these businesses currently queuing</h2>
        <div class="" id="search-loader" style="display: none; text-align: center;">
            <img style="width:30px;" src="/images/reload_dash.gif" />
        </div>
        <div class="row" id="search-loader" style="display: none; text-align: center;">
            <img src="/images/reload_dash.gif" />
        </div>
    </div>
    <div class="container">
        <div class="row" id="search-grid" style="display: none;">
            <div class="col-md-12 col-xs-12 col-sm-12">
                <h5 class="mb30 searchresults" ng-hide="searchLabel == '' || searchLabel == undefined">@{{ searchLabel }}</h5>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12" ng-repeat="business in businesses">
                <a class="broadcast_link" href="/broadcast/business/@{{ business.business_id }}" target="_blank">
                    <div ng-class="{true: 'boxed biz-open', false: 'boxed biz-closed'}[business.card_bool]">
                        <p class="title">@{{ business.business_name }}</p>
                        <p class="address">@{{ business.local_address }}</p>
                        <div class="statuses" ng-if="!business.card_bool">
                            <p><span class="icon-lineq"></span> Business Hours: <span class="pull-right">@{{ business.time_open }} - @{{ business.time_close }}</span> <span class="icon-busy"></span> </p>
                            <p><span class="icon-waittime"></span> Last Active:
                                <span class="pull-right"><i>@{{ business.last_active }}</i></span>
                            </p>
                        </div>
                        <div class="statuses" ng-if="business.card_bool">
                            <div class="col-md-6 col-xs-6 text-center">
                                <h5>Calling</h5>
                                <h4><strong>@{{ business.last_number_called }}</strong></h4>
                            </div>
                            <div class="col-md-6 col-xs-6 text-center">
                                <h5>Next Available</h5>
                                <h4><strong>@{{ business.next_available_number }}</strong></h4>
                            </div>
                            <div class="col-md-12 text-center">
                                <p class="line">Line Status: <span class="@{{ business.waiting_time }}">&middot</span> @{{ business.waiting_time }}</p>
                            </div>
                        </div>
                        <div class="status open" data-toggle="tooltip" data-placement="top" title="" data-original-title="Queue on-going" ng-if="business.card_bool">
                        	<span class="glyphicon glyphicon-play"></span>
                        	<div class="bg"></div>
                        </div>
                        <div class="status closed" data-toggle="tooltip" data-placement="top" title="Queue Closed" ng-if="!business.card_bool">
                        	<span class="glyphicon glyphicon-ban-circle"></span>
                        	<div class="bg"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@stop
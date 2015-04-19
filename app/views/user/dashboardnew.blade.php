@extends('dashboard')

@section('subtitle')
    Dashboard
@stop

@section('styles')
    <link rel='stylesheet' type='text/css' href='css/dashboard/dashboard.css'>
@stop

@section('scripts')
    <script src="/js/search-business.js"></script>
    <script type="text/javascript" src="js/dashboard/dashboard.js"></script>
@stop

@section('container')
    <div id="main_dashboard_container" ng-controller="searchBusinessCtrl">
      <div class="feat feat-dashboard">
        <div class="container">
          <div class="text-center">
            <h1>Search for Businesses</h1>
          </div>
          <div class="container">
          <div class="clearfix">
              <div class="filterwrap col-md-offset-2 col-md-8">
                <div class="row">
                    <form ng-submit="searchBusiness(location_filter, industry_filter)">
                      <div class="col-md-2 col-sm-2 col-xs-4 btn-group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle ng-binding" data-toggle="dropdown">
                          @{{ location_filter }}
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1" id="location-filter">
                          <li ng-repeat="location in locations" ng-click="locationFilter(location.code);"><a href="#">@{{ location.code }}</a></li>
                            </ul>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-4 btn-group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle ng-binding" data-toggle="dropdown">
                          @{{ industry_filter }}
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                          <li ng-repeat="industry in industries" ng-click="industryFilter(industry.code);"><a href="#">@{{ industry.code }}</a></li>
                        </ul>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-4 btn-group">
                        <input type="text" id="time_open-filter" name="time_open" placeholder="Time Open" class="form-control" ng-model="time_open">
                      </div>
                        <input class="col-md-4 col-sm-4 col-xs-12" type="text" placeholder="ie: Ng Khai Devt Corp" id="search-keyword" ng-model="search_keyword">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="submit" class=" btn btn-orange btn-md" value="SEARCH">
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
        <h2 class="text-center">Or browse from these businesses currrently queuing</h2>
      </div>
      <div class="container">
        <div class="row" id="biz-grid">
          @if(count($active_businesses) > 0)
            @foreach($active_businesses as $business)
                <div class="col-md-3">
                  <a class="broadcast_link" href="{{ URL::to( '/broadcast/business/' . $business['business_id'] ) }}" target="_blank" title="View Broadcast Page.">
                  <div class="boxed">
                    <p class="title">{{ $business['name'] }}</p>
                    <p class="address">{{ $business['local_address'] }}</p>
                    <div class="statuses">
                      <p><span class="icon-lineq"></span> Business Hours: {{ $business['open_time'] }} - {{ $business['close_time'] }} <span class="icon-busy"></span></p>
                      <p><span class="icon-waittime"></span> Waiting Time: {{ $business['waiting_time'] }} </p>
                    </div>
                  </div>
                  </a>
                </div>
            @endforeach
          @endif
        </div>
        <div class="row" id="search-grid" style="display: none;">
            <h5 class="mb30 searchresults">@{{ searchLabel }}</h5>
            <div class="col-md-3" ng-repeat="business in businesses">
                <a class="broadcast_link" href="/broadcast/business/@{{ business.business_id }}">
                    <div class="boxed">
                        <p class="title">@{{ business.business_name }}</p>
                        <p class="address">@{{ business.local_address }}</p>
                        <div class="statuses">
                          <p><span class="icon-lineq"></span> Business Hours: @{{ business.time_open }} - @{{ business.time_close }} <span class="icon-busy"></span></p>
                          <p><span class="icon-waittime"></span> Waiting Time: @{{ business.waiting_time }} </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
      </div>
    </div>
@stop
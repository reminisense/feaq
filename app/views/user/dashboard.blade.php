@extends('user.dashboard_master')

@section('subtitle')
    Dashboard
@stop

@section('scripts')
    {{--{{ HTML::script('js/dashboard/dashboard.js') }}--}}
    <script src="/js/dashboard/dashboard.js"></script>

    {{--{{ HTML::script('js/jquery.form.js') }}--}}
    <script src="/js/jquery.form.js"></script>

    {{--{{ HTML::script('js/dashboard/edit-business.js') }}--}}
    <script src="/js/dashboard/edit-business.js"></script>

    {{--{{ HTML::script('js/jquery.timepicker.min.js') }}--}}
    <script src="/js/jquery.timepicker.min.js"></script>

    {{--{{ HTML::script('js/intlTelInput.js') }}--}}
    <script src="/js/intlTelInput.js"></script>

    {{--{{ HTML::script('js/dashboard/jquery.validate.js') }}--}}
    <script src="/js/dashboard/jquery.validate.js"></script>

    {{--{{ HTML::script('js/dashboard/search-business.js') }}--}}
    <script src="/js/dashboard/search-business.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key=AIzaSyB55xpm64WJKkHPNoHoTt8XR2xVXDJnVbs"></script>

    {{--{{ HTML::script('js/jquery.geocomplete.js') }}--}}
    <script src="/js/jquery.geocomplete.js"></script>

    {{--{{ HTML::script('js/google-analytics/googleAnalytics.js') }}--}}
    <script src="/js/google-analytics/googleAnalytics.js"></script>

    {{--{{ HTML::script('js/google-analytics/ga-dashboard.js') }}--}}
    <script src="/js/google-analytics/ga-dashboard.js"></script>

    {{--<script src="/js/user/Usertracker.js"></script>--}}

@stop

@section('styles')
    {{--{{ HTML::style('css/jquery.timepicker.min.css') }}--}}
    <link media="all" type="text/css" rel="stylesheet" href="/css/jquery.timepicker.min.css">

    {{--{{ HTML::style('css/intlTelInput.css') }}--}}
    <link media="all" type="text/css" rel="stylesheet" href="/css/intlTelInput.css">
@stop

@section('content')
 <div class="row mt30">
    <div id="my_businesses" style="display: none;">
        @if(count($my_businesses) > 0)
            @foreach($my_businesses as $business)
                <div class="col-md-3" business_id="{{ $business->business_id }}">
                  <div class="boxed boxed-single edit-biz">
                    <div class="wrap">
                      <h3>{{ $business->name }}</h3>
                      <small>{{  $business->local_address }}</small>
                      <a href="" class="to-terminals" title="Process Queue."><span class="glyphicon glyphicon-share-alt"></span> Process</a>
                      <a href="{{ url('/broadcast/business/' . $business->business_id) }}" class="pull-right to-broadcast" target="_blank" title="View Broadcast Page."><span class="glyphicon glyphicon-blackboard"></span> Broadcast</a>
                      @if($business->owner == 1)
                        <button data-toggle="modal" data-target="#editBusiness" data-business-id="{{ $business->business_id }}" class="btn btn-nobg edit-business-cog"><span class="glyphicon glyphicon-cog"></span></button>
                      @endif
                    </div>
                    <div class="biz-terminals">
                      <div class="clearfix">
                      @foreach($business->terminals as $terminal)
                        @if($terminal['assigned'] == 1)
                            <a href="{{url( '/processqueue/terminal/' . $terminal['terminal_id']) }}" target="_blank">
                        @else
                            <a href="#forbidden" class="not-active">
                        @endif
                          <span class="@if ($terminal['assigned'] == 1) {{ 'glyphicon glyphicon-ok' }} @else {{ 'glyphicon glyphicon-ban-circle' }} @endif "></span>
                          <small>{{ $terminal['name']; }}</small>
                        </a>
                      @endforeach
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
        @endif

        @if(!$has_business)
        <div class="col-md-3">
          <div class="boxed boxed-single to-modal" data-toggle="modal" id="add_business">
            <div class="wrap">
              <h3 class="orange"><span class="glyphicon glyphicon-plus"> </span>Add a business</h3>
            </div>
          </div>
        </div>
        @endif
    </div>

    <div id="search_business" style="display: block;">
        <div class="col-md-12">
            <h5 class="mb30">BUSINESSES</h5>
            @if(count($active_businesses) > 0)
                <div id="active-businesses">
                    <div class="row">
                        @foreach($active_businesses as $actives)
                            <div class="col-md-3">
                                <div class="boxed boxed-single clickable">
                                    <a href="{{ URL::to( '/broadcast/business/' . $actives['business_id'] ) }}" target="_blank" title="View Broadcast Page."> {{--RDH Links for Business' broadcast page--}}
                                        <div class="wrap" style="position: relative">
                                            <h3> {{ $actives['name'] }}
                                                <span class="glyphicon glyphicon-time pull-right {{ $actives['time_icon_color'] }}" title="{{ $actives['open_time'] . ' - ' . $actives['close_time'] }}"></span>
                                            </h3>
                                            <small>{{ $actives['local_address'] }}</small>

                                            <small class="pull-right" style="position: absolute; bottom: 5px; right: 18px; margin: 0; padding: 5px 3px;">
                                                @if($actives['queue_population'])
                                                    @for($counter = 1; $counter <= $actives['queue_population']; $counter++)
                                                    <span class="glyphicon glyphicon-user text-success"></span>
                                                    @endfor
                                                @else
                                                    <span class="glyphicon glyphicon-user"></span>
                                                @endif
                                            </small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-12" ng-if="businesses.length !== 0">
            <h5 class="mb30" ng-if="businesses.length !== 0">@{{ searchLabel }}</h5>
            <div class="col-md-3" ng-repeat="business in businesses">
                <div class="boxed boxed-single clickable">
                    <a href="/broadcast/business/@{{ business.business_id }}">
                        <div class="wrap">
                            <h3>@{{ business.business_name }}</h3>
                            <small>@{{ business.local_address }}</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-3" ng-if="businesses.length === 0">
                    <div class="boxed boxed-single clickable">
                        <div class="wrap">
                            <h3>No Available Businesses</h3>
                            <small></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 </div>
@stop

@section('modals')
    @include('modals.business.verify-user-modal')
    @include('modals.business.setup-business-modal')
    @include('modals.business.edit-business-modal')
    @include('modals.user.edit-user-modal')
@stop
@extends('dashboard')

@section('styles')
    <link media="all" type="text/css" rel="stylesheet" href="/css/kiosk/kiosk.css">
@stop

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular-sanitize.min.js"></script>
    <script src="/js/reconnecting-websocket.min.js"></script>
    <script src="/js/websocket-variables.js"></script>
    <script src="/js/kiosk/kiosk.js"></script>

    <script src="/js/google-analytics/googleAnalytics.js"></script>
    <script src="https://ucarecdn.com/widget/2.3.5/uploadcare/uploadcare.min.js" charset="utf-8"></script>
    <script>
        UPLOADCARE_LOCALE = "en";
        UPLOADCARE_TABS = "file";
        UPLOADCARE_PUBLIC_KEY = "844c2b9e554c2ee5cc0a";
    </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
@stop

@section('container')
    <div class="feat feat-kiosk">
        <div class="container">
            <div class="text-center">
                <h1><span class="glyphicon glyphicon-modal-window"></span> Kiosk</h1>
            </div>
        </div>
        <div class="arrow">
            <img src="/img/arrow.png">
        </div>
    </div>

    <div class="container" id="kiosk-wrapper" ng-controller="kioskController">
        <br/>
        <div class="row">
            <ul class="nav nav-pills nav-justified" id="services-list">
                <li role="presentation" ng-repeat="service in services" ng-class="$index==0?'active':'' " ><a href="#">@{{service.name}}</a></li>
            </ul>
        </div>
        <div class="row">
            {{--@{{services}}--}}
            {{--@{{rawr}}--}}
            <div class="col-md-6 issue-number">
                <span class="number-to-issue" id="next-number">@{{ next_number }}</span><br/>
                <button class="btn btn-lg btn-success" id="get-number" ng-click="getIssueNumber()"><strong><span class="glyphicon glyphicon-download"></span> GET NUMBER</strong></button>
            </div>
            <div class="col-md-6 well well-lg">
                <div class="clearfix">
                    <div class="col-md-6">
                        <p class="title">Notes</p>
                        <input type="text" class="form-control ng-pristine ng-untouched ng-valid" value="THIS IS A DEMO" ng-model="business_name">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--constants-->
    <input type="hidden" id="business_id" value="{{ $business_id }}">
    <!-- urls -->
    <input type="hidden" id="issue-specific-url" value="{{ url('/issuenumber/insertspecific/') }}">
    <!-- end urls -->
    <!-- end process queue main -->
{{--    @include('modals.websockets.websocket-loader')--}}
    @include('modals.kiosk.confirmation-code')
@stop
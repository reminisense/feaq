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
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="active"><a href="#service-a" id="service-a-tab" data-toggle="tab">Service A</a></li>
            {{--<ling-repeat="service in services" ng-class="$index==0?'active':'' " >@{{service.name}}</li>--}}
            <li class=""><a href="#service-b" id="service-b-tab" data-toggle="tab">Service B</a></li>
            <li class=""><a href="#service-c" id="service-c-tab" data-toggle="tab">Service C</a></li>
            <li class=""><a href="#service-d" id="service-d-tab" data-toggle="tab">Service D</a></li>
        </ul>
        <div class="tab-content" id="kioskTabContent">
            <div role="tabpanel" class="tab-pane fade active in" id="service-a" aria-labelledby="service-a-tab">
                <div class="clearfix">
                    <div class="col-md-12 emphasis">
                        <div class="col-md-6 issue-number">
                            <span class="number-to-issue" id="next-number">@{{ next_number }}</span><br/>
                        </div>
                        <div class="col-md-6">
                            <div class="well well-sm">
                                <p class="title">Notes</p>
                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid" value="THIS IS A DEMO">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="service-b" aria-labelledby="service-b-tab">
                <div class="clearfix">
                    <div class="col-md-12 emphasis">
                        <div class="col-md-6 issue-number">
                            <span class="number-to-issue">21</span>
                        </div>
                        <div class="col-md-6">
                            <div class="well well-sm">
                                <p class="title">Requests</p>
                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid" value="THIS IS A DEMO">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="service-c" aria-labelledby="service-c-tab">
                <div class="clearfix">
                    <div class="col-md-12 emphasis">
                        <div class="col-md-6 issue-number">
                            <span class="number-to-issue">41</span>
                        </div>
                        <div class="col-md-6">
                            <div class="well well-sm">
                                <p class="title">Others</p>
                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid" value="THIS IS A DEMO">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="service-d" aria-labelledby="service-d-tab">
                <div class="clearfix">
                    <div class="col-md-12 emphasis">
                        <div class="col-md-6 issue-number">
                            <span class="number-to-issue">61</span>
                        </div>
                        <div class="col-md-6">
                            <div class="well well-sm">
                                <p class="title">Diagnosis</p>
                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid" value="THIS IS A DEMO">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <center>
                    <button class="btn btn-lg btn-success" id="get-number" data-toggle="modal" data-target="#issue-confirmation-code" ng-click="getIssueNumber()"><span class="glyphicon glyphicon-download"></span> GET NUMBER</button>
                </center>
            </div>
        </div>
    </div>

    <!--OLD UI CODE WITH ANGULAR-->

    {{--<div class="container" id="kiosk-wrapper" ng-controller="kioskController">--}}
        {{--<br/>--}}
        {{--<div class="row">--}}
            {{--<ul class="nav nav-tabs nav-justified" id="services-list">--}}
                {{--<li role="presentation" ng-repeat="service in services" ng-class="$index==0?'active':'' " ><a href="#">@{{service.name}}</a></li>--}}
            {{--</ul>--}}
        {{--</div>--}}
        {{--<div class="row" id="kioskTabContent">--}}
            {{--<div class="col-md-6 issue-number">--}}
                {{--<span class="number-to-issue" id="next-number">@{{ next_number }}</span><br/>--}}
                {{--<button class="btn btn-lg btn-success" id="get-number" ng-click="getIssueNumber()"><strong><span class="glyphicon glyphicon-download"></span> GET NUMBER</strong></button>--}}
            {{--</div>--}}
            {{--<div class="col-md-6 well well-lg">--}}
                {{--<div class="clearfix">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<p class="title">Notes</p>--}}
                        {{--<input type="text" class="form-control ng-pristine ng-untouched ng-valid" value="THIS IS A DEMO" ng-model="business_name">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


    <!--constants-->
    <input type="hidden" id="business_id" value="{{ $business_id }}">
    <!-- urls -->
    <input type="hidden" id="issue-specific-url" value="{{ url('/issuenumber/insertspecific/') }}">
    <!-- end urls -->
    <!-- end process queue main -->
{{--    @include('modals.websockets.websocket-loader')--}}
    @include('modals.kiosk.confirmation-code')
@stop
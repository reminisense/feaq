@extends('dashboard')

@section('styles')
    <link media="all" type="text/css" rel="stylesheet" href="/css/process-queue/processq.css">
    <link media="all" type="text/css" rel="stylesheet" href="/css/process-queue/responsive.css">
    <link media="all" type="text/css" rel="stylesheet" href="/css/jquery.timepicker.min.css">
@stop

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular-sanitize.min.js"></script>
    {{--<script src="/js/reconnecting-websocket.min.js"></script>--}}
    {{--<script src="/js/websocket-variables.js"></script>--}}
    <script src="/js/process-queue/process-queue.js"></script>

    <script src="/js/google-analytics/googleAnalytics.js"></script>
    <script src="https://ucarecdn.com/widget/2.3.5/uploadcare/uploadcare.min.js" charset="utf-8"></script>
    <script>
        UPLOADCARE_LOCALE = "en";
        UPLOADCARE_TABS = "file";
        UPLOADCARE_PUBLIC_KEY = "844c2b9e554c2ee5cc0a";
    </script>
    <script src="/js/dashboard/dashboard.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
@stop

@section('container')
    <div class="feat feat-processq">
        <div class="container">
            <div class="text-center">
                <h1><span class="glyphicon glyphicon-modal-window"></span> Kiosk</h1>
            </div>
        </div>
        <div class="arrow">
            <img src="/img/arrow.png">
        </div>
    </div>

    <div class="container" id="process-queue-wrapper" ng-controller="processqueueController">
        <div class="row">

        </div>
    </div>

    <!-- urls -->
    <input type="hidden" id="issue-specific-url" value="{{ url('/issuenumber/insertspecific/') }}">
    <!-- end urls -->
    <!-- end process queue main -->
    @include('modals.websockets.websocket-loader')
@stop
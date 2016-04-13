@extends('dashboard')

@section('subtitle')
Processs Queue > {{ $business_name }}
@stop


@section('styles')
<link media="all" type="text/css" rel="stylesheet" href="/css/process-queue/processq.css">
<link media="all" type="text/css" rel="stylesheet" href="/css/process-queue/responsive.css">
<link media="all" type="text/css" rel="stylesheet" href="/css/jquery.timepicker.min.css">
@stop

@section('scripts')
{{--disabled for faster loading--}}
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular-sanitize.min.js"></script>
<script src="/js/reconnecting-websocket.min.js"></script>
<script src="/js/websocket-variables.js"></script>
{{--
--}}
<script src="/js/process-queue/process-queue-cards-angular.js"></script>
<script src="/js/process-queue/issue-number-angular.js"></script>
<script src="/js/process-queue/messages-angular.js"></script>
<script src="/js/google-analytics/googleAnalytics.js"></script>
<script src="/js/google-analytics/ga-process_queue.js"></script>
<script src="https://ucarecdn.com/widget/2.3.5/uploadcare/uploadcare.min.js" charset="utf-8"></script>
<script>
    UPLOADCARE_LOCALE = "en";
    UPLOADCARE_TABS = "file";
    UPLOADCARE_PUBLIC_KEY = "844c2b9e554c2ee5cc0a";
</script>
<script src="/js/dashboard/dashboard.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
{{--
--}}
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.min.js"></script>
<script src="/js/process-queue/process-queue.js"></script>

@stop

@section('container')
<div class="feat feat-processq">
    <div class="container">
        <div class="text-center">
            <h1 id="feat-business-name"><span>Processing Queues for: </span> {{ $business_name }}</h1>
        </div>
    </div>
    <div class="arrow">
        <img src="/img/arrow.png">
    </div>
</div>

<div class="container" id="process-queue-wrapper" ng-controller="processqueueController">
    <div class="clearfix">
        <div class="page-header clearfix">
            <div class="col-md-4 col-sm-4" id="service-terminal-names">
                <div class="clearfix">
                    <h2>{{ $service_name }}
                        <small>SERVICE NAME</small>
                    </h2>
                    <h2 class="dashed">-</h2>
                    <h2>{{ $terminal_name }}
                        <small>TERMINAL NAME</small>
                    </h2>
                </div>
                <div class="clearfix">
                    <p class="date-today">
                        <span class="glyphicon glyphicon-calendar"></span>@{{ dateString }}
                        <input type="text" class="datepicker" ng-model="date" ng-change="getAllNumbers()" readonly="readonly" style="height: 0px; width:0px; border: 0px;"/>
                    </p>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-4">
                <a id="fwd-history" class="dtable btn" target="_blank" href="{{ url('/processqueue/forward-history/' . $service_id) }}" ng-show="allowed_businesses.length > 0" >
                    <div class="dcell">
                        <span class="glyphicon glyphicon-share-alt"></span>
                        <span>View Forwarding <br>History</span>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-4">
                <a id="stop-queue" class="dtable btn btn-white" href="#" ng-click="stopProcessQueue()">
                    <div class="dcell">
                        <span class="red glyphicon glyphicon-stop"></span>
                        <span>Stop Queuing</span>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-4">
                <a id="view-bcast" class="dtable btn btn-cyan" target="_blank" href="{{ url('/broadcast/business/' . $business_id) }}">
                    <div class="dcell">
                        <span class=" glyphicon glyphicon-th"></span>
                        <span>View Broadcast <br>Screen</span>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-4">
                <a id="issue-number" class="dtable btn btn-blue" href="#" data-toggle="modal" data-target="#moreq">
                    <div class="dcell">
                        <span class=" glyphicon glyphicon-log-in"></span>
                        <span>Issue a <br>Number</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box-wrap">
                <div class="box clearfix" ng-repeat="number in unprocessed_numbers">
                    <div class="box-head clearfix" >
                        <p class="called-number pull-left" ng-if="number.time_called > 0">
                            <a href="" class="cyan priority-number-details" title="Number: @{{ number.priority_number }}" data-transaction-number="@{{ number.transaction_number }}" data-priority-number="@{{ number.priority_number }}" data-name="@{{ number.name }}" data-phone="@{{ number.phone }}" data-email="@{{ number.email }}" data-confirmation-code="@{{ number.confirmation_code }}" data-toggle="modal" data-target="#priority-number-modal">
                                @{{ number.priority_number }}
                            </a>
                        </p>
                        <p class="queue-number pull-left" ng-if="number.time_called == 0">
                            <a href="" class="priority-number-details" title="Number: @{{ number.priority_number }}" data-transaction-number="@{{ number.transaction_number }}" data-priority-number="@{{ number.priority_number }}" data-name="@{{ number.name }}" data-phone="@{{ number.phone }}" data-email="@{{ number.email }}" data-confirmation-code="@{{ number.confirmation_code }}" data-toggle="modal" data-target="#priority-number-modal">
                                @{{ number.priority_number }}
                            </a>
                        </p>
                        <a href="" class="pull-right forward-number priority-number-forward" ng-if="number.time_called > 0" title="Number: @{{ number.priority_number }}" data-transaction-number="@{{ number.transaction_number }}" data-priority-number="@{{ number.priority_number }}" data-name="@{{ number.name }}" data-phone="@{{ number.phone }}" data-email="@{{ number.email }}" data-confirmation-code="@{{ number.confirmation_code }}" data-toggle="modal" data-target="#priority-number-modal">
                            <span class="glyphicon glyphicon-share-alt"></span>
                            <small>FORWARD</small>
                        </a>
                    </div>
                    <div class="box-body clearfix">
                        <div class="img-thumb pull-right">
                            <img src="http://placehold.it/30x30">
                        </div>
                        <p class="name"><a href=""> @{{ number.name }}</a></p>
                        <p class="time"> @{{ number.confirmation_code }}</p>
                        {{--<p class="time">2:45pm - 3:330pm</p>--}}
                        <p class="status in" ng-if="number.checked_in == true"><span class="glyphicon glyphicon-ok"></span>CHECKED IN</p>
                        <p class="status"  ng-if="number.checked_in != true">NOT CHECKED IN</p>

                        <div class="clearfix">
                            <small class="pull-right">via <span style="text-transform:capitalize;">@{{ number.queue_platform }}</span></small>
                        </div>
                    </div>
                    <div class="box-footer clearfix" ng-if="number.time_called == 0">
                        <a href="" class="bgdblue removeCard" ng-click="dropNumber(number.transaction_number)"><span class="glyphicon glyphicon-trash"></span></a>
                        <a href="" class="bgblue cardAction" ng-click="callNumber(number.transaction_number)">CALL</a>
                    </div>
                    <div class="box-footer clearfix" ng-if="number.time_called > 0">
                        <a href="" class="bgdcyan removeCard" ng-click="dropNumber(number.transaction_number)"><span class="glyphicon glyphicon-trash"></span></a>
                        <a href="" class="bgcyan cardAction" ng-click="serveNumber(number.transaction_number)">DONE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- urls -->
<input type="hidden" id="service-id" value="{{ $service_id }}">
<input type="hidden" id="terminal-id" value="{{ $terminal_id }}">
<input type="hidden" id="business-id" value="{{ $business_id }}">
<input type="hidden" id="all-numbers-url" value="{{ url('/processqueue/allnumbers/') }}">
<input type="hidden" id="call-number-url" value="{{ url('/processqueue/callnumber/') }}">
<input type="hidden" id="serve-number-url" value="{{ url('/processqueue/servenumber/') }}">
<input type="hidden" id="drop-number-url" value="{{ url('/processqueue/dropnumber/') }}">

<input type="hidden" id="issue-multiple-url" value="{{ url('/issuenumber/multiple/') }}">
<input type="hidden" id="issue-specific-url" value="{{ url('/issuenumber/insertspecific/') }}">

<input type="hidden" id="ratings-url" value="{{ url('/rating/userratings/') }}">
<input type="hidden" id="verify-email-url" value="{{ url('/rating/verifyemail/') }}">

<!-- end urls -->
<!-- end process queue main -->

@include('modals.process-queue.issue-number-modal')
@include('modals.process-queue.priority-number-details-modal')
@include('modals.websockets.websocket-loader')
@stop

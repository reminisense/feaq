@extends('dashboard')

@section('subtitle')
Processs Queue > {{ $business_name }}
@stop


@section('styles')
<link media="all" type="text/css" rel="stylesheet" href="/css/process-queue/processq.css">
<link media="all" type="text/css" rel="stylesheet" href="/css/modal.css">
<link media="all" type="text/css" rel="stylesheet" href="/css/jquery.timepicker.min.css">
@stop

@section('scripts')
<script src="/js/jquery.timepicker.min.js"></script>
<script src="/js/process-queue/process-queue.js"></script>
<script src="/js/process-queue/process-queue-angular.js"></script>
<script src="/js/process-queue/issue-number-angular.js"></script>

{{--<script src="/js/google-analytics/googleAnalytics.js"></script>--}}
{{--<script src="/js/google-analytics/ga-process_queue.js"></script>--}}

@stop

@section('container')
<div class="feat feat-processq">
    <div class="container">
        <div class="text-center">
            <h1><span class="glyphicon glyphicon-saved"></span> Process Queue</h1>
        </div>
    </div>
    <div class="arrow">
        <img src="/img/arrow.png">
    </div>
</div>

<div class="container" id="process-queue-wrapper" ng-controller="processqueueController">
    <div class="row page-header">
        <div class="col-md-offset-1 col-md-7">
            <p>Processing Queues for:</p>
            <h2>{{ $business_name }}</h2>
        </div>
        <div class="col-md-3">
            <a id="view-broadcast" target="_blank" href="{{ url('/broadcast/business/' . $business_id) }}">View Broadcast <br>Screen</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="boxed processq-box processq">
                <div class="row">
                    <div class="q-actions clearfix">
                        <div class="col-md-9">
                            <input id="selected-tnumber" type="hidden" ng-value="called_number" value=0>
                            <div class="dropdown-wrapper" ng-show="timebound_numbers.length != 0 || uncalled_numbers.length != 0">
                                <button class="btn-select btn-md dropdown-toggle" type="button" data-toggle="dropdown">
                                    <span id="selected-pnumber">Please select a number</span><span class="caret"></span> <!-- @todo replace this with selected number-->
                                </button>
                                <ul class="dropdown-menu dd-select" id="uncalled-numbers">
                                    <li ng-repeat="number in timebound_numbers" data-tnumber="@{{ number.transaction_number }}" data-pnumber="@{{ number.priority_number }}">@{{ number.priority_number }}</li>
                                    <li ng-repeat="number in uncalled_numbers" data-tnumber="@{{ number.transaction_number }}" data-pnumber="@{{ number.priority_number }}">@{{ number.priority_number }}</li>
                                </ul>
                            </div>
                            <input id="issue-call-number" type="number" class="form-control" min="1" max="@{{ number_limit }}"  ng-model="issue_call_number" ng-show="timebound_numbers.length == 0 && uncalled_numbers.length == 0">
                            <a href="#" id="btn-pmore" class="btn btn-md btn-primary" data-toggle="modal" data-target="#moreq" title="Issue a number.">+</a>
                        </div>
                        <div class="col-md-3 text-right">
                            <button class="btn btn-orange btn-md" id="btn-call" ng-click="issueOrCall()" ng-disabled="isCalling">CALL NUMBER</button>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <tbody>
                    <tr ng-repeat="number in called_numbers" data-tnumber="@{{ number.transaction_number }}">
                        <th scope="row">
                            <a href="#" class="priority-number" title="Number: @{{ number.priority_number }}" data-name="@{{ number.name }}" data-phone="@{{ number.phone }}" data-email="@{{ number.email }}" data-toggle="modal" data-target="#priority-number-modal">
                                @{{ number.priority_number }}
                            </a>
                        </th>
                        <td>
                            <a href="#" class="delete" ng-click="dropNumber(number.transaction_number)" ng-disabled="isProcessing"><span class="glyphicon glyphicon-trash"></span></a>
                            <a href="#" class="btn btn-sm btn-default" ng-click="serveAndCallNext(number.transaction_number)" ng-disabled="isProcessing">Next <span class="glyphicon glyphicon-arrow-right"></span></a>
                            <a href="#" class="btn btn-sm btn-default" ng-click="serveNumber(number.transaction_number)" ng-disabled="isProcessing">Serve <span class="glyphicon glyphicon-ok"></span></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>






<!-- urls -->
<input type="hidden" id="service-id" value="{{ $service_id }}">
<input type="hidden" id="terminal-id" value="{{ $terminal_id }}">
<input type="hidden" id="all-numbers-url" value="{{ url('/processqueue/allnumbers/') }}">
<input type="hidden" id="call-number-url" value="{{ url('/processqueue/callnumber/') }}">
<input type="hidden" id="serve-number-url" value="{{ url('/processqueue/servenumber/') }}">
<input type="hidden" id="drop-number-url" value="{{ url('/processqueue/dropnumber/') }}">

<input type="hidden" id="issue-multiple-url" value="{{ url('/issuenumber/multiple/') }}">
<input type="hidden" id="issue-specific-url" value="{{ url('/issuenumber/insertspecific/') }}">
<!-- end urls -->
<!-- end process queue main -->
@include('modals.process-queue.issue-number-modal')
@include('modals.process-queue.priority-number-details-modal')
@stop
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
<script src="/js/process-queue/process-queue.js"></script>
<script src="/js/process-queue/process-queue-angular.js"></script>
<script src="/js/process-queue/issue-number-angular.js"></script>
<script src="/js/dashboard/dashboard.js"></script>

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
        <div class="col-md-offset-1 col-md-7 col-sm-8">
            <p>Processing Queues for:</p>
            <h2>{{ $business_name }} - {{ $terminal_name }}</h2>
        </div>
        <div class="col-md-3 col-sm-4 ">
            {{--<a id="view-broadcast" target="_blank" href="{{ url('/broadcast/business/' . $business_id) }}">View Broadcast <br>Screen</a>--}}
            <a id="view-broadcast" target="_blank" href="{{ url('/broadcast/business/' . $business_id) }}"><span class="glyphicon glyphicon-th-large"></span> View Broadcast Screen</a>
            <point-of-interest position="left" bottom="35" right="100" title="Broadcast Page" description="Click on the <strong>View Broadcast Page</strong> link to view the numbers being called."></point-of-interest>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="boxed processq-box processq">
                <div class="row">
                    <div class="q-actions clearfix">
                        <form>
                            <div class="col-md-8 col-sm-8 col-xs-9">
                                <input id="selected-tnumber" type="hidden" ng-value="called_number" value=0>
                                <div class="dropdown-wrapper" ng-show="timebound_numbers.length != 0 || uncalled_numbers.length != 0">
                                    <button class="btn-select btn-md dropdown-toggle" type="button" data-toggle="dropdown">
                                        <span id="selected-pnumber">Please select a number</span><span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dd-select" id="uncalled-numbers">
                                        <li ng-repeat="number in timebound_numbers" data-tnumber="@{{ number.transaction_number }}" data-pnumber="@{{ number.priority_number }}">@{{ number.priority_number }}</li>
                                        <li ng-repeat="number in uncalled_numbers" data-tnumber="@{{ number.transaction_number }}" data-pnumber="@{{ number.priority_number }}">@{{ number.priority_number }}</li>
                                    </ul>
                                </div>
                                <input id="issue-call-number" type="number" class="form-control" min="1" max="@{{ number_limit }}"  ng-model="issue_call_number" ng-show="timebound_numbers.length == 0 && uncalled_numbers.length == 0">
                            </div>
                            <point-of-interest position="left" bottom="85" right="100"  title="Issued Numbers" description="Look for the numbers you want to call in this drop-down list or type the number you want call when the list is empty."></point-of-interest>
                            <div class="col-md-1 col-sm-1 col-xs-3">
                                <a href="#" id="btn-pmore" class="btn btn-md btn-primary" data-toggle="modal" data-target="#moreq" title="Issue a number.">+</a>
                            </div>
                            <point-of-interest position="right" bottom="85" right="25"  title="Issue Numbers" description="Click on the blue '+' (plus) button to issue more numbers."></point-of-interest>
                            <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                                <button class="btn btn-orange btn-md" id="btn-call" ng-click="issueOrCall()" ng-disabled="isCalling">CALL NUMBER</button>
                            </div>
                            <point-of-interest position="right" bottom="85" right="-1"  title="Call Numbers" description="Click on the <strong>CALL NUMBER</strong> button to call the number selected on the drop-down list."></point-of-interest>
                        </form>
                    </div>
                </div>
                <div ng-show="called_numbers.length != 0">
                    <point-of-interest position="left" bottom="68" right="96" title="Called Number" description="Click on the number to view the information about the user assigned to this number."></point-of-interest>
                    <point-of-interest position="left" bottom="68" right="27" title="Drop Number" description="The <strong>Drop</strong> button (trashcan icon) indicates that the person assigned to the number did not show thus removes the number from the list."></point-of-interest>
                    <point-of-interest position="left" bottom="68" right="21" title="Next Number" description="The <strong>Next</strong> button indicates that the number has been served and calls the next number on the list."></point-of-interest>
                    <point-of-interest position="right" bottom="68" right="0" title="Serve Number" description="The <strong>Serve</strong> button indicates that the person assigned to the number has been served."></point-of-interest>
                </div>
                <table class="table table-striped">
                    <tbody>
                    <tr ng-repeat="number in called_numbers" data-tnumber="@{{ number.transaction_number }}">
                        <th scope="row">
                            <a href="#" class="priority-number" title="Number: @{{ number.priority_number }}" data-name="@{{ number.name }}" data-phone="@{{ number.phone }}" data-email="@{{ number.email }}" data-toggle="modal" data-target="#priority-number-modal">
                                @{{ number.priority_number }}<span class="glyphicon glyphicon-zoom-in"></span>
                            </a>
                        </th>
                        <td>
                            <form class="star-rating-form" ng-show="temp_called_numbers[$index].email_checker">
                                <span class="star-rating" ng-init="temp_called_numbers[$index].rating">
                                    <input type="radio" name="rating" ng-model="temp_called_numbers[$index].rating" value="1"><i></i>
                                    <input type="radio" name="rating" ng-model="temp_called_numbers[$index].rating" value="2"><i></i>
                                    <input type="radio" name="rating" ng-model="temp_called_numbers[$index].rating" value="3"><i></i>
                                    <input type="radio" name="rating" ng-model="temp_called_numbers[$index].rating" value="4"><i></i>
                                    <input type="radio" name="rating" ng-model="temp_called_numbers[$index].rating" value="5"><i></i>
                                </span>
                            </form>
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

<input type="hidden" id="ratings-url" value="{{ url('/rating/userratings/') }}">
<input type="hidden" id="verify-email-url" value="{{ url('/rating/verifyemail/') }}">

<!-- end urls -->
<!-- end process queue main -->
@include('modals.process-queue.issue-number-modal')
@include('modals.process-queue.priority-number-details-modal')
@stop
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
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular-sanitize.min.js"></script>
<script src="/js/reconnecting-websocket.min.js"></script>
<script src="/js/websocket-variables.js"></script>
<script src="/js/process-queue/process-queue.js"></script>
<script src="/js/process-queue/process-queue-angular.js"></script>
<script src="/js/process-queue/issue-number-angular.js"></script>
<script src="/js/process-queue/messages-angular.js"></script>
<script src="/js/dashboard/dashboard.js"></script>

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
    <div class="row">
        <div class="page-header clearfix">
            {{--<div class="col-md-12 text-center">
                <button class="btn btn-danger stopbutton"ng-click="stopProcessQueue()">STOP</button>
            </div>--}}
            <div class="col-md-offset-1 col-md-7 col-sm-8">
                <p>Processing Queues for:</p>
                <h2><strong>{{ $business_name }}</strong></h2>
                <h3><strong>{{ $service_name }} - {{ $terminal_name }}</strong></h3>
                Showing numbers for date:
                <div class="col-md-12 row">
                    <div class="col-md-4">
                        <input type="text" class="datepicker form-control" ng-model="date" ng-change="getAllNumbers()" readonly="readonly" style="cursor: text; background-color: #FFFFFF"/>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 ">
                {{--<a id="view-broadcast" target="_blank" href="{{ url('/broadcast/business/' . $business_id) }}">View Broadcast <br>Screen</a>--}}
                <a id="view-broadcast" target="_blank" href="{{ url('/broadcast/business/' . $business_id) }}"><span class="glyphicon glyphicon-th-large"></span> View Broadcast Screen</a>
                <point-of-interest position="left" bottom="35" right="100" title="Broadcast Page" description="Click on the <strong>View Broadcast Page</strong> link to view the numbers being called."></point-of-interest>
            </div>
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
                                        <span id="selected-pnumber">@{{ called_number }}</span>
                                        <span class="caret"></span>
                                        <span id="selected-userinfo" class="font-normal"></span>
                                    </button>
                                    <ul class="dropdown-menu dd-select" id="uncalled-numbers">
                                        <li ng-repeat="number in timebound_numbers"
                                            data-tnumber="@{{ number.transaction_number }}"
                                            data-pnumber="@{{ number.priority_number }}"
                                            data-name="@{{ number.name }}"
                                            data-email="@{{ number.email }}"
                                            data-phone="@{{ number.phone }}"
                                            data-queue_platform="@{{ number.queue_platform }}"
                                            data-checked_in="@{{ number.checked_in }}"
                                            >
                                            @{{ number.priority_number }}
                                            <small class="font-normal">@{{ number.queue_platform }}</small>
                                            <span
                                               class="pull-right font-normal mr5 userinfo show-messages"
                                               title="Number: @{{ number.priority_number }}"
                                               data-toggle="modal"
                                               data-target="#priority-number-modal"
                                               data-priority-number="@{{ number.priority_number }}"
                                               data-name="@{{ number.name }}"
                                               data-email="@{{ number.email }}"
                                               data-phone="@{{ number.phone }}"
                                            >
                                                <a href="#">
                                                    <span ng-if="number.name"
                                                        style="text-transform: capitalize;"
                                                    >@{{ number.name }}</span>
                                                </a>
                                            </span>
                                            <span ng-if="(number.queue_platform == 'remote' || number.queue_platform == 'android') && number.checked_in">
                                                <small class="pull-right font-normal">checked in</small>
                                                <span class="pull-right mr5 glyphicon glyphicon-ok"
                                                    style="font-size: 10px;
                                                    margin-top:5px;
                                                    margin-right: 3px;"
                                                ></span>
                                            </span>
                                        </li>
                                        <li ng-repeat="number in uncalled_numbers"
                                            data-tnumber="@{{ number.transaction_number }}"
                                            data-pnumber="@{{ number.priority_number }}"
                                            data-priority_number="@{{ number.priority_number }}"
                                            data-name="@{{ number.name }}"
                                            data-email="@{{ number.email }}"
                                            data-phone="@{{ number.phone }}"
                                            data-queue_platform="@{{ number.queue_platform }}"
                                            data-checked_in="@{{ number.checked_in }}"
                                            >
                                            @{{ number.priority_number }}
                                            <small class="font-normal">@{{ number.queue_platform }}</small>
                                            <span
                                               class="font-normal pull-right mr5 userinfo show-messages"
                                               title="Number: @{{ number.priority_number }}"
                                               data-toggle="modal"
                                               data-target="#priority-number-modal"
                                               data-priority-number="@{{ number.priority_number }}"
                                               data-name="@{{ number.name }}"
                                               data-email="@{{ number.email }}"
                                               data-phone="@{{ number.phone }}"
                                            >
                                                <a href="#">
                                                    <span ng-if="number.name"
                                                    style="text-transform: capitalize;
                                                    font-size: 14px;"
                                                    >@{{ number.name }}</span>
                                                </a>
                                            </span>
                                            <span ng-if="(number.queue_platform == 'remote' || number.queue_platform == 'android') && number.checked_in">
                                                <small class="pull-right mr5 font-normal"
                                                    style="margin-top: 3px;
                                                    margin-right: 20px;"
                                                >checked in</small>
                                                <span class="pull-right glyphicon glyphicon-ok"
                                                    style="font-size: 10px;
                                                    margin-top:5px;
                                                    margin-right:3px;"
                                                > </span>
                                            </span>

                                        </li>
                                    </ul>
                                </div>
                                <input id="issue-call-number" type="text" class="form-control" min="1" max="@{{ number_limit }}"  ng-model="issue_call_number" ng-show="timebound_numbers.length == 0 && uncalled_numbers.length == 0">
                            </div>
                            <point-of-interest position="left" bottom="85" right="100"  title="Issued Numbers" description="Look for the numbers you want to call in this drop-down list or type the number you want call when the list is empty."></point-of-interest>
                            <div class="col-md-1 col-sm-1 col-xs-3">
                                <a ng-if="date == today" id="btn-pmore" class="btn btn-md btn-primary" data-toggle="modal" data-target="#moreq" title="Issue a number.">+</a>
                            </div>
                            <point-of-interest position="right" bottom="85" right="25"  title="Issue Numbers" description="Click on the blue '+' (plus) button to issue more numbers."></point-of-interest>
                            <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                                <button class="btn btn-orange btn-md" id="btn-call" ng-click="issueOrCall()" ng-disabled="isCalling" ng-if="date == today">CALL NUMBER</button>
                                <button class="btn btn-orange btn-md" id="btn-call" ng-click="moveToday()" ng-disabled="isCalling" ng-if="date != today">MOVE TO CURRENT</button>
                            </div>
                            <point-of-interest position="right" bottom="85" right="-1"  title="Call Numbers" description="Click on the <strong>CALL NUMBER</strong> button to call the number selected on the drop-down list."></point-of-interest>
                        </form>
                    </div>
                </div>
                <div ng-show="called_numbers.length != 0">
                    <point-of-interest position="left" bottom="68" right="96" title="Called Number" description="Click on the number to view the information about the user assigned to this number."></point-of-interest>
                    <point-of-interest position="left" bottom="68" right="16.5" title="Drop Number" description="The <strong>Drop</strong> button (trashcan icon) indicates that the person assigned to the number did not show thus removes the number from the list."></point-of-interest>
                    <point-of-interest position="left" bottom="68" right="1.5" title="Next Number" description="The <strong>Next</strong> button indicates that the number has been served and calls the next number on the list."></point-of-interest>
                </div>
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th></th>
                        <td>
                            <div class="progress" style="padding-top: 0;" ng-show="isStopping">
                                <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="@{{ progress_current }}" aria-valuemin="0" aria-valuemax="@{{ progress_max }}" style="padding-top: 0; width: @{{ stop_progress + '%' }}">
                                    <span> Stopping... </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <button ng-if="date == today" class="pull-right btn btn-sm btn-danger stopbutton" ng-click="stopProcessQueue()">
                                <span class="glyphicon glyphicon-stop"></span> STOP
                            </button>
                        </td>
                    </tr>
                    <tr ng-repeat="number in called_numbers" data-tnumber="@{{ number.transaction_number }}">
                        <th scope="row">
                            <a href="#" class="priority-number" title="Number: @{{ number.priority_number }}" data-transaction-number="@{{ number.transaction_number }}" data-priority-number="@{{ number.priority_number }}" data-name="@{{ number.name }}" data-phone="@{{ number.phone }}" data-email="@{{ number.email }}" data-toggle="modal" data-target="#priority-number-modal">
                                @{{ number.priority_number }} <span class="glyphicon glyphicon-zoom-in"></span>
                            </a>
                        </th>
                        <td>
                            <div>
                                <a ng-if="number.name" href="#" class="show-messages" title="Number: @{{ number.priority_number }}" data-transaction-number="@{{ number.transaction_number }}" data-priority-number="@{{ number.priority_number }}" data-name="@{{ number.name }}" data-phone="@{{ number.phone }}" data-email="@{{ number.email }}" data-toggle="modal" data-target="#priority-number-modal">
                                    <span>@{{ number.name }}</span>
                                </a>
                            </div>
                        </td>
                        <td>
                            <form ng-if="date == today" class="star-rating-form" ng-show="called_numbers[$index].verified_email">
                                <span class="star-rating">
                                    <input type="radio" name="rating" ng-model="called_numbers_rating[$index]" value="1"><i></i>
                                    <input type="radio" name="rating" ng-model="called_numbers_rating[$index]" value="2"><i></i>
                                    <input type="radio" name="rating" ng-model="called_numbers_rating[$index]" value="3"><i></i>
                                    <input type="radio" name="rating" ng-model="called_numbers_rating[$index]" value="4"><i></i>
                                    <input type="radio" name="rating" ng-model="called_numbers_rating[$index]" value="5"><i></i>
                                </span>
                            </form>
                            <a ng-if="date == today" class="delete" ng-click="dropNumber(number.transaction_number)" ng-disabled="isProcessing"><span class="glyphicon glyphicon-trash"></span></a>
                            <a ng-if="date == today" class="btn btn-sm btn-default"  ng-click="serveAndCallNext(number.transaction_number)" ng-disabled="isProcessing">Next <span class="glyphicon glyphicon-arrow-right"></span></a>
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
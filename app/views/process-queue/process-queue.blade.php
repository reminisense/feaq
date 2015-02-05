@extends('user.dashboard_master')

@section('scripts')
    {{ HTML::script('js/process-queue/process-queue.js') }}
    {{ HTML::script('js/process-queue/process-queue-angular.js') }}
@stop

@section('content')
    <!-- Process queue main -->
    <div class="row " ng-controller="processqueueController">
        <div class="col-md-12">
            <h2 class="heading">{{ $business_name }}</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="boxed mb20 processq">
                        <div class="head head-blue">
                            <h3>{{ $terminal_name }}</h3>
                        </div>
                        <div class="body">
                            <form class="clearfix">
                                <div class="row mb30">
                                    <div class="col-md-8 col-xs-12">
                                        <input id="selected-tnumber" type="hidden" ng-value="called_number" value=0>
                                        <button class="btn-select btn-md dropdown-toggle" type="button" data-toggle="dropdown">
                                            <span id="selected-pnumber">Please select a number</span><span class="caret"></span> <!-- @todo replace this with selected number-->
                                        </button>
                                        <ul class="dropdown-menu dd-select" id="uncalled-numbers">
                                            <li ng-repeat="number in uncalled_numbers" data-tnumber="@{{ number.transaction_number }}" data-pnumber="@{{ number.priority_number }}">@{{ number.priority_number }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-2 col-xs-12">
                                        <div id="pmsg">
                                            <!-- Comment Button for next release
                                            <button id="" class="btn btn-cyan btn-lg">
                                                <span class="glyphicon glyphicon-comment"></span>
                                            </button>
                                            -->
                                            <div id="pmsg-window">
                                                <div class="wrap">
                                                    <form>
                                                        <input type="text" placeholder="Input Number">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pmore">
                                            <button id="btn-pmore" class="btn btn-blue btn-lg" data-toggle="modal" data-target="#moreq">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-xs-12 text-right">
                                        <button class="btn btn-lg btn-orange" id="btn-call" ng-click="callNumber()" ng-disabled="isCalling">CALL NUMBER</button>
                                    </div>
                                </div>
                            </form>
                            <!-- called numbers -->
                            <table class="table">
                                <thead></thead>
                                <tbody>
                                <tr ng-repeat="number in called_numbers">
                                    <th scope="row">@{{ number.priority_number }}</th>
                                    <!-- if this terminal -->
                                    <td ng-if="number.terminal_id == terminal_id">
                                        <button class="btn btn-gray" ng-click="dropNumber(number.transaction_number)" ng-disabled="isProcessing"><span class="glyphicon glyphicon-trash"></span></button>
                                        <button class="btn btn-cyan" ng-click="serveAndCallNext(number.transaction_number)" ng-disabled="isProcessing"><span class="glyphicon glyphicon-arrow-right"></span> Next</button>
                                        <button class="btn btn-cyan" ng-click="serveNumber(number.transaction_number)" ng-disabled="isProcessing"><span class="glyphicon glyphicon-ok"></span> Serve</button>
                                    </td>
                                    <!-- not this terminal -->
                                    <td ng-if="number.terminal_id != terminal_id">
                                        @{{ number.terminal_name }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
@stop

@section('modals')
    @include('modals.process-queue.issue-number-modal')
@stop
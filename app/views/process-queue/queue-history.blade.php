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
    {{--<script src="/js/process-queue/process-queue.js"></script>--}}
    {{--<script src="/js/process-queue/process-queue-angular.js"></script>--}}
    {{--<script src="/js/process-queue/issue-number-angular.js"></script>--}}
    {{--<script src="/js/process-queue/messages-angular.js"></script>--}}
    {{--<script src="/js/dashboard/dashboard.js"></script>--}}

    {{--<script src="/js/google-analytics/googleAnalytics.js"></script>--}}
    {{--<script src="/js/google-analytics/ga-process_queue.js"></script>--}}
    {{--<script src="https://ucarecdn.com/widget/2.3.5/uploadcare/uploadcare.min.js" charset="utf-8"></script>--}}
    {{--<script>--}}
        {{--UPLOADCARE_LOCALE = "en";--}}
        {{--UPLOADCARE_TABS = "file";--}}
        {{--UPLOADCARE_PUBLIC_KEY = "844c2b9e554c2ee5cc0a";--}}
    {{--</script>--}}
    {{--<script src="/js/dashboard/dashboard.js"></script>--}}
    {{--<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>--}}
@stop

@section('container')
    <div class="feat feat-processq">
        <div class="container">
            <div class="text-center">
                <h1><span class="glyphicon glyphicon-fast-forward"></span> Forwarding History</h1>
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
                    <h3><strong>{{ $service_name }}</strong></h3>
                    Showing numbers for date:
                    <div class="col-md-12 row">
                        <div class="col-md-4">
                            <input type="text" class="datepicker form-control" ng-model="date" ng-change="getAllNumbers()" readonly="readonly" style="cursor: text; background-color: #FFFFFF"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="boxed processq-box processq">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="10%">Transaction Number</th>
                            <th width="10%">Priority Number</th>
                            <th width="30%">Forwarder Terminal</th>
                            <th width="30%">Forwarder</th>
                            <th width="10%">Forwarded Service</th>
                            <th width="10%">Forwarder Priority Number</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0123456</td>
                                <td>45</td>
                                <td>Monster Inc Terminal</td>
                                <td>Aunne Arzadon</td>
                                <td>Cashier</td>
                                <td>1</td>
                            </tr>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->forwarder_transaction_number }}</td>
                                <td>{{ $transaction->forwarded_priority_number }}</td>
                                <td>{{ $transaction->forwarder_terminal_id }}</td>
                                <td>{{ $transaction->forwarder_user_id }}</td>
                                <td>{{ $transaction->service_id }}</td>
                                <td>{{ $transaction->priority_number }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- urls -->
    <input type="hidden" id="service-id" value="{{ $service_id }}">
    <input type="hidden" id="business-id" value="{{ $business_id }}">
    <input type="hidden" id="all-numbers-url" value="{{ url('/processqueue/allnumbers/') }}">

@stop
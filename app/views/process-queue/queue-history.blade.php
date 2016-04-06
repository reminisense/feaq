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
    <script type="text/javascript">
        (function(){
            $(".datepicker").datepicker({ dateFormat: 'mm-dd-yy' });

            app.requires.push('ngSanitize');
            app.requires.push('angular-loading-bar'); //add angular loading bar
            app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
                cfpLoadingBarProvider.includeSpinner = false;
            }]);

            app.controller('forwardHistoryController', function($scope, $http){
                var current_date = new Date();
                var day = current_date.getDate() < 10 ? '0' + current_date.getDate() : current_date.getDate();
                var month = (current_date.getMonth() + 1) < 10 ? '0' + (current_date.getMonth() + 1) : (current_date.getMonth() + 1);
                var year = current_date.getFullYear();

                $scope.today = month + '-' + day + '-' + year;
                $scope.date = $scope.today;
                $scope.service_id = $('#service-id').val();
                $scope.transactions = null;
                $scope.getForwardHistory = function(){
                    $http.get('/processqueue/forward-history-data/' + $scope.service_id + '/' + $scope.date)
                            .success(function(response){
                                $scope.transactions = response.data;
                            });
                };

                $scope.getForwardHistory();
            });
        })();
    </script>
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

    <div class="container" id="process-queue-wrapper" ng-controller="forwardHistoryController">
        <div class="row">
            <div class="page-header clearfix">
                <div class="col-md-offset-1 col-md-10 col-sm-10">
                    <div class="col-md-9 col-sm-9">
                        <p>Business Name:</p>
                        <h2><strong>{{ $business_name }}</strong></h2>
                        <br>
                        <p>Service Name:</p>
                        <h2><strong>{{ $service_name }}</strong></h2>
                    </div>
                    <div class="col-md-3 col-sm-3 text-right">
                        <h2 class=" cyan"><span class="glyphicon glyphicon-calendar"></span> <strong>Select a date</strong></h2>
                        <p>To view queue forwarding history</p>
                        <br>
                        <div class="form-group">
                            <input id="input-history-date" type="text" class="datepicker form-control" ng-model="date" ng-change="getForwardHistory()" readonly="readonly"/>
                            <input type="text" class="form-control" ng-model="searchText" placeholder="Search"/>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="boxed ">
                    <table class="table table-bordered table-striped" id="table-queue-history">
                        <thead>
                        <tr>
                            <th width="10%" class="text-center">Confirmation Code</th>
                            <th width="15%" class="text-center">Customer Name</th>
                            <th width="20%" class="text-center">Forwarder</th>
                            <th width="15%" class="text-center">From Terminal</th>
                            <th width="10%" class="text-center">Priority Number</th>
                            <th width="15%" class="text-center">To Service</th>
                            <th width="10%" class="text-center">New Priority Number</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="transaction in transactions | filter:searchText" >
                                <td class="text-center">@{{ transaction.confirmation_code }}</td>
                                <td class="text-center">@{{ transaction.customer_name }}</td>
                                <td class="text-center">@{{ transaction.forwarder_first_name + ' ' + transaction.forwarder_last_name}}</td>
                                <td class="text-center">@{{ transaction.forwarder_terminal_name }}</td>
                                <td class="text-center">@{{ transaction.forwarded_priority_number }}</td>
                                <td class="text-center">@{{ transaction.forwarded_service }}</td>
                                <td class="text-center">@{{ transaction.priority_number }}</td>
                            </tr>
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
@extends('dashboard')

@section('subtitle')
    Advanced Analytics
@stop

@section('styles')
    <link rel='stylesheet' type='text/css' href='/css/business/business.css'>
    <link rel='stylesheet' type='text/css' href='/css/business/responsive.css'>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@stop

@section('scripts')
    <script type="text/javascript" src="/js/business/advanced-analytics.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
@stop

@section('container')
    <div class="feat feat-business">
        <div class="container">
            <div class="text-center">
                <h1><span class="glyphicon glyphicon-stats"></span>Advanced Analytics</h1>
            </div>
        </div>
        <div class="arrow">
            <img src="/img/arrow.png">
        </div>
    </div>
    <div class="container" ng-controller="businessAnalyticsController">
        <div class="row">
            <p>
            <form class="clearfix" ng-submit="getBusinessAnalytics(startdate, enddate)">
                <div class="col-md-2">
                    <input type="text" id="start-date" name="start-date" class="form-control datepicker" ng-model="startdate"/>
                </div>
                <div class="col-md-2">
                    <input type="text" id="end-date" name="end-date" class="form-control datepicker" ng-model="enddate"/>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-lg btn-primary" type="submit" ng-disabled="startdate > enddate">Get Analytics</button>
                </div>
            </form>
            </p>
        </div>
        <div class="row">
            <div class="biz-navs">
                <div id="messages-wrap" class="form-group row">
                    <ul role="tablist" class="nav nav-tabs" id="bizTab">
                        <li role="presentation" class="active"><a data-toggle="tab" href="#queue-activity">Queue Activity</a></li>
                        <li role="presentation"><a data-toggle="tab" href="#terminal-users">Terminal Users</a></li>
                        <li role="presentation"><a data-toggle="tab" href="#basic">Basic</a></li>
                    </ul>
                    <div id="bizTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="queue-activity">
                            <div class="clearfix header">
                                <p>Displays the activity of the first day of specified range.</p>
                                <button class="btn btn-lg btn-primary" ng-click="generateQueueGraph()" type="button">Generate Graph</button>
                            </div>
                            <div id="queue-activity-graph"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="terminal-users" ng-show="analytics.terminals.length > 0">
                            <table class="table" ng-repeat="terminal in analytics.terminals">
                                <thead>
                                    <tr>
                                        <th colspan="6">@{{ terminal.terminal_name }}</th>
                                    </tr>
                                    <tr>
                                        <th width="40%">Name</th>
                                        <th width="15%" class="text-center">Numbers Called</th>
                                        <th width="15%" class="text-center">Numbers Served</th>
                                        <th width="15%" class="text-center">Numbers Dropped</th>
                                        <th width="20%" class="text-center">Average Serving Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="user in terminal.users">
                                        <td>@{{ user.user_name }}</td>
                                        <td class="text-center">@{{ user.numbers_called }}</td>
                                        <td class="text-center">@{{ user.numbers_served }}</td>
                                        <td class="text-center">@{{ user.numbers_dropped }}</td>
                                        <td class="text-center">@{{ user.average_serving_time }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="basic">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td style="padding-top: 18px;">
                                        <p class="title">
                                            Queued Numbers Remaining:
                                        </p>
                                    </td>
                                    <td style="padding-top: 18px;">@{{ analytics.remaining_count ? analytics.remaining_count : "0" }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="title">
                                            Total Numbers Issued:
                                        </p>
                                    </td>
                                    <td>@{{ analytics.total_numbers_issued ? analytics.total_numbers_issued : "0" }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="title">
                                            Total Numbers Called:
                                        </p>
                                    </td>
                                    <td>@{{ analytics.total_numbers_called ? analytics.total_numbers_called : "0" }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="title">
                                            Total Numbers Served: </p>
                                    </td>
                                    <td>@{{ analytics.total_numbers_served ? analytics.total_numbers_served : "0" }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="title">Total Numbers Dropped:</p>
                                    </td>
                                    <td>@{{ analytics.total_numbers_dropped ? analytics.total_numbers_dropped : "0" }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="title">Average Waiting Time: </p>
                                    </td> <!-- from number issued to calling -->

                                    <td>@{{ analytics.average_time_called ? analytics.average_time_called : "0 minute(s) 0 second(s)" }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="title">Average Serving Time:
                                        </p>
                                    </td> <!-- from number called to served -->
                                    <td>@{{ analytics.average_time_served ? analytics.average_time_served : "0 minute(s) 0 second(s)" }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end of tab contents -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" value="{{ $business_id }}" id="business_id"/>
@stop
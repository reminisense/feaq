@extends('dashboard')
@section('styles')
<link rel='stylesheet' type='text/css' href='/css/business/business.css'>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@stop
@section('container')
<div class="feat feat-business">
    <div class="container">
        <div class="text-center">
            <h1><span class="glyphicon glyphicon-stats"></span>My Statistics</h1>
        </div>
    </div>
    <div class="arrow">
        <img src="/img/arrow.png">
    </div>
</div>
<div class="container" ng-controller="statsController">
    <div class="row">
        <div class="biz-details-wrap">
            <div class="form-group">
                <div class="col-md-11">
                    <input type="hidden" id="user_id" value="{{ $user_id }}">
                    <select class="form-control" id="keyword" ng-model="keyword">
                        <option ng-repeat="keyword in keywords" value="@{{ keyword.keyword }}">@{{ keyword.name }}</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary" ng-click="loadChart()">Load Chart</button>
                </div>
                <div class="col-md-12">
                    <div id="statChart" style="height: 618px;"></div>
                </div>
            </div>
        </div>
    </div>

</div>
@stop

@section('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="/js/analytics/user_analytics.js"></script>
@stop
@extends('dashboard')
@section('styles')
    <link rel='stylesheet' type='text/css' href='/css/business/business.css'>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@stop
@section('container')
    <div class="feat feat-business">
        <div class="container">
            <div class="text-center">
                <h1><span class="glyphicon glyphicon-stats"></span>FeatherQ Statistics</h1>
            </div>
        </div>
        <div class="arrow">
            <img src="/img/arrow.png">
        </div>
    </div>

    <div ng-controller="graphsController">

        <div class ="container" id="graphs-container">
            <ul id="graph-nav" class="nav nav-tabs">
                <li class="active"><a href="#issued-container">Issued</a></li>
                <li><a href="#called-container">Called</a></li>
                <li><a href="#served-container">Served</a></li>
                <li><a href="#dropped-container">Dropped</a></li>
            </ul>
            <div id="issued-container" class="container table-bordered">
                <div id="lineIssuedChart"></div>
            </div>
            <div id="called-container" class="container table-bordered ">
                <div id="lineCalledChart"></div>
            </div>
            <div id="served-container" class="container table-bordered">
                <div id="lineServedChart"></div>
            </div>
            <div id="dropped-container" class="container table-bordered">
                <div id="lineDroppedChart"></div>
            </div>

        </div>


    </div>

    <input type="hidden" id="start_date" value="{{ $start_date }}">
    <input type="hidden" id="end_date" value="{{ $end_date }}">
    <input type="hidden" id="mode" value="{{ $mode }}">
    <input type="hidden" id="value" value="{{ $value }}">
@stop

@section('scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="/js/admin/business_graphs.js"></script>
@stop
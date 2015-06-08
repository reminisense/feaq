@extends('dashboard')
@section('styles')
<link rel='stylesheet' type='text/css' href='/css/business/business.css'>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@stop
@section('container')
<div class="feat feat-business">
    <div class="container">
        <div class="text-center">
            <h1><span class="glyphicon glyphicon-stats"></span>Admin Page</h1>
        </div>
    </div>
    <div class="arrow">
        <img src="/img/arrow.png">
    </div>
</div>
<div class="container" ng-controller="adminController">
    <div class="row">
        <div class="biz-details-wrap">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#all-admins" data-toggle="tab">Admins</a></li>
                <li><a href="#usage-stats" data-toggle="tab">Usage Stats</a></li>
                <li><a href="#featherqash" data-toggle="tab">FeatherQash</a></li>
            </ul>
            <div class="clearfix tab-content">
                <div class="tab-pane fade active in" id="all-admins">
                    @include('admin.admin-tabs.admins-list-tab')
                </div>
                <div class="tab-pane fade in" id="usage-stats"> <!--usage stats tab-->
                    @include('admin.admin-tabs.usage-stats-tab')
                </div><!-- eo usage stats tab-->
                <div class="tab-pane fade in" id="featherqash"> <!--featherqash tab-->
                    @include('admin.admin-tabs.featherqash-tab')
                </div> <!--eo featherqash tab-->
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="/js/admin/admin.js"></script>
@stop
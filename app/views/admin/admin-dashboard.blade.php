@extends('dashboard')
@section('styles')
<link rel='stylesheet' type='text/css' href='/css/admin/admin.css'>
<link rel='stylesheet' type='text/css' href='/css/business/business.css'>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<link rel="stylesheet" href="/css/jquery-ui.css">
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
<div class="container" ng-controller="adminController" id="adminController">
    <div class="clearfix biz-details-wrap" style="min-height: 500px;">
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div id="tabs">
                            <ul class="nav nav-tabs nav-pills admin-tabs">
                                <li class="active"><a href="#business-features" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> General Settings</a></li>
                                <li><a href="#all-admins" data-toggle="tab"><span class="glyphicon glyphicon-king"></span> Admins</a></li>
                                <li><a href="#usage-stats" data-toggle="tab"><span class="glyphicon glyphicon-tasks"></span> Usage Stats</a></li>
                                <li><a href="#business-stats" data-toggle="tab"><span class="glyphicon glyphicon-briefcase"></span> Business Stats</a></li>
                            </ul>
            </div>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="clearfix tab-content" id="admin-cont-wrap">
                            <div class="tab-pane fade in" id="all-admins">
                                @include('admin.admin-tabs.admins-list-tab')
                            </div>
                            <div class="tab-pane fade in" id="usage-stats"> <!--usage stats tab-->
                                @include('admin.admin-tabs.usage-stats-tab')
                            </div><!-- eo usage stats tab-->
                            <div class="tab-pane fade in" id="business-stats"> <!--business numbers-->
                                @include('admin.admin-tabs.business-stats-tab')
                            </div>
                            <div class="tab-pane fade  active in" id="business-features">
                                @include('admin.admin-tabs.business-features-tab')
                            </div>
                        </div>
        </div>

    </div>
</div>
@stop

@section('scripts')
<script src="/js/raphael-min.js"></script>
<script src="/js/morris.min.js"></script>
<script src="/js/jquery-ui.minjs"></script>
<script src="/js/admin/admin.js"></script>
<script src="/js/dashboard/dashboard.js"></script>
<script type="text/javascript" src="/js/jstz.min.js"></script>
<script>
    UPLOADCARE_LOCALE = "en";
    UPLOADCARE_TABS = "file";
    UPLOADCARE_PUBLIC_KEY = "844c2b9e554c2ee5cc0a";
</script>
<script charset="utf-8" src="//ucarecdn.com/widget/2.3.4/uploadcare/uploadcare.full.min.js"></script>
@stop
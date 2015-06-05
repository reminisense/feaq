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
            </ul>
            <div class="clearfix tab-content">
                <div class="tab-pane fade active in" id="all-admins">
                    <div class="form-group">
                        <form ng-submit="addAdmin(admin_email)">
                            <div class="col-md-11">
                                <input class="form-control" type="email" required ng-model="admin_email">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-lg btn-blue">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="form-group">
                        <div class="col-md-11">
                            <h5><span class="glyphicon glyphicon-refresh" ng-click="getAdmins($event)" style="cursor: pointer"></span> List of Admin Emails: </h5>
                            <div class="row">
                                <div class="col-lg-3" ng-repeat="email in admins">
                                    <p>
                                        <a class="label label-danger" href="#" ng-click="removeAdmin(email, $event)">X</a>
                                        <span class="title">@{{ email }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade in" id="usage-stats"> <!--usage stats tab-->
                    <div class="form-group">
                        <div class="col-md-10">
                            <input type="hidden" id="user_id" value="{{ $user_id }}">
                            <select class="form-control" id="keyword" ng-model="keyword">
                                <option ng-repeat="keyword in keywords" value="@{{ keyword.keyword }}">@{{ keyword.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-primary" ng-click="loadChart()">Load Chart</button>
                        </div>
                        <div class="col-md-1 div-view-business">
                            <button class="btn btn-primary" ng-click="loadBusinessNumbers()">View Business Numbers</button>
                        </div>
                        <div class="col-md-12">
                            <div id="statChart" style="min-height: 477px;"></div>
                        </div>
                    </div>
                </div><!-- eo usage stats tab-->
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
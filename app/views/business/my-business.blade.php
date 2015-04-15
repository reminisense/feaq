@extends('dashboard')

@section('subtitle')
My Business
@stop

@section('styles')
    <link rel='stylesheet' type='text/css' href='/css/business/business.css'>
    <link rel='stylesheet' type='text/css' href='/css/dashboard.css'>
    <link media="all" type="text/css" rel="stylesheet" href="/css/jquery.timepicker.min.css">
@stop

@section('scripts')
    <script src="/js/jquery.form.js"></script>
    <script src="/js/dashboard/dashboard.js"></script>
    <script src="/js/dashboard/edit-business.js"></script>
    {{--<script src="/js/google-analytics/googleAnalytics.js"></script>--}}
    {{--<script src="/js/google-analytics/ga-dashboard.js"></script>--}}
@stop

@section('container')
<div class="feat feat-business">
    <div class="container">
        <div class="text-center">
            <h1><span class="glyphicon glyphicon-home"></span>My Business</h1>
        </div>
    </div>
    <div class="arrow">
        <img src="/img/arrow.png">
    </div>
</div>

<div class="container" ng-controller="editBusinessController" id="editBusiness">
    @if(isset($business_id))
    <div class="row">
        <div class="biz-details-wrap">
            <div class="col-md-12">
                <div class="row">
                    <img class="col-md-2 col-xs-4" src="/img/biz-qrcode.jpg">
                    <div class="biz-details col-md-7 col-xs-12">
                        <h2>@{{ business_name }}</h2>
                        <p class="address"><span class="glyphicon glyphicon-map-marker"></span> @{{ business_address }}</p>
                        {{--<p class="contact"><span class="glyphicon glyphicon-phone-alt"></span> +032 259 8611 / +038 259 8622 </p><br>--}}
                        <a class="btn btn-sm btn-primary" href="{{ url('business/pdf-download/' . $business_id) }}" target="_blank">Download QR Code</a>
                    </div>
                    <div class="col-md-3 col-xs-10 ">
                        <a id="view-broadcast" href="{{ url('broadcast/business/' . $business_id) }}" target="_blank">View Broadcast Screen</a>
                        <div id="process-queue" href="#" class="boxed edit-biz">
                            <a href="#" style="color: #ffffff">Process <br>Queue</a>
                            <div class="biz-terminals">
                                <div class="clearfix">
                                    <div ng-repeat="terminal in terminals" >
                                        <a ng-if="isAssignedUser(user_id, terminal.terminal_id)" href="{{ url('/processqueue/terminal') }}/@{{ terminal.terminal_id }}" target="_blank" style="padding: 8px;">
                                            <span class=" glyphicon glyphicon-ok "></span>
                                            <small>@{{ terminal.name }}</small>
                                        </a>
                                        <a ng-if="!isAssignedUser(user_id, terminal.terminal_id)" href="#" class="not-active" style="padding: 8px;">
                                            <span class=" glyphicon glyphicon-ban-circle"></span>
                                            <small>@{{ terminal.name }}</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="biz-navs">
            <form>
                <div class="form-group row">
                    <ul id="bizTab" class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#details" id="details-tab" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span>Details</a></li>
                        <li class=""><a href="#terminals" id="terminals-tab" data-toggle="tab"><span class="glyphicon glyphicon-tasks"></span> Terminals</a></li>
                        <li class=""><a href="#broadcast" id="broadcast-tab" data-toggle="tab"><span class="glyphicon glyphicon-th-large"></span> Broadcast</a></li>
                        <li class=""><a href="#ads" id="ads-tab" data-toggle="tab"><span class="glyphicon glyphicon-blackboard"></span> Advertisements</a></li>
                        <li class=""><a href="#settings" id="settings-tab" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                        <li class=""><a href="#analytics" id="analytics-tab" data-toggle="tab"><span class="glyphicon glyphicon-stats"></span> Analytics</a></li>
                    </ul>
                    <div id="bizTabContent" class="tab-content" style="">
                        <div class="col-md-12">
                            <div class="alert" id="edit_message" style="display: none;">
                                <p style="text-align: center;"></p>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade active in" id="details" aria-labelledby="details-tab">
                            <div class="clearfix">@include('business.my-business-tabs.details-tab')</div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="terminals" aria-labelledby="terminals-tab">
                            <div class="clearfix">@include('business.my-business-tabs.terminals-tab')</div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="broadcast" aria-labelledby="broadcast-tab">
                            <div class="clearfix">@include('business.my-business-tabs.broadcast-tab')</div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="ads" aria-labelledby="ads-tab">
                            <div class="clearfix">@include('business.my-business-tabs.advertisements-tab')</div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="settings" aria-labelledby="settings-tab">
                            <div class="clearfix">@include('business.my-business-tabs.settings-tab')</div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="analytics" aria-labelledby="analytics-tab">
                            <div class="clearfix">@include('business.my-business-tabs.analytics-tab')</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @else
        <div class="row">
            <div class="biz-details-wrap">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 col-xs-6 " data-toggle="modal" id="add_business">
                            <a id="add-business" target="_blank">Create Your <br/>First Business</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- js variables used --}}
<!-- business -->
<input type="hidden" id="user_id" value="@if(isset($user_id)){{ $user_id }} @endif">
<input type="hidden" id="business_id" value="@if(isset($business_id)){{ $business_id }}@endif">
<input type="hidden" id="business-details-url" value="{{ url('/business/businessdetails/') }}">
<input type="hidden" id="business-edit-url" value="{{ url('/business/edit-business/') }}">
<input type="hidden" id="business-remove-url" value="{{ url('/business/remove/') }}">

<!-- terminals -->
<input type="hidden" id="terminal-assign-url" value="{{ url('/terminal/assign/') }}">
<input type="hidden" id="terminal-unassign-url" value="{{ url('/terminal/unassign/') }}">
<input type="hidden" id="terminal-delete-url" value="{{ url('/terminal/delete/') }}">
<input type="hidden" id="terminal-edit-url" value="{{ url('/terminal/edit/') }}">
<input type="hidden" id="terminal-create-url" value="{{ url('/terminal/create/') }}">
<input type="hidden" id="user-emailsearch-url" value="{{ url('/user/emailsearch/') }}">

<!-- broadcast -->
<input type="hidden" id="broadcast-set-theme-url" value="{{ url('/broadcast/set-theme/') }}">
<input type="hidden" id="broadcast-json-url" value="{{ url('/json/') }}">
<input type="hidden" id="ads-embed-video-url" value="{{ url('/advertisement/embed-video/') }}">
<input type="hidden" id="ads-tv-select-url" value="{{ url('/advertisement/tv-select/') }}">
<input type="hidden" id="ads-tv-on-url" value="{{ url('/advertisement/turn-on-tv/') }}">
<input type="hidden" id="ads-type-url" value="{{ url('/advertisement/ad-type/') }}">

<!-- queue settings-->
<input type="hidden" id="queue-settings-get-url" value="{{ url('/queuesettings/allvalues/') }}">
<input type="hidden" id="queue-settings-update-url" value="{{ url('/queuesettings/update/') }}">
@include('modals.business.setup-business-modal')
@stop
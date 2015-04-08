@extends('user.dashboard_master')

@section('subtitle')
My Business
@stop

@section('styles')
    <link rel='stylesheet' type='text/css' href='/css/global.css'>
    <link rel='stylesheet' type='text/css' href='/css/business/business.css'>
@stop

@section('scripts')
    <script src="/js/dashboard/dashboard.js"></script>
    <script src="/js/jquery.form.js"></script>
    <script src="/js/dashboard/edit-business.js"></script>
    <script src="/js/jquery.timepicker.min.js"></script>
    <script src="/js/intlTelInput.js"></script>
    <script src="/js/dashboard/jquery.validate.js"></script>
    <script src="/js/dashboard/search-business.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="/js/jquery.geocomplete.js"></script>

    {{--<script src="/js/google-analytics/googleAnalytics.js"></script>--}}
    {{--<script src="/js/google-analytics/ga-dashboard.js"></script>--}}
@stop

@section('content')
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
    <div class="row">
        <div class="biz-details-wrap">
            <div class="col-md-12">
                <div class="row">
                    <img class="col-md-2 col-xs-4" src="/img/biz-qrcode.jpg">
                    <div class="biz-details col-md-7 col-xs-12">
                        <h2>@{{ business_name }}</h2>
                        <p class="address"><span class="glyphicon glyphicon-map-marker"></span> @{{ business_address }}</p>
                        <p class="contact"><span class="glyphicon glyphicon-phone-alt"></span> +032 259 8611 / +038 259 8622 </p><br>
                        <a class="btn btn-sm btn-primary" href="{{ url('business/pdf-download/' . $business_id) }}" target="_blank">Download QR Code</a>
                    </div>
                    <div class="col-md-3 col-xs-6 ">
                        <a id="view-broadcast" href="{{ url('broadcast/business/' . $business_id) }}" target="_blank">View Broadcast Screen</a>
                        <a id="process-queue" href="{{ url('processqueue/terminal/' . $first_terminal) }}" target="_blank">Process <br>Queue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="biz-navs">
            <ul id="bizTab" class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#details" id="details-tab" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span>Details</a></li>
                <li class=""><a href="#terminals" id="terminals-tab" data-toggle="tab"><span class="glyphicon glyphicon-tasks"></span> Terminals</a></li>
                <li class=""><a href="#broadcast" id="broadcast-tab" data-toggle="tab"><span class="glyphicon glyphicon-th-large"></span> Broadcast</a></li>
                <li class=""><a href="#settings" id="settings-tab" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                <li class=""><a href="#analytics" id="analytics-tab" data-toggle="tab"><span class="glyphicon glyphicon-stats"></span> Analytics</a></li>
            </ul>
            <div id="bizTabContent" class="tab-content" style="min-height: 500px;">
                <div role="tabpanel" class="tab-pane fade active in" id="details" aria-labelledby="details-tab">
                    <p>@include('business.my-business-tabs.details-tab')</p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="terminals" aria-labelledby="terminals-tab">
                    <p>@include('business.my-business-tabs.terminals-tab')</p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="broadcast" aria-labelledby="broadcast-tab">
                    <p>@include('business.my-business-tabs.broadcast-tab')</p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings" aria-labelledby="settings-tab">
                    <p>@include('business.my-business-tabs.settings-tab')</p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="analytics" aria-labelledby="analytics-tab">
                    <p>@include('business.my-business-tabs.analytics-tab')</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- js variables used --}}
<!-- business -->
<input type="hidden" id="business_id" value="{{ $business_id }}">
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
@stop
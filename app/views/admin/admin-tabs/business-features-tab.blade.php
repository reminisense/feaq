<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger mt30" ng-if="messages.error_message != '' && messages.error_message != undefined">@{{ messages.error_message }}</div>
            <div class="alert alert-success mt30" ng-if="messages.success_message != '' && messages.success_message != undefined">@{{ messages.success_message }}</div>
        </div>
        <div class="col-md-12 mb20">
            <div class="container mt30 general-container">
                <div class="col-md-6">
                    <button id="business-settings"><h4>Business</h4></button>
                </div>
                <div class="col-md-6">
                    <button id="user-settings"><h4>User</h4></button>
                </div>
            </div>
            <div class="container business-container">
                <div class="search-business container">
                    <form ng-submit="searchBusiness()">
                        <div class="col-md-10">
                            <input type="text" ng-model="business_name" placeholder="Search for a business.."/>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="biz-results">
                    <div ng-repeat="business in businesses" class="mt10">
                        <span class="biz-name">@{{ business.business_name }}</span>
                        <a href="#" class="biz-manage" ng-click="manageBusiness(business.business_id)">Manage</a>
                    </div>
                </div>
                <div class="biz-specific mt20">
                    <div class="biz-main">
                        <h4> > Details</h4>
                        <div class="biz-main-form">
                            <form ng-submit="updateBusiness()">
                                <input type="hidden" ng-model="edit_business_id" value="@{{ edit_business_id }}">
                                Business Name: <input type="text" ng-model="edit_name" /><br>
                                Address: <input type="text" ng-model="edit_address" /><br>
                                Industry: <input type="text" ng-model="edit_industry" /><br>
                                Timezone: <input type="text" ng-model="edit_timezone" /><br>
                                Time Open: <input type="text" ng-model="edit_time_open" /><br>
                                Time Close: <input type="text" ng-model="edit_time_close" /><br>
                                <br>
                                <div></div>
                                <button type="submit">Update Information</button>
                            </form>
                        </div>
                    </div>
                    <div class="biz-service">
                        <h4> > Services</h4>
                        <div class="biz-service-form">
                            <div ng-repeat="service in services" class="mt10">
                                <input id="service-input@{{ $index }}" type="text" value="@{{service.name}}"><br>
                                <button ng-click="updateService($index,service.service_id)">Edit Service</button>
                                <button ng-click="removeService(service.service_id)">Delete Service</button>
                                <div ng-repeat="terminal in service.terminals" style="padding-left: 100px;" class="mt10">
                                    <input type="text" value="@{{ terminal.name }}"><br>
                                    <button ng-click="">Edit Terminal</button>
                                    <button ng-click="">Delete Terminal</button>
                                    <button ng-click="" ng-show="terminals.length < max_terminals"> Add Terminal</button>
                                </div>
                            </div>
                            <div class="mt20" ng-show="terminals.length < max_services">
                                <input type="text" ng-model="name">
                                <button ng-click="createService(name, edit_business_id)">Add Service</button>
                            </div>
                        </div>
                    </div>
                    <div class="biz-status">
                        <h4> > Account Status</h4>
                        <div class="biz-status-form">
                            <form ng-submit="updateBusiness()">
                                Contract: <select ng-model="package_type" ng-init="package_type">
                                    <option value="Trial">Trial</option>
                                    <option value="Basic">Basic</option>
                                    <option value="Plus">Plus</option>
                                    <option value="Pro">Pro</option>
                                </select>
                                Business Owner: <input type="text" ng-model="business_owner" readonly="readonly" /><br>
                                Emaill Address: <input type="text" ng-model="business_email_address" readonly="readonly" /><br>
                                <br>
                                <button type="submit">Update Status</button>
                            </form>
                        </div>
                    </div>
                    <div class="biz-settings">
                        <h4> > Settings</h4>
                        <div class="biz-settings-form">
                            <form ng-submit="updateBusiness()">
                                Max Services: <input type="text" ng-model="max_services" /><br>
                                Max Terminals: <input type="text" ng-model="max_terminals" /><br>
                                <br>
                                Vanity URL: <input type="text" ng-model="vanity_url" /><br>
                                <br>
                                {{--Enable Video Ads? <label><input type="radio" name="video_ads" ng-model="enable_video_ads" value="1">Yes</label> <label><input type="radio" name="video_ads" ng-model="enable_video_ads" value="0">No</label><br>--}}
                                {{--<br>--}}
                                {{--Video Ad Limits:<br>--}}
                                {{--Upload limit: <input type="text" ng-model="upload_size_limit" /> MB<br>--}}
                                {{--<br>--}}
                                <button type="submit">Update Settings</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container user-container">
                <p>this is a test</p>
            </div>
        </div>
            {{--<select id="business-dropdown" class="form-control" ng-model="business_id" ng-change="getBusinessFeatures(business_id)">--}}
                {{--<option selected disabled value="">Select a Business</option>--}}
                {{--<option ng-repeat="business in all_businesses" value="@{{ business.business_id }}" ng-click="getBusinessFeatures(business.business_id)">@{{ business.name }}</option>--}}
            {{--</select>--}}
        {{--</div>--}}
        {{--<div class="col-md-12">--}}
            {{--<form id="features-form" ng-submit="saveBusinessFeatures(business_id)">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="form-group col-md-2">--}}
                        {{--Terminal Users :--}}
                    {{--</div>--}}
                    {{--<div class="form-group col-md-2">--}}
                        {{--<input class="form-control" type="text" ng-model="business_features.terminal_users" />--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="form-group col-md-2">--}}
                        {{--SMS :--}}
                    {{--</div>--}}
                    {{--<div class="form-group col-md-2">--}}
                        {{--<br/><input type="radio" ng-model="business_features.allow_sms" value="false"/> No--}}
                        {{--<br/><input type="radio" ng-model="business_features.allow_sms" value="true"/> Yes--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-12 mb20">--}}
                    {{--<div class="form-group col-md-2">--}}
                        {{--Queue Forwarding :--}}
                    {{--</div>--}}
                    {{--<div class="form-group col-md-2">--}}
                        {{--<br/><input type="radio" ng-model="business_features.queue_forwarding" value="false"/> No--}}
                        {{--<br/><input type="radio" ng-model="business_features.queue_forwarding" value="true"/> Yes--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-12">--}}
                    {{--<button class="btn btn-primary">Submit</button>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    </div>
</div>

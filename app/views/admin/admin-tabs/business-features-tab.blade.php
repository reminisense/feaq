
    <div class="clearfix">
        <div class="col-md-12">
            <div class="alert alert-danger mt10" ng-if="messages.error_message != '' && messages.error_message != undefined">@{{ messages.error_message }}</div>
            <div class="alert alert-success mt10" ng-if="messages.success_message != '' && messages.success_message != undefined">@{{ messages.success_message }}</div>
        </div>
        <div class="col-md-12 ">
            <div class="general-container">
                <ul id="admin-manage" class="nav nav-tabs">
                    <li class="active"><a class="" href="" id="business-settings">Manage Businesses</a></li>
                    <li><a class="" href="" id="user-settings">Manage Users</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-12 mb20">
            <div class="business-container clearfix">
                <div class="search-business col-md-12 clearfix ">
                    <form ng-submit="searchBusiness()">
                            <input class="form-control" type="text" ng-model="business_name" placeholder="Search for a business.."/>
                            <button class="btn btn-primary btn-lg" type="submit">Search</button>
                    </form>
                </div>
                <div class="biz-results clearfix">
                    <div class="col-md-12 mt10">
                        <table class="table table-striped table-results">
                            <tr ng-repeat="business in businesses">
                                <td width="80%"><h4 class="biz-name"><strong>@{{ business.business_name }}</strong></h4></td>
                                <td width="20%">
                                    <a href="#" class="btn btn-blue biz-manage" ng-click="manageBusiness(business.business_id)">
                                        <span class="glyphicon glyphicon-pencil"></span> Manage
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="biz-specific mt20">
                    <div class="biz-main">
                        <div class="col-md-12 mt20">
                            <a class="btn btn-gray btn-lg" href=""><span class="glyphicon glyphicon-chevron-right"></span> Details</a>
                        </div>
                        <div class="col-md-12">
                            <div class="biz-main-form clearfix">
                                <form ng-submit="updateBusiness()">
                                    <input class="form-control" type="hidden" ng-model="edit_business_id" value="@{{ edit_business_id }}">
                                    <table class="table table-form">
                                        <tr>
                                            <td>
                                                <label>Business Name:</label>
                                                <input class="form-control" type="text" ng-model="edit_name" />
                                            </td>
                                            <td>
                                                <label>Address:</label>
                                                <input class="form-control" type="text" ng-model="edit_address" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Industry:</label>
                                                <input class="form-control" type="text" ng-model="edit_name" />
                                            </td>
                                            <td>
                                                <label>Industry:</label>
                                                <input class="form-control" type="text" ng-model="edit_industry" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Timezone:</label>
                                                <input class="form-control" type="text" ng-model="edit_timezone" /><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Time Open:</label>
                                                <input class="form-control" type="text" ng-model="edit_time_open" />
                                            </td>
                                            <td>
                                                <label>Time Close:</label>
                                                <input class="form-control" type="text" ng-model="edit_time_close" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-right">
                                                <button class="btn btn-orange btn-lg" type="submit">Update Information</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="biz-service">
                        <div class="col-md-12">
                            <a class="btn btn-gray btn-lg" href=""><span class="glyphicon glyphicon-chevron-right"></span> Services</a>
                        </div>
                        <div class="col-md-12">
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
                    </div>
                    <div class="biz-status">
                        <div class="col-md-12">
                            <a class="btn btn-gray btn-lg" href=""><span class="glyphicon glyphicon-chevron-right"></span> Account Status</a>
                        </div>
                        <div class="col-md-12">
                            <div class="biz-status-form mt20">
                                <form ng-submit="updateBusiness()">
                                    <table class="table table-form">
                                        <tr>
                                            <td>
                                                <label>Contract:</label>
                                                <select class="form-control" ng-model="package_type" ng-init="package_type">
                                                                                    <option value="Trial">Trial</option>
                                                                                    <option value="Basic">Basic</option>
                                                                                    <option value="Plus">Plus</option>
                                                                                    <option value="Pro">Pro</option>
                                                                                </select>
                                            </td>
                                            <td>
                                                <label>Business Owner:</label>
                                                <input class="form-control" type="text" ng-model="business_owner" readonly="readonly" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Emaill Address:</label>
                                                <input class="form-control" type="text" ng-model="business_email_address" readonly="readonly" />
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-right">
                                                <button class="btn btn-lg btn-orange" type="submit">Update Status</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                         </div>
                    </div>
                    <div class="biz-settings">
                        <div class="col-md-12">
                            <a class="btn btn-gray btn-lg" href=""><span class="glyphicon glyphicon-chevron-right"></span> Settings</a>
                        </div>
                        <div class="col-md-12">
                            <div class="biz-settings-form mt20">
                                <form ng-submit="updateBusiness()">
                                    <table class="table table-form">
                                        <tr>
                                            <td>
                                                <label>Max Services: </label>
                                                <input class="form-control" type="text" ng-model="max_services" /><br>
                                            </td>
                                            <td>
                                                <label>Max Terminals:</label>
                                                <input class="form-control" type="text" ng-model="max_terminals" /><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Vanity URL:</label>
                                                <input class="form-control" type="text" ng-model="vanity_url" /><br>
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-right">
                                                <button class="btn btn-lg btn-orange" type="submit">Update Settings</button>
                                            </td>
                                        </tr>



                                    {{--Enable Video Ads? <label><input type="radio" name="video_ads" ng-model="enable_video_ads" value="1">Yes</label> <label><input type="radio" name="video_ads" ng-model="enable_video_ads" value="0">No</label><br>--}}
                                    {{--<br>--}}
                                    {{--Video Ad Limits:<br>--}}
                                    {{--Upload limit: <input type="text" ng-model="upload_size_limit" /> MB<br>--}}
                                    {{--<br>--}}

                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    
                    
                
            </div>
            <div class=" user-container clearfix">
                <div class="search-user clearfix">
                    <form>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="user-email" placeholder="Search for a user using the email address.."/>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-lg search-user-button" type="submit" ng-click="searchUser()">Search</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-cyan btn-lg create-user-button" type="submit" id="create-user"><span class="glyphicon glyphicon-plus"></span> Create</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12 cus-main-form clearfix">
                    <h2>Manage User</h2>
                    <form ng-submit="updateUser(user_id)">
                        <table class="table table-form">
                            <tr>
                                <td>
                                    <label>First Name:</label>
                                    <input class="form-control" type="text" ng-model="edit_first_name" />
                                </td>
                                <td>
                                    <label>Last Name:</label>
                                    <input class="form-control" type="text" ng-model="edit_last_name" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Address:</label>
                                    <input class="form-control" type="text" ng-model="edit_user_location" />
                                </td>
                                <td>
                                    <label>Email:</label>
                                    <input class="form-control" type="text" ng-model="edit_email" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Phone:</label>
                                    <input class="form-control" type="text" ng-model="edit_mobile" />
                                </td>
                                <td>
                                    <label>Password:</label><br>
                                    <button class="btn btn-primary btn-lg" type="button" ng-click="resetPass(user_id)">Reset Password</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Status:</label>
                                    <div class="status">
                                    <input type="radio" name="edit_status" ng-model="edit_status" value="1"> <h5>Enabled</h5>
                                    <input type="radio" name="edit_status" ng-model="edit_status" value="0"> <h5>Disabled</h5>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right">
                                    <button class="btn btn-orange btn-lg" type="submit">Save</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class=" col-md- 12 cus-create-form">
                    <h2 class="col-md-12">Create User</h2>
                    <form ng-submit="createUser()">
                        <table class="table table-form">
                            <tr>
                                <td>
                                    <label>Email: </label>
                                    <input class="form-control" type="text" ng-model="create_email" />
                                </td>
                                <td>

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Password: </label>
                                    <input class="form-control" type="password" ng-model="new_password" />
                                </td>
                                <td>
                                    <label>Confirm Password:</label>
                                    <input class="form-control" type="password" ng-model="password_confirm" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>First Name:</label>
                                    <input class="form-control" type="text" ng-model="create_first_name" />
                                </td>
                                <td>
                                    <label>Last Name:</label>
                                    <input class="form-control" type="text" ng-model="create_last_name" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Gender:</label>
                                    <select class="form-control" ng-model="create_gender" ng-init="create_gender='male'">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </td>
                                <td>
                                    <label>Address: </label>
                                    <input class="form-control" type="text" ng-model="create_user_location" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Phone:</label>
                                    <input class="form-control" type="text" ng-model="create_mobile" />
                                </td>
                                <td class="text-right">
                                    <button class="mt20 btn btn-orange btn-lg" type="submit">Save</button>
                                </td>
                            </tr>

                        </table>
                    </form>
                </div>
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



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
                    <li><a class="" href="" id="business-list-settings">Manage Business List</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-12 mb20">
            <div class="business-container clearfix">
                <div class="search-business col-md-12 clearfix ">
                    <form>
                        <div class="col-lg-8 col-md-6 col-xs-12 col-sm-12">
                            <input class="form-control" type="text" ng-model="business_name" placeholder="Search for a business.."/>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4 col-sm-4">
                            <button class="btn btn-primary btn-lg search-business-button" type="submit" ng-click="searchBusiness()">Search</button>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4 col-sm-4 text-center">
                            <button class="btn btn-cyan btn-lg create-business-button" type="submit" id="create-business"><span class="glyphicon glyphicon-plus"></span> Create</button>
                        </div>
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
                            <div class="alert alert-danger" id="business-search-error" style="display: none">
                                <p style="text-align: center;">No businesses found.</p>
                            </div>
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
                                                <input type="text" class="form-control" ng-model="edit_address" ng-autocomplete options="options" details="details">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Industry:</label>
                                                <select class="form-control" ng-model="edit_industry">
                                                    <option value="@{{ edit_industry }}">@{{ edit_industry }}</option>
                                                    <option value="Accounting">Accounting</option>
                                                    <option value="Advertising">Advertising</option>
                                                    <option value="Agriculture">Agriculture</option>
                                                    <option value="Air Services">Air Services</option>
                                                    <option value="Airlines">Airlines</option>
                                                    <option value="Apparel">Apparel</option>
                                                    <option value="Appliances">Appliances</option>
                                                    <option value="Auto Dealership">Auto Dealership</option>
                                                    <option value="Banking">Banking</option>
                                                    <option value="Broadcasting">Broadcasting</option>
                                                    <option value="Business Services">Business Services</option>
                                                    <option value="Communications">Communications</option>
                                                    <option value="Corporate">Corporate</option>
                                                    <option value="Customer Service">Customer Service</option>
                                                    <option value="Delivery">Delivery</option>
                                                    <option value="Delivery Services">Delivery Services</option>
                                                    <option value="Education">Education</option>
                                                    <option value="Energy">Energy</option>
                                                    <option value="Entertainment">Entertainment</option>
                                                    <option value="Events">Events</option>
                                                    <option value="Food and Beverage">Food and Beverage</option>
                                                    <option value="Government">Government</option>
                                                    <option value="Grocery">Grocery</option>
                                                    <option value="Healthcare">Healthcare</option>
                                                    <option value="Hobbies and Collections">Hobbies and Collections</option>
                                                    <option value="Hospitality">Hospitality</option>
                                                    <option value="Insurance">Insurance</option>
                                                    <option value="Information Technology">Information Technology</option>
                                                    <option value="Lifestyle">Lifestyle</option>
                                                    <option value="Mail Order Services">Mail Order Services</option>
                                                    <option value="Manufacturing">Manufacturing</option>
                                                    <option value="Pharmaceutical">Pharmaceutical</option>
                                                    <option value="Media">Media</option>
                                                    <option value="Professional Services">Professional Services</option>
                                                    <option value="Publishing">Publishing</option>
                                                    <option value="Real Estate">Real Estate</option>
                                                    <option value="Recreation">Recreation</option>
                                                    <option value="Rentals">Rentals</option>
                                                    <option value="Retail">Retail</option>
                                                    <option value="Software Development">Software Development</option>
                                                    <option value="Technology">Technology</option>
                                                    <option value="Travel and Tours">Travel and Tours</option>
                                                    <option value="Utility Services">Utility Services</option>
                                                    <option value="Web Services">Web Services</option>
                                                    <option value="Wholesale">Wholesale</option>
                                                </select>
                                            </td>
                                            <td>
                                                <label>Time Open:</label>
                                                <input class="form-control" type="text" ng-model="edit_time_open" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">
                                                <label>Timezone:</label>
                                                <select class="form-control" ng-model="edit_timezone"> <!-- ARA Added timezone picker -->
                                                    @foreach(Helper::getTimezoneList() as $index => $timezone)
                                                        <option value="{{ $index }}">{{ $timezone }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td width="50%">
                                                <label>Time Close:</label>
                                                <input class="form-control" type="text" ng-model="edit_time_close" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-right">
                                                <button class="btn btn-orange btn-lg" id="biz-details-btn" type="submit">Update Information</button>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="alert alert-success" id="biz-details-success" style="display: none">
                                        <p style="text-align: center;">Business information updated.</p>
                                    </div>
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
                                <table class="table table-form table-spaces table-hover table-responsive table-inputnotblock">
                                    <tr  ng-repeat="service in services">
                                        <th>
                                            <input style="width: 100%" class="form-control" id="service-input@{{ $index }}" type="text" value="@{{service.name}}">
                                            <div class="alert alert-danger mt10" id="edt-service-err@{{ $index }}" style="display: none">
                                                <p style="text-align: center;"></p>
                                            </div>
                                            <div class="alert alert-success mt10" id="edt-service-suc@{{ $index }}" style="display: none">
                                                <p style="text-align: center;">Service name updated.</p>
                                            </div>
                                            <div ng-repeat="terminal in service.terminals" style="padding-left: 100px; padding-right:150px;" class="mt10">
                                                <input class="form-control edit-terminal" terminal_id="@{{ terminal.terminal_id }}" type="text" value="@{{ terminal.name }}">
                                                <button class="btn-boxy btn-cyan" id="terminal-edit-button"  ng-click="updateTerminal(terminal.terminal_id, edit_business_id)"> <span class="glyphicon glyphicon-save-file"></span> Save</button>
                                                <button class="btn-boxy btn-danger" ng-click="deleteTerminal(terminal.terminal_id, edit_business_id)"> <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                                <div class="alert alert-danger mt10" id="edt-terminal-err@{{ terminal.terminal_id }}" style="display: none">
                                                    <p style="text-align: center;"></p>
                                                </div>
                                                <div class="alert alert-success mt10" id="edt-terminal-suc@{{ terminal.terminal_id }}" style="display: none">
                                                    <p style="text-align: center;">Terminal name updated.</p>
                                                </div>
                                            </div>
                                            <div style="padding-left: 100px; padding-right:150px;" class="mt10" ng-show="service.terminals.length < max_terminals">
                                                <input class="form-control" type="text" ng-model="terminal_name">
                                                <button class="btn btn-orange" ng-click="createTerminal(terminal_name, service.service_id, edit_business_id)"> New Terminal</button>
                                                <div class="alert alert-danger mt10" id="add-terminal-err@{{ service.service_id }}" style="display: none">
                                                    <p style="text-align: center;"></p>
                                                </div>
                                            </div>

                                        </th>
                                        <th>
                                            <button class="btn-boxy btn-cyan" ng-click="updateService($index,service.service_id,edit_business_id)"><span class="glyphicon glyphicon-save-file"></span> Save</button>
                                            <button class="btn-boxy btn-danger" ng-click="removeService(service.service_id, edit_business_id)"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr ng-show="services.length < max_services" style="background-color: #eee;">
                                        <td class="pb10">
                                            <input style="width: 100%" class="form-control" type="text" ng-model="name" id="create-service-inpt">
                                            <div class="alert alert-danger mt10" id="add-service-err" style="display: none">
                                                <p style="text-align: center;"></p>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <button class="btn btn-orange btn-lg" ng-click="createService(name, edit_business_id)">Add Service</button>
                                        </td>
                                    </tr>
                                </table>
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
                                                <button class="btn btn-lg btn-orange" id="biz-status-btn" type="submit">Update Status</button>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="alert alert-success" id="biz-status-success" style="display: none">
                                        <p style="text-align: center;">Business status updated.</p>
                                    </div>
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
                                                <input class="form-control" type="number" ng-model="max_services" /><br>
                                            </td>
                                            <td>
                                                <label>Max Terminals:</label>
                                                <input class="form-control" type="number" ng-model="max_terminals"/><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Vanity URL:</label>
                                                <input class="form-control" type="text" ng-model="vanity_url" /><br>
                                            </td>
                                            <td>
                                                <label>SMS Feature:</label><br>
                                                <input class="text-center" type="radio" ng-model="allow_sms" value="false"/> No<br>
                                                <input class="text-center" type="radio" ng-model="allow_sms" value="true"/> Yes
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Queue Forwarding:</label><br>
                                                <input type="radio" ng-model="queue_forwarding" value="false"/> No <br>
                                                <input type="radio" ng-model="queue_forwarding" value="true"/> Yes
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-right">
                                                <button class="btn btn-lg btn-orange" id="biz-settings-btn" type="submit">Update Settings</button>
                                            </td>
                                        </tr>



                                    {{--Enable Video Ads? <label><input type="radio" name="video_ads" ng-model="enable_video_ads" value="1">Yes</label> <label><input type="radio" name="video_ads" ng-model="enable_video_ads" value="0">No</label><br>--}}
                                    {{--<br>--}}
                                    {{--Video Ad Limits:<br>--}}
                                    {{--Upload limit: <input type="text" ng-model="upload_size_limit" /> MB<br>--}}
                                    {{--<br>--}}

                                    </table>
                                    <div class="alert alert-success" id="biz-settings-success" style="display: none">
                                        <p style="text-align: center;">Business settings updated.</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="biz-create">
                        <form ng-submit="createBusiness()">
                            <input type="hidden" ng-model="suggested">
                            <table class="table table-responsive table-form">
                                <tr>
                                    <td>
                                        <label>Business Owner (email):</label>
                                        <input type="text" ng-model="email" required="true" id="biz-email" class="form-control create-fields"/>
                                    </td>
                                    <td style="position: relative">
                                        <label>Business Name:</label>
                                        {{--<input type="text" ng-model="new_business_name" required="true" class="form-control create-fields"/>--}}
                                        <input class="form-control create-fields" type="text" placeholder="e.g. Bills Payment SM Megamall" id="search-keyword" ng-click="showDropdown()" ng-model="new_business_name" ng-model-options="{debounce: 1000}" autocomplete="off">
                                        <ul class="dropdown-menu" role="menu" id="search-suggest" outside-click="dropdown_businesses = []">
                                            <li ng-repeat="business in dropdown_businesses">
                                                <a href="#" ng-click="fillBusinessFields(business.business_list_id)">
                                                    <strong class="business-name">@{{ business.name }}</strong><br>
                                                    <small class="address">@{{ business.local_address }}</small>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label id="biz-address-lbl">Address:</label>
                                        <input type="text" class="form-control create-fields" ng-model="address" ng-autocomplete options="options" details="details" required="true">
                                    </td>
                                    <td>
                                        <label id="biz-industry-lbl">Industry:</label>
                                        <select class="form-control create-fields"  ng-model="industry" required="true">
                                            <option value="" >Please select an industry</option>
                                            <option value="Accounting">Accounting</option>
                                            <option value="Advertising">Advertising</option>
                                            <option value="Agriculture">Agriculture</option>
                                            <option value="Air Services">Air Services</option>
                                            <option value="Airlines">Airlines</option>
                                            <option value="Apparel">Apparel</option>
                                            <option value="Appliances">Appliances</option>
                                            <option value="Auto Dealership">Auto Dealership</option>
                                            <option value="Banking">Banking</option>
                                            <option value="Broadcasting">Broadcasting</option>
                                            <option value="Business Services">Business Services</option>
                                            <option value="Communications">Communications</option>
                                            <option value="Corporate">Corporate</option>
                                            <option value="Customer Service">Customer Service</option>
                                            <option value="Delivery">Delivery</option>
                                            <option value="Delivery Services">Delivery Services</option>
                                            <option value="Education">Education</option>
                                            <option value="Energy">Energy</option>
                                            <option value="Entertainment">Entertainment</option>
                                            <option value="Events">Events</option>
                                            <option value="Food and Beverage">Food and Beverage</option>
                                            <option value="Government">Government</option>
                                            <option value="Grocery">Grocery</option>
                                            <option value="Healthcare">Healthcare</option>
                                            <option value="Hobbies and Collections">Hobbies and Collections</option>
                                            <option value="Hospitality">Hospitality</option>
                                            <option value="Insurance">Insurance</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Lifestyle">Lifestyle</option>
                                            <option value="Mail Order Services">Mail Order Services</option>
                                            <option value="Manufacturing">Manufacturing</option>
                                            <option value="Pharmaceutical">Pharmaceutical</option>
                                            <option value="Media">Media</option>
                                            <option value="Professional Services">Professional Services</option>
                                            <option value="Publishing">Publishing</option>
                                            <option value="Real Estate">Real Estate</option>
                                            <option value="Recreation">Recreation</option>
                                            <option value="Rentals">Rentals</option>
                                            <option value="Retail">Retail</option>
                                            <option value="Software Development">Software Development</option>
                                            <option value="Technology">Technology</option>
                                            <option value="Travel and Tours">Travel and Tours</option>
                                            <option value="Utility Services">Utility Services</option>
                                            <option value="Web Services">Web Services</option>
                                            <option value="Wholesale">Wholesale</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <label>Timezone:</label>
                                        <select class="form-control create-fields" ng-model="timezone" required="true"> <!-- ARA Added timezone picker -->
                                            <option value="">Please select a timezone</option>
                                            @foreach(Helper::getTimezoneList() as $index => $timezone)
                                                <option value="{{ $index }}">{{ $timezone }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td width="50%">
                                        <label>Time Open: </label>
                                        <input type="text" ng-model="time_open" required="true" class="form-control create-fields" placeholder="ex: 10:00 AM"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Time Close:</label>
                                        <input type="text" ng-model="time_close" required="true" class="form-control create-fields" placeholder="ex :05:00 PM"/>
                                    </td>
                                    <td class="text-right">
                                        <br>
                                        <button class="btn btn-orange btn-lg" type="submit" id="biz-create-btn">Create Business</button>
                                    </td>
                                </tr>
                            </table>
                            <div class="alert alert-success" id="biz-create-success" style="display: none">
                                <p style="text-align: center;">Business created.</p>
                            </div>
                            <div class="alert alert-danger" id="biz-create-error" style="display: none">
                                <p style="text-align: center;"></p>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class=" user-container clearfix">
                <div class="search-user col-md-12 clearfix">
                    <form>
                        <div class="col-lg-8 col-md-6 col-xs-12 col-sm-12">
                            <input class="form-control" type="text" id="user-email" placeholder="Search for a user using the email address.."/>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4 col-sm-4">
                            <button class="btn btn-primary btn-lg search-user-button" type="submit" ng-click="searchUser()">Search</button>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4 col-sm-4">
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
                                    <input type="text" class="form-control" ng-model="edit_user_location" ng-autocomplete options="options" details="details" required="true">
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
                        <div class="alert alert-success" id="user-update-success" style="display: none">
                            <p style="text-align: center;">User information updated.</p>
                        </div>
                    </form>
                </div>
                <div class="alert alert-danger" id="user-email-error" style="display: none">
                    <p style="text-align: center;">Please enter a valid email.</p>
                </div>
                <div class="alert alert-danger" id="user-search-error" style="display: none">
                    <p style="text-align: center;">No users found.</p>
                </div>
                <div class=" col-md-12 cus-create-form">
                    <form ng-submit="createUser()" style="margin-left: 15%; margin-right: 15%">
                        <table class="table table-form">
                            <tr>
                                    <label>Email: </label>
                                    <input class="form-control" type="text" ng-model="create_email" />
                            </tr>

                            <tr>
                                    <label>Password: </label>
                                    <input class="form-control" type="password" ng-model="new_password" />
                            </tr>
                            <tr>
                                    <label>Confirm Password:</label>
                                    <input class="form-control" type="password" ng-model="password_confirm" />
                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td class="text-right">
                                    <button class="mt20 btn btn-orange btn-lg" type="submit">Create User</button>
                                </td>
                            </tr>
                        </table>
                        <div class="alert alert-danger" id="user-create-error" style="display: none">
                            <p style="text-align: center;">@{{create_err}}</p>
                        </div>
                        <div class="alert alert-success" id="user-create-success" style="display: none">
                            <p style="text-align: center;">User created.</p>
                        </div>
                        <div class="alert alert-danger" id="user-password-error" style="display: none">
                            <p style="text-align: center;">Passwords do not match.</p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="business-list-container clearfix">
                <div class="search-business-list col-md-12 clearfix">
                    <form>
                        <div class="col-lg-8 col-md-6 col-xs-12 col-sm-12">
                            <input class="form-control" type="text" id="business-list-name" ng-model="business_list_name" placeholder="Search for a business in the business list.."/>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4 col-sm-4">
                            <button class="btn btn-primary btn-lg search-user-button" type="submit" ng-click="searchBusinessList()">Search</button>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4 col-sm-4">
                            <button class="btn btn-cyan btn-lg create-user-button" type="submit" id="create-business-list"><span class="glyphicon glyphicon-plus"></span> Create</button>
                        </div>
                    </form>
                </div>
                <div class="biz-list-results clearfix">
                    <div class="col-md-12 mt10">
                        <table class="table table-striped table-results">
                            <tr ng-repeat="business in businesses_list">
                                <td width="80%"><h4 class="biz-name"><strong>@{{ business.business_name }}</strong></h4></td>
                                <td width="20%">
                                    <a href="#" class="btn btn-blue biz-manage" ng-click="manageBusinessList(business.business_list_id)">
                                        <span class="glyphicon glyphicon-pencil"></span> Manage
                                    </a>
                                </td>
                            </tr>
                            <div class="alert alert-danger" id="business-list-search-error" style="display: none">
                                <p style="text-align: center;">No businesses found.</p>
                            </div>
                        </table>
                    </div>
                </div>
                <div class="biz-list-specific mt20">
                    <div class="biz-main">
                        <div class="col-md-12">
                            <div class=" clearfix">
                                <h2>Manage User</h2>
                                <form ng-submit="updateBusinessList()">
                                    <input class="form-control" type="hidden" ng-model="edit_business_id" value="@{{ edit_business_list_id }}">
                                    <table class="table table-form">
                                        <tr>
                                            <td>
                                                <label>Business Name:</label>
                                                <input class="form-control" type="text" id="edit_business_list_name" ng-model="edit_business_list_name" />
                                            </td>
                                            <td>
                                                <label>Address:</label>
                                                <input type="text" class="form-control" id="edit_business_list_address"  ng-model="edit_business_list_address" ng-autocomplete options="options" details="details">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Email:</label>
                                                <input type="text" class="form-control" id="edit_business_list_email" ng-model="edit_business_list_email">
                                            </td>
                                            <td>
                                                <label>Phone:</label>
                                                <input class="form-control" type="text" id="edit_business_list_phone" ng-model="edit_business_list_phone" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Time Open:</label>
                                                <input type="text" class="form-control" id="edit_business_list_open" ng-model="edit_business_list_open">
                                            </td>
                                            <td>
                                                <label>Time Close:</label>
                                                <input class="form-control" type="text" id="edit_business_list_close" ng-model="edit_business_list_close" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>

                                            </td>
                                            <td colspan="2" class="text-right">
                                                <button type="button" id="biz-list-delete-btn" class="btn btn-primary btn-lg" ng-click="deleteBusinessList()"><span class="glyphicon glyphicon-trash"></span> Delete Business</button>
                                                <button type="button" id="biz-list-restore-btn" class="btn btn-primary btn-lg" ng-click="restoreBusinessList()"><span class="glyphicon glyphicon-trash"></span> Re-Add Business</button>
                                                <button class="btn btn-orange btn-lg" id="biz-list-update-btn" type="submit">Update Information</button>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="alert alert-success" id="biz-list-details-success" style="display: none">
                                        <p style="text-align: center;">Business information updated.</p>
                                    </div>
                                    <div class="alert alert-success" id="biz-list-deleted-success" style="display: none">
                                        <p style="text-align: center;">Business deleted.</p>
                                    </div>
                                    <div class="alert alert-success" id="biz-list-restore-success" style="display: none">
                                        <p style="text-align: center;">Business restored.</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="biz-list-create clearfix">
                    <form ng-submit="createBusinessList()">
                        <table class="table table-form">
                            <tr>
                                <td>
                                    <label>Business Name:</label>
                                    <input class="biz-list-create form-control" type="text" ng-model="new_business_list_name" />
                                </td>
                                <td>
                                    <label>Address:</label>
                                    <input type="text" class="biz-list-create form-control" ng-model="new_business_list_address" ng-autocomplete options="options" details="details">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email:</label>
                                    <input type="text" class="biz-list-create form-control" ng-model="new_business_list_email">
                                </td>
                                <td>
                                    <label>Phone:</label>
                                    <input class="biz-list-create form-control" type="text" ng-model="new_business_list_phone" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Time Open:</label>
                                    <input type="text" class="biz-list-create form-control" placeholder="ex. 10:00 AM" ng-model="new_business_list_open">
                                </td>
                                <td>
                                    <label>Time Close:</label>
                                    <input class="biz-list-create form-control" type="text" placeholder="ex. 10:00 PM" ng-model="new_business_list_close" />
                                </td>
                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td colspan="2" class="text-right">
                                    <button class="btn btn-orange btn-lg" id="biz-list-create-btn" type="submit">Create</button>
                                </td>
                            </tr>
                        </table>
                        <div class="alert alert-success" id="biz-create-list-success" style="display: none">
                            <p style="text-align: center;">Business created.</p>
                        </div>
                    </form>
                    <hr>
                    <p><strong>Import file </strong> <small>(xls, xlsx, csv)</small></p>
                    <br>
                    <div class="clearfix mb30">
                        <form enctype="multipart/form-data" action="{{url('/admin/spreadsheet-business-list')}}" method="post" target="temporaryFrame">
                            <div class="col-md-9 col-xs-12 col-sm-9">
                                <span class="bg-gray">
                                    <input type="file" name="business_list" id="business_list" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                                </span>
                            </div>
                            <div class="col-md-3 col-xs-12 col-sm-3 text-right">
                                <input class="btn btn-lg btn-orange" type="submit" id="biz-list-upload-btn" value="Upload" />
                            </div>


                            </table>
                            <div class="alert alert-success" id="biz-list-upload-success" style="display: none">
                                <p style="text-align: center;">Business added.</p>
                            </div>
                        </form>
                    </div>
                    {{--<input type="hidden" role="uploadcare-uploader" data-crop="disabled" id="business-attachment" />--}}
                    {{--<em class="help-block">Upload is limited to documents and images up to 5MB.</em>--}}
                    {{--<button onclick="alert($('#business-attachment').val())"></button>--}}
                    <iframe name="temporaryFrame" style="display:none">
                    </iframe>
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


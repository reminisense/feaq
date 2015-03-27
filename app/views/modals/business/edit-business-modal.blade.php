<input type="hidden" id="queue-settings-get-url" value="{{ url('/queuesettings/allvalues/') }}">
<input type="hidden" id="queue-settings-update-url" value="{{ url('/queuesettings/update/') }}">
<input type="hidden" id="business-details-url" value="{{ url('/business/businessdetails/') }}">
<!-- modal -->
<div class="modal fade" id="editBusiness" tabindex="-1" ng-controller="editBusinessController">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Edit Business</h3> {{--CSD Goob job finding this!--}}
            </div>
            <div class="modal-body" id="edit_business_body">
                <form class="">
                    <div class="form-group row">

                        <ul class="nav nav-tabs nav-justified" id="editbiz-tabs">
                            <li class="active"><a href="#bizdetails" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span> Details</a></li>
                            <li> <a href="#bizterminals" data-toggle="tab"><span class="glyphicon glyphicon-th"></span> Terminals</a></li>
                            <li> <a href="#bizbroadcast" data-toggle="tab" ng-click="currentActiveTheme(business_id)"><span class="glyphicon glyphicon-blackboard"></span> Broadcast</a></li>
                            <li> <a href="#bizqueuesettings" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                            <li> <a href="#bizanalytics" data-toggle="tab"><span class="glyphicon glyphicon-stats"></span> Analytics</a></li>
                        </ul>
                        <div class="col-md-12">
                            <div class="alert" id="edit_message" style="display: none;">
                                <p style="text-align: center;"></p>
                            </div>
                        </div>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="bizdetails">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>BUSINESS DETAILS
                                        </h5>
                                        <small>Business Name</small>
                                        <input type="text" class=" form-control" value="@{{ business_name }}" ng-model="business_name">
                                    </div>
                                    <div class="col-md-12">
                                        <small>Business Address</small>
                                        <input type="text" class="form-control" value="@{{ business_address }}" ng-model="business_address" ng-autocomplete options="options" details="details">
                                    </div>
                                    <div class="col-md-12">
                                        <small>Facebook URL</small>
                                        <input type="text" class=" form-control" value="@{{ facebook_url }}" placeholder="Add Your Facebook Page!" ng-model="facebook_url">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <small>Time Open</small>
                                                <input type="text" class="form-control" value="@{{ time_open }}" ng-model="time_open"> <!-- RDH  Added timepicker -->
                                            </div>
                                            <div class="col-md-6">
                                                <small>Time Close</small>
                                                <input type="text" class="form-control" value="@{{ time_closed }}" ng-model="time_closed"> <!-- RDH  Added timepicker -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <small>Industry</small>
                                            <div class="btn-group">
                                                <select class="form-control" name="industry" id="industry">
                                                    <option value="@{{ industry }}">@{{ industry }}</option>
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
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <small><span class="glyphicon glyphicon-qrcode"></span> QR Code</small>
                                            <div class="row" style="margin-top: 12px;">
                                                <a id="qr_code_download" href="{{ url('business/pdf-download') }}/@{{ business_id }}" target="_blank" ng-model="business_id" class="btn-boxy btn-xs btn-primary"><span class="glyphicon glyphicon-qrcode"></span> View QR Code </a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-md-12">
                                        <small>Description</small>
                                        <textarea rows="10" class="form-control" placeholder="Add A Description Of Your Business Here! Try and talk about what your business does, how it started, and how valuable it is to your customers' lives! When we talk about our business, we can definitely say a whole lot about it! So don't hesitate to write it down here."></textarea>
                                    </div>
                                    -->
                                </div>
                            </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="bizterminals" aria-labelledby="profile-tab">
                            <div class="col-md-12">
                                <!-- accordion -->
                                <div class="panel-group" id="accordion">
                                    <div class="">
                                        <div id="headingOne">
                                            <h4 class="mb20">
                                                <a class="h5" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    TERMINALS
                                                </a>
                                                <span class="caret"></span>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <form></form> <!-- ARA I just placed this because if not placed other form elements below will not be rendered -->
                                            <table class="table table-hover table-spaces table-responsive" ng-init="terminal_index = 0">
                                                <thead>
                                                  <tr>
                                                    <th>#</th>
                                                    <th>Terminal Name</th>
                                                    <th>Users</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                <tr ng-repeat="terminal in terminals">
                                                    <td>
                                                        <div class="bold">@{{ $index + 1 }}</div>
                                                    </td>
                                                    <td>
                                                        <span class="terminal-name-display" terminal_id="@{{ terminal.terminal_id }}" style="font-size: 14px; ">@{{ terminal.name }}</span>
                                                        <input type="text" class="terminal-name-update terminal-update-field" terminal_id="@{{ terminal.terminal_id }}" value="@{{ terminal.name }}" style="display: none;">
                                                        <div class="mt10 mb10">
                                                            <span class="inline-btns">
                                                                <a href="#" ng-click="editTerminal(terminal.terminal_id)" class="edit-terminal-button btn-boxy btn-xs btn-primary" terminal_id="@{{ terminal.terminal_id }}" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                                                <a href="#" ng-click="updateTerminal(terminal.terminal_id)" class="update-terminal-button btn-boxy btn-xs btn-primary" terminal_id="@{{ terminal.terminal_id }}" style="display: none;"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
                                                                <a href="#" ng-click="deleteTerminal(terminal.terminal_id)" class="btn-boxy btn-xs btn-primary"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                                            </span>
                                                        </div>
                                                        <div style="display: none;" class="alert alert-danger terminal-error-message" terminal_id="@{{ terminal.terminal_id }}"> Terminal name already exists.</div>
                                                    </td>
                                                    <td>
                                                        <span ng-if="terminal.users.length != 0">
                                                            <span ng-repeat="user in terminal.users">
                                                                <span class="terminal_user">@{{ user.first_name + ' ' + user.last_name }}</span>
                                                                <div class="block terminal-buttons">
                                                                    <a href="#" class="btn-boxy btn-primary" ng-click="unassignFromTerminal(user.user_id, user.terminal_id)"><span class="glyphicon glyphicon-remove"></span> Remove</a>
                                                                    <span class="inline-btns" ng-if="terminal.users.length < 3">
                                                                        <span ng-if="user.user_id == terminal.users[terminal.users.length - 1].user_id">
                                                                            <a href="#" class="btn-boxy btn-adduser btn-primary"><span class="glyphicon glyphicon-plus"></span> Add User</a>
                                                                            <div class="mb10 mt10 inputuser" style="display: none">
                                                                                <form ng-submit="emailSearch(search_user, terminal.terminal_id)">
                                                                                    <input type="text" class="form-control" ng-model="search_user">
                                                                                </form>
                                                                                <div class="alert alert-danger" ng-show="user_found == false"> User does not exist. </div>
                                                                            </div>
                                                                        </span>
                                                                    </span>
                                                                    <span class="inline-btns" ng-if="terminal.users.length == 3">
                                                                        <span ng-if="user.user_id == terminal.users[terminal.users.length - 1].user_id">
                                                                            <a class="btn-boxy btn-xs btn-disabled"><span class="glyphicon glyphicon-plus"></span> Add User</a>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </span>
                                                        </span>
                                                        <span ng-if="terminal.users.length == 0">
                                                            <div class="mt30">
                                                                <span ng-if="user.user_id == terminal.users[terminal.users.length - 1].user_id">
                                                                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary"><span class="glyphicon glyphicon-plus"></span> Add User</a>
                                                                    <div class="mb10 mt10 inputuser" style="display: none">
                                                                        <form ng-submit="emailSearch(search_user, terminal.terminal_id)">
                                                                            <input type="text" class="form-control" ng-model="search_user">
                                                                        </form>
                                                                        <div class="alert alert-danger" ng-show="user_found == false"> User does not exist. </div>
                                                                    </div>
                                                                </span>
                                                             </div>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <!-- -->
                                                <tr ng-if="terminals.length < 3">
                                                    <td>
                                                        <div></div>
                                                    </td>
                                                    <td>
                                                        <div class="block mb10">
                                                            <a href="#" id="btn-addterminal" class="btn-boxy btn-xs btn-adduser btn-primary"><span class="glyphicon glyphicon-add"></span> Add Terminal</a>
                                                            <form id="inputterminal-form" ng-submit="createTerminal(terminal_name)">
                                                                <input id="inputterminal" type="text" class="form-control" ng-model="terminal_name">
                                                            </form>
                                                            <div style="display: none;" class="alert alert-danger terminal-error-msg"> Terminal name already exists.</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="block mb10">
                                                            <!-- button here -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="alert alert-danger" ng-show="terminal_delete_error"> @{{ terminal_delete_error }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="bizqueuesettings" aria-labelledby="profile-tab">
                                <div class="col-md-12">
                                    <div>
                                        <div id="headingTwo">
                                            <h4 class="mb20">
                                                <a class="h5 collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    QUEUE SETTINGS
                                                </a>
                                                <span class="caret"></span>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse in">
                                            <table class="table">
                                                <tbody>
                                                {{--RDH Removed Other Queue Settings Since These Do Not Apply To This Release--}}
                                                {{--<tr>
                                                    <td>Number Start</td>
                                                    <td><input class="mb0 form-control" type="text" placeholder="@{{ number_start }}"></td>
                                                </tr>--}}
                                                <tr>
                                                    <td style="padding-top: 20px;">Number Limit</td>
                                                    <td><input class="mb0 form-control" type="text" value="@{{ queue_limit }}" ng-model="queue_limit" ></td>  {{--RDH Added queue_limit to Edit Business Page--}}
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 20px;">Show Only Numbers Issued By Terminal</td>
                                                    <td style="padding-top: 20px;"><input type="checkbox" ng-model="terminal_specific_issue"></td> {{--ARA Terminal-specific issue numbers--}}
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 20px;">
                                                        <strong>*</strong>Frontline SMS Secret
                                                        <a href="https://frontlinecloud.zendesk.com/entries/28395408-Using-the-WebConnection-API-to-send-messages" target="_blank">
                                                            <span class="glyphicon glyphicon-question-sign" title="How to create a Web Connection in Frontlinesms"></span>
                                                        </a>
                                                    </td>
                                                    <td><input class="mb0 form-control" type="password" value="@{{ frontline_secret }}" ng-model="frontline_secret" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 20px;">
                                                        <strong>*</strong>Frontline SMS URL
                                                        <a href="https://frontlinecloud.zendesk.com/entries/28395408-Using-the-WebConnection-API-to-send-messages" target="_blank">
                                                            <span class="glyphicon glyphicon-question-sign" title="How to create a Web Connection in Frontlinesms"></span>
                                                        </a>
                                                    </td>
                                                    <td><input class="mb0 form-control" type="text" value="@{{ frontline_url }}" ng-model="frontline_url" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 20px;">
                                                        SMS Notification Settings<strong>:</strong>
                                                        <span class="glyphicon glyphicon-info-sign" style="color:#337ab7;" title="When to notify users via SMS."></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 10px; padding-left:20px;">Priority Number is called<strong>.</strong></td>
                                                    <td style="padding-top: 10px;"><input type="checkbox"  ng-model="sms_current_number"></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 5px; padding-left:20px;">Priority Number is next in queue<strong>.</strong></td>
                                                    <td style="padding-top: 5px;;"><input type="checkbox"  ng-model="sms_1_ahead"></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 5px; padding-left:20px;">5 Numbers ahead in queue<strong>.</strong></td>
                                                    <td style="padding-top: 5px;"><input type="checkbox"  ng-model="sms_5_ahead"></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 5px; padding-left:20px;">10 Numbers ahead in queue<strong>.</strong></td>
                                                    <td style="padding-top: 5px;"><input type="checkbox"  ng-model="sms_10_ahead"></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 5px; padding-left:20px;"><input id="input_sms_field" type="text" ng-model="input_sms_field"> Numbers ahead in queue.</td>
                                                    <td style="padding-top: 5px;"><input type="checkbox"  ng-model="sms_blank_ahead"></td>
                                                </tr>

                                                {{--<tr>
                                                    <td>Loop numbers automatically.</td>
                                                    <td><input type="radio">Yes <input type="radio">No </td>
                                                </tr>
                                                <tr>
                                                    <td>Allow SMS notification.</td>
                                                    <td><input type="radio">Yes <input type="radio">No </td>
                                                </tr>
                                                <tr>
                                                    <td>Allow Remote Queuing.</td>
                                                    <td><input type="radio">Yes <input type="radio">No </td>
                                                </tr>--}}
                                                </tbody>
                                            </table>
                                            <div class="alert alert-info" role="alert">
                                                <strong>* FeatherQ Frontline SMS</strong> features will be given for <strong>free</strong> for the next few months.
                                                However, future developments might classify these features to be given exclusively to premium users without prior notice.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- accordion -->
                            </div>

                            @include('modals.business.broadcast')

                            <div role="tabpanel" class="tab-pane fade" id="bizanalytics" aria-lavelledby="profile-tab">
                                <div class="col-md-12">
                                    <h5>BUSINESS ANALYTICS</h5>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td style="padding-top: 20px;">Queued Numbers Remaining: </td>
                                                <td style="padding-top: 20px;">@{{ analytics.remaining_count ? analytics.remaining_count : 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Numbers Issued: </td>
                                                <td>@{{ analytics.total_numbers_issued ? analytics.total_numbers_issued : 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Numbers Called: </td>
                                                <td>@{{ analytics.total_numbers_called ? analytics.total_numbers_called : 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Numbers Served: </td>
                                                <td>@{{ analytics.total_numbers_served ? analytics.total_numbers_served : 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Numbers Dropped: </td>
                                                <td>@{{ analytics.total_numbers_dropped ? analytics.total_numbers_dropped : 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Average Waiting Time: </td> <!-- from number issued to calling -->
                                                <td>@{{ analytics.average_time_called ? analytics.average_time_called : 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Average Serving Time: </td> <!-- from number called to served -->
                                                <td>@{{ analytics.average_time_served ? analytics.average_time_served : 0 }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="alert alert-info" role="alert">
                                        <strong>FeatherQ Business Analytics</strong> features will be given for <strong>free</strong> for the next few months.
                                        However, future developments might classify these features to be given exclusively to premium users without prior notice.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="delete_business" class="btn btn-danger btn-lg" ng-click="deleteBusiness(business_id)"><span class="glyphicon glyphicon-trash"></span> DELETE BUSINESS</button>
                <button type="button" id="edit_business" class="btn btn-orange btn-lg" ng-click="saveBusinessDetails()"><span class="glyphicon glyphicon-check"></span> SUBMIT</button>
            </div>
        </div>
    </div>
</div>
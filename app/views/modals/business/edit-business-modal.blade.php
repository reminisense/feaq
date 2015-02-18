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
            <div class="modal-body">
                <form class="">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="alert" id="edit_message" style="display: none;">
                                <p style="text-align: center;"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>BUSINESS DETAILS
                                    </h5>
                                    <small>Business Name</small>
                                    <input type="text" class=" form-control" value="@{{ business_name }}" ng-model="business_name">
                                </div>
                                <div class="col-md-12">
                                    <small>Business Address</small>
                                    <input type="text" class="form-control" id="edit_business_address" ng-autocomplete value="@{{ business_address }}" ng-model="business_address" options="options" details="details">
                                </div>
                                <div class="col-md-12">
                                    <small>Facebook URL</small>
                                    <input type="text" class=" form-control" value="@{{ facebook_url }}" placeholder="Add Your Facebook Page!" ng-model="facebook_url">
                                </div>
                                <div class="col-md-12">
                                    <small>Industry</small>
                                    <div class="btn-group">
                                        <select class="form-control" name="industry" id="industry">
                                            <option value="@{{ industry }}">@{{ industry }}</option>
                                            <option value="Accounting and Finance">Accounting and Finance</option>
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
                                            <option value="Communications Technology">Communications Technology</option>
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
                                            <option value="Photography, Videography, and Media">Photography, Videography, and Media</option>
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
                                    <small>QR Code</small>
                                    <div class="row">
                                        <a id="qr_code_download" href="https://api.qrserver.com/v1/create-qr-code/?data={{ url('broadcast/business') }}/@{{ business_id }}&size=150x150" ng-model="business_id" class="btn btn-blue" download="qrcode.png"><span class="glyphicon glyphicon-add"></span> Download QR Code</a>
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
                        <div class="col-md-6">
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
                                        <table class="table" ng-init="terminal_index = 0">
                                            <tbody>
                                            <tr ng-repeat="terminal in terminals">
                                                <td>
                                                    <div>@{{ $index + 1 }}</div>
                                                </td>
                                                <td>
                                                    <div class="block mb10">
                                                        <small>Terminal Name</small>
                                                        <p class="bold">
                                                            <span class="terminal-name-display" terminal_id="@{{ terminal.terminal_id }}" style="font-size: 14px; ">@{{ terminal.name }}</span>
                                                            <input type="text" class="terminal-name-update" terminal_id="@{{ terminal.terminal_id }}" value="@{{ terminal.name }}" style="display: none;">
                                                        </p>
                                                    </div>
                                                    <div class="block" ng-if="terminal.users.length != 0">
                                                        <small>User</small>
                                                        <p class="bold" ng-repeat="user in terminal.users">@{{ user.first_name + ' ' + user.last_name }}</p>
                                                    </div>
                                                    <div class="block mb10" ng-if="terminal.users.length == 0">
                                                        <a href="#" class="btn btn-blue btn-adduser"><span class="glyphicon glyphicon-add"></span> Add User</a>
                                                        <div class="block inputuser" style="display: none">
                                                            <form ng-submit="emailSearch(search_user, terminal.terminal_id)">
                                                                <input type="text" class="form-control" ng-model="search_user">
                                                            </form>
                                                            <div class="alert alert-danger" ng-show="user_found == false"> User does not exist. </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="block mb10">
                                                        <a href="#" ng-click="editTerminal(terminal.terminal_id)" class="edit-terminal-button" terminal_id="@{{ terminal.terminal_id }}" ><span class="glyphicon glyphicon-trash"></span> Edit</a>
                                                        <a href="#" ng-click="updateTerminal(terminal.terminal_id)" class="update-terminal-button" terminal_id="@{{ terminal.terminal_id }}" style="display: none;"><span class="glyphicon glyphicon-trash"></span> Update</a>
                                                        <a href="#" ng-click="deleteTerminal(terminal.terminal_id)"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                                    </div>
                                                    <div class="block">
                                                        <a href="#" ng-repeat="user in terminal.users" ng-click="unassignFromTerminal(user.user_id, user.terminal_id)"><span class="glyphicon glyphicon-remove"></span> Remove</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- -->
                                            <tr ng-if="terminals.length < 3">
                                                <td>
                                                    <div></div>
                                                </td>
                                                <td>
                                                    <div class="block mb10">
                                                        <a href="#" id="btn-addterminal" class="btn btn-blue"><span class="glyphicon glyphicon-add"></span> Add Terminal</a>
                                                        <form id="inputterminal-form" ng-submit="createTerminal(terminal_name)">
                                                            <input id="inputterminal" type="text" class="form-control" ng-model="terminal_name">
                                                        </form>
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
                                    </div>
                                </div>
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
                                            </tbody></table>

                                    </div>
                                </div>
                            </div>
                            <!-- accordion -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="delete_business" class="btn btn-danger btn-lg" ng-click="deleteBusiness(business_id)">DELETE BUSINESS</button>
                <button type="button" id="edit_business" class="btn btn-orange btn-lg" ng-click="saveBusinessDetails()">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
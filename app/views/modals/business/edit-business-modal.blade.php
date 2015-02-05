<input type="hidden" id="queue-settings-get-url" value="{{ url('/queuesettings/allvalues/') }}">
<input type="hidden" id="queue-settings-update-url" value="{{ url('/queuesettings/update/') }}">
<input type="hidden" id="business-details-url" value="{{ url('/business/businessdetails/') }}">
<!-- modal -->
<div class="modal fade" id="editBusiness" tabindex="-1" ng-controller="editBusinessController">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Edit Kublai Khan</h3>
            </div>
            <div class="modal-body">
                <form class="">
                    <div class="form-group row">
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
                                    <input type="text" class=" form-control" value="@{{ business_address }}" ng-model="business_address">
                                </div>
                                <div class="col-md-12">
                                    <small>Facebook URL</small>
                                    <input type="text" class=" form-control" value="@{{ facebook_url }}" placeholder="Add Your Facebook Page!" ng-model="facebook_url">
                                </div>
                                <div class="col-md-12">
                                    <small>Industry</small>
                                    <input type="text" class=" form-control" value="@{{ industry }}" ng-model="industry">
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small>Time Open</small>
                                            <input type="text" class=" form-control" value="08:00 am" ng-model="time_open">
                                        </div>
                                        <div class="col-md-6">
                                            <small>Time Close</small>
                                            <input type="text" class=" form-control" value="10:00 pm" ng-model="time_closed"> <!-- RDH -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <small>Description</small>
                                    <textarea rows="10" class="form-control" placeholder="Add A Description Of Your Business Here! Try and talk about what your business does, how it started, and how valuable it is to your customers' lives! When we talk about our business, we can definitely say a whole lot about it! So don't hesitate to write it down here."></textarea>
                                </div>

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

                                        <table class="table">
                                            <tbody>
                                            <tr ng-repeat="terminal in terminals">
                                                <td>
                                                    <div>0</div>
                                                </td>
                                                <td>
                                                    <div class="block mb10">
                                                        <small>Terminal Name</small>
                                                        <p class="bold">@{{ terminal.name }}</p>
                                                    </div>
                                                    <div class="block" ng-if="terminal.users.length != 0">
                                                        <small>User</small>
                                                        <p class="bold" ng-repeat="user in terminal.users">@{{ user.first_name + ' ' + user.last_name }}</p>
                                                    </div>
                                                    <div class="block mb10" ng-if="terminal.users.length == 0">
                                                        <a href="#" class="btn btn-blue btn-adduser"><span class="glyphicon glyphicon-add"></span> Add User</a>
                                                        <form>
                                                            <input type="text" class="form-control inputuser" ng-model="search_user" style="display: none">
                                                            <ul style="display: none">
                                                                <li ng-repeat="user in users | filter:search_user" >
                                                                    <button ng-click="assignToTerminal(user.user_id, terminal.terminal_id)">@{{ user.first_name + ' ' + user.last_name }}</button>
                                                                </li>
                                                            </ul>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="block mb10">
                                                        <a href="#"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                                    </div>
                                                    <div class="block">
                                                        <a href="#" ng-repeat="user in terminal.users" ng-click="unassignFromTerminal(user.user_id, user.terminal_id)"><span class="glyphicon glyphicon-remove"></span> Remove</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- -->
                                            <tr>
                                                <td>
                                                    <div>3</div>
                                                </td>
                                                <td>
                                                    <div class="block mb10">
                                                        <a href="#" id="btn-addterminal" class="btn btn-blue"><span class="glyphicon glyphicon-add"></span> Add Terminal</a>
                                                        <form>
                                                            <input id="inputterminal" type="text" class="form-control">
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
                                                <td>Number Limit</td>
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
                <button type="button" id="edit_business" class="btn btn-orange btn-lg" ng-click="saveBusinessDetails()">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
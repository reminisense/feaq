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
                                    <input type="text" class=" form-control" placeholder="@{{ business_name }}" id="business-name">
                                </div>
                                <div class="col-md-12">
                                    <small>Business Address</small>
                                    <input type="text" class=" form-control" placeholder="@{{ business_address }}" id="business-name">
                                </div>
                                <div class="col-md-12">
                                    <small>Facebook URL</small>
                                    <input type="text" class=" form-control" placeholder="@{{ facebook_url }}" id="business-name">
                                </div>
                                <div class="col-md-12">
                                    <small>Industry</small>
                                    <input type="text" class=" form-control" placeholder="@{{ industry }}" id="business-name">
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small>Time Open</small>
                                            <input type="text" class=" form-control" placeholder="08:00 am" id="time-open">
                                        </div>
                                        <div class="col-md-6">
                                            <small>Time Close</small>
                                            <input type="text" class=" form-control" placeholder="10:00 pm" id="time-close">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <small>Description</small>
                                    <textarea rows="10" class="form-control" placeholder="Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS."></textarea>
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
                                                            <input type="text" class="form-control inputuser" style="display: none">
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
                                            <tbody><tr>
                                                <td>Number Start</td>
                                                <td><input class="mb0 form-control" type="text" placeholder="@{{ number_start }}"></td>
                                            </tr>
                                            <tr>
                                                <td>Number Limit</td>
                                                <td><input class="mb0 form-control" type="text" placeholder="@{{ number_limit }}" ></td>
                                            </tr>
                                            <tr>
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
                                            </tr>
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
                <button type="button" class="btn btn-orange btn-lg">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
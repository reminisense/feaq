<div class="clearfix header mb10">
    <h5 class="col-md-12">STAFF MANAGEMENT</h5>
</div>

<!-- Start new services form -->
<div class="clearfix">
    <form ng-submit="emailSearch(search_user, selected_terminal)">
        <div class="col-md-12">
            <div class="alert alert-danger" id="add-user-error" ng-show="assign_error" style="text-align: center">@{{ assign_error }}</div>
            <div class="alert alert-success" id="add-user-suc" ng-show="assign_suc" style="text-align: center">@{{ assign_suc }}</div>
        </div>
        <div class="col-md-2">
            Assign to terminal :
        </div>
        <div class="col-md-2">
            <input type="email" class="form-control" placeholder="Email Address" ng-model="search_user" title="Staff Email" required/>
        </div>
        <div class="col-md-2">
            <select class="form-control" ng-model="selected_service" title="Select Service">
                <option ng-repeat="service in services" value="@{{ $index }}">@{{ service.name }}</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" ng-model="selected_terminal" title="Select Terminal">
                <option value=0>SELECT TERMINAL</option>
                <option ng-repeat="terminal in services[selected_service].terminals" value="@{{ terminal.terminal_id }}">@{{ terminal.name }}</option>
            </select>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok"></span> Assign</button>
        </div>
    </form>
</div>
<!-- end new services form -->

<div class="clearfix header mb10">
    <h5 class="col-md-12">GROUP MANAGEMENT</h5>
</div>

<!-- Start new group form -->
<div class="clearfix">
    <form ng-submit="">
        <div class="col-md-2">
            Create a new group:
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="Group Name" ng-model="groupToAdd" title="Group Name" required/>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-success btn-lg" ng-click="addNewGroup()"><span class="glyphicon glyphicon-floppy-disk"></span></button>
        </div>
    </form>
</div>
<!-- end new group form -->

<!-- Start delete group form -->
<div class="clearfix">
    <form ng-submit="">
        <div class="col-md-2">
            Delete an existing group:
        </div>
        <div class="col-md-2">
            <select class="form-control" ng-model="groupToDelete" title="Select Group">
                <option value="0">Select Group</option>
                <option ng-repeat="grouping in groupings" value="@{{ grouping.group_id }}">@{{ grouping.group_name }}</option>
            </select>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger btn-lg" ng-click="deleteGrouping(groupToDelete)"><span class="glyphicon glyphicon-trash"></span></button>
        </div>
    </form>
</div>
<!-- end delete group form -->

<div class="clearfix mt20 mb10">
    <div class="col-md-12">
        <h5 class=mb10"">SERVICES MANAGEMENT</h5>
        <button type="button" class=" mt10 mb20 btn btn-lg btn-orange" id="" ng-click="service_create = true" ng-show="services.length <= business_features.max_services" title="Add a Service"><span class="glyphicon glyphicon-plus"></span> Add a Service</button>
    </div>
</div>
<div class="clearfix">
    <div class="col-md-12 alert alert-danger" id="service-error" ng-show="service_error"> @{{ service_error }}</div>
</div>

<form class="clearfix" id="create-service" ng-submit="createService(new_service_name)" ng-show="service_create">
    <div class="col-md-12 broadcast-wrap clearfix" style="padding: 15px 20px;">
        <div class="col-md-6 col-xs-12">Add a New Service</div>
        <div class="col-md-4 col-xs-6">
            <input type="text" ng-model="new_service_name" placeholder="e.g. Cashier" class="form-control nomg white"/></div>
        <div class="col-md-2 col-xs-6">
            <button type="button" class="btn-boxy btn-removeuser btn-light" ng-click="service_create = false" title="Cancel"><span class="glyphicon glyphicon-remove"></span></button>
            <button type="submit" class="edit-terminal-button btn-boxy btn-success" title="Save"><span class="glyphicon glyphicon-floppy-disk"></span></button></div>
    </div>

</form>

<div class="clearfix table-responsive">
    @include('modals.business.settings-modal')
    <table class="clearfix table table-hover" ng-init="terminal_index = 0" ng-repeat="service in services" ng-if="$index > 0">
        <thead>
        <tr>
            <th colspan="2">
                <div class="col-md-2">
                    <select id="service-group-@{{ service.service_id }}" name="service-group" class="form-control" ng-model="serviceGroup" title="Select Group" ng-change="setServiceGroup(service.service_id)">
                        <option ng-repeat="grouping in groupings" value="@{{ grouping.group_id }}">@{{ grouping.group_name }}</option>
                    </select>
                </div>
                <strong>@{{$index }} - <span class="service-name" ng-hide="service.edit_service">@{{ service.name }}</span></strong>
            </th>
            <th width="" class="text-right">
                <a href="" class="btn-boxy btn-light" ng-click="getServiceQueueSettings(service.service_id, service.name)" title="Service Settings"><span class="glyphicon glyphicon-cog"></span></a>
                <a href="" class="btn-boxy btn-removeuser btn-light" ng-click="removeService(service.service_id)" title="Remove Service"><span class="glyphicon glyphicon-trash"></span></a>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="terminal in service.terminals">
            <td width="15%">
                <div class="mt10 mb10 block clearfix">Terminal @{{ $index + 1 }}</div>
            </td>
            <td width="50%">
                <div class="mt10 mb10 block clearfix">
                    <form ng-submit="updateTerminal($event, terminal.terminal_id)">
                        <div class="col-md-7">
                            <input type="text" class="form-control terminal-name-update terminal-update-field" terminal_id="@{{ terminal.terminal_id }}" value="@{{ terminal.name }}" style="display: none;">
                            <span class="terminal-name-display" terminal_id="@{{ terminal.terminal_id }}" style="font-size: 14px;">@{{ terminal.name }}</span>
                            <div style="display: none; margin-top: 10px;" class="alert alert-danger terminal-error-message" terminal_id="@{{ terminal.terminal_id }}"></div>
                            <div class="">
                                <button type="button" ng-click="editTerminal($event, terminal.terminal_id)" class="edit-terminal-button btn-boxy btn-light" terminal_id="@{{ terminal.terminal_id }}" title="Edit Terminal">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <button type="button" ng-click="deleteTerminal($event, terminal.terminal_id)" class="delete-terminal-button btn-boxy btn-light" style="display:inline-block;" title="Delete Terminal">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                                <button type="submit" class="update-terminal-button btn-boxy btn-success" terminal_id="@{{ terminal.terminal_id }}" style="display: none;" title="Save">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-5 clearfix">
                            <div class="pull-left">
                                <div id="terminal-colors" class="clearfix">
                                    <div class="dropdown">
                                        <button id="btn-terminal-color-@{{ terminal.terminal_id }}" class="btn btn-md btn-primary t-btn dropdown-toggle @{{ terminal.color }}" type="button" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu banana" id="">
                                            <li><a id="cyan" data-color="cyan" href="" ng-click="setTerminalColor(terminal.terminal_id, 'cyan')"></a></li>
                                            <li><a id="yellow" data-color="yellow" href="" ng-click="setTerminalColor(terminal.terminal_id, 'yellow')"></a></li>
                                            <li><a id="blue" data-color="blue" href="" ng-click="setTerminalColor(terminal.terminal_id, 'blue')"></a></li>
                                            <li><a id="orange" data-color="borange" href="" ng-click="setTerminalColor(terminal.terminal_id, 'borange')"></a></li>
                                            <li><a id="red" data-color="red" href="" ng-click="setTerminalColor(terminal.terminal_id, 'red')"></a></li>
                                            <li><a id="green" data-color="green" href="" ng-click="setTerminalColor(terminal.terminal_id, 'green')"></a></li>
                                            <li><a id="violet" data-color="violet" href="" ng-click="setTerminalColor(terminal.terminal_id, 'violet')"></a></li>
                                            <li><a id="ECD078" data-color="ECD078" href="" ng-click="setTerminalColor(terminal.terminal_id, 'ECD078')"></a></li>
                                            <li><a id="D95B43" data-color="D95B43" href="" ng-click="setTerminalColor(terminal.terminal_id, 'D95B43')"></a></li>
                                            <li><a id="C02942" data-color="C02942" href="" ng-click="setTerminalColor(terminal.terminal_id, 'C02942')"></a></li>
                                            <li><a id="x542437" data-color="x542437" href="" ng-click="setTerminalColor(terminal.terminal_id, 'x542437')"></a></li>
                                            <li><a id="x53777A" data-color="x53777A" href="" ng-click="setTerminalColor(terminal.terminal_id, 'x53777A')"></a></li>
                                            <li><a id="FCA78B" data-color="FCA78B" href="" ng-click="setTerminalColor(terminal.terminal_id, 'FCA78B')"></a></li>
                                            <li><a id="FF745F" data-color="FF745F" href="" ng-click="setTerminalColor(terminal.terminal_id, 'FF745F')"></a></li>
                                            <li><a id="x78250A" data-color="x78250A" href="" ng-click="setTerminalColor(terminal.terminal_id, 'x78250A')"></a></li>
                                            <li><a id="x242436" data-color="x242436" href="" ng-click="setTerminalColor(terminal.terminal_id, 'x242436')"></a></li>
                                        </ul>
                                    </div>
                                    {{--<small id="color-info-@{{ terminal.terminal_id }}">*Colors will take effect on the next number.</small>--}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </td>
            <td width="35%">
                <div class="col-md-12" ng-if="terminal.users.length != 0">
                    <div ng-repeat="user in terminal.users">
                        <div class="mt10 mb10 block clearfix">
                            <div class=" panel panel-default">
                                <div class="panel-body clearfix">
                                    <div class="pull-left">
                                        <span class="glyphicon glyphicon-user"></span>
                                        <span class="terminal_user" style="margin-left:10px;">@{{ user.first_name + ' ' + user.last_name }}</span>
                                    </div>
                                    <div class="pull-right text-right">
                                        <a href="" class="btn-boxy btn-removeuser btn-light" ng-click="unassignFromTerminal(user.user_id, user.terminal_id)" title="Remove Terminal User"><span class="glyphicon glyphicon-remove"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>

        <tr ng-if="service.terminals.length < business_features.max_terminals">
            <td colspan="4" class="text-left">
                <div class=" block mt10 mb10">
                    <a href="" id="" class="btn-boxy btn-xs btn-orange btn-addterminal"><span class="glyphicon glyphicon-plus"></span> Add Terminal</a>
                    <form class="inputterminal-form" ng-submit="createTerminal(service.service_id)" style="display: none">
                        <div class="inputterminal">
                            <div class="col-md-9">
                                <input type="text" class="form-control" ng-model="add_terminal.terminal_name" placeholder="Terminal Name">
                                <div style="display: none; margin-top: 10px;" class="alert alert-danger terminal-error-msg"></div>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn-boxy btn-xs btn-danger cancel-add-terminal" title="Cancel"><span class="glyphicon glyphicon-remove"></span></button>
                                <button type="submit" class="btn-boxy btn-xs btn-success" title="Add"><span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="alert alert-danger" id="terminal-delete-error" ng-show="terminal_delete_error"> @{{ terminal_delete_error }}</div>
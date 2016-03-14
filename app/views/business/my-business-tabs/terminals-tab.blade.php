<div class="clearfix header mb10">
    <h5 class="col-md-12">STAFF MANAGEMENT</h5>
</div>

<!-- Start new services form -->
<div class="clearfix">
    <form ng-submit="emailSearch(search_user, selected_terminal)">
        <div class="col-md-12">
            <div class="alert alert-danger" id="add-user-error" ng-show="assign_error">@{{ assign_error }}</div>
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

<div class="clearfix mt20 mb10">
    <div class="col-md-12">
        <h5 class=mb10"">SERVICES MANAGEMENT</h5>
        <button type="button" class=" btn btn-lg btn-orange" id="" ng-click="service_create = true" ng-show="services.length <= business_features.max_services" title="Add a Service"><span class="glyphicon glyphicon-plus"></span> Add a Service</button>
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
            <button type="button" class="btn-boxy btn-removeuser btn-danger" ng-click="service_create = false" title="Cancel"><span class="glyphicon glyphicon-remove"></span></button>
            <button type="submit" class="edit-terminal-button btn-boxy btn-success" title="Save"><span class="glyphicon glyphicon-floppy-disk"></span></button></div>
    </div>

</form>

<div class="clearfix table-responsive">
<table class="clearfix table table-hover" ng-init="terminal_index = 0" ng-repeat="service in services" ng-if="$index > 0">
    <thead>
    <tr>
        <th width="">

            <form ng-submit="updateService(edit_service_name, service.service_id)">
                <strong>@{{ $index }} - <span class="service-name" ng-hide="service.edit_service">@{{ service.name }}</span></strong>
                <input type="text" ng-model="edit_service_name" ng-show="service.edit_service" placeholder="@{{ service.name }}"/>
            </form>
        </th>
        <th width="">
            <a href="" ng-show="service.edit_service" ng-click="service.edit_service = !service.edit_service" class="edit-terminal-button btn-boxy btn-default" title="Cancel" ><span class="glyphicon glyphicon-remove"></span></a>
            <a href="" ng-show="service.edit_service" ng-click="updateService(edit_service_name, service.service_id)" class="edit-terminal-button btn-boxy btn-primary" title="Save" ><span class="glyphicon glyphicon-floppy-disk"></span></a>
        </th>
        <th width="" class="text-right">
            <a href="" ng-hide="service.edit_service" ng-click="service.edit_service = !service.edit_service" class="edit-terminal-button btn-boxy btn-primary"  title="Edit Service"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="" class="btn-boxy btn-removeuser btn-danger" ng-click="removeService(service.service_id)" title="Remove Service"><span class="glyphicon glyphicon-trash"></span></a>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr ng-repeat="terminal in service.terminals">

        <td>
            <div class="mt10 mb10 block clearfix">Terminal @{{ $index + 1 }}</div>
        </td>
        <td>
            <div class="mt10 mb10 block clearfix">
                <form ng-submit="updateTerminal($event, terminal.terminal_id)">
                    <div class="col-md-7" style="height: 25px;">
                        <input type="text" class="form-control terminal-name-update terminal-update-field" terminal_id="@{{ terminal.terminal_id }}" value="@{{ terminal.name }}" style="display: none;">
                        <span class="terminal-name-display" terminal_id="@{{ terminal.terminal_id }}" style="font-size: 14px;">@{{ terminal.name }}</span>
                        <div style="display: none; margin-top: 10px;" class="alert alert-danger terminal-error-message" terminal_id="@{{ terminal.terminal_id }}"></div>
                    </div>
                    <div class="col-md-5">
                        <div class="pull-left clearfix dropdown" id="terminal-colors">
                            <button id="btn-terminal-color" class="btn btn-md btn-primary dropdown-toggle " type="button" data-toggle="dropdown" aria-expanded="false">Select Color
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu" id="terminal-colors">
                                <li><a id="cyan" data-color="cyan" href=""></a></li>
                                <li><a id="yellow" data-color="yellow" href=""></a></li>
                                <li><a id="blue" data-color="blue" href=""></a></li>
                                <li><a id="orange" data-color="borange" href=""></a></li>
                                <li><a id="red" data-color="red" href=""></a></li>
                                <li><a id="green" data-color="green" href=""></a></li>
                                <li><a id="violet" data-color="violet" href=""></a></li>
                            </ul>
                        </div>
                        <div class="pull-left">
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
                </form>
            </div>
        </td>
        <td width="">
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
                                    <a href="" class="btn-boxy btn-removeuser btn-danger" ng-click="unassignFromTerminal(user.user_id, user.terminal_id)" title="Remove Terminal User"><span class="glyphicon glyphicon-remove"></span></a>
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
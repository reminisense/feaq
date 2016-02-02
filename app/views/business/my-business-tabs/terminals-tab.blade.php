<div class="clearfix header">
    <h5 class="clearfix">STAFF MANAGEMENT</h5>
</div>

<!-- Start new services form -->
<div class="col-md-12">
    <form ng-submit="emailSearch(search_user, selected_terminal)">
        <div class="col-md-2">
            Assign to terminal :
        </div>
        <div class="col-md-2">
            <select class="form-control" ng-model="selected_service" title="Select Service">
                <option>SELECT SERVICE</option>
                <option ng-repeat="service in services" value="@{{ $index }}">@{{ service.name }}</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" ng-model="selected_terminal" title="Select Terminal">
                <option>SELECT TERMINAL</option>
                <option ng-repeat="terminal in services[selected_service].terminals" value="@{{ terminal.terminal_id }}">@{{ terminal.name }}</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="email" class="form-control" placeholder="Email" ng-model="search_user" title="Staff Email"/>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok"></span> Assign</button>
        </div>
    </form>
</div>
<!-- end new services form -->

<div class="clearfix header">
    <h5 class="clearfix">SERVICES MANAGEMENT
        <button type="submit" class="pull-right btn btn-lg btn-orange" id="" ng-click="service_create = true" ng-show="terminals.length < 3" title="Add a Service"><span class="glyphicon glyphicon-plus"></span></button>
    </h5>
</div>

<div class="alert alert-danger" id="service-error" ng-show="service_error"> @{{ service_error }}</div>
<form id="create-service" ng-submit="createService(new_service_name)">
    <table class="table table-hover table-spaces table-responsive" ng-show="service_create">
        <thead>
        <tr>
            <th width="5%"></th>
            <th width="20%">Add a new Service</th>
            <th width="35%">
                <div class="col-md-9">
                    <input type="text" ng-model="new_service_name" placeholder="e.g. Cashier" class="form-control nomg white"/>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn-boxy btn-removeuser btn-danger" ng-click="service_create = false" title="Cancel"><span class="glyphicon glyphicon-remove"></span></button>
                    <button type="submit" class="edit-terminal-button btn-boxy btn-success" title="Save"><span class="glyphicon glyphicon-floppy-disk"></span></button>
                </div>
            </th>
            <th width="40%" class="text-right"></th>
        </tr>
        </thead>
    </table>
</form>
<table class="table table-hover table-spaces table-responsive" ng-init="terminal_index = 0" ng-repeat="service in services">
    <thead>
    <tr>
        <th>@{{ $index + 1 }}</th>
        <th>
            <form ng-submit="updateService(edit_service_name, service.service_id)">
                <span class="service-name" ng-hide="service.edit_service">@{{ service.name }}</span>
                <input type="text" ng-model="edit_service_name" ng-show="service.edit_service" placeholder="@{{ service.name }}"/>
            </form>
        </th>
        <th>
            <a href="" ng-show="service.edit_service" ng-click="service.edit_service = !service.edit_service" class="edit-terminal-button btn-boxy btn-default" title="Cancel" ><span class="glyphicon glyphicon-remove"></span></a>
            <a href="" ng-show="service.edit_service" ng-click="updateService(edit_service_name, service.service_id)" class="edit-terminal-button btn-boxy btn-primary" title="Save" ><span class="glyphicon glyphicon-floppy-disk"></span></a>
        </th>
        <th class="text-right">
            <a href="" ng-hide="service.edit_service" ng-click="service.edit_service = !service.edit_service" class="edit-terminal-button btn-boxy btn-primary"  title="Edit Service"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="" class="btn-boxy btn-removeuser btn-danger" ng-click="removeService(service.service_id)" title="Remove Service"><span class="glyphicon glyphicon-trash"></span></a>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr ng-repeat="terminal in service.terminals">
        <td width="5%"></td>
        <td width="20%">
            <div class="mt10 mb10 block clearfix">Terminal @{{ $index + 1 }}</div>
        </td>
        <td width="35%">
            <div class="mt10 mb10 block clearfix">
                <form ng-submit="updateTerminal($event, terminal.terminal_id)">
                    <div class="col-md-9" style="height: 25px;">
                        <input type="text" class="form-control terminal-name-update terminal-update-field" terminal_id="@{{ terminal.terminal_id }}" value="@{{ terminal.name }}" style="display: none;">
                        <span class="terminal-name-display" terminal_id="@{{ terminal.terminal_id }}" style="font-size: 14px;">@{{ terminal.name }}</span>
                        <div style="display: none; margin-top: 10px;" class="alert alert-danger terminal-error-message" terminal_id="@{{ terminal.terminal_id }}"></div>
                    </div>
                    <div class="col-md-3">
                        <button type="button" ng-click="deleteTerminal($event, terminal.terminal_id)" class="delete-terminal-button btn-boxy btn-danger" style="display:inline-block;" title="Delete Terminal">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                        <button type="button" ng-click="editTerminal($event, terminal.terminal_id)" class="edit-terminal-button btn-boxy btn-primary" terminal_id="@{{ terminal.terminal_id }}" title="Edit Terminal">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                        <button type="submit" class="update-terminal-button btn-boxy btn-success" terminal_id="@{{ terminal.terminal_id }}" style="display: none;" title="Save">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                        </button>
                    </div>
                </form>
            </div>
        </td>
        <td width="40%">
            <div class="col-md-12" ng-if="terminal.users.length != 0">
                <div ng-repeat="user in terminal.users">
                    <div class="mt10 mb10 block clearfix">
                        <div class="col-md-12">
                            <div class="col-md-11">
                                <span class="terminal_user" style="margin-left:10px;">@{{ user.first_name + ' ' + user.last_name }}</span>
                            </div>
                            <div class="col-md-1 text-right">
                                <a href="" class="btn-boxy btn-removeuser btn-danger" ng-click="unassignFromTerminal(user.user_id, user.terminal_id)"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <!-- -->
    <tr ng-if="terminals.length < 3">
        <td width="25%" colspan="2"></td>
        <td width="35%">
            <div class="block mt10 mb10">
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
        <td width="40%"></td>
    </tr>
    </tbody>
</table>
<div class="alert alert-danger" id="terminal-delete-error" ng-show="terminal_delete_error"> @{{ terminal_delete_error }}</div>

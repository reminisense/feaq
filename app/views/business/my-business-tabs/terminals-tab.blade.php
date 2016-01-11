<div class="clearfix header">
    <h5 class="clearfix">SERVICES
        <button type="submit" class="pull-right btn btn-lg btn-orange" id="" ng-click="service_create = true" ng-show="terminals.length < 3" ><span class="glyphicon glyphicon-plus"></span> Add a Service</button>
    </h5>
</div>
<form></form> <!-- ARA I just placed this because if not placed other form elements below will not be rendered -->
<div class="alert alert-danger" id="service-error" ng-show="service_error"> @{{ service_error }}</div>
<form ng-submit="createService(new_service_name)">
    <table class="table table-hover table-spaces table-responsive" ng-show="service_create">
        <thead>
        <tr>
            <th></th>
            <th><input type="text" ng-model="new_service_name" placeholder="e.g. Cashier"/></th>
            <th>
                <button type="submit" class="edit-terminal-button btn-boxy btn-primary"  ><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
            </th>
            <th class="text-right">
                <a href="" class="btn-boxy btn-removeuser btn-default" ng-click="service_create = false">
                    <span class="glyphicon glyphicon-remove"></span> Cancel
                </a>
            </th>
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
            <a href="" ng-hide="service.edit_service" ng-click="service.edit_service = !service.edit_service" class="edit-terminal-button btn-boxy btn-primary"  ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
            <a href="" ng-show="service.edit_service" ng-click="service.edit_service = !service.edit_service" class="edit-terminal-button btn-boxy btn-default"  ><span class="glyphicon glyphicon-remove"></span> Cancel</a>
            <a href="" ng-show="service.edit_service" ng-click="updateService(edit_service_name, service.service_id)" class="edit-terminal-button btn-boxy btn-primary"  ><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
        </th>
        <th class="text-right">
            <a href="" class="btn-boxy btn-removeuser btn-default" ng-click="removeService(service.service_id)">
                <span class="glyphicon glyphicon-remove"></span> Remove Service
            </a>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr ng-repeat="terminal in service.terminals">
        <td width="5%"></td>
        <td width="20%">
            <div>Terminal @{{ $index + 1 }}</div>
        </td>
        <td width="35%">
            <form ng-submit="updateTerminal($event, terminal.terminal_id)">
                <span class="terminal-name-display" terminal_id="@{{ terminal.terminal_id }}" style="font-size: 14px; ">@{{ terminal.name }}</span>
                <input type="text" class="form-control terminal-name-update terminal-update-field" terminal_id="@{{ terminal.terminal_id }}" value="@{{ terminal.name }}" style="display: none;">
                <div class="mt10 mb10 block terminal-buttons">
                    <a href="" ng-click="deleteTerminal($event, terminal.terminal_id)" class="delete-terminal-button btn-boxy btn-default" style="display:inline-block;"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                    <a href="" ng-click="editTerminal($event, terminal.terminal_id)" class="edit-terminal-button btn-boxy btn-primary" terminal_id="@{{ terminal.terminal_id }}" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                    <button ng-click="" type="submit" class="update-terminal-button btn-boxy btn-primary" terminal_id="@{{ terminal.terminal_id }}" style="display: none;"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </div>
                <div style="display: none; margin-top: 10px;" class="alert alert-danger terminal-error-message" terminal_id="@{{ terminal.terminal_id }}"></div>
            </form>
        </td>
        <td width="40%">
        <span ng-if="terminal.users.length != 0">
            <span ng-repeat="user in terminal.users">
                <div class="mt10 mb10 block clearfix">
                    <div class="col-md-12">
                        <a href="" class="btn-boxy btn-removeuser btn-default" ng-click="unassignFromTerminal(user.user_id, user.terminal_id)">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </a>
                        <span class="terminal_user" style="margin-left:10px;">@{{ user.first_name + ' ' + user.last_name }}</span>
                    </div>
                    {{--<div class="col-md-6">

                    </div>--}}
                </div>
                <div class="mt10 block terminal-buttons clearfix">
                    <div class="col-md-12">
                        <span class="inline-btns" ng-if="terminal.users.length < business_features.terminal_users">
                            <span ng-if="user.user_id == terminal.users[terminal.users.length - 1].user_id">
                                <a href="" class="btn-boxy btn-adduser btn-primary"><span class="glyphicon glyphicon-plus"></span> Add User</a>
                                <div class="mb10 mt10 inputuser" style="display: none">
                                    <form ng-submit="emailSearch(search_user, terminal.terminal_id)">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" ng-model="search_user" placeholder="Facebook Email" ng-model-options="{debounce: 1000}">
                                            <ul class="dropdown-menu" role="menu" ng-show="user_results.users.length > 0"  style="display: block;" outside-click="clearUserResults()">
                                                <li ng-repeat="user in user_results.users" ng-click="emailSearch(user.email, terminal.terminal_id)">
                                                    <a href="#">
                                                        <strong>@{{ user.first_name + ' ' + user.last_name }}</strong><br>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn-boxy btn-danger cancel-adduser"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                            <button type="submit" class="btn-boxy btn-cyan"><span class="glyphicon glyphicon-plus"></span> Add</button>
                                        </div>
                                    </form>
                                    <div style="display: none; margin-top: 10px;" class="alert alert-danger add-user-error" terminal_id="@{{ terminal.terminal_id }}"> User does not exist in FeatherQ. </div>
                                </div>
                            </span>
                        </span>
                        <span class="inline-btns" ng-if="terminal.users.length == business_features.terminal_users">
                            <span ng-if="user.user_id == terminal.users[terminal.users.length - 1].user_id">
                                <a class="btn-boxy btn-xs btn-disabled"><span class="glyphicon glyphicon-plus"></span> Add User</a>
                            </span>
                        </span>
                    </div>
                </div>
            </span>
        </span>
        <span ng-if="terminal.users.length == 0">
            <div class="mb10 mt10 block col-md-12">
                <span ng-if="user.user_id == terminal.users[terminal.users.length - 1].user_id">
                    <a href="" class="btn-boxy btn-xs btn-adduser btn-primary"><span class="glyphicon glyphicon-plus"></span> Add User</a>
                    <div class="mb10 inputuser" style="display: none">
                        <form ng-submit="emailSearch(search_user, terminal.terminal_id)">
                            <div class="col-md-12">
                                <input type="text" class="form-control" ng-model="search_user" placeholder="Facebook Email" ng-model-options="{debounce: 1000}">
                                <ul class="dropdown-menu" role="menu" ng-show="user_results.users.length > 0"  style="display: block" outside-click="clearUserResults()">
                                    <li ng-repeat="user in user_results.users" ng-click="emailSearch(user.email, terminal.terminal_id)">
                                        <a href="#">
                                            <strong>@{{ user.first_name + ' ' + user.last_name }}</strong><br>
                                            <span>@{{ user.email }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn-boxy btn-danger cancel-adduser"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                <button type="submit" class="btn-boxy btn-cyan"><span class="glyphicon glyphicon-plus"></span> Add</button>
                            </div>
                        </form>
                        <div style="display: none; margin-top: 10px;" class="alert alert-danger add-user-error" terminal_id="@{{ terminal.terminal_id }}"> User does not exist in FeatherQ. </div>
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
            <div class="block mt10 mb10">
                <a href="" id="" class="btn-boxy btn-xs btn-orange btn-addterminal"><span class="glyphicon glyphicon-plus"></span> Add Terminal</a>
                <form class="inputterminal-form" ng-submit="createTerminal(service.service_id)" style="display: none">
                    <div class="inputterminal">
                        <div class="">
                            <input type="text" class="form-control" ng-model="add_terminal.terminal_name" placeholder="Terminal Name">
                        </div>
                        <div class="">
                            <button type="button" class="btn-boxy btn-xs btn-primary cancel-add-terminal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                            <button class="btn-boxy btn-xs btn-cyan" type="submit"><span class="glyphicon glyphicon-plus"></span> Add</button>
                        </div>
                        <div style="display: none; margin-top: 10px;" class="alert alert-danger terminal-error-msg"></div>
                    </div>
                </form>
            </div>
        </td>
        <td>
            <div class="block mb10">
                <!-- button here -->
            </div>
        </td>
        <td></td>
    </tr>
    </tbody>
</table>
<div class="alert alert-danger" id="terminal-delete-error" ng-show="terminal_delete_error"> @{{ terminal_delete_error }}</div>

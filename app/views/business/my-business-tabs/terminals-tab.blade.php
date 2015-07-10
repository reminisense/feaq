<div class="clearfix header">
    <h5>TERMINALS</h5>
</div>
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
        <td width="10%">
            <div class="bold">@{{ $index + 1 }}</div>
        </td>
        <td width="45%">
            <span class="terminal-name-display" terminal_id="@{{ terminal.terminal_id }}" style="font-size: 14px; ">@{{ terminal.name }}</span>
            <input type="text" class="form-control terminal-name-update terminal-update-field" terminal_id="@{{ terminal.terminal_id }}" value="@{{ terminal.name }}" style="display: none;">
            <div class="mt10 mb10 block terminal-buttons">
                <a href="" ng-click="deleteTerminal($event, terminal.terminal_id)" class="delete-terminal-button btn-boxy btn-default" style="display:inline-block;"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                <a href="" ng-click="editTerminal($event, terminal.terminal_id)" class="edit-terminal-button btn-boxy btn-primary" terminal_id="@{{ terminal.terminal_id }}" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                <a href="" ng-click="updateTerminal($event, terminal.terminal_id)" class="update-terminal-button btn-boxy btn-primary" terminal_id="@{{ terminal.terminal_id }}" style="display: none;"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>

            </div>
            <div style="display: none; margin-top: 10px;" class="alert alert-danger terminal-error-message" terminal_id="@{{ terminal.terminal_id }}"> Terminal name already exists.</div>
        </td>
        <td width="45%">
        <span ng-if="terminal.users.length != 0">
            <span ng-repeat="user in terminal.users">
                <span class="terminal_user">@{{ user.first_name + ' ' + user.last_name }}</span>
                <div class="mt10 mb10 block terminal-buttons">
                    <a href="" class="btn-boxy btn-removeuser btn-default" ng-click="unassignFromTerminal(user.user_id, user.terminal_id)"><span class="glyphicon glyphicon-remove"></span> Remove</a>
                    <span class="inline-btns" ng-if="terminal.users.length < 3">
                        <span ng-if="user.user_id == terminal.users[terminal.users.length - 1].user_id">
                            <a href="" class="btn-boxy btn-adduser btn-primary"><span class="glyphicon glyphicon-plus"></span> Add User</a>
                            <div class="mb10 mt10 inputuser" style="display: none">
                                <form ng-submit="emailSearch(search_user, terminal.terminal_id)">
                                    <div class="">
                                        <input type="text" class="form-control" ng-model="search_user" placeholder="Facebook Email">
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn-boxy btn-cyan"><span class="glyphicon glyphicon-plus"></span> Add</button>
                                        <button class="btn-boxy btn-danger cancel-adduser"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                    </div>
                                </form>
                                <div style="display: none; margin-top: 10px;" class="alert alert-danger add-user-error" terminal_id="@{{ terminal.terminal_id }}"> User does not exist in FeatherQ. </div>
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
            <div class="mb10 mt10 block">
                <span ng-if="user.user_id == terminal.users[terminal.users.length - 1].user_id">
                    <a href="" class="btn-boxy btn-xs btn-adduser btn-primary"><span class="glyphicon glyphicon-plus"></span> Add User</a>
                    <div class="mb10 inputuser" style="display: none">
                        <form ng-submit="emailSearch(search_user, terminal.terminal_id)">
                            <div class="">
                                <input type="text" class="form-control" ng-model="search_user" placeholder="Facebook Email">
                            </div>
                            <div class="">
                                <button class="btn-boxy btn-danger cancel-adduser"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
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
                <a href="" id="btn-addterminal" class="btn-boxy btn-xs btn-orange"><span class="glyphicon glyphicon-plus"></span> Add Terminal</a>
                <form id="inputterminal-form" ng-submit="createTerminal(terminal_name)">
                    <div id="inputterminal">
                        <div class="">
                            <input type="text" class="form-control" ng-model="terminal_name" placeholder="Terminal Name">
                        </div>
                        <div class="">
                            <button type="button" class="btn-boxy btn-xs btn-primary cancel-add-terminal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                            <button class="btn-boxy btn-xs btn-cyan" type="submit"><span class="glyphicon glyphicon-plus"></span> Add</button>
                        </div>
                        <div style="display: none; margin-top: 10px;" class="alert alert-danger terminal-error-msg"> Terminal name already exists.</div>
                    </div>
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
<div class="alert alert-danger" id="terminal-delete-error" ng-show="terminal_delete_error"> @{{ terminal_delete_error }}</div>

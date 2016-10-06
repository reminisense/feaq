<style>
    #terminal-colors .btn{
        width: 238px;
    }
    .service-name strong{
        font-size: 24px;
    }
    .terminal-name span:last-child{
        font-size: 20px;
    }
</style>
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
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Add a New Service</div>
                </div>
                <div class="panel-body">
                    <table class="clearfix table table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">SERVICE</th>
                            <th class="text-center">TERMINALS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td rowspan="4" style="vertical-align: middle;">
                                <input type="text" ng-model="new_service_name" placeholder="Service Name" class="form-control nomg white"/>
                            </td>
                        </tr>
                        <tr ng-repeat="n in [1,2,3]">
                            <td>
                                <input type="text" placeholder="Terminal @{{ n }}" class="form-control nomg white"/>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>
                <div class="panel-footer">
                    <div class="clearfix">
                        <button type="submit" class="btn btn-success pull-right"><span class="glyphicon glyphicon-floppy-disk"></span>SUBMIT</button>
                        <button type="button" class="btn btn-default pull-right" ng-click="service_create = false">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="clearfix table-responsive">
    @include('modals.business.settings-modal')
    <table class="clearfix table table-hover" ng-init="terminal_index = 0">
        <thead>
        <th class="text-center"><strong>SERVICES</strong></th>
        <th class="text-center"><strong>TERMINALS</strong></th>
        <th class="text-center"><strong>USERS</strong></th>
        </thead>
        <tbody ng-repeat="service in services" ng-if="$index > 0">
        <tr>
            <td width="25%" rowspan="@{{ service.terminals.length + 2 }}" class="" style="vertical-align: middle;">
                <div class="col-md-12">
                    <a href="#" class="service-name">
                        <span class="glyphicon glyphicon-chevron-down"></span>
                        <strong>
                            <span class="" ng-hide="service.edit_service">@{{ service.name }}</span>
                        </strong>
                    </a>
                </div>
                <div class="col-md-12 service-buttons" style="display: none">
                    <button class="btn btn-default">
                        <span class="glyphicon glyphicon-pencil"></span>
                        Rename
                    </button>
                    <button class="btn btn-default" ng-click="getServiceQueueSettings(service.service_id, service.name)" title="Service Settings">
                        <span class="glyphicon glyphicon-cog"></span>
                        Settings
                    </button>
                </div>
            </td>
        </tr>
        <tr ng-repeat="terminal in service.terminals">
            <td width="35%" style="vertical-align: middle;">
                <div class="mt10 mb10 block clearfix">
                    <form ng-submit="updateTerminal($event, terminal.terminal_id)">
                        <div class="col-md-12">
                            <div class="mb20">
                                <a href="#" class="terminal-name @{{ terminal.color }}">
                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                    <span class="terminal-name-display" terminal_id="@{{ terminal.terminal_id }}">@{{ terminal.name }}</span>
                                    <input type="text" class="form-control terminal-name-update terminal-update-field" terminal_id="@{{ terminal.terminal_id }}" value="@{{ terminal.name }}" style="display: none;">
                                </a>
                            </div>
                            <div style="display: none; margin-top: 10px;" class="alert alert-danger terminal-error-message" terminal_id="@{{ terminal.terminal_id }}"></div>
                            <div class="terminal-buttons" style="display: none">
                                <button type="button" class="edit-terminal-button btn btn-default" terminal_id="@{{ terminal.terminal_id }}" ng-click="editTerminal($event, terminal.terminal_id)" title="Edit Terminal">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    Rename
                                </button>
                                <button type="submit" class="update-terminal-button btn btn-success" terminal_id="@{{ terminal.terminal_id }}" style="display: none;" title="Submit">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>
                                    Submit
                                </button>
                                <button type="button" class="delete-terminal-button btn btn-default" ng-click="deleteTerminal($event, terminal.terminal_id)" title="Delete Terminal">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    Remove
                                </button>
                                <div id="terminal-colors" class="clearfix">
                                    <div class="dropdown">
                                        <button id="btn-terminal-color-@{{ terminal.terminal_id }}" class="text-center btn btn-md btn-primary t-btn dropdown-toggle @{{ terminal.color }}" type="button" data-toggle="dropdown" aria-expanded="false">
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
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </td>
            <td width="40%">
                <div class="col-md-12" ng-if="terminal.users.length < business_features.terminal_users">
                    <ul class="list-group">
                        <li class="list-group-item" ng-repeat="user in terminal.users">
                            <span class="glyphicon glyphicon-user"></span>
                            <span class="terminal_user" style="margin-left:10px;">@{{ user.first_name + ' ' + user.last_name }}</span>
                            <a href="" class="pull-right" ng-click="unassignFromTerminal(user.user_id, user.terminal_id)" title="Remove Terminal User"><span class="glyphicon glyphicon-remove"></span></a>
                        </li>
                        <li class="list-group-item clearfix">
                            <form ng-submit="emailSearch(search_user, terminal.terminal_id)">
                                <div class="input-group">
                                    <span class="input-group-addon glyphicon glyphicon-user" style="top: 0px;"></span>
                                    <input type="text" class="form-control mb0" ng-model="search_user" placeholder="Add new user">
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>

        <tr ng-if="service.terminals.length < business_features.max_terminals">
            <td colspan="2" class="text-left">
                <div class=" block mt10 mb10">
                    <a href="" id="" class="btn-boxy btn-xs btn-orange btn-addterminal"><span class="glyphicon glyphicon-plus"></span> Add Terminal</a>
                    <form class="inputterminal-form" ng-submit="createTerminal(service.service_id)" style="display: none">
                        <div class="inputterminal">
                            <div class="col-md-6">
                                <input type="text" class="form-control" ng-model="add_terminal.terminal_name" placeholder="Terminal Name">
                                <div style="display: none; margin-top: 10px;" class="alert alert-danger terminal-error-msg"></div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-lg btn-success" title="Save">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>
                                    Save
                                </button>
                                <button type="button" class="btn btn-lg btn-default cancel-add-terminal" title="Cancel">
                                    <span class="glyphicon glyphicon-remove"></span>
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="alert alert-danger" id="terminal-delete-error" ng-show="terminal_delete_error"> @{{ terminal_delete_error }}</div>
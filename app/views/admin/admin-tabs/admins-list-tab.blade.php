<div class="form-group">
    <form ng-submit="addAdmin(admin_email)">
        <div class="col-md-10">
            <input class="form-control" type="email" required ng-model="admin_email">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-lg btn-blue">Add</button>
        </div>
    </form>
</div>
<div class="form-group">
    <div class="col-md-12">
        <h3><span class="glyphicon glyphicon-refresh" ng-click="getAdmins($event)" style="cursor: pointer"></span> List of Admin Emails: </h3>
        <div class="clearfix">
            <table id="admin-list" class="table table-striped table-hover table-condensed">
                <tr ng-repeat="email in admins">
                    <td><span class="title">@{{ email }}</span></td>
                    <td class="text-right">
                        <a class="btn btn-md btn-danger" href="#" ng-click="removeAdmin(email, $event)">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a></td>
                </tr>
            </table>

        </div>
    </div>
</div>
<div class="form-group">
    <form ng-submit="addAdmin(admin_email)">
        <div class="col-md-11">
            <input class="form-control" type="email" required ng-model="admin_email">
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-lg btn-blue">Add</button>
        </div>
    </form>
</div>
<div class="form-group">
    <div class="col-md-11">
        <h5><span class="glyphicon glyphicon-refresh" ng-click="getAdmins($event)" style="cursor: pointer"></span> List of Admin Emails: </h5>
        <div class="row">
            <div class="col-lg-3" ng-repeat="email in admins">
                <p>
                    <a class="label label-danger" href="#" ng-click="removeAdmin(email, $event)">X</a>
                    <span class="title">@{{ email }}</span>
                </p>
            </div>
        </div>
    </div>
</div>

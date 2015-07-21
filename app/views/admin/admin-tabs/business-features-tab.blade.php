<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" ng-if="messages.error_message != '' && messages.error_message != undefined">@{{ messages.error_message }}</div>
            <div class="alert alert-success" ng-if="messages.success_message != '' && messages.success_message != undefined">@{{ messages.success_message }}</div>
        </div>
        <div class="col-md-12">
            <div>
                <h4>Business:</h4>
            </div>
            <select id="business-dropdown" class="form-control" ng-model="business_id">
                <option ng-repeat="business in all_businesses" value="@{{ business.business_id }}" ng-click="getBusinessFeatures(business.business_id)">@{{ business.name }}</option>
            </select>
        </div>
        <div class="col-md-12">
            <form id="features-form" ng-submit="saveBusinessFeatures(business_id)">
                <div class="form-group col-md-2">
                    Terminal Users :
                    <input class="form-control" type="text" ng-model="business_features.terminal_users" />
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

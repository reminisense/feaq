<div class="container">
    <div class="row">
        <div class="col-md-12 mb20">
            <div>
                <h4>Business:</h4>
            </div>
            <select id="business-dropdown" class="form-control" ng-model="business_id" ng-change="getBusinessFeatures(business_id)">
                <option selected disabled value="">Select a Business</option>
                <option ng-repeat="business in all_businesses" value="@{{ business.business_id }}" ng-click="getBusinessFeatures(business.business_id)">@{{ business.name }}</option>
            </select>
        </div>
        <div class="col-md-12">
            <form id="features-form" ng-submit="saveBusinessFeatures(business_id)">
                <div class="col-md-12">
                    <div class="form-group col-md-2">
                        Terminal Users :
                    </div>
                    <div class="form-group col-md-2">
                        <input class="form-control" type="text" ng-model="business_features.terminal_users" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group col-md-2">
                        SMS :
                    </div>
                    <div class="form-group col-md-2">
                        <br/><input type="radio" ng-model="business_features.allow_sms" value="false"/> No
                        <br/><input type="radio" ng-model="business_features.allow_sms" value="true"/> Yes
                    </div>
                </div>
                <div class="col-md-12 mb20">
                    <button class="btn btn-primary">Submit</button>
                </div>
                <div class="col-md-12">
                    <div class="alert alert-danger" ng-if="messages.error_message != '' && messages.error_message != undefined">@{{ messages.error_message }}</div>
                    <div class="alert alert-success" ng-if="messages.success_message != '' && messages.success_message != undefined">@{{ messages.success_message }}</div>
                </div>
            </form>
        </div>
    </div>
</div>

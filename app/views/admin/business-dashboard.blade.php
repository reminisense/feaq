<html>
<head>
    <title>Business Dashboard</title>
    <script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script>
        var app = angular.module('FeatherQ', []);
        app.controller('searchBusinessCtrl', function($scope, $http) {
            $scope.searchBusiness = function() {
                $scope.businesses = new Array();
                $http.post('/admin/business-search', {
                    "keyword": $scope.business_name
                }).success(function(response) {
                    console.log(response);
                    for (var i = 0; i < response.length; i++) {
                        $scope.businesses.push({
                            "business_id": response[i].business_id,
                            "business_name": response[i].name
                        });
                    }
                });
            };
            $scope.manageBusiness = function(business_id) {
                $http.get('/admin/business-details/' + business_id).success(function(response) {
                    console.log(response);
                    $scope.businessObj = response;
                    $scope.edit_business_id = response.business_id;
                    $scope.edit_name = response.business_name;
                    $scope.edit_address = response.business_address;
                    $scope.edit_industry = response.industry;
                    $scope.edit_timezone = response.timezone;
                    $scope.edit_time_open = response.time_open;
                    $scope.edit_time_close = response.time_closed;
                    $scope.vanity_url = response.vanity_url;
                    $scope.package_type = response.business_features.package_type;
                    $scope.max_services = response.business_features.max_services;
                    $scope.max_terminals = response.business_features.max_terminals;
                    $scope.enable_video_ads = response.business_features.enable_video_ads;
                    $scope.upload_size_limit = response.business_features.upload_size_limit;
                });
            }
            $scope.updateBusiness = function() {
                var data = $scope.businessObj;
                data.business_id = $scope.edit_business_id;
                data.business_name = $scope.edit_name;
                data.business_address = $scope.edit_address;
                data.industry = $scope.edit_industry;
                data.time_open = $scope.edit_time_open;
                data.time_close = $scope.edit_time_close;
                data.timezone = $scope.edit_timezone;
                data.vanity_url = $scope.vanity_url;
                data.business_features.package_type = $scope.package_type;
                data.business_features.max_services = $scope.max_services;
                data.business_features.max_terminals = $scope.max_terminals;
                data.business_features.enable_video_ads = $scope.enable_video_ads;
                data.business_features.upload_size_limit = $scope.upload_size_limit;
                $http.post('/admin/update-business', data).success(function(response) {
                    console.log(response);
                    alert('updated');
                });
            }
        });
    </script>
</head>
<body ng-app="FeatherQ">
    <div ng-controller="searchBusinessCtrl">
        <form ng-submit="searchBusiness()">
            Business Name: <input type="text" ng-model="business_name"/>
            <button type="submit">Search</button>
        </form>
        <br><br>
        <div class="biz-results">
            <div ng-repeat="business in businesses">
                <span class="biz-name">@{{ business.business_name }}</span>
                <a href="#" class="biz-manage" ng-click="manageBusiness(business.business_id)">Manage</a>
            </div>
        </div>
        <br><br>
        <div>
            <form ng-submit="updateBusiness()">
                <input type="hidden" ng-model="edit_business_id" value="@{{ edit_business_id }}">
                Business Name: <input type="text" ng-model="edit_name" /><br>
                Address: <input type="text" ng-model="edit_address" /><br>
                Industry: <input type="text" ng-model="edit_industry" /><br>
                Timezone: <input type="text" ng-model="edit_timezone" /><br>
                Time Open: <input type="text" ng-model="edit_time_open" /><br>
                Time Close: <input type="text" ng-model="edit_time_close" /><br>
                <br>
                Contract: <select ng-model="package_type" ng-init="package_type">
                    <option value="Trial">Trial</option>
                    <option value="Basic">Basic</option>
                    <option value="Plus">Plus</option>
                    <option value="Pro">Pro</option>
                </select><br>
                <br>
                Max Services: <input type="text" ng-model="max_services" /><br>
                Max Terminals: <input type="text" ng-model="max_terminals" /><br>
                <br>
                Enable Video Ads? <label><input type="radio" name="video_ads" ng-model="enable_video_ads" value="1">Yes</label> <label><input type="radio" name="video_ads" ng-model="enable_video_ads" value="0">No</label><br>
                <br>
                Video Ad Limits:<br>
                Upload limit: <input type="text" ng-model="upload_size_limit" /> MB<br>
                <br>
                Vanity URL: <input type="text" ng-model="vanity_url" /><br>
                <br>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</body>
</html>
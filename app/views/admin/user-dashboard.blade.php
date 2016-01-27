<html>
<head>
    <title>User Dashboard</title>
    <script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script>
        var app = angular.module('FeatherQ', []);
        app.controller('userListCtrl', function($scope, $http) {
            $scope.manageUser = function(user_id) {
                $http.get('/admin/user-details/' + user_id).success(function(response) {
                    console.log(response);
                    $scope.user_id = response.user_id;
                    $scope.email = response.email;
                    $scope.first_name = response.first_name;
                    $scope.last_name = response.last_name;
                    $scope.phone = response.phone;
                    $scope.status = response.status;
                    $scope.address = response.address;
                });
            };
            $scope.updateUser = function() {
                $http.post('/admin/update-user', {
                    user_id: $scope.user_id,
                    edit_first_name: $scope.first_name,
                    edit_last_name: $scope.last_name,
                    edit_mobile: $scope.phone,
                    edit_user_location: $scope.address,
                    status: $scope.status
                }).success(function(response) {
                    alert('updated');
                });
            };
        });
    </script>
</head>
<body ng-app="FeatherQ">
<div ng-controller="userListCtrl">
    <div class="user-list">
        @foreach ($users as $count => $data)
            <div>
                <span class="user-name">{{ $data->first_name }} {{ $data->last_name }} | {{ $data->email }}</span>
                <a href="#" class="user-manage" ng-click="manageUser({{ $data->user_id }})">Manage</a>
            </div>
        @endforeach
    </div>
    <br><br>
    <div>
        <form ng-submit="updateUser()">
            <input type="hidden" ng-model="user_id" value="{{ $user_id }}">
            First Name: <input type="text" ng-model="first_name" /><br>
            Last Name: <input type="text" ng-model="last_name" /><br>
            Address: <input type="text" ng-model="address" /><br>
            Email: <input type="text" ng-model="email" /><br>
            Phone: <input type="text" ng-model="phone" /><br>
            <br>
            Status: <label><input type="radio" name="status" ng-model="status" value="1">Enabled</label> <label><input type="radio" name="status" ng-model="status" value="0">Disabled</label><br>
            <br>
            <button type="submit">Save</button>
        </form>
    </div>
</div>
</body>
</html>
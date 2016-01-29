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
                    $scope.edit_email = response.email;
                    $scope.edit_first_name = response.first_name;
                    $scope.edit_last_name = response.last_name;
                    $scope.edit_mobile = response.phone;
                    $scope.edit_status = response.status;
                    $scope.edit_user_location = response.address;
                });
            };
            $scope.updateUser = function(user_id) {
                $http.post('/admin/update-user', {
                    user_id: user_id,
                    edit_first_name: $scope.edit_first_name,
                    edit_last_name: $scope.edit_last_name,
                    edit_mobile: $scope.edit_mobile,
                    edit_user_location: $scope.edit_user_location,
                    edit_status: $scope.edit_status,
                    edit_email: $scope.edit_email
                }).success(function(response) {
                    alert('updated');
                });
            };
            $scope.createUser = function() {
                if ($scope.new_password == $scope.password_confirm) {
                    $http.post('/admin/create-user', {
                        email: $scope.create_email,
                        password: $scope.new_password,
                        password_confirm: $scope.password_confirm,
                        create_first_name: $scope.create_first_name,
                        create_last_name: $scope.create_last_name,
                        create_mobile: $scope.create_mobile,
                        create_user_location: $scope.create_user_location,
                        create_gender: $scope.create_gender
                    }).success(function (response) {
                        alert('created');
                    });
                }
                else {
                    alert('passwords do not match');
                }
            };
            $scope.resetPass = function(user_id) {
                $http.post('/admin/reset-password', {
                    user_id: user_id
                }).success(function(response) {
                    alert(response.password);
                });
            }
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
        Manage User<br>
        <form ng-submit="updateUser(user_id)">
            First Name: <input type="text" ng-model="edit_first_name" /><br>
            Last Name: <input type="text" ng-model="edit_last_name" /><br>
            Address: <input type="text" ng-model="edit_user_location" /><br>
            Email: <input type="text" ng-model="edit_email" /><br>
            Phone: <input type="text" ng-model="edit_mobile" /><br>
            <button type="button" ng-click="resetPass(user_id)">Reset Password</button><br>
            <br>
            Status: <label><input type="radio" name="edit_status" ng-model="edit_status" value="1">Enabled</label> <label><input type="radio" name="edit_status" ng-model="edit_status" value="0">Disabled</label><br>
            <br>
            <button type="submit">Save</button>
        </form>
    </div>
    <br><br>
    <div>
        Create User<br>
        <form ng-submit="createUser()">
            Email: <input type="text" ng-model="create_email" /><br>
            Password: <input type="password" ng-model="new_password" /><br>
            Confirm Password: <input type="password" ng-model="password_confirm" /><br>
            First Name: <input type="text" ng-model="create_first_name" /><br>
            Last Name: <input type="text" ng-model="create_last_name" /><br>
            Gender: <select ng-model="create_gender" ng-init="create_gender='male'">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select><br>
            Address: <input type="text" ng-model="create_user_location" /><br>
            Phone: <input type="text" ng-model="create_mobile" /><br>
            <br>
            <button type="submit">Save</button>
        </form>
    </div>
</div>
</body>
</html>
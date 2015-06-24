<div class="form-group">
    <form>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-1"><h5>User: </h5></div>
                            <div class="col-md-11">
                                <input class="form-control" type="text" ng-model="feathercash_user" ng-change="userSearch(feathercash_user)" ng-model="feathercash_user" ng-model-options="{debounce: 1000}" autocomplete="off" outside-click="users = []">
                                <ul class="dropdown-menu" role="menu" ng-show="users.length != 0" id="search-suggest" style="display: block">
                                    <li ng-repeat="user in users">
                                        <a href="#" ng-click="setUserId(user.user_id, user.first_name, user.last_name)">@{{ user.first_name + ' ' + user.last_name }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="well well-lg">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="col-md-5"><h5>User ID:</h5></div>
                                    <div class="col-md-5"><h5>@{{ feathercash_user_id }}</h5></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-5"><h5>First Name:</h5></div>
                                    <div class="col-md-5"><h5>@{{ account.first_name }}</h5></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-5"><h5>Last Name:</h5></div>
                                    <div class="col-md-5"><h5>@{{ account.last_name }}</h5></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-5"><h5>Email:</h5></div>
                                    <div class="col-md-5"><h5>@{{ account.email }}</h5></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-5"><h5>Current Amount: </h5></div>
                                    <div class="col-md-5"><h5>@{{ account.current_amount }}</h5></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="col-md-2"><h5>Amount: </h5></div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" ng-model="feathercash_amount">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2"><h5>Description: </h5></div>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" ng-model="feathercash_description">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2"><h5>Actions: </h5></div>
                                    <div class="col-md-10">
                                        <button class="btn btn-lg btn-blue" type="submit" ng-click="addFeatherCash(feathercash_user_id, feathercash_amount, feathercash_description)">
                                            <span class="glyphicon glyphicon-plus-sign"></span> Add
                                        </button>
                                        <button class="btn btn-lg btn-danger" type="button" ng-click="subtractFeatherCash(feathercash_user_id, feathercash_amount, feathercash_description)">
                                            <span class="glyphicon glyphicon-minus-sign"></span> Subtract
                                        </button>
                                        <button class="btn btn-lg btn-gray" type="reset">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
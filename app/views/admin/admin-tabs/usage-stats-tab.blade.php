<div class="form-group">
    <div class="col-md-10">
        <input type="hidden" id="user_id" value="{{ $user_id }}">
        <select class="form-control" id="keyword" ng-model="keyword">
            <option ng-repeat="keyword in keywords" value="@{{ keyword.keyword }}">@{{ keyword.name }}</option>
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary" ng-click="loadChart()">Load Chart</button>
    </div>
    <div class="col-md-12">
        <div id="statChart" style="min-height: 477px;"></div>
    </div>
</div>

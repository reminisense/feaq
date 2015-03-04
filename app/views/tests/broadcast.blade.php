<html>
<head>
    <title>Broadcast Settings</title>
    {{ HTML::script('js/jquery1.11.0.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/wow.min.js') }}
    {{ HTML::script('js/custom.js') }}
    {{ HTML::script('js/angular.js') }}
    {{ HTML::script('js/ngFeatherQ.js') }}
    {{ HTML::script('js/ngFacebook.js') }}
    {{ HTML::script('js/ngAutocomplete.js') }}
    {{ HTML::script('js/dashboard/search-business.js') }}
    {{ HTML::script('js/dashboard/edit-business.js') }}
</head>
<body ng-app="FeatherQ">
    <div id="business-id" business_id="{{ $business_id }}"></div>
    <div ng-controller="broadcastDisplayController">
        <div>
            1 Ad, 1 Num <button type="button" ng-click="activateTheme('1-1')" id="1ad-1num" class="1-1">Activate</button>
        </div>
        <div>
            1 Ad, 4 Num <button type="button" ng-click="activateTheme('1-4')" id="1ad-4num" class="1-4">Activate</button>
        </div>
        <div>
            1 Ad, 6 Num <button type="button" ng-click="activateTheme('1-6')" id="1ad-6num" class="1-6">Activate</button>
        </div>
        <div>
            1 Num <button type="button" ng-click="activateTheme('0-1')" id="1num" class="0-1">Activate</button>
        </div>
        <div>
            4 Num <button type="button" ng-click="activateTheme('0-4')" id="4num" class="0-4">Activate</button>
        </div>
        <div>
            6 Num <button type="button" ng-click="activateTheme('0-6')" id="6num" class="0-6">Activate</button>
        </div>
    </div>
</body>
</html>
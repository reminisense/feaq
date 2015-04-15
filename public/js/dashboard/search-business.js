(function() {

    app.controller('searchBusinessCtrl', function($scope, $http) {

        $scope.location_filter = 'Location';
        $scope.industry_filter = 'Industry';
        $scope.searchLabel = 'POPULAR BUSINESSES';
        $scope.businesses = [];

        $scope.searchBusiness = (function(location, industry) {
            var keyword = document.getElementById('search-keyword').value;
            var time_open = document.getElementById('time_open-filter').value;
            $http.post('/business/filter-search', {
                "keyword": keyword,
                "country": location,
                "industry": industry,
                "time_open": time_open
            }).success(function(response) {
                $('#popular-businesses').hide();
                $scope.businesses = new Array();
                $scope.searchLabel = 'SHOWING RESULTS '+response.length+' OF '+response.length;
                for (var i = 0; i < response.length; i++) {
                    $scope.businesses.push({
                        "business_id": response[i].business_id,
                        "business_name": response[i].business_name,
                        "local_address": response[i].local_address
                    });
                }

            });
        });

        $scope.locationFilter = (function(location) {
            $scope.location_filter = location;
        });

        $scope.industryFilter = (function(industry) {
            $scope.industry_filter = industry;
        });

    });

})();
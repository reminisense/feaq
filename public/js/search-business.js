/**
 * Created by JONAS on 3/4/2015.
 */
(function() {

    app.controller('searchBusinessCtrl', function($scope, $http) {

        $scope.location_filter = 'Location';
        $scope.industry_filter = 'Industry';

        $scope.searchBusiness = (function(location, industry) {

            var keyword = document.getElementById('search-keyword').value;
            var time_open = document.getElementById('time_open-filter').value;
            $http.post('/business/filter-search', {
                "keyword": keyword,
                "country": location,
                "industry": industry,
                "time_open": time_open
            }).success(function(response) {
                $('.active-businesses').hide();
                $scope.businesses = new Array();
                for (var i = 0; i < response.length; i++) {
                    $scope.businesses.push({
                        "business_id": response[i].business_id,
                        "business_name": response[i].business_name,
                        "local_address": response[i].local_address
                    });
                }
                $('.new-businesses').hide();
                $('#business-search').show();
                $scope.searchLabel= 'SHOWING RESULTS '+response.length+' OF '+response.length;

            });
        });

        $scope.locationFilter = (function(location) {
            $scope.location_filter = location;
        });

        $scope.industryFilter = (function(industry) {
            $scope.industry_filter = industry;
        });

    });

    $('#btnTimeOpen').click(function (){
        if ($('#time_open-filter').is(':hidden')) {
            $('#time_open-filter').show();
            $(this).hide();
        }
    });
    $('#time_open-filter').focusout(function () {

    });

})();
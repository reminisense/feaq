/**
 * Created by JONAS on 3/4/2015.
 */
(function() {
    app.controller('searchBusinessCtrl', function($scope, $http) {
        jQuery.ajax({
            url: '//freegeoip.net/json/',
            type: 'POST',
            dataType: 'jsonp',
            success: function(location) {
                $scope.location_filter = location.country_name;
            }
        });

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
                $('#biz-grid').hide();
                $scope.businesses = new Array();
                var length_limit = 7;
                for (var i = 0; i < response.length; i++) {
                    $scope.businesses.push({
                        "business_id": response[i].business_id,
                        "business_name": response[i].business_name,
                        "local_address": response[i].local_address,
                        "time_open" : response[i].time_open,
                        "time_close": response[i].time_close
                    });
                    if(i == length_limit - 1) break;
                }

                if(response.length <= length_limit){
                    length_limit = response.length;
                }
                $scope.searchLabel= 'Showing Top '+ length_limit +' Result(s)';
                $('#search-grid').show();
            });
        });

        $scope.locationFilter = (function(location) {
            $scope.location_filter = location;
        });

        $scope.industryFilter = (function(industry) {
            $scope.industry_filter = industry;
        });

        $('#btnTimeOpen').on('click', function (e){
            if ($('#time_open-filter').is(':hidden')) {
                $('#time_open-filter').show();
                $('#time_open-filter').timeEntry({
                    ampmPrefix: ' ',
                    spinnerImage: ''
                });
                e.preventDefault();
                $('#time_open-filter').focus();
                $(this).hide();
            }
        });

        $('#time_open-filter').focusout(function () {
            if ($(this).val() == ''){
                $(this).hide();
                $('#btnTimeOpen').show();
            }
        });
    });
})();
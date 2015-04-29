var app = angular.module('FeatherQ', ['Facebook', 'ngAutocomplete']);

//ARA run history tracker
app.run(function($http){
    navigator.geolocation.getCurrentPosition(function(position){
        getData(position);
    });
    var getData = function(position){
        $http.post('/history/log-visit/',
            {
                page_url: window.location.href,
                latitude: position.coords.latitude,
                longitude: position.coords.longitude
            }).success(function(response){
                console.log('id = ' + response.log_id);
            });
    };
});
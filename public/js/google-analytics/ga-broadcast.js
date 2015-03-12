/**
 * Created by USER on 3/12/15.
 */
google_analytics.load();
google_analytics.create();
var page = window.location.href;
var url_array = page.split('/');
var business_id = url_array[url_array.length - 1];
var request_url = '/business/businessdetails/' + business_id;

$.get(request_url, function(response){}).done(function(response){
    var result = jQuery.parseJSON(response);
    var business_name = 'broadcast: ' + result.business.business_name ;
    console.log(business_name);
    google_analytics.send(window.location.href, business_name);
});
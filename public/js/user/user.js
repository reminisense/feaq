($(document).ready(function() {
    $.post('/user/verify', {
        'first_name' : $('#first_name'),
        'last_name' : $('#last_name'),
        'email' : $('#email'),
        'mobile' : $('#mobile'),
        'location' : $('location')
    }, function(){

    }).success(function(){

    });

    $.post('/business/setup', {
        'business_name' : $('#business_name'),
        'address' : $('#business_address'),
        'time_open' : $('#time_open'),
        'time_close' : $('#time_close'),
        'industry' : $('#industry'),
        'queue_number_limit' : $('#queue_number_limit')
    }, function(){

    }).success(function(){

    });
}));
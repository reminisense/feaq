/**
 * Created by carlo on 1/29/15.
 */
$(document).ready(function(){
    $('input.timepicker').timepicker({});


    var user_location = document.getElementById('user_location');
    var business_location = document.getElementById('business_location');
    var options = {
        componentRestrictions: {country: 'ph'}
    };

    var autocomplete = new google.maps.places.Autocomplete(user_location, options);
    var autocomplete = new google.maps.places.Autocomplete(business_location, options);

    $.get('/user/user-status', function(){

    }).success(function(data){
        var jsonData = jQuery.parseJSON(data);
        $('.user_id').val(jsonData.user.user_id);
        if (jsonData.success == 1 && jsonData.user.verified == ''){
            $('#first_name').val(jsonData.user.first_name);
            $('#last_name').val(jsonData.user.last_name);
            $('#email').val(jsonData.user.email);
            $('#mobile').val(jsonData.user.phone);
            $('#user_location').val(jsonData.user.local_address);
            $('#verifyUser').modal('show');
            $('#verifyUser').prepend('<div class="modal-backdrop fade in" style="height: ' + $( window ).height() + 'px"></div>');
        }
    });

    $('#start_queuing').on('click', function(){
        $.ajax({
            url: $('#verification_form').attr('action'),
            type: 'POST',
            dataType: 'text json',
            data: $('#verification_form').serialize(),
            success: function(response){
                $('#verifyUser').modal('hide');
                $('#setupBusiness').modal();
                $('#setupBusiness').prepend('<div class="modal-backdrop fade in" style="height: ' + $( window ).height() + 'px"></div>');
            }
        });
    });

    $('#submit_business').on('click', function(){
        $.ajax({
            url: $('#add_business_form').attr('action'),
            type: 'POST',
            dataType: 'text json',
            data: $('#add_business_form').serialize(),
            success: function(response){
                $('#setupBusiness').modal('hide');
                window.location.href = '/';
            }
        });
    });

    $('#add_business').on('click', function(){
        $('#add_business_header').html('Add a Business');
        $('#add_business_form').attr('action', '/business/add-business');
        $('#skip_step_link').remove();
        $('#setupBusiness').modal('show');
        $('#setupBusiness').prepend('<div class="modal-backdrop fade in" style="height: ' + $( window ).height() + 'px"></div>');
    });

});
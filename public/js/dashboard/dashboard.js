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
        var errorMessage = '';
        if ($('#first_name').val() == ""){
            errorMessage = "First Name field is required. ";
        }

        if ($('#last_name').val() == ""){
            errorMessage = errorMessage + "Last Name field is required. ";
        }

        if ($('#email').val() == ""){
            errorMessage = errorMessage + "Email field is required. ";
        }

        if ($('#mobile').val() == "" || $('#mobile').val() == "0"){
            errorMessage = errorMessage + "Mobile field is required. ";
        }

        if ($('#user_location').val() == ""){
            errorMessage = errorMessage + "Location field is required. ";
        }

        if (!isEmail($('#email').val())){
            errorMessage = errorMessage + "Invalid Email field input. ";
        }

        if (errorMessage == ""){
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
        } else {
            $('#verifyError').text(errorMessage);
            $('#verifyError').fadeIn( 400 );
        }
    });

    $('#submit_business').on('click', function(){
        var errorMessage = '';
        if ($('#business_name').val() == ""){
            errorMessage = "Business Name field is required. ";
        }

        if ($('#business_location').val() == ""){
            errorMessage = errorMessage + "Business Address field is required. ";
        }

        if ($('#time_open').val() == ""){
            errorMessage = errorMessage + "Time Open field is required. ";
        } else if (!isValidTime($('#time_open').val())) {
            errorMessage = errorMessage + "Invalid Time Open field input. ";
        }

        if ($('#time_close').val() == ""){
            errorMessage = errorMessage + "Time Close field is required. ";
        } else if (!isValidTime($('#time_close').val())) {
            errorMessage = errorMessage + "Invalid Time Open field input. ";
        }

        if ($('#industry').val() == ""){
            errorMessage = errorMessage + "Industry field is required. ";
        }

        if ($('#num_terminals').val() == ""){
            errorMessage = errorMessage + "Terminal Number field is required. ";
        }

        if ($('#queue_limit').val() == ""){
            errorMessage = errorMessage + "Queue Number Limit field is required. ";
        } else if (!$.isNumeric($('#queue_limit').val())){
            errorMessage = errorMessage + "Invalid Queue Limit field input. ";
        } else if ($('#queue_limit').val() < 0 && $.isNumeric($('#queue_limit').val())){
            errorMessage = errorMessage + "Invalid Queue Limit field input. ";
        }

        if (errorMessage == ""){
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
        } else {
            $('#setupError').text(errorMessage);
            $('#setupError').fadeIn( 400 );
        }

    });

    $('#add_business').on('click', function(){
        $('#add_business_header').html('Add a Business');
        $('#skip_step_link').remove();
        $('#setupBusiness').modal('show');
        $('#setupBusiness').prepend('<div class="modal-backdrop fade in" style="height: ' + $( window ).height() + 'px"></div>');
        $('#add_business_cloase').css('display', 'block');
    });

    $("#mobile").intlTelInput();

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function isValidTime(time){
        var regex = /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/;
        return regex.test(time);
    }

});
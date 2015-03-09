/**
 * Created by carlo on 1/29/15.
 */
$(document).ready(function(){
    $('input.timepicker').timepicker({});

    $("#user_location").geocomplete();
    $("#business_location").geocomplete();
    $("#edit_business_address").geocomplete();
    $("#edit_user_location").geocomplete();

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
            $('#verifyUser').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    });

    $('#start_queuing').on('click', function(){
        $(this).attr('disabled', '');
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

        if (!isValidPhone($('#mobile').val()) && ($('#mobile').val() != 0 || $('#mobile').val() == '')){
            errorMessage = errorMessage + "Mobile field is required. ";
        }

        if ($('#user_location').val() == ""){
            errorMessage = errorMessage + "Location field is required. ";
        }

        if (!isEmail($('#email').val())){
            errorMessage = errorMessage + "Invalid Email field input. ";
        }

        if (errorMessage == ""){
            $('#start_queuing').html('PROCESSING... &nbsp;<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>');
            $.ajax({
                url: $('#verification_form').attr('action'),
                type: 'POST',
                dataType: 'text json',
                data: $('#verification_form').serialize()
            }).done(function(){
                $('#start_queuing').removeAttr('disabled');
                $('#start_queuing').html('START QUEUING');
                $('#verifyUser').modal('hide');
                location.reload();
            });
        } else {
            $('#start_queuing').removeAttr('disabled');
            $('#verifyError').text(errorMessage);
            $('#verifyError').fadeIn( 400 );
        }
    });

    $('#update_profile_button').on('click', function(){
        $(this).attr('disabled', '');
        var errorMessage = '';
        if ($('#edit_first_name').val() == ""){
            errorMessage = "First Name field is required. ";
        }

        if ($('#edit_last_name').val() == ""){
            errorMessage = errorMessage + "Last Name field is required. ";
        }

        if (!isValidPhone($('#edit_mobile').val()) && ($('#edit_mobile').val() != 0 || $('#edit_mobile').val() == '')){
            errorMessage = errorMessage + "Mobile field is required. ";
        }

        if ($('#edit_user_location').val() == ""){
            errorMessage = errorMessage + "Location field is required. ";
        }

        if (errorMessage == ""){
            $.ajax({
                url: $('#update_user_form').attr('action'),
                type: 'POST',
                dataType: 'text json',
                data: $('#update_user_form').serialize()
            }).done(function(response){
                $('#update_profile_button').removeAttr('disabled');
                if(response.success == 1){
                    if ($('#profile_update_message').hasClass('alert-danger')){
                        $('#profile_update_message').removeClass('alert-danger');
                        $('#profile_update_message').addClass('alert-success');
                        $('#profile_update_message').text("Your profile has been successfully updated!");
                    }
                    $('#profile_update_message').text("Your profile has been successfully updated!");
                } else {
                    if ($('#profile_update_message').hasClass('alert-success')){
                        $('#profile_update_message').removeClass('alert-success');
                        $('#profile_update_message').addClass('alert-danger');
                    }
                    $('#profile_update_message').text(response.error);
                }
                $('#profile_update_message').fadeIn( 400 );
                setTimeout(function(){ $('#profile_update_message').fadeOut(); }, 3000);
            });
        } else {
            $('#update_profile_button').removeAttr('disabled');
            if ($('#profile_update_message').hasClass('alert-success')){
                $('#profile_update_message').removeClass('alert-success');
                $('#profile_update_message').addClass('alert-danger');
            }
            $('#profile_update_message').text(errorMessage);
            $('#profile_update_message').fadeIn( 400 );
            setTimeout(function(){ $('#profile_update_message').fadeOut(); }, 3000);
        }
    });

    $('#submit_business').on('click', function(){
        $(this).attr('disabled', '');
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
            errorMessage = errorMessage + "Invalid Time Open input value. ";
        }

        if ($('#time_close').val() == ""){
            errorMessage = errorMessage + "Time Close field is required. ";
        } else if (!isValidTime($('#time_close').val())) {
            errorMessage = errorMessage + "Invalid Time Close input value. ";
        }

        if ($('#industry').val() == 0){
            errorMessage = errorMessage + "Industry field is required. ";
        }

        if (errorMessage == ""){
            $('#submit_business').html('SUBMITTING... &nbsp;<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>');
            $.ajax({
                url: $('#add_business_form').attr('action'),
                type: 'POST',
                dataType: 'text json',
                data: $('#add_business_form').serialize()
            }).done(function(response){
                $('#submit_business').removeAttr('disabled');
                $('#submit_business').html('SUBMIT');
                if(response.success == 1){
                    var terminal = response.terminals[0];
                    $('#setupBusiness').modal('hide');
                    window.location.href = "/processqueue/terminal/" + terminal.terminal_id;
                } else {
                    $('#setupError').text(response.error);
                    $('#setupError').fadeIn( 400 );
                    setTimeout(function(){ $('#setupError').fadeOut(); }, 3000);
                }
            });
        } else {
            $('#submit_business').removeAttr('disabled');
            $('#setupError').text(errorMessage);
            $('#setupError').fadeIn( 400 );
            setTimeout(function(){ $('#setupError').fadeOut(); }, 3000);
        }
    });

    $('#add_business').on('click', function(){
        $('#add_business_header').html('Add a Business');
        $('#skip_step_link').remove();
        $('#setupBusiness').modal('show');
        $('#add_business_cloase').css('display', 'block');
    });

    $('#edit_profile').on('click', function(){
        $.get('/user/user-status', function(){

        }).success(function(data){
            var jsonData = jQuery.parseJSON(data);
            var user = jsonData.user;
            $('.user_id').val(jsonData.user.user_id);
            $('#edit_first_name').val(user.first_name);
            $('#edit_last_name').val(user.last_name);
            $('#edit_email').html(user.email);
            $('#edit_mobile').val(user.phone);
            $('#edit_user_location').val(user.local_address);

            $('#updateUser').modal('show');
        });
    });

    if (!isMobile()){
        $('#edit_business_address').tooltip();
    }

    $("#mobile").intlTelInput({
        defaultCountry: "auto"
    });

    $("#edit_mobile").intlTelInput({
        defaultCountry: "auto"
    });

    $('#mobile').keypress(function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
    });

    $('#edit_mobile').keypress(function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
    });

    function isMobile() {
        try{ document.createEvent("TouchEvent"); return true; }
        catch(e){ return false; }
    }

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function isValidTime(time){
        var regex = /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/;
        return regex.test(time);
    }

    function isValidPhone (txtPhone) {
        var filter = /^[0-9-+]+$/;
        if (filter.test(txtPhone)) {
            return true;
        } else {
            return false;
        }
    }
});
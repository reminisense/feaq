/**
 * Created by carlo on 1/29/15.
 */
$(document).ready(function(){
    $('input.timepicker').timepicker({});

    $("#user_location").geocomplete();
    $("#business_location").geocomplete();
    $("#edit_business_address").geocomplete();

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
            /*$('#verifyUser').modal('show');*/
            /*RBM -modal cannot be escaped*/
            $('#verifyUser').modal({
                backdrop: 'static',
                keyboard: false
            });
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
            $.ajax({
                url: $('#verification_form').attr('action'),
                type: 'POST',
                dataType: 'text json',
                data: $('#verification_form').serialize(),
                success: function(response){
                    $('#verifyUser').modal('hide');
                    location.reload();
                }
            });
        } else {
            $('#verifyError').text(errorMessage);
            $('#verifyError').fadeIn( 400 );
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
            $.ajax({
                url: $('#add_business_form').attr('action'),
                type: 'POST',
                dataType: 'text json',
                data: $('#add_business_form').serialize()
            }).done(function(response){
                $('#submit_business').removeAttr('disabled');
                if(response.success == 1){
                    var terminal = response.terminals[0];
                    $('#setupBusiness').modal('hide');
                    window.location.href = "/processqueue/terminal/" + terminal.terminal_id;
                } else {
                    $('#setupError').text(response.error);
                    $('#setupError').fadeIn( 400 );
                }
            });
        } else {
            $('#submit_business').removeAttr('disabled');
            $('#setupError').text(errorMessage);
            $('#setupError').fadeIn( 400 );
        }

    });

    $('#add_business').on('click', function(){
        $('#add_business_header').html('Add a Business');
        $('#skip_step_link').remove();
        $('#setupBusiness').modal('show');
        $('#add_business_cloase').css('display', 'block');
    });

    if (!isMobile()){
        $('#edit_business_address').tooltip();
    }

    $("#mobile").intlTelInput({
        defaultCountry: "auto"
    });

    $('#mobile').keypress(function(key) {
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
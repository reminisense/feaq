/**
 * Created by carlo on 1/29/15.
 */
$(document).ready(function(){
    $('input.timepicker').timepicker({});


    var input = document.getElementById('location');
    var options = {
        componentRestrictions: {country: 'ph'}
    };

    var autocomplete = new google.maps.places.Autocomplete(input, options);


    $.get('/user/user-status', function(){

    }).success(function(data){
        var jsonData = jQuery.parseJSON(data);
        $('.user_id').val(jsonData.user.user_id);
        if (jsonData.success == 1 && jsonData.user.verified == ''){
            console.log(jsonData.user.user_id);
            $('#first_name').val(jsonData.user.first_name);
            $('#last_name').val(jsonData.user.last_name);
            $('#email').val(jsonData.user.email);
            $('#mobile').val(jsonData.user.phone);
            $('#location').val(jsonData.user.local_address);
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
                $('#addBusiness').modal();
                $('#addBusiness').prepend('<div class="modal-backdrop fade in" style="height: ' + $( window ).height() + 'px"></div>');
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
                console.log(jQuery.parseJSON(response));
                $('#addBusiness').modal('hide');
            }
        });
    });

});
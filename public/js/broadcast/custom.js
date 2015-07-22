function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function isValidPhone (txtPhone) {
    var filter = /^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/i;
    if (filter.test(txtPhone)) {
        return true;
    } else {
        return false;
    }
}

$(document).on('click', '#send-business-message', function(){
    var business_id = $('#business-id').attr('business_id');
    var contname = $('#contactname').val();
    var contemail = $('#contactemail').val();
    var contmobile = $('#contactmobile').val();
    var contmessage = $('#contactmessage').val();
    var contfile = $('#contactfile').val();
    var custom_fields = [];
    var custom_fields_bool = false;

    var errorMessage = '';
    if (!isEmail(contemail)){
        errorMessage += "Invalid user Email input. ";
    }

    if (!isValidPhone(contmobile)){
        errorMessage += "Invalid user Mobile Number input. ";
    }

    if (contname == '' || contemail == '' || contmobile == '' || contmessage == ''){
        errorMessage = "Please input all required fields in the form.";
    }

    if (errorMessage == ''){
        // Get the Values of the Custom Fields
        $.post('/forms/display-fields', {
            business_id : business_id
        }).done(function(response) {
            var result = jQuery.parseJSON(response);
            if (result.form_fields) {
                custom_fields_bool = true;
                $.each(result.form_fields, function(form_id, field_data) {
                    if (field_data.field_type == 'Radio') {
                        custom_fields[form_id] = $('input:radio[name=forms_'+form_id+']:checked').val();
                    }
                    else if (field_data.field_type == 'Checkbox') {
                        custom_fields[form_id] = $('#forms_'+form_id).prop('checked') ? 'Yes' : 'No';
                    }
                    else {
                        custom_fields[form_id] = $('#forms_' + form_id).val();
                    }
                });
            }
            $.post( '/message/sendto-business', {
                business_id: business_id,
                contname: contname,
                contemail: contemail,
                contmobile: contmobile,
                contmessage: contmessage,
                contfile : contfile,
                custom_fields_bool : custom_fields_bool,
                custom_fields : custom_fields
            }).done(function( data ) {
                var resp = jQuery.parseJSON(data);
                if (resp.status > 0){
                    $('#message-notif').removeClass('alert-danger');
                    $('#message-notif').addClass('alert-success');
                    $('#message-notif').html('Message sent! The business will contact you through email or mobile.');
                    $('#message-notif').fadeIn();
                    $('#contactname').val('');
                    $('#contactemail').val('');
                    $('#contactmessage').val('');
                    $('#contactmobile').val('');
                    $('.custom-field').val('');
                    $('[name="contact_business_form"] input:checkbox').removeAttr('checked');
                    $('[name="contact_business_form"] input:radio').removeAttr('checked');
                    $('.custom-dropdown').val('0');
                    $('#contactmessage').attr('placeholder', 'Write your message here...');
                }
            });
        });
    } else {
        $('#message-notif').removeClass('alert-success');
        $('#message-notif').addClass('alert-danger');
        $('#message-notif').html(errorMessage);
        $('#message-notif').fadeIn();
    }

    setTimeout(function(){ $('#message-notif').fadeOut(); }, 3000);
});

/*broadcast - more details*/
$('#btn-bcast-details').click(function () {
  if ( $( '.bcast-details' ).is( ':hidden' ) ) {
     $('.bcast-details').slideDown( 'fast' );
     $('#btn-bcast-details').html("<span class='glyphicon glyphicon-minus'></span>");
  } else {
    $( '.bcast-details' ).slideUp( 'slow' );
    $('#btn-bcast-details').html("<span class='glyphicon glyphicon-plus'></span>");
  } 
});

/*business - show search bar*/
$('.nav-tabs li').click( function () {
  $('.nav-tabs li').removeClass('active');
  $(this).addClass('active');
  if ($(this).hasClass('biz')) {
    $('.filters').slideUp('fast');
  } else {
    $('.filters').slideDown('fast');
  }
});

/*business - show terminals*/
$('.to-terminals').click( function () {
  if ( $('.edit-biz').find( '.biz-terminals' ).is( ':hidden' ) ) {
    $(this).parent().next().slideDown('fast');  
  } else {
    $('.edit-biz').find('.biz-terminals').slideUp('fast');  
  }
  return false;
});
$('html').click(function() {
  $('.biz-terminals').slideUp('fast');
});

$('#pmore-tab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});

$('#btn-addterminal').click(function () {
  $('#inputterminal').show();
  $('#btn-addterminal').hide();
});

$('#editbiz-tabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});
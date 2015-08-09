$(document).on('click', '#send-business-message', function(){
    $('#send-business-message').addClass('disabled');
    var business_id = $('#business-id').attr('business_id');
    var contmessage = $('#contactmessage').val();
    var contfile = $('#contactfile').val();
    var custom_fields = [];
    var custom_fields_bool = false;

    var errorMessage = '';

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
                    $('#contactmessage').val('');
                    $('.custom-field').val('');
                    $('[name="contact_business_form"] input:checkbox').removeAttr('checked');
                    $('[name="contact_business_form"] input:radio').removeAttr('checked');
                    $('.custom-dropdown').val('0');
                    $('#contactmessage').attr('placeholder', 'Write your message here...');
                }
            }).always(function(){
                $('#send-business-message').removeClass('disabled');
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

//ARA prevent sending while uploading
$(document).on('show.bs.modal', '#contact-business-modal', function(){
    var uploadcareWidget = uploadcare.SingleWidget('#contactfile');
    uploadcareWidget.onChange(function(file){
        $('#send-business-message').addClass('disabled');
    }).onUploadComplete(function(file){
        $('#send-business-message').removeClass('disabled');
    });
});

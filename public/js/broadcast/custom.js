function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function isValidPhone (txtPhone) {
    var filter = /^(\+\d{1,3}[- ]?)?\d{11}$/;
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
        $.post( '/message/sendto-business', { business_id: business_id, contname: contname, contemail: contemail, contmobile: contmobile, contmessage: contmessage })
            .done(function( data ) {
                var resp = jQuery.parseJSON(data);
                if (resp.status > 0){
                    $('#message-notif').removeClass('alert-danger');
                    $('#message-notif').addClass('alert-success');
                    $('#message-notif').html('Message sent! The business will personally contact you through your email or mobile number.');
                    $('#message-notif').fadeIn();
                    $('#contactname').val('');
                    $('#contactemail').val('');
                    $('#contactmessage').val('');
                    $('#contactmobile').val('');
                    $('#contactmessage').attr('placeholder', 'Write your message here...');
                }
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
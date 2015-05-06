$(document).on('click', '#btn-message-business', function(){
    $('#contactBusinessModal').html("Contact " + $('#business-name').html());
});

$(document).on('click', '#send-business-message', function(){
    var business_id = $('#business-id').attr('business_id');
    var contname = $('#contactname').val();
    var contemail = $('#contactemail').val();
    var contmobile = $('#contactmobile').val();
    var contmessage = $('#contactmessage').val();

    $.post( '/broadcast/business-message', { business_id: business_id, contname: contname, contemail: contemail, contmobile: contmobile, contmessage: contmessage })
        .done(function( data ) {
            var resp = jQuery.parseJSON(data);
            if (resp.message_id > 0){
                $('#message-notif').fadeIn();
                $('#message-notif').html('Message sent! The business will personally contact you through your email or mobile number.');
                $('#contactname').val('');
                $('#contactemail').val('');
                $('#contactmessage').val('');
                $('#contactmobile').val('');
                $('#contactmessage').attr('placeholder', 'Write your message here...');
            }
        });
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

(function(){
    app.controller('messagesController', function($scope, $http){
        $scope.username = "";
        $scope.useremail = "";
        $scope.usermessage = "";


    });
})();
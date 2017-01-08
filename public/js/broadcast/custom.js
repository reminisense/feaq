$(document).ready(function(){
    var count = $('.marquee-text').length;
    var i = 0;

    rotateMarquee();

    function rotateMarquee() {
        $('.real-marquee-text').html($('.ticker-message .marquee-text:eq(' + i + ')').html());
        $('.real-marquee-text').one('finished', function() {
            if (i == parseInt(count - 1)){
                i = 0;
            } else {
                i++;
            }
            rotateMarquee();
        }).marquee({
            duration: 10000
        });
    }

    setInterval(blinker, 1000); //Runs every second

});

function blinker() {
  $('.blink-num').fadeOut(500);
  $('.blink-num').fadeIn(500);
}

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

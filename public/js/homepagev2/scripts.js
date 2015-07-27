$(document).ready(function() {
	$('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });
  
    $(function() {
      $('ul.navbar-nav a[href*=#]').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
    });

    $('#search-loader').hide();

    $('#subscribe-button').click(function() {

        $('#subscribe-button').html('<span style="color: #fff;" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading');
        $("#subscribe-button").prop('disabled', true);

        var email = $('#subscriber-field').val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if(regex.test(email)) {
            $.get('/newsletter/subscribe/' + email)
                .success(function (response) {
                    var values = $.parseJSON(response);
                    console.log(values.success);
                    if(values.success) {
                        $('#subscribe-success').fadeIn().delay(1000).fadeOut();
                        $('#subscriber-field').val("");
                        $('#subscribe-button').html('Subscribe');
                        $('#subscribe-button').prop('disabled', false);
                    }else {
                        $('#subscribe-duplicate').fadeIn().delay(2000).fadeOut();
                        $('#subscriber-field').val("");
                        $('#subscribe-button').html('Subscribe');
                        $('#subscribe-button').prop('disabled', false);
                    }
                });
        }else{
            $('#subscribe-error').fadeIn().delay(1000).fadeOut();
            $('#subscribe-button').html('Subscribe');
            $('#subscribe-button').prop('disabled', false);
        }
    });
});

$(window).scroll(function() {
  if ($(document).scrollTop() > 50) {
    $('.navbar').addClass('shrink');
} else {
    $('.navbar').removeClass('shrink');
}
});
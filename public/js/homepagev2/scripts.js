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
});

$(window).scroll(function() {
  if ($(document).scrollTop() > 50) {
    $('.navbar').addClass('shrink');
} else {
    $('.navbar').removeClass('shrink');
}
});
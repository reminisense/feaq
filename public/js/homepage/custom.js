$(window).scroll(function() {
  if (jQuery(document).scrollTop() > 50) {
      $('.navbar').addClass('shrink');
} else {
      $('.navbar').removeClass('shrink');
}
});

$(function() {
    $('a[href*=#]:not([href=#])').click(function() {
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

$('.nav li a').click(function(){

    $('.nav li a').addClass('orange');
});
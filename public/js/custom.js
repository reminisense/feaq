$(document).ready(function(){
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
            || location.hostname == this.hostname) {

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

    jQuery(window).scroll(function() {
        if (jQuery(document).scrollTop() > 50) {
            jQuery('.navbar').addClass('shrink');
        } else {
            jQuery('.navbar').removeClass('shrink');
        }
        if (jQuery(document).scrollTop() > 150) {
            jQuery('#gotop').show();
        } else {
            jQuery('#gotop').hide();
        }
    });
});

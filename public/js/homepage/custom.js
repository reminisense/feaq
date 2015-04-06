jQuery(window).scroll(function() {
  if (jQuery(document).scrollTop() > 50) {
    jQuery('.navbar').addClass('shrink');
} else {
    jQuery('.navbar').removeClass('shrink');
}
});
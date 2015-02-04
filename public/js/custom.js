

$(document).ready(function(){
    $('#btn-bcast-details').click(function () {
        if ( $( '.bcast-details' ).is( ':hidden' ) ) {
            $('.bcast-details').slideDown( 'fast' );
            $('#btn-bcast-details').html("BROADCAST <span class='glyphicon glyphicon-minus'></span>");
        } else {
            $( '.bcast-details' ).slideUp( 'slow' );
            $('#btn-bcast-details').html("DETAILS <span class='glyphicon glyphicon-plus'></span>'");
        }
    });

    $('.nav-tabs li').click( function () {
        $('.nav-tabs li').removeClass('active');
        $(this).addClass('active');
        if ($(this).hasClass('biz')) {
            $('.filters').slideUp('fast');
            $('#my_businesses').css('display', 'block');
            $('#search_business').css('display', 'none');
        } else {
            $('.filters').slideDown('fast');
            $('#my_businesses').css('display', 'none');
            $('#search_business').css('display', 'block');
        }
    });

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

    /*smooth scrolling to anchors on homepage*/
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
    /*back to top*/
    // browser window scroll (in pixels) after which the "back to top" link is shown
    var offset = 300,
    //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
        offset_opacity = 1200,
    //duration of the top scrolling animation (in ms)
        scroll_top_duration = 700,
    //grab the "back to top" link
        $back_to_top = $('.cd-top');

    //hide or show the "back to top" link
    $(window).scroll(function(){
        ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
        if( $(this).scrollTop() > offset_opacity ) {
            $back_to_top.addClass('cd-fade-out');
        }
    });

    //smooth scroll to top
    $back_to_top.on('click', function(event){
        event.preventDefault();
        $('body,html').animate({
                scrollTop: 0 ,
            }, scroll_top_duration
        );
    });

});
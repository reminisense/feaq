$(document).ready(function() {
    /*broadcast - more details*/
    $('#btn-bcast-details').click(function () {
        if ($('.bcast-details').is(':hidden')) {
            $('.bcast-details').slideDown('fast');
            $('#btn-bcast-details').html("BROADCAST <span class='glyphicon glyphicon-minus'></span>");
        } else {
            $('.bcast-details').slideUp('slow');
            $('#btn-bcast-details').html("DETAILS <span class='glyphicon glyphicon-plus'></span>");
        }
    });

    $('.nav-tabs li').click(function () {
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

    $('.to-terminals').click(function () {
        if ($('.edit-biz').find('.biz-terminals').is(':hidden')) {
            $(this).parent().next().slideDown('fast');
        } else {
            $('.edit-biz').find('.biz-terminals').slideUp('fast');
        }
        return false;
    });
    $('html').click(function () {
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

});
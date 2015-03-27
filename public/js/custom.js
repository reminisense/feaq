$(document).ready(function() {
    /*broadcast - more details*/
    $('#btn-bcast-details').click(function () {
        if ($('.bcast-details').is(':hidden')) {
            $('.bcast-details').slideDown('fast');
            $('#btn-bcast-details').html("<span class='glyphicon glyphicon-minus'></span>");
        } else {
            $('.bcast-details').slideUp('slow');
            $('#btn-bcast-details').html("<span class='glyphicon glyphicon-plus'></span>");
        }
    });

    $('#header-tabs.nav-tabs li').click(function (e) {
        e.preventDefault();
        $('.nav-tabs li').removeClass('active');
        $(this).addClass('active');
        if ($(this).hasClass('biz')) {
            $('.filters').slideUp('fast');
            $('#my_businesses').css('display', 'block');
            $('#search_business').css('display', 'none');
        } else if($(this).hasClass('search')){
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

//    ARA Moved to edit-business.js
//    $('#btn-addterminal').click(function () {
//        $('#inputterminal').show();
//        $('#btn-addterminal').hide();
//    });

    /*hovering get this number button*/
    $('.btn-getnum').hover(
        function () {
            var $this = $(this); // caching $(this)
            $this.text($this.data("GET THIS NUMBER <span class='glyphicon glyphicon-save'></span>"));
        }
    );

    /*replace ugly input time filter*/
    $('#btnTimeOpen').click(function (){
        if ($('#time_open-filter').is(':hidden')) {
            $('#time_open-filter').show();
            $(this).hide();
        }
    });
    $('#time_open-filter').focusout(function () {

    });


});
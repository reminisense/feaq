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

    $('#subscribe-button').click(function() {

        $('#subscribe-button').html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading');
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
                        $('#subscribe-duplicate').fadeIn().delay(1000).fadeOut();
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
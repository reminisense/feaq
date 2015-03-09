/**
 * Created by USER on 1/26/15.
 */

//load functions
$(document).ready(function(){
    $('#edit_profile').remove();
    pq.jquery_functions.load_switch_tabs();
    pq.jquery_functions.load_select_number();
    pq.jquery_functions.load_default_navbar_link();
    pq.jquery_functions.load_search_filter_behavior();
    pq.jquery_functions.load_show_modal();
    pq.jquery_functions.load_priority_number_modal_content();
});

//these functions and variables are separated since they are using jquery
//the purpose of this is to separate jquery functions from angular functions
//however, the angular functions are still dependent on the functions below
var pq = {
    ids : {
        service_id : $('#service-id').val(),
        terminal_id :$('#terminal-id').val()
    },

    urls : {
        process_queue : {
            all_numbers_url : $('#all-numbers-url').val() + '/',
            call_number_url : $('#call-number-url').val() + '/',
            serve_number_url : $('#serve-number-url').val() + '/',
            drop_number_url : $('#drop-number-url').val() + '/'
        },

        issue_numbers : {
            issue_multiple_url : $('#issue-multiple-url').val() + '/',
            issue_specific_url : $('#issue-specific-url').val() + '/'
        }

    },

    jquery_functions : {
        load_switch_tabs : function(){
            $('#pmore-tab a').on('click', function(e) {
                e.preventDefault();
                $(this).tab('show');
                $('.issue-submit-btn').hide();
                $($(this).attr('data-submit')).show();
            });
        },

        load_select_number : function(){
            $('#uncalled-numbers').on('click', 'li', function(e){
                e.preventDefault();
                pq.jquery_functions.select_number($(this).attr('data-tnumber'), $(this).attr('data-pnumber'));
                $('#btn-call').removeAttr('disabled');
            });
        },

        load_default_navbar_link : function(){
            $('.nav-tabs li.search').removeClass('active');
            $('.nav-tabs li.biz').addClass('active');
            $('.filters').hide();
        },

        load_search_filter_behavior : function(){
            $('.nav-tabs li.biz').on('click', function(){
                $('#search_results').slideUp();
            });

            $('.nav-tabs li.search').on('click', function(){
                $('#search_results').slideDown();
            });
        },

        load_show_modal : function(){
            $('#moreq').on('show.bs.modal', function(){
                pq.jquery_functions.show_tab_content();
                pq.jquery_functions.set_next_priority_number();
            });
        },

        load_priority_number_modal_content : function(){
            $('body').on('click', '.priority-number', function(e){
                e.preventDefault();
                name = $(this).attr('data-name') ? $(this).attr('data-name') : 'N/A';
                phone = $(this).attr('data-phone') ? $(this).attr('data-phone') : 'N/A';
                email = $(this).attr('data-email') ? $(this).attr('data-email') : 'N/A';
                priority_number = $(this).html();

                $('#priority-number-modal .modal-title').html('#' + priority_number);
                $('#priority-number-number').html(priority_number);
                $('#priority-number-name').html(name);
                $('#priority-number-phone').html(phone);
                $('#priority-number-email').html(email);
            });
        },

        remove_and_update_dropdown : function(transaction_number){
            $('#selected-tnumber').val(0);
            if(transaction_number) pq.jquery_functions.remove_from_dropdown(transaction_number);
            if($('#uncalled-numbers li').length == 0){
                pq.jquery_functions.change_dropdown_message('Please issue a number');
            }else{
                pq.jquery_functions.select_next_number();
            }
        },

        find_in_numbers_array : function(transaction_number, uncalled_numbers){
            return $.grep(uncalled_numbers, function(e){
                return e.transaction_number == transaction_number;
            });
        },

        select_number : function(tnumber, pnumber){
            $('#selected-tnumber').val(tnumber);
            $('#selected-pnumber').html(pnumber);
        },

        select_next_number : function(){
            $('#uncalled-numbers li:first-child').trigger('click');
        },

        remove_from_dropdown : function(transaction_number){
            $('#uncalled-numbers li[data-tnumber=' + transaction_number + ']').remove();
        },

        remove_from_called : function(transaction_number){
            $('#called-numbers tr[data-tnumber=' + transaction_number + ']').remove();
        },

        change_dropdown_message : function(message){
            $('#selected-pnumber').html(message);
        },

        issue_number_success_alert : function(message){
            pq.jquery_functions.hide_tab_content();

            $('#issue-number-success .message').html(message);
            $('#issue-number-success').fadeIn('fast');
            setTimeout(function(){$('#issue-number-success').fadeOut('slow')}, 3000);
        },

        issue_number_success : function(message){
            pq.jquery_functions.issue_number_success_alert(message);
        },

        hide_tab_content : function(){
            $('#pmore-tab').hide();
            $('#pmore-tab').next().hide();
            $('.issue-submit-btn').hide();
        },

        show_tab_content : function(){
            $('#pmore-tab').show();
            $('#pmore-tab').next().show();
            $($('#pmore-tab li.active a').attr('data-submit')).show();
        },

        set_next_priority_number : function(){
            process_queue = angular.element($("#process-queue-wrapper")).scope();
            $('#moreq form input[name=priority_number]').val(process_queue.next_number);
        },

        set_next_number_placeholder : function(next_number){
            $('#moreq form input[name=priority_number]').attr('placeholder', next_number);
        }
    }
};




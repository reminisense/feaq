/**
 * Created by USER on 1/26/15.
 */

//load functions
$(document).ready(function(){
    pq.jquery_functions.load_switch_tabs();
    pq.jquery_functions.load_select_number();
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
        },

        queue_settings : {
            queue_settings_get_url : $('#queue-settings-get-url').val() + '/',
            queue_settings_update_url : $('#queue-settings-update-url').val() + '/'
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
                $('#selected-tnumber').val($(this).attr('data-tnumber'));
                $('#selected-pnumber').html($(this).attr('data-pnumber'));
            });
        },

        remove_and_update_dropdown : function(transaction_number){
            pq.jquery_functions.remove_from_dropdown(transaction_number);
            if($('#uncalled-numbers li').length == 0){
                pq.jquery_functions.change_dropdown_message('Please issue a number');
            }else{
                pq.jquery_functions.select_next_number();
            }
        },

        select_next_number : function(){
            $('#uncalled-numbers li:first-child').trigger('click');
        },

        remove_from_dropdown : function(transaction_number){
            $('#uncalled-numbers li[data-tnumber=' + transaction_number + ']').remove();
        },

        change_dropdown_message : function(message){
            $('#selected-pnumber').html(message);
        },

        issue_number_success_alert : function(message){
            $('#issue-number-success .message').html(message);
            $('#issue-number-success').show();
        },

        issue_number_success : function(message){
            pq.jquery_functions.issue_number_success_alert(message);
            pq.jquery_functions.change_dropdown_message('Please select a number');
        }
    }
};




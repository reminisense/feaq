/**
 * Created by USER on 1/26/15.
 */

var timeoutfunc;

//load functions
$(document).ready(function(){
    $(".datepicker").datepicker({ dateFormat: 'mm-dd-yy' });

    pq.jquery_functions.load_switch_tabs();
    pq.jquery_functions.load_select_number();
    pq.jquery_functions.load_default_navbar_link();
    pq.jquery_functions.load_show_modal();
    pq.jquery_functions.load_priority_number_modal_content();
    pq.jquery_functions.load_issue_number_intelliput();

    $(document).on('click', '#forward-btn', function(e){
        e.preventDefault();
        service_id = $('#allowed-businesses').val();
        transaction_number = $('#priority-number-modal').attr('data-transaction-number');
        process_queue_scope = angular.element($("#process-queue-wrapper")).scope();
        process_queue_scope.issueToOther(service_id, transaction_number);
    });

    /*add box cards animation*/
    $('.box a.removeCard').on('click', function() {
        $(this).parents('.box').remove();
        $('.box-wrap').isotope({ layoutMode : 'fitRows' });
    });

    //$('.box-wrap').isotope({
    //    itemSelector : '.box'
    //});

    $('.date-today').on('click', function(){
        $('.datepicker').datepicker('show');
    });

});

//these functions and variables are separated since they are using jquery
//the purpose of this is to separate jquery functions from angular functions
//however, the angular functions are still dependent on the functions below
var pq = {
    ids : {
        service_id : $('#service-id').val(),
        terminal_id: $('#terminal-id').val(),
        business_id: $('#business-id').val()
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

        rating : {
            ratings_url : $('#ratings-url').val() + '/',
            verify_email_url : $('#verify-email-url').val() + '/'
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
                pq.jquery_functions.select_number(
                    $(this).attr('data-tnumber'),
                    $(this).attr('data-pnumber'),
                    $(this).attr('data-name'),
                    $(this).attr('data-email'),
                    $(this).attr('data-phone'),
                    $(this).attr('data-queue_platform'),
                    $(this).attr('data-checked_in')
                );
                $('#btn-call').removeAttr('disabled');
            });
        },

        load_default_navbar_link : function(){
            $('#search-business').removeClass('active');
            $('#message-inbox').removeClass('active');
            $('#my-business').addClass('active');
        },

        load_show_modal : function(){
            process_queue = angular.element($("#process-queue-wrapper")).scope();
            issue_number_modal = angular.element($("#moreq")).scope();
            $('#moreq').on('show.bs.modal', function(){
                pq.jquery_functions.show_tab_content();
                pq.jquery_functions.set_next_priority_number();
                issue_number_modal.$apply(function(){
                    issue_number_modal.number_limit = process_queue.number_limit;
                });
            });

            $('#moreq').on('hide.bs.modal', function(){
                issue_number_modal.$apply(function(){
                    issue_number_modal.priority_number = process_queue.next_number;
                    issue_number_modal.number_start = process_queue.next_number;
                });
                pq.jquery_functions.clearModalTimeout();
            });

        },

        load_priority_number_modal_content : function(){
            $('body').on('click', '.priority-number', function(e){
                e.preventDefault();
                pq.jquery_functions.clear_pnumber_modal();
                name = $(this).attr('data-name') ? $(this).attr('data-name') : 'Not specified';
                phone = $(this).attr('data-phone') ? $(this).attr('data-phone') : 'Not specified';
                email = $(this).attr('data-email') ? $(this).attr('data-email') : 'Not specified';
                priority_number = $(this).attr('data-priority-number');
                transaction_number = $(this).attr('data-transaction-number');
                confirmation_code = $(this).attr('data-confirmation-code');

                $('#priority-number-modal .modal-title').html('#' + priority_number);
                $('#priority-number-number').html(priority_number);
                $('#priority-number-confirmation-code').html(confirmation_code);
                $('#priority-number-name').html(name);
                $('#priority-number-phone').html(phone);
                $('#priority-number-email').html(email);
                $('#priority-number-modal').attr('data-transaction-number', transaction_number);

                $('#priority-number-modal .modal-body ul .details a').trigger('click');

                process_queue = angular.element($("#process-queue-wrapper")).scope();
                process_queue.getAllowedBusinesses();

                $('#priority-number-modal-close').hide();
                $('#allowed-businesses').removeAttr('disabled');
                $('#forward-btn').show();
                $('#forward-success').hide();
                $('#forward-success').html('');

            });

            $('body').on('click', '.show-messages', function(e){
                e.preventDefault();
                pq.jquery_functions.clear_pnumber_modal();
                name = $(this).attr('data-name') ? $(this).attr('data-name') : 'Not specified';
                phone = $(this).attr('data-phone') ? $(this).attr('data-phone') : 'Not specified';
                email = $(this).attr('data-email') ? $(this).attr('data-email') : 'Not specified';
                priority_number = $(this).attr('data-priority-number');
                transaction_number = $(this).attr('data-transaction-number');
                confirmation_code = $(this).attr('data-confirmation-code');

                $('#priority-number-modal .modal-title').html('#' + priority_number);
                $('#priority-number-number').html(priority_number);
                $('#priority-number-confirmation-code').html(confirmation_code);
                $('#priority-number-name').html(name);
                $('#priority-number-phone').html(phone);
                $('#priority-number-email').html(email);
                $('#priority-number-modal').attr('data-transaction-number', transaction_number);

                $('#priority-number-modal .modal-body #pmore-tab .messages a').trigger('click');
            });

            // Redesign functions
            $('body').on('click', '.priority-number-forward', function(e){
                e.preventDefault();
                pq.jquery_functions.clear_pnumber_modal();
                name = $(this).attr('data-name') ? $(this).attr('data-name') : 'Not specified';
                phone = $(this).attr('data-phone') ? $(this).attr('data-phone') : 'Not specified';
                email = $(this).attr('data-email') ? $(this).attr('data-email') : 'Not specified';
                priority_number = $(this).attr('data-priority-number');
                transaction_number = $(this).attr('data-transaction-number');
                confirmation_code = $(this).attr('data-confirmation-code');

                $('#priority-number-modal .modal-title').html('#' + priority_number);
                $('#priority-number-number').html(priority_number);
                $('#priority-number-confirmation-code').html(confirmation_code);
                $('#priority-number-name').html(name);
                $('#priority-number-phone').html(phone);
                $('#priority-number-email').html(email);
                $('#priority-number-modal').attr('data-transaction-number', transaction_number);

                $('#priority-number-modal .modal-body ul .details a').trigger('click');

                process_queue = angular.element($("#process-queue-wrapper")).scope();
                process_queue.getAllowedBusinesses();

                $('#priority-number-modal-close').hide();
                $('#allowed-businesses').removeAttr('disabled');
                $('#forward-btn').show();
                $('#forward-success').hide();
                $('#forward-success').html('');

            });

            $('body').on('click', '.priority-number-details', function(e){
                e.preventDefault();
                pq.jquery_functions.clear_pnumber_modal();
                name = $(this).attr('data-name') ? $(this).attr('data-name') : 'Not specified';
                phone = $(this).attr('data-phone') ? $(this).attr('data-phone') : 'Not specified';
                email = $(this).attr('data-email') ? $(this).attr('data-email') : 'Not specified';
                priority_number = $(this).attr('data-priority-number');
                transaction_number = $(this).attr('data-transaction-number');
                confirmation_code = $(this).attr('data-confirmation-code');

                $('#priority-number-modal .modal-title').html('#' + priority_number);
                $('#priority-number-number').html(priority_number);
                $('#priority-number-confirmation-code').html(confirmation_code);
                $('#priority-number-name').html(name);
                $('#priority-number-phone').html(phone);
                $('#priority-number-email').html(email);
                $('#priority-number-modal').attr('data-transaction-number', transaction_number);

                $('#allowed-businesses option').remove();
                $('#allowed-businesses-area').hide();

                $('#priority-number-modal .modal-body ul .details a').trigger('click');
            });
        },

        load_issue_number_intelliput : function(){
            $("#issued-number-phone").intlTelInput({
                defaultCountry: "auto"
            });
        },

        clear_pnumber_modal : function(){
            $('#priority-number-modal .modal-title').html('');
            $('#priority-number-number').html('');
            $('#priority-number-name').html('');
            $('#priority-number-phone').html('');
            $('#priority-number-email').html('');
        },

        remove_and_update_dropdown : function(transaction_number){
            $('#selected-tnumber').val(0);
            if(transaction_number) pq.jquery_functions.remove_from_dropdown(transaction_number);
            pq.jquery_functions.select_next_number();
        },

        find_in_numbers_array : function(transaction_number, uncalled_numbers){
            return $.grep(uncalled_numbers, function(e){
                return e.transaction_number == transaction_number;
            });
        },

        select_number : function(tnumber, pnumber, username, email, phone, queue_platform, checked_in){
            username = username != undefined ? username : '';
            queue_platform = queue_platform != undefined ? queue_platform : '';
            checked_in = checked_in != undefined ? checked_in : false;
            //ARA add priority number and
            var userinfo = '';


            userinfo += '<span ' +
                'class="pull-right user-info show-messages" ' +
                'style="margin-right: 20px; z-index: 99999" ' +
                'title="Number: ' + pnumber + '" ' +
                'data-priority-number="' + pnumber + '" ' +
                'data-name="' + username + '" ' +
                'data-phone="' + phone + '" ' +
                'data-email="' + email + '" ' +
                'data-toggle="modal" ' +
                'data-target="#priority-number-modal"' +
                '>';
            userinfo += '<a href="#">';
            userinfo += username != undefined ? '<span>' + username + ' </span>' : '';
            userinfo += '</a>';
            userinfo += '</span>';

            if((queue_platform == 'remote' || queue_platform == 'android') && (checked_in == "true" || checked_in == true)){
                userinfo += '<span><small class="c-status pull-right mr5 checkedin font-normal">checked in</small><span class="dpq-icons pull-right checkedin glyphicon glyphicon-ok"></span></span>';
            }else if((queue_platform == 'remote' || queue_platform == 'android') && (checked_in == "false" || checked_in == false)){
                userinfo += '<span><small class="c-status pull-right mr5 font-normal notcheckedin">not checked in</small><span class="notcheckedin dpq-icons pull-right glyphicon glyphicon-remove"></span></span>';
            }else{
                userinfo += '';
            }


            $('#selected-tnumber').val(tnumber);
            $('#selected-pnumber').html(pnumber);
            $('#selected-userinfo').html(userinfo);
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
            timeoutfunc = setTimeout(function(){
                $('#issue-number-success').fadeOut('slow');
                $('#moreq').modal('hide');
            }, 3000);
        },

        issue_number_error_alert : function(message){
            pq.jquery_functions.hide_tab_content();

            $('#issue-number-error .message').html(message);
            $('#issue-number-error').fadeIn('fast');
            timeoutfunc = setTimeout(function(){
                $('#issue-number-error').fadeOut('slow');
                $('#moreq').modal('hide');
            }, 3000);
        },

        clearModalTimeout : function(){
            $('#issue-number-success').fadeOut('slow');
            $('#issue-number-error').fadeOut('slow');
            $('#issue-number-success .message').html('');
            $('#issue-number-error .message').html('');
            clearTimeout(timeoutfunc);
        },

        issue_number_success : function(message){
            pq.jquery_functions.issue_number_success_alert(message);
        },

        issue_number_error : function(message){
            pq.jquery_functions.issue_number_error_alert(message);
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
            issue_number = angular.element($("#moreq")).scope();
            issue_number.$apply(function(){
                issue_number.priority_number = process_queue.next_number;
                issue_number.number_start = process_queue.next_number;
                issue_number.number_end = process_queue.next_number;
            });
        },

        set_next_number_placeholder : function(next_number){
            $('#moreq form input[name=priority_number]').attr('placeholder', next_number);
            $('#moreq form input[name=number_start]').attr('placeholder', next_number);
            $('#issue-call-number').attr('placeholder', next_number);
        },

        send_pq_websocket_data : function(data){
            var pq_scope = angular.element($("#process-queue-wrapper")).scope();
            pq_websocket = pq_scope.pq_websocket;
            data = data == undefined ? {} : data;
            data.business_id = pq.ids.business_id;
            data.service_id = pq.ids.service_id;
            data.terminal_id = pq.ids.terminal_id;
            pq_websocket.send(JSON.stringify(data));
        },

        getMonthString : function(month){
            switch(month){
                case '01': return 'January'; break;
                case '02': return 'February'; break;
                case '03': return 'March'; break;
                case '04': return 'April'; break;
                case '05': return 'May'; break;
                case '06': return 'June'; break;
                case '07': return 'July'; break;
                case '08': return 'August'; break;
                case '09': return 'September'; break;
                case '10': return 'October'; break;
                case '11': return 'November'; break;
                case '12': return 'December'; break;
            }
        },

        converDateToString : function(date){
            date_array = date.split('-');
            return pq.jquery_functions.getMonthString(date_array[0]) + ' ' + date_array[1] + ', ' + date_array[2];
        },
    }
};




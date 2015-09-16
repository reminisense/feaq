/**
 * Created by USER on 2/3/15.
 */
$(document).ready(function(){
//    $('.edit-business-cog').on('click', function(){
//        eb.jquery_functions.setBusinessId($(this).attr('data-business-id'));
//    });

//    $('#editBusiness').on('show.bs.modal', function(){
//        eb.jquery_functions.getBusinessDetails();
//        $('#editbiz-tabs li.active a').trigger('click'); //ARA Added to execute functions triggered by clicking tabs
//    });

    $('body').on('click', '#btn-addterminal',function (e) {
        $('#inputterminal').show();
        $('#btn-addterminal').hide();
        e.preventDefault();
    });

    $('body').on('click', '.btn-adduser', function(e){
        e.preventDefault();
        $(this).parent().find('.inputuser').show();
        $(this).hide();
    });

    $('body').on('click', '.cancel-adduser', function(e){
        e.preventDefault();
        $(this).parents('.inputuser').hide();
        $(this).parents('.inputuser').siblings('.btn-adduser').show();
    });

    $('body').on('click', '.cancel-add-terminal', function(){
        eb.jquery_functions.hide_add_terminal_form();
    });

    $('#tv-channel').on('change', function(){
        $('#tv-script-submit-btn').removeAttr('disabled');
    });

    $(document).on('change', '#ad-image', function(){
        $('#image-submit-btn').removeClass('btn-disabled');
    });

    $(document).on('change', '#ad-video', function(){
        $('#vid-submit-btn').removeClass('btn-disabled');
    });

    $(document).on('click', '.process-queue', function(e){
        if ($(this).find('.biz-terminals').is(':hidden')) {
            $(this).find('.biz-terminals').slideDown('fast');
            $('#process-queue').css("border","none");
        }
        return false;
    });

    $('html').click(function () {
        $('.biz-terminals').slideUp('fast');
        $('#process-queue').css({"border-bottom":"4px solid #d36e3c"});
    });

    $('.biz-terminals').on('click', 'a', function(e){
        e.stopPropagation();
    });

    $(".datepicker").datepicker();


    /*select option chooser for how many numbers to display*/
    /*$(function () {
        $('.q-numbers').hide();
        $('.n3').show();

        $('#select-q-numbers').on("change",function () {
            $('.q-numbers').hide();
            $('.n'+$(this).val()).show();
        }).val("3");
    });*/
    /*select option chooser for ads type*/
    $(function () {
        $('.ads-type').hide();
        $('.a1').show();

        $('#select-ads-type').on("change",function () {
            $('.ads-type').hide();
            $('.a'+$(this).val()).show();

            if ($(this).val() == '3'){
                $('#ad-num-width').css('width', '100%');
                $('#ad-width').hide();
            } else {
                $('#ad-width').show();
                $('#ad-width').css('width', '50%');
                $('#ad-num-width').css('width', '50%');
            }
        }).val("1");
    });
    /*add new fields for ticker message*/
    var qmax_fields      = 10;
    var qdefault         = 1;
    var qwrapper         = $(".q-nums-wrap");
    var qadd_button      = $(".q-add");
    var qx = 1;
    $(qadd_button).click(function(e){
        e.preventDefault();
        if(qx < qmax_fields){
            qx++;
            $(qwrapper).append('<div class="qbox"><div class="pull-left half">1</div></div>');
        }
        $('.q-nums-wrap .qbox:last-child .half').html(qx);
    });
    $('.q-minus').on("click", function(e){ //user click on remove text
        qx--;
        if(qx < qdefault){
            qx = qdefault;
            $('.q-nums-wrap .qbox:last-child .half').html(qx);
        }
        else {
            e.preventDefault(); $('.q-nums-wrap .qbox:last-child').remove();
        }

    });
    /**/
        var max_fields      = 5;
        var wrapper         = $(".ticker-field-wrap");
        var add_button      = $(".add-ticker");//Add button ID
        var x = 1;
        $(add_button).click(function(e){
            e.preventDefault();
            if(x < max_fields){
                x++;
                $(wrapper).append('<div class="rel"><input class="form-control" placeholder="Your Ticker Message Here" type="text"/><a href="#" class="btn btn-md btn-primary abs remove_field"> Remove</a></div>');
            }
        });
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        });


    //eb.jquery_functions.load_users();
    eb.jquery_functions.setBusinessId($('#business_id').val());
    eb.jquery_functions.setUserId($('#user_id').val());
    eb.jquery_functions.getBusinessDetails();
    eb.jquery_functions.my_business_link_active();
    eb.jquery_functions.activate_plupload();
    eb.jquery_functions.load_remote_limit_slider();
    eb.jquery_functions.reorder_ad_image();

});

var eb = {

    urls : {
        business: {
            business_details_url : $('#business-details-url').val() + '/',
            business_edit_url : $('#business-edit-url').val(),
            business_remove_url : $('#business-remove-url').val()
        },

        terminals: {
            terminal_create_url : $('#terminal-create-url').val(),
            terminal_edit_url : $('#terminal-edit-url').val(),
            terminal_delete_url : $('#terminal-delete-url').val(),
            terminal_assign_url : $('#terminal-assign-url').val(),
            terminal_unassign_url : $('#terminal-unassign-url').val(),
            user_emailsearch_url : $('#user-emailsearch-url').val() + '/'
        },

        broadcast: {
            broadcast_json_url : $('#broadcast-json-url').val() + '/',
            broadcast_set_theme_url : $('#broadcast-set-theme-url').val(),
            ads_embed_video_url : $('#ads-embed-video-url').val(),
            ads_tv_select_url : $('#ads-tv-select-url').val(),
            ads_tv_on_url : $('#ads-tv-on-url').val(),
            ads_type_url : $('#ads-type-url').val(),
            save_ticker_url : '/advertisement/save-ticker'
        },

        queue_settings : {
            queue_settings_get_url : $('#queue-settings-get-url').val() + '/',
            queue_settings_update_url : $('#queue-settings-update-url').val() + '/'
        },

        forms : {
            add_textfield_url : '/forms/add-textfield',
            add_radiobutton_url : '/forms/add-radiobutton',
            add_checkbox_url : '/forms/add-checkbox',
            add_dropdown_url : '/forms/add-dropdown',
            display_fields_url : '/forms/display-fields',
            delete_field_url : '/forms/delete-field'
        },

        advertisement : {
            get_slider_image : '/advertisement/slider-images',
            delete_slider_image : '/advertisement/delete-image',
            carousel_delay : '/advertisement/carousel-delay'
        }
    },

    jquery_functions : {
        /*
         createTextField : function(form_id, field_data) {
         return '<div class="col-md-3"><label>'+ field_data.label+'</label></div><div class="col-md-9"><input type="text" class="form-control"></div>';
         },

         createCheckbox : function(form_id, field_data) {
         return '<div class="col-md-3"><label>'+ field_data.label+'</label></div><div class="col-md-9"><input type="checkbox" class="form-control" value="1"></div>';
         },

         createRadio : function(form_id, field_data) {
         return '<div class="col-md-3"><label>'+ field_data.label+'</label></div><div class="col-md-9"><label><input type="radio" name="forms_'+form_id+'" value="'+field_data.value_a+'" > <strong>'+field_data.value_a+'</strong></label><label><input type="radio" name="forms_'+form_id+'" value="'+field_data.value_b+'"> <strong>'+field_data.value_b+'</strong></label></div>';
         },

         createDropdown : function(form_id, field_data) {
         var select_options = '';
         $.each(field_data.options, function(count, val) {
         select_options += '<option value="'+val+'">'+val+'</option>';
         });
         return '<div class="col-md-3"><label>'+ field_data.label+'</label></div><div class="col-md-9"><select class="form-control">'+select_options+'</select></div>';
         },

         generateCustomFields : function(response) {
         var form_fields = '';
         $.each(response.form_fields, function(form_id, field_data) {
         if (field_data.field_type == 'Text Field') form_fields += eb.jquery_functions.createTextField(form_id, field_data);
         else if (field_data.field_type == 'Checkbox') form_fields += eb.jquery_functions.createCheckbox(form_id, field_data);
         else if (field_data.field_type == 'Radio') form_fields += eb.jquery_functions.createRadio(form_id, field_data);
         else if (field_data.field_type == 'Dropdown') form_fields += eb.jquery_functions.createDropdown(form_id, field_data);
         });
         return form_fields;
         },
         */

        validYouTubeURL : function(url) {
            var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
            return (url.match(p)) ? RegExp.$1 : false;
        },

        getBusinessDetails : function(){
            var scope = angular.element($("#editBusiness")).scope();
            scope.$apply(function(){
                scope.getBusinessDetails();
                scope.currentActiveBroadcastDetails(scope.business_id);
            });
        },

        setBusinessId : function(business_id){
            var scope = angular.element($("#editBusiness")).scope();
            scope.$apply(function(){
                scope.business_id = business_id;
            });
        },

        setUserId : function(user_id){
            var scope = angular.element($("#editBusiness")).scope();
            scope.$apply(function(){
                scope.user_id = user_id;
            });
        },

//        load_users : function(){
//            var scope = angular.element($("#editBusiness")).scope();
//            scope.$apply(function(){
//                scope.getUsers();
//            });
//        },

        hide_add_terminal_form : function(){
            $('#inputterminal').hide();
            $('#btn-addterminal').show();
        },

        my_business_link_active : function(){
            $('#my-business').addClass('active');
            $('#search-business').removeClass('active');
            $('#message-inbox').removeClass('active');
        },

        clear_terminal_delete_msg : function(){
            setTimeout(function(){
                $("#terminal-delete-error").fadeOut('slow', function(){
                    var scope = angular.element($("#editBusiness")).scope();
                    scope.$apply(function(){
                        scope.terminal_delete_error = null;
                    });
                    $("#terminal-delete-error").show();
                });
            }, 3000);
        },

        load_remote_limit_slider : function(){
            var scope = angular.element($("#editBusiness")).scope();
            var value = scope.remote_limit;

            $( "#remote-slider" ).slider({
                range: "max",
                min: 0,
                max: 20,
                value: value,
                slide: function( event, ui ) {
                    scope.$apply(function(){
                        scope.remote_limit = ui.value;
                    });
                }
            });
        },

        activate_plupload : function() {
            $("#html5_uploader").pluploadQueue({
                // General settings
                runtimes : 'html5',
                url : '/advertisement/upload-image',
                chunk_size : '1mb',
                unique_names : true,

                filters : {
                    max_file_size : '5mb',
                    mime_types: [
                        {title : "Image files", extensions : "jpg,jpeg,gif,png"}
                    ]
                },

                // Resize images on clientside if we can
                resize : {width : 800, height : 800, quality : 90},

                multipart_params : {
                    "business_id" : $('#business_id').val()
                },

                init : {
                    UploadComplete: function(up, files) {
                        $.post(eb.urls.advertisement.get_slider_image, {
                            'business_id' : $('#business_id').val()
                        }, function(result) {
                            var response = jQuery.parseJSON(result);
                            $('#adimage-success').fadeIn();
                            $('#adimage-success').fadeOut(7000);
                            var scope = angular.element($("#editBusiness")).scope();
                            scope.$apply(function(){
                                scope.slider_images = response.slider_images;
                                if ($.trim(response.slider_images)) {
                                    $('.reorder-note').show();
                                }
                                else {
                                    $('.reorder-note').hide();
                                }
                            });
                            eb.jquery_functions.activate_plupload();
                        });
                    }
                }
            });
        },

        reorder_ad_image : function() {
            $( "#ad-images-preview tbody" ).sortable({
                stop: function( event, ui ){
                    $(this).find('tr').each(function(i){
                        $(this).attr('img_weight', i+1);
                        $.post('/advertisement/reorder-images', {
                            business_id: $('#business_id').val(),
                            img_id : $(this).attr('img_id'),
                            weight : $(this).attr('img_weight')
                        });
                    });
                }
            });
        }
    }
};


(function(){
    app.requires.push('angular-loading-bar'); //add angular loading bar
    app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
        cfpLoadingBarProvider.includeSpinner = false;
    }]);
    app.controller('editBusinessController', function($scope, $http, $filter){
        $scope.user_id = null;
        $scope.business_id = null;
        $scope.business_name = null;
        $scope.business_address = null;
        $scope.facebook_url = null;
        $scope.industry = null;
        $scope.time_open = null;
        $scope.time_closed = null;
        $scope.queue_limit = null; /* RDH Added queue_limit to Edit Business Page */

        $scope.terminals = [];
        $scope.users = [];
        $scope.analytics = [];
        $scope.messages = [];

        $scope.form_fields = [];

        $scope.remaining_character1  = 95;
        $scope.remaining_character2  = 95;
        $scope.remaining_character3  = 95;
        $scope.remaining_character4  = 95;
        $scope.remaining_character5  = 95;

        $scope.number_start = 1;
        $scope.terminal_specific_issue = 0;
        $scope.sms_current_number = 0;
        $scope.sms_1_ahead  = 0;
        $scope.sms_5_ahead  = 0;
        $scope.sms_10_ahead  = 0;
        $scope.sms_blank_ahead = 0;
        $scope.input_sms_field = 0;
        $scope.allow_remote = 0;
        $scope.remote_limit = 0;

        $scope.add_terminal = {
            terminal_name : ""
        };

        $scope.business_reply_form = {
            message_reply : "",
            active_sender_email : "",
            attachment : "",
            pick_number : 0
        };
        $scope.sendby = {
            email : 'email',
            phone : 'phone'
        }

        $scope.business_features = {
            terminal_users: 3
        };

        $scope.startdate = $filter('date')(new Date(),'MM/dd/yyyy');
        $scope.enddate = $filter('date')(new Date(),'MM/dd/yyyy');

        $scope.my_accesskey = null;
        $scope.getBusinessDetails = function(){
            if ( $scope.business_id > 0 ) {
                $http.get(eb.urls.business.business_details_url + $scope.business_id)
                    .success(function(response){
                        setBusinessFields(response.business);
                        setBusinessFeatures(response.business.features);
                    });
            }
        }

        setBusinessFields = function(business){
            $scope.business_id = business.business_id;
            $scope.business_name = business.business_name;
            $scope.business_address = business.business_address;
            $scope.facebook_url = business.facebook_url;
            $scope.industry = business.industry;
            $scope.time_open = business.time_open;
            $scope.time_closed = business.time_closed;
            $scope.timezone = business.timezone; //ARA Added Timezone
            $scope.queue_limit = business.queue_limit; /* RDH Added queue_limit to Edit Business Page */
            $scope.terminal_specific_issue = business.terminal_specific_issue ? true : false;
            $scope.sms_current_number = business.sms_current_number ? true : false;
            $scope.sms_1_ahead  = business.sms_1_ahead ? true : false;
            $scope.sms_5_ahead  = business.sms_5_ahead ? true : false;
            $scope.sms_10_ahead  = business.sms_10_ahead ? true : false;
            $scope.sms_blank_ahead = business.sms_blank_ahead ? true : false;
            $scope.input_sms_field = business.input_sms_field;
            $scope.allow_remote = business.allow_remote ? true : false;
            $scope.remote_limit = business.remote_limit;
            $scope.terminals = business.terminals;
            $scope.analytics = business.analytics;
            $scope.terminal_delete_error = business.error ? business.error : null;
            $scope.allowed_businesses = business.allowed_businesses;

            //sms settings
            $scope.sms_gateway = business.sms_gateway;
            if(business.sms_gateway == 'frontline_sms'){
                $scope.frontline_api_key = business.frontline_api_key;
                $scope.frontline_url = business.frontline_sms_url;
            }else if(business.sms_gateway == 'twilio'){
                $scope.twilio_account_sid = business.twilio_account_sid;
                $scope.twilio_auth_token = business.twilio_auth_token;
                $scope.twilio_phone_number = business.twilio_phone_number;
            }

            eb.jquery_functions.load_remote_limit_slider();
        }

        setBusinessFeatures = function(features){
            if(features){
                $scope.business_features = features;
                if(features.terminal_users == undefined) features.terminal_users = 3;
                if(features.allow_sms == 'false'){
                    $scope.sms_gateway == null;
                    $scope.frontline_api_key = null;
                    $scope.frontline_url = null;
                    $scope.twilio_account_sid = null;
                    $scope.twilio_auth_token = null;
                    $scope.twilio_phone_number = null;
                }
            }
        }

        /* @CSD 05062015 */
        /* @CSD 08032015 Migrated to messages.js by Paul */
        /*
        $scope.setPreviewMessage = function(sender, message_id, active_email){
            $('.message-preview').hide();
            $('.preview-container').fadeIn();
            if (isMobile.any() != null){
                $('#mobile-back-button').removeClass('hidden').fadeIn();
                $('.message-collection').fadeOut();
            }
            $scope.business_reply_form.active_sender_email = active_email;
            $http.post('/message/phone-list', {
                message_id : message_id
            }).success(function(response) {
                $scope.number_list = response.numbers;
            });
            $http.post('/message/message-thread', {
                message_id : message_id
            }).success(function(response) {
                $('.messagefrom').remove();
                $('.messageto').remove();
                for(var i = 0; i < response.contactmessage.length; i++){
                    var newMessage = response.contactmessage[i].content.replace(/\n/g, '<br>');
                    var attachmentLink = response.contactmessage[i].attachment;
                    if ($.trim(attachmentLink)) {
                        attachmentLink = "<p><a style=\"font-weight: bold; color: #d36e3c;\" href=\"" + attachmentLink + "\" download>Download Attachment</a></p>";
                    }
                    if (response.contactmessage[i].sender == 'user'){
                        finalMessage = "" +
                            "<div class='messagefrom clearfix'>" +
                            "<p>" + newMessage + "</p>" + attachmentLink +
                            "<p class='timestamp pull-right'>Posted by <strong class='sender'>" + sender + "</strong> on <strong>" + response.contactmessage[i].timestamp +
                            "</strong></div>" +
                            "";
                        $('.thread-boundary').before(finalMessage);
                    } else {
                        finalMessage = "" +
                            "<div class='messageto clearfix'>" +
                            "<p>" + newMessage + "</p>" + attachmentLink +
                            "<p class='timestamp pull-right'>Posted by <strong class='sender'>You</strong> on <strong>" + response.contactmessage[i].timestamp +
                            "</strong></div>" +
                            "";
                        $('.thread-boundary').before(finalMessage);
                    }
                }
                $('.message-preview').fadeIn();
            });
        }

        $scope.sendBusinessReply = function(){
            $('#sendreply').html('Sending... &nbsp;<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>');
            $('#sendreply').attr('disabled', '');
            $http.post('/message/sendto-user', {
                business_id: $scope.business_id,
                contactemail: $scope.business_reply_form.active_sender_email,
                messageContent: $scope.business_reply_form.message_reply,
                phonenumber : $scope.business_reply_form.pick_number,
                attachment : $('#business-attachment').val(),
                sendbyphone : $scope.sendby.phone
            }).success(function(response){
                var attachmentLink = $('#business-attachment').val();
                if ($.trim(attachmentLink)) {
                    attachmentLink = "<p><a style=\"font-weight: bold; color: #d36e3c;\" href=\"" + attachmentLink + "\" download>Download Attachment</a></p>";
                }
                var finalMessage = "" +
                    "<div class='messageto'>" +
                    "<p>" + $scope.business_reply_form.message_reply.replace(/\n/g, '<br>') + "</p>" + attachmentLink +
                    "<p class='timestamp pull-right'>Posted by <strong class='sender'>You</strong> on <strong>" + response.timestamp +
                    "</strong></div>" +
                "";
                $('.thread-boundary').before(finalMessage);
                $('#sendreplytext').val('');
                $('#sendreply').html('Send Reply');
                $('#sendreply').removeAttr('disabled');
            });
        }
        */

        $scope.unassignFromTerminal = function(user_id, terminal_id){
            var confirmDel = confirm("Are you sure you want to remove this terminal user?");
            if (confirmDel){
                $http.post(eb.urls.terminals.terminal_unassign_url, {
                    user_id : user_id,
                    terminal_id : terminal_id
                }).success(function(response){
                    setBusinessFields(response.business);
                });
            }
        }

        $scope.assignToTerminal = function(user_id, terminal_id){
            $http.post(eb.urls.terminals.terminal_assign_url, {
                user_id : user_id,
                terminal_id : terminal_id
            }).success(function(response){
                    setBusinessFields(response.business);
                });
        }

        $scope.emailSearch = function(email, terminal_id){
            $http.get(eb.urls.terminals.user_emailsearch_url + email)
                .success(function(response){
                    if(response.user){
                        $scope.assignToTerminal(response.user.user_id, terminal_id);
                        $scope.clearUserResults();
                    }else{
                        $('.add-user-error[terminal_id=' + terminal_id + ']').show();
                        setTimeout(function(){$('.add-user-error[terminal_id=' + terminal_id + ']').fadeOut('slow')}, 3000);
                    }
                });
        }

        $scope.user_results = {users : []};
        $scope.userSearch = function(keyword){
            $http.get('/user/search-user/' + keyword).success(function(response){
                $scope.user_results.users = response.users;
            }).error(function(response){
                $scope.user_results.users = [];
            });
        }

        $scope.clearUserResults = function(){
            $scope.user_results.users = [];
        }

        $scope.isAssignedUser = function(user_id, terminal_id){
            terminals = $scope.terminals
            assigned = false;
            for(terminal in terminals){
                if(terminals[terminal].terminal_id == terminal_id){
                    for(user in terminals[terminal].users){
                        if(terminals[terminal].users[user].user_id == user_id){
                            assigned = true;
                        }
                    }
                }
            }
            return assigned;
        }

        $scope.deleteTerminal = function($event, terminal_id) {
            var confirmDel = confirm("Are you sure you want to delete this terminal?");
            if (confirmDel){
                $http.post(eb.urls.terminals.terminal_delete_url, {
                    terminal_id : terminal_id
                }).success(function(response) {
                    setBusinessFields(response.business);
                    eb.jquery_functions.clear_terminal_delete_msg();
                });
            }

            $event.preventDefault();
        }

        $scope.editTerminal = function($event, terminal_id){
            $('.terminal-name-display[terminal_id='+terminal_id+']').hide();
            $('.edit-terminal-button[terminal_id='+terminal_id+']').hide();
            $('.terminal-name-update[terminal_id='+terminal_id+']').show();
            $('.update-terminal-button[terminal_id='+terminal_id+']').show();
            $event.preventDefault();
        }

        $scope.updateTerminal = (function($event, terminal_id) {
            var new_name = $('.terminal-name-update[terminal_id='+terminal_id+']').val().trim();
            if (new_name !== ""){
                $('.terminal-name-display[terminal_id='+terminal_id+']').text(new_name);
                $http.post(eb.urls.terminals.terminal_edit_url, {
                    terminal_id : terminal_id,
                    name : new_name
                }).success(function(response) {
                    if(response.status){
                        $('.terminal-name-update[terminal_id=' + terminal_id + ']').val(new_name);
                        $('.update-terminal-button[terminal_id=' + terminal_id + ']').hide();
                        $('.terminal-name-update[terminal_id=' + terminal_id + ']').hide();
                        $('.terminal-name-display[terminal_id=' + terminal_id + ']').show();
                        $('.edit-terminal-button[terminal_id=' + terminal_id + ']').show();
                        $('.terminal-error-message[terminal_id=' + terminal_id + ']').hide();
                    }else{
                        $('.terminal-error-message[terminal_id=' + terminal_id + ']').html('Terminal name already exists.');
                        $('.terminal-error-message[terminal_id=' + terminal_id + ']').show();
                        setTimeout(function(){$('.terminal-error-message[terminal_id=' + terminal_id + ']').fadeOut('slow')}, 3000);
                    }
                }).error(function(response) {
                    alert('Something went wrong..');
                });
            } else {
                $('.terminal-error-message[terminal_id=' + terminal_id + ']').html('Terminal name cannot be empty.');
                $('.terminal-error-message[terminal_id=' + terminal_id + ']').show();
                setTimeout(function(){$('.terminal-error-message[terminal_id=' + terminal_id + ']').fadeOut('slow')}, 3000);
            }

            $event.preventDefault();
        });

        $scope.createTerminal = function(){
            var terminal_name = $scope.add_terminal.terminal_name.trim();
            if (terminal_name !== ""){
                $http.post(eb.urls.terminals.terminal_create_url, {
                    business_id : $scope.business_id,
                    name : terminal_name
                }).success(function(response){
                    if(response.status == 0){
                        $('.terminal-error-msg').html("Terminal name already exists.");
                        $('.terminal-error-msg').show();
                        setTimeout(function(){$('.terminal-error-msg').fadeOut('slow')}, 3000);
                    } else {
                        setBusinessFields(response.business);
                        $scope.add_terminal.terminal_name = '';
                        eb.jquery_functions.hide_add_terminal_form();
                        $('.terminal-error-msg').hide();
                    }
                });
            } else {
                $('.terminal-error-msg').html("Terminal name cannot be empty.");
                $('.terminal-error-msg').show();
                setTimeout(function(){$('.terminal-error-msg').fadeOut('slow')}, 3000);
            }
        }

        $scope.isValidTime = function(time){
            var regex = /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/;
            return regex.test(time);
        }

        /*
         * @author: CSD
         * @description: post edit business form
         */
        $scope.saveBusinessDetails = function(business){
            var errorMessage = "";
            if ($scope.business_name == ""){
                errorMessage = "Business Name field is required. ";
            }

            if ($scope.business_address == ""){
                errorMessage = errorMessage + "Business Address field is required. ";
            }

            if ($scope.time_open == ""){
                errorMessage = errorMessage + "Time Open field is required. ";
            } else if (!$scope.isValidTime($scope.time_open)) {
                errorMessage = errorMessage + "Invalid Time Open field input. ";
            }

            if ($scope.time_closed == ""){
                errorMessage = errorMessage + "Time Close field is required. ";
            } else if (!$scope.isValidTime($scope.time_closed)) {
                errorMessage = errorMessage + "Invalid Time Open field input. ";
            }

            if ($scope.sms_blank_ahead == 1 && $scope.input_sms_field == ""){
                errorMessage = errorMessage + "Please input a valid number for the SMS notification field. ";
            }else{

                if(($scope.input_sms_field % 1) != 0){
                    errorMessage = errorMessage + "Please input a whole number on the SMS notification field. ";
                }else if($scope.input_sms_field <= 0 && $scope.input_sms_field !=""){
                    errorMessage = errorMessage + "Please input a positive number on the SMS notification field. ";
                }

            }

            if (errorMessage != ""){
                $('#edit_message').removeClass('alert-success');
                $('#edit_message').addClass('alert-danger');
                $('#edit_message p').html(errorMessage);
                $('#edit_message').fadeIn();
                setTimeout(function(){ $('#edit_message').fadeOut(); }, 3000);
            } else {
                var data = {
                    business_id : $scope.business_id,
                    business_name: $scope.business_name,
                    business_address: $scope.business_address,
                    facebook_url: $scope.facebook_url,
                    industry: $scope.industry,
                    time_open: $scope.time_open,
                    time_close: $scope.time_closed,
                    timezone: $scope.timezone, //ARA Added timezone
                    queue_limit: $scope.queue_limit, /* RDH Added queue_limit to Edit Business Page */
                    terminal_specific_issue : $scope.terminal_specific_issue ? 1 : 0,
                    sms_current_number : $scope.sms_current_number ? 1 : 0,
                    sms_1_ahead : $scope.sms_1_ahead ? 1 : 0,
                    sms_5_ahead : $scope.sms_5_ahead ? 1 : 0,
                    sms_10_ahead : $scope.sms_10_ahead ? 1 : 0,
                    sms_blank_ahead : $scope.sms_blank_ahead ? 1 : 0,
                    input_sms_field: $scope.input_sms_field,
                    allow_remote: $scope.allow_remote ? 1 : 0,
                    remote_limit: $scope.remote_limit,
                    sms_gateway : $scope.sms_gateway
                }

                if($scope.sms_gateway == 'frontline_sms'){
                    data.frontline_api_key = $scope.frontline_api_key;
                    data.frontline_url = $scope.frontline_url;
                }else if($scope.sms_gateway == 'twilio'){
                    data.twilio_account_sid = $scope.twilio_account_sid;
                    data.twilio_auth_token = $scope.twilio_auth_token;
                    data.twilio_phone_number = $scope.twilio_phone_number;
                }

                $http.post(eb.urls.business.business_edit_url, data)
                    .success(function(response){
                        if(response.success == 1){
                            setBusinessFields(response.business);
                            $('#edit_message').removeClass('alert-danger');
                            $('#edit_message').addClass('alert-success');
                            $('#edit_message p').html("Your business details have been updated");
                            $('#edit_message').fadeIn();
                            setTimeout(function(){ $('#edit_message').fadeOut(); }, 3000);
                        } else {
                            $('#edit_message').removeClass('alert-success');
                            $('#edit_message').addClass('alert-danger');
                            $('#edit_message p').html(response.error);
                            $('#edit_message').fadeIn();
                            setTimeout(function(){ $('#edit_message').fadeOut(); }, 3000);
                        }
                    })
            }
        }

        $scope.deleteBusiness = (function(business_id) {
            if (confirm('Are you sure you want to remove this business?')) {
                $http.post(eb.urls.business.business_remove_url, {
                    business_id : business_id
                }).success(function(response) {
                    //console.log(response);
                    $('.col-md-3[business_id='+business_id+']').remove();
                    location.reload();
                });
            }
        });

        $scope.activateTheme = (function(theme_type, business_id, show_called_only) {
            $http.post(eb.urls.broadcast.broadcast_set_theme_url, {
                'business_id' : business_id,
                'theme_type' : theme_type,
                'show_issued' : !show_called_only //ARA Added for toggling to show only called numbers in broadcast page
            }).success(function(response) {
                $('.activated').hide();
                $('.theme-btn').show();
                $('.'+theme_type+'.theme-btn').hide();
                $('.'+theme_type+'.activated').show();
                $scope.theme_type = theme_type;
            });
        });

        $scope.currentActiveBroadcastDetails = (function(business_id) {
            if (business_id > 0){
                $http.get(eb.urls.broadcast.broadcast_json_url + business_id + '.json?nocache='+Math.floor((Math.random() * 10000) + 1)).success(function(response) {
                    $('.activated').hide();
                    $('.theme-btn').show();
                    $('.'+response.display+'.theme-btn').hide();
                    $('.'+response.display+'.activated').show();

                    // default ad screen size
                    var total_width = $('#ad-well-inner').css('width');
                    $('#ad-width').css('width', '50%');
                    $('#ad-num-width').css('width', '50%');
                    $('#ad-width-preview').css('width', 400);

                    $("#ad-width").resizable({
                        handles: 'e'
                    }).bind( "resize", function(e) {
                        var total_width = parseInt($('#ad-well-inner').css('width'));
                        var percent_num = Math.floor(parseInt(total_width) * 0.25);
                        var percent_ad = Math.floor(parseInt(total_width) * 0.50);

                        var adwidth = parseInt($("#ad-width").css('width'));
                        var numwidth = total_width - adwidth;

                        if (numwidth >= percent_num && adwidth >= percent_ad){
                            $('#ad-width').css('width', adwidth);
                            $('#ad-num-width').css('width', numwidth);
                        } else if (numwidth <= percent_num) {
                            $('#ad-width').css('width', total_width - percent_num);
                            $('#ad-num-width').css('width', percent_num);
                        } else if (adwidth <= percent_ad) {
                            $('#ad-width').css('width', percent_ad);
                            $('#ad-num-width').css('width', total_width - percent_ad);
                        }
                    });

                    // default ad video / image
                    if (!response.ad_image) {
                        response.ad_image = '/images/ads.jpg'
                    }
                    $('#ad-preview').attr('src', response.ad_image);
                    $('#advideo-preview').attr('src', response.ad_video);

                    // ad type
                    if (response.ad_type == 'video') {
                        $('input:radio[name=ad_type]').filter('[value=video]').prop('checked', true);
                        $('#image-adtype').hide();
                        $('#video-adtype').show();
                    }
                    else {
                        $('input:radio[name=ad_type]').filter('[value=image]').prop('checked', true);
                        $('#video-adtype').hide();
                        $('#image-adtype').show();
                    }

                    //ARA Added for toggling to show only called numbers in broadcast page
                    $scope.theme_type = response.display;
                    $scope.show_called_only = response.show_issued != undefined ? !response.show_issued : false;

                    // default internet TV channel
                    $scope.tv_channel = response.tv_channel;

                    // current active ticker message
                    $scope.ticker_message = response.ticker_message;
                    $scope.ticker_message2 = response.ticker_message2;
                    $scope.ticker_message3 = response.ticker_message3;
                    $scope.ticker_message4 = response.ticker_message4;
                    $scope.ticker_message5 = response.ticker_message5;

                    // current carousel delay
                    $scope.carousel_delay = response.carousel_delay/1000;
                });
                $http.post(eb.urls.advertisement.get_slider_image, {
                    'business_id' : business_id
                }).success(function(response) {
                    $scope.slider_images = response.slider_images;
                    if ($.trim(response.slider_images)) {
                        $('.reorder-note').show();
                    }
                    else {
                        $('.reorder-note').hide();
                    }
                });
            }
        });

        $scope.addNumBoxes = function(table_id) {
            var total_rows = $('#'+table_id+' tr').length + 1;
            if (total_rows <= 10) {
                $('#'+table_id).append('<tr><td>'+total_rows+'</td></tr>');
            }
        };

        $scope.reduceNumBoxes = function(table_id) {
            $('#'+table_id+' tr:last').remove();
        };

        $scope.deleteImageSlide = function(business_id, count, img_path) {
            if (confirm('Are you sure you want to delete this image?')) {
                $http.post(eb.urls.advertisement.delete_slider_image, {
                    business_id : business_id,
                    path : img_path
                }).success(function(response) {
                    $('#slide'+count).remove();
                    if (!$('#ad-images-preview tr').length) {
                        $('.reorder-note').hide();
                    }
                });
            }
        };

        $scope.adVideoEmbed = (function(business_id) {
            $('#image-submit-btn').addClass('btn-disabled');
            if (eb.jquery_functions.validYouTubeURL($scope.ad_video)) {
                $http.post(eb.urls.broadcast.ads_embed_video_url, {
                    business_id : business_id,
                    ad_video : $scope.ad_video
                }).success(function(response) {
                    $('#advideo-preview').attr('src', response.ad_video);
                    $('#advideo-danger').hide();
                    $('#advideo-success').fadeIn();
                    $('#advideo-success').fadeOut(7000);
                    $('#image-submit-btn').removeClass('btn-disabled');
                }).error(function() {
                    $('#advideo-danger').hide();
                    $('#advideo-success').fadeIn();
                    $('#image-submit-btn').removeClass('btn-disabled');
                });
            }
            else {
                alert('The Video URL is not a valid YouTube link.')
                $('#image-submit-btn').removeClass('btn-disabled');
            }
        });

        $scope.selectTV = (function(business_id) {
            if ($scope.tv_channel) {
                $http.post(eb.urls.broadcast.ads_tv_select_url, {
                    business_id : business_id,
                    tv_channel : $scope.tv_channel
                }).success(function() {
                    $('#tvchannel-danger').hide();
                    $('#tvchannel-success').fadeIn();
                    $('#tvchannel-success').fadeOut(7000);
                }).error(function() {
                    $('#tvchannel-danger').hide();
                    $('#tvchannel-success').fadeIn();
                });
            }
            else {
                alert('Please select a channel.')
            }
        });

        $scope.setTicker = (function(business_id) {
            $http.post(eb.urls.broadcast.save_ticker_url, {
                business_id : business_id,
                ticker_message : $scope.ticker_message,
                ticker_message2 : $scope.ticker_message2,
                ticker_message3 : $scope.ticker_message3,
                ticker_message4 : $scope.ticker_message4,
                ticker_message5 : $scope.ticker_message5
            }).success(function() {
                $('#ticker-danger').hide();
                $('#ticker-success').fadeIn();
                $('#ticker-success').fadeOut(7000);
            }).error(function() {
                $('#ticker-danger').hide();
                $('#ticker-success').fadeIn();
            });
        });

        $scope.setCarouselDelay = (function() {
            $http.post(eb.urls.advertisement.carousel_delay, {
                business_id : $scope.business_id,
                carousel_delay : $scope.carousel_delay
            }).success(function() {
                $('#carouseldelay-danger').hide();
                $('#carouseldelay-success').fadeIn();
                $('#carouseldelay-success').fadeOut(7000);
            }).error(function() {
                $('#carouseldelay-danger').hide();
                $('#carouseldelay-success').fadeIn();
            });
        });

        $scope.setRemainingCharacter = (function() {
            var bla = $('#ticker-message').val();
            var bla2 = $('#ticker-message2').val();
            var bla3 = $('#ticker-message3').val();
            var bla4 = $('#ticker-message4').val();
            var bla5 = $('#ticker-message5').val();
            var accepted_char = 95;
            if($('#lbl-ticker').css('visibility') == 'hidden') $('#lbl-ticker').css('visibility', 'visible');
            if($('#lbl-ticker2').css('visibility') == 'hidden') $('#lbl-ticker2').css('visibility', 'visible');
            if($('#lbl-ticker3').css('visibility') == 'hidden') $('#lbl-ticker3').css('visibility', 'visible');
            if($('#lbl-ticker4').css('visibility') == 'hidden') $('#lbl-ticker4').css('visibility', 'visible');
            if($('#lbl-ticker5').css('visibility') == 'hidden') $('#lbl-ticker5').css('visibility', 'visible');
            $scope.remaining_character = accepted_char - bla.length;
            $scope.remaining_character2 = accepted_char - bla2.length;
            $scope.remaining_character3 = accepted_char - bla3.length;
            $scope.remaining_character4 = accepted_char - bla4.length;
            $scope.remaining_character5 = accepted_char - bla5.length;
            if($scope.remaining_character < 0 ||
                $scope.remaining_character2 < 0 ||
                $scope.remaining_character3 < 0 ||
                $scope.remaining_character4 < 0 ||
                $scope.remaining_character5 < 0){
                $('#ticker-message-submit-btn').attr('disabled','disabled');
            }else{
                $('#ticker-message-submit-btn').removeAttr('disabled');
            }
        });

        $scope.turnOnTV = (function(business_id) {
            $http.post(eb.urls.broadcast.ads_tv_on_url, {
                business_id : business_id,
                status : $scope.tv_status
            }).success(function() {
                $('#turnon-danger').hide();
                $('#turnon-success').fadeIn();
            });
        });

        $scope.adType = (function(ad_type, business_id) {
            $http.post(eb.urls.broadcast.ads_type_url, {
                ad_type : ad_type,
                business_id : business_id
            }).success(function() {
                if (ad_type == 'video') {
                    $('#image-adtype').fadeOut(300, function() {
                        $('#video-adtype').show();
                    });
                }
                else {
                    $('#video-adtype').fadeOut(300, function() {
                        $('#image-adtype').show();
                    });
                }
            });
        });

        $scope.addTextField = function(business_id) {
            $http.post(eb.urls.forms.add_textfield_url, {
                business_id : business_id,
                text_field_label : $scope.text_field_label
            }).success(function(response) {
                $scope.displayFormFields(business_id);
                $('#add-text-field').modal('hide');
                $('#text-field-label').val('');
            });
        };

        $scope.addRadioButton = function(business_id) {
            $http.post(eb.urls.forms.add_radiobutton_url, {
                business_id : business_id,
                radio_button_label : $scope.radio_button_label,
                radio_value_a : $scope.radio_value_a,
                radio_value_b : $scope.radio_value_b
            }).success(function(response) {
                $scope.displayFormFields(business_id);
                $('#add-radio-button').modal('hide');
                $('#radio-button-label').val('');
                $('#radio-value-a').val('');
                $('#radio-value-b').val('');
            });
        };

        $scope.addCheckbox = function(business_id) {
            $http.post(eb.urls.forms.add_checkbox_url, {
                business_id : business_id,
                checkbox_label : $scope.checkbox_label
            }).success(function(response) {
                $scope.displayFormFields(business_id);
                $('#add-check-box').modal('hide');
                $('#check-box-label').val('');
            });
        };

        $scope.addDropdown = function(business_id) {
            $http.post(eb.urls.forms.add_dropdown_url, {
                business_id : business_id,
                dropdown_label : $scope.dropdown_label,
                dropdown_options : $scope.dropdown_options
            }).success(function(response) {
                $scope.displayFormFields(business_id);
                $('#add-dropdown').modal('hide');
                $('#dropdown-label').val('');
                $('#dropdown-options').val('');
            });
        };

        $scope.displayFormFields = function(business_id) {
            $http.post(eb.urls.forms.display_fields_url, {
                business_id : business_id
            }).success(function(response) {
                $scope.form_fields = response.form_fields;
            });
        };

        /*
         $scope.showPreviewForm = function(business_id) {
         $http.post(eb.urls.forms.display_fields_url, {
         business_id : business_id
         }).success(function(response) {
         $('#custom-fields-display').html(eb.jquery_functions.generateCustomFields(response));
         });
         };
         */

        $scope.deleteFormField = function(form_id) {
            if (confirm('Are you sure you want to delete this field?')) {
                $http.post(eb.urls.forms.delete_field_url, {
                    form_id : form_id
                }).success(function(response) {
                    $('.field-'+form_id).remove();
                });
            }
        };

        $scope.getBusinessAnalytics = function(startdate, enddate){
            $http.post('/business/business-analytics', { business_id: $scope.business_id, startdate: startdate, enddate: enddate }).success(function(response){
                $scope.analytics = response.analytics;
            });
        };

        $scope.saveQueueForwardingBusiness = function(){
            $http.post('/business/forwarding-permission/', {
                business_id: $scope.business_id,
                access_key: $scope.queue_forward_accesskey
            }).success(function(response){
                $scope.queue_forward_accesskey = '';
                $scope.allowed_businesses = response.allowed_businesses;
            });
        }

        $scope.deletePermission = function(forwarder_id){
            $http.post('/business/delete-permission/', {
                business_id: $scope.business_id,
                forwarder_id: forwarder_id
            }).success(function(response){
                $scope.allowed_businesses = response.allowed_businesses;
            });
        }

        $scope.getAccesskey = function(){
            $http.get('/business/access-key/' + $scope.business_id).success(function(response){
                $scope.my_accesskey = response.access_key;
            });
        }
    });

})();
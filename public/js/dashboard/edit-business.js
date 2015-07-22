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

    $(document).on('click', '#mobile-back-button', function(){
        $(this).fadeOut();
        $('.message-collection').fadeIn();
        $('.preview-container').fadeOut();
    });

    //eb.jquery_functions.load_users();
    eb.jquery_functions.setBusinessId($('#business_id').val());
    eb.jquery_functions.setUserId($('#user_id').val());
    eb.jquery_functions.getBusinessDetails();
    eb.jquery_functions.my_business_link_active();


});

var eb = {

    urls : {
        business: {
            business_details_url : $('#business-details-url').val() + '/',
            business_edit_url : $('#business-edit-url').val(),
            business_remove_url : $('#business-remove-url').val() + '/'
        },

        terminals: {
            terminal_create_url : $('#terminal-create-url').val() + '/',
            terminal_edit_url : $('#terminal-edit-url').val(),
            terminal_delete_url : $('#terminal-delete-url').val() + '/',
            terminal_assign_url : $('#terminal-assign-url').val() + '/',
            terminal_unassign_url : $('#terminal-unassign-url').val() + '/',
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
        }
    }
};


(function(){

    app.controller('editBusinessController', function($scope, $http){
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

        $scope.remaining_character  = 95;

        $scope.number_start = 1;
        $scope.terminal_specific_issue = 0;
        $scope.sms_current_number = 0;
        $scope.sms_1_ahead  = 0;
        $scope.sms_5_ahead  = 0;
        $scope.sms_10_ahead  = 0;
        $scope.sms_blank_ahead = 0;
        $scope.input_sms_field = 0;
        $scope.allow_remote = 0;

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
            $scope.frontline_secret = business.frontline_sms_secret;
            $scope.frontline_url = business.frontline_sms_url;
            $scope.sms_current_number = business.sms_current_number ? true : false;
            $scope.sms_1_ahead  = business.sms_1_ahead ? true : false;
            $scope.sms_5_ahead  = business.sms_5_ahead ? true : false;
            $scope.sms_10_ahead  = business.sms_10_ahead ? true : false;
            $scope.sms_blank_ahead = business.sms_blank_ahead ? true : false;
            $scope.input_sms_field = business.input_sms_field;
            $scope.allow_remote = business.allow_remote ? true : false;
            $scope.terminals = business.terminals;
            $scope.analytics = business.analytics;
            $scope.terminal_delete_error = business.error ? business.error : null;
        }

        setBusinessFeatures = function(features){
            if(features){
                $scope.business_features = features;
                if(features.terminal_users == undefined) features.terminal_users = 3;
            }

        }

        $scope.displayMessageList = function(business_id) {
            $http.post('/message/message-list', {
                business_id : business_id
            }).success(function(response) {
                $scope.messages = response.messages;
            });
        }

        /* @CSD 05062015 */
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

        $scope.unassignFromTerminal = function(user_id, terminal_id){
            $http.get(eb.urls.terminals.terminal_unassign_url + user_id + '/' + terminal_id)
                .success(function(response){
                    setBusinessFields(response.business);
                });
        }

        $scope.assignToTerminal = function(user_id, terminal_id){
            $http.get(eb.urls.terminals.terminal_assign_url + user_id + '/' + terminal_id)
                .success(function(response){
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

        $scope.deleteTerminal = function($event, terminal_id){
            $http.get(eb.urls.terminals.terminal_delete_url + terminal_id)
                .success(function(response){
                    setBusinessFields(response.business);
                    eb.jquery_functions.clear_terminal_delete_msg();
                });
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
            var new_name = $('.terminal-name-update[terminal_id='+terminal_id+']').val();
            $('.terminal-name-display[terminal_id='+terminal_id+']').text(new_name);
            $http.post(eb.urls.terminals.terminal_edit_url, {
                terminal_id : terminal_id,
                name : new_name
            }).success(function(response) {
                if(response.status){
                    $('.update-terminal-button[terminal_id=' + terminal_id + ']').hide();
                    $('.terminal-name-update[terminal_id=' + terminal_id + ']').hide();
                    $('.terminal-name-display[terminal_id=' + terminal_id + ']').show();
                    $('.edit-terminal-button[terminal_id=' + terminal_id + ']').show();
                    $('.terminal-error-message[terminal_id=' + terminal_id + ']').hide();
                }else{
                    $('.terminal-error-message[terminal_id=' + terminal_id + ']').show();
                    setTimeout(function(){$('.terminal-error-message[terminal_id=' + terminal_id + ']').fadeOut('slow')}, 3000);
                }
            }).error(function(response) {
                alert('Something went wrong..');
            });
            $event.preventDefault();
        });

        $scope.createTerminal = function(terminal_name){
            data = { name : terminal_name };
            $http.post(eb.urls.terminals.terminal_create_url + $scope.business_id, data)
                .success(function(response){
                    if(response.status == 0){
                        $('.terminal-error-msg').show();
                        setTimeout(function(){$('.terminal-error-msg').fadeOut('slow')}, 3000);
                    }else{
                        setBusinessFields(response.business);
                        $scope.terminal_name = '';
                        eb.jquery_functions.hide_add_terminal_form();
                        $('.terminal-error-msg').hide();
                    }
                });
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
                    frontline_sms_secret : $scope.frontline_secret,
                    frontline_sms_url : $scope.frontline_url,
                    sms_current_number : $scope.sms_current_number ? 1 : 0,
                    sms_1_ahead : $scope.sms_1_ahead ? 1 : 0,
                    sms_5_ahead : $scope.sms_5_ahead ? 1 : 0,
                    sms_10_ahead : $scope.sms_10_ahead ? 1 : 0,
                    sms_blank_ahead : $scope.sms_blank_ahead ? 1 : 0,
                    input_sms_field: $scope.input_sms_field,
                    allow_remote: $scope.allow_remote ? 1 : 0
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
                });
            }
        });

        $scope.adImageUpload = (function(business_id) {
            $('#image-submit-btn').addClass('btn-disabled');
            $('#ad-image-uploader').submit(function() {
                $(this).ajaxSubmit({
                    data : {
                        business_id : business_id
                    },
                    //target:   '#ad-preview',   // target element(s) to be updated with server response
                    beforeSubmit:  (function() {
                        //check whether browser fully supports all File API
                        if (window.File && window.FileReader && window.FileList && window.Blob)
                        {

                            var fsize = $('#ad-image')[0].files[0].size; //get file size
                            var ftype = $('#ad-image')[0].files[0].type; // get file type


                            //allow only valid image file types
                            switch(ftype)
                            {
                                case 'image/png': case 'image/jpeg': case 'image/jpg':
                                break;
                                default:
                                    $("#ad-preview").html("<b>"+ftype+"</b> Unsupported file type!");
                                    return false
                            }

                            //Allowed file size is less than 10 MB (1048576)
                            if(fsize>10485760)
                            {
                                $("#ad-preview").html("<b>"+fsize +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
                                return false
                            }

                            $('#image-submit-btn').hide(); //hide submit button
                            $('#loading-img').show(); //hide submit button
                        }
                        else
                        {
                            //Output error to older browsers that do not support HTML5 File API
                            $("#ad-preview").html("Please upgrade your browser, because your current browser lacks some new features we need!");
                            return false;
                        }
                    }),  // pre-submit callback
                    resetForm: true,        // reset the form after successful submit
                    success : function(response) {
                        var result = jQuery.parseJSON(response);
                        $('#ad-preview').attr('src', result.src);
                        $('#loading-img').hide();
                        $('#submit-btn').show();
                        $('#adimage-danger').hide();
                        $('#adimage-success').fadeIn();
                        $('#image-submit-btn').show();
                    },
                    error: function(response) {
                        $('#adimage-success').hide();
                        $('#adimage-danger').fadeIn();
                    }
                });  //Ajax Submit form
                // return false to prevent standard browser submit and page navigation
                return false;
            });
        });

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
                ticker_message : $scope.ticker_message
            }).success(function() {
                $('#ticker-danger').hide();
                $('#ticker-success').fadeIn();
                $('#ticker-success').fadeOut(7000);
            }).error(function() {
                $('#ticker-danger').hide();
                $('#ticker-success').fadeIn();
            });
        });

        $scope.setRemainingCharacter = (function() {
            var bla = $('#ticker-message').val();
            var accepted_char = 95;

            if($('#lbl-ticker').css('visibility') == 'hidden')
            {
                $('#lbl-ticker').css('visibility', 'visible');
            }
            $scope.remaining_character = accepted_char - bla.length;
            if($scope.remaining_character < 0){
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

        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };

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
    });

})();
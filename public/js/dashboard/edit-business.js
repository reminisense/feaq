/**
 * Created by USER on 2/3/15.
 */
$(document).ready(function(){
    $('.edit-business-cog').on('click', function(){
        eb.jquery_functions.setBusinessId($(this).attr('data-business-id'));
    });

    $('#editBusiness').on('show.bs.modal', function(){
        eb.jquery_functions.getBusinessDetails();
        $('#editbiz-tabs li.active a').trigger('click'); //ARA Added to execute functions triggered by clicking tabs
    });

    $('body').on('click', '#btn-addterminal',function () {
        $('#inputterminal').show();
        $('#btn-addterminal').hide();
    });

    $('body').on('click', '.btn-adduser', function(e){
        e.preventDefault();
        $(this).parent().find('.inputuser').show();
        $(this).hide();
    });

    $(document).on('change', '#ad-image', function(){
        $('#image-submit-btn').removeClass('btn-disabled');
    });

    $(document).on('change', '#ad-video', function(){
        $('#vid-submit-btn').removeClass('btn-disabled');
    });

    //eb.jquery_functions.load_users();
});

var eb = {

    urls : {
        business: {
            business_details_url : $('#business-details-url').val() + '/'
        },

        queue_settings : {
            queue_settings_get_url : $('#queue-settings-get-url').val() + '/',
            queue_settings_update_url : $('#queue-settings-update-url').val() + '/'
        }
    },

    jquery_functions : {
        getBusinessDetails : function(){
            var scope = angular.element($("#editBusiness")).scope();
            scope.$apply(function(){
                scope.getBusinessDetails();
            });
        },

        setBusinessId : function(business_id){
            var scope = angular.element($("#editBusiness")).scope();
            scope.$apply(function(){
                scope.business_id = business_id;
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
        }
    }
};


(function(){

    app.controller('editBusinessController', function($scope, $http){
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

        $scope.number_start = 1;
        $scope.terminal_specific_issue = 0;
        $scope.sms_current_number = 0;
        $scope.sms_1_ahead  = 0;
        $scope.sms_5_ahead  = 0;
        $scope.sms_10_ahead  = 0;
        $scope.sms_blank_ahead = 0;
        $scope.input_sms_field = 0;

        $scope.getBusinessDetails = function(){
            $http.get(eb.urls.business.business_details_url + $scope.business_id)
                .success(function(response){
                    setBusinessFields(response.business);
                });
        }

        setBusinessFields = function(business){
            $scope.business_id = business.business_id;
            $scope.business_name = business.business_name;
            $scope.business_address = business.business_address;
            $scope.facebook_url = business.facebook_url;
            $scope.industry = business.industry;
            $scope.time_open = business.time_open;
            $scope.time_closed = business.time_closed;
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
            $scope.terminals = business.terminals;
            $scope.analytics = business.analytics;
            $scope.terminal_delete_error = business.error ? business.error : null;

       }

        $scope.unassignFromTerminal = function(user_id, terminal_id){
            $http.get('terminal/unassign/' + user_id + '/' + terminal_id)
                .success(function(response){
                    setBusinessFields(response.business);
                });
        }

        $scope.assignToTerminal = function(user_id, terminal_id){
            $http.get('terminal/assign/' + user_id + '/' + terminal_id)
                .success(function(response){
                    setBusinessFields(response.business);
                });
        }

        $scope.emailSearch = function(email, terminal_id){
            $http.get('user/emailsearch/' + email)
                .success(function(response){
                    if(response.user){
                        $scope.user_found = true;
                        $scope.assignToTerminal(response.user.user_id, terminal_id);
                    }else{
                        $scope.user_found = false;
                    }
                });
        }


        $scope.deleteTerminal = function(terminal_id){
            $http.get('terminal/delete/' + terminal_id)
                .success(function(response){
                    setBusinessFields(response.business);
                });
        }

        $scope.editTerminal = function(terminal_id){
            $('.terminal-name-display[terminal_id='+terminal_id+']').hide();
            $('.edit-terminal-button[terminal_id='+terminal_id+']').hide();
            $('.terminal-name-update[terminal_id='+terminal_id+']').show();
            $('.update-terminal-button[terminal_id='+terminal_id+']').show();
        }

        $scope.updateTerminal = (function(terminal_id) {
            var new_name = $('.terminal-name-update[terminal_id='+terminal_id+']').val();
            $('.terminal-name-display[terminal_id='+terminal_id+']').text(new_name);
            $http.post('/terminal/edit', {
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
                }
            }).error(function(response) {
                alert('Something went wrong..');
            });
        });

        $scope.createTerminal = function(terminal_name){
            data = { name : terminal_name };
            $http.post('terminal/create/' + $scope.business_id, data)
                .success(function(response){
                    if(response.status == 0){
                        $('.terminal-error-msg').show();
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
                    queue_limit: $scope.queue_limit, /* RDH Added queue_limit to Edit Business Page */
                    terminal_specific_issue : $scope.terminal_specific_issue ? 1 : 0,
                    frontline_sms_secret : $scope.frontline_secret,
                    frontline_sms_url : $scope.frontline_url,
                    sms_current_number : $scope.sms_current_number ? 1 : 0,
                    sms_1_ahead : $scope.sms_1_ahead ? 1 : 0,
                    sms_5_ahead : $scope.sms_5_ahead ? 1 : 0,
                    sms_10_ahead : $scope.sms_10_ahead ? 1 : 0,
                    sms_blank_ahead : $scope.sms_blank_ahead ? 1 : 0,
                    input_sms_field: $scope.input_sms_field
                }

                $http.post('/business/edit-business', data)
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
                $http.post('/business/remove', {
                    business_id : business_id
                }).success(function(response) {
                    $('.col-md-3[business_id='+business_id+']').remove();
                    $('#editBusiness').hide();
                });
            }
        });

        $scope.activateTheme = (function(theme_type, business_id, show_called_only) {
            $http.post('/broadcast/set-theme', {
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

        $scope.currentActiveTheme = (function(business_id) {
            $http.get('/json/'+business_id+'.json?nocache='+Math.floor((Math.random() * 10000) + 1)).success(function(response) {
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
            });
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
            $http.post('/advertisement/embed-video', {
                business_id : business_id,
                ad_video : $scope.ad_video
            }).success(function(response) {
                $('#advideo-preview').attr('src', response.ad_video);
                $('#advideo-danger').hide();
                $('#advideo-success').fadeIn();
            }).error(function() {
                $('#advideo-danger').hide();
                $('#advideo-success').fadeIn();
            });
        });

        $scope.selectTV = (function(business_id) {
            $http.post('/advertisement/tv-select', {
                business_id : business_id,
                tv_channel : $scope.tv_channel
            }).success(function() {
                $('#tvchannel-danger').hide();
                $('#tvchannel-success').fadeIn();
            }).error(function() {
                $('#tvchannel-danger').hide();
                $('#tvchannel-success').fadeIn();
            });
        });

        $scope.turnOnTV = (function(business_id) {
            $http.post('/advertisement/turn-on-tv', {
                business_id : business_id,
                status : $scope.tv_status
            }).success(function() {
                $('#turnon-danger').hide();
                $('#turnon-success').fadeIn();
            });
        });

        $scope.adType = (function(ad_type, business_id) {
            $http.post('/advertisement/ad-type', {
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
    });

})();
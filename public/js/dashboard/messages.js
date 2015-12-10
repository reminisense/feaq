/**
 * Created by polljii on 7/28/15.
 */

(function() {

    app.controller('messagingController', function($scope, $http) {

        websocket = new ReconnectingWebSocket(mailsocket_url);

        websocket.onmessage = function (response) { // what happens when data is received
            var result = JSON.parse(response.data);
            $scope.setPreviewMessage(result.preview_type, "", result.message_id, "");
        };

        websocket.onopen = function (response) { // connection is open
            $('#WebsocketLoaderModal').modal('hide');
        }

        $scope.messages = [];
        $scope.assigned_businesses = [];
        $scope.business_reply_form = {
            message_reply : "",
            active_sender_email : "",
            attachment : "",
            thread_message_id : "",
            pick_number : 0,
            preview_type : ''
        };

        $scope.displayBusinessInbox = function() {
            $('.yes-messages').hide();
            $('.no-messages').hide();
            $('.message-preview').hide();
            $scope.business_reply_form.preview_type = 'business';
            $http.post('/message/assigned-businesses').success(function(response) {
                $scope.assigned_businesses = response.businesses;
            });
            $http.post('/message/business-inbox').success(function(response) {
                if (response.messages.length == 0) {
                    $('.no-messages').fadeIn();
                }
                else {
                    $('.yes-messages').fadeIn();
                }
                $('#assigned-businesses').fadeIn();
                $scope.messages = response.messages;
            });
        };

        $scope.displayOtherInbox = function() {
            $('.yes-messages').hide();
            $('.no-messages').hide();
            $('#assigned-businesses').hide();
            $('.message-preview').hide();
            $scope.business_reply_form.preview_type = 'other';
            $http.post('/message/other-inbox').success(function(response) {
                if (response.messages.length == 0) {
                    $('.no-messages').fadeIn();
                }
                else {
                    $('.yes-messages').fadeIn();
                }
                $scope.messages = response.messages;
            });
        };

        $scope.filterMessages = function(business_id) {
            $('.message-preview').hide();
            $('.message-item').hide();
            $('.message-item[business_id="'+business_id+'"]').show();
        };

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

        $scope.setPreviewMessage = function(preview_type, sender, message_id, active_email){
            $('.message-preview').hide();
            $('.preview-container').fadeIn();
            if (isMobile.any() != null){
                $('.business-inbox').hide();
                $('#mobile-back-button').parent().removeClass('hidden').fadeIn();
                $('.message-collection').fadeOut();
            }
            $scope.business_reply_form.active_sender_email = active_email;
            $scope.business_reply_form.thread_message_id = message_id;
            $http.post('/message/message-thread', {
                message_id : message_id,
                preview_type : preview_type
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
                $('.message-preview').fadeIn(function(){
                    var uploadcareWidget = uploadcare.SingleWidget('#business-attachment');
                    uploadcareWidget.onChange(function(file){
                        $('#sendreply').addClass('disabled');
                    }).onUploadComplete(function(file){
                        $('#sendreply').removeClass('disabled');
                    });
                });
            });
        };

        $scope.sendBusinessReply = function(preview_type){
            $('#sendreply').html('Sending... &nbsp;<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>');
            $('#sendreply').attr('disabled', '');
            $http.post('/message/sendto-user', {
                preview_type : preview_type,
                message_id: $scope.business_reply_form.thread_message_id,
                messageContent: $scope.business_reply_form.message_reply,
                attachment : $('#business-attachment').val()
            }).success(function(response){
                websocket.send(JSON.stringify({
                    message_id: scope.business_reply_form.thread_message_id,
                    preview_type: preview_type,
                    message_update: true
                }));
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
        };

        $scope.loadDefaultNavLink = function(){
            $('#my-business').removeClass('active');
            $('#search-business').removeClass('active');
            $('#message-inbox').addClass('active');
        };

        websocket.onerror = function (response) {
            $('#WebsocketLoaderModal').modal('show');
        };

        websocket.onclose = function (response) {
            $('#WebsocketLoaderModal').modal('show');
        };

    });

})();


$(document).ready(function() {
    var scope = angular.element($("#messageInbox")).scope();
    scope.$apply(function(){
        scope.displayBusinessInbox();
        scope.loadDefaultNavLink();
    });

    $(document).on('click', '.business-tab', function(){
        $('.business-tab').removeClass('active-btn-biz');
        $(this).addClass('active-btn-biz');
    });

    $(document).on('click', '#mobile-back-button', function(){
        $(this).parent().fadeOut();
        $('.message-collection').fadeIn();
        $('.business-inbox').fadeIn();
        $('.preview-container').fadeOut();
    });

    $('#my-business').removeClass('active');
    $('#search-business').removeClass('active');
    $('#message-inbox').addClass('active');
});
/**
 * Created by polljii on 7/28/15.
 */

(function() {

    app.controller('messagingController', function($scope, $http) {

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
            $('#assigned-businesses').show();
            $('.message-preview').hide();
            $scope.business_reply_form.preview_type = 'business';
            $http.post('/message/assigned-businesses').success(function(response) {
                $scope.assigned_businesses = response.businesses;
            });
            $http.post('/message/business-inbox').success(function(response) {
                $scope.messages = response.messages;
            });
        };

        $scope.displayOtherInbox = function() {
            $('#assigned-businesses').hide();
            $('.message-preview').hide();
            $scope.business_reply_form.preview_type = 'other';
            $http.post('/message/other-inbox').success(function(response) {
                $scope.messages = response.messages;
            });
        };

        $scope.filterMessages = function(business_id) {
            $('.message-preview').hide();
            $('.message-item').hide();
            $('.message-item[business_id="'+business_id+'"]').show();
        };

        $scope.setPreviewMessage = function(preview_type, sender, message_id, active_email){
            $('.message-preview').hide();
            $('.preview-container').fadeIn();
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
                $('.message-preview').fadeIn();
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

    });

})();

$(document).ready(function() {
    var scope = angular.element($("#messageInbox")).scope();
    scope.$apply(function(){
        scope.displayBusinessInbox();
    });

    $(document).on('click', '.business-tab', function(){
        $('.business-tab').removeClass('active-btn-biz');
        $(this).addClass('active-btn-biz');
    });
});

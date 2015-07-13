/**
 * Created by USER on 5/26/15.
 */
app.controller('messageController', function($scope, $http){
    $scope.messages = [];
    $scope.getMessages = function(){
        $scope.messages = [];
        $http.post('/message/business-user-thread', {
            business_id : pq.ids.business_id,
            email: $('#priority-number-email').html()
        }).success(function(response) {
            $scope.messages = response.contactmessage;
        });
    }

    $scope.sendBusinessReply = function(){
        $http.post('/message/sendto-user', {
            business_id: pq.ids.business_id,
            contactemail: $('#priority-number-email').html(),
            phonenumber : $('#priority-number-phone').html(),
            messageContent: $scope.message_reply,
            sendbyphone : $scope.send_to_phone
        }).success(function(response){
            $scope.message_reply = '';
            $scope.getMessages();
        });
    }
});
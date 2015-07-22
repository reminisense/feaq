/**
 * Created by USER on 5/26/15.
 */
app.controller('messageController', function($scope, $http){
    $scope.allow_send = false;
    $scope.messages = [];
    $scope.getMessages = function(){
        $scope.messages = [];
        $http.post('/message/business-user-thread', {
            business_id : pq.ids.business_id,
            email: $('#priority-number-email').html()
        }).success(function(response) {
            $scope.messages = response.contactmessage;
            $scope.allow_send = true;
            $scope.message_reply = '';
        }).error(function(response){
            $scope.allow_send = false;
            $scope.message_reply = 'Cannot send a reply unless the customer sends an initial message.'
        }).finally(function(){
            console.log($scope.allow_send);
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
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
            $scope.message_id = response.message_id;
            $scope.allow_send = true;
        }).error(function(response){
            $scope.allow_send = false;
        });
    }

    $scope.sendBusinessReply = function(){
        $http.post('/message/sendto-user', {
            preview_type: 'other',
            message_id: $scope.message_id,
            messageContent: $scope.message_reply,
            attachment : $('#business-attachment').val()
        }).success(function(response){
            $scope.message_reply = '';
            $scope.getMessages();
        });
    }
});
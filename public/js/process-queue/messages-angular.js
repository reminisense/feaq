/**
 * Created by USER on 5/26/15.
 */
app.controller('messageController', function($scope, $http){
    $scope.allow_send = true;
    $scope.messages = [];
    $scope.getMessages = function(){
        $scope.messages = [];
        $scope.message_id = null;
        $http.post('/message/business-user-thread', {
            business_id : pq.ids.business_id,
            email: $('#priority-number-email').html()
        }).success(function(response) {
            $scope.messages = response.contactmessage;
            $scope.message_id = response.message_id;
            $scope.allow_send = true;
        }).error(function(response){
            //$scope.allow_send = false;
        });
    }

    $scope.sendBusinessReply = function(){
        data = {
            messageContent: $scope.message_reply,
            attachment : $('#business-attachment').val()
        }

        if($scope.message_id){
            data.message_id = $scope.message_id;
        }else{
            data.business_id = pq.ids.business_id;
            data.email = $('#priority-number-email').html();
        }

        $http.post('/message/sendto-user', data)
            .success(function(response){
                $scope.message_reply = '';
                $scope.getMessages();
                var singleWidget = uploadcare.SingleWidget('#business-attachment');
                singleWidget.value(null);
            });
    }
});
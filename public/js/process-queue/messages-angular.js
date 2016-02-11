/**
 * Created by USER on 5/26/15.
 */
app.controller('messageController', function($scope, $http){

    /**
     * uploadcare functions
     *
     */
    var uploadcareWidget = uploadcare.SingleWidget('#business-attachment');
    uploadcareWidget.onChange(function(file){
        $scope.allow_send = false;
    }).onUploadComplete(function(file){
        $scope.allow_send = true;
    });



    /**
     * scope functions
     */
    $scope.allow_send = true;
    $scope.messages = [];
    $scope.getMessages = function(){
        $scope.allow_send = false;
        $scope.messages = [];
        $scope.message_id = null;
        $('.glyphicon-refresh').addClass('glyphicon-refresh-animate');
        $http.post('/message/business-user-thread', {
            business_id : pq.ids.business_id,
            email: $('#priority-number-email').html()
        }).success(function(response) {
            $scope.messages = response.contactmessage;
            $scope.message_id = response.message_id;
            $scope.allow_send = true;
        }).error(function(response){
            $scope.allow_send = false;
        }).finally(function(){
            //$scope.allow_send = true;
            $('.glyphicon-refresh').removeClass('glyphicon-refresh-animate');
        });
    }

    $scope.sendBusinessReply = function(){
        $scope.allow_send = false;
        data = {
            messageContent: $scope.message_reply,
            attachment : $('#business-attachment').val()
        }

        if($scope.message_id){
            data.message_id = $scope.message_id;
        }else {
            data.business_id = pq.ids.business_id;
            data.email = $('#priority-number-email').html();
        }

        $('.glyphicon-refresh').addClass('glyphicon-refresh-animate');
        $http.post('/message/sendto-user', data)
            .success(function(response){
                $scope.message_reply = '';
                $scope.getMessages();
                uploadcareWidget.value(null);
            }).finally(function(){
                $scope.allow_send = false;
                $('.glyphicon-refresh').removeClass('glyphicon-refresh-animate');
            });
    }


});
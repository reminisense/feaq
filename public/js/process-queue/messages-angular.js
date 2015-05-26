/**
 * Created by USER on 5/26/15.
 */
app.controller('messageController', function($scope, $http){
    $scope.messages = [];
    $scope.getMessages = function(){
        console.log(pq.ids.business_id);
        console.log($('#priority-number-email').html());
        data = {
            business_id : pq.ids.business_id,
            email: $('#priority-number-email').html()
        }
        $http.post('/message/business-user-thread', data).success(function(response) {
            $scope.messages = response.contactmessage;
            console.log(response);
        });
    }
});
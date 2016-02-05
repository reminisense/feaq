/**
 * Created by aunne on 26/01/2016.
 */
//angularjs implementation

app.controller('emailAuthController', function($scope, $http){
    $scope.email = '';
    $scope.password = '';
    $scope.password_confirm = '';
    $scope.error_message = '';
    $scope.success_message = '';

    $scope.send_password_reset = function(){
        $http.post('/user/send-reset', {email: $scope.email}).success(function(response){
            $scope.message = 'Password reset link sent.';
        });
    }

    $scope.login = function(){
        $('#FBLoaderModal').modal('show');
        $http.post('/user/email-login', {email: $scope.email, password: $scope.password}).success(function(response){
            if(response.redirect != undefined){
                window.location.href = response.redirect;
            }else if(response.error != undefined){
                $('#FBLoaderModal').modal('hide');
                $scope.error_message = response.error;
            }
        });
    }

    $scope.register = function(){
        if($scope.password != $scope.password_confirm){
            $scope.error_message = "Passwords do not match."
        }else{
            $http.post('/user/email-registration', {email: $scope.email, password: $scope.password, password_confirm: $scope.password_confirm}).success(function(response) {
                if(response.message != undefined){
                    $scope.success_message = response.message;
                    $scope.error_message = '';
                }else if(response.redirect != undefined){
                    window.location.href = response.redirect;
                }else if(response.error != undefined){
                    $scope.success_message = '';
                    $scope.error_message = response.error;
                }
            });
        }
    }

    $scope.verify = function(){
        $scope.email = $('#email').val();
        $scope.mobile = $('#mobile').val();
        $scope.location = $('#location').val();

        $('#start_queuing').attr('disabled', '');
        var errorMessage = '';
        if ($scope.first_name == ""){
            errorMessage = "First Name field is required. ";
        }

        if ($scope.last_name == ""){
            errorMessage = errorMessage + "Last Name field is required. ";
        }

        if ($scope.email == ""){
            errorMessage = errorMessage + "Email field is required. ";
        }

        if (!isValidPhone($scope.mobile) && ($scope.mobile == '0' || $scope.mobile == '')){
            errorMessage = errorMessage + "Mobile field is required. ";
        }

        if ($scope.location == ""){
            errorMessage = errorMessage + "Location field is required. ";
        }

        if (!isEmail($scope.email)){
            errorMessage = errorMessage + "Invalid Email field input. ";
        }

        if (errorMessage == ""){
            $('#start_queuing').html('PROCESSING... &nbsp;<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>');

            var data = {
                first_name: $scope.first_name,
                last_name: $scope.last_name,
                email: $scope.email,
                mobile: $scope.mobile,
                location: $scope.location
            }

            $http.post('/user/verify-user', data).success(function(response){
                $('#start_queuing').removeAttr('disabled');
                $('#start_queuing').html('START QUEUING');
                window.location.reload();
            });
        } else {
            $('#start_queuing').removeAttr('disabled');
            $('#verifyError').text(errorMessage);
            $('#verifyError').fadeIn( 400 );
        }
    }
});


$("#location").geocomplete();

$("#mobile").intlTelInput({
    defaultCountry: "auto"
});

$('#mobile').keypress(function(key) {
    if(key.charCode < 48 || key.charCode > 57) return false;
});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function isValidPhone (txtPhone) {
    var filter = /^[0-9-+]+$/;
    if (filter.test(txtPhone)) {
        return true;
    } else {
        return false;
    }
}
var business_id = $('#business-id').attr('business_id');

var callNumberSound = function (soundobj)
{
    var thissound = document.getElementById(soundobj);
    thissound.play();
};

var announceNumber = function ($scope, response, rank_num, box_num, name_num, service_num, color_num, user_num)
{
    if (typeof response[box_num] != 'undefined') {
        if ($scope[rank_num] != response[box_num].rank) {
            $scope[rank_num] = response[box_num].rank;
            $scope[name_num] = response[box_num].terminal;
            $scope[service_num] = response[box_num].service;
            $scope[color_num] = response[box_num].color;
            $scope[user_num] = response[box_num].user;
            if ($scope[rank_num] != "") {
                callNumberSound('call-number-sound');
            }
        }
    }
};

var announceNumberFromBlank = function ($scope, response, box_num, rank_num)
{
    if (typeof response[box_num] != 'undefined') {
        if ($scope[box_num] != response[box_num].number && $scope[rank_num] != "") {
            callNumberSound('call-number-sound');
        }
        if (box_num == "box1") {
            responsiveVoice.speak(response[box_num].number, "UK English Male", {rate: .6, pitch: .9});
        }
    }
};

var writeNumber = function ($scope, response, box_num, service_num, user_num, color_num)
{
    if (typeof response[box_num] != 'undefined') {
        $scope[box_num] = response[box_num].number;
        $scope[service_num] = response[box_num].service;
        $scope[user_num] = response[box_num].user;
        $scope[color_num] = response[box_num].color;
    }
};

var getNum = function ($scope, response)
{
    var service_id = $('#services').val();
    if (service_id) {
        $scope.get_num = response.services[service_id].get_num;
    } else {
        $scope.get_num = (response.get_num === "") ? "-" : response.get_num;
    }
};

var writeNumberToBoxes = function ($scope, response, box_num, service, current, terminal, color, called)
{
    $scope[service] = response[box_num].group_name;
    $scope[current] = response[box_num].current_number;
    if (response[box_num].current_number != "") {
        $scope[terminal] = response[box_num].service_name + " - " + response[box_num].terminal;
    }
    else {
        $scope[terminal] = response[box_num].service_name;
    }
    $scope[color] = response[box_num].color;
    $scope[called] = response[box_num].called_numbers;
//    responsiveVoice.speak(response[box_num].current_number, "UK English Male", {rate: .6, pitch: .9});
};

var checkGroupExistenceInBroadcast = function (groupList, now_group_id)
{
    if (groupList.indexOf(now_group_id.toString()) == -1) {
        return false;
    }
    return true;
}

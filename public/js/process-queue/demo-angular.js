/**
 * Created by USER on 12/15/2015.
 */
app.controller('demoController', function($scope){
    $scope.data = {
        issue_number: 1,
        selected_number: null,
        issued_numbers: [],
        called_numbers: []
    }
    $scope.boxes = {
        box1: {
            terminal: '',
            number: '',
            box_class: ''
        },
        box2: {
            terminal: '',
            number: '',
            box_class: ''
        },
        box3: {
            terminal: '',
            number: '',
            box_class: ''
        },
        box4: {
            terminal: '',
            number: '',
            box_class: ''
        }
    }

    $scope.callNumber = function(terminal, number, box){
        $scope.boxes.box4 = $scope.boxes.box3;
        $scope.boxes.box3 = $scope.boxes.box2;
        $scope.boxes.box2 = $scope.boxes.box1;
        $scope.boxes.box1 = {terminal: terminal, number: number, box_class: box};
        $scope.data.called_numbers.push($scope.boxes.box1);
        $scope.nextNumber(number);
        $scope.removeIssuedNumber(number);
    }

    $scope.stop = function(){
        $scope.boxes.box4 = {terminal: '', number: '', box_class: ''};
        $scope.boxes.box3 = {terminal: '', number: '', box_class: ''};
        $scope.boxes.box2 = {terminal: '', number: '', box_class: ''};
        $scope.boxes.box1 = {terminal: '', number: '', box_class: ''};
        $scope.data.called_numbers = [];
    }

    $scope.drop = function(box_number){
        $scope.removeCalledNumber($scope.boxes['box' + box_number].number);
        $scope.resetBoxes();
    }

    $scope.next = function(served_number, terminal, number, box){
        $scope.removeCalledNumber(served_number);
        $scope.callNumber(terminal, number, box);
        $scope.resetBoxes();
        $scope.nextNumber(number);
        $scope.updateDropdown();
    }

    $scope.getNumber = function(number){
        $scope.data.issued_numbers.push(number);
        $scope.nextNumber(number);
        $scope.updateDropdown();
    }

    $scope.nextNumber = function(number){
        if(number == $scope.data.issue_number){$scope.data.issue_number++;}
    }

    $scope.removeIssuedNumber = function(number){
        for(var i = $scope.data.issued_numbers.length - 1; i >= 0; i--) {
            if($scope.data.issued_numbers[i] == number) {
                $scope.data.issued_numbers.splice(i, 1);
                $scope.updateDropdown();
                break;
            }
        }
    }

    $scope.removeCalledNumber = function(number){
        for(var i = $scope.data.called_numbers.length - 1; i >= 0; i--) {
            if($scope.data.called_numbers[i].number == number) {
                $scope.data.called_numbers.splice(i, 1);
                break;
            }
        }
    }

    $scope.updateDropdown = function(){
        $scope.data.selected_number = $scope.data.issued_numbers[0];
    }

    $scope.resetBoxes = function(){
        for(var i = 1; i <= 4; i++){
            if(i <= $scope.data.called_numbers.length){
                $scope.boxes['box' + i] = $scope.data.called_numbers[$scope.data.called_numbers.length - i];
            }else{
                $scope.boxes['box' + i] = {terminal: '', number: '', box_class: ''};
            }
        }
    }

});
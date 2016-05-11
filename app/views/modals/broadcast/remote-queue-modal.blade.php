<!-- modal -->
<div id="urls">
    <!-- ids -->
    {{--<input type="hidden" id="service-id" value="{{ $first_service->service_id }}">--}}
    <input type="hidden" id="terminal-id" value="">

    <!-- urls-->
    <input type="hidden" id="issue-multiple-url" value="{{ url('/issuenumber/multiple/') }}">
    <input type="hidden" id="issue-specific-url" value="{{ url('/issuenumber/insertspecific/') }}">
</div>

<div class="modal fade" id="remote-queue-modal" tabindex="-1" ng-controller="issuenumberController">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="myModalLabel">Get This Number</h3>
            </div>
            <div class="modal-body" style=" border-bottom: 1px dotted #ccc;">
                <div class="clearfix">
                    <div class="tab-pane fade active in" id="insertq">
                        <form class="navbar-form navbar-left" name="issue_specific_form">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Number</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" disabled class="form-control" ng-model="get_num" name="number" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="name" value="@{{ contactname }}" readonly name="name" required>
                                </div>

                                <div class="col-md-4">
                                    <label>Cellphone</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="issued-number-phone" type="text" class="form-control" ng-model="phone" value="@{{ contactmobile }}" name="phone" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" ng-model="email" value="@{{ contactemail }}" readonly name="email" required>
                                </div>
                            </div>
                            <div class="alert alert-danger" role="alert" ng-show="issue_specific_error.length > 0">
                                <div><strong class="message">@{{ issue_specific_error }}</strong></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="clearfix">
                    <div class="tab-pane fade active in" id="insertq">
                        <form class="navbar-form navbar-left" name="issue_specific_form">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Gender <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-md-8" style="margin-bottom: 20px">
                                    <input type="radio" ng-model="gender" name="gender" value="male"> Male
                                    <input type="radio"  ng-model="gender" name="gender" value="female"> Female
                                </div>
                                <div class="col-md-4">
                                    <label>Age  <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" ng-model="age" name="age" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Birthday  <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    {{--<input id="issued-number-phone" type="text" class="form-control" ng-model="phone" value="@{{ contactmobile }}" name="phone" required>--}}
                                    <input type="text" class="form-control datepicker" id="date" name="date"/>
                                </div>
                                <div class="col-md-4">
                                    <label>Height  <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" ng-model="height" name="height" required placeholder="in Centimeters.">
                                </div>
                                <div class="col-md-4">
                                    <label>Weight  <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" ng-model="weight" name="weight" required placeholder="in Kilograms.">
                                </div>
                                <div class="col-md-4">
                                    <label>Blood Type  <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" ng-model="bloodtype" name="bloodtype" id="bloodtype">
                                        <option value="" disabled selected>Select your bloodtype</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                </div>
                                {{--<div class="col-md-8">--}}
                                    {{--<input type="email" class="form-control" ng-model="email" value="@{{ contactemail }}" readonly name="email" required>--}}
                               {{----}}
                                {{--</div>--}}
                                {{--<div class="col-md-4">--}}
                                    {{--<label>Medication</label>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-8">--}}
                                    {{--<textarea rows="5" class="form-control" ng-model="medication" name="medication" style=" resize: none;"></textarea>--}}
                                {{--</div>--}}
                                <div class="col-md-4">
                                    <label>Allergies</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea rows="3" class="form-control" ng-model="allergies"  name="allergies" style=" resize: none;" placeholder="sushi, shrimps"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="alert alert-success" style="display: none; text-align: center" role="alert" id="issue-number-success">
                    <p style="text-align: center; font-family: 'ralewayregular'; font-size: 14px;"> Your are number <strong>1</strong> and your data has been submitted.</p>
                </div>
                <div class="alert alert-danger" style="display: none; text-align: center" role="alert" id="issue-number-error">
                    <p style="text-align: center; font-family: 'ralewayregular'; font-size: 14px;"> Please fill up all the required fields.</p>
                </div>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-orange btn-lg" data-dismiss="modal" aria-label="Close">CLOSE</button>--}}
                <button id="issue-specific-submit" type="button" class="btn btn-orange btn-lg" ng-disabled="isIssuing" ng-click="getNumberSubmitForm()">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->
<!-- modal -->
<div id="urls">
    <!-- ids -->
    <input type="hidden" id="service-id" value="{{ $first_service->service_id }}">
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
            <div class="modal-body">
                <div class="clearfix">
                    <div class="tab-pane fade active in" id="insertq">
                        <form class="navbar-form navbar-left" name="issue_specific_form">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Number</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="get_num" name="number" required>
                                </div>

                                <div class="col-md-4">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="name" name="name" required>
                                </div>

                                <div class="col-md-4">
                                    <label>Cellphone</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="phone" name="phone" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" ng-model="email" name="email" required>
                                </div>
                            </div>
                            <div class="alert alert-danger" role="alert" ng-show="checkIssueSpecificErrors(priority_number)">
                                <div><strong class="message">@{{ issue_specific_error }}</strong></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="alert alert-success" style="display: none" role="alert" id="issue-number-success">
                    <div><strong class="message"></strong></div>
                </div>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-orange btn-lg" data-dismiss="modal" aria-label="Close">CLOSE</button>--}}
                <button id="issue-specific-submit" type="button" class="btn btn-orange btn-lg" ng-disabled="isIssuing || checkIssueSpecificErrors()" ng-click="issueSpecific(priority_number, name, phone, email, time_assigned)">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->
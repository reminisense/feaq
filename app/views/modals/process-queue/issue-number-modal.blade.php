<!-- modal -->
<div class="modal fade" id="moreq" tabindex="-1" ng-controller="issuenumberController">
    <point-of-interest position="left" bottom="84" right="64" title="Issue Specific Number" description="This tab allows you to issue one specific number and input information about the person assigned to the number."></point-of-interest>
    <point-of-interest position="right" bottom="84" right="56" title="Issue Multiple Numbers" description="This tab allows you to issue multiple numbers depending on the range that you provide."></point-of-interest>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="myModalLabel">Insert Queue</h3>
            </div>
            <div class="modal-body">
                {{--ARA 09132016 Commented out to remove issue multiple numbers--}}
                <ul id="pmore-tab" class="nav nav-tabs">
                    <li class="active"><a data-submit="#issue-specific-submit" href="#insertq" data-toggle="tab">INSERT TO QUEUE</a></li>
                    {{--<li><a data-submit="#issue-multiple-submit" href="#multipleq" data-toggle="tab" >ISSUE MULTIPLE</a></li>--}}
                </ul>
                <div class="clearfix">
                    <div class="" id="insertq">
                        <form class="navbar-form navbar-left" name="issue_specific_form">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label><strong>Specific #</strong></label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group mb20" style="width: 100%;">
                                        <span class="input-group-addon" ng-show="number_prefix">@{{ number_prefix }}</span>
                                        <input type="text" min="1" class="form-control" ng-model="priority_number" name="priority_number">
                                        <span class="input-group-addon" ng-show="number_suffix">@{{ number_suffix }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Time to call</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" ng-model="time_assigned" name="time_assigned" placeholder="ex. 01:59 am"> <!--ARA for timebound numbers-->
                                </div>
                                <div class="col-md-3">
                                    <label><strong>Name</strong></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" ng-model="name" name="name">
                                </div>
                                <div class="col-md-3">
                                    <label><strong>Cellphone</strong></label>
                                </div>
                                <div class="col-md-9 mb20">
                                    <input type="text" class="form-control" ng-model="phone" name="phone" id="issued-number-phone">
                                </div>
                                <div class="col-md-3">
                                    <label><strong>Email</strong></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" ng-model="email" name="email">
                                </div>
                                <div class="col-md-12">
                                    <div class="alert alert-info col-md-12 text-center">
                                        <p>An empty value in the <strong>Specific #</strong> field will automatically give you the next available number.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-warning" role="alert" ng-show="priority_number.length > 3">
                                <div>
                                    <strong class="message">Please make sure that the length of your number will fit the boxes of your broadcast screen.
                                        <br/>The ideal number of characters that will fit the broadcast screen is 4 characters.
                                        <br/>Very long numbers might cause the broadcast screen to display incorrectly.
                                    </strong>
                                </div>
                            </div>
                            <div class="alert alert-danger col-md-12" role="alert" ng-show="issue_specific_error.length > 0">
                                <div><strong class="message">@{{ issue_specific_error }}</strong></div>
                            </div>
                        </form>
                    </div>
                    {{--ARA 09132016 Commented out to remove issue multiple numbers--}}
                    {{--<div class="tab-pane fade" id="multipleq" aria-labelledby="profile-tab">--}}
                        {{--<form class="navbar-form navbar-left" name="issue_multiple_form">--}}
                            {{--<div class="form-group">--}}
                                {{--<div class="col-md-3">--}}
                                    {{--<label><strong>First Number</strong></label>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<input type="number" class="form-control" ng-model="number_start" name="number_start" required>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-3">--}}
                                    {{--<label><strong>Last Number</strong></label>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<input type="number" class="form-control" ng-model="number_end" name="number_end" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="alert alert-danger" role="alert" ng-show="issue_multiple_error.length > 0">--}}
                                {{--<div><strong class="message">@{{ issue_multiple_error }}</strong></div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                </div>
                <div class="alert alert-success" style="display: none" role="alert" id="issue-number-success">
                    <div><strong class="message"></strong></div>
                </div>
                {{--ARA 09132016 Commented out to remove issue multiple numbers--}}
                <div class="alert alert-danger" style="display: none" role="alert" id="issue-number-error">
                    <div><strong class="message"></strong></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="issue-specific-submit" type="button" class="issue-submit-btn btn btn-orange btn-md" ng-disabled="isIssuing" ng-click="checkIssueSpecificErrors(priority_number, number_limit)">SUBMIT</button>
                <button id="issue-multiple-submit" type="button" class="issue-submit-btn btn btn-orange btn-md" ng-disabled="isIssuing" ng-click="checkIssueMultipleErrors()" style="display: none">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->
<!-- modal -->
<div class="modal fade" id="moreq" tabindex="-1" ng-controller="issuenumberController">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="myModalLabel">Insert Queue</h3>
            </div>
            <div class="modal-body">
                <ul id="pmore-tab" class="nav nav-tabs nav-justified">
                    <li class="active"><a data-submit="#issue-specific-submit" href="#insertq" data-toggle="tab">INSERT TO QUEUE</a></li>
                    <li><a data-submit="#issue-multiple-submit" href="#multipleq" data-toggle="tab" >ISSUE MULTIPLE</a></li>
                </ul>
                <div class="clearfix tab-content">
                    <div class="tab-pane fade active in" id="insertq">
                        <form class="navbar-form navbar-left">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label><strong>Specific #</strong></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="priority_number">
                                </div>
                                <div class="col-md-4">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="name">
                                </div>
                                <div class="col-md-4">
                                    <label>Cellphone</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="phone">
                                </div>
                                <div class="col-md-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="email">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="multipleq" aria-labelledby="profile-tab">
                        <form class="navbar-form navbar-left">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label><strong>Amount</strong></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="range">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="alert alert-success" style="display: none" role="alert" id="issue-number-success">
                    <div><strong class="message"></strong></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="issue-specific-submit" type="button" class="issue-submit-btn btn btn-orange btn-lg" ng-click="issueSpecific(priority_number, name, phone, email)">SUBMIT</button>
                <button id="issue-multiple-submit" type="button" class="issue-submit-btn btn btn-orange btn-lg" ng-click="issueMultiple(range)" style="display: none">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->
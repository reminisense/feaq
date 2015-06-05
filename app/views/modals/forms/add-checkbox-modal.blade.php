<div class="modal fade" id="add-check-box" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="addCheckBoxModal">ADD CHECKBOX</h3>
            </div>
            <form ng-submit="addCheckbox(business_id)">
                <div class="modal-body">
                    <div class="clearfix">
                        <div id="message-notif" class="alert alert-success" style="display: none; text-align: center;" role="alert"></div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>Label <span class="req">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="check-box-label" ng-model="checkbox_label" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="create-field" type="submit" class="btn btn-orange btn-lg">
                        <span class="glyphicon glyphicon-ok"></span> CREATE
                    </button>
                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
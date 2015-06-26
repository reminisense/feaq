<div class="modal fade" id="add-text-field" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="addTextFieldModal">Add Text Field</h3>
            </div>
            <div class="modal-body">
                <form ng-submit="addTextField(business_id)">
                    <div class="clearfix">
                        <div id="message-notif" class="alert alert-success" style="display: none; text-align: center;" role="alert"></div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <small>Text Label</small>
                                <input type="text" class="form-control mb0" id="text-field-label" ng-model="text_field_label" required/>
                            </div>
                        </div>
                    </div>
            <div class="modal-footer">
                <button id="create-field" type="submit" class="btn btn-orange btn-lg">
                    <span class="glyphicon glyphicon-ok"></span> &nbsp; Add
                </button>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
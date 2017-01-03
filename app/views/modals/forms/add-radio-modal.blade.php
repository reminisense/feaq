<div class="modal fade" id="add-radio-button" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="addRadioButtonModal">Add Radio Button</h3>
            </div>
            <div class="modal-body">
                <form ng-submit="addRadioButton(business_id)">
                    <div class="clearfix">
                        <div id="message-notif" class="alert alert-success" style="display: none; text-align: center;" role="alert"></div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <select class="form-control"  id="radio-fld" >
                                    <option ng-repeat="service in services" value="@{{ service.service_id }}">@{{ service.name }}</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <small>Radio Label</small>
                                <input type="text" class="form-control" id="radio-button-label" ng-model="radio_button_label" required />
                            </div>
                            <div class="col-md-12">
                                <small>Option A</small>
                                <input type="text" class="form-control" id="radio-value-a" ng-model="radio_value_a" required />
                            </div>
                            <div class="col-md-12">
                                <small>Option B</small>
                                <input type="text" class="form-control" id="radio-value-b" ng-model="radio_value_b" required />
                            </div>
                        </div>
                    </div>
            <div class="modal-footer">
                <button id="create-field" type="submit" class="btn btn-orange btn-lg">
                    <span class="glyphicon glyphicon-ok"></span>&nbsp; Add
                </button>
            </div>
                    <div class="alert alert-danger" id="radio-error" style="display:none;  text-align: center;">
                        Please select a service.
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
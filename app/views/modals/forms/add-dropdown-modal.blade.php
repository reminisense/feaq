<div class="modal fade" id="add-dropdown" tabindex="-1"
     xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="addDropDownModal">Add Dropdown</h3>
            </div>
            <div class="modal-body">
            <form ng-submit="addDropdown(business_id)">
                <div class="clearfix">
                    <div id="message-notif" class="alert alert-success" style="display: none; text-align: center;" role="alert"></div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <select class="form-control"  id="dropdown-fld">
                                <option ng-repeat="service in services" value="@{{ service.service_id }}">@{{ service.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <small>Dropdown Label</small>
                            <input type="text" class="form-control" id="dropdown-label" ng-model="dropdown_label" required />
                        </div>
                        <div class="col-md-12">
                            <small>Options</small>
                            <textarea class="form-control" id="dropdown-options" ng-model="dropdown_options" rows="5" placeholder="Separate options by line.." required/></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="create-field" type="submit" class="btn btn-orange btn-lg">
                        <span class="glyphicon glyphicon-ok"></span> &nbsp; Add
                    </button>
                </div>
                <div class="alert alert-danger" id="dropdown-error" style="display:none;  text-align: center;">
                    Please select a service.
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
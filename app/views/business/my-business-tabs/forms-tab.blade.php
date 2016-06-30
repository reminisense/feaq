<div class="header">
    <h5>FORM CUSTOMIZATION</h5>
    <small>Customize the contact form to suit your business needs.</small>
</div>
<div class="clearfix">
    <div style="padding-bottom: 20px;">
        <button type="button" class="btn btn-primary btn-lg" id="create-form"><span class="	glyphicon glyphicon-plus"></span> Create a Form</button>
    </div>
    <div id="create-form-container" style="background-color: #daebf2; display: none; padding: 20px;">
        <div class="cold-md-12" style="text-align: center; background-color: #ffffff;">
            <div class="container">
                <div class="col-md-4">
                    <label>Select a Service: </label>
                </div>
                <div class="col-md-8">
                    <select id="select-service">
                        <option ng-repeat="service in services" ng-if="service.service_id != undefined" value="@{{ service.service_id }}">@{{ service.name }}</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="tab-pane fade active in">
                <form class="navbar-form">
                    <div>
                        <input id="form-name" type="text" class="form-control" required placeholder="Form Name">
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Number</label>
                        </div>
                        <div class="col-md-8">
                            <h5> 82</h5>
                        </div>
                        <div class="col-md-4">
                            <label>Email</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="johndoe@gmail.com" disabled>
                        </div>
                        <div class="col-md-4">
                            <label>Name :</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" disabled value="John Doe">
                        </div>
                        <div class="col-md-4">
                            <label>Phone :</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" disabled value="+639991516057">
                        </div>
                        <hr>
                        <div class="form-control" id="fields" style="display: none;">
                        </div>
                        <div>
                            <div class="col-md-5">
                                <input type="text" id="field-name" class="form-control" placeholder="Put a Label">
                            </div>
                            <div class="col-md-5">
                                <select id="select-field" class="form-control">
                                    <option value="" disabled selected>Select a Field</option>
                                    <option value="1">Text Field</option>
                                    <option value="2">Checkbox</option>
                                    <option value="3">Radio Button</option>
                                    <option value="4">Dropdown</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="button" ng-click="addField()" class="btn btn-primary btn-lg" id="create-field">Add a Field</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="clearfix">
    <label>Show Only</label>
    <select id="filter-forms">
        <option value="0">ALL</option>
        <option ng-repeat="service in services" ng-if="service.service_id != undefined" value="@{{ service.service_id }}">@{{ service.name }}</option>
    </select>
</div>

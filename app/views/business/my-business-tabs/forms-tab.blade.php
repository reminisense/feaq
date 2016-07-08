<div class="header">
    <h5>FORM CUSTOMIZATION</h5>
    <small>Customize the contact form to suit your business needs.</small>
</div>
<div  ng-controller="formsController">
    <div class="clearfix">
        <div style="padding-bottom: 20px;">
            <button type="button" class="btn btn-primary btn-lg" id="create-form"><span class="	glyphicon glyphicon-plus"></span> Create a Form</button>
        </div>
    </div>
    <div class="clearfix create-form-wrap">
        <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
            <div class="clearfix">
                <form>
                    <div class="form-header clearfix">
                        <div class="col-md-6">
                            <a href="" class="form-title">Click to edit Form Title
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <div class="clearfix" id="edit-form-title" style="display:none">
                                <input id="form-name" class="mr5 form-control" type="text" placeholder="Form Title" />
                                <a href="" class="btn btn-xs btn-default">Cancel</a>
                                <a href="" class="btn btn-xs btn-primary">Save</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right text-right">
                                <select class="form-control" id="select-service">
                                    <option disabled value="0" selected="selected">Select a service</option>
                                    <option ng-repeat="service in services" value="@{{ service.service_id }}">@{{ service.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix form-body">
                        <div class="clearfix">
                            <div class="entry clearfix">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    Priority Number
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p id="prio-number"># 25</p>
                                </div>
                            </div>
                            <div class="entry clearfix">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    Name
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="text" disabled placeholder="Stan Wayne"/>
                                </div>
                            </div>
                            <div class="entry clearfix">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    Cellphone
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="text" disabled placeholder="+639222010715"/>
                                </div>
                            </div>
                            <div class="entry clearfix">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    Email Address
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="text" disabled placeholder="stan.wayne@gmail.com"/>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="sep"></div>
                            </div>
                        </div>
                        <div class="col-md-12" id="custom-fields">
                            <div class="clearfix entry" ng-repeat="field in fields" id="@{{field.field_data.label}}">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @{{ field.field_data.label }}
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-10">
                                    <input class="form-control" type="text" ng-if="field.field_type == 'textfield'"/>
                                    <input type="checkbox"ng-if="field.field_type == 'checkbox'"/>
                                    <div ng-if="field.field_type == 'radio'">
                                        <input type="radio">@{{ field.field_data.value_a }}<br>
                                        <input type="radio"> @{{ field.field_data.value_b }}<br>
                                    </div>
                                    <select ng-if="field.field_type == 'dropdown'">
                                        <option ng-repeat="option in field.field_data.options">@{{ option }}</option>
                                    </select>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-2" id="field-actions">
                                    <button class="btn btn-blue" ng-click="deleteField(field.field_data.label)"><span class="glyphicon glyphicon-trash"></span></button>
                                </div>
                            </div>
                        </div>
                        <!-- generate form fields -->
                        <div class="clearfix generate-forms entry">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="for-label" type="text" class="form-control" placeholder="Put a Label" />
                                <div id="radio-options" style="display:none">
                                    <input id="for-label" class="form-control" type="text" placeholder="Option 1" />
                                    <input id="for-label" class="form-control" type="text" placeholder="Option 2" />
                                </div>
                                <div id="dropdown-options" style="display:none">
                                    <input id="for-label" class="form-control" type="text" placeholder="Option 1" />
                                    <a ng-click="addDropdown()" id="btn-add-dropdown">Add Field</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-10">
                                <select id="option-field" class="form-control">
                                    <option value="0">Select a Field Type</option>
                                    <option value="textfield">Text Field</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio Button</option>
                                    <option value="dropdown">Dropdown</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <button ng-click="addField()" class="btn btn-primary btn-md" id="btn-add-field">Add Field</button>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix form-footer">
                        <div class="pull-right">
                            <a href="" class="mr5 btn btn-md btn-default">Cancel</a>
                            <a href="" class="btn btn-md btn-orange">Save Form</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <ul id="business-forms-tabs" class="clearfix nav nav-tabs">
            <li role="presentation" class="" ng-repeat="service in services track by $index">
                <a href="#service-@{{ $index+1 }}" data-toggle="tab">@{{ service.name }}</a>
            </li>
            <li role="presentation" class="active">
                <a href="#service-0" data-toggle="tab">All Services</a>
            </li>
            <li id="label-services">SERVICES &rarr;</li>
        </ul>
        <div id="business-form-tabs-table" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="service-0" >
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Form Name/Title</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th class="text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="form in forms">
                        <td>@{{ form.form_name }}</td>
                        <td>@{{ form.service_name }}</td>
                        <td>@{{ form.date_created }}</td>
                        <td><a href="" id="btn-view-form" ng-onclick="ViewForm(form)"><span class="glyphicon glyphicon-eye-open"></span>View</a></td>
                        {{--<td id="onoff"><input type="checkbox" checked data-toggle="toggle"></td>--}}
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="service-@{{ $index+1 }}" ng-repeat="service in services track by $index">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Form Name/Title</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th class="text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="form in forms" ng-if="form.service_id == service.service_id">
                        <td>@{{ form.form_name }}</td>
                        <td>@{{ form.service_name }}</td>
                        <td>@{{ form.date_created }}</td>
                        <td><a href="" id="btn-view-form" ><span class="glyphicon glyphicon-eye-open"></span>View</a></td>
                        {{--<td id="onoff"><input type="checkbox" checked data-toggle="toggle"></td>--}}
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix view-form-wrap rel">
            <div class="abs" id="btn-goback">
                <a href="" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-arrow-left"></span>Go back to Forms</a>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <h5>Transaction Info:</h5>
                <table class="table" id="table-transaction-info">
                <tbody>
                  <tr>
                    <td><strong>Name</strong></td>
                    <td><strong>@{{ fullName }}</strong></td>
                  </tr>
                  <tr>
                    <td>Time check-in</td>
                    <td>@{{ timeCheckIn }}</td>
                  </tr>
                  <tr>
                    <td>Time of Queue</td>
                    <td>@{{ queueTime }}</td>
                  </tr>
                </tbody>
              </table>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="clearfix">
                  <form>
                    <div class="form-header">
                      <p>@{{ formName }}</p>
                    </div>
                    <div class="clearfix form-body">
                      <div id="form-fields-html"></div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="clearfix table-view-signups">
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>Costumer</th>
                    <th>Transaction #</th>
                    <th>Date</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="(count, record) in records">
                    <th>@{{ record.full_name }}</th>
                    <td>@{{ record.transaction_number }}</td>
                    <td>@{{ record.date }}</td>
                    <td class="text-right"><a href="" ng-click="viewRecord(record.record_id)"><span class="glyphicon glyphicon-eye-open"></span>View Transaction</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
</div>
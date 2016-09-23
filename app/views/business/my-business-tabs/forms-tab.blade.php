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
                                <input id="form-name" class="mr5 form-control" type="text" placeholder="Form Title" maxlength="24"/>
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
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    Priority Number
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <p id="prio-number"># 25</p>
                                </div>
                            </div>
                            <div class="entry clearfix">
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    Name
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input class="form-control" type="text" disabled placeholder="Stan Wayne"/>
                                </div>
                            </div>
                            <div class="entry clearfix">
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    Cellphone
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input class="form-control" type="text" disabled placeholder="+639222010715"/>
                                </div>
                            </div>
                            <div class="entry clearfix">
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    Email Address
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-12">
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
                            <div class="clearfix entry mb20" ng-repeat="field in fields" id="@{{field.field_data.label}}">
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    @{{ field.field_data.label }}
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-10">
                                    <input class="form-control" type="text" ng-if="field.field_type == 'textfield'"/>
                                    <input type="checkbox"ng-if="field.field_type == 'checkbox'"/>
                                    <div ng-if="field.field_type == 'radio'">
                                        <div class="mb10"><input type="radio" name="field.field_data.label"> @{{ field.field_data.value_a }}</div>
                                        <div class="mb10"><input type="radio" name="field.field_data.label"> @{{ field.field_data.value_b }}</div>
                                    </div>
                                    <select class="form-control" ng-if="field.field_type == 'dropdown'">
                                        <option ng-repeat="option in field.field_data.options">@{{ option }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" id="field-actions">
                                    <button class="btn btn-blue" ng-click="deleteField(field.field_data.label)"><span class="glyphicon glyphicon-trash"></span></button>
                                </div>
                            </div>
                        </div>
                        <!-- generate form fields -->
                        <div class="clearfix generate-forms entry">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input id="for-label" type="text" class="form-control" placeholder="Put a Label" />
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-10">
                                <select id="option-field" class="form-control">
                                    <option value="0">Select a Field Type</option>
                                    <option value="textfield">Text Field</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio Button</option>
                                    <option value="dropdown">Dropdown</option>
                                </select>
                                <div id="radio-options" style="display:none">
                                                                    <input id="value_a" class="form-control" type="text" placeholder="Option 1" />
                                                                    <input id="value_b" class="form-control" type="text" placeholder="Option 2" />
                                                                </div>
                                                                <div id="dropdown-options" style="display:none">
                                                                    <input id="dropdown-0" class="form-control" type="text" placeholder="Option 1" />
                                                                    <input ng-repeat="dropdown in dropdowns" class="form-control" id="dropdown-@{{ dropdown.number_of_options}}" type="text" placeholder="Option @{{ dropdown.number_of_options + 1 }}" />
                                                                    <a href ng-click="addDropdown()" id="btn-add-dropdown"><span class="glyphicon glyphicon-plus"></span> Add an option</a>
                                                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <button ng-click="addField()" class="btn btn-primary btn-md" id="btn-add-field">Add Field</button>
                            </div>
                        </div>
                        <div class="alert alert-danger mt10" id="field-error" style="display: none; text-align: center">@{{ err_message }}</div>
                    </div>
                    <div class="clearfix form-footer">
                        <div class="pull-right">
                            <button id="cancel-form" class="mr5 btn btn-md btn-default">Cancel</button>
                            <button class="btn btn-md btn-orange" ng-click="createForm()">Save Form</button>
                        </div>
                    </div>
                    <div class="clearfix form-footer">
                        <div class="alert alert-success mt10" id="form-success" style="display: none; text-align: center">Your form has been created.</div>
                        <div class="alert alert-danger mt10" id="form-error" style="display: none; text-align: center">@{{ error_message }}.</div>
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
                        <th class="text-right">Enable</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="form in forms">
                        <td>@{{ form.form_name }}</td>
                        <td>@{{ form.service_name }}</td>
                        <td>@{{ form.date_created }}</td>
                        <td><a href="" id="btn-view-form" ng-click="viewForm(form.form_id)"><span class="glyphicon glyphicon-eye-open"></span>View</a></td>
                        <td id="onoff">
                            <input type="checkbox" checked data-toggle="toggle" id="status@{{ form.form_id }}" ng-model="form.status" ng-change="saveFormStatus(form.form_id)" >
                        </td>
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
                        <th class="text-right">Enable</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="form in forms" ng-if="form.service_id == service.service_id">
                        <td>@{{ form.form_name }}</td>
                        <td>@{{ form.service_name }}</td>
                        <td>@{{ form.date_created }}</td>
                        <td><a href="" id="btn-view-form" ng-click="viewForm(form.form_id)"><span class="glyphicon glyphicon-eye-open"></span>View</a></td>
                        <td id="onoff"><input id="status@{{ form.form_id }}" ng-model="form.status" type="checkbox" ng-change="saveFormStatus(form.form_id)" data-toggle="toggle"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix view-form-wrap rel">
            <div class="abs" id="btn-goback">
                <a href="" id="btn-back" ng-click="clearForms()" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-arrow-left"></span>Go back to Forms</a>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <h5>Transaction Info:</h5>
                <table class="table" id="table-transaction-info">
                <tbody>
                  <tr>
                    <td><strong>Name</strong></td>
                    <td>@{{ fullName }}</td>
                  </tr>
                  <tr>
                    <td><strong>Email</strong></td>
                    <td>@{{ userEmail }}</td>
                  </tr>
                  <tr>
                    <td><strong>Transaction Number</strong></td>
                    <td>@{{ transactionNumber }}</td>
                  </tr>
                  <tr>
                    <td><strong>Priority Number</strong></td>
                    <td>@{{ priorityNumber }}</td>
                  </tr>
                  <tr>
                    <td><strong>Date</strong></td>
                    <td>@{{transactionDate }}</td>
                  </tr>
                  <tr>
                    <td><strong>Time Lined Up</strong></td>
                    <td>@{{ timeQueued }}</td>
                  </tr>
                  <tr>
                    <td><strong>Time Called</strong></td>
                    <td>@{{ timeCalled }}</td>
                  </tr>
                  <tr>
                      <td><strong>Time Finished</strong></td>
                      <td>@{{ timeCompleted }}</td>
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
                <div class="clearfix search-filter">
                    <select class="col-md-2 col-xs-12 col-sm-2 form-control" id='record-option'>
                        <option value="all">All</option>
                        <option value="name">Name</option>
                        <option value="date">Date</option>
                    </select>
                    <input class="form-control" type="text" id="record-name">
                    <input class="form-control" type="text" id="record-datepicker">
                    <button class="btn-primary btn btn-lg" ng-click="searchUserRecords()">Search</button>
                </div>
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
                  <tr id='all-records' ng-repeat="(count, record) in records" ng-show="!filtered_records.length && !err_search">
                    <th>@{{ record.full_name }}</th>
                    <td>@{{ record.transaction_number }}</td>
                    <td>@{{ record.date }}</td>
                    <td class="text-right"><a href="" ng-click="viewRecord(record.record_id)"><span class="glyphicon glyphicon-eye-open"></span>View Transaction</a></td>
                  </tr>
                  <tr id='filtered-records' ng-repeat="(count, record) in filtered_records" ng-show="filtered_records.length && !err_search">
                      <th>@{{ record.full_name }}</th>
                      <td>@{{ record.transaction_number }}</td>
                      <td>@{{ record.date }}</td>
                      <td class="text-right"><a href="" ng-click="viewRecord(record.record_id)"><span class="glyphicon glyphicon-eye-open"></span>View Transaction</a></td>
                  </tr>
                </tbody>
              </table>
              <div class="alert alert-danger mt10" id="form-error" ng-show="err_search" style="text-align: center;">@{{ err_search }}</div>
            </div>
        </div>
</div>
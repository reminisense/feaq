<div class="header">
    <h5>FORM CUSTOMIZATION</h5>
    <small>Customize the contact form to suit your business needs.</small>
</div>
<div class="clearfix">
    <div style="padding-bottom: 20px;">
        <button type="button" class="btn btn-primary btn-lg" id="create-form"><span class="	glyphicon glyphicon-plus"></span> Create a Form</button>
    </div>
</div>
<div ng-controller="formsController">
<div class="clearfix create-form-wrap">
              <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                <div class="clearfix">
                  <form>
                    <div class="form-header">
                      <a href="" class="form-title">Click to edit Form Title
                        <span class="glyphicon glyphicon-pencil"></span>
                      </a>
                      <div class="clearfix" id="edit-form-title" style="display:none">
                        <input class="mr5 form-control" type="text" placeholder="Form Title" />
                        <a href="" class="btn btn-xs btn-default">Cancel</a>
                        <a href="" class="btn btn-xs btn-primary">Save</a>
                      </div>
                    </div>
                    <div class="clearfix form-body">
                      <div class="clearfix">
                        <div class="entry clearfix">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <strong>Priority Number</strong>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <p id="prio-number">#</p>
                          </div>
                        </div>
                        <div class="entry clearfix">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <strong>Name</strong>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" type="text"/>
                          </div>
                        </div>
                        <div class="entry clearfix">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <strong>Cellphone</strong>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="disabled form-control" type="text"/>
                          </div>
                        </div>
                        <div class="entry clearfix">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <strong>Email Address</strong>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" type="text"/>
                          </div>
                        </div>
                      </div>

                      <div class="clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="sep"></div>
                        </div>
                      </div>

                      <div class="dynamic-inputs col-md-12">
                        <div class="clearfix entry">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <strong>Age</strong>
                          </div>
                          <div class="col-md-5 col-sm-5 col-xs-10">
                            <input class="form-control" type="text"/>
                          </div>
                          <div class="col-md-1 col-sm-1 col-xs-2" id="field-actions">
                            <a id="btn-delete-field" href=""><span class="glyphicon glyphicon-trash"></span></a>
                          </div>
                        </div>
                        <div class="clearfix entry">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <strong>Sex</strong>
                          </div>
                          <div class="col-md-5 col-sm-5 col-xs-10">
                            <span class="btn-radio"><input type="radio" /> Male</span>
                            <span class="btn-radio"><input type="radio" /> Female</span>
                          </div>
                          <div class="col-md-1 col-sm-1 col-xs-2" id="field-actions">
                            <a id="btn-delete-field" href=""><span class="glyphicon glyphicon-trash"></span></a>
                          </div>
                        </div>
                        <div class="clearfix entry">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <strong>Last Physical Examination</strong>
                          </div>
                          <div class="col-md-5 col-sm-5 col-xs-10">
                            <input class="form-control" type="text"/>
                          </div>
                          <div class="col-md-1 col-sm-1 col-xs-2" id="field-actions">
                            <a id="btn-delete-field" href=""><span class="glyphicon glyphicon-trash"></span></a>
                          </div>
                        </div>
                      </div>
                      <!-- generate form fields -->
                      <div class="clearfix generate-forms entry">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="for-label" type="text" class="form-control" placeholder="Put a Label" />
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-10">
                          <select class="form-control">
                            <option>Select a Field Type</option>
                            <option>Text Field</option>
                            <option>Text Area</option>
                            <option>Radio Button</option>
                            <option>Checkbox</option>
                          </select>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <a href="" class="btn btn-primary btn-md" id="btn-add-field">Add Field</a>
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
                <li role="presentation" class="active">
                  <a href="#service-a" data-toggle="tab">Health Checkup</a>
                </li>
                <li role="presentation" class="">
                  <a href="#service-b" data-toggle="tab">Laboratory</a>
                </li>
                <li role="presentation" class="">
                  <a href="#service-b" data-toggle="tab">Cashier / Billing</a>
                </li>
                <li id="label-services">SERVICES &rarr;</li>
              </ul>
              <div id="business-form-tabs-table" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="service-a" >
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Form Name/Title</th>
                        <th>Total Sign-ups</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th class="text-right"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>Generic Health checkup</th>
                        <td>98</td>
                        <td>June 17, 2016</td>
                        <td><a href="" id="btn-view-form" ng-click="viewForm(1)"><span class="glyphicon glyphicon-eye-open"></span>View</a></td>
                        <td id="onoff"><input type="checkbox" checked data-toggle="toggle"></td>
                      </tr>
                      <tr>
                        <th>Physical Exam Checkup Form</th>
                        <td>102</td>
                        <td>June 16, 2016</td>
                        <td><a href="" id="btn-view-form"><span class="glyphicon glyphicon-eye-open"></span>View</a></td>
                        <td id="onoff"><input type="checkbox" checked data-toggle="toggle"></td>
                      </tr>
                      <tr>
                        <th>Company/Business Registraion Form</th>
                        <td>182</td>
                        <td>June 17, 2016</td>
                        <td><a href="" id="btn-view-form"><span class="glyphicon glyphicon-eye-open"></span>View</a></td>
                        <td id="onoff"><input type="checkbox" checked data-toggle="toggle"></td>
                      </tr>
                      <tr>
                        <th>Generic Health checkup</th>
                        <td>98</td>
                        <td>June 17, 2016</td>
                        <td><a href="" id="btn-view-form"><span class="glyphicon glyphicon-eye-open"></span>View</a></td>
                        <td id="onoff"><input type="checkbox" checked data-toggle="toggle"></td>
                      </tr>
                      <tr>
                        <th>Physical Exam Checkup Form</th>
                        <td>102</td>
                        <td>June 16, 2016</td>
                        <td><a href="" id="btn-view-form"><span class="glyphicon glyphicon-eye-open"></span>View</a></td>
                        <td id="onoff"><input type="checkbox" checked data-toggle="toggle"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div class="tab-pane fade" id="service-b">
                  <table class="table"> <thead> <tr> <th>#</th> <th>BBFirst Name</th> <th>Last Name</th> <th>Username</th> </tr> </thead> <tbody> <tr> <th scope="row">1</th> <td>Mark</td> <td>Otto</td> <td>@mdo</td> </tr> <tr> <th scope="row">2</th> <td>Jacob</td> <td>Thornton</td> <td>@fat</td> </tr> <tr> <th scope="row">3</th> <td>Larry</td> <td>the Bird</td> <td>@twitter</td> </tr> </tbody> </table>
                </div>
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
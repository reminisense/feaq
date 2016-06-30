<div class="header">
    <h5>FORM CUSTOMIZATION</h5>
    <small>Customize the contact form to suit your business needs.</small>
</div>
<div class="clearfix">
    <div style="padding-bottom: 20px;">
        <button type="button" class="btn btn-primary btn-lg" id="create-form"><span class="	glyphicon glyphicon-plus"></span> Create a Form</button>
    </div>
</div>
<div class="clearfix">
    <table class="clearfix table table-hover">
        <tbody>
            <thead>
                <tr>
                    <th width="25%">Form Name/Title </th>
                    <th width="25%">Service</th>
                    <th width="25%">Date</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <tbody>
            <tr ng-repeat="form in forms">
                <td>@{{ form.form_name }}</td>
                <td>@{{ form.service_name }}</td>
                <td>@{{ form.date_created }}</td>
                <td><a href="" style="text-decoration: none;"><span class="glyphicon glyphicon-th-list"></span> View</a></td>
            </tr>
        </tbody>
    </table>
</div>

<div ng-controller="formsController">
    <button ng-click="viewForm(1)">View Form</button><br>
    <input type="text" ng-model="keyword">
    <button ng-click="searchUserRecords(1, keyword)">Search Record</button>
</div>
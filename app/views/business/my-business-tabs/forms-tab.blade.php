<div class="header">
    <h5>FORM CUSTOMIZATION</h5>
    <small>Customize the contact form to suit your business needs.</small>
</div>
<div class="clearfix">
    <button type="button" class="btn btn-primary btn-lg" id="create_form">CREATE A FORM</button>
    <label>Show Only</label>
    <select id="filter-forms">
        <option value="0">ALL</option>
        <option ng-repeat="service in services" ng-if="service.service_id != undefined" value="@{{ service.service_id }}">@{{ service.name }}</option>
    </select>
</div>
{{--<div class="clearfix">--}}
    {{--<div class="well">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-3">--}}
                {{--<button type="button" id="add_textfield" class="btn btn-primary btn-lg" data-target="#add-text-field" data-toggle="modal" style="width: 100%; margin-bottom: 5px;"><span class="glyphicon glyphicon-text-size"></span> Add Text Field</button>--}}
            {{--</div>--}}
            {{--<div class="col-md-3">--}}
                {{--<button type="button" id="add_radio" class="btn btn-primary btn-lg" data-target="#add-radio-button" data-toggle="modal" style="width: 100%; margin-bottom: 5px;"><span class="glyphicon glyphicon-record"></span> Add Radio</button>--}}
            {{--</div>--}}
            {{--<div class="col-md-3">--}}
                {{--<button type="button" id="add_checkbox" class="btn btn-primary btn-lg" data-target="#add-check-box" data-toggle="modal" style="width: 100%; margin-bottom: 5px;"><span class="glyphicon glyphicon-check"></span> Add Checkbox</button>--}}
            {{--</div>--}}
            {{--<div class="col-md-3">--}}
                {{--<button type="button" id="add_dropdown" class="btn btn-primary btn-lg" data-target="#add-dropdown" data-toggle="modal" style="width: 100%; margin-bottom: 5px;"><span class="glyphicon glyphicon-collapse-down"></span> Add Dropdown</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="table table-responsive">--}}
    {{--<div ng-repeat="service in services" ng-if="$index > 0">--}}
        {{--<table class="table">--}}
            {{--<h5 class="mb20">@{{service.name}}</h5>--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th>Label</th>--}}
                {{--<th>Field Type</th>--}}
                {{--<th></th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--<tr ng-repeat="(form_id, field) in form_fields" ng-if="field.service_id == service.service_id" class="field-@{{ form_id }}">--}}
                {{--<td><strong>@{{ field.label }}</strong></td>--}}
                {{--<td>@{{ field.field_type }}</td>--}}
                {{--<td><a href="" ng-click="deleteFormField(form_id, business_id)" class="btn-boxy btn-primary" style="display:inline-block;"><span class="glyphicon glyphicon-trash"></span></a></td>--}}
            {{--</tr>--}}
            {{--</tbody>--}}
        {{--</table>--}}
        {{--</div>--}}
{{--</div>--}}

{{--@include('modals.forms.add-text-modal')--}}
{{--@include('modals.forms.add-radio-modal')--}}
{{--@include('modals.forms.add-checkbox-modal')--}}
{{--@include('modals.forms.add-dropdown-modal')--}}
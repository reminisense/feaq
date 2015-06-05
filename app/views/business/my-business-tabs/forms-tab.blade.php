<h5 class="col-md-12">
    FORM CUSTOMIZATION
    <small>Customize the contact form to suit your business needs.</small>
</h5>
<div class="col-md-12">
    <div class="well">
        <div class="row">
            <div class="col-md-3">
                <button type="button" id="add_textfield" class="btn btn-orange btn-lg" data-target="#add-text-field" data-toggle="modal" style="width: 100%; margin-bottom: 5px;"><span class="glyphicon glyphicon-text-size"></span> Add Text Field</button>
            </div>
            <div class="col-md-3">
                <button type="button" id="add_radio" class="btn btn-orange btn-lg" data-target="#add-radio-button" data-toggle="modal" style="width: 100%; margin-bottom: 5px;"><span class="glyphicon glyphicon-record"></span> Add Radio</button>
            </div>
            <div class="col-md-3">
                <button type="button" id="add_checkbox" class="btn btn-orange btn-lg" data-target="#add-check-box" data-toggle="modal" style="width: 100%; margin-bottom: 5px;"><span class="glyphicon glyphicon-check"></span> Add Checkbox</button>
            </div>
            <div class="col-md-3">
                <button type="button" id="add_dropdown" class="btn btn-orange btn-lg" data-target="#add-dropdown" data-toggle="modal" style="width: 100%; margin-bottom: 5px;"><span class="glyphicon glyphicon-collapse-down"></span> Add Dropdown</button>
            </div>
        </div>
    </div>
</div>
<a href="" class="btn-boxy btn-primary" ng-click="showPreviewForm(business_id)" data-target="#preview-form-modal" data-toggle="modal" style="width: 100%"><span class="glyphicon glyphicon-eye-open"></span> Preview Form</a>
<div class="table table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Label</th>
            <th>Field Type</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="(form_id, field) in form_fields" class="field-@{{ form_id }}">
            <td><strong>@{{ field.label }}</strong></td>
            <td>@{{ field.field_type }}</td>
            <td><a href="" ng-click="deleteFormField(form_id)" class="btn-boxy btn-danger" style="display:inline-block;"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
        </tbody>
    </table>
</div>

@include('modals.forms.preview-form-modal')
@include('modals.forms.add-text-modal')
@include('modals.forms.add-radio-modal')
@include('modals.forms.add-checkbox-modal')
@include('modals.forms.add-dropdown-modal')
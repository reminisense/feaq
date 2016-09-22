<!-- modal -->
<div id="urls">
    <!-- ids -->
    <input type="hidden" id="service-id" value="{{ $first_service->service_id }}">
    <input type="hidden" id="terminal-id" value="">

    <!-- urls-->
    <input type="hidden" id="issue-multiple-url" value="{{ url('/issuenumber/multiple/') }}">
    <input type="hidden" id="issue-specific-url" value="{{ url('/issuenumber/insertspecific/') }}">
</div>

<div class="modal fade" id="remote-queue-modal" tabindex="-1" ng-controller="issuenumberController">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="myModalLabel">Get This Number</h3>
            </div>
            <div class="modal-body">
                <div class="clearfix">
                    <div class="tab-pane fade active in" id="insertq">
                        <form class="navbar-form navbar-left" name="issue_specific_form">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Number</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" disabled class="form-control" ng-model="get_num" name="number" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="name" value="@{{ contactname }}" readonly name="name" required>
                                </div>

                                <div class="col-md-4">
                                    <label>Cellphone</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="issued-number-phone" type="text" class="form-control" ng-model="phone" value="@{{ contactmobile }}" name="phone" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" ng-model="email" value="@{{ contactemail }}" readonly name="email" required>
                                </div>
                            </div>
                            <div class="alert alert-danger" role="alert" ng-show="issue_specific_error.length > 0">
                                <div><strong class="message">@{{ issue_specific_error }}</strong></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="forms-container" ng-show="forms.length > 0">
                    <div style=" border-top: 1px dotted #ccc; padding-top: 20px;">
                        <ul id="form-tabs" class="nav nav-tabs">
                            <li ng-repeat="form in filtered_forms" class="@{{ $index == 0 ? 'active in':''}}"><a data-toggle="tab" href="#@{{ form.form_id }}">@{{ form.form_name }}</a></li>
                        </ul>
                        <div class="tab-content" style="max-height: 150px; overflow: auto;">
                            <div ng-repeat="form in filtered_forms" id="@{{ form.form_id }}" class="tab-pane fade @{{ $index == 0 ? 'active in':''}}">
                                <table class="table" id="borderless">
                                    <tr ng-repeat="field in form.fields">
                                        <th scope="row" width="35%">@{{ field.field_data.label }}</th>
                                        <td>
                                            <input class="form-control" id="@{{ form.form_id }}_@{{ $index }}" type="textfield" ng-if="field.field_type == 'textfield'" value="@{{field.field_data.suggested}}" style="margin-bottom: 10px">
                                            <input id="@{{ form.form_id }}_@{{ $index }}" type="checkbox" ng-if="field.field_type == 'checkbox'" style="margin-bottom: 10px" ng-checked="@{{field.field_data.suggested == 'Yes' ? '1':'0'}}">
                                            <div  ng-if="field.field_type == 'radio'" style="margin-bottom: 10px">
                                                <input type="radio" name="@{{ form.form_id }}_@{{ $index }}" value="@{{ field.field_data.value_a}}" ng-checked="@{{ field.field_data.value_a == field.field_data.suggested ? '1':'0' }}"> @{{ field.field_data.value_a }} <br>
                                                <input type="radio" name="@{{ form.form_id }}_@{{ $index }}" value="@{{ field.field_data.value_b }}" ng-checked="@{{ field.field_data.value_b == field.field_data.suggested ? '1':'0' }}"> @{{ field.field_data.value_b }}
                                            </div>
                                            <select  class="form-control" id="@{{ form.form_id }}_@{{ $index }}" ng-if="field.field_type == 'dropdown'"  style="margin-bottom: 10px">
                                                <option ng-repeat="option in field.field_data.options" value="@{{ option }}" ng-selected="@{{ option == field.field_data.suggested ? '1':'0' }}">@{{ option }}</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-success" style="display: none" role="alert" id="issue-number-success">
                    <div><strong class="message"></strong></div>
                </div>
                <div class="alert alert-danger" style="display: none" role="alert" id="issue-number-error">
                    <div><strong class="message"></strong></div>
                </div>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-orange btn-lg" data-dismiss="modal" aria-label="Close">CLOSE</button>--}}
                <button id="issue-specific-submit" type="button" class="btn btn-orange btn-lg" ng-disabled="isIssuing" ng-click="checkIssueSpecificErrors()">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->
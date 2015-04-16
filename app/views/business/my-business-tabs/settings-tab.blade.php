<h5>QUEUE SETTINGS</h5>
<table class="table settings">
    <tbody>
    {{--RDH Removed Other Queue Settings Since These Do Not Apply To This Release--}}
    {{--<tr>
        <td>Number Start</td>
        <td><input class="mb0 form-control" type="text" placeholder="@{{ number_start }}"></td>
    </tr>--}}
    <tr>
        <td>
            <p class="title">Number Limit</p>
        </td>
        <td><input class="mb0 form-control" type="text" value="@{{ queue_limit }}" ng-model="queue_limit" ></td>  {{--RDH Added queue_limit to Edit Business Page--}}
    </tr>
    <tr>
        <td>
            <p class="title">Show Only Numbers Issued By Terminal</p>
        </td>
        <td><input type="checkbox" ng-model="terminal_specific_issue"></td> {{--ARA Terminal-specific issue numbers--}}
    </tr>
    <tr>
        <td>
            <p class="title">* Frontline SMS Secret
            <a href="https://frontlinecloud.zendesk.com/entries/28395408-Using-the-WebConnection-API-to-send-messages" target="_blank">
                <span class="glyphicon glyphicon-question-sign" title="How to create a Web Connection in Frontlinesms"></span>
            </a>
            </p>
        </td>
        <td><input class="mb0 form-control" type="password" value="@{{ frontline_secret }}" ng-model="frontline_secret" ></td>
    </tr>
    <tr>
        <td>
            <p class="title">* Frontline SMS URL
            <a href="https://frontlinecloud.zendesk.com/entries/28395408-Using-the-WebConnection-API-to-send-messages" target="_blank">
                <span class="glyphicon glyphicon-question-sign" title="How to create a Web Connection in Frontlinesms"></span>
            </a>
            </p>
        </td>
        <td><input class="mb0 form-control" type="text" value="@{{ frontline_url }}" ng-model="frontline_url" ></td>
    </tr>

    <tr>
        <td colspan="2">
            <div class="col-md-12">
                <p class="title">SMS Notification Settings
                <span class="glyphicon glyphicon-info-sign" style="color:#337ab7;" title="When to notify users via SMS."></span></p>
            </div>
            <div class="col-md-2 col-xs-12">
                <input type="checkbox" ng-model="sms_current_number">
                Priority Number is called
            </div>
            <div class="col-md-2 col-xs-12">
                <input type="checkbox"  ng-model="sms_1_ahead">
                Priority Number is next in queue
            </div>
            <div class="col-md-2 col-xs-12">
                <input type="checkbox"  ng-model="sms_5_ahead">
                 5 Numbers ahead in queue
            </div>
            <div class="col-md-2 col-xs-12">
                 <input type="checkbox"  ng-model="sms_10_ahead">
                             10 Numbers ahead in queue
                        </div>
            <div class="col-md-2 col-xs-12">
                  <input id="input_sms_field" type="text" ng-model="input_sms_field">
                  <input type="checkbox"  ng-model="sms_blank_ahead">
                  Numbers ahead in queue.
            </div>

        </td>
    </tr>


    {{--<tr>
        <td>Loop numbers automatically.</td>
        <td><input type="radio">Yes <input type="radio">No </td>
    </tr>
    <tr>
        <td>Allow SMS notification.</td>
        <td><input type="radio">Yes <input type="radio">No </td>
    </tr>
    <tr>
        <td>Allow Remote Queuing.</td>
        <td><input type="radio">Yes <input type="radio">No </td>
    </tr>--}}
    </tbody>
</table>
<div class="alert alert-info" role="alert">
    <strong>* FeatherQ Frontline SMS</strong> features will be given for <strong>free</strong> for the next few months.
    However, future developments might classify these features to be given exclusively to premium users without prior notice.
</div>
<div class="row">
    <div class="col-md-12">
        <div class="pull-right">
            <button type="button" id="edit_business" class="btn btn-orange btn-lg" ng-click="saveBusinessDetails()"><span class="glyphicon glyphicon-check"></span> SUBMIT</button>
        </div>
    </div>
</div>

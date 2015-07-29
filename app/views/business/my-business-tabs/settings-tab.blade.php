<div class="clearfix settings">
    <div class="col-md-6">
        <div class=" header">
            <h5>QUEUE SETTINGS</h5>
        </div>
        <div class="clearfix">
            <div class="col-md-6 mb20">
                <p class="title">Number Limit</p>
            </div>
            <div class="col-md-6 mb20">
                <input class="mb0 form-control" type="text" value="@{{ queue_limit }}" ng-model="queue_limit" ></td>  {{--RDH Added queue_limit to Edit Business Page--}}
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-6 mb20">
                <p class="title">Show Only Numbers Issued By Terminal</p>
            </div>
            <div class="col-md-6 mb20">
                <input type="checkbox" ng-model="terminal_specific_issue">
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-6 mb20">
                <p class="title">Allow Remote Queuing
                    <span class="glyphicon glyphicon-info-sign" style="color:#337ab7; cursor: pointer" title="Allow users to issue numbers away from location."></span>
                </p>
            </div>
            <div class="col-md-6 mb20">
                <input type="checkbox" ng-model="allow_remote">
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-6 mb20">
                <p class="title">Remote Queue Limit</p>
            </div>
            <div class="col-md-6 mb20">
                <input type="text" id="remote-limit" readonly style="border:0; font-weight:bold; width: 28px;" ng-model="remote_limit"> %
                <div id="remote-slider"></div>
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-6 mb20">
                <p class="title">SMS and Email Notification Settings
                    <span class="glyphicon glyphicon-info-sign" style="color:#337ab7; cursor: pointer;margin-bottom:20px;" title="When to notify users via SMS."></span>
                </p>
            </div>
            <div class="col-md-6 mb20">
                <div class=" mb10">
                    <input type="checkbox" ng-model="sms_current_number">Priority Number is called
                </div>
                <div class=" mb10">
                    <input type="checkbox"  ng-model="sms_1_ahead">
                    Priority Number is next in queue
                </div>
                <div class="mb10">
                    <input type="checkbox"  ng-model="sms_5_ahead">
                    5 Numbers ahead in queue
                </div>
                <div class="mb10">
                    <input type="checkbox"  ng-model="sms_10_ahead">
                    10 Numbers ahead in queue
                </div>
                <div class="mb10">
                    <input id="input_sms_field" type="text" ng-model="input_sms_field">
                    <input type="checkbox"  ng-model="sms_blank_ahead">
                    Numbers ahead in queue.
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class=" header">
            <h5>SMS SETTINGS</h5>
        </div>
        <div class="clearfix">
            <div class="col-md-6 mb20">
                <p class="title">* Frontline SMS Secret
                    <a href="https://frontlinecloud.zendesk.com/entries/28395408-Using-the-WebConnection-API-to-send-messages" target="_blank">
                    <span class="glyphicon glyphicon-question-sign" title="How to create a Web Connection in Frontlinesms"></span>
                    </a>
                </p>
            </div>
            <div class="col-md-6 mb20">
                <input class="mb0 form-control" type="password" value="@{{ frontline_secret }}" ng-model="frontline_secret" >
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-6 mb20">
                <p class="title">* Frontline SMS URL
                    <a href="https://frontlinecloud.zendesk.com/entries/28395408-Using-the-WebConnection-API-to-send-messages" target="_blank">
                    <span class="glyphicon glyphicon-question-sign" title="How to create a Web Connection in Frontlinesms"></span>
                    </a>
                </p>
            </div>
            <div class="col-md-6 mb20">
                <input class="mb0 form-control" type="text" value="@{{ frontline_url }}" ng-model="frontline_url" >
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <strong>* FeatherQ Frontline SMS</strong> features will be given for <strong>free</strong> for the next few months.
                    However, future developments might classify these features to be given exclusively to premium users without prior notice.
                </div>
            </div>
        </div>
    </div>
</div>





<div class="clearfix">
    <div class="">
        <div class="pull-right">
            <button type="button" id="edit_business" class="btn btn-orange btn-lg" ng-click="saveBusinessDetails()"><span class="glyphicon glyphicon-check"></span> SUBMIT</button>
        </div>
    </div>
</div>

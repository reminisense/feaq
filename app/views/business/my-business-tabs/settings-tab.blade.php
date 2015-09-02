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
                <p class="title">* Remote Queue Limit</p>
            </div>
            <div class="col-md-6 mb20">
                <input type="text" id="remote-limit" readonly style="border:0; font-weight:bold; width: 28px;" ng-model="remote_limit"> %
                <div id="remote-slider"></div>
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-6 mb20">
                <p class="title">General Notification Settings
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
        <div class="clearfix">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <strong>* Remote Queue Limit</strong> refers to the percentage of people who can queue remotely from the total number of people currently lined up.
                    This means that if you have a 10% limit, once 10 people have been issued numbers, 1 slot will be open for another person to queue in remotely.
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class=" header">
            <h5>** SMS SETTINGS</h5>
        </div>
        <div class="clearfix">
            <span><label>Frontline SMS</label> <input ng-disabled="business_features.allow_sms == 'false'" type="radio" value="frontline_sms" ng-model="sms_gateway"/></span>
            <span><label>Twilio</label> <input ng-disabled="business_features.allow_sms == 'false'" type="radio" value="twilio" ng-model="sms_gateway"/></span>
        </div>
        <div ng-show="sms_gateway == 'frontline_sms'">
            <div class="clearfix">
                <div class="col-md-6 mb20">
                    <p class="title">Frontline SMS API Key
                        <a href="https://frontlinecloud.zendesk.com/entries/28395408-Using-the-WebConnection-API-to-send-messages" target="_blank">
                            <span class="glyphicon glyphicon-question-sign" title="How to create a Web Connection in Frontlinesms"></span>
                        </a>
                    </p>
                </div>
                <div class="col-md-6 mb20">
                    <input class="mb0 form-control" ng-disabled="business_features.allow_sms == 'false'" type="password" value="@{{ frontline_api_key }}" ng-model="frontline_api_key" ng-disabled="true">
                </div>
            </div>
            <div class="clearfix">
                <div class="col-md-6 mb20">
                    <p class="title">Frontline SMS URL
                        <a href="https://frontlinecloud.zendesk.com/entries/28395408-Using-the-WebConnection-API-to-send-messages" target="_blank">
                            <span class="glyphicon glyphicon-question-sign" title="How to create a Web Connection in Frontlinesms"></span>
                        </a>
                    </p>
                </div>
                <div class="col-md-6 mb20">
                    <input class="mb0 form-control" ng-disabled="business_features.allow_sms == 'false'" type="text" value="@{{ frontline_url }}" ng-model="frontline_url" ng-disabled="true">
                </div>
            </div>
        </div>
        <div ng-show="sms_gateway == 'twilio'">
            <div class="clearfix">
                <div class="col-md-6 mb20">
                    <p class="title">Twilio Account SID</p>
                </div>
                <div class="col-md-6 mb20">
                    <input class="mb0 form-control" ng-disabled="business_features.allow_sms == 'false'" type="password" value="@{{ twilio_account_sid }}" ng-model="twilio_account_sid" ng-disabled="true">
                </div>
            </div>
            <div class="clearfix">
                <div class="col-md-6 mb20">
                    <p class="title">Twilio Auth Token</p>
                </div>
                <div class="col-md-6 mb20">
                    <input class="mb0 form-control" ng-disabled="business_features.allow_sms == 'false'" type="password" value="@{{ twilio_auth_token }}" ng-model="twilio_auth_token" ng-disabled="true">
                </div>
            </div>
            <div class="clearfix">
                <div class="col-md-6 mb20">
                    <p class="title">Twilio phone number</p>
                </div>
                <div class="col-md-6 mb20">
                    <input class="mb0 form-control" ng-disabled="business_features.allow_sms == 'false'" type="text" value="@{{ twilio_phone_number }}" ng-model="twilio_phone_number" ng-disabled="true">
                </div>
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <strong>** FeatherQ SMS Notifications</strong> will soon be enjoyed by business partners that have been in close contact with us.
                    To be one of these partners, you may contact us at <strong><a href="mailto:contact@featherq.com">contact@featherq.com</a></strong>.
                    You may also call us at <strong>(+63 32) 345-4658</strong> for further inquiries.
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

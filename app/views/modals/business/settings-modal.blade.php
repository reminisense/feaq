<div id="settings-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Service Settings</h4>
            </div>
            <div class="modal-body">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a role="tab" data-toggle="tab" href="#queueing">QUEUEING</a></li>
                        <li role="presentation" class=""><a role="tab" data-toggle="tab" href="#remote">REMOTE</a></li>
                        <li role="presentation" class=""><a role="tab" data-toggle="tab" href="#sms">SMS</a></li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="queueing">
                            <div class="broadcast-wrap2">
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Number Prefix</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input class="mb0 form-control white" type="text" value="@{{ queue_prefix }}" ng-model="queue_prefix" ></td>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Number Start</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input class="mb0 form-control white" type="text" value="@{{ queue_start }}" ng-model="queue_start" ></td>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Number Limit</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input class="mb0 form-control white" type="text" value="@{{ queue_limit }}" ng-model="queue_limit" ></td>  {{--RDH Added queue_limit to Edit Business Page--}}
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">View</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <strong>@{{ queue_prefix + queue_start }} - @{{ queue_prefix + queue_limit }}</strong>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Show Numbers</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input type="checkbox" ng-model="terminal_specific_issue">
                                        Only Numbers Issued By Terminal
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Process Queue Layout</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input type="checkbox" ng-model="process_queue_layout">
                                        New Layout
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Queue Now</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input type="checkbox" ng-model="broadcast_check_in">
                                        Show <input id="input_check_in_field" type="text" ng-model="check_in_display" ng-disabled="!broadcast_check_in"> numbers for standby
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Notifications</p>
                                        <small><a class="info-button" href="#general-notif"><span class="glyphicon glyphicon-info-sign"></span>  More info...</a></small>
                                        <div class="clearfix mb20">
                                            <div class="alert alert-warning hidden" role="alert" id="general-notif">
                                                When to notify users via SMS.
                                            </div>
                                        </div>
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
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="remote">
                            <div class="broadcast-wrap2">
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Permission</p>
                                        <small><a class="info-button" href="#remote-queue"><span class="glyphicon glyphicon-info-sign"></span>  More info...</a></small>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input type="checkbox" ng-model="allow_remote"> Allow
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-12 mb20">
                                        <div class="alert alert-warning hidden" role="alert" id="remote-queue">
                                            Allow users to get priority numbers remotely from your business
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">
                                            Remote Queue Limit
                                            <br><small><a class="info-button" href="#remote-queue-limit-alert"> <span class="glyphicon glyphicon-info-sign"></span> More info...</a></small>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input type="text" id="remote-limit" readonly style="border:0; font-weight:bold; width: 28px;" ng-model="remote_limit"> %
                                        <div id="remote-slider"></div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-12 mb20">
                                        <div class="alert alert-warning hidden" role="alert" id="remote-queue-limit-alert">
                                            <strong>Remote Queue Limit</strong> - Set the percentage of people able to join the queue remotely
                                            (E.g.: At 10% Remote queue limit, one person can join remotely after issuing 10 numbers).
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">
                                            Remote Queue Time
                                            <br><small><a class="info-button" href="#remote-queue-time-alert"> <span class="glyphicon glyphicon-info-sign"></span> More info...</a></small>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input type="text" id="remote-time" class="form-control" ng-model="remote_time"/>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-12 mb20">
                                        <div class="alert alert-warning hidden" role="alert" id="remote-queue-time-alert">
                                            <strong>Remote Queue Time</strong> - Set the time when customers are allowed to start getting numbers remotely.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="sms">
                            <div class="broadcast-wrap2">
                                <div class="col-md-12">
                                    <div class="clearfix mb10">
                                        <span class="inline-b" style="padding-right:12px;"><label>Frontline SMS </label> <input ng-disabled="business_features.allow_sms == 'false'" type="radio" value="frontline_sms" ng-model="sms_gateway"/></span>
                                        <span><label>Twilio</label> <input ng-disabled="business_features.allow_sms == 'false'" type="radio" value="twilio" ng-model="sms_gateway"/></span>
                                        <br><small><a class="info-button" href="#sms-alert"><span class="glyphicon glyphicon-info-sign"></span> More info...</a></small>
                                    </div>
                                </div>
                                <div class="clearfix mb20">
                                    <div class="col-md-12">
                                        <div class="alert alert-warning hidden" role="alert" id="sms-alert">
                                            <strong>FeatherQ SMS Notifications</strong> will soon be enjoyed by business partners that have been in close contact with us.
                                            To be one of these partners, you may contact us at <strong><a href="mailto:contact@featherq.com">contact@featherq.com</a></strong>.
                                            You may also call us at <strong>(+63 32) 345-4658</strong> for further inquiries.
                                        </div>
                                    </div>
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
                                            <input class="mb0 white form-control" ng-disabled="business_features.allow_sms == 'false'" type="password" value="@{{ frontline_api_key }}" ng-model="frontline_api_key" ng-disabled="true">
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
                                            <input class="mb0 white form-control" ng-disabled="business_features.allow_sms == 'false'" type="text" value="@{{ frontline_url }}" ng-model="frontline_url" ng-disabled="true">
                                        </div>
                                    </div>
                                </div>
                                <div ng-show="sms_gateway == 'twilio'">
                                    <div class="clearfix">
                                        <div class="col-md-6 mb20">
                                            <p class="title">Twilio Account SID</p>
                                        </div>
                                        <div class="col-md-6 mb20">
                                            <input class="mb0 white form-control" ng-disabled="business_features.allow_sms == 'false'" type="password" value="@{{ twilio_account_sid }}" ng-model="twilio_account_sid" ng-disabled="true">
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-md-6 mb20">
                                            <p class="title">Twilio Auth Token</p>
                                        </div>
                                        <div class="col-md-6 mb20">
                                            <input class="mb0 white form-control" ng-disabled="business_features.allow_sms == 'false'" type="password" value="@{{ twilio_auth_token }}" ng-model="twilio_auth_token" ng-disabled="true">
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-md-6 mb20">
                                            <p class="title">Twilio phone number</p>
                                        </div>
                                        <div class="col-md-6 mb20">
                                            <input class="mb0 white form-control" ng-disabled="business_features.allow_sms == 'false'" type="text" value="@{{ twilio_phone_number }}" ng-model="twilio_phone_number" ng-disabled="true">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-orange btn-lg" ng-click="saveBusinessDetails()"><span class="glyphicon glyphicon-check"></span> SUBMIT</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
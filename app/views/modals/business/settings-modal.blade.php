<div id="settings-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                      aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Service Settings</h4>
            </div>
            <div class="modal-body">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a role="tab" data-toggle="tab"
                                                                  href="#general">GENERAL</a></li>
                        <li role="presentation" class=""><a role="tab" data-toggle="tab" href="#numbers">NUMBERS</a>
                        </li>
                        <li role="presentation" class=""><a role="tab" data-toggle="tab" href="#pacing">PACING</a></li>
                        <li role="presentation" class=""><a role="tab" data-toggle="tab" href="#remote">REMOTE</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="col-md-12 mb20 mt10">
                            <div class="alert alert-@{{ service_settings.success.type ? 'success' : 'danger' }}"
                                 id="service-settings-message" ng-show="service_settings.success.type != undefined">
                                <p style="text-align: center;">@{{ service_settings.success.message }}</p>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade in active" id="general">
                            <div class="broadcast-wrap2">
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Service Name</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input class="mb0 form-control white" type="text" ng-model="edit_service_name"
                                               placeholder="@{{ service_settings.service_name }}"/>
                                        <div class="mt10 alert alert-danger"
                                             ng-show="service_error"> @{{ service_error }}</div>
                                    </div>
                                </div>
                                {{--<div class="clearfix">--}}
                                {{--<div class="col-md-6 mb20">--}}
                                {{--<p class="title">Show Numbers</p>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6 mb20">--}}
                                {{--<input type="checkbox" ng-model="service_settings.terminal_specific_issue">--}}
                                {{--Only Numbers Issued By Terminal--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="clearfix">--}}
                                {{--<div class="col-md-6 mb20">--}}
                                {{--<p class="title">Process Queue Layout</p>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6 mb20">--}}
                                {{--<input type="checkbox" ng-model="service_settings.process_queue_layout">--}}
                                {{--New Layout--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Queue Now</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input id="input_check_in_field" type="text"
                                               ng-model="service_settings.check_in_display"> numbers
                                        for standby
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Grace Period</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input id="input_grace_period" type="text"
                                               ng-model="service_settings.grace_period"> seconds before
                                        number is dropped.
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Notifications</p>
                                        <small><a class="info-button" href="#general-notif"><span
                                                  class="glyphicon glyphicon-info-sign"></span> More info...</a>
                                        </small>
                                        <div class="clearfix mb20">
                                            <div class="alert alert-warning hidden" role="alert" id="general-notif">
                                                When to notify users via SMS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <div class=" mb10">
                                            <input type="checkbox" ng-model="service_settings.sms_current_number">Priority
                                            Number is called
                                        </div>
                                        <div class=" mb10">
                                            <input type="checkbox" ng-model="service_settings.sms_1_ahead">
                                            Priority Number is next in queue
                                        </div>
                                        <div class="mb10">
                                            <input type="checkbox" ng-model="service_settings.sms_5_ahead">
                                            5 Numbers ahead in queue
                                        </div>
                                        <div class="mb10">
                                            <input type="checkbox" ng-model="service_settings.sms_10_ahead">
                                            10 Numbers ahead in queue
                                        </div>
                                        <div class="mb10">
                                            <input id="input_sms_field" type="text"
                                                   ng-model="service_settings.input_sms_field">
                                            <input type="checkbox" ng-model="service_settings.sms_blank_ahead">
                                            Numbers ahead in queue.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="pacing">
                            <div class="broadcast-wrap2">
                                <div class="clearfix">
                                    <div class="col-md-6 mb0">
                                        <p class="title">Enable Pacing: </p>
                                    </div>
                                    <div class="col-md-6 mb0">
                                        <div class="col-md-3">
                                            <input class="mb0" type="radio"
                                                   ng-model="service_settings.pacingStatus" name="enable_pacing"
                                                   value="Yes"
                                                   ng-value="1"> <label>Yes</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input class="mb0" type="radio"
                                                   ng-model="service_settings.pacingStatus" name="enable_pacing"
                                                   value="No"
                                                   ng-value="0"> <label>No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb20">
                                        <div class="alert alert-warning" role="alert">
                                            <p><strong>Note:</strong> Pacing will override the current number limit to
                                                the total number of quota per time slot.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Time Start</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input class="mb0 form-control white" type="time"
                                               ng-model="service_settings.timeStart">
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Time End</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input class="mb0 form-control white" type="time"
                                               ng-model="service_settings.timeEnd">
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Quota</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input class="mb0 form-control white" type="number"
                                               ng-model="service_settings.quota">
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-12 mb20">
                                        <button class="btn btn-warning pull-right" ng-click="setPaceSchedule()"><span
                                              class="glyphicon glyphicon-ok"></span> SET PACE
                                        </button>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-12" style="height: 300px; overflow: auto;">
                                        <table class="table table-condensed table-hover" style="text-align: center;">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center;">Time Start</th>
                                                <th style="text-align: center;">Time End</th>
                                                <th style="text-align: center;">Quota</th>
                                                <th style="text-align: center;">Remove</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="pacingRecord in service_settings.pacingRecords" id="pacing-record-@{{ pacingRecord.pacing_id }}">
                                                <td><strong>@{{ pacingRecord.time_start }}</strong></td>
                                                <td><strong>@{{ pacingRecord.time_end }}</strong></td>
                                                <td><strong>@{{ pacingRecord.quota }}</strong></td>
                                                <td>
                                                    <button class="btn btn-danger btn-xs"
                                                            ng-click="removePacing(pacingRecord.pacing_id)"><span
                                                          class="glyphicon glyphicon-remove"></span></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="numbers">
                            <div class="broadcast-wrap2">
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Number Prefix</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input class="mb0 form-control white" type="text"
                                               ng-model="service_settings.number_prefix">
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Number Start</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input class="mb0 form-control white" type="text"
                                               ng-model="service_settings.number_start">
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Number Limit</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input class="mb0 form-control white" type="text"
                                               ng-model="service_settings.number_limit"> {{--RDH Added queue_limit to Edit Business Page--}}
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Number Suffix</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input class="mb0 form-control white" type="text"
                                               ng-model="service_settings.number_suffix">
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">Numbers Range from</p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <strong>@{{ service_settings.number_prefix + service_settings.number_start + service_settings.number_suffix }}
                                            to @{{ service_settings.number_prefix + service_settings.number_limit  + service_settings.number_suffix }}</strong>
                                    </div>
                                    <div class="col-md-12 mb20">
                                        <div class="alert alert-warning" role="alert">
                                            <p>Once the number prefix is changed, the queue will automatically reset to
                                                the starting
                                                number</p>
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
                                        <small><a class="info-button" href="#remote-queue"><span
                                                  class="glyphicon glyphicon-info-sign"></span> More info...</a>
                                        </small>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input type="checkbox" ng-model="service_settings.allow_remote"> Allow
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
                                            <br>
                                            <small><a class="info-button" href="#remote-queue-limit-alert"> <span
                                                      class="glyphicon glyphicon-info-sign"></span> More
                                                    info...</a></small>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input type="text" id="remote-limit" readonly
                                               style="border:0; font-weight:bold; width: 28px;"
                                               ng-model="service_settings.remote_limit"> %
                                        <div id="remote-slider"></div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-12 mb20">
                                        <div class="alert alert-warning hidden" role="alert"
                                             id="remote-queue-limit-alert">
                                            <strong>Remote Queue Limit</strong> - Set the percentage of people able to
                                            join the queue remotely
                                            (E.g.: At 10% Remote queue limit, one person can join remotely after issuing
                                            10 numbers).
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-6 mb20">
                                        <p class="title">
                                            Remote Queue Time
                                            <br>
                                            <small><a class="info-button" href="#remote-queue-time-alert"> <span
                                                      class="glyphicon glyphicon-info-sign"></span> More
                                                    info...</a></small>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb20">
                                        <input type="text" id="remote-time" class="form-control"
                                               ng-model="service_settings.remote_time"/>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="col-md-12 mb20">
                                        <div class="alert alert-warning hidden" role="alert"
                                             id="remote-queue-time-alert">
                                            <strong>Remote Queue Time</strong> - Set the time when customers are allowed
                                            to start getting
                                            numbers remotely.
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
                <button type="button" class="btn btn-orange btn-lg" ng-click="saveServiceQueueSettings()"><span
                      class="glyphicon glyphicon-check"></span> SUBMIT
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
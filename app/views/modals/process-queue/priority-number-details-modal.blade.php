<!-- modal -->

<div class="modal fade" id="priority-number-modal" tabindex="-1" data-transaction_number="" ng-controller="messageController">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id=""></h3>
            </div>
            <div class="modal-body">
                <ul id="pmore-tab" class="nav nav-tabs">
                    <li class="details active"><a href="#details" data-toggle="tab">DETAILS</a></li>
                    <li class="messages"><a href="#messages" data-toggle="tab" ng-click="getMessages()">MESSAGES</a></li>
                </ul>
                <div class="clearfix tab-content">
                    <div class="tab-pane fade active in" id="details">
                        <div class="">
                            <div class="col-md-4 col-xs-4"><h5>Priority Number: </h5></div>
                            <div class="col-md-8 col-xs-8"><h5 id="priority-number-number"></h5></div>
                        </div>
                        <div class="">
                            <div class="col-md-4 col-xs-4"><h5>Confirmation Code: </h5></div>
                            <div class="col-md-8 col-xs-8"><h5 id="priority-number-confirmation-code"></h5></div>
                        </div>
                        <div class="">
                            <div class="col-md-4 col-xs-4"><h5>Name: </h5></div>
                            <div class="col-md-8 col-xs-8"><h5 id="priority-number-name"></h5></div>
                        </div>
                        <div class="">
                            <div class="col-md-4 col-xs-4"><h5>Phone: </h5></div>
                            <div class="col-md-8 col-xs-8"><h5 id="priority-number-phone"></h5></div>
                        </div>
                        <div class="">
                            <div class="col-md-4 col-xs-4"><h5>Email: </h5></div>
                            <div class="col-md-8 col-xs-8"><h5 id="priority-number-email"></h5></div>
                        </div>
                        <div class="priority-number-custom-fields">
                        </div>
                        <div class="" id="allowed-businesses-area" style="display: none">
                            <div class="col-md-4 col-xs-4"><h5>Forward to: </h5></div>
                            <div class="col-md-7 col-xs-7"><select class="form-control" id="allowed-businesses"></select></div>
                            <div class="col-md-12 col-xs-12 mt10 mb10"><div class="alert alert-success text-center" style="display: none" id="forward-success"></div></div>
                            <div class="col-md-12 col-xs-12 text-right"><button class=" btn btn-orange btn-md" id="forward-btn"><span class="glyphicon glyphicon-share-alt mr5"></span>Forward</button></div>
                            {{--<div class="col-md-12 col-xs-12 text-right"><button class="btn btn-primary" id="priority-number-modal-close" data-dismiss="modal">Close</button></div>--}}
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="messages">
                        <div class="">
                            <div class="col-md-12 text-center"><h5>Conversation History</h5></div>
                            <div class="col-md-12" style="max-height: 300px; overflow: auto;">
                                <div ng-repeat="message in messages" class=" mb10">
                                    <div ng-if="message.sender == 'user'" class="alert alert-success">
                                        <p>
                                            <strong>User: </strong>
                                            <p ng-bind-html="message.content"></p>
                                            <a href="@{{ message.attachment }}" ng-if="message.attachment" target="_blank">Download Attachment</a>
                                            <span class="pull-right">Sent @{{ message.timestamp }}</span>
                                        </p>
                                    </div>
                                    <div ng-if="message.sender == 'business'" class="alert alert-info mb10">
                                        <p>
                                            <strong>You: </strong>
                                            <p ng-bind-html="message.content"></p>
                                            <a href="@{{ message.attachment }}" ng-if="message.attachment" target="_blank">Download Attachment</a>
                                            <span class="pull-right">Sent @{{ message.timestamp }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12"><a href="#" ng-click="getMessages()"><span class="glyphicon glyphicon-refresh"></span> Refresh Messages</a></div>
                            <div class="col-md-12">
                                <h5>Send A Message</h5>
                                <div ng-show="allow_send">
                                    <textarea class="form-control" rows="5" placeholder="Write a message..." style="resize: none;" ng-model="message_reply" ng-show="allow_send"></textarea>
                                    <button class="btn btn-primary btn-md pull-right" ng-click="sendBusinessReply()" >Send Message</button>
                                </div>
                                <div ng-show="!allow_send">
                                    <textarea class="form-control disabled" disabled="disabled" rows="5" placeholder="Cannot send a reply unless the customer sends an initial message." style="resize: none;" ng-show="!allow_send"></textarea>
                                    <button class="btn btn-primary btn-md pull-right disabled" ng-show="!allow_send" title=""><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Send Message</button>
                                </div>
                                <input type="hidden" name="picture" role="uploadcare-uploader" id="business-attachment" ng-show="allow_send"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!--eo modal-->
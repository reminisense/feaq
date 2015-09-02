<!-- modal -->

<div class="modal fade" id="priority-number-modal" tabindex="-1" data-transaction_number="">{{--<div class="modal fade" id="priority-number-modal" tabindex="-1" ng-controller="messageController">--}}
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
                    {{-- ARA Save this for later <li class="messages"><a href="#messages" data-toggle="tab" ng-click="getMessages()">MESSAGES</a></li> --}}
                </ul>
                <div class="clearfix tab-content">
                    <div class="tab-pane fade active in" id="details">
                        <div class="">
                            <div class="col-md-6 col-xs-6"><h5>Priority Number: </h5></div>
                            <div class="col-md-6 col-xs-6"><h5 id="priority-number-number"></h5></div>
                        </div>
                        <div class="">
                            <div class="col-md-6 col-xs-6"><h5>Name: </h5></div>
                            <div class="col-md-6 col-xs-6"><h5 id="priority-number-name"></h5></div>
                        </div>
                        <div class="">
                            <div class="col-md-6 col-xs-6"><h5>Phone: </h5></div>
                            <div class="col-md-6 col-xs-6"><h5 id="priority-number-phone"></h5></div>
                        </div>
                        <div class="">
                            <div class="col-md-6 col-xs-6"><h5>Email: </h5></div>
                            <div class="col-md-6 col-xs-6"><h5 id="priority-number-email"></h5></div>
                        </div>
                        <div class="" id="allowed-businesses-area">
                            <div class="col-md-6 col-xs-6"><h5>Forward to business: </h5></div>
                            <div class="col-md-4 col-xs-4"><select id="allowed-businesses"></select></div>
                            <div class="col-md-1 col-xs-1"><button class="btn btn-primary" id="forward-btn">Forward</button></div>
                        </div>
                    </div>
                    {{-- ARA Save this for later
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
                    --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-orange btn-md" data-dismiss="modal" aria-label="Close">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->